@php
    $modules = [
        [
            'name' => 'Legal',
            'icon' => '⚖️',
            'url' => 'https://law.zengfy.top',
            'description' => 'Cases and legal schedule',
            'color' => 'bg-blue-500',
        ],
        [
            'name' => 'Merchant',
            'icon' => '🛍️',
            'url' => 'https://merchant.zengfy.top',
            'description' => 'Orders and product management',
            'color' => 'bg-pink-500',
        ],
        [
            'name' => 'School',
            'icon' => '🎓',
            'url' => 'https://school.zengfy.top',
            'description' => 'Attendance and result system',
            'color' => 'bg-indigo-500',
        ],
        [
            'name' => 'POS',
            'icon' => '🛒',
            'url' => 'https://pos.zengfy.top',
            'description' => 'Billing and inventory',
            'color' => 'bg-green-500',
        ],
    ];
@endphp

<div x-data="{ open: false }" class="relative">
    <!-- Switcher Button -->
    <button @click="open = !open"
        class="flex items-center gap-2 px-3 py-2 rounded-lg bg-gray-100 hover:bg-gray-200 transition duration-200">
        <span class="text-lg">🍱</span>
        <span class="hidden md:block font-bold text-gray-700">Explore Apps</span>
        <svg class="w-4 h-4 text-gray-500 transition-transform duration-200" :class="open ? 'rotate-180' : ''"
            fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    <!-- Mega Menu Dropdown -->
    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2"
        class="absolute right-0 mt-2 w-72 md:w-96 bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden z-[100]">

        <div class="p-4 grid grid-cols-1 md:grid-cols-2 gap-3">
            @foreach($modules as $module)
                <a href="{{ $module['url'] }}"
                    class="group flex items-start gap-3 p-3 rounded-xl hover:bg-gray-50 transition duration-200">
                    <div
                        class="w-10 h-10 {{ $module['color'] }} rounded-lg flex items-center justify-center text-white text-xl shadow-lg shadow-opacity-20 group-hover:scale-110 transition duration-200">
                        {{ $module['icon'] }}
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-sm">{{ $module['name'] }}</h4>
                        <p class="text-xs text-gray-500 leading-tight mt-0.5">{{ $module['description'] }}</p>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Footer link -->
        <div class="bg-gray-50 p-3 text-center border-t border-gray-100">
            <a href="{{ route('welcome') }}" class="text-sm font-bold text-blue-600 hover:text-blue-700">
                View All Ecosystem Services →
            </a>
        </div>
    </div>
</div>