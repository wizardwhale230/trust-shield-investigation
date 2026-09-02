<!DOCTYPE html>
<html lang="en" data-theme="{{ $settings->usertheme }}" data-sidebar-behaviour="fixed" data-navigation-color="inverted" data-is-fluid="true">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="Webinning" name="author">
    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('themes/dashly/assets/css/theme.bundle.css') }}" id="stylesheetLTR">
    <link rel="stylesheet" href="{{ asset('themes/dashly/assets/css/theme.rtl.bundle.css') }}" id="stylesheetRTL">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preload" as="style"
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&amp;display=swap">
    <link rel="stylesheet" media="print" onload="this.onload=null;this.removeAttribute('media');"
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&amp;display=swap">
    <link rel="stylesheet" href="{{ asset('themes/dashly/assets/ext/font/bootstrap-icons.css') }}">
    <!-- no-JS fallback -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <noscript>
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&amp;display=swap">
    </noscript>

    <script>
        // Add your client ID and secret
        var PAYPAL_CLIENT = '{{ $settings->pp_ci }}';
        var PAYPAL_SECRET = '{{ $settings->pp_cs }}';
        // Point your server to the PayPal API
        var PAYPAL_ORDER_API = 'https://api.paypal.com/v2/checkout/orders/';
    </script>
    <script src="https://www.paypal.com/sdk/js?client-id={{ $settings->pp_ci }}"></script>
    <script src="{{ asset('themes/dashly/assets/ext/dist/sweetalert2.all.min.js') }}"></script>
    <link href="{{ asset('themes/dashly/assets/ext/dist/sweetalert2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('themes/dashly/assets/ext/libs/toastr.min.css') }}">
    
    <script>
        // Theme switcher
        let themeSwitcher = document.getElementById('themeSwitcher');

        const getPreferredTheme = () => {
            if (localStorage.getItem('theme') != null) {
                return localStorage.getItem('theme');
            }

            return document.documentElement.dataset.theme;
        };

        const setTheme = function(theme) {
            if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.documentElement.dataset.theme = window.matchMedia('(prefers-color-scheme: dark)').matches ?
                    'dark' : 'light';
            } else {
                document.documentElement.dataset.theme = theme;
            }

            localStorage.setItem('theme', theme);
        };

        const showActiveTheme = theme => {
            const activeBtn = document.querySelector(`[data-theme-value="${theme}"]`);

            document.querySelectorAll('[data-theme-value]').forEach(element => {
                element.classList.remove('active');
            });

            activeBtn && activeBtn.classList.add('active');

            // Set button if demo mode is enabled
            document.querySelectorAll('[data-theme-control="theme"]').forEach(element => {
                if (element.value == theme) {
                    element.checked = true;
                }
            });
        };

        function reloadPage() {
            window.location = window.location.pathname;
        }


        setTheme(getPreferredTheme());

        if (typeof themeSwitcher != 'undefined') {
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
                if (localStorage.getItem('theme') != null) {
                    if (localStorage.getItem('theme') == 'auto') {
                        reloadPage();
                    }
                }
            });

            window.addEventListener('load', () => {
                showActiveTheme(getPreferredTheme());

                document.querySelectorAll('[data-theme-value]').forEach(element => {
                    element.addEventListener('click', () => {
                        const theme = element.getAttribute('data-theme-value');

                        localStorage.setItem('theme', theme);
                        reloadPage();
                    })
                })
            });
        }
    </script>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('storage/' . $settings->favicon) }}" sizes="any">

    <!-- Demo script -->
    <script>
        var themeConfig = {
            theme: JSON.parse('"dark"'),
            isRTL: JSON.parse('false'),
            isFluid: JSON.parse('true'),
            sidebarBehaviour: JSON.parse('"fixed"'),
            navigationColor: JSON.parse('"inverted"')
        };

        var isRTL = localStorage.getItem('isRTL') === 'true',
            isFluid = localStorage.getItem('isFluid') === 'true',
            theme = localStorage.getItem('theme'),
            sidebarSizing = localStorage.getItem('sidebarSizing'),
            linkLTR = document.getElementById('stylesheetLTR'),
            linkRTL = document.getElementById('stylesheetRTL'),
            html = document.documentElement;

        if (isRTL) {
            linkLTR.setAttribute('disabled', '');
            linkRTL.removeAttribute('disabled');
            html.setAttribute('dir', 'rtl');
        } else {
            linkRTL.setAttribute('disabled', '');
            linkLTR.removeAttribute('disabled');
            html.removeAttribute('dir');
        }
    </script>

    <!-- Page Title -->
    <title>@yield('title') | {{ $settings->site_name }}</title>
    @stack('styles')
    <script src="{{ asset('themes/dashly/assets/ext/dist/alpine.min.js') }}" defer></script>
    @livewireStyles
