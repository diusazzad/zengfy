<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sovereign Account Hub | Zengfy</title>
    <meta name="description" content="Manage your unified identity, active devices, and ecosystem apps in the Zengfy Sovereign Account Hub.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'monospace'],
                    },
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
            background-color: #0B0F17;
            color: #F3F4F6;
        }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0B0F17; }
        ::-webkit-scrollbar-thumb { background: #1F2937; border-radius: 9999px; }
        #react-account-root:not(:empty) + #blade-account-fallback {
            display: none !important;
        }
    </style>

    @vite(['resources/js/react/main.jsx'])
</head>

<body class="bg-[#0B0F17] text-gray-100 min-h-screen flex flex-col justify-between selection:bg-blue-600 selection:text-white antialiased relative"
      x-data="{ 
          appSwitcherOpen: false, 
          profileMenuOpen: false, 
          activeTab: 'overview',
          editProfileOpen: false,
          verifyNidOpen: false,
          avatarPreview: '{{ $user->avatar_url }}',
          avatarUploading: false,
          avatarMessage: '',
          async uploadQuickAvatar(event) {
              const file = event.target.files[0];
              if (!file) return;

              this.avatarPreview = URL.createObjectURL(file);
              this.avatarUploading = true;
              this.avatarMessage = 'Uploading...';

              const formData = new FormData();
              formData.append('avatar', file);
              formData.append('_token', '{{ csrf_token() }}');

              try {
                  const res = await fetch('{{ route("account.avatar") }}', {
                      method: 'POST',
                      headers: {
                          'Accept': 'application/json',
                      },
                      body: formData
                  });

                  const data = await res.json();
                  if (res.ok && data.success) {
                      this.avatarPreview = data.avatar_url;
                      this.avatarMessage = 'Photo updated!';
                      setTimeout(() => window.location.reload(), 500);
                  } else {
                      alert(data.message || 'Failed to upload photo.');
                      this.avatarMessage = '';
                  }
              } catch (err) {
                  alert('Network error while uploading photo.');
                  this.avatarMessage = '';
              } finally {
                  this.avatarUploading = false;
              }
          },
          async removeAvatar() {
              if (!confirm('Are you sure you want to remove your profile photo?')) return;
              this.avatarUploading = true;
              try {
                  const res = await fetch('{{ route("account.avatar.remove") }}', {
                      method: 'DELETE',
                      headers: {
                          'Accept': 'application/json',
                          'X-CSRF-TOKEN': '{{ csrf_token() }}'
                      }
                  });
                  const data = await res.json();
                  if (res.ok && data.success) {
                      this.avatarPreview = null;
                      setTimeout(() => window.location.reload(), 400);
                  }
              } catch (err) {
                  alert('Failed to remove photo.');
              } finally {
                  this.avatarUploading = false;
              }
          },

          /* AI Assistant Drawer State & Mock Messages */
          aiChatOpen: false,
          aiQuery: '',
          aiIsTyping: false,
          aiMessages: [
              {
                  role: 'assistant',
                  text: '👋 আসসালামু আলাইকুম {{ strtok($user->name, " ") }}! আমি Zengfy AI Sovereign Assistant। আপনার একাউন্ট সিকিউরিটি, NID ভেরিফিকেশন, অথবা সোশ্যাল ফিড নিয়ে কোন সহায়তা প্রয়োজন?'
              }
          ],
          sendAiMessage(customPrompt = null) {
              const textToSend = customPrompt || this.aiQuery.trim();
              if (!textToSend) return;

              this.aiMessages.push({ role: 'user', text: textToSend });
              this.aiQuery = '';
              this.aiIsTyping = true;

              setTimeout(() => {
                  this.aiIsTyping = false;
                  this.aiMessages.push({
                      role: 'assistant',
                      text: 'ধন্যবাদ আপনার বার্তার জন্য! আমাদের এই Sovereign AI সাপোর্ট সিস্টেমটি বর্তমানে প্রিভিউ স্টেজে ডিজাইন করা রয়েছে। পরবর্তী আপডেটে সরাসরি ফুল ইন্টেলিজেন্ট ইঞ্জিন যুক্ত করা হবে।'
                  });
                  this.$nextTick(() => {
                      const chatBox = this.$refs.aiChatContainer;
                      if (chatBox) chatBox.scrollTop = chatBox.scrollHeight;
                  });
              }, 700);

              this.$nextTick(() => {
                  const chatBox = this.$refs.aiChatContainer;
                  if (chatBox) chatBox.scrollTop = chatBox.scrollHeight;
              });
          }
      }">

    <!-- Ambient Glowing Background Grid & Orbs (Rich Glassmorphism Mesh) -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0" aria-hidden="true">
        <!-- Top Radiant Cyan/Blue Spotlight -->
        <div class="absolute -top-40 left-1/3 -translate-x-1/2 w-[750px] h-[550px] bg-gradient-to-b from-blue-600/25 via-cyan-500/15 to-transparent blur-3xl opacity-80 animate-pulse-slow"></div>
        <!-- Right Bottom Neon Cyan Flare -->
        <div class="absolute top-1/4 -right-32 w-[600px] h-[600px] bg-gradient-to-t from-cyan-500/20 via-blue-700/15 to-transparent blur-3xl opacity-60"></div>
        <!-- Left Bottom Deep Violet Orb -->
        <div class="absolute -bottom-40 left-10 w-[550px] h-[550px] bg-gradient-to-tr from-indigo-600/20 via-purple-700/15 to-transparent blur-3xl opacity-50"></div>
        <!-- Subtle Precision Grid Pattern with Vignette Fade -->
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff07_1px,transparent_1px),linear-gradient(to_bottom,#ffffff07_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_70%_60%_at_50%_30%,#000_70%,transparent_100%)]"></div>
    </div>

    <!-- 1. Top Navbar (Google Workspace Style) -->
    <header class="sticky top-0 z-40 bg-[#0E1524]/90 backdrop-blur-xl border-b border-white/[0.08]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between gap-4">
            
            <!-- Left: Logo & Hub Title -->
            <div class="flex items-center gap-3">
                <a href="{{ $homeUrl ?? route('welcome') }}" aria-label="Zengfy" class="flex items-center gap-2.5 group p-1.5 min-h-[44px] rounded-xl focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                    <div aria-hidden="true" class="w-9 h-9 rounded-xl bg-gradient-to-tr from-blue-600 via-indigo-600 to-cyan-400 flex items-center justify-center font-black text-lg text-white shadow-lg shadow-blue-500/25 group-hover:scale-105 transition-transform">
                        Z
                    </div>
                    <span class="text-xl font-extrabold tracking-tight text-white group-hover:text-gray-200 transition-colors">
                        Zengfy<span class="text-blue-500 font-black" aria-hidden="true">.</span>
                    </span>
                </a>
                <span class="text-xs px-2.5 py-0.5 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 font-semibold hidden sm:inline-block">
                    Sovereign Account Hub
                </span>
            </div>

            <!-- Middle Navigation Links -->
            <nav class="hidden md:flex items-center gap-1 text-sm font-medium">
                <button @click="activeTab = 'overview'; window.dispatchEvent(new CustomEvent('zengfy-tab-change', { detail: { tab: 'overview' } }))" 
                        :class="activeTab === 'overview' ? 'text-white bg-white/[0.08] border-white/20' : 'text-gray-400 hover:text-white hover:bg-white/[0.04] border-transparent'"
                        class="px-3.5 py-2 min-h-[40px] rounded-xl border text-xs sm:text-sm font-semibold transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                    Overview
                </button>
                <button @click="activeTab = 'security'; window.dispatchEvent(new CustomEvent('zengfy-tab-change', { detail: { tab: 'security' } }))" 
                        :class="activeTab === 'security' ? 'text-white bg-white/[0.08] border-white/20' : 'text-gray-400 hover:text-white hover:bg-white/[0.04] border-transparent'"
                        class="px-3.5 py-2 min-h-[40px] rounded-xl border text-xs sm:text-sm font-semibold transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                    Security & Devices
                </button>
                <button @click="activeTab = 'apps'; window.dispatchEvent(new CustomEvent('zengfy-tab-change', { detail: { tab: 'apps' } }))" 
                        :class="activeTab === 'apps' ? 'text-white bg-white/[0.08] border-white/20' : 'text-gray-400 hover:text-white hover:bg-white/[0.04] border-transparent'"
                        class="px-3.5 py-2 min-h-[40px] rounded-xl border text-xs sm:text-sm font-semibold transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                    Ecosystem Apps
                </button>
                <a href="{{ $socialUrl ?? route('social.feed') }}" 
                   class="px-3.5 py-2 min-h-[40px] rounded-xl text-xs sm:text-sm font-semibold text-cyan-400 hover:text-cyan-300 hover:bg-cyan-500/10 transition-all flex items-center gap-1.5 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                    <span>Social Feed</span>
                    <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-pulse"></span>
                </a>
            </nav>

            <!-- Right: 9-Dot App Launcher, AI Support Launcher & User Profile Menu -->
            <div class="flex items-center gap-2 sm:gap-3">

                <!-- AI Customer Support Header Trigger -->
                <button @click="aiChatOpen = !aiChatOpen"
                        title="AI Customer Support / সহায়তা"
                        aria-label="Open AI Customer Support Agent"
                        class="relative flex items-center gap-1.5 px-3 py-1.5 min-h-[44px] rounded-xl bg-gradient-to-r from-blue-600/15 via-cyan-500/15 to-indigo-600/15 hover:from-blue-600/25 hover:to-cyan-500/25 border border-cyan-500/30 text-cyan-300 hover:text-white transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-cyan-400">
                    <span class="flex h-2 w-2 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-cyan-500"></span>
                    </span>
                    <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    <span class="text-xs font-bold hidden lg:inline">AI Agent</span>
                </button>

                <!-- 9-Dot Google-Style App Switcher -->
                <div class="relative">
                    <button @click="appSwitcherOpen = !appSwitcherOpen" 
                            title="Zengfy Apps" 
                            aria-label="Google Apps Switcher"
                            class="w-11 h-11 min-w-[44px] min-h-[44px] rounded-xl bg-white/[0.04] hover:bg-white/[0.08] border border-white/10 flex items-center justify-center text-gray-300 hover:text-white transition-all cursor-pointer focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                        <!-- 9-dot SVG -->
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <circle cx="5" cy="5" r="2"/>
                            <circle cx="12" cy="5" r="2"/>
                            <circle cx="19" cy="5" r="2"/>
                            <circle cx="5" cy="12" r="2"/>
                            <circle cx="12" cy="12" r="2"/>
                            <circle cx="19" cy="12" r="2"/>
                            <circle cx="5" cy="19" r="2"/>
                            <circle cx="12" cy="19" r="2"/>
                            <circle cx="19" cy="19" r="2"/>
                        </svg>
                    </button>

                    <!-- 9-Dot Dropdown Menu -->
                    <div x-show="appSwitcherOpen" 
                         @click.away="appSwitcherOpen = false" 
                         x-cloak
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         class="absolute right-0 mt-2 w-80 sm:w-96 bg-[#121A29] border border-white/15 rounded-2xl shadow-2xl backdrop-blur-2xl p-4 z-50">
                        <div class="flex items-center justify-between mb-3 pb-2 border-b border-white/10">
                            <span class="text-xs font-bold uppercase tracking-wider text-gray-400">Ecosystem Applications</span>
                            <span class="text-[10px] text-cyan-400 font-semibold">Unified SSO</span>
                        </div>
                        <div class="grid grid-cols-3 gap-2.5">
                            @foreach($ecosystemApps as $app)
                            <a href="{{ $app['url'] }}" 
                               class="flex flex-col items-center text-center p-2.5 rounded-xl hover:bg-white/[0.06] border border-transparent hover:border-white/10 transition-all group">
                                <span class="text-2xl mb-1.5 transform group-hover:scale-110 transition-transform">{{ $app['icon'] }}</span>
                                <span class="text-xs font-semibold text-white group-hover:text-cyan-400 transition-colors">{{ $app['name'] }}</span>
                                <span class="text-[9px] text-gray-400 truncate max-w-full mt-0.5">{{ $app['category'] }}</span>
                            </a>
                            @endforeach
                        </div>
                        <div class="mt-3 pt-2.5 border-t border-white/10 text-center">
                            <a href="{{ route('download.app') }}" class="text-xs font-semibold text-cyan-400 hover:text-cyan-300 flex items-center justify-center gap-1.5 py-1.5 min-h-[36px]">
                                <span>📱 Download Android APK</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- User Profile Dropdown -->
                <div class="relative">
                    <button @click="profileMenuOpen = !profileMenuOpen" 
                            aria-label="User Account Profile Menu"
                            class="flex items-center gap-2 pl-2 pr-3 py-1.5 min-h-[44px] rounded-xl bg-white/[0.04] hover:bg-white/[0.08] border border-white/10 transition-all cursor-pointer focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                        <template x-if="avatarPreview">
                            <img :src="avatarPreview" alt="{{ $user->name }}" class="w-8 h-8 rounded-lg object-cover border border-white/20">
                        </template>
                        <template x-if="!avatarPreview">
                            <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white font-bold text-xs">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        </template>
                        <span class="text-xs font-semibold text-white max-w-[100px] truncate hidden sm:inline-block">
                            {{ $user->name }}
                        </span>
                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Profile Dropdown -->
                    <div x-show="profileMenuOpen" 
                         @click.away="profileMenuOpen = false" 
                         x-cloak
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         class="absolute right-0 mt-2 w-64 bg-[#121A29] border border-white/15 rounded-2xl shadow-2xl p-3 z-50">
                        <div class="p-2 border-b border-white/10 mb-2 flex items-center gap-3">
                            <template x-if="avatarPreview">
                                <img :src="avatarPreview" alt="{{ $user->name }}" class="w-10 h-10 rounded-xl object-cover border border-white/20 shrink-0">
                            </template>
                            <template x-if="!avatarPreview">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white font-bold text-sm shrink-0">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            </template>
                            <div class="min-w-0 flex-1">
                                <p class="text-xs font-bold text-white truncate">{{ $user->name }}</p>
                                <p class="text-[11px] text-gray-400 truncate">{{ $user->email }}</p>
                                <p class="text-[10px] text-cyan-400 font-mono mt-0.5">@{{ $user->handle ?? 'citizen' }}</p>
                            </div>
                        </div>
                        <a href="{{ $socialUrl ?? route('social.feed') }}" class="flex items-center gap-2 px-3 py-2.5 min-h-[40px] text-xs font-medium text-gray-300 hover:text-white hover:bg-white/[0.06] rounded-xl transition">
                            <span>🌐 Zengfy Social Feed</span>
                        </a>
                        <button @click="activeTab = 'security'; profileMenuOpen = false;" class="w-full text-left flex items-center gap-2 px-3 py-2.5 min-h-[40px] text-xs font-medium text-gray-300 hover:text-white hover:bg-white/[0.06] rounded-xl transition cursor-pointer">
                            <span>🔒 Security & Sessions</span>
                        </button>
                        <hr class="my-1.5 border-white/10">
                        <form action="{{ route('logout') }}" method="POST" @submit="localStorage.removeItem('zengfy_token')">
                            @csrf
                            <button type="submit" class="w-full text-left flex items-center gap-2 px-3 py-2.5 min-h-[40px] text-xs font-bold text-rose-400 hover:bg-rose-500/10 rounded-xl transition cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                <span>Sign Out Everywhere</span>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <!-- 2. Main Content Dashboard Container (Accessibility Landmark) -->
    <main id="main-content" role="main" class="relative z-10 flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Notification Banners -->
        @if(session('success') || request('welcome') || request('reset'))
        <div class="mb-6 p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 text-sm flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl bg-emerald-500/20 flex items-center justify-center text-emerald-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div>
                    @if(request('welcome'))
                        <p class="font-bold text-white">Welcome to Zengfy Sovereign Digital Network!</p>
                        <p class="text-xs text-emerald-300">Your unified account is active across all 15 ecosystem modules.</p>
                    @elseif(request('reset'))
                        <p class="font-bold text-white">Password Updated Successfully!</p>
                        <p class="text-xs text-emerald-300">Your account credentials have been securely refreshed.</p>
                    @else
                        <p class="font-bold text-white">{{ session('success') }}</p>
                    @endif
                </div>
            </div>
        </div>
        @endif

        @if($errors->any())
        <div class="mb-6 p-4 rounded-2xl bg-rose-500/10 border border-rose-500/30 text-rose-300 text-sm">
            <ul class="list-disc pl-5 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- React 19 Sovereign Account Hub Root -->
        <div id="react-account-root" 
             data-user="{{ json_encode($user) }}" 
             data-devices="{{ json_encode($activeDevices) }}" 
             data-apps="{{ json_encode($ecosystemApps) }}"></div>

        <!-- Blade/Progressive Fallback Container (Hidden when React mounts) -->
        <div id="blade-account-fallback" class="space-y-6">

        <!-- TAB 1: OVERVIEW & PROFILE HUB -->
        <div x-show="activeTab === 'overview'" class="space-y-6">

            <!-- Hero Citizen Identity Card -->
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-[#121A29] via-[#0E1626] to-[#0A101C] border border-white/10 p-6 sm:p-8 shadow-2xl">
                <!-- Decorative Glow Line -->
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-600 via-cyan-400 to-indigo-600"></div>

                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <!-- Left: Avatar & Details -->
                    <div class="flex items-start sm:items-center gap-5">
                        <div class="relative shrink-0 group">
                            <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl bg-gradient-to-tr from-blue-600 via-indigo-600 to-cyan-400 p-1 shadow-xl shadow-blue-600/20 overflow-hidden">
                                <template x-if="avatarPreview">
                                    <img :src="avatarPreview" alt="{{ $user->name }}" class="w-full h-full object-cover rounded-xl">
                                </template>
                                <template x-if="!avatarPreview">
                                    <div class="w-full h-full bg-[#0B0F17] rounded-xl flex items-center justify-center font-black text-2xl sm:text-3xl text-white">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                </template>
                            </div>

                            <!-- Camera Quick Upload Hover Overlay -->
                            <label for="quick-avatar-file" 
                                   title="Change profile photo / ছবি পরিবর্তন করুন"
                                   class="absolute inset-0 rounded-2xl bg-black/60 opacity-0 group-hover:opacity-100 transition-all flex flex-col items-center justify-center text-white cursor-pointer backdrop-blur-[2px]">
                                <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-[10px] font-bold text-gray-200 mt-1" x-text="avatarUploading ? 'Uploading...' : 'Change Photo'"></span>
                            </label>

                            <input type="file" id="quick-avatar-file" accept="image/jpeg,image/png,image/webp,image/gif" class="hidden" @change="uploadQuickAvatar($event)">

                            <span class="absolute bottom-1 right-1 w-4 h-4 rounded-full bg-emerald-500 border-2 border-[#0B0F17]" title="Active Sovereign Citizen"></span>
                        </div>

                        <div class="space-y-1">
                            <div class="flex flex-wrap items-center gap-2">
                                <h1 class="text-xl sm:text-2xl font-extrabold text-white">{{ $user->name }}</h1>
                                
                                @if($user->nid_verified || $user->verified_badge)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-cyan-500/10 border border-cyan-500/30 text-cyan-300 text-xs font-bold">
                                        <svg class="w-3.5 h-3.5 text-cyan-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        <span>Verified Citizen</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-300 text-xs font-bold">
                                        <span>🟡 Unverified NID</span>
                                    </span>
                                @endif
                            </div>

                            <p class="text-xs sm:text-sm text-gray-400 flex flex-wrap items-center gap-3">
                                <span class="font-mono text-cyan-400">{{ '@' . ($user->handle ?? 'citizen_' . substr($user->id, 0, 8)) }}</span>
                                <span>•</span>
                                <span>{{ $user->email }}</span>
                                <span>•</span>
                                <span>{{ $user->ward_code ?? 'Ward Code Unassigned' }}</span>
                            </p>

                            @if($user->bio)
                                <p class="text-xs text-gray-300 italic pt-1">{{ $user->bio }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Right: Quick Actions -->
                    <div class="flex flex-wrap sm:flex-nowrap items-center gap-3">
                        <button @click="editProfileOpen = !editProfileOpen" 
                                class="px-4 py-2.5 min-h-[44px] rounded-xl bg-white/[0.06] hover:bg-white/[0.1] border border-white/10 text-white font-semibold text-xs sm:text-sm transition-all flex items-center gap-2 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                            </svg>
                            <span>Edit Profile</span>
                        </button>

                        <a href="{{ $socialUrl ?? route('social.feed') }}" 
                           class="px-5 py-2.5 min-h-[44px] rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white font-bold text-xs sm:text-sm shadow-lg shadow-blue-500/25 transition-all flex items-center gap-2 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                            <span>Open Social Feed</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Citizen Social Stats Ribbon -->
                <div class="mt-6 pt-6 border-t border-white/[0.08] grid grid-cols-2 sm:grid-cols-4 gap-4 text-center">
                    <div class="p-3 rounded-2xl bg-white/[0.02] border border-white/[0.05]">
                        <p class="text-xs text-gray-400">Social Followers</p>
                        <p class="text-xl font-extrabold text-white mt-0.5">{{ $user->followers_count ?? 0 }}</p>
                    </div>
                    <div class="p-3 rounded-2xl bg-white/[0.02] border border-white/[0.05]">
                        <p class="text-xs text-gray-400">Following</p>
                        <p class="text-xl font-extrabold text-white mt-0.5">{{ $user->following_count ?? 0 }}</p>
                    </div>
                    <div class="p-3 rounded-2xl bg-white/[0.02] border border-white/[0.05]">
                        <p class="text-xs text-gray-400">Mutual Friends</p>
                        <p class="text-xl font-extrabold text-white mt-0.5">{{ $user->friends_count ?? 0 }}</p>
                    </div>
                    <div class="p-3 rounded-2xl bg-white/[0.02] border border-white/[0.05]">
                        <p class="text-xs text-gray-400">Active Devices</p>
                        <p class="text-xl font-extrabold text-cyan-400 mt-0.5">{{ $activeDevices->count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Bento Row: Connected Pillars -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Pillar A: Sovereign Security & Vault -->
                <div class="rounded-3xl bg-[#121A29] border border-white/10 p-6 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xs font-bold uppercase tracking-wider text-blue-400">Pillar 1: Identity & SSO</span>
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">Central Security Gateway</h3>
                        <p class="text-xs text-gray-400 leading-relaxed">
                            Your account is protected with 12-round bcrypt hash, 256-bit AES encryption, and Sanctum tokens.
                        </p>
                        <div class="mt-4 space-y-2 text-xs">
                            <div class="flex justify-between py-1.5 border-b border-white/[0.05]">
                                <span class="text-gray-400">NID Status</span>
                                <span class="font-semibold {{ $user->nid_verified ? 'text-emerald-400' : 'text-amber-400' }}">
                                    {{ $user->nid_verified ? 'Verified Citizen' : 'Pending Verification' }}
                                </span>
                            </div>
                            <div class="flex justify-between py-1.5 border-b border-white/[0.05]">
                                <span class="text-gray-400">SSO Token Scope</span>
                                <span class="font-semibold text-white">Full Ecosystem</span>
                            </div>
                        </div>
                    </div>
                    <button @click="activeTab = 'security'" class="mt-6 w-full py-2.5 px-4 min-h-[44px] rounded-xl bg-white/[0.06] hover:bg-white/[0.1] text-xs font-semibold text-white border border-white/10 transition text-center flex items-center justify-center">
                        Manage Security & Passwords →
                    </button>
                </div>

                <!-- Pillar B: Zengfy Social -->
                <div class="rounded-3xl bg-[#121A29] border border-white/10 p-6 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xs font-bold uppercase tracking-wider text-cyan-400">Pillar 2: Social Network</span>
                            <span class="text-xs px-2 py-0.5 rounded-full bg-cyan-500/10 text-cyan-400 border border-cyan-500/20">Hyperlocal</span>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">Verified Citizen Community</h3>
                        <p class="text-xs text-gray-400 leading-relaxed">
                            Connect with verified neighbors, publish updates, trigger emergency SOS, and message friends with zero bot interference.
                        </p>
                        <div class="mt-4 p-3 rounded-2xl bg-cyan-500/[0.05] border border-cyan-500/20 text-xs text-cyan-300">
                            💡 Ready to publish your first verified update or connect with friends?
                        </div>
                    </div>
                    <a href="{{ $socialUrl ?? route('social.feed') }}" class="mt-6 w-full py-2.5 px-4 min-h-[44px] rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-xs font-bold text-white shadow-lg shadow-blue-600/20 transition text-center flex items-center justify-center">
                        Launch Social Community →
                    </a>
                </div>

                <!-- Pillar C: Mobile Android APK -->
                <div class="rounded-3xl bg-[#121A29] border border-white/10 p-6 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xs font-bold uppercase tracking-wider text-emerald-400">Mobile Ecosystem</span>
                            <span class="text-xs px-2 py-0.5 rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">Alpha v1.0</span>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">Zengfy Android APK</h3>
                        <p class="text-xs text-gray-400 leading-relaxed">
                            Native Android app packaging with biometric NID scanning, ward SOS beacon, and instant push notifications.
                        </p>
                        <div class="mt-4 space-y-1.5 text-xs text-gray-400">
                            <p class="flex items-center gap-2"><span>📷</span> Biometric Camera OCR</p>
                            <p class="flex items-center gap-2"><span>🚨</span> 1-Tap SOS Geolocation</p>
                        </div>
                    </div>
                    <a href="{{ route('download.app') }}" class="mt-6 w-full py-2.5 px-4 min-h-[44px] rounded-xl bg-white/[0.06] hover:bg-white/[0.1] text-xs font-semibold text-emerald-300 border border-emerald-500/30 transition text-center flex items-center justify-center">
                        Get Android APK Build →
                    </a>
                </div>

            </div>

            <!-- Profile Edit Drawer / Form (Collapsible) -->
            <div x-show="editProfileOpen" x-cloak class="p-6 rounded-3xl bg-[#121A29] border border-white/15 shadow-2xl">
                <div class="flex items-center justify-between mb-4 pb-3 border-b border-white/10">
                    <h3 class="text-base font-bold text-white">Update Sovereign Profile</h3>
                    <button @click="editProfileOpen = false" class="text-xs text-gray-400 hover:text-white py-1 px-2 min-h-[36px] inline-flex items-center">✕ Close</button>
                </div>
                <form action="{{ route('account.profile') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @csrf

                    <!-- Profile Photo Uploader Section -->
                    <div class="sm:col-span-2 p-4 rounded-2xl bg-white/[0.03] border border-white/10 flex flex-col sm:flex-row items-center gap-4">
                        <div class="relative w-16 h-16 rounded-xl overflow-hidden shrink-0 border border-white/20 bg-[#0B0F17]">
                            <template x-if="avatarPreview">
                                <img :src="avatarPreview" alt="Avatar preview" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!avatarPreview">
                                <div class="w-full h-full flex items-center justify-center font-bold text-white text-lg bg-gradient-to-tr from-blue-600 to-indigo-600">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            </template>
                        </div>
                        <div class="flex-1 text-center sm:text-left">
                            <p class="text-xs font-bold text-white">Profile Photo / প্রোফাইল ছবি</p>
                            <p class="text-[11px] text-gray-400 mt-0.5">JPG, PNG, WebP up to 5MB. Visible across Zengfy Social and Account Hub.</p>
                            <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2 mt-2">
                                <label class="px-3.5 py-1.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold cursor-pointer transition shadow-md shadow-blue-600/20 inline-flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                    <span>Upload Photo</span>
                                    <input type="file" name="avatar" accept="image/jpeg,image/png,image/webp,image/gif" class="hidden" @change="uploadQuickAvatar($event)">
                                </label>
                                <template x-if="avatarPreview">
                                    <button type="button" @click="removeAvatar()" class="px-3 py-1.5 rounded-xl bg-rose-500/10 hover:bg-rose-500/20 border border-rose-500/30 text-rose-300 text-xs font-semibold transition cursor-pointer">
                                        Remove Photo
                                    </button>
                                </template>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-300 mb-1">Full Legal Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-3.5 py-2.5 bg-[#0B0F17] border border-white/10 rounded-xl text-white text-xs sm:text-sm focus:border-blue-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-300 mb-1">Sovereign Handle (@handle)</label>
                        <input type="text" name="handle" value="{{ old('handle', $user->handle) }}" placeholder="e.g. sazzad" class="w-full px-3.5 py-2.5 bg-[#0B0F17] border border-white/10 rounded-xl text-white text-xs sm:text-sm focus:border-blue-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-300 mb-1">Ward Code (Dhaka / Division)</label>
                        <input type="text" name="ward_code" value="{{ old('ward_code', $user->ward_code) }}" placeholder="e.g. WARD-DHAKA-19" class="w-full px-3.5 py-2.5 bg-[#0B0F17] border border-white/10 rounded-xl text-white text-xs sm:text-sm focus:border-blue-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-300 mb-1">Contact Phone</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="+8801700000000" class="w-full px-3.5 py-2.5 bg-[#0B0F17] border border-white/10 rounded-xl text-white text-xs sm:text-sm focus:border-blue-500 focus:outline-none">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold text-gray-300 mb-1">Bio / Citizen Statement</label>
                        <textarea name="bio" rows="2" placeholder="Tell your verified neighbors about yourself..." class="w-full px-3.5 py-2 bg-[#0B0F17] border border-white/10 rounded-xl text-white text-xs sm:text-sm focus:border-blue-500 focus:outline-none">{{ old('bio', $user->bio) }}</textarea>
                    </div>
                    <div class="sm:col-span-2 flex justify-end gap-3 pt-2">
                        <button type="button" @click="editProfileOpen = false" class="px-4 py-2.5 min-h-[44px] rounded-xl bg-white/[0.05] text-xs font-semibold text-gray-400 hover:text-white">Cancel</button>
                        <button type="submit" class="px-5 py-2.5 min-h-[44px] rounded-xl bg-blue-600 hover:bg-blue-500 text-xs font-bold text-white shadow-lg shadow-blue-600/30">Save Profile</button>
                    </div>
                </form>
            </div>

        </div>

        <!-- TAB 2: SECURITY & ACTIVE DEVICES -->
        <div x-show="activeTab === 'security'" x-cloak class="space-y-6">

            <!-- Active Sessions & Device Management -->
            <div class="rounded-3xl bg-[#121A29] border border-white/10 p-6 sm:p-8 shadow-2xl">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 pb-4 border-b border-white/10">
                    <div>
                        <h2 class="text-xl font-bold text-white">Active Login Sessions</h2>
                        <p class="text-xs text-gray-400 mt-1">Manage all web browsers, tablets, and mobile devices connected to your sovereign account.</p>
                    </div>

                    @if($activeDevices->count() > 1)
                    <form action="{{ route('account.devices.revoke-all') }}" method="POST" onsubmit="return confirm('Terminate all sessions except this current device?');">
                        @csrf
                        <button type="submit" class="px-4 py-2.5 min-h-[44px] rounded-xl bg-rose-500/10 hover:bg-rose-500/20 border border-rose-500/30 text-rose-300 font-bold text-xs transition flex items-center gap-1.5 cursor-pointer">
                            <svg class="w-4 h-4 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            <span>Sign Out Other Devices</span>
                        </button>
                    </form>
                    @endif
                </div>

                <div class="space-y-3">
                    @forelse($activeDevices as $device)
                    <div class="p-4 rounded-2xl bg-white/[0.02] border border-white/[0.06] hover:border-white/15 transition flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-400 shrink-0">
                                @if(str_contains($device->device_name, 'Android') || str_contains($device->device_name, 'Mobile'))
                                    📱
                                @else
                                    💻
                                @endif
                            </div>
                            <div class="space-y-0.5">
                                <div class="flex items-center gap-2">
                                    <p class="text-sm font-bold text-white">{{ $device->device_name }}</p>
                                    @if(request()->ip() === $device->ip_address)
                                        <span class="px-2 py-0.5 rounded-full bg-emerald-500/15 border border-emerald-500/30 text-emerald-300 text-[10px] font-bold">This Device</span>
                                    @endif
                                </div>
                                <p class="text-xs text-gray-400">
                                    IP: <span class="font-mono text-gray-300">{{ $device->ip_address }}</span> • Last Active: {{ $device->last_active_at ? $device->last_active_at->diffForHumans() : 'Just now' }}
                                </p>
                            </div>
                        </div>

                        <div>
                            @if(request()->ip() !== $device->ip_address)
                            <form action="{{ route('account.device.revoke', $device->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-xs text-rose-400 hover:text-rose-300 font-semibold px-3 py-2 min-h-[36px] rounded-lg hover:bg-rose-500/10 transition cursor-pointer">
                                    Revoke
                                </button>
                            </form>
                            @else
                            <span class="text-xs text-emerald-400 font-semibold flex items-center gap-1">
                                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> Active Session
                            </span>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-6 text-xs text-gray-500">
                        No active sessions recorded yet.
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Change Password Card -->
            <div class="rounded-3xl bg-[#121A29] border border-white/10 p-6 sm:p-8 shadow-2xl">
                <h2 class="text-xl font-bold text-white mb-2">Change Account Password</h2>
                <p class="text-xs text-gray-400 mb-6">Ensure your account uses a unique 8+ character password to safeguard your sovereign credentials.</p>

                <form action="{{ route('account.password') }}" method="POST" class="max-w-xl space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-gray-300 mb-1.5 uppercase tracking-wider">Current Password</label>
                        <input type="password" name="current_password" required placeholder="••••••••••••" class="w-full px-4 py-3 bg-[#0B0F17] border border-white/10 rounded-xl text-white text-sm focus:border-blue-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-300 mb-1.5 uppercase tracking-wider">New Password</label>
                        <input type="password" name="new_password" required minlength="8" placeholder="••••••••••••" class="w-full px-4 py-3 bg-[#0B0F17] border border-white/10 rounded-xl text-white text-sm focus:border-blue-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-300 mb-1.5 uppercase tracking-wider">Confirm New Password</label>
                        <input type="password" name="new_password_confirmation" required minlength="8" placeholder="••••••••••••" class="w-full px-4 py-3 bg-[#0B0F17] border border-white/10 rounded-xl text-white text-sm focus:border-blue-500 focus:outline-none">
                    </div>
                    <button type="submit" class="px-6 py-3 min-h-[48px] rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-bold text-sm shadow-lg shadow-blue-600/30 transition cursor-pointer">
                        Update Password
                    </button>
                </form>
            </div>

        </div>

        <!-- TAB 3: ECOSYSTEM APPS -->
        <div x-show="activeTab === 'apps'" x-cloak class="space-y-6">
            <div class="rounded-3xl bg-[#121A29] border border-white/10 p-6 sm:p-8 shadow-2xl">
                <div class="mb-6 pb-4 border-b border-white/10">
                    <h2 class="text-xl font-bold text-white">Ecosystem Applications & Services</h2>
                    <p class="text-xs text-gray-400 mt-1">Single sign-on access to all sovereign sub-applications connected to your Zengfy ID.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach($ecosystemApps as $app)
                    <div class="p-5 rounded-2xl bg-white/[0.02] border border-white/[0.08] hover:border-white/20 transition flex flex-col justify-between group">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-3xl">{{ $app['icon'] }}</span>
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full border {{ $app['badge_color'] }}">
                                    {{ $app['badge'] }}
                                </span>
                            </div>
                            <h3 class="text-base font-bold text-white group-hover:text-cyan-400 transition-colors">{{ $app['name'] }}</h3>
                            <p class="text-xs text-gray-400 mt-1 leading-relaxed">{{ $app['desc'] }}</p>
                        </div>
                        <div class="mt-4 pt-3 border-t border-white/[0.05]">
                            @if($app['url'] !== '#')
                            <a href="{{ $app['url'] }}" class="text-xs font-semibold text-blue-400 hover:text-blue-300 py-1.5 min-h-[36px] flex items-center justify-between">
                                <span>Launch Service</span>
                                <span>→</span>
                            </a>
                            @else
                            <span class="text-xs text-gray-500 italic py-1.5 min-h-[36px] flex items-center">Coming in Phase 2</span>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        </div> <!-- /#blade-account-fallback -->

    </main>

    <!-- 3. Footer -->
    <footer class="relative z-10 border-t border-white/[0.06] bg-[#0E1524] py-6 text-center text-xs text-gray-500">
        <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p>© {{ date('Y') }} Zengfy Inc. Bangladesh's Premier Sovereign Identity Network.</p>
            <div class="flex items-center gap-4 text-gray-400">
                <a href="{{ route('terms') }}" class="hover:text-white transition py-2 px-1 min-h-[36px] inline-flex items-center">Terms of Service</a>
                <span>•</span>
                <a href="{{ route('download.app') }}" class="hover:text-white transition py-2 px-1 min-h-[36px] inline-flex items-center">Android App</a>
                <span>•</span>
                <a href="{{ route('faq') }}" class="hover:text-white transition py-2 px-1 min-h-[36px] inline-flex items-center">Support & FAQ</a>
            </div>
        </div>
    </footer>

    <!-- 4. Floating AI Customer Support Agent Widget (Side Dock) -->
    <!-- Trigger Floating Button (Bottom Right) -->
    <div class="fixed bottom-6 right-6 z-50 flex items-center gap-2">
        <button @click="aiChatOpen = !aiChatOpen"
                aria-label="Toggle Sovereign AI Customer Support Agent"
                class="group relative flex items-center gap-3 px-4 py-3 min-h-[52px] rounded-2xl bg-gradient-to-r from-blue-600 via-indigo-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white font-bold text-xs sm:text-sm shadow-2xl shadow-blue-500/40 hover:shadow-cyan-500/50 transition-all transform hover:-translate-y-0.5 cursor-pointer focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-cyan-400">
            <!-- Pulsing Online Glow -->
            <div class="relative w-8 h-8 rounded-xl bg-white/20 backdrop-blur-md flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                <span class="absolute -top-0.5 -right-0.5 flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                </span>
            </div>
            <div class="text-left hidden sm:block">
                <span class="block text-xs font-extrabold tracking-wide uppercase text-white leading-tight">AI Support</span>
                <span class="block text-[10px] text-cyan-200 font-normal">Sovereign Assistant</span>
            </div>
        </button>
    </div>

    <!-- AI Customer Support Flyout Drawer / Modal -->
    <div x-show="aiChatOpen" 
         x-cloak
         @click.away="aiChatOpen = false"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-8 sm:translate-y-0 sm:translate-x-12 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:translate-x-0 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:translate-x-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-8 sm:translate-y-0 sm:translate-x-12 scale-95"
         class="fixed bottom-20 right-4 sm:right-6 z-50 w-[calc(100vw-2rem)] sm:w-[380px] md:w-[420px] max-h-[82vh] h-[580px] flex flex-col bg-[#101726]/95 backdrop-blur-2xl border border-white/15 rounded-3xl shadow-2xl overflow-hidden">
        
        <!-- Drawer Header -->
        <div class="px-5 py-4 bg-gradient-to-r from-[#141E33] to-[#0D1526] border-b border-white/10 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="relative w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 via-indigo-600 to-cyan-400 p-0.5 shadow-lg shadow-blue-500/25">
                    <div class="w-full h-full bg-[#0B0F17] rounded-[10px] flex items-center justify-center text-cyan-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <span class="absolute bottom-0 right-0 w-2.5 h-2.5 rounded-full bg-emerald-500 border border-[#0B0F17]"></span>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-white flex items-center gap-1.5">
                        <span>Zengfy AI Agent</span>
                        <span class="text-[9px] px-1.5 py-0.5 rounded-full bg-cyan-500/10 text-cyan-300 border border-cyan-500/20 font-mono">v1 Preview</span>
                    </h3>
                    <p class="text-[11px] text-gray-400">Autonomous Customer & Citizen Support</p>
                </div>
            </div>
            <button @click="aiChatOpen = false" 
                    aria-label="Close AI Support Agent"
                    class="w-8 h-8 rounded-lg bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white flex items-center justify-center transition">
                ✕
            </button>
        </div>

        <!-- Chat Messages Container -->
        <div x-ref="aiChatContainer" class="flex-1 p-4 overflow-y-auto space-y-3.5 text-xs">
            <template x-for="(msg, index) in aiMessages" :key="index">
                <div class="flex items-start gap-2.5" :class="msg.role === 'user' ? 'justify-end' : 'justify-start'">
                    <!-- AI Avatar Badge -->
                    <template x-if="msg.role === 'assistant'">
                        <div class="w-6 h-6 rounded-lg bg-blue-600/30 border border-blue-500/30 flex items-center justify-center text-cyan-400 text-[10px] shrink-0 font-bold">
                            AI
                        </div>
                    </template>
                    <!-- Message Bubble -->
                    <div class="max-w-[82%] px-3.5 py-2.5 rounded-2xl leading-relaxed"
                         :class="msg.role === 'user' 
                             ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-tr-none' 
                             : 'bg-white/[0.05] border border-white/10 text-gray-200 rounded-tl-none'">
                        <p x-text="msg.text"></p>
                    </div>
                </div>
            </template>

            <!-- Typing indicator -->
            <div x-show="aiIsTyping" class="flex items-center gap-2 text-gray-400 text-[11px] pl-8">
                <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-ping"></span>
                <span>AI Agent is typing...</span>
            </div>
        </div>

        <!-- Quick Prompt Chips -->
        <div class="px-4 py-2 border-t border-white/[0.06] bg-[#0E1524]/60 flex items-center gap-1.5 overflow-x-auto text-[10px]">
            <button type="button" @click="sendAiMessage('How do I verify my NID?')" class="px-2.5 py-1 rounded-full bg-white/[0.04] hover:bg-white/[0.08] text-gray-300 hover:text-white border border-white/10 whitespace-nowrap transition cursor-pointer">
                🪪 NID Verification
            </button>
            <button type="button" @click="sendAiMessage('Tell me about Sovereign SSO token security')" class="px-2.5 py-1 rounded-full bg-white/[0.04] hover:bg-white/[0.08] text-gray-300 hover:text-white border border-white/10 whitespace-nowrap transition cursor-pointer">
                🔒 Security & Tokens
            </button>
            <button type="button" @click="sendAiMessage('How to download Android APK?')" class="px-2.5 py-1 rounded-full bg-white/[0.04] hover:bg-white/[0.08] text-gray-300 hover:text-white border border-white/10 whitespace-nowrap transition cursor-pointer">
                📱 Android App
            </button>
        </div>

        <!-- Input Box -->
        <div class="p-3 bg-[#0B101D] border-t border-white/10">
            <form @submit.prevent="sendAiMessage()" class="flex items-center gap-2">
                <input type="text" 
                       x-model="aiQuery"
                       placeholder="Ask AI Support (e.g. NID, Password, SOS)..."
                       class="flex-1 bg-white/[0.04] border border-white/10 focus:border-cyan-400/50 rounded-xl px-3.5 py-2 text-xs text-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-cyan-400/50">
                <button type="submit" 
                        aria-label="Send AI Query"
                        class="w-9 h-9 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white flex items-center justify-center shrink-0 transition shadow-md shadow-blue-500/25">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                </button>
            </form>
            <p class="text-[9px] text-gray-500 text-center mt-1.5">Zengfy Sovereign Support Agent • Preview Mode</p>
        </div>

    </div>

    <!-- Back-Forward Cache (bfcache) Buster -->
    <script>
        window.addEventListener('pageshow', function (event) {
            const navEntries = (window.performance && window.performance.getEntriesByType) ? window.performance.getEntriesByType('navigation') : [];
            const isBackForward = event.persisted || 
                (window.performance && window.performance.navigation && window.performance.navigation.type === 2) ||
                (navEntries.length > 0 && navEntries[0].type === 'back_forward');

            if (isBackForward) {
                window.location.reload();
            }
        });
    </script>
</body>
</html>
