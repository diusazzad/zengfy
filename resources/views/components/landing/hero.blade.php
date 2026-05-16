<!-- p:\Zengfy-Ecosystem\core\resources\views\components\landing\hero.blade.php -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-16 flex flex-col md:flex-row items-center justify-between gap-8 md:gap-12 lg:gap-16">
    <!-- Left: Vision Content -->
    <div class="flex-1 text-center md:text-left z-10 w-full">
        <!-- Badge -->
        <div data-aos="fade-down" data-aos-delay="100" class="inline-flex items-center justify-center gap-1.5 px-3 py-1.5 rounded-full bg-blue-50 text-blue-700 text-[10px] sm:text-xs font-black uppercase tracking-wider mx-auto md:mx-0 mb-4 sm:mb-6 border border-blue-100 shadow-sm">
            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            {{ __('welcome.prds.badge') }}
        </div>

        <!-- Main Title -->
        <h1 data-aos="fade-up" data-aos-delay="200" class="text-2xl sm:text-4xl md:text-4xl lg:text-5xl xl:text-6xl font-black text-gray-900 leading-[1.25] tracking-tight mb-4 sm:mb-5">
            {!! __('welcome.prds.title_html') !!}
        </h1>
        
        <!-- Description -->
        <p data-aos="fade-up" data-aos-delay="300" class="text-sm sm:text-lg md:text-lg text-gray-600 font-medium leading-relaxed max-w-2xl mx-auto md:mx-0 mb-6 sm:mb-10 md:pr-4 lg:pr-6">
            {{ __('welcome.prds.description') }}
        </p>

        <!-- Vision PRD Highlights (Desktop Only) -->
        <div class="hidden md:flex flex-col gap-3 sm:gap-4 text-left mb-6 md:mb-8 max-w-lg mx-auto md:mx-0">
            <!-- PRD 1: Community & Health -->
            <div data-aos="fade-up" data-aos-delay="400" class="flex items-start gap-3 sm:gap-4 p-3 sm:p-4 rounded-xl bg-gray-50 border border-gray-100">
                <div class="w-8 h-8 sm:w-10 sm:h-10 shrink-0 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 text-sm sm:text-base leading-tight mt-0.5 sm:mt-0">{{ __('welcome.prds.health.title') }}</h3>
                    <p class="text-xs sm:text-sm md:text-[13px] lg:text-sm text-gray-600 mt-1 leading-snug">{{ __('welcome.prds.health.desc') }}</p>
                </div>
            </div>

            <!-- PRD 2: Offline SOS -->
            <div data-aos="fade-up" data-aos-delay="500" class="flex items-start gap-3 sm:gap-4 p-3 sm:p-4 rounded-xl bg-gray-50 border border-gray-100">
                <div class="w-8 h-8 sm:w-10 sm:h-10 shrink-0 rounded-lg bg-red-100 flex items-center justify-center text-red-600">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 text-sm sm:text-base leading-tight mt-0.5 sm:mt-0">{{ __('welcome.prds.sos.title') }}</h3>
                    <p class="text-xs sm:text-sm md:text-[13px] lg:text-sm text-gray-600 mt-1 leading-snug">{{ __('welcome.prds.sos.desc') }}</p>
                </div>
            </div>

            <!-- PRD 3: 100% Verified Community -->
            <div data-aos="fade-up" data-aos-delay="600" class="flex items-start gap-3 sm:gap-4 p-3 sm:p-4 rounded-xl bg-gray-50 border border-gray-100">
                <div class="w-8 h-8 sm:w-10 sm:h-10 shrink-0 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 text-sm sm:text-base leading-tight mt-0.5 sm:mt-0">{{ __('welcome.prds.secure.title') }}</h3>
                    <p class="text-xs sm:text-sm md:text-[13px] lg:text-sm text-gray-600 mt-1 leading-snug">{{ __('welcome.prds.secure.desc') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side: Embedded Login Box (Fully Mobile Optimized) -->
    <div data-aos="fade-left" data-aos-delay="400" class="w-full md:w-[340px] lg:w-[420px] shrink-0 mt-6 md:mt-0 px-0">
        <div class="bg-white p-5 sm:p-8 rounded-2xl md:rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-gray-100 w-full relative">
            <div class="text-center mb-5 sm:mb-6">
                <h2 class="text-lg sm:text-2xl font-black text-gray-900 leading-tight">{{ __('welcome.prds.login_title') }}</h2>
                <p class="text-xs sm:text-sm text-gray-500 mt-1.5 font-medium">{{ __('welcome.prds.login_subtitle') }}</p>
            </div>

            <form method="POST" action="/login" class="flex flex-col gap-3.5 sm:gap-4">
                @csrf
                <div>
                    <label for="email" class="block text-xs sm:text-sm font-bold text-gray-700 mb-1 sm:mb-1.5">{{ __('welcome.prds.form.email') }}</label>
                    <input id="email" type="text" name="email" required autofocus class="w-full px-3.5 py-2.5 sm:px-4 sm:py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none text-base transition-colors" placeholder="example@email.com">
                </div>

                <div>
                    <div class="flex flex-wrap items-center justify-between gap-1 mb-1 sm:mb-1.5">
                        <label for="password" class="block text-xs sm:text-sm font-bold text-gray-700">{{ __('welcome.prds.form.password') }}</label>
                        <a href="/password/reset" class="text-[11px] sm:text-xs font-bold text-blue-600 hover:text-blue-800 transition-colors">{{ __('welcome.prds.form.forgot') }}</a>
                    </div>
                    <input id="password" type="password" name="password" required class="w-full px-3.5 py-2.5 sm:px-4 sm:py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none text-base transition-colors" placeholder="••••••••">
                </div>

                <div class="flex items-center mt-0.5">
                    <input id="remember" type="checkbox" name="remember" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 cursor-pointer">
                    <label for="remember" class="ml-2 block text-xs sm:text-sm font-medium text-gray-700 cursor-pointer select-none">
                        {{ __('welcome.prds.form.remember') }}
                    </label>
                </div>

                <button type="submit" class="w-full py-3 sm:py-3.5 mt-1 sm:mt-2 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white rounded-lg font-bold text-sm sm:text-base border border-transparent shadow-md transition-colors">
                    {{ __('welcome.nav.login') }}
                </button>
            </form>

            <div class="mt-5 sm:mt-6 flex items-center justify-center overflow-hidden">
                <span class="h-px w-full bg-gray-100"></span>
                <span class="px-3 sm:px-4 text-[10px] sm:text-xs font-bold text-gray-400 uppercase tracking-wider shrink-0">{{ __('welcome.prds.form.or') }}</span>
                <span class="h-px w-full bg-gray-100"></span>
            </div>

            <a href="/register" class="mt-5 sm:mt-6 w-full py-3 sm:py-3.5 flex justify-center items-center gap-2 bg-gray-900 hover:bg-gray-800 active:bg-gray-950 text-white rounded-lg font-bold text-sm sm:text-base shadow-sm transition-colors cursor-pointer">
                {{ __('welcome.nav.signup') }}
            </a>
        </div>

        <!-- Vision PRD Highlights (Mobile Only - Below Login) -->
        <div class="flex md:hidden flex-col gap-3 text-left mt-8 mx-auto w-full">
            <!-- PRD 1: Community & Health -->
            <div class="flex items-start gap-3 p-3.5 rounded-xl bg-gray-50 border border-gray-100 shadow-sm">
                <div class="w-8 h-8 shrink-0 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 text-sm leading-tight mt-0.5">{{ __('welcome.prds.health.title') }}</h3>
                    <p class="text-[13px] text-gray-600 mt-1 leading-snug">{{ __('welcome.prds.health.desc') }}</p>
                </div>
            </div>

            <!-- PRD 2: Offline SOS -->
            <div class="flex items-start gap-3 p-3.5 rounded-xl bg-gray-50 border border-gray-100 shadow-sm">
                <div class="w-8 h-8 shrink-0 rounded-lg bg-red-100 flex items-center justify-center text-red-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 text-sm leading-tight mt-0.5">{{ __('welcome.prds.sos.title') }}</h3>
                    <p class="text-[13px] text-gray-600 mt-1 leading-snug">{{ __('welcome.prds.sos.desc') }}</p>
                </div>
            </div>

            <!-- PRD 3: 100% Verified Community -->
            <div class="flex items-start gap-3 p-3.5 rounded-xl bg-gray-50 border border-gray-100 shadow-sm">
                <div class="w-8 h-8 shrink-0 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 text-sm leading-tight mt-0.5">{{ __('welcome.prds.secure.title') }}</h3>
                    <p class="text-[13px] text-gray-600 mt-1 leading-snug">{{ __('welcome.prds.secure.desc') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>