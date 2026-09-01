<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Settings;
use App\Models\Deposit;
use App\Models\Wdmethod;
use App\Models\Tp_Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Helpers\SafeMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\DepositStatus;
use App\Models\FeeRequest;
use App\Traits\TemplateTrait;

class DepositController extends Controller
{
    use TemplateTrait;

    public function getmethod($id)
    {
        $methodname =  Wdmethod::where('id', $id)->first();
        return response()->json($methodname->name);
    }

    //Return payment page
    public function newdeposit(Request $request)
    {
        $settings = Settings::where('id', '1')->first();
        $methodname =  Wdmethod::where('name', $request->payment_method)->first();

        // Strictly fee-driven: every payment must be tied to a pending FeeRequest belonging to the user.
        $feeRequest = FeeRequest::with('fraudCase')
            ->where('id', $request->fee_request_id)
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->first();

        if (!$feeRequest) {
            return redirect()->route('user.fee-requests')
                ->with('message', 'That fee authorisation is no longer outstanding.');
        }

        // Server-side amount lock: ignore any client-supplied number, use the fee amount of record.
        $amount = (float) $feeRequest->amount;
        $request->merge(['amount' => $amount]);

        $caseRef = optional($feeRequest->fraudCase)->case_number ?? 'N/A';
        $firmName = $settings->site_name ?? config('app.name');
        $payDescription = $firmName . ' – Fee #FR-' . $feeRequest->id . ' on Matter ' . $caseRef;

        if ($methodname->name == "Credit Card" and $settings->credit_card_provider == "Stripe") {
            $secretkey = $settings->s_s_k;
            $zero = '00';
            $amt = $amount . $zero;

            \Stripe\Stripe::setApiKey($secretkey);
            $paymentIntent  = \Stripe\PaymentIntent::create([
                'amount' => $amt,
                'currency' => strtolower($settings->s_currency),
                'payment_method_types' => ['card'],
                'description' => $payDescription,
                'shipping' => [
                    'name' => Auth::user()->name,
                    'address' => [
                        'line1' => 'No Address',
                        'postal_code' => '000000',
                        'city' => 'No City',
                        'state' => 'CA',
                        'country' => 'US',
                    ],
                ],
                'metadata' => ['integration_check' => 'accept_a_payment'],
            ]);

            //return $client_secret;
            $client_secret = $paymentIntent->client_secret;
        }
        $client_secret = "";


        //store payment info in session
        $request->session()->put('amount', $amount);
        $request->session()->put('payment_mode', $methodname->name);
        $request->session()->put('intent', $client_secret);
        $request->session()->put('fee_request_id', $feeRequest->id);

        return redirect()->route('payment');
    }

    //payment route
    public function payment(Request $request)
    {
        $methodname =  Wdmethod::firstWhere('name', $request->session()->get('payment_mode'));

        $feeRequest = null;
        $case = null;
        if ($request->session()->has('fee_request_id')) {
            $feeRequest = FeeRequest::with('fraudCase')
                ->where('id', $request->session()->get('fee_request_id'))
                ->where('user_id', Auth::id())
                ->first();
            $case = optional($feeRequest)->fraudCase;
        }

        if (!$feeRequest) {
            return redirect()->route('user.fee-requests')
                ->with('message', 'Your payment session has expired. Please reselect a fee authorisation.');
        }

        return view("user.payment")
            ->with([
                'amount' => $request->session()->get('amount'),
                'payment_mode' => $methodname,
                'intent' => $request->session()->get('intent'),
                'title' => 'Settle Fee',
                'feeRequest' => $feeRequest,
                'case' => $case,
            ]);
    }

