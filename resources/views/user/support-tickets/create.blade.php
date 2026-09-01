@extends('layouts.dashboard')
@section('title', $title)
@section('page-title', 'New Support Ticket')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('user.support-tickets.index') }}" class="text-sm text-primary hover:text-primary-dark font-medium inline-flex items-center gap-1">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Back to Tickets
            </a>
        </div>

        <div class="dash-card">
            <h2 class="text-lg font-heading font-semibold text-content mb-1">Submit a Support Ticket</h2>
            <p class="text-sm text-content-secondary mb-6">Describe your issue and our team will respond as soon as possible.</p>

            <form method="POST" action="{{ route('user.support-tickets.store') }}">
                @csrf

                <div class="mb-4">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" id="subject" name="subject" value="{{ old('subject') }}" class="input-field" placeholder="Brief description of your issue" required>
                    @error('subject')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="priority" class="form-label">Priority</label>
                    <select id="priority" name="priority" class="input-field" required>
                        <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ old('priority', 'medium') == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                        <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                    </select>
                    @error('priority')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="message" class="form-label">Message</label>
                    <textarea id="message" name="message" rows="6" class="input-field" placeholder="Describe your issue in detail..." required>{{ old('message') }}</textarea>
                    @error('message')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn-primary w-full">
                    <i data-lucide="send" class="w-4 h-4 mr-2"></i>
                    Submit Ticket
                </button>
            </form>
        </div>
    </div>
@endsection
