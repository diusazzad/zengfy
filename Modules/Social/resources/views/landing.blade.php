<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Zengfy Social | Sovereign Hyperlocal Network for Verified Bangladeshi Citizens</title>
    <meta name="description" content="Connect with verified neighbors, publish civic updates, trigger emergency SOS, and chat securely without bot manipulation. Bangladesh's premier NID-verified social platform.">

    <!-- OpenGraph / Social Metadata -->
    <meta property="og:title" content="Zengfy Social | Sovereign Hyperlocal Community">
    <meta property="og:description" content="Real citizens. Zero bots. Hyperlocal Ward feeds across Bangladesh.">
    <meta property="og:type" content="website">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">

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
                    colors: {
                        brand: {
                            dark: '#0B0F17',
                            card: '#121A29',
                            cardBorder: 'rgba(255, 255, 255, 0.08)',
                            primary: '#2563EB',
                            accent: '#06B6D4',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js for Interactive Showcase & API Auth Gateway -->
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
        ::-webkit-scrollbar-thumb:hover { background: #374151; }
    </style>
</head>

<body class="bg-[#0B0F17] text-gray-100 min-h-screen flex flex-col justify-between selection:bg-blue-600 selection:text-white antialiased relative overflow-x-hidden"
      x-data="socialLandingAuth()">

    <!-- Ambient Glowing Orbs -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0" aria-hidden="true">
        <div class="absolute -top-40 left-1/4 w-[650px] h-[550px] bg-gradient-to-b from-blue-600/15 via-indigo-600/10 to-transparent blur-3xl opacity-60"></div>
        <div class="absolute top-1/3 -right-40 w-[600px] h-[600px] bg-gradient-to-t from-cyan-500/15 via-blue-700/10 to-transparent blur-3xl opacity-50"></div>
        <div class="absolute -bottom-40 left-10 w-[500px] h-[500px] bg-gradient-to-tr from-emerald-500/10 via-indigo-700/10 to-transparent blur-3xl opacity-40"></div>
    </div>

    <!-- ========================================================================= -->
    <!-- 1. Header / Top Navigation Bar                                           -->
    <!-- ========================================================================= -->
    <header class="sticky top-0 z-40 bg-[#0E1524]/90 backdrop-blur-xl border-b border-white/[0.08]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-18 flex items-center justify-between gap-4">
            
            <!-- Logo & Brand Badge -->
            <div class="flex items-center gap-3">
                <a href="{{ $homeUrl ?? '/' }}" aria-label="Zengfy Ecosystem" class="flex items-center gap-2.5 group p-1.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-blue-600 via-indigo-600 to-cyan-400 flex items-center justify-center font-black text-lg text-white shadow-lg shadow-blue-500/25 group-hover:scale-105 transition-transform">
                        Z
                    </div>
                    <span class="text-xl font-extrabold tracking-tight text-white">
                        Zengfy<span class="text-blue-500 font-black">.</span><span class="text-xs text-cyan-400 font-bold ml-1 uppercase tracking-wider">Social</span>
                    </span>
                </a>
                <span class="text-[10px] px-2.5 py-0.5 rounded-full bg-cyan-500/10 border border-cyan-500/20 text-cyan-300 font-semibold hidden md:inline-flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-pulse"></span>
                    <span>Hyperlocal Civic Mesh</span>
                </span>
            </div>

            <!-- Center Navigation Links -->
            <nav class="hidden lg:flex items-center gap-6 text-xs sm:text-sm font-semibold text-gray-300">
                <a href="#features" class="hover:text-white hover:text-cyan-300 transition-colors">Features</a>
                <a href="#hyperlocal" class="hover:text-white hover:text-cyan-300 transition-colors">Ward Pulse</a>
                <a href="#security" class="hover:text-white hover:text-cyan-300 transition-colors">Anti-Bot Shield</a>
                <a href="#preview" class="hover:text-white hover:text-cyan-300 transition-colors">Live Preview</a>
                <a href="{{ $feedUrl }}" class="text-cyan-400 hover:text-cyan-300 flex items-center gap-1 transition-colors">
                    <span>Explore Feed</span>
                    <span class="text-[10px]">↗</span>
                </a>
            </nav>

            <!-- Right: Action CTA Buttons -->
            <div class="flex items-center gap-2.5 sm:gap-3">
                @auth
                    <!-- If user is logged in, offer 1-click jump into Feed & Account -->
                    <a href="{{ $feedUrl }}" 
                       class="px-4 py-2 min-h-[40px] rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white font-bold text-xs sm:text-sm shadow-lg shadow-blue-600/30 transition-all flex items-center gap-2">
                        <span>Open My Feed</span>
                        <span>→</span>
                    </a>
                    <a href="{{ $accountUrl }}" 
                       title="Sovereign Account Hub"
                       class="p-2 min-h-[40px] rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 text-gray-300 hover:text-white transition">
                        👤
                    </a>
                @else
                    <!-- If guest, provide Google-style Central SSO triggers -->
                    <a href="{{ $loginUrl }}?continue={{ urlencode($feedUrl) }}"
                       class="px-4 py-2 min-h-[40px] rounded-xl bg-white/[0.05] hover:bg-white/[0.1] border border-white/10 text-white font-semibold text-xs sm:text-sm transition-all flex items-center justify-center">
                        Sign In / লগইন
                    </a>
                    <a href="{{ $registerUrl }}?continue={{ urlencode($feedUrl) }}"
                       class="px-4.5 py-2 min-h-[40px] rounded-xl bg-gradient-to-r from-blue-600 via-indigo-600 to-cyan-500 hover:from-blue-500 hover:via-indigo-500 hover:to-cyan-400 text-white font-bold text-xs sm:text-sm shadow-lg shadow-blue-600/30 transition-all flex items-center justify-center gap-1.5">
                        <span>Get Citizen ID</span>
                        <span class="hidden sm:inline">🇧🇩</span>
                    </a>
                @endauth
            </div>

        </div>
    </header>

    <!-- ========================================================================= -->
    <!-- 2. Hero Section (Benchmarked vs X, Threads, Discord & Bluesky)            -->
    <!-- ========================================================================= -->
    <section class="relative z-10 pt-16 pb-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto text-center">
        
        <!-- Sovereign Tag Pill -->
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-gradient-to-r from-blue-600/15 via-cyan-500/15 to-indigo-600/15 border border-cyan-500/30 text-cyan-300 text-xs font-bold mb-6 shadow-md shadow-cyan-500/10">
            <span class="flex h-2 w-2 relative">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-cyan-500"></span>
            </span>
            <span>🇧🇩 Bangladesh's Sovereign NID-Verified Social Network</span>
        </div>

        <!-- Hero Headline -->
        <h1 class="text-3xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold tracking-tight text-white max-w-5xl mx-auto leading-[1.12]">
            Where Real Citizens Connect <br class="hidden sm:inline" />
            <span class="bg-gradient-to-r from-blue-400 via-cyan-300 to-indigo-400 bg-clip-text text-transparent">
                Without Bots, Trolls, or Surveillance.
            </span>
        </h1>

        <!-- Subheading in English & Bengali -->
        <p class="mt-6 text-sm sm:text-base md:text-lg text-gray-400 max-w-3xl mx-auto leading-relaxed">
            বাংলাদেশের নাগরিকদের জন্য প্রথম স্মার্ট এনআইডি ভেরিফাইড সামাজিক প্ল্যাটফর্ম। আপনার ওয়ার্ডের প্রতিবেশী, জরুরি সিভিক নোটিশ এবং এন্ড-টু-এন্ড এনক্রিপ্টেড যোগাযোগের জন্য একটি নিরাপদ সোভারেন ডিজিটাল নেটওয়ার্ক।
        </p>

        <!-- Main Conversion Action Buttons -->
        <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
            <a href="{{ $loginUrl }}?continue={{ urlencode($feedUrl) }}"
               class="px-7 py-3.5 min-h-[48px] rounded-2xl bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white font-extrabold text-sm sm:text-base shadow-xl shadow-blue-500/30 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2.5">
                <span>🚀 Join Sovereign Network / প্রবেশ করুন</span>
            </a>
            <a href="{{ $feedUrl }}" 
               class="px-6 py-3.5 min-h-[48px] rounded-2xl bg-white/[0.05] hover:bg-white/[0.1] border border-white/10 hover:border-white/20 text-white font-bold text-sm sm:text-base transition-all flex items-center gap-2">
                <span>🌐 Preview Public Feed</span>
                <span class="text-xs text-cyan-400 font-mono">Live</span>
            </a>
        </div>

        <!-- Trust Badges Strip -->
        <div class="mt-10 pt-8 border-t border-white/[0.08] max-w-4xl mx-auto grid grid-cols-2 sm:grid-cols-4 gap-4 text-xs font-semibold text-gray-400">
            <div class="flex items-center justify-center gap-2">
                <span class="text-cyan-400">🛡️</span>
                <span>Smart NID Verified</span>
            </div>
            <div class="flex items-center justify-center gap-2">
                <span class="text-emerald-400">🤖</span>
                <span>Zero Bot Tolerance</span>
            </div>
            <div class="flex items-center justify-center gap-2">
                <span class="text-blue-400">🔒</span>
                <span>P2P Encrypted Chat</span>
            </div>
            <div class="flex items-center justify-center gap-2">
                <span class="text-amber-400">📍</span>
                <span>Hyperlocal Ward Pulse</span>
            </div>
        </div>

    </section>

    <!-- ========================================================================= -->
    <!-- 3. Interactive Live Showcase & Mockup (Like Google Docs Product Showcase) -->
    <!-- ========================================================================= -->
    <section id="preview" class="relative z-10 py-12 px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto">
        <div class="relative rounded-3xl bg-gradient-to-b from-[#141E33] via-[#0E1626] to-[#0A101C] border border-white/15 p-6 sm:p-10 shadow-2xl overflow-hidden backdrop-blur-2xl">
            <!-- Glowing top edge -->
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-600 via-cyan-400 to-indigo-600"></div>

            <div class="flex flex-col lg:flex-row items-center justify-between gap-8 mb-8 pb-6 border-b border-white/10">
                <div>
                    <span class="text-xs font-bold text-cyan-400 uppercase tracking-widest">Live Experience Mockup</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white mt-1">Real-time Hyperlocal Feed Preview</h2>
                    <p class="text-xs sm:text-sm text-gray-400 mt-1">Experience how verified neighbors post civic alerts and interact without algorithm distortion.</p>
                </div>
                
                <!-- Ward Switcher Tabs in Showcase -->
                <div class="flex items-center gap-2 p-1.5 rounded-2xl bg-[#0B0F17] border border-white/10 text-xs font-bold">
                    <button class="px-3.5 py-1.5 rounded-xl bg-blue-600 text-white shadow-md">Ward 19 (Gulshan)</button>
                    <button class="px-3.5 py-1.5 rounded-xl text-gray-400 hover:text-white">Ward 20 (Banani)</button>
                    <button class="px-3.5 py-1.5 rounded-xl text-gray-400 hover:text-white">Civic SOS</button>
                </div>
            </div>

            <!-- Feed Post Mockup Card -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
                
                <!-- Left: Citizen Post Card -->
                <div class="md:col-span-2 rounded-2xl bg-[#121A29]/90 border border-white/10 p-5 sm:p-6 shadow-xl space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-blue-600 via-indigo-600 to-cyan-400 flex items-center justify-center font-black text-white text-base shadow-md">
                                SA
                            </div>
                            <div>
                                <div class="flex items-center gap-1.5">
                                    <span class="font-extrabold text-sm text-white">Sazzad Hossain</span>
                                    <span class="inline-flex items-center gap-0.5 px-2 py-0.5 rounded-full bg-cyan-500/10 border border-cyan-500/30 text-cyan-300 text-[10px] font-bold">
                                        <span>✓</span>
                                        <span>Verified Citizen</span>
                                    </span>
                                </div>
                                <p class="text-xs text-gray-400 font-mono">@sazzad • 📍 Ward 19 (Gulshan)</p>
                            </div>
                        </div>
                        <span class="text-[10px] px-2.5 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-300 font-bold">
                            Civic Update
                        </span>
                    </div>

                    <p class="text-xs sm:text-sm text-gray-200 leading-relaxed">
                        Gulshan Avenue Road 11 drainage maintenance completed today by DNCC volunteers. Streetlights are fully operational. Please drive carefully near the circle. 🚗✨
                    </p>

                    <!-- Interactive Mock Actions -->
                    <div class="pt-3 border-t border-white/5 flex items-center justify-between text-xs text-gray-400">
                        <div class="flex items-center gap-4">
                            <span class="flex items-center gap-1.5 text-rose-400 font-bold">
                                <span>❤️</span> 48 Verified Likes
                            </span>
                            <span class="flex items-center gap-1.5 text-blue-400 font-semibold">
                                <span>💬</span> 14 Comments
                            </span>
                        </div>
                        <a href="{{ $loginUrl }}?continue={{ urlencode($feedUrl) }}" class="text-[11px] text-cyan-400 hover:text-cyan-300 font-semibold transition-colors">
                            Sign in to join discussion →
                        </a>
                    </div>
                </div>

                <!-- Right: Ward Pulse & Emergency SOS Beacon Widget -->
                <div class="space-y-4">
                    <div class="p-5 rounded-2xl bg-gradient-to-br from-rose-500/10 via-[#121A29] to-[#121A29] border border-rose-500/25 space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-wider text-rose-400 flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-rose-500 animate-ping"></span>
                                <span>Emergency SOS Beacon</span>
                            </span>
                            <span class="text-[10px] px-2 py-0.5 rounded-full bg-rose-500/20 text-rose-300 font-bold">P1 Priority</span>
                        </div>
                        <p class="text-xs text-gray-300 leading-relaxed">
                            1-Tap distress signal broadcasts your encrypted GPS coordinates directly to trusted neighbors & emergency services.
                        </p>
                        <a href="{{ $loginUrl }}?continue={{ urlencode($feedUrl) }}" class="w-full py-2 px-3 rounded-xl bg-rose-600/80 hover:bg-rose-500 text-white font-bold text-xs transition text-center block">
                            Explore SOS Safety Features
                        </a>
                    </div>

                    <div class="p-4 rounded-2xl bg-[#0E1626] border border-white/10 text-xs space-y-2">
                        <div class="flex justify-between text-gray-400">
                            <span>Active Verified Citizens</span>
                            <span class="text-white font-bold font-mono">{{ number_format($displayCitizenCount) }}+</span>
                        </div>
                        <div class="flex justify-between text-gray-400">
                            <span>Connected Wards</span>
                            <span class="text-cyan-400 font-bold font-mono">4,554 Wards</span>
                        </div>
                        <div class="flex justify-between text-gray-400">
                            <span>Civic Safety Index</span>
                            <span class="text-emerald-400 font-bold font-mono">{{ $safetyIndex }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 4. Core Pillars Bento Grid                                                -->
    <!-- ========================================================================= -->
    <section id="features" class="relative z-10 py-16 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-xs font-bold text-cyan-400 uppercase tracking-widest">Sovereign Architecture</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mt-2">Engineered for Citizen Dignity</h2>
            <p class="text-sm text-gray-400 mt-2">Built from the ground up for authentic human trust, civic democracy, and local neighborhood solidarity.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Bento 1: Smart NID Anti-Bot Shield -->
            <div class="p-6 rounded-3xl bg-[#121A29] border border-white/10 hover:border-white/20 transition-all flex flex-col justify-between group">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition-transform">
                        🛡️
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Smart NID Verified</h3>
                    <p class="text-xs text-gray-400 leading-relaxed">
                        Every citizen profile is anchored to authentic Smart NID verification with 256-bit AES encryption. No troll armies, no fake political bots.
                    </p>
                </div>
                <div class="mt-6 pt-3 border-t border-white/5 text-[11px] text-cyan-400 font-semibold">
                    1 Citizen = 1 Voice
                </div>
            </div>

            <!-- Bento 2: Hyperlocal Ward Pulse -->
            <div class="p-6 rounded-3xl bg-[#121A29] border border-white/10 hover:border-white/20 transition-all flex flex-col justify-between group">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition-transform">
                        📍
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Hyperlocal Wards</h3>
                    <p class="text-xs text-gray-400 leading-relaxed">
                        Switch seamlessly between your local ward (e.g. Ward-19 Gulshan), thana, and all-city public feeds. Connect with real people on your actual street.
                    </p>
                </div>
                <div class="mt-6 pt-3 border-t border-white/5 text-[11px] text-cyan-400 font-semibold">
                    64 Districts • 4,554 Wards
                </div>
            </div>

            <!-- Bento 3: P2P Encrypted Messenger -->
            <div class="p-6 rounded-3xl bg-[#121A29] border border-white/10 hover:border-white/20 transition-all flex flex-col justify-between group">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition-transform">
                        💬
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Encrypted Live Chat</h3>
                    <p class="text-xs text-gray-400 leading-relaxed">
                        Direct messaging and neighborhood mesh chat powered by Laravel Reverb WebSockets. Zero third-party ad tracking or metadata harvesting.
                    </p>
                </div>
                <div class="mt-6 pt-3 border-t border-white/5 text-[11px] text-cyan-400 font-semibold">
                    Live WebSocket Mesh
                </div>
            </div>

            <!-- Bento 4: Zero Algorithm Exploitation -->
            <div class="p-6 rounded-3xl bg-[#121A29] border border-white/10 hover:border-white/20 transition-all flex flex-col justify-between group">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition-transform">
                        ⚖️
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Honest Chronology</h3>
                    <p class="text-xs text-gray-400 leading-relaxed">
                        Say goodbye to rage-bait algorithms. Zengfy Social serves clean, chronological feeds with zero corporate manipulation of your feed.
                    </p>
                </div>
                <div class="mt-6 pt-3 border-t border-white/5 text-[11px] text-cyan-400 font-semibold">
                    Chronological Timeline
                </div>
            </div>

        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 5. Direct Call-to-Action Banner                                          -->
    <!-- ========================================================================= -->
    <section class="relative z-10 py-16 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <div class="rounded-3xl bg-gradient-to-r from-blue-600 via-indigo-600 to-cyan-600 p-8 sm:p-12 text-center text-white shadow-2xl relative overflow-hidden">
            <div class="absolute -top-24 -left-24 w-60 h-60 bg-white/20 rounded-full blur-2xl pointer-events-none"></div>
            
            <h2 class="text-2xl sm:text-4xl font-black mb-3">Ready to Experience True Citizen Sovereignty?</h2>
            <p class="text-xs sm:text-sm text-blue-100 max-w-2xl mx-auto mb-6 leading-relaxed">
                Join thousands of verified Bangladeshi citizens already discussing local community updates, business, and safety without toxic bots.
            </p>

            <div class="flex flex-wrap items-center justify-center gap-3">
                <a href="{{ $registerUrl }}?continue={{ urlencode($feedUrl) }}"
                   class="px-8 py-3.5 rounded-2xl bg-white text-blue-900 font-black text-sm shadow-xl hover:bg-gray-100 hover:scale-105 active:scale-95 transition-all flex items-center justify-center">
                    Create Free Citizen Account
                </a>
                <a href="{{ $loginUrl }}?continue={{ urlencode($feedUrl) }}"
                   class="px-7 py-3.5 rounded-2xl bg-black/30 hover:bg-black/40 text-white font-bold text-sm border border-white/20 transition-all flex items-center justify-center">
                    Sign In with Existing ID
                </a>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- 6. Footer                                                                -->
    <!-- ========================================================================= -->
    <footer class="relative z-10 border-t border-white/[0.08] bg-[#0E1524] py-8 text-xs text-gray-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 rounded-lg bg-gradient-to-tr from-blue-600 to-cyan-400 flex items-center justify-center font-bold text-white text-xs">
                    Z
                </div>
                <p>© {{ date('Y') }} Zengfy Social. Bangladesh's Premier Sovereign Community Network.</p>
            </div>
            <div class="flex items-center gap-4 text-gray-400">
                <a href="{{ $homeUrl }}" class="hover:text-white transition">Zengfy Core</a>
                <a href="{{ $accountUrl }}" class="hover:text-white transition">Account Hub</a>
                <a href="{{ $downloadUrl }}" class="hover:text-white transition">Android APK</a>
                <a href="{{ $feedUrl }}" class="text-cyan-400 hover:text-cyan-300 font-semibold">Social Feed</a>
            </div>
        </div>
    </footer>

    <!-- ========================================================================= -->
    <!-- 7. Embedded API-Driven Auth Modal (Sign In & Register)                   -->
    <!-- Communicates directly via /api/v1/auth/login and /api/v1/auth/register    -->
    <!-- ========================================================================= -->
    <div x-show="authModalOpen" 
         x-cloak
         @keydown.escape.window="authModalOpen = false"
         class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4">
        
        <!-- Backdrop Blur -->
        <div class="fixed inset-0 bg-black/80 backdrop-blur-md transition-opacity" 
             @click="authModalOpen = false"></div>

        <!-- Modal Dialog Surface -->
        <div class="relative w-full max-w-md bg-[#121A29] border border-white/15 rounded-3xl shadow-2xl p-6 sm:p-8 z-10 overflow-hidden animate-in fade-in zoom-in-95 duration-200">
            <!-- Glowing top line -->
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-600 via-cyan-400 to-indigo-600"></div>

            <!-- Close button -->
            <button @click="authModalOpen = false" 
                    class="absolute top-5 right-5 text-gray-400 hover:text-white p-1 rounded-lg hover:bg-white/10 transition cursor-pointer">
                ✕
            </button>

            <!-- Modal Header -->
            <div class="text-center mb-6">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-blue-600 via-indigo-600 to-cyan-400 flex items-center justify-center font-black text-xl text-white mx-auto shadow-lg shadow-blue-500/30 mb-3">
                    Z
                </div>
                <h3 class="text-xl font-extrabold text-white" x-text="authMode === 'login' ? 'Sign In to Zengfy Social' : 'Register Sovereign Citizen ID'"></h3>
                <p class="text-xs text-gray-400 mt-1" x-text="authMode === 'login' ? 'Access your verified hyperlocal feeds & live chats.' : 'Create your authenticated profile for your ward.'"></p>
            </div>

            <!-- Mode Switcher Tabs -->
            <div class="flex p-1 bg-[#0B0F17] rounded-xl border border-white/10 mb-5 text-xs font-semibold">
                <button type="button" 
                        @click="switchMode('login')"
                        :class="authMode === 'login' ? 'bg-blue-600 text-white shadow' : 'text-gray-400 hover:text-white'"
                        class="flex-1 py-2 rounded-lg transition text-center cursor-pointer">
                    Sign In / লগইন
                </button>
                <button type="button" 
                        @click="switchMode('register')"
                        :class="authMode === 'register' ? 'bg-blue-600 text-white shadow' : 'text-gray-400 hover:text-white'"
                        class="flex-1 py-2 rounded-lg transition text-center cursor-pointer">
                    Register / রেজিস্ট্রেশন
                </button>
            </div>

            <!-- Alert Box (Success or Error) -->
            <div x-show="errorMessage" x-cloak class="mb-4 p-3 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-300 text-xs">
                <p x-text="errorMessage"></p>
            </div>
            <div x-show="successMessage" x-cloak class="mb-4 p-3 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 text-xs flex items-center gap-2">
                <span class="text-base">✓</span>
                <span x-text="successMessage"></span>
            </div>

            <!-- LOGIN FORM (API: POST /api/v1/auth/login) -->
            <form x-show="authMode === 'login'" @submit.prevent="submitLogin()" class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-300 mb-1">Email or Sovereign ID</label>
                    <input type="email" 
                           x-model="loginForm.email" 
                           required 
                           placeholder="citizen@zengfy.test"
                           class="w-full px-3.5 py-2.5 bg-[#0B0F17] border border-white/10 focus:border-blue-500 rounded-xl text-white text-xs sm:text-sm focus:outline-none transition">
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label class="block text-xs font-semibold text-gray-300">Password</label>
                        <a href="{{ $loginUrl }}" class="text-[11px] text-cyan-400 hover:underline">Forgot password?</a>
                    </div>
                    <input type="password" 
                           x-model="loginForm.password" 
                           required 
                           placeholder="••••••••••••"
                           class="w-full px-3.5 py-2.5 bg-[#0B0F17] border border-white/10 focus:border-blue-500 rounded-xl text-white text-xs sm:text-sm focus:outline-none transition">
                </div>

                <div class="flex items-center gap-2 text-xs text-gray-400">
                    <input type="checkbox" id="remember" x-model="loginForm.remember" class="rounded bg-[#0B0F17] border-white/20 text-blue-600 focus:ring-0">
                    <label for="remember">Keep me signed in on this device</label>
                </div>

                <button type="submit" 
                        :disabled="isSubmitting"
                        class="w-full py-3 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white font-bold text-xs sm:text-sm shadow-lg shadow-blue-500/30 transition-all flex items-center justify-center gap-2 cursor-pointer disabled:opacity-50">
                    <span x-show="isSubmitting" class="animate-spin text-base">◌</span>
                    <span x-text="isSubmitting ? 'Authenticating...' : 'Sign In via Sovereign API'"></span>
                </button>
            </form>

            <!-- REGISTER FORM (API: POST /api/v1/auth/register) -->
            <form x-show="authMode === 'register'" @submit.prevent="submitRegister()" class="space-y-3.5">
                <div>
                    <label class="block text-xs font-semibold text-gray-300 mb-1">Full Legal Name</label>
                    <input type="text" 
                           x-model="registerForm.name" 
                           required 
                           placeholder="e.g. Sazzad Hossain"
                           class="w-full px-3.5 py-2.5 bg-[#0B0F17] border border-white/10 focus:border-blue-500 rounded-xl text-white text-xs sm:text-sm focus:outline-none transition">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-300 mb-1">Email Address</label>
                    <input type="email" 
                           x-model="registerForm.email" 
                           required 
                           placeholder="sazzad@example.com"
                           class="w-full px-3.5 py-2.5 bg-[#0B0F17] border border-white/10 focus:border-blue-500 rounded-xl text-white text-xs sm:text-sm focus:outline-none transition">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-gray-300 mb-1">Password</label>
                        <input type="password" 
                               x-model="registerForm.password" 
                               required 
                               minlength="8"
                               placeholder="••••••••"
                               class="w-full px-3.5 py-2.5 bg-[#0B0F17] border border-white/10 focus:border-blue-500 rounded-xl text-white text-xs sm:text-sm focus:outline-none transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-300 mb-1">Confirm Password</label>
                        <input type="password" 
                               x-model="registerForm.password_confirmation" 
                               required 
                               minlength="8"
                               placeholder="••••••••"
                               class="w-full px-3.5 py-2.5 bg-[#0B0F17] border border-white/10 focus:border-blue-500 rounded-xl text-white text-xs sm:text-sm focus:outline-none transition">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-300 mb-1">Ward Code (Dhaka / Division)</label>
                    <input type="text" 
                           x-model="registerForm.ward_code" 
                           placeholder="WARD-DHAKA-19 (Gulshan)"
                           class="w-full px-3.5 py-2.5 bg-[#0B0F17] border border-white/10 focus:border-blue-500 rounded-xl text-white text-xs sm:text-sm focus:outline-none transition">
                </div>

                <button type="submit" 
                        :disabled="isSubmitting"
                        class="w-full py-3 rounded-xl bg-gradient-to-r from-blue-600 via-indigo-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white font-bold text-xs sm:text-sm shadow-lg shadow-blue-500/30 transition-all flex items-center justify-center gap-2 cursor-pointer disabled:opacity-50">
                    <span x-show="isSubmitting" class="animate-spin text-base">◌</span>
                    <span x-text="isSubmitting ? 'Creating ID...' : 'Register Citizen Account'"></span>
                </button>
            </form>

            <!-- Bottom Single Sign-On Info -->
            <p class="text-[10px] text-gray-500 text-center mt-4">
                Unified SSO credentials valid across all 15 Zengfy Ecosystem modules.
            </p>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- 8. Alpine.js Controller for API Auth & Navigation                        -->
    <!-- ========================================================================= -->
    <script>
        function socialLandingAuth() {
            return {
                authModalOpen: false,
                authMode: 'login', // 'login' or 'register'
                isSubmitting: false,
                errorMessage: '',
                successMessage: '',
                feedTargetUrl: '{{ $feedUrl }}',

                loginForm: {
                    email: '',
                    password: '',
                    remember: true
                },

                registerForm: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    ward_code: 'WARD-DHAKA-19'
                },

                openAuthModal(mode = 'login') {
                    this.authMode = mode;
                    this.errorMessage = '';
                    this.successMessage = '';
                    this.authModalOpen = true;
                },

                switchMode(mode) {
                    this.authMode = mode;
                    this.errorMessage = '';
                    this.successMessage = '';
                },

                async submitLogin() {
                    this.isSubmitting = true;
                    this.errorMessage = '';
                    this.successMessage = '';

                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                    try {
                        const response = await fetch('/api/v1/auth/login', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': csrfToken || ''
                            },
                            credentials: 'same-origin',
                            body: JSON.stringify(this.loginForm)
                        });

                        const data = await response.json();

                        if (response.ok && data.success) {
                            if (data.token) {
                                localStorage.setItem('zengfy_token', data.token);
                            }
                            this.successMessage = 'Login successful! Entering sovereign feed...';
                            setTimeout(() => {
                                window.location.href = this.feedTargetUrl;
                            }, 600);
                        } else {
                            this.errorMessage = data.message || 'Invalid credentials. Please verify your email and password.';
                        }
                    } catch (err) {
                        this.errorMessage = 'Network connection error. Please try again.';
                    } finally {
                        this.isSubmitting = false;
                    }
                },

                async submitRegister() {
                    if (this.registerForm.password !== this.registerForm.password_confirmation) {
                        this.errorMessage = 'Passwords do not match.';
                        return;
                    }

                    this.isSubmitting = true;
                    this.errorMessage = '';
                    this.successMessage = '';

                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                    try {
                        const response = await fetch('/api/v1/auth/register', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': csrfToken || ''
                            },
                            credentials: 'same-origin',
                            body: JSON.stringify(this.registerForm)
                        });

                        const data = await response.json();

                        if (response.ok && data.success) {
                            if (data.token) {
                                localStorage.setItem('zengfy_token', data.token);
                            }
                            this.successMessage = 'Account created successfully! Welcome to Zengfy Social.';
                            setTimeout(() => {
                                window.location.href = this.feedTargetUrl;
                            }, 700);
                        } else {
                            if (data.errors) {
                                const firstError = Object.values(data.errors)[0];
                                this.errorMessage = Array.isArray(firstError) ? firstError[0] : firstError;
                            } else {
                                this.errorMessage = data.message || 'Registration failed. Please check inputs.';
                            }
                        }
                    } catch (err) {
                        this.errorMessage = 'Network connection error during registration.';
                    } finally {
                        this.isSubmitting = false;
                    }
                }
            };
        }
    </script>
</body>
</html>
