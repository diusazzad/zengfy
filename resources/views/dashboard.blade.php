<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ড্যাশবোর্ড - Zen G School</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'bengali': ['Noto Sans Bengali', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                        },
                        accent: {
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706',
                        },
                        daraz: {
                            orange: '#f85606',
                            red: '#e60023',
                            yellow: '#ffce32'
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Noto Sans Bengali', sans-serif;
            padding-bottom: 70px;
            /* Fixed navbar এর জন্য স্থান সংরক্ষণ */
        }

        .navbar-shadow {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }


        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: #e60023;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Fixed Bottom Navbar Styles */
        .fixed-navbar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 50;
            background: white;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
        }

        .nav-item {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 10px 0;
            text-decoration: none;
            color: #4B5563;
            transition: all 0.3s ease;
        }

        .nav-item.active {
            color: #2563EB;
        }

        .nav-item:hover {
            color: #2563EB;
        }

        .nav-icon {
            font-size: 1.5rem;
            margin-bottom: 4px;
        }

        .nav-text {
            font-size: 0.75rem;
        }

        @media (min-width: 769px) {
            .fixed-navbar {
                display: none;
            }

            body {
                padding-bottom: 0;
            }
        }

        @media (min-width: 769px) {
            .desktop-header {
                display: block;
            }
        }
    </style>
</head>

