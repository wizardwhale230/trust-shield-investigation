@extends('layouts.dashboard')
@section('title', $title)
@section('page-title', 'My Profile')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    {{-- Alert messages --}}
    @if(session('message'))<div class="flex items-center gap-3 bg-danger-light border border-danger/20 text-danger rounded-md px-4 py-3 text-sm"><i data-lucide="alert-circle" class="w-4 h-4 flex-shrink-0"></i>{{ session('message') }}</div>@endif
    @if(session('success'))<div class="flex items-center gap-3 bg-success-light border border-success/20 text-success rounded-md px-4 py-3 text-sm"><i data-lucide="check-circle-2" class="w-4 h-4 flex-shrink-0"></i>{{ session('success') }}</div>@endif
    @if(session('status'))<div class="flex items-center gap-3 bg-info-light border border-info/20 text-info rounded-md px-4 py-3 text-sm"><i data-lucide="info" class="w-4 h-4 flex-shrink-0"></i>{{ session('status') }}</div>@endif

    {{-- Client Identity Card --}}
    <div class="rounded-xl border border-border bg-surface overflow-hidden shadow-card">
        <div class="h-1.5 w-full bg-gradient-to-r from-primary via-accent to-accent-dark"></div>
        <div class="p-6 sm:p-8">
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">
                {{-- Avatar initials --}}
                <div class="flex-shrink-0 w-16 h-16 rounded-full bg-primary flex items-center justify-center ring-4 ring-accent/20">
                    <span class="text-xl font-bold text-white font-heading tracking-wide">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}{{ strtoupper(substr(strstr(Auth::user()->name, ' ') ?: ' ', 1, 1)) }}
                    </span>
                </div>
                {{-- Identity info --}}
                <div class="flex-1 min-w-0">
                    <div class="flex flex-wrap items-center gap-2 mb-1">
                        <h2 class="text-lg font-heading font-semibold text-content">{{ Auth::user()->name }}</h2>
                        @if(Auth::user()->email_verified_at)
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-success-light text-success text-xs font-medium">
                            <i data-lucide="shield-check" class="w-3 h-3"></i> Verified Client
                        </span>
                        @endif
                    </div>
                    <p class="text-sm text-content-secondary truncate">{{ Auth::user()->email }}</p>
                    <p class="text-xs text-content-tertiary mt-1">
                        Client since {{ Auth::user()->created_at->format('F Y') }}
                        @if(Auth::user()->country) &nbsp;&bull;&nbsp; {{ Auth::user()->country }} @endif
                    </p>
                </div>
                {{-- Firm badge --}}
                <div class="hidden sm:flex flex-col items-end gap-1 text-right flex-shrink-0">
                    <div class="flex items-center gap-1.5 text-xs font-medium text-content-tertiary uppercase tracking-widest">
                        <i data-lucide="landmark" class="w-3.5 h-3.5 text-accent"></i> Client Portal
                    </div>
                    <p class="text-xs text-content-tertiary">Protected &amp; Confidential</p>
                </div>
            </div>
            {{-- Summary stats --}}
            <div class="mt-6 pt-5 border-t border-border-muted grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div>
                    <p class="text-xs text-content-tertiary uppercase tracking-wide mb-1">Status</p>
                    <p class="text-sm font-medium text-success flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-success inline-block"></span> Active</p>
                </div>
                <div>
                    <p class="text-xs text-content-tertiary uppercase tracking-wide mb-1">Account Type</p>
                    <p class="text-sm font-medium text-content">Recovery Client</p>
                </div>
                <div>
                    <p class="text-xs text-content-tertiary uppercase tracking-wide mb-1">Phone</p>
                    <p class="text-sm font-medium text-content">{{ Auth::user()->phone ?: '—' }}</p>
                </div>
                <div>
                    <p class="text-xs text-content-tertiary uppercase tracking-wide mb-1">Country</p>
                    <p class="text-sm font-medium text-content">{{ Auth::user()->country ?: '—' }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Confidentiality notice --}}
    <div class="flex items-start gap-3 rounded-lg border border-accent/30 bg-accent-light/40 px-4 py-3">
        <i data-lucide="lock" class="w-4 h-4 text-accent mt-0.5 flex-shrink-0"></i>
        <p class="text-xs text-content-secondary leading-relaxed">
            <span class="font-semibold text-content">Confidentiality notice:</span>
            All information you provide is held strictly confidential in accordance with our client care policy and applicable data protection regulations. Your data is used solely for case management and recovery proceedings.
        </p>
    </div>

    {{-- Tabs --}}
    <div x-data="{ tab: 'personal' }">
        <div class="flex rounded-t-xl overflow-hidden border border-b-0 border-border bg-surface-muted">
            <button @click="tab = 'personal'"
                :class="tab === 'personal' ? 'bg-surface text-primary border-b-2 border-primary' : 'text-content-secondary hover:text-content hover:bg-surface/60'"
                class="flex items-center gap-2 px-5 py-3.5 text-sm font-medium transition-colors flex-1 sm:flex-none justify-center sm:justify-start">
                <i data-lucide="user" class="w-4 h-4"></i><span>Personal Details</span>
            </button>
            <button @click="tab = 'password'"
                :class="tab === 'password' ? 'bg-surface text-primary border-b-2 border-primary' : 'text-content-secondary hover:text-content hover:bg-surface/60'"
                class="flex items-center gap-2 px-5 py-3.5 text-sm font-medium transition-colors flex-1 sm:flex-none justify-center sm:justify-start">
                <i data-lucide="key-round" class="w-4 h-4"></i><span>Password</span>
            </button>
        </div>
        <div class="border border-t-0 border-border rounded-b-xl bg-surface overflow-hidden shadow-card">
            <div x-show="tab === 'personal'" x-cloak>
                <div class="px-6 py-4 border-b border-border-muted bg-surface-muted/50 flex items-start gap-3">
                    <i data-lucide="user-circle" class="w-4 h-4 text-accent mt-0.5 flex-shrink-0"></i>
                    <div>
                        <p class="text-sm font-semibold text-content">Personal Information</p>
                        <p class="text-xs text-content-tertiary mt-0.5">Keep your contact details accurate so we can communicate with you about your case.</p>
                    </div>
                </div>
                <div class="p-6">@include('profile.update-profile-information-form')</div>
            </div>
            <div x-show="tab === 'password'" x-cloak>
                <div class="px-6 py-4 border-b border-border-muted bg-surface-muted/50 flex items-start gap-3">
                    <i data-lucide="shield-ellipsis" class="w-4 h-4 text-accent mt-0.5 flex-shrink-0"></i>
                    <div>
                        <p class="text-sm font-semibold text-content">Change Password</p>
                        <p class="text-xs text-content-tertiary mt-0.5">Use a strong, unique password to keep your client account and case information secure.</p>
                    </div>
                </div>
                <div class="p-6">@include('profile.update-password-form')</div>
            </div>
        </div>
    </div>

    <p class="text-center text-xs text-content-tertiary pb-2">
        Need help with your account?
        <a href="{{ route('recovery.contact') }}" class="text-primary underline hover:text-primary-dark ml-1">Contact our support team &rarr;</a>
    </p>

</div>
@endsection