<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CryptoAccount;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Settings;
use App\Models\Plans;
use App\Models\User_plans;
use App\Models\Mt4Details;
use App\Models\Deposit;
use App\Models\SettingsCont;
use App\Models\Wdmethod;
use App\Models\Withdrawal;
use App\Models\Tp_Transaction;
use App\Models\FraudCase;
use App\Models\FeeRequest;
use App\Models\CaseNote;
use App\Traits\PingServer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ViewsController extends Controller
{
    use PingServer;

    public function dashboard(Request $request)
    {

        $settings = Settings::where('id', '1')->first();
        $user = User::find(auth()->user()->id);

        //check if user does not have ref link then update his link
        if ($user->ref_link == '') {
            User::where('id', $user->id)
                ->update([
                    'ref_link' => $settings->site_address . '/ref/' . $user->username,
                ]);
        }

        //give reg bonus if new
        if ($user->signup_bonus != "received" && ($settings->signup_bonus != NULL && $settings->signup_bonus > 0)) {
            User::where('id', $user->id)
                ->update([
                    'bonus' => $user->bonus + $settings->signup_bonus,
                    'account_bal' => $user->account_bal + $settings->signup_bonus,
                    'signup_bonus' => "received",
                ]);
            //create history
            Tp_Transaction::create([
                'user' => Auth::user()->id,
                'plan' => "SignUp Bonus",
                'amount' => $settings->signup_bonus,
                'type' => "Bonus",
            ]);
        }

        if (DB::table('crypto_accounts')->where('user_id', Auth::user()->id)->doesntExist()) {
            $cryptoaccnt = new CryptoAccount();
            $cryptoaccnt->user_id = Auth::user()->id;
            $cryptoaccnt->save();
        }

        //sum total deposited
        $total_deposited = DB::table('deposits')->where('user', $user->id)->where('status', 'Processed')->sum('amount');

        $total_withdrawal = DB::table('withdrawals')->where('user', $user->id)->where('status', 'Processed')->sum('amount');

        //log user out if not blocked by admin
        if ($user->status != "active") {
            $request->session()->flush();
            return redirect()->route('dashboard');
        }

        $totalCases = FraudCase::where('user_id', $user->id)->count();
        $activeCases = FraudCase::where('user_id', $user->id)
            ->whereNotIn('status', ['closed', 'withdrawal_ready'])
            ->count();
        $totalRecovered = (float) FraudCase::where('user_id', $user->id)->sum('amount_recovered');
        $recentCases = FraudCase::where('user_id', $user->id)->orderByDesc('id')->take(5)->get();
        $pendingFeeRequests = FeeRequest::with('fraudCase')->where('user_id', $user->id)->where('status', 'pending')->orderByDesc('id')->take(5)->get();

        $primaryCase = FraudCase::with('assignedTo')
            ->where('user_id', $user->id)
            ->whereNotIn('status', ['closed'])
            ->orderByDesc('id')
            ->first();

        $userCaseIds = FraudCase::where('user_id', $user->id)->pluck('id');
        $caseActivity = CaseNote::with('fraudCase')
            ->whereIn('case_id', $userCaseIds)
            ->where('is_internal', false)
            ->orderByDesc('id')
            ->take(6)
            ->get();

        $nextActionCount = $pendingFeeRequests->count();

        return view("user.dashboard-new", [
            'title' => 'Account Dashboard',
            'totalCases' => $totalCases,
            'activeCases' => $activeCases,
            'totalRecovered' => $totalRecovered,
            'recentCases' => $recentCases,
            'pendingFeeRequests' => $pendingFeeRequests,
            'primaryCase' => $primaryCase,
            'caseActivity' => $caseActivity,
            'nextActionCount' => $nextActionCount,
            'currency' => $settings->currency ?? '$',
            'settings' => $settings,
        ]);
    }

    //Profile route
    public function profile()
    {
        $userinfo = User::where('id', Auth::user()->id)->first();

        $paymethods = Wdmethod::select(['status', 'name'])->where(function ($query) {
            $query->where('type', '=', 'withdrawal')
                ->orWhere('type', '=', 'both');
        })->whereIn('name', ['Bitcoin', 'Ethereum', 'Litecoin', 'Bank Transfer', 'USDT'])->get();

        return view("user.profile")->with(array(
            'userinfo' => $userinfo,
            'methods' => $paymethods,
            'title' => 'Profile',
        ));
    }

    //return add withdrawal account form view
    public function accountdetails()
    {
        return view("user.profile")->with(array(
            'title' => 'Update account details',
        ));
    }


    //support route
    public function support()
    {
        return redirect()->route('user.support-tickets.index');
    }

    //Trading history route
    public function tradinghistory()
    {
        return view("user.thistory")
            ->with(array(
                't_history' => Tp_Transaction::where('user', Auth::user()->id)
                    ->where('type', 'ROI')
                    ->orderByDesc('id')
                    ->paginate(15),
                'title' => 'Trading History',
            ));
    }

    //Account transactions history route
    public function accounthistory()
    {
        return view("user.transactions")
            ->with(array(
                't_history' => Tp_Transaction::where('user', Auth::user()->id)
                    ->where('type', '<>', 'ROI')
                    ->orderByDesc('id')
                    ->get(),

                'withdrawals' => Withdrawal::where('user', Auth::user()->id)->orderBy('id', 'desc')
                    ->get(),
                'deposits' => Deposit::where('user', Auth::user()->id)->orderBy('id', 'desc')
                    ->get(),
                'title' => 'Account Transactions History',

            ));
    }

    //Return fee authorisation / payment route
    public function deposits(Request $request)
    {
        $userId = Auth::id();

        // This portal is strictly fee-driven: clients can only pay fees the firm has raised.
        $feeRequestId = $request->query('fee_request_id');

        if (!$feeRequestId) {
            // Push the client to the fee authorisations index where they pick a fee.
            return redirect()->route('user.fee-requests')
                ->with('message', 'Please select a fee authorisation to settle.');
        }

        $feeRequest = FeeRequest::with('fraudCase')
            ->where('id', $feeRequestId)
            ->where('user_id', $userId)
            ->where('status', 'pending')
            ->first();

        if (!$feeRequest) {
            return redirect()->route('user.fee-requests')
                ->with('message', 'That fee authorisation is no longer outstanding.');
        }

        $paymethod = Wdmethod::where(function ($query) {
            $query->where('type', '=', 'deposit')
                ->orWhere('type', '=', 'both');
        })->where('status', 'enabled')->orderByDesc('id')->get();

        return view("user.deposits")
            ->with([
                'title' => 'Authorise Fee',
                'dmethods' => $paymethod,
                'feeRequest' => $feeRequest,
                'case' => $feeRequest->fraudCase,
            ]);
    }

    //Return withdrawals route
    public function withdrawals()
    {
        $withdrawals =  Wdmethod::where(function ($query) {
            $query->where('type', '=', 'withdrawal')
                ->orWhere('type', '=', 'both');
        })->where('status', 'enabled')->orderByDesc('id')->get();

        return view("user.withdrawals")
            ->with(array(
                'title' => 'Withdraw Your funds',
                'wmethods' => $withdrawals,
            ));
    }

    public function transferview()
    {
        $settings = SettingsCont::find(1);
        if (!$settings->use_transfer) {
            abort(404);
        }
        return view("user.transfer", [
            'title' => 'Send funds to a friend',
        ]);
    }

    //Subscription Trading 
    public function subtrade()
    {
        $settings = Settings::where('id', 1)->first();
        $mod = $settings->modules;
        if (!$mod['subscription']) {
            abort(404);
        }
        return view("user.subtrade")
            ->with(array(
                'title' => 'Subscription Trade',
                'subscriptions' => Mt4Details::where('client_id', auth::user()->id)->orderBy('id', 'desc')->get(),
            ));
    }


    //Main Plans route
    public function mplans()
    {
        return view("user.mplans")
            ->with(array(
                'title' => 'Main Plans',
                'plans' => Plans::where('type', 'main')->get(),
                'settings' => Settings::where('id', '1')->first(),
            ));
    }

    //My Plans route
    public function myplans($sort)
    {
        if ($sort == 'All') {
            return view("user.myplans")
                ->with(array(
                    'numOfPlan' => User_plans::where('user', Auth::user()->id)->count(),
                    'title' => 'Your packages',
                    'plans' => User_plans::where('user', Auth::user()->id)->orderByDesc('id')->paginate(10),
                    'settings' => Settings::where('id', '1')->first(),
                ));
        } else {
            return view("user.myplans")
                ->with(array(
                    'numOfPlan' => User_plans::where('user', Auth::user()->id)->count(),
                    'title' => 'Your packages',
                    'plans' => User_plans::where('user', Auth::user()->id)->where('active', $sort)->orderByDesc('id')->paginate(10),
                    'settings' => Settings::where('id', '1')->first(),
                ));
        }
    }


    public function sortPlans($sort)
    {
        return redirect()->route('myplans', ['sort' => $sort]);
    }

    public function planDetails($id)
    {
        $plan = User_plans::find($id);
        return view("user.plandetails", [
            'title' => $plan->dplan->name,
            'plan' => $plan,
            'transactions' => Tp_Transaction::where('type', 'ROI')->where('user_plan_id', $plan->id)->orderByDesc('id')->paginate(10),
        ]);
    }


    function twofa()
    {
        return view("profile.show", [
            'title' => 'Advance Security Settings',
        ]);
    }

    // Referral Page
    public function referuser()
    {
        return view("user.referuser", [
            'title' => 'Refer user',
        ]);
    }
    
    
    
     // taxcode verification code 
    public function taxverification()
    {
        return view("user.taxverification", [
            'title' => 'withdrawal verification',
        ]);
    }


    public function verifyaccount()
    {
        if (Auth::user()->account_verify == 'Verified') {
            abort(404, 'You do not have permission to access this page');
        }
        return view("user.verify", [
            'title' => 'Verify your Account',
        ]);
    }

    public function verificationForm()
    {
        if (Auth::user()->account_verify == 'Verified') {
            abort(404, 'You do not have permission to access this page');
        }
        return view("user.verification", [
            'title' => 'KYC Application'
        ]);
    }



    public function tradeSignals()
    {
        $settings = Settings::where('id', 1)->first();
        $mod = $settings->modules;
        if (!$mod['signal']) {
            abort(404);
        }

        $response = $this->fetctApi('/subscription', [
            'id' => auth()->user()->id
        ]);
        $res = json_decode($response);

        $responseSt = $this->fetctApi('/signal-settings');
        $info = json_decode($responseSt);

        return view("user.signals.subscribe", [
            'title' => 'Trade signals',
            'subscription' => $res->data,
            'set' => $info->data->settings,
        ]);
    }


    public function binanceSuccess()
    {
        return redirect()->route('deposits')->with('success', 'Your Deposit was successful, please wait while it is confirmed. You will receive a notification regarding the status of your deposit.');
    }

    public function binanceError()
    {
        return redirect()->route('deposits')->with('message', 'Something went wrong please try again. Contact our support center if problem persist');
    }
}
