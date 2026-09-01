<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\FeeRequest;
use App\Models\Settings;
use Illuminate\Support\Facades\Auth;

class FeeRequestController extends Controller
{
    public function index()
    {
        $settings = Settings::find(1);

        return view('user.fee-requests.index', [
            'title' => 'Fee Requests',
            'feeRequests' => FeeRequest::where('user_id', Auth::id())
                ->with('fraudCase')
                ->orderByDesc('created_at')
                ->paginate(15),
            'currency' => $settings->currency ?? '$',
            'settings' => $settings,
        ]);
    }
}
