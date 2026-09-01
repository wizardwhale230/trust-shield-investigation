<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ $settings->site_name ?? 'Recovery' }}</title>
    @if($settings->favicon ?? false)
        <link rel="icon" href="{{ asset('storage/app/public/'.$settings->favicon) }}" sizes="any">
    @endif

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
                        warning: {
                            light: '#FEF3C7',
                            DEFAULT: '#D97706',
                        },
                        danger: {
                            light: '#FEE2E2',
                            DEFAULT: '#DC2626',
                        },
                        success: {
                            light: '#DCFCE7',
                            DEFAULT: '#16A34A',
                        },
                        info: {
                            light: '#DBEAFE',
                            DEFAULT: '#2563EB',
                        },
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                        heading: ['Poppins', 'system-ui', 'sans-serif'],
                    },
                    boxShadow: {
                        card: '0 1px 3px 0 rgba(0,0,0,0.04)',
                        dropdown: '0 4px 12px -2px rgba(0,0,0,0.08)',
                    },
                },
            },
        }
    </script>
    <style type="text/tailwindcss">
        @font-face { font-family: 'Inter'; font-style: normal; font-weight: 400; font-display: swap; src: url(https://fonts.gstatic.com/s/inter/v13/UcC73FwrK3iLTeHuS_fvQtMwCp50KnMa2JL7W0Q5nw.woff2) format("woff2"); }
        @font-face { font-family: 'Inter'; font-style: normal; font-weight: 500; font-display: swap; src: url(https://fonts.gstatic.com/s/inter/v13/UcC73FwrK3iLTeHuS_fvQtMwCp50KnMa2JL7W0Q5nw.woff2) format("woff2"); }
        @font-face { font-family: 'Inter'; font-style: normal; font-weight: 600; font-display: swap; src: url(https://fonts.gstatic.com/s/inter/v13/UcC73FwrK3iLTeHuS_fvQtMwCp50KnMa2JL7W0Q5nw.woff2) format("woff2"); }
        @font-face { font-family: Poppins; font-style: normal; font-weight: 600; font-display: swap; src: url(../assets/fonts/poppins-v21-latin-600.woff2) format("woff2"); }

        [x-cloak] { display: none !important; }

        @layer base {
            html { -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }
            body { @apply bg-surface-muted text-content font-sans text-sm; }
        }

        @layer components {
            .btn-primary {
                @apply inline-flex items-center justify-center rounded-md bg-primary px-4 py-2 text-sm font-medium text-white transition-colors duration-150 hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2;
            }
            .btn-secondary {
                @apply inline-flex items-center justify-center rounded-md border border-border bg-surface px-4 py-2 text-sm font-medium text-content transition-colors duration-150 hover:bg-surface-muted focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2;
            }
            .btn-ghost {
                @apply inline-flex items-center justify-center rounded-md bg-transparent px-4 py-2 text-sm font-medium text-content-secondary transition-colors duration-150 hover:bg-surface-subtle focus:outline-none;
            }
            .btn-danger {
                @apply inline-flex items-center justify-center rounded-md bg-danger px-4 py-2 text-sm font-medium text-white transition-colors duration-150 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-danger focus:ring-offset-2;
            }
            .dash-card {
                @apply bg-surface rounded-lg border border-border-muted p-5;
            }
            .input-field {
                @apply w-full rounded-md border border-border bg-surface px-3.5 py-2.5 text-sm text-content placeholder:text-content-tertiary transition-colors duration-150 focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none;
            }
            .form-label {
                @apply block text-sm font-medium text-content mb-1.5;
            }
            .form-error {
                @apply text-xs text-danger mt-1;
            }
            .table-th {
                @apply px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider;
            }
            .table-td {
                @apply px-4 py-3.5 text-sm text-content-secondary;
            }
            .status-badge {
                @apply inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium;
            }
            .nav-link {
                @apply flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-md transition-colors duration-150;
            }
            .nav-link-active {
                @apply bg-primary-light text-primary;
            }
            .nav-link-inactive {
                @apply text-content-secondary hover:text-content hover:bg-surface-muted;
            }
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

    @livewireStyles
    @stack('styles')
</head>
<body x-data="{ sidebarOpen: false }">

    {{-- Mobile sidebar overlay --}}
    <div x-show="sidebarOpen" x-transition:enter="transition-opacity duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-40 bg-content/20 lg:hidden" @click="sidebarOpen = false" x-cloak></div>

    {{-- Sidebar --}}
    <aside :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }" class="fixed inset-y-0 left-0 z-50 w-60 bg-surface-muted border-r border-border-muted flex flex-col transition-transform duration-200 -translate-x-full lg:translate-x-0 lg:z-30">

        {{-- Logo --}}
        <div class="flex items-center h-14 px-5 border-b border-border-muted flex-shrink-0">
            <a href="{{ route('dashboard') }}" class="flex-shrink-0">
                <img src="{{ asset('storage/app/public/'.$settings->logo) }}" alt="{{ $settings->site_name ?? '' }}" class="h-7 w-auto">
            </a>
            <button @click="sidebarOpen = false" class="ml-auto lg:hidden text-content-tertiary hover:text-content">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'nav-link-active' : 'nav-link-inactive' }}">
                <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                Dashboard
            </a>
            <a href="{{ route('user.cases.index') }}" class="nav-link {{ request()->routeIs('user.cases.*') ? 'nav-link-active' : 'nav-link-inactive' }}">
                <i data-lucide="folder-open" class="w-4 h-4"></i>
                My Cases
            </a>
            <a href="{{ route('user.cases.create') }}" class="nav-link {{ request()->routeIs('user.cases.create') ? 'nav-link-active' : 'nav-link-inactive' }}">
                <i data-lucide="plus-circle" class="w-4 h-4"></i>
                File New Case
            </a>

            <div class="pt-4 pb-2">
                <p class="px-3 text-xs font-medium text-content-tertiary uppercase tracking-wider">Financial</p>
            </div>
            @if(!empty($hasFeeRequests))
            <a href="{{ route('user.fee-requests') }}" class="nav-link {{ request()->routeIs('user.fee-requests*') ? 'nav-link-active' : 'nav-link-inactive' }}">
                <i data-lucide="receipt" class="w-4 h-4"></i>
                Fee Requests
                @if(($pendingFees ?? 0) > 0)
                    <span class="ml-auto bg-warning-light text-warning text-xs font-medium px-1.5 py-0.5 rounded-full">{{ $pendingFees }}</span>
                @endif
            </a>
            @endif
            {{-- <a href="{{ route('deposits') }}" class="nav-link {{ request()->routeIs('deposits') ? 'nav-link-active' : 'nav-link-inactive' }}">
                <i data-lucide="wallet" class="w-4 h-4"></i>
                Payments
            </a> --}}
            <a href="{{ route('withdrawalsdeposits') }}" class="nav-link {{ request()->routeIs('withdrawalsdeposits') ? 'nav-link-active' : 'nav-link-inactive' }}">
                <i data-lucide="arrow-up-right" class="w-4 h-4"></i>
                Disbursements
            </a>
            {{-- <a href="{{ route('accounthistory') }}" class="nav-link {{ request()->routeIs('accounthistory') ? 'nav-link-active' : 'nav-link-inactive' }}">
                <i data-lucide="clock" class="w-4 h-4"></i>
                Transactions
            </a> --}}

            <div class="pt-4 pb-2">
                <p class="px-3 text-xs font-medium text-content-tertiary uppercase tracking-wider">Account</p>
            </div>
            <a href="{{ route('accountdetails') }}" class="nav-link {{ request()->routeIs('accountdetails') ? 'nav-link-active' : 'nav-link-inactive' }}">
                <i data-lucide="user" class="w-4 h-4"></i>
                Profile
            </a>
            <a href="{{ route('user.support-tickets.index') }}" class="nav-link {{ request()->routeIs('user.support-tickets.*') ? 'nav-link-active' : 'nav-link-inactive' }}">
                <i data-lucide="help-circle" class="w-4 h-4"></i>
                Help & Support
            </a>
        </nav>

        {{-- User info at bottom --}}
        <div class="flex-shrink-0 border-t border-border-muted p-3" x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center gap-3 w-full px-3 py-2 rounded-md hover:bg-surface-muted transition-colors">
                <div class="w-8 h-8 rounded-full bg-primary-light text-primary flex items-center justify-center text-xs font-semibold flex-shrink-0">
                    {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                </div>
                <div class="flex-1 text-left min-w-0">
                    <p class="text-sm font-medium text-content truncate">{{ auth()->user()->name ?? 'User' }}</p>
                </div>
                <i data-lucide="chevron-up" class="w-4 h-4 text-content-tertiary transition-transform" :class="open && 'rotate-180'"></i>
            </button>
            <div x-show="open" x-transition @click.away="open = false" class="mt-1 py-1 bg-surface border border-border rounded-md shadow-dropdown" x-cloak>
                <a href="{{ route('accountdetails') }}" class="block px-4 py-2 text-sm text-content-secondary hover:bg-surface-muted transition-colors">Account Settings</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-content-secondary hover:bg-surface-muted transition-colors">Sign Out</button>
                </form>
            </div>
        </div>
    </aside>

    {{-- Main content area --}}
    <div class="lg:pl-60 min-h-screen flex flex-col">

        {{-- Top bar --}}
        <header class="sticky top-0 z-20 bg-surface border-b border-border-muted">
            <div class="flex items-center justify-between h-14 px-4 sm:px-6">
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = true" class="lg:hidden text-content-secondary hover:text-content">
                        <i data-lucide="menu" class="w-5 h-5"></i>
                    </button>
                    <h1 class="text-base font-semibold text-content font-heading">@yield('page-title', 'Dashboard')</h1>
                </div>
                <div class="flex items-center gap-2">
                    {{-- Balance pill --}}
                    <div class="hidden sm:flex items-center gap-1.5 bg-surface-subtle px-3 py-1.5 rounded-md">
                        <span class="text-xs text-content-tertiary">Balance:</span>
                        <span class="text-sm font-semibold text-content">{{ $settings->currency ?? '$' }}{{ number_format(auth()->user()->account_bal ?? 0, 2) }}</span>
                    </div>
                    {{-- Notification bell --}}
                    <button class="relative p-2 text-content-tertiary hover:text-content rounded-md hover:bg-surface-muted transition-colors">
                        <i data-lucide="bell" class="w-4.5 h-4.5"></i>
                    </button>
                </div>
            </div>
        </header>

        {{-- Flash messages (global) --}}
        @php
            $flashSuccess = session('success');
            $flashError   = session('error') ?? session('message') ?? session('status') ?? session('danger');
            $flashWarning = session('warning');
            $flashInfo    = session('info');
        @endphp

        @if($flashSuccess)
            <div class="mx-4 sm:mx-6 mt-4" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 6000)">
                <div class="flex items-start gap-3 bg-success-light border border-success/20 text-success rounded-md px-4 py-3 text-sm">
                    <i data-lucide="check-circle-2" class="w-4 h-4 flex-shrink-0 mt-0.5"></i>
                    <div class="flex-1">{{ $flashSuccess }}</div>
                    <button type="button" @click="show = false" class="text-success/70 hover:text-success">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>
        @endif

        @if($flashError)
            <div class="mx-4 sm:mx-6 mt-4" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 8000)">
                <div class="flex items-start gap-3 bg-danger-light border border-danger/20 text-danger rounded-md px-4 py-3 text-sm">
                    <i data-lucide="alert-circle" class="w-4 h-4 flex-shrink-0 mt-0.5"></i>
                    <div class="flex-1">{{ $flashError }}</div>
                    <button type="button" @click="show = false" class="text-danger/70 hover:text-danger">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>
        @endif

        @if($flashWarning)
            <div class="mx-4 sm:mx-6 mt-4" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 7000)">
                <div class="flex items-start gap-3 bg-warning-light border border-warning/20 text-warning rounded-md px-4 py-3 text-sm">
                    <i data-lucide="alert-triangle" class="w-4 h-4 flex-shrink-0 mt-0.5"></i>
                    <div class="flex-1">{{ $flashWarning }}</div>
                    <button type="button" @click="show = false" class="text-warning/70 hover:text-warning">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>
        @endif

        @if($flashInfo)
            <div class="mx-4 sm:mx-6 mt-4" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 6000)">
                <div class="flex items-start gap-3 bg-info-light border border-info/20 text-info rounded-md px-4 py-3 text-sm">
                    <i data-lucide="info" class="w-4 h-4 flex-shrink-0 mt-0.5"></i>
                    <div class="flex-1">{{ $flashInfo }}</div>
                    <button type="button" @click="show = false" class="text-info/70 hover:text-info">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="mx-4 sm:mx-6 mt-4" x-data="{ show: true }" x-show="show" x-transition>
                <div class="flex items-start gap-3 bg-danger-light border border-danger/20 text-danger rounded-md px-4 py-3 text-sm">
                    <i data-lucide="alert-circle" class="w-4 h-4 flex-shrink-0 mt-0.5"></i>
                    <div class="flex-1">
                        <p class="font-medium mb-1">Please fix the following:</p>
                        <ul class="list-disc list-inside space-y-0.5">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button type="button" @click="show = false" class="text-danger/70 hover:text-danger">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>
        @endif

        <script>
            // Re-render any new lucide icons added by the alerts above.
            document.addEventListener('DOMContentLoaded', () => { if (window.lucide) lucide.createIcons(); });
        </script>

        {{-- Page content --}}
        <main class="flex-1 p-4 sm:p-6">
            @yield('content')
        </main>

        {{-- Footer --}}
        <footer class="border-t border-border-muted px-4 sm:px-6 py-4">
            <p class="text-xs text-content-tertiary">&copy; {{ date('Y') }} {{ $settings->site_name ?? '' }}. All rights reserved.</p>
        </footer>
    </div>

    @livewireScripts
    @stack('scripts')
    <script>
        // Re-init Lucide icons after Livewire updates
        document.addEventListener('livewire:load', () => {
            Livewire.hook('message.processed', () => {
                if (window.lucide) lucide.createIcons();
            });
        });
    </script>

    @include('layouts.livechat')
</body>
</html>
