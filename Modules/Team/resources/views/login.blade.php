<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Team Login | Zengfy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 antialiased min-h-screen flex items-center justify-center p-6">
    <div class="max-w-md w-full">
        <div class="bg-white p-10 rounded-[2.5rem] shadow-xl border border-gray-100">
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 text-blue-600 rounded-2xl mb-6 text-2xl">
                    👥
                </div>
                <h1 class="text-3xl font-black text-gray-900 mb-2">Team Admin</h1>
                <p class="text-gray-500 font-medium">টিম ম্যানেজমেন্ট পোর্টালে লগইন করুন</p>
            </div>

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-100 text-red-600 rounded-2xl text-sm font-medium">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('team.login.submit') }}" class="space-y-6">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-bold text-gray-700 mb-2">ইমেইল অ্যাড্রেস</label>
                    <input type="email" name="email" id="email" required autofocus
                        class="w-full px-5 py-4 rounded-2xl border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all"
                        placeholder="admin@zengfy.top">
                </div>

                <div>
                    <label for="password" class="block text-sm font-bold text-gray-700 mb-2">পাসওয়ার্ড</label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-5 py-4 rounded-2xl border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all"
                        placeholder="••••••••">
                </div>

                <button type="submit"
                    class="w-full py-5 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-black text-lg shadow-lg shadow-blue-600/20 transition-all transform hover:scale-[1.02] active:scale-[0.98]">
                    লগইন করুন
                </button>
            </form>
        </div>
        
        <p class="text-center mt-8 text-gray-400 font-medium text-sm">
            &copy; {{ date('Y') }} Zengfy Ecosystem. All rights reserved.
        </p>
    </div>
</body>
</html>
