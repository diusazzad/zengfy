<!-- resources/views/components/landing/cta.blade.php -->
<section id="cta" class="relative py-16 sm:py-24 bg-[#0B0F17] overflow-hidden">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">

        <div
            class="relative rounded-3xl p-6 sm:p-12 lg:p-16 bg-gradient-to-r from-blue-950/80 via-indigo-950/60 to-purple-950/80 border border-blue-500/30 shadow-2xl backdrop-blur-2xl overflow-hidden text-center max-w-full">

            <!-- Ambient Lighting Effects -->
            <div
                class="absolute -top-24 -left-24 w-48 sm:w-72 h-48 sm:h-72 bg-blue-500/20 rounded-full blur-[100px] pointer-events-none">
            </div>
            <div
                class="absolute -bottom-24 -right-24 w-48 sm:w-72 h-48 sm:h-72 bg-indigo-500/20 rounded-full blur-[100px] pointer-events-none">
            </div>

            <div class="relative z-10 max-w-3xl mx-auto">
                <span
                    class="text-blue-400 font-extrabold tracking-widest uppercase text-xs bg-blue-500/10 border border-blue-500/20 px-4 py-1.5 rounded-full">
                    Sovereign Infrastructure for Bangladesh
                </span>

                <h2 class="text-3xl sm:text-5xl font-black mt-6 text-white tracking-tight leading-tight">
                    Ready to Build Your <br />
                    <span
                        class="bg-gradient-to-r from-blue-400 via-indigo-300 to-cyan-400 bg-clip-text text-transparent">
                        Digital Ecosystem Today?
                    </span>
                </h2>

                <p class="mt-4 text-gray-300 text-base sm:text-xl font-normal leading-relaxed">
                    Create your NID-verified account and manage your school, retail POS, legal practice, and social
                    network from a single, secure identity.
                </p>

                <!-- Action Buttons -->
                <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-6">
                    <a href="{{ env('APP_ENV') === 'local' ? 'http://zengfy.test:7000/register' : 'https://zengfy.top/register' }}"
                        class="w-full sm:w-auto px-8 py-4 rounded-full bg-blue-600 hover:bg-blue-500 text-white font-bold text-base shadow-xl shadow-blue-600/30 transition-all transform hover:scale-105 active:scale-95 flex items-center justify-center gap-2">
                        <span>Sign Up / Create Free Account</span>
                        <span>🚀</span>
                    </a>

                    <a href="#ecosystem"
                        class="w-full sm:w-auto px-8 py-4 rounded-full bg-white/5 hover:bg-white/10 text-gray-200 border border-white/10 font-semibold text-base backdrop-blur-md transition-all flex items-center justify-center gap-2">
                        <span>Explore Ecosystem</span>
                        <span>↓</span>
                    </a>
                </div>

                <!-- Trust Micro-Badges -->
                <div class="mt-8 flex flex-wrap items-center justify-center gap-6 text-xs text-gray-300 font-semibold">
                    <div class="flex items-center gap-2">
                        <span class="text-green-400">✓</span> Free for Personal Use
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-green-400">✓</span> No Credit Card Required
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-green-400">✓</span> 1-Click SSO Onboarding
                    </div>
                </div>

            </div>

        </div>

    </div>
</section>
