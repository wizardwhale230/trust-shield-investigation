@extends('layouts.dashboard')
@section('title', $title)
@section('page-title', 'Transaction History')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <h2 class="text-lg font-heading font-semibold text-content">Account Transaction History</h2>
            <p class="text-sm text-content-secondary mt-0.5">All your transaction history in one place.</p>
        </div>

        {{-- Alert messages --}}
        {{-- Alert messages handled globally in dashboard layout --}}

        {{-- Tabs --}}
        <div x-data="{ tab: 'deposits' }">
            <div class="flex gap-1 border-b border-border-muted mb-6">
                <button @click="tab = 'deposits'" :class="tab === 'deposits' ? 'border-primary text-primary' : 'border-transparent text-content-secondary hover:text-content'" class="flex items-center gap-2 px-4 py-2.5 text-sm font-medium border-b-2 transition-colors">
                    <i data-lucide="arrow-down-circle" class="w-4 h-4"></i> Deposits
                </button>
                <button @click="tab = 'withdrawals'" :class="tab === 'withdrawals' ? 'border-primary text-primary' : 'border-transparent text-content-secondary hover:text-content'" class="flex items-center gap-2 px-4 py-2.5 text-sm font-medium border-b-2 transition-colors">
                    <i data-lucide="arrow-up-circle" class="w-4 h-4"></i> Disbursement ledger
                </button>
                <button @click="tab = 'others'" :class="tab === 'others' ? 'border-primary text-primary' : 'border-transparent text-content-secondary hover:text-content'" class="flex items-center gap-2 px-4 py-2.5 text-sm font-medium border-b-2 transition-colors">
                    <i data-lucide="repeat" class="w-4 h-4"></i> Others
                </button>
            </div>

            {{-- Deposits --}}
            <div x-show="tab === 'deposits'" class="dash-card">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-border-muted">
                                <th class="table-th">Amount</th>
                                <th class="table-th">Payment Mode</th>
                                <th class="table-th">Status</th>
                                <th class="table-th">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border-muted">
                            @forelse ($deposits as $deposit)
                                <tr>
                                    <td class="table-td font-medium text-content">{{ $settings->currency }}{{ number_format((float)$deposit->amount, 2) }}</td>
                                    <td class="table-td">{{ $deposit->payment_mode }}</td>
                                    <td class="table-td">
                                        @if ($deposit->status == 'Processed')
                                            <span class="status-badge bg-success-light text-success">{{ $deposit->status }}</span>
                                        @else
                                            <span class="status-badge bg-warning-light text-warning">{{ $deposit->status }}</span>
                                        @endif
                                    </td>
                                    <td class="table-td text-content-tertiary">{{ \Carbon\Carbon::parse($deposit->created_at)->format('M d, Y h:i A') }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="table-td text-center text-content-tertiary py-8">No deposit records found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Disbursement ledger --}}
            <div x-show="tab === 'withdrawals'" x-cloak class="dash-card">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-border-muted">
                                <th class="table-th">Amount</th>
                                <th class="table-th">Gross (incl. fees)</th>
                                <th class="table-th">Channel</th>
                                <th class="table-th">Status</th>
                                <th class="table-th">Instructed</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border-muted">
                            @forelse ($withdrawals as $withdrawal)
                                @php
                                    $isDisbursed = $withdrawal->status == 'Processed';
                                    $statusLabel = $isDisbursed ? 'Disbursed' : 'Queued for payout';
                                @endphp
                                <tr>
                                    <td class="table-td font-medium text-content">{{ $settings->currency }}{{ number_format((float)$withdrawal->amount, 2) }}</td>
                                    <td class="table-td">{{ $settings->currency }}{{ number_format((float)$withdrawal->to_deduct, 2) }}</td>
                                    <td class="table-td">{{ $withdrawal->payment_mode }}</td>
                                    <td class="table-td">
                                        @if ($isDisbursed)
                                            <span class="status-badge bg-success-light text-success">{{ $statusLabel }}</span>
                                        @else
                                            <span class="status-badge bg-warning-light text-warning">{{ $statusLabel }}</span>
                                        @endif
                                    </td>
                                    <td class="table-td text-content-tertiary">{{ \Carbon\Carbon::parse($withdrawal->created_at)->format('M d, Y h:i A') }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="table-td text-center text-content-tertiary py-8">No disbursements have been issued on your case file yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Others --}}
            <div x-show="tab === 'others'" x-cloak class="dash-card">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-border-muted">
                                <th class="table-th">Amount</th>
                                <th class="table-th">Type</th>
                                <th class="table-th">Narration</th>
                                <th class="table-th">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border-muted">
                            @forelse ($t_history as $history)
                                <tr>
                                    <td class="table-td font-medium text-content">{{ $settings->currency }}{{ number_format((float)$history->amount, 2) }}</td>
                                    <td class="table-td">{{ $history->type }}</td>
                                    <td class="table-td">{{ $history->plan }}</td>
                                    <td class="table-td text-content-tertiary">{{ \Carbon\Carbon::parse($history->created_at)->format('M d, Y h:i A') }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="table-td text-center text-content-tertiary py-8">No other transactions found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
