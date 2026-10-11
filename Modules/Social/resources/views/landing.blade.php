<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zengfy Social | Real People. Real Communities. Zero Noise.</title>
    <meta name="description" content="Clean, bot-free sovereign social network for verified citizens. Hyperlocal feeds, friends, and community forums.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (CDN configured for light & clean aesthetics) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            blue: '#2563EB',
                            blueHover: '#1D4ED8',
                            slate: '#0F172A',
                            muted: '#64748B',
                            border: '#E2E8F0',
                            card: '#FFFFFF',
                            bg: '#FAFAFA'
                        }
                    }
                }
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #FAFAFA; 
            color: #0F172A; 
            -webkit-font-smoothing: antialiased;
        }
        /* Custom subtle scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #F1F5F9; }
        ::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 9999px; }
        ::-webkit-scrollbar-thumb:hover { background: #94A3B8; }
        
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>

@php
    $baseDomain = env('APP_BASE_DOMAIN', 'zengfy.test');
    $scheme = request()->getScheme();
    $port = request()->getPort();
    $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";

    $feedUrl = $feedUrl ?? "{$scheme}://social.{$baseDomain}{$portSuffix}/feed";
    $homeUrl = $homeUrl ?? "{$scheme}://{$baseDomain}{$portSuffix}/";
    $loginUrl = $loginUrl ?? "{$scheme}://{$baseDomain}{$portSuffix}/login";
    $ssoLoginUrl = "{$loginUrl}?continue=" . urlencode($feedUrl);
@endphp

<body class="bg-[#FAFAFA] text-slate-900 min-h-screen flex flex-col justify-between selection:bg-blue-600 selection:text-white antialiased relative overflow-x-hidden">

    <!-- Ambient Subtle Top Light Glow -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0" aria-hidden="true">
        <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[900px] h-[480px] bg-gradient-to-b from-blue-100/70 via-indigo-50/40 to-transparent blur-3xl opacity-80 rounded-full"></div>
        <div class="absolute top-1/3 -right-32 w-[500px] h-[500px] bg-gradient-to-t from-sky-100/40 via-blue-50/20 to-transparent blur-3xl opacity-60 rounded-full"></div>
    </div>

    <!-- 1. Header Navigation: Minimalist Clean White Glassmorphism -->
    <header class="sticky top-0 z-40 bg-white/85 backdrop-blur-md border-b border-slate-200/80 shadow-[0_1px_3px_rgba(0,0,0,0.02)]">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between gap-4">
            
            <!-- Logo -->
            <a href="{{ $feedUrl }}" class="flex items-center gap-2.5 group focus:outline-none">
                <div class="w-9 h-9 rounded-xl bg-blue-600 flex items-center justify-center font-black text-lg text-white shadow-md shadow-blue-500/25 group-hover:scale-105 transition-transform">
                    Z
                </div>
                <span class="text-xl font-extrabold tracking-tight text-slate-900">
                    Zengfy<span class="text-blue-600 font-black">.</span>
                    <span class="text-[11px] font-bold text-blue-700 bg-blue-50 border border-blue-200/70 px-2 py-0.5 rounded-full ml-1 uppercase tracking-wider">Social</span>
                </span>
            </a>

            <!-- Right Actions: Google 9-Dot Waffle + Central SSO Sign In -->
            <div class="flex items-center gap-3">
                <!-- 9-Dot Universal Ecosystem Launcher (Clean Light & Mobile Fixed Position) -->
                <div class="relative" x-data="{ launcherOpen: false }">
                    <button @click="launcherOpen = !launcherOpen" @click.outside="launcherOpen = false"
                        class="p-2.5 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-slate-100 border border-slate-200/90 transition-colors focus:outline-none"
                        title="Zengfy Apps">
                        <svg class="w-5 h-5 pointer-events-none" fill="currentColor" viewBox="0 0 24 24">
                            <circle cx="5" cy="5" r="2.2"/><circle cx="12" cy="5" r="2.2"/><circle cx="19" cy="5" r="2.2"/>
                            <circle cx="5" cy="12" r="2.2"/><circle cx="12" cy="12" r="2.2"/><circle cx="19" cy="12" r="2.2"/>
                            <circle cx="5" cy="19" r="2.2"/><circle cx="12" cy="19" r="2.2"/><circle cx="19" cy="19" r="2.2"/>
                        </svg>
                    </button>

                    <!-- Popover Dropdown Grid (Fixed on mobile to prevent clipping) -->
                    <div x-show="launcherOpen" x-cloak
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="fixed inset-x-4 top-20 sm:absolute sm:inset-auto sm:right-0 sm:top-full sm:mt-2.5 sm:w-80 bg-white border border-slate-200 rounded-2xl shadow-2xl p-4 z-50">
                        
                        <div class="flex items-center justify-between mb-3 px-1">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Zengfy Sovereign Suite</span>
                            <span class="text-[10px] font-semibold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-md">Universal SSO</span>
                        </div>

                        <div class="grid grid-cols-3 gap-2 text-center">
                            <a href="{{ $feedUrl }}" class="flex flex-col items-center p-2.5 rounded-xl bg-blue-50/70 border border-blue-200/80 text-blue-700 hover:scale-105 transition-all">
                                <span class="text-2xl mb-1">🌐</span><span class="text-xs font-bold">Social</span>
                            </a>
                            <a href="{{ $scheme }}://school.{{ $baseDomain }}{{ $portSuffix }}/" target="_blank" class="flex flex-col items-center p-2.5 rounded-xl bg-slate-50 hover:bg-slate-100 border border-slate-200/70 text-slate-700 hover:text-slate-900 hover:scale-105 transition-all">
                                <span class="text-2xl mb-1">🏫</span><span class="text-xs font-semibold">School</span>
                            </a>
                            <a href="{{ $scheme }}://pos.{{ $baseDomain }}{{ $portSuffix }}/" target="_blank" class="flex flex-col items-center p-2.5 rounded-xl bg-slate-50 hover:bg-slate-100 border border-slate-200/70 text-slate-700 hover:text-slate-900 hover:scale-105 transition-all">
                                <span class="text-2xl mb-1">🛒</span><span class="text-xs font-semibold">POS</span>
                            </a>
                            <a href="{{ $scheme }}://law.{{ $baseDomain }}{{ $portSuffix }}/" target="_blank" class="flex flex-col items-center p-2.5 rounded-xl bg-slate-50 hover:bg-slate-100 border border-slate-200/70 text-slate-700 hover:text-slate-900 hover:scale-105 transition-all">
                                <span class="text-2xl mb-1">⚖️</span><span class="text-xs font-semibold">Law</span>
                            </a>
                            <a href="{{ $scheme }}://hotel.{{ $baseDomain }}{{ $portSuffix }}/" target="_blank" class="flex flex-col items-center p-2.5 rounded-xl bg-slate-50 hover:bg-slate-100 border border-slate-200/70 text-slate-700 hover:text-slate-900 hover:scale-105 transition-all">
                                <span class="text-2xl mb-1">🏨</span><span class="text-xs font-semibold">Hotel</span>
                            </a>
                            <a href="{{ $scheme }}://{{ $baseDomain }}{{ $portSuffix }}/account" target="_blank" class="flex flex-col items-center p-2.5 rounded-xl bg-slate-50 hover:bg-slate-100 border border-slate-200/70 text-slate-700 hover:text-slate-900 hover:scale-105 transition-all">
                                <span class="text-2xl mb-1">🛡️</span><span class="text-xs font-semibold">Account</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Sign In Button linking through Central SSO -->
                <a href="{{ $ssoLoginUrl }}" class="px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-xs font-bold text-white shadow-sm shadow-blue-500/20 active:scale-95 transition-all flex items-center gap-1.5 focus:outline-none">
                    <span>Sign In</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </header>

    <!-- 2. Hero & Dynamic Teaser Section (Signal / Apple Clean Minimalist White Style) -->
    <main class="relative z-10 flex-grow max-w-4xl w-full mx-auto px-4 sm:px-6 py-12 sm:py-20 flex flex-col items-center text-center">
        
        <!-- Live Status Pill -->
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-blue-50 border border-blue-200/80 text-blue-700 text-xs font-semibold mb-6 shadow-sm">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            <span>Verified Citizen Network &bull; Zero Bots &bull; Hyperlocal Ward Feeds</span>
        </div>

        <!-- Hero Headline -->
        <h1 class="text-4xl sm:text-6xl font-black tracking-tight leading-[1.1] text-slate-900 max-w-2xl">
            Real People. <br />
            <span class="bg-gradient-to-r from-blue-600 via-indigo-600 to-sky-600 bg-clip-text text-transparent">Real Communities.</span> <br />
            Zero Noise.
        </h1>

        <p class="mt-4 text-base sm:text-lg text-slate-600 max-w-xl font-normal leading-relaxed">
            The next-generation public square for Bangladesh. Experience authentic neighborhood discussions, civic notices, and close friends timeline under one unified sovereign account.
        </p>

        <!-- Central SSO Primary CTA -->
        <div class="mt-8 flex flex-col sm:flex-row items-center gap-3 w-full max-w-sm">
            <a href="{{ $ssoLoginUrl }}"
                class="w-full py-3.5 px-6 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm shadow-lg shadow-blue-600/25 active:scale-95 transition-all flex items-center justify-center gap-2">
                <span>Continue with Zengfy Account</span>
                <span aria-hidden="true">&rarr;</span>
            </a>
            <a href="{{ $feedUrl }}"
                class="w-full sm:w-auto py-3.5 px-6 rounded-2xl bg-white hover:bg-slate-50 border border-slate-300 text-slate-700 hover:text-slate-900 font-semibold text-sm shadow-sm active:scale-95 transition-all flex items-center justify-center gap-1.5">
                <span>Explore Live Feed</span>
            </a>
        </div>

        <!-- 3. Interactive Live Feed Teaser (4 Dynamic Streams in Crisp White Cards) -->
        <div class="mt-14 w-full text-left" x-data="{
            activeTab: 'world',
            streams: {
                world: [
                    { name: 'Tanvir Ahmed', handle: 'tanvir', ward: 'Dhaka', verified: true, time: '10m ago', text: 'Exciting to see open, decentralized civic tech gaining traction across South Asia. Verification makes conversations meaningful again.', likes: 42, comments: 8 },
                    { name: 'Ayesha Siddiqua', handle: 'ayesha', ward: 'Chittagong', verified: true, time: '25m ago', text: 'Neighborhood clean energy initiative starting this weekend. Everyone is welcome to participate!', likes: 29, comments: 5 }
                ],
                friends: [
                    { name: 'Rahim Chowdhury', handle: 'rahim', ward: 'Dhaka', verified: true, time: '1h ago', text: 'Catching up with friends after long! Let us organize our weekend bike ride around the lake.', likes: 18, comments: 12 },
                    { name: 'Farhana Kabir', handle: 'farhana', ward: 'Sylhet', verified: true, time: '3h ago', text: 'Shared some new photography from our tea garden walk yesterday. Check it out!', likes: 35, comments: 4 }
                ],
                community: [
                    { name: 'Gulshan Civic Forum', handle: 'gulshan_forum', ward: 'Ward 19', badge: 'Civic Notice', verified: true, time: '45m ago', text: 'Tree plantation drive scheduled for Saturday morning along Road 11. Volunteers needed for sapling distribution.', likes: 88, comments: 19 },
                    { name: 'Dhanmondi Residents', handle: 'dhanmondi_rc', ward: 'Ward 15', badge: 'Community', verified: true, time: '2h ago', text: 'Lake perimeter security lights inspection completed successfully by ward representatives.', likes: 54, comments: 7 }
                ],
                nearby: [
                    { name: 'Ward-19 Citizen Help', handle: 'w19_help', ward: 'Ward 19 Gulshan', badge: 'Hyperlocal', verified: true, time: '15m ago', text: 'Traffic diversion near Gulshan-2 circle due to utility line maintenance until 4 PM. Please take alternate lanes.', likes: 63, comments: 14 },
                    { name: 'Mohammad Shumon', handle: 'shumon_w19', ward: 'Ward 19 Gulshan', verified: true, time: '50m ago', text: 'Lost pet cat found near Park 3. Wearing red collar. Please DM or reach out to security booth.', likes: 31, comments: 6 }
                ]
            }
        }">
            <!-- 4-Stream Tab Switcher Pills (Clean Gray Container with White Active Pills) -->
            <div class="flex items-center justify-center sm:justify-start gap-1 p-1 bg-slate-200/70 border border-slate-300/80 rounded-2xl w-full sm:w-fit mx-auto mb-5 overflow-x-auto no-scrollbar">
                <button type="button" @click="activeTab = 'world'"
                    :class="activeTab === 'world' ? 'bg-white text-slate-900 shadow-sm font-bold border border-slate-200/80' : 'text-slate-600 hover:text-slate-900 font-semibold'"
                    class="px-4 py-2 rounded-xl text-xs transition-all cursor-pointer whitespace-nowrap">
                    🌍 World's Happening
                </button>
                <button type="button" @click="activeTab = 'friends'"
                    :class="activeTab === 'friends' ? 'bg-white text-slate-900 shadow-sm font-bold border border-slate-200/80' : 'text-slate-600 hover:text-slate-900 font-semibold'"
                    class="px-4 py-2 rounded-xl text-xs transition-all cursor-pointer whitespace-nowrap">
                    👥 Friends
                </button>
                <button type="button" @click="activeTab = 'community'"
                    :class="activeTab === 'community' ? 'bg-white text-slate-900 shadow-sm font-bold border border-slate-200/80' : 'text-slate-600 hover:text-slate-900 font-semibold'"
                    class="px-4 py-2 rounded-xl text-xs transition-all cursor-pointer whitespace-nowrap">
                    🏛️ Community
                </button>
                <button type="button" @click="activeTab = 'nearby'"
                    :class="activeTab === 'nearby' ? 'bg-white text-slate-900 shadow-sm font-bold border border-slate-200/80' : 'text-slate-600 hover:text-slate-900 font-semibold'"
                    class="px-4 py-2 rounded-xl text-xs transition-all cursor-pointer whitespace-nowrap">
                    📍 Nearby
                </button>
            </div>

            <!-- Dynamic Teaser Cards Container (High-Contrast Clean White Cards) -->
            <div class="space-y-3.5">
                <template x-for="(item, idx) in streams[activeTab]" :key="idx">
                    <article class="bg-white border border-slate-200 hover:border-slate-300 rounded-2xl p-5 shadow-[0_2px_10px_rgba(0,0,0,0.03)] hover:shadow-[0_4px_16px_rgba(0,0,0,0.06)] transition-all">
                        <div class="flex items-start justify-between gap-3 mb-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center font-bold text-xs text-white shadow-sm">
                                    <span x-text="item.name.substring(0, 2).toUpperCase()"></span>
                                </div>
                                <div>
                                    <div class="flex items-center gap-1.5">
                                        <span class="text-sm font-bold text-slate-900" x-text="item.name"></span>
                                        <span class="w-3.5 h-3.5 rounded-full bg-blue-600 flex items-center justify-center text-[9px] text-white font-bold" title="Verified Citizen">✓</span>
                                    </div>
                                    <div class="text-xs text-slate-500">
                                        <span x-text="'@' + item.handle"></span> &bull; <span x-text="item.time"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <template x-if="item.badge">
                                    <span class="text-[11px] font-semibold px-2.5 py-0.5 rounded-full bg-amber-50 text-amber-700 border border-amber-200" x-text="item.badge"></span>
                                </template>
                                <span class="text-[11px] font-medium px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-600 border border-slate-200" x-text="item.ward"></span>
                            </div>
                        </div>
                        <p class="text-sm text-slate-700 leading-relaxed font-normal" x-text="item.text"></p>
                        <div class="flex items-center gap-5 mt-4 pt-3 border-t border-slate-100 text-xs text-slate-500">
                            <span class="flex items-center gap-1.5 font-medium hover:text-rose-600 transition-colors cursor-pointer">
                                <span class="text-rose-500">♥</span> <span x-text="item.likes"></span>
                            </span>
                            <span class="flex items-center gap-1.5 font-medium hover:text-blue-600 transition-colors cursor-pointer">
                                <span>💬</span> <span x-text="item.comments"></span>
                            </span>
                            <a :href="'{{ $ssoLoginUrl }}'" class="ml-auto text-xs font-bold text-blue-600 hover:text-blue-700 hover:underline">
                                Join Conversation &rarr;
                            </a>
                        </div>
                    </article>
                </template>
            </div>
        </div>

        <!-- 4. Three Clean Minimalist Value Pillars (Signal.org inspired) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-16 text-left w-full">
            <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-sm">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg mb-3">
                    🛡️
                </div>
                <h3 class="text-sm font-bold text-slate-900 mb-1">Zero Bots. Real Citizens.</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Verified citizen profiles guarantee that every interaction, vote, and discussion comes from an authentic resident.
                </p>
            </div>

            <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-sm">
                <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-lg mb-3">
                    📍
                </div>
                <h3 class="text-sm font-bold text-slate-900 mb-1">Hyperlocal Ward Pulse</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Instantly view news, notices, road diversions, and civic activities filtered directly to your ward or union.
                </p>
            </div>

            <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-sm">
                <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-lg mb-3">
                    🚨
                </div>
                <h3 class="text-sm font-bold text-slate-900 mb-1">Emergency SOS Hub</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Single-tap distress broadcasts alert verified neighbors and community responders during accidents or urgent needs.
                </p>
            </div>
        </div>

    </main>

    <!-- Footer: Clean Light Slate -->
    <footer class="relative z-10 border-t border-slate-200 bg-white py-8 text-center text-xs text-slate-500">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div>&copy; {{ date('Y') }} Zengfy Social. Sovereign Citizen Network for Bangladesh.</div>
            <div class="flex items-center gap-5 text-slate-600 font-medium">
                <a href="{{ $feedUrl }}" class="hover:text-slate-900 transition-colors">Live Feed</a>
                <a href="{{ $homeUrl }}terms" class="hover:text-slate-900 transition-colors">Privacy & Terms</a>
                <a href="{{ $homeUrl }}download" class="hover:text-slate-900 transition-colors">Android App</a>
            </div>
        </div>
    </footer>

</body>
</html>