</head>

<body>
    {{-- Livechat --}}
    <script>
        {!! $settings->tawk_to !!}
    </script>
    <!-- THEME CONFIGURATION -->
    <script>
        let themeAttrs = document.documentElement.dataset;

        for (let attr in themeAttrs) {
            if (localStorage.getItem(attr) != null) {
                document.documentElement.dataset[attr] = localStorage.getItem(attr);

                if (theme === 'auto') {
                    document.documentElement.dataset.theme = window.matchMedia('(prefers-color-scheme: dark)').matches ?
                        'dark' : 'light';

                    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
                        e.matches ? document.documentElement.dataset.theme = 'dark' : document.documentElement
                            .dataset.theme = 'light';
                    });
                }
            }
        }
    </script>
    <!-- NAVIGATION -->
    <nav id="mainNavbar" class="navbar navbar-vertical navbar-expand-lg scrollbar bg-dark navbar-dark">
        <!-- Theme configuration (navbar) -->
        <script>
            let navigationColor = localStorage.getItem('navigationColor'),
                navbar = document.getElementById('mainNavbar');

            if (navigationColor != null && navbar != null) {
                if (navigationColor == 'inverted') {
                    navbar.classList.add('bg-dark', 'navbar-dark');
                    navbar.classList.remove('bg-white', 'navbar-light');
                } else {
                    navbar.classList.add('bg-white', 'navbar-light');
                    navbar.classList.remove('bg-dark', 'navbar-dark');
                }
            }
        </script>
        <div class="container-fluid">
            <!-- Brand -->
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <img src="{{ asset('storage/' . $settings->logo) }}"
                    class="navbar-brand-img logo-light logo-small" alt="{{ $settings->site_name }}" width="19"
                    height="25">
                <img src="{{ asset('storage/' . $settings->logo) }}"
                    class="navbar-brand-img logo-light logo-large" alt="{{ $settings->site_name }}" width="125"
                    height="25">

                <img src="{{ asset('storage/' . $settings->logo) }}"
                    class="navbar-brand-img logo-dark logo-small" alt="{{ $settings->site_name }}" width="19"
                    height="25">
                <img src="{{ asset('storage/' . $settings->logo) }}"
                    class="navbar-brand-img logo-dark logo-large" alt="{{ $settings->site_name }}" width="125"
                    height="25">
            </a>

            <!-- Navbar toggler -->
            <a href="javascript: void(0);" class="navbar-toggler" data-bs-toggle="collapse"
                data-bs-target="#sidenavCollapse" aria-controls="sidenavCollapse" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </a>
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenavCollapse">
                <!-- Navigation -->
                <ul class="navbar-nav mb-lg-7">
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => request()->routeIs('dashboard')]) href="{{ route('dashboard') }}">
                            <i class="bi bi-house nav-link-icon fs-3"></i>
                            <span>Dashboards</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a @class([
                            'nav-link',
                            'active' =>
                                request()->routeIs('deposits') ||
                                request()->routeIs('payment') ||
                                request()->routeIs('pay.crypto'),
                        ]) href="{{ route('deposits') }}">
                            <i class="bi bi-wallet-fill nav-link-icon fs-3"></i>
                            <span>Deposit</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a @class([
                            'nav-link',
                            'active' =>
                                request()->routeIs('withdrawalsdeposits') ||
                                request()->routeIs('withdrawfunds'),
                        ]) href="{{ route('withdrawalsdeposits') }}">
                            <i class="bi bi-graph-down nav-link-icon fs-3"></i>
                            <span>Withdraw</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a @class([
                            'nav-link',
                            'active' =>
                                request()->routeIs('accounthistory') ||
                                request()->routeIs('withdrawlhistory') ||
                                request()->routeIs('otherhistory') ||
                                request()->routeIs('profithistory'),
                        ]) href="{{ route('accounthistory') }}">
                            <i class="bi bi-clock-history nav-link-icon fs-3"></i>
                            <span>Transaction History</span>
                        </a>
                    </li>
                    {{-- Investment section removed - recovery platform --}}
                    {{-- @if ($mod['investment']) ... @endif --}}
                  
                   
                    
                    @if ($settings->enable_kyc =='yes')
                    
                        <li class="nav-item dropdown">
                            <a @class([
                                'nav-link',
                                'active' =>
                                    request()->routeIs('user.courses') ||
                                    request()->routeIs('user.mycourses') ||
                                    request()->routeIs('user.learning') ||
                                    request()->routeIs('user.mycoursedetails') ||
                                    request()->routeIs('user.course.details'),
                            ]) href="#educationCollapse" data-bs-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="educationCollapse">
                                <i class="bi bi-book nav-link-icon fs-3"></i>
                                <span>KYC</span>
                            </a>
                            <div class="collapse" id="educationCollapse">
                                <ul class="nav flex-column">
                                   @if (Auth::user()->account_verify == 'Verified')
                                    <li class="nav-item">
                                    <span class="badge bg-success">
                                <i class="bi bi-check-circle-fill"></i>
                                Verified
                            </span>
                            </li>
            
                                  
                                    
                                     @elseif (Auth::user()->account_verify == 'Under review')
                                    <li class="nav-item">
                                        <a href="{{ route('account.verify') }}" @class(['nav-link', 'active' => request()->routeIs('user.mycourses')])>
                                            <span>Verify Account</span>
                                        </a>
                                    </li>
                                     
                                     @else
                            <!-- Button -->
                              <li class="nav-item">
                                         <a class="btn w-100 btn-sm btn-primary" href="{{ route('account.verify') }}">Verify your
                                identity</a>
                                    </li>
                           
                        @endif
                                    
                                </ul>
                            </div>
                        </li>
                        @endif
                         {{-- Crypto swap removed - recovery platform --}}
                  
                  
                  {{-- Transfer, signals, referral removed - recovery platform --}}

                    <li class="nav-item w-100">
                        <hr>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('support') }}" @class(['nav-link', 'active' => request()->routeIs('support')]) class="nav-link">
                            <i class="bi bi-info-circle-fill nav-link-icon fs-3"></i>
                            <span>Help & Support</span>
                        </a>
                    </li>
                </ul>
                <!-- End of Navigation -->
                
                    <!-- Info box -->
                    <div class="help-box rounded-3 py-5 px-4 text-center mt-auto d-block">
                        <img src="https://d33wubrfki0l68.cloudfront.net/562db41ab1c8390d2de557ae8ebd99c6add4f80b/2053e/assets/images/illustrations/upgrade-illustration.svg"
                            alt="..." class="img-fluid mb-4" width="160" height="160">
                        <h6>Verify your identity to operate seamlessly.</h6>
                        @if (Auth::user()->account_verify == 'Verified')
                            <span class="badge bg-success">
                                <i class="bi bi-check-circle-fill"></i>
                                Verified
                            </span>
                        @elseif (Auth::user()->account_verify == 'Under review')
                            <span class="badge bg-warning">
                                <i class="bi bi-exclamation-circle-fill"></i>
                                Under review
                            </span>
                        @else
                            <!-- Button -->
                            <a class="btn w-100 btn-sm btn-primary" href="{{ route('account.verify') }}">Verify
                                identity</a>
                        @endif
                    </div>
                
            </div>
            <!-- End of Collapse -->
        </div>
    </nav>
    <!-- MAIN CONTENT -->
    <main>
        <!-- HEADER -->
        <header class="container-fluid d-flex py-6 mb-4">
            <!-- Top buttons -->
            <div class="d-flex align-items-center ms-auto me-n1 me-lg-n2">

                <!-- Dropdown -->
                <div class="dropdown" id="themeSwitcher">
                    <a href="javascript: void(0);"
                        class="dropdown-toggle no-arrow d-flex align-items-center justify-content-center bg-white rounded-circle shadow-sm mx-1 mx-lg-2 w-40px h-40px link-secondary"
                        role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        data-bs-offset="0,0">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="18" width="18">
                            <g>
                                <path
                                    d="M12,4.64A7.36,7.36,0,1,0,19.36,12,7.37,7.37,0,0,0,12,4.64Zm0,12.72A5.36,5.36,0,1,1,17.36,12,5.37,5.37,0,0,1,12,17.36Z"
                                    style="fill: currentColor" />
                                <path d="M12,3.47a1,1,0,0,0,1-1V1a1,1,0,0,0-2,0V2.47A1,1,0,0,0,12,3.47Z"
                                    style="fill: currentColor" />
                                <path
                                    d="M4.55,6a1,1,0,0,0,.71.29A1,1,0,0,0,6,6,1,1,0,0,0,6,4.55l-1-1A1,1,0,0,0,3.51,4.93Z"
                                    style="fill: currentColor" />
                                <path d="M2.47,11H1a1,1,0,0,0,0,2H2.47a1,1,0,1,0,0-2Z" style="fill: currentColor" />
                                <path
                                    d="M4.55,18l-1,1a1,1,0,0,0,0,1.42,1,1,0,0,0,.71.29,1,1,0,0,0,.71-.29l1-1A1,1,0,0,0,4.55,18Z"
                                    style="fill: currentColor" />
                                <path d="M12,20.53a1,1,0,0,0-1,1V23a1,1,0,0,0,2,0V21.53A1,1,0,0,0,12,20.53Z"
                                    style="fill: currentColor" />
                                <path
                                    d="M19.45,18A1,1,0,0,0,18,19.45l1,1a1,1,0,0,0,.71.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.42Z"
                                    style="fill: currentColor" />
                                <path d="M23,11H21.53a1,1,0,0,0,0,2H23a1,1,0,0,0,0-2Z" style="fill: currentColor" />
                                <path
                                    d="M18.74,6.26A1,1,0,0,0,19.45,6l1-1a1,1,0,1,0-1.42-1.42l-1,1A1,1,0,0,0,18,6,1,1,0,0,0,18.74,6.26Z"
                                    style="fill: currentColor" />
                            </g>
                        </svg>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <button type="button" class="dropdown-item active" data-theme-value="light">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="me-2"
                                    height="18" width="18">
                                    <g>
                                        <path
                                            d="M12,4.64A7.36,7.36,0,1,0,19.36,12,7.37,7.37,0,0,0,12,4.64Zm0,12.72A5.36,5.36,0,1,1,17.36,12,5.37,5.37,0,0,1,12,17.36Z"
                                            style="fill: currentColor" />
                                        <path d="M12,3.47a1,1,0,0,0,1-1V1a1,1,0,0,0-2,0V2.47A1,1,0,0,0,12,3.47Z"
                                            style="fill: currentColor" />
                                        <path
                                            d="M4.55,6a1,1,0,0,0,.71.29A1,1,0,0,0,6,6,1,1,0,0,0,6,4.55l-1-1A1,1,0,0,0,3.51,4.93Z"
                                            style="fill: currentColor" />
                                        <path d="M2.47,11H1a1,1,0,0,0,0,2H2.47a1,1,0,1,0,0-2Z"
                                            style="fill: currentColor" />
                                        <path
                                            d="M4.55,18l-1,1a1,1,0,0,0,0,1.42,1,1,0,0,0,.71.29,1,1,0,0,0,.71-.29l1-1A1,1,0,0,0,4.55,18Z"
                                            style="fill: currentColor" />
                                        <path d="M12,20.53a1,1,0,0,0-1,1V23a1,1,0,0,0,2,0V21.53A1,1,0,0,0,12,20.53Z"
                                            style="fill: currentColor" />
                                        <path
                                            d="M19.45,18A1,1,0,0,0,18,19.45l1,1a1,1,0,0,0,.71.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.42Z"
                                            style="fill: currentColor" />
                                        <path d="M23,11H21.53a1,1,0,0,0,0,2H23a1,1,0,0,0,0-2Z"
                                            style="fill: currentColor" />
                                        <path
                                            d="M18.74,6.26A1,1,0,0,0,19.45,6l1-1a1,1,0,1,0-1.42-1.42l-1,1A1,1,0,0,0,18,6,1,1,0,0,0,18.74,6.26Z"
                                            style="fill: currentColor" />
                                    </g>
                                </svg>
                                Light mode
                            </button>
                        </li>
                        <li>
                            <button type="button" class="dropdown-item" data-theme-value="dark">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="me-2"
                                    height="18" width="18">
                                    <path
                                        d="M19.57,23.34a1,1,0,0,0,0-1.9,9.94,9.94,0,0,1,0-18.88,1,1,0,0,0,.68-.94,1,1,0,0,0-.68-.95A11.58,11.58,0,0,0,8.88,2.18,12.33,12.33,0,0,0,3.75,12a12.31,12.31,0,0,0,5.11,9.79A11.49,11.49,0,0,0,15.61,24,12.55,12.55,0,0,0,19.57,23.34ZM10,20.17A10.29,10.29,0,0,1,5.75,12a10.32,10.32,0,0,1,4.3-8.19A9.34,9.34,0,0,1,15.59,2a.17.17,0,0,1,.17.13.18.18,0,0,1-.07.2,11.94,11.94,0,0,0-.18,19.21.25.25,0,0,1-.16.45A9.5,9.5,0,0,1,10,20.17Z"
                                        style="fill: currentColor" />
                                </svg>
                                Dark mode
                            </button>
                        </li>
                        <li>
                            <button type="button" class="dropdown-item" data-theme-value="auto">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="me-2"
                                    height="18" width="18">
                                    <path
                                        d="M24,12a1,1,0,0,0-1-1H19.09a.51.51,0,0,1-.49-.4,6.83,6.83,0,0,0-.94-2.28.5.5,0,0,1,.06-.63l2.77-2.76a1,1,0,1,0-1.42-1.42L16.31,6.28a.5.5,0,0,1-.63.06A6.83,6.83,0,0,0,13.4,5.4a.5.5,0,0,1-.4-.49V1a1,1,0,0,0-2,0V4.91a.51.51,0,0,1-.4.49,6.83,6.83,0,0,0-2.28.94.5.5,0,0,1-.63-.06L4.93,3.51A1,1,0,0,0,3.51,4.93L6.28,7.69a.5.5,0,0,1,.06.63A6.83,6.83,0,0,0,5.4,10.6a.5.5,0,0,1-.49.4H1a1,1,0,0,0,0,2H4.91a.51.51,0,0,1,.49.4,6.83,6.83,0,0,0,.94,2.28.5.5,0,0,1-.06.63L3.51,19.07a1,1,0,1,0,1.42,1.42l2.76-2.77a.5.5,0,0,1,.63-.06,6.83,6.83,0,0,0,2.28.94.5.5,0,0,1,.4.49V23a1,1,0,0,0,2,0V19.09a.51.51,0,0,1,.4-.49,6.83,6.83,0,0,0,2.28-.94.5.5,0,0,1,.63.06l2.76,2.77a1,1,0,1,0,1.42-1.42l-2.77-2.76a.5.5,0,0,1-.06-.63,6.83,6.83,0,0,0,.94-2.28.5.5,0,0,1,.49-.4H23A1,1,0,0,0,24,12Zm-8.74,2.5A5.76,5.76,0,0,1,9.5,8.74a5.66,5.66,0,0,1,.16-1.31A.49.49,0,0,1,10,7.07a5.36,5.36,0,0,1,1.8-.31,5.47,5.47,0,0,1,5.46,5.46,5.36,5.36,0,0,1-.31,1.8.49.49,0,0,1-.35.32A5.53,5.53,0,0,1,15.26,14.5Z"
                                        style="fill: currentColor" />
                                </svg>
                                Auto
                            </button>
                        </li>
                    </ul>
                </div>

                <!-- Separator -->
                <div class="vr bg-gray-700 mx-2 mx-lg-3"></div>
                <!-- Button -->
                <a class="d-flex align-items-center justify-content-center bg-white rounded-circle shadow-sm mx-1 mx-lg-2 w-40px h-40px position-relative link-secondary"
                    data-bs-toggle="offcanvas" href="#offcanvasNotifications" role="button"
                    aria-controls="offcanvasNotifications">
                    <svg viewBox="0 0 24 24" height="18" width="18" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10,21.75a2.087,2.087,0,0,0,4.005,0" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                        <path d="M12 3L12 0.75" fill="none" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="1.5" />
                        <path
                            d="M12,3a7.5,7.5,0,0,1,7.5,7.5c0,7.046,1.5,8.25,1.5,8.25H3s1.5-1.916,1.5-8.25A7.5,7.5,0,0,1,12,3Z"
                            fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="1.5" />
                    </svg>
                   
                </a>

                <!-- Notifications offcanvas -->
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNotifications"
                    aria-labelledby="offcanvasNotificationsLabel">
                    <div class="offcanvas-header px-5">
                        <h3 class="offcanvas-title" id="offcanvasNotificationsLabel">Notifications</h3>
                        <div class="d-flex align-items-start">
                            <!-- Button -->
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                    </div>

                    <div class="offcanvas-body p-0">
                        <div class="list-group list-group-flush">
                           
                        </div>
                    </div>
                </div>
                <!-- Separator -->
                <div class="vr bg-gray-700 mx-2 mx-lg-3"></div>

                <!-- Dropdown -->
                <div class="dropdown">
                    <a href="javascript: void(0);"
                        class="dropdown-toggle no-arrow d-flex align-items-center justify-content-center bg-white rounded-circle shadow-sm mx-1 mx-lg-2 w-40px h-40px"
                        role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true"
                        aria-expanded="false" data-bs-offset="0,0">
                        <div class="avatar avatar-circle avatar-sm avatar-online">
                            @if (auth()->user()->profile_photo_path)
                                <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}"
                                    alt="Profile picture" class="avatar-img" width="40" height="40">
                            @else
                                <img src="https://png.pngtree.com/png-vector/20220521/ourlarge/pngtree-avatar-profile-icon-png-image_4644647.png"
                                    alt="..." class="avatar-img" width="40" height="40">
                            @endif
                        </div>
                    </a>

                    <div class="dropdown-menu">
                        <div class="dropdown-item-text">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 ms-3">
                                    <h4 class="mb-0">{{ auth()->user()->name }}</h4>
                                    <p class="card-text">{{ auth()->user()->email }}</p>
                                </div>
                            </div>
                        </div>
                        <hr class="dropdown-divider">
                        <!-- Dropdown -->
                        <div class="dropdown dropend">
                            <a class="dropdown-item dropdown-toggle" href="javascript: void(0);" id="statusDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="-16,10">
                                Quick links
                            </a>
                            <div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-sub-menu"
                                aria-labelledby="statusDropdown">
                                <a class="dropdown-item" href="{{ route('deposits') }}">
                                    Deposit
                                </a>
                                <a class="dropdown-item" href="{{ route('withdrawalsdeposits') }}">
                                    Withdrawal request
                                </a>
                            </div>
                        </div>
                        <!-- End Dropdown -->

                        <a class="dropdown-item" href="{{ route('profile') }}">Profile & account</a>
                        @if ($moresettings->use_transfer)
                            <a class="dropdown-item" href="{{ route('transferview') }}">Transfer</a>
                        @endif
                        <hr class="dropdown-divider">

                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">Sign
                            out</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <div class="container-fluid mb-5">
            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="mt-auto">
            <div class="container-fluid mt-4 mb-6 text-muted">
                <div class="row justify-content-between">
                    <div class="col">
                        All Rights Reserved &copy; {{ $settings->site_name }} {{$settings->twak}}
                    </div>

                    <div class="col-auto">
                        @if ($settings->google_translate == 'on')
                            <div id="google_translate_element"></div>
                        @endif
                    </div>
                </div> <!-- / .row -->
            </div>
        </footer>
    </main> <!-- / main -->



  @livewireScripts
    @section('scripts')
        <!--   Core JS Files   -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        {{-- <script src="{{ asset('dash/js/core/jquery.3.2.1.min.js')}} "></script> --}}
        <script src="{{ asset('dash/js/core/popper.min.js') }}"></script>
        <script src="{{ asset('dash/js/core/bootstrap.min.js') }} "></script>
        <!-- jQuery UI -->
        <script src="{{ asset('dash/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('dash/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>
        <!-- jQuery Scrollbar -->
        <script src="{{ asset('dash/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }} "></script>
        <!-- jQuery Sparkline -->
        <script src="{{ asset('dash/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }} "></script>
        <!-- Sweet Alert -->
        <script src="{{ asset('dash/js/plugin/sweetalert/sweetalert.min.js') }} "></script>
        <!-- Bootstrap Notify -->
        <script src="{{ asset('dash/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }} "></script>

        <script type="text/javascript"
            src="https://cdn.datatables.net/v/bs4/dt-1.10.21/af-2.3.5/b-1.6.3/b-flash-1.6.3/b-html5-1.6.3/b-print-1.6.3/r-2.2.5/datatables.min.js">
        </script>

        <script src="{{ asset('dash/js/atlantis.min.js') }}"></script>
        <script src="{{ asset('dash/js/atlantis.js') }}"></script>

        <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
        </script>

        <script type="text/javascript">
            function googleTranslateElementInit() {
                new google.translate.TranslateElement({
                    pageLanguage: 'en'
                }, 'google_translate_element');
            }
        </script>
        <script src="{{ asset('dash/js/customs.js') }}"></script>
    @show
    <!-- JAVASCRIPT-->
    <!-- Theme JS -->

    <script src="{{ asset('themes/dashly/assets/js/theme.bundle.js') }}"></script>
    @if ($settings->google_translate == 'on')
        <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
        </script>

        <script type="text/javascript">
            function googleTranslateElementInit() {
                new google.translate.TranslateElement({
                    pageLanguage: 'en'
                }, 'google_translate_element');
            }
        </script>
    @endif
    @livewireScripts
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="{{ asset('themes/dashly/assets/ext/dist/toastr.min.js') }}"></script>
    @stack('scripts')



    @section('scripts')
        <!-- Scripts -->
        <!-- Core JS - includes jquery, bootstrap, popper, in-view and sticky-kit -->
        <script src="{{ asset('themes/purposeTheme/assets/js/purpose.core.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <!-- Bootstrap Notify -->
        <script src="{{ asset('themes/purposeTheme/assets/libs/bootstrap-notify/bootstrap-notify.min.js') }} "></script>
        <!-- Page JS -->
        <script src="{{ asset('themes/purposeTheme/assets/libs/progressbar.js/dist/progressbar.min.js') }}"></script>
        <script src="{{ asset('themes/purposeTheme/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
        <script src="{{ asset('themes/purposeTheme/assets/libs/moment/min/moment.min.js') }}"></script>
        <script src="{{ asset('themes/purposeTheme/assets/libs/fullcalendar/dist/fullcalendar.min.js') }}"></script>
        <script src="{{ asset('themes/purposeTheme/assets/libs/sweetalert/sweetalert.min.js') }} "></script>
        <!-- Purpose JS -->
        <script src="{{ asset('themes/purposeTheme/assets/js/purpose.js') }}"></script>
        <script type="text/javascript"
            src="https://cdn.datatables.net/v/bs4/dt-1.10.21/af-2.3.5/b-1.6.3/b-flash-1.6.3/b-html5-1.6.3/b-print-1.6.3/r-2.2.5/datatables.min.js">
        </script>
        {{-- my custom javascript file --}}
        <script src="{{ asset('themes/purposeTheme/assets/libs/flatpickr/dist/flatpickr.min.js') }}"></script>

    @show
    
    
    
    @if($settings->tido)
    <script src="//code.tidio.co/{{$settings->tido}}.js" async></script>
    @endif
    
    
    <!-- GetButton.io widget -->
    @if($settings->whatsapp)
<script type="text/javascript">
    (function () {
        var options = {
            whatsapp: "{{$settings->whatsapp}}", // WhatsApp number
            call_to_action: "Message us", // Call to action
            button_color: "#FF6550", // Color of button
            position: "left", // Position may be 'right' or 'left'
        };
        var proto = 'https:', host = "getbutton.io", url = proto + '//static.' + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>
  @endif
</body>

</html>
