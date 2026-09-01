@extends('layouts.auth')
@section('title', 'Two factor authentication')
@section('content')

    {{-- Alerts --}}
    @if (Session::has('message'))
        <div class="alert-danger mb-6">{{ Session::get('message') }}</div>
    @endif

    {{-- Heading --}}
    <div class="mb-8 text-center">
        <div class="mx-auto mb-4 w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center">
            <i data-lucide="shield-check" class="w-6 h-6 text-primary"></i>
        </div>
        <h1 class="auth-heading">Two-factor authentication</h1>
        <p class="auth-subtext mt-2">A 2FA code has been sent to your email. Enter it below to continue.</p>
    </div>

    {{-- Form --}}
    <form method="POST" action="{{ route('twofalogin') }}" class="space-y-5">
        @csrf

        <div>
            <label for="twofa" class="form-label">Verification code</label>
            <input id="twofa" type="text" inputmode="numeric" name="twofa" class="form-input" placeholder="Enter the code from your email" required autofocus>
            @error('twofa')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn-primary w-full justify-center">Verify &amp; sign in</button>
    </form>

    {{-- Back to sign in --}}
    <p class="mt-8 text-center text-sm text-content-secondary">
        Back to
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="font-medium text-primary hover:text-primary-dark transition-colors">Sign in</a>
    </p>
    <form id="logout-form" action="{{ route('adminlogout') }}" method="POST" class="hidden">
        @csrf
    </form>

@endsection
