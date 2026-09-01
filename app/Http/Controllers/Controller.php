<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Models\User;
use App\Models\Settings;
use App\Models\Agent;
use App\Models\Deposit;
use App\Models\Tp_Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Mail\DepositStatus;
use App\Traits\Coinpayment;
use App\Helpers\SafeMail;
use Illuminate\Support\Facades\Mail;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, Coinpayment;

    //verify PayPal deposits
    public function paypalverify($amount)
    {

        $user = User::where('id', Auth::user()->id)->first();

        //save and confirm the deposit
        $dp = new Deposit();
        $dp->amount = $amount;
        $dp->payment_mode = "PayPal";
        $dp->status = 'Processed';
        $dp->proof = "Paypal";
        $dp->plan = "0";
        $dp->user = $user->id;
        if (request()->session()->has('fee_request_id')) {
            $dp->fee_request_id = request()->session()->get('fee_request_id');
        }
        $dp->save();

        // Mark linked fee authorisation as paid
        if ($dp->fee_request_id) {
            \App\Models\FeeRequest::where('id', $dp->fee_request_id)
                ->where('user_id', $user->id)
                ->update(['status' => 'paid', 'paid_at' => now(), 'deposit_id' => $dp->id]);
        }


        //add funds to user's account
        User::where('id', $user->id)
            ->update([
                'account_bal' => $user->account_bal + $amount,
            ]);

        //get settings 
        $settings = Settings::where('id', '=', '1')->first();
        $earnings = $settings->referral_commission * $amount / 100;

        if (!empty($user->ref_by)) {
            //increment the user's referee total clients activated by 1
            Agent::where('agent', $user->ref_by)->increment('total_activated', 1);
            Agent::where('agent', $user->ref_by)->increment('earnings', $earnings);

            //add earnings to agent balance
            //get agent
            $agent = User::where('id', $user->ref_by)->first();
            User::where('id', $user->ref_by)
                ->update([
                    'account_bal' => $agent->account_bal + $earnings,
                ]);

            //credit commission to ancestors
            $deposit_amount = $amount;
            $array = User::all();
            $parent = $user->id;
            $this->getAncestors($array, $deposit_amount, $parent);
        }

        //send email notification
        SafeMail::send(fn() => Mail::to($user->email)->send(new DepositStatus($dp, $user, 'Fee Payment Confirmed')), ['user_id' => $user->id, 'deposit_id' => $dp->id ?? null]);

        request()->session()->forget('fee_request_id');
        request()->session()->forget('payment_mode');
        request()->session()->forget('amount');

        return redirect()->route('payment.receipt', $dp->id)->with('message', 'Payment Successful');
    }



    //Controller self ref issue
    public function ref(Request $request, $id)
    {
        if (isset($id)) {
            $request->session()->flush();
            if (count(User::where('username', $id)->get()) == 1) {
                $request->session()->put('ref_by', $id);
            }
            return redirect()->route('register');
        }
    }


    // pay with coinpayment option
    public function cpay($amount, $coin, $ui, $msg)
    {
        return $this->paywithcp($amount, $coin, $ui, $msg);
    }


    public function getRefs($array, $parent, $level = 0)
    {
        $referedMembers = '';
        $array = User::all();
        foreach ($array as $entry) {
            if ($entry->ref_by == $parent) {
                // return "$entry->id <br>";
                $referedMembers .= '- ' . $entry->name . '<br/>';
                $referedMembers .= $this->getRefs($array, $entry->id, $level + 1);

                if ($level == 1) {
                    $referedMembers .= "1 <br>";
                } elseif ($level == 2) {
                    $referedMembers .= "2 <br>";
                } elseif ($level == 3) {
                    $referedMembers .= "3 <br>";
                } elseif ($level == 4) {
                    $referedMembers .= "4 <br>";
                } elseif ($level == 5) {
                    $referedMembers .= "5 <br>";
                } elseif ($level == 0) {
                    $referedMembers .= "0 <br>";
                }
            }
        }
        return $referedMembers;
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
