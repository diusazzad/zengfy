<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zengfy Social | সার্বভৌম সিটিজেন সোশ্যাল প্ল্যাটফর্ম</title>
    <meta name="description" content="Clean, bot-free sovereign social network for verified citizens. Hyperlocal feeds, world updates, and civic identity.">
    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    <!-- Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Vite Assets (React 19 Fast Refresh + Tailwind CSS) -->
    @viteReactRefresh
    @vite(['resources/css/app.css', 'Modules/Social/resources/js/main.jsx'])
</head>
<body class="bg-[#F0F2F5] text-slate-900 antialiased selection:bg-blue-600 selection:text-white min-h-screen">
    <!-- Accessible Skip to Main Content Link (WCAG 2.1 AA) -->
    <a href="#main-content" 
       class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-blue-600 focus:text-white focus:rounded-xl focus:shadow-xl focus:outline-none focus:ring-2 focus:ring-white font-bold text-sm">
        Skip to main content / মূল তথ্যে যান
    </a>

    <!-- React 19 Social Application Mount Point -->
    <div id="react-social-landing-root" 
         data-initial-data="{{ json_encode($initialData ?? $landingData ?? null, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) }}">
        <main id="main-content" role="main" class="min-h-screen flex items-center justify-center">
            <div class="flex items-center gap-2 text-slate-400 font-bold text-sm">
                <span class="w-3 h-3 rounded-full bg-blue-600 animate-ping"></span>
                <span>Zengfy Social লোড হচ্ছে...</span>
            </div>
        </main>
    </div>
</body>
</html>
