<!-- p:\Zengfy-Ecosystem\core\resources\views\components\landing\service-grid.blade.php -->
@props(['services' => []])

<section id="services" class="max-w-7xl mx-auto px-8 sm:px-10 py-20">
    <div class="text-center mb-16">
        <span
            class="text-blue-600 font-black tracking-widest uppercase text-[10px] sm:text-xs bg-blue-50 px-4 py-1.5 rounded-full">Our
            Ecosystem</span>
        <h2 class="text-2xl sm:text-3xl md:text-5xl font-black mt-4 mb-4 text-gray-900 leading-tight">Unified Services
            for Everything</h2>
        <p class="text-gray-500 text-base sm:text-xl max-w-2xl mx-auto font-medium">One account, all the tools you need
            to manage your life and business.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        @foreach($services as $service)
            <a href="{{ $service['url'] }}" class="block service-card group h-full">
                <div
                    class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-gray-100 h-full flex flex-col items-center justify-center relative overflow-hidden transition-all duration-500 hover:shadow-2xl hover:border-blue-200 hover:-translate-y-1">
                    <div class="relative mb-6">
                        <div
                            class="absolute inset-0 bg-blue-400 blur-2xl opacity-0 group-hover:opacity-20 transition-opacity duration-500">
                        </div>
                        <img src="{{ asset($service['img']) }}" alt="{{ $service['name'] }}"
                            class="h-20 sm:h-24 md:h-28 w-auto object-contain relative z-10 transition-transform duration-500 group-hover:scale-110">
                    </div>
                    <h3 class="font-black text-gray-900 text-lg sm:text-xl text-center">{{ $service['name'] }}</h3>
                    <p class="text-sm sm:text-base text-gray-500 mt-3 font-medium text-center leading-relaxed">
                        {{ $service['desc'] }}
                    </p>

                    <div
                        class="mt-6 flex items-center gap-1.5 text-blue-600 font-bold text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span>Learn More</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </div>
                </div>
            </a>
        @endforeach

        <div class="block service-card text-center h-full">
            <div
                class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border-2 border-dashed border-gray-200 h-full flex flex-col items-center justify-center relative overflow-hidden transition-all duration-300 hover:border-blue-300">
                <div
                    class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center text-3xl font-black text-blue-600 transition-transform group-hover:scale-110 mb-4">
                    +</div>
                <h3 class="font-black text-blue-600 text-lg sm:text-xl">Coming Soon</h3>
                <p class="text-xs sm:text-sm text-blue-400 mt-2 font-bold uppercase tracking-wider">Law, Skill, Journal
                </p>
            </div>
        </div>
    </div>
</section>