@extends('layouts.auth')
@section('title', 'Authenticate account')
@section('content')

    <div x-data="{ recovery: false }">
        {{-- Errors --}}
        @if ($errors->any())
            <div class="alert-danger mb-6">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Heading --}}
        <div class="mb-8 text-center">
            <div class="mx-auto mb-4 w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center">
                <i data-lucide="shield-check" class="w-6 h-6 text-primary"></i>
            </div>
            <h1 class="auth-heading">2-step verification</h1>
            <p class="auth-subtext mt-2" x-show="!recovery">
                {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
            </p>
            <p class="auth-subtext mt-2" x-show="recovery">
                {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
            </p>
        </div>

        {{-- Form --}}
        <form method="POST" action="{{ route('two-factor.login') }}" class="space-y-5">
            @csrf

            {{-- Auth code input --}}
            <div x-show="!recovery">
                <label for="code" class="form-label">Authentication code</label>
                <input id="code" type="text" inputmode="numeric" name="code" class="form-input" placeholder="Enter code from your app" autofocus x-ref="code" autocomplete="one-time-code">
            </div>

            {{-- Recovery code input --}}
            <div x-show="recovery">
                <label for="recovery_code" class="form-label">Recovery code</label>
                <input id="recovery_code" type="text" name="recovery_code" class="form-input" placeholder="Enter a recovery code" x-ref="recovery_code" autocomplete="one-time-code">
            </div>

            {{-- Toggle link --}}
            <div class="text-center">
                <button type="button" class="text-sm text-primary hover:text-primary-dark transition-colors" x-show="!recovery" x-on:click="recovery = true; $nextTick(() => { $refs.recovery_code.focus() })">
                    {{ __('Use a recovery code') }}
                </button>
                <button type="button" class="text-sm text-primary hover:text-primary-dark transition-colors" x-show="recovery" x-on:click="recovery = false; $nextTick(() => { $refs.code.focus() })">
                    {{ __('Use an authentication code') }}
                </button>
            </div>

            <button type="submit" class="btn-primary w-full justify-center">Verify &amp; sign in</button>
        </form>
    </div>

@endsection
        <!--end container-->
    </section>
    <!--end section-->
</div> --}}
