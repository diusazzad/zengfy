<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zengfy Atelier | Sovereign Apparel & Clothing Brand</title>
    <meta name="description" content="Crafted in Dhaka. 380 GSM Heavyweight French Terry Hoodies, 240 GSM Boxy Oversized Tees, Tactical Cargo Pants, and minimalist streetwear essentials. Zero compromise on fabric density.">
    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    <!-- Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Vite Assets (React 19 Fast Refresh + Tailwind CSS) -->
    @viteReactRefresh
    @vite(['resources/css/app.css', 'Modules/Shop/resources/js/main.jsx'])
</head>
<body class="bg-[#FAFAFA] text-slate-900 antialiased selection:bg-slate-900 selection:text-white min-h-screen">
    <!-- Accessible Skip to Main Content Link (WCAG 2.1 AA) -->
    <a href="#main-content" 
       class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-slate-900 focus:text-white focus:rounded-xl focus:shadow-xl focus:outline-none focus:ring-2 focus:ring-slate-400 font-bold text-sm">
        Skip to main content / মূল তথ্যে যান
    </a>

    <!-- React 19 Shop Atelier Application Mount Point -->
    <div id="react-shop-landing-root" 
         data-initial-data="{{ json_encode($initialData ?? null, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) }}">
        <!-- Pre-hydration Semantic Main Landmark (Simple & Clean) -->`n        <main id="main-content" role="main" class="min-h-screen">`n        </main>
    </div>
</body>
</html>
