@extends('layouts.social')

@section('title', 'Hyperlocal Feed | Zengfy Sovereign Network')
@section('meta_description', 'Real-time hyperlocal updates, civic announcements, and verified citizen discussions in Bangladesh.')

@section('content')
<div 
    x-data="{ 
        currentFilter: (new URLSearchParams(window.location.search).get('filter') || 'world'),
        switchFilter(f) {
            this.currentFilter = f;
            window.dispatchEvent(new CustomEvent('zengfy:switch-filter', { detail: { filter: f } }));
        }
    }" 
    @zengfy:filter-changed.window="currentFilter = $event.detail.filter"
    class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start pb-16 md:pb-6">

    <!-- ========================================== -->
    <!-- LEFT COLUMN: Citizen Card & Ward Navigator -->
    <!-- ========================================== -->
    <aside class="hidden lg:block lg:col-span-3 space-y-5 sticky top-24">
        
        <!-- Citizen Mini Profile Card (Linear Obsidian Surface) -->
        @if($currentUser)
            @php
                $nameParts = explode(' ', trim($currentUser->name ?? 'Zengfy Citizen'));
                $userInitials = count($nameParts) > 1 
                    ? strtoupper(substr($nameParts[0], 0, 1) . substr(end($nameParts), 0, 1))
                    : strtoupper(substr($nameParts[0], 0, 2));
            @endphp
            <div class="bg-[#121A29] border border-white/[0.08] hover:border-white/[0.18] transition-colors rounded-2xl p-5 shadow-xl relative overflow-hidden">
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-600 via-indigo-500 to-cyan-400"></div>
                
                <div class="flex items-center gap-3 mb-4">
                    <div class="relative shrink-0">
                        @if($currentUser->avatar_url)
                            <img src="{{ $currentUser->avatar_url }}" alt="{{ $currentUser->name }}" class="w-12 h-12 rounded-2xl object-cover border border-white/10 shadow-md shadow-blue-500/20" />
                        @else
                            <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-base font-extrabold text-white shadow-md shadow-blue-500/20">
                                {{ $userInitials }}
                            </div>
                        @endif
                        @if($currentUser->verified_badge || $currentUser->nid_verified)
                            <span class="absolute -bottom-1 -right-1 w-4 h-4 rounded-full bg-blue-500 border-2 border-[#121A29] flex items-center justify-center text-[9px] text-white font-bold" title="Verified Citizen">
                                ✓
                            </span>
                        @endif
                    </div>
                    <div class="overflow-hidden">
                        <h3 class="text-sm font-bold text-gray-100 truncate flex items-center gap-1">
                            <span>{{ $currentUser->name }}</span>
                        </h3>
                        <p class="text-xs text-gray-400 truncate">{{ '@' . ($currentUser->handle ?: 'citizen') }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-2 py-3 border-y border-white/[0.08] text-center mb-4">
                    <div>
                        <div class="text-xs font-extrabold text-gray-100">{{ $currentUser->followers_count ?? 0 }}</div>
                        <div class="text-[10px] text-gray-400 font-medium">Followers</div>
                    </div>
                    <div>
                        <div class="text-xs font-extrabold text-gray-100">{{ $currentUser->following_count ?? 0 }}</div>
                        <div class="text-[10px] text-gray-400 font-medium">Following</div>
                    </div>
                    <div>
                        <div class="text-xs font-extrabold text-gray-100">{{ $currentUser->friends_count ?? 0 }}</div>
                        <div class="text-[10px] text-gray-400 font-medium">Friends</div>
                    </div>
                </div>

                <a href="{{ route('social.profile', ['handle' => $currentUser->handle ?: $currentUser->id]) }}" class="w-full py-2 px-3 rounded-xl bg-white/[0.04] hover:bg-white/[0.08] text-xs font-semibold text-gray-200 border border-white/[0.08] active:scale-95 transition-all flex items-center justify-center gap-1.5">
                    <span>View My Profile</span>
                    <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        @else
            <div class="bg-[#121A29] border border-white/[0.08] hover:border-white/[0.18] transition-colors rounded-2xl p-5 shadow-xl relative overflow-hidden">
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-600 via-indigo-500 to-cyan-400"></div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center text-xl text-gray-300">
                        👤
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-gray-100">Guest Citizen</h3>
                        <p class="text-xs text-gray-400">Join Zengfy Network</p>
                    </div>
                </div>
                <p class="text-xs text-gray-400 mb-4 leading-relaxed">
                    Log in with your Sovereign Account to share neighborhood updates and photos.
                </p>
                <a href="/login" class="w-full py-2 px-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-xs font-bold text-white shadow-lg shadow-blue-600/30 active:scale-95 transition-all flex items-center justify-center gap-1.5">
                    <span>Sign In to Post</span>
                </a>
            </div>
        @endif

        <!-- 4 Dynamic Streams Navigation (Material 3 Expressive SPA Switcher) -->
        <div class="bg-[#121A29] border border-white/[0.08] hover:border-white/[0.18] transition-colors rounded-2xl p-4 shadow-xl space-y-2">
            <div class="text-xs font-bold text-gray-400 uppercase tracking-wider px-2 mb-2">
                Timeline Feeds
            </div>

            <a href="/feed?filter=world"
                @click.prevent="switchFilter('world')"
                :class="currentFilter === 'world' ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg shadow-blue-500/20 border-transparent' : 'text-gray-300 hover:bg-white/[0.05] hover:text-white border-transparent'"
                class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-semibold border active:scale-95 transition-all text-left cursor-pointer">
                <span class="flex items-center gap-2.5">
                    <span class="text-base">🌍</span>
                    <span>World's Happening</span>
                </span>
                <span :class="currentFilter === 'world' ? 'bg-white/20 text-white' : 'bg-white/10 text-gray-300'" class="text-[10px] px-2 py-0.5 rounded-full transition-colors">Global</span>
            </a>

            <a href="/feed?filter=friends"
                @click.prevent="switchFilter('friends')"
                :class="currentFilter === 'friends' ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg shadow-blue-500/20 border-transparent' : 'text-gray-300 hover:bg-white/[0.05] hover:text-white border-transparent'"
                class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-semibold border active:scale-95 transition-all text-left cursor-pointer">
                <span class="flex items-center gap-2.5">
                    <span class="text-base">👥</span>
                    <span>Friends Network</span>
                </span>
                <span :class="currentFilter === 'friends' ? 'bg-white/20 text-white' : 'bg-white/10 text-gray-300'" class="text-[10px] px-2 py-0.5 rounded-full transition-colors">Direct</span>
            </a>

            <a href="/feed?filter=community"
                @click.prevent="switchFilter('community')"
                :class="currentFilter === 'community' ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg shadow-blue-500/20 border-transparent' : 'text-gray-300 hover:bg-white/[0.05] hover:text-white border-transparent'"
                class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-semibold border active:scale-95 transition-all text-left cursor-pointer">
                <span class="flex items-center gap-2.5">
                    <span class="text-base">🏛️</span>
                    <span>Civic Community</span>
                </span>
                <span :class="currentFilter === 'community' ? 'bg-white/20 text-white' : 'bg-indigo-500/20 text-indigo-300'" class="text-[10px] px-2 py-0.5 rounded-full font-bold transition-colors">Forum</span>
            </a>

            <a href="/feed?filter=nearby"
                @click.prevent="switchFilter('nearby')"
                :class="currentFilter === 'nearby' ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg shadow-blue-500/20 border-transparent' : 'text-gray-300 hover:bg-white/[0.05] hover:text-white border-transparent'"
                class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-semibold border active:scale-95 transition-all text-left cursor-pointer">
                <span class="flex items-center gap-2.5">
                    <span class="text-base">📍</span>
                    <span>Nearby (Ward 19)</span>
                </span>
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
            </a>
        </div>
    </aside>

    <!-- ======================================================== -->
    <!-- CENTER COLUMN: Pure Headless React 19 SPA Mount Target   -->
    <!-- ======================================================== -->
    <div class="lg:col-span-6 space-y-6">
        <!-- React 19 Hyperlocal Feed Stream Root -->
        <div id="react-feed-root" data-user="{{ json_encode($currentUser) }}"></div>
    </div>

    <!-- ======================================================== -->
    <!-- RIGHT COLUMN: Bento Grid Architecture (Cards A, B, and C) -->
    <!-- ======================================================== -->
    <aside class="hidden lg:block lg:col-span-3 space-y-4 sticky top-24">

        <!-- Bento Card A (Ward Pulse): Live Active Citizens Count -->
        <div class="bg-[#121A29] border border-white/[0.08] hover:border-white/[0.18] transition-colors rounded-2xl p-4 sm:p-5 shadow-xl relative overflow-hidden">
            <div class="flex items-center justify-between mb-3.5">
                <h4 class="text-xs font-bold text-gray-100 uppercase tracking-wider flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Ward 19 Pulse</span>
                </h4>
                <span class="text-[10px] px-2 py-0.5 rounded-full bg-emerald-500/10 text-emerald-400 font-semibold border border-emerald-500/20">Live</span>
            </div>

            <div class="space-y-2.5">
                <div class="flex items-center justify-between p-2.5 rounded-xl bg-white/[0.02] border border-white/[0.04]">
                    <span class="text-xs text-gray-400">Active Citizens</span>
                    <div class="flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span class="text-xs font-extrabold text-gray-100">1,480+ Online</span>
                    </div>
                </div>
                <div class="flex items-center justify-between p-2.5 rounded-xl bg-white/[0.02] border border-white/[0.04]">
                    <span class="text-xs text-gray-400">Civic Safety Index</span>
                    <span class="text-xs font-extrabold text-emerald-400">98.4% (Optimal)</span>
                </div>
                <div class="flex items-center justify-between p-2.5 rounded-xl bg-white/[0.02] border border-white/[0.04]">
                    <span class="text-xs text-gray-400">Hyperlocal Activity</span>
                    <span class="text-xs font-extrabold text-blue-400">High Volume</span>
                </div>
            </div>
        </div>

        <!-- Bento Card B (Emergency SOS Hub): Red/Rose Tinted Single-Tap Distress Signal -->
        <div x-data="{ sosTriggered: false, triggerSos() { this.sosTriggered = true; setTimeout(() => { this.sosTriggered = false; }, 6000); } }" class="bg-rose-500/10 border border-rose-500/20 rounded-2xl p-4 shadow-xl relative overflow-hidden">
            <div class="flex items-center justify-between mb-2.5">
                <div class="flex items-center gap-2 text-rose-400 text-xs font-bold uppercase tracking-wider">
                    <span class="w-2.5 h-2.5 rounded-full bg-rose-500 animate-ping"></span>
                    <span>Emergency SOS Hub</span>
                </div>
                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-rose-500/20 text-rose-300 border border-rose-500/30">Priority 1</span>
            </div>

            <p class="text-xs text-gray-300 leading-relaxed mb-3.5">
                Single-tap distress signal broadcasts your verified location to Ward 19 emergency coordinators and rapid civic responders.
            </p>

            <template x-if="!sosTriggered">
                <button 
                    type="button"
                    @click="triggerSos()"
                    class="w-full py-2.5 px-4 rounded-xl bg-gradient-to-r from-rose-600 to-red-600 hover:from-rose-500 hover:to-red-500 text-white text-xs font-extrabold shadow-lg shadow-rose-600/30 active:scale-95 transition-all flex items-center justify-center gap-2 cursor-pointer">
                    <svg class="w-4 h-4 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span>Trigger SOS Distress Signal</span>
                </button>
            </template>

            <template x-if="sosTriggered">
                <div class="p-2.5 rounded-xl bg-rose-600 text-white text-xs font-bold text-center animate-in fade-in flex items-center justify-center gap-2">
                    <span class="animate-spin text-base">⚠️</span>
                    <span>Distress Signal Broadcasted (Ward 19)</span>
                </div>
            </template>
        </div>

        <!-- Bento Card C (Civic Notices / Trending Ward Topics): Compact Micro-List with Pill Tags -->
        <div class="bg-[#121A29] border border-white/[0.08] hover:border-white/[0.18] transition-colors rounded-2xl p-4 sm:p-5 shadow-xl space-y-3">
            <div class="flex items-center justify-between pb-2 border-b border-white/[0.06]">
                <h4 class="text-xs font-bold text-gray-100 uppercase tracking-wider flex items-center gap-1.5">
                    <span>📢</span>
                    <span>Civic Notices & Topics</span>
                </h4>
                <span class="text-[10px] text-gray-500 font-mono">Trending</span>
            </div>

            <div class="space-y-2">
                <!-- Notice 1 -->
                <div class="rounded-lg bg-white/[0.03] hover:bg-white/[0.06] p-2.5 border border-white/[0.04] transition-colors">
                    <div class="flex items-center justify-between gap-2 mb-1">
                        <span class="text-[11px] font-bold text-gray-100 truncate">Gulshan Ave Road Maintenance</span>
                        <span class="text-[9px] px-2 py-0.5 rounded-full bg-amber-500/10 text-amber-400 font-semibold shrink-0">Tonight</span>
                    </div>
                    <p class="text-[11px] text-gray-400 leading-snug mb-1.5">
                        Diversions between Road 11 & 24 from 11 PM to 5 AM.
                    </p>
                    <div class="flex items-center gap-1.5 flex-wrap">
                        <span class="text-[10px] px-2 py-0.5 rounded-full bg-white/[0.05] text-gray-300 font-medium">#DNCC</span>
                        <span class="text-[10px] px-2 py-0.5 rounded-full bg-white/[0.05] text-gray-300 font-medium">#Ward19Maintenance</span>
                    </div>
                </div>

                <!-- Notice 2 -->
                <div class="rounded-lg bg-white/[0.03] hover:bg-white/[0.06] p-2.5 border border-white/[0.04] transition-colors">
                    <div class="flex items-center justify-between gap-2 mb-1">
                        <span class="text-[11px] font-bold text-gray-100 truncate">Ward Cleanliness Campaign</span>
                        <span class="text-[9px] px-2 py-0.5 rounded-full bg-blue-500/10 text-blue-400 font-semibold shrink-0">Friday</span>
                    </div>
                    <p class="text-[11px] text-gray-400 leading-snug mb-1.5">
                        Community volunteer mobilization for clean streets.
                    </p>
                    <div class="flex items-center gap-1.5 flex-wrap">
                        <span class="text-[10px] px-2 py-0.5 rounded-full bg-white/[0.05] text-gray-300 font-medium">#GreenGulshan</span>
                        <span class="text-[10px] px-2 py-0.5 rounded-full bg-white/[0.05] text-gray-300 font-medium">#CivicAction</span>
                    </div>
                </div>

                <!-- Notice 3 -->
                <div class="rounded-lg bg-white/[0.03] hover:bg-white/[0.06] p-2.5 border border-white/[0.04] transition-colors">
                    <div class="flex items-center justify-between gap-2 mb-1">
                        <span class="text-[11px] font-bold text-gray-100 truncate">Neighborhood Night Patrol</span>
                        <span class="text-[9px] px-2 py-0.5 rounded-full bg-emerald-500/10 text-emerald-400 font-semibold shrink-0">Active</span>
                    </div>
                    <p class="text-[11px] text-gray-400 leading-snug mb-1.5">
                        Ward safety volunteers active across sectors 1 and 2.
                    </p>
                    <div class="flex items-center gap-1.5 flex-wrap">
                        <span class="text-[10px] px-2 py-0.5 rounded-full bg-white/[0.05] text-gray-300 font-medium">#SafeWard</span>
                        <span class="text-[10px] px-2 py-0.5 rounded-full bg-white/[0.05] text-gray-300 font-medium">#CivicAlert</span>
                    </div>
                </div>
            </div>
        </div>

    </aside>

</div>

@push('scripts')
@vite(['resources/js/react/main.jsx'])
@endpush
@endsection
