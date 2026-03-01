<!-- p:\Zengfy-Ecosystem\core\resources\views\components\landing\cta.blade.php -->
<section class="bg-gray-900 text-white py-24 relative overflow-hidden">
    <div
        class="absolute inset-0 bg-blue-600 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]">
    </div>
    <div class="max-w-4xl mx-auto px-6 sm:px-6 text-center relative z-10">
        <h2 class="text-3xl sm:text-4xl md:text-5xl font-black mb-8 leading-tight">
            {{ __('welcome.cta_footer.title') }}
        </h2>
        <p class="text-lg sm:text-xl text-gray-300 mb-12 font-medium leading-relaxed">
            {{ __('welcome.cta_footer.subtitle') }}
        </p>
        <div class="flex justify-center">
            <a href="#"
                class="px-10 py-5 bg-blue-600 text-white rounded-xl font-black text-lg hover:bg-blue-700 transition shadow-2xl shadow-blue-600/30 active:scale-95 w-full sm:w-auto">
                {{ __('welcome.cta_footer.btn_free') }}
            </a>
        </div>
    </div>
</section>