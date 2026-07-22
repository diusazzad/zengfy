<!-- resources/views/components/landing/bento-grid.blade.php -->
@props(['services' => []])

<section id="ecosystem" class="relative py-28 bg-[#0B0F17] overflow-hidden">

    <!-- Ambient Lighting -->
    <div class="absolute top-1/2 right-0 w-[400px] h-[400px] bg-blue-600/10 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">

        <div class="text-center mb-16">
            <span class="text-blue-400 font-extrabold tracking-widest uppercase text-xs bg-blue-500/10 border border-blue-500/20 px-4 py-1.5 rounded-full">
                Unified Ecosystem Suite
            </span>
            <h2 class="text-3xl sm:text-5xl font-black mt-4 text-white tracking-tight">
                One Account. Endless Operating Systems.
            </h2>
            <p class="text-gray-400 text-lg sm:text-xl max-w-2xl mx-auto font-normal mt-3">
                Access specialized operating systems for every aspect of your life and business with one single login.
            </p>
        </div>

        <!-- Bento Grid Container -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">

            @foreach($services as $index => $service)
                @php
                    // ২ নম্বর (School) এবং ৪ নম্বর (Law) সার্ভিসকে বড় (Featured) Bento Box বানানো
                    $isFeatured = ($index === 1 || $index === 3);
                @endphp

                <div class="{{ $isFeatured ? 'md:col-span-2 lg:col-span-2' : 'col-span-1' }} group relative rounded-3xl p-8 bg-[#121A29]/60 border border-white/10 hover:border-blue-500/40 hover:bg-[#121A29]/90 backdrop-blur-xl shadow-xl transition-all duration-500 flex flex-col justify-between overflow-hidden">

                    <!-- Hover Glow Effect inside Card -->
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 via-transparent to-indigo-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>

                    <div>
                        <!-- Header inside Card -->
                        <div class="flex items-center justify-between mb-6">
                            <div class="w-14 h-14 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center group-hover:scale-110 group-hover:bg-blue-600 transition-all duration-300 shadow-inner">
                                <img src="{{ asset($service['img']) }}" alt="{{ $service['name'] }}" class="h-8 w-8 object-contain">
                            </div>
                            <span class="text-[11px] font-bold px-3 py-1 bg-white/5 text-gray-400 rounded-full border border-white/5 group-hover:bg-blue-500/20 group-hover:text-blue-300 transition-colors">
                                Active Suite
                            </span>
                        </div>

                        <!-- Title & Description -->
                        <h3 class="text-2xl font-black text-white tracking-tight group-hover:text-blue-400 transition-colors">
                            {{ $service['name'] }}
                        </h3>
                        <p class="text-gray-400 font-normal text-sm sm:text-base mt-2 leading-relaxed">
                            {{ $service['desc'] }}
                        </p>
                    </div>

                    <!-- Action Link -->
                    <div class="mt-8 pt-4 border-t border-white/10 flex items-center justify-between">
                        <a href="{{ $service['url'] }}" target="_blank" class="inline-flex items-center gap-2 text-sm font-bold text-gray-300 group-hover:text-blue-400 transition-colors">
                            <span>Launch {{ $service['name'] }}</span>
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach

        </div>

    </div>
</section>
