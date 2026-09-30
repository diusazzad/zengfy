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

    @stack('styles')
</head>

<body class="bg-[#0B0F17] text-gray-100 min-h-screen flex flex-col selection:bg-blue-600 selection:text-white antialiased relative overflow-x-hidden">

    <!-- Ambient Glowing Background Grid & Orbs -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0" aria-hidden="true">
        <!-- Radial Gradient Glow Top -->
        <div class="absolute -top-40 left-1/3 -translate-x-1/2 w-[700px] h-[500px] bg-gradient-to-b from-blue-600/15 via-indigo-600/10 to-transparent blur-3xl opacity-70 animate-pulse-slow"></div>
        <!-- Radial Gradient Glow Bottom Right -->
        <div class="absolute top-1/2 -right-40 w-[500px] h-[500px] bg-gradient-to-t from-cyan-500/10 via-blue-700/10 to-transparent blur-3xl opacity-40"></div>
        <!-- Subtle Vector Grid Pattern -->
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff05_1px,transparent_1px),linear-gradient(to_bottom,#ffffff05_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)]"></div>
    </div>

    <!-- Navigation Header -->
    <header class="sticky top-0 z-40 w-full bg-[#0B0F17]/90 backdrop-blur-xl border-b border-white/[0.08]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 gap-4">

                <!-- Left: Brand Logo & Hyperlocal Ward Badge -->
                <div class="flex items-center gap-4 shrink-0">
                    <a href="/feed" class="flex items-center gap-2.5 group focus:outline-none">
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
                            class="w-full pl-10 pr-4 py-2 bg-white/[0.04] border border-white/10 rounded-xl text-sm text-gray-200 placeholder-gray-500 focus:outline-none focus:border-blue-500 focus:bg-white/[0.06] transition-all"
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
                            class="p-2 rounded-xl text-gray-400 hover:text-white hover:bg-white/[0.06] border border-transparent hover:border-white/10 transition-colors focus:outline-none"
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

                        <!-- 9-Dot Dropdown Grid -->
                        <div 
                            x-show="launcherOpen" 
                            x-cloak
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-72 bg-[#121A29] border border-white/10 rounded-2xl shadow-2xl backdrop-blur-2xl p-4 z-50">
                            <div class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3 px-1">
                                Zengfy Unified Apps
                            </div>
                            <div class="grid grid-cols-3 gap-2">
                                <a href="/feed" class="flex flex-col items-center p-2 rounded-xl bg-blue-600/10 border border-blue-500/30 text-white group hover:scale-105 transition-all">
                                    <span class="text-xl mb-1">🌐</span>
                                    <span class="text-[11px] font-semibold">Social</span>
                                </a>
                                <a href="https://school.zengfy.top" target="_blank" class="flex flex-col items-center p-2 rounded-xl bg-white/[0.03] hover:bg-white/[0.08] text-gray-300 hover:text-white group hover:scale-105 transition-all">
                                    <span class="text-xl mb-1">🏫</span>
                                    <span class="text-[11px] font-semibold">School</span>
                                </a>
                                <a href="https://pos.zengfy.top" target="_blank" class="flex flex-col items-center p-2 rounded-xl bg-white/[0.03] hover:bg-white/[0.08] text-gray-300 hover:text-white group hover:scale-105 transition-all">
                                    <span class="text-xl mb-1">💳</span>
                                    <span class="text-[11px] font-semibold">POS</span>
                                </a>
                                <a href="https://law.zengfy.top" target="_blank" class="flex flex-col items-center p-2 rounded-xl bg-white/[0.03] hover:bg-white/[0.08] text-gray-300 hover:text-white group hover:scale-105 transition-all">
                                    <span class="text-xl mb-1">⚖️</span>
                                    <span class="text-[11px] font-semibold">Law</span>
                                </a>
                                <a href="https://hotel.zengfy.top" target="_blank" class="flex flex-col items-center p-2 rounded-xl bg-white/[0.03] hover:bg-white/[0.08] text-gray-300 hover:text-white group hover:scale-105 transition-all">
                                    <span class="text-xl mb-1">🏨</span>
                                    <span class="text-[11px] font-semibold">Hotel</span>
                                </a>
                                <a href="https://smartai.zengfy.top" target="_blank" class="flex flex-col items-center p-2 rounded-xl bg-white/[0.03] hover:bg-white/[0.08] text-gray-300 hover:text-white group hover:scale-105 transition-all">
                                    <span class="text-xl mb-1">🤖</span>
                                    <span class="text-[11px] font-semibold">Smart AI</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Notifications Bell -->
                    <button class="relative p-2 rounded-xl text-gray-400 hover:text-white hover:bg-white/[0.06] border border-transparent hover:border-white/10 transition-colors focus:outline-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-cyan-400"></span>
                    </button>

                    <!-- Citizen Profile Pill -->
                    <div class="relative">
                        <button 
                            @click="profileOpen = !profileOpen" 
                            @click.outside="profileOpen = false"
                            class="flex items-center gap-2 p-1 pl-2 pr-2.5 rounded-full bg-white/[0.04] hover:bg-white/[0.08] border border-white/10 transition-all focus:outline-none">
                            <div class="relative">
                                <div class="w-7 h-7 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-xs font-bold text-white shadow">
                                    SH
                                </div>
                                <span class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 rounded-full bg-blue-500 border-2 border-[#0B0F17]" title="Smart NID Verified"></span>
                            </div>
                            <span class="text-xs font-semibold text-gray-200 hidden sm:inline-block">Sazzad</span>
                            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Profile Dropdown -->
                        <div 
                            x-show="profileOpen" 
                            x-cloak
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-56 bg-[#121A29] border border-white/10 rounded-2xl shadow-2xl backdrop-blur-2xl p-2 z-50">
                            
                            <a href="/u/sazzad" class="flex items-center gap-3 p-2.5 rounded-xl hover:bg-white/[0.06] text-gray-200 hover:text-white transition-colors">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-xs font-bold text-white">
                                    SH
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-white flex items-center gap-1">
                                        <span>Sazzad Hossain</span>
                                        <svg class="w-3 h-3 text-blue-400" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                                    </div>
                                    <div class="text-[11px] text-gray-400">@sazzad</div>
                                </div>
                            </a>

                            <div class="my-1 border-t border-white/[0.08]"></div>

                            <a href="/feed" class="flex items-center gap-2.5 px-3 py-2 text-xs text-gray-300 hover:text-white hover:bg-white/[0.06] rounded-xl transition-colors">
                                <span>🌐 Hyperlocal Feed</span>
                            </a>
                            <a href="/u/sazzad" class="flex items-center gap-2.5 px-3 py-2 text-xs text-gray-300 hover:text-white hover:bg-white/[0.06] rounded-xl transition-colors">
                                <span>👤 Citizen Profile</span>
                            </a>
                            <a href="/" class="flex items-center gap-2.5 px-3 py-2 text-xs text-gray-300 hover:text-white hover:bg-white/[0.06] rounded-xl transition-colors">
                                <span>🏠 Zengfy Home</span>
                            </a>

                            <div class="my-1 border-t border-white/[0.08]"></div>

                            <a href="/login" class="flex items-center gap-2.5 px-3 py-2 text-xs text-rose-400 hover:text-rose-300 hover:bg-rose-500/10 rounded-xl transition-colors">
                                <span>🚪 Sign Out</span>
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </header>

    <!-- Main View Content Injection -->
    <main class="relative z-10 flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6">
        @yield('content')
    </main>

    <!-- Mobile Bottom Navigation Bar -->
    <nav class="md:hidden fixed bottom-0 left-0 right-0 z-40 bg-[#0B0F17]/95 backdrop-blur-xl border-t border-white/[0.08] px-4 py-2">
        <div class="flex items-center justify-around">
            <a href="/feed" class="flex flex-col items-center gap-1 text-blue-400 py-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
                <span class="text-[10px] font-semibold">Feed</span>
            </a>
            <a href="/feed?filter=ward" class="flex flex-col items-center gap-1 text-gray-400 hover:text-white py-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span class="text-[10px] font-semibold">My Ward</span>
            </a>
            <a href="/u/sazzad" class="flex flex-col items-center gap-1 text-gray-400 hover:text-white py-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="text-[10px] font-semibold">Profile</span>
            </a>
        </div>
    </nav>

    @stack('scripts')
</body>
</html>
