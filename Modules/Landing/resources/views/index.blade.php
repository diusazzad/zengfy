<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zengfy | Speak Freely. One Unified Account.</title>
    <meta name="description" content="Say hello to a sovereign messaging and ecosystem experience. An unexpected focus on privacy, combined with school ERP, POS, and legal tools.">
    <meta name="keywords" content="Zengfy, Speak Freely, Privacy, Messaging, School ERP, POS Bangladesh, Legal Management, Unified SaaS">
    <meta name="author" content="Zengfy Inc.">

    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Zengfy | Speak Freely. One Unified Account.">
    <meta property="og:description" content="Privacy-first communication and sovereign modular software suite for Bangladesh.">
    <meta property="og:image" content="{{ asset('images/logo.png') }}">

    <!-- Google Fonts: Plus Jakarta Sans (Non-blocking Font Load to improve FCP & LCP) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" media="print" onload="this.media='all'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap">
    </noscript>

    <!-- Tailwind CSS / Vite Core Assets (Includes Bundled Alpine.js) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            font-display: swap;
            color: #0f172a;
        }

        /* Enhanced High-Definition Glassmorphism Utilities */
        .glass-panel {
            background: rgba(255, 255, 255, 0.45);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.65);
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.06), 0 0 0 1px rgba(0, 0, 0, 0.05);
        }

        .glass-panel-subtle {
            background: rgba(255, 255, 255, 0.40);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.55);
            box-shadow: 0 4px 15px -2px rgba(0, 0, 0, 0.03), 0 0 0 1px rgba(0, 0, 0, 0.04);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.45);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.65);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.04), 0 0 0 1px rgba(0, 0, 0, 0.04);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .glass-card:hover {
            transform: translateY(-4px);
            background: rgba(255, 255, 255, 0.75);
            border-color: rgba(59, 130, 246, 0.45);
            box-shadow: 0 20px 35px -10px rgba(37, 99, 235, 0.15), 0 0 0 1px rgba(59, 130, 246, 0.2);
        }

        .glass-nav {
            background: rgba(255, 255, 255, 0.60);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.03), 0 0 0 1px rgba(0, 0, 0, 0.03);
        }
    </style>
</head>

@php
    $baseDomain = config('app.base_domain', env('APP_BASE_DOMAIN', 'zengfy.test'));
    $port = request()->getPort();
    $portSuffix = ($port && !in_array($port, [80, 443])) ? ':' . $port : '';
    $scheme = request()->getScheme();
    $buildSubdomainUrl = function ($subdomain) use ($scheme, $baseDomain, $portSuffix) {
        return $scheme . '://' . $subdomain . '.' . $baseDomain . $portSuffix;
    };
    $socialUrl = $buildSubdomainUrl('social');
    $schoolUrl = $buildSubdomainUrl('school');
    $posUrl = $buildSubdomainUrl('pos');
    $lawUrl = $buildSubdomainUrl('law');
    $rentUrl = $buildSubdomainUrl('rent');
    $hotelUrl = $buildSubdomainUrl('hotel');
@endphp

