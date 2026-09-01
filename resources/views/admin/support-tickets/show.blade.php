@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="d-flex align-items-center justify-content-between mt-2 mb-4">
                    <div>
                        <a href="{{ route('admin.support-tickets.index') }}" class="text-muted small">
                            &larr; Back to Tickets
                        </a>
                        <h1 class="title1 mt-1">{{ $ticket->ticket_number }}</h1>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        @php
                            $statusClass = [
                                'open' => 'badge-warning',
                                'answered' => 'badge-success',
                                'closed' => 'badge-secondary',
                            ][$ticket->status] ?? 'badge-secondary';
                        @endphp
                        <span class="badge {{ $statusClass }} px-3 py-2">{{ $ticket->status_label }}</span>
                    </div>
                </div>
                <x-danger-alert />
                <x-success-alert />

                <div class="row">
                    <div class="col-md-8">
                        {{-- Ticket Details --}}
                        <div class="card shadow-sm mb-4">
                            <div class="card-header">
                                <h4 class="card-title mb-0">{{ $ticket->subject }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-3 p-3 bg-light rounded">
                                    <p class="mb-1"><strong>Original Message:</strong></p>
                                    <p class="mb-0" style="white-space: pre-wrap;">{{ $ticket->message }}</p>
                                </div>
                                <small class="text-muted">
                                    Submitted by <strong>{{ $ticket->user->name ?? 'N/A' }}</strong>
                                    ({{ $ticket->user->email ?? '' }})
                                    on {{ $ticket->created_at->format('M d, Y \a\t h:i A') }}
                                </small>
                            </div>
                        </div>

                        {{-- Conversation Thread --}}
                        <div class="card shadow-sm mb-4">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Conversation</h4>
                            </div>
                            <div class="card-body">
                                @forelse($replies as $reply)
                                    <div class="mb-3 p-3 rounded {{ $reply->is_admin ? 'bg-primary text-white' : 'bg-light' }}">
                                        <div class="d-flex justify-content-between mb-2">
                                            <strong>
                                                @if($reply->is_admin)
                                                    Admin
                                                @else
                                                    {{ $reply->user->name ?? 'User' }}
                                                @endif
                                            </strong>
                                            <small class="{{ $reply->is_admin ? 'text-white-50' : 'text-muted' }}">
                                                {{ $reply->created_at->diffForHumans() }}
                                            </small>
                                        </div>
                                        <p class="mb-0" style="white-space: pre-wrap;">{{ $reply->message }}</p>
                                    </div>
                                @empty
                                    <p class="text-muted text-center py-3">No replies yet.</p>
                                @endforelse
                            </div>
                        </div>

                        {{-- Admin Reply Form --}}
                        @if($ticket->status !== 'closed')
                            <div class="card shadow-sm">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Reply</h4>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('admin.support-tickets.reply', $ticket->id) }}">
                                        @csrf
                                        <div class="form-group">
                                            <textarea name="message" rows="5" class="form-control" placeholder="Type your reply to the user..." required>{{ old('message') }}</textarea>
                                            @error('message')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-paper-plane mr-1"></i> Send Reply
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-4">
                        {{-- Ticket Info Sidebar --}}
                        <div class="card shadow-sm mb-4">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Ticket Info</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-borderless mb-0">
                                    <tr>
                                        <td class="text-muted">Ticket #</td>
                                        <td><code>{{ $ticket->ticket_number }}</code></td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">User</td>
                                        <td>{{ $ticket->user->name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Email</td>
                                        <td>{{ $ticket->user->email ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Priority</td>
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
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Status</td>
                                        <td><span class="badge {{ $statusClass }}">{{ $ticket->status_label }}</span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Opened</td>
                                        <td>{{ $ticket->created_at->format('M d, Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Last Reply</td>
                                        <td>{{ $ticket->last_replied_at ? $ticket->last_replied_at->diffForHumans() : 'N/A' }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        {{-- Status Management --}}
                        <div class="card shadow-sm">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Update Status</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.support-tickets.status', $ticket->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <select name="status" class="form-control">
                                            <option value="open" {{ $ticket->status === 'open' ? 'selected' : '' }}>Open</option>
                                            <option value="answered" {{ $ticket->status === 'answered' ? 'selected' : '' }}>Answered</option>
                                            <option value="closed" {{ $ticket->status === 'closed' ? 'selected' : '' }}>Closed</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-warning btn-block">
                                        Update Status
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
