@extends('layouts.social')

@section('title', 'Hyperlocal Feed | Zengfy Sovereign Network')
@section('meta_description', 'Real-time hyperlocal updates, civic announcements, and verified citizen discussions in Bangladesh.')

@section('content')
<div data-realtime="true" x-data="socialFeed()" x-init="initFeed()" class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start pb-16 md:pb-6">

    <!-- ========================================== -->
    <!-- LEFT COLUMN: Citizen Card & Ward Navigator -->
    <!-- ========================================== -->
    <aside class="hidden lg:block lg:col-span-3 space-y-5 sticky top-24">
        
        <!-- Citizen Mini Profile Card -->
        @if($currentUser)
            @php
                $nameParts = explode(' ', trim($currentUser->name ?? 'Zengfy Citizen'));
                $userInitials = count($nameParts) > 1 
                    ? strtoupper(substr($nameParts[0], 0, 1) . substr(end($nameParts), 0, 1))
                    : strtoupper(substr($nameParts[0], 0, 2));
            @endphp
            <div class="bg-[#121A29]/90 border border-white/10 rounded-2xl p-5 shadow-xl backdrop-blur-xl relative overflow-hidden">
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
                            <span class="absolute -bottom-1 -right-1 w-4 h-4 rounded-full bg-blue-500 border-2 border-[#121A29] flex items-center justify-center text-[9px] text-white font-bold" title="Smart NID Verified">
                                ✓
                            </span>
                        @endif
                    </div>
                    <div class="overflow-hidden">
                        <h3 class="text-sm font-bold text-white truncate flex items-center gap-1">
                            <span>{{ $currentUser->name }}</span>
                        </h3>
                        <p class="text-xs text-gray-400 truncate">{{ '@' . ($currentUser->handle ?: 'citizen') }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-2 py-3 border-y border-white/[0.08] text-center mb-4">
                    <div>
                        <div class="text-xs font-extrabold text-white">{{ $currentUser->followers_count ?? 0 }}</div>
                        <div class="text-[10px] text-gray-400 font-medium">Followers</div>
                    </div>
                    <div>
                        <div class="text-xs font-extrabold text-white">{{ $currentUser->following_count ?? 0 }}</div>
                        <div class="text-[10px] text-gray-400 font-medium">Following</div>
                    </div>
                    <div>
                        <div class="text-xs font-extrabold text-white">{{ $currentUser->friends_count ?? 0 }}</div>
                        <div class="text-[10px] text-gray-400 font-medium">Friends</div>
                    </div>
                </div>

                <a href="{{ route('social.profile', ['handle' => $currentUser->handle ?: $currentUser->id]) }}" class="w-full py-2 px-3 rounded-xl bg-white/[0.04] hover:bg-white/[0.08] text-xs font-semibold text-gray-200 border border-white/10 transition-colors flex items-center justify-center gap-1.5">
                    <span>View My Profile</span>
                    <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        @else
            <div class="bg-[#121A29]/90 border border-white/10 rounded-2xl p-5 shadow-xl backdrop-blur-xl relative overflow-hidden">
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-600 via-indigo-500 to-cyan-400"></div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center text-xl text-gray-300">
                        👤
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-white">Guest Citizen</h3>
                        <p class="text-xs text-gray-400">Join Zengfy Network</p>
                    </div>
                </div>
                <p class="text-xs text-gray-400 mb-4 leading-relaxed">
                    Log in with your Sovereign Account to share neighborhood updates and photos.
                </p>
                <a href="/login" class="w-full py-2 px-3 rounded-xl bg-blue-600 hover:bg-blue-500 text-xs font-bold text-white shadow-lg shadow-blue-600/30 transition-all flex items-center justify-center gap-1.5">
                    <span>Sign In to Post</span>
                </a>
            </div>
        @endif

        <!-- Hyperlocal Ward Filter Navigation -->
        <div class="bg-[#121A29]/90 border border-white/10 rounded-2xl p-4 shadow-xl backdrop-blur-xl space-y-2">
            <div class="text-xs font-bold text-gray-400 uppercase tracking-wider px-2 mb-2">
                Hyperlocal Feeds
            </div>

            <button 
                @click="filterWard('all')"
                :class="activeFilter === 'all' ? 'bg-blue-600/20 text-blue-400 border-blue-500/30' : 'text-gray-300 hover:bg-white/[0.04] hover:text-white border-transparent'"
                class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-semibold border transition-all text-left">
                <span class="flex items-center gap-2.5">
                    <span class="text-base">🌐</span>
                    <span>All Public Feeds</span>
                </span>
                <span class="text-[10px] px-2 py-0.5 rounded-full bg-white/10 text-gray-300">Live</span>
            </button>

            <button 
                @click="filterWard('WARD-DHAKA-19')"
                :class="activeFilter === 'WARD-DHAKA-19' ? 'bg-blue-600/20 text-blue-400 border-blue-500/30' : 'text-gray-300 hover:bg-white/[0.04] hover:text-white border-transparent'"
                class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-semibold border transition-all text-left">
                <span class="flex items-center gap-2.5">
                    <span class="text-base">📍</span>
                    <span>Ward 19 (Gulshan)</span>
                </span>
                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
            </button>

            <button 
                @click="filterWard('notices')"
                :class="activeFilter === 'notices' ? 'bg-amber-500/20 text-amber-400 border-amber-500/30' : 'text-gray-300 hover:bg-white/[0.04] hover:text-white border-transparent'"
                class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-semibold border transition-all text-left">
                <span class="flex items-center gap-2.5">
                    <span class="text-base">📢</span>
                    <span>Civic Notices</span>
                </span>
                <span class="text-[10px] px-2 py-0.5 rounded-full bg-amber-500/20 text-amber-300 font-bold">P1</span>
            </button>
        </div>

    </aside>

    <!-- ========================================== -->
    <!-- CENTER COLUMN: Composer & Feed Stream     -->
    <!-- ========================================== -->
    <div class="lg:col-span-6 space-y-6">

        <!-- React 19 Hyperlocal Feed Stream Root -->
        <div id="react-feed-root" data-user="{{ json_encode($currentUser) }}"></div>

        <!-- Blade/Alpine Progressive Fallback Stream -->
        <div id="blade-feed-fallback" class="space-y-6">

        <!-- Post Creator Composer Box -->
        <div class="bg-[#121A29] border border-white/10 rounded-2xl p-4 sm:p-5 shadow-2xl relative">
            <div class="flex items-start gap-3">
                <div class="shrink-0">
                    @if($currentUser && $currentUser->avatar_url)
                        <img src="{{ $currentUser->avatar_url }}" alt="{{ $currentUser->name }}" class="w-10 h-10 rounded-xl object-cover border border-white/10 shadow" />
                    @else
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center font-bold text-sm text-white shadow">
                            {{ $currentUser ? $userInitials : 'ZC' }}
                        </div>
                    @endif
                </div>

                <div class="flex-1">
                    <textarea 
                        x-model="postContent"
                        rows="3"
                        placeholder="What is happening in your ward or neighborhood, {{ $currentUser ? strtok($currentUser->name, ' ') : 'Citizen' }}?"
                        class="w-full bg-white/[0.03] border border-white/10 rounded-xl p-3 text-sm text-gray-100 placeholder-gray-500 focus:outline-none focus:border-blue-500 focus:bg-white/[0.05] transition-all resize-none"></textarea>

                    <!-- Preview of Attached Media -->
                    <template x-if="attachedMedia.length > 0">
                        <div class="mt-2.5 flex items-center gap-2 flex-wrap">
                            <template x-for="(media, index) in attachedMedia" :key="index">
                                <div class="relative group rounded-xl overflow-hidden border border-white/20 w-24 h-24 bg-black/40 shadow-inner">
                                    <img :src="media.url" class="w-full h-full object-cover" />
                                    <button 
                                        type="button"
                                        @click="removeMedia(index)"
                                        class="absolute top-1.5 right-1.5 w-6 h-6 bg-red-600/90 hover:bg-red-500 text-white rounded-full flex items-center justify-center text-xs font-bold shadow-md transition cursor-pointer"
                                        title="Remove photo">
                                        ✕
                                    </button>
                                </div>
                            </template>
                        </div>
                    </template>

                    <!-- Error Alert -->
                    <template x-if="errorMessage">
                        <div class="mt-2.5 text-xs text-rose-400 bg-rose-500/10 border border-rose-500/20 rounded-xl px-3 py-2" x-text="errorMessage"></div>
                    </template>

                    <!-- Composer Action Toolbar -->
                    <div class="mt-3 pt-3 border-t border-white/[0.06] flex items-center justify-between flex-wrap gap-2">
                        <div class="flex items-center gap-2">
                            <!-- Image / Media Attach Button -->
                            <label class="cursor-pointer p-2 rounded-xl text-gray-400 hover:text-blue-400 hover:bg-white/[0.05] border border-transparent hover:border-white/10 transition-colors flex items-center gap-1.5 text-xs">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="hidden sm:inline">Photo</span>
                                <input 
                                    type="file" 
                                    x-ref="photoInput" 
                                    @change="attachMedia($event)" 
                                    accept="image/jpeg,image/png,image/webp,image/gif" 
                                    class="hidden" />
                            </label>

                            <!-- Ward Geo-Tag Selector -->
                            <div class="flex items-center gap-1 px-2.5 py-1.5 rounded-xl bg-blue-500/10 text-blue-300 text-xs font-medium border border-blue-500/20">
                                <span>📍</span>
                                <span>{{ $currentUser->ward_code ?? 'WARD-DHAKA-19' }}</span>
                            </div>
                        </div>

                        <!-- Publish Button -->
                        <button 
                            @click="publishPost()"
                            :disabled="(!postContent.trim() && attachedMedia.length === 0) || isSubmitting"
                            class="px-5 py-2 rounded-xl bg-blue-600 hover:bg-blue-500 disabled:opacity-40 disabled:hover:bg-blue-600 text-white text-xs font-bold transition-all shadow-lg shadow-blue-600/30 flex items-center gap-1.5 cursor-pointer">
                            <svg x-show="isSubmitting" class="w-3.5 h-3.5 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span x-text="isSubmitting ? 'Publishing...' : 'Publish'"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Timeline Stream Cards -->
        <div class="space-y-4">
            <!-- Empty state -->
            <template x-if="filteredPosts().length === 0">
                <div class="bg-[#121A29] border border-white/10 rounded-2xl p-10 text-center text-gray-400">
                    <span class="text-3xl block mb-2">🏙️</span>
                    <p class="font-bold text-sm text-gray-200">No posts in this feed yet</p>
                    <p class="text-xs text-gray-500 mt-1">Be the first to share an update or photo with your neighborhood!</p>
                </div>
            </template>

            <template x-for="post in filteredPosts()" :key="post.id">
                <article class="bg-[#121A29] border border-white/10 rounded-2xl p-5 shadow-xl backdrop-blur-xl transition hover:border-white/20">
                    
                    <!-- Post Header -->
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <div class="shrink-0">
                                <template x-if="post.authorAvatar">
                                    <img :src="post.authorAvatar" class="w-10 h-10 rounded-xl object-cover border border-white/10 shadow" />
                                </template>
                                <template x-if="!post.authorAvatar">
                                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-cyan-600 to-blue-600 flex items-center justify-center font-bold text-sm text-white shadow" x-text="post.authorInitials"></div>
                                </template>
                            </div>
                            <div>
                                <div class="flex items-center gap-1.5">
                                    <span class="text-sm font-bold text-white hover:underline cursor-pointer" x-text="post.authorName"></span>
                                    <template x-if="post.verified">
                                        <svg class="w-3.5 h-3.5 text-blue-400 shrink-0" fill="currentColor" viewBox="0 0 24 24" title="Smart NID Verified">
                                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                        </svg>
                                    </template>
                                </div>
                                <div class="flex items-center gap-2 text-[11px] text-gray-400">
                                    <span x-text="post.authorHandle"></span>
                                    <span>·</span>
                                    <span x-text="post.timeAgo"></span>
                                    <span>·</span>
                                    <span class="text-cyan-400 font-medium" x-text="post.wardCode"></span>
                                </div>
                            </div>
                        </div>

                        <span class="text-xs px-2.5 py-1 rounded-full bg-white/[0.04] border border-white/10 text-gray-400 font-mono" x-text="post.type"></span>
                    </div>

                    <!-- Post Body -->
                    <template x-if="post.content">
                        <p class="text-sm text-gray-200 leading-relaxed mb-3 whitespace-pre-line" x-text="post.content"></p>
                    </template>

                    <!-- Optional Media -->
                    <template x-if="post.image">
                        <div class="rounded-xl overflow-hidden mb-3 border border-white/10 bg-black/40">
                            <img :src="post.image" class="w-full max-h-96 object-contain bg-black/60 rounded-xl" loading="lazy" />
                        </div>
                    </template>

                    <!-- Post Footer Reactions -->
                    <div class="flex items-center justify-between pt-3 border-t border-white/[0.06] text-xs text-gray-400">
                        <button 
                            @click="toggleLike(post)"
                            :class="post.liked ? 'text-rose-400 font-semibold' : 'text-gray-400 hover:text-white'"
                            class="flex items-center gap-1.5 transition-colors focus:outline-none cursor-pointer">
                            <svg class="w-4 h-4 transition-transform active:scale-125" :fill="post.liked ? 'currentColor' : 'none'" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            <span x-text="post.likesCount"></span>
                        </button>

                        <div class="flex items-center gap-4">
                            <button class="flex items-center gap-1.5 hover:text-white transition-colors cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                <span x-text="post.commentsCount"></span>
                            </button>

                            <button class="hover:text-white transition-colors cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                </article>
            </template>
        </div>

        </div> <!-- /#blade-feed-fallback -->

    </div>

    <!-- ========================================== -->
    <!-- RIGHT COLUMN: Ward 19 Pulse & Notices      -->
    <!-- ========================================== -->
    <aside class="hidden lg:block lg:col-span-3 space-y-5 sticky top-24">

        <!-- Ward 19 Pulse Analytics Card -->
        <div class="bg-[#121A29]/90 border border-white/10 rounded-2xl p-5 shadow-xl backdrop-blur-xl">
            <div class="flex items-center justify-between mb-4">
                <h4 class="text-xs font-bold text-white uppercase tracking-wider flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
                    <span>Ward 19 Pulse</span>
                </h4>
                <span class="text-[10px] px-2 py-0.5 rounded-full bg-cyan-500/10 text-cyan-300 font-semibold border border-cyan-500/20">Gulshan</span>
            </div>

            <div class="space-y-3.5">
                <div class="flex items-center justify-between">
                    <span class="text-xs text-gray-400">Verified Citizens</span>
                    <span class="text-xs font-extrabold text-white">1,480+</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-xs text-gray-400">Civic Safety Index</span>
                    <span class="text-xs font-extrabold text-emerald-400">98.4%</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-xs text-gray-400">Hyperlocal Activity</span>
                    <span class="text-xs font-extrabold text-blue-400">High</span>
                </div>
            </div>
        </div>

        <!-- DNCC Civic Emergency Notice -->
        <div class="bg-gradient-to-br from-amber-500/10 via-[#121A29] to-[#121A29] border border-amber-500/30 rounded-2xl p-5 shadow-xl relative overflow-hidden">
            <div class="flex items-center gap-2 text-amber-400 text-xs font-bold uppercase tracking-wider mb-2">
                <span>⚠️</span>
                <span>DNCC Emergency Notice</span>
            </div>
            <p class="text-xs text-gray-300 leading-relaxed mb-3">
                Road maintenance work on Gulshan Avenue (Road 11 to 24) scheduled tonight from 11:00 PM to 5:00 AM. Expect diversions.
            </p>
            <div class="text-[10px] text-gray-400 font-medium">
                Issued by: Dhaka North City Corporation
            </div>
        </div>

    </aside>

</div>

@push('scripts')
@vite(['resources/js/react/main.jsx'])
<script>
function socialFeed() {
    return {
        activeFilter: 'all',
        postContent: '',
        isSubmitting: false,
        errorMessage: '',
        attachedMedia: [],
        attachedMediaFiles: [],
        posts: @json($initialPosts ?? [], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
        csrfToken: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',

        initFeed() {
            // Prepared for WebSocket subscription if needed
        },

        filterWard(filter) {
            this.activeFilter = filter;
        },

        filteredPosts() {
            if (this.activeFilter === 'all') {
                return this.posts;
            }
            if (this.activeFilter === 'notices') {
                return this.posts.filter(p => p.type === 'Announcement' || p.type === 'Hyperlocal_notice' || p.type === 'Civic');
            }
            return this.posts.filter(p => p.wardCode === this.activeFilter);
        },

        attachMedia(event) {
            const files = event.target.files;
            if (!files || files.length === 0) return;
            const file = files[0];

            if (file.size > 15 * 1024 * 1024) {
                this.errorMessage = 'Photo size must be less than 15MB.';
                return;
            }

            this.errorMessage = '';
            const previewUrl = URL.createObjectURL(file);
            this.attachedMedia = [{ url: previewUrl, name: file.name }];
            this.attachedMediaFiles = [file];
        },

        removeMedia(index) {
            this.attachedMedia.splice(index, 1);
            this.attachedMediaFiles.splice(index, 1);
            if (this.$refs.photoInput) {
                this.$refs.photoInput.value = '';
            }
        },

        async publishPost() {
            if (!this.postContent.trim() && this.attachedMediaFiles.length === 0) return;

            @guest
                window.location.href = '/login';
                return;
            @endguest

            this.isSubmitting = true;
            this.errorMessage = '';

            try {
                const formData = new FormData();
                if (this.postContent.trim()) {
                    formData.append('content', this.postContent.trim());
                }
                formData.append('ward_code', '{{ $currentUser->ward_code ?? 'WARD-DHAKA-19' }}');

                if (this.attachedMediaFiles.length > 0) {
                    formData.append('image', this.attachedMediaFiles[0]);
                }

                formData.append('_token', this.csrfToken);

                const response = await fetch('/posts', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': this.csrfToken
                    }
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'Failed to publish post. Please try again.');
                }

                const newPostData = result.data;
                const firstMedia = (newPostData.media && newPostData.media.length > 0) ? newPostData.media[0] : null;
                const author = newPostData.user || {};

                const nameParts = (author.name || '{{ $currentUser->name ?? 'Citizen' }}').trim().split(' ');
                const initials = nameParts.length > 1
                    ? (nameParts[0][0] + nameParts[nameParts.length - 1][0]).toUpperCase()
                    : nameParts[0].substring(0, 2).toUpperCase();

                const formatted = {
                    id: String(newPostData.id),
                    authorName: author.name || '{{ $currentUser->name ?? 'Citizen' }}',
                    authorHandle: '@' + (author.handle || '{{ $currentUser->handle ?? 'citizen' }}'),
                    authorInitials: initials,
                    authorAvatar: author.avatar_url || '{{ $currentUser->avatar_url ?? null }}',
                    verified: Boolean(author.verified_badge || author.nid_verified),
                    timeAgo: 'Just now',
                    wardCode: newPostData.ward_code || 'WARD-DHAKA-19',
                    type: (newPostData.post_type || 'standard').charAt(0).toUpperCase() + (newPostData.post_type || 'standard').slice(1),
                    content: newPostData.content || '',
                    image: firstMedia ? firstMedia.url : null,
                    likesCount: parseInt(newPostData.likes_count || 0),
                    commentsCount: parseInt(newPostData.comments_count || 0),
                    liked: false
                };

                this.posts.unshift(formatted);
                this.postContent = '';
                this.attachedMedia = [];
                this.attachedMediaFiles = [];
                if (this.$refs.photoInput) {
                    this.$refs.photoInput.value = '';
                }
            } catch (err) {
                this.errorMessage = err.message || 'Network error occurred.';
            } finally {
                this.isSubmitting = false;
            }
        },

        async toggleLike(post) {
            @guest
                window.location.href = '/login';
                return;
            @endguest

            const originalLiked = post.liked;
            const originalCount = post.likesCount;

            post.liked = !post.liked;
            post.likesCount += post.liked ? 1 : -1;

            try {
                const response = await fetch('/posts/' + post.id + '/like', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': this.csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (!response.ok) {
                    post.liked = originalLiked;
                    post.likesCount = originalCount;
                } else {
                    const res = await response.json();
                    if (res.data) {
                        post.liked = res.data.liked;
                        post.likesCount = res.data.likes_count;
                    }
                }
            } catch (e) {
                post.liked = originalLiked;
                post.likesCount = originalCount;
            }
        }
    };
}
</script>
@endpush
@endsection
