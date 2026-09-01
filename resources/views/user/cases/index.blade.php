@extends('layouts.dashboard')
@section('title', $title)
@section('page-title', 'Matters')

@section('content')
    {{-- Header band --}}
    <div class="mb-6 pb-5 border-b border-border-muted">
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
            <div>
                <p class="text-xs uppercase tracking-widest text-accent font-semibold mb-2">Client Portal</p>
                <h2 class="text-xl sm:text-2xl font-heading font-semibold text-content">Matters on file</h2>
                <p class="text-sm text-content-secondary mt-1 max-w-2xl">Every claim you have filed with the firm, with current status and recovery progress.</p>
            </div>
            <a href="{{ route('user.cases.create') }}" class="btn-primary">
                <i data-lucide="plus" class="w-4 h-4 mr-1.5"></i>
                File a new claim
            </a>
        </div>
        <div class="mt-4 h-px w-16 bg-accent"></div>
    </div>

    {{-- Filters --}}
    <div class="dash-card mb-6" x-data="{ show: false }">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
                <i data-lucide="filter" class="w-4 h-4 text-content-tertiary"></i>
                <span class="text-sm font-medium text-content-secondary">Filter matters</span>
            </div>
            <button @click="show = !show" class="btn-ghost py-1 px-2 text-xs">
                <span x-text="show ? 'Hide' : 'Show'"></span>
            </button>
        </div>
        <div x-show="show" x-transition class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-4" x-cloak>
            <form method="GET" action="{{ route('user.cases.index') }}" class="contents" id="filterForm">
                <div>
                    <label class="form-label">Status</label>
                    <select name="status" class="input-field" onchange="document.getElementById('filterForm').submit()">
                        <option value="">All Statuses</option>
                        @foreach(['new','assigned','investigating','legal_action','funds_recovered','withdrawal_ready','closed'] as $s)
                            <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>
                                {{ ucwords(str_replace('_', ' ', $s)) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label">Fraud Type</label>
                    <select name="fraud_type" class="input-field" onchange="document.getElementById('filterForm').submit()">
                        <option value="">All Types</option>
                        @foreach(['cryptocurrency','forex','binary_options','romance','investment','other'] as $t)
                            <option value="{{ $t }}" {{ request('fraud_type') == $t ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_', ' ', $t)) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end">
                    <a href="{{ route('user.cases.index') }}" class="btn-ghost text-sm">Clear Filters</a>
                </div>
            </form>
        </div>
    </div>

    {{-- Cases Table --}}
    <div class="dash-card">
        @if($cases->isEmpty())
            <div class="text-center py-12">
                <div class="w-14 h-14 rounded-full bg-primary-light flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="folder-open" class="w-7 h-7 text-primary"></i>
                </div>
                <h3 class="text-base font-heading font-semibold text-content mb-1">No matters on file yet</h3>
                <p class="text-sm text-content-secondary mb-5 max-w-md mx-auto">File your first claim and our intake team will assign counsel to your matter within 24 hours.</p>
                <a href="{{ route('user.cases.create') }}" class="btn-primary">File a claim</a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-y border-border-muted bg-surface-subtle">
                            <th class="table-th">Matter #</th>
                            <th class="table-th">Scheme</th>
                            <th class="table-th">Claim</th>
                            <th class="table-th hidden sm:table-cell">Recovered</th>
                            <th class="table-th">Status</th>
                            <th class="table-th hidden md:table-cell">Filed</th>
                            <th class="table-th"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border-muted">
                        @foreach($cases as $case)
                            <tr class="hover:bg-surface-muted transition-colors">
                                <td class="table-td font-mono font-medium text-content">{{ $case->case_number }}</td>
                                <td class="table-td">{{ ucfirst(str_replace('_', ' ', $case->fraud_type)) }}</td>
                                <td class="table-td">{{ $currency }}{{ number_format($case->amount_lost, 2) }}</td>
                                <td class="table-td hidden sm:table-cell">
                                    @if($case->amount_recovered > 0)
                                        <span class="text-success font-medium">{{ $currency }}{{ number_format($case->amount_recovered, 2) }}</span>
                                    @else
                                        <span class="text-content-tertiary">&mdash;</span>
                                    @endif
                                </td>
                                <td class="table-td">
                                    <span class="status-badge
                                        @switch($case->status_color)
                                            @case('primary') bg-primary-light text-primary @break
                                            @case('warning') bg-warning-light text-warning @break
                                            @case('success') bg-success-light text-success @break
                                            @case('info') bg-info-light text-info @break
                                            @default bg-surface-subtle text-content-secondary
                                        @endswitch
                                    ">{{ $case->status_label }}</span>
                                </td>
                                <td class="table-td hidden md:table-cell text-content-tertiary">{{ $case->created_at->format('M d, Y') }}</td>
                                <td class="table-td text-right">
                                    <a href="{{ route('user.cases.show', $case) }}" class="btn-ghost py-1 px-2 text-xs">
                                        View <i data-lucide="chevron-right" class="w-3 h-3 ml-0.5 inline"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($cases->hasPages())
                <div class="mt-4 pt-4 border-t border-border-muted">
                    {{ $cases->withQueryString()->links() }}
                </div>
            @endif
        @endif
    </div>
@endsection
