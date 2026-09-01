
@extends('layouts.dashboard')
@section('title', $title)
@section('page-title', 'KYC Verification')

@section('content')
    <div class="max-w-3xl mx-auto">
        <x-danger-alert />
        <x-success-alert />

        <div class="dash-card mb-6 text-center">
            <div class="w-14 h-14 rounded-full bg-warning-light flex items-center justify-center mx-auto mb-4">
                <i data-lucide="shield-alert" class="w-7 h-7 text-warning"></i>
            </div>
            <h2 class="text-lg font-heading font-semibold text-content mb-2">KYC Verification Required</h2>
            <p class="text-sm text-content-secondary max-w-2xl mx-auto">
                To keep the recovery platform secure and compliant, identity verification is required before certain actions are enabled.
            </p>

            <div class="mt-5">
                @if (Auth::user()->account_verify == 'Verified' or Auth::user()->account_verify == 'Under review')
                    <button class="btn-secondary opacity-70 cursor-not-allowed" disabled>KYC Application Submitted</button>
                    <p class="text-xs text-success mt-2">Your previous application is under review, please wait.</p>
                @else
                    <a href="{{ route('kycform') }}" class="btn-primary">Start KYC Verification</a>
                @endif
            </div>
        </div>

        <div class="dash-card flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 rounded-md bg-primary-light flex items-center justify-center">
                    <i data-lucide="life-buoy" class="w-5 h-5 text-primary"></i>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-content">Need help?</h3>
                    <p class="text-xs text-content-secondary">Contact support and our team will assist with your verification process.</p>
                </div>
            </div>
            <a href="{{ route('user.support-tickets.index') }}" class="btn-secondary">Get Support</a>
        </div>
    </div>
@endsection
