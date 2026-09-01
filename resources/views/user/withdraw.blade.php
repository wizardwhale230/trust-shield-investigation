@extends('layouts.dashboard')
@section('title', $title)
@section('page-title', 'Authorise Disbursement')

@php
    $currency = $settings->currency ?? '$';
    $availableBalance = (float)(Auth::user()->account_bal ?? 0);
    $isCrypto = ($methodtype ?? '') === 'crypto';
    $isBankTransfer = strcasecmp($payment_mode ?? '', 'Bank Transfer') === 0;
    $useAutomatedGateway = ($payment_mode === 'USDT'
        && ($settings->auto_merchant_option ?? '') === 'Binance'
        && ($settings->withdrawal_option ?? '') === 'auto');
@endphp

@section('content')
    <div class="max-w-3xl mx-auto space-y-5">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3">
            <div>
                <p class="text-xs uppercase tracking-widest text-accent font-semibold mb-1.5">Disbursement instruction</p>
                <h2 class="text-lg font-heading font-semibold text-content">Authorise disbursement &mdash; {{ $payment_mode }}</h2>
                <p class="text-sm text-content-secondary mt-0.5">Confirm the amount and destination, then authorise the firm to release the funds from client escrow.</p>
            </div>
            <a href="{{ route('withdrawalsdeposits') }}" class="btn-secondary text-xs self-start sm:self-auto">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5 mr-1"></i>
                Choose a different channel
            </a>
        </div>

        {{-- Step indicator --}}
        <div class="flex items-center gap-2 sm:gap-3 text-xs">
            <div class="flex items-center gap-2 text-content-tertiary">
                <span class="w-6 h-6 rounded-full bg-primary text-white flex items-center justify-center font-semibold">
                    <i data-lucide="check" class="w-3 h-3"></i>
                </span>
                <span class="hidden sm:inline">Channel chosen</span>
            </div>
            <div class="flex-1 h-px bg-border"></div>
            <div class="flex items-center gap-2 text-primary">
                <span class="w-6 h-6 rounded-full bg-primary text-white flex items-center justify-center font-semibold">2</span>
                <span class="font-medium">Amount &amp; beneficiary</span>
            </div>
            <div class="flex-1 h-px bg-border"></div>
            <div class="flex items-center gap-2 text-content-tertiary">
                <span class="w-6 h-6 rounded-full bg-surface-subtle border border-border flex items-center justify-center font-semibold">3</span>
                <span class="hidden sm:inline">Review &amp; authorise</span>
            </div>
        </div>

        {{-- Channel summary --}}
        <div class="dash-card border border-border-muted">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-lg {{ $isCrypto ? 'bg-surface-subtle text-content-secondary' : 'bg-primary-light text-primary' }} flex items-center justify-center">
                    <i data-lucide="{{ $isCrypto ? 'bitcoin' : 'landmark' }}" class="w-5 h-5"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-content">{{ $payment_mode }}</p>
                    <p class="text-xs text-content-tertiary">{{ $isCrypto ? 'Digital-asset channel' : 'Bank / wire transfer' }} &middot; Verified</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-content-tertiary">Available</p>
                    <p class="text-sm font-semibold text-content">{{ $currency }}{{ number_format($availableBalance, 2) }}</p>
                </div>
            </div>
        </div>

        @if (session('status'))
            <div class="flex items-center gap-3 bg-danger-light border border-danger/20 text-danger rounded-md px-4 py-3 text-sm">
                <i data-lucide="alert-circle" class="w-4 h-4 flex-shrink-0"></i>
                {{ session('status') }}
            </div>
            {{ session()->forget('status') }}
        @endif

        <x-danger-alert />
        <x-success-alert />
        <x-alert />

        <div class="dash-card">
            @if ($useAutomatedGateway)
                <livewire:user.crypto-withdaw :payment_mode="$payment_mode" />
            @else
                <div
                    x-data="{
                        step: 'enter',
                        amount: null,
                        details: '',
                        bank: { name: '', account_name: '', account_number: '', swift: '' },
                        attested: false,
                        error: '',
                        available: {{ $availableBalance }},
                        isBank: {{ $isBankTransfer ? 'true' : 'false' }},
                        isCrypto: {{ $isCrypto ? 'true' : 'false' }},
                        composeDetails() {
                            if (this.isBank) {
                                return 'Bank Name: ' + this.bank.name.trim()
                                    + ', Account Name: ' + this.bank.account_name.trim()
                                    + ', Account Number: ' + this.bank.account_number.trim()
                                    + ', Swift Code: ' + this.bank.swift.trim();
                            }
                            return (this.details || '').trim();
                        },
                        validateAndReview() {
                            this.error = '';
                            const amt = parseFloat(this.amount);
                            if (!amt || amt <= 0) { this.error = 'Enter the amount you wish to disburse.'; return; }
                            if (amt > this.available) { this.error = 'Amount exceeds the funds cleared for disbursement on your file.'; return; }
                            if (this.isBank) {
                                if (!this.bank.name.trim() || !this.bank.account_name.trim() || !this.bank.account_number.trim()) {
                                    this.error = 'Please complete the bank name, account name, and account number.'; return;
                                }
                            } else if (!(this.details || '').trim()) {
                                this.error = this.isCrypto
                                    ? 'Please enter the destination wallet address.'
                                    : 'Please enter the beneficiary details for this disbursement.';
                                return;
                            }
                            this.step = 'review';
                            window.scrollTo({ top: 0, behavior: 'smooth' });
                        }
                    }"
                    x-cloak
                >
                    <form action="{{ route('completewithdrawal') }}" method="post">
                        @csrf
                        <input value="{{ $payment_mode }}" type="hidden" name="method">

                        {{-- ============ Step 1: Entry pane ============ --}}
                        <div x-show="step === 'enter'">
                            <div class="mb-5">
                                <h3 class="text-base font-semibold text-content">Enter disbursement details</h3>
                                <p class="text-xs text-content-secondary mt-0.5">All amounts are released from your client trust balance and reduced by any applicable channel fee.</p>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Amount to disburse ({{ $currency }})</label>
                                <input class="input-field" placeholder="0.00" type="number" step="any" min="0"
                                       name="amount" x-model.number="amount" required>
                                <p class="text-xs text-content-tertiary mt-1.5">Maximum currently available: {{ $currency }}{{ number_format($availableBalance, 2) }}</p>
                            </div>

                            @if (Auth::user()->sendotpemail == 'Yes')
                                <div class="mb-4">
                                    <div class="flex items-center justify-between mb-2 gap-3">
                                        <label class="form-label mb-0">Authorisation code</label>
                                        <a class="btn-secondary text-xs" href="{{ route('getotp') }}">
                                            <i data-lucide="mail" class="w-3.5 h-3.5 mr-1"></i>
                                            Send code to my email
                                        </a>
                                    </div>
                                    <input class="input-field" placeholder="Enter authorisation code" type="text" name="otpcode" required>
                                    <p class="text-xs text-content-tertiary mt-1.5">A one-time code is sent to your verified email to confirm you originated this disbursement instruction.</p>
                                </div>
                            @endif

                            {{-- Beneficiary section (always shown; entered inline) --}}
                            <div class="mb-2 mt-6 pt-4 border-t border-border-muted">
                                <h4 class="text-sm font-semibold text-content">Beneficiary destination</h4>
                                <p class="text-xs text-content-secondary mt-0.5">
                                    @if ($isBankTransfer)
                                        Funds will be released only to the bank account entered below. Please ensure the details exactly match the verified account holder.
                                    @elseif ($isCrypto)
                                        Funds will be released to the wallet address entered below. Verify ownership before authorising &mdash; on-chain transfers cannot be reversed.
                                    @else
                                        Provide the destination details for this disbursement. The firm will release funds only to the destination specified.
                                    @endif
                                </p>
                            </div>

                            @if ($isBankTransfer)
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="form-label">Bank name</label>
                                        <input class="input-field" type="text" placeholder="e.g. HSBC UK"
                                               x-model="bank.name" required>
                                    </div>
                                    <div>
                                        <label class="form-label">Account name</label>
                                        <input class="input-field" type="text" placeholder="Full name as on account"
                                               x-model="bank.account_name" required>
                                    </div>
                                    <div>
                                        <label class="form-label">Account number / IBAN</label>
                                        <input class="input-field" type="text" placeholder="Account number or IBAN"
                                               x-model="bank.account_number" required>
                                    </div>
                                    <div>
                                        <label class="form-label">SWIFT / BIC code <span class="text-content-tertiary font-normal">(optional for domestic)</span></label>
                                        <input class="input-field" type="text" placeholder="e.g. HBUKGB4B"
                                               x-model="bank.swift">
                                    </div>
                                </div>
                            @elseif ($isCrypto)
                                <div class="mb-4">
                                    <label class="form-label">{{ $payment_mode }} wallet address</label>
                                    <input class="input-field font-mono text-xs" type="text"
                                           placeholder="Paste the destination wallet address"
                                           x-model="details" required>
                                    <p class="text-xs text-danger mt-1.5">Double-check the address. Funds sent to an incorrect wallet cannot be recovered.</p>
                                </div>
                            @else
                                <div class="mb-4">
                                    <label class="form-label">{{ $payment_mode }} beneficiary details</label>
                                    <textarea class="input-field" rows="4" x-model="details"
                                              placeholder="Provide all details required to receive funds via {{ $payment_mode }}" required></textarea>
                                </div>
                            @endif

                            {{-- Composed details submitted to backend --}}
                            <input type="hidden" name="details" :value="composeDetails()">

                            <div x-show="error" x-cloak class="mb-4 flex items-start gap-2 bg-danger-light border border-danger/20 text-danger rounded-md px-3 py-2 text-xs">
                                <i data-lucide="alert-circle" class="w-3.5 h-3.5 flex-shrink-0 mt-0.5"></i>
                                <span x-text="error"></span>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-2 sm:justify-end pt-2 border-t border-border-muted">
                                <a href="{{ route('withdrawalsdeposits') }}" class="btn-ghost text-sm">Cancel</a>
                                <button type="button" @click="validateAndReview()" class="btn-primary">
                                    Continue to review
                                    <i data-lucide="arrow-right" class="w-4 h-4 ml-1.5"></i>
                                </button>
                            </div>
                        </div>

                        {{-- ============ Step 2: Review pane ============ --}}
                        <div x-show="step === 'review'" x-cloak>
                            <div class="mb-5">
                                <h3 class="text-base font-semibold text-content">Review &amp; authorise this instruction</h3>
                                <p class="text-xs text-content-secondary mt-0.5">Please confirm the disbursement details below. Once authorised, the instruction enters the firm's payout queue and cannot be amended online.</p>
                            </div>

                            <div class="rounded-md border border-border-muted divide-y divide-border-muted text-sm">
                                <div class="flex justify-between px-4 py-3">
                                    <dt class="text-content-secondary">Channel</dt>
                                    <dd class="text-content font-medium">{{ $payment_mode }}</dd>
                                </div>
                                <div class="flex justify-between px-4 py-3">
                                    <dt class="text-content-secondary">Channel type</dt>
                                    <dd class="text-content font-medium">{{ $isCrypto ? 'Digital-asset' : 'Bank / wire transfer' }}</dd>
                                </div>
                                <div class="flex justify-between px-4 py-3">
                                    <dt class="text-content-secondary">Amount requested</dt>
                                    <dd class="text-content font-semibold">{{ $currency }}<span x-text="(parseFloat(amount) || 0).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})"></span></dd>
                                </div>
                                @if ($isBankTransfer)
                                    <div class="px-4 py-3 space-y-1">
                                        <div class="flex justify-between gap-3"><dt class="text-content-secondary">Bank name</dt><dd class="text-content font-medium text-right" x-text="bank.name || '—'"></dd></div>
                                        <div class="flex justify-between gap-3"><dt class="text-content-secondary">Account name</dt><dd class="text-content font-medium text-right" x-text="bank.account_name || '—'"></dd></div>
                                        <div class="flex justify-between gap-3"><dt class="text-content-secondary">Account number</dt><dd class="text-content font-mono text-xs text-right" x-text="bank.account_number || '—'"></dd></div>
                                        <div class="flex justify-between gap-3"><dt class="text-content-secondary">SWIFT / BIC</dt><dd class="text-content font-mono text-xs text-right" x-text="bank.swift || '— (domestic)'"></dd></div>
                                    </div>
                                @else
                                    <div class="flex justify-between px-4 py-3 gap-3">
                                        <dt class="text-content-secondary">{{ $isCrypto ? 'Wallet address' : 'Beneficiary' }}</dt>
                                        <dd class="text-content {{ $isCrypto ? 'font-mono text-xs break-all max-w-[60%] text-right' : 'font-medium text-right' }}" x-text="details || '—'"></dd>
                                    </div>
                                @endif
                                <div class="flex justify-between px-4 py-3">
                                    <dt class="text-content-secondary">Available balance</dt>
                                    <dd class="text-content">{{ $currency }}{{ number_format($availableBalance, 2) }}</dd>
                                </div>
                            </div>

                            <div class="mt-5 flex items-start gap-3 bg-surface-subtle border border-border-muted rounded-md px-4 py-3">
                                <input id="attest" type="checkbox" x-model="attested"
                                       class="mt-0.5 h-4 w-4 rounded border-border text-primary focus:ring-primary">
                                <label for="attest" class="text-xs text-content-secondary leading-relaxed">
                                    I confirm I am the verified client of record and authorise the firm to release the amount above from client escrow to the destination shown. I acknowledge that, once submitted, this instruction enters the firm's payout queue and is processed within the channel's published settlement window.
                                </label>
                            </div>

                            <div class="mt-3 flex items-start gap-2 text-xs text-content-tertiary">
                                <i data-lucide="info" class="w-3.5 h-3.5 flex-shrink-0 mt-0.5"></i>
                                <span>You will receive ledger updates by email at each stage &mdash; queued, in review, and disbursed.</span>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-2 sm:justify-end mt-5 pt-4 border-t border-border-muted">
                                <button type="button" @click="step = 'enter'" class="btn-secondary">
                                    <i data-lucide="arrow-left" class="w-4 h-4 mr-1.5"></i>
                                    Back to edit
                                </button>
                                <button type="submit" class="btn-primary" :disabled="!attested" :class="!attested && 'opacity-60 cursor-not-allowed'">
                                    Authorise &amp; submit instruction
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => { if (window.lucide) lucide.createIcons(); });
        document.addEventListener('alpine:initialized', () => { if (window.lucide) lucide.createIcons(); });
    </script>
@endsection
