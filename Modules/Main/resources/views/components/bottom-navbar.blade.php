<div
    class="fixed bottom-0 left-0 z-50 w-full h-16 bg-white border-t border-gray-200 dark:bg-gray-700 dark:border-gray-600 md:hidden">
    <div class="grid h-full max-w-lg grid-cols-3 mx-auto font-medium" x-data="{ appsOpen: false }">

        <!-- Home -->
        <a href="{{ route('dashboard') }}"
            class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
            <svg class="w-6 h-6 mb-1 text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500 {{ request()->routeIs('dashboard') ? 'text-blue-600 dark:text-blue-500' : '' }}"
                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path
                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                </path>
            </svg>
            <span
                class="text-xs text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500 {{ request()->routeIs('dashboard') ? 'text-blue-600 dark:text-blue-500' : '' }}">Home</span>
        </a>

        <!-- Apps (Triggers Menu) -->
        <div class="relative flex justify-center">
            <!-- Apps Menu Dropup -->
            <div x-show="appsOpen" @click.outside="appsOpen = false"
                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
                class="absolute bottom-16 left-1/2 transform -translate-x-1/2 w-64 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden mb-2"
                style="display: none;">
                <div class="p-3 grid grid-cols-3 gap-3">
                    <!-- School -->
                    <a href="http://school.zengfy.top"
                        class="flex flex-col items-center p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                        <span class="text-xl">🎓</span>
                        <span class="text-[10px] mt-1 text-gray-900 dark:text-white">School</span>
                    </a>
                    <!-- Shop -->
                    <a href="http://ecommerce.zengfy.top"
                        class="flex flex-col items-center p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                        <span class="text-xl">🛒</span>
                        <span class="text-[10px] mt-1 text-gray-900 dark:text-white">Shop</span>
                    </a>
                    <!-- POS -->
                    <a href="http://pos.zengfy.top"
                        class="flex flex-col items-center p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                        <span class="text-xl">💳</span>
                        <span class="text-[10px] mt-1 text-gray-900 dark:text-white">POS</span>
                    </a>
                    <!-- Hotel -->
                    <a href="http://hotel.zengfy.top"
                        class="flex flex-col items-center p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                        <span class="text-xl">🏨</span>
                        <span class="text-[10px] mt-1 text-gray-900 dark:text-white">Hotel</span>
                    </a>
                    <!-- AI -->
                    <a href="#"
                        class="flex flex-col items-center p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                        <span class="text-xl">🤖</span>
                        <span class="text-[10px] mt-1 text-gray-900 dark:text-white">AI</span>
                    </a>
                    <!-- More -->
                    <a href="#"
                        class="flex flex-col items-center p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                        <span class="text-xl">⚡</span>
                        <span class="text-[10px] mt-1 text-gray-900 dark:text-white">More</span>
                    </a>
                </div>
            </div>

            <button @click="appsOpen = !appsOpen"
                class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group w-full">
                <div
                    class="p-2 bg-blue-100 dark:bg-blue-900 rounded-full group-hover:bg-blue-200 dark:group-hover:bg-blue-800 transition">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-300" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path
                            d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                        </path>
                    </svg>
                </div>
            </button>
        </div>

        <!-- Account -->
        <a href="{{ route('account') }}"
            class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
            <img class="w-6 h-6 rounded-full border border-gray-300 dark:border-gray-500 mb-1"
                src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random" alt="User">
            <span
                class="text-xs text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500 {{ request()->routeIs('account') ? 'text-blue-600 dark:text-blue-500' : '' }}">Account</span>
        </a>
    </div>
</div>