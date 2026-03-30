<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Zengfy | Your Digital Sanctuary')</title>
    <meta name="description" content="@yield('meta_description', 'The health-first social ecosystem designed for productivity and digital well-being.')">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Zengfy | Your Digital Sanctuary')">
    <meta property="og:description" content="@yield('meta_description', 'The health-first social ecosystem designed for productivity and digital well-being.')">
    <meta property="og:image" content="@yield('og_image', asset('images/og-main.png'))">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="@yield('title', 'Zengfy | Your Digital Sanctuary')">
    <meta name="twitter:description" content="@yield('meta_description', 'The health-first social ecosystem designed for productivity and digital well-being.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/og-main.png'))">

    <link rel="canonical" href="{{ url()->current() }}">

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

<body class="bg-gray-50 dark:bg-gray-900 font-sans antialiased">

    <x-main::navbar />

    <div class="p-4 sm:ml-0 pt-20 max-w-7xl mx-auto">
        @yield('content')
    </div>

    <x-main::bottom-navbar />
</body>

</html>