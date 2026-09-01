{{-- Mobile Navigation (included in layout) --}}
<div x-show="mobileOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 bg-content/50 lg:hidden" @click="mobileOpen = false" x-cloak></div>
<div x-show="mobileOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" class="fixed top-0 right-0 z-50 w-full max-w-sm h-full bg-surface shadow-lg overflow-y-auto lg:hidden" x-cloak>
    <div class="flex items-center justify-between p-4 border-b border-border">
        <img src="alt="{{ $settings->site_name  }}"" alt="{{ $settings->site_name  }}" class="h-8 w-auto">
        <button @click="mobileOpen = false" class="p-2 text-content-secondary hover:text-content rounded-md" aria-label="Close menu">
            <i data-lucide="x" class="w-5 h-5"></i>
        </button>
    </div>
    <nav class="p-4" aria-label="Mobile Navigation">
        <div class="space-y-1">
            <a href="{{ route('recovery.home') }}" class="block px-4 py-3 text-sm font-medium text-content rounded-md hover:bg-surface-muted transition-colors">Home</a>
            <div x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 text-sm font-medium text-content rounded-md hover:bg-surface-muted transition-colors">
                    Our Company
                    <i data-lucide="chevron-down" class="w-4 h-4 text-content-tertiary transition-transform" :class="open && 'rotate-180'"></i>
                </button>
                <div x-show="open" x-transition class="ml-4 border-l border-border-muted">
                    <a href="{{ route('recovery.about') }}" class="block px-4 py-2.5 text-sm text-content-secondary hover:text-content transition-colors">About Us</a>
                    <a href="{{ route('recovery.testimonials') }}" class="block px-4 py-2.5 text-sm text-content-secondary hover:text-content transition-colors">Testimonials</a>
                </div>
            </div>
            <div x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 text-sm font-medium text-content rounded-md hover:bg-surface-muted transition-colors">
                    Services
                    <i data-lucide="chevron-down" class="w-4 h-4 text-content-tertiary transition-transform" :class="open && 'rotate-180'"></i>
                </button>
                <div x-show="open" x-transition class="ml-4 border-l border-border-muted">
                    <a href="{{ route('recovery.service', 'trading-scams') }}" class="block px-4 py-2.5 text-sm text-content-secondary hover:text-content transition-colors">Trading Scams</a>
                    <a href="{{ route('recovery.service', 'cryptocurrency') }}" class="block px-4 py-2.5 text-sm text-content-secondary hover:text-content transition-colors">Cryptocurrency</a>
                    <a href="{{ route('recovery.service', 'forex-trading-scams') }}" class="block px-4 py-2.5 text-sm text-content-secondary hover:text-content transition-colors">Forex Trading Scams</a>
                    <a href="{{ route('recovery.service', 'investment-scams') }}" class="block px-4 py-2.5 text-sm text-content-secondary hover:text-content transition-colors">Investment Scams</a>
                    <a href="{{ route('recovery.service', 'bank-fraud') }}" class="block px-4 py-2.5 text-sm text-content-secondary hover:text-content transition-colors">Bank Fraud</a>
                    <a href="{{ route('recovery.service', 'phishing-scams') }}" class="block px-4 py-2.5 text-sm text-content-secondary hover:text-content transition-colors">Phishing Scams</a>
                    <a href="{{ route('recovery.service', 'romance-fraud') }}" class="block px-4 py-2.5 text-sm text-content-secondary hover:text-content transition-colors">Romance Fraud</a>
                    <a href="{{ route('recovery.services') }}" class="flex items-center gap-1 px-4 py-2.5 text-sm font-medium text-primary hover:text-primary-dark transition-colors">View all services <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i></a>
                </div>
            </div>
            <a href="{{ route('recovery.contact') }}" class="block px-4 py-3 text-sm font-medium text-content rounded-md hover:bg-surface-muted transition-colors">Contact</a>
        </div>
        <div class="mt-6 pt-6 border-t border-border space-y-3">
            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings->office_phone ?? '') }}" class="flex items-center justify-center gap-2 w-full py-3 text-sm font-medium text-content-secondary border border-border rounded-md hover:bg-surface-muted transition-colors"><i data-lucide="phone" class="w-4 h-4"></i>{{ $settings->office_phone ?? '' }}</a>
            @auth
                <a href="{{ route('dashboard') }}" class="btn-secondary w-full text-center">Go to Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn-secondary w-full text-center">Login</a>
            @endauth
            @auth
                <a href="{{ route('user.cases.create') }}" class="btn-primary w-full text-center">File New Case</a>
            @else
                <a href="{{ route('recovery.claim') }}" class="btn-primary w-full text-center">Start Your Claim</a>
            @endauth
        </div>
    </nav>
</div>
