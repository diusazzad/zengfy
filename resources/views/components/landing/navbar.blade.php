<!-- resources/views/components/landing/navbar.blade.php -->
<nav
    class="fixed top-0 left-0 right-0 z-50 bg-[#0B0F17]/80 backdrop-blur-xl border-b border-white/10 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">

        <!-- Brand Logo -->
        <a href="/" class="flex items-center gap-3 group">
            <div
                class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 via-indigo-600 to-cyan-400 flex items-center justify-center font-black text-xl text-white shadow-lg shadow-blue-500/25 group-hover:scale-105 transition-transform duration-300">
                Z
            </div>
            <span class="text-2xl font-extrabold tracking-tight text-white group-hover:text-gray-200 transition-colors">
                zengfy<span class="text-blue-500 font-black">.</span>
            </span>
        </a>

        <!-- Center Menu Navigation -->
        <div class="hidden md:flex items-center gap-8 text-sm font-medium text-gray-400">
            <a href="#ecosystem" class="hover:text-white transition-colors duration-200 py-1">Ecosystem</a>
            <a href="#security" class="hover:text-white transition-colors duration-200 py-1">Security & NID</a>
            <a href="#sso" class="hover:text-white transition-colors duration-200 py-1">Unified SSO</a>
            <a href="#solutions" class="hover:text-white transition-colors duration-200 py-1">Solutions</a>
        </div>

        <!-- Right Action Buttons -->
        <div class="flex items-center gap-4">
            <a href="{{ env('APP_ENV') === 'local' ? 'http://zengfy.test:7000/login' : 'https://zengfy.top/login' }}"
                class="hidden sm:inline-flex items-center text-sm font-semibold text-gray-300 hover:text-white transition-colors px-4 py-2">
                Sign In
            </a>

            <a href="#cta"
                class="relative group overflow-hidden rounded-full p-px font-semibold text-sm shadow-xl shadow-blue-600/20 active:scale-95 transition-all">
                <span
                    class="absolute inset-0 bg-gradient-to-r from-blue-600 to-indigo-600 group-hover:opacity-90 transition-opacity"></span>
                <span
                    class="relative block px-6 py-2.5 rounded-full bg-[#0B0F17]/40 backdrop-blur-sm text-white group-hover:bg-transparent transition-colors">
                    Get Started Free
                </span>
            </a>
        </div>
    </div>
</nav>
