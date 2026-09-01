<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;700;900&display=swap" rel="stylesheet">

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
                            muted: '#F7F8FB',
                            subtle: '#EEF1F6',
                        },
                        border: {
                            DEFAULT: '#E2E6EE',
                            muted: '#EDF0F5',
                        },
                        success: '#16A34A',
                        warning: '#D97706',
                        danger: '#DC2626',
                        info: '#2563EB',
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
</head>
<body class="font-sans text-content antialiased">
    <div class="flex min-h-screen flex-col md:flex-row">
        <div class="flex w-full items-center justify-center bg-surface px-6 py-16 md:w-1/2 md:py-0">
            <div class="m-8 max-w-sm">
                <div class="font-heading text-6xl font-black text-primary md:text-9xl">
                    @yield('code', __('Oh no'))
                </div>

                <div class="my-3 h-1 w-16 rounded bg-accent md:my-6"></div>

                <p class="mb-8 text-2xl font-light leading-normal text-content-secondary md:text-3xl">
                    @yield('message')
                </p>

                <a href="{{ app('router')->has('home') ? route('home') : url('/') }}"
                   class="inline-flex items-center justify-center rounded-md border border-border bg-surface px-6 py-3 text-sm font-semibold uppercase tracking-wide text-content transition-colors duration-200 hover:bg-surface-muted focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                    {{ __('Go Home') }}
                </a>
            </div>
        </div>

        <div class="relative flex w-full items-center justify-center bg-primary md:min-h-screen md:w-1/2">
            @yield('image')
        </div>
    </div>
</body>
</html>
