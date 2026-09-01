@extends('layouts.dashboard')
@section('title', $title)
@section('page-title', 'Client Portal')

@php
    // Pipeline stages drive both the hero stepper and the docket mini-progress bar.
    $stageOrder = [
        'new'              => ['label' => 'Filed',           'icon' => 'file-text'],
        'assigned'         => ['label' => 'Counsel Assigned','icon' => 'user-check'],
        'investigating'    => ['label' => 'Investigation',   'icon' => 'search'],
        'legal_action'     => ['label' => 'Legal Action',    'icon' => 'gavel'],
        'funds_recovered' => ['label' => 'Funds Recovered',  'icon' => 'landmark'],
        'withdrawal_ready' => ['label' => 'Cleared for Disbursement', 'icon' => 'banknote'],
    ];
    $stageKeys = array_keys($stageOrder);

    $currentStageIndex = null;
    if ($primaryCase) {
        $idx = array_search($primaryCase->status, $stageKeys, true);
        $currentStageIndex = $idx === false ? 0 : $idx;
    }

    $availableBalance = (float)(Auth::user()->account_bal ?? 0);
@endphp

@section('content')
    {{-- ============================================================
         1. Welcome / firm reassurance band
         ============================================================ --}}
    <div class="mb-6 pb-5 border-b border-border-muted">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
            <div>
                <p class="text-xs uppercase tracking-widest text-accent font-semibold mb-2">Client Portal</p>
                <h2 class="text-xl sm:text-2xl font-heading font-semibold text-content">
                    Welcome back, {{ Auth::user()->name }}.
                </h2>
                <p class="text-sm text-content-secondary mt-1 max-w-2xl">
                    Your recovery team is on the matter. This portal summarises the status of your active files, any actions required from you, and recent updates from your assigned counsel.
                </p>
            </div>
            <div class="flex flex-wrap items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-success-light text-success text-xs font-medium">
                    <i data-lucide="shield-check" class="w-3.5 h-3.5"></i>
                    Encrypted session
                </span>
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-surface-subtle text-content-secondary text-xs font-medium">
                    <i data-lucide="phone" class="w-3.5 h-3.5"></i>
                    On-call: 24 / 7
                </span>
            </div>
        </div>
        <div class="mt-4 h-px w-16 bg-accent"></div>
    </div>

    {{-- ============================================================
         2. Primary Matter hero card
         ============================================================ --}}
    @if($primaryCase)
        @php
            $recoveredPct = 0;
    if ($primaryCase->amount_lost > 0 && $primaryCase->amount_recovered > 0) {
        $recoveredPct = min(100, round(($primaryCase->amount_recovered / $primaryCase->amount_lost) * 100));
    } elseif ($currentStageIndex !== null && count($stageKeys) > 1) {
        // No monetary amounts recorded yet — derive progress from pipeline stage position
        $recoveredPct = round(($currentStageIndex / (count($stageKeys) - 1)) * 100);
    }
            $statusColorMap = [
                'primary' => 'bg-primary-light text-primary',
                'warning' => 'bg-warning-light text-warning',
                'success' => 'bg-success-light text-success',
                'info'    => 'bg-info-light text-info',
                'muted'   => 'bg-surface-subtle text-content-secondary',
            ];
            $heroBadgeClass = $statusColorMap[$primaryCase->status_color] ?? $statusColorMap['muted'];
        @endphp
        <div class="dash-card border-l-4 border-primary mb-6">
            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4 mb-6">
                <div>
                    <p class="text-xs uppercase tracking-wider text-content-tertiary font-medium mb-1">Primary active matter</p>
                    <div class="flex flex-wrap items-center gap-3">
                        <h3 class="text-lg font-heading font-semibold text-content font-mono">{{ $primaryCase->case_number }}</h3>
                        <span class="status-badge {{ $heroBadgeClass }}">{{ $primaryCase->status_label }}</span>
                        @if(!empty($primaryCase->priority))
                            <span class="status-badge bg-surface-subtle text-content-secondary">
                                <i data-lucide="flag" class="w-3 h-3 mr-1"></i>
                                Priority: {{ ucfirst($primaryCase->priority) }}
                            </span>
                        @endif
                    </div>
                    <p class="text-sm text-content-secondary mt-1">
                        {{ ucfirst(str_replace('_', ' ', $primaryCase->fraud_type)) }}
                        &middot; Filed {{ $primaryCase->created_at->format('M d, Y') }}
                    </p>
                </div>
                <a href="{{ route('user.cases.show', $primaryCase) }}" class="btn-primary self-start">
                    Open matter file
                    <i data-lucide="arrow-right" class="w-4 h-4 ml-1.5"></i>
                </a>
            </div>

            {{-- Recovery pipeline --}}
            <div class="bg-surface-subtle rounded-md p-4 sm:p-5 mb-5">
                <p class="text-xs uppercase tracking-wider text-content-tertiary font-medium mb-4">Recovery pipeline</p>
                <ol class="flex flex-col md:flex-row md:items-start gap-4 md:gap-0">
                    @foreach($stageOrder as $key => $stage)
                        @php
                            $idx = array_search($key, $stageKeys, true);
                            $isComplete = $currentStageIndex !== null && $idx < $currentStageIndex;
                            $isCurrent  = $currentStageIndex !== null && $idx === $currentStageIndex;
                            $isLast = $idx === count($stageKeys) - 1;

                            if ($isComplete) {
                                $dotClass = 'bg-primary text-white border-primary';
                                $labelClass = 'text-content';
                                $iconName = 'check';
                            } elseif ($isCurrent) {
                                $dotClass = 'bg-accent text-white border-accent ring-4 ring-accent/20';
                                $labelClass = 'text-content font-semibold';
                                $iconName = $stage['icon'];
                            } else {
                                $dotClass = 'bg-surface text-content-tertiary border-border';
                                $labelClass = 'text-content-tertiary';
                                $iconName = $stage['icon'];
                            }
                        @endphp
                        <li class="flex md:flex-col items-center md:items-center md:flex-1 gap-3 md:gap-2 relative">
                            <div class="flex md:flex-col items-center md:items-center md:w-full">
                                <span class="w-9 h-9 rounded-full border-2 flex items-center justify-center flex-shrink-0 {{ $dotClass }}">
                                    <i data-lucide="{{ $iconName }}" class="w-4 h-4"></i>
                                </span>
                                @if(!$isLast)
                                    <span class="hidden md:block flex-1 h-0.5 mx-1 {{ $isComplete ? 'bg-primary' : 'bg-border' }}"></span>
                                @endif
                            </div>
                            <span class="text-xs text-center {{ $labelClass }} md:mt-2 md:px-1 leading-tight">
                                {{ $stage['label'] }}
                            </span>
                        </li>
                    @endforeach
                </ol>
            </div>

            {{-- Hero metrics --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="rounded-md border border-border-muted p-4">
                    <p class="text-xs uppercase tracking-wider text-content-tertiary font-medium">Amount in dispute</p>
                    @php $amountLabel = $primaryCase->amount_lost_label; @endphp
                    <p class="mt-1 text-lg font-semibold text-content">
                        {{ $amountLabel && !is_numeric($amountLabel) ? $amountLabel : $currency . number_format($primaryCase->amount_lost, 2) }}
                    </p>
                </div>
                <div class="rounded-md border border-border-muted p-4">
                    <p class="text-xs uppercase tracking-wider text-content-tertiary font-medium">Recovered to date</p>
                    <p class="mt-1 text-lg font-semibold text-content">{{ $currency }}{{ number_format($primaryCase->amount_recovered, 2) }}</p>
                </div>
                <div class="rounded-md border border-border-muted p-4">
                    <p class="text-xs uppercase tracking-wider text-content-tertiary font-medium">Recovery progress</p>
                    <div class="mt-2 flex items-center gap-3">
                        <div class="flex-1 h-2 rounded-full bg-surface-subtle overflow-hidden">
                            <div class="h-full bg-primary" style="width: {{ $recoveredPct }}%"></div>
                        </div>
                        <span class="text-sm font-semibold text-content">{{ $recoveredPct }}%</span>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="dash-card border-l-4 border-accent mb-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h3 class="text-base font-heading font-semibold text-content">No active matter on file</h3>
                    <p class="text-sm text-content-secondary mt-1 max-w-xl">
                        File a new claim and our intake team will assign counsel to your matter within 24 hours. All submissions are reviewed under attorney-client confidentiality.
                    </p>
                </div>
                <a href="{{ route('user.cases.create') }}" class="btn-primary self-start">
                    File a new claim
                    <i data-lucide="arrow-right" class="w-4 h-4 ml-1.5"></i>
                </a>
            </div>
        </div>
    @endif

    {{-- ============================================================
         3. Action Required queue
         ============================================================ --}}
    @if($nextActionCount > 0)
        <div class="dash-card mb-6 border border-warning/30">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <span class="w-9 h-9 rounded-md bg-warning-light text-warning flex items-center justify-center">
                        <i data-lucide="alert-circle" class="w-4 h-4"></i>
                    </span>
                    <div>
                        <h3 class="text-sm font-heading font-semibold text-content">Action required from you</h3>
                        <p class="text-xs text-content-tertiary mt-0.5">Outstanding items must be resolved for your matter to proceed.</p>
                    </div>
                </div>
                <span class="status-badge bg-warning-light text-warning">{{ $nextActionCount }} pending</span>
            </div>

            <div class="divide-y divide-border-muted -mx-5">
                @foreach($pendingFeeRequests as $fee)
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 px-5 py-3.5">
                        <div class="flex items-start gap-3 min-w-0">
                            <span class="w-8 h-8 rounded-md bg-primary-light text-primary flex items-center justify-center flex-shrink-0">
                                <i data-lucide="receipt" class="w-4 h-4"></i>
                            </span>
                            <div class="min-w-0">
                                <p class="text-sm font-medium text-content truncate">{{ $fee->title }}</p>
                                <p class="text-xs text-content-tertiary mt-0.5">
                                    Matter
                                    <span class="font-mono">{{ optional($fee->fraudCase)->case_number ?? '—' }}</span>
                                    &middot; Issued {{ $fee->created_at->format('M d, Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between sm:justify-end gap-4">
                            <span class="text-sm font-semibold text-content">{{ $currency }}{{ number_format($fee->amount, 2) }}</span>
                            <a href="{{ route('deposits') }}" class="btn-primary text-xs whitespace-nowrap">
                                Authorize payment
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- ============================================================
         4. KPI strip (legal-language framing)
         ============================================================ --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="dash-card">
            <div class="flex items-center justify-between mb-3">
                <span class="text-content-tertiary text-xs font-medium uppercase tracking-wider">Matters on File</span>
                <span class="w-8 h-8 rounded-md bg-primary-light flex items-center justify-center">
                    <i data-lucide="folder" class="w-4 h-4 text-primary"></i>
                </span>
            </div>
            <p class="text-2xl font-semibold text-content font-heading">{{ $totalCases }}</p>
        </div>

        <div class="dash-card">
            <div class="flex items-center justify-between mb-3">
                <span class="text-content-tertiary text-xs font-medium uppercase tracking-wider">Active Matters</span>
                <span class="w-8 h-8 rounded-md bg-primary-light flex items-center justify-center">
                    <i data-lucide="gavel" class="w-4 h-4 text-primary"></i>
                </span>
            </div>
            <p class="text-2xl font-semibold text-content font-heading">{{ $activeCases }}</p>
        </div>

        <div class="dash-card relative overflow-hidden">
            <span class="absolute top-0 left-0 right-0 h-0.5 bg-accent"></span>
            <div class="flex items-center justify-between mb-3">
                <span class="text-content-tertiary text-xs font-medium uppercase tracking-wider">Recovered to Date</span>
                <span class="w-8 h-8 rounded-md bg-primary-light flex items-center justify-center">
                    <i data-lucide="scale" class="w-4 h-4 text-primary"></i>
                </span>
            </div>
            <p class="text-2xl font-semibold text-content font-heading">{{ $currency }}{{ number_format($totalRecovered, 2) }}</p>
            <p class="mt-1 text-xs text-content-tertiary">Lifetime, across all matters</p>
        </div>

        <div class="dash-card">
            <div class="flex items-center justify-between mb-3">
                <span class="text-content-tertiary text-xs font-medium uppercase tracking-wider">Cleared for Disbursement</span>
                <span class="w-8 h-8 rounded-md bg-primary-light flex items-center justify-center">
                    <i data-lucide="landmark" class="w-4 h-4 text-primary"></i>
                </span>
            </div>
            <p class="text-2xl font-semibold text-content font-heading">{{ $currency }}{{ number_format($availableBalance, 2) }}</p>
            <p class="mt-1 text-xs text-content-tertiary">Released after KYC verification</p>
        </div>
    </div>

    {{-- ============================================================
         5. Two-column workspace: Open Matters docket + side stack
         ============================================================ --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        {{-- Open Matters docket --}}
        <div class="lg:col-span-2 dash-card">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-sm font-heading font-semibold text-content">Open matters</h3>
                    <p class="text-xs text-content-tertiary mt-0.5">Most recent filings</p>
                </div>
                <a href="{{ route('user.cases.index') }}" class="text-xs text-primary hover:text-primary-dark font-medium">View docket &rarr;</a>
            </div>

            @if($recentCases->isEmpty())
                <div class="text-center py-10 border border-dashed border-border-muted rounded-md">
                    <i data-lucide="folder-open" class="w-10 h-10 text-content-tertiary mx-auto mb-3"></i>
                    <p class="text-sm font-medium text-content mb-1">No matters yet</p>
                    <p class="text-xs text-content-secondary mb-4 max-w-xs mx-auto">File your first claim to have counsel assigned.</p>
                    <a href="{{ route('user.cases.create') }}" class="btn-primary text-sm">File a claim</a>
                </div>
            @else
                <div class="overflow-x-auto -mx-5">
                    <table class="w-full">
                        <thead>
                            <tr class="border-y border-border-muted bg-surface-subtle">
                                <th class="table-th">Matter #</th>
                                <th class="table-th">Scheme</th>
                                <th class="table-th">Claim</th>
                                <th class="table-th">Recovery</th>
                                <th class="table-th">Status</th>
                                <th class="table-th">Filed</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border-muted">
                            @foreach($recentCases as $case)
                                @php
                                    $rowPct = 0;
                                    if ($case->amount_lost > 0 && $case->amount_recovered > 0) {
                                        $rowPct = min(100, round(($case->amount_recovered / $case->amount_lost) * 100));
                                    } elseif (count($stageKeys) > 1) {
                                        $rowIdx = array_search($case->status, $stageKeys, true);
                                        if ($rowIdx !== false) {
                                            $rowPct = round(($rowIdx / (count($stageKeys) - 1)) * 100);
                                        }
                                    }
                                    $rowBadgeClass = $statusColorMap[$case->status_color] ?? $statusColorMap['muted'] ?? 'bg-surface-subtle text-content-secondary';
                                @endphp
                                <tr class="hover:bg-surface-muted transition-colors cursor-pointer" onclick="window.location='{{ route('user.cases.show', $case) }}'">
                                    <td class="table-td font-mono font-medium text-content">{{ $case->case_number }}</td>
                                    <td class="table-td">{{ ucfirst(str_replace('_', ' ', $case->fraud_type)) }}</td>
                                    <td class="table-td">
                                        @php $rawLabel = $case->amount_lost_label; @endphp
                                        {{ $rawLabel && !is_numeric($rawLabel) ? $rawLabel : $currency . number_format($case->amount_lost, 2) }}
                                    </td>
                                    <td class="table-td">
                                        <div class="flex items-center gap-2 w-32">
                                            <div class="flex-1 h-1.5 rounded-full bg-surface-subtle overflow-hidden">
                                                <div class="h-full bg-primary" style="width: {{ $rowPct }}%"></div>
                                            </div>
                                            <span class="text-xs font-medium text-content-secondary">{{ $rowPct }}%</span>
                                        </div>
                                    </td>
                                    <td class="table-td">
                                        <span class="status-badge {{ $rowBadgeClass }}">{{ $case->status_label }}</span>
                                    </td>
                                    <td class="table-td text-content-tertiary whitespace-nowrap">{{ $case->created_at->format('M d, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        {{-- Side stack: Counsel + Docket Updates --}}
        <div class="space-y-6">
            {{-- Your Counsel --}}
            <div class="dash-card">
                <p class="text-xs uppercase tracking-wider text-content-tertiary font-medium mb-3">Your Counsel</p>
                @if($primaryCase && $primaryCase->assignedTo)
                    @php $counsel = $primaryCase->assignedTo; @endphp
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-primary text-white flex items-center justify-center text-base font-semibold ring-2 ring-accent/40 ring-offset-2 ring-offset-surface flex-shrink-0">
                            {{ strtoupper(substr($counsel->name ?? 'C', 0, 1)) }}
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm font-semibold text-content truncate">{{ $counsel->name ?? 'Lead Counsel' }}</p>
                            <p class="text-xs text-content-secondary">Lead Recovery Counsel</p>
                            <p class="text-xs text-content-tertiary mt-0.5">Matter <span class="font-mono">{{ $primaryCase->case_number }}</span></p>
                        </div>
                    </div>
                @else
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-md bg-primary-light text-primary flex items-center justify-center flex-shrink-0">
                            <i data-lucide="briefcase" class="w-5 h-5"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm font-semibold text-content">Recovery Operations Desk</p>
                            <p class="text-xs text-content-secondary">Awaiting counsel assignment</p>
                        </div>
                    </div>
                @endif

                <a href="{{ route('user.support-tickets.index') }}" class="btn-secondary w-full mt-4 text-sm">
                    <i data-lucide="lock" class="w-3.5 h-3.5 mr-1.5"></i>
                    Send a secure message
                </a>
            </div>

            {{-- Docket Updates --}}
            <div class="dash-card">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-heading font-semibold text-content">Docket updates</h3>
                </div>

                @if($caseActivity->isEmpty())
                    <div class="text-center py-6">
                        <i data-lucide="clock" class="w-7 h-7 text-content-tertiary mx-auto mb-2"></i>
                        <p class="text-xs text-content-secondary max-w-xs mx-auto">
                            No new updates. Your team will post developments here as they occur.
                        </p>
                    </div>
                @else
                    <ol class="relative border-l border-border-muted ml-2 space-y-4">
                        @foreach($caseActivity as $note)
                            <li class="pl-4">
                                <span class="absolute -left-1.5 mt-1.5 w-2.5 h-2.5 rounded-full bg-primary border-2 border-surface"></span>
                                <p class="text-xs text-content-tertiary">
                                    {{ $note->created_at->format('M d, Y') }}
                                    @if($note->fraudCase)
                                        &middot; <span class="font-mono">{{ $note->fraudCase->case_number }}</span>
                                    @endif
                                </p>
                                <p class="text-sm text-content mt-0.5 line-clamp-2">{{ \Illuminate\Support\Str::limit($note->note, 110) }}</p>
                            </li>
                        @endforeach
                    </ol>
                @endif
            </div>
        </div>
    </div>

    {{-- ============================================================
         6. Compliance / trust footer strip
         ============================================================ --}}
    <div class="dash-card bg-surface-subtle border-border-muted">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div class="flex items-start gap-3">
                <div class="w-9 h-9 rounded-md bg-primary-light text-primary flex items-center justify-center flex-shrink-0">
                    <i data-lucide="user-check" class="w-4 h-4"></i>
                </div>
                <div>
                    <p class="text-sm font-semibold text-content">KYC verified</p>
                    <p class="text-xs text-content-secondary mt-0.5">Funds are released only after identity verification, protecting recovered amounts from interception.</p>
                </div>
            </div>
            <div class="flex items-start gap-3">
                <div class="w-9 h-9 rounded-md bg-primary-light text-primary flex items-center justify-center flex-shrink-0">
                    <i data-lucide="vault" class="w-4 h-4"></i>
                </div>
                <div>
                    <p class="text-sm font-semibold text-content">Funds held in escrow</p>
                    <p class="text-xs text-content-secondary mt-0.5">Recovered amounts remain in segregated client escrow until cleared for disbursement to your verified account.</p>
                </div>
            </div>
            <div class="flex items-start gap-3">
                <div class="w-9 h-9 rounded-md bg-primary-light text-primary flex items-center justify-center flex-shrink-0">
                    <i data-lucide="scale" class="w-4 h-4"></i>
                </div>
                <div>
                    <p class="text-sm font-semibold text-content">AML / CFT reviewed</p>
                    <p class="text-xs text-content-secondary mt-0.5">Every disbursement is logged and reviewed against anti-money-laundering and counter-financing controls before release.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
