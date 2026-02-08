@php
    $ecosystemApps = [
        ['name' => 'Legal', 'icon' => '⚖️', 'url' => zengfy_url('law'), 'description' => 'Cases & Schedule', 'color' => 'bg-blue-500'],
        ['name' => 'Merchant', 'icon' => '🛍️', 'url' => zengfy_url('merchant'), 'description' => 'Orders & Store', 'color' => 'bg-pink-500'],
        ['name' => 'School', 'icon' => '🎓', 'url' => zengfy_url('school'), 'description' => 'Attendance & ERP', 'color' => 'bg-indigo-500'],
        ['name' => 'POS', 'icon' => '🛒', 'url' => zengfy_url('pos'), 'description' => 'Billing & Inventory', 'color' => 'bg-green-500'],
        ['name' => 'Hotel', 'icon' => '🏨', 'url' => zengfy_url('hotel'), 'description' => 'Booking & Management', 'color' => 'bg-amber-500'],
        ['name' => 'AI', 'icon' => '⚡', 'url' => zengfy_url('ai'), 'description' => 'Smart Assistants', 'color' => 'bg-purple-500'],
    ];
@endphp

<div class="relative" x-data="{ open: false }">
    <button @click="open = !open" @click.outside="open = false" type="button"
        class="p-2 text-gray-500 rounded-lg hover:bg-gray-100 hover:text-gray-900 focus:ring-4 focus:ring-gray-300 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-600 transition duration-200">
        <span class="sr-only">Open apps menu</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
            <path
                d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
            </path>
        </svg>
    </button>

    <!-- Dropdown menu -->
    <div x-show="open" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-2 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-2 scale-95"
        class="absolute right-0 z-50 mt-2 my-4 w-80 md:w-96 text-base list-none bg-white divide-y divide-gray-100 rounded-2xl shadow-2xl dark:bg-gray-800 dark:divide-gray-700 border border-gray-100 dark:border-gray-700 overflow-hidden"
        id="apps-dropdown">

        <div class="p-4 grid grid-cols-2 gap-3">
            @foreach($ecosystemApps as $app)
                <a href="{{ $app['url'] }}"
                    class="group flex items-start gap-4 p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200">
                    <div
                        class="w-10 h-10 {{ $app['color'] }} rounded-lg flex items-center justify-center text-white text-xl shadow-lg shadow-opacity-20 group-hover:scale-110 transition duration-200">
                        {{ $app['icon'] }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="font-bold text-gray-900 dark:text-white text-sm truncate">{{ $app['name'] }}</h4>
                        <p class="text-[10px] text-gray-500 dark:text-gray-400 font-medium leading-tight mt-0.5">
                            {{ $app['description'] }}</p>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="p-4 bg-gray-50 dark:bg-gray-800/50 text-center">
            <a href="{{ route('services') }}"
                class="inline-flex items-center justify-center w-full px-5 py-2.5 text-sm font-bold text-center text-white rounded-xl bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 transition duration-200 shadow-lg shadow-blue-500/20">
                Explore All Services
            </a>
        </div>
    </div>
</div>