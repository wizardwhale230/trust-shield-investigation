@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="d-flex align-items-center justify-content-between mt-2 mb-4">
                    <div>
                        <a href="{{ route('admin.cases') }}" class="text-muted small">&larr; All Cases</a>
                        <h1 class="title1 mb-0">{{ $case->case_number }}</h1>
                    </div>
                    <div>
                        @switch($case->status)
                            @case('new') <span class="badge badge-info badge-pill px-3 py-2">New</span> @break
                            @case('assigned') <span class="badge badge-primary badge-pill px-3 py-2">Assigned</span> @break
                            @case('investigating') <span class="badge badge-warning badge-pill px-3 py-2">Investigating</span> @break
                            @case('legal_action') <span class="badge badge-warning badge-pill px-3 py-2">Legal Action</span> @break
                            @case('funds_recovered') <span class="badge badge-success badge-pill px-3 py-2">Funds Recovered</span> @break
                            @case('withdrawal_ready') <span class="badge badge-success badge-pill px-3 py-2">Withdrawal Ready</span> @break
                            @case('closed') <span class="badge badge-secondary badge-pill px-3 py-2">Closed</span> @break
                        @endswitch
                    </div>
                </div>
                <x-danger-alert />
                <x-success-alert />

                <div class="row">
                    {{-- Left: Case details --}}
                    <div class="col-lg-8">
                        {{-- Case Overview --}}
                        <div class="card shadow-sm mb-4">
                            <div class="card-header"><h4 class="card-title mb-0">Case Overview</h4></div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <p class="text-muted small mb-1">Client</p>
                                        <p class="fw-bold">
                                            {{ $case->user->name ?? '' }} {{ $case->user->l_name ?? '' }}
                                            <br><small class="text-muted">{{ $case->user->email ?? '' }} &middot; {{ $case->user->phone ?? '' }}</small>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="text-muted small mb-1">Assigned To</p>
                                        @if($case->assignedTo)
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $case->assignedTo->photo_url }}" alt="{{ $case->assignedTo->full_name }}"
                                                     class="rounded-circle mr-2" style="width:32px;height:32px;object-fit:cover;">
                                                <div>
                                                    <p class="fw-bold mb-0">{{ $case->assignedTo->full_name }}</p>
                                                    <small class="text-muted">{{ $case->assignedTo->job_title }}</small>
                                                </div>
                                            </div>
                                        @else
                                            <p class="fw-bold text-muted">Unassigned</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <p class="text-muted small mb-1">Fraud Type</p>
                                        <p>{{ ucfirst(str_replace('_', ' ', $case->fraud_type)) }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="text-muted small mb-1">Timeframe</p>
                                        <p>{{ ucfirst(str_replace('_', ' ', $case->timeframe)) }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="text-muted small mb-1">Amount Lost</p>
                                        <p class="fw-bold text-danger">{{ $settings->currency }}{{ number_format($case->amount_lost, 2) }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="text-muted small mb-1">Amount Recovered</p>
                                        <p class="fw-bold text-success">{{ $settings->currency }}{{ number_format($case->amount_recovered, 2) }}</p>
                                    </div>
                                </div>
                                @if($case->description)
                                    <div class="border-top pt-3">
                                        <p class="text-muted small mb-1">Description</p>
                                        <p>{{ $case->description }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Add Note --}}
                        <div class="card shadow-sm mb-4">
                            <div class="card-header"><h4 class="card-title mb-0">Add Note</h4></div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.cases.addnote', $case->id) }}">
                                    @csrf
                                    <div class="form-group">
                                        <textarea name="note" class="form-control" rows="3" placeholder="Write an update for this case..." required></textarea>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input type="checkbox" name="is_internal" value="1" class="form-check-input" id="internalNote">
                                        <label class="form-check-label" for="internalNote">Internal note (not visible to client)</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">Add Note</button>
                                </form>
                            </div>
                        </div>

                        {{-- Notes Timeline --}}
                        <div class="card shadow-sm mb-4">
                            <div class="card-header"><h4 class="card-title mb-0">Case Notes & Activity</h4></div>
                            <div class="card-body">
                                @forelse($notes as $note)
                                    <div class="d-flex mb-3 pb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                                        <div class="mr-3">
                                            <span class="badge badge-pill {{ $note->author_type === 'App\\Models\\Admin' ? 'badge-primary' : 'badge-secondary' }} p-2">
                                                <i class="fa {{ $note->author_type === 'App\\Models\\Admin' ? 'fa-user-shield' : 'fa-user' }}"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <strong class="small">
                                                    {{ $note->author->name ?? $note->author->firstName ?? 'System' }}
                                                    @if($note->is_internal) <span class="badge badge-light text-muted">Internal</span> @endif
                                                </strong>
                                                <small class="text-muted">{{ $note->created_at->diffForHumans() }}</small>
                                            </div>
                                            <p class="mb-0 small">{{ $note->note }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-center text-muted py-3">No notes yet.</p>
                                @endforelse
                            </div>
                        </div>

                        {{-- Documents --}}
                        <div class="card shadow-sm mb-4">
                            <div class="card-header"><h4 class="card-title mb-0">Documents ({{ $case->documents->count() }})</h4></div>
                            <div class="card-body">
                                @forelse($case->documents as $doc)
                                    <div class="d-flex align-items-center mb-2 p-2 border rounded">
                                        <i class="fa fa-file mr-3 text-muted"></i>
                                        <div class="flex-grow-1">
                                            <p class="mb-0 small fw-bold">{{ $doc->original_name }}</p>
                                            <small class="text-muted">
                                                {{ $doc->description ?? '' }}
                                                @if($doc->description) &middot; @endif
                                                {{ number_format($doc->file_size / 1024, 0) }} KB &middot;
                                                Uploaded by {{ $doc->uploaded_by }} &middot;
                                                {{ $doc->created_at->format('M d, Y') }}
                                            </small>
                                        </div>
                                        <a href="{{ route('admin.cases.document.download', [$case->id, $doc]) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                @empty
                                    <p class="text-center text-muted py-3">No documents uploaded.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    {{-- Right: Actions --}}
                    <div class="col-lg-4">
                        {{-- Assign --}}
                        <div class="card shadow-sm mb-4">
                            <div class="card-header"><h4 class="card-title mb-0">Assign Case</h4></div>
                            <div class="card-body">
                                @if($case->assignedTo)
                                    <div class="d-flex align-items-center mb-3 p-2 bg-light rounded">
                                        <img src="{{ $case->assignedTo->photo_url }}" alt="{{ $case->assignedTo->full_name }}"
                                             class="rounded-circle mr-2" style="width:40px;height:40px;object-fit:cover;">
                                        <div>
                                            <p class="fw-bold mb-0 small">{{ $case->assignedTo->full_name }}</p>
                                            <small class="text-muted">{{ $case->assignedTo->job_title }}</small>
                                        </div>
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('admin.cases.assign', $case->id) }}">
                                    @csrf
                                    <div class="form-group">
                                        <select name="team_member_id" class="form-control form-control-sm">
                                            <option value="">Select team member</option>
                                            @foreach($teamMembers as $member)
                                                <option value="{{ $member->id }}" {{ $case->team_member_id == $member->id ? 'selected' : '' }}>
                                                    {{ $member->full_name }} — {{ $member->job_title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm btn-block">Assign</button>
                                </form>
                            </div>
                        </div>

                        {{-- Update Status --}}
                        <div class="card shadow-sm mb-4">
                            <div class="card-header"><h4 class="card-title mb-0">Update Status</h4></div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.cases.status', $case->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <select name="status" class="form-control form-control-sm">
                                            @foreach(['new','assigned','investigating','legal_action','funds_recovered','withdrawal_ready','closed'] as $s)
                                                <option value="{{ $s }}" {{ $case->status == $s ? 'selected' : '' }}>
                                                    {{ ucwords(str_replace('_', ' ', $s)) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-info btn-sm btn-block">Update Status</button>
                                </form>
                            </div>
                        </div>

                        {{-- Credit Recovery --}}
                        <div class="card shadow-sm mb-4">
                            <div class="card-header"><h4 class="card-title mb-0">Credit Recovery</h4></div>
                            <div class="card-body">
                                <p class="small text-muted">Credit recovered funds to the client's account balance.</p>
                                <form method="POST" action="{{ route('admin.cases.recovery', $case->id) }}">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">{{ $settings->currency }}</span>
                                        </div>
                                        <input type="number" name="amount" class="form-control" placeholder="0.00" step="0.01" min="0.01" required>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-sm btn-block" onclick="return confirm('Credit this amount to client account?')">Credit to Client</button>
                                </form>
                            </div>
                        </div>

                        {{-- Fee Requests --}}
                        <div class="card shadow-sm mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title mb-0">Fee Requests</h4>
                                <a href="{{ route('admin.cases.fee.create', $case->id) }}" class="btn btn-sm btn-outline-primary">+ Add</a>
                            </div>
                            <div class="card-body">
                                @forelse($case->feeRequests as $fee)
                                    <div class="d-flex justify-content-between align-items-center mb-2 pb-2 {{ !$loop->last ? 'border-bottom' : '' }}">
                                        <div>
                                            <p class="mb-0 small fw-bold">{{ $fee->title }}</p>
                                            <small class="text-muted">{{ $settings->currency }}{{ number_format($fee->amount, 2) }}</small>
                                        </div>
                                        <div>
                                            @if($fee->status === 'pending')
                                                <span class="badge badge-warning">Pending</span>
                                                <form method="POST" action="{{ route('admin.fee.cancel', $fee->id) }}" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger ml-1" onclick="return confirm('Cancel this fee request?')">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </form>
                                            @elseif($fee->status === 'paid')
                                                <span class="badge badge-success">Paid</span>
                                            @else
                                                <span class="badge badge-secondary">Cancelled</span>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-center text-muted small">No fee requests.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
