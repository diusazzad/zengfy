<div class="relative" x-data="{ open: false }">
    <button @click="open = !open" @click.outside="open = false" type="button"
        class="p-2 text-gray-500 rounded-lg hover:bg-gray-100 hover:text-gray-900 focus:ring-4 focus:ring-gray-300 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-600 transition duration-200">
        <span class="sr-only">View notifications</span>
        <div class="relative">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                </path>
            </svg>
            <div
                class="absolute top-0 right-0 w-2.5 h-2.5 bg-red-500 border-2 border-white dark:border-gray-800 rounded-full">
            </div>
        </div>
    </button>

    <!-- Dropdown menu -->
    <div x-show="open" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-2 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-2 scale-95"
        class="absolute right-0 z-50 mt-2 w-80 bg-white divide-y divide-gray-100 rounded-2xl shadow-2xl dark:bg-gray-800 dark:divide-gray-700 border border-gray-100 dark:border-gray-700 overflow-hidden"
        x-cloak>
        <div class="px-4 py-3 bg-gray-50 dark:bg-gray-800/50 flex justify-between items-center">
            <span class="font-bold text-gray-900 dark:text-white text-sm">Notifications</span>
            <span class="text-[10px] bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full font-bold">3 New</span>
        </div>
        <div class="max-h-96 overflow-y-auto">
            <!-- Notification Item 1 -->
            <a href="#" class="flex px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                <div class="flex-shrink-0">
                    <img class="rounded-full w-11 h-11"
                        src="https://ui-avatars.com/api/?name=Rahim+Ahmed&background=random" alt="User">
                </div>
                <div class="w-full ps-3">
                    <div class="text-gray-500 text-xs mb-1.5 dark:text-gray-400">
                        New comment from <span class="font-semibold text-gray-900 dark:text-white">Rahim Ahmed</span>:
                        "Great post! 🚀"
                    </div>
                    <div class="text-blue-600 text-[10px] font-bold">2 minutes ago</div>
                </div>
            </a>
            <!-- Notification Item 2 -->
            <a href="#" class="flex px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                <div class="flex-shrink-0">
                    <div class="rounded-full w-11 h-11 bg-blue-500 flex items-center justify-center text-white text-xl">
                        👍</div>
                </div>
                <div class="w-full ps-3">
                    <div class="text-gray-500 text-xs mb-1.5 dark:text-gray-400">
                        <span class="font-semibold text-gray-900 dark:text-white">Sumaiya Akter</span> liked your photo.
                    </div>
                    <div class="text-gray-400 text-[10px]">1 hour ago</div>
                </div>
            </a>
        </div>
        <a href="#"
            class="block py-3 text-sm font-bold text-center text-blue-600 bg-gray-50 dark:bg-gray-800/50 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
            View all notifications
        </a>
    </div>
</div>