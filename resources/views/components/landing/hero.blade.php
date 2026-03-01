<!-- p:\Zengfy-Ecosystem\core\resources\views\components\landing\hero.blade.php -->
<section
    class="max-w-7xl mx-auto px-8 sm:px-10 pt-10 pb-20 flex flex-col lg:flex-row items-center justify-between gap-12 lg:gap-20">
    <!-- Left Side: Branding & Value Prop -->
    <div class="flex-1 text-center lg:text-left">
        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black text-gray-900 leading-tight mb-6 font-sans">
            {{ __('welcome.hero.title_prefix') }}
            <span class="text-blue-600">{{ __('welcome.hero.unified_saas') }}</span>
        </h1>
        <p class="text-lg sm:text-xl md:text-2xl text-gray-600 font-medium leading-relaxed max-w-xl mx-auto lg:mx-0">
            {{ __('welcome.hero.description') }}
        </p>

        <!-- Social Features Highlight -->
        <div class="mt-10 hidden lg:flex flex-col gap-4 text-gray-500 font-semibold">
            <div class="flex items-center gap-3">
                <div class="w-3 h-3 rounded-full bg-green-500 shadow-sm"></div>
                <span>Real Identity. No Fake Accounts.</span>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-3 h-3 rounded-full bg-blue-500 shadow-sm"></div>
                <span>Local Business Community & B2B Feed.</span>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-3 h-3 rounded-full bg-indigo-500 shadow-sm"></div>
                <span>Unified One-Dashboard Management.</span>
            </div>
        </div>
    </div>

    <!-- Right Side: Simplified CTA Card -->
    <div class="w-full max-w-[400px] shrink-0">
        <div
            class="bg-white p-8 sm:p-10 rounded-3xl shadow-2xl shadow-blue-900/5 border border-gray-100 flex flex-col gap-8 animate-fade-in-up">
            <div class="text-center">
                <div class="w-20 h-20 bg-blue-50 rounded-2xl flex items-center justify-center text-4xl mx-auto mb-6">🚀</div>
                <h2 class="text-2xl font-black text-gray-900 mb-2">Join Zengfy</h2>
                <p class="text-gray-500 font-medium leading-relaxed">Start your journey in the world's first unified social business ecosystem.</p>
            </div>

            <div class="flex flex-col gap-4">
                <a href="#"
                    class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-black text-lg shadow-xl shadow-blue-600/20 transition-all transform active:scale-95 flex items-center justify-center gap-2">
                    <span>Get Started Free</span>
                </a>
                <a href="#" class="w-full py-3 bg-gray-50 hover:bg-gray-100 text-gray-700 rounded-xl font-bold text-center transition-all border border-gray-100">
                    Sign In
                </a>
            </div>
            <p class="text-[10px] text-center text-gray-400 font-bold uppercase tracking-widest">No credit card required</p>
        </div>
    </div>
</section>