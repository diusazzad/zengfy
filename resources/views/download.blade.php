<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>অ্যাপ ডাউনলোড - Zengfy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Noto Sans Bengali', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 h-screen flex flex-col items-center justify-center pb-16 md:pb-0">
    <div class="bg-white p-8 rounded-lg shadow-lg text-center max-w-md w-full">
        <div
            class="w-16 h-16 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-2xl mx-auto mb-6">
            Z</div>
        <h1 class="text-2xl font-bold mb-4">Zengfy অ্যাপ ডাউনলোড করুন</h1>
        <p class="text-gray-600 mb-8">Play Store বা App Store থেকে আমাদের অ্যাপ নামিয়ে আপনার ব্যবসা পরিচালনা করুন হাতের
            মুঠোয়।</p>

        <div class="space-y-4">
            <button
                class="w-full bg-gray-900 text-white py-3 px-4 rounded-lg flex items-center justify-center gap-2 hover:bg-gray-800 transition">
                <span>Google Play</span>
            </button>
            <button
                class="w-full bg-gray-900 text-white py-3 px-4 rounded-lg flex items-center justify-center gap-2 hover:bg-gray-800 transition">
                <span>App Store</span>
            </button>
        </div>

        <div class="mt-8">
            <a href="{{ route('welcome') }}" class="text-blue-600 hover:underline">হোমে ফিরে যান</a>
        </div>
    </div>
    <x-mobile-nav />
</body>

</html>