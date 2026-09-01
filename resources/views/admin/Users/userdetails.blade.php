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
    <div class="main-panel">
        <div class="content ">
            <div class="page-inner">
                <x-danger-alert />
                <x-success-alert />
                <!-- Beginning of  Dashboard Stats  -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="p-3 card ">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <h1 class="d-inline text-primary">{{ $user->name }}</h1><span></span>
                                        <div class="d-inline">
                                            <div class="float-right btn-group">
                                                <a class="btn btn-primary btn-sm" href="{{ route('manageusers') }}"> <i
                                                        class="fa fa-arrow-left"></i> back</a> &nbsp;
                                                <button type="button" class="btn btn-secondary dropdown-toggle btn-sm"
                                                    data-toggle="dropdown" data-display="static" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-lg-right">
                                                    <a class="dropdown-item"
                                                        href="{{ route('loginactivity', $user->id) }}">Login Activity</a>
                                                    @if ($user->status == null || $user->status == 'blocked')
                                                        <a class="dropdown-item"
                                                            href="{{ url('admin/dashboard/uunblock') }}/{{ $user->id }}">Unblock</a>
                                                    @else
                                                        <a class="dropdown-item"
                                                            href="{{ url('admin/dashboard/uublock') }}/{{ $user->id }}">Block</a>
                                                    @endif
                                                    @if ($user->email_verified_at)
                                                    @else
                                                        <a href="{{ url('admin/dashboard/email-verify') }}/{{ $user->id }}"
                                                            class="dropdown-item">Verify Email</a>
                                                    @endif
                                                    <a href="#" data-toggle="modal" data-target="#topupModal"
                                                        class="dropdown-item">Adjust Available Balance</a>
                                                    @if ($cases->isNotEmpty())
                                                        <a href="#" data-toggle="modal" data-target="#assignCaseModal"
                                                            class="dropdown-item">Assign Case</a>
                                                    @endif
                                                    <a href="#" data-toggle="modal" data-target="#resetpswdModal"
                                                        class="dropdown-item">Reset Password</a>
                                                    <a href="#" data-toggle="modal" data-target="#clearacctModal"
                                                        class="dropdown-item">Clear Account</a>
                                                    <a href="#" data-toggle="modal" data-target="#edituser"
                                                        class="dropdown-item">Edit</a>
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#sendmailtooneuserModal" class="dropdown-item">Send
                                                        Email</a>
                                                    <a href="#" data-toggle="modal" data-target="#switchuserModal"
                                                        class="dropdown-item text-success">Login as {{ $user->name }}</a>
                                                    <a href="#" data-toggle="modal" data-target="#deleteModal"
                                                        class="dropdown-item text-danger">Delete {{ $user->name }}</a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-3 mt-4 border rounded row ">
                                    <div class="col-md-3">
                                        <h5 class="text-bold">Available Balance</h5>
                                        <p>{{ $settings->currency }}{{ number_format($user->account_bal, 2, '.', ',') }}
                                        </p>
                                        <small class="text-muted">Withdrawable recovered funds</small>
                                    </div>
                                    <div class="col-md-3">
                                        <h5 class="text-bold">Total Recovered</h5>
                                        <p>{{ $settings->currency }}{{ number_format($totalRecovered ?? 0, 2, '.', ',') }}
                                        </p>
                                        <small class="text-muted">Lifetime recovered across all cases</small>
                                    </div>
                                    <div class="col-md-3">
                                        <h5>User Account Status</h5>
                                        @if ($user->status == 'blocked')
                                            <span class="badge badge-danger">Blocked</span>
                                        @else
                                            <span class="badge badge-success">Active</span>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <h5>KYC</h5>
                                        @if ($user->account_verify == 'Verified')
                                            <span class="badge badge-success">Verified</span>
                                        @else
                                            <span class="badge badge-danger">Not Verified</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="mt-3 row ">
                                    <div class="col-md-12">
                                        <h5>USER INFORMATION</h5>
                                    </div>
                                </div>
                                <div class="p-3 border row ">
                                    <div class="col-md-4 border-right">
                                        <h5>Fullname</h5>
                                    </div>
                                    <div class="col-md-8">
                                        <h5>{{ $user->name }}</h5>
                                    </div>
                                </div>
                                <div class="p-3 border row ">
                                    <div class="col-md-4 border-right">
                                        <h5>Email Address</h5>
                                    </div>
                                    <div class="col-md-8">
                                        <h5>{{ $user->email }}</h5>
                                    </div>
                                </div>
                                <div class="p-3 border row ">
                                    <div class="col-md-4 border-right">
                                        <h5>Mobile Number</h5>
                                    </div>
                                    <div class="col-md-8">
                                        <h5>{{ $user->phone }}</h5>
                                    </div>
                                </div>
                                <div class="p-3 border row ">
                                    <div class="col-md-4 border-right">
                                        <h5>Date of birth</h5>
                                    </div>
                                    <div class="col-md-8">
                                        <h5>{{ $user->dob }}</h5>
                                    </div>
                                </div>
                                <div class="p-3 border row ">
                                    <div class="col-md-4 border-right">
                                        <h5>Nationality</h5>
                                    </div>
                                    <div class="col-md-8">
                                        <h5>{{ $user->country }}</h5>
                                    </div>
                                </div>
                                {{-- <div class="p-3 border row ">
                                    <div class="col-md-4 border-right">
                                        <h5>Wallet Address</h5>
                                    </div>
                                    <div class="col-md-8">
                                        <h5>
                                            @if ($user->wallet_address)
                                                {{ $user->wallet_address }}
                                            @else
                                                Not added yet!
                                            @endif
                                        </h5>
                                    </div>
                                </div> --}}
                                <div class="p-3 border row ">
                                    <div class="col-md-4 border-right">
                                        <h5>Registered</h5>
                                    </div>
                                    <div class="col-md-8">
                                        <h5>{{ \Carbon\Carbon::parse($user->created_at)->toDayDateTimeString() }}</h5>
                                    </div>
                                </div>

                                {{-- Recovery Cases for this user --}}
                                <div class="mt-4 row">
                                    <div class="col-md-12 d-flex align-items-center justify-content-between">
                                        <h5 class="mb-0">RECOVERY CASES <span class="badge badge-secondary">{{ $cases->count() }}</span></h5>
                                        <div>
                                            <a href="{{ route('admin.cases') }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fa fa-folder-open"></i> View All Cases
                                            </a>
                                            @if ($cases->isNotEmpty())
                                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#assignCaseModal">
                                                    <i class="fa fa-user-plus"></i> Assign Case
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="p-0 border rounded mt-2">
                                    @if ($cases->isEmpty())
                                        <div class="p-3 text-center text-muted">
                                            <p class="mb-0">This user has not filed any recovery cases yet.</p>
                                        </div>
                                    @else
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Case #</th>
                                                        <th>Status</th>
                                                        <th>Type</th>
                                                        <th class="text-right">Amount Lost</th>
                                                        <th class="text-right">Recovered</th>
                                                        <th>Assigned To</th>
                                                        <th>Filed</th>
                                                        <th class="text-right">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($cases as $case)
                                                        <tr>
                                                            <td><strong>{{ $case->case_number }}</strong></td>
                                                            <td><span class="badge badge-{{ $case->status_color ?? 'secondary' }}">{{ $case->status_label ?? $case->status }}</span></td>
                                                            <td>{{ $case->fraud_type }}</td>
                                                            <td class="text-right">{{ $settings->currency }}{{ number_format((float) $case->amount_lost, 2, '.', ',') }}</td>
                                                            <td class="text-right">{{ $settings->currency }}{{ number_format((float) $case->amount_recovered, 2, '.', ',') }}</td>
                                                            <td>
                                                                @if ($case->assignedTo)
                                                                    {{ $case->assignedTo->name ?? trim(($case->assignedTo->firstName ?? '') . ' ' . ($case->assignedTo->lastName ?? '')) }}
                                                                @else
                                                                    <span class="text-muted">Unassigned</span>
                                                                @endif
                                                            </td>
                                                            <td>{{ $case->created_at ? \Carbon\Carbon::parse($case->created_at)->toFormattedDateString() : '-' }}</td>
                                                            <td class="text-right">
                                                                <a href="{{ route('admin.cases.show', $case->id) }}" class="btn btn-sm btn-primary">
                                                                    <i class="fa fa-eye"></i> View
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.Users.users_actions')
    @endsection
