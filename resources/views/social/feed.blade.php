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
        <div class="bg-[#121A29]/90 border border-white/10 rounded-2xl p-5 shadow-xl backdrop-blur-xl relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-600 via-indigo-500 to-cyan-400"></div>
            
            <div class="flex items-center gap-3 mb-4">
                <div class="relative">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-base font-extrabold text-white shadow-md shadow-blue-500/20">
                        SH
                    </div>
                    <span class="absolute -bottom-1 -right-1 w-4 h-4 rounded-full bg-blue-500 border-2 border-[#121A29] flex items-center justify-center text-[9px] text-white font-bold" title="Smart NID Verified">
                        ✓
                    </span>
                </div>
                <div class="overflow-hidden">
                    <h3 class="text-sm font-bold text-white truncate flex items-center gap-1">
                        <span>Sazzad Hossain</span>
                    </h3>
                    <p class="text-xs text-gray-400 truncate">@sazzad</p>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-2 py-3 border-y border-white/[0.08] text-center mb-4">
                <div>
                    <div class="text-xs font-extrabold text-white">350</div>
                    <div class="text-[10px] text-gray-400 font-medium">Followers</div>
                </div>
                <div>
                    <div class="text-xs font-extrabold text-white">195</div>
                    <div class="text-[10px] text-gray-400 font-medium">Following</div>
                </div>
                <div>
                    <div class="text-xs font-extrabold text-white">88</div>
                    <div class="text-[10px] text-gray-400 font-medium">Friends</div>
                </div>
            </div>

            <a href="/u/sazzad" class="w-full py-2 px-3 rounded-xl bg-white/[0.04] hover:bg-white/[0.08] text-xs font-semibold text-gray-200 border border-white/10 transition-colors flex items-center justify-center gap-1.5">
                <span>View My Profile</span>
                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

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

        <!-- Post Creator Composer Box -->
        <div class="bg-[#121A29] border border-white/10 rounded-2xl p-4 sm:p-5 shadow-2xl relative">
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center font-bold text-sm text-white shrink-0 shadow">
                    SH
                </div>

                <div class="flex-1">
                    <textarea 
                        x-model="postContent"
                        rows="3"
                        placeholder="What is happening in your ward or neighborhood, Sazzad?"
                        class="w-full bg-white/[0.03] border border-white/10 rounded-xl p-3 text-sm text-gray-100 placeholder-gray-500 focus:outline-none focus:border-blue-500 focus:bg-white/[0.05] transition-all resize-none"></textarea>

                    <!-- Preview of Attached Media -->
                    <template x-if="attachedMedia.length > 0">
                        <div class="mt-2.5 flex items-center gap-2 flex-wrap">
                            <template x-for="(media, index) in attachedMedia" :key="index">
                                <div class="relative group rounded-lg overflow-hidden border border-white/10 w-16 h-16 bg-black">
                                    <img :src="media.url" class="w-full h-full object-cover" />
                                    <button 
                                        @click="removeMedia(index)"
                                        class="absolute top-1 right-1 w-4 h-4 bg-red-600 rounded-full text-white text-[10px] flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                        ×
                                    </button>
                                </div>
                            </template>
                        </div>
                    </template>

                    <!-- Composer Action Toolbar -->
                    <div class="mt-3 pt-3 border-t border-white/[0.06] flex items-center justify-between flex-wrap gap-2">
                        <div class="flex items-center gap-2">
                            <!-- Image / Media Attach Button -->
                            <label class="cursor-pointer p-2 rounded-xl text-gray-400 hover:text-blue-400 hover:bg-white/[0.05] border border-transparent hover:border-white/10 transition-colors flex items-center gap-1.5 text-xs">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="hidden sm:inline">Photo</span>
                                <input type="file" @change="attachMockMedia($event)" accept="image/*" class="hidden" />
                            </label>

                            <!-- Ward Geo-Tag Selector -->
                            <div class="flex items-center gap-1 px-2.5 py-1.5 rounded-xl bg-blue-500/10 text-blue-300 text-xs font-medium border border-blue-500/20">
                                <span>📍</span>
                                <span>WARD-DHAKA-19</span>
                            </div>
                        </div>

                        <!-- Publish Button -->
                        <button 
                            @click="publishPost()"
                            :disabled="!postContent.trim() || isSubmitting"
                            class="px-5 py-2 rounded-xl bg-blue-600 hover:bg-blue-500 disabled:opacity-40 disabled:hover:bg-blue-600 text-white text-xs font-bold transition-all shadow-lg shadow-blue-600/30 flex items-center gap-1.5 cursor-pointer">
                            <span x-text="isSubmitting ? 'Publishing...' : 'Publish'"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Timeline Stream Cards -->
        <div class="space-y-4">
            <template x-for="post in posts" :key="post.id">
                <article class="bg-[#121A29] border border-white/10 rounded-2xl p-5 shadow-xl backdrop-blur-xl transition hover:border-white/20">
                    
                    <!-- Post Header -->
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-cyan-600 to-blue-600 flex items-center justify-center font-bold text-sm text-white shadow" x-text="post.authorInitials"></div>
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
                    <p class="text-sm text-gray-200 leading-relaxed mb-3 whitespace-pre-line" x-text="post.content"></p>

                    <!-- Optional Media -->
                    <template x-if="post.image">
                        <div class="rounded-xl overflow-hidden mb-3 border border-white/10 bg-black/40 max-h-72">
                            <img :src="post.image" class="w-full h-full object-cover" />
                        </div>
                    </template>

                    <!-- Post Footer Reactions -->
                    <div class="flex items-center justify-between pt-3 border-t border-white/[0.06] text-xs text-gray-400">
                        <button 
                            @click="toggleLike(post)"
                            :class="post.liked ? 'text-rose-400 font-semibold' : 'text-gray-400 hover:text-white'"
                            class="flex items-center gap-1.5 transition-colors focus:outline-none">
                            <svg class="w-4 h-4 transition-transform active:scale-125" :fill="post.liked ? 'currentColor' : 'none'" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            <span x-text="post.likesCount"></span>
                        </button>

                        <div class="flex items-center gap-4">
                            <button class="flex items-center gap-1.5 hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                <span x-text="post.commentsCount"></span>
                            </button>

                            <button class="hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                </article>
            </template>
        </div>

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
<script>
function socialFeed() {
    return {
        activeFilter: 'all',
        postContent: '',
        isSubmitting: false,
        attachedMedia: [],
        posts: [
            {
                id: '1',
                authorName: 'Sazzad Hossain',
                authorHandle: '@sazzad',
                authorInitials: 'SH',
                verified: true,
                timeAgo: '10m ago',
                wardCode: 'WARD-DHAKA-19',
                type: 'Civic',
                content: 'Welcome to Zengfy Social Sovereign Network! Verified citizen accounts, hyperlocal neighborhood security, and civic alerts all unified.',
                image: null,
                likesCount: 24,
                commentsCount: 5,
                liked: false
            },
            {
                id: '2',
                authorName: 'Gulshan Ward Inspector',
                authorHandle: '@ward19_admin',
                authorInitials: 'WI',
                verified: true,
                timeAgo: '1h ago',
                wardCode: 'WARD-DHAKA-19',
                type: 'Announcement',
                content: 'DNCC Emergency mosquito prevention spraying routine will take place today across Sector 2 from 4:30 PM.',
                image: null,
                likesCount: 42,
                commentsCount: 12,
                liked: true
            }
        ],
        initFeed() {
            // Prepared for Echo subscription if needed
        },
        filterWard(filter) {
            this.activeFilter = filter;
        },
        attachMockMedia(event) {
            const file = event.target.files[0];
            if (file) {
                const url = URL.createObjectURL(file);
                this.attachedMedia.push({ url, file });
            }
        },
        removeMedia(index) {
            this.attachedMedia.splice(index, 1);
        },
        publishPost() {
            if (!this.postContent.trim()) return;
            this.isSubmitting = true;

            setTimeout(() => {
                this.posts.unshift({
                    id: String(Date.now()),
                    authorName: 'Sazzad Hossain',
                    authorHandle: '@sazzad',
                    authorInitials: 'SH',
                    verified: true,
                    timeAgo: 'Just now',
                    wardCode: 'WARD-DHAKA-19',
                    type: 'Citizen',
                    content: this.postContent,
                    image: this.attachedMedia.length > 0 ? this.attachedMedia[0].url : null,
                    likesCount: 0,
                    commentsCount: 0,
                    liked: false
                });

                this.postContent = '';
                this.attachedMedia = [];
                this.isSubmitting = false;
            }, 300);
        },
        toggleLike(post) {
            post.liked = !post.liked;
            post.likesCount += post.liked ? 1 : -1;
        }
    };
}
</script>
@endpush
@endsection
