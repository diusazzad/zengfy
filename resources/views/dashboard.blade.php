<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zengfy | Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">
    <header class="bg-white shadow-sm sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <a href="{{ route('welcome') }}" class="text-2xl font-bold text-blue-600">Zengfy</a>
                <span class="text-sm text-slate-500">Account Hub</span>
            </div>
            <nav class="hidden md:flex items-center gap-4 text-sm">
                <a href="{{ route('dashboard') }}" class="text-blue-600 font-semibold">Dashboard</a>
                <a href="{{ route('welcome') }}" class="hover:text-blue-600">Home</a>
                <a href="{{ route('team') }}" class="hover:text-blue-600">Team</a>
                <a href="{{ route('download.app') }}" class="hover:text-blue-600">Download App</a>
                <a href="{{ route('faq') }}" class="hover:text-blue-600">FAQ</a>
            </nav>
            <div class="flex items-center gap-3">
                <button class="px-4 py-2 rounded-lg border border-slate-200 text-sm hover:border-slate-300">Manage subscription</button>
                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-semibold">U</div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-10 space-y-10">
        <section class="grid lg:grid-cols-3 gap-6 items-start">
            <div class="lg:col-span-2 space-y-4">
                <p class="text-sm text-slate-500 uppercase tracking-[0.35em]">Welcome</p>
                <h1 class="text-3xl font-bold">One place for all your Zengfy services</h1>
                <p class="text-slate-600">Open your active services, explore new modules, and keep track of notifications and tasks across eCommerce, School ERP, POS, Legal, Hotel, and AI assistants.</p>
                <div class="flex flex-wrap gap-3">
                    <a href="https://ecommerce.zengfy.top" class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-500 transition">Go to store</a>
                    <a href="#" class="px-4 py-2 border border-slate-200 rounded-lg font-semibold text-slate-700 hover:border-slate-300 transition">Invite teammates</a>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 space-y-3">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold">Quick stats</h3>
                    <span class="text-xs text-emerald-600 bg-emerald-50 px-2 py-1 rounded">Live</span>
                </div>
                <div class="grid grid-cols-2 gap-3 text-sm">
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                        <p class="text-slate-500">Active services</p>
                        <p class="text-xl font-semibold">{{ collect($services)->where('status','!=','locked')->count() }}</p>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                        <p class="text-slate-500">Notifications</p>
                        <p class="text-xl font-semibold">{{ count($notifications) }}</p>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                        <p class="text-slate-500">Tasks</p>
                        <p class="text-xl font-semibold">{{ count($tasks) }}</p>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                        <p class="text-slate-500">Trials</p>
                        <p class="text-xl font-semibold">{{ collect($services)->where('status','trial')->count() }}</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-semibold">Services</h2>
                <a href="#" class="text-sm text-blue-600 hover:underline">Manage subscription</a>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($services as $service)
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 flex flex-col gap-3">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold">{{ $service['name'] }}</h3>
                            @if($service['status'] === 'active')
                                <span class="text-xs text-emerald-700 bg-emerald-50 px-2 py-1 rounded-full">Active</span>
                            @elseif($service['status'] === 'trial')
                                <span class="text-xs text-amber-700 bg-amber-50 px-2 py-1 rounded-full">Trial</span>
                            @else
                                <span class="text-xs text-slate-500 bg-slate-100 px-2 py-1 rounded-full">Locked</span>
                            @endif
                        </div>
                        <p class="text-sm text-slate-600">{{ $service['meta'] }}</p>
                        <a href="{{ $service['url'] }}" class="inline-flex items-center justify-center px-4 py-2 rounded-lg text-sm font-semibold
                            @if($service['status']==='active') bg-blue-600 text-white hover:bg-blue-500
                            @elseif($service['status']==='trial') bg-amber-500 text-white hover:bg-amber-400
                            @else border border-slate-200 text-slate-700 hover:border-slate-300 @endif transition">
                            {{ $service['cta'] }}
                        </a>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="grid lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-100 shadow-sm p-5 space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold">Notifications</h3>
                    <a href="#" class="text-sm text-blue-600 hover:underline">View all</a>
                </div>
                <div class="space-y-3">
                    @foreach ($notifications as $note)
                        <div class="p-3 rounded-xl border border-slate-100 bg-slate-50 flex flex-col gap-1">
                            <p class="font-medium text-slate-900">{{ $note['title'] }}</p>
                            <p class="text-xs text-slate-500">{{ $note['meta'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold">Tasks</h3>
                    <a href="#" class="text-sm text-blue-600 hover:underline">View all</a>
                </div>
                <div class="space-y-3">
                    @foreach ($tasks as $task)
                        <div class="p-3 rounded-xl border border-slate-100 bg-slate-50">
                            <p class="font-medium text-slate-900">{{ $task['label'] }}</p>
                            <p class="text-xs text-slate-500">Priority: {{ $task['priority'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold">Quick links</h3>
            </div>
            <div class="flex flex-wrap gap-3">
                @foreach ($quickLinks as $link)
                    <a href="{{ $link['url'] }}" class="px-4 py-2 rounded-lg border border-slate-200 text-sm font-semibold text-slate-700 hover:border-slate-300 transition">{{ $link['label'] }}</a>
                @endforeach
            </div>
        </section>
    </main>
</body>
</html>
