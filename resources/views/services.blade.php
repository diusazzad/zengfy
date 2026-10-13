@extends('layouts.app')
@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">
                Explore All Zengfy Services
            </h1>
            <p class="mt-4 text-xl text-gray-500 dark:text-gray-400">
                Tailored solutions for local businesses, schools, and legal professionals.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($services as $service)
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition duration-300 border border-gray-100 dark:border-gray-700">
                    <div class="p-8">
                        <div class="flex items-center justify-between mb-4">
                            <span class="inline-flex items-center justify-center p-3 bg-blue-600 rounded-xl shadow-lg shadow-blue-500/20 text-white text-2xl">
                                @switch($service['name'])
                                    @case('Ecommerce') 🛒 @break
                                    @case('School ERP') 🏫 @break
                                    @case('POS') 🛍️ @break
                                    @case('Law') ⚖️ @break
                                    @case('Legal') ⚖️ @break
                                    @case('Hotel') 🏨 @break
                                    @case('Skill') 🎓 @break
                                    @case('Journal') 📓 @break
                                    @case('AI Assistant') ⚡ @break
                                    @default ⚙️
                                @endswitch
                            </span>
                            <span class="px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-full {{ $service['status'] === 'active' ? 'bg-green-100 text-green-700' : ($service['status'] === 'trial' ? 'bg-amber-100 text-amber-700' : 'bg-gray-100 text-gray-600') }}">
                                {{ $service['status'] }}
                            </span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $service['name'] }}</h3>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{ $service['meta'] }}</p>
                        <div class="mt-6">
                            <a href="{{ $service['url'] }}" class="inline-flex items-center justify-center w-full px-5 py-3 border border-transparent text-base font-bold rounded-xl text-white bg-blue-600 hover:bg-blue-700 transition duration-200 shadow-md hover:shadow-lg">
                                {{ $service['cta'] }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-16 bg-blue-600 rounded-3xl p-8 md:p-12 text-center text-white shadow-2xl overflow-hidden relative">
            <div class="relative z-10">
                <h2 class="text-3xl font-bold mb-4">Need a Custom Solution?</h2>
                <p class="text-blue-100 text-lg max-w-2xl mx-auto mb-8">
                    We help local businesses scale with tailor-made digital ecosystems. Contact our team to discuss your specific requirements.
                </p>
                <a href="{{ route('faq') }}" class="inline-flex items-center justify-center px-8 py-4 border-2 border-white text-lg font-bold rounded-2xl text-white hover:bg-white hover:text-blue-600 transition duration-300">
                    Get in Touch
                </a>
            </div>
            <!-- Decorative circle -->
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-blue-500 rounded-full opacity-20"></div>
            <div class="absolute -bottom-12 -left-12 w-48 h-48 bg-blue-700 rounded-full opacity-30"></div>
        </div>
    </div>
@endsection
