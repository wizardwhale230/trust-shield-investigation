@extends('layouts.dashboard')
@section('title', 'Matter ' . $case->case_number)
@section('page-title', 'Matter File')

@php
    $statusColorMap = [
        'primary' => 'bg-primary-light text-primary',
        'warning' => 'bg-warning-light text-warning',
        'success' => 'bg-success-light text-success',
        'info'    => 'bg-info-light text-info',
        'muted'   => 'bg-surface-subtle text-content-secondary',
    ];
    $headerBadgeClass = $statusColorMap[$case->status_color] ?? $statusColorMap['muted'];
@endphp

@section('content')
    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm mb-6">
        <a href="{{ route('user.cases.index') }}" class="text-content-tertiary hover:text-content transition-colors">Matters</a>
        <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-content-tertiary"></i>
        <span class="text-content font-medium font-mono">{{ $case->case_number }}</span>
    </nav>

    {{-- Matter header --}}
    <div class="dash-card border-l-4 border-primary mb-6">
        <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
            <div>
                <p class="text-xs uppercase tracking-widest text-accent font-semibold mb-2">Matter file</p>
                <div class="flex flex-wrap items-center gap-3 mb-1">
                    <h2 class="text-xl font-heading font-semibold text-content font-mono">{{ $case->case_number }}</h2>
                    <span class="status-badge {{ $headerBadgeClass }}">{{ $case->status_label }}</span>
                    @if(!empty($case->priority))
                        <span class="status-badge bg-surface-subtle text-content-secondary">
                            <i data-lucide="flag" class="w-3 h-3 mr-1"></i>
                            Priority: {{ ucfirst($case->priority) }}
                        </span>
                    @endif
                </div>
                <p class="text-sm text-content-secondary">
                    {{ ucfirst(str_replace('_', ' ', $case->fraud_type)) }}
                    &middot; Filed {{ $case->created_at->format('F d, Y \a\t g:i A') }}
                </p>
            </div>
            @if($case->assignedTo)
                <div class="flex items-center gap-3 bg-surface-subtle border border-border-muted px-4 py-3 rounded-md self-start">
                    <img src="{{ $case->assignedTo->photo_url }}" alt="{{ $case->assignedTo->full_name }}"
                         class="w-10 h-10 rounded-full object-cover ring-2 ring-accent/40 ring-offset-2 ring-offset-surface flex-shrink-0">
                    <div>
                        <p class="text-xs text-content-tertiary uppercase tracking-wider font-medium">Lead Counsel</p>
                        <p class="text-sm font-semibold text-content">{{ $case->assignedTo->full_name }}</p>
                        <p class="text-xs text-content-secondary">{{ $case->assignedTo->job_title }}</p>
                    </div>
                    <a href="{{ route('user.cases.member', $case) }}"
                       class="text-xs text-primary hover:text-primary-dark font-medium whitespace-nowrap flex-shrink-0">
                        View profile &rarr;
                    </a>
                </div>
            @endif
        </div>
        <div class="mt-4 h-px w-16 bg-accent"></div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Main Content --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Matter Overview --}}
            <div class="dash-card">
                <h3 class="text-sm font-heading font-semibold text-content mb-4">Matter overview</h3>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <p class="text-xs text-content-tertiary uppercase tracking-wider mb-1">Scheme type</p>
                        <p class="text-sm font-medium text-content">{{ ucfirst(str_replace('_', ' ', $case->fraud_type)) }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-content-tertiary uppercase tracking-wider mb-1">Timeframe</p>
                        <p class="text-sm font-medium text-content">{{ ucfirst(str_replace('_', ' ', $case->timeframe)) }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-content-tertiary uppercase tracking-wider mb-1">Amount in dispute</p>
                        <p class="text-sm font-semibold text-content">{{ $currency }}{{ number_format($case->amount_lost, 2) }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-content-tertiary uppercase tracking-wider mb-1">Recovered to date</p>
                        <p class="text-sm font-semibold {{ $case->amount_recovered > 0 ? 'text-success' : 'text-content-tertiary' }}">
                            {{ $case->amount_recovered > 0 ? $currency . number_format($case->amount_recovered, 2) : 'Pending' }}
                        </p>
                    </div>
                </div>
                @if($case->description)
                    <div class="pt-4 border-t border-border-muted">
                        <p class="text-xs text-content-tertiary uppercase tracking-wider mb-2">Statement of facts</p>
                        <p class="text-sm text-content-secondary leading-relaxed whitespace-pre-line">{{ $case->description }}</p>
                    </div>
                @endif
            </div>

            {{-- Docket Updates --}}
            <div class="dash-card">
                <h3 class="text-sm font-heading font-semibold text-content mb-4">Docket updates</h3>

                @if($notes->isEmpty())
                    <div class="text-center py-6">
                        <i data-lucide="message-square" class="w-8 h-8 text-content-tertiary mx-auto mb-2"></i>
                        <p class="text-sm text-content-secondary">No updates yet. Counsel will post developments here as your matter progresses.</p>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($notes as $note)
                            <div class="relative pl-6 pb-4 {{ !$loop->last ? 'border-l border-border-muted' : '' }}">
                                <div class="absolute left-0 top-0 -translate-x-1/2 w-2.5 h-2.5 rounded-full {{ $note->author_type === 'App\\Models\\Admin' ? 'bg-primary' : 'bg-content-tertiary' }} border-2 border-surface"></div>
                                <div class="bg-surface-muted rounded-md p-3">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-xs font-medium {{ $note->author_type === 'App\\Models\\Admin' ? 'text-primary' : 'text-content-secondary' }}">
                                            {{ $note->author_type === 'App\\Models\\Admin' ? ($note->author->name ?? 'Recovery Counsel') : 'You' }}
                                        </span>
                                        <span class="text-xs text-content-tertiary">{{ $note->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-sm text-content-secondary">{{ $note->note }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Documents --}}
            <div class="dash-card">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-heading font-semibold text-content">Evidence &amp; documents</h3>
                    <button onclick="document.getElementById('docUploadForm').classList.toggle('hidden')" class="btn-ghost py-1 px-2 text-xs">
                        <i data-lucide="plus" class="w-3.5 h-3.5 mr-1 inline"></i>Upload
                    </button>
                </div>

                {{-- Upload form --}}
                <form id="docUploadForm" method="POST" action="{{ route('user.cases.upload', $case) }}" enctype="multipart/form-data" class="hidden mb-4 p-4 bg-surface-muted rounded-md border border-border-muted">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Select File</label>
                        <input type="file" name="document" required class="input-field text-sm file:mr-3 file:py-1 file:px-3 file:border-0 file:text-sm file:font-medium file:bg-primary-light file:text-primary file:rounded-md file:cursor-pointer">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description (optional)</label>
                        <input type="text" name="description" class="input-field" placeholder="e.g., Bank statement, Chat screenshot">
                    </div>
                    <button type="submit" class="btn-primary text-sm">Upload Document</button>
                </form>

                @if($documents->isEmpty())
                    <div class="text-center py-6">
                        <i data-lucide="file-text" class="w-8 h-8 text-content-tertiary mx-auto mb-2"></i>
                        <p class="text-sm text-content-secondary">No evidence on file. Upload supporting materials to strengthen your matter.</p>
                    </div>
                @else
                    <div class="space-y-2">
                        @foreach($documents as $doc)
                            <div class="flex items-center gap-3 p-3 rounded-md border border-border-muted hover:border-border transition-colors">
                                <div class="w-9 h-9 rounded bg-surface-subtle flex items-center justify-center flex-shrink-0">
                                    @if(in_array($doc->file_type, ['image/jpeg','image/png','image/gif','image/webp']))
                                        <i data-lucide="image" class="w-4 h-4 text-primary"></i>
                                    @elseif($doc->file_type === 'application/pdf')
                                        <i data-lucide="file-text" class="w-4 h-4 text-danger"></i>
                                    @else
                                        <i data-lucide="file" class="w-4 h-4 text-content-tertiary"></i>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-content truncate">{{ $doc->original_name }}</p>
                                    <p class="text-xs text-content-tertiary">
                                        {{ $doc->description ?? '' }}
                                        @if($doc->description) &middot; @endif
                                        {{ number_format($doc->file_size / 1024, 0) }} KB &middot;
                                        {{ $doc->created_at->format('M d, Y') }}
                                    </p>
                                </div>
                                <a href="{{ route('user.cases.document.download', [$case, $doc]) }}" class="btn-ghost py-1 px-2 text-xs flex-shrink-0">
                                    <i data-lucide="download" class="w-3.5 h-3.5"></i>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="space-y-6">
            {{-- Assigned Attorney Card --}}
            @if($case->assignedTo)
                <div class="dash-card">
                    <h3 class="text-sm font-heading font-semibold text-content mb-4">Your assigned attorney</h3>
                    <div class="flex items-center gap-3 mb-3">
                        <img src="{{ $case->assignedTo->photo_url }}" alt="{{ $case->assignedTo->full_name }}"
                             class="w-14 h-14 rounded-full object-cover ring-2 ring-accent/30 flex-shrink-0">
                        <div>
                            <p class="font-semibold text-content">{{ $case->assignedTo->full_name }}</p>
                            <p class="text-xs text-content-secondary">{{ $case->assignedTo->job_title }}</p>
                            @if($case->assignedTo->specialization)
                                <p class="text-xs text-accent font-medium mt-0.5">{{ $case->assignedTo->specialization }}</p>
                            @endif
                        </div>
                    </div>
                    <a href="{{ route('user.cases.member', $case) }}"
                       class="block w-full text-center text-sm text-primary hover:text-primary-dark font-medium py-2 border border-border rounded-md hover:bg-primary-light transition-colors">
                        View Full Profile &rarr;
                    </a>
                </div>
            @else
                <div class="dash-card">
                    <h3 class="text-sm font-heading font-semibold text-content mb-3">Your assigned attorney</h3>
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-full bg-surface-subtle border border-border flex items-center justify-center flex-shrink-0">
                            <i data-lucide="user" class="w-4 h-4 text-content-tertiary"></i>
                        </div>
                        <p class="text-sm text-content-secondary leading-snug">
                            Your case is under review. An attorney will be assigned shortly.
                        </p>
                    </div>
                </div>
            @endif
            {{-- Recovery Pipeline --}}
            <div class="dash-card">
                <h3 class="text-sm font-heading font-semibold text-content mb-4">Recovery pipeline</h3>
                @php
                    $stages = [
                        'new'              => ['label' => 'Filed',                    'icon' => 'file-text'],
                        'assigned'         => ['label' => 'Counsel Assigned',         'icon' => 'user-check'],
                        'investigating'    => ['label' => 'Investigation',            'icon' => 'search'],
                        'legal_action'     => ['label' => 'Legal Action',             'icon' => 'gavel'],
                        'funds_recovered' => ['label' => 'Funds Recovered',           'icon' => 'landmark'],
                        'withdrawal_ready' => ['label' => 'Cleared for Disbursement', 'icon' => 'banknote'],
                        'closed'           => ['label' => 'Matter Closed',            'icon' => 'check-circle-2'],
                    ];
                    $stageKeys = array_keys($stages);
                    $current = array_search($case->status, $stageKeys, true);
                    if ($current === false) { $current = 0; }
                @endphp
                <ol class="space-y-0">
                    @foreach($stages as $key => $stage)
                        @php
                            $idx = array_search($key, $stageKeys, true);
                            $isComplete = $idx < $current;
                            $isCurrent  = $idx === $current;
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
                            $connectorClass = $isComplete ? 'bg-primary' : 'bg-border-muted';
                        @endphp
                        <li class="flex items-start gap-3">
                            <div class="flex flex-col items-center flex-shrink-0">
                                <span class="w-8 h-8 rounded-full border-2 flex items-center justify-center {{ $dotClass }}">
                                    <i data-lucide="{{ $iconName }}" class="w-3.5 h-3.5"></i>
                                </span>
                                @if(!$isLast)
                                    <span class="w-0.5 h-6 {{ $connectorClass }}"></span>
                                @endif
                            </div>
                            <span class="text-sm {{ $labelClass }} pt-1.5 pb-2">{{ $stage['label'] }}</span>
                        </li>
                    @endforeach
                </ol>
            </div>

            {{-- Fee Authorisations for this matter --}}
            <div class="dash-card">
                <h3 class="text-sm font-heading font-semibold text-content mb-4">Fee authorisations</h3>
                @if($feeRequests->isEmpty())
                    <p class="text-sm text-content-secondary">No fees raised on this matter.</p>
                @else
                    <div class="space-y-3">
                        @foreach($feeRequests as $fee)
                            <div class="p-3 rounded-md border border-border-muted">
                                <div class="flex items-start justify-between mb-1 gap-2">
                                    <p class="text-sm font-medium text-content">{{ $fee->title }}</p>
                                    <span class="status-badge whitespace-nowrap
                                        {{ $fee->status === 'paid' ? 'bg-success-light text-success' : ($fee->status === 'cancelled' ? 'bg-surface-subtle text-content-tertiary' : 'bg-warning-light text-warning') }}
                                    ">{{ ucfirst($fee->status) }}</span>
                                </div>
                                <p class="text-sm font-semibold text-content">{{ $currency }}{{ number_format($fee->amount, 2) }}</p>
                                @if($fee->description)
                                    <p class="text-xs text-content-tertiary mt-1">{{ $fee->description }}</p>
                                @endif
                                @if($fee->status === 'pending')
                                    <a href="{{ route('deposits') }}" class="inline-block mt-2 text-xs text-primary hover:text-primary-dark font-medium">Authorize payment &rarr;</a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
