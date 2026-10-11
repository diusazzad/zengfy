<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Zengfy Social | Hyperlocal Sovereign Network')</title>
    <meta name="description" content="@yield('meta_description', 'Hyperlocal, bot-free sovereign social network for verified Bangladeshi citizens.')">

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
                            cardHover: '#162032',
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
            transition: background-color 0.3s ease, color 0.3s ease;
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

        /* ========================================================= */
        /* Eye-Comfort Night Yellow / Amber Warm Theme System        */
        /* Engineered to reduce blue-light glare and eye-strain       */
        /* ========================================================= */
        body.theme-night-yellow {
            background-color: #15120B !important;
            color: #F8EFE3 !important;
        }
        .theme-night-yellow header {
            background-color: rgba(21, 18, 11, 0.85) !important;
            border-color: rgba(245, 158, 11, 0.16) !important;
        }
        .theme-night-yellow aside .bg-\[\#121A29\],
        .theme-night-yellow div.bg-\[\#121A29\],
        .theme-night-yellow article.bg-\[\#121A29\],
        .theme-night-yellow nav.bg-\[\#0B0F17\]\/85 {
            background-color: rgba(31, 25, 15, 0.94) !important;
            border-color: rgba(245, 158, 11, 0.16) !important;
        }
        .theme-night-yellow .bg-\[\#0B0F17\] {
            background-color: #15120B !important;
        }
        .theme-night-yellow .bg-\[\#162032\] {
            background-color: #2A2114 !important;
        }
        .theme-night-yellow .text-gray-100 {
            color: #F8EFE3 !important;
        }
        .theme-night-yellow .text-gray-200 {
            color: #ECE0CE !important;
        }
        .theme-night-yellow .text-gray-300 {
            color: #D7C6AD !important;
        }
        .theme-night-yellow .text-gray-400 {
            color: #B5A186 !important;
        }
        .theme-night-yellow .text-gray-500 {
            color: #8C7C65 !important;
        }
        .theme-night-yellow .border-white\/10,
        .theme-night-yellow .border-white\/\[0\.08\],
        .theme-night-yellow .border-white\/\[0\.04\],
        .theme-night-yellow .border-white\/15 {
            border-color: rgba(245, 158, 11, 0.14) !important;
        }
        .theme-night-yellow .bg-white\/\[0\.04\],
        .theme-night-yellow .bg-white\/\[0\.03\] {
            background-color: rgba(245, 158, 11, 0.06) !important;
        }
        .theme-night-yellow .bg-white\/\[0\.06\],
        .theme-night-yellow .bg-white\/\[0\.08\] {
            background-color: rgba(245, 158, 11, 0.10) !important;
        }
        .theme-night-yellow .glow-warm {
            background: radial-gradient(circle, rgba(245, 158, 11, 0.15) 0%, transparent 70%) !important;
        }
    </style>

    @stack('styles')
</head>

@php
    $baseDomain = env('APP_BASE_DOMAIN', 'zengfy.test');
    $scheme = request()->getScheme();
    $port = request()->getPort();
    $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
    $homeUrl = "{$scheme}://{$baseDomain}{$portSuffix}/";
    $socialUrl = "{$scheme}://social.{$baseDomain}{$portSuffix}/";
    $accountUrl = "{$scheme}://{$baseDomain}{$portSuffix}/account";
    $schoolUrl = "{$scheme}://school.{$baseDomain}{$portSuffix}/";
    $posUrl = "{$scheme}://pos.{$baseDomain}{$portSuffix}/";
    $lawUrl = "{$scheme}://law.{$baseDomain}{$portSuffix}/";
    $hotelUrl = "{$scheme}://hotel.{$baseDomain}{$portSuffix}/";
@endphp

<body x-data="themeManager()" x-init="init()" :class="{ 'theme-night-yellow': nightYellow }" class="bg-[#0B0F17] text-gray-100 min-h-screen flex flex-col selection:bg-amber-500 selection:text-white antialiased relative overflow-x-hidden">

    <!-- Ambient Glowing Background Grid & Orbs -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0" aria-hidden="true">
        <!-- Radial Gradient Glow Top -->
        <div class="absolute -top-40 left-1/3 -translate-x-1/2 w-[700px] h-[500px] bg-gradient-to-b from-blue-600/15 via-indigo-600/10 to-transparent blur-3xl opacity-70 animate-pulse-slow"></div>
        <!-- Radial Gradient Glow Bottom Right -->
        <div class="absolute top-1/2 -right-40 w-[500px] h-[500px] bg-gradient-to-t from-cyan-500/10 via-blue-700/10 to-transparent blur-3xl opacity-40"></div>
        <!-- Subtle Vector Grid Pattern -->
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff05_1px,transparent_1px),linear-gradient(to_bottom,#ffffff05_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)]"></div>
    </div>

    <!-- Navigation Header (Structural Shell: Pure Glassmorphism) -->
    <header class="sticky top-0 z-40 w-full backdrop-blur-xl bg-[#0B0F17]/85 border-b border-white/[0.08] shadow-2xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 gap-4">

                <!-- Left: Brand Logo & Hyperlocal Ward Badge -->
                <div class="flex items-center gap-4 shrink-0">
                    <a href="{{ $socialUrl }}" class="flex items-center gap-2.5 group focus:outline-none active:scale-95 transition-all">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-blue-600 via-indigo-600 to-cyan-400 flex items-center justify-center font-black text-lg text-white shadow-md shadow-blue-500/25 group-hover:scale-105 transition-transform duration-300">
                            Z
                        </div>
                        <span class="text-xl font-extrabold tracking-tight text-white hidden sm:inline-block">
                            Zengfy<span class="text-blue-500">.</span><span class="text-xs font-semibold text-cyan-400 ml-1 uppercase tracking-wider">Social</span>
                        </span>
                    </a>

                    <!-- Ward Geo-Fence Pill -->
                    <div class="hidden md:flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-xs font-medium text-blue-300">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span class="text-gray-300">Hyperlocal:</span>
                        <span class="text-white font-semibold">WARD-DHAKA-19</span>
                        <span class="text-[11px] text-gray-400">· Gulshan</span>
                    </div>
                </div>

                <!-- Center: Global Search Bar -->
                <div class="flex-1 max-w-md hidden sm:block">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input 
                            type="search" 
                            placeholder="Search citizens, hyperlocal notices, topics..." 
                            class="w-full pl-10 pr-4 py-2 bg-white/[0.04] border border-white/[0.08] focus:border-white/[0.18] rounded-xl text-sm text-gray-200 placeholder-gray-500 focus:outline-none transition-all"
                        />
                    </div>
                </div>

                <!-- Right: Actions, 9-Dot Launcher, Citizen Profile -->
                <div class="flex items-center gap-3" x-data="{ launcherOpen: false, profileOpen: false }">
                    
                    <!-- Ward Switcher Quick Mobile Icon -->
                    <div class="md:hidden flex items-center px-2 py-1 rounded-lg bg-blue-500/10 text-xs text-blue-300 font-semibold border border-blue-500/20">
                        W-19
                    </div>

                    <!-- 9-Dot Universal Ecosystem Launcher Button -->
                    <div class="relative">
                        <button 
                            @click="launcherOpen = !launcherOpen" 
                            @click.outside="launcherOpen = false"
                            class="p-2 rounded-xl text-gray-400 hover:text-white hover:bg-white/[0.06] border border-transparent hover:border-white/10 active:scale-95 transition-all focus:outline-none"
                            title="Zengfy Ecosystem Apps">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <circle cx="5" cy="5" r="2"/>
                                <circle cx="12" cy="5" r="2"/>
                                <circle cx="19" cy="5" r="2"/>
                                <circle cx="5" cy="12" r="2"/>
                                <circle cx="12" cy="12" r="2"/>
                                <circle cx="19" cy="12" r="2"/>
                                <circle cx="5" cy="19" r="2"/>
                                <circle cx="12" cy="19" r="2"/>
                                <circle cx="19" cy="19" r="2"/>
                            </svg>
                        </button>

                        <!-- 9-Dot Dropdown Grid (Glassmorphism Shell) -->
                        <div 
                            x-show="launcherOpen" 
                            x-cloak
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-72 backdrop-blur-xl bg-[#0B0F17]/85 border border-white/[0.08] rounded-2xl shadow-2xl p-4 z-50">
                            <div class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3 px-1">
                                Zengfy Unified Apps
                            </div>
                            <div class="grid grid-cols-3 gap-2">
                                <a href="{{ $socialUrl }}" class="flex flex-col items-center p-2 rounded-xl bg-blue-600/10 border border-blue-500/30 text-white group active:scale-95 transition-all">
                                    <span class="text-xl mb-1">🌐</span>
                                    <span class="text-[11px] font-semibold">Social</span>
                                </a>
                                <a href="{{ $schoolUrl }}" class="flex flex-col items-center p-2 rounded-xl bg-white/[0.03] hover:bg-white/[0.08] text-gray-300 hover:text-white group active:scale-95 transition-all">
                                    <span class="text-xl mb-1">🏫</span>
                                    <span class="text-[11px] font-semibold">School</span>
                                </a>
                                <a href="{{ $posUrl }}" class="flex flex-col items-center p-2 rounded-xl bg-white/[0.03] hover:bg-white/[0.08] text-gray-300 hover:text-white group active:scale-95 transition-all">
                                    <span class="text-xl mb-1">💳</span>
                                    <span class="text-[11px] font-semibold">POS</span>
                                </a>
                                <a href="{{ $lawUrl }}" class="flex flex-col items-center p-2 rounded-xl bg-white/[0.03] hover:bg-white/[0.08] text-gray-300 hover:text-white group active:scale-95 transition-all">
                                    <span class="text-xl mb-1">⚖️</span>
                                    <span class="text-[11px] font-semibold">Law</span>
                                </a>
                                <a href="{{ $hotelUrl }}" class="flex flex-col items-center p-2 rounded-xl bg-white/[0.03] hover:bg-white/[0.08] text-gray-300 hover:text-white group active:scale-95 transition-all">
                                    <span class="text-xl mb-1">🏨</span>
                                    <span class="text-[11px] font-semibold">Hotel</span>
                                </a>
                                <a href="{{ $accountUrl }}" class="flex flex-col items-center p-2 rounded-xl bg-white/[0.03] hover:bg-white/[0.08] text-gray-300 hover:text-white group active:scale-95 transition-all">
                                    <span class="text-xl mb-1">🛡️</span>
                                    <span class="text-[11px] font-semibold">Account</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Eye-Comfort Warm Mode Toggle (Sun/Moon) -->
                    <button 
                        @click="toggleTheme()" 
                        type="button"
                        :class="nightYellow ? 'text-amber-400 bg-amber-500/10 border-amber-500/30' : 'text-gray-400 hover:text-white hover:bg-white/[0.06] border-transparent'"
                        class="p-2 rounded-xl border active:scale-95 transition-all focus:outline-none flex items-center justify-center cursor-pointer"
                        :title="nightYellow ? 'Eye Comfort: Night Yellow Active (Click for Midnight)' : 'Click to enable Night Yellow (Eye Comfort)'">
                        <template x-if="nightYellow">
                            <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </template>
                        <template x-if="!nightYellow">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                        </template>
                    </button>

                    <!-- Notifications Bell -->
                    <button class="relative p-2 rounded-xl text-gray-400 hover:text-white hover:bg-white/[0.06] border border-transparent hover:border-white/10 active:scale-95 transition-all focus:outline-none cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-cyan-400"></span>
                    </button>

                    @php
                        $authUser = auth()->user();
                        $authDisplayName = $authUser ? $authUser->name : null;
                        $authHandle = $authUser ? ($authUser->handle ?: $authUser->id) : null;
                        $authInitials = '';
                        if ($authUser) {
                            $np = explode(' ', trim($authUser->name));
                            $authInitials = count($np) > 1 
                                ? strtoupper(substr($np[0], 0, 1) . substr(end($np), 0, 1))
                                : strtoupper(substr($np[0], 0, 2));
                        }
                    @endphp

                    @if($authUser)
                    <!-- Citizen Profile Pill -->
                    <div class="relative">
                        <button 
                            @click="profileOpen = !profileOpen" 
                            @click.outside="profileOpen = false"
                            class="flex items-center gap-2 p-1 pl-2 pr-2.5 rounded-full bg-white/[0.04] hover:bg-white/[0.08] border border-white/[0.08] active:scale-95 transition-all focus:outline-none cursor-pointer">
                            <div class="relative">
                                @if($authUser->avatar_url)
                                    <img src="{{ $authUser->avatar_url }}" alt="{{ $authDisplayName }}" class="w-7 h-7 rounded-full object-cover" />
                                @else
                                    <div class="w-7 h-7 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-xs font-bold text-white shadow">
                                        {{ $authInitials }}
                                    </div>
                                @endif
                                @if($authUser->verified_badge || $authUser->nid_verified)
                                    <span class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 rounded-full bg-blue-500 border-2 border-[#0B0F17]" title="Verified Citizen"></span>
                                @endif
                            </div>
                            <span class="text-xs font-semibold text-gray-200 hidden sm:inline-block">{{ explode(' ', $authDisplayName)[0] }}</span>
                            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Profile Dropdown (Glassmorphism Shell) -->
                        <div 
                            x-show="profileOpen" 
                            x-cloak
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-60 backdrop-blur-xl bg-[#0B0F17]/85 border border-white/[0.08] rounded-2xl shadow-2xl p-2 z-50">
                            
                            <a href="{{ route('social.profile', ['handle' => $authHandle]) }}" class="flex items-center gap-3 p-2.5 rounded-xl hover:bg-white/[0.06] text-gray-200 hover:text-white active:scale-95 transition-all">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-xs font-bold text-white shrink-0">
                                    {{ $authInitials }}
                                </div>
                                <div class="overflow-hidden">
                                    <div class="text-xs font-bold text-white flex items-center gap-1 truncate">
                                        <span>{{ $authDisplayName }}</span>
                                        @if($authUser->verified_badge || $authUser->nid_verified)
                                            <svg class="w-3 h-3 text-blue-400 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                                        @endif
                                    </div>
                                    <div class="text-[11px] text-gray-400 truncate">{{ '@' . $authHandle }}</div>
                                </div>
                            </a>

                            <div class="my-1 border-t border-white/[0.08]"></div>

                            <a href="{{ $socialUrl }}" class="flex items-center gap-2.5 px-3 py-2 text-xs text-gray-300 hover:text-white hover:bg-white/[0.06] rounded-xl active:scale-95 transition-all">
                                <span>🌐 Hyperlocal Feed</span>
                            </a>
                            <a href="{{ route('social.profile', ['handle' => $authHandle]) }}" class="flex items-center gap-2.5 px-3 py-2 text-xs text-gray-300 hover:text-white hover:bg-white/[0.06] rounded-xl active:scale-95 transition-all">
                                <span>👤 Citizen Profile</span>
                            </a>
                            <a href="{{ $accountUrl }}" class="flex items-center gap-2.5 px-3 py-2 text-xs text-cyan-300 hover:text-cyan-200 hover:bg-cyan-500/10 rounded-xl active:scale-95 transition-all">
                                <span>🛡️ Sovereign Account Hub</span>
                            </a>
                            <a href="{{ $homeUrl }}" class="flex items-center gap-2.5 px-3 py-2 text-xs text-gray-300 hover:text-white hover:bg-white/[0.06] rounded-xl active:scale-95 transition-all">
                                <span>🏠 Zengfy Home</span>
                            </a>

                            <div class="my-1 border-t border-white/[0.08]"></div>

                            <!-- Eye-Comfort Mode Selector (Right near Sign Out) -->
                            <div class="px-2.5 py-2 rounded-xl bg-white/[0.03] border border-white/[0.06] my-1">
                                <div class="flex items-center justify-between text-[11px] mb-1.5 font-semibold">
                                    <span class="flex items-center gap-1.5" :class="nightYellow ? 'text-amber-400' : 'text-blue-400'">
                                        <span x-show="nightYellow">☀️</span>
                                        <span x-show="!nightYellow">🌙</span>
                                        <span>Eye Comfort Mode</span>
                                    </span>
                                    <span class="text-[10px] px-1.5 py-0.5 rounded text-gray-400 font-mono" x-text="nightYellow ? 'Night Yellow' : 'Midnight'"></span>
                                </div>
                                <div class="grid grid-cols-2 gap-1 p-0.5 bg-black/40 rounded-lg">
                                    <button 
                                        type="button" 
                                        @click=\"setTheme('midnight')\" 
                                        :class="!nightYellow ? 'bg-blue-600/40 text-white border-blue-500/50 font-bold shadow' : 'text-gray-400 hover:text-gray-200 border-transparent'"
                                        class="px-2 py-1 text-[10px] rounded-md border active:scale-95 transition-all text-center">
                                        🌙 Midnight
                                    </button>
                                    <button 
                                        type="button" 
                                        @click=\"setTheme('night_yellow')\" 
                                        :class="nightYellow ? 'bg-amber-500/30 text-amber-200 border-amber-500/50 font-bold shadow' : 'text-gray-400 hover:text-gray-200 border-transparent'"
                                        class="px-2 py-1 text-[10px] rounded-md border active:scale-95 transition-all text-center">
                                        ☀️ Night Yellow
                                    </button>
                                </div>
                            </div>

                            <div class="my-1 border-t border-white/[0.08]"></div>

                            <a href="{{ route('logout') }}" @click="localStorage.removeItem('zengfy_token')" class="flex items-center gap-2.5 px-3 py-2 text-xs text-rose-400 hover:text-rose-300 hover:bg-rose-500/10 rounded-xl active:scale-95 transition-all">
                                <span>🚪 Sign Out</span>
                            </a>
                        </div>
                    </div>
                    @else
                    <a href="/login" class="px-4 py-2 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-xs font-bold text-white shadow-lg shadow-blue-600/30 active:scale-95 transition-all flex items-center gap-1.5 focus:outline-none">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        <span>Sign In</span>
                    </a>
                    @endif

                </div>

            </div>
        </div>
    </header>

    <!-- Main View Content Injection -->
    <main class="relative z-10 flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6">
        @yield('content')
    </main>

    <!-- Android Native PWA Mobile Bottom Navigation Bar (5 Tabs) (Structural Shell: Pure Glassmorphism & SPA Switcher) -->
    <nav 
        x-data="{ 
            currentNavFilter: (new URLSearchParams(window.location.search).get('filter') || 'world'),
            navTo(f) {
                if (window.location.pathname.startsWith('/feed')) {
                    this.currentNavFilter = f;
                    window.dispatchEvent(new CustomEvent('zengfy:switch-filter', { detail: { filter: f } }));
                } else {
                    window.location.href = '/feed?filter=' + f;
                }
            }
        }" 
        @zengfy:filter-changed.window="currentNavFilter = $event.detail.filter"
        class="md:hidden fixed bottom-0 left-0 right-0 z-40 backdrop-blur-xl bg-[#0B0F17]/85 border-t border-white/[0.08] shadow-2xl px-2 py-2 pb-safe">
        <div class="grid grid-cols-5 items-center text-center">
            
            <!-- 1. World Feed -->
            <a href="/feed?filter=world" 
                @click.prevent="navTo('world')"
                :class="currentNavFilter === 'world' ? 'text-blue-400 font-bold' : 'text-gray-400 hover:text-white'"
                class="flex flex-col items-center gap-1 py-1 active:scale-95 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-[10px] leading-tight">World</span>
            </a>

            <!-- 2. Friends -->
            <a href="/feed?filter=friends" 
                @click.prevent="navTo('friends')"
                :class="currentNavFilter === 'friends' ? 'text-blue-400 font-bold' : 'text-gray-400 hover:text-white'"
                class="flex flex-col items-center gap-1 py-1 active:scale-95 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span class="text-[10px] leading-tight">Friends</span>
            </a>

            <!-- 3. Community -->
            <a href="/feed?filter=community" 
                @click.prevent="navTo('community')"
                :class="currentNavFilter === 'community' ? 'text-indigo-400 font-bold' : 'text-gray-400 hover:text-white'"
                class="flex flex-col items-center gap-1 py-1 active:scale-95 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <span class="text-[10px] leading-tight">Community</span>
            </a>

            <!-- 4. Nearby / SOS -->
            <a href="/feed?filter=nearby" 
                @click.prevent="navTo('nearby')"
                :class="currentNavFilter === 'nearby' ? 'text-cyan-400 font-bold' : 'text-gray-400 hover:text-white'"
                class="relative flex flex-col items-center gap-1 py-1 active:scale-95 transition-all">
                <div class="relative">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <!-- Emergency SOS Alert Beacon Dot -->
                    <span class="absolute -top-0.5 -right-0.5 w-2 h-2 rounded-full bg-rose-500 animate-ping"></span>
                    <span class="absolute -top-0.5 -right-0.5 w-2 h-2 rounded-full bg-rose-500"></span>
                </div>
                <span class="text-[10px] leading-tight">Nearby/SOS</span>
            </a>

            <!-- 5. Profile / Central SSO Login -->
            @if($authUser)
                <a href="{{ route('social.profile', ['handle' => $authHandle]) }}" class="flex flex-col items-center gap-1 py-1 text-gray-400 hover:text-white active:scale-95 transition-all">
                    <div class="relative">
                        @if($authUser->avatar_url)
                            <img src="{{ $authUser->avatar_url }}" alt="{{ $authDisplayName }}" class="w-5 h-5 rounded-full object-cover" />
                        @else
                            <div class="w-5 h-5 rounded-full bg-blue-600 flex items-center justify-center text-[9px] font-bold text-white">
                                {{ substr($authInitials, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <span class="text-[10px] leading-tight">Profile</span>
                </a>
            @else
                <a href="/login" class="flex flex-col items-center gap-1 py-1 text-blue-400 hover:text-blue-300 active:scale-95 transition-all font-semibold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    <span class="text-[10px] leading-tight">Sign In</span>
                </a>
            @endif

        </div>
    </nav>

    <!-- Theme Manager Script for Eye-Comfort Night Yellow -->
    <script>
        function themeManager() {
            return {
                nightYellow: localStorage.getItem('zengfy_eye_comfort') !== 'false',
                setTheme(mode) {
                    this.nightYellow = (mode === 'night_yellow');
                    localStorage.setItem('zengfy_eye_comfort', this.nightYellow ? 'true' : 'false');
                    this.applyTheme();
                },
                toggleTheme() {
                    this.setTheme(this.nightYellow ? 'midnight' : 'night_yellow');
                },
                applyTheme() {
                    if (this.nightYellow) {
                        document.body.classList.add('theme-night-yellow');
                    } else {
                        document.body.classList.remove('theme-night-yellow');
                    }
                },
                init() {
                    this.applyTheme();
                }
            };
        }
    </script>

    <!-- Back-Forward Cache (bfcache) Buster -->
    <script>
        window.addEventListener('pageshow', function (event) {
            const navEntries = (window.performance && window.performance.getEntriesByType) ? window.performance.getEntriesByType('navigation') : [];
            const isBackForward = event.persisted || 
                (window.performance && window.performance.navigation && window.performance.navigation.type === 2) ||
                (navEntries.length > 0 && navEntries[0].type === 'back_forward');

            if (isBackForward) {
                window.location.reload();
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
