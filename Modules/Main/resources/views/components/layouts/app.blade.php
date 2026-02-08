<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ZenGFY Dashboard</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Setup Tailwind for Blade components since we are in a Module -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: { "50": "#eff6ff", "100": "#dbeafe", "200": "#bfdbfe", "300": "#93c5fd", "400": "#60a5fa", "500": "#3b82f6", "600": "#2563eb", "700": "#1d4ed8", "800": "#1e40af", "900": "#1e3a8a", "950": "#172554" }
                    }
                }
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gray-50 dark:bg-gray-900 font-sans antialiased" x-data="{ sidebarOpen: false }"
    x-on:toggle-sidebar.window="sidebarOpen = !sidebarOpen">

    <!-- MOBILE SIDENAV (Drawer) -->
    <div x-show="sidebarOpen" class="fixed inset-0 z-[60] lg:hidden" @keydown.escape.window="sidebarOpen = false"
        x-cloak>
        <div class="fixed inset-0 bg-gray-600 bg-opacity-75 transition-opacity" @click="sidebarOpen = false"
            x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"></div>

        <div class="fixed inset-y-0 left-0 flex max-w-xs w-full bg-white dark:bg-gray-800 shadow-xl"
            x-show="sidebarOpen" x-transition:enter="transition ease-in-out duration-300 transform"
            x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full">

            <div class="w-full flex flex-col h-full">
                <div
                    class="p-6 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center bg-blue-600">
                    <span class="text-xl font-bold text-white">Menu</span>
                    <button @click="sidebarOpen = false" class="text-white">✕</button>
                </div>
                <nav class="flex-1 overflow-y-auto py-4">
                    <a href="{{ route('welcome') }}"
                        class="flex items-center px-6 py-4 text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <span class="text-2xl mr-4">🏠</span> Home
                    </a>
                    <a href="{{ route('services') }}"
                        class="flex items-center px-6 py-4 text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <span class="text-2xl mr-4">🛠️</span> Services
                    </a>
                    <a href="#"
                        class="flex items-center px-6 py-4 text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <span class="text-2xl mr-4">👥</span> Friends
                    </a>
                    <a href="#"
                        class="flex items-center px-6 py-4 text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <span class="text-2xl mr-4">👨‍👩‍👧‍👦</span> Groups
                    </a>
                    <a href="#"
                        class="flex items-center px-6 py-4 text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition border-t border-gray-100 dark:border-gray-700 mt-4">
                        <span class="text-2xl mr-4">⚙️</span> Settings
                    </a>
                    @auth
                        <form action="{{ route('logout') }}" method="POST" class="mt-auto px-6 py-8">
                            @csrf
                            <button type="submit"
                                class="w-full bg-red-50 hover:bg-red-100 text-red-600 font-bold py-3 rounded-xl transition">
                                Logout
                            </button>
                        </form>
                    @endauth
                </nav>
            </div>
        </div>
    </div>

    <x-main::navbar />

    <div class="p-4 sm:ml-0 pt-20 max-w-7xl mx-auto">
        {{ $slot }}
    </div>

    <x-main::bottom-navbar />

    <x-sos-button />
</body>

</html>