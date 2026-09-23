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
            <span>🇧🇩 বাংলাদেশ এর ডিজিটাল ইকোসিস্টেম • 100% NID-Verified</span>
        </div>

        <!-- Main Headline with Vibrant Gradient -->
        <h1
            class="text-3xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-8xl font-black tracking-tight leading-[1.1] max-w-5xl mx-auto text-white">
            One Unified Account. <br class="hidden sm:block" />
            <span class="bg-gradient-to-r from-blue-400 via-indigo-300 to-cyan-400 bg-clip-text text-transparent">
                Infinite Digital Ecosystem.
            </span>
        </h1>

        <!-- Subheadline -->
        <p class="mt-4 sm:mt-6 text-base sm:text-xl lg:text-2xl text-gray-300 max-w-3xl mx-auto font-normal leading-relaxed">
            Manage your school, retail POS, legal practice, and verified social community under one secure national identity.
            <span class="text-blue-400/90 font-medium text-sm sm:text-base mt-2 block">
                একটি একাউন্টেই স্কুল ম্যানেজমেন্ট, সুপারশপ ও খুচরা পিওএস, আইনি কেস ভল্ট এবং নিরাপদ সোশ্যাল নেটওয়ার্ক।
            </span>
        </p>

        <!-- CTAs Container -->
        <div class="mt-8 sm:mt-10 flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-6">
            <a href="/#cta" 
               class="w-full sm:w-auto px-8 py-3.5 sm:py-4 rounded-full bg-blue-600 hover:bg-blue-500 text-white font-bold text-sm sm:text-base shadow-xl shadow-blue-600/30 transition-all transform hover:scale-105 active:scale-95 flex items-center justify-center gap-2">
                <span>Sign Up Free / একাউন্ট খুলুন</span>
                <span>🚀</span>
            </a>

            <a href="#ecosystem" 
               class="w-full sm:w-auto px-8 py-3.5 sm:py-4 rounded-full bg-white/5 hover:bg-white/10 text-gray-200 border border-white/10 font-semibold text-sm sm:text-base backdrop-blur-md transition-all flex items-center justify-center gap-2">
                <span>Explore Ecosystem / সার্ভিসসমূহ</span>
                <span>↓</span>
            </a>
        </div>

        <!-- Interactive Floating Ecosystem Mockup Showcase (Google 9-Dot App Switcher Hub) -->
        <div
            class="mt-12 sm:mt-16 relative max-w-5xl mx-auto rounded-3xl p-1.5 sm:p-2 bg-gradient-to-b from-white/15 to-white/0 border border-white/10 shadow-2xl backdrop-blur-2xl max-w-full overflow-hidden">
            <div class="rounded-2xl bg-[#0F1623] p-4 sm:p-8 overflow-hidden border border-white/5 text-left">
                
                <!-- Top Window Controls & 9-Dot App Switcher Bar -->
                <div class="flex items-center justify-between pb-6 border-b border-white/10 flex-wrap gap-3">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-1.5">
                            <div class="w-3 h-3 rounded-full bg-red-500/80"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-500/80"></div>
                            <div class="w-3 h-3 rounded-full bg-green-500/80"></div>
                        </div>
                        <span class="text-xs font-mono text-gray-400">my.zengfy.top — Universal 9-Dot App Launcher</span>
                    </div>

                    <!-- 9-Dot App Switcher (Google Waffle Menu) Badge -->
                    <div class="flex items-center gap-2">
                        <div class="p-2 rounded-xl bg-blue-600/20 text-blue-400 border border-blue-500/30 flex items-center gap-2">
                            <!-- 9-Dot SVG Icon -->
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M6 10a2 2 0 110-4 2 2 0 010 4zm6 0a2 2 0 110-4 2 2 0 010 4zm6 0a2 2 0 110-4 2 2 0 010 4zM6 16a2 2 0 110-4 2 2 0 010 4zm6 0a2 2 0 110-4 2 2 0 010 4zm6 0a2 2 0 110-4 2 2 0 010 4z"/>
                            </svg>
                            <span class="text-xs font-bold font-mono">9-Dot App Switcher</span>
                        </div>
                        <div class="hidden sm:flex items-center gap-2 text-xs font-semibold bg-green-600/20 text-green-400 px-3 py-1.5 rounded-xl border border-green-500/30">
                            <span class="w-2 h-2 rounded-full bg-green-400"></span>
                            NID Verified
                        </div>
                    </div>
                </div>

                <!-- Live App Dashboard Grid (Google Workspace Style) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
                    
                    <!-- App 1: Social -->
                    <div class="p-5 rounded-xl bg-white/5 border border-white/10 hover:border-blue-500/40 transition-all">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-bold uppercase text-blue-400 tracking-wider flex items-center gap-1.5">
                                <span>🌐</span> Zengfy Social
                            </span>
                            <span class="text-[10px] bg-blue-500/20 text-blue-400 px-2 py-0.5 rounded-full font-bold">Free Forever</span>
                        </div>
                        <p class="text-base font-bold text-white">NID Verified Feed</p>
                        <p class="text-xs text-gray-300 mt-1">Real connections with 0 fake bots.</p>
                    </div>

                    <!-- App 2: School -->
                    <div class="p-5 rounded-xl bg-white/5 border border-white/10 hover:border-indigo-500/40 transition-all">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-bold uppercase text-indigo-400 tracking-wider flex items-center gap-1.5">
                                <span>🏫</span> Zengfy School
                            </span>
                            <span class="text-[10px] bg-green-500/20 text-green-400 px-2 py-0.5 rounded-full font-bold">৳3,000/mo</span>
                        </div>
                        <p class="text-base font-bold text-white">Dhaka Model Academy</p>
                        <p class="text-xs text-gray-300 mt-1">94% Attendance · 1,240 Students</p>
                    </div>

                    <!-- App 3: POS -->
                    <div class="p-5 rounded-xl bg-white/5 border border-white/10 hover:border-cyan-500/40 transition-all">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-bold uppercase text-cyan-400 tracking-wider flex items-center gap-1.5">
                                <span>🛒</span> Zengfy POS
                            </span>
                            <span class="text-[10px] bg-green-500/20 text-green-400 px-2 py-0.5 rounded-full font-bold">৳40k One-time</span>
                        </div>
                        <p class="text-base font-bold text-white">Zengfy Supermart</p>
                        <p class="text-xs text-gray-300 mt-1">৳42,850 Today · 18 bKash Billing</p>
                    </div>

                    <!-- App 4: Law -->
                    <div class="p-5 rounded-xl bg-white/5 border border-white/10 hover:border-amber-500/40 transition-all">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-bold uppercase text-amber-400 tracking-wider flex items-center gap-1.5">
                                <span>⚖️</span> Zengfy Law
                            </span>
                            <span class="text-[10px] bg-green-500/20 text-green-400 px-2 py-0.5 rounded-full font-bold">৳500/mo</span>
                        </div>
                        <p class="text-base font-bold text-white">Court Schedule Vault</p>
                        <p class="text-xs text-gray-300 mt-1">3 Hearings Scheduled Today</p>
                    </div>

                    <!-- App 5: Rent -->
                    <div class="p-5 rounded-xl bg-white/5 border border-white/10 hover:border-purple-500/40 transition-all">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-bold uppercase text-purple-400 tracking-wider flex items-center gap-1.5">
                                <span>🔑</span> Zengfy Rent
                            </span>
                            <span class="text-[10px] bg-green-500/20 text-green-400 px-2 py-0.5 rounded-full font-bold">৳30/search</span>
                        </div>
                        <p class="text-base font-bold text-white">Tenant Background</p>
                        <p class="text-xs text-gray-300 mt-1">NID Tenant Verification Verified</p>
                    </div>

                    <!-- App 6: Hotel -->
                    <div class="p-5 rounded-xl bg-white/5 border border-white/10 hover:border-emerald-500/40 transition-all">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-bold uppercase text-emerald-400 tracking-wider flex items-center gap-1.5">
                                <span>🏨</span> Zengfy Hotel
                            </span>
                            <span class="text-[10px] bg-green-500/20 text-green-400 px-2 py-0.5 rounded-full font-bold">৳1,200/mo</span>
                        </div>
                        <p class="text-base font-bold text-white">Grand Stay Suite</p>
                        <p class="text-xs text-gray-300 mt-1">12 Booked Rooms · Live Check-in</p>
                    </div>

                </div>

            </div>
        </div>

    </div>
</section>
