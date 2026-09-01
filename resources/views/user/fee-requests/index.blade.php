@extends('layouts.dashboard')
@section('title', $title)
@section('page-title', 'Fee Authorisations')

@section('content')
    {{-- Header band --}}
    <div class="mb-6 pb-5 border-b border-border-muted">
        <p class="text-xs uppercase tracking-widest text-accent font-semibold mb-2">Client Portal</p>
        <h2 class="text-xl sm:text-2xl font-heading font-semibold text-content">Fee authorisations</h2>
        <p class="text-sm text-content-secondary mt-1 max-w-2xl">Fees raised by your recovery team to advance your matter. Each item is itemised and tied to a specific matter on file.</p>
        <div class="mt-4 h-px w-16 bg-accent"></div>
    </div>

    <div class="dash-card">
        @if($feeRequests->isEmpty())
            <div class="text-center py-12">
                <div class="w-14 h-14 rounded-full bg-primary-light flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="receipt" class="w-7 h-7 text-primary"></i>
                </div>
                <h3 class="text-base font-heading font-semibold text-content mb-1">No fee authorisations outstanding</h3>
                <p class="text-sm text-content-secondary max-w-md mx-auto">When your team raises a fee to advance a matter, it will appear here for your review and authorisation.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-y border-border-muted bg-surface-subtle">
                            <th class="table-th">Matter #</th>
                            <th class="table-th">Fee</th>
                            <th class="table-th hidden sm:table-cell">Description</th>
                            <th class="table-th">Amount</th>
                            <th class="table-th">Status</th>
                            <th class="table-th hidden md:table-cell">Issued</th>
                            <th class="table-th"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border-muted">
                        @foreach($feeRequests as $fee)
                            <tr class="hover:bg-surface-muted transition-colors">
                                <td class="table-td">
                                    <a href="{{ route('user.cases.show', $fee->case_id) }}" class="text-primary hover:text-primary-dark font-mono font-medium">
                                        {{ $fee->fraudCase->case_number }}
                                    </a>
                                </td>
                                <td class="table-td font-medium text-content">{{ $fee->title }}</td>
                                <td class="table-td hidden sm:table-cell text-content-secondary">{{ Str::limit($fee->description, 50) }}</td>
                                <td class="table-td font-semibold text-content">{{ $currency }}{{ number_format($fee->amount, 2) }}</td>
                                <td class="table-td">
                                    <span class="status-badge
                                        {{ $fee->status === 'paid' ? 'bg-success-light text-success' : ($fee->status === 'cancelled' ? 'bg-surface-subtle text-content-tertiary' : 'bg-warning-light text-warning') }}
                                    ">{{ ucfirst($fee->status) }}</span>
                                </td>
                                <td class="table-td hidden md:table-cell text-content-tertiary">{{ $fee->created_at->format('M d, Y') }}</td>
                                <td class="table-td text-right">
                                    @if($fee->status === 'pending')
                                        <a href="{{ route('deposits', ['fee_request_id' => $fee->id]) }}" class="btn-primary py-1 px-3 text-xs whitespace-nowrap">Authorize</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($feeRequests->hasPages())
                <div class="mt-4 pt-4 border-t border-border-muted">
                    {{ $feeRequests->links() }}
                </div>
            @endif
        @endif
    </div>
@endsection
