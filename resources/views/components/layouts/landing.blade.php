<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'zengfy | ' . __('welcome.title') }}</title>
    <meta name="description" content="{{ __('welcome.hero.description') }}">
    <meta name="theme-color" content="#2563EB">
    <link rel="canonical" href="{{ url('/') }}">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="{{ __('welcome.title') }}">
    <meta property="og:description" content="{{ __('welcome.hero.description') }}">
    <meta property="og:image" content="{{ asset('images/og-image.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;800&family=Noto+Sans+Bengali:wght@400;700&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100/50 text-gray-800 antialiased selection:bg-blue-200 selection:text-blue-900 overflow-x-hidden">

    <x-landing.preloader />

    <x-landing.header />

    <main>
        {{ $slot }}
    </main>

    <x-landing.footer />

    <x-landing.cookies-banner />
</body>

</html>