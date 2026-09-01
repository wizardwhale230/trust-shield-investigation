<!DOCTYPE html>
<html lang="en-GB" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="csrf-token" content="{{ csrf_token() }}"> <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', ($settings->site_name ?? 'Verfins') . ' Solicitors')</title>
    <meta name="description" content="@yield('description', $settings->description ?? 'Our team of investment fraud lawyers have a proven track record of recovering assets for victims of investment fraud.')">
    <meta name="robots" content="max-image-preview:large">
    @if($settings->favicon)<link rel="icon" href="{{ asset('storage/app/public/'.$settings->favicon) }}" type="image/x-icon">@endif

    <!-- Open Graph -->
    <meta property="og:title" content="@yield('title', ($settings->site_name ?? 'Verfins') . ' Solicitors')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="en_GB">

    <!-- Preload fonts -->
    <link rel="preload" href="{{ asset('assets/fonts/poppins-v21-latin-600.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('assets/fonts/poppins-v21-latin-regular.woff2') }}" as="font" type="font/woff2" crossorigin>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            light: '#E6EAF2',
                            DEFAULT: '#0A1F44',
                            dark: '#061634',
                        },
                        accent: {
                            light: '#F6EFE0',
                            DEFAULT: '#B08D57',
                            dark: '#8A6C3E',
                        },
                        content: {
                            DEFAULT: '#0F172A',
                            secondary: '#475569',
                            tertiary: '#94A3B8',
                            inverse: '#FFFFFF',
                        },
                        surface: {
                            DEFAULT: '#FFFFFF',
                            muted: '#FAF8F3',
                            subtle: '#F2EFE7',
                        },
                        border: {
                            DEFAULT: '#E2E6EE',
                            muted: '#EDF0F5',
                        },
                        warning: '#D97706',
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                        heading: ['Poppins', 'system-ui', 'sans-serif'],
                    },
                    boxShadow: {
                        card: '0 2px 8px -2px rgba(0,0,0,0.06)',
                    },
                },
            },
        }
    </script>
    <style type="text/tailwindcss">
        @font-face { font-family: Poppins; font-style: normal; font-weight: 300; font-display: swap; src: url(../assets/fonts/poppins-v21-latin-300.woff2) format("woff2"); }
        @font-face { font-family: Poppins; font-style: normal; font-weight: 400; font-display: swap; src: url(../assets/fonts/poppins-v21-latin-regular.woff2) format("woff2"); }
        @font-face { font-family: Poppins; font-style: normal; font-weight: 500; font-display: swap; src: url(../assets/fonts/poppins-v21-latin-500.woff2) format("woff2"); }
        @font-face { font-family: Poppins; font-style: normal; font-weight: 600; font-display: swap; src: url(../assets/fonts/poppins-v21-latin-600.woff2) format("woff2"); }
        @font-face { font-family: Poppins; font-style: normal; font-weight: 700; font-display: swap; src: url(../assets/fonts/poppins-v21-latin-700.woff2) format("woff2"); }

        [x-cloak] { display: none !important; }

        @layer base {
            html { scroll-behavior: smooth; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }
            body { @apply bg-surface text-content font-sans; }
            h1, h2, h3, h4, h5, h6 { @apply font-heading text-content; }
            h1 { @apply text-4xl md:text-5xl font-bold leading-tight tracking-tight; }
            h2 { @apply text-3xl md:text-4xl font-semibold leading-tight; }
            h3 { @apply text-xl md:text-2xl font-semibold; }
            h4 { @apply text-lg font-semibold; }
        }

        @layer components {
            .btn-primary {
                @apply inline-flex items-center justify-center rounded-md bg-primary px-6 py-3 text-sm font-semibold text-white transition-colors duration-200 hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2;
            }
            .btn-secondary {
                @apply inline-flex items-center justify-center rounded-md border border-border bg-transparent px-6 py-3 text-sm font-semibold text-content transition-colors duration-200 hover:bg-surface-muted focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2;
            }
            .btn-ghost {
                @apply inline-flex items-center justify-center rounded-md bg-transparent px-6 py-3 text-sm font-semibold text-primary transition-colors duration-200 hover:bg-primary-light focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2;
            }
            .section-container {
                @apply mx-auto max-w-[1280px] px-4 sm:px-6 lg:px-8;
            }
            .section-padding {
                @apply py-16 md:py-24;
            }
            .eyebrow {
                @apply text-xs font-semibold uppercase tracking-widest text-content-tertiary;
            }
            .card {
                @apply rounded-lg border border-border-muted bg-surface p-6 transition-shadow duration-200 hover:shadow-card;
            }
            .input-field {
                @apply w-full rounded-t-md border-0 border-b border-border bg-surface-subtle px-4 py-3 text-sm text-content placeholder:text-content-tertiary transition-colors duration-150 focus:border-primary focus:outline-none focus:ring-0;
            }
            .prose-content {
                @apply leading-relaxed text-content-secondary;
            }
            .prose-content h2, .prose-content p { @apply mb-4; }
            .prose-content h2 { @apply mt-10; }
            .prose-content h3 { @apply mt-8 mb-3; }
            .prose-content ul, .prose-content ol { @apply mb-4 pl-6; }
            .prose-content li { @apply mb-2; }
            .prose-content a { @apply text-primary underline hover:text-primary-dark; }
        }
    </style>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Lucide Icons -->
    <script defer src="https://cdn.jsdelivr.net/npm/lucide@latest/dist/umd/lucide.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) lucide.createIcons();
        });
    </script>

    <!-- Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "{{ $settings->site_name  }}",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('storage/app/public/'.$settings->logo) }}",
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "{{ $settings->office_phone ?? '' }}",
            "contactType": "customer service",
            "areaServed": "GB"
        }
    }
    </script>

    @stack('head')
