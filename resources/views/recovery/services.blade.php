@extends('layouts.recovery')

@section('title', 'Our Services | ' . $settings->site_name . ' Solicitors')
@section('description', 'Our recovery services are focused on getting you money back from losses made through investments, trading or residential cases. Contact us today.')

@section('content')

    {{-- Page Header --}}
    <section class="relative bg-surface-muted border-b border-border-muted overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&w=1920&q=80');"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-surface/95 via-surface/85 to-surface/40"></div>
        <div class="relative section-container py-16 md:py-24">
            <x-breadcrumb :items="[
                ['label' => 'Services', 'url' => null],
            ]" />
            <p class="eyebrow mb-3">Our Services</p>
            <h1 class="text-3xl md:text-4xl">Recovery Services</h1>
            <p class="mt-4 text-lg text-content-secondary max-w-2xl">
                Comprehensive recovery solutions for victims of financial fraud, scams, and investment losses.
            </p>
        </div>
    </section>

    {{-- Services Grid --}}
    <section>
        <div class="section-container section-padding">
            <div x-data="{ filter: 'all' }" class="mb-10">
                <div class="flex flex-wrap gap-2 mb-10">
                    <button @click="filter = 'all'" :class="filter === 'all' ? 'bg-content text-content-inverse' : 'bg-surface-subtle text-content-secondary hover:text-content'" class="px-4 py-2 text-sm font-medium rounded-md transition-colors">All</button>
                    <button @click="filter = 'trading'" :class="filter === 'trading' ? 'bg-content text-content-inverse' : 'bg-surface-subtle text-content-secondary hover:text-content'" class="px-4 py-2 text-sm font-medium rounded-md transition-colors">Trading & Investment</button>
                    <button @click="filter = 'online'" :class="filter === 'online' ? 'bg-content text-content-inverse' : 'bg-surface-subtle text-content-secondary hover:text-content'" class="px-4 py-2 text-sm font-medium rounded-md transition-colors">Online Fraud</button>
                    <button @click="filter = 'bank'" :class="filter === 'bank' ? 'bg-content text-content-inverse' : 'bg-surface-subtle text-content-secondary hover:text-content'" class="px-4 py-2 text-sm font-medium rounded-md transition-colors">Bank & Recovery</button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($services as $slug => $s)
                    <div x-show="filter === 'all' || filter === '{{ $s['category'] }}'" x-transition>
                        <x-service-card
                            :title="$s['name']"
                            :desc="$s['description']"
                            :url="route('recovery.service', $slug)"
                            :icon="$s['icon']"
                        />
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Industries / Specialisms --}}
    <section class="bg-surface-muted">
        <div class="section-container section-padding">
            <div class="text-center mb-12 max-w-2xl mx-auto">
                <p class="eyebrow mb-3">Specialist Knowledge</p>
                <h2 class="mb-4">Industries we recover from</h2>
                <p class="text-content-secondary leading-relaxed">Each fraud type demands its own evidence trail and legal strategy. Our specialists are trained in the techniques unique to every sector below.</p>
            </div>
            @php
            $industries = [
                ['icon' => 'bitcoin',     'name' => 'Cryptocurrency',     'desc' => 'Fake exchanges, rug pulls, wallet drains and DeFi protocol fraud.', 'image' => 'https://images.unsplash.com/photo-1518546305927-5a555bb7020d?auto=format&fit=crop&w=800&q=80'],
                ['icon' => 'line-chart',  'name' => 'Forex &amp; CFD Trading', 'desc' => 'Unregulated brokers, manipulated spreads and refused withdrawals.', 'image' => 'https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?auto=format&fit=crop&w=800&q=80'],
                ['icon' => 'gauge',       'name' => 'Binary Options',     'desc' => 'High-pressure platforms designed to trap deposits indefinitely.', 'image' => 'https://images.unsplash.com/photo-1642543492481-44e81e3914a7?auto=format&fit=crop&w=800&q=80'],
                ['icon' => 'heart-crack', 'name' => 'Pig-Butchering',     'desc' => 'Romance-led, long-game investment fraud across messaging apps.', 'image' => 'https://images.unsplash.com/photo-1518621736915-f3b1c41bfd00?auto=format&fit=crop&w=800&q=80'],
                ['icon' => 'phone-call',  'name' => 'Boiler Room Scams',  'desc' => 'Cold-call share scams &amp; unauthorised pension liberation.', 'image' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=800&q=80'],
                ['icon' => 'shield-alert','name' => 'Recovery-Room Scams','desc' => 'Fake recovery firms targeting victims for a second loss.', 'image' => 'https://images.unsplash.com/photo-1521791136064-7986c2920216?auto=format&fit=crop&w=800&q=80'],
            ];
            @endphp
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($industries as $ind)
                <div class="card flex flex-col gap-0 p-0 overflow-hidden">
                    <div class="relative aspect-[16/9] overflow-hidden bg-surface-subtle">
                        <img src="{{ $ind['image'] }}" alt="{{ $ind['name'] }}" class="w-full h-full object-cover" loading="lazy">
                        <div class="absolute bottom-3 left-3 w-10 h-10 rounded-lg bg-surface/95 backdrop-blur-sm border border-border-muted flex items-center justify-center text-primary">
                            <i data-lucide="{{ $ind['icon'] }}" class="w-5 h-5"></i>
                        </div>
                    </div>
                    <div class="p-5 flex flex-col gap-2">
                        <h3 class="text-base font-semibold text-content">{!! $ind['name'] !!}</h3>
                        <p class="text-sm text-content-secondary leading-relaxed">{{ $ind['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Why Our Services Work --}}
    <section>
        <div class="section-container section-padding">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <div class="hidden lg:block">
                    <img src="https://images.unsplash.com/photo-1521791055366-0d553872125f?auto=format&fit=crop&w=1200&q=80" alt="Recovery lawyers reviewing case files" class="w-full rounded-2xl object-cover aspect-[4/5] shadow-sm" loading="lazy">
                </div>
                <div>
                    <p class="eyebrow mb-3">Our Methodology</p>
                    <h2 class="mb-4">Why our recovery services work</h2>
                    <p class="text-content-secondary leading-relaxed mb-8">A combination of legal pressure, forensic evidence and global banking partnerships gives us routes to recovery most firms cannot access.</p>
                    @php
                    $whyTiles = [
                        ['icon' => 'search-check',  'title' => 'Forensic-led evidence', 'desc' => 'Every case is built on tradeable evidence: trade logs, wallet trails, bank rails.'],
                        ['icon' => 'building-2',    'title' => 'Direct banking channels','desc' => 'Established chargeback &amp; recall pathways with major UK and EU banks.'],
                        ['icon' => 'gavel',         'title' => 'Regulatory leverage',   'desc' => 'Formal complaints to FCA, SRA, FOS and overseas regulators where applicable.'],
                        ['icon' => 'globe',         'title' => 'Cross-border reach',    'desc' => 'Local-counsel partners across 38 jurisdictions for offshore recoveries.'],
                    ];
                    @endphp
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        @foreach($whyTiles as $t)
                        <div class="flex gap-3">
                            <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="{{ $t['icon'] }}" class="w-5 h-5 text-primary"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-content mb-1">{!! $t['title'] !!}</h4>
                                <p class="text-xs text-content-secondary leading-relaxed">{{ $t['desc'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Service Process Timeline --}}
    <section class="bg-surface-muted">
        <div class="section-container section-padding">
            <div class="text-center mb-12 max-w-2xl mx-auto">
                <p class="eyebrow mb-3">How It Works</p>
                <h2 class="mb-4">Engaging our services in four steps</h2>
                <p class="text-content-secondary leading-relaxed">A clear, no-obligation pathway from your first message to active case work.</p>
            </div>
            @php
            $serviceSteps = [
                ['number' => '1', 'icon' => 'phone',        'title' => 'Free consultation', 'desc' => 'Confidential review of your circumstances by a fraud specialist.'],
                ['number' => '2', 'icon' => 'clipboard-list','title' => 'Case assessment',  'desc' => 'We analyse evidence, identify the right service and explain prospects.'],
                ['number' => '3', 'icon' => 'file-signature','title' => 'Engagement',       'desc' => 'Clear no-win, no-fee agreement signed before any work begins.'],
                ['number' => '4', 'icon' => 'rocket',       'title' => 'Recovery launched', 'desc' => 'Forensics, legal filings &amp; negotiations begin immediately.'],
            ];
            @endphp
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach($serviceSteps as $step)
                <x-process-step :number="$step['number']" :icon="$step['icon']" :title="$step['title']" :desc="$step['desc']" />
                @endforeach
            </div>
        </div>
    </section>

    {{-- How We Charge --}}
    <section>
        <div class="section-container section-padding">
            <div class="text-center mb-12 max-w-2xl mx-auto">
                <p class="eyebrow mb-3">Fees &amp; Funding</p>
                <h2 class="mb-4">Transparent ways to fund your case</h2>
                <p class="text-content-secondary leading-relaxed">Most clients pay nothing up front. Choose the funding model that suits your case.</p>
            </div>
            @php
            $feeOptions = [
                [
                    'icon'     => 'handshake',
                    'name'     => 'No-Win, No-Fee',
                    'tagline'  => 'Most popular',
                    'desc'     => 'You pay nothing unless we successfully recover funds. The standard model for the majority of our cases.',
                    'features' => ['No up-front legal fees', 'Success fee taken only on recovery', 'Full risk borne by the firm'],
                    'featured' => true,
                ],
                [
                    'icon'     => 'wallet',
                    'name'     => 'Fixed Fee',
                    'tagline'  => 'For defined-scope work',
                    'desc'     => 'A single agreed fee for clearly scoped work, such as a regulatory complaint or initial investigation.',
                    'features' => ['Price agreed before work begins', 'No hourly billing surprises', 'Ideal for advisory or one-off filings'],
                    'featured' => false,
                ],
                [
                    'icon'     => 'clock',
                    'name'     => 'Hourly Retainer',
                    'tagline'  => 'For complex litigation',
                    'desc'     => 'Traditional hourly billing for complex multi-jurisdictional disputes, with regular cost updates.',
                    'features' => ['Detailed time records', 'Monthly billing &amp; cost reports', 'Used only when client prefers'],
                    'featured' => false,
                ],
            ];
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($feeOptions as $fee)
                <div class="relative card flex flex-col gap-4 p-6 {{ $fee['featured'] ? 'border-primary ring-1 ring-primary/30' : '' }}">
                    @if($fee['featured'])
                    <span class="absolute -top-3 right-5 inline-flex items-center gap-1 bg-primary text-white text-xs font-semibold uppercase tracking-wider px-3 py-1 rounded-full">
                        <i data-lucide="star" class="w-3 h-3 fill-white"></i>
                        {{ $fee['tagline'] }}
                    </span>
                    @endif
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                            <i data-lucide="{{ $fee['icon'] }}" class="w-5 h-5 text-primary"></i>
                        </div>
                        <div>
                            <h3 class="text-base font-semibold text-content leading-tight">{{ $fee['name'] }}</h3>
                            @if(!$fee['featured'])
                                <p class="text-xs text-content-secondary">{{ $fee['tagline'] }}</p>
                            @endif
                        </div>
                    </div>
                    <p class="text-sm text-content-secondary leading-relaxed">{{ $fee['desc'] }}</p>
                    <ul class="flex flex-col gap-2 mt-2 pt-4 border-t border-border-muted">
                        @foreach($fee['features'] as $feature)
                        <li class="flex items-start gap-2 text-sm text-content">
                            <i data-lucide="check" class="w-4 h-4 text-primary flex-shrink-0 mt-0.5"></i>
                            <span>{!! $feature !!}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
            <p class="text-xs text-content-secondary text-center mt-8 max-w-2xl mx-auto">All fee arrangements are explained in writing before any case work begins. We never take fees from cases we do not believe have realistic prospects of recovery.</p>
        </div>
    </section>

    {{-- Services FAQ --}}
    <section class="bg-surface-muted">
        <div class="section-container section-padding">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-start">
                <div>
                    <p class="eyebrow mb-3">Service Questions</p>
                    <h2 class="mb-4">Common questions about our services</h2>
                    <p class="text-content-secondary leading-relaxed mb-6">Quick answers about how our recovery services work, who they suit and what to expect.</p>
                    <a href="{{ route('recovery.contact') }}" class="btn-secondary">Ask a different question</a>
                </div>
                <div>
                    <x-faq-accordion :items="[
                        ['question' => 'Which service is right for my case?', 'answer' => 'Book a free consultation. Our specialists will match your circumstances to the most appropriate service \u2014 whether that is bank chargeback, regulatory complaint, civil claim or cross-border tracing.'],
                        ['question' => 'Can you help if my funds went to an offshore wallet or broker?', 'answer' => 'Yes. We operate across 38 jurisdictions through trusted local-counsel partners and are experienced in cross-border crypto, forex and bank-rail recoveries.'],
                        ['question' => 'How long does a typical case take?', 'answer' => 'Most cases settle in 3 to 9 months. Bank chargebacks can resolve in weeks; complex cross-border litigation can take longer. We give you a realistic estimate at the consultation.'],
                        ['question' => 'Do you offer combined services?', 'answer' => 'Yes. Many cases benefit from running multiple services in parallel \u2014 for example, blockchain forensics alongside bank chargeback and a regulatory complaint.'],
                        ['question' => 'What happens if recovery is not possible?', 'answer' => 'On no-win, no-fee cases you pay nothing. We will tell you up front if we believe recovery is unrealistic rather than take on a case we cannot win.'],
                        ['question' => 'Are my conversations with you confidential?', 'answer' => 'Yes. Every consultation and case is protected by solicitor-client privilege and our internal confidentiality and data-security policies.'],
                    ]" />
                </div>
            </div>
        </div>
    </section>

    <x-cta-banner :dark="true" title="Not sure which service you need?" subtitle="Contact us for a free consultation and we'll help you understand your options." />

@endsection
