@extends('layouts.social')

@section('title', ($user->name ?? 'Citizen Profile') . ' (@' . ($user->handle ?? 'citizen') . ') | Zengfy Social')
@section('meta_description', 'View sovereign citizen profile, hyperlocal activity, and verified civic contributions on Zengfy.')

@php
    $isOwner = Auth::check() && ($user instanceof \App\Models\User ? Auth::id() === $user->id : (Auth::user()->handle === ($user->handle ?? null)));
    $userInitials = strtoupper(substr($user->name ?? 'SC', 0, 2));
    if (!empty($user->name)) {
        $parts = explode(' ', trim($user->name));
        $userInitials = count($parts) > 1 
            ? strtoupper(substr($parts[0], 0, 1) . substr(end($parts), 0, 1))
            : strtoupper(substr($parts[0], 0, 2));
    }
@endphp

@section('content')
<div x-data="citizenProfile()" class="max-w-4xl mx-auto space-y-6 pb-20 md:pb-8">

    <!-- Toast Notification Banner -->
    <div x-show="toastMessage" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         x-cloak
         class="fixed top-20 right-6 z-50 px-5 py-3 rounded-2xl bg-[#121A29]/95 border border-amber-500/40 text-white shadow-2xl backdrop-blur-xl flex items-center gap-3 text-xs font-semibold">
        <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
        <span x-text="toastMessage"></span>
    </div>

    <!-- Profile Header Card -->
    <div class="bg-[#121A29]/95 border border-white/10 rounded-3xl overflow-hidden shadow-2xl backdrop-blur-2xl transition-colors duration-300">
        
        <!-- Cover Banner with Luxury Sovereign Gradient & Warm Amber Undertones -->
        <div class="h-44 sm:h-60 w-full bg-gradient-to-r from-slate-900 via-indigo-950 to-amber-950/60 relative overflow-hidden">
            <!-- Ambient luminous glows -->
            <div class="absolute -top-24 -left-20 w-72 h-72 bg-blue-600/25 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-20 -right-20 w-80 h-80 bg-amber-500/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute inset-0 bg-black/30"></div>
            
            <!-- Subtle geometric sovereign grid -->
            <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff0a_1px,transparent_1px),linear-gradient(to_bottom,#ffffff0a_1px,transparent_1px)] bg-[size:2rem_2rem]"></div>
            
            <!-- Hyperlocal Ward Tag Overlay -->
            <div class="absolute top-4 right-4 px-3.5 py-1.5 rounded-full bg-black/60 backdrop-blur-md border border-amber-500/30 text-xs text-amber-300 font-medium flex items-center gap-2 shadow-lg">
                <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                <span class="font-bold">{{ $user->ward_code ?? 'WARD-19' }}</span>
                <span class="text-gray-300">· {{ $user->city ?? 'Gulshan' }}</span>
            </div>
        </div>

        <!-- Citizen Identity & Bio Section -->
        <div class="px-6 pb-6 pt-0 relative">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 -mt-16 sm:-mt-20 mb-5">
                
                <!-- Avatar with Sovereign Shield Badge & Upload Hover -->
                <div class="relative group/avatar">
                    <div class="w-28 h-28 sm:w-32 sm:h-32 rounded-3xl bg-gradient-to-tr from-amber-500 via-indigo-600 to-cyan-400 p-1 shadow-2xl border-4 border-[#121A29] overflow-hidden">
                        <template x-if="avatarPreview">
                            <img :src="avatarPreview" alt="{{ $user->name ?? 'Citizen' }}" class="w-full h-full object-cover rounded-[20px]">
                        </template>
                        <template x-if="!avatarPreview">
                            <div class="w-full h-full rounded-[20px] bg-[#0B0F17] flex items-center justify-center text-3xl font-black text-amber-200 tracking-wider">
                                {{ $userInitials }}
                            </div>
                        </template>
                    </div>

                    @if($isOwner)
                    <!-- Camera Quick Upload Overlay for Owner -->
                    <label for="profile-avatar-input" 
                           title="ছবি আপলোড করুন"
                           class="absolute inset-0 rounded-3xl bg-black/70 opacity-0 group-hover/avatar:opacity-100 transition-all flex flex-col items-center justify-center text-white cursor-pointer backdrop-blur-[2px]">
                        <svg class="w-7 h-7 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="text-[10px] font-bold text-amber-200 mt-1" x-text="avatarUploading ? 'আপলোড হচ্ছে...' : 'ছবি পরিবর্তন'"></span>
                    </label>
                    <input type="file" id="profile-avatar-input" accept="image/jpeg,image/png,image/webp,image/gif" class="hidden" @change="uploadAvatar($event)">
                    @endif
                    
                    <!-- Verified Sovereign Gold Shield Badge (Only when verified) -->
                    @if(!empty($user->verified_badge) || !empty($user->nid_verified))
                    <div class="absolute bottom-1 right-1 w-8 h-8 rounded-full bg-gradient-to-tr from-amber-500 to-yellow-400 border-4 border-[#121A29] flex items-center justify-center shadow-lg pointer-events-none" title="Verified Sovereign Citizen">
                        <svg class="w-4 h-4 text-slate-950" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/>
                        </svg>
                    </div>
                    @endif
                </div>

                <!-- Action Buttons: Follow / Friend / Share OR Owner Controls -->
                <div class="flex items-center gap-2.5 flex-wrap">
                    @if($isOwner)
                        <label for="profile-avatar-input" class="px-4 py-2.5 rounded-xl bg-gradient-to-r from-amber-500 via-amber-400 to-yellow-500 hover:from-amber-400 hover:to-yellow-400 text-slate-950 font-bold text-xs shadow-lg shadow-amber-500/20 transition-all flex items-center gap-2 cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            <span>ছবি আপলোড</span>
                        </label>
                        <template x-if="avatarPreview">
                            <button type="button" @click="removeAvatar()" class="px-3.5 py-2.5 rounded-xl bg-rose-500/10 hover:bg-rose-500/20 border border-rose-500/30 text-rose-300 text-xs font-semibold transition cursor-pointer">
                                মুছে ফেলুন
                            </button>
                        </template>
                        <a href="{{ route('account') }}" class="px-4 py-2.5 rounded-xl bg-white/[0.06] hover:bg-white/[0.1] border border-white/10 text-white text-xs font-semibold transition-all flex items-center gap-2">
                            <span>⚙️ একাউন্ট হাব</span>
                        </a>
                    @else
                        <!-- Live Follow / Following Action -->
                        <button 
                            type="button"
                            @click="toggleFollow()" 
                            :disabled="followLoading"
                            :class="isFollowing ? 'bg-white/10 hover:bg-white/15 text-white border-white/20' : 'bg-gradient-to-r from-amber-500 via-amber-400 to-yellow-500 hover:from-amber-400 hover:to-yellow-400 text-slate-950 font-black shadow-lg shadow-amber-500/25 border-transparent'"
                            class="px-5 py-2.5 rounded-xl text-xs font-bold border transition-all flex items-center gap-1.5 cursor-pointer disabled:opacity-50">
                            <svg x-show="followLoading" class="w-3.5 h-3.5 animate-spin text-current" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                            <span x-text="followLoading ? 'আপডেট হচ্ছে...' : (isFollowing ? '✓ Following' : '+ Follow')"></span>
                        </button>

                        <!-- Add Friend Action -->
                        <button 
                            type="button"
                            @click="toggleFriendRequest()" 
                            :class="friendStatus === 'friends' ? 'bg-emerald-600/20 text-emerald-400 border-emerald-500/30' : (friendStatus === 'pending' ? 'bg-amber-500/20 text-amber-300 border-amber-500/30' : 'bg-white/[0.04] hover:bg-white/[0.08] text-gray-200 border-white/10')"
                            class="px-4 py-2.5 rounded-xl text-xs font-semibold border transition-all flex items-center gap-1.5 cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                            <span x-text="friendStatus === 'friends' ? '👥 Friends' : (friendStatus === 'pending' ? '⏳ Request Sent' : 'Add Friend')"></span>
                        </button>

                        <!-- Share Profile Button -->
                        <button 
                            type="button"
                            @click="shareProfile()" 
                            title="প্রোফাইল লিংক কপি করুন"
                            class="p-2.5 rounded-xl bg-white/[0.04] hover:bg-white/[0.08] border border-white/10 text-gray-300 hover:text-white transition-colors cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                            </svg>
                        </button>
                    @endif
                </div>

            </div>

            <!-- Citizen Details -->
            <div class="space-y-3">
                <div>
                    <h1 class="text-xl sm:text-2xl font-black text-white flex items-center gap-2 flex-wrap">
                        <span>{{ $user->name ?? 'Citizen' }}</span>
                        @if(!empty($user->verified_badge) || !empty($user->nid_verified))
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-amber-500/15 text-amber-300 border border-amber-500/35 shadow-sm shadow-amber-500/10">
                            <svg class="w-3.5 h-3.5 text-amber-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/></svg>
                            <span>🛡️ Sovereign Citizen</span>
                        </span>
                        @endif
                    </h1>
                    <p class="text-sm font-semibold text-gray-400 mt-0.5">
                        {{ '@' . ($user->handle ?? 'citizen') }}
                    </p>
                </div>

                <!-- Bio -->
                <p class="text-sm text-gray-300 leading-relaxed max-w-2xl">
                    {{ $user->bio ?? 'Verified sovereign citizen on Zengfy network. Contributing to hyperlocal governance, community transparency, and civic alerts.' }}
                </p>

                <!-- Metadata Row -->
                <div class="flex flex-wrap items-center gap-4 text-xs text-gray-400 pt-1">
                    <div class="flex items-center gap-1.5">
                        <span class="text-amber-400">📍</span>
                        <span>{{ $user->ward_code ?? 'WARD-19' }}, {{ $user->city ?? 'Gulshan' }}</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="text-gray-300">📅</span>
                        <span>Joined {{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->format('F Y') : 'September 2026' }}</span>
                    </div>
                    @if(!empty($user->verified_badge) || !empty($user->nid_verified))
                    <div class="flex items-center gap-1.5 text-amber-300 font-medium">
                        <span>🔒</span>
                        <span>Cryptographically Verified Citizen</span>
                    </div>
                    @endif
                </div>

                <!-- Social Stats Counter Strip -->
                <div class="flex items-center gap-6 pt-3 border-t border-white/[0.08] text-sm">
                    <div class="flex items-center gap-1.5">
                        <span class="font-extrabold text-white" x-text="followersCount"></span>
                        <span class="text-gray-400 text-xs">Followers</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="font-extrabold text-white" x-text="followingCount"></span>
                        <span class="text-gray-400 text-xs">Following</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="font-extrabold text-white" x-text="friendsCount"></span>
                        <span class="text-gray-400 text-xs">Mutual Friends</span>
                    </div>
                </div>

            </div>

        </div>

        <!-- Navigation Tabs with Eye-Comfort Amber Accents -->
        <div class="flex items-center px-6 border-t border-white/[0.08] bg-black/30 overflow-x-auto">
            <button 
                type="button"
                @click="activeTab = 'posts'" 
                :class="activeTab === 'posts' ? 'text-amber-400 border-amber-400' : 'text-gray-400 hover:text-white border-transparent'"
                class="py-3.5 px-4 text-xs font-bold border-b-2 transition-all whitespace-nowrap cursor-pointer flex items-center gap-1.5">
                <span>Posts</span>
                <span class="px-1.5 py-0.2 rounded-full bg-white/10 text-[10px]" x-text="posts.length"></span>
            </button>
            <button 
                type="button"
                @click="activeTab = 'media'" 
                :class="activeTab === 'media' ? 'text-amber-400 border-amber-400' : 'text-gray-400 hover:text-white border-transparent'"
                class="py-3.5 px-4 text-xs font-bold border-b-2 transition-all whitespace-nowrap cursor-pointer flex items-center gap-1.5">
                <span>Media & Photos</span>
                <span class="px-1.5 py-0.2 rounded-full bg-white/10 text-[10px]" x-text="mediaList.length"></span>
            </button>
            <button 
                type="button"
                @click="activeTab = 'notices'" 
                :class="activeTab === 'notices' ? 'text-amber-400 border-amber-400' : 'text-gray-400 hover:text-white border-transparent'"
                class="py-3.5 px-4 text-xs font-bold border-b-2 transition-all whitespace-nowrap cursor-pointer flex items-center gap-1.5">
                <span>Civic Notices</span>
                <span class="px-1.5 py-0.2 rounded-full bg-white/10 text-[10px]" x-text="civicNotices.length"></span>
            </button>
        </div>

    </div>

    <!-- Posts Stream by Citizen -->
    <div x-show="activeTab === 'posts'" class="space-y-4">
        
        <!-- Empty State for Posts -->
        <template x-if="posts.length === 0">
            <div class="bg-[#121A29]/90 border border-white/10 rounded-3xl p-12 text-center shadow-xl backdrop-blur-xl">
                <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-white mb-1">কোনো পোস্ট পাওয়া যায়নি</h3>
                <p class="text-xs text-gray-400 max-w-sm mx-auto mb-6">
                    এই নাগরিক এখনও কোনো পোস্ট বা নাগরিক আপডেট প্রকাশ করেননি।
                </p>
                @if($isOwner)
                <a href="{{ route('social.feed') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 text-slate-950 font-bold text-xs shadow-lg shadow-amber-500/20 hover:from-amber-400 hover:to-amber-500 transition-all">
                    <span>✏️ ফিডে গিয়ে প্রথম পোস্ট করুন</span>
                </a>
                @endif
            </div>
        </template>

        <!-- Dynamic Post Cards -->
        <template x-for="post in posts" :key="post.id">
            <article class="bg-[#121A29]/90 border border-white/10 rounded-2xl p-5 shadow-xl backdrop-blur-xl transition-all hover:border-amber-500/25">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl overflow-hidden bg-gradient-to-tr from-amber-500 to-indigo-600 flex items-center justify-center font-bold text-white text-xs shrink-0 border border-white/10">
                            <template x-if="post.authorAvatar || avatarPreview">
                                <img :src="post.authorAvatar || avatarPreview" alt="Avatar" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!post.authorAvatar && !avatarPreview">
                                <span x-text="post.authorInitials || '{{ $userInitials }}'"></span>
                            </template>
                        </div>
                        <div>
                            <div class="text-xs font-bold text-white flex items-center gap-1.5">
                                <span x-text="post.authorName || '{{ $user->name ?? 'Citizen' }}'"></span>
                                <template x-if="post.verified">
                                    <svg class="w-3.5 h-3.5 text-amber-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/></svg>
                                </template>
                            </div>
                            <div class="flex items-center gap-1 text-[11px] text-gray-400">
                                <span x-text="post.authorHandle || '{{ '@' . ($user->handle ?? 'citizen') }}'"></span>
                                <span>·</span>
                                <span x-text="post.timeAgo"></span>
                                <span>·</span>
                                <span class="text-amber-400 font-mono text-[10px]" x-text="post.wardCode"></span>
                            </div>
                        </div>
                    </div>
                    <span class="px-2.5 py-0.5 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-300 text-[10px] font-semibold" x-text="post.type"></span>
                </div>

                <!-- Post Text -->
                <div class="text-sm text-gray-200 leading-relaxed mb-4 whitespace-pre-line" x-text="post.content"></div>

                <!-- Media Attachments (If any) -->
                <template x-if="post.media && post.media.length > 0">
                    <div class="mb-4 rounded-2xl overflow-hidden border border-white/10 bg-black/40">
                        <div :class="post.media.length > 1 ? 'grid grid-cols-2 gap-2' : ''">
                            <template x-for="(med, idx) in post.media" :key="med.id || idx">
                                <div class="relative group cursor-pointer overflow-hidden max-h-96" @click="openLightbox(med.url, post.content)">
                                    <img :src="med.url" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <span class="px-3.5 py-1.5 rounded-xl bg-black/80 border border-amber-500/30 backdrop-blur-md text-amber-200 text-xs font-semibold flex items-center gap-1.5 shadow-lg">
                                            🔍 বড় করে দেখুন
                                        </span>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </template>

                <!-- Action Bar -->
                <div class="flex items-center justify-between pt-3 border-t border-white/[0.06] text-xs text-gray-400">
                    <div class="flex items-center gap-5">
                        <!-- Live Like Reaction -->
                        <button 
                            type="button"
                            @click="toggleLike(post)" 
                            :class="post.liked ? 'text-rose-400 font-bold' : 'hover:text-rose-400 text-gray-400'"
                            class="flex items-center gap-1.5 transition-colors cursor-pointer group">
                            <svg :class="post.liked ? 'fill-rose-500 text-rose-500 scale-110' : 'fill-none stroke-currentColor text-gray-400 group-hover:text-rose-400'" class="w-4 h-4 transition-transform" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                            <span x-text="post.likesCount"></span>
                        </button>

                        <!-- Comments Indicator -->
                        <div class="flex items-center gap-1.5 text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            <span x-text="post.commentsCount"></span>
                        </div>
                    </div>

                    <!-- Share Action -->
                    <button 
                        type="button"
                        @click="sharePost(post)" 
                        title="পোস্ট শেয়ার করুন"
                        class="hover:text-amber-300 transition-colors cursor-pointer flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                        </svg>
                        <span>শেয়ার</span>
                    </button>
                </div>
            </article>
        </template>

    </div>

    <!-- Media & Photos Gallery Tab -->
    <div x-show="activeTab === 'media'" x-cloak class="space-y-4">
        
        <!-- Empty State for Media -->
        <template x-if="mediaList.length === 0">
            <div class="bg-[#121A29]/90 border border-white/10 rounded-3xl p-12 text-center shadow-xl backdrop-blur-xl">
                <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400 text-2xl">
                    📸
                </div>
                <h3 class="text-base font-bold text-white mb-1">কোনো ছবি বা মিডিয়া নেই</h3>
                <p class="text-xs text-gray-400 max-w-sm mx-auto">
                    এই নাগরিকের কোনো ছবি বা মিডিয়া অ্যাটাচমেন্ট এখনও আপলোড করা হয়নি।
                </p>
            </div>
        </template>

        <!-- Dynamic Photo Grid -->
        <template x-if="mediaList.length > 0">
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                <template x-for="(item, idx) in mediaList" :key="idx">
                    <div class="relative group aspect-square rounded-2xl overflow-hidden border border-white/10 bg-black/40 cursor-pointer shadow-lg hover:border-amber-500/40 transition-all duration-300"
                         @click="openLightbox(item.url, item.caption)">
                        <img :src="item.url" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity p-3 flex flex-col justify-end">
                            <p class="text-[11px] text-amber-200 font-medium line-clamp-2" x-text="item.caption"></p>
                            <span class="text-[9px] text-amber-400 font-mono mt-1" x-text="item.timeAgo"></span>
                        </div>
                    </div>
                </template>
            </div>
        </template>

    </div>

    <!-- Civic Notices Tab -->
    <div x-show="activeTab === 'notices'" x-cloak class="space-y-4">
        <template x-if="civicNotices.length === 0">
            <div class="bg-[#121A29]/90 border border-white/10 rounded-3xl p-12 text-center shadow-xl backdrop-blur-xl">
                <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400 text-2xl">
                    📢
                </div>
                <h3 class="text-base font-bold text-white mb-1">কোনো নাগরিক নোটিশ নেই</h3>
                <p class="text-xs text-gray-400 max-w-sm mx-auto">
                    এই নাগরিকের সংশ্লিষ্ট ওয়ার্ড সম্পর্কিত কোনো জরুরি নাগরিক সতর্কতা বা অফিশিয়াল নোটিশ নেই।
                </p>
            </div>
        </template>

        <template x-for="notice in civicNotices" :key="notice.id">
            <article class="bg-[#121A29]/90 border border-amber-500/30 rounded-2xl p-5 shadow-xl backdrop-blur-xl">
                <div class="flex items-center justify-between mb-2">
                    <span class="px-2.5 py-0.5 rounded-full bg-amber-500/20 text-amber-300 text-[10px] font-bold border border-amber-500/30 flex items-center gap-1">
                        <span>📢</span>
                        <span>অফিশিয়াল নাগরিক নোটিশ</span>
                    </span>
                    <span class="text-[10px] text-gray-400" x-text="notice.timeAgo"></span>
                </div>
                <p class="text-sm text-gray-200 leading-relaxed" x-text="notice.content"></p>
            </article>
        </template>
    </div>

    <!-- Lightbox Modal with Luxury Amber Close & Border -->
    <div x-show="lightboxOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @keydown.escape.window="lightboxOpen = false"
         x-cloak
         class="fixed inset-0 z-50 bg-black/92 backdrop-blur-2xl flex items-center justify-center p-4">
        
        <button type="button" @click="lightboxOpen = false" class="absolute top-6 right-6 p-3 rounded-full bg-white/10 hover:bg-amber-500/20 text-white hover:text-amber-300 border border-white/15 transition cursor-pointer">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <div class="max-w-4xl max-h-[85vh] flex flex-col items-center">
            <img :src="lightboxImage" class="max-w-full max-h-[75vh] rounded-2xl object-contain shadow-2xl border border-amber-500/25">
            <p class="text-sm text-amber-200 mt-4 text-center max-w-xl font-medium" x-text="lightboxCaption"></p>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
function citizenProfile() {
    return {
        activeTab: 'posts',
        userId: '{{ $user->id ?? "" }}',
        userHandle: '{{ $user->handle ?? "citizen" }}',
        isFollowing: {{ $isFollowing ? 'true' : 'false' }},
        followLoading: false,
        friendStatus: 'none', // 'none', 'pending', 'friends'
        followersCount: {{ (int) ($user->followers_count ?? 0) }},
        followingCount: {{ (int) ($user->following_count ?? 0) }},
        friendsCount: {{ (int) ($user->friends_count ?? 0) }},

        avatarPreview: '{{ $user->avatar_url ?? "" }}',
        avatarUploading: false,
        toastMessage: '',

        lightboxOpen: false,
        lightboxImage: '',
        lightboxCaption: '',

        posts: @json($formattedPosts ?? []),
        mediaList: @json($userMedia ?? []),

        get civicNotices() {
            return this.posts.filter(p => (p.type || '').toLowerCase() === 'announcement' || (p.type || '').toLowerCase() === 'alert');
        },

        showToast(msg) {
            this.toastMessage = msg;
            setTimeout(() => {
                this.toastMessage = '';
            }, 3000);
        },

        openLightbox(imgUrl, caption = '') {
            this.lightboxImage = imgUrl;
            this.lightboxCaption = caption;
            this.lightboxOpen = true;
        },

        async toggleFollow() {
            @guest
                window.location.href = '{{ route("login") }}';
                return;
            @endguest

            if (!this.userId) {
                this.showToast('ইউজার আইডি পাওয়া যায়নি।');
                return;
            }

            if (this.followLoading) return;
            this.followLoading = true;

            const nextAction = !this.isFollowing;
            const endpoint = nextAction ? `/users/${this.userId}/follow` : `/users/${this.userId}/unfollow`;

            // Optimistic update
            this.isFollowing = nextAction;
            this.followersCount += nextAction ? 1 : -1;

            try {
                const res = await fetch(endpoint, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                const data = await res.json();
                if (res.ok && data.success) {
                    this.isFollowing = data.data.following;
                    this.followersCount = data.data.followers_count;
                    this.showToast(data.message || (this.isFollowing ? 'ফলো করা হয়েছে!' : 'আনফলো করা হয়েছে!'));
                } else {
                    // Revert on error
                    this.isFollowing = !nextAction;
                    this.followersCount += nextAction ? -1 : 1;
                    this.showToast(data.message || 'অপারেশন ব্যর্থ হয়েছে।');
                }
            } catch (err) {
                // Revert on network failure
                this.isFollowing = !nextAction;
                this.followersCount += nextAction ? -1 : 1;
                this.showToast('সার্ভার বা নেটওয়ার্ক সংযোগে সমস্যা হয়েছে।');
            } finally {
                this.followLoading = false;
            }
        },

        toggleFriendRequest() {
            @guest
                window.location.href = '{{ route("login") }}';
                return;
            @endguest

            if (this.friendStatus === 'none') {
                this.friendStatus = 'pending';
                this.showToast('বন্ধুত্বের অনুরোধ পাঠানো হয়েছে!');
            } else if (this.friendStatus === 'pending') {
                this.friendStatus = 'friends';
                this.friendsCount++;
                this.showToast('বন্ধু তালিকায় যুক্ত হয়েছে!');
            } else {
                this.friendStatus = 'none';
                this.friendsCount--;
                this.showToast('বন্ধু তালিকা থেকে সরানো হয়েছে।');
            }
        },

        async toggleLike(post) {
            @guest
                window.location.href = '{{ route("login") }}';
                return;
            @endguest

            const originalLiked = post.liked;
            const originalCount = post.likesCount;

            // Optimistic UI
            post.liked = !post.liked;
            post.likesCount += post.liked ? 1 : -1;

            try {
                const res = await fetch(`/posts/${post.id}/like`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                const data = await res.json();
                if (res.ok && data.success) {
                    post.liked = data.data.liked;
                    post.likesCount = data.data.likes_count;
                } else {
                    post.liked = originalLiked;
                    post.likesCount = originalCount;
                }
            } catch (e) {
                post.liked = originalLiked;
                post.likesCount = originalCount;
            }
        },

        sharePost(post) {
            const url = `${window.location.origin}/u/${this.userHandle}`;
            if (navigator.clipboard) {
                navigator.clipboard.writeText(url).then(() => {
                    this.showToast('পোস্টের লিংক ক্লিপবোর্ডে কপি করা হয়েছে!');
                });
            } else {
                this.showToast('লিংক: ' + url);
            }
        },

        shareProfile() {
            const url = window.location.href;
            if (navigator.clipboard) {
                navigator.clipboard.writeText(url).then(() => {
                    this.showToast('প্রোফাইল লিংক ক্লিপবোর্ডে কপি করা হয়েছে!');
                });
            } else {
                this.showToast('লিংক: ' + url);
            }
        },

        async uploadAvatar(event) {
            const file = event.target.files[0];
            if (!file) return;

            if (file.size > 5 * 1024 * 1024) {
                this.showToast('ছবির সাইজ সর্বোচ্চ ৫ মেগাবাইট হতে পারবে।');
                return;
            }

            this.avatarPreview = URL.createObjectURL(file);
            this.avatarUploading = true;
            this.showToast('ছবি আপলোড করা হচ্ছে...');

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
                    this.showToast('প্রোফাইল ছবি সফলভাবে পরিবর্তিত হয়েছে!');
                    setTimeout(() => window.location.reload(), 600);
                } else {
                    this.showToast(data.message || 'ছবি আপলোড ব্যর্থ হয়েছে।');
                }
            } catch (err) {
                this.showToast('নেটওয়ার্ক সমস্যার কারণে ছবি আপলোড হয়নি।');
            } finally {
                this.avatarUploading = false;
            }
        },

        async removeAvatar() {
            if (!confirm('আপনি কি নিশ্চিতভাবে প্রোফাইল ছবি মুছে ফেলতে চান?')) return;
            this.avatarUploading = true;
            this.showToast('ছবি মুছে ফেলা হচ্ছে...');
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
                    this.avatarPreview = '';
                    this.showToast('প্রোফাইল ছবি মুছে ফেলা হয়েছে!');
                    setTimeout(() => window.location.reload(), 500);
                } else {
                    this.showToast(data.message || 'ছবি মোছা সম্ভব হয়নি।');
                }
            } catch (err) {
                this.showToast('নেটওয়ার্ক সমস্যার কারণে ছবি মোছা যায়নি।');
            } finally {
                this.avatarUploading = false;
            }
        }
    }
}
</script>
@endpush
