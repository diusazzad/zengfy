<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Zengfy Social | সার্বভৌম সিটিজেন সোশ্যাল প্ল্যাটফর্ম</title>
    <meta name="description" content="Clean, sovereign social network for verified citizens. Hyperlocal feeds, world updates, and civic identity.">
    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    <!-- Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Vite Assets (React 19 Fast Refresh + Tailwind CSS) -->
    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/react/main.jsx'])
</head>
<body class="bg-[#F0F2F5] text-slate-900 antialiased min-h-screen">
    @php
        $userData = $currentUser ? [
            'id' => $currentUser->id,
            'name' => $currentUser->name,
            'email' => $currentUser->email,
            'handle' => $currentUser->handle ?? 'citizen',
            'avatar_url' => $currentUser->avatar_url,
            'bio' => $currentUser->bio ?? 'সার্বভৌম ডিজিটাল বাংলাদেশ বিনির্মাণে একজন প্রত্যয়ী নাগরিক | Tech Entrepreneur & Civic Builder',
            'city' => $currentUser->city ?? 'ঢাকা, বাংলাদেশ',
            'ward_code' => $currentUser->ward_code ?? 'WARD-19',
            'nid_verified' => (bool) ($currentUser->nid_verified ?? false),
        ] : null;
    @endphp

    <div id="react-feed-root" 
         data-user="{{ json_encode($userData, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) }}">
        <main role="main" class="min-h-screen flex items-center justify-center">
            <div class="flex items-center gap-2 text-slate-400 font-bold text-sm">
                <span class="w-3 h-3 rounded-full bg-blue-600 animate-ping"></span>
                <span>Zengfy Social লোড হচ্ছে...</span>
            </div>
        </main>
    </div>
</body>
</html>