</head>
<body class="min-h-screen flex flex-col">
    <!-- Skip to content -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-50 btn-primary">
        Skip to main content
    </a>

    {{-- Top Bar --}}
    <div class="bg-content text-content-inverse">
        <div class="section-container">
            <p class="py-2.5 text-center text-xs font-medium tracking-wide">
                <span class="text-primary-light font-semibold">4.8 &#9733; Rated on Trustpilot</span>
                <span class="hidden sm:inline"> &mdash; by our many happy clients</span>
            </p>
        </div>
    </div>

    {{-- Header --}}
    <header class="sticky top-0 z-40 bg-surface border-b border-border" x-data="{ mobileOpen: false }">
        <div class="section-container">
            <div class="flex items-center justify-between h-16 md:h-18">
                <a href="{{ route('recovery.home') }}" class="flex-shrink-0">
                    <img src="{{ asset('storage/app/public/'.$settings->logo) }}" alt="{{ $settings->site_name  }}" class="h-10 w-auto">
                </a>

                {{-- Desktop Navigation --}}
                <nav class="hidden lg:flex items-center gap-1" aria-label="Main Navigation">
                    <a href="{{ route('recovery.home') }}" class="px-3 py-2 text-sm font-medium text-content-secondary hover:text-content transition-colors rounded-md hover:bg-surface-muted">Home</a>

                    {{-- Our Company Dropdown --}}
                    <div x-data="{ open: false }" @click.away="open = false" class="relative">
                        <button @click="open = !open" class="flex items-center gap-1 px-3 py-2 text-sm font-medium text-content-secondary hover:text-content transition-colors rounded-md hover:bg-surface-muted">
                            Our Company
                            <i data-lucide="chevron-down" class="w-3.5 h-3.5 transition-transform" :class="open && 'rotate-180'"></i>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1" class="absolute left-0 mt-1 w-48 bg-surface border border-border rounded-lg shadow-card py-1" x-cloak>
                            <a href="{{ route('recovery.about') }}" class="block px-4 py-2.5 text-sm text-content-secondary hover:text-content hover:bg-surface-muted transition-colors">About Us</a>
                            <a href="{{ route('recovery.testimonials') }}" class="block px-4 py-2.5 text-sm text-content-secondary hover:text-content hover:bg-surface-muted transition-colors">Testimonials</a>
                        </div>
                    </div>

                    {{-- Services Mega Menu --}}
                    <div x-data="{ open: false }" @click.away="open = false" class="relative">
                        <button @click="open = !open" class="flex items-center gap-1 px-3 py-2 text-sm font-medium text-content-secondary hover:text-content transition-colors rounded-md hover:bg-surface-muted">
                            Services
                            <i data-lucide="chevron-down" class="w-3.5 h-3.5 transition-transform" :class="open && 'rotate-180'"></i>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1" class="absolute left-1/2 -translate-x-1/2 mt-1 w-[640px] bg-surface border border-border rounded-lg shadow-card p-6" x-cloak>
                            <div class="grid grid-cols-3 gap-x-8 gap-y-1">
                                <div>
                                    <p class="eyebrow mb-3">Trading & Investment</p>
                                    <div class="space-y-1">
                                        <a href="{{ route('recovery.service', 'trading-scams') }}" class="flex items-center gap-2 py-1.5 text-sm text-content-secondary hover:text-primary transition-colors"><i data-lucide="trending-up" class="w-4 h-4 text-content-tertiary"></i>Trading Scams</a>
                                        <a href="{{ route('recovery.service', 'forex-trading-scams') }}" class="flex items-center gap-2 py-1.5 text-sm text-content-secondary hover:text-primary transition-colors"><i data-lucide="bar-chart-3" class="w-4 h-4 text-content-tertiary"></i>Forex Trading Scams</a>
                                        <a href="{{ route('recovery.service', 'cryptocurrency') }}" class="flex items-center gap-2 py-1.5 text-sm text-content-secondary hover:text-primary transition-colors"><i data-lucide="bitcoin" class="w-4 h-4 text-content-tertiary"></i>Cryptocurrency</a>
                                        <a href="{{ route('recovery.service', 'investment-scams') }}" class="flex items-center gap-2 py-1.5 text-sm text-content-secondary hover:text-primary transition-colors"><i data-lucide="wallet" class="w-4 h-4 text-content-tertiary"></i>Investment Scams</a>
                                        <a href="{{ route('recovery.service', 'nft-scams') }}" class="flex items-center gap-2 py-1.5 text-sm text-content-secondary hover:text-primary transition-colors"><i data-lucide="image" class="w-4 h-4 text-content-tertiary"></i>NFT Scams</a>
                                        <a href="{{ route('recovery.service', 'pension-scams') }}" class="flex items-center gap-2 py-1.5 text-sm text-content-secondary hover:text-primary transition-colors"><i data-lucide="landmark" class="w-4 h-4 text-content-tertiary"></i>Pension Scams</a>
                                    </div>
                                </div>
                                <div>
                                    <p class="eyebrow mb-3">Online Fraud</p>
                                    <div class="space-y-1">
                                        <a href="{{ route('recovery.service', 'phishing-scams') }}" class="flex items-center gap-2 py-1.5 text-sm text-content-secondary hover:text-primary transition-colors"><i data-lucide="fish" class="w-4 h-4 text-content-tertiary"></i>Phishing Scams</a>
                                        <a href="{{ route('recovery.service', 'romance-fraud') }}" class="flex items-center gap-2 py-1.5 text-sm text-content-secondary hover:text-primary transition-colors"><i data-lucide="heart" class="w-4 h-4 text-content-tertiary"></i>Romance Fraud</a>
                                        <a href="{{ route('recovery.service', 'impersonation-scams') }}" class="flex items-center gap-2 py-1.5 text-sm text-content-secondary hover:text-primary transition-colors"><i data-lucide="user-x" class="w-4 h-4 text-content-tertiary"></i>Impersonation Scams</a>
                                        <a href="{{ route('recovery.service', 'ai-scams') }}" class="flex items-center gap-2 py-1.5 text-sm text-content-secondary hover:text-primary transition-colors"><i data-lucide="bot" class="w-4 h-4 text-content-tertiary"></i>AI Scams</a>
                                        <a href="{{ route('recovery.service', 'purchase-scams') }}" class="flex items-center gap-2 py-1.5 text-sm text-content-secondary hover:text-primary transition-colors"><i data-lucide="shopping-cart" class="w-4 h-4 text-content-tertiary"></i>Purchase Scams</a>
                                        <a href="{{ route('recovery.service', 'ponzi-fraud') }}" class="flex items-center gap-2 py-1.5 text-sm text-content-secondary hover:text-primary transition-colors"><i data-lucide="triangle-alert" class="w-4 h-4 text-content-tertiary"></i>Ponzi Fraud</a>
                                    </div>
                                </div>
                                <div>
                                    <p class="eyebrow mb-3">Bank & Recovery</p>
                                    <div class="space-y-1">
                                        <a href="{{ route('recovery.service', 'bank-fraud') }}" class="flex items-center gap-2 py-1.5 text-sm text-content-secondary hover:text-primary transition-colors"><i data-lucide="building-2" class="w-4 h-4 text-content-tertiary"></i>Bank Fraud</a>
                                        <a href="{{ route('recovery.service', 'revolut-scam-refunds') }}" class="flex items-center gap-2 py-1.5 text-sm text-content-secondary hover:text-primary transition-colors"><i data-lucide="credit-card" class="w-4 h-4 text-content-tertiary"></i>Revolut Refunds</a>
                                        <a href="{{ route('recovery.service', 'regulated-broker-recovery') }}" class="flex items-center gap-2 py-1.5 text-sm text-content-secondary hover:text-primary transition-colors"><i data-lucide="shield-check" class="w-4 h-4 text-content-tertiary"></i>Broker Recovery</a>
                                        <a href="{{ route('recovery.service', 'spoofing-fraud') }}" class="flex items-center gap-2 py-1.5 text-sm text-content-secondary hover:text-primary transition-colors"><i data-lucide="phone-off" class="w-4 h-4 text-content-tertiary"></i>Spoofing Fraud</a>
                                    </div>
                                    <div class="mt-4 pt-4 border-t border-border-muted">
                                        <a href="{{ route('recovery.services') }}" class="flex items-center gap-1 text-sm font-medium text-primary hover:text-primary-dark transition-colors">
                                            View all services <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('recovery.contact') }}" class="px-3 py-2 text-sm font-medium text-content-secondary hover:text-content transition-colors rounded-md hover:bg-surface-muted">Contact</a>
                </nav>

                {{-- Right side --}}
                <div class="flex items-center gap-3">
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings->office_phone ?? '') }}" class="hidden md:flex items-center gap-2 text-sm text-content-secondary hover:text-content transition-colors">
                        <i data-lucide="phone" class="w-4 h-4"></i><span>{{ $settings->office_phone ?? '' }}</span>
                    </a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="hidden sm:inline-flex btn-secondary text-xs sm:text-sm">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="hidden sm:inline-flex btn-secondary text-xs sm:text-sm">Login</a>
                    @endauth
                    @auth
                        <a href="{{ route('user.cases.create') }}" class="hidden sm:inline-flex btn-primary text-xs sm:text-sm">File New Case</a>
                    @else
                        <a href="{{ route('recovery.claim') }}" class="hidden sm:inline-flex btn-primary text-xs sm:text-sm">Start Claim</a>
                    @endauth
                    <button @click="mobileOpen = true" class="lg:hidden p-2 text-content-secondary hover:text-content rounded-md" aria-label="Open menu">
                        <i data-lucide="menu" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>
        </div>

        @include('recovery.partials.mobile-nav')
    </header>

    {{-- Page Content --}}
    <main id="main-content" class="flex-1">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-content mt-auto">
        <div class="section-container py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-8">
                <div class="lg:col-span-1">
                    <img src="{{ asset('storage/app/public/'.$settings->logo) }}" alt="{{ $settings->site_name  }}" class="h-10 w-auto mb-4">
                    <p class="text-sm text-content-tertiary leading-relaxed mb-6">{{ $settings->site_name  }} is a platform that recovers stolen funds. We provide free consultations to help you get started.</p>
                    <div class="flex items-center gap-3">
                        <a href="#" class="p-2 text-content-tertiary hover:text-content-inverse rounded-md transition-colors" aria-label="Facebook"><i data-lucide="message-circle" class="w-4 h-4"></i></a>
                        <a href="#" class="p-2 text-content-tertiary hover:text-content-inverse rounded-md transition-colors" aria-label="Instagram"><i data-lucide="image" class="w-4 h-4"></i></a>
                        <a href="#" class="p-2 text-content-tertiary hover:text-content-inverse rounded-md transition-colors" aria-label="LinkedIn"><i data-lucide="briefcase" class="w-4 h-4"></i></a>
                        <a href="mailto:{{ $settings->contact_email ?? '' }}" class="p-2 text-content-tertiary hover:text-content-inverse rounded-md transition-colors" aria-label="Email"><i data-lucide="mail" class="w-4 h-4"></i></a>
                    </div>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-content-inverse mb-4">Quick Links</h4>
                    <ul class="space-y-2.5">
                        <li><a href="{{ route('recovery.home') }}" class="text-sm text-content-tertiary hover:text-content-inverse transition-colors">Home</a></li>
                        <li><a href="{{ route('recovery.about') }}" class="text-sm text-content-tertiary hover:text-content-inverse transition-colors">About Us</a></li>
                        <li><a href="{{ route('recovery.services') }}" class="text-sm text-content-tertiary hover:text-content-inverse transition-colors">Our Services</a></li>
                        <li><a href="{{ route('recovery.testimonials') }}" class="text-sm text-content-tertiary hover:text-content-inverse transition-colors">Testimonials</a></li>
                        <li><a href="{{ route('recovery.claim') }}" class="text-sm text-content-tertiary hover:text-content-inverse transition-colors">Start Your Claim</a></li>
                        <li><a href="{{ route('recovery.contact') }}" class="text-sm text-content-tertiary hover:text-content-inverse transition-colors">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-content-inverse mb-4">Services</h4>
                    <ul class="space-y-2.5">
                        <li><a href="{{ route('recovery.service', 'trading-scams') }}" class="text-sm text-content-tertiary hover:text-content-inverse transition-colors">Trading Scams</a></li>
                        <li><a href="{{ route('recovery.service', 'cryptocurrency') }}" class="text-sm text-content-tertiary hover:text-content-inverse transition-colors">Cryptocurrency Recovery</a></li>
                        <li><a href="{{ route('recovery.service', 'forex-trading-scams') }}" class="text-sm text-content-tertiary hover:text-content-inverse transition-colors">Forex Trading Scams</a></li>
                        <li><a href="{{ route('recovery.service', 'investment-scams') }}" class="text-sm text-content-tertiary hover:text-content-inverse transition-colors">Investment Scams</a></li>
                        <li><a href="{{ route('recovery.service', 'bank-fraud') }}" class="text-sm text-content-tertiary hover:text-content-inverse transition-colors">Bank Fraud</a></li>
                        <li><a href="{{ route('recovery.service', 'romance-fraud') }}" class="text-sm text-content-tertiary hover:text-content-inverse transition-colors">Romance Fraud</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-content-inverse mb-4">Contact</h4>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <i data-lucide="mail" class="w-4 h-4 text-content-tertiary mt-0.5 flex-shrink-0"></i>
                            <a href="mailto:{{ $settings->contact_email ?? '' }}" class="text-sm text-content-tertiary hover:text-content-inverse transition-colors">{{ $settings->contact_email ?? '' }}</a>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="phone" class="w-4 h-4 text-content-tertiary mt-0.5 flex-shrink-0"></i>
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings->office_phone ?? '') }}" class="text-sm text-content-tertiary hover:text-content-inverse transition-colors">{{ $settings->office_phone ?? '' }}</a>
                        </li>
                        @if($settings->office_address)
                        <li class="flex items-start gap-3">
                            <i data-lucide="map-pin" class="w-4 h-4 text-content-tertiary mt-0.5 flex-shrink-0"></i>
                            <span class="text-sm text-content-tertiary">{{ $settings->office_address }}</span>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="border-t border-content-secondary/20">
            <div class="section-container py-6">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                    <p class="text-xs text-content-tertiary">&copy; {{ date('Y') }} {{ $settings->site_name  }}. All rights reserved.</p>
                    <div class="flex items-center gap-6">
                        <a href="{{ route('recovery.page', 'privacy-policy') }}" class="text-xs text-content-tertiary hover:text-content-inverse transition-colors">Privacy Policy</a>
                        <a href="{{ route('recovery.page', 'terms-conditions') }}" class="text-xs text-content-tertiary hover:text-content-inverse transition-colors">Terms & Conditions</a>
                        <a href="{{ route('recovery.page', 'cookie-policy') }}" class="text-xs text-content-tertiary hover:text-content-inverse transition-colors">Cookie Policy</a>
                        <a href="{{ route('recovery.page', 'complaints-procedure') }}" class="text-xs text-content-tertiary hover:text-content-inverse transition-colors">Complaints</a>
                    </div>
                </div>
                <p class="mt-4 text-xs text-content-tertiary/60 leading-relaxed max-w-3xl">
                {{ $settings->site_name  }} provide free consultations. Chargeback and other fund recovery programs contracted thereafter are subject to retainers, fees and/or commissions depending on the individual case history and the type of service selected.
                </p>
            </div>
        </div>
    </footer>

    @include('layouts.livechat')
</body>
</html>
