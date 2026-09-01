<?php
if (Auth('admin')->User()->dashboard_style == 'light') {
    $text = 'dark';
    $bg = 'light';
} else {
    $text = 'light';
    $bg = 'dark';
}
?>
@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel ">
        <div class="content ">
            <div class="page-inner">
                <div class="mt-2 mb-5">
                    <h1 class="title1 d-inline ">Process Withdrawal Request</h1>
                    <div class="d-inline">
                        <div class="float-right btn-group">

                            <a class="btn btn-primary btn-sm" href="{{ route('mwithdrawals') }}"> <i
                                    class="fa fa-arrow-left"></i> back</a>
                        </div>
                    </div>
                </div>
                <x-danger-alert />
                <x-success-alert />
                <div class="mb-5 row">
                    <div class="col-lg-8 offset-lg-2 card p-md-4 p-2  shadow">
                        <div class="mb-3">
                            @if ($withdrawal->status != 'Processed')
                                <h4 class="">Send Funds to {{ $user->name }} through his payment details below</h4>
                            @else
                                <h4 class="text-success">Payment Completed</h4>
                            @endif
                        </div>
                        <div class="">
                            @php
                                // Beneficiary details are now entered inline by the user at withdrawal time
                                // and stored in $withdrawal->paydetails. We prefer that, falling back to the
                                // user's profile fields only when paydetails is empty (legacy records).
                                $details = trim((string) $withdrawal->paydetails);
                                $u = $withdrawal->duser;

                                // For Bank Transfer the composed string is:
                                // "Bank Name: ..., Account Name: ..., Account Number: ..., Swift Code: ..."
                                $bank = ['name' => null, 'account_name' => null, 'account_number' => null, 'swift' => null];
                                if ($withdrawal->payment_mode == 'Bank Transfer') {
                                    if ($details !== '' && stripos($details, 'Bank Name:') !== false) {
                                        if (preg_match('/Bank Name:\s*([^,]*)/i', $details, $m)) $bank['name'] = trim($m[1]);
                                        if (preg_match('/Account Name:\s*([^,]*)/i', $details, $m)) $bank['account_name'] = trim($m[1]);
                                        if (preg_match('/Account Number:\s*([^,]*)/i', $details, $m)) $bank['account_number'] = trim($m[1]);
                                        if (preg_match('/Swift Code:\s*(.*)$/i', $details, $m)) $bank['swift'] = trim($m[1]);
                                    } else {
                                        $bank['name'] = $u->bank_name ?? null;
                                        $bank['account_name'] = $u->account_name ?? null;
                                        $bank['account_number'] = $u->account_number ?? null;
                                        $bank['swift'] = $u->swift_code ?? null;
                                    }
                                }

                                // Crypto/other: prefer inline details; fallback to profile address
                                $cryptoFallback = [
                                    'Bitcoin'  => $u->btc_address ?? null,
                                    'Ethereum' => $u->eth_address ?? null,
                                    'Litecoin' => $u->ltc_address ?? null,
                                    'USDT'     => $u->usdt_address ?? null,
                                ];
                                $cryptoAddress = $details !== '' ? $details : ($cryptoFallback[$withdrawal->payment_mode] ?? null);
                            @endphp

                            @if ($withdrawal->payment_mode == 'Bank Transfer')
                                <div class="mb-3 form-group">
                                    <h5 class="">Bank Name</h5>
                                    <input type="text" class="form-control readonly" value="{{ $bank['name'] }}" readonly>
                                </div>
                                <div class="mb-3 form-group">
                                    <h5 class="">Account Name</h5>
                                    <input type="text" class="form-control readonly" value="{{ $bank['account_name'] }}" readonly>
                                </div>
                                <div class="mb-3 form-group">
                                    <h5 class="">Account Number</h5>
                                    <input type="text" class="form-control readonly" value="{{ $bank['account_number'] }}" readonly>
                                </div>
                                @if (!empty($bank['swift']))
                                    <div class="mb-3 form-group">
                                        <h5 class="">Swift Code</h5>
                                        <input type="text" class="form-control readonly" value="{{ $bank['swift'] }}" readonly>
                                    </div>
                                @endif
                            @elseif (in_array($withdrawal->payment_mode, ['Bitcoin', 'Ethereum', 'Litecoin', 'USDT', 'BUSD']) || ($method->methodtype ?? '') == 'crypto')
                                <div class="mb-3 form-group">
                                    <h5 class="">{{ $withdrawal->payment_mode }} Address</h5>
                                    <input type="text" class="form-control readonly" value="{{ $cryptoAddress }}" readonly>
                                </div>
                            @else
                                <div class="mb-3 form-group">
                                    <h5 class="">{{ $withdrawal->payment_mode }} Payment Details</h5>
                                    <textarea class="form-control" rows="3" readonly>{{ $details }}</textarea>
                                </div>
                            @endif

                            {{-- Always also show the raw inline entry for transparency --}}
                            @if ($details !== '')
                                <div class="mb-3 form-group">
                                    <h6 class="text-muted">Beneficiary details as submitted by client</h6>
                                    <textarea class="form-control" rows="2" readonly style="font-size: 12px;">{{ $details }}</textarea>
                                </div>
                            @endif
                        </div>

                        @if ($withdrawal->status != 'Processed')
                            <div class="mt-1">
                                <form action="{{ route('pwithdrawal') }}" method="POST">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <h6 class="">Action</h6>
                                            <select name="action" id="action" class="  mb-2 form-control">
                                                {{-- <option selected disabled>Select processing action</option> --}}
                                                <option value="Paid">Paid</option>
                                                <option value="Reject">Reject</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row d-none" id="emailcheck">
                                        <div class="col-md-12 form-group">
                                            <div class="selectgroup">
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="emailsend" id="dontsend" value="false"
                                                        class="selectgroup-input" checked="">
                                                    <span class="selectgroup-button">Don't Send Email</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="emailsend" id="sendemail" value="true"
                                                        class="selectgroup-input">
                                                    <span class="selectgroup-button">Send Email</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row d-none" id="emailtext">
                                        <div class="form-group col-md-12">
                                            <h6 class="">Subject</h6>
                                            <input type="text" name="subject" id="subject" class="  form-control">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <h6 class="">Enter Reasons for rejecting this withdrawal request</h6>
                                            <textarea class="  form-control" row="3" placeholder="Type in here" name="reason" id="message"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="hidden" name="id" value="{{ $withdrawal->id }}">
                                        <input type="submit" class="px-3 btn btn-primary" value="Proccess">
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <script>
            let action = document.getElementById('action');

            $('#action').change(function() {
                if (action.value === "Reject") {
                    document.getElementById('emailcheck').classList.remove('d-none');
                } else {
                    document.getElementById('emailcheck').classList.add('d-none');
                    document.getElementById('emailtext').classList.add('d-none');
                    document.getElementById('dontsend').checked = true;
                    document.getElementById('subject').removeAttribute('required');
                    document.getElementById('message').removeAttribute('required');
                }
            });

            $('#sendemail').click(function() {
                document.getElementById('emailtext').classList.remove('d-none');
                document.getElementById('subject').setAttribute('required', '');
                document.getElementById('message').setAttribute('required', '');
            });

            $('#dontsend').click(function() {
                document.getElementById('emailtext').classList.add('d-none');
                document.getElementById('subject').removeAttribute('required');
                document.getElementById('message').removeAttribute('required');
            });
        </script>
    @endsection
