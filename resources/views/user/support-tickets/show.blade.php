@extends('layouts.dashboard')
@section('title', $title)
@section('page-title', $ticket->ticket_number)

@section('content')
    @if(session('success'))
        <div class="mb-4 p-3 rounded-md bg-success-light text-success text-sm">{{ session('success') }}</div>
    @endif

    <div class="max-w-3xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('user.support-tickets.index') }}" class="text-sm text-primary hover:text-primary-dark font-medium inline-flex items-center gap-1">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Back to Tickets
            </a>
        </div>

        {{-- Ticket Info Header --}}
        <div class="dash-card mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-3">
                <div>
                    <h2 class="text-lg font-heading font-semibold text-content">{{ $ticket->subject }}</h2>
                    <p class="text-xs text-content-tertiary mt-1 font-mono">{{ $ticket->ticket_number }}</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-xs font-medium {{ $ticket->priority_color }}">{{ ucfirst($ticket->priority) }}</span>
                    <span class="status-badge status-badge-{{ $ticket->status_color }}">{{ $ticket->status_label }}</span>
                </div>
            </div>
            <p class="text-xs text-content-tertiary">Opened {{ $ticket->created_at->format('M d, Y \a\t h:i A') }}</p>
        </div>

        {{-- Conversation Thread --}}
        <div class="space-y-4 mb-6">
            {{-- Original message --}}
            <div class="flex justify-end">
                <div class="max-w-[80%]">
                    <div class="bg-primary text-content-inverse rounded-lg rounded-br-sm px-4 py-3">
                        <p class="text-sm whitespace-pre-wrap">{{ $ticket->message }}</p>
                    </div>
                    <p class="text-xs text-content-tertiary mt-1 text-right">You &middot; {{ $ticket->created_at->diffForHumans() }}</p>
                </div>
            </div>

            {{-- Replies --}}
            @foreach($replies as $reply)
                @if($reply->is_admin)
                    <div class="flex justify-start">
                        <div class="max-w-[80%]">
                            <div class="bg-surface-subtle rounded-lg rounded-bl-sm px-4 py-3">
                                <p class="text-sm text-content whitespace-pre-wrap">{{ $reply->message }}</p>
                            </div>
                            <p class="text-xs text-content-tertiary mt-1">Support Team &middot; {{ $reply->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @else
                    <div class="flex justify-end">
                        <div class="max-w-[80%]">
                            <div class="bg-primary text-content-inverse rounded-lg rounded-br-sm px-4 py-3">
                                <p class="text-sm whitespace-pre-wrap">{{ $reply->message }}</p>
                            </div>
                            <p class="text-xs text-content-tertiary mt-1 text-right">You &middot; {{ $reply->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        {{-- Reply Form --}}
        @if($ticket->status !== 'closed')
            <div class="dash-card">
                <h3 class="text-sm font-semibold text-content mb-3">Reply</h3>
                <form method="POST" action="{{ route('user.support-tickets.reply', $ticket) }}">
                    @csrf
                    <div class="mb-4">
                        <textarea name="message" rows="4" class="input-field" placeholder="Type your reply..." required>{{ old('message') }}</textarea>
                        @error('message')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn-primary">
                        <i data-lucide="send" class="w-4 h-4 mr-2"></i>
                        Send Reply
                    </button>
                </form>
            </div>
        @else
            <div class="dash-card text-center py-6">
                <p class="text-sm text-content-tertiary">This ticket has been closed. Submit a new ticket if you need further help.</p>
            </div>
        @endif
    </div>
@endsection
