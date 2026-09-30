<!-- resources/views/components/landing/navbar.blade.php -->
<nav x-data="{ mobileOpen: false, productsOpen: false, solutionsOpen: false }" id="main-navbar"
    class="fixed top-0 left-0 right-0 z-50 bg-[#0B0F17]/95 backdrop-blur-xl border-b border-white/10 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-12 h-16 sm:h-20 flex items-center justify-between">

        <!-- Brand Logo (Optimized for Accessible Name & 44px Touch Target) -->
        <a href="{{ route('welcome') }}" aria-label="Zengfy Home"
            class="flex items-center gap-2 sm:gap-3 group shrink-0 rounded-xl focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 p-1.5 min-h-[44px]">
            <div aria-hidden="true"
                class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg sm:rounded-xl bg-gradient-to-tr from-blue-600 via-indigo-600 to-cyan-400 flex items-center justify-center font-black text-base sm:text-xl text-white shadow-lg shadow-blue-500/25 group-hover:scale-105 transition-transform duration-300">
                Z
            </div>
            <span aria-hidden="true"
                class="text-xl sm:text-2xl font-extrabold tracking-tight text-white group-hover:text-gray-200 transition-colors">
                Zengfy<span class="text-blue-500 font-black">.</span>
            </span>
        </a>

        <!-- Center Menu Navigation (Hootsuite-Style Desktop/Laptop Mega Menu with 44px+ Touch Targets) -->
        <div class="hidden md:flex items-center gap-2 lg:gap-4 text-sm font-medium text-gray-300">

            <!-- Products Mega Menu Dropdown -->
            <div class="relative" @mouseenter="productsOpen = true" @mouseleave="productsOpen = false">
                <a href="{{ route('products') }}"
                    class="inline-flex items-center gap-1.5 hover:text-white transition-colors duration-200 py-2.5 px-3 min-h-[44px] rounded-lg focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                    <span>Products</span>
                    <svg class="w-4 h-4 transition-transform duration-200"
                        :class="productsOpen ? 'rotate-180 text-blue-400' : ''" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </a>

                <!-- Mega Menu Box -->
                <div x-show="productsOpen" x-cloak x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                    x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                    class="absolute top-full left-0 w-[540px] bg-[#0E1420] border border-white/10 rounded-2xl shadow-2xl p-4 grid grid-cols-2 gap-2 backdrop-blur-2xl z-50">

                    <a href="{{ route('products') }}"
                        class="col-span-2 p-3 min-h-[48px] rounded-xl bg-blue-600/10 border border-blue-500/20 hover:bg-blue-600/20 flex items-center justify-between group">
                        <div>
                            <p class="text-xs font-bold text-blue-400 uppercase tracking-wider">Explore All 10+ Apps</p>
                            <p class="text-xs text-gray-300 mt-0.5">Browse full product catalogue & features</p>
                        </div>
                        <span class="text-blue-400 font-bold group-hover:translate-x-1 transition-transform">→</span>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://school.zengfy.test:7000' : 'https://school.zengfy.top' }}"
                        class="p-3 min-h-[48px] rounded-xl hover:bg-white/5 flex items-center gap-3 transition-colors">
                        <span class="text-xl">🏫</span>
                        <div>
                            <p class="text-xs font-bold text-white">Zengfy School</p>
                            <p class="text-[10px] text-gray-300">Complete Academic ERP</p>
                        </div>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://pos.zengfy.test:7000' : 'https://pos.zengfy.top' }}"
                        class="p-3 min-h-[48px] rounded-xl hover:bg-white/5 flex items-center gap-3 transition-colors">
                        <span class="text-xl">🛒</span>
                        <div>
                            <p class="text-xs font-bold text-white">Zengfy POS</p>
                            <p class="text-[10px] text-gray-300">Retail & Inventory</p>
                        </div>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://law.zengfy.test:7000' : 'https://law.zengfy.top' }}"
                        class="p-3 min-h-[48px] rounded-xl hover:bg-white/5 flex items-center gap-3 transition-colors">
                        <span class="text-xl">⚖️</span>
                        <div>
                            <p class="text-xs font-bold text-white">Zengfy Law</p>
                            <p class="text-[10px] text-gray-300">Legal Vault & Cases</p>
                        </div>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://social.zengfy.test:7000' : 'https://social.zengfy.top' }}"
                        class="p-3 min-h-[48px] rounded-xl hover:bg-white/5 flex items-center gap-3 transition-colors">
                        <span class="text-xl">🌐</span>
                        <div>
                            <p class="text-xs font-bold text-white">Zengfy Social</p>
                            <p class="text-[10px] text-gray-300">NID-Verified Network</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Pricing Route Link -->
            <a href="{{ route('pricing') }}"
                class="hover:text-white transition-colors duration-200 py-2.5 px-3 min-h-[44px] inline-flex items-center rounded-lg focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                Pricing
            </a>

            <!-- Company Route Link -->
            <a href="{{ route('company') }}"
                class="hover:text-white transition-colors duration-200 py-2.5 px-3 min-h-[44px] inline-flex items-center rounded-lg focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                Company & Team
            </a>

            <!-- Terms & Conditions Route Link -->
            <a href="{{ route('terms') }}"
                class="hover:text-white transition-colors duration-200 py-2.5 px-3 min-h-[44px] inline-flex items-center rounded-lg focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                Terms & Conditions
            </a>

            <!-- Android App Download Route Link -->
            <a href="/download"
                class="inline-flex items-center gap-1.5 text-cyan-400 hover:text-cyan-300 transition-colors duration-200 py-2.5 px-3 min-h-[44px] rounded-lg font-semibold focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                <span>📱 Android App</span>
                <span class="text-[9px] px-1.5 py-0.5 rounded-full bg-cyan-500/20 text-cyan-300 font-bold">APK</span>
            </a>

            <!-- FAQ Link -->
            <a href="{{ route('faq') }}"
                class="hover:text-white transition-colors duration-200 py-2.5 px-3 min-h-[44px] inline-flex items-center rounded-lg focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                FAQ
            </a>
        </div>

        <!-- Right Action Buttons + Hamburger Menu Toggle -->
        <div class="flex items-center gap-2 sm:gap-3 shrink-0">
            <!-- Sign Up Link -->
            <a href="/register"
                class="hidden sm:inline-flex items-center text-xs sm:text-sm font-semibold text-gray-300 hover:text-white px-3 py-2 min-h-[44px] transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 rounded-xl">
                Sign Up
            </a>

            <!-- Sovereign Sign In Button (Sign up is accessible inside login view) -->
            <a href="/login"
                class="relative group overflow-hidden rounded-full p-px font-semibold text-xs sm:text-sm shadow-xl shadow-blue-600/20 active:scale-95 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                <span
                    class="absolute inset-0 bg-gradient-to-r from-blue-600 to-indigo-600 group-hover:opacity-90 transition-opacity"></span>
                <span
                    class="relative block px-5 sm:px-6 py-2.5 rounded-full bg-[#0B0F17]/40 backdrop-blur-sm text-white group-hover:bg-transparent transition-colors whitespace-nowrap min-h-[44px] flex items-center justify-center gap-2">
                    <span>Sign In</span>
                    <svg class="w-4 h-4 text-cyan-400 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </span>
            </a>

            <!-- Mobile Hamburger Button (Accessible Touch Target 48x48px) -->
            <button @click="mobileOpen = !mobileOpen" id="mobile-menu-btn" aria-label="Toggle Mobile Navigation"
                type="button"
                class="md:hidden min-w-[48px] min-h-[48px] p-3 rounded-xl text-gray-300 hover:text-white bg-white/5 border border-white/10 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 shrink-0 cursor-pointer flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path id="hamburger-icon-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation Drawer (Generous 48px touch targets for thumb navigation) -->
    <div x-show="mobileOpen" x-cloak id="mobile-menu-drawer"
        class="hidden md:hidden bg-[#0B0F17] border-b border-white/10 px-4 sm:px-6 py-5 space-y-2 text-sm font-semibold text-gray-300 transition-all">
        <a @click="mobileOpen = false" href="/download"
            class="flex items-center text-cyan-400 font-bold py-3 px-3 min-h-[48px] rounded-xl hover:bg-white/5">📱 Download Android APK →</a>
        <a @click="mobileOpen = false" href="{{ route('products') }}"
            class="flex items-center text-blue-400 font-bold py-3 px-3 min-h-[48px] rounded-xl hover:bg-white/5">Browse All Products →</a>
        <a @click="mobileOpen = false" href="{{ route('pricing') }}"
            class="flex items-center hover:text-white py-3 px-3 min-h-[48px] rounded-xl hover:bg-white/5">Pricing Plans</a>
        <a @click="mobileOpen = false" href="{{ route('company') }}"
            class="flex items-center hover:text-white py-3 px-3 min-h-[48px] rounded-xl hover:bg-white/5">Company & Team</a>
        <a @click="mobileOpen = false" href="{{ route('terms') }}"
            class="flex items-center hover:text-white py-3 px-3 min-h-[48px] rounded-xl hover:bg-white/5">Terms & Conditions</a>
        <a @click="mobileOpen = false" href="{{ route('faq') }}" 
            class="flex items-center hover:text-white py-3 px-3 min-h-[48px] rounded-xl hover:bg-white/5">FAQ</a>
        <div class="pt-3 border-t border-white/10">
            <a href="/login"
                class="w-full flex items-center justify-center py-3.5 px-4 min-h-[48px] rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold text-sm shadow-lg shadow-blue-600/30">
                Sign In to Sovereign Hub →
            </a>
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
            drawer.querySelectorAll('a').forEach(function (link) {
                link.addEventListener('click', function () {
                    drawer.classList.add('hidden');
                });
            });
        }
    });
</script>
