<x-main::layouts.app>
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 max-w-7xl mx-auto pt-4">

        <!-- LEFT SIDEBAR (Navigation) -->
        <div class="hidden lg:block lg:col-span-1 space-y-4">
            <!-- Mini Profile -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-4 flex items-center space-x-3">
                <img class="w-12 h-12 rounded-full"
                    src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random" alt="User">
                <div>
                    <h3 class="font-bold text-gray-900 dark:text-gray-100">{{ Auth::user()->name }}</h3>
                    <p class="text-xs text-gray-500">Free Account</p>
                </div>
            </div>

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

            <!-- Stories -->
            <div class="flex space-x-4 overflow-x-auto pb-2 no-scrollbar">
                <!-- Add Story -->
                <div
                    class="flex-shrink-0 w-32 h-48 bg-gray-200 dark:bg-gray-700 rounded-xl relative overflow-hidden cursor-pointer group">
                    <img class="w-full h-full object-cover transition duration-300 group-hover:scale-110"
                        src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random"
                        alt="My Story">
                    <div class="absolute bottom-0 inset-x-0 bg-black/40 p-2 text-center">
                        <span
                            class="text-white text-xs font-bold w-6 h-6 rounded-full bg-blue-500 inline-flex items-center justify-center border-2 border-white">+</span>
                        <p class="text-white text-xs mt-1 font-semibold">Create Story</p>
                    </div>
                </div>
                <!-- Demo Story 1 -->
                <div class="flex-shrink-0 w-32 h-48 bg-gray-800 rounded-xl relative overflow-hidden cursor-pointer">
                    <img class="w-full h-full object-cover opacity-80"
                        src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80"
                        alt="Story">
                    <div class="absolute top-2 left-2 w-8 h-8 rounded-full border-2 border-blue-500 overflow-hidden">
                        <img src="https://ui-avatars.com/api/?name=Zengfy+Team" alt="User">
                    </div>
                    <div class="absolute bottom-2 left-2">
                        <p class="text-white text-xs font-bold">Zengfy Team</p>
                    </div>
                </div>
                <!-- Demo Story 2 -->
                <div class="flex-shrink-0 w-32 h-48 bg-gray-800 rounded-xl relative overflow-hidden cursor-pointer">
                    <img class="w-full h-full object-cover opacity-80"
                        src="https://images.unsplash.com/photo-1497215728101-856f4ea42174?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80"
                        alt="Story">
                    <div class="absolute top-2 left-2 w-8 h-8 rounded-full border-2 border-blue-500 overflow-hidden">
                        <img src="https://ui-avatars.com/api/?name=Rahim+Ahmed" alt="User">
                    </div>
                    <div class="absolute bottom-2 left-2">
                        <p class="text-white text-xs font-bold">Rahim Ahmed</p>
                    </div>
                </div>
            </div>

            <!-- Create Post -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-4">
                <div class="flex space-x-4">
                    <img class="w-10 h-10 rounded-full"
                        src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random" alt="User">
                    <input type="text" placeholder="What's on your mind, {{ Auth::user()->name }}?"
                        class="flex-1 bg-gray-100 dark:bg-gray-700 rounded-full px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-white transition">
                </div>
                <div class="border-t border-gray-100 dark:border-gray-700 mt-4 pt-3 flex justify-between">
                    <button
                        class="flex items-center space-x-2 text-red-500 hover:bg-gray-50 dark:hover:bg-gray-700 px-4 py-1.5 rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                            </path>
                        </svg>
                        <span class="text-sm font-medium">Live Video</span>
                    </button>
                    <button
                        class="flex items-center space-x-2 text-green-500 hover:bg-gray-50 dark:hover:bg-gray-700 px-4 py-1.5 rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        <span class="text-sm font-medium">Photo/Video</span>
                    </button>
                    <button
                        class="flex items-center space-x-2 text-yellow-500 hover:bg-gray-50 dark:hover:bg-gray-700 px-4 py-1.5 rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                        <span class="text-sm font-medium">Feeling</span>
                    </button>
                </div>
            </div>

            <!-- Feed Post 1 -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow">
                <!-- Header -->
                <div class="p-4 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <img class="w-10 h-10 rounded-full" src="https://ui-avatars.com/api/?name=Zengfy+Official"
                            alt="User">
                        <div>
                            <h4 class="font-bold text-gray-900 dark:text-gray-100 text-sm">Zengfy Official <span
                                    class="text-blue-500">✓</span></h4>
                            <p class="text-xs text-gray-500">2 hours ago</p>
                        </div>
                    </div>
                    <button class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z">
                            </path>
                        </svg>
                    </button>
                </div>
                <!-- Content -->
                <div class="px-4 pb-2">
                    <p class="text-gray-800 dark:text-gray-200 text-sm">🚀 We are thrilled to announce the launch of
                        **Zengfy School ERP**! Now manage your entire institution with a single click. Admissions, Fees,
                        Results - everything in one place.</p>
                </div>
                <div class="mt-2 h-64 bg-gray-100 overflow-hidden">
                    <img class="w-full h-full object-cover"
                        src="https://images.unsplash.com/photo-1509062522246-3755977927d7?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80"
                        alt="Post Image">
                </div>
                <!-- Actions -->
                <div
                    class="p-4 border-t border-gray-100 dark:border-gray-700 flex justify-between text-gray-500 text-sm">
                    <button class="flex items-center space-x-2 hover:text-blue-500 transition"><span
                            class="text-lg">👍</span> <span>Like</span></button>
                    <button class="flex items-center space-x-2 hover:text-blue-500 transition"><span
                            class="text-lg">💬</span> <span>Comment</span></button>
                    <button class="flex items-center space-x-2 hover:text-blue-500 transition"><span
                            class="text-lg">↗</span> <span>Share</span></button>
                </div>
            </div>
            <!-- Feed Post 2 -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow">
                <!-- Header -->
                <div class="p-4 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <img class="w-10 h-10 rounded-full" src="https://ui-avatars.com/api/?name=Rahim+Ahmed"
                            alt="User">
                        <div>
                            <h4 class="font-bold text-gray-900 dark:text-gray-100 text-sm">Rahim Ahmed</h4>
                            <p class="text-xs text-gray-500">5 hours ago</p>
                        </div>
                    </div>
                </div>
                <!-- Content -->
                <div class="px-4 pb-4">
                    <p class="text-gray-800 dark:text-gray-200 text-sm">Just tried the new **Zengfy POS** for my shop.
                        The offline sync feature is a lifesaver! Highly recommended for all shop owners. 🏪</p>
                </div>
                <!-- Actions -->
                <div
                    class="p-4 border-t border-gray-100 dark:border-gray-700 flex justify-between text-gray-500 text-sm">
                    <button class="flex items-center space-x-2 hover:text-blue-500 transition"><span
                            class="text-lg">👍</span> <span>Like</span></button>
                    <button class="flex items-center space-x-2 hover:text-blue-500 transition"><span
                            class="text-lg">💬</span> <span>Comment</span></button>
                    <button class="flex items-center space-x-2 hover:text-blue-500 transition"><span
                            class="text-lg">↗</span> <span>Share</span></button>
                </div>
            </div>

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
                    <div>
                        <p class="text-xs text-gray-500">Business • Trending</p>
                        <h4 class="font-semibold text-gray-800 dark:text-gray-200 text-sm">#StartupBangladesh</h4>
                        <p class="text-xs text-gray-500">20k Posts</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Technology • Trending</p>
                        <h4 class="font-semibold text-gray-800 dark:text-gray-200 text-sm">#AIRevolution</h4>
                        <p class="text-xs text-gray-500">15k Posts</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Education • Trending</p>
                        <h4 class="font-semibold text-gray-800 dark:text-gray-200 text-sm">#SmartEducation</h4>
                        <p class="text-xs text-gray-500">10k Posts</p>
                    </div>
                </div>
            </div>

            <div class="text-xs text-gray-400">
                <p>&copy; 2025 Zengfy Inc. • Privacy • Terms • Advertising • More</p>
            </div>

        </div>

    </div>
</x-main::layouts.app>