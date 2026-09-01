@extends('layouts.dashboard')
@section('title', $title)
@section('page-title', 'Authorise Fee')

@section('content')
    <div class="max-w-3xl mx-auto">
        {{-- Letterhead band --}}
        <div class="mb-6 pb-5 border-b border-border-muted">
            <p class="text-xs uppercase tracking-widest text-accent font-semibold mb-2">Client Portal</p>
            <h2 class="text-xl sm:text-2xl font-heading font-semibold text-content">Authorise fee</h2>
            <p class="text-sm text-content-secondary mt-1 max-w-2xl">
                Review the fee raised by your recovery team on the matter below and select an authorised payment channel.
                Funds are received into the firm's client trust account.
            </p>
            <div class="mt-4 h-px w-16 bg-accent"></div>
        </div>

        {{-- Alerts --}}
        @if(session('message'))
            <div class="mb-4 flex items-center gap-3 bg-danger-light border border-danger/20 text-danger rounded-md px-4 py-3 text-sm">
                <i data-lucide="alert-circle" class="w-4 h-4 flex-shrink-0"></i>{{ session('message') }}
            </div>
        @endif
        @if(session('success'))
            <div class="mb-4 flex items-center gap-3 bg-success-light border border-success/20 text-success rounded-md px-4 py-3 text-sm">
                <i data-lucide="check-circle-2" class="w-4 h-4 flex-shrink-0"></i>{{ session('success') }}
            </div>
        @endif

        {{-- Invoice summary card --}}
        <div class="dash-card mb-6">
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 pb-4 border-b border-border-muted">
                <div>
                    <p class="text-xs uppercase tracking-wider text-content-tertiary mb-1">Matter</p>
                    <a href="{{ route('user.cases.show', $case->id) }}" class="font-mono text-sm text-primary hover:text-primary-dark font-medium">
                        {{ $case->case_number }}
                    </a>
                    <h3 class="text-base font-heading font-semibold text-content mt-1">{{ $case->title ?? 'Recovery matter' }}</h3>
                </div>
                <div class="sm:text-right">
                    <p class="text-xs uppercase tracking-wider text-content-tertiary mb-1">Amount due</p>
                    <p class="text-2xl font-semibold text-content">
                        {{ $settings->currency ?? '$' }}{{ number_format($feeRequest->amount, 2) }}
                    </p>
                    <span class="status-badge bg-warning-light text-warning mt-1 inline-block">Pending Authorisation</span>
                </div>
            </div>

            <dl class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-3 text-sm">
                <div>
                    <dt class="text-content-tertiary">Fee Reference</dt>
                    <dd class="text-content font-medium">FR-{{ $feeRequest->id }}</dd>
                </div>
                <div>
                    <dt class="text-content-tertiary">Fee</dt>
                    <dd class="text-content font-medium">{{ $feeRequest->title }}</dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-content-tertiary">Description</dt>
                    <dd class="text-content-secondary">{{ $feeRequest->description ?? '—' }}</dd>
                </div>
                <div>
                    <dt class="text-content-tertiary">Issued</dt>
                    <dd class="text-content">{{ $feeRequest->created_at->format('M d, Y') }}</dd>
                </div>
                @if($feeRequest->requestedBy)
                    <div>
                        <dt class="text-content-tertiary">Authorised by</dt>
                        <dd class="text-content">{{ $feeRequest->requestedBy->name ?? 'Recovery Team' }}</dd>
                    </div>
                @endif
            </dl>
        </div>

        {{-- Payment channel picker --}}
        <div class="dash-card mb-6">
            <h3 class="text-base font-heading font-semibold text-content mb-1">Select payment channel</h3>
            <p class="text-sm text-content-secondary mb-4">All channels listed below are authorised for receipt into the firm's client trust account.</p>

            <form action="{{ route('newdeposit') }}" method="post" id="submitpaymentform" x-data="{ selectedMethod: '' }">
                @csrf
                <input type="hidden" name="amount" value="{{ $feeRequest->amount }}">
                <input type="hidden" name="payment_method" id="paymethod">
                <input type="hidden" name="fee_request_id" value="{{ $feeRequest->id }}">

                @if(count($dmethods) > 0)
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                        @foreach ($dmethods as $method)
                            <label class="relative cursor-pointer" onclick="checkpamethd('{{ $method->id }}')">
                                <input type="radio" name="payment_method_radio" id="{{ $method->id }}customCheck1" class="sr-only peer" data-method="{{ $method->name }}" value="{{ $method->id }}">
                                <div class="border border-border rounded-lg p-4 text-center transition-all duration-150 hover:border-primary peer-checked:border-primary peer-checked:bg-primary-light">
                                    <div class="flex items-center justify-center mb-3 h-10">
                                        @if (!empty($method->img_url))
                                            <img src="{{ $method->img_url }}" alt="{{ $method->name }}" class="h-8 w-auto">
                                        @else
                                            <i data-lucide="wallet" class="w-8 h-8 text-primary"></i>
                                        @endif
                                    </div>
                                    <p class="text-sm font-medium text-content">{{ $method->name }}</p>
                                </div>
                            </label>
                        @endforeach
                    </div>

                    <div class="mt-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <a href="{{ route('user.fee-requests') }}" class="text-sm text-content-secondary hover:text-primary inline-flex items-center gap-1">
                            <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to fee authorisations
                        </a>
                        <button type="submit" class="btn-primary px-8 py-3">Authorise &amp; Continue to Payment</button>
                    </div>
                    <input type="hidden" id="lastchosen" value="0">
                @else
                    <div class="rounded-md bg-surface-subtle border border-border-muted p-4 text-sm text-content-secondary">
                        No payment channel is currently enabled. Please contact your case manager to settle this fee.
                    </div>
                @endif
            </form>
        </div>

        {{-- Trust-account disclaimer --}}
        <p class="text-xs text-content-tertiary leading-relaxed">
            All payments are received into the firm's client trust account in accordance with the terms of your retainer agreement.
            Transactions are encrypted in transit, recorded against your matter file, and reconciled by our finance team.
            A formal receipt will be issued to you on confirmation of cleared funds.
        </p>
    </div>

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    @include('user.script')
@endpush
@endsection
