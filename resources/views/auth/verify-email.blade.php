@extends('layouts.auth')
@section('title', 'Verify email address')
@section('content')

    {{-- Alerts --}}
    @if (session('status'))
        <div class="alert-success mb-6">A verification link has been sent to your email address. Please click the link to verify.</div>
    @endif
    @if (session('message'))
        <div class="alert-success mb-6">{{ session('message') }}</div>
    @endif

    {{-- Heading --}}
    <div class="mb-8 text-center">
        <div class="mx-auto mb-4 w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center">
            <i data-lucide="mail" class="w-6 h-6 text-primary"></i>
        </div>
        <h1 class="auth-heading">Verify your email</h1>
        <p class="auth-subtext mt-2">We've sent a verification link to your email address.<br>Please follow the link to continue.</p>
    </div>

    {{-- Resend --}}
    <form method="POST" action="{{ route('verification.send') }}" class="text-center">
        @csrf
        <p class="text-sm text-content-secondary mb-4">
            Didn't receive an email?
            <button type="submit" class="font-medium text-primary hover:text-primary-dark transition-colors">Resend verification email</button>
        </p>
    </form>

    {{-- Logout --}}
    <form method="POST" action="{{ route('logout') }}" class="text-center">
        @csrf
        <button type="submit" class="btn-secondary w-full justify-center">{{ __('Log Out') }}</button>
    </form>

@endsection
