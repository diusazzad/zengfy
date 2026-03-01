<nav class="fixed bottom-0 left-0 z-50 w-full h-16 bg-white/90 border-t border-gray-200 backdrop-blur-lg md:hidden">
    <div class="grid h-full max-w-lg grid-cols-5 mx-auto font-medium">
        <a href="{{ route('welcome') }}"
            class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 group {{ Route::is('welcome') ? 'text-blue-600' : 'text-gray-500' }}">
            <svg class="w-6 h-6 mb-1 transition-colors duration-200 group-hover:text-blue-600 {{ Route::is('welcome') ? 'text-blue-600' : 'text-gray-500' }}"
                fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                </path>
            </svg>
            <span
                class="text-[10px] transition-colors duration-200 group-hover:text-blue-600 {{ Route::is('welcome') ? 'text-blue-600' : 'text-gray-500' }}">
                {{ __('welcome.nav.home') ?? 'Home' }}
            </span>
        </a>

        <a href="{{ route('team') }}"
            class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 group {{ Route::is('team') ? 'text-blue-600' : 'text-gray-500' }}">
            <svg class="w-6 h-6 mb-1 transition-colors duration-200 group-hover:text-blue-600 {{ Route::is('team') ? 'text-blue-600' : 'text-gray-500' }}"
                fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                </path>
            </svg>
            <span
                class="text-[10px] transition-colors duration-200 group-hover:text-blue-600 {{ Route::is('team') ? 'text-blue-600' : 'text-gray-500' }}">
                {{ __('welcome.nav.team') ?? 'Team' }}
            </span>
        </a>

        <a href="{{ route('download.app') }}"
            class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 group {{ Route::is('download.app') ? 'text-blue-600' : 'text-gray-500' }}">
            <svg class="w-6 h-6 mb-1 transition-colors duration-200 group-hover:text-blue-600 {{ Route::is('download.app') ? 'text-blue-600' : 'text-gray-500' }}"
                fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
            </svg>
            <span
                class="text-[10px] transition-colors duration-200 group-hover:text-blue-600 {{ Route::is('download.app') ? 'text-blue-600' : 'text-gray-500' }}">App</span>
        </a>

        <a href="{{ route('faq') }}"
            class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 group {{ Route::is('faq') ? 'text-blue-600' : 'text-gray-500' }}">
            <svg class="w-6 h-6 mb-1 transition-colors duration-200 group-hover:text-blue-600 {{ Route::is('faq') ? 'text-blue-600' : 'text-gray-500' }}"
                fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                </path>
            </svg>
            <span
                class="text-[10px] transition-colors duration-200 group-hover:text-blue-600 {{ Route::is('faq') ? 'text-blue-600' : 'text-gray-500' }}">FAQ</span>
        </a>

        @auth
            <a href="{{ route('welcome') }}"
                class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 group {{ Route::is('welcome') ? 'text-blue-600' : 'text-gray-500' }}">
                <svg class="w-6 h-6 mb-1 transition-colors duration-200 group-hover:text-blue-600 {{ Route::is('welcome') ? 'text-blue-600' : 'text-gray-500' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                    </path>
                </svg>
                <span
                    class="text-[10px] transition-colors duration-200 group-hover:text-blue-600 {{ Route::is('welcome') ? 'text-blue-600' : 'text-gray-500' }}">
                    Home
                </span>
            </a>
        @else
            <a href="#"
                class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 group {{ false ? 'text-blue-600' : 'text-gray-500' }}">
                <svg class="w-6 h-6 mb-1 transition-colors duration-200 group-hover:text-blue-600 {{ false ? 'text-blue-600' : 'text-gray-500' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                <span
                    class="text-[10px] transition-colors duration-200 group-hover:text-blue-600 {{ false ? 'text-blue-600' : 'text-gray-500' }}">
                    {{ __('welcome.nav.signup') ?? 'Sign Up' }}
                </span>
            </a>
        @endauth
    </div>
</nav>