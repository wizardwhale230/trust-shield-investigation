<?php
if (Auth('admin')->User()->dashboard_style == 'light') {
    $bg = 'light';
    $text = 'dark';
    $gradient = 'primary';
} else {
    $bg = 'dark';
    $text = 'light';
    $gradient = 'dark';
}

?>
@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel">
        <div class="content ">
            <div class="panel-header bg-{{ $gradient }}-gradient">
                <div class="py-5 page-inner">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="pb-2 text-white fw-bold">Dashboard</h2>
                            <h5 class="mb-2 text-white op-7">Welcome, {{ Auth('admin')->User()->firstName }}
                                {{ Auth('admin')->User()->lastName }}!</h5>
                        </div>
                        @if (Auth('admin')->User()->type == 'Super Admin' || Auth('admin')->User()->type == 'Admin')
                            <div class="py-2 ml-md-auto py-md-0">
                                <a href="{{ route('admin.cases') }}" class="mr-2 btn btn-primary btn-border ">Recovery Cases</a>
                                <a href="{{ route('manageusers') }}" class="btn btn-secondary ">Users</a>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
            <x-danger-alert />
            <x-success-alert />
            <div class="page-inner mt--5">
                <!-- Recovery KPIs Row 1: Case status -->
                <div class="row row-card-no-pd shadow-lg mt--2">
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round full-height">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="text-center icon-big">
                                            <i class="fa fa-folder-open text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Total Cases</p>
                                            <h4 class="card-title">{{ number_format($total_cases) }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round full-height">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="text-center icon-big">
                                            <i class="fa fa-bell text-info"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">New Cases</p>
                                            <h4 class="card-title">{{ number_format($cases_by_status['new']) }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round full-height">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="text-center icon-big">
                                            <i class="fa fa-search text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Investigating</p>
                                            <h4 class="card-title">{{ number_format($cases_by_status['investigating']) }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round full-height">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="text-center icon-big">
                                            <i class="fa fa-gavel text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Legal Action</p>
                                            <h4 class="card-title">{{ number_format($cases_by_status['legal_action']) }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recovery KPIs Row 2: Money / recovery progress -->
                <div class="row row-card-no-pd shadow-lg">
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round full-height">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="text-center icon-big">
                                            <i class="fa fa-exclamation-triangle text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Total Funds Lost</p>
                                            <h4 class="card-title">{{ $settings->currency }}{{ number_format($total_amount_lost, 2) }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round full-height">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="text-center icon-big">
                                            <i class="fa fa-shield text-success"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Funds Recovered</p>
                                            <h4 class="card-title">{{ $settings->currency }}{{ number_format($total_amount_recovered, 2) }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round full-height">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="text-center icon-big">
                                            <i class="fa fa-percent text-success"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Recovery Rate</p>
                                            <h4 class="card-title">{{ $recovery_rate }}%</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round full-height">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="text-center icon-big">
                                            <i class="fa fa-money text-success"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Withdrawal Ready</p>
                                            <h4 class="card-title">{{ number_format($cases_by_status['withdrawal_ready']) }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recovery KPIs Row 3: Fees + workload -->
                <div class="row row-card-no-pd shadow-lg">
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round full-height">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="text-center icon-big">
                                            <i class="fa fa-file-text-o text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Pending Fee Requests</p>
                                            <h4 class="card-title">{{ number_format($pending_fees_count) }}</h4>
                                            <p class="card-category">{{ $settings->currency }}{{ number_format($pending_fees_amount, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round full-height">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="text-center icon-big">
                                            <i class="fa fa-check-circle text-success"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Paid Fee Requests</p>
                                            <h4 class="card-title">{{ number_format($paid_fees_count) }}</h4>
                                            <p class="card-category">{{ $settings->currency }}{{ number_format($paid_fees_amount, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round full-height">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="text-center icon-big">
                                            <i class="fa fa-user-times text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Unassigned Cases</p>
                                            <h4 class="card-title">{{ number_format($unassigned_cases) }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round full-height">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="text-center icon-big">
                                            <i class="fa fa-archive text-secondary"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Closed Cases</p>
                                            <h4 class="card-title">{{ number_format($cases_by_status['closed']) }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recovery KPIs Row 4: Users -->
                <div class="row row-card-no-pd shadow-lg">
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="text-center icon-big">
                                            <i class="flaticon-users text-success"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Total Users</p>
                                            <h4 class="card-title">{{ number_format($user_count) }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="text-center icon-big">
                                            <i class="flaticon-user-2 text-success"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Active Users</p>
                                            <h4 class="card-title">{{ number_format($activeusers) }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="text-center icon-big">
                                            <i class="flaticon-remove-user text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Blocked Users</p>
                                            <h4 class="card-title">{{ number_format($blockeusers) }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="text-center icon-big">
                                            <i class="fa fa-id-card-o text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Unverified KYC</p>
                                            <h4 class="card-title">{{ number_format($unverifiedusers) }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cases by Status Chart -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Cases by Status</h4>
                            </div>
                            <div class="card-body">
                                <div class="overflow-auto">
                                    <canvas id="myChart" height="100"></canvas>
                                </div>
                            </div>
                        </div>

                        <script>
                            var ctx = document.getElementById('myChart').getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: ['New', 'Assigned', 'Investigating', 'Legal Action', 'Funds Recovered', 'Withdrawal Ready', 'Closed'],
                                    datasets: [{
                                        label: '# Recovery Cases by Status',
                                        data: [
                                            {{ $cases_by_status['new'] }},
                                            {{ $cases_by_status['assigned'] }},
                                            {{ $cases_by_status['investigating'] }},
                                            {{ $cases_by_status['legal_action'] }},
                                            {{ $cases_by_status['funds_recovered'] }},
                                            {{ $cases_by_status['withdrawal_ready'] }},
                                            {{ $cases_by_status['closed'] }}
                                        ],
                                        backgroundColor: [
                                            'rgba(54, 162, 235, 0.2)',
                                            'rgba(75, 120, 200, 0.2)',
                                            'rgba(255, 206, 86, 0.2)',
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(75, 192, 192, 0.2)',
                                            'rgba(40, 167, 69, 0.2)',
                                            'rgba(108, 117, 125, 0.2)'
                                        ],
                                        borderColor: [
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(75, 120, 200, 1)',
                                            'rgba(255, 206, 86, 1)',
                                            'rgba(255, 99, 132, 1)',
                                            'rgba(75, 192, 192, 1)',
                                            'rgba(40, 167, 69, 1)',
                                            'rgba(108, 117, 125, 1)'
                                        ],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            ticks: { precision: 0 }
                                        }
                                    }
                                }
                            });
                        </script>
                    </div>
                </div>

                <!-- Recent Cases -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h4 class="card-title mb-0">Recent Cases</h4>
                                <a href="{{ route('admin.cases') }}" class="btn btn-sm btn-primary">View All</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Case #</th>
                                                <th>Client</th>
                                                <th>Fraud Type</th>
                                                <th>Amount Lost</th>
                                                <th>Status</th>
                                                <th>Filed</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($recent_cases as $case)
                                                <tr>
                                                    <td><strong>{{ $case->case_number }}</strong></td>
                                                    <td>
                                                        @if ($case->user)
                                                            {{ $case->user->firstName ?? '' }} {{ $case->user->lastName ?? '' }}
                                                        @else
                                                            <span class="text-muted">—</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ ucwords(str_replace('_', ' ', $case->fraud_type ?? '')) }}</td>
                                                    <td>{{ $settings->currency }}{{ number_format((float) $case->amount_lost, 2) }}</td>
                                                    <td>
                                                        <span class="badge badge-{{ $case->status_color }}">
                                                            {{ $case->status_label }}
                                                        </span>
                                                    </td>
                                                    <td>{{ optional($case->created_at)->format('M d, Y') }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.cases.show', $case->id) }}"
                                                            class="btn btn-sm btn-primary btn-border">View</a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center text-muted py-4">
                                                        No recovery cases yet.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
