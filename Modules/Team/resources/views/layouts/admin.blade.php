<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Team Admin') - Zengfy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); }
    </style>
</head>
<body class="h-full text-gray-900">
    <div class="min-h-full">
        <!-- Main Navigation -->
        <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center gap-2">
                            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white font-black">T</div>
                            <span class="text-xl font-black tracking-tight">Team<span class="text-blue-600">Admin</span></span>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="hidden md:block text-right">
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Logged in as</p>
                            <p class="text-sm font-black text-gray-900">{{ Auth::guard('team')->user()->name }}</p>
                        </div>
                        <form action="{{ route('team.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="p-2 text-gray-400 hover:text-red-600 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Content Area -->
        <main class="py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @if(session('success'))
                    <div class="mb-8 p-4 bg-green-50 border border-green-100 rounded-2xl text-green-700 text-sm font-bold flex items-center gap-3">
                        <span class="w-6 h-6 rounded-full bg-green-200 flex items-center justify-center text-[10px]">✓</span>
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-8 p-4 bg-red-50 border border-red-100 rounded-2xl text-red-700 text-sm font-bold">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
