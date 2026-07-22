<!-- resources/views/components/landing/navbar.blade.php -->
<nav x-data="{ mobileOpen: false }"
    class="fixed top-0 left-0 right-0 z-50 bg-[#0B0F17]/80 backdrop-blur-xl border-b border-white/10 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-12 xl:px-16 h-20 flex items-center justify-between">

        <!-- Brand Logo -->
        <a href="/" aria-label="Zengfy" class="flex items-center gap-3 group">
            <div aria-hidden="true"
                class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 via-indigo-600 to-cyan-400 flex items-center justify-center font-black text-xl text-white shadow-lg shadow-blue-500/25 group-hover:scale-105 transition-transform duration-300">
                Z
            </div>
            <span aria-hidden="true" class="text-2xl font-extrabold tracking-tight text-white group-hover:text-gray-200 transition-colors">
                zengfy<span class="text-blue-500 font-black">.</span>
            </span>
        </a>

        <!-- Center Menu Navigation (Desktop/Laptop) -->
        <div class="hidden md:flex items-center gap-6 lg:gap-8 text-sm font-medium text-gray-300">
            <a href="#ecosystem" class="hover:text-white transition-colors duration-200 py-1">Ecosystem</a>
            <a href="#security" class="hover:text-white transition-colors duration-200 py-1">Security & NID</a>
            <a href="#sso" class="hover:text-white transition-colors duration-200 py-1">Unified SSO</a>
            <a href="#faq" class="hover:text-white transition-colors duration-200 py-1">FAQ</a>
        </div>

        <!-- Right Action Buttons + Hamburger Menu Toggle -->
        <div class="flex items-center gap-3 sm:gap-4">
            <a href="{{ env('APP_ENV') === 'local' ? 'http://zengfy.test:7000/login' : 'https://zengfy.top/login' }}"
                class="hidden sm:inline-flex items-center text-sm font-semibold text-gray-300 hover:text-white transition-colors px-3 py-2">
                Sign In
            </a>

            <a href="#cta"
                class="relative group overflow-hidden rounded-full p-px font-semibold text-xs sm:text-sm shadow-xl shadow-blue-600/20 active:scale-95 transition-all">
                <span
                    class="absolute inset-0 bg-gradient-to-r from-blue-600 to-indigo-600 group-hover:opacity-90 transition-opacity"></span>
                <span
                    class="relative block px-4 sm:px-6 py-2 sm:py-2.5 rounded-full bg-[#0B0F17]/40 backdrop-blur-sm text-white group-hover:bg-transparent transition-colors">
                    Get Started Free
                </span>
            </a>

            <!-- Mobile Hamburger Button -->
            <button @click="mobileOpen = !mobileOpen" aria-label="Toggle Mobile Navigation"
                class="md:hidden p-2 rounded-xl text-gray-300 hover:text-white bg-white/5 border border-white/10 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path x-show="mobileOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation Drawer -->
    <div x-show="mobileOpen" x-cloak 
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        class="md:hidden bg-[#0B0F17] border-b border-white/10 px-6 py-6 space-y-4 text-sm font-semibold text-gray-300">
        <a @click="mobileOpen = false" href="#ecosystem" class="block hover:text-white">Ecosystem</a>
        <a @click="mobileOpen = false" href="#security" class="block hover:text-white">Security & NID</a>
        <a @click="mobileOpen = false" href="#sso" class="block hover:text-white">Unified SSO</a>
        <a @click="mobileOpen = false" href="#faq" class="block hover:text-white">FAQ</a>
        <div class="pt-4 border-t border-white/10 flex items-center justify-between">
            <a href="{{ env('APP_ENV') === 'local' ? 'http://zengfy.test:7000/login' : 'https://zengfy.top/login' }}" 
               class="text-blue-400 font-bold">Sign In to Dashboard →</a>
        </div>
    </div>
</nav>
