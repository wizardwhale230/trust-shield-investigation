@extends('layouts.auth')
@section('title', 'Admin forgot password')
@section('content')

    {{-- Alerts --}}
    <x-danger-alert />
    <x-success-alert />
    @if (session('status'))
        <div class="alert-success mb-6">{{ session('status') }}</div>
    @endif

    {{-- Heading --}}
    <div class="mb-8">
        <h1 class="auth-heading">Forgot password?</h1>
        <p class="auth-subtext mt-2">Enter your email and we'll send instructions to reset your password.</p>
    </div>

    {{-- Form --}}
    <form method="POST" action="{{ route('sendpasswordrequest') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="form-label">Email address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-input" placeholder="you@example.com" required autofocus>
            @error('email')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn-primary w-full justify-center">Send reset link</button>
    </form>

    {{-- Back to login --}}
    <p class="mt-8 text-center text-sm text-content-secondary">
        Back to <a href="{{ route('adminloginform') }}" class="font-medium text-primary hover:text-primary-dark transition-colors">Sign in</a>
    </p>

@endsection
