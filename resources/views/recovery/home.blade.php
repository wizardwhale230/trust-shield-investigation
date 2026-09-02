@extends('layouts.recovery')

@section('title', 'Trading & Investment Fraud Lawyers | ' . $settings->site_name . ' Solicitors')
@section('description', 'Our team of investment fraud lawyers have a proven track record of recovering assets for victims of investment fraud. Contact ' . $settings->site_name . ' today for a free consultation.')

@section('content')

    {{-- Hero Section --}}
    <section class="bg-surface-muted">
        <div class="section-container py-16 md:py-24 lg:py-28">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <div>
                    <p class="eyebrow mb-4">Experienced Fraud Lawyers</p>
                    <h1 class="mb-6">
                        $30,000,000+<br>
                        <span class="text-content-secondary">already recovered</span>
                    </h1>
                    <p class="text-lg text-content-secondary leading-relaxed mb-8 max-w-lg">
                        If you have lost money investing, {{ $settings->site_name  }} may be able to recover your funds.
                    </p>
                    <div class="flex items-center gap-2 mb-8">
                        <span class="text-2xl font-semibold text-content">4.8</span>
                        <i data-lucide="star" class="w-6 h-6 text-primary fill-primary"></i>
                        <span class="text-2xl font-semibold text-content">Trustpilot</span>
                    </div>
                    <p class="text-sm text-content-secondary mb-8">Rated <strong class="text-content">Excellent</strong> on Trustpilot</p>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('recovery.claim') }}" class="btn-primary">Start Your Claim</a>
                        <a href="{{ route('recovery.services') }}" class="btn-secondary">Our Services</a>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <img src="{{ asset('assets/images/wealth-recovery-homepage-hero.jpg') }}" alt="{{ $settings->site_name  }} - Fraud Recovery Experts" class="w-full rounded-lg" loading="eager">
                </div>
            </div>
        </div>
    </section>

    {{-- Press / As Seen On --}}
    <section class="border-b border-border-muted">
        <div class="section-container py-10">
            <div class="flex flex-wrap items-center justify-center gap-8 md:gap-14 opacity-40">
                <img src="{{ asset('assets/images/press_the_times.webp') }}" alt="The Times" class="h-6 md:h-8 object-contain grayscale">
                <img src="{{ asset('assets/images/press_the_law_society.webp') }}" alt="The Law Society Gazette" class="h-6 md:h-8 object-contain grayscale">
                <img src="{{ asset('assets/images/press_chesire_magazine.webp') }}" alt="Cheshire Magazine" class="h-6 md:h-8 object-contain grayscale">
                <img src="{{ asset('assets/images/press_guardian.webp') }}" alt="The Guardian" class="h-6 md:h-8 object-contain grayscale">
            </div>
        </div>
    </section>

    {{-- Services Section --}}
    <section class="bg-surface-muted">
        <div class="section-container section-padding">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12 mb-12">
                <div class="lg:col-span-1">
                    <p class="eyebrow mb-3">Our Services</p>
                    <h2 class="mb-6">How our investment fraud lawyers can help</h2>
                    <a href="{{ route('recovery.services') }}" class="btn-primary">Our Services</a>
                </div>
                <div class="lg:col-span-2">
                    <p class="text-content-secondary leading-relaxed mb-4">
                        There are many different ways that brokers may have breached rules and regulations when handling your investments, or you may have experienced scams when trading online, causing you to lose your financial investments.
                    </p>
                    <p class="text-content-secondary leading-relaxed">
                        We&rsquo;ve found that, in a lot of cases, when scams or fraud happen as a result of trading online, many investors believe that their money is lost forever. This isn&rsquo;t the case. Our team of investment fraud lawyers here at {{ $settings->site_name  }} Solicitors are highly skilled and experienced in recovering money lost in this way.
                    </p>
                </div>
            </div>

            @php
            $tiles = [
                ['icon' => 'trending-up', 'title' => 'Advised how to trade', 'desc' => 'Were you advised to buy or sell a specific stock, commodity, or Forex?'],
                ['icon' => 'banknote', 'title' => 'Guaranteed profit', 'desc' => 'Were you assured that you will definitely make money from your investments?'],
                ['icon' => 'timer', 'title' => 'Pressured to deposit', 'desc' => 'Were you under constant pressure to deposit more money?'],
                ['icon' => 'user-cog', 'title' => 'Professional account', 'desc' => 'Were you advised to provide false information to upgrade your trading account?'],
                ['icon' => 'trending-down', 'title' => 'Major losses', 'desc' => 'Did you lose a large amount of money in a short amount of time?'],
                ['icon' => 'lock', 'title' => 'Prevented withdrawals', 'desc' => 'Were your requests to withdraw your money met with refusals or resistance?'],
                ['icon' => 'users', 'title' => 'New account manager', 'desc' => 'Did the trading firm often change who was in charge of your account?'],
                ['icon' => 'gauge', 'title' => 'Trading pressure', 'desc' => 'Did your account manager call and pressure you to make immediate trades?'],
            ];
            @endphp
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($tiles as $tile)
                <div class="card text-center flex flex-col items-center gap-3 p-5">
                    <i data-lucide="{{ $tile['icon'] }}" class="w-6 h-6 text-primary"></i>
                    <h4 class="text-sm font-semibold text-content">{{ $tile['title'] }}</h4>
                    <p class="text-xs text-content-secondary leading-relaxed">{{ $tile['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Scam Types We Recover From --}}
    <section>
        <div class="section-container section-padding">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10">
                <div class="max-w-2xl">
                    <p class="eyebrow mb-3">Areas of Expertise</p>
                    <h2 class="mb-4">Types of investment fraud we recover</h2>
                    <p class="text-content-secondary leading-relaxed">From sophisticated cryptocurrency exchanges to long-running romance scams, our fraud lawyers handle the full spectrum of online investment crime.</p>
                </div>
                <a href="{{ route('recovery.services') }}" class="inline-flex items-center gap-1 text-sm font-semibold text-primary hover:underline whitespace-nowrap">
                    View all scam types <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>
            @php
            $scamTypes = [
                ['icon' => 'bitcoin',     'name' => 'Cryptocurrency Scams',  'desc' => 'Fake exchanges, rug pulls, fraudulent ICOs and stolen wallet keys.', 'image' => 'https://images.unsplash.com/photo-1518546305927-5a555bb7020d?auto=format&fit=crop&w=800&q=80'],
                ['icon' => 'line-chart',  'name' => 'Forex Trading Fraud',   'desc' => 'Unregulated brokers, manipulated spreads and refused withdrawals.',     'image' => 'https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?auto=format&fit=crop&w=800&q=80'],
                ['icon' => 'gauge',       'name' => 'Binary Options',         'desc' => 'High-pressure platforms designed to make withdrawal nearly impossible.', 'image' => 'https://images.unsplash.com/photo-1642543492481-44e81e3914a7?auto=format&fit=crop&w=800&q=80'],
                ['icon' => 'heart-crack', 'name' => 'Romance &amp; Pig-Butchering', 'desc' => 'Long-game emotional fraud funnelling victims into fake investments.', 'image' => 'https://images.unsplash.com/photo-1518621736915-f3b1c41bfd00?auto=format&fit=crop&w=800&q=80'],
                ['icon' => 'phone-call',  'name' => 'Boiler Room &amp; Pension Scams', 'desc' => 'Cold-call share scams and unauthorised pension liberation schemes.',  'image' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=800&q=80'],
                ['icon' => 'shield-alert','name' => 'Recovery-Room Scams',     'desc' => 'Fraudsters targeting victims a second time with fake recovery offers.', 'image' => 'https://images.unsplash.com/photo-1521791136064-7986c2920216?auto=format&fit=crop&w=800&q=80'],
            ];
            @endphp
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($scamTypes as $scam)
                <div class="card flex flex-col gap-0 p-0 overflow-hidden">
                    <div class="relative aspect-[16/9] overflow-hidden bg-surface-subtle">
                        <img src="{{ $scam['image'] }}" alt="{{ $scam['name'] }}" class="w-full h-full object-cover" loading="lazy">
                        <div class="absolute bottom-3 left-3 w-10 h-10 rounded-lg bg-surface/95 backdrop-blur-sm border border-border-muted flex items-center justify-center text-primary">
                            <i data-lucide="{{ $scam['icon'] }}" class="w-5 h-5"></i>
                        </div>
                    </div>
                    <div class="p-5 flex flex-col gap-2">
                        <h3 class="text-base font-semibold text-content">{!! $scam['name'] !!}</h3>
                        <p class="text-sm text-content-secondary leading-relaxed">{{ $scam['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Success Story CTA + Trustpilot --}}
    <section>
        <div class="section-container section-padding">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="mb-4">Be part of our success story</h2>
                    <a href="{{ route('recovery.claim') }}" class="btn-primary mb-8 inline-flex">Start Your Claim</a>
                    <div class="flex items-center gap-2 mt-6">
                        <span class="text-2xl font-semibold text-content">4.8</span>
                        <i data-lucide="star" class="w-5 h-5 text-primary fill-primary"></i>
                        <span class="text-2xl font-semibold text-content">Trustpilot</span>
                    </div>
                    <p class="text-sm text-content-secondary mt-1">Rated <strong class="text-content">Excellent</strong> on Trustpilot</p>
                </div>
                <div class="bg-white rounded-lg p-8 md:p-12 flex flex-col items-center justify-center gap-6 shadow-sm border border-border-muted">
                    <img src="https://cdn.trustpilot.net/brand-assets/4.1.0/logo-black.svg" alt="Trustpilot" class="h-10 md:h-12 object-contain" loading="lazy">
                    <img src="https://cdn.trustpilot.net/brand-assets/4.1.0/stars/stars-5.svg" alt="Rated 5 stars on Trustpilot" class="w-full max-w-sm object-contain" loading="lazy">
                    <p class="text-sm text-content-secondary text-center">Based on hundreds of verified client reviews</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Accreditation Logos --}}
    <section class="border-y border-border-muted">
        <div class="section-container py-10">
            <p class="text-center text-xs uppercase tracking-widest text-content-secondary mb-8">Accredited &amp; Recognised By</p>
            @php
            $accreditations = [
                ['icon' => 'scale',         'name' => 'The Law Society',         'sub' => 'Regulated Member'],
                ['icon' => 'landmark',      'name' => 'SRA Authorised',          'sub' => 'Solicitors Regulation Authority'],
                ['icon' => 'badge-check',   'name' => 'Lexcel Accredited',       'sub' => 'Practice Management Standard'],
                ['icon' => 'shield-check',  'name' => 'Cyber Essentials',        'sub' => 'Certified Secure'],
            ];
            @endphp
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($accreditations as $a)
                <div class="flex flex-col items-center text-center gap-2 p-4 rounded-lg border border-border-muted bg-surface hover:border-primary/40 transition-colors">
                    <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center">
                        <i data-lucide="{{ $a['icon'] }}" class="w-6 h-6 text-primary"></i>
                    </div>
                    <p class="text-sm font-semibold text-content leading-tight">{{ $a['name'] }}</p>
                    <p class="text-xs text-content-secondary leading-tight">{{ $a['sub'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Why Choose Us --}}
    <section>
        <div class="section-container section-padding">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <div>
                    <p class="eyebrow mb-3">Why {{ $settings->site_name }}</p>
                    <h2 class="mb-4">A law firm built around victims, not headlines</h2>
                    <p class="text-content-secondary leading-relaxed mb-8">We combine specialist legal expertise with forensic investigators and global banking partners to give you the strongest possible chance of recovery.</p>
                    @php
                    $usps = [
                        ['icon' => 'handshake',    'title' => 'No-Win, No-Fee assurance', 'desc' => 'You only pay if we successfully recover funds on your behalf.'],
                        ['icon' => 'lock',         'title' => 'Confidential &amp; discreet', 'desc' => 'Every case handled under strict solicitor-client privilege.'],
                        ['icon' => 'scale',        'title' => 'SRA-regulated specialists', 'desc' => 'Authorised and regulated by the Solicitors Regulation Authority.'],
                        ['icon' => 'globe',        'title' => 'Multi-jurisdictional reach', 'desc' => 'Cross-border recovery across 38 jurisdictions worldwide.'],
                    ];
                    @endphp
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        @foreach($usps as $usp)
                        <div class="flex gap-3">
                            <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="{{ $usp['icon'] }}" class="w-5 h-5 text-primary"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-content mb-1">{!! $usp['title'] !!}</h4>
                                <p class="text-xs text-content-secondary leading-relaxed">{{ $usp['desc'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="hidden lg:block">
                    <img src="https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=1200&q=80" alt="Investment fraud lawyers in consultation" class="w-full rounded-2xl object-cover aspect-[4/5] shadow-sm" loading="lazy">
                </div>
            </div>
        </div>
    </section>

    {{-- Impact Stats Band --}}
    <section class="bg-primary text-white">
        <div class="section-container py-14 md:py-16">
            <div class="text-center mb-10">
                <p class="text-xs uppercase tracking-widest text-white/70 mb-3">Our Impact</p>
                <h2 class="text-white">Results that speak for our clients</h2>
                <p class="text-white/80 text-sm mt-3 max-w-xl mx-auto">Independently verified by client outcomes and Trustpilot reviews.</p>
            </div>
            @php
            $impacts = [
                ['value' => '$30M+',  'label' => 'Funds recovered', 'icon' => 'banknote'],
                ['value' => '2,400+', 'label' => 'Clients helped', 'icon' => 'users'],
                ['value' => '38',     'label' => 'Jurisdictions covered', 'icon' => 'globe'],
                ['value' => '12+',    'label' => 'Years of experience', 'icon' => 'award'],
            ];
            @endphp
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                @foreach($impacts as $impact)
                <div class="rounded-xl bg-white/5 border border-white/10 p-5 flex flex-col gap-2">
                    <div class="w-9 h-9 rounded-lg bg-white/10 flex items-center justify-center mb-1">
                        <i data-lucide="{{ $impact['icon'] }}" class="w-5 h-5 text-white"></i>
                    </div>
                    <div class="text-3xl md:text-4xl font-bold text-white leading-tight">{{ $impact['value'] }}</div>
                    <div class="text-sm text-white/80 leading-snug">{{ $impact['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Visual Process Timeline --}}
    <section class="bg-surface-muted">
        <div class="section-container section-padding">
            <div class="text-center mb-12 max-w-2xl mx-auto">
                <p class="eyebrow mb-3">Your Journey</p>
                <h2 class="mb-4">From first call to funds returned</h2>
                <p class="text-content-secondary leading-relaxed">A clear five-step process that keeps you informed at every stage.</p>
            </div>
            @php
            $journey = [
                ['number' => '1', 'icon' => 'phone',         'title' => 'Free consultation',     'desc' => 'A confidential, no-obligation review of your case by a fraud specialist.'],
                ['number' => '2', 'icon' => 'search',        'title' => 'Investigation',         'desc' => 'Forensic tracing of funds, broker history and regulatory standing.'],
                ['number' => '3', 'icon' => 'file-text',     'title' => 'Strategy &amp; filing',  'desc' => 'We build the legal case and file the claim with the right authorities.'],
                ['number' => '4', 'icon' => 'gavel',         'title' => 'Negotiation',           'desc' => 'Direct negotiation with banks, exchanges and regulators on your behalf.'],
                ['number' => '5', 'icon' => 'check-circle',  'title' => 'Funds returned',        'desc' => 'Recovered amounts are transferred securely back to your account.'],
            ];
            @endphp
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5">
                @foreach($journey as $step)
                <x-process-step :number="$step['number']" :icon="$step['icon']" :title="$step['title']" :desc="$step['desc']" />
                @endforeach
            </div>
        </div>
    </section>

    {{-- Recovery Plan Steps --}}
    <section>
        <div class="section-container section-padding">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative bg-gradient-to-br from-primary/10 via-surface-muted to-accent/10 rounded-2xl p-10 md:p-14 border border-border-muted shadow-sm max-w-md mx-auto overflow-hidden">
                        <div class="absolute -top-10 -right-10 w-40 h-40 bg-primary/10 rounded-full blur-3xl"></div>
                        <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-accent/10 rounded-full blur-3xl"></div>
                        <div class="relative flex flex-col items-center text-center gap-4">
                            <div class="w-14 h-14 rounded-full bg-primary/15 flex items-center justify-center">
                                <i data-lucide="shield-check" class="w-7 h-7 text-primary"></i>
                            </div>
                            <p class="eyebrow">Total Recovered</p>
                            <p class="text-5xl md:text-6xl font-bold text-content tracking-tight">$30M+</p>
                            <p class="text-content-secondary text-sm leading-relaxed">
                                Successfully recovered for victims of investment &amp; trading fraud worldwide.
                            </p>
                            <div class="flex items-center gap-1 mt-2">
                                @for($s = 0; $s < 5; $s++)
                                    <i data-lucide="star" class="w-4 h-4 text-primary fill-primary"></i>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <p class="eyebrow mb-3">Recovery Plan</p>
                    <h2 class="mb-4">Steps to recover your money</h2>
                    <p class="text-content-secondary leading-relaxed mb-8">
                        If you have lost money trading, our forward thinking &amp; innovative team of investment fraud lawyers &amp; legal experts can deliver results in 3 simple steps.
                    </p>
                    <x-faq-accordion :items="[
                        ['question' => 'Investigation', 'answer' => 'With any wealth and investment recovery case, the starting point is to investigate the company involved. This is to see if they are a regulated company or not, or if they themselves are the victim of a cryptocurrency scam. Our team of investment fraud lawyers will examine the strengths and weaknesses of your case and how best to determine the recovery of your lost investment.'],
                        ['question' => 'Build a case', 'answer' => 'After concluding our initial investigation, our team of investment fraud lawyers will swiftly analyse the trades that have occurred and trace where the funds have gone. We will then help maximise the recovery of your lost money and work to build a strong argument in order to recover your investment.'],
                        ['question' => 'Recovery', 'answer' => 'A lot of companies will give the impression that you can\'t recover your money and that all hope is lost. Here at {{ $settings->site_name  }}, our team of investment fraud lawyers work tirelessly to expose any breaches on your behalf using our expertise and experience.'],
                    ]" />
                </div>
            </div>
        </div>
    </section>

    {{-- Our Company Section --}}
    <section class="bg-surface-muted">
        <div class="section-container section-padding">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?auto=format&fit=crop&w=1200&q=80" alt="Our team of investment fraud lawyers" class="w-full rounded-lg shadow-sm object-cover aspect-[4/3]" loading="lazy">
                </div>
                <div>
                    <p class="eyebrow mb-3">Our Company</p>
                    <h2 class="mb-4">{{ $settings->site_name  }}</h2>
                    <p class="text-content-secondary leading-relaxed mb-6">
                        We are {{ $settings->site_name  }} Solicitors, a Manchester-based law firm with a team of legal experts and investment fraud lawyers with experience in specialist trading and online money investment recovery. Our team are dedicated to helping our clients retrieve money lost from investments &amp; trading.
                    </p>
                    <a href="{{ route('recovery.about') }}" class="btn-primary">Learn More</a>
                </div>
            </div>
        </div>
    </section>

    {{-- Case Studies --}}
    <section>
        <div class="section-container section-padding">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10">
                <div class="max-w-2xl">
                    <p class="eyebrow mb-3">Recent Recoveries</p>
                    <h2 class="mb-4">Real outcomes for real clients</h2>
                    <p class="text-content-secondary leading-relaxed">A snapshot of recent cases where our team recovered funds for victims of investment fraud.</p>
                </div>
                <a href="{{ route('recovery.testimonials') }}" class="inline-flex items-center gap-1 text-sm font-semibold text-primary hover:underline whitespace-nowrap">
                    More case studies <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>
            @php
            $caseStudies = [
                [
                    'image' => 'https://images.unsplash.com/photo-1639762681485-074b7f938ba0?auto=format&fit=crop&w=900&q=80',
                    'category' => 'Crypto Fraud',
                    'title' => 'Retired teacher recovers $420k from fake crypto exchange',
                    'summary' => 'After being lured into a fraudulent platform claiming FCA registration, our team traced the wallet trail and negotiated a full bank chargeback.',
                    'recovered' => '$420,000',
                    'duration' => '4 months',
                ],
                [
                    'image' => 'https://images.unsplash.com/photo-1590283603385-17ffb3a7f29f?auto=format&fit=crop&w=900&q=80',
                    'category' => 'Forex Scam',
                    'title' => 'Engineer wins back $185k after broker manipulation',
                    'summary' => 'A regulated complaint, supported by trade-log forensics, exposed manipulated spreads and forced the offshore broker into settlement.',
                    'recovered' => '$185,000',
                    'duration' => '6 months',
                ],
                [
                    'image' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=900&q=80',
                    'category' => 'Pig-Butchering',
                    'title' => 'Widow recovers $310k from offshore wallet trail',
                    'summary' => 'Cross-border legal action combined with blockchain analysis recovered the majority of funds lost to a long-running romance investment scam.',
                    'recovered' => '$310,000',
                    'duration' => '8 months',
                ],
            ];
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($caseStudies as $cs)
                    <x-case-study-card :image="$cs['image']" :category="$cs['category']" :title="$cs['title']" :summary="$cs['summary']" :recovered="$cs['recovered']" :duration="$cs['duration']" />
                @endforeach
            </div>
            <p class="text-xs text-content-secondary text-center mt-8 max-w-2xl mx-auto">Names and identifying details have been changed to protect client confidentiality. Outcomes vary on a case-by-case basis.</p>
        </div>
    </section>

    {{-- Meet the Team --}}
    <section class="bg-surface-muted">
        <div class="section-container section-padding">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10">
                <div class="max-w-2xl">
                    <p class="eyebrow mb-3">Our People</p>
                    <h2 class="mb-4">Led by experienced fraud lawyers</h2>
                    <p class="text-content-secondary leading-relaxed">A dedicated team of solicitors, forensic investigators and client advocates working on your case from day one.</p>
                </div>
                <a href="{{ route('recovery.about') }}" class="inline-flex items-center gap-1 text-sm font-semibold text-primary hover:underline whitespace-nowrap">
                    Meet the full team <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>
            @php
            $team = [
                ['image' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=600&q=80', 'name' => 'Jonathan Hale',   'role' => 'Senior Partner',          'specialism' => '20+ years in financial crime litigation.'],
                ['image' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=600&q=80', 'name' => 'Priya Desai',      'role' => 'Head of Crypto Recovery', 'specialism' => 'Blockchain forensics &amp; digital asset tracing.'],
                ['image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=600&q=80', 'name' => 'Marcus Whittaker', 'role' => 'Litigation Director',     'specialism' => 'Cross-border civil recovery proceedings.'],
                ['image' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=600&q=80', 'name' => 'Elena Rodriguez',  'role' => 'Client Services Lead',    'specialism' => 'Your single point of contact throughout your case.'],
            ];
            @endphp
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
                @foreach($team as $member)
                    <x-team-member-card :image="$member['image']" :name="$member['name']" :role="$member['role']" :specialism="$member['specialism']" />
                @endforeach
            </div>
        </div>
    </section>

    {{-- Testimonials Section --}}
    <section>
        <div class="section-container section-padding">
            <div class="text-center mb-12">
                <p class="eyebrow mb-3">Testimonials</p>
                <h2>Our customer reviews</h2>
            </div>

            @php
            $testimonials = [
                ['initials' => 'HH', 'name' => 'H Harris', 'title' => 'Fantastic company', 'body' => "I picked up " . $settings->site_name . " on a google search, read the reviews and decided to contact them to see if they could help me with a Crypto scam. Right from the start they've been helpful and thorough, I'm about a month into the case and they've already recovered some of my funds. Can't recommend Sophie and " . $settings->site_name . " enough, true lifesavers."],
                ['initials' => 'RR', 'name' => 'Richard', 'title' => $settings->site_name . ' have done a great job to date', 'body' => $settings->site_name . ' have done a great job to date already recovering part of the money lost due to a crypto investment scam credited back to my account within a couple of weeks from providing all relevant information and authorisation to proceed.'],
                ['initials' => 'DD', 'name' => 'Debbie', 'title' => 'Unbelievable service', 'body' => 'Josh was so helpful with getting all my money back that I lost through crypto. He was so helpful and informative the whole way through the process. I will always recommend him to anyone who needs help recovering funds.'],
                ['initials' => 'AA', 'name' => 'Aharon', 'title' => 'A big thank you to Avi and the team', 'body' => "A big thank you to Avi and the team for helping me with my case and all its hurdles along the way. I didn't expect to recover a penny but with the help of " . $settings->site_name . ", a large amount of the capital was recovered. Would highly recommend."],
                ['initials' => 'JR', 'name' => 'John Ramsdale', 'title' => 'Highly recommend this firm', 'body' => "The team at " . $settings->site_name . " have been really amazing. Hannah has been absolutely great with how she has handled my case so far with the banks. They have recovered some of my funds and are working on recovering the rest for me now."],
                ['initials' => 'CC', 'name' => 'Chris', 'title' => 'Josh & his team have done a great job', 'body' => 'Josh & his team have done a great job & should be applauded for their determination & patience to resolve my case successfully. I would highly recommend this company.'],
            ];
            $slides = array_chunk($testimonials, 3);
            @endphp

            <div x-data="{ current: 0, total: {{ count($slides) }} }" class="relative">
                <div class="overflow-hidden">
                    <div class="flex transition-transform duration-500" :style="'transform: translateX(-' + (current * 100) + '%)'">
                        @foreach($slides as $slide)
                        <div class="w-full flex-shrink-0 grid grid-cols-1 md:grid-cols-3 gap-6 px-1">
                            @foreach($slide as $t)
                                <x-testimonial-card :initials="$t['initials']" :name="$t['name']" :title="$t['title']" :body="$t['body']" :rating="5" />
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="flex items-center justify-center gap-4 mt-8">
                    <button @click="current = current > 0 ? current - 1 : total - 1" class="p-2 border border-border rounded-full text-content-secondary hover:text-content hover:border-content transition-colors" aria-label="Previous reviews">
                        <i data-lucide="chevron-left" class="w-4 h-4"></i>
                    </button>
                    <div class="flex gap-2">
                        @for($i = 0; $i < count($slides); $i++)
                            <button @click="current = {{ $i }}" class="w-2 h-2 rounded-full transition-colors" :class="current === {{ $i }} ? 'bg-primary' : 'bg-border'" aria-label="Go to slide {{ $i + 1 }}"></button>
                        @endfor
                    </div>
                    <button @click="current = current < total - 1 ? current + 1 : 0" class="p-2 border border-border rounded-full text-content-secondary hover:text-content hover:border-content transition-colors" aria-label="Next reviews">
                        <i data-lucide="chevron-right" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>

            <div class="text-center mt-8">
                <a href="{{ route('recovery.testimonials') }}" class="btn-secondary">Read More Reviews</a>
            </div>
        </div>
    </section>

    {{-- Homepage FAQ --}}
    <section class="bg-surface-muted">
        <div class="section-container section-padding">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-start">
                <div class="hidden lg:block">
                    <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&w=1200&q=80" alt="Lawyer in client consultation" class="w-full rounded-2xl object-cover aspect-[4/5] shadow-sm" loading="lazy">
                </div>
                <div>
                    <p class="eyebrow mb-3">Common Questions</p>
                    <h2 class="mb-4">Answers before you start your claim</h2>
                    <p class="text-content-secondary leading-relaxed mb-8">Quick answers to the questions clients ask most often during their first consultation.</p>
                    <x-faq-accordion :items="[
                        ['question' => 'How much does it cost to make a claim?', 'answer' => 'We work on a no-win, no-fee basis for the majority of our cases. You only pay a fee if we successfully recover funds for you. Initial consultations are always free of charge.'],
                        ['question' => 'Is my case confidential?', 'answer' => 'Absolutely. Every case is handled under strict solicitor-client privilege, and your details are never shared with third parties without your written consent.'],
                        ['question' => 'How long does the recovery process take?', 'answer' => 'Most cases are resolved within 3 to 9 months, depending on the complexity, the jurisdictions involved and the cooperation of the financial institutions handling the funds.'],
                        ['question' => 'What if the scammer is based overseas?', 'answer' => 'Our team operates across 38 jurisdictions and works with international banking partners and law enforcement to trace and recover funds, even when scammers are based abroad.'],
                        ['question' => 'How do I know if I have a strong case?', 'answer' => 'Book a free consultation. Our specialists will assess the evidence you have, the regulatory standing of the platform involved and the realistic prospects of recovery before you commit to anything.'],
                        ['question' => 'Will I have to go to court?', 'answer' => 'In most cases, no. The vast majority of recoveries are settled through negotiation with banks, exchanges and regulators without the need for court proceedings.'],
                    ]" />
                </div>
            </div>
        </div>
    </section>

    {{-- Resources / Scam Alerts --}}
    <section>
        <div class="section-container section-padding">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10">
                <div class="max-w-2xl">
                    <p class="eyebrow mb-3">Stay Informed</p>
                    <h2 class="mb-4">Latest scam alerts &amp; guides</h2>
                    <p class="text-content-secondary leading-relaxed">Practical insight from our fraud specialists to help you spot scams before they cost you.</p>
                </div>
            </div>
            @php
            $resources = [
                [
                    'image'   => 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=900&q=80',
                    'tag'     => 'Scam Alert',
                    'date'    => 'April 2026',
                    'title'   => 'Fake Coinbase support scam targeting UK retirees',
                    'excerpt' => 'A new wave of impersonation calls is convincing victims to grant remote access to their wallets. Here is how to spot it.',
                    'url'     => '#',
                ],
                [
                    'image'   => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&w=900&q=80',
                    'tag'     => 'Guide',
                    'date'    => 'March 2026',
                    'title'   => '5 red flags of a recovery-room scam',
                    'excerpt' => 'Fraudsters often target victims a second time with fake recovery offers. Learn the warning signs every claimant should know.',
                    'url'     => '#',
                ],
                [
                    'image'   => 'https://images.unsplash.com/photo-1639762681057-408e52192e55?auto=format&fit=crop&w=900&q=80',
                    'tag'     => 'Insight',
                    'date'    => 'February 2026',
                    'title'   => 'How blockchain forensics traces stolen crypto',
                    'excerpt' => 'A look inside the tools and techniques our investigators use to follow stolen funds across chains and exchanges.',
                    'url'     => '#',
                ],
            ];
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($resources as $r)
                    <x-resource-card :image="$r['image']" :tag="$r['tag']" :date="$r['date']" :title="$r['title']" :excerpt="$r['excerpt']" :url="$r['url']" />
                @endforeach
            </div>
        </div>
    </section>

    {{-- Final CTA --}}
    <x-cta-banner :dark="true" title="Ready to recover your funds?" subtitle="Get a free consultation with our team of expert fraud lawyers today." />

@endsection
