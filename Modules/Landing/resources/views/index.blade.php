<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zengfy | One Account. Infinite Ecosystem.</title>
    <meta name="description" content="Manage your school ERP, business POS, and legal practice with one secure unified account.">
    <meta name="keywords" content="Zengfy, Ecosystem, School ERP, POS Bangladesh, Legal Management, Unified SaaS">
    <meta name="author" content="Zengfy Inc.">

    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Zengfy | One Account. Infinite Ecosystem.">
    <meta property="og:description" content="Manage your school, business POS, and legal practice with one secure account.">
    <meta property="og:image" content="{{ asset('images/logo.png') }}">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Tailwind CSS / Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background-color: #ffffff;
            color: #0f172a;
        }

        /* Glassmorphism Utilities */
        .glass-panel {
            background: rgba(255, 255, 255, 0.72);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.85);
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.05), 0 20px 25px -5px rgba(0, 0, 0, 0.02);
        }

        .glass-panel-subtle {
            background: rgba(255, 255, 255, 0.55);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.65);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.03);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .glass-card:hover {
            transform: translateY(-4px);
            background: rgba(255, 255, 255, 0.92);
            border-color: rgba(59, 130, 246, 0.35);
            box-shadow: 0 20px 35px -10px rgba(37, 99, 235, 0.12);
        }

        .glass-nav {
            background: rgba(255, 255, 255, 0.82);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        }
    </style>
</head>

