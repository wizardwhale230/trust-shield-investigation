@extends('layouts.dashboard')
@section('title', $title)
@section('page-title', 'Payment Receipt')

@push('styles')
<style>
    @media print {
        body { background: white !important; }
        .no-print, .no-print * { display: none !important; }
        .print-only { display: block !important; }
        aside, header, nav, footer { display: none !important; }
        .receipt-wrap { max-width: 100% !important; margin: 0 !important; padding: 0 !important; }
        .dash-card { box-shadow: none !important; border: 1px solid lightgray !important; }
        a { color: inherit !important; text-decoration: none !important; }
    }
</style>
@endpush

@section('content')
    <div class="max-w-3xl mx-auto receipt-wrap">

        {{-- Confirmation banner --}}
        <div class="mb-6 flex items-center gap-4">
            <div class="w-14 h-14 rounded-full bg-success-light flex items-center justify-center flex-shrink-0">
                <i data-lucide="check-circle-2" class="w-8 h-8 text-success"></i>
            </div>
            <div>
                <p class="text-xs uppercase tracking-widest text-accent font-semibold">Payment Receipt</p>
                <h2 class="text-xl sm:text-2xl font-heading font-semibold text-content">
                    {{ $deposit->status === 'Processed' ? 'Payment confirmed' : 'Payment received — reconciliation pending' }}
                </h2>
                <p class="text-sm text-content-secondary mt-1">
                    @if($deposit->status === 'Processed')
                        Funds have been received into the firm's client trust account and applied to your matter.
                    @else
                        Your payment has been recorded. Our finance team will confirm receipt of cleared funds shortly.
                    @endif
                </p>
            </div>
        </div>

        {{-- Receipt card --}}
        <div class="dash-card mb-6">

            {{-- Letterhead --}}
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 pb-5 border-b border-border-muted">
                <div class="flex items-center gap-3">
                    @if(!empty($settings->logo))
                        <img src="{{ asset('storage/'.$settings->logo) }}" alt="{{ $settings->site_name ?? '' }}" class="h-10 w-auto">
                    @endif
                    <div>
                        <p class="text-base font-heading font-semibold text-content">{{ $settings->site_name ?? config('app.name') }}</p>
                        <p class="text-xs text-content-tertiary">Recovery &amp; Claims</p>
                    </div>
                </div>
                <div class="sm:text-right text-xs text-content-secondary leading-relaxed">
                    @if(!empty($settings->location))
                        <p>{{ $settings->location }}</p>
                    @endif
                    @if(!empty($settings->contact_email))
                        <p>{{ $settings->contact_email }}</p>
                    @endif
                    @if(!empty($settings->site_address))
                        <p>{{ $settings->site_address }}</p>
                    @endif
                </div>
            </div>

            {{-- Receipt header --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 py-5 border-b border-border-muted">
                <div>
                    <p class="text-xs uppercase tracking-wider text-content-tertiary">Receipt No.</p>
                    <p class="text-sm font-mono font-semibold text-content">RCPT-{{ str_pad($deposit->id, 6, '0', STR_PAD_LEFT) }}</p>
                </div>
                <div class="sm:text-right">
                    <p class="text-xs uppercase tracking-wider text-content-tertiary">Date</p>
                    <p class="text-sm text-content">{{ $deposit->created_at->format('M d, Y g:i A') }}</p>
                </div>
            </div>

            {{-- Client + matter --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 py-5 border-b border-border-muted text-sm">
                <div>
                    <p class="text-xs uppercase tracking-wider text-content-tertiary mb-1">Client</p>
                    <p class="text-content font-medium">{{ $user->name }}</p>
                    <p class="text-content-secondary text-xs">{{ $user->email }}</p>
                </div>
                @if(!empty($case))
                    <div>
                        <p class="text-xs uppercase tracking-wider text-content-tertiary mb-1">Matter</p>
                        <a href="{{ route('user.cases.show', $case->id) }}" class="text-primary hover:text-primary-dark font-mono font-medium no-print-link">
                            {{ $case->case_number }}
                        </a>
                        @if(!empty($case->title))
                            <p class="text-content-secondary text-xs">{{ $case->title }}</p>
                        @endif
                    </div>
                @endif
                @if(!empty($feeRequest))
                    <div class="sm:col-span-2">
                        <p class="text-xs uppercase tracking-wider text-content-tertiary mb-1">Fee</p>
                        <p class="text-content font-medium">{{ $feeRequest->title }} <span class="text-content-tertiary font-normal">(FR-{{ $feeRequest->id }})</span></p>
                        @if(!empty($feeRequest->description))
                            <p class="text-content-secondary text-xs mt-0.5">{{ $feeRequest->description }}</p>
                        @endif
                    </div>
                @endif
            </div>

            {{-- Payment details --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 py-5 border-b border-border-muted text-sm">
                <div>
                    <p class="text-xs uppercase tracking-wider text-content-tertiary mb-1">Payment Channel</p>
                    <p class="text-content">{{ $deposit->payment_mode }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wider text-content-tertiary mb-1">Status</p>
                    <span class="status-badge {{ $deposit->status === 'Processed' ? 'bg-success-light text-success' : 'bg-warning-light text-warning' }}">
                        {{ $deposit->status }}
                    </span>
                </div>
                @if(!empty($deposit->txn_id))
                    <div class="sm:col-span-2">
                        <p class="text-xs uppercase tracking-wider text-content-tertiary mb-1">Transaction ID</p>
                        <p class="text-content font-mono text-xs break-all">{{ $deposit->txn_id }}</p>
                    </div>
                @endif
            </div>

            {{-- Total --}}
            <div class="flex items-center justify-between pt-5">
                <p class="text-sm uppercase tracking-wider text-content-tertiary">Amount paid</p>
                <p class="text-2xl font-semibold text-content">
                    {{ $settings->currency ?? '$' }}{{ number_format($deposit->amount, 2) }}
                </p>
            </div>
        </div>

        {{-- Footer notice --}}
        <p class="text-xs text-content-tertiary leading-relaxed mb-6">
            Funds are held in the firm's client trust account and applied to your matter in accordance with the terms of your retainer agreement. This receipt is generated electronically and is valid without signature.
        </p>

        {{-- Actions --}}
        <div class="no-print flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between">
            <a href="{{ route('user.fee-requests') }}" class="text-sm text-content-secondary hover:text-primary inline-flex items-center gap-1">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to fee authorisations
            </a>
            <button type="button" onclick="window.print()" class="btn-primary px-6 py-2.5 inline-flex items-center justify-center">
                <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print receipt
            </button>
        </div>
    </div>
@endsection
