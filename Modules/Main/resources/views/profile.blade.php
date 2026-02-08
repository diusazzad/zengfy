<x-main::layouts.app>
    <div class="max-w-7xl mx-auto pt-4 px-4 sm:px-6 lg:px-8">
        <!-- Profile Header -->
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm overflow-hidden mb-6">
            <!-- Cover Photo Placeholder -->
            <div class="h-48 md:h-64 bg-gradient-to-r from-blue-400 to-indigo-500 relative">
                @if(Auth::id() === $user->id)
                    <button
                        class="absolute bottom-4 right-4 bg-black/20 hover:bg-black/40 text-white px-4 py-2 rounded-xl text-xs font-bold backdrop-blur-sm transition">
                        Change Cover
                    </button>
                @endif
            </div>

            <div class="px-6 pb-6 relative">
                <!-- Avatar -->
                <div class="absolute -top-16 left-6">
                    <div class="relative group">
                        <img class="w-32 h-32 md:w-40 md:h-40 rounded-full border-4 border-white dark:border-gray-800 shadow-lg object-cover"
                            src="{{ $user->avatar ?: 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=0D8ABC&color=fff&size=200' }}"
                            alt="{{ $user->name }}">
                        @if(Auth::id() === $user->id)
                            <a href="{{ route('account') }}"
                                class="absolute inset-0 flex items-center justify-center bg-black/40 rounded-full opacity-0 group-hover:opacity-100 transition">
                                <span class="text-white text-xs font-bold">Edit Profile</span>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Profile Info -->
                <div class="pt-20 md:pt-4 md:ml-48 flex flex-col md:flex-row md:items-end md:justify-between gap-4">
                    <div>
                        <h1
                            class="text-2xl md:text-3xl font-extrabold text-gray-900 dark:text-white flex items-center gap-2">
                            {{ $user->name }}
                            @if($user->nid_verified)
                                <span class="text-blue-500" title="Verified Identity">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.64.304 1.25.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" />
                                    </svg>
                                </span>
                            @endif
                        </h1>
                        <p class="text-gray-500 dark:text-gray-400 font-medium">@
                            {{ strtolower(str_replace(' ', '', $user->name)) }}</p>
                    </div>

                    <div class="flex gap-2">
                        @if(Auth::id() === $user->id)
                            <a href="{{ route('account') }}"
                                class="px-6 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 text-gray-900 dark:text-white rounded-xl text-sm font-bold transition">
                                Edit Profile
                            </a>
                        @else
                            <button
                                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-bold shadow-lg shadow-blue-500/20 transition">
                                Follow
                            </button>
                            <button
                                class="px-4 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 text-gray-900 dark:text-white rounded-xl text-sm font-bold transition">
                                Message
                            </button>
                        @endif
                    </div>
                </div>

                <!-- Bio & Stats -->
                <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-1 space-y-4">
                        <div class="bg-gray-50 dark:bg-gray-900/50 p-4 rounded-2xl">
                            <h3 class="font-bold text-gray-900 dark:text-white mb-2">About</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Welcome to my profile on ZenGFY!</p>
                            <div class="mt-4 space-y-2">
                                <div class="flex items-center gap-2 text-sm text-gray-500">
                                    <span>📍</span> Dhaka, Bangladesh
                                </div>
                                <div class="flex items-center gap-2 text-sm text-gray-500">
                                    <span>🗓️</span> Joined {{ $user->created_at->format('M Y') }}
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-around bg-gray-50 dark:bg-gray-900/50 p-4 rounded-2xl">
                            <div class="text-center">
                                <p class="text-xl font-black text-gray-900 dark:text-white">{{ $posts->count() }}</p>
                                <p class="text-[10px] text-gray-500 uppercase font-bold tracking-widest">Posts</p>
                            </div>
                            <div class="text-center">
                                <p class="text-xl font-black text-gray-900 dark:text-white">0</p>
                                <p class="text-[10px] text-gray-500 uppercase font-bold tracking-widest">Followers</p>
                            </div>
                            <div class="text-center">
                                <p class="text-xl font-black text-gray-900 dark:text-white">0</p>
                                <p class="text-[10px] text-gray-500 uppercase font-bold tracking-widest">Following</p>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Feed -->
                    <div class="md:col-span-2 space-y-6">
                        @if($posts->isEmpty())
                            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm p-12 text-center">
                                <div class="text-5xl mb-4">📸</div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">No posts yet</h3>
                                <p class="text-gray-500 mt-2">When
                                    {{ $user->id === Auth::id() ? 'you share' : $user->name . ' shares' }} a post, it will
                                    appear here.</p>
                            </div>
                        @else
                            @foreach($posts as $post)
                                <!-- Reusable Post Component Logic (Simplified here for now, could be a component) -->
                                <div
                                    class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700">
                                    <div class="p-4 flex items-center justify-between">
                                        <div class="flex items-center space-x-3">
                                            <img class="w-10 h-10 rounded-full object-cover"
                                                src="{{ $post->user->avatar ?: 'https://ui-avatars.com/api/?name=' . urlencode($post->user->name) }}"
                                                alt="">
                                            <div>
                                                <h4 class="font-bold text-gray-900 dark:text-white text-sm">
                                                    {{ $post->user->name }}
                                                </h4>
                                                <p class="text-[10px] text-gray-500">{{ $post->created_at->diffForHumans() }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="px-4 pb-4">
                                        <p class="text-gray-800 dark:text-gray-200 text-sm whitespace-pre-line">
                                            {{ $post->body }}</p>
                                    </div>
                                    @if($post->image_path)
                                        <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden">
                                            <img class="w-full h-auto max-h-[500px] object-contain" src="{{ $post->image_path }}"
                                                alt="Post Image">
                                        </div>
                                    @endif
                                    <!-- Actions -->
                                    <div class="px-4 py-3 border-t border-gray-100 dark:border-gray-700 flex justify-between text-gray-500 text-sm"
                                        x-data="{ 
                                            liked: {{ $post->likes->contains('user_id', auth()->id()) ? 'true' : 'false' }}, 
                                            likesCount: {{ $post->likes_count }},
                                            async toggleLike() {
                                                const response = await fetch('{{ route('posts.like', $post->id) }}', {
                                                    method: 'POST',
                                                    headers: {
                                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                        'Accept': 'application/json'
                                                    }
                                                });
                                                const data = await response.json();
                                                this.liked = data.status === 'liked';
                                                this.likesCount = data.likes_count;
                                            }
                                         }">
                                        <button @click="toggleLike()" :class="liked ? 'text-blue-500' : 'hover:text-blue-500'"
                                            class="flex items-center space-x-2 transition">
                                            <span class="text-lg" x-text="liked ? '👍' : '👍'"></span>
                                            <span class="font-medium" x-text="likesCount > 0 ? likesCount + ' Like' : 'Like'"></span>
                                        </button>
                                        <button @click="$dispatch('toggle-comments-{{ $post->id }}')"
                                            class="flex items-center space-x-2 hover:text-blue-500 transition">
                                            <span class="text-lg">💬</span>
                                            <span
                                                class="font-medium">{{ $post->comments_count > 0 ? $post->comments_count . ' Comment' : 'Comment' }}</span>
                                        </button>
                                        <button class="flex items-center space-x-2 hover:text-blue-500 transition">
                                            <span class="text-lg">↗</span>
                                            <span class="font-medium">Share</span>
                                        </button>
                                    </div>

                                    <!-- Comments Section -->
                                    <div x-data="{ open: false }" x-on:toggle-comments-{{ $post->id }}.window="open = !open" x-show="open"
                                        x-cloak
                                        class="border-t border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/50 p-4 space-y-4">

                                        <!-- Comment List -->
                                        <div class="space-y-3">
                                            @foreach($post->comments as $comment)
                                                <div class="flex space-x-3">
                                                    <img class="w-8 h-8 rounded-full object-cover"
                                                        src="{{ $comment->user->avatar ?: 'https://ui-avatars.com/api/?name=' . urlencode($comment->user->name) }}"
                                                        alt="">
                                                    <div class="flex-1 bg-white dark:bg-gray-800 p-3 rounded-2xl shadow-sm">
                                                        <div class="flex justify-between items-center mb-1">
                                                            <h5 class="text-xs font-bold text-gray-900 dark:text-white">
                                                                {{ $comment->user->name }}
                                                            </h5>
                                                            <span
                                                                class="text-[10px] text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                                        </div>
                                                        <p class="text-xs text-gray-700 dark:text-gray-300">{{ $comment->body }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <!-- Add Comment -->
                                        <form action="{{ route('posts.comment', $post->id) }}" method="POST"
                                            class="flex items-start space-x-3 pt-2">
                                            @csrf
                                            <img class="w-8 h-8 rounded-full object-cover"
                                                src="{{ Auth::user()->avatar ?: 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                                                alt="">
                                            <div class="flex-1 relative">
                                                <textarea name="body" placeholder="Write a comment..."
                                                    class="w-full bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-xl px-4 py-2 text-xs focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-white resize-none"
                                                    rows="1" required></textarea>
                                                <button type="submit" class="absolute right-2 top-2 text-blue-500 hover:text-blue-600">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-main::layouts.app>