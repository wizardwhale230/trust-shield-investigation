@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="d-flex align-items-center justify-content-between mt-2 mb-4">
                    <h1 class="title1">Support Tickets</h1>
                </div>
                <x-danger-alert />
                <x-success-alert />

                {{-- Status Filter Tabs --}}
                <div class="mb-3">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link {{ !$currentStatus ? 'active' : '' }}" href="{{ route('admin.support-tickets.index') }}">
                                All
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $currentStatus === 'open' ? 'active' : '' }}" href="{{ route('admin.support-tickets.index', ['status' => 'open']) }}">
                                Open
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $currentStatus === 'answered' ? 'active' : '' }}" href="{{ route('admin.support-tickets.index', ['status' => 'answered']) }}">
                                Answered
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $currentStatus === 'closed' ? 'active' : '' }}" href="{{ route('admin.support-tickets.index', ['status' => 'closed']) }}">
                                Closed
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Ticket #</th>
                                        <th>User</th>
                                        <th>Subject</th>
                                        <th>Priority</th>
                                        <th>Status</th>
                                        <th>Last Updated</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($tickets as $ticket)
                                        <tr>
                                            <td><code>{{ $ticket->ticket_number }}</code></td>
                                            <td>
                                                <strong>{{ $ticket->user->name ?? 'N/A' }}</strong><br>
                                                <small class="text-muted">{{ $ticket->user->email ?? '' }}</small>
                                            </td>
                                            <td>{{ Str::limit($ticket->subject, 40) }}</td>
                                            <td>
                                                @php
                                                    $priorityClass = [
                                                        'low' => 'badge-secondary',
                                                        'medium' => 'badge-info',
                                                        'high' => 'badge-warning',
                                                        'urgent' => 'badge-danger',
                                                    ][$ticket->priority] ?? 'badge-secondary';
                                                @endphp
                                                <span class="badge {{ $priorityClass }}">{{ ucfirst($ticket->priority) }}</span>
                                            </td>
                                            <td>
                                                @php
                                                    $statusClass = [
                                                        'open' => 'badge-warning',
                                                        'answered' => 'badge-success',
                                                        'closed' => 'badge-secondary',
                                                    ][$ticket->status] ?? 'badge-secondary';
                                                @endphp
                                                <span class="badge {{ $statusClass }}">{{ $ticket->status_label }}</span>
                                            </td>
                                            <td><small>{{ $ticket->updated_at->diffForHumans() }}</small></td>
                                            <td>
                                                <a href="{{ route('admin.support-tickets.show', $ticket->id) }}" class="btn btn-sm btn-primary">
                                                    View
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-4 text-muted">
                                                No support tickets found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    {{ $tickets->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
