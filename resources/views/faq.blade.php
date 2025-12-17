<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>সচারাচর জিজ্ঞাসিত প্রশ্ন - Zengfy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Noto Sans Bengali', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 pb-20 md:pb-0">
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex items-center justify-between">
            <h1 class="text-3xl font-bold text-gray-900">FAQ</h1>
            <a href="{{ route('welcome') }}" class="text-blue-600 hover:text-blue-800 font-medium">হোম</a>
        </div>
    </header>
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        @if(session('success'))
        <div class="px-4 mb-6">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm" role="alert">
                <p class="font-bold">সফল!</p>
                <p>{{ session('success') }}</p>
            </div>
        </div>
        @endif
        <div class="px-4 py-6 sm:px-0 grid gap-8 lg:grid-cols-2">
            <!-- FAQ Accordions -->
            <div class="space-y-4">
                <details class="bg-white p-6 rounded-lg shadow cursor-pointer group">
                    <summary class="font-bold text-lg list-none flex justify-between items-center text-gray-800">
                        Zengfy কি ফ্রি ব্যবহার করা যায়?
                        <span class="transition group-open:rotate-180">
                            <svg fill="none" class="w-5 h-5" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </span>
                    </summary>
                    <p class="mt-4 text-gray-600 leading-relaxed">হ্যাঁ, আমরা একটি ফ্রি টায়ার অফার করি যা ছোট ব্যবসার
                        জন্য উপযুক্ত। আপনি কোনো ক্রেডিট কার্ড ছাড়াই শুরু করতে পারবেন।</p>
                </details>

                <details class="bg-white p-6 rounded-lg shadow cursor-pointer group">
                    <summary class="font-bold text-lg list-none flex justify-between items-center text-gray-800">
                        আমি কি পরে প্যাকেজ আপগ্রেড করতে পারি?
                        <span class="transition group-open:rotate-180">
                            <svg fill="none" class="w-5 h-5" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </span>
                    </summary>
                    <p class="mt-4 text-gray-600 leading-relaxed">অবশ্যই! আপনি যেকোনো সময় আপনার ড্যাশবোর্ড থেকে প্ল্যান
                        আপগ্রেড করতে পারেন। আমাদের সাপোর্ট টিম আপনাকে সাহায্য করবে।</p>
                </details>

                <details class="bg-white p-6 rounded-lg shadow cursor-pointer group">
                    <summary class="font-bold text-lg list-none flex justify-between items-center text-gray-800">
                        সাপোর্ট কিভাবে পাবো?
                        <span class="transition group-open:rotate-180">
                            <svg fill="none" class="w-5 h-5" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </span>
                    </summary>
                    <p class="mt-4 text-gray-600 leading-relaxed">আমরা ২৪/৭ সাপোর্ট প্রদান করি। আমাদের সাথে ইমেইল, ফোন
                        বা লাইভ চ্যাটের মাধ্যমে যোগাযোগ করতে পারেন।</p>
                </details>
            </div>

            <!-- Ask a Question Form -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">অন্য কোনো প্রশ্ন আছে?</h2>
                <form action="{{ route('faq.submit') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">আপনার নাম</label>
                        <input type="text" name="name" id="name" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                            placeholder="Abida Sultana">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">ইমেইল</label>
                        <input type="email" name="email" id="email" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                            placeholder="you@example.com">
                    </div>
                    <div>
                        <label for="question" class="block text-sm font-medium text-gray-700 mb-1">প্রশ্ন</label>
                        <textarea name="question" id="question" rows="4" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                            placeholder="কিভাবে পেমেন্ট গেটওয়ে সেটআপ করব?"></textarea>
                    </div>
                    <button type="submit"
                        class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-700 transition transform active:scale-95 shadow-lg shadow-blue-500/30">
                        প্রশ্ন জমা দিন
                    </button>
                    <p class="text-xs text-gray-500 text-center mt-4">আমরা সাধারণত ২৪ ঘন্টার মধ্যে উত্তর দিয়ে থাকি।</p>
                </form>
            </div>
        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('welcome') }}"
                class="text-blue-600 hover:underline inline-flex items-center gap-2 font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                হোমে ফিরে যান
            </a>
        </div>
    </main>
    <x-mobile-nav />
</body>

</html>