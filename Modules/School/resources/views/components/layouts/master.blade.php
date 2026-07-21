<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zengfy School Management</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased selection:bg-blue-200">

    <!-- Navbar -->
    <nav class="flex justify-between items-center px-8 py-6 max-w-7xl mx-auto">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-xs">Z</div>
            <span class="text-2xl font-black text-gray-900 tracking-tighter">zengfy<span class="text-blue-600">school</span></span>
        </div>
        <div>
            <a href="{{ route('school.request') }}" class="bg-gray-900 text-white px-6 py-2.5 rounded-full font-bold hover:bg-black transition shadow-lg">Request Access</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="max-w-7xl mx-auto px-8 pt-20 pb-16 text-center">
        <div class="inline-flex items-center gap-2 bg-blue-50 text-blue-700 px-4 py-1.5 rounded-full text-sm font-bold mb-8 border border-blue-100">
            <span class="relative flex h-2 w-2">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
              <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
            </span>
            NID-Verified Digital Ecosystem 🇧🇩
        </div>

        <h1 class="text-5xl md:text-7xl font-extrabold mb-6 tracking-tight leading-tight">
            The Operating System for <br><span class="text-blue-600">Modern Schools.</span>
        </h1>

        <p class="text-xl text-gray-500 mb-10 max-w-2xl mx-auto leading-relaxed">
            Manage attendance, results, fees, and connect directly with parents in one unified, secure platform built for Bangladesh.
        </p>

        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('school.request') }}" class="bg-blue-600 text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-blue-700 transition shadow-xl shadow-blue-200">Join the Waitlist</a>
            <a href="#" class="bg-white text-gray-900 border border-gray-200 px-8 py-4 rounded-full font-bold text-lg hover:bg-gray-50 transition shadow-sm">Watch Demo</a>
        </div>
    </main>

    <!-- Bento Grid Features Section -->
    <section class="max-w-7xl mx-auto px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Feature 1 (Large) -->
            <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 md:col-span-2 hover:shadow-md transition duration-300">
                <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h3 class="text-3xl font-bold mb-4">Parent-Teacher Network</h3>
                <p class="text-gray-500 text-lg">Directly connect with NID-verified parents. Share results, daily attendance, and notices instantly through the Zengfy app. No more lost diaries.</p>
            </div>

            <!-- Feature 2 (Small Highlight) -->
            <div class="bg-gray-900 text-white p-8 rounded-[2rem] shadow-xl hover:-translate-y-1 transition duration-300">
                <div class="w-14 h-14 bg-gray-800 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-7 h-7 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold mb-4">Automated Fees</h3>
                <p class="text-gray-400">bKash & Nagad integration. Collect fees automatically with zero manual entry.</p>
            </div>

        </div>
    </section>

</body>
</html>
