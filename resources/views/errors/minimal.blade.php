<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - {{ $settings->site_name ?? config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;700&display=swap" rel="stylesheet">

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
<body class="min-h-screen bg-surface-muted font-sans text-content antialiased">
    <main class="flex min-h-screen items-center justify-center px-4 py-12">
        <div class="w-full max-w-xl rounded-lg border border-border bg-surface px-8 py-12 text-center shadow-card sm:px-12">
            <p class="font-heading text-7xl font-bold tracking-tight text-primary sm:text-8xl">
                @yield('code')
            </p>
            <div class="mx-auto my-6 h-1 w-16 rounded bg-accent"></div>
            <h1 class="font-heading text-2xl font-semibold text-content sm:text-3xl">
                @yield('title')
            </h1>
            <p class="mt-4 text-base leading-relaxed text-content-secondary">
                @yield('message')
            </p>
            <div class="mt-8 flex flex-col items-center justify-center gap-3 sm:flex-row">
                <a href="{{ url()->previous() }}"
                   class="inline-flex w-full items-center justify-center rounded-md bg-primary px-6 py-3 text-sm font-semibold text-content-inverse transition-colors duration-200 hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 sm:w-auto">
                    Go Back
                </a>
                <a href="{{ url('/') }}"
                   class="inline-flex w-full items-center justify-center rounded-md border border-border bg-surface px-6 py-3 text-sm font-semibold text-content transition-colors duration-200 hover:bg-surface-muted focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 sm:w-auto">
                    Go Home
                </a>
            </div>
        </div>
    </main>
</body>
</html>

