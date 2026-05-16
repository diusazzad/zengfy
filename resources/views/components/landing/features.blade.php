<!-- p:\Zengfy-Ecosystem\core\resources\views\components\landing\features.blade.php -->
@props(['features' => []])

<section class="bg-blue-50 py-24 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 sm:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl md:text-5xl font-black text-gray-900 mb-6 leading-tight">
                {{ __('welcome.features.title') }}
            </h2>
            <p class="text-gray-500 text-lg sm:text-xl max-w-2xl mx-auto font-medium lead-relaxed">
                {{ __('welcome.features.subtitle') }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 sm:gap-10">
            @foreach($features as $feature)
                <div
                    class="bg-white p-8 sm:p-10 rounded-3xl shadow-sm border border-blue-100 hover:shadow-2xl transition-all duration-500 group"
                    data-aos="fade-up"
                    data-aos-delay="{{ $loop->index * 150 }}">
                    <div
                        class="w-16 h-16 {{ $feature['bg'] }} rounded-2xl flex items-center justify-center text-4xl mb-8 group-hover:scale-110 transition-transform duration-500">
                        {{ $feature['icon'] }}
                    </div>
                    <h3 class="text-2xl font-black mb-4 text-gray-900">{{ $feature['title'] }}</h3>
                    <p class="text-gray-500 leading-relaxed font-medium">
                        {{ $feature['desc'] }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>