<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zengfy | One Account. Infinite Ecosystem.</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#0B0F17] text-white antialiased selection:bg-blue-600 selection:text-white overflow-x-hidden">

    <!-- 1. Header Navigation -->
    <x-landing.navbar />

    <!-- Main Content Body -->
    <main class="pt-20">
        <!-- 2. Hero Section -->
        <x-landing.hero />

        <!-- 3. Security & Trust Strip -->
        <x-landing.trust-badges />

        <!-- 4. Ecosystem Bento Grid -->
        <x-landing.bento-grid :services="$services" />

        <!-- 5. Single Sign-On (SSO) Feature Showcase -->
        <x-landing.sso-feature />
    </main>

    <!-- 6. Modern Footer -->
    <x-landing.footer />

</body>
</html>
