@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="d-flex align-items-center justify-content-between mt-2 mb-4">
                    <h1 class="title1">Recovery Cases</h1>
                    <span class="badge badge-warning badge-pill px-3 py-2">{{ $newCasesCount }} New</span>
                </div>
                <x-danger-alert />
                <x-success-alert />

                {{-- Filters --}}
                <div class="card shadow-sm mb-4">
                    <div class="card-body py-3">
                        <form method="GET" action="{{ route('admin.cases') }}" class="row g-2 align-items-end">
                            <div class="col-md-3">
                                <label class="form-label small text-muted">Status</label>
                                <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                                    <option value="">All Statuses</option>
                                    @foreach(['new','assigned','investigating','legal_action','funds_recovered','withdrawal_ready','closed'] as $s)
                                        <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>
                                            {{ ucwords(str_replace('_', ' ', $s)) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small text-muted">Assigned To</label>
                                <select name="assigned_to" class="form-control form-control-sm" onchange="this.form.submit()">
                                    <option value="">All Team Members</option>
                                    @foreach($teamMembers as $member)
                                        <option value="{{ $member->id }}" {{ request('assigned_to') == $member->id ? 'selected' : '' }}>
                                            {{ $member->full_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small text-muted">Fraud Type</label>
                                <select name="fraud_type" class="form-control form-control-sm" onchange="this.form.submit()">
                                    <option value="">All Types</option>
                                    @foreach(['cryptocurrency','forex','binary_options','romance','investment','other'] as $t)
                                        <option value="{{ $t }}" {{ request('fraud_type') == $t ? 'selected' : '' }}>
                                            {{ ucfirst(str_replace('_', ' ', $t)) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('admin.cases') }}" class="btn btn-sm btn-outline-secondary">Clear</a>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Cases Table --}}
                <div class="card shadow p-4">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Case #</th>
                                    <th>Client</th>
                                    <th>Fraud Type</th>
                                    <th>Amount Lost</th>
                                    <th>Status</th>
                                    <th>Assigned To</th>
                                    <th>Date Filed</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($cases as $case)
                                    <tr>
                                        <td><strong>{{ $case->case_number }}</strong></td>
                                        <td>
                                            {{ $case->user->name ?? 'N/A' }} {{ $case->user->l_name ?? '' }}
                                            <br><small class="text-muted">{{ $case->user->email ?? '' }}</small>
                                        </td>
                                        <td>{{ ucfirst(str_replace('_', ' ', $case->fraud_type)) }}</td>
                                        <td>{{ $settings->currency }}{{ number_format($case->amount_lost, 2) }}</td>
                                        <td>
                                            @switch($case->status)
                                                @case('new')
                                                    <span class="badge badge-info">New</span>
                                                    @break
                                                @case('assigned')
                                                    <span class="badge badge-primary">Assigned</span>
                                                    @break
                                                @case('investigating')
                                                    <span class="badge badge-warning">Investigating</span>
                                                    @break
                                                @case('legal_action')
                                                    <span class="badge badge-warning">Legal Action</span>
                                                    @break
                                                @case('funds_recovered')
                                                    <span class="badge badge-success">Funds Recovered</span>
                                                    @break
                                                @case('withdrawal_ready')
                                                    <span class="badge badge-success">Withdrawal Ready</span>
                                                    @break
                                                @case('closed')
                                                    <span class="badge badge-secondary">Closed</span>
                                                    @break
                                            @endswitch
                                        </td>
                                        <td>
                                            @if($case->assignedTo)
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ $case->assignedTo->photo_url }}" alt="{{ $case->assignedTo->full_name }}"
                                                         class="rounded-circle mr-2" style="width:28px;height:28px;object-fit:cover;">
                                                    <span>{{ $case->assignedTo->full_name }}</span>
                                                </div>
                                            @else
                                                <span class="text-muted">Unassigned</span>
                                            @endif
                                        </td>
                                        <td>{{ $case->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <a href="{{ route('admin.cases.show', $case->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-eye"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4 text-muted">No cases found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($cases->hasPages())
                        <div class="mt-3">
                            {{ $cases->withQueryString()->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
