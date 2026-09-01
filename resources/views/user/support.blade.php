
@extends('layouts.dashboard')
@section('title', $title)
@section('page-title', 'Support')

@section('content')
    {{-- Alerts --}}
    @if(session('success'))
        <div class="mb-4 p-3 rounded-md bg-success-light text-success text-sm">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-3 rounded-md bg-danger-light text-danger text-sm">{{ session('error') }}</div>
    @endif

    <div class="max-w-2xl mx-auto">
        {{-- Contact Info Card --}}
        <div class="dash-card text-center mb-6">
            <div class="w-14 h-14 rounded-full bg-primary-light flex items-center justify-center mx-auto mb-4">
                <i data-lucide="headphones" class="w-7 h-7 text-primary"></i>
            </div>
            <h2 class="text-xl font-heading font-semibold text-content mb-1">{{ $settings->site_name }} Support</h2>
            <p class="text-sm text-content-secondary mb-3">For inquiries, suggestions or complaints, mail us</p>
            <a href="mailto:{{ $settings->contact_email }}" class="text-primary hover:text-primary-dark font-medium text-sm">
                <i data-lucide="mail" class="w-4 h-4 inline-block mr-1"></i>
                {{ $settings->contact_email }}
            </a>
        </div>

        {{-- Message Form Card --}}
        <div class="dash-card">
            <h3 class="text-sm font-semibold text-content mb-4">Send us a message</h3>
            <form method="post" action="{{ route('enquiry') }}">
                @csrf
                <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                <input type="hidden" name="email" value="{{ Auth::user()->email }}">

                <div class="mb-4">
                    <label class="form-label">Message <span class="text-danger">*</span></label>
                    <textarea name="message" rows="5" class="input-field" placeholder="Describe your issue or question..." required></textarea>
                </div>

                <button type="submit" class="btn-primary w-full">
                    <i data-lucide="send" class="w-4 h-4 mr-2"></i>
                    Send Message
                </button>
            </form>
        </div>
    </div>
@endsection
