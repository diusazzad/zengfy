@extends('layouts.social')

@section('title', ($user->name ?? 'Citizen Profile') . ' (@' . ($user->handle ?? 'citizen') . ') | Zengfy Social')
@section('meta_description', 'View sovereign citizen profile, hyperlocal activity, and verified civic contributions on Zengfy.')

@section('content')
<div x-data="citizenProfile()" class="max-w-4xl mx-auto space-y-6 pb-16 md:pb-6">

    <!-- Profile Header Card -->
    <div class="bg-[#121A29]/95 border border-white/10 rounded-3xl overflow-hidden shadow-2xl backdrop-blur-2xl">
        
        <!-- Cover Banner with Sovereign Gradient -->
        <div class="h-44 sm:h-56 w-full bg-gradient-to-r from-blue-700 via-indigo-700 to-cyan-500 relative">
            <div class="absolute inset-0 bg-black/20"></div>
            <!-- Subtle geometric grid -->
            <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff10_1px,transparent_1px),linear-gradient(to_bottom,#ffffff10_1px,transparent_1px)] bg-[size:2rem_2rem]"></div>
            
            <!-- Hyperlocal Ward Tag Overlay -->
            <div class="absolute top-4 right-4 px-3 py-1 rounded-full bg-black/40 backdrop-blur-md border border-white/20 text-xs text-white font-medium flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                <span>{{ $user->ward_code ?? 'WARD-DHAKA-19' }}</span>
                <span class="text-gray-300">· Gulshan</span>
            </div>
        </div>

        <!-- Citizen Identity & Bio Section -->
        <div class="px-6 pb-6 pt-0 relative">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 -mt-16 sm:-mt-20 mb-5">
                
                <!-- Avatar with Blue Verified Badge & Upload Hover -->
                <div class="relative group/avatar">
                    <div class="w-28 h-28 sm:w-32 sm:h-32 rounded-3xl bg-gradient-to-tr from-blue-600 via-indigo-600 to-cyan-400 p-1 shadow-2xl border-4 border-[#121A29] overflow-hidden">
                        <template x-if="avatarPreview">
                            <img :src="avatarPreview" alt="{{ $user->name ?? 'Citizen' }}" class="w-full h-full object-cover rounded-[20px]">
                        </template>
                        <template x-if="!avatarPreview">
                            <div class="w-full h-full rounded-[20px] bg-[#0B0F17] flex items-center justify-center text-3xl font-black text-white">
                                {{ strtoupper(substr($user->name ?? 'SH', 0, 2)) }}
                            </div>
                        </template>
                    </div>

                    @auth
                    @if(Auth::id() === ($user->id ?? null) || Auth::user()?->handle === ($user->handle ?? null) || !isset($user->id))
                    <!-- Camera Quick Upload Overlay -->
                    <label for="profile-avatar-input" 
                           title="ছবি আপলোড করুন"
                           class="absolute inset-0 rounded-3xl bg-black/60 opacity-0 group-hover/avatar:opacity-100 transition-all flex flex-col items-center justify-center text-white cursor-pointer backdrop-blur-[2px]">
                        <svg class="w-7 h-7 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="text-[10px] font-bold text-gray-200 mt-1" x-text="avatarUploading ? 'আপলোড হচ্ছে...' : 'ছবি পরিবর্তন'"></span>
                    </label>
                    <input type="file" id="profile-avatar-input" accept="image/jpeg,image/png,image/webp,image/gif" class="hidden" @change="uploadAvatar($event)">
                    @endif
                    @endauth
                    
                    <!-- Blue Citizen Badge -->
                    <div class="absolute bottom-1 right-1 w-8 h-8 rounded-full bg-blue-500 border-4 border-[#121A29] flex items-center justify-center text-white shadow-lg pointer-events-none" title="Smart NID Verified Sovereign Citizen">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                        </svg>
                    </div>
                </div>

                <!-- Action Buttons: Follow / Friend / Message OR Owner Controls -->
                <div class="flex items-center gap-2.5 flex-wrap">
                    @auth
                    @if(Auth::id() === ($user->id ?? null) || Auth::user()?->handle === ($user->handle ?? null) || !isset($user->id))
                        <label for="profile-avatar-input" class="px-4 py-2.5 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white font-bold text-xs shadow-lg shadow-blue-500/25 transition-all flex items-center gap-2 cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            <span>ছবি আপলোড করুন</span>
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
                    <button 
                        @click="toggleFollow()" 
                        :class="isFollowing ? 'bg-white/10 hover:bg-white/15 text-white border-white/20' : 'bg-blue-600 hover:bg-blue-500 text-white shadow-lg shadow-blue-600/30 border-transparent'"
                        class="px-5 py-2.5 rounded-xl text-xs font-bold border transition-all flex items-center gap-1.5 cursor-pointer">
                        <span x-text="isFollowing ? '✓ Following' : '+ Follow'"></span>
                    </button>
                    @endif
                    @else
                    <button 
                        @click="toggleFollow()" 
                        :class="isFollowing ? 'bg-white/10 hover:bg-white/15 text-white border-white/20' : 'bg-blue-600 hover:bg-blue-500 text-white shadow-lg shadow-blue-600/30 border-transparent'"
                        class="px-5 py-2.5 rounded-xl text-xs font-bold border transition-all flex items-center gap-1.5 cursor-pointer">
                        <span x-text="isFollowing ? '✓ Following' : '+ Follow'"></span>
                    </button>
                    @endauth

                    <button 
                        @click="toggleFriendRequest()" 
                        :class="friendStatus === 'friends' ? 'bg-emerald-600/20 text-emerald-400 border-emerald-500/30' : (friendStatus === 'pending' ? 'bg-amber-500/20 text-amber-300 border-amber-500/30' : 'bg-white/[0.04] hover:bg-white/[0.08] text-gray-200 border-white/10')"
                        class="px-4 py-2.5 rounded-xl text-xs font-semibold border transition-all flex items-center gap-1.5 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        <span x-text="friendStatus === 'friends' ? '👥 Friends' : (friendStatus === 'pending' ? '⏳ Request Sent' : 'Add Friend')"></span>
                    </button>

                    <button class="p-2.5 rounded-xl bg-white/[0.04] hover:bg-white/[0.08] border border-white/10 text-gray-300 hover:text-white transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </button>
                </div>

            </div>

            <!-- Citizen Details -->
            <div class="space-y-3">
                <div>
                    <h1 class="text-xl sm:text-2xl font-black text-white flex items-center gap-2">
                        <span>{{ $user->name ?? 'Sazzad Hossain' }}</span>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-bold bg-blue-500/15 text-blue-400 border border-blue-500/30">
                            🛡️ Sovereign Citizen
                        </span>
                    </h1>
                    <p class="text-sm font-semibold text-gray-400 mt-0.5">
                        {{ '@' . ($user->handle ?? 'sazzad') }}
                    </p>
                </div>

                <!-- Bio -->
                <p class="text-sm text-gray-300 leading-relaxed max-w-2xl">
                    {{ $user->bio ?? 'Lead Architect of Zengfy Ecosystem. Building Bangladesh sovereign digital infrastructure with zero bot farms and cryptographically verified civic identity.' }}
                </p>

                <!-- Metadata Row -->
                <div class="flex flex-wrap items-center gap-4 text-xs text-gray-400 pt-1">
                    <div class="flex items-center gap-1.5">
                        <span class="text-gray-300">📍</span>
                        <span>{{ $user->ward_code ?? 'WARD-DHAKA-19' }}, Dhaka North</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="text-gray-300">📅</span>
                        <span>Joined September 2026</span>
                    </div>
                    <div class="flex items-center gap-1.5 text-blue-400">
                        <span>🔒</span>
                        <span>NID AES-256 HMAC Verified</span>
                    </div>
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

        <!-- Navigation Tabs -->
        <div class="flex items-center px-6 border-t border-white/[0.08] bg-black/20">
            <button 
                @click="activeTab = 'posts'" 
                :class="activeTab === 'posts' ? 'text-blue-400 border-blue-500' : 'text-gray-400 hover:text-white border-transparent'"
                class="py-3.5 px-4 text-xs font-bold border-b-2 transition-all">
                Posts ({{ count($posts ?? []) > 0 ? count($posts) : 3 }})
            </button>
            <button 
                @click="activeTab = 'media'" 
                :class="activeTab === 'media' ? 'text-blue-400 border-blue-500' : 'text-gray-400 hover:text-white border-transparent'"
                class="py-3.5 px-4 text-xs font-bold border-b-2 transition-all">
                Media & Photos
            </button>
            <button 
                @click="activeTab = 'notices'" 
                :class="activeTab === 'notices' ? 'text-blue-400 border-blue-500' : 'text-gray-400 hover:text-white border-transparent'"
                class="py-3.5 px-4 text-xs font-bold border-b-2 transition-all">
                Civic Notices
            </button>
        </div>

    </div>

    <!-- Posts Stream by Citizen -->
    <div x-show="activeTab === 'posts'" class="space-y-4">
        
        <template x-for="post in citizenPosts" :key="post.id">
            <article class="bg-[#121A29]/90 border border-white/10 rounded-2xl p-5 shadow-xl backdrop-blur-xl transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-xl overflow-hidden bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center font-bold text-white text-xs shrink-0">
                            <template x-if="avatarPreview">
                                <img :src="avatarPreview" alt="Avatar" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!avatarPreview">
                                <span>{{ strtoupper(substr($user->name ?? 'SH', 0, 2)) }}</span>
                            </template>
                        </div>
                        <div>
                            <div class="text-xs font-bold text-white flex items-center gap-1">
                                <span>{{ $user->name ?? 'Sazzad Hossain' }}</span>
                                <svg class="w-3.5 h-3.5 text-blue-400" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                            </div>
                            <span class="text-[10px] text-gray-400" x-text="post.time_ago + ' · ' + post.ward_code"></span>
                        </div>
                    </div>
                    <span class="px-2 py-0.5 rounded bg-blue-500/10 text-blue-300 text-[10px] font-mono">
                        Verified
                    </span>
                </div>

                <div class="text-sm text-gray-200 leading-relaxed mb-3 whitespace-pre-line" x-text="post.content"></div>

                <!-- Media (If any) -->
                <template x-if="post.media && post.media.length > 0">
                    <div class="mb-3 rounded-xl overflow-hidden border border-white/10">
                        <img :src="post.media[0].url" class="w-full max-h-80 object-cover" />
                    </div>
                </template>

                <div class="flex items-center gap-6 pt-3 border-t border-white/[0.06] text-xs text-gray-400">
                    <button class="flex items-center gap-1.5 text-rose-400">
                        <span>❤️</span>
                        <span x-text="post.likes_count"></span>
                    </button>
                    <button class="flex items-center gap-1.5 hover:text-white">
                        <span>💬</span>
                        <span x-text="post.comments_count"></span>
                    </button>
                </div>
            </article>
        </template>

    </div>

    <!-- Media Tab Placeholder -->
    <div x-show="activeTab === 'media'" x-cloak class="p-8 text-center bg-[#121A29]/90 border border-white/10 rounded-2xl text-gray-400 text-xs">
        <span>📸 Photo gallery and verified media attachments uploaded by {{ $user->name ?? 'citizen' }}.</span>
    </div>

    <!-- Civic Notices Tab Placeholder -->
    <div x-show="activeTab === 'notices'" x-cloak class="p-8 text-center bg-[#121A29]/90 border border-white/10 rounded-2xl text-gray-400 text-xs">
        <span>📢 Official civic issues and hyperlocal notices reported by this citizen.</span>
    </div>

</div>
@endsection

@push('scripts')
<script>
function citizenProfile() {
    return {
        activeTab: 'posts',
        isFollowing: false,
        friendStatus: 'none', // 'none', 'pending', 'friends'
        followersCount: {{ $user->followers_count ?? 348 }},
        followingCount: {{ $user->following_count ?? 192 }},
        friendsCount: {{ $user->friends_count ?? 84 }},

        avatarPreview: '{{ $user->avatar_url ?? "" }}',
        avatarUploading: false,

        async uploadAvatar(event) {
            const file = event.target.files[0];
            if (!file) return;

            this.avatarPreview = URL.createObjectURL(file);
            this.avatarUploading = true;

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
                    setTimeout(() => window.location.reload(), 500);
                } else {
                    alert(data.message || 'Failed to upload photo.');
                }
            } catch (err) {
                alert('Network error while uploading photo.');
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
                } else {
                    alert('Failed to remove photo.');
                }
            } catch (err) {
                alert('Network error while removing photo.');
            } finally {
                this.avatarUploading = false;
            }
        },

        citizenPosts: [
            {
                id: 'cp-1',
                content: 'Zengfy 10M Scale Architecture deployed! Distributed multi-tenancy, cross-subdomain SSO, and sovereign data residency for Bangladesh.',
                ward_code: 'WARD-DHAKA-19',
                time_ago: '1d ago',
                likes_count: 56,
                comments_count: 14,
                media: []
            },
            {
                id: 'cp-2',
                content: 'Inspected the community surveillance and fiber optics routing in Gulshan Sector 2 with DNCC ward delegates. Transparency first!',
                ward_code: 'WARD-DHAKA-19',
                time_ago: '3d ago',
                likes_count: 32,
                comments_count: 8,
                media: [
                    { url: 'https://images.unsplash.com/photo-1517649763962-0c623266ddc0?auto=format&fit=crop&w=800&q=80' }
                ]
            }
        ],

        toggleFollow() {
            this.isFollowing = !this.isFollowing;
            this.followersCount += this.isFollowing ? 1 : -1;
        },

        toggleFriendRequest() {
            if (this.friendStatus === 'none') {
                this.friendStatus = 'pending';
            } else if (this.friendStatus === 'pending') {
                this.friendStatus = 'friends';
                this.friendsCount++;
            } else {
                this.friendStatus = 'none';
                this.friendsCount--;
            }
        }
    }
}
</script>
@endpush
