@extends('layouts.dashboard')
@section('title', $title)
@section('page-title', 'Support Tickets')

@section('content')
    @if(session('success'))
        <div class="mb-4 p-3 rounded-md bg-success-light text-success text-sm">{{ session('success') }}</div>
    @endif

    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-lg font-heading font-semibold text-content">Support Tickets</h2>
            <p class="text-sm text-content-secondary mt-0.5">View and manage your support requests</p>
        </div>
        <a href="{{ route('user.support-tickets.create') }}" class="btn-primary">
            <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
            New Ticket
        </a>
    </div>

    <div class="dash-card">
        @if($tickets->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="table-th text-left">Ticket</th>
                            <th class="table-th text-left">Subject</th>
                            <th class="table-th text-left">Priority</th>
                            <th class="table-th text-left">Status</th>
                            <th class="table-th text-left">Last Updated</th>
                            <th class="table-th text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tickets as $ticket)
                            <tr class="border-t border-border-muted">
                                <td class="table-td font-mono text-xs">{{ $ticket->ticket_number }}</td>
                                <td class="table-td">
                                    <a href="{{ route('user.support-tickets.show', $ticket) }}" class="text-primary hover:text-primary-dark font-medium">
                                        {{ Str::limit($ticket->subject, 40) }}
                                    </a>
                                </td>
                                <td class="table-td">
                                    <span class="text-xs font-medium {{ $ticket->priority_color }}">
                                        {{ ucfirst($ticket->priority) }}
                                    </span>
                                </td>
                                <td class="table-td">
                                    <span class="status-badge status-badge-{{ $ticket->status_color }}">
                                        {{ $ticket->status_label }}
                                    </span>
                                </td>
                                <td class="table-td text-xs text-content-tertiary">{{ $ticket->updated_at->diffForHumans() }}</td>
                                <td class="table-td text-right">
                                    <a href="{{ route('user.support-tickets.show', $ticket) }}" class="btn-ghost text-xs">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $tickets->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <div class="w-14 h-14 rounded-full bg-surface-muted flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="ticket" class="w-7 h-7 text-content-tertiary"></i>
                </div>
                <h3 class="text-sm font-semibold text-content mb-1">No tickets yet</h3>
                <p class="text-sm text-content-secondary mb-4">Create a support ticket to get help from our team.</p>
                <a href="{{ route('user.support-tickets.create') }}" class="btn-primary">
                    <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                    Create Ticket
                </a>
            </div>
        @endif
    </div>
@endsection
