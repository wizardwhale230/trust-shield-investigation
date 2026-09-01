@extends('layouts.dashboard')
@section('title', $title)
@section('page-title', 'Disbursement of Recovered Funds')

@php
    $availableBalance = (float)(Auth::user()->account_bal ?? 0);
    $currency = $settings->currency ?? '$';
    $withdrawalsEnabled = ($settings->enable_with ?? 'true') !== 'false';

    // Split channels: bank/wire (primary) vs crypto (alternative).
    [$primaryChannels, $altChannels] = collect($wmethods)
        ->partition(fn($m) => strtolower($m->methodtype ?? '') !== 'crypto');
@endphp

@section('content')
    <div class="max-w-6xl mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
            <div>
                <p class="text-xs uppercase tracking-widest text-accent font-semibold mb-2">Disbursement console</p>
                <h2 class="text-xl sm:text-2xl font-heading font-semibold text-content">Authorise disbursement of recovered funds</h2>
                <p class="text-sm text-content-secondary mt-1 max-w-2xl">
                    Funds recovered on your matter are held in segregated client escrow until you instruct the firm to release them. Choose a verified disbursement channel below to authorise a payout to your account on file.
                </p>
                <p class="text-xs text-content-tertiary mt-1.5">Client reference: <span class="font-mono">#{{ Auth::id() }}</span></p>
            </div>
            <a href="{{ route('accounthistory') }}" class="btn-secondary text-sm self-start sm:self-auto">
                <i data-lucide="clock" class="w-4 h-4 mr-1.5"></i>
                Disbursement ledger
            </a>
        </div>

        {{-- Cleared-for-disbursement hero --}}
        <div class="rounded-xl bg-gradient-to-br from-primary to-primary-dark text-white p-6 sm:p-8 shadow-card">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2">
                    <p class="text-xs uppercase tracking-wider text-white/70 font-medium">Funds cleared for disbursement</p>
                    <p class="mt-2 text-3xl sm:text-4xl font-heading font-semibold">
                        {{ $currency }}{{ number_format($availableBalance, 2) }}
                    </p>
                    <p class="mt-1 text-xs text-white/70">Net of legal fees and operational costs already deducted.</p>
                    <p class="mt-3 text-sm text-white/80 max-w-lg">
                        These funds have been recovered on your behalf, reconciled into our client trust account, and are cleared for release. Select a channel below to issue a disbursement instruction.
                    </p>
                </div>
                <div class="flex flex-col justify-center gap-3 lg:border-l lg:border-white/15 lg:pl-6">
                    <div class="flex items-center gap-2 text-sm text-white/90">
                        <i data-lucide="vault" class="w-4 h-4"></i>
                        <span>Held in segregated client escrow</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-white/90">
                        <i data-lucide="shield-check" class="w-4 h-4"></i>
                        <span>AML / CFT screened on every release</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-white/90">
                        <i data-lucide="user-check" class="w-4 h-4"></i>
                        <span>Released only to the verified client of record</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Step indicator (4 stages) --}}
        <div class="flex items-center gap-2 sm:gap-3 text-xs sm:text-sm">
            <div class="flex items-center gap-2 text-primary">
                <span class="w-7 h-7 rounded-full bg-primary text-white flex items-center justify-center font-semibold">1</span>
                <span class="font-medium">Choose channel</span>
            </div>
            <div class="flex-1 h-px bg-border"></div>
            <div class="flex items-center gap-2 text-content-tertiary">
                <span class="w-7 h-7 rounded-full bg-surface-subtle border border-border flex items-center justify-center font-semibold">2</span>
                <span class="hidden sm:inline">Amount &amp; beneficiary</span>
            </div>
            <div class="flex-1 h-px bg-border"></div>
            <div class="flex items-center gap-2 text-content-tertiary">
                <span class="w-7 h-7 rounded-full bg-surface-subtle border border-border flex items-center justify-center font-semibold">3</span>
                <span class="hidden sm:inline">Review &amp; authorise</span>
            </div>
            <div class="flex-1 h-px bg-border"></div>
            <div class="flex items-center gap-2 text-content-tertiary">
                <span class="w-7 h-7 rounded-full bg-surface-subtle border border-border flex items-center justify-center font-semibold">4</span>
                <span class="hidden sm:inline">Submitted</span>
            </div>
        </div>

        @if(!$withdrawalsEnabled)
            <div class="flex items-start gap-3 bg-warning-light border border-warning/20 text-warning rounded-md px-4 py-3 text-sm">
                <i data-lucide="alert-triangle" class="w-4 h-4 flex-shrink-0 mt-0.5"></i>
                <div>
                    <p class="font-medium">Outbound disbursements are on temporary hold</p>
                    <p class="text-xs mt-0.5 opacity-90">Operations has briefly paused outbound releases pending review. Your case officer will notify you as soon as channels reopen.</p>
                </div>
            </div>
        @endif

        {{-- Primary disbursement channel --}}
        <div>
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-base font-heading font-semibold text-content">Primary disbursement channel</h3>
                    <p class="text-xs text-content-tertiary mt-0.5">Recommended for all client-money releases. Beneficiary bank must match the verified account on file.</p>
                </div>
                <span class="text-xs text-content-tertiary">{{ $primaryChannels->count() }} available</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @forelse ($primaryChannels as $method)
                    <div class="dash-card flex flex-col hover:shadow-dropdown transition-shadow duration-150 border border-border-muted relative">
                        <span class="absolute top-3 right-3 status-badge bg-accent/10 text-accent">
                            <i data-lucide="star" class="w-3 h-3 mr-0.5"></i> Recommended
                        </span>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-11 h-11 rounded-lg bg-primary-light text-primary flex items-center justify-center">
                                <i data-lucide="landmark" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-content leading-tight">{{ $method->name }}</h4>
                                <p class="text-xs text-content-tertiary">Bank / wire transfer &middot; Verified channel</p>
                            </div>
                        </div>

                        <dl class="border-t border-border-muted pt-4 space-y-2.5 flex-1 text-sm">
                            <div class="flex justify-between">
                                <dt class="text-content-secondary">Minimum disbursement</dt>
                                <dd class="text-content font-medium">{{ $currency }}{{ number_format($method->minimum) }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-content-secondary">Maximum per instruction</dt>
                                <dd class="text-content font-medium">{{ $currency }}{{ number_format($method->maximum) }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-content-secondary">Operational fee</dt>
                                <dd class="text-content font-medium">
                                    @if ($method->charges_type == 'percentage')
                                        {{ $method->charges_amount }}%
                                    @else
                                        {{ $currency }}{{ $method->charges_amount }}
                                    @endif
                                </dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-content-secondary">Settlement window</dt>
                                <dd class="text-content font-medium">{{ $method->duration }}</dd>
                            </div>
                        </dl>

                        <div class="mt-5 pt-4 border-t border-border-muted">
                            @if(!$withdrawalsEnabled)
                                <button class="btn-secondary w-full opacity-60 cursor-not-allowed" disabled>
                                    Disbursements on hold
                                </button>
                            @elseif($availableBalance < (float)$method->minimum)
                                <button class="btn-secondary w-full opacity-70 cursor-not-allowed" disabled title="Available balance is below this channel's minimum">
                                    Below minimum disbursement amount
                                </button>
                            @else
                                <form action="{{ route('withdrawamount') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $method->name }}" name="method">
                                    <button class="btn-primary w-full" type="submit">
                                        Authorise via this channel
                                        <i data-lucide="arrow-right" class="w-4 h-4 ml-1.5"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="md:col-span-2 dash-card text-center py-10 border-dashed">
                        <div class="w-12 h-12 rounded-full bg-warning-light flex items-center justify-center mx-auto mb-3">
                            <i data-lucide="landmark" class="w-6 h-6 text-warning"></i>
                        </div>
                        <h3 class="text-sm font-semibold text-content mb-1">No bank disbursement channel configured</h3>
                        <p class="text-xs text-content-secondary max-w-md mx-auto">
                            Your case officer has not yet enabled a bank or wire channel on your file. Please contact the firm to authorise one before requesting a payout.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Alternative settlement channels (crypto) --}}
        @if($altChannels->isNotEmpty())
            <div>
                <div class="flex items-center justify-between mb-3">
                    <div>
                        <h3 class="text-sm font-heading font-semibold text-content">Alternative settlement channels (advanced)</h3>
                        <p class="text-xs text-content-tertiary mt-0.5">Available where the client has provided and verified ownership of a destination wallet. Bank disbursement remains the recommended channel for client-money releases.</p>
                    </div>
                    <span class="text-xs text-content-tertiary">{{ $altChannels->count() }} available</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($altChannels as $method)
                        <div class="dash-card flex flex-col hover:shadow-dropdown transition-shadow duration-150 border border-border-muted">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-surface-subtle text-content-secondary flex items-center justify-center">
                                        <i data-lucide="bitcoin" class="w-5 h-5"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-semibold text-content leading-tight">{{ $method->name }}</h4>
                                        <p class="text-xs text-content-tertiary">Digital-asset channel</p>
                                    </div>
                                </div>
                                <span class="status-badge bg-success-light text-success">
                                    <i data-lucide="check" class="w-3 h-3 mr-0.5"></i> Verified
                                </span>
                            </div>

                            <dl class="border-t border-border-muted pt-4 space-y-2.5 flex-1 text-sm">
                                <div class="flex justify-between">
                                    <dt class="text-content-secondary">Minimum</dt>
                                    <dd class="text-content font-medium">{{ $currency }}{{ number_format($method->minimum) }}</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-content-secondary">Maximum</dt>
                                    <dd class="text-content font-medium">{{ $currency }}{{ number_format($method->maximum) }}</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-content-secondary">Network fee</dt>
                                    <dd class="text-content font-medium">
                                        @if ($method->charges_type == 'percentage')
                                            {{ $method->charges_amount }}%
                                        @else
                                            {{ $currency }}{{ $method->charges_amount }}
                                        @endif
                                    </dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-content-secondary">Settlement window</dt>
                                    <dd class="text-content font-medium">{{ $method->duration }}</dd>
                                </div>
                            </dl>

                            <div class="mt-5 pt-4 border-t border-border-muted">
                                @if(!$withdrawalsEnabled)
                                    <button class="btn-secondary w-full opacity-60 cursor-not-allowed" disabled>
                                        Disbursements on hold
                                    </button>
                                @elseif($availableBalance < (float)$method->minimum)
                                    <button class="btn-secondary w-full opacity-70 cursor-not-allowed" disabled title="Available balance is below this channel's minimum">
                                        Below minimum disbursement amount
                                    </button>
                                @else
                                    <form action="{{ route('withdrawamount') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $method->name }}" name="method">
                                        <button class="btn-secondary w-full" type="submit">
                                            Authorise via this channel
                                            <i data-lucide="arrow-right" class="w-4 h-4 ml-1.5"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if($primaryChannels->isEmpty() && $altChannels->isEmpty())
            <div class="dash-card text-center py-12">
                <div class="w-14 h-14 rounded-full bg-warning-light flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="briefcase" class="w-7 h-7 text-warning"></i>
                </div>
                <h3 class="text-base font-semibold text-content mb-1">No disbursement channels authorised on your case file</h3>
                <p class="text-sm text-content-secondary max-w-md mx-auto">
                    Your assigned case officer has not yet authorised a payout channel on your matter. Please reach out to the firm so a verified channel can be enabled for your recovered funds.
                </p>
            </div>
        @endif

        {{-- Compliance footer --}}
        <div class="dash-card bg-surface-subtle border-border-muted">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="flex items-start gap-3">
                    <div class="w-9 h-9 rounded-md bg-primary-light text-primary flex items-center justify-center flex-shrink-0">
                        <i data-lucide="vault" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-content">Trust-account reconciled</p>
                        <p class="text-xs text-content-secondary mt-0.5">Recovered amounts are held in a segregated client escrow account, ring-fenced from the firm's operating funds until you instruct release.</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-9 h-9 rounded-md bg-primary-light text-primary flex items-center justify-center flex-shrink-0">
                        <i data-lucide="user-check" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-content">Case-officer oversight</p>
                        <p class="text-xs text-content-secondary mt-0.5">Every disbursement instruction is reviewed by your assigned case officer before funds are released to the verified beneficiary on file.</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-9 h-9 rounded-md bg-primary-light text-primary flex items-center justify-center flex-shrink-0">
                        <i data-lucide="scale" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-content">AML / CFT screened</p>
                        <p class="text-xs text-content-secondary mt-0.5">Each release is logged and screened against anti-money-laundering and counter-financing-of-terrorism controls in line with client-money handling standards.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
