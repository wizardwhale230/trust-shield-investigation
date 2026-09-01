@extends('layouts.auth')
@section('title', 'Reset your password')
@section('content')

    {{-- Alerts --}}
    @if (Session::has('status'))
        <div class="alert-success mb-6">{{ session('status') }}</div>
    @endif
    @if (Session::has('message'))
        <div class="alert-info mb-6">{{ Session::get('message') }}</div>
    @endif

    {{-- Heading --}}
    <div class="mb-8">
        <h1 class="auth-heading">Reset password</h1>
        <p class="auth-subtext mt-2">Enter your email and a new password.</p>
    </div>

    {{-- Form --}}
    <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <label for="email" class="form-label">Email address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-input" placeholder="you@example.com" required>
            @error('email')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div x-data="{ show: false }">
            <label for="password" class="form-label">New password</label>
            <div class="relative">
                <input id="password" :type="show ? 'text' : 'password'" name="password" class="form-input pr-10" placeholder="Create a new password" required>
                <button type="button" @click="show = !show" class="absolute right-3 top-1/2 -translate-y-1/2 text-content-tertiary hover:text-content-secondary transition-colors" tabindex="-1">
                    <i x-show="!show" data-lucide="eye" class="w-4 h-4"></i>
                    <i x-show="show" data-lucide="eye-off" class="w-4 h-4"></i>
                </button>
            </div>
            @error('password')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div x-data="{ show: false }">
            <label for="password_confirmation" class="form-label">Confirm password</label>
            <div class="relative">
                <input id="password_confirmation" :type="show ? 'text' : 'password'" name="password_confirmation" class="form-input pr-10" placeholder="Confirm your new password" required>
                <button type="button" @click="show = !show" class="absolute right-3 top-1/2 -translate-y-1/2 text-content-tertiary hover:text-content-secondary transition-colors" tabindex="-1">
                    <i x-show="!show" data-lucide="eye" class="w-4 h-4"></i>
                    <i x-show="show" data-lucide="eye-off" class="w-4 h-4"></i>
                </button>
            </div>
        </div>

        <button type="submit" class="btn-primary w-full justify-center">Reset password</button>
    </form>

@endsection
