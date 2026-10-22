<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#F8FAFD]">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Zengfy অ্যাকাউন্ট | Sovereign Identity Hub</title>
    <meta name="description" content="Manage your unified Zengfy Sovereign Account, profile info, 2FA security, and connected ecosystem apps.">

    <!-- Fonts: Plus Jakarta Sans & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'monospace'],
                    },
                    colors: {
                        google: {
                            blue: '#1A73E8',
                            blueHover: '#1557B0',
                            grayBg: '#F8FAFD',
                            border: '#E2E8F0',
                            text: '#202124',
                            textMuted: '#5F6368',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #F8FAFD;
            color: #202124;
        }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #F1F3F4; }
        ::-webkit-scrollbar-thumb { background: #DADCE0; border-radius: 9999px; }
        #react-account-root:not(:empty) + #blade-account-fallback {
            display: none !important;
        }
    </style>

    @vite(['resources/js/react/main.jsx'])
</head>

<body class="min-h-screen bg-[#F8FAFD] text-[#202124] antialiased flex flex-col justify-between selection:bg-blue-600 selection:text-white"
      x-data="{
          activeTab: 'home', // 'home', 'personal_info', 'security', 'privacy', 'devices'
          appSwitcherOpen: false,
          profileMenuOpen: false,
          avatarUploading: false,
          avatarMessage: '',
          avatarPreview: '{{ $user->avatar_url }}',
          twoFactorEnabled: {{ ($settings->two_factor_enabled ?? false) ? 'true' : 'false' }},
          twoFactorLoading: false,

          async toggle2FA() {
              if (this.twoFactorLoading) return;
              this.twoFactorLoading = true;
              try {
                  const res = await fetch('{{ route('account.2fa.toggle') }}', {
                      method: 'POST',
                      headers: {
                          'Content-Type': 'application/json',
                          'Accept': 'application/json',
                          'X-CSRF-TOKEN': '{{ csrf_token() }}'
                      }
                  });
                  const data = await res.json();
                  if (res.ok && data.success) {
                      this.twoFactorEnabled = data.two_factor_enabled;
                      alert(data.message);
                  } else {
                      alert(data.message || '2FA আপডেট করা সম্ভব হয়নি।');
                  }
              } catch (e) {
                  alert('নেটওয়ার্ক সমস্যার কারণে 2FA আপডেট করা যায়নি।');
              } finally {
                  this.twoFactorLoading = false;
              }
          },

          async uploadAvatar(event) {
              const file = event.target.files[0];
              if (!file) return;

              this.avatarPreview = URL.createObjectURL(file);
              this.avatarUploading = true;
              this.avatarMessage = 'আপলোড হচ্ছে...';

              const formData = new FormData();
              formData.append('avatar', file);
              formData.append('_token', '{{ csrf_token() }}');

              try {
                  const res = await fetch('{{ route('account.avatar') }}', {
                      method: 'POST',
                      headers: { 'Accept': 'application/json' },
                      body: formData
                  });
                  const data = await res.json();
                  if (res.ok && data.success) {
                      this.avatarPreview = data.avatar_url;
                      this.avatarMessage = 'প্রোফাইল ছবি সফলভাবে আপডেট হয়েছে!';
                      setTimeout(() => window.location.reload(), 600);
                  } else {
                      alert(data.message || 'ছবি আপলোড ব্যর্থ হয়েছে।');
                      this.avatarMessage = '';
                  }
              } catch (err) {
                  alert('নেটওয়ার্ক সমস্যার কারণে ছবি আপলোড করা সম্ভব হয়নি।');
                  this.avatarMessage = '';
              } finally {
                  this.avatarUploading = false;
              }
          }
      }">

    <!-- React Island Mount Root (Hydrates when JS bundles load) -->
    <div id="react-account-root"
         data-user='@json($userData ?? [])'
         data-devices='@json($activeDevices ?? [])'
         data-apps='@json($ecosystemApps ?? [])'
         data-settings='@json($settings ?? [])'
         data-billing='@json($billingData ?? [])'></div>

    <!-- Blade Server-Rendered Shell (Instant First Paint & SEO) -->
    <div id="blade-account-fallback" class="min-h-screen flex flex-col justify-between">

        <!-- ========================================================================= -->
        <!-- GOOGLE STYLE TOP HEADER                                                   -->
        <!-- ========================================================================= -->
        <header class="sticky top-0 z-40 bg-white border-b border-slate-200/90 shadow-2xs px-4 sm:px-6 py-2.5 flex items-center justify-between">
            <!-- Left: Logo & Title -->
            <div class="flex items-center gap-3">
                <a href="{{ route('accounts.home') }}" class="flex items-center gap-2.5 group focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 rounded-lg p-1">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-blue-600 via-indigo-600 to-cyan-500 flex items-center justify-center text-white shadow-sm shadow-blue-500/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div class="flex items-baseline gap-1.5">
                        <span class="text-lg font-extrabold text-slate-900 tracking-tight">Zengfy</span>
                        <span class="text-sm font-medium text-slate-500">অ্যাকাউন্ট</span>
                    </div>
                </a>
            </div>

            <!-- Middle: Google-style Search Bar (Desktop) -->
            <div class="hidden md:flex flex-1 max-w-xl mx-8">
                <div class="w-full relative flex items-center">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        placeholder="Zengfy অ্যাকাউন্ট ও নিরাপত্তা সেটিংস খুঁজুন..." 
                        class="w-full pl-10 pr-4 py-2 bg-slate-100/80 hover:bg-slate-200/60 focus:bg-white text-slate-900 placeholder-slate-400 text-xs sm:text-sm rounded-full border border-transparent focus:border-blue-400 focus:shadow-sm focus:outline-none transition-all"
                    />
                </div>
            </div>

            <!-- Right: Support, 9-Dot App Switcher & Profile Avatar Menu -->
            <div class="flex items-center gap-1.5 sm:gap-2">
                <!-- Support FAQ -->
                <a href="{{ route('faq') }}" title="সাহায্য ও সাপোর্ট" class="p-2 rounded-full hover:bg-slate-100 text-slate-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </a>

                <!-- ========================================================================= -->
                <!-- 9-DOT GOOGLE STYLE APP LAUNCHER                                           -->
                <!-- ========================================================================= -->
                <div class="relative" @click.outside="appSwitcherOpen = false">
                    <button 
                        type="button" 
                        @click="appSwitcherOpen = !appSwitcherOpen" 
                        title="Zengfy ইকোসিস্টেম অ্যাপসমূহ"
                        class="p-2 rounded-full hover:bg-slate-100 text-slate-700 transition-colors cursor-pointer focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500"
                        :class="appSwitcherOpen ? 'bg-slate-100 text-blue-600' : ''">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <!-- 9 rounded dots in 3x3 grid -->
                            <circle cx="5" cy="5" r="2" />
                            <circle cx="12" cy="5" r="2" />
                            <circle cx="19" cy="5" r="2" />
                            <circle cx="5" cy="12" r="2" />
                            <circle cx="12" cy="12" r="2" />
                            <circle cx="19" cy="12" r="2" />
                            <circle cx="5" cy="19" r="2" />
                            <circle cx="12" cy="19" r="2" />
                            <circle cx="19" cy="19" r="2" />
                        </svg>
                    </button>

                    <!-- Google-style Apps Drawer Dropdown -->
                    <div x-show="appSwitcherOpen" x-cloak
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                         x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                         class="absolute right-0 mt-2 w-80 sm:w-96 rounded-3xl bg-white border border-slate-200/90 shadow-2xl p-4 z-50 overflow-hidden">
                        
                        <div class="flex items-center justify-between pb-3 mb-2 border-b border-slate-100 px-2">
                            <span class="text-xs font-bold text-slate-800 uppercase tracking-wider">Zengfy ইকোসিস্টেম</span>
                            <span class="text-[10px] bg-blue-50 text-blue-700 font-bold px-2 py-0.5 rounded-full">১৫টি মডিউল</span>
                        </div>

                        <!-- 3-Column Apps Grid -->
                        <div class="grid grid-cols-3 gap-2 max-h-[380px] overflow-y-auto pr-1">
                            @foreach($ecosystemApps as $app)
                                <a href="{{ $app['url'] }}" 
                                   class="flex flex-col items-center text-center p-2.5 rounded-2xl hover:bg-slate-50 transition-all group">
                                    <div class="w-11 h-11 rounded-2xl {{ $app['icon_bg'] ?? 'bg-blue-50 text-blue-600' }} flex items-center justify-center text-xl mb-1.5 shadow-2xs group-hover:scale-105 transition-transform">
                                        @if($app['id'] === 'social') 🌐
                                        @elseif($app['id'] === 'school') 🎓
                                        @elseif($app['id'] === 'law') ⚖️
                                        @elseif($app['id'] === 'pos') 🛒
                                        @elseif($app['id'] === 'civil') 🏗️
                                        @elseif($app['id'] === 'ecommerce') 🛍️
                                        @elseif($app['id'] === 'hotel') 🏨
                                        @elseif($app['id'] === 'rent') 🏠
                                        @elseif($app['id'] === 'ngo') 🤝
                                        @elseif($app['id'] === 'mobile') 📱
                                        @else ⚡
                                        @endif
                                    </div>
                                    <span class="text-xs font-semibold text-slate-800 group-hover:text-blue-600 truncate max-w-full leading-tight">{{ $app['name'] }}</span>
                                    <span class="text-[10px] text-slate-400 truncate max-w-full mt-0.5">{{ $app['category'] }}</span>
                                </a>
                            @endforeach
                        </div>

                        <div class="pt-3 mt-2 border-t border-slate-100 text-center">
                            <a href="{{ $homeUrl ?? 'http://zengfy.top:8000/' }}" class="text-xs font-semibold text-blue-600 hover:underline">
                                সকল সার্ভিস এক্সপ্লোর করুন &rarr;
                            </a>
                        </div>
                    </div>
                </div>

                <!-- ========================================================================= -->
                <!-- GOOGLE STYLE PROFILE MENU                                                 -->
                <!-- ========================================================================= -->
                <div class="relative" @click.outside="profileMenuOpen = false">
                    <button 
                        type="button" 
                        @click="profileMenuOpen = !profileMenuOpen" 
                        class="flex items-center gap-2 p-1 rounded-full hover:ring-4 hover:ring-slate-100 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 cursor-pointer">
                        <template x-if="avatarPreview">
                            <img :src="avatarPreview" alt="{{ $user->name }}" class="w-8 h-8 rounded-full object-cover ring-2 ring-blue-500/30">
                        </template>
                        <template x-if="!avatarPreview">
                            <div class="w-8 h-8 rounded-full bg-blue-600 text-white font-bold text-xs flex items-center justify-center ring-2 ring-blue-500/20">
                                {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                            </div>
                        </template>
                    </button>

                    <!-- Google Profile Dropdown Card -->
                    <div x-show="profileMenuOpen" x-cloak
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                         x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                         class="absolute right-0 mt-2 w-80 rounded-3xl bg-white border border-slate-200/90 shadow-2xl p-5 z-50 text-center">
                        
                        <p class="text-[11px] font-semibold text-slate-400 mb-3">{{ $user->email }}</p>

                        <!-- Centered Big Avatar with Upload Button -->
                        <div class="relative inline-block mx-auto mb-3">
                            <template x-if="avatarPreview">
                                <img :src="avatarPreview" alt="{{ $user->name }}" class="w-18 h-18 rounded-full object-cover mx-auto ring-4 ring-slate-100">
                            </template>
                            <template x-if="!avatarPreview">
                                <div class="w-18 h-18 rounded-full bg-blue-600 text-white font-extrabold text-2xl flex items-center justify-center mx-auto ring-4 ring-slate-100">
                                    {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                                </div>
                            </template>
                            <label for="header-avatar-input" title="ছবি পরিবর্তন করুন" class="absolute bottom-0 right-0 w-6 h-6 rounded-full bg-white border border-slate-200 text-slate-600 hover:text-blue-600 shadow-xs flex items-center justify-center cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </label>
                            <input type="file" id="header-avatar-input" accept="image/*" class="hidden" @change="uploadAvatar($event)">
                        </div>

                        <h3 class="text-base font-bold text-slate-900">{{ $user->name }}</h3>
                        <p class="text-xs text-slate-500 mb-4">{{ '@' . ($user->handle ?? 'sovereign_citizen') }}</p>

                        <!-- Manage Account Button -->
                        <button 
                            type="button" 
                            @click="activeTab = 'personal_info'; profileMenuOpen = false"
                            class="w-full py-2.5 px-4 rounded-full border border-slate-300 hover:bg-slate-50 text-slate-800 text-xs font-semibold transition-all shadow-2xs mb-4">
                            Zengfy অ্যাকাউন্ট ম্যানেজ করুন
                        </button>

                        <div class="border-t border-slate-100 pt-3">
                            <form action="{{ route('logout') }}" method="POST" @submit="localStorage.removeItem('zengfy_token')">
                                @csrf
                                <button type="submit" class="w-full py-2 px-4 rounded-xl text-rose-600 hover:bg-rose-50 text-xs font-semibold transition-colors flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    <span>অ্যাকাউন্ট থেকে লগআউট</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- ========================================================================= -->
        <!-- MAIN CONTENT WITH GOOGLE STYLE SIDEBAR & CARDS                            -->
        <!-- ========================================================================= -->
        <div class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 flex flex-col md:flex-row gap-6 lg:gap-8">
            
            <!-- Google Style Left Navigation Bar -->
            <nav class="w-full md:w-64 shrink-0 space-y-1">
                <button 
                    type="button" 
                    @click="activeTab = 'home'" 
                    class="w-full flex items-center gap-3.5 px-4 py-3 rounded-2xl text-xs sm:text-sm font-semibold transition-all text-left cursor-pointer"
                    :class="activeTab === 'home' ? 'bg-blue-50 text-blue-700 font-bold' : 'text-slate-600 hover:bg-slate-100/80'">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>হোম (Home)</span>
                </button>

                <button 
                    type="button" 
                    @click="activeTab = 'personal_info'" 
                    class="w-full flex items-center gap-3.5 px-4 py-3 rounded-2xl text-xs sm:text-sm font-semibold transition-all text-left cursor-pointer"
                    :class="activeTab === 'personal_info' ? 'bg-blue-50 text-blue-700 font-bold' : 'text-slate-600 hover:bg-slate-100/80'">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    <span>ব্যক্তিগত তথ্য (Personal info)</span>
                </button>

                <button 
                    type="button" 
                    @click="activeTab = 'security'" 
                    class="w-full flex items-center gap-3.5 px-4 py-3 rounded-2xl text-xs sm:text-sm font-semibold transition-all text-left cursor-pointer"
                    :class="activeTab === 'security' ? 'bg-blue-50 text-blue-700 font-bold' : 'text-slate-600 hover:bg-slate-100/80'">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    <span>নিরাপত্তা ও ২FA (Security)</span>
                </button>

                <button 
                    type="button" 
                    @click="activeTab = 'privacy'" 
                    class="w-full flex items-center gap-3.5 px-4 py-3 rounded-2xl text-xs sm:text-sm font-semibold transition-all text-left cursor-pointer"
                    :class="activeTab === 'privacy' ? 'bg-blue-50 text-blue-700 font-bold' : 'text-slate-600 hover:bg-slate-100/80'">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    <span>তথ্য ও গোপনীয়তা (Data & privacy)</span>
                </button>

                <button 
                    type="button" 
                    @click="activeTab = 'devices'" 
                    class="w-full flex items-center gap-3.5 px-4 py-3 rounded-2xl text-xs sm:text-sm font-semibold transition-all text-left cursor-pointer"
                    :class="activeTab === 'devices' ? 'bg-blue-50 text-blue-700 font-bold' : 'text-slate-600 hover:bg-slate-100/80'">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <span>ডিভাইস ও সেশন (Devices)</span>
                </button>

                <button 
                    type="button" 
                    @click="activeTab = 'billing'" 
                    class="w-full flex items-center gap-3.5 px-4 py-3 rounded-2xl text-xs sm:text-sm font-semibold transition-all text-left cursor-pointer"
                    :class="activeTab === 'billing' ? 'bg-blue-50 text-blue-700 font-bold' : 'text-slate-600 hover:bg-slate-100/80'">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                    <span>পেমেন্ট ও সাবস্ক্রিপশন (Billing)</span>
                </button>
            </nav>

            <!-- Main Content Display -->
            <main class="flex-1 min-w-0">

                <!-- ========================================================================= -->
                <!-- TAB 1: HOME (Google "Manage your Google Account" look)                    -->
                <!-- ========================================================================= -->
                <div x-show="activeTab === 'home'" x-transition class="space-y-6">

                    <!-- Centered Welcome Header -->
                    <div class="text-center py-4">
                        <div class="relative inline-block mb-3">
                            <template x-if="avatarPreview">
                                <img :src="avatarPreview" alt="{{ $user->name }}" class="w-20 h-20 sm:w-24 sm:h-24 rounded-full object-cover ring-4 ring-white shadow-md mx-auto">
                            </template>
                            <template x-if="!avatarPreview">
                                <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full bg-blue-600 text-white font-black text-3xl flex items-center justify-center ring-4 ring-white shadow-md mx-auto">
                                    {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                                </div>
                            </template>
                            <label for="home-avatar-input" title="প্রোফাইল ছবি পরিবর্তন করুন" class="absolute bottom-0 right-0 w-7 h-7 rounded-full bg-white border border-slate-200 text-slate-600 hover:text-blue-600 shadow-md flex items-center justify-center cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </label>
                            <input type="file" id="home-avatar-input" accept="image/*" class="hidden" @change="uploadAvatar($event)">
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight">স্বাগতম, {{ $user->name }}</h1>
                        <p class="text-xs sm:text-sm text-slate-500 mt-1 max-w-md mx-auto">আপনার তথ্য, গোপনীয়তা এবং নিরাপত্তা একটি একক সার্বভৌম অ্যাকাউন্ট থেকে নিয়ন্ত্রণ করুন।</p>
                    </div>

                    <!-- ========================================================================= -->
                    <!-- PROFILE INFO COMPLETION PROMPT (User's primary requirement)               -->
                    <!-- ========================================================================= -->
                    <div class="rounded-3xl bg-white border border-slate-200/90 shadow-xs p-5 sm:p-6 transition-all hover:shadow-md">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div class="flex items-start gap-3.5">
                                <div class="w-11 h-11 rounded-2xl bg-amber-50 border border-amber-200 text-amber-600 flex items-center justify-center shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h2 class="text-base font-bold text-slate-900">আপনার প্রোফাইল তথ্য সম্পূর্ণ করুন</h2>
                                        <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full {{ $profileCompletion['is_complete'] ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200' }}">
                                            {{ $profileCompletion['score'] }}% সম্পন্ন
                                        </span>
                                    </div>
                                    <p class="text-xs text-slate-500 mt-1">
                                        @if(!$profileCompletion['is_complete'])
                                            আপনার অ্যাকাউন্টের সম্পূর্ণ নিরাপত্তা এবং সার্বভৌম যাচাইয়ের জন্য অবশিষ্ট তথ্য পূরণ করুন।
                                        @else
                                            আপনার মৌলিক প্রোফাইল তথ্য সম্পূর্ণ রয়েছে। যেকোনো সময় তা আপডেট করতে পারেন।
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <button 
                                type="button" 
                                @click="activeTab = 'personal_info'"
                                class="shrink-0 py-2.5 px-5 rounded-full bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold transition-all shadow-sm shadow-blue-500/20 cursor-pointer flex items-center gap-1.5">
                                <span>প্রোফাইল তথ্য আপডেট করুন</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </button>
                        </div>

                        <!-- Progress Bar & Missing items chips -->
                        <div class="mt-4 pt-4 border-t border-slate-100">
                            <div class="w-full bg-slate-100 rounded-full h-2 mb-3 overflow-hidden">
                                <div class="bg-gradient-to-r from-amber-500 to-blue-600 h-2 rounded-full transition-all duration-500" style="width: {{ $profileCompletion['score'] }}%"></div>
                            </div>
                            
                            @if(!empty($profileCompletion['missing_fields']))
                                <div class="flex flex-wrap items-center gap-2 text-xs">
                                    <span class="text-slate-400 font-medium">বাকি তথ্য:</span>
                                    @foreach($profileCompletion['missing_fields'] as $missing)
                                        <button type="button" @click="activeTab = 'personal_info'" class="px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 text-[11px] font-semibold transition-colors flex items-center gap-1">
                                            <span>+ {{ $missing['label'] }}</span>
                                        </button>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Clean 2-Column Preview / Recommendation Cards (Extensible Architecture) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        
                        <!-- Security Recommendations Card -->
                        <div class="rounded-3xl bg-white border border-slate-200/90 p-5 shadow-xs flex flex-col justify-between hover:shadow-md transition-shadow">
                            <div>
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                    </div>
                                    <h3 class="text-sm font-bold text-slate-900">নিরাপত্তা সুপারিশ (Security)</h3>
                                </div>
                                <p class="text-xs text-slate-500 leading-relaxed">
                                    আপনার অ্যাকাউন্ট মৌলিকভাবে সুরক্ষিত রয়েছে। যেকোনো সময় পাসওয়ার্ড এবং ২-ধাপ যাচাইকরণ (2FA) চালু করতে পারেন।
                                </p>
                            </div>
                            <div class="pt-4 mt-3 border-t border-slate-100">
                                <button type="button" @click="activeTab = 'security'" class="text-xs font-bold text-blue-600 hover:underline">
                                    নিরাপত্তা সেটিংস দেখুন &rarr;
                                </button>
                            </div>
                        </div>

                        <!-- Data & Privacy Card -->
                        <div class="rounded-3xl bg-white border border-slate-200/90 p-5 shadow-xs flex flex-col justify-between hover:shadow-md transition-shadow">
                            <div>
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="w-10 h-10 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                    </div>
                                    <h3 class="text-sm font-bold text-slate-900">গোপনীয়তা ও ডেটা (Privacy)</h3>
                                </div>
                                <p class="text-xs text-slate-500 leading-relaxed">
                                    আপনার সার্বভৌম ডেটা সম্পূর্ণ এনক্রিপ্টেড। আপনার অ্যাক্টিভিটি হিস্ট্রি এবং ডাটা শেয়ারিং নিয়ন্ত্রণ করুন।
                                </p>
                            </div>
                            <div class="pt-4 mt-3 border-t border-slate-100">
                                <button type="button" @click="activeTab = 'privacy'" class="text-xs font-bold text-blue-600 hover:underline">
                                    গোপনীয়তা চেকআপ &rarr;
                                </button>
                            </div>
                        </div>

                    </div>

                </div>

                <!-- ========================================================================= -->
                <!-- TAB 2: PERSONAL INFO (Google Style Form)                                   -->
                <!-- ========================================================================= -->
                <div x-show="activeTab === 'personal_info'" x-transition class="space-y-6">
                    <div class="rounded-3xl bg-white border border-slate-200/90 shadow-xs p-6 sm:p-8">
                        <div class="flex items-center justify-between pb-4 mb-6 border-b border-slate-100">
                            <div>
                                <h2 class="text-lg font-bold text-slate-900">ব্যক্তিগত তথ্য (Personal info)</h2>
                                <p class="text-xs text-slate-500 mt-0.5">আপনার নাম, জন্মতারিখ ও যোগাযোগের তথ্য ম্যানেজ করুন</p>
                            </div>
                        </div>

                        <!-- Update Profile Form -->
                        <form action="{{ route('account.profile') }}" method="POST" class="space-y-4">
                            @csrf

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <!-- Name -->
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">পুরো নাম (Full Legal Name) <span class="text-rose-500">*</span></label>
                                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all">
                                </div>

                                <!-- Handle / Username -->
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">ইউজারনেম (@handle)</label>
                                    <input type="text" name="handle" value="{{ old('handle', $user->handle) }}" placeholder="sovereign_username" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all">
                                </div>

                                <!-- Email (Read Only) -->
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">ইমেইল (যাচাইকৃত)</label>
                                    <input type="email" value="{{ $user->email }}" disabled class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-500 text-sm cursor-not-allowed">
                                </div>

                                <!-- Phone Number -->
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">মোবাইল নম্বর (Phone)</label>
                                    <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="+88017XXXXXXXX" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all">
                                </div>

                                <!-- Date of Birth -->
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">জন্মতারিখ (Date of Birth)</label>
                                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth) }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all">
                                </div>

                                <!-- Gender -->
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">লিঙ্গ (Gender)</label>
                                    <select name="gender" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all bg-white">
                                        <option value="">নির্বাচন করুন</option>
                                        <option value="male" {{ (old('gender', $user->gender) === 'male') ? 'selected' : '' }}>পুরুষ (Male)</option>
                                        <option value="female" {{ (old('gender', $user->gender) === 'female') ? 'selected' : '' }}>নারী (Female)</option>
                                        <option value="other" {{ (old('gender', $user->gender) === 'other') ? 'selected' : '' }}>অন্যান্য (Other)</option>
                                    </select>
                                </div>

                                <!-- Ward / Location -->
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">শহর ও ওয়ার্ড (City / Ward)</label>
                                    <input type="text" name="city" value="{{ old('city', $user->city) }}" placeholder="ঢাকা, ওয়ার্ড-১৯" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all">
                                </div>

                                <!-- Recovery Email -->
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">জরুরি রিকভারি ইমেইল (Recovery Email)</label>
                                    <input type="email" name="recovery_email" value="{{ old('recovery_email', $settings->recovery_email ?? '') }}" placeholder="recovery@example.com" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all">
                                </div>
                            </div>

                            <!-- Bio -->
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">বায়ো / পরিচিতি (Bio)</label>
                                <textarea name="bio" rows="3" placeholder="আপনার পরিচিতি লিখুন..." class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all">{{ old('bio', $user->bio) }}</textarea>
                            </div>

                            <div class="pt-4 flex justify-end">
                                <button type="submit" class="py-2.5 px-6 rounded-full bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs shadow-md shadow-blue-500/20 transition-all cursor-pointer">
                                    পরিবর্তন সংরক্ষণ করুন
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- ========================================================================= -->
                <!-- TAB 3: SECURITY & 2FA (নিরাপত্তা ও ২-ধাপ যাচাই)                            -->
                <!-- ========================================================================= -->
                <div x-show="activeTab === 'security'" x-transition class="space-y-6">
                    <!-- 2FA Control Card -->
                    <div class="rounded-3xl bg-white border border-slate-200/90 shadow-xs p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-start gap-3.5">
                                <div class="w-11 h-11 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                </div>
                                <div>
                                    <h3 class="text-base font-bold text-slate-900">২-ধাপ যাচাইকরণ (2-Step Verification)</h3>
                                    <p class="text-xs text-slate-500 mt-0.5">নতুন ডিভাইসে লগইন করার সময় পাসওয়ার্ডের পাশাপাশি দ্বিতীয় ভেরিফিকেশন কোড চাওয়া হবে।</p>
                                </div>
                            </div>

                            <!-- Switch Toggle Button -->
                            <button 
                                type="button" 
                                @click="toggle2FA"
                                :disabled="twoFactorLoading"
                                class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none"
                                :class="twoFactorEnabled ? 'bg-blue-600' : 'bg-slate-200'">
                                <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow-sm ring-0 transition duration-200 ease-in-out"
                                      :class="twoFactorEnabled ? 'translate-x-5' : 'translate-x-0'"></span>
                            </button>
                        </div>
                    </div>

                    <!-- Change Password Form -->
                    <div class="rounded-3xl bg-white border border-slate-200/90 shadow-xs p-6">
                        <h3 class="text-base font-bold text-slate-900 mb-1">পাসওয়ার্ড পরিবর্তন (Change Password)</h3>
                        <p class="text-xs text-slate-500 mb-4">আপনার অ্যাকাউন্টের নিরাপত্তা জোরদার করতে নিয়মিত পাসওয়ার্ড আপডেট করুন</p>

                        <form action="{{ route('account.password') }}" method="POST" class="max-w-md space-y-4">
                            @csrf
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">বর্তমান পাসওয়ার্ড</label>
                                <input type="password" name="current_password" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">নতুন পাসওয়ার্ড (কমপক্ষে ৮ অক্ষর)</label>
                                <input type="password" name="password" minlength="8" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">নতুন পাসওয়ার্ড নিশ্চিত করুন</label>
                                <input type="password" name="password_confirmation" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none">
                            </div>
                            <button type="submit" class="py-2 px-5 rounded-full bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold transition-all shadow-xs cursor-pointer">
                                পাসওয়ার্ড পরিবর্তন করুন
                            </button>
                        </form>
                    </div>
                </div>

                <!-- ========================================================================= -->
                <!-- TAB 4: DATA & PRIVACY                                                     -->
                <!-- ========================================================================= -->
                <div x-show="activeTab === 'privacy'" x-transition class="space-y-6">
                    <div class="rounded-3xl bg-white border border-slate-200/90 shadow-xs p-6">
                        <h2 class="text-lg font-bold text-slate-900 mb-1">তথ্য ও গোপনীয়তা (Data & privacy)</h2>
                        <p class="text-xs text-slate-500 mb-6">আপনার সার্বভৌম ডেটা ডাউনলোড করুন অথবা গোপনীয়তা নীতি পর্যবেক্ষণ করুন।</p>

                        <div class="space-y-3">
                            <div class="p-4 rounded-2xl border border-slate-200 flex items-center justify-between">
                                <div>
                                    <h4 class="text-sm font-bold text-slate-800">অ্যাকাউন্ট ডেটা ডাউনলোড</h4>
                                    <p class="text-xs text-slate-500 mt-0.5">আপনার প্রোফাইল এবং অ্যাক্টিভিটি হিস্ট্রির একটি কপি ডাউনলোড করুন</p>
                                </div>
                                <button type="button" class="py-2 px-4 rounded-full border border-slate-300 text-xs font-semibold hover:bg-slate-50 transition-colors">
                                    অনুরোধ পাঠান
                                </button>
                            </div>

                            <div class="p-4 rounded-2xl border border-slate-200 flex items-center justify-between">
                                <div>
                                    <h4 class="text-sm font-bold text-slate-800">সার্বভৌম এনক্রিপশন ভল্ট</h4>
                                    <p class="text-xs text-slate-500 mt-0.5">AES-256 বিট জিরো-নলেজ এনক্রিপশন সক্রিয় রয়েছে</p>
                                </div>
                                <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full">সক্রিয়</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========================================================================= -->
                <!-- TAB 5: DEVICES & ACTIVE SESSIONS                                          -->
                <!-- ========================================================================= -->
                <div x-show="activeTab === 'devices'" x-transition class="space-y-6">
                    <div class="rounded-3xl bg-white border border-slate-200/90 shadow-xs p-6">
                        <div class="flex items-center justify-between pb-4 mb-4 border-b border-slate-100">
                            <div>
                                <h2 class="text-lg font-bold text-slate-900">কানেক্টেড ডিভাইস ও সেশন (Your devices)</h2>
                                <p class="text-xs text-slate-500 mt-0.5">আপনার অ্যাকাউন্টে বর্তমানে যে সকল ডিভাইস লগইন রয়েছে</p>
                            </div>

                            <form action="{{ route('account.devices.revoke-all') }}" method="POST" onsubmit="return confirm('বর্তমান ডিভাইস ব্যতীত বাকি সব সেশন বন্ধ করতে চান?');">
                                @csrf
                                <button type="submit" class="py-2 px-4 rounded-full bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-bold border border-rose-200 transition-colors">
                                    অন্যান্য সব ডিভাইস রিভোক করুন
                                </button>
                            </form>
                        </div>

                        <!-- Active Devices List -->
                        <div class="space-y-3">
                            @forelse($activeDevices as $device)
                                <div class="p-4 rounded-2xl border border-slate-200/80 hover:border-slate-300 transition-all flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center text-lg">
                                            💻
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-slate-800">{{ $device->device_name }}</p>
                                            <p class="text-[11px] text-slate-500">IP: {{ $device->ip_address }} • শেষ সক্রিয়: {{ $device->last_active_at ? $device->last_active_at->diffForHumans() : 'সম্প্রতি' }}</p>
                                        </div>
                                    </div>

                                    <form action="{{ route('account.device.revoke', $device->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-xs text-slate-400 hover:text-rose-600 font-semibold px-2 py-1 rounded-md transition-colors">
                                            লগআউট
                                        </button>
                                    </form>
                                </div>
                            @empty
                                <div class="p-6 text-center text-slate-400 text-xs">
                                    কোনো অতিরিক্ত সক্রিয় সেশন পাওয়া যায়নি।
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                            <!-- ========================================================================= -->
                <!-- TAB 6: BILLING & SUBSCRIPTIONS (Google / Odoo Multi-Product Model)        -->
                <!-- ========================================================================= -->
                <div x-show="activeTab === 'billing'" x-transition class="space-y-6">
                    <!-- Billing Header Summary -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="rounded-3xl bg-white border border-slate-200/90 shadow-xs p-5">
                            <span class="text-xs text-slate-500 font-medium">ডিফল্ট পেমেন্ট মেথড</span>
                            <div class="mt-2 flex items-center gap-2">
                                <span class="px-2 py-0.5 rounded text-[11px] font-black bg-pink-100 text-pink-700">bKash</span>
                                <span class="text-sm font-bold text-slate-800">0171***429</span>
                            </div>
                        </div>
                        <div class="rounded-3xl bg-white border border-slate-200/90 shadow-xs p-5">
                            <span class="text-xs text-slate-500 font-medium">সক্রিয় সাবস্ক্রিপশন</span>
                            <div class="mt-2 flex items-center gap-2">
                                <span class="text-xl font-extrabold text-blue-600">৩টি</span>
                                <span class="text-xs text-slate-400">(Social, School, Law)</span>
                            </div>
                        </div>
                        <div class="rounded-3xl bg-white border border-slate-200/90 shadow-xs p-5">
                            <span class="text-xs text-slate-500 font-medium">Zengfy ওয়ালেট ব্যালেন্স</span>
                            <div class="mt-2 text-xl font-extrabold text-emerald-600">৳ ২৫০.০০</div>
                        </div>
                    </div>

                    <!-- Subscriptions Cards -->
                    <div class="rounded-3xl bg-white border border-slate-200/90 shadow-xs p-6">
                        <div class="flex items-center justify-between pb-4 mb-4 border-b border-slate-100">
                            <div>
                                <h2 class="text-lg font-bold text-slate-900">আপনার সক্রিয় সাবস্ক্রিপশনসমূহ</h2>
                                <p class="text-xs text-slate-500 mt-0.5">Zengfy ইকোসিস্টেমের বিভিন্ন মডিউলের সাবস্ক্রিপশন ও অটো-রিনিউয়াল</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($billingData['subscriptions'] ?? [] as $sub)
                                <div class="rounded-2xl border border-slate-200/80 p-5 flex flex-col justify-between hover:border-slate-300 transition-all">
                                    <div>
                                        <div class="flex items-start justify-between gap-2 mb-2">
                                            <div>
                                                <span class="text-[10px] uppercase font-bold tracking-wider text-slate-400">{{ $sub['module_name'] }}</span>
                                                <h3 class="text-sm font-bold text-slate-900 mt-0.5">{{ $sub['plan_name'] }}</h3>
                                            </div>
                                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full {{ $sub['status'] === 'active' ? 'bg-emerald-50 text-emerald-600 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200' }}">
                                                {{ $sub['status_label'] }}
                                            </span>
                                        </div>
                                        <div class="text-xl font-black text-slate-900 my-2">
                                            {{ $sub['price'] }} <span class="text-xs font-normal text-slate-400">/ {{ $sub['interval'] }}</span>
                                        </div>
                                        <ul class="text-xs text-slate-600 space-y-1.5 mt-3 mb-4">
                                            @foreach($sub['features'] ?? [] as $feat)
                                                <li class="flex items-center gap-2">
                                                    <svg class="w-3.5 h-3.5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                                    <span>{{ $feat }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                                        <span class="text-slate-400 text-[11px]">পরবর্তী বিলিং: {{ $sub['next_billing'] }}</span>
                                        <button type="button" class="font-bold text-blue-600 hover:underline">ম্যানেজ প্ল্যান</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Invoices History -->
                    <div class="rounded-3xl bg-white border border-slate-200/90 shadow-xs p-6">
                        <h3 class="text-base font-bold text-slate-900 mb-1">বিলিং হিস্ট্রি ও অফিসিয়াল চালান (Invoices)</h3>
                        <p class="text-xs text-slate-500 mb-4">সরকারি মূসক/ভ্যাট সহ সকল পরিশোধিত ইনভয়েস</p>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-xs">
                                <thead>
                                    <tr class="border-b border-slate-200 text-slate-400 uppercase text-[10px] tracking-wider">
                                        <th class="py-2.5 px-3">ইনভয়েস নং</th>
                                        <th class="py-2.5 px-3">প্রোডাক্ট / সার্ভিস</th>
                                        <th class="py-2.5 px-3">তারিখ</th>
                                        <th class="py-2.5 px-3">পদ্ধতি</th>
                                        <th class="py-2.5 px-3">পরিমাণ</th>
                                        <th class="py-2.5 px-3">স্ট্যাটাস</th>
                                        <th class="py-2.5 px-3 text-right">ডাউনলোড</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @foreach($billingData['invoices'] ?? [] as $inv)
                                        <tr class="hover:bg-slate-50/70 transition-colors">
                                            <td class="py-3 px-3 font-mono font-bold text-slate-800">{{ $inv['invoice_no'] }}</td>
                                            <td class="py-3 px-3 text-slate-700 font-medium">{{ $inv['product'] }}</td>
                                            <td class="py-3 px-3 text-slate-500">{{ $inv['date'] }}</td>
                                            <td class="py-3 px-3 text-slate-600">{{ $inv['method'] }}</td>
                                            <td class="py-3 px-3 font-bold text-slate-900">{{ $inv['amount'] }}</td>
                                            <td class="py-3 px-3">
                                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-600 border border-emerald-200">
                                                    {{ $inv['status_label'] }}
                                                </span>
                                            </td>
                                            <td class="py-3 px-3 text-right">
                                                <a href="#" onclick="alert('ইনভয়েস PDF প্রস্তুত করা হচ্ছে...'); return false;" class="text-blue-600 hover:text-blue-700 font-bold hover:underline">
                                                    PDF
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </main>
        </div>

        <!-- Footer -->
        <footer class="border-t border-slate-200/80 bg-white py-4 px-6 text-center text-xs text-slate-500">
            <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-2">
                <span>&copy; {{ date('Y') }} Zengfy Ecosystem. সকল স্বত্ব সংরক্ষিত।</span>
                <div class="flex items-center gap-4">
                    <a href="{{ route('terms') }}" class="hover:underline">শর্তাবলী</a>
                    <a href="{{ route('faq') }}" class="hover:underline">গোপনীয়তা</a>
                    <a href="{{ route('faq') }}" class="hover:underline">সহায়তা</a>
                </div>
            </div>
        </footer>

    </div>

</body>
</html>
