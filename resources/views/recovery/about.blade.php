@extends('layouts.recovery')

@section('title', 'Our Company | ' . $settings->site_name . ' Solicitors')
@section('description', 'Learn more about ' . $settings->site_name . ' Solicitors, a Manchester-based law firm specialising in investment fraud recovery.')

@section('content')

    {{-- Page Header --}}
    <section class="relative bg-surface-muted border-b border-border-muted overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1589994965851-a8f479c573a9?auto=format&fit=crop&w=1920&q=80');"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-surface/95 via-surface/85 to-surface/40"></div>
        <div class="relative section-container py-16 md:py-24">
            <x-breadcrumb :items="[['label' => 'Our Company', 'url' => null]]" />
            <p class="eyebrow mb-3">Our Company</p>
            <h1 class="text-3xl md:text-4xl">{{ $settings->site_name  }} Solicitors</h1>
            <p class="mt-4 text-lg text-content-secondary max-w-2xl">
                A Manchester-based law firm dedicated to recovering funds for victims of financial fraud.
            </p>
        </div>
    </section>

    {{-- About Content --}}
    <section>
        <div class="section-container section-padding">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?auto=format&fit=crop&w=1200&q=80" alt="{{ $settings->site_name  }} Team" class="w-full rounded-lg shadow-sm object-cover aspect-[4/3]" loading="lazy">
                </div>
                <div>
                    <h2 class="text-2xl font-semibold mb-4">Who We Are</h2>
                    <div class="prose-content">
                        <p>We are {{ $settings->site_name  }} Solicitors, a Manchester-based law firm with a team of legal experts and investment fraud lawyers with experience in specialist trading and online money investment recovery.</p>
                        <p>Our team are dedicated to helping our clients retrieve money lost from investments &amp; trading. We have recovered over $30 million for our clients and continue to fight for justice on behalf of fraud victims.</p>
                        <p>With a 4.8 rating on Trustpilot and recognition from major publications including The Times, The Guardian, and The Law Society Gazette, we are trusted by clients across the UK and internationally.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Our Story Timeline --}}
    <section class="bg-surface-muted">
        <div class="section-container section-padding">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 lg:gap-16">
                <div class="lg:col-span-1">
                    <p class="eyebrow mb-3">Our Story</p>
                    <h2 class="mb-4">A decade of fighting financial fraud</h2>
                    <p class="text-content-secondary leading-relaxed">From a single solicitor handling boiler-room scams to a multidisciplinary fraud recovery practice operating across 38 jurisdictions.</p>
                </div>
                <div class="lg:col-span-2">
                    @php
                    $milestones = [
                        ['year' => '2014', 'title' => 'Firm founded in Manchester', 'desc' => 'Established to help victims of cold-call investment scams who had nowhere else to turn.'],
                        ['year' => '2017', 'title' => 'First $1M case recovered',    'desc' => 'A landmark forex broker case set the standard for our forensic-led approach.'],
                        ['year' => '2019', 'title' => 'Crypto recovery practice launched', 'desc' => 'Dedicated digital-asset team formed in response to the rise of crypto fraud.'],
                        ['year' => '2022', 'title' => 'International expansion',     'desc' => 'Partner network established across 30+ jurisdictions for cross-border recovery.'],
                        ['year' => '2025', 'title' => '$30M+ milestone passed',      'desc' => 'Cumulative recovered funds for victims of investment fraud surpassed $30 million.'],
                    ];
                    @endphp
                    <ol class="relative border-l-2 border-border-muted pl-6 space-y-8">
                        @foreach($milestones as $m)
                        <li class="relative">
                            <span class="absolute -left-[34px] top-0 w-6 h-6 rounded-full bg-primary text-white flex items-center justify-center">
                                <i data-lucide="check" class="w-3.5 h-3.5"></i>
                            </span>
                            <p class="text-xs uppercase tracking-widest text-primary font-semibold mb-1">{{ $m['year'] }}</p>
                            <h3 class="text-base font-semibold text-content mb-1">{{ $m['title'] }}</h3>
                            <p class="text-sm text-content-secondary leading-relaxed">{{ $m['desc'] }}</p>
                        </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats --}}
    <section class="bg-surface-muted">
        <div class="section-container py-16">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <p class="text-3xl md:text-4xl font-bold text-content mb-1">$30M+</p>
                    <p class="text-sm text-content-secondary">Funds Recovered</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl md:text-4xl font-bold text-content mb-1">500+</p>
                    <p class="text-sm text-content-secondary">Cases Handled</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl md:text-4xl font-bold text-content mb-1">4.8</p>
                    <p class="text-sm text-content-secondary">Trustpilot Rating</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl md:text-4xl font-bold text-content mb-1">24/7</p>
                    <p class="text-sm text-content-secondary">Client Support</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Values --}}
    <section>
        <div class="section-container section-padding">
            <div class="text-center mb-12">
                <p class="eyebrow mb-3">Why Choose Us</p>
                <h2>Our Approach</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-10 h-10 bg-surface-muted rounded-lg mb-4">
                        <i data-lucide="search" class="w-5 h-5 text-primary"></i>
                    </div>
                    <h4 class="text-base font-semibold mb-2">Thorough Investigation</h4>
                    <p class="text-sm text-content-secondary leading-relaxed">We investigate every aspect of your case to build the strongest possible argument for recovery.</p>
                </div>
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-10 h-10 bg-surface-muted rounded-lg mb-4">
                        <i data-lucide="shield" class="w-5 h-5 text-primary"></i>
                    </div>
                    <h4 class="text-base font-semibold mb-2">Expert Legal Team</h4>
                    <p class="text-sm text-content-secondary leading-relaxed">Our solicitors specialise in financial fraud and have years of experience recovering lost funds.</p>
                </div>
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-10 h-10 bg-surface-muted rounded-lg mb-4">
                        <i data-lucide="check-circle" class="w-5 h-5 text-primary"></i>
                    </div>
                    <h4 class="text-base font-semibold mb-2">Proven Results</h4>
                    <p class="text-sm text-content-secondary leading-relaxed">With over $30 million recovered, our track record speaks for itself.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Meet the Team (Full Grid) --}}
    <section class="bg-surface-muted">
        <div class="section-container section-padding">
            <div class="text-center mb-12 max-w-2xl mx-auto">
                <p class="eyebrow mb-3">Meet the Team</p>
                <h2 class="mb-4">The people behind your recovery</h2>
                <p class="text-content-secondary leading-relaxed">Solicitors, forensic investigators and client advocates working together on every case.</p>
            </div>
            @php
            $aboutTeam = [
                ['image' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=600&q=80', 'name' => 'Jonathan Hale',   'role' => 'Senior Partner',          'specialism' => '20+ years in financial crime litigation.'],
                ['image' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=600&q=80', 'name' => 'Priya Desai',      'role' => 'Head of Crypto Recovery', 'specialism' => 'Blockchain forensics &amp; digital asset tracing.'],
                ['image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=600&q=80', 'name' => 'Marcus Whittaker', 'role' => 'Litigation Director',     'specialism' => 'Cross-border civil recovery proceedings.'],
                ['image' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=600&q=80', 'name' => 'Elena Rodriguez',  'role' => 'Client Services Lead',    'specialism' => 'Your single point of contact throughout your case.'],
                ['image' => 'https://images.unsplash.com/photo-1556157382-97eda2d62296?auto=format&fit=crop&w=600&q=80', 'name' => 'David Chen',       'role' => 'Forensic Investigator',   'specialism' => 'Bank chargeback &amp; payment trail specialist.'],
                ['image' => 'https://images.unsplash.com/photo-1551836022-deb4988cc6c0?auto=format&fit=crop&w=600&q=80', 'name' => 'Sarah Lindqvist',  'role' => 'Compliance Officer',      'specialism' => 'AML &amp; SRA regulatory adherence.'],
                ['image' => 'https://images.unsplash.com/photo-1590650153855-d9e808231d41?auto=format&fit=crop&w=600&q=80', 'name' => 'Olumide Adesola',  'role' => 'International Counsel',   'specialism' => 'African &amp; Middle East jurisdictions.'],
                ['image' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&w=600&q=80', 'name' => 'Hannah Brooks',    'role' => 'Senior Paralegal',        'specialism' => 'Case file management &amp; client liaison.'],
            ];
            @endphp
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 lg:gap-8">
                @foreach($aboutTeam as $member)
                    <x-team-member-card :image="$member['image']" :name="$member['name']" :role="$member['role']" :specialism="$member['specialism']" />
                @endforeach
            </div>
        </div>
    </section>

    {{-- Accreditations &amp; Memberships --}}
    <section>
        <div class="section-container section-padding">
            <div class="text-center mb-12 max-w-2xl mx-auto">
                <p class="eyebrow mb-3">Trust &amp; Regulation</p>
                <h2 class="mb-4">Accreditations &amp; memberships</h2>
                <p class="text-content-secondary leading-relaxed">Independently regulated, vetted and certified by the bodies that matter.</p>
            </div>
            @php
            $aboutAccreditations = [
                ['icon' => 'scale',         'name' => 'The Law Society',         'sub' => 'Regulated Member'],
                ['icon' => 'landmark',      'name' => 'SRA Authorised',          'sub' => 'Solicitors Regulation Authority'],
                ['icon' => 'badge-check',   'name' => 'Lexcel Accredited',       'sub' => 'Practice Management Standard'],
                ['icon' => 'shield-check',  'name' => 'Cyber Essentials',        'sub' => 'Certified Secure'],
                ['icon' => 'gavel',         'name' => 'IBA Member',              'sub' => 'International Bar Association'],
                ['icon' => 'globe-2',       'name' => 'INTERPOL Liaison',        'sub' => 'Cross-border investigations'],
                ['icon' => 'file-check',    'name' => 'ISO 27001',               'sub' => 'Information Security Standard'],
                ['icon' => 'users-2',       'name' => 'FCA Whistleblower Channel','sub' => 'Recognised reporting partner'],
            ];
            @endphp
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($aboutAccreditations as $a)
                <div class="flex flex-col items-center text-center gap-2 p-5 rounded-lg border border-border-muted bg-surface hover:border-primary/40 transition-colors">
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

    {{-- Our Promise / Pledge Band --}}
    <section class="bg-primary text-white">
        <div class="section-container py-14 md:py-16">
            <div class="max-w-3xl mx-auto text-center mb-10">
                <p class="text-xs uppercase tracking-widest text-white/70 mb-3">Our Promise</p>
                <h2 class="text-white">Six commitments to every client</h2>
                <p class="text-white/80 text-sm mt-3">The principles that guide how we handle your case from first call to final recovery.</p>
            </div>
            @php
            $promises = [
                ['icon' => 'message-circle', 'title' => 'Honest assessment',    'desc' => 'We will tell you up front whether your case has realistic prospects.'],
                ['icon' => 'lock',           'title' => 'Strict confidentiality','desc' => 'Solicitor-client privilege protects every conversation.'],
                ['icon' => 'wallet',         'title' => 'Transparent fees',     'desc' => 'No-win, no-fee on most cases. No hidden charges, ever.'],
                ['icon' => 'clock',          'title' => 'Regular updates',      'desc' => 'A dedicated case manager keeps you informed at every stage.'],
                ['icon' => 'shield-check',   'title' => 'Ethical practice',     'desc' => 'Fully SRA-regulated. We never cold-call or chase victims.'],
                ['icon' => 'heart-handshake','title' => 'Empathetic support',   'desc' => 'We understand the human cost of fraud, not just the financial one.'],
            ];
            @endphp
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($promises as $p)
                <div class="flex gap-4 p-5 rounded-xl bg-white/5 border border-white/10">
                    <div class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center flex-shrink-0">
                        <i data-lucide="{{ $p['icon'] }}" class="w-5 h-5 text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-white mb-1">{{ $p['title'] }}</h3>
                        <p class="text-sm text-white/80 leading-relaxed">{{ $p['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Office / Where to find us --}}
    <section>
        <div class="section-container section-padding">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1200&q=80" alt="{{ $settings->site_name }} Manchester office" class="w-full rounded-2xl shadow-sm object-cover aspect-[4/3]" loading="lazy">
                </div>
                <div>
                    <p class="eyebrow mb-3">Where to Find Us</p>
                    <h2 class="mb-4">Manchester headquarters, global reach</h2>
                    <p class="text-content-secondary leading-relaxed mb-6">Our central Manchester office is the hub of our UK operations, with associate partners and forensic specialists working with us across Europe, North America, the Middle East and Asia.</p>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="map-pin" class="w-4 h-4 text-primary"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-content">Head Office</p>
                                <p class="text-sm text-content-secondary leading-relaxed">{{ $settings->address ?? 'Manchester, United Kingdom' }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="clock" class="w-4 h-4 text-primary"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-content">Office Hours</p>
                                <p class="text-sm text-content-secondary leading-relaxed">Monday &ndash; Friday, 9:00 AM &ndash; 6:00 PM (GMT). Out-of-hours support for active cases.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="globe" class="w-4 h-4 text-primary"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-content">Global Coverage</p>
                                <p class="text-sm text-content-secondary leading-relaxed">38 jurisdictions through trusted local partners worldwide.</p>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('recovery.contact') }}" class="btn-primary mt-8 inline-flex">Get in touch</a>
                </div>
            </div>
        </div>
    </section>

    <x-cta-banner :dark="true" title="Ready to work with our team?" />

@endsection