<body class="bg-gradient-to-br from-blue-50 via-white to-purple-50 text-slate-800 antialiased selection:bg-blue-600 selection:text-white overflow-x-hidden min-h-screen flex flex-col justify-between">

    <!-- Ambient Glass Gradient Background (Rich Multi-Layer for High-Definition Frosted Glass) -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0" aria-hidden="true">
        <!-- Soft Sky Blue Orb Top Left -->
        <div class="absolute -top-32 -left-32 w-[650px] h-[650px] rounded-full bg-gradient-to-br from-blue-300/40 via-sky-200/30 to-transparent blur-3xl opacity-80"></div>
        <!-- Soft Indigo / Violet Orb Top Right -->
        <div class="absolute top-10 -right-32 w-[700px] h-[700px] rounded-full bg-gradient-to-bl from-indigo-300/35 via-purple-200/25 to-transparent blur-3xl opacity-80"></div>
        <!-- Soft Amber / Emerald Glow Mid-Body -->
        <div class="absolute top-[40%] left-1/2 -translate-x-1/2 w-[850px] h-[550px] rounded-full bg-gradient-to-tr from-amber-200/30 via-cyan-200/25 to-transparent blur-3xl opacity-70"></div>
        <!-- Very Subtle Vector Mesh Grid -->
        <div class="absolute inset-0 bg-[radial-gradient(#94a3b8_1px,transparent_1px)] [background-size:28px_28px] opacity-25"></div>
    </div>

    <!-- ========================================================================= -->
    <!-- 1. Header Navigation (Google-Style Dot Menu + Sign In, Minimalist)        -->
    <!-- ========================================================================= -->
    <nav id="main-navbar"
        class="fixed top-0 left-0 right-0 z-50 glass-nav transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-18 sm:h-20 flex items-center justify-between">

            <!-- Brand Logo (WCAG Label-in-Name Compliant: Accessible name matches visible text) -->
            <a href="{{ route('welcome') }}"
                class="flex items-center gap-2.5 sm:gap-3 group shrink-0 rounded-xl p-1.5 min-w-[44px] min-h-[44px] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                <div aria-hidden="true"
                    class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-gradient-to-tr from-blue-600 via-indigo-600 to-cyan-500 flex items-center justify-center font-black text-lg sm:text-xl text-white shadow-md shadow-blue-500/20 group-hover:scale-105 transition-transform duration-300">
                    Z
                </div>
                <span class="text-xl sm:text-2xl font-extrabold tracking-tight text-slate-900 group-hover:text-blue-600 transition-colors">
                    Zengfy<span class="text-blue-600 font-black" aria-hidden="true">.</span>
                </span>
            </a>

            <!-- Right Actions: Google-Style 9-Dot (Waffle) Menu + Sign In Button -->
            <div class="flex items-center gap-2.5 sm:gap-3.5 shrink-0">

                <!-- Google-style 9-Dot Waffle Apps Launcher (48x48px Touch Target + Solid Accessible Button) -->
                <div class="relative" id="apps-dropdown-wrapper" x-data="{ appsOpen: false }" @click.outside="appsOpen = false" @keydown.escape.window="appsOpen = false">

                    <!-- Mobile Backdrop Overlay for Touch Devices -->
                    <div x-show="appsOpen" x-cloak 
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="fixed inset-0 bg-slate-900/25 backdrop-blur-xs z-40 sm:hidden" 
                        @click="appsOpen = false" 
                        aria-hidden="true">
                    </div>

                    <button @click="appsOpen = !appsOpen"
                        id="apps-menu-button"
                        :aria-expanded="appsOpen ? 'true' : 'false'"
                        aria-haspopup="true"
                        aria-label="Zengfy Apps"
                        title="Zengfy Apps"
                        type="button"
                        class="w-12 h-12 min-w-[48px] min-h-[48px] p-3 rounded-2xl flex items-center justify-center shrink-0 bg-white hover:bg-slate-50 active:bg-slate-100 border border-slate-200/90 shadow-sm text-slate-700 hover:text-blue-600 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 cursor-pointer"
                        :class="appsOpen ? 'bg-slate-100 text-blue-600 ring-2 ring-blue-500/50 shadow-md' : ''">
                        <svg class="w-6 h-6 pointer-events-none" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <circle cx="5" cy="5" r="2.2" />
                            <circle cx="12" cy="5" r="2.2" />
                            <circle cx="19" cy="5" r="2.2" />
                            <circle cx="5" cy="12" r="2.2" />
                            <circle cx="12" cy="12" r="2.2" />
                            <circle cx="19" cy="12" r="2.2" />
                            <circle cx="5" cy="19" r="2.2" />
                            <circle cx="12" cy="19" r="2.2" />
                            <circle cx="19" cy="19" r="2.2" />
                        </svg>
                    </button>

                    <!-- Google-style Apps Popover Panel (100% Solid Pure White Background - Zero Transparency Bleed) -->
                    <div x-show="appsOpen" x-cloak id="apps-dropdown-panel"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-3 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                        x-transition:leave-end="opacity-0 translate-y-3 scale-95"
                        class="fixed left-3.5 right-3.5 top-20 sm:absolute sm:left-auto sm:right-0 sm:top-full mt-2 sm:mt-3 sm:w-[380px] max-h-[85vh] overflow-y-auto bg-white border border-slate-200/90 rounded-3xl p-4 sm:p-5 shadow-[0_25px_60px_-15px_rgba(0,0,0,0.25)] ring-1 ring-slate-900/5 z-50">

                        <!-- Popover Header -->
                        <div class="flex items-center justify-between pb-3 mb-3 border-b border-slate-100">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold uppercase tracking-wider text-slate-700">Zengfy Apps</span>
                                <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-blue-50 text-blue-700 border border-blue-200/60">Sovereign Suite</span>
                            </div>
                            <span class="text-[10px] text-slate-400 font-mono">One SSO Account</span>
                        </div>

                        <!-- 3x3 Apps Grid (Solid Crisp High-Contrast Cards) -->
                        <div class="grid grid-cols-3 gap-2 text-center">

                            <!-- 1. Social -->
                            <a href="{{ $socialUrl }}"
                                target="_blank" rel="noopener noreferrer"
                                class="flex flex-col items-center p-2.5 sm:p-3 min-h-[52px] rounded-2xl bg-slate-50/80 hover:bg-cyan-50/70 border border-slate-100/90 hover:border-cyan-200 transition-all group">
                                <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-2xl bg-cyan-100/90 border border-cyan-200 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform shadow-xs">
                                    🌐
                                </div>
                                <span class="mt-2 text-xs font-bold text-slate-900 group-hover:text-blue-600 transition-colors truncate w-full">Social</span>
                                <span class="text-[10px] text-slate-500 font-medium truncate w-full">Feed & Chat</span>
                            </a>

                            <!-- 2. School -->
                            <a href="{{ $schoolUrl }}"
                                target="_blank" rel="noopener noreferrer"
                                class="flex flex-col items-center p-2.5 sm:p-3 min-h-[52px] rounded-2xl bg-slate-50/80 hover:bg-blue-50/70 border border-slate-100/90 hover:border-blue-200 transition-all group">
                                <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-2xl bg-blue-100/90 border border-blue-200 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform shadow-xs">
                                    🏫
                                </div>
                                <span class="mt-2 text-xs font-bold text-slate-900 group-hover:text-blue-600 transition-colors truncate w-full">School</span>
                                <span class="text-[10px] text-slate-500 font-medium truncate w-full">Academic ERP</span>
                            </a>

                            <!-- 3. POS -->
                            <a href="{{ $posUrl }}"
                                target="_blank" rel="noopener noreferrer"
                                class="flex flex-col items-center p-2.5 sm:p-3 min-h-[52px] rounded-2xl bg-slate-50/80 hover:bg-indigo-50/70 border border-slate-100/90 hover:border-indigo-200 transition-all group">
                                <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-2xl bg-indigo-100/90 border border-indigo-200 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform shadow-xs">
                                    🛒
                                </div>
                                <span class="mt-2 text-xs font-bold text-slate-900 group-hover:text-blue-600 transition-colors truncate w-full">POS</span>
                                <span class="text-[10px] text-slate-500 font-medium truncate w-full">Retail & Stock</span>
                            </a>

                            <!-- 4. Law -->
                            <a href="{{ $lawUrl }}"
                                target="_blank" rel="noopener noreferrer"
                                class="flex flex-col items-center p-2.5 sm:p-3 min-h-[52px] rounded-2xl bg-slate-50/80 hover:bg-purple-50/70 border border-slate-100/90 hover:border-purple-200 transition-all group">
                                <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-2xl bg-purple-100/90 border border-purple-200 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform shadow-xs">
                                    ⚖️
                                </div>
                                <span class="mt-2 text-xs font-bold text-slate-900 group-hover:text-blue-600 transition-colors truncate w-full">Law</span>
                                <span class="text-[10px] text-slate-500 font-medium truncate w-full">Case Vault</span>
                            </a>

                            <!-- 5. Rent -->
                            <a href="{{ $rentUrl }}"
                                target="_blank" rel="noopener noreferrer"
                                class="flex flex-col items-center p-2.5 sm:p-3 min-h-[52px] rounded-2xl bg-slate-50/80 hover:bg-amber-50/70 border border-slate-100/90 hover:border-amber-200 transition-all group">
                                <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-2xl bg-amber-100/90 border border-amber-200 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform shadow-xs">
                                    🔑
                                </div>
                                <span class="mt-2 text-xs font-bold text-slate-900 group-hover:text-blue-600 transition-colors truncate w-full">Rent</span>
                                <span class="text-[10px] text-slate-500 font-medium truncate w-full">Property Hub</span>
                            </a>

                            <!-- 6. Hotel -->
                            <a href="{{ $hotelUrl }}"
                                target="_blank" rel="noopener noreferrer"
                                class="flex flex-col items-center p-2.5 sm:p-3 min-h-[52px] rounded-2xl bg-slate-50/80 hover:bg-rose-50/70 border border-slate-100/90 hover:border-rose-200 transition-all group">
                                <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-2xl bg-rose-100/90 border border-rose-200 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform shadow-xs">
                                    🏨
                                </div>
                                <span class="mt-2 text-xs font-bold text-slate-900 group-hover:text-blue-600 transition-colors truncate w-full">Hotel</span>
                                <span class="text-[10px] text-slate-500 font-medium truncate w-full">Hospitality</span>
                            </a>

                            <!-- 7. Android APK -->
                            <a href="/download"
                                class="flex flex-col items-center p-2.5 sm:p-3 min-h-[52px] rounded-2xl bg-slate-50/80 hover:bg-emerald-50/70 border border-slate-100/90 hover:border-emerald-200 transition-all group">
                                <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-2xl bg-emerald-100/90 border border-emerald-200 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform shadow-xs">
                                    📱
                                </div>
                                <span class="mt-2 text-xs font-bold text-slate-900 group-hover:text-blue-600 transition-colors truncate w-full">Android APK</span>
                                <span class="text-[10px] text-slate-500 font-medium truncate w-full">Direct App</span>
                            </a>

                            <!-- 8. Pricing Plans -->
                            <a href="{{ route('pricing') }}"
                                class="flex flex-col items-center p-2.5 sm:p-3 min-h-[52px] rounded-2xl bg-slate-50/80 hover:bg-slate-100 border border-slate-100/90 hover:border-slate-300 transition-all group">
                                <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-2xl bg-slate-200/90 border border-slate-300 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform shadow-xs">
                                    💳
                                </div>
                                <span class="mt-2 text-xs font-bold text-slate-900 group-hover:text-blue-600 transition-colors truncate w-full">Pricing</span>
                                <span class="text-[10px] text-slate-500 font-medium truncate w-full">Plans & Rates</span>
                            </a>

                            <!-- 9. Product Catalogue -->
                            <a href="{{ route('products') }}"
                                class="flex flex-col items-center p-2.5 sm:p-3 min-h-[52px] rounded-2xl bg-slate-50/80 hover:bg-blue-50/70 border border-slate-100/90 hover:border-blue-200 transition-all group">
                                <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-2xl bg-blue-100/90 border border-blue-200 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform shadow-xs">
                                    📦
                                </div>
                                <span class="mt-2 text-xs font-bold text-slate-900 group-hover:text-blue-600 transition-colors truncate w-full">Catalogue</span>
                                <span class="text-[10px] text-slate-500 font-medium truncate w-full">All Services</span>
                            </a>

                        </div>

                        <!-- Bottom Link in Modal -->
                        <div class="mt-3.5 pt-3 border-t border-slate-100 text-center">
                            <a href="{{ route('products') }}" class="text-xs font-bold text-blue-600 hover:text-blue-700 transition-colors inline-flex items-center gap-1.5 py-1.5 min-h-[36px]">
                                <span>Explore entire ecosystem</span>
                                <span>→</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Sign In Button (Touch Target: 44px minimum) -->
                <a href="/login"
                    class="inline-flex items-center justify-center gap-2 px-5 sm:px-6 py-2.5 min-h-[48px] rounded-full bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/30 active:scale-95 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                    <span>Sign In</span>
                    <svg class="w-4 h-4 text-blue-200" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>
    </nav>

    <!-- ========================================================================= -->
    <!-- Main Content Area                                                         -->
    <!-- ========================================================================= -->
    <main id="main-content" role="main" class="relative z-10 pt-24 sm:pt-28 pb-20">

        <!-- ===================================================================== -->
        <!-- 1. Signal-Style Hero Section ("Speak Freely" & Privacy-First Social)  -->
        <!-- ===================================================================== -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 sm:pt-14 pb-16 sm:pb-24">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">

                <!-- Left Content: Bold Headline, Subheadline & Get Started CTA -->
                <div class="lg:col-span-7 text-left space-y-6 sm:space-y-7">

                    <!-- Privacy Badge Pill -->
                    <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full glass-panel-subtle text-slate-700 text-xs sm:text-sm font-semibold shadow-xs">
                        <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
                        <span class="text-blue-700 font-bold">Privacy First</span>
                        <span class="text-slate-300">•</span>
                        <span>Sovereign Communication</span>
                    </div>

                    <!-- Signal-Inspired Main Headline -->
                    <h1 class="text-5xl sm:text-6xl md:text-7xl font-extrabold tracking-tight text-slate-900 leading-[1.05]">
                        Speak Freely<span class="text-blue-600">.</span>
                    </h1>

                    <!-- Signal-Inspired Subheadline -->
                    <p class="text-xl sm:text-2xl md:text-2xl text-slate-600 font-normal leading-relaxed max-w-2xl">
                        Say &ldquo;hello&rdquo; to a different messaging experience. An unexpected focus on privacy, combined with all of the features you expect.
                    </p>

                    <p class="text-sm sm:text-base text-slate-500 font-medium leading-relaxed max-w-xl">
                        কোনো বাণিজ্যিক নজরদারি বা ট্র্যাকিং নেই — সার্বভৌম নাগরিক পরিচয়ে সম্পূর্ণ নিরাপদ, দ্রুত ও স্বাধীন সোশ্যাল নেটওয়ার্ক।
                    </p>

                    <!-- CTAs: Get Started Button (Directly routes to Zengfy Social) -->
                    <div class="pt-2 flex flex-col sm:flex-row items-stretch sm:items-center gap-3.5 sm:gap-4 max-w-lg">
                        <a href="{{ $socialUrl }}"
                            class="px-8 py-4 rounded-full bg-blue-600 hover:bg-blue-700 text-white font-bold text-base sm:text-lg shadow-xl shadow-blue-500/25 hover:shadow-2xl hover:shadow-blue-500/35 active:scale-95 transition-all inline-flex items-center justify-center gap-2.5 min-h-[52px]">
                            <span>Get Started</span>
                            <svg class="w-5 h-5 text-blue-200" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>

                        <a href="/download"
                            class="px-6 py-4 rounded-full glass-panel hover:bg-white/80 text-slate-700 hover:text-slate-900 font-semibold text-sm sm:text-base border border-white/60 transition-all inline-flex items-center justify-center gap-2 min-h-[52px]">
                            <span>📱 Download Android APK</span>
                        </a>
                    </div>

                    <!-- Trust Pillars / Privacy Guarantees -->
                    <div class="pt-4 flex flex-wrap items-center gap-5 sm:gap-7 text-xs sm:text-sm text-slate-500 font-semibold">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-600" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>End-to-End Encrypted</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-600" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>No Ads or Trackers</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-600" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>100% Free Forever</span>
                        </div>
                    </div>

                </div>

                <!-- Right Visual: Signal-Style White Glassmorphic Chat Experience Mockup -->
                <div class="lg:col-span-5 relative">

                    <!-- Ambient Glow Behind Device Frame -->
                    <div class="absolute -inset-4 bg-gradient-to-tr from-blue-400/25 via-cyan-300/20 to-purple-400/25 rounded-3xl blur-2xl opacity-75"></div>

                    <!-- Floating Badge Top Right -->
                    <div class="absolute -top-4 -right-2 sm:-right-4 z-20 glass-panel px-3.5 py-1.5 rounded-full border border-white/70 shadow-lg text-xs font-bold text-slate-800 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                        <span>🔒 256-Bit Encrypted</span>
                    </div>

                    <!-- Floating Badge Bottom Left -->
                    <div class="absolute -bottom-4 -left-2 sm:-left-4 z-20 glass-panel px-3.5 py-1.5 rounded-full border border-white/70 shadow-lg text-xs font-bold text-slate-800 flex items-center gap-2">
                        <span class="text-blue-600">⚡</span>
                        <span>Zero Data Harvesting</span>
                    </div>

                    <!-- Glass Device / Chat Window (bg-white/40 backdrop-blur-xl border-white/60 ring-1 ring-black/5) -->
                    <div class="bg-white/45 backdrop-blur-2xl rounded-3xl p-5 sm:p-6 border border-white/70 shadow-2xl ring-1 ring-black/5 relative z-10 overflow-hidden">

                        <!-- Mock Chat Header -->
                        <div class="flex items-center justify-between pb-4 border-b border-slate-200/60 mb-5">
                            <div class="flex items-center gap-3">
                                <div class="relative">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white font-bold text-sm shadow-sm">
                                        Z
                                    </div>
                                    <span class="absolute bottom-0 right-0 w-3 h-3 rounded-full bg-emerald-500 border-2 border-white"></span>
                                </div>
                                <div>
                                    <div class="flex items-center gap-1.5">
                                        <h2 class="text-sm font-bold text-slate-900">Zengfy Social Circle</h2>
                                        <span class="text-blue-600" title="Verified Sovereign Citizen">✓</span>
                                    </div>
                                    <p class="text-[11px] text-emerald-600 font-medium flex items-center gap-1">
                                        <span>•</span>
                                        <span>Private End-to-End Chat</span>
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center gap-1.5 text-slate-400">
                                <div class="w-8 h-8 rounded-full hover:bg-white/60 flex items-center justify-center text-slate-600 cursor-pointer">
                                    <svg class="w-4 h-4" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Chat Messages Mockup -->
                        <div class="space-y-4 text-xs sm:text-sm">

                            <!-- Bubble 1: Incoming -->
                            <div class="flex items-start gap-2.5">
                                <div class="w-7 h-7 rounded-full bg-blue-100 text-blue-700 font-bold flex items-center justify-center text-[10px] shrink-0 mt-0.5">
                                    SC
                                </div>
                                <div class="bg-white/80 text-slate-800 rounded-2xl rounded-tl-sm px-4 py-2.5 max-w-[85%] border border-white/70 shadow-xs backdrop-blur-md">
                                    <p class="leading-relaxed">Hey! Have you tried the new sovereign ecosystem on Zengfy?</p>
                                    <span class="text-[9px] text-slate-400 block mt-1 text-right">10:14 AM</span>
                                </div>
                            </div>

                            <!-- Bubble 2: Outgoing (Blue Gradient, with reaction) -->
                            <div class="flex flex-col items-end">
                                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-2xl rounded-tr-sm px-4 py-2.5 max-w-[85%] shadow-md">
                                    <p class="leading-relaxed">Yes! One login unlocks everything — encrypted messaging, school ERP, and retail POS. Zero tracking.</p>
                                    <div class="flex items-center justify-end gap-1 mt-1 text-[9px] text-blue-200">
                                        <span>10:15 AM</span>
                                        <span>• ✓✓</span>
                                    </div>
                                </div>
                                <!-- Floating reaction pill -->
                                <div class="-mt-2 mr-2 bg-white/90 rounded-full px-2 py-0.5 text-[11px] shadow-sm border border-white/70 flex items-center gap-1 backdrop-blur-md">
                                    <span>❤️</span>
                                    <span class="text-[10px] font-bold text-slate-700">12</span>
                                </div>
                            </div>

                            <!-- Bubble 3: Incoming -->
                            <div class="flex items-start gap-2.5">
                                <div class="w-7 h-7 rounded-full bg-cyan-100 text-cyan-700 font-bold flex items-center justify-center text-[10px] shrink-0 mt-0.5">
                                    MZ
                                </div>
                                <div class="bg-white/80 text-slate-800 rounded-2xl rounded-tl-sm px-4 py-2.5 max-w-[85%] border border-white/70 shadow-xs backdrop-blur-md">
                                    <p class="leading-relaxed">That's amazing! Pure communication, zero algorithms pushing ads. 🔒✨</p>
                                    <span class="text-[9px] text-slate-400 block mt-1 text-right">10:16 AM</span>
                                </div>
                            </div>

                        </div>

                        <!-- Chat Mock Input Bar -->
                        <div class="mt-6 pt-3 border-t border-slate-200/60 flex items-center gap-2">
                            <div class="flex-grow bg-white/70 rounded-full px-4 py-2 text-xs text-slate-500 border border-white/60 flex items-center justify-between backdrop-blur-sm">
                                <span>Speak freely...</span>
                                <span class="text-slate-400">😊</span>
                            </div>
                            <div class="w-9 h-9 rounded-full bg-blue-600 flex items-center justify-center text-white shadow-sm shrink-0">
                                <svg class="w-4 h-4 -rotate-45" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>

        <!-- ========================================================================= -->
        <!-- 2. Ecosystem Hero Section (One Unified Account. Infinite Digital Ecosystem)-->
        <!-- ========================================================================= -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-8 sm:pt-12 pb-16 sm:pb-24 border-t border-slate-200/70">

            <!-- Sleek Glass Feature Pill -->
            <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full glass-panel-subtle text-slate-700 text-xs sm:text-sm font-semibold mb-6 sm:mb-8 shadow-xs">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>Single Sign-On • 10+ Connected Operating Apps</span>
            </div>

            <!-- Main Headline -->
            <h2 class="text-4xl sm:text-6xl md:text-7xl font-extrabold tracking-tight leading-[1.1] max-w-5xl mx-auto text-slate-900">
                One Unified Account. <br class="hidden sm:inline" />
                <span class="bg-gradient-to-r from-blue-600 via-indigo-600 to-cyan-600 bg-clip-text text-transparent">
                    Infinite Digital Ecosystem.
                </span>
            </h2>

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
                    class="w-full sm:w-auto px-8 py-3.5 rounded-full glass-panel hover:bg-white/80 text-slate-700 hover:text-slate-900 font-semibold text-sm sm:text-base border border-white/60 transition-all flex items-center justify-center gap-2 min-h-[48px]">
                    <span>Explore Ecosystem / সার্ভিসসমূহ</span>
                    <span>↓</span>
                </a>
            </div>

            <!-- Glassmorphic Preview Hero Box (Clean Interactive Showcase) -->
            <div class="mt-14 sm:mt-18 max-w-5xl mx-auto glass-panel rounded-3xl p-4 sm:p-7 border border-white/70 shadow-2xl ring-1 ring-black/5 relative">
                <!-- Browser Window Top Bar -->
                <div class="flex items-center justify-between pb-4 mb-5 border-b border-slate-200/50">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-rose-400"></div>
                        <div class="w-3 h-3 rounded-full bg-amber-400"></div>
                        <div class="w-3 h-3 rounded-full bg-emerald-400"></div>
                        <span class="ml-3 text-xs font-mono text-slate-400 hidden sm:inline">zengfy.test — Unified App Hub</span>
                    </div>
                    <div class="inline-flex items-center gap-1.5 text-xs font-semibold px-3 py-1 rounded-full bg-blue-50/80 text-blue-700 border border-blue-200/60">
                        <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                        <span>Single Sign-On Active</span>
                    </div>
                </div>

                <!-- 4 Live App Glass Tiles -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3.5 text-left">

                    <!-- School Tile -->
                    <div class="glass-card rounded-2xl p-4 bg-white/50">
                        <div class="flex items-center justify-between mb-2.5">
                            <span class="text-xl">🏫</span>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800">ERP Suite</span>
                        </div>
                        <h2 class="text-sm font-bold text-slate-900">Zengfy School</h2>
                        <p class="text-xs text-slate-500 mt-1">Student attendance, exams & fee collection.</p>
                    </div>

                    <!-- POS Tile -->
                    <div class="glass-card rounded-2xl p-4 bg-white/50">
                        <div class="flex items-center justify-between mb-2.5">
                            <span class="text-xl">🛒</span>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-blue-100 text-blue-800">Retail & Stock</span>
                        </div>
                        <h2 class="text-sm font-bold text-slate-900">Zengfy POS</h2>
                        <p class="text-xs text-slate-500 mt-1">Barcode scanning, stock & bKash checkout.</p>
                    </div>

                    <!-- Law Tile -->
                    <div class="glass-card rounded-2xl p-4 bg-white/50">
                        <div class="flex items-center justify-between mb-2.5">
                            <span class="text-xl">⚖️</span>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-purple-100 text-purple-800">Legal Vault</span>
                        </div>
                        <h2 class="text-sm font-bold text-slate-900">Zengfy Law</h2>
                        <p class="text-xs text-slate-500 mt-1">Court schedule dates & encrypted client files.</p>
                    </div>

                    <!-- Social Tile -->
                    <div class="glass-card rounded-2xl p-4 bg-white/50">
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
        <!-- 3. Glassmorphic Ecosystem Bento Grid Section                              -->
        <!-- ========================================================================= -->
        <section id="ecosystem" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20 border-t border-slate-200/60">
            <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                <span class="text-xs uppercase font-extrabold tracking-widest text-blue-600 bg-blue-50/80 px-3 py-1 rounded-full border border-blue-200/50">
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
                    <div class="pt-6 mt-6 border-t border-slate-200/50 flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-500">৳3,000 / month</span>
                        <a href="{{ $schoolUrl }}"
                            target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-600 hover:text-blue-800 py-2 min-h-[40px] px-3 rounded-lg hover:bg-blue-50/80 transition-colors">
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
                    <div class="pt-6 mt-6 border-t border-slate-200/50 flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-500">৳40,000 One-time</span>
                        <a href="{{ $posUrl }}"
                            target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center gap-1.5 text-xs font-bold text-indigo-600 hover:text-indigo-800 py-2 min-h-[40px] px-3 rounded-lg hover:bg-indigo-50/80 transition-colors">
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
                    <div class="pt-6 mt-6 border-t border-slate-200/50 flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-500">৳500 / month</span>
                        <a href="{{ $lawUrl }}"
                            target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center gap-1.5 text-xs font-bold text-purple-600 hover:text-purple-800 py-2 min-h-[40px] px-3 rounded-lg hover:bg-purple-50/80 transition-colors">
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
                    <div class="pt-6 mt-6 border-t border-slate-200/50 flex items-center justify-between">
                        <span class="text-xs font-semibold text-emerald-600 font-bold">100% Free Forever</span>
                        <a href="{{ $socialUrl }}"
                            target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center gap-1.5 text-xs font-bold text-cyan-600 hover:text-cyan-800 py-2 min-h-[40px] px-3 rounded-lg hover:bg-cyan-50/80 transition-colors">
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
                    <div class="pt-6 mt-6 border-t border-slate-200/50 flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-500">৳30 / search detail</span>
                        <a href="{{ $rentUrl }}"
                            target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center gap-1.5 text-xs font-bold text-amber-600 hover:text-amber-800 py-2 min-h-[40px] px-3 rounded-lg hover:bg-amber-50/80 transition-colors">
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
                    <div class="pt-6 mt-6 border-t border-slate-200/50 flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-500">৳1,200 / month</span>
                        <a href="{{ $hotelUrl }}"
                            target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center gap-1.5 text-xs font-bold text-rose-600 hover:text-rose-800 py-2 min-h-[40px] px-3 rounded-lg hover:bg-rose-50/80 transition-colors">
                            Launch Portal →
                        </a>
                    </div>
                </div>

            </div>
        </section>

    </main>

    <!-- ========================================================================= -->
    <!-- 4. Footer (Glassmorphic, WCAG AA Touch Targets, Minimal & Accessible)     -->
    <!-- ========================================================================= -->
    <footer class="relative z-10 glass-panel border-t border-slate-200/80 pt-16 pb-12 text-sm text-slate-600 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 pb-12 border-b border-slate-200/60">

                <!-- Column 1: Brand & Status (WCAG Label-in-Name Compliant) -->
                <div class="col-span-2 md:col-span-1">
                    <a href="{{ route('welcome') }}" class="inline-flex items-center gap-2.5 group mb-4 min-w-[44px] min-h-[44px]">
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

                <!-- Column 2: Ecosystem Applications (Minimum Touch Target Area: 40px height) -->
                <div>
                    <h3 class="text-slate-900 font-bold text-xs sm:text-sm mb-3 tracking-wider uppercase">Operating Apps</h3>
                    <ul class="space-y-1 text-xs font-medium">
                        <li>
                            <a href="{{ $schoolUrl }}"
                                target="_blank" rel="noopener noreferrer"
                                class="py-2 min-h-[40px] inline-flex items-center hover:text-blue-600 transition-colors">School ERP Suite</a>
                        </li>
                        <li>
                            <a href="{{ $posUrl }}"
                                target="_blank" rel="noopener noreferrer"
                                class="py-2 min-h-[40px] inline-flex items-center hover:text-blue-600 transition-colors">POS Retail & Stock</a>
                        </li>
                        <li>
                            <a href="{{ $lawUrl }}"
                                target="_blank" rel="noopener noreferrer"
                                class="py-2 min-h-[40px] inline-flex items-center hover:text-blue-600 transition-colors">Legal Case Vault</a>
                        </li>
                        <li>
                            <a href="{{ $socialUrl }}"
                                target="_blank" rel="noopener noreferrer"
                                class="py-2 min-h-[40px] inline-flex items-center hover:text-blue-600 transition-colors">Social Network Feed</a>
                        </li>
                        <li>
                            <a href="/download" class="py-2 min-h-[40px] inline-flex items-center font-bold text-blue-600 hover:text-blue-700 transition-colors">
                                📱 Download Android APK
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Column 3: Company & Workplace (Minimum Touch Target Area: 40px height) -->
                <div>
                    <h3 class="text-slate-900 font-bold text-xs sm:text-sm mb-3 tracking-wider uppercase">Company</h3>
                    <ul class="space-y-1 text-xs font-medium">
                        <li>
                            <a href="{{ route('company') }}" class="py-2 min-h-[40px] inline-flex items-center hover:text-blue-600 transition-colors">
                                Company & Team
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('policy.workplace') }}" class="py-2 min-h-[40px] inline-flex items-center hover:text-blue-600 transition-colors">
                                Workplace Policy
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pricing') }}" class="py-2 min-h-[40px] inline-flex items-center hover:text-blue-600 transition-colors">
                                Pricing Plans
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('products') }}" class="py-2 min-h-[40px] inline-flex items-center hover:text-blue-600 transition-colors">
                                Product Catalogue
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Column 4: Help, FAQ & Legal (Minimum Touch Target Area: 40px height) -->
                <div>
                    <h3 class="text-slate-900 font-bold text-xs sm:text-sm mb-3 tracking-wider uppercase">Help & Legal</h3>
                    <ul class="space-y-1 text-xs font-medium">
                        <li>
                            <a href="{{ route('faq') }}" class="py-2 min-h-[40px] inline-flex items-center hover:text-blue-600 transition-colors">
                                Frequently Asked Questions (FAQ)
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('terms') }}" class="py-2 min-h-[40px] inline-flex items-center hover:text-blue-600 transition-colors">
                                Terms of Service
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('terms') }}" class="py-2 min-h-[40px] inline-flex items-center hover:text-blue-600 transition-colors">
                                Privacy Policy
                            </a>
                        </li>
                    </ul>
                </div>

            </div>

            <!-- Bottom Copyright & Language Switcher (All links have >= 36px touch target area) -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
                <div>
                    © {{ date('Y') }} Zengfy Inc. All rights reserved. Built for Bangladesh 🇧🇩
                </div>

                <!-- Language Switcher -->
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-100/80 border border-slate-200 text-xs text-slate-600">
                    <span class="font-semibold">🌐 ভাষা / Language:</span>
                    <a href="{{ route('lang.switch', 'bn') }}"
                        class="px-2.5 py-1.5 min-h-[36px] inline-flex items-center rounded-md transition-all {{ session('locale', 'bn') === 'bn' ? 'bg-blue-600 text-white font-bold' : 'hover:text-blue-600' }}">
                        বাংলা
                    </a>
                    <span class="text-slate-300">|</span>
                    <a href="{{ route('lang.switch', 'en') }}"
                        class="px-2.5 py-1.5 min-h-[36px] inline-flex items-center rounded-md transition-all {{ session('locale', 'en') === 'en' ? 'bg-blue-600 text-white font-bold' : 'hover:text-blue-600' }}">
                        English
                    </a>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('terms') }}" class="py-2 px-2 min-h-[36px] inline-flex items-center hover:text-blue-600 transition-colors">Terms</a>
                    <span>•</span>
                    <a href="{{ route('faq') }}" class="py-2 px-2 min-h-[36px] inline-flex items-center hover:text-blue-600 transition-colors">FAQ</a>
                </div>
            </div>

        </div>
    </footer>

    <!-- Safe Vanilla Fallback (Only active if Alpine is absent) -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(function () {
                if (window.Alpine) return; // Alpine is active, let Alpine handle all interactions natively

                var btn = document.getElementById('apps-menu-button');
                var panel = document.getElementById('apps-dropdown-panel');
                var wrapper = document.getElementById('apps-dropdown-wrapper');

                if (btn && panel) {
                    btn.addEventListener('click', function () {
                        var isHidden = panel.hasAttribute('x-cloak') || panel.style.display === 'none' || window.getComputedStyle(panel).display === 'none';
                        if (isHidden) {
                            panel.removeAttribute('x-cloak');
                            panel.style.display = 'block';
                            btn.setAttribute('aria-expanded', 'true');
                            btn.classList.add('bg-slate-100', 'text-blue-600', 'ring-2', 'ring-blue-500/50');
                        } else {
                            panel.style.display = 'none';
                            btn.setAttribute('aria-expanded', 'false');
                            btn.classList.remove('bg-slate-100', 'text-blue-600', 'ring-2', 'ring-blue-500/50');
                        }
                    });

                    document.addEventListener('click', function (e) {
                        if (wrapper && !wrapper.contains(e.target)) {
                            panel.style.display = 'none';
                            btn.setAttribute('aria-expanded', 'false');
                            btn.classList.remove('bg-slate-100', 'text-blue-600', 'ring-2', 'ring-blue-500/50');
                        }
                    });
                }
            }, 300);
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
</body>

</html>