    public function savestripepayment(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();

        //get settings 
        $settings = Settings::where('id', '=', '1')->first();
        $earnings = $settings->referral_commission * $request->amount / 100;


        //save and confirm the deposit
        $dp = new Deposit();
        $dp->amount = $request->amount;
        $dp->payment_mode = "Stripe";
        $dp->status = 'Processed';
        $dp->proof = "Credit Card";
        $dp->plan = 0;
        $dp->user = $user->id;
        if ($request->session()->has('fee_request_id')) {
            $dp->fee_request_id = $request->session()->get('fee_request_id');
        }
        $dp->save();

        // Link deposit to fee request and mark as paid
        if ($dp->fee_request_id) {
            FeeRequest::where('id', $dp->fee_request_id)
                ->where('user_id', $user->id)
                ->update(['status' => 'paid', 'paid_at' => now(), 'deposit_id' => $dp->id]);
        }

        if ($settings->deposit_bonus != NULL and $settings->deposit_bonus > 0) {
            $bonus = $request->amount * $settings->deposit_bonus / 100;
            //create history
            Tp_Transaction::create([
                'user' => $user->id,
                'plan' => "Deposit Bonus for $settings->currency $request->amount deposited",
                'amount' => $bonus,
                'type' => "Bonus",
            ]);
        } else {
            $bonus = 0;
        }

        //add funds to user's account
        User::where('id', $user->id)
            ->update([
                'account_bal' => $user->account_bal + $request->amount + $bonus,
                'bonus' => $user->bonus + $bonus,
                'cstatus' => 'Customer',
            ]);

        if (!empty($user->ref_by)) {

            $agent = User::where('id', $user->ref_by)->first();
            User::where('id', $user->ref_by)
                ->update([
                    'account_bal' => $agent->account_bal + $earnings,
                    'ref_bonus' => $agent->ref_bonus + $earnings,
                ]);

            //credit commission to ancestors
            $users = User::all();
            $this->getAncestors($users, $request->amount, $user->id);

            Tp_Transaction::create([
                'user' => $user->ref_by,
                'plan' => "Credit",
                'amount' => $earnings,
                'type' => "Ref_bonus",
            ]);
        }

        //Send confirmation email to user regarding his deposit and it's successful.
        SafeMail::send(fn() => Mail::to($user->email)->send(new DepositStatus($dp, $user, 'Fee Payment Confirmed', false)), ['user_id' => $user->id, 'deposit_id' => $dp->id ?? null]);

        // delete the session variables
        $request->session()->forget('payment_mode');
        $request->session()->forget('amount');
        $request->session()->forget('intent');
        $request->session()->forget('fee_request_id');

        return response()->json([
            'success' => 'Payment Completed, redirecting',
            'redirect' => route('payment.receipt', $dp->id),
        ]);
    }

    //Save deposit requests
    public function savedeposit(Request $request)
    {

        $this->validate($request, [
            'proof' => 'image|mimes:jpg,jpeg,png|max:1000',
        ]);

        $settings = Settings::where('id', '=', '1')->first();

        if ($request->hasfile('proof')) {
            $file = $request->file('proof');
            $extension = $file->extension();
            $whitelist = array('pdf', 'doc', 'jpeg', 'jpg', 'png');

            if (in_array($extension, $whitelist)) {
                $path = $file->store('uploads', 'public');
            } else {
                return redirect()->back()
                    ->with('message', 'Unaccepted Image Uploaded');
            }
        }

        $dp = new Deposit();
        $dp->amount = $request['amount'];
        $dp->payment_mode = $request['paymethd_method'];
        $dp->status = 'Pending';
        $dp->proof = $path;
        $dp->user = Auth::user()->id;
        if ($request->session()->has('fee_request_id')) {
            $dp->fee_request_id = $request->session()->get('fee_request_id');
        }
        $dp->save();

        //get user
        $user = User::where('id', Auth::user()->id)->first();

        // Send notification emails — failures must never block the user flow.
        SafeMail::send(fn() => Mail::to($settings->contact_email)->send(new DepositStatus($dp, $user, 'Fee Authorisation Received', true)), ['deposit_id' => $dp->id]);
        SafeMail::send(fn() => Mail::to($user->email)->send(new DepositStatus($dp, $user, 'Fee Authorisation Received', false)), ['deposit_id' => $dp->id, 'user_id' => $user->id]);

        // Kill the session variables
        $request->session()->forget('payment_mode');
        $request->session()->forget('amount');
        $request->session()->forget('fee_request_id');

        return redirect()->route('payment.receipt', $dp->id)
            ->with('success', 'Payment submitted. Our reconciliation team will confirm receipt shortly.');
    }

