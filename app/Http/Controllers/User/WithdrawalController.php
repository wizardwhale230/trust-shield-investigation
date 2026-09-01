<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Settings;
use App\Models\User_plans;
use App\Models\Wdmethod;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\Auth;
use App\Mail\NewNotification;
use App\Helpers\SafeMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\WithdrawalStatus;
use App\Traits\Coinpayment;
use App\Traits\TemplateTrait;
use Session;

class WithdrawalController extends Controller
{
    use Coinpayment, TemplateTrait;
    //
    public function withdrawamount(Request $request)
    {
        $request->session()->put('paymentmethod', $request->method);
        return redirect()->route('withdrawfunds');
    }

    //Return withdrawals route
    public function withdrawfunds()
    {
        $paymethod = session('paymentmethod');
        $checkmethod =  Wdmethod::where('name', $paymethod)->first();
        if ($checkmethod->defaultpay == "yes") {
            $default = true;
        } else {
            $default = false;
        }

        if ($checkmethod->methodtype == "crypto") {
            $methodtype = 'crypto';
        } else {
            $methodtype = 'currency';
        }

        return view("user.withdraw", [
            'title' => 'Complete Withdrawal Request',
            'payment_mode' => $paymethod,
            'default' => $default,
            'methodtype' => $methodtype,
        ]);
    }

    public function getotp()
    {
        // OTP step removed from withdrawal flow.
        return redirect()->route('withdrawfunds');
    }
    
    
    
    public function taxverification(Request $request){
        // Tax verification step removed from withdrawal flow.
        return redirect()->route('withdrawfunds');
    }
    
    
    public function userwithdrawal(Request $request){
        // Withdrawal-code gate removed from withdrawal flow.
        return redirect()->route('withdrawfunds');
    }
    
    
    
    

    public function completewithdrawal(Request $request)
    {
        $data = [
            'method' => $request->method,
            'amount' => $request->amount,
        ];

        $settings = Settings::where('id', '1')->first();
        if ($settings->enable_kyc == "yes") {
            if (Auth::user()->account_verify != "Verified") {
                return redirect()->back()->with('message', 'Your account must be verified before you can make withdrawal.');
            }
        }

        $method = Wdmethod::where('name',  $data['method'])->first();


            
        if ($method->charges_type == 'percentage') {
            $charges =  $data['amount'] * $method->charges_amount / 100;
        } else {
            $charges = $method->charges_amount;
        }

        $to_withdraw = $data['amount'] + $charges;
        //return if amount is lesser than method minimum withdrawal amount

        if (Auth::user()->account_bal < $to_withdraw) {
            return redirect()->route('withdrawfunds')
                ->with('message', 'Sorry, your available balance is insufficient for this request.');
        }

        if ($data['amount'] < $method->minimum) {
             return redirect()->route('withdrawfunds')
                ->with("message", "Sorry, The minimum amount you can withdraw is $settings->currency$method->minimum, please try another payment method.");
        }

        //get user last investment package
        User_plans::where('user', Auth::user()->id)
            ->where('active', 'yes')
            ->orderBy('activated_at', 'asc')->first();

        //get user
        $user = User::where('id', Auth::user()->id)->first();

        // Beneficiary destination is now entered inline on the disbursement form
        // (see resources/views/user/withdraw.blade.php) and arrives as $request->details.
        // Profile-based wallet/bank fields are used as a fallback only.
        $coin = null;
        $wallet = null;
        if ( $data['method'] == 'Bitcoin') {
            $coin = "BTC";
            $wallet = $user->btc_address ?: $request->details;
        } elseif ( $data['method'] == 'Ethereum') {
            $coin = "ETH";
            $wallet = $user->eth_address ?: $request->details;
        } elseif ( $data['method']  == 'Litecoin') {
            $coin = "LTC";
            $wallet = $user->ltc_address ?: $request->details;
        } elseif ( $data['method']  == 'USDT') {
            $coin = "USDT.TRC20";
            $wallet = $user->usdt_address ?: $request->details;
        }

        if (empty($request->details)) {
            return redirect()->route('withdrawfunds')
                ->with('message', 'Please provide the beneficiary destination for this disbursement.');
        }

        $amount = $data['amount'];
        $ui = $user->id;

        if ($settings->deduction_option == "userRequest") {
            //debit user available balance
            User::where('id', $user->id)->update([
                'account_bal' => $user->account_bal - $to_withdraw,
            ]);
        }

        if ($settings->withdrawal_option == "auto" and ( $data['method'] == 'Bitcoin' or  $data['method']  == 'Litecoin' or  $data['method']  == 'Ethereum' or  $data['method'] == 'USDT')) {
            return $this->cpwithdraw($amount, $coin, $wallet, $ui, $to_withdraw);
        }

        //save withdrawal info
        $dp = new Withdrawal();
        $dp->amount = $amount;
        $dp->to_deduct = $to_withdraw;
        $dp->payment_mode =$data['method'];
        $dp->status = 'Pending';
        $dp->paydetails = $request->details;
        $dp->user = $user->id;
        $dp->save();

        // send mail to admin and user — never let a transport failure surface to the client
        SafeMail::send(fn() => Mail::to($settings->contact_email)->send(new WithdrawalStatus($dp, $user, 'Withdrawal Request', true)), ['withdrawal_id' => $dp->id]);
        SafeMail::send(fn() => Mail::to($user->email)->send(new WithdrawalStatus($dp, $user, 'Successful Withdrawal Request')), ['withdrawal_id' => $dp->id, 'user_id' => $user->id]);

        return redirect()->route('withdrawalsdeposits')
            ->with('success', 'Action Sucessful! Please wait while we process your request.');
    }


    // for front end content management
    function RandomStringGenerator($n)
    {
        $generated_string = "";
        $domain = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        $len = strlen($domain);
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, $len - 1);
            $generated_string = $generated_string . $domain[$index];
        }
        // Return the random generated string 
        return $generated_string;
    }
}
