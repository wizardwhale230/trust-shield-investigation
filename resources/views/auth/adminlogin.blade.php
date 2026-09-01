@extends('layouts.auth')
@section('title', 'Admin sign in')
@section('content')

    {{-- Alerts --}}
    @if (session('message'))
        <div class="alert-danger mb-6">{{ session('message') }}</div>
    @endif
    @if (session('success'))
        <div class="alert-success mb-6">{{ session('success') }}</div>
    @endif

    {{-- Heading --}}
    <div class="mb-8">
        <h1 class="auth-heading">Admin sign in</h1>
        <p class="auth-subtext mt-2">Enter your credentials to access the dashboard.</p>
    </div>

    {{-- Form --}}
    <form method="POST" action="{{ route('adminlogin') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="form-label">Email address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-input" placeholder="you@example.com" required autofocus>
            @error('email')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div x-data="{ show: false }">
            <div class="flex items-center justify-between">
                <label for="password" class="form-label">Password</label>
                <a href="{{ route('admin.forgetpassword') }}" class="text-xs text-content-tertiary hover:text-primary transition-colors">Forgot password?</a>
            </div>
            <div class="relative">
                <input id="password" :type="show ? 'text' : 'password'" name="password" class="form-input pr-10" placeholder="Enter your password" required>
                <button type="button" @click="show = !show" class="absolute right-3 top-1/2 -translate-y-1/2 text-content-tertiary hover:text-content-secondary transition-colors" tabindex="-1">
                    <i x-show="!show" data-lucide="eye" class="w-4 h-4"></i>
                    <i x-show="show" data-lucide="eye-off" class="w-4 h-4"></i>
                </button>
            </div>
        </div>

        <button type="submit" class="btn-primary w-full justify-center">Sign in</button>
    </form>

@endsection

@push('head')
<script>
    // Refresh CSRF token every 10 minutes so the form never expires
    (function () {
        const TEN_MINUTES = 10 * 60 * 1000;
        function refreshCsrf() {
            fetch('{{ route('csrf.refresh') }}', { credentials: 'same-origin' })
                .then(r => r.json())
                .then(data => {
                    document.querySelectorAll('input[name="_token"]')
                        .forEach(el => el.value = data.token);
                    const meta = document.querySelector('meta[name="csrf-token"]');
                    if (meta) meta.setAttribute('content', data.token);
                })
                .catch(() => {});
        }
        setInterval(refreshCsrf, TEN_MINUTES);
    })();
</script>
@endpush