<body class="bg-white text-slate-800 antialiased selection:bg-blue-600 selection:text-white overflow-x-hidden min-h-screen flex flex-col justify-between">

    <!-- Ambient Glass Gradient Background (Light & Airy) -->
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

    <!-- ========================================================================= -->
    <!-- 1. Header Navigation (Glassmorphic, Simple, No Company/Terms/FAQ/Sign Up) -->
    <!-- ========================================================================= -->
    <nav x-data="{ mobileOpen: false, productsOpen: false }" id="main-navbar"
        class="fixed top-0 left-0 right-0 z-50 glass-nav transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-18 sm:h-20 flex items-center justify-between">

            <!-- Brand Logo (Accessible Name & 44px Touch Target) -->
            <a href="{{ route('welcome') }}" aria-label="Zengfy"
                class="flex items-center gap-2.5 sm:gap-3 group shrink-0 rounded-xl p-1.5 min-h-[44px] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                <div aria-hidden="true"
                    class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-gradient-to-tr from-blue-600 via-indigo-600 to-cyan-500 flex items-center justify-center font-black text-lg sm:text-xl text-white shadow-md shadow-blue-500/20 group-hover:scale-105 transition-transform duration-300">
                    Z
                </div>
                <span class="text-xl sm:text-2xl font-extrabold tracking-tight text-slate-900 group-hover:text-blue-600 transition-colors">
                    Zengfy<span class="text-blue-600 font-black" aria-hidden="true">.</span>
                </span>
            </a>

            <!-- Center Navigation (Simple & Essential Links Only) -->
            <div class="hidden md:flex items-center gap-1 lg:gap-2 text-sm font-medium text-slate-600">

                <!-- Products Dropdown (Glassmorphic) -->
                <div class="relative" @mouseenter="productsOpen = true" @mouseleave="productsOpen = false">
                    <a href="{{ route('products') }}"
                        class="inline-flex items-center gap-1.5 hover:text-blue-600 text-slate-700 transition-colors py-2.5 px-3.5 min-h-[44px] rounded-xl hover:bg-slate-100/70 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                        <span>Products</span>
                        <svg class="w-4 h-4 transition-transform duration-200"
                            :class="productsOpen ? 'rotate-180 text-blue-600' : 'text-slate-400'" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>

                    <!-- Products Glass Dropdown Panel -->
                    <div x-show="productsOpen" x-cloak
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                        x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                        class="absolute top-full left-0 w-[480px] glass-panel border border-slate-200/80 rounded-2xl p-3 shadow-2xl grid grid-cols-2 gap-2 z-50">

                        <a href="{{ route('products') }}"
                            class="col-span-2 p-3 rounded-xl bg-blue-50/80 hover:bg-blue-100/80 border border-blue-200/60 flex items-center justify-between group transition-colors">
                            <div>
                                <p class="text-xs font-bold text-blue-700 uppercase tracking-wider">All Applications</p>
                                <p class="text-xs text-slate-600 mt-0.5">Explore full suite of modular systems</p>
                            </div>
                            <span class="text-blue-600 font-bold group-hover:translate-x-1 transition-transform">→</span>
                        </a>

                        <a href="{{ env('APP_ENV') === 'local' ? 'http://school.zengfy.test:7000' : 'https://school.zengfy.top' }}"
                            target="_blank" rel="noopener noreferrer"
                            class="p-2.5 rounded-xl hover:bg-slate-100/80 flex items-center gap-3 transition-colors">
                            <span class="text-xl">🏫</span>
                            <div>
                                <p class="text-xs font-bold text-slate-800">Zengfy School</p>
                                <p class="text-[10px] text-slate-500">Academic ERP</p>
                            </div>
                        </a>

                        <a href="{{ env('APP_ENV') === 'local' ? 'http://pos.zengfy.test:7000' : 'https://pos.zengfy.top' }}"
                            target="_blank" rel="noopener noreferrer"
                            class="p-2.5 rounded-xl hover:bg-slate-100/80 flex items-center gap-3 transition-colors">
                            <span class="text-xl">🛒</span>
                            <div>
                                <p class="text-xs font-bold text-slate-800">Zengfy POS</p>
                                <p class="text-[10px] text-slate-500">Retail & Stock</p>
                            </div>
                        </a>

                        <a href="{{ env('APP_ENV') === 'local' ? 'http://law.zengfy.test:7000' : 'https://law.zengfy.top' }}"
                            target="_blank" rel="noopener noreferrer"
                            class="p-2.5 rounded-xl hover:bg-slate-100/80 flex items-center gap-3 transition-colors">
                            <span class="text-xl">⚖️</span>
                            <div>
                                <p class="text-xs font-bold text-slate-800">Zengfy Law</p>
                                <p class="text-[10px] text-slate-500">Case Schedules</p>
                            </div>
                        </a>

                        <a href="{{ env('APP_ENV') === 'local' ? 'http://social.zengfy.test:7000' : 'https://social.zengfy.top' }}"
                            target="_blank" rel="noopener noreferrer"
                            class="p-2.5 rounded-xl hover:bg-slate-100/80 flex items-center gap-3 transition-colors">
                            <span class="text-xl">🌐</span>
                            <div>
                                <p class="text-xs font-bold text-slate-800">Zengfy Social</p>
                                <p class="text-[10px] text-slate-500">Feed & Circles</p>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Pricing Link -->
                <a href="{{ route('pricing') }}"
                    class="hover:text-blue-600 text-slate-700 transition-colors py-2.5 px-3.5 min-h-[44px] inline-flex items-center rounded-xl hover:bg-slate-100/70 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                    Pricing
                </a>

                <!-- Android App APK Download -->
                <a href="/download"
                    class="inline-flex items-center gap-1.5 text-blue-600 hover:text-blue-700 font-semibold transition-colors py-2.5 px-3.5 min-h-[44px] rounded-xl hover:bg-blue-50/70 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                    <span>📱 Android App</span>
                    <span class="text-[10px] px-1.5 py-0.5 rounded-full bg-blue-100 text-blue-700 font-bold border border-blue-200/60">APK</span>
                </a>
            </div>

            <!-- Right Actions: Sign In Button -->
            <div class="flex items-center gap-3 shrink-0">
                <a href="/login"
                    class="inline-flex items-center justify-center gap-2 px-6 py-2.5 min-h-[44px] rounded-full bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/30 active:scale-95 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                    <span>Sign In</span>
                    <svg class="w-4 h-4 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>

                <!-- Mobile Hamburger Button -->
                <button @click="mobileOpen = !mobileOpen" id="mobile-menu-btn" aria-label="Toggle Mobile Navigation"
                    type="button"
                    class="md:hidden min-w-[44px] min-h-[44px] p-2.5 rounded-xl text-slate-600 hover:text-slate-900 bg-slate-100/80 border border-slate-200/80 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 shrink-0 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Drawer (Clean & Simple) -->
        <div x-show="mobileOpen" x-cloak id="mobile-menu-drawer"
            class="md:hidden glass-panel border-b border-slate-200 px-4 py-4 space-y-2 text-sm font-semibold text-slate-700">
            <a @click="mobileOpen = false" href="/download"
                class="flex items-center text-blue-600 font-bold py-2.5 px-3 min-h-[44px] rounded-xl hover:bg-slate-100/80">📱 Download Android APK →</a>
            <a @click="mobileOpen = false" href="{{ route('products') }}"
                class="flex items-center py-2.5 px-3 min-h-[44px] rounded-xl hover:bg-slate-100/80">Products & Services</a>
            <a @click="mobileOpen = false" href="{{ route('pricing') }}"
                class="flex items-center py-2.5 px-3 min-h-[44px] rounded-xl hover:bg-slate-100/80">Pricing Plans</a>
        </div>
    </nav>

    <!-- ========================================================================= -->
    <!-- Main Content Area (Glassmorphic, Clean, Minimalist, White Background) -->
    <!-- ========================================================================= -->
    <main id="main-content" role="main" class="relative z-10 pt-28 sm:pt-32 pb-20">

        <!-- 2. Hero Section (Simple, Minimalist, White Background, Glassmorphic) -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-6 sm:pt-10 pb-16 sm:pb-24">
            
            <!-- Sleek Glass Feature Pill -->
            <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full glass-panel-subtle text-slate-700 text-xs sm:text-sm font-semibold mb-6 sm:mb-8 shadow-sm">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>Single Sign-On • 10+ Connected Operating Apps</span>
            </div>

            <!-- Main Headline -->
            <h1 class="text-4xl sm:text-6xl md:text-7xl font-extrabold tracking-tight leading-[1.1] max-w-5xl mx-auto text-slate-900">
                One Unified Account. <br class="hidden sm:inline" />
                <span class="bg-gradient-to-r from-blue-600 via-indigo-600 to-cyan-600 bg-clip-text text-transparent">
                    Infinite Digital Ecosystem.
                </span>
            </h1>

            <!-- Subheadline in English and Bengali -->
            <p class="mt-5 sm:mt-6 text-base sm:text-lg md:text-xl text-slate-600 max-w-3xl mx-auto font-normal leading-relaxed">
                Connect your school ERP, retail point of sale, legal case files, and team operations under one seamless sovereign identity.
                <span class="text-blue-700 font-medium block mt-2 text-sm sm:text-base">
                    একটি একাউন্টেই স্কুল ম্যানেজমেন্ট, রিটেইল পিওএস, আইনি কেস ভল্ট এবং সকল প্রয়োজনীয় ডিজিটাল সমাধান।
                </span>
            </p>

            <!-- Action CTAs -->
            <div class="mt-8 sm:mt-10 flex flex-col sm:flex-row items-center justify-center gap-3.5 sm:gap-4 max-w-md mx-auto">
                <a href="/login"
                    class="w-full sm:w-auto px-8 py-3.5 rounded-full bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm sm:text-base shadow-lg shadow-blue-500/25 hover:shadow-xl hover:shadow-blue-500/35 active:scale-95 transition-all flex items-center justify-center gap-2 min-h-[48px]">
                    <span>Sign In to Account / লগইন করুন</span>
                    <span>→</span>
                </a>

                <a href="#ecosystem"
                    class="w-full sm:w-auto px-8 py-3.5 rounded-full glass-panel hover:bg-white text-slate-700 hover:text-slate-900 font-semibold text-sm sm:text-base border border-slate-200/80 transition-all flex items-center justify-center gap-2 min-h-[48px]">
                    <span>Explore Ecosystem / সার্ভিসসমূহ</span>
                    <span>↓</span>
                </a>
            </div>

            <!-- Glassmorphic Preview Hero Box (Clean Interactive Showcase) -->
            <div class="mt-14 sm:mt-18 max-w-5xl mx-auto glass-panel rounded-3xl p-4 sm:p-7 border border-white/80 shadow-2xl relative">
                <!-- Browser Window Top Bar -->
                <div class="flex items-center justify-between pb-4 mb-5 border-b border-slate-200/60">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-rose-400"></div>
                        <div class="w-3 h-3 rounded-full bg-amber-400"></div>
                        <div class="w-3 h-3 rounded-full bg-emerald-400"></div>
                        <span class="ml-3 text-xs font-mono text-slate-400 hidden sm:inline">zengfy.test — Unified App Hub</span>
                    </div>
                    <div class="inline-flex items-center gap-1.5 text-xs font-semibold px-3 py-1 rounded-full bg-blue-50 text-blue-700 border border-blue-200/60">
                        <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                        <span>Single Sign-On Active</span>
                    </div>
                </div>

                <!-- 4 Live App Glass Tiles -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3.5 text-left">
                    
                    <!-- School Tile -->
                    <div class="glass-card rounded-2xl p-4 bg-white/60">
                        <div class="flex items-center justify-between mb-2.5">
                            <span class="text-xl">🏫</span>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800">ERP Suite</span>
                        </div>
                        <h2 class="text-sm font-bold text-slate-900">Zengfy School</h2>
                        <p class="text-xs text-slate-500 mt-1">Student attendance, exams & fee collection.</p>
                    </div>

                    <!-- POS Tile -->
                    <div class="glass-card rounded-2xl p-4 bg-white/60">
                        <div class="flex items-center justify-between mb-2.5">
                            <span class="text-xl">🛒</span>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-blue-100 text-blue-800">Retail & Stock</span>
                        </div>
                        <h2 class="text-sm font-bold text-slate-900">Zengfy POS</h2>
                        <p class="text-xs text-slate-500 mt-1">Barcode scanning, stock & bKash checkout.</p>
                    </div>

                    <!-- Law Tile -->
                    <div class="glass-card rounded-2xl p-4 bg-white/60">
                        <div class="flex items-center justify-between mb-2.5">
                            <span class="text-xl">⚖️</span>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-purple-100 text-purple-800">Legal Vault</span>
                        </div>
                        <h2 class="text-sm font-bold text-slate-900">Zengfy Law</h2>
                        <p class="text-xs text-slate-500 mt-1">Court schedule dates & encrypted client files.</p>
                    </div>

                    <!-- Social Tile -->
                    <div class="glass-card rounded-2xl p-4 bg-white/60">
                        <div class="flex items-center justify-between mb-2.5">
                            <span class="text-xl">🌐</span>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-cyan-100 text-cyan-800">Community</span>
                        </div>
                        <h2 class="text-sm font-bold text-slate-900">Zengfy Social</h2>
                        <p class="text-xs text-slate-500 mt-1">Clean newsfeed, messaging & user profiles.</p>
                    </div>

                </div>
            </div>

        </section>

        <!-- ========================================================================= -->
        <!-- 3. Glassmorphic Ecosystem Bento Grid Section -->
        <!-- ========================================================================= -->
        <section id="ecosystem" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
            <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                <span class="text-xs uppercase font-extrabold tracking-widest text-blue-600 bg-blue-50 px-3 py-1 rounded-full border border-blue-200/50">
                    Modular Software Suite
                </span>
                <h2 class="text-3xl sm:text-5xl font-extrabold text-slate-900 tracking-tight mt-3">
                    Everything Connected in One Place
                </h2>
                <p class="text-sm sm:text-base text-slate-600 mt-3">
                    Switch between specialized business modules in one click using your unified login.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- 1. School ERP -->
                <div class="glass-card rounded-2xl p-6 sm:p-7 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-blue-100/80 border border-blue-200/60 flex items-center justify-center text-2xl mb-5 shadow-sm">
                            🏫
                        </div>
                        <span class="text-[11px] font-bold uppercase tracking-wider text-blue-600">Academic & Management</span>
                        <h3 class="text-xl font-bold text-slate-900 mt-1">Zengfy School</h3>
                        <p class="text-sm text-slate-600 mt-2 leading-relaxed">
                            Comprehensive school operations: automated student attendance, exam report cards, tuition fee receipts, and parent SMS notices.
                        </p>
                    </div>
                    <div class="pt-6 mt-6 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-500">৳3,000 / month</span>
                        <a href="{{ env('APP_ENV') === 'local' ? 'http://school.zengfy.test:7000' : 'https://school.zengfy.top' }}"
                            target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-600 hover:text-blue-800 py-1.5 px-3 rounded-lg hover:bg-blue-50 transition-colors">
                            Launch Portal →
                        </a>
                    </div>
                </div>

                <!-- 2. POS Retail & Inventory -->
                <div class="glass-card rounded-2xl p-6 sm:p-7 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-indigo-100/80 border border-indigo-200/60 flex items-center justify-center text-2xl mb-5 shadow-sm">
                            🛒
                        </div>
                        <span class="text-[11px] font-bold uppercase tracking-wider text-indigo-600">Retail & Commerce</span>
                        <h3 class="text-xl font-bold text-slate-900 mt-1">Zengfy POS</h3>
                        <p class="text-sm text-slate-600 mt-2 leading-relaxed">
                            Complete point of sale: multi-branch inventory, barcode scanner support, automated daily profit/loss, and instant bKash customer checkout.
                        </p>
                    </div>
                    <div class="pt-6 mt-6 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-500">৳40,000 One-time</span>
                        <a href="{{ env('APP_ENV') === 'local' ? 'http://pos.zengfy.test:7000' : 'https://pos.zengfy.top' }}"
                            target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center gap-1.5 text-xs font-bold text-indigo-600 hover:text-indigo-800 py-1.5 px-3 rounded-lg hover:bg-indigo-50 transition-colors">
                            Launch Portal →
                        </a>
                    </div>
                </div>

                <!-- 3. Legal Practice Suite -->
                <div class="glass-card rounded-2xl p-6 sm:p-7 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-purple-100/80 border border-purple-200/60 flex items-center justify-center text-2xl mb-5 shadow-sm">
                            ⚖️
                        </div>
                        <span class="text-[11px] font-bold uppercase tracking-wider text-purple-600">Legal Practice</span>
                        <h3 class="text-xl font-bold text-slate-900 mt-1">Zengfy Law</h3>
                        <p class="text-sm text-slate-600 mt-2 leading-relaxed">
                            Organize case numbers, hearing dates, client billing, and court documents inside a bank-grade 256-bit encrypted legal vault.
                        </p>
                    </div>
                    <div class="pt-6 mt-6 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-500">৳500 / month</span>
                        <a href="{{ env('APP_ENV') === 'local' ? 'http://law.zengfy.test:7000' : 'https://law.zengfy.top' }}"
                            target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center gap-1.5 text-xs font-bold text-purple-600 hover:text-purple-800 py-1.5 px-3 rounded-lg hover:bg-purple-50 transition-colors">
                            Launch Portal →
                        </a>
                    </div>
                </div>

                <!-- 4. Community & Social -->
                <div class="glass-card rounded-2xl p-6 sm:p-7 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-cyan-100/80 border border-cyan-200/60 flex items-center justify-center text-2xl mb-5 shadow-sm">
                            🌐
                        </div>
                        <span class="text-[11px] font-bold uppercase tracking-wider text-cyan-600">Community & Circles</span>
                        <h3 class="text-xl font-bold text-slate-900 mt-1">Zengfy Social</h3>
                        <p class="text-sm text-slate-600 mt-2 leading-relaxed">
                            Authentic local community discussions, public notice feeds, and encrypted messaging without spam or fraudulent accounts.
                        </p>
                    </div>
                    <div class="pt-6 mt-6 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-xs font-semibold text-emerald-600 font-bold">100% Free Forever</span>
                        <a href="{{ env('APP_ENV') === 'local' ? 'http://social.zengfy.test:7000' : 'https://social.zengfy.top' }}"
                            target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center gap-1.5 text-xs font-bold text-cyan-600 hover:text-cyan-800 py-1.5 px-3 rounded-lg hover:bg-cyan-50 transition-colors">
                            Explore Feed →
                        </a>
                    </div>
                </div>

                <!-- 5. Rental & Property Management -->
                <div class="glass-card rounded-2xl p-6 sm:p-7 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-amber-100/80 border border-amber-200/60 flex items-center justify-center text-2xl mb-5 shadow-sm">
                            🔑
                        </div>
                        <span class="text-[11px] font-bold uppercase tracking-wider text-amber-600">Property & Housing</span>
                        <h3 class="text-xl font-bold text-slate-900 mt-1">Zengfy Rent</h3>
                        <p class="text-sm text-slate-600 mt-2 leading-relaxed">
                            Manage apartment buildings, commercial rental spaces, tenant lease agreements, and automated monthly rent collection receipts.
                        </p>
                    </div>
                    <div class="pt-6 mt-6 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-500">৳30 / search detail</span>
                        <a href="{{ env('APP_ENV') === 'local' ? 'http://rent.zengfy.test:7000' : 'https://rent.zengfy.top' }}"
                            target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center gap-1.5 text-xs font-bold text-amber-600 hover:text-amber-800 py-1.5 px-3 rounded-lg hover:bg-amber-50 transition-colors">
                            Launch Portal →
                        </a>
                    </div>
                </div>

                <!-- 6. Hotel & Hospitality -->
                <div class="glass-card rounded-2xl p-6 sm:p-7 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-rose-100/80 border border-rose-200/60 flex items-center justify-center text-2xl mb-5 shadow-sm">
                            🏨
                        </div>
                        <span class="text-[11px] font-bold uppercase tracking-wider text-rose-600">Hospitality & Booking</span>
                        <h3 class="text-xl font-bold text-slate-900 mt-1">Zengfy Hotel</h3>
                        <p class="text-sm text-slate-600 mt-2 leading-relaxed">
                            Streamline room reservations, guest check-in/check-out logs, invoice billing, and housekeeping schedules effortlessly.
                        </p>
                    </div>
                    <div class="pt-6 mt-6 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-500">৳1,200 / month</span>
                        <a href="{{ env('APP_ENV') === 'local' ? 'http://hotel.zengfy.test:7000' : 'https://hotel.zengfy.top' }}"
                            target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center gap-1.5 text-xs font-bold text-rose-600 hover:text-rose-800 py-1.5 px-3 rounded-lg hover:bg-rose-50 transition-colors">
                            Launch Portal →
                        </a>
                    </div>
                </div>

            </div>
        </section>

        <!-- ========================================================================= -->
        <!-- 4. Glassmorphic Core Advantages (3 Pillars) -->
        <!-- ========================================================================= -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="glass-card rounded-2xl p-7 text-center">
                    <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center text-2xl mx-auto mb-4">
                        ⚡
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Unified Single Sign-On</h3>
                    <p class="text-xs sm:text-sm text-slate-600 mt-2 leading-relaxed">
                        Say goodbye to remembering dozens of passwords. One master login credentials securely unlocks every app in the ecosystem.
                    </p>
                </div>

                <div class="glass-card rounded-2xl p-7 text-center">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-100 text-indigo-600 flex items-center justify-center text-2xl mx-auto mb-4">
                        📱
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Mobile & Android Ready</h3>
                    <p class="text-xs sm:text-sm text-slate-600 mt-2 leading-relaxed">
                        Access all tools seamlessly on any desktop browser or download our native lightweight Android APK for on-the-go management.
                    </p>
                </div>

                <div class="glass-card rounded-2xl p-7 text-center">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-2xl mx-auto mb-4">
                        🔒
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Bank-Grade 256-Bit Security</h3>
                    <p class="text-xs sm:text-sm text-slate-600 mt-2 leading-relaxed">
                        Your institution and customer data is protected with end-to-end SSL encryption, device session revocation, and automated backups.
                    </p>
                </div>

            </div>
        </section>

        <!-- ========================================================================= -->
        <!-- 5. Glassmorphic CTA Banner -->
        <!-- ========================================================================= -->
        <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 my-16">
            <div class="glass-panel rounded-3xl p-8 sm:p-12 text-center border border-white/90 shadow-xl bg-gradient-to-r from-blue-50/60 via-white/80 to-indigo-50/60">
                <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                    Ready to Streamline Your Operations?
                </h2>
                <p class="text-sm sm:text-base text-slate-600 mt-3 max-w-xl mx-auto">
                    Sign in to your sovereign dashboard and connect your organization in minutes.
                </p>
                <div class="mt-7 flex justify-center">
                    <a href="/login"
                        class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm sm:text-base shadow-lg shadow-blue-500/25 active:scale-95 transition-all min-h-[48px]">
                        <span>Go to Sign In / প্রবেশ করুন</span>
                        <span>→</span>
                    </a>
                </div>
            </div>
        </section>

    </main>

    <!-- ========================================================================= -->
    <!-- 6. Footer (Glassmorphic, Contains Company, Terms, FAQ, Ecosystem, Language) -->
    <!-- ========================================================================= -->
    <footer class="relative z-10 glass-panel border-t border-slate-200/80 pt-16 pb-12 text-sm text-slate-600 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 pb-12 border-b border-slate-200/60">

                <!-- Column 1: Brand & Status -->
                <div class="col-span-2 md:col-span-1">
                    <a href="{{ route('welcome') }}" aria-label="Zengfy" class="flex items-center gap-2.5 group mb-4 min-h-[44px]">
                        <div aria-hidden="true" class="w-8 h-8 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center font-black text-white text-base group-hover:scale-105 transition-transform">
                            Z
                        </div>
                        <span class="text-xl font-extrabold tracking-tight text-slate-900 group-hover:text-blue-600 transition-colors">
                            Zengfy<span class="text-blue-600 font-black" aria-hidden="true">.</span>
                        </span>
                    </a>

                    <p class="text-xs text-slate-500 leading-relaxed font-normal mb-5 max-w-sm">
                        Building the sovereign digital ecosystem for Bangladesh. One unified account for every tool in your business and personal life.
                    </p>

                    <!-- System Status Pill -->
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-semibold">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>All Systems Operational</span>
                    </div>
                </div>

                <!-- Column 2: Ecosystem Applications -->
                <div>
                    <h3 class="text-slate-900 font-bold text-xs sm:text-sm mb-4 tracking-wider uppercase">Operating Apps</h3>
                    <ul class="space-y-2 text-xs font-medium">
                        <li>
                            <a href="{{ env('APP_ENV') === 'local' ? 'http://school.zengfy.test:7000' : 'https://school.zengfy.top' }}"
                                target="_blank" rel="noopener noreferrer"
                                class="py-1 min-h-[32px] inline-flex items-center hover:text-blue-600 transition-colors">School ERP Suite</a>
                        </li>
                        <li>
                            <a href="{{ env('APP_ENV') === 'local' ? 'http://pos.zengfy.test:7000' : 'https://pos.zengfy.top' }}"
                                target="_blank" rel="noopener noreferrer"
                                class="py-1 min-h-[32px] inline-flex items-center hover:text-blue-600 transition-colors">POS Retail & Stock</a>
                        </li>
                        <li>
                            <a href="{{ env('APP_ENV') === 'local' ? 'http://law.zengfy.test:7000' : 'https://law.zengfy.top' }}"
                                target="_blank" rel="noopener noreferrer"
                                class="py-1 min-h-[32px] inline-flex items-center hover:text-blue-600 transition-colors">Legal Case Vault</a>
                        </li>
                        <li>
                            <a href="{{ env('APP_ENV') === 'local' ? 'http://social.zengfy.test:7000' : 'https://social.zengfy.top' }}"
                                target="_blank" rel="noopener noreferrer"
                                class="py-1 min-h-[32px] inline-flex items-center hover:text-blue-600 transition-colors">Social Network Feed</a>
                        </li>
                        <li>
                            <a href="/download" class="py-1 min-h-[32px] inline-flex items-center font-bold text-blue-600 hover:text-blue-700 transition-colors">
                                📱 Download Android APK
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Column 3: Company & Workplace (Moved from header) -->
                <div>
                    <h3 class="text-slate-900 font-bold text-xs sm:text-sm mb-4 tracking-wider uppercase">Company</h3>
                    <ul class="space-y-2 text-xs font-medium">
                        <li>
                            <a href="{{ route('company') }}" class="py-1 min-h-[32px] inline-flex items-center hover:text-blue-600 transition-colors">
                                Company & Team
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('policy.workplace') }}" class="py-1 min-h-[32px] inline-flex items-center hover:text-blue-600 transition-colors">
                                Workplace Policy
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pricing') }}" class="py-1 min-h-[32px] inline-flex items-center hover:text-blue-600 transition-colors">
                                Pricing Plans
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('products') }}" class="py-1 min-h-[32px] inline-flex items-center hover:text-blue-600 transition-colors">
                                Product Catalogue
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Column 4: Help, FAQ & Legal (Moved from header) -->
                <div>
                    <h3 class="text-slate-900 font-bold text-xs sm:text-sm mb-4 tracking-wider uppercase">Help & Legal</h3>
                    <ul class="space-y-2 text-xs font-medium">
                        <li>
                            <a href="{{ route('faq') }}" class="py-1 min-h-[32px] inline-flex items-center hover:text-blue-600 transition-colors">
                                Frequently Asked Questions (FAQ)
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('terms') }}" class="py-1 min-h-[32px] inline-flex items-center hover:text-blue-600 transition-colors">
                                Terms of Service
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('terms') }}" class="py-1 min-h-[32px] inline-flex items-center hover:text-blue-600 transition-colors">
                                Privacy Policy
                            </a>
                        </li>
                    </ul>
                </div>

            </div>

            <!-- Bottom Copyright & Language Switcher -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
                <div>
                    © {{ date('Y') }} Zengfy Inc. All rights reserved. Built for Bangladesh 🇧🇩
                </div>

                <!-- Language Switcher -->
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-100/80 border border-slate-200 text-xs text-slate-600">
                    <span class="font-semibold">🌐 ভাষা / Language:</span>
                    <a href="{{ route('lang.switch', 'bn') }}"
                        class="px-2 py-0.5 min-h-[28px] inline-flex items-center rounded-md transition-all {{ session('locale', 'bn') === 'bn' ? 'bg-blue-600 text-white font-bold' : 'hover:text-blue-600' }}">
                        বাংলা
                    </a>
                    <span class="text-slate-300">|</span>
                    <a href="{{ route('lang.switch', 'en') }}"
                        class="px-2 py-0.5 min-h-[28px] inline-flex items-center rounded-md transition-all {{ session('locale') === 'en' ? 'bg-blue-600 text-white font-bold' : 'hover:text-blue-600' }}">
                        English
                    </a>
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ route('terms') }}" class="hover:text-blue-600 transition-colors">Terms</a>
                    <span>•</span>
                    <a href="{{ route('faq') }}" class="hover:text-blue-600 transition-colors">FAQ</a>
                </div>
            </div>

        </div>
    </footer>


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
</body>

</html>
