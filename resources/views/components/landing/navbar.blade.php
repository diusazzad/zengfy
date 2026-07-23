<!-- resources/views/components/landing/navbar.blade.php -->
<nav x-data="{ mobileOpen: false }" id="main-navbar"
    class="fixed top-0 left-0 right-0 z-50 bg-[#0B0F17]/90 backdrop-blur-xl border-b border-white/10 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-2.5 sm:px-6 lg:px-12 h-16 sm:h-20 flex items-center justify-between">

        <!-- Brand Logo (Optimized for 300px+ screens) -->
        <a href="/" aria-label="Zengfy Home" class="flex items-center gap-2 sm:gap-3 group shrink-0 rounded-xl focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 p-1">
            <div aria-hidden="true"
                class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg sm:rounded-xl bg-gradient-to-tr from-blue-600 via-indigo-600 to-cyan-400 flex items-center justify-center font-black text-base sm:text-xl text-white shadow-lg shadow-blue-500/25 group-hover:scale-105 transition-transform duration-300">
                Z
            </div>
            <span aria-hidden="true" class="text-xl sm:text-2xl font-extrabold tracking-tight text-white group-hover:text-gray-200 transition-colors">
                zengfy<span class="text-blue-500 font-black">.</span>
            </span>
        </a>

        <!-- Center Menu Navigation (Desktop/Laptop) -->
        <div class="hidden md:flex items-center gap-6 lg:gap-8 text-sm font-medium text-gray-300">
            <a href="#ecosystem" class="hover:text-white transition-colors duration-200 py-1 px-2 rounded-lg focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">Ecosystem</a>
            <a href="#security" class="hover:text-white transition-colors duration-200 py-1 px-2 rounded-lg focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">Security & NID</a>
            <a href="#sso" class="hover:text-white transition-colors duration-200 py-1 px-2 rounded-lg focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">Unified SSO</a>
            <a href="#faq" class="hover:text-white transition-colors duration-200 py-1 px-2 rounded-lg focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">FAQ</a>
        </div>

        <!-- Right Action Buttons + Hamburger Menu Toggle -->
        <div class="flex items-center gap-1.5 sm:gap-4 shrink-0">
            <a href="{{ env('APP_ENV') === 'local' ? 'http://zengfy.test:7000/login' : 'https://zengfy.top/login' }}"
                class="hidden sm:inline-flex items-center text-sm font-semibold text-gray-300 hover:text-white transition-colors px-3 py-2 rounded-lg focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                Sign In
            </a>

            <a href="#cta"
                class="relative group overflow-hidden rounded-full p-px font-semibold text-[11px] sm:text-sm shadow-xl shadow-blue-600/20 active:scale-95 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                <span
                    class="absolute inset-0 bg-gradient-to-r from-blue-600 to-indigo-600 group-hover:opacity-90 transition-opacity"></span>
                <span
                    class="relative block px-3 sm:px-6 py-2 sm:py-2.5 rounded-full bg-[#0B0F17]/40 backdrop-blur-sm text-white group-hover:bg-transparent transition-colors whitespace-nowrap min-h-[40px] sm:min-h-[44px] flex items-center justify-center">
                    Get Started
                </span>
            </a>

            <!-- Mobile Hamburger Button (Touch Target 44x44px minimum) -->
            <button @click="mobileOpen = !mobileOpen" id="mobile-menu-btn" aria-label="Toggle Mobile Navigation" type="button"
                class="md:hidden min-w-[44px] min-h-[44px] p-2 rounded-xl text-gray-300 hover:text-white bg-white/5 border border-white/10 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 shrink-0 cursor-pointer flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path id="hamburger-icon-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation Drawer -->
    <div x-show="mobileOpen" x-cloak id="mobile-menu-drawer"
        class="hidden md:hidden bg-[#0B0F17] border-b border-white/10 px-4 sm:px-6 py-5 space-y-4 text-sm font-semibold text-gray-300 transition-all">
        <a @click="mobileOpen = false" href="#ecosystem" class="block hover:text-white py-2 px-2 rounded-lg focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">Ecosystem</a>
        <a @click="mobileOpen = false" href="#security" class="block hover:text-white py-2 px-2 rounded-lg focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">Security & NID</a>
        <a @click="mobileOpen = false" href="#sso" class="block hover:text-white py-2 px-2 rounded-lg focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">Unified SSO</a>
        <a @click="mobileOpen = false" href="#faq" class="block hover:text-white py-2 px-2 rounded-lg focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">FAQ</a>
        <div class="pt-3 border-t border-white/10 flex items-center justify-between">
            <a href="{{ env('APP_ENV') === 'local' ? 'http://zengfy.test:7000/login' : 'https://zengfy.top/login' }}" 
               class="text-blue-400 font-bold hover:underline py-2 px-2 rounded-lg focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">Sign In to Dashboard →</a>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('mobile-menu-btn');
        const drawer = document.getElementById('mobile-menu-drawer');
        if (btn && drawer) {
            btn.addEventListener('click', function () {
                drawer.classList.toggle('hidden');
            });
            drawer.querySelectorAll('a').forEach(function(link) {
                link.addEventListener('click', function() {
                    drawer.classList.add('hidden');
                });
            });
        }
    });
</script>
