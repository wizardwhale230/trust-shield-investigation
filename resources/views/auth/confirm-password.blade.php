@extends('layouts.auth')
@section('title', 'Confirm your password')
@section('content')

    {{-- Heading --}}
    <div class="mb-8">
        <h1 class="auth-heading">Confirm password</h1>
        <p class="auth-subtext mt-2">This is a secure area. Please confirm your password before continuing.</p>
    </div>

    {{-- Form --}}
    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
        @csrf

        <div x-data="{ show: false }">
            <label for="password" class="form-label">Password</label>
            <div class="relative">
                <input id="password" :type="show ? 'text' : 'password'" name="password" class="form-input pr-10" placeholder="Enter your password" required autocomplete="current-password" autofocus>
                <button type="button" @click="show = !show" class="absolute right-3 top-1/2 -translate-y-1/2 text-content-tertiary hover:text-content-secondary transition-colors" tabindex="-1">
                    <i x-show="!show" data-lucide="eye" class="w-4 h-4"></i>
                    <i x-show="show" data-lucide="eye-off" class="w-4 h-4"></i>
                </button>
            </div>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p class="form-error">{{ $error }}</p>
                @endforeach
            @endif
        </div>

        <button type="submit" class="btn-primary w-full justify-center">Confirm</button>
    </form>

@endsection
