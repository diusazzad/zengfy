<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Create Account - ZenGfy</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;700;900&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-50 text-gray-900 antialiased selection:bg-blue-200 selection:text-blue-900 px-4 sm:px-6 lg:px-8">

    <div class="max-w-md w-full space-y-8 bg-white p-8 sm:p-10 rounded-3xl shadow-xl border border-gray-100">
        
        <!-- Logo & Header -->
        <div class="text-center">
            <a href="/" class="inline-block mb-4 transition-transform hover:scale-105">
                <span class="text-3xl font-black tracking-tight text-blue-600">ZenGfy</span>
            </a>
            <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">
                Create your account
            </h2>
            <p class="mt-2 text-sm text-gray-500 font-medium">
                Fast, secure, and ready for your business.
            </p>
        </div>

        <!-- Register Form -->
        <form action="{{ route('register') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Name Input -->
            <div>
                <label for="name" class="block text-sm font-bold text-gray-700">Full Name</label>
                <div class="mt-1.5">
                    <input id="name" name="name" type="text" required value="{{ old('name') }}"
                        class="appearance-none block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition-colors"
                        placeholder="e.g. John Doe">
                </div>
                @error('name') <p class="mt-1 text-xs text-red-500 font-semibold">{{ $message }}</p> @enderror
            </div>

            <!-- Email Input -->
            <div>
                <label for="email" class="block text-sm font-bold text-gray-700">Email Address</label>
                <div class="mt-1.5">
                    <input id="email" name="email" type="email" required value="{{ old('email') }}"
                        class="appearance-none block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition-colors"
                        placeholder="you@example.com">
                </div>
                @error('email') <p class="mt-1 text-xs text-red-500 font-semibold">{{ $message }}</p> @enderror
            </div>

            <!-- Password Inputs (Grid for compact look) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="password" class="block text-sm font-bold text-gray-700">Password</label>
                    <div class="mt-1.5">
                        <input id="password" name="password" type="password" required
                            class="appearance-none block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition-colors"
                            placeholder="••••••••">
                    </div>
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-bold text-gray-700">Confirm</label>
                    <div class="mt-1.5">
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                            class="appearance-none block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition-colors"
                            placeholder="••••••••">
                    </div>
                </div>
                @error('password') <div class="col-span-1 sm:col-span-2"><p class="mt-1 text-xs text-red-500 font-semibold">{{ $message }}</p></div> @enderror
            </div>

            <!-- Register Button -->
            <div class="pt-3">
                <button type="submit"
                    class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-sm text-sm font-black text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600 active:scale-[0.98] transition-all">
                    Create Free Account
                </button>
            </div>
        </form>

        <!-- Footer / Login Link -->
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-500 font-medium">
                Already have an account? 
                <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:text-blue-700 hover:underline transition-colors">Log in</a>
            </p>
        </div>
    </div>

</body>
</html>
