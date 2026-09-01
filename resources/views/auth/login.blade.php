@extends('layouts.recovery')

@section('title', 'Login | ' . $settings->site_name . ' Solicitors')
@section('description', 'Sign in to your recovery dashboard to monitor your claim progress and withdraw recovered funds.')

@section('content')

    <section class="relative bg-surface-muted border-b border-border-muted overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&w=1920&q=80');"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-surface/95 via-surface/85 to-surface/40"></div>
        <div class="relative section-container py-16 md:py-24">
            <x-breadcrumb :items="[['label' => 'Login', 'url' => null]]" />
            <h1 class="text-3xl md:text-4xl">Login to Your Dashboard</h1>
            <p class="mt-4 text-lg text-content-secondary max-w-2xl">
                Continue tracking your claim progress and recovered funds.
            </p>
        </div>
    </section>

    <section>
        <div class="section-container section-padding">
            <div class="max-w-xl mx-auto card">
                @if (Session::has('status'))
                    <div class="mb-6 bg-primary-light border-l-2 border-primary text-sm text-content-secondary p-3 rounded-r-md">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-content mb-1.5">Email address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" class="input-field" placeholder="you@example.com" autofocus>
                        @error('email')
                            <p class="text-xs text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div x-data="{ show: false }">
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="password" class="block text-sm font-medium text-content">Password</label>
                            <a href="{{ route('password.request') }}" class="text-xs text-primary hover:text-primary-dark transition-colors">Forgot password?</a>
                        </div>
                        <div class="relative">
                            <input id="password" :type="show ? 'text' : 'password'" name="password" class="input-field pr-10" placeholder="Enter your password" autocomplete="current-password">
                            <button type="button" @click="show = !show" class="absolute right-3 top-1/2 -translate-y-1/2 text-content-tertiary hover:text-content-secondary transition-colors" tabindex="-1">
                                <i x-show="!show" data-lucide="eye" class="w-4 h-4"></i>
                                <i x-show="show" data-lucide="eye-off" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <input id="remember" type="checkbox" name="remember" class="rounded border-border text-primary focus:ring-primary w-4 h-4">
                        <label for="remember" class="text-sm text-content-secondary">Remember me</label>
                    </div>

                    <button type="submit" class="btn-primary w-full justify-center">Sign in</button>
                </form>

                @if ($settings->enable_social_login == 'yes')
                    <div class="my-6 flex items-center gap-4 text-xs text-content-tertiary">
                        <span class="flex-1 h-px bg-border"></span>
                        <span>or</span>
                        <span class="flex-1 h-px bg-border"></span>
                    </div>
                    <a href="{{ route('social.redirect', ['social' => 'google']) }}" class="btn-secondary w-full justify-center gap-2">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18A10.96 10.96 0 0 0 1 12c0 1.77.42 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                        Sign in with Google
                    </a>
                @endif

                <p class="mt-8 text-center text-sm text-content-secondary">
                    Don&rsquo;t have an account?
                    <a href="{{ route('register') }}" class="font-medium text-primary hover:text-primary-dark transition-colors">Start Claim</a>
                </p>
            </div>
        </div>
    </section>

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
                    // Update all _token inputs on the page
                    document.querySelectorAll('input[name="_token"]')
                        .forEach(el => el.value = data.token);
                    // Update the meta tag used by JS libs
                    const meta = document.querySelector('meta[name="csrf-token"]');
                    if (meta) meta.setAttribute('content', data.token);
                })
                .catch(() => {}); // silently ignore network errors
        }
        setInterval(refreshCsrf, TEN_MINUTES);
    })();
</script>
@endpush
