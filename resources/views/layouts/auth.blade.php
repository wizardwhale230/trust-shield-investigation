<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ $settings->site_name ?? 'Account' }}</title>
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
                        warning: '#D97706',
                        danger: '#DC2626',
                        success: '#16A34A',
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
        @font-face { font-family: Poppins; font-style: normal; font-weight: 400; font-display: swap; src: url(../assets/fonts/poppins-v21-latin-regular.woff2) format("woff2"); }
        @font-face { font-family: Poppins; font-style: normal; font-weight: 500; font-display: swap; src: url(../assets/fonts/poppins-v21-latin-500.woff2) format("woff2"); }
        @font-face { font-family: Poppins; font-style: normal; font-weight: 600; font-display: swap; src: url(../assets/fonts/poppins-v21-latin-600.woff2) format("woff2"); }
        @font-face { font-family: Poppins; font-style: normal; font-weight: 700; font-display: swap; src: url(../assets/fonts/poppins-v21-latin-700.woff2) format("woff2"); }

        @layer base {
            html { scroll-behavior: smooth; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }
            body { @apply bg-surface text-content font-sans; }
        }

        @layer components {
            .auth-heading {
                @apply text-2xl font-semibold font-heading text-content tracking-tight;
            }
            .auth-subtext {
                @apply text-sm text-content-secondary leading-relaxed;
            }
            .form-label {
                @apply block text-sm font-medium text-content mb-1.5;
            }
            .form-input {
                @apply w-full rounded-md border border-border bg-surface px-3.5 py-2.5 text-sm text-content placeholder:text-content-tertiary transition-colors duration-150 focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none;
            }
            .form-select {
                @apply w-full rounded-md border border-border bg-surface px-3.5 py-2.5 text-sm text-content transition-colors duration-150 focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none appearance-none;
            }
            .form-error {
                @apply text-xs text-danger mt-1;
            }
            .btn-primary {
                @apply inline-flex items-center justify-center rounded-md bg-primary px-6 py-2.5 text-sm font-semibold text-white transition-colors duration-200 hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2;
            }
            .btn-secondary {
                @apply inline-flex items-center justify-center rounded-md border border-border bg-surface px-6 py-2.5 text-sm font-medium text-content transition-colors duration-200 hover:bg-surface-muted focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2;
            }
            .alert-success {
                @apply bg-surface-subtle border-l-2 border-success text-sm text-content-secondary p-3 rounded-r-md;
            }
            .alert-danger {
                @apply bg-surface-subtle border-l-2 border-danger text-sm text-content-secondary p-3 rounded-r-md;
            }
            .alert-info {
                @apply bg-surface-subtle border-l-2 border-primary text-sm text-content-secondary p-3 rounded-r-md;
            }
            .divider-text {
                @apply flex items-center gap-4 text-xs text-content-tertiary;
            }
            .divider-text::before, .divider-text::after {
                content: '';
                @apply flex-1 h-px bg-border;
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

    @stack('head')
</head>
<body class="min-h-screen flex flex-col">

    {{-- Top bar with logo --}}
    <div class="border-b border-border">
        <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-center h-14">
                <a href="/" class="flex-shrink-0">
                    <img src="{{ asset('storage/app/public/'.$settings->logo) }}" alt="{{ $settings->site_name ?? '' }}" class="h-8 w-auto">
                </a>
            </div>
        </div>
    </div>

    {{-- Main content --}}
    <main class="flex-1 flex items-center justify-center px-4 py-12 sm:py-16">
        <div class="w-full @yield('auth-width', 'max-w-md')">
            @yield('content')
        </div>
    </main>

    {{-- Footer --}}
    <div class="py-6">
        <p class="text-center text-xs text-content-tertiary">&copy; {{ date('Y') }} {{ $settings->site_name ?? '' }}. All rights reserved.</p>
    </div>

</body>
</html>
