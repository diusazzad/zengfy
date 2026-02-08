<x-main::layouts.app>
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 max-w-7xl mx-auto pt-4">

        <!-- LEFT SIDEBAR (Navigation) -->
        <div class="hidden lg:block lg:col-span-1 space-y-4">
            <!-- Mini Profile -->
            <a href="{{ route('profile', Auth::id()) }}"
                class="bg-white dark:bg-gray-800 rounded-xl shadow p-4 flex items-center space-x-3 hover:bg-gray-50 transition">
                <img class="w-12 h-12 rounded-full"
                    src="{{ Auth::user()->avatar ?: 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=random' }}"
                    alt="User">
                <div>
                    <h3 class="font-bold text-gray-900 dark:text-gray-100">{{ Auth::user()->name }}</h3>
                    <p class="text-xs text-gray-500">Free Account</p>
                </div>
            </a>

            <!-- Menu -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">
                <nav class="flex flex-col">
                    <a href="#"
                        class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <span class="text-xl mr-3">📰</span> News Feed
                    </a>
                    <a href="#"
                        class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <span class="text-xl mr-3">👥</span> Friends
                    </a>
                    <a href="#"
                        class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <span class="text-xl mr-3">👨‍👩‍👧‍👦</span> Groups
                    </a>
                    <a href="#"
                        class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <span class="text-xl mr-3">🏪</span> Marketplace
                    </a>
                    <a href="#"
                        class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <span class="text-xl mr-3">📺</span> Watch
                    </a>
                    <a href="#"
                        class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <span class="text-xl mr-3">🔖</span> Saved
                    </a>
                </nav>
            </div>
        </div>

        <!-- MAIN FEED (Center) -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Create Post -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-4">
                @if(!auth()->user()->nid_verified)
                    <div class="mb-4 p-3 bg-amber-50 border border-amber-200 rounded-xl flex items-center gap-3">
                        <span class="text-xl">⚠️</span>
                        <div class="text-xs text-amber-800">
                            <p class="font-bold">পরিচয় যাচাই প্রয়োজন</p>
                            <p>পোস্ট করার জন্য আপনার National ID ভেরিফিকেশন সম্পন্ন করতে হবে। <a
                                    href="{{ route('account') }}" class="underline font-bold">এখান থেকে আপলোড করুন</a>।</p>
                        </div>
                    </div>
                @endif
                <form action="{{ route('main.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex space-x-4">
                        <img class="w-10 h-10 rounded-full object-cover"
                            src="{{ Auth::user()->avatar ?: 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=0D8ABC&color=fff' }}"
                            alt="User">
                        <textarea name="body" placeholder="What's on your mind, {{ Auth::user()->name }}?"
                            class="flex-1 bg-gray-100 dark:bg-gray-700 rounded-2xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-white transition resize-none min-h-[40px]"
                            required></textarea>
                    </div>
                    <div id="image-preview" class="hidden mt-3 relative">
                        <img src="" class="max-h-60 rounded-xl w-full object-cover">
                        <button type="button" onclick="removeImage()"
                            class="absolute top-2 right-2 bg-black/50 text-white rounded-full p-1 hover:bg-black/70">
                            ✕
                        </button>
                    </div>
                    <div
                        class="border-t border-gray-100 dark:border-gray-700 mt-4 pt-3 flex items-center justify-between">
                        <div class="flex space-x-2">
                            <label
                                class="flex items-center space-x-2 text-green-500 hover:bg-gray-50 dark:hover:bg-gray-700 px-4 py-1.5 rounded-lg transition cursor-pointer">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span class="text-sm font-medium">Photo</span>
                                <input type="file" name="image" class="hidden" onchange="previewImage(this)">
                            </label>
                            <button type="button"
                                class="flex items-center space-x-2 text-yellow-500 hover:bg-gray-50 dark:hover:bg-gray-700 px-4 py-1.5 rounded-lg transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                                <span class="text-sm font-medium">Feeling</span>
                            </button>
                        </div>
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-1.5 px-6 rounded-xl transition shadow-lg shadow-blue-500/20">
                            Post
                        </button>
                    </div>
                </form>
            </div>

            <!-- Feed Posts -->
            @foreach($posts as $post)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow">
                    <!-- Header -->
                    <div class="p-4 flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('profile', $post->user->id) }}">
                                <img class="w-10 h-10 rounded-full object-cover"
                                    src="{{ $post->user->avatar ?: 'https://ui-avatars.com/api/?name=' . urlencode($post->user->name) . '&background=random' }}"
                                    alt="User">
                            </a>
                            <div>
                                <a href="{{ route('profile', $post->user->id) }}">
                                    <h4
                                        class="font-bold text-gray-900 dark:text-gray-100 text-sm flex items-center gap-1 hover:text-blue-600 transition">
                                        {{ $post->user->name }}
                                        @if($post->user->nid_verified)
                                            <span class="text-blue-500 ml-1" title="Verified Identity">
                                                <svg class="w-4 h-4 inline" fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.64.304 1.25.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" />
                                                </svg>
                                            </span>
                                        @endif
                                    </h4>
                                </a>
                                <p class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Content -->
                    <div class="px-4 pb-2">
                        <p class="text-gray-800 dark:text-gray-200 text-sm whitespace-pre-line">{{ $post->body }}</p>
                    </div>
                    @if($post->image_path)
                        <div class="mt-2 bg-gray-100 dark:bg-gray-700 overflow-hidden">
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

            @if($posts->isEmpty())
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-8 text-center">
                    <div class="text-4xl mb-4">📭</div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">No posts yet</h3>
                    <p class="text-gray-500 text-sm mt-1">Be the first to share something with the community!</p>
                </div>
            @endif

        </div>

        <!-- RIGHT SIDEBAR (Trending / Upsell) -->
        <div class="hidden lg:block lg:col-span-1 space-y-4">
            <!-- Sponsored / Upsell -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-4">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-bold text-gray-500 dark:text-gray-400 text-sm uppercase tracking-wider">Sponsored
                    </h3>
                </div>
                <a href="#" class="flex items-center space-x-3 mb-4 group">
                    <div class="w-24 h-24 bg-gray-100 rounded-lg overflow-hidden">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition"
                            src="https://images.unsplash.com/photo-1556740758-90de374c12ad?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80"
                            alt="Ad">
                    </div>
                    <div class="flex-1">
                        <h4
                            class="font-semibold text-gray-900 dark:text-gray-200 text-sm group-hover:text-blue-500 transition">
                            Grow with Zengfy POS</h4>
                        <p class="text-xs text-gray-500 mt-1">school.zengfy.top</p>
                    </div>
                </a>
                <a href="#" class="flex items-center space-x-3 group">
                    <div class="w-24 h-24 bg-gray-100 rounded-lg overflow-hidden">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition"
                            src="https://images.unsplash.com/photo-1531403009284-440f080d1e12?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80"
                            alt="Ad">
                    </div>
                    <div class="flex-1">
                        <h4
                            class="font-semibold text-gray-900 dark:text-gray-200 text-sm group-hover:text-blue-500 transition">
                            Design Masterclass</h4>
                        <p class="text-xs text-gray-500 mt-1">skill.zengfy.top</p>
                    </div>
                </a>
            </div>

            <!-- Trending -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-4">
                <h3 class="font-bold text-gray-900 dark:text-gray-100 text-lg mb-4">Trending Now</h3>
                <div class="space-y-4">
                    @foreach($trends as $trend)
                        <div>
                            <p class="text-xs text-gray-500">{{ $trend['category'] }}</p>
                            <h4
                                class="font-semibold text-gray-800 dark:text-gray-200 text-sm hover:text-blue-500 transition cursor-pointer">
                                {{ $trend['title'] }}
                            </h4>
                            <p class="text-xs text-gray-500">{{ $trend['posts_count'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="text-xs text-gray-400">
                <p>&copy; 2025 Zengfy Inc. • Privacy • Terms • Advertising • More</p>
            </div>

        </div>

    </div>
</x-main::layouts.app>