<body class="bg-gray-50 font-bengali">
    <!-- Desktop Header (Hidden on Mobile) -->
    <header class="fixed top-0 left-0 right-0 bg-white navbar-shadow z-50">
        <div class="container mx-auto px-4">
            <!-- Top Bar -->
            <div class="flex items-center justify-between py-2 border-b">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('welcome') }}" class="text-2xl font-bold text-daraz-orange">Zengfy</a>
                </div>

                <!-- Search Bar -->
                <div class="flex-1 max-w-2xl mx-4">
                    <div class="relative">
                        <input type="text" placeholder="পণ্য খুঁজুন..."
                            class="w-full py-2 px-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-daraz-orange focus:border-transparent">
                        <button
                            class="absolute right-0 top-0 h-full bg-daraz-orange text-white px-4 rounded-r-lg hover:bg-orange-600 transition-colors">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>

                <!-- User Actions -->
                <div class="flex items-center space-x-4">
                    <!-- Cart -->
                    <div class="relative hidden md:block">
                        <button class="text-gray-700 hover:text-daraz-orange transition-colors">
                            <i class="fas fa-shopping-cart text-xl"></i>
                            <span class="cart-badge">3</span>
                        </button>
                    </div>

                    <!-- User Menu -->
                    <div class="relative group  hidden md:block">
                        <button
                            class="flex items-center space-x-2 text-gray-700 hover:text-daraz-orange transition-colors">
                            <div
                                class="w-8 h-8 bg-daraz-orange rounded-full flex items-center justify-center text-white">
                                <i class="fas fa-user"></i>
                            </div>
                            <span id="userName" class="font-medium">ইউজার</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div
                            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 hidden group-hover:block">
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-user mr-2"></i>প্রোফাইল
                            </a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-shopping-bag mr-2"></i>আমার অর্ডার
                            </a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-heart mr-2"></i>উইশলিস্ট
                            </a>
                            <hr class="my-2">
                            <button id="logoutBtnDesktop"
                                class="w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">
                                <i class="fas fa-sign-out-alt mr-2"></i>লগআউট
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-4">
        <!-- Video Section -->
        <section id="videoContainer" class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-20"></section>
        
        <!-- Product Section -->
        <section class="mt-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">জনপ্রিয় পণ্য</h2>
                <a href="#" class="text-daraz-orange font-medium flex items-center">
                    সব দেখুন
                    <i class="fas fa-chevron-right ml-1 text-sm"></i>
                </a>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <!-- Product 1 - কাপড় -->
                <div class="bg-white rounded-lg shadow-sm product-card border border-gray-100 overflow-hidden">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1618354691373-d851c5c3a990?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=715" 
                             alt="ফ্যাশনেবল শার্ট" class="w-full h-48 object-cover">
                        <div class="absolute top-2 right-2 bg-daraz-orange text-white text-xs font-bold px-2 py-1 rounded">
                            ২০% ছাড়
                        </div>
                    </div>
                    <div class="p-3">
                        <h3 class="font-medium text-gray-800 text-sm mb-1 line-clamp-2">মেনস কটন ফ্যাশন শার্ট - বিভিন্ন কালার</h3>
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400 text-xs">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="text-gray-500 text-xs ml-1">(১৫২)</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-daraz-orange font-bold">৳ ৫৯৯</span>
                            <span class="text-gray-500 text-sm line-through ml-2">৳ ৭৪৯</span>
                        </div>
                        <button class="w-full mt-3 bg-daraz-orange text-white py-2 rounded text-sm font-medium hover:bg-orange-600 transition-colors">
                            কার্টে যোগ করুন
                        </button>
                    </div>
                </div>
                
                <!-- Product 2 - ফুড -->
                <div class="bg-white rounded-lg shadow-sm product-card border border-gray-100 overflow-hidden">
                    <div class="relative">
                        <img src="https://plus.unsplash.com/premium_photo-1705404738477-24fc4e77f836?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1172" 
                             alt="খাবার" class="w-full h-48 object-cover">
                        <div class="absolute top-2 right-2 bg-daraz-orange text-white text-xs font-bold px-2 py-1 rounded">
                            ১৫% ছাড়
                        </div>
                    </div>
                    <div class="p-3">
                        <h3 class="font-medium text-gray-800 text-sm mb-1 line-clamp-2">প্রিমিয়াম বাসমতি চাল - ৫ কেজি</h3>
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400 text-xs">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <span class="text-gray-500 text-xs ml-1">(৮৭)</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-daraz-orange font-bold">৳ ৪৯৯</span>
                            <span class="text-gray-500 text-sm line-through ml-2">৳ ৫৮৯</span>
                        </div>
                        <button class="w-full mt-3 bg-daraz-orange text-white py-2 rounded text-sm font-medium hover:bg-orange-600 transition-colors">
                            কার্টে যোগ করুন
                        </button>
                    </div>
                </div>
                
                <!-- Product 3 - দুধ -->
                <div class="bg-white rounded-lg shadow-sm product-card border border-gray-100 overflow-hidden">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1563636619-e9143da7973b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8bWlsa3xlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60" 
                             alt="দুধ" class="w-full h-48 object-cover">
                        <div class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
                            হট ডিল
                        </div>
                    </div>
                    <div class="p-3">
                        <h3 class="font-medium text-gray-800 text-sm mb-1 line-clamp-2">ফ্রেশ টোনড মিল্ক - ১ লিটার প্যাক</h3>
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400 text-xs">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="text-gray-500 text-xs ml-1">(২৩৪)</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-daraz-orange font-bold">৳ ৭০</span>
                            <span class="text-gray-500 text-sm line-through ml-2">৳ ৮০</span>
                        </div>
                        <button class="w-full mt-3 bg-daraz-orange text-white py-2 rounded text-sm font-medium hover:bg-orange-600 transition-colors">
                            কার্টে যোগ করুন
                        </button>
                    </div>
                </div>
                
                <!-- Product 4 - আইসক্রিম -->
                <div class="bg-white rounded-lg shadow-sm product-card border border-gray-100 overflow-hidden">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1654796605330-8a1248a2cb07?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=687" 
                             alt="আইসক্রিম" class="w-full h-48 object-cover">
                    </div>
                    <div class="p-3">
                        <h3 class="font-medium text-gray-800 text-sm mb-1 line-clamp-2">ভ্যানিলা চকোলেট আইসক্রিম - ১ লিটার</h3>
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400 text-xs">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="text-gray-500 text-xs ml-1">(৬৩)</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-daraz-orange font-bold">৳ ৩৫০</span>
                        </div>
                        <button class="w-full mt-3 bg-daraz-orange text-white py-2 rounded text-sm font-medium hover:bg-orange-600 transition-colors">
                            কার্টে যোগ করুন
                        </button>
                    </div>
                </div>
                
                <!-- Product 5 - কাপড় -->
                <div class="bg-white rounded-lg shadow-sm product-card border border-gray-100 overflow-hidden">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1586790170083-2f9ceadc732d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dCUyMHNoaXJ0fGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60" 
                             alt="টি-শার্ট" class="w-full h-48 object-cover">
                        <div class="absolute top-2 right-2 bg-daraz-orange text-white text-xs font-bold px-2 py-1 rounded">
                            ১০% ছাড়
                        </div>
                    </div>
                    <div class="p-3">
                        <h3 class="font-medium text-gray-800 text-sm mb-1 line-clamp-2">কটন টি-শার্ট - বিভিন্ন ডিজাইন</h3>
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400 text-xs">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <span class="text-gray-500 text-xs ml-1">(১২০)</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-daraz-orange font-bold">৳ ৩৯৯</span>
                            <span class="text-gray-500 text-sm line-through ml-2">৳ ৪৪৯</span>
                        </div>
                        <button class="w-full mt-3 bg-daraz-orange text-white py-2 rounded text-sm font-medium hover:bg-orange-600 transition-colors">
                            কার্টে যোগ করুন
                        </button>
                    </div>
                </div>
                
                <!-- Product 6 - ফুড -->
                <div class="bg-white rounded-lg shadow-sm product-card border border-gray-100 overflow-hidden">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Zm9vZCUyMGdyb2Nlcnl8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60" 
                             alt="গ্রোসারি" class="w-full h-48 object-cover">
                    </div>
                    <div class="p-3">
                        <h3 class="font-medium text-gray-800 text-sm mb-1 line-clamp-2">অর্গানিক ডাল ও মসলা প্যাক - ১ কেজি</h3>
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400 text-xs">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="text-gray-500 text-xs ml-1">(৪৫)</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-daraz-orange font-bold">৳ ২৯৯</span>
                        </div>
                        <button class="w-full mt-3 bg-daraz-orange text-white py-2 rounded text-sm font-medium hover:bg-orange-600 transition-colors">
                            কার্টে যোগ করুন
                        </button>
                    </div>
                </div>
                
                <!-- Product 7 - দুধ -->
                <div class="bg-white rounded-lg shadow-sm product-card border border-gray-100 overflow-hidden">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1567769541495-338ee7203e3c?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=687" 
                             alt="দই" class="w-full h-48 object-cover">
                        <div class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
                            হট ডিল
                        </div>
                    </div>
                    <div class="p-3">
                        <h3 class="font-medium text-gray-800 text-sm mb-1 line-clamp-2">ফ্রুট ফ্লেভার দই - ৫০০ গ্রাম</h3>
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400 text-xs">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="text-gray-500 text-xs ml-1">(৭৮)</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-daraz-orange font-bold">৳ ১২০</span>
                            <span class="text-gray-500 text-sm line-through ml-2">৳ ১৪০</span>
                        </div>
                        <button class="w-full mt-3 bg-daraz-orange text-white py-2 rounded text-sm font-medium hover:bg-orange-600 transition-colors">
                            কার্টে যোগ করুন
                        </button>
                    </div>
                </div>
                
                <!-- Product 8 - আইসক্রিম -->
                <div class="bg-white rounded-lg shadow-sm product-card border border-gray-100 overflow-hidden">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1497034825429-c343d7c6a68f?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=687" 
                             alt="কোন আইসক্রিম" class="w-full h-48 object-cover">
                        <div class="absolute top-2 right-2 bg-daraz-orange text-white text-xs font-bold px-2 py-1 rounded">
                            ২৫% ছাড়
                        </div>
                    </div>
                    <div class="p-3">
                        <h3 class="font-medium text-gray-800 text-sm mb-1 line-clamp-2">স্ট্রবেরি ফ্লেভার কন আইসক্রিম - ৬ পিস</h3>
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400 text-xs">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="text-gray-500 text-xs ml-1">(১৮৯)</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-daraz-orange font-bold">৳ ২৫০</span>
                            <span class="text-gray-500 text-sm line-through ml-2">৳ ৩৩০</span>
                        </div>
                        <button class="w-full mt-3 bg-daraz-orange text-white py-2 rounded text-sm font-medium hover:bg-orange-600 transition-colors">
                            কার্টে যোগ করুন
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- Fixed Bottom Navbar (Mobile Only) -->
    <div class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 z-40">
        <div class="flex justify-around">
            <a href="{{ route('dashboard') }}" class="flex flex-col items-center py-2 text-gray-600">
                <div class="text-xl">🏠</div>
                <div class="text-xs">Home</div>
            </a>
            <a href="{{ route('team') }}" class="flex flex-col items-center py-2 text-gray-600">
                <div class="text-xl">💬</div>
                <div class="text-xs">Message</div>
            </a>
            <a href="{{ route('service') }}" class="flex flex-col items-center py-2 text-gray-600">
                <div class="text-xl">🛒</div>
                <div class="text-xs">Cart</div>
            </a>
            <a href="{{ route('service') }}" class="flex flex-col items-center py-2 text-gray-600">
                <div class="text-xl">💳</div>
                <div class="text-xs">Account</div>
            </a>
            <!-- Logout Button for Mobile -->
            <button id="bottomNavLogoutBtn" class="flex flex-col items-center py-2 text-gray-600">
                <i class="fas fa-sign-out-alt text-xl"></i>
                <div class="text-xs">লগআউট</div>
            </button>
        </div>
    </div>

    <script>
        // Check authentication and display user info
    document.addEventListener('DOMContentLoaded', function() {
        const token = localStorage.getItem('auth_token');
        const user = JSON.parse(localStorage.getItem('user') || '{}');

        if (!token) {
            window.location.href = '{{ route('login') }}';
        } else {
            // Display user info
            const userName = user.name || 'ইউজার';
            const userEmail = user.email || 'ইমেইল পাওয়া যায়নি';
            
            document.getElementById('userName').textContent = userName;
            // যদি welcomeMessage এবং displayUserName/id থাকে তাহলে সেট করুন
            const welcomeMessage = document.getElementById('welcomeMessage');
            const displayUserName = document.getElementById('displayUserName');
            const displayUserEmail = document.getElementById('displayUserEmail');
            
            if (welcomeMessage) welcomeMessage.textContent = `স্বাগতম, ${userName}!`;
            if (displayUserName) displayUserName.textContent = userName;
            if (displayUserEmail) displayUserEmail.textContent = userEmail;
        }

        // Set active state for current page in navbar
        const currentPath = window.location.pathname;
        document.querySelectorAll('.fixed-navbar a').forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('text-daraz-orange');
                link.classList.remove('text-gray-600');
            }
        });

        // Logout functionality for desktop
        const logoutBtnDesktop = document.getElementById('logoutBtnDesktop');
        if (logoutBtnDesktop) {
            logoutBtnDesktop.addEventListener('click', () => {
                logoutUser();
            });
        }

        // Logout functionality for bottom navbar (Mobile)
        const bottomNavLogoutBtn = document.getElementById('bottomNavLogoutBtn');
        if (bottomNavLogoutBtn) {
            bottomNavLogoutBtn.addEventListener('click', () => {
                logoutUser();
            });
        }
    });

    // Unified logout function
    function logoutUser() {
        // Clear localStorage
        localStorage.removeItem('auth_token');
        localStorage.removeItem('user');
        // Redirect to login page
        window.location.href = '{{ route('login') }}';
    }

    // videos 
     document.addEventListener('DOMContentLoaded', function () {
        // আপনার API URL সঠিক দিন
        fetch('https://zengfy.top/backend/api/dashboard/videos', {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('auth_token'), // যদি Token লাগে
            },
        })
        .then(response => response.json())
        .then(videos => {
            const container = document.getElementById('videoContainer');
            if (videos.length === 0) {
                container.innerHTML = '<p class="col-span-3 text-center text-gray-500">কোন ভিডিও পাওয়া যায়নি 😢</p>';
                return;
            }
            container.innerHTML = videos.map(video => `
                <div class="bg-white p-3 rounded-lg shadow hover:shadow-lg transition">
                    <video controls class="w-full rounded">
                        <source src="${video.url}" type="video/mp4">
                        আপনার ব্রাউজার ভিডিও সাপোর্ট করে না।
                    </video>
                    <p class="mt-2 text-sm text-gray-700 text-center font-medium">${video.name}</p>
                </div>
            `).join('');
        })
        .catch(err => {
            console.error('ভিডিও লোডিং এরর:', err);
        });
    });
    </script>
</body>

</html>