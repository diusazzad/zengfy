<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Zengfy Unified Auth | Sovereign Identity Portal')</title>
    <meta name="description" content="@yield('meta_description', 'Secure Single Sign-On (SSO) and NID-verified identity gateway for Zengfy Ecosystem.')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (CDN configured with brand tokens) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            dark: '#0B0F17',
                            card: '#121A29',
                            cardBorder: 'rgba(255, 255, 255, 0.08)',
                            primary: '#2563EB',
                            primaryHover: '#1D4ED8',
                            accent: '#06B6D4',
                            indigo: '#4F46E5',
                        }
                    },
                    animation: {
                        'pulse-slow': 'pulse 6s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #0B0F17;
            color: #F3F4F6;
        }
        /* Custom Subtle Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #0B0F17;
        }
        ::-webkit-scrollbar-thumb {
            background: #1F2937;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #374151;
        }
    </style>

    @stack('head')
</head>

<body class="bg-[#0B0F17] text-gray-100 min-h-screen flex flex-col justify-between selection:bg-blue-600 selection:text-white antialiased relative overflow-x-hidden">

    <!-- Ambient Glowing Background Grid & Orbs -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0" aria-hidden="true">
        <!-- Radial Gradient Glow Top -->
        <div class="absolute -top-40 left-1/2 -translate-x-1/2 w-[700px] h-[500px] bg-gradient-to-b from-blue-600/20 via-indigo-600/10 to-transparent blur-3xl opacity-70 animate-pulse-slow"></div>
        <!-- Radial Gradient Glow Bottom Right -->
        <div class="absolute -bottom-40 right-10 w-[500px] h-[500px] bg-gradient-to-t from-cyan-500/15 via-blue-700/10 to-transparent blur-3xl opacity-50"></div>
        <!-- Subtle Vector Grid Pattern -->
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff05_1px,transparent_1px),linear-gradient(to_bottom,#ffffff05_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)]"></div>
    </div>

    <!-- Header / Brand Logo & Navigation -->
    <header class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 sm:pt-8 flex items-center justify-between">
        <a href="/" class="flex items-center gap-3 group focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 rounded-xl p-1">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 via-indigo-600 to-cyan-400 flex items-center justify-center font-black text-xl text-white shadow-lg shadow-blue-500/25 group-hover:scale-105 transition-transform duration-300">
                Z
            </div>
            <span class="text-2xl font-extrabold tracking-tight text-white group-hover:text-gray-200 transition-colors">
                Zengfy<span class="text-blue-500 font-black">.</span>
            </span>
        </a>

        <div class="flex items-center gap-3">
            <a href="/" class="inline-flex items-center gap-2 text-xs sm:text-sm font-semibold text-gray-400 hover:text-white transition-colors bg-white/[0.04] hover:bg-white/[0.08] border border-white/10 px-3.5 py-1.5 sm:py-2 rounded-xl backdrop-blur-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Back to Home</span>
            </a>
        </div>
    </header>

    <!-- Main Content Injection -->
    <main class="relative z-10 flex-grow flex items-center justify-center px-4 py-8 sm:py-12">
        <div class="w-full max-w-md">
            @yield('content')
        </div>
    </main>

    <!-- Sovereign Security & Trust Footer -->
    <footer class="relative z-10 w-full max-w-7xl mx-auto px-4 py-6 text-center text-xs text-gray-400 border-t border-white/[0.06]">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
            <div class="flex items-center gap-2 text-gray-400">
                <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                <span class="font-medium text-gray-300">Protected by 256-Bit Cloud Encryption & Anti-Bot Shield</span>
            </div>
            <div class="flex items-center gap-4 text-gray-400">
                <a href="{{ route('terms') }}" class="hover:text-gray-200 transition-colors">Terms of Service</a>
                <span>&bull;</span>
                <a href="{{ route('faq') }}" class="hover:text-gray-200 transition-colors">Help & FAQ</a>
                <span>&bull;</span>
                <span class="text-gray-400">&copy; {{ date('Y') }} Zengfy Inc.</span>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
