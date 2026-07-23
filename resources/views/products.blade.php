<!-- resources/views/products.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All Products & Operating Systems | Zengfy</title>
    <meta name="description" content="Explore all 10+ specialized operating systems powered by Zengfy Unified SSO and NID Verification.">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#0B0F17] text-white antialiased selection:bg-blue-600 selection:text-white overflow-x-hidden min-h-screen flex flex-col justify-between" x-data="{ activeCategory: 'all', search: '' }">

    <!-- Header Navigation -->
    <x-landing.navbar />

    <!-- Main Body Container -->
    <main class="pt-28 pb-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 w-full flex-grow">
        
        <!-- Hero Section -->
        <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
            <span class="text-blue-400 font-extrabold tracking-widest uppercase text-xs bg-blue-500/10 border border-blue-500/20 px-4 py-1.5 rounded-full">
                Sovereign Product Suite
            </span>
            <h1 class="text-3xl sm:text-5xl font-black mt-4 text-white tracking-tight leading-tight">
                One Identity. <br class="hidden sm:block"/>
                <span class="bg-gradient-to-r from-blue-400 via-indigo-300 to-cyan-400 bg-clip-text text-transparent">
                    10+ Operating Systems.
                </span>
            </h1>
            <p class="mt-4 text-gray-300 text-base sm:text-lg leading-relaxed">
                Click on any product card below to launch its dedicated landing page or login instantly via Zengfy Unified Single Sign-On (SSO).
            </p>
        </div>

        <!-- Filter & Search Bar -->
        <div class="mb-12 flex flex-col sm:flex-row items-center justify-between gap-4 bg-[#121A29]/60 p-4 rounded-2xl border border-white/10 backdrop-blur-xl">
            <!-- Category Filter Pills -->
            <div class="flex flex-wrap items-center gap-2 w-full sm:w-auto">
                <button @click="activeCategory = 'all'" 
                        :class="activeCategory === 'all' ? 'bg-blue-600 text-white' : 'bg-white/5 text-gray-300 hover:bg-white/10'"
                        class="px-4 py-2 rounded-xl text-xs font-bold transition-all cursor-pointer">
                    All Apps ({{ count($products) }})
                </button>
                <button @click="activeCategory = 'Community & Identity'" 
                        :class="activeCategory === 'Community & Identity' ? 'bg-blue-600 text-white' : 'bg-white/5 text-gray-300 hover:bg-white/10'"
                        class="px-4 py-2 rounded-xl text-xs font-bold transition-all cursor-pointer">
                    Social & Identity
                </button>
                <button @click="activeCategory = 'Education & ERP'" 
                        :class="activeCategory === 'Education & ERP' ? 'bg-blue-600 text-white' : 'bg-white/5 text-gray-300 hover:bg-white/10'"
                        class="px-4 py-2 rounded-xl text-xs font-bold transition-all cursor-pointer">
                    Education
                </button>
                <button @click="activeCategory = 'Commerce & Retail'" 
                        :class="activeCategory === 'Commerce & Retail' ? 'bg-blue-600 text-white' : 'bg-white/5 text-gray-300 hover:bg-white/10'"
                        class="px-4 py-2 rounded-xl text-xs font-bold transition-all cursor-pointer">
                    Commerce
                </button>
                <button @click="activeCategory = 'Legal Practice & Vault'" 
                        :class="activeCategory === 'Legal Practice & Vault' ? 'bg-blue-600 text-white' : 'bg-white/5 text-gray-300 hover:bg-white/10'"
                        class="px-4 py-2 rounded-xl text-xs font-bold transition-all cursor-pointer">
                    Legal
                </button>
            </div>

            <!-- Instant Search Input -->
            <div class="relative w-full sm:w-64 shrink-0">
                <input type="text" x-model="search" placeholder="Search product..." 
                       class="w-full bg-[#0B0F17] border border-white/10 text-white text-xs rounded-xl px-4 py-2.5 pl-9 focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-gray-500">
                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </div>

        <!-- All Products Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            @foreach($products as $product)
                <div x-show="(activeCategory === 'all' || activeCategory === '{{ $product['category'] }}') && ('{{ strtolower($product['name']) }}'.includes(search.toLowerCase()) || '{{ strtolower($product['desc']) }}'.includes(search.toLowerCase()))"
                     x-transition:enter="transition ease-out duration-300"
                     class="group relative rounded-3xl p-6 sm:p-8 bg-[#121A29]/70 border border-white/10 hover:border-blue-500/50 hover:bg-[#121A29] backdrop-blur-xl transition-all duration-300 flex flex-col justify-between">
                    
                    <div>
                        <!-- Top Header -->
                        <div class="flex items-center justify-between mb-6">
                            <div class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center text-2xl group-hover:scale-110 group-hover:bg-blue-600 transition-all duration-300">
                                {{ $product['icon'] }}
                            </div>
                            <span class="text-[11px] font-bold px-3 py-1 bg-blue-500/10 text-blue-300 rounded-full border border-blue-500/20">
                                {{ $product['pricing']['amount'] }}
                            </span>
                        </div>

                        <!-- Category Tag -->
                        <span class="text-xs font-semibold text-gray-300 uppercase tracking-wider block mb-1">
                            {{ $product['category'] }}
                        </span>

                        <!-- Product Title & Tagline -->
                        <h2 class="text-2xl font-black text-white tracking-tight group-hover:text-blue-400 transition-colors">
                            {{ $product['name'] }}
                        </h2>
                        <p class="text-sm font-semibold text-gray-200 mt-1">
                            {{ $product['tagline'] }}
                        </p>

                        <!-- Description -->
                        <p class="text-xs sm:text-sm text-gray-300 mt-3 leading-relaxed font-normal">
                            {{ $product['desc'] }}
                        </p>
                    </div>

                    <!-- Bottom Action Link -->
                    <div class="mt-8 pt-5 border-t border-white/10 flex items-center justify-between">
                        <a href="{{ $product['url'] }}" target="_blank" 
                           class="w-full inline-flex items-center justify-between text-sm font-bold text-white group-hover:text-blue-400 transition-colors py-1">
                            <span>Launch Application</span>
                            <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>

                </div>
            @endforeach
        </div>

    </main>

    <!-- Footer -->
    <x-landing.footer />

</body>
</html>
