@extends('layouts.recovery')

@section('title', 'Forgot Password | ' . $settings->site_name . ' Solicitors')
@section('description', 'Reset your account password to continue tracking your fund recovery claim.')

@section('content')

    <section class="relative bg-surface-muted border-b border-border-muted overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&w=1920&q=80');"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-surface/95 via-surface/85 to-surface/40"></div>
        <div class="relative section-container py-16 md:py-24">
            <x-breadcrumb :items="[['label' => 'Forgot Password', 'url' => null]]" />
            <h1 class="text-3xl md:text-4xl">Forgot Password</h1>
            <p class="mt-4 text-lg text-content-secondary max-w-2xl">
                Enter your email address and we&rsquo;ll send a secure password reset link.
            </p>
        </div>
    </section>

    <section>
        <div class="section-container section-padding">
            <div class="max-w-xl mx-auto card">
                @if (Session::has('message'))
                    <div class="mb-6 bg-danger/10 border-l-2 border-danger text-sm text-content-secondary p-3 rounded-r-md">{{ Session::get('message') }}</div>
                @endif
                @if (session('status'))
                    <div class="mb-6 bg-success/10 border-l-2 border-success text-sm text-content-secondary p-3 rounded-r-md">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium text-content mb-1.5">Email address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" class="input-field" placeholder="you@example.com" required autofocus>
                        @error('email')
                            <p class="text-xs text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn-primary w-full justify-center">Send Reset Link</button>
                </form>

                <p class="mt-8 text-center text-sm text-content-secondary">
                    Back to <a href="{{ route('login') }}" class="font-medium text-primary hover:text-primary-dark transition-colors">Sign in</a>
                </p>
            </div>
        </div>
    </section>

@endsection
