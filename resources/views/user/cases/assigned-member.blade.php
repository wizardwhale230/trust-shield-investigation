@extends('layouts.dashboard')
@section('title', $member->full_name . ' — Your Attorney')
@section('page-title', 'Attorney Profile')

@section('content')
    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm mb-6">
        <a href="{{ route('user.cases.index') }}" class="text-content-tertiary hover:text-content transition-colors">Matters</a>
        <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-content-tertiary"></i>
        <a href="{{ route('user.cases.show', $case) }}" class="text-content-tertiary hover:text-content transition-colors font-mono">{{ $case->case_number }}</a>
        <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-content-tertiary"></i>
        <span class="text-content font-medium">Attorney Profile</span>
    </nav>

    <div class="max-w-2xl">
        {{-- Profile card --}}
        <div class="dash-card mb-6">
            <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6">
                {{-- Photo --}}
                <img src="{{ $member->photo_url }}"
                     alt="{{ $member->full_name }}"
                     class="w-28 h-28 rounded-full object-cover ring-4 ring-accent/30 flex-shrink-0">

                {{-- Name / title --}}
                <div class="text-center sm:text-left">
                    <p class="text-xs uppercase tracking-widest text-accent font-semibold mb-1">Lead Counsel — Case {{ $case->case_number }}</p>
                    <h1 class="text-2xl font-heading font-bold text-content mb-1">{{ $member->full_name }}</h1>
                    <p class="text-base text-content-secondary font-medium mb-2">{{ $member->job_title }}</p>

                    <div class="flex flex-wrap justify-center sm:justify-start gap-2 mt-2">
                        @if($member->specialization)
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-accent-light text-accent border border-accent/20">
                                <i data-lucide="award" class="w-3 h-3"></i>
                                {{ $member->specialization }}
                            </span>
                        @endif
                        @if($member->years_experience)
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-primary-light text-primary border border-primary/20">
                                <i data-lucide="briefcase" class="w-3 h-3"></i>
                                {{ $member->years_experience }}+ years experience
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Divider --}}
            <div class="my-5 h-px bg-border-muted"></div>

            {{-- Bio --}}
            @if($member->bio)
                <div class="mb-5">
                    <h2 class="text-xs uppercase tracking-wider text-content-tertiary font-semibold mb-2">About</h2>
                    <p class="text-sm text-content-secondary leading-relaxed whitespace-pre-line">{{ $member->bio }}</p>
                </div>
            @endif

            {{-- Contact details (only when provided) --}}
            @if($member->email || $member->phone)
                <div>
                    <h2 class="text-xs uppercase tracking-wider text-content-tertiary font-semibold mb-3">Contact</h2>
                    <div class="space-y-2">
                        @if($member->email)
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-md bg-surface-subtle flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="mail" class="w-4 h-4 text-content-tertiary"></i>
                                </div>
                                <a href="mailto:{{ $member->email }}"
                                   class="text-sm text-primary hover:text-primary-dark font-medium">
                                    {{ $member->email }}
                                </a>
                            </div>
                        @endif
                        @if($member->phone)
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-md bg-surface-subtle flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="phone" class="w-4 h-4 text-content-tertiary"></i>
                                </div>
                                <a href="tel:{{ $member->phone }}"
                                   class="text-sm text-primary hover:text-primary-dark font-medium">
                                    {{ $member->phone }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        {{-- Back link --}}
        <a href="{{ route('user.cases.show', $case) }}"
           class="inline-flex items-center gap-2 text-sm text-content-secondary hover:text-content transition-colors font-medium">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            Back to Matter {{ $case->case_number }}
        </a>
    </div>
@endsection
