
@extends('layouts.dashboard')
@section('title', $title)
@section('page-title', 'Security Settings')

@section('content')
    {{-- Alerts --}}
    @if(session('success'))
        <div class="mb-4 p-3 rounded-md bg-success-light text-success text-sm">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-3 rounded-md bg-danger-light text-danger text-sm">{{ session('error') }}</div>
    @endif

    <div class="max-w-3xl mx-auto space-y-6">
        {{-- Two Factor Authentication --}}
        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
            <div class="dash-card">
                @livewire('profile.two-factor-authentication-form')
            </div>
        @endif

        {{-- Browser Sessions --}}
        <div class="dash-card">
            @livewire('profile.logout-other-browser-sessions-form')
        </div>

        {{-- Account Deletion --}}
        @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
            <div class="dash-card">
                @livewire('profile.delete-user-form')
            </div>
        @endif
    </div>
@endsection
