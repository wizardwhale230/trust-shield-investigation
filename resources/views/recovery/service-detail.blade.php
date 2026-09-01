@extends('layouts.recovery')

@section('title', $service['name'] . ' | ' . $settings->site_name . ' Solicitors')
@section('description', $service['description'])

@section('content')

    {{-- Page Header --}}
    @php($heroImage = $service['hero_image'] ?? 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&w=1920&q=80')
    <section class="relative bg-surface-muted border-b border-border-muted overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $heroImage }}');"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-surface/95 via-surface/85 to-surface/40"></div>
        <div class="relative section-container py-16 md:py-24">
            <x-breadcrumb :items="[
                ['label' => 'Services', 'url' => route('recovery.services')],
                ['label' => $service['name'], 'url' => null],
            ]" />
            <div class="flex items-center gap-3 mb-4">
                <i data-lucide="{{ $service['icon'] }}" class="w-6 h-6 text-primary"></i>
                <p class="eyebrow">Our Services</p>
            </div>
            <h1 class="text-3xl md:text-4xl">{{ $service['name'] }}</h1>
            @if(!empty($service['intro']))
                <p class="mt-5 max-w-3xl text-lg text-content-secondary leading-relaxed">{{ $service['intro'] }}</p>
            @endif
        </div>
    </section>

    {{-- Stats Strip --}}
    @if(!empty($service['stats']))
    <section class="bg-surface border-b border-border-muted">
        <div class="section-container py-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                @foreach($service['stats'] as $stat)
                    <x-stat-tile :value="$stat['value']" :label="$stat['label']" :icon="$stat['icon'] ?? null" />
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Content --}}
    <section>
        <div class="section-container section-padding">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 lg:gap-16">
                {{-- Main Content --}}
                <div class="lg:col-span-2">
                    @if(!empty($service['warning_signs']))
                    <div class="mb-10 rounded-xl border border-red-200 bg-red-50/60 p-6">
                        <div class="flex items-center gap-2 mb-4">
                            <i data-lucide="alert-triangle" class="w-5 h-5 text-red-600"></i>
                            <h2 class="text-lg font-semibold text-red-900 m-0">Warning Signs to Watch For</h2>
                        </div>
                        <ul class="space-y-2.5">
                            @foreach($service['warning_signs'] as $sign)
                            <li class="flex items-start gap-3 text-sm text-red-900/90 leading-relaxed">
                                <i data-lucide="x-circle" class="w-4 h-4 text-red-600 flex-shrink-0 mt-0.5"></i>
                                <span>{{ $sign }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if(!empty($service['process']))
                    <div class="mb-10">
                        <h2 class="text-2xl font-semibold mb-6">Our Recovery Process</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($service['process'] as $i => $step)
                                <x-process-step
                                    :number="$i + 1"
                                    :icon="$step['icon'] ?? 'check'"
                                    :title="$step['title']"
                                    :desc="$step['desc']" />
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="prose-content">
                        {!! $service['content'] !!}
                    </div>

                    @if(!empty($service['cta_question']))
                    <div class="mt-10 rounded-xl bg-primary text-white p-6 md:p-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h3 class="text-xl font-semibold text-white m-0">{{ $service['cta_question'] }}</h3>
                            <p class="text-white/80 text-sm mt-1 m-0">Speak with our specialists today — free, confidential, no obligation.</p>
                        </div>
                        <a href="{{ route('recovery.claim') }}" class="bg-white text-primary font-semibold px-6 py-3 rounded-lg whitespace-nowrap hover:bg-white/90 transition-colors text-center">Start Your Claim</a>
                    </div>
                    @endif

                    @if(!empty($service['faqs']))
                    <div class="mt-12 pt-12 border-t border-border-muted">
                        <h2 class="text-2xl font-semibold mb-6">Frequently Asked Questions</h2>
                        <x-faq-accordion :items="$service['faqs']" />
                    </div>
                    @endif
                </div>

                {{-- Sidebar --}}
                <aside class="lg:col-span-1">
                    <div class="sticky top-24 space-y-6">
                        <div class="bg-surface-muted rounded-lg p-6">
                            <h4 class="text-base font-semibold text-content mb-2">Free Consultation</h4>
                            <p class="text-sm text-content-secondary mb-4">Speak with our expert team about your case today.</p>
                            <a href="{{ route('recovery.claim') }}" class="btn-primary w-full text-center mb-3">Start Your Claim</a>
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings->office_phone ?? '') }}" class="btn-secondary w-full text-center flex items-center justify-center gap-2">
                                <i data-lucide="phone" class="w-4 h-4"></i> {{ $settings->office_phone ?? '' }}
                            </a>
                        </div>

                        @if(!empty($service['related']))
                        <div>
                            <h4 class="text-sm font-semibold text-content mb-4">Related Services</h4>
                            <div class="space-y-1">
                                @foreach($service['related'] as $rs)
                                <a href="{{ route('recovery.service', $rs['slug']) }}" class="flex items-center gap-2 py-2 text-sm text-content-secondary hover:text-primary transition-colors">
                                    <i data-lucide="arrow-right" class="w-3.5 h-3.5 text-content-tertiary"></i>
                                    {{ $rs['title'] }}
                                </a>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </aside>
            </div>
        </div>
    </section>

    {{-- CTA Banner --}}
    <x-cta-banner :dark="true" :title="'Affected by ' . strtolower($service['name']) . '?'" subtitle="Our team of expert fraud lawyers can help you recover your lost funds." />

@endsection
