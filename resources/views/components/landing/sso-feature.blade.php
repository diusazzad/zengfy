<!-- resources/views/components/landing/sso-feature.blade.php -->
<section id="sso" class="relative w-full max-w-full py-16 sm:py-24 bg-[#0E1420] border-t border-white/5 overflow-hidden">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">

            <!-- Left Side: Content & Features -->
            <div>
                <span
                    class="text-blue-400 font-extrabold tracking-widest uppercase text-xs bg-blue-500/10 border border-blue-500/20 px-4 py-1.5 rounded-full">
                    Sovereign Identity Layer
                </span>

                <h2 class="text-3xl sm:text-5xl font-black mt-6 text-white tracking-tight leading-tight">
                    One Login. <br />
                    <span class="bg-gradient-to-r from-blue-400 to-indigo-300 bg-clip-text text-transparent">
                        Every App at Your Finger-Tips.
                    </span>
                </h2>

                <p class="text-gray-300 text-base sm:text-lg mt-4 leading-relaxed font-normal">
                    No more managing dozens of passwords for different business software. With Zengfy Central SSO, your
                    NID-verified account grants instant, secure access across all subdomains.
                </p>

                <!-- Feature Bullets -->
                <div class="mt-8 space-y-4">
                    <div class="flex items-start gap-4">
                        <div
                            class="w-8 h-8 rounded-lg bg-blue-500/20 text-blue-400 flex items-center justify-center font-bold text-sm shrink-0 mt-1">
                            ✓</div>
                        <div>
                            <h3 class="text-white font-bold text-base">Universal 9-Dot App Launcher</h3>
                            <p class="text-gray-300 text-xs sm:text-sm mt-0.5">Switch from School ERP to POS or Legal
                                suite in 1-click without leaving your workflow.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div
                            class="w-8 h-8 rounded-lg bg-indigo-500/20 text-indigo-400 flex items-center justify-center font-bold text-sm shrink-0 mt-1">
                            ✓</div>
                        <div>
                            <h3 class="text-white font-bold text-base">Cross-Subdomain Session Sync</h3>
                            <p class="text-gray-300 text-xs sm:text-sm mt-0.5">Log in once at <code
                                    class="text-blue-300 font-mono">zengfy.top</code> and stay seamlessly authenticated
                                everywhere.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div
                            class="w-8 h-8 rounded-lg bg-cyan-500/20 text-cyan-400 flex items-center justify-center font-bold text-sm shrink-0 mt-1">
                            ✓</div>
                        <div>
                            <h3 class="text-white font-bold text-base">Centralized Audit & Security</h3>
                            <p class="text-gray-300 text-xs sm:text-sm mt-0.5">Monitor active devices, login history,
                                and manage permissions from one central hub.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Interactive App Launcher Visual Mockup -->
            <div class="relative">
                <div
                    class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-3xl blur-2xl opacity-20">
                </div>

                <div class="relative bg-[#0B0F17] rounded-3xl p-6 sm:p-8 border border-white/10 shadow-2xl">
                    <!-- Top App Bar Mock -->
                    <div class="flex items-center justify-between pb-6 border-b border-white/10">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-9 h-9 rounded-xl bg-blue-600 flex items-center justify-center text-white font-black text-sm">
                                Z</div>
                            <span class="text-white font-bold text-sm">Zengfy SSO Engine</span>
                        </div>

                        <!-- 9-Dot Icon Preview -->
                        <div
                            class="p-2 rounded-lg bg-blue-500/20 text-blue-400 border border-blue-500/30 flex items-center gap-1 cursor-pointer">
                            <span class="text-xs font-mono font-bold">App Switcher</span>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M6 10a2 2 0 110-4 2 2 0 010 4zm6 0a2 2 0 110-4 2 2 0 010 4zm6 0a2 2 0 110-4 2 2 0 010 4zM6 16a2 2 0 110-4 2 2 0 010 4zm6 0a2 2 0 110-4 2 2 0 010 4zm6 0a2 2 0 110-4 2 2 0 010 4z" />
                            </svg>
                        </div>
                    </div>

                    <!-- App Launcher Grid Mockup -->
                    <div class="grid grid-cols-2 gap-4 mt-6">
                        <div
                            class="p-4 rounded-xl bg-white/5 border border-white/10 hover:border-blue-500/50 transition-all flex items-center gap-3">
                            <span class="text-2xl">🏫</span>
                            <div>
                                <p class="text-sm font-bold text-white">School ERP</p>
                                <span class="text-[10px] text-blue-300">school.zengfy.test</span>
                            </div>
                        </div>

                        <div
                            class="p-4 rounded-xl bg-white/5 border border-white/10 hover:border-indigo-500/50 transition-all flex items-center gap-3">
                            <span class="text-2xl">🛒</span>
                            <div>
                                <p class="text-sm font-bold text-white">POS Retail</p>
                                <span class="text-[10px] text-indigo-300">pos.zengfy.test</span>
                            </div>
                        </div>

                        <div
                            class="p-4 rounded-xl bg-white/5 border border-white/10 hover:border-cyan-500/50 transition-all flex items-center gap-3">
                            <span class="text-2xl">⚖️</span>
                            <div>
                                <p class="text-sm font-bold text-white">Legal Suite</p>
                                <span class="text-[10px] text-cyan-300">law.zengfy.test</span>
                            </div>
                        </div>

                        <div
                            class="p-4 rounded-xl bg-white/5 border border-white/10 hover:border-emerald-500/50 transition-all flex items-center gap-3">
                            <span class="text-2xl">🌐</span>
                            <div>
                                <span class="text-[10px] text-emerald-400">social.zengfy.test</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 p-4 rounded-xl bg-blue-500/10 border border-blue-500/20 text-center">
                        <span class="text-xs font-semibold text-blue-300">
                            🔒 1-Click Authenticated via Sovereign Token
                        </span>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
