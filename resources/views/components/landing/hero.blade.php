<!-- resources/views/components/landing/hero.blade.php -->
<section class="relative w-full max-w-full min-h-[70vh] lg:min-h-[75vh] flex items-center justify-center pt-8 sm:pt-12 lg:pt-16 pb-12 sm:pb-16 lg:pb-20 overflow-hidden">
    <!-- Background Glow Multi-Layer Effects -->
    <div
        class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[320px] sm:w-[600px] h-[320px] sm:h-[600px] bg-blue-600/20 rounded-full blur-[100px] sm:blur-[140px] pointer-events-none">
    </div>
    <div
        class="absolute top-1/3 left-1/3 w-[250px] sm:w-[350px] h-[250px] sm:h-[350px] bg-indigo-600/15 rounded-full blur-[80px] sm:blur-[100px] pointer-events-none">
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10 text-center">
        <!-- Live Pill Badge -->
        <div
            class="inline-flex items-center gap-2 sm:gap-2.5 px-3 sm:px-4 py-1.5 sm:py-2 rounded-full bg-blue-950/60 border border-blue-500/30 text-blue-400 text-xs sm:text-sm font-semibold mb-6 sm:mb-8 backdrop-blur-md shadow-inner shadow-blue-500/10">
            <span class="relative flex h-2.5 w-2.5">
                <span
                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-blue-500"></span>
            </span>
            <span>NID-Verified Digital Ecosystem 🇧🇩</span>
        </div>

        <!-- Main Headline with Vibrant Gradient -->
        <h1
            class="text-3xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-8xl font-black tracking-tight leading-[1.1] max-w-5xl mx-auto text-white">
            The Operating System for <br class="hidden sm:block" />
            <span class="bg-gradient-to-r from-blue-400 via-indigo-300 to-cyan-400 bg-clip-text text-transparent">
                Modern Business & Life.
            </span>
        </h1>

        <!-- Subheadline -->
        <p class="mt-4 sm:mt-6 text-base sm:text-xl lg:text-2xl text-gray-300 max-w-3xl mx-auto font-normal leading-relaxed">
            Connect your school, legal practice, POS retail, and social community under one single, sovereign identity.
        </p>

        <!-- CTAs Container -->
        <div class="mt-8 sm:mt-10 flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-6">
            <a href="#ecosystem"                class="w-full sm:w-auto px-8 py-3.5 sm:py-4 rounded-full bg-blue-600 hover:bg-blue-500 text-white font-bold text-sm sm:text-base shadow-xl shadow-blue-600/30 transition-all transform hover:scale-105 active:scale-95">
                Explore All 10+ Apps
            </a>

            <a href="#sso"                class="w-full sm:w-auto px-8 py-4 rounded-full bg-white/5 hover:bg-white/10 text-gray-200 border border-white/10 font-semibold text-sm sm:text-base backdrop-blur-md transition-all">
                How SSO Works →
            </a>
        </div>

        <!-- Interactive Floating Ecosystem Mockup Showcase -->
        <div
            class="mt-12 sm:mt-16 relative max-w-5xl mx-auto rounded-3xl p-1.5 sm:p-2 bg-gradient-to-b from-white/15 to-white/0 border border-white/10 shadow-2xl backdrop-blur-2xl max-w-full overflow-hidden">
            <div class="rounded-2xl bg-[#0F1623] p-4 sm:p-8 overflow-hidden border border-white/5 text-left">
                <!-- Window Controls Top Bar -->
                <div class="flex items-center justify-between pb-6 border-b border-white/10">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-red-500/80"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-500/80"></div>
                        <div class="w-3 h-3 rounded-full bg-green-500/80"></div>
                        <span class="ml-4 text-xs font-mono text-gray-400">my.zengfy.top — App Launcher Hub</span>
                    </div>
                    <div
                        class="flex items-center gap-2 text-xs font-semibold bg-blue-600/20 text-blue-400 px-3 py-1 rounded-lg border border-blue-500/30">
                        <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                        NID Verified: Safayet Hossain
                    </div>
                </div>

                <!-- Simulated Live App Dashboard Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-6">
                    <!-- App Card 1: School -->
                    <div
                        class="p-5 rounded-xl bg-white/5 border border-white/10 hover:border-blue-500/40 transition-all">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-bold uppercase text-blue-400 tracking-wider">School ERP</span>
                            <span class="text-[10px] bg-green-500/20 text-green-400 px-2 py-0.5 rounded">Active</span>
                        </div>
                        <p class="text-lg font-bold text-white">Dhaka Academy</p>
                        <p class="text-xs text-gray-300 mt-1">94% Attendance Today · 1,240 Students</p>
                    </div>

                    <!-- App Card 2: POS -->
                    <div
                        class="p-5 rounded-xl bg-white/5 border border-white/10 hover:border-indigo-500/40 transition-all">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-bold uppercase text-indigo-400 tracking-wider">POS & Retail</span>
                            <span class="text-[10px] bg-green-500/20 text-green-400 px-2 py-0.5 rounded">Active</span>
                        </div>
                        <p class="text-lg font-bold text-white">Zengfy Mart</p>
                        <p class="text-xs text-gray-300 mt-1">৳42,850 Sales Today · 18 Orders</p>
                    </div>

                    <!-- App Card 3: Social -->
                    <div
                        class="p-5 rounded-xl bg-white/5 border border-white/10 hover:border-cyan-500/40 transition-all">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-bold uppercase text-cyan-400 tracking-wider">Social Network</span>
                            <span class="text-[10px] bg-blue-500/20 text-blue-400 px-2 py-0.5 rounded">Connected</span>
                        </div>
                        <p class="text-lg font-bold text-white">Community Feed</p>
                        <p class="text-xs text-gray-300 mt-1">5 New Network Notifications</p>
                    </div>

                </div>

            </div>
        </div>

    </div>
</section>
