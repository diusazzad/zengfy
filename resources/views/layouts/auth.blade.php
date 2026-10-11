<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Zengfy Unified Auth | Sovereign Identity Portal')</title>
    <meta name="description" content="@yield('meta_description', 'Secure Single Sign-On (SSO) identity gateway for Zengfy Ecosystem.')">

    <!-- Fonts (Non-blocking Font Load to improve FCP & LCP) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" media="print" onload="this.media='all'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap">
    </noscript>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Tailwind CSS / Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            font-display: swap;
            background-color: #ffffff;
            color: #0f172a;
        }

        /* Glassmorphism Utilities (Identical to Landing Page) */
        .glass-panel {
            background: rgba(255, 255, 255, 0.82);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(226, 232, 240, 0.9);
            box-shadow: 0 20px 45px -15px rgba(0, 0, 0, 0.06), 0 0 0 1px rgba(255, 255, 255, 0.8);
        }

        .glass-input {
            background: rgba(248, 250, 252, 0.85);
            border: 1px solid rgba(226, 232, 240, 0.95);
            color: #0f172a;
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .glass-input:focus {
            background: #ffffff;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
            outline: none;
        }

        /* Custom Subtle Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #f8fafc;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>

    @stack('head')
</head>

<body class="bg-white text-slate-800 min-h-screen flex flex-col justify-between selection:bg-blue-600 selection:text-white antialiased relative overflow-x-hidden">

    <!-- Ambient Glass Gradient Background (Light & Airy - Benchmarked against Landing Page) -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0" aria-hidden="true">
        <!-- Soft Sky Blue Orb Top Left -->
        <div class="absolute -top-40 -left-40 w-[600px] h-[600px] rounded-full bg-gradient-to-br from-blue-100/70 via-sky-100/50 to-transparent blur-3xl opacity-80"></div>
        <!-- Soft Indigo Orb Top Right -->
        <div class="absolute top-10 -right-40 w-[650px] h-[650px] rounded-full bg-gradient-to-bl from-indigo-100/60 via-purple-100/40 to-transparent blur-3xl opacity-70"></div>
        <!-- Soft Amber/Warm Orb Center Mid -->
        <div class="absolute top-[45%] left-1/2 -translate-x-1/2 w-[800px] h-[500px] rounded-full bg-gradient-to-tr from-amber-50/50 via-blue-50/40 to-transparent blur-3xl opacity-60"></div>
        <!-- Very Subtle Vector Grid -->
        <div class="absolute inset-0 bg-[radial-gradient(#e2e8f0_1px,transparent_1px)] [background-size:28px_28px] opacity-60"></div>
    </div>

    <!-- Header / Brand Logo & Navigation (WCAG Label-in-Name Compliant) -->
    <header class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 sm:pt-8 flex items-center justify-between">
        <a href="/" class="flex items-center gap-2.5 sm:gap-3 group focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 rounded-xl p-1.5 min-w-[44px] min-h-[44px]">
            <div aria-hidden="true" class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-gradient-to-tr from-blue-600 via-indigo-600 to-cyan-500 flex items-center justify-center font-black text-lg sm:text-xl text-white shadow-md shadow-blue-500/20 group-hover:scale-105 transition-transform duration-300">
                Z
            </div>
            <span class="text-xl sm:text-2xl font-extrabold tracking-tight text-slate-900 group-hover:text-blue-600 transition-colors">
                Zengfy<span class="text-blue-600 font-black" aria-hidden="true">.</span>
            </span>
        </a>

        <div class="flex items-center gap-3">
            <a href="/" class="inline-flex items-center gap-2 text-xs sm:text-sm font-semibold text-slate-600 hover:text-slate-900 transition-colors bg-white/80 hover:bg-white border border-slate-200/80 px-4 py-2 min-h-[44px] rounded-xl shadow-xs backdrop-blur-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                <svg class="w-4 h-4 text-slate-500" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Back to Home</span>
            </a>
        </div>
    </header>

    <!-- Main Content Landmark -->
    <main id="main-content" role="main" class="relative z-10 flex-grow flex items-center justify-center px-4 py-8 sm:py-12">
        <div class="w-full max-w-md">
            @yield('content')
        </div>
    </main>

    <!-- Sovereign Security & Trust Footer (WCAG Touch Target: min 44px) -->
    <footer class="relative z-10 w-full max-w-7xl mx-auto px-4 py-6 text-center text-xs text-slate-500 border-t border-slate-200/70">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
            <div class="flex items-center gap-2 text-slate-600">
                <svg class="w-4 h-4 text-emerald-600 shrink-0" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                <span class="font-medium">Protected by 256-Bit SSL Encryption & Sovereign Vault</span>
            </div>
            <div class="flex items-center gap-4 text-slate-500">
                <a href="{{ route('terms') }}" class="hover:text-slate-800 transition-colors py-2 px-2 min-h-[44px] inline-flex items-center focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 rounded-lg">Terms of Service</a>
                <span>&bull;</span>
                <a href="{{ route('faq') }}" class="hover:text-slate-800 transition-colors py-2 px-2 min-h-[44px] inline-flex items-center focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 rounded-lg">Help & FAQ</a>
                <span>&bull;</span>
                <span>&copy; {{ date('Y') }} Zengfy Inc.</span>
            </div>
        </div>
    </footer>

    <!-- Back-Forward Cache (bfcache) Buster -->
    <script>
        window.addEventListener('pageshow', function (event) {
            if (event.persisted) {
                window.location.reload();
            }
        });
    </script>

    <!-- Progressive Web App Service Worker Registration -->
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function () {
                navigator.serviceWorker.register('/sw.js?v=4')
                    .then(function (registration) {
                        console.log('[Zengfy PWA] Service Worker registered:', registration.scope);
                        registration.update();
                    })
                    .catch(function (error) {
                        console.warn('[Zengfy PWA] Service Worker registration failed:', error);
                    });
            });
        }
    </script>

    @stack('scripts')
</body>
</html>