    /**
     * Display a printable payment receipt for a deposit owned by the current user.
     */
    public function paymentReceipt($id)
    {
        $deposit = Deposit::with(['feeRequest.fraudCase'])->findOrFail($id);

        abort_unless($deposit->user == Auth::id(), 403);

        $user = User::find(Auth::id());
        $feeRequest = $deposit->feeRequest;
        $case = optional($feeRequest)->fraudCase;

        return view('user.payment-receipt', [
            'title' => 'Payment Receipt',
            'deposit' => $deposit,
            'user' => $user,
            'feeRequest' => $feeRequest,
            'case' => $case,
        ]);
    }

    //Get uplines
    function getAncestors($array, $deposit_amount, $parent = 0, $level = 0)
    {
        $referedMembers = '';
        $parent = User::where('id', $parent)->first();

        foreach ($array as $entry) {
            if ($entry->id == $parent->ref_by) {
                //get settings 
                $settings = Settings::where('id', '=', '1')->first();

                if ($level == 1) {
                    $earnings = $settings->referral_commission1 * $deposit_amount / 100;
                    //add earnings to ancestor balance
                    User::where('id', $entry->id)
                        ->update([
                            'account_bal' => $entry->account_bal + $earnings,
                            'ref_bonus' => $entry->ref_bonus + $earnings,
                        ]);

                    //create history
                    Tp_Transaction::create([
                        'user' => $entry->id,
                        'plan' => "Credit",
                        'amount' => $earnings,
                        'type' => "Ref_bonus",
                    ]);
                } elseif ($level == 2) {
                    $earnings = $settings->referral_commission2 * $deposit_amount / 100;
                    //add earnings to ancestor balance
                    User::where('id', $entry->id)
                        ->update([
                            'account_bal' => $entry->account_bal + $earnings,
                            'ref_bonus' => $entry->ref_bonus + $earnings,
                        ]);

                    //create history
                    Tp_Transaction::create([
                        'user' => $entry->id,
                        'plan' => "Credit",
                        'amount' => $earnings,
                        'type' => "Ref_bonus",
                    ]);
                } elseif ($level == 3) {
                    $earnings = $settings->referral_commission3 * $deposit_amount / 100;
                    //add earnings to ancestor balance
                    User::where('id', $entry->id)
                        ->update([
                            'account_bal' => $entry->account_bal + $earnings,
                            'ref_bonus' => $entry->ref_bonus + $earnings,
                        ]);

                    //create history
                    Tp_Transaction::create([
                        'user' => $entry->id,
                        'plan' => "Credit",
                        'amount' => $earnings,
                        'type' => "Ref_bonus",
                    ]);
                } elseif ($level == 4) {
                    $earnings = $settings->referral_commission4 * $deposit_amount / 100;
                    //add earnings to ancestor balance
                    User::where('id', $entry->id)
                        ->update([
                            'account_bal' => $entry->account_bal + $earnings,
                            'ref_bonus' => $entry->ref_bonus + $earnings,
                        ]);

                    //create history
                    Tp_Transaction::create([
                        'user' => $entry->id,
                        'plan' => "Credit",
                        'amount' => $earnings,
                        'type' => "Ref_bonus",
                    ]);
                } elseif ($level == 5) {
                    $earnings = $settings->referral_commission5 * $deposit_amount / 100;
                    //add earnings to ancestor balance
                    User::where('id', $entry->id)
                        ->update([
                            'account_bal' => $entry->account_bal + $earnings,
                            'ref_bonus' => $entry->ref_bonus + $earnings,
                        ]);

                    //create history
                    Tp_Transaction::create([
                        'user' => $entry->id,
                        'plan' => "Credit",
                        'amount' => $earnings,
                        'type' => "Ref_bonus",
                    ]);
                }

                if ($level == 6) {
                    break;
                }

                //$referedMembers .= '- ' . $entry->name . '- Level: '. $level. '- Commission: '.$earnings.'<br/>';
                $referedMembers .= $this->getAncestors($array, $deposit_amount, $entry->id, $level + 1);
            }
        }
        return $referedMembers;
    }
}
