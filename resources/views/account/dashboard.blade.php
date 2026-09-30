<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sovereign Account Hub | Zengfy</title>
    <meta name="description" content="Manage your unified identity, active devices, and ecosystem apps in the Zengfy Sovereign Account Hub.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'monospace'],
                    },
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
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0B0F17; }
        ::-webkit-scrollbar-thumb { background: #1F2937; border-radius: 9999px; }
    </style>
</head>

<body class="bg-[#0B0F17] text-gray-100 min-h-screen flex flex-col justify-between selection:bg-blue-600 selection:text-white antialiased relative"
      x-data="{ 
          appSwitcherOpen: false, 
          profileMenuOpen: false, 
          activeTab: 'overview',
          editProfileOpen: false,
          verifyNidOpen: false
      }">

    <!-- Ambient Glowing Orbs -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0" aria-hidden="true">
        <div class="absolute -top-40 left-1/3 w-[600px] h-[500px] bg-gradient-to-b from-blue-600/15 via-indigo-600/10 to-transparent blur-3xl opacity-60"></div>
        <div class="absolute -bottom-40 right-10 w-[500px] h-[500px] bg-gradient-to-t from-cyan-500/15 via-blue-700/10 to-transparent blur-3xl opacity-50"></div>
    </div>

    <!-- 1. Top Navbar (Google Workspace Style) -->
    <header class="sticky top-0 z-40 bg-[#0E1524]/90 backdrop-blur-xl border-b border-white/[0.08]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between gap-4">
            
            <!-- Left: Logo & Hub Title -->
            <div class="flex items-center gap-3">
                <a href="{{ route('welcome') }}" class="flex items-center gap-2.5 group">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-blue-600 via-indigo-600 to-cyan-400 flex items-center justify-center font-black text-lg text-white shadow-lg shadow-blue-500/25 group-hover:scale-105 transition-transform">
                        Z
                    </div>
                    <span class="text-xl font-extrabold tracking-tight text-white">
                        Zengfy<span class="text-blue-500 font-black">.</span>
                    </span>
                </a>
                <span class="text-xs px-2.5 py-0.5 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 font-semibold hidden sm:inline-block">
                    Sovereign Account Hub
                </span>
            </div>

            <!-- Middle Navigation Links -->
            <nav class="hidden md:flex items-center gap-1 text-sm font-medium">
                <button @click="activeTab = 'overview'" 
                        :class="activeTab === 'overview' ? 'text-white bg-white/[0.08] border-white/20' : 'text-gray-400 hover:text-white hover:bg-white/[0.04] border-transparent'"
                        class="px-3.5 py-1.5 rounded-xl border text-xs sm:text-sm font-semibold transition-all">
                    Overview
                </button>
                <button @click="activeTab = 'security'" 
                        :class="activeTab === 'security' ? 'text-white bg-white/[0.08] border-white/20' : 'text-gray-400 hover:text-white hover:bg-white/[0.04] border-transparent'"
                        class="px-3.5 py-1.5 rounded-xl border text-xs sm:text-sm font-semibold transition-all">
                    Security & Devices
                </button>
                <button @click="activeTab = 'apps'" 
                        :class="activeTab === 'apps' ? 'text-white bg-white/[0.08] border-white/20' : 'text-gray-400 hover:text-white hover:bg-white/[0.04] border-transparent'"
                        class="px-3.5 py-1.5 rounded-xl border text-xs sm:text-sm font-semibold transition-all">
                    Ecosystem Apps
                </button>
                <a href="{{ route('social.feed') }}" 
                   class="px-3.5 py-1.5 rounded-xl text-xs sm:text-sm font-semibold text-cyan-400 hover:text-cyan-300 hover:bg-cyan-500/10 transition-all flex items-center gap-1.5">
                    <span>Social Feed</span>
                    <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-pulse"></span>
                </a>
            </nav>

            <!-- Right: 9-Dot App Launcher & User Profile Menu -->
            <div class="flex items-center gap-3">

                <!-- 9-Dot Google-Style App Switcher -->
                <div class="relative">
                    <button @click="appSwitcherOpen = !appSwitcherOpen" 
                            title="Zengfy Apps" 
                            class="w-10 h-10 rounded-xl bg-white/[0.04] hover:bg-white/[0.08] border border-white/10 flex items-center justify-center text-gray-300 hover:text-white transition-all cursor-pointer">
                        <!-- 9-dot SVG -->
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

                    <!-- 9-Dot Dropdown Menu -->
                    <div x-show="appSwitcherOpen" 
                         @click.away="appSwitcherOpen = false" 
                         x-cloak
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         class="absolute right-0 mt-2 w-80 sm:w-96 bg-[#121A29] border border-white/15 rounded-2xl shadow-2xl backdrop-blur-2xl p-4 z-50">
                        <div class="flex items-center justify-between mb-3 pb-2 border-b border-white/10">
                            <span class="text-xs font-bold uppercase tracking-wider text-gray-400">Ecosystem Applications</span>
                            <span class="text-[10px] text-cyan-400 font-semibold">Unified SSO</span>
                        </div>
                        <div class="grid grid-cols-3 gap-2.5">
                            @foreach($ecosystemApps as $app)
                            <a href="{{ $app['url'] }}" 
                               class="flex flex-col items-center text-center p-2.5 rounded-xl hover:bg-white/[0.06] border border-transparent hover:border-white/10 transition-all group">
                                <span class="text-2xl mb-1.5 transform group-hover:scale-110 transition-transform">{{ $app['icon'] }}</span>
                                <span class="text-xs font-semibold text-white group-hover:text-cyan-400 transition-colors">{{ $app['name'] }}</span>
                                <span class="text-[9px] text-gray-400 truncate max-w-full mt-0.5">{{ $app['category'] }}</span>
                            </a>
                            @endforeach
                        </div>
                        <div class="mt-3 pt-2.5 border-t border-white/10 text-center">
                            <a href="{{ route('download.app') }}" class="text-xs font-semibold text-cyan-400 hover:text-cyan-300 flex items-center justify-center gap-1.5">
                                <span>📱 Download Android APK</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- User Profile Dropdown -->
                <div class="relative">
                    <button @click="profileMenuOpen = !profileMenuOpen" 
                            class="flex items-center gap-2 pl-2 pr-3 py-1.5 rounded-xl bg-white/[0.04] hover:bg-white/[0.08] border border-white/10 transition-all cursor-pointer">
                        <div class="w-7 h-7 rounded-lg bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white font-bold text-xs">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <span class="text-xs font-semibold text-white max-w-[100px] truncate hidden sm:inline-block">
                            {{ $user->name }}
                        </span>
                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Profile Dropdown -->
                    <div x-show="profileMenuOpen" 
                         @click.away="profileMenuOpen = false" 
                         x-cloak
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         class="absolute right-0 mt-2 w-64 bg-[#121A29] border border-white/15 rounded-2xl shadow-2xl p-3 z-50">
                        <div class="p-2 border-b border-white/10 mb-2">
                            <p class="text-xs font-bold text-white truncate">{{ $user->name }}</p>
                            <p class="text-[11px] text-gray-400 truncate">{{ $user->email }}</p>
                            <p class="text-[10px] text-cyan-400 font-mono mt-1">@{{ $user->handle ?? 'citizen' }}</p>
                        </div>
                        <a href="{{ route('social.feed') }}" class="flex items-center gap-2 px-3 py-2 text-xs font-medium text-gray-300 hover:text-white hover:bg-white/[0.06] rounded-xl transition">
                            <span>🌐 Zengfy Social Feed</span>
                        </a>
                        <button @click="activeTab = 'security'; profileMenuOpen = false;" class="w-full text-left flex items-center gap-2 px-3 py-2 text-xs font-medium text-gray-300 hover:text-white hover:bg-white/[0.06] rounded-xl transition">
                            <span>🔒 Security & Sessions</span>
                        </button>
                        <hr class="my-1.5 border-white/10">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left flex items-center gap-2 px-3 py-2 text-xs font-bold text-rose-400 hover:bg-rose-500/10 rounded-xl transition">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                <span>Sign Out Everywhere</span>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <!-- 2. Main Content Dashboard Container -->
    <main class="relative z-10 flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Notification Banners -->
        @if(session('success') || request('welcome') || request('reset'))
        <div class="mb-6 p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 text-sm flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl bg-emerald-500/20 flex items-center justify-center text-emerald-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div>
                    @if(request('welcome'))
                        <p class="font-bold text-white">Welcome to Zengfy Sovereign Digital Network!</p>
                        <p class="text-xs text-emerald-300">Your unified account is active across all 15 ecosystem modules.</p>
                    @elseif(request('reset'))
                        <p class="font-bold text-white">Password Updated Successfully!</p>
                        <p class="text-xs text-emerald-300">Your account credentials have been securely refreshed.</p>
                    @else
                        <p class="font-bold text-white">{{ session('success') }}</p>
                    @endif
                </div>
            </div>
        </div>
        @endif

        @if($errors->any())
        <div class="mb-6 p-4 rounded-2xl bg-rose-500/10 border border-rose-500/30 text-rose-300 text-sm">
            <ul class="list-disc pl-5 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- TAB 1: OVERVIEW & PROFILE HUB -->
        <div x-show="activeTab === 'overview'" class="space-y-6">

            <!-- Hero Citizen Identity Card -->
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-[#121A29] via-[#0E1626] to-[#0A101C] border border-white/10 p-6 sm:p-8 shadow-2xl">
                <!-- Decorative Glow Line -->
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-600 via-cyan-400 to-indigo-600"></div>

                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <!-- Left: Avatar & Details -->
                    <div class="flex items-start sm:items-center gap-5">
                        <div class="relative shrink-0">
                            <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl bg-gradient-to-tr from-blue-600 via-indigo-600 to-cyan-400 p-1 shadow-xl shadow-blue-600/20">
                                <div class="w-full h-full bg-[#0B0F17] rounded-xl flex items-center justify-center font-black text-2xl sm:text-3xl text-white">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            </div>
                            <span class="absolute bottom-1 right-1 w-4 h-4 rounded-full bg-emerald-500 border-2 border-[#0B0F17]" title="Active Sovereign Citizen"></span>
                        </div>

                        <div class="space-y-1">
                            <div class="flex flex-wrap items-center gap-2">
                                <h1 class="text-xl sm:text-2xl font-extrabold text-white">{{ $user->name }}</h1>
                                
                                @if($user->nid_verified || $user->verified_badge)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-cyan-500/10 border border-cyan-500/30 text-cyan-300 text-xs font-bold">
                                        <svg class="w-3.5 h-3.5 text-cyan-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        <span>Verified Citizen</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-300 text-xs font-bold">
                                        <span>🟡 Unverified NID</span>
                                    </span>
                                @endif
                            </div>

                            <p class="text-xs sm:text-sm text-gray-400 flex flex-wrap items-center gap-3">
                                <span class="font-mono text-cyan-400">@{{ $user->handle ?? 'citizen_' . substr($user->id, 0, 8) }}</span>
                                <span>•</span>
                                <span>{{ $user->email }}</span>
                                <span>•</span>
                                <span>{{ $user->ward_code ?? 'Ward Code Unassigned' }}</span>
                            </p>

                            @if($user->bio)
                                <p class="text-xs text-gray-300 italic pt-1">{{ $user->bio }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Right: Quick Actions -->
                    <div class="flex flex-wrap sm:flex-nowrap items-center gap-3">
                        <button @click="editProfileOpen = !editProfileOpen" 
                                class="px-4 py-2.5 rounded-xl bg-white/[0.06] hover:bg-white/[0.1] border border-white/10 text-white font-semibold text-xs sm:text-sm transition-all flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                            </svg>
                            <span>Edit Profile</span>
                        </button>

                        <a href="{{ route('social.feed') }}" 
                           class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white font-bold text-xs sm:text-sm shadow-lg shadow-blue-500/25 transition-all flex items-center gap-2">
                            <span>Open Social Feed</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Citizen Social Stats Ribbon -->
                <div class="mt-6 pt-6 border-t border-white/[0.08] grid grid-cols-2 sm:grid-cols-4 gap-4 text-center">
                    <div class="p-3 rounded-2xl bg-white/[0.02] border border-white/[0.05]">
                        <p class="text-xs text-gray-400">Social Followers</p>
                        <p class="text-xl font-extrabold text-white mt-0.5">{{ $user->followers_count ?? 0 }}</p>
                    </div>
                    <div class="p-3 rounded-2xl bg-white/[0.02] border border-white/[0.05]">
                        <p class="text-xs text-gray-400">Following</p>
                        <p class="text-xl font-extrabold text-white mt-0.5">{{ $user->following_count ?? 0 }}</p>
                    </div>
                    <div class="p-3 rounded-2xl bg-white/[0.02] border border-white/[0.05]">
                        <p class="text-xs text-gray-400">Mutual Friends</p>
                        <p class="text-xl font-extrabold text-white mt-0.5">{{ $user->friends_count ?? 0 }}</p>
                    </div>
                    <div class="p-3 rounded-2xl bg-white/[0.02] border border-white/[0.05]">
                        <p class="text-xs text-gray-400">Active Devices</p>
                        <p class="text-xl font-extrabold text-cyan-400 mt-0.5">{{ $activeDevices->count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Bento Row: Connected Pillars -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Pillar A: Sovereign Security & Vault -->
                <div class="rounded-3xl bg-[#121A29] border border-white/10 p-6 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xs font-bold uppercase tracking-wider text-blue-400">Pillar 1: Identity & SSO</span>
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">Central Security Gateway</h3>
                        <p class="text-xs text-gray-400 leading-relaxed">
                            Your account is protected with 12-round bcrypt hash, 256-bit AES encryption, and Sanctum tokens.
                        </p>
                        <div class="mt-4 space-y-2 text-xs">
                            <div class="flex justify-between py-1.5 border-b border-white/[0.05]">
                                <span class="text-gray-400">NID Status</span>
                                <span class="font-semibold {{ $user->nid_verified ? 'text-emerald-400' : 'text-amber-400' }}">
                                    {{ $user->nid_verified ? 'Verified Citizen' : 'Pending Verification' }}
                                </span>
                            </div>
                            <div class="flex justify-between py-1.5 border-b border-white/[0.05]">
                                <span class="text-gray-400">SSO Token Scope</span>
                                <span class="font-semibold text-white">Full Ecosystem</span>
                            </div>
                        </div>
                    </div>
                    <button @click="activeTab = 'security'" class="mt-6 w-full py-2.5 px-4 rounded-xl bg-white/[0.06] hover:bg-white/[0.1] text-xs font-semibold text-white border border-white/10 transition text-center">
                        Manage Security & Passwords →
                    </button>
                </div>

                <!-- Pillar B: Zengfy Social -->
                <div class="rounded-3xl bg-[#121A29] border border-white/10 p-6 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xs font-bold uppercase tracking-wider text-cyan-400">Pillar 2: Social Network</span>
                            <span class="text-xs px-2 py-0.5 rounded-full bg-cyan-500/10 text-cyan-400 border border-cyan-500/20">Hyperlocal</span>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">Verified Citizen Community</h3>
                        <p class="text-xs text-gray-400 leading-relaxed">
                            Connect with verified neighbors, publish updates, trigger emergency SOS, and message friends with zero bot interference.
                        </p>
                        <div class="mt-4 p-3 rounded-2xl bg-cyan-500/[0.05] border border-cyan-500/20 text-xs text-cyan-300">
                            💡 Ready to publish your first verified update or connect with friends?
                        </div>
                    </div>
                    <a href="{{ route('social.feed') }}" class="mt-6 w-full py-2.5 px-4 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-xs font-bold text-white shadow-lg shadow-blue-600/20 transition text-center">
                        Launch Social Community →
                    </a>
                </div>

                <!-- Pillar C: Mobile Android APK -->
                <div class="rounded-3xl bg-[#121A29] border border-white/10 p-6 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xs font-bold uppercase tracking-wider text-emerald-400">Mobile Ecosystem</span>
                            <span class="text-xs px-2 py-0.5 rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">Alpha v1.0</span>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">Zengfy Android APK</h3>
                        <p class="text-xs text-gray-400 leading-relaxed">
                            Native Android app packaging with biometric NID scanning, ward SOS beacon, and instant push notifications.
                        </p>
                        <div class="mt-4 space-y-1.5 text-xs text-gray-400">
                            <p class="flex items-center gap-2"><span>📷</span> Biometric Camera OCR</p>
                            <p class="flex items-center gap-2"><span>🚨</span> 1-Tap SOS Geolocation</p>
                        </div>
                    </div>
                    <a href="{{ route('download.app') }}" class="mt-6 w-full py-2.5 px-4 rounded-xl bg-white/[0.06] hover:bg-white/[0.1] text-xs font-semibold text-emerald-300 border border-emerald-500/30 transition text-center">
                        Get Android APK Build →
                    </a>
                </div>

            </div>

            <!-- Profile Edit Drawer / Form (Collapsible) -->
            <div x-show="editProfileOpen" x-cloak class="p-6 rounded-3xl bg-[#121A29] border border-white/15 shadow-2xl">
                <div class="flex items-center justify-between mb-4 pb-3 border-b border-white/10">
                    <h3 class="text-base font-bold text-white">Update Sovereign Profile</h3>
                    <button @click="editProfileOpen = false" class="text-xs text-gray-400 hover:text-white">✕ Close</button>
                </div>
                <form action="{{ route('account.profile') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-gray-300 mb-1">Full Legal Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-3.5 py-2.5 bg-[#0B0F17] border border-white/10 rounded-xl text-white text-xs sm:text-sm focus:border-blue-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-300 mb-1">Sovereign Handle (@handle)</label>
                        <input type="text" name="handle" value="{{ old('handle', $user->handle) }}" placeholder="e.g. sazzad" class="w-full px-3.5 py-2.5 bg-[#0B0F17] border border-white/10 rounded-xl text-white text-xs sm:text-sm focus:border-blue-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-300 mb-1">Ward Code (Dhaka / Division)</label>
                        <input type="text" name="ward_code" value="{{ old('ward_code', $user->ward_code) }}" placeholder="e.g. WARD-DHAKA-19" class="w-full px-3.5 py-2.5 bg-[#0B0F17] border border-white/10 rounded-xl text-white text-xs sm:text-sm focus:border-blue-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-300 mb-1">Contact Phone</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="+8801700000000" class="w-full px-3.5 py-2.5 bg-[#0B0F17] border border-white/10 rounded-xl text-white text-xs sm:text-sm focus:border-blue-500 focus:outline-none">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold text-gray-300 mb-1">Bio / Citizen Statement</label>
                        <textarea name="bio" rows="2" placeholder="Tell your verified neighbors about yourself..." class="w-full px-3.5 py-2 bg-[#0B0F17] border border-white/10 rounded-xl text-white text-xs sm:text-sm focus:border-blue-500 focus:outline-none">{{ old('bio', $user->bio) }}</textarea>
                    </div>
                    <div class="sm:col-span-2 flex justify-end gap-3 pt-2">
                        <button type="button" @click="editProfileOpen = false" class="px-4 py-2 rounded-xl bg-white/[0.05] text-xs font-semibold text-gray-400 hover:text-white">Cancel</button>
                        <button type="submit" class="px-5 py-2 rounded-xl bg-blue-600 hover:bg-blue-500 text-xs font-bold text-white shadow-lg shadow-blue-600/30">Save Profile</button>
                    </div>
                </form>
            </div>

        </div>

        <!-- TAB 2: SECURITY & ACTIVE DEVICES -->
        <div x-show="activeTab === 'security'" x-cloak class="space-y-6">

            <!-- Active Sessions & Device Management -->
            <div class="rounded-3xl bg-[#121A29] border border-white/10 p-6 sm:p-8 shadow-2xl">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 pb-4 border-b border-white/10">
                    <div>
                        <h2 class="text-xl font-bold text-white">Active Login Sessions</h2>
                        <p class="text-xs text-gray-400 mt-1">Manage all web browsers, tablets, and mobile devices connected to your sovereign account.</p>
                    </div>

                    @if($activeDevices->count() > 1)
                    <form action="{{ route('account.devices.revoke-all') }}" method="POST" onsubmit="return confirm('Terminate all sessions except this current device?');">
                        @csrf
                        <button type="submit" class="px-4 py-2.5 rounded-xl bg-rose-500/10 hover:bg-rose-500/20 border border-rose-500/30 text-rose-300 font-bold text-xs transition flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            <span>Sign Out Other Devices</span>
                        </button>
                    </form>
                    @endif
                </div>

                <div class="space-y-3">
                    @forelse($activeDevices as $device)
                    <div class="p-4 rounded-2xl bg-white/[0.02] border border-white/[0.06] hover:border-white/15 transition flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-400 shrink-0">
                                @if(str_contains($device->device_name, 'Android') || str_contains($device->device_name, 'Mobile'))
                                    📱
                                @else
                                    💻
                                @endif
                            </div>
                            <div class="space-y-0.5">
                                <div class="flex items-center gap-2">
                                    <p class="text-sm font-bold text-white">{{ $device->device_name }}</p>
                                    @if(request()->ip() === $device->ip_address)
                                        <span class="px-2 py-0.5 rounded-full bg-emerald-500/15 border border-emerald-500/30 text-emerald-300 text-[10px] font-bold">This Device</span>
                                    @endif
                                </div>
                                <p class="text-xs text-gray-400">
                                    IP: <span class="font-mono text-gray-300">{{ $device->ip_address }}</span> • Last Active: {{ $device->last_active_at ? $device->last_active_at->diffForHumans() : 'Just now' }}
                                </p>
                            </div>
                        </div>

                        <div>
                            @if(request()->ip() !== $device->ip_address)
                            <form action="{{ route('account.device.revoke', $device->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-xs text-rose-400 hover:text-rose-300 font-semibold px-3 py-1.5 rounded-lg hover:bg-rose-500/10 transition">
                                    Revoke
                                </button>
                            </form>
                            @else
                            <span class="text-xs text-emerald-400 font-semibold flex items-center gap-1">
                                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> Active Session
                            </span>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-6 text-xs text-gray-500">
                        No active sessions recorded yet.
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Change Password Card -->
            <div class="rounded-3xl bg-[#121A29] border border-white/10 p-6 sm:p-8 shadow-2xl">
                <h2 class="text-xl font-bold text-white mb-2">Change Account Password</h2>
                <p class="text-xs text-gray-400 mb-6">Ensure your account uses a unique 8+ character password to safeguard your sovereign credentials.</p>

                <form action="{{ route('account.password') }}" method="POST" class="max-w-xl space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-gray-300 mb-1.5 uppercase tracking-wider">Current Password</label>
                        <input type="password" name="current_password" required placeholder="••••••••••••" class="w-full px-4 py-3 bg-[#0B0F17] border border-white/10 rounded-xl text-white text-sm focus:border-blue-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-300 mb-1.5 uppercase tracking-wider">New Password</label>
                        <input type="password" name="new_password" required minlength="8" placeholder="••••••••••••" class="w-full px-4 py-3 bg-[#0B0F17] border border-white/10 rounded-xl text-white text-sm focus:border-blue-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-300 mb-1.5 uppercase tracking-wider">Confirm New Password</label>
                        <input type="password" name="new_password_confirmation" required minlength="8" placeholder="••••••••••••" class="w-full px-4 py-3 bg-[#0B0F17] border border-white/10 rounded-xl text-white text-sm focus:border-blue-500 focus:outline-none">
                    </div>
                    <button type="submit" class="px-6 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-bold text-sm shadow-lg shadow-blue-600/30 transition">
                        Update Password
                    </button>
                </form>
            </div>

        </div>

        <!-- TAB 3: ECOSYSTEM APPS -->
        <div x-show="activeTab === 'apps'" x-cloak class="space-y-6">
            <div class="rounded-3xl bg-[#121A29] border border-white/10 p-6 sm:p-8 shadow-2xl">
                <div class="mb-6 pb-4 border-b border-white/10">
                    <h2 class="text-xl font-bold text-white">Ecosystem Applications & Services</h2>
                    <p class="text-xs text-gray-400 mt-1">Single sign-on access to all sovereign sub-applications connected to your Zengfy ID.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach($ecosystemApps as $app)
                    <div class="p-5 rounded-2xl bg-white/[0.02] border border-white/[0.08] hover:border-white/20 transition flex flex-col justify-between group">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-3xl">{{ $app['icon'] }}</span>
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full border {{ $app['badge_color'] }}">
                                    {{ $app['badge'] }}
                                </span>
                            </div>
                            <h3 class="text-base font-bold text-white group-hover:text-cyan-400 transition-colors">{{ $app['name'] }}</h3>
                            <p class="text-xs text-gray-400 mt-1 leading-relaxed">{{ $app['desc'] }}</p>
                        </div>
                        <div class="mt-4 pt-3 border-t border-white/[0.05]">
                            @if($app['url'] !== '#')
                            <a href="{{ $app['url'] }}" class="text-xs font-semibold text-blue-400 hover:text-blue-300 flex items-center justify-between">
                                <span>Launch Service</span>
                                <span>→</span>
                            </a>
                            @else
                            <span class="text-xs text-gray-500 italic">Coming in Phase 2</span>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </main>

    <!-- 3. Footer -->
    <footer class="relative z-10 border-t border-white/[0.06] bg-[#0E1524] py-6 text-center text-xs text-gray-500">
        <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p>© {{ date('Y') }} Zengfy Inc. Bangladesh's Premier Sovereign Identity Network.</p>
            <div class="flex items-center gap-4 text-gray-400">
                <a href="{{ route('terms') }}" class="hover:text-white transition">Terms of Service</a>
                <span>•</span>
                <a href="{{ route('download.app') }}" class="hover:text-white transition">Android App</a>
                <span>•</span>
                <a href="{{ route('faq') }}" class="hover:text-white transition">Support & FAQ</a>
            </div>
        </div>
    </footer>

</body>
</html>
