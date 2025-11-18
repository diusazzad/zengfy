<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>নিবন্ধন করুন - Zengfy.top</title>
    <meta name="description" content="Zengfy.top-এ নিবন্ধন করুন এবং এক অ্যাকাউন্টে সব ব্যবসার সমাধান পান">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        bn: ['"Noto Sans Bengali"', 'sans-serif']
                    },
                    colors: {
                        primary: '#2563EB',
                        primaryDark: '#1D4ED8',
                        accent: '#FBBF24',
                        accentHover: '#F59E0B'
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Noto Sans Bengali', sans-serif;
        }
        
        .form-input:focus {
            border-color: #2563EB;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
        
        .service-highlight {
            transition: all 0.3s ease;
        }
        
        .service-highlight:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">
    <!-- Desktop Header -->
    <header class="bg-white shadow-sm sticky top-0 z-40">
        <div class="max-w-6xl mx-auto px-4 flex items-center justify-between h-16">
            <a href="https://zengfy.top" class="text-2xl font-extrabold text-primary">Zengfy.top</a>
            <nav class="hidden md:flex space-x-6">
                <a href="https://zengfy.top" class="hover:text-primary transition-colors">হোম</a>
                <a href="https://zengfy.top/team" class="hover:text-primary transition-colors">টীম</a>
                <a href="{{ route('download.app') }}" class="hover:text-primary transition-colors">Download App</a>
                <a href="{{ route('login') }}" class="text-primary hover:text-primaryDark transition-colors">লগইন</a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="min-h-screen py-8">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-8 items-start">
                <!-- Signup Form Section -->
                <div class="w-full lg:w-1/2 bg-white rounded-xl shadow-lg p-6 lg:p-8">
                    <div class="text-center mb-8">
                        <h1 class="text-3xl font-bold text-primary mb-2">নতুন অ্যাকাউন্ট তৈরি করুন</h1>
                        <p class="text-gray-600">আপনার ব্যবসার ডিজিটাল রূপান্তর আজই শুরু করুন</p>
                    </div>

                    <form id="signupForm" class="space-y-6">
                        <!-- Name Fields -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="firstName" class="block text-sm font-medium text-gray-700 mb-1">প্রথম নাম</label>
                                <input 
                                    type="text" 
                                    id="firstName" 
                                    name="firstName"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg form-input focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition"
                                    placeholder="আপনার প্রথম নাম"
                                >
                            </div>
                            <div>
                                <label for="lastName" class="block text-sm font-medium text-gray-700 mb-1">শেষ নাম</label>
                                <input 
                                    type="text" 
                                    id="lastName" 
                                    name="lastName"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg form-input focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition"
                                    placeholder="আপনার শেষ নাম"
                                >
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">ইমেইল ঠিকানা</label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg form-input focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition"
                                placeholder="you@example.com"
                            >
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">মোবাইল নম্বর</label>
                            <div class="flex">
                                <div class="flex items-center px-3 border border-r-0 border-gray-300 rounded-l-lg bg-gray-50">
                                    <span class="text-gray-600">+88</span>
                                </div>
                                <input 
                                    type="tel" 
                                    id="phone" 
                                    name="phone"
                                    required
                                    class="flex-1 px-4 py-3 border border-gray-300 rounded-r-lg form-input focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition"
                                    placeholder="01XXXXXXXXX"
                                >
                            </div>
                        </div>

                        <!-- Business Type -->
                        <div>
                            <label for="businessType" class="block text-sm font-medium text-gray-700 mb-1">ব্যবসার ধরন</label>
                            <select 
                                id="businessType" 
                                name="businessType"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg form-input focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition"
                            >
                                <option value="">ব্যবসার ধরন নির্বাচন করুন</option>
                                <option value="ecommerce">ই-কমার্স</option>
                                <option value="education">শিক্ষা প্রতিষ্ঠান</option>
                                <option value="retail">রিটেইল দোকান</option>
                                <option value="hotel">হোটেল</option>
                                <option value="watch">ঘড়ির দোকান</option>
                                <option value="other">অন্যান্য</option>
                            </select>
                        </div>

                        <!-- Password -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">পাসওয়ার্ড</label>
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password"
                                    required
                                    minlength="8"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg form-input focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition"
                                    placeholder="অন্তত ৮ অক্ষর"
                                >
                            </div>
                            <div>
                                <label for="confirmPassword" class="block text-sm font-medium text-gray-700 mb-1">পাসওয়ার্ড নিশ্চিত করুন</label>
                                <input 
                                    type="password" 
                                    id="confirmPassword" 
                                    name="confirmPassword"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg form-input focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition"
                                    placeholder="পাসওয়ার্ড আবার লিখুন"
                                >
                            </div>
                        </div>

                        <!-- Terms & Conditions -->
                        <div class="flex items-start space-x-3">
                            <input 
                                type="checkbox" 
                                id="terms" 
                                name="terms"
                                required
                                class="mt-1 rounded border-gray-300 text-primary focus:ring-primary"
                            >
                            <label for="terms" class="text-sm text-gray-600">
                                আমি <a href="" class="text-primary hover:underline">সেবার শর্তাবলী</a> 
                                ও <a href="" class="text-primary hover:underline">গোপনীয়তা নীতি</a> 
                                পড়েছি এবং স্বীকার করছি
                            </label>
                        </div>

                        <!-- Marketing Consent -->
                        <div class="flex items-start space-x-3">
                            <input 
                                type="checkbox" 
                                id="marketing" 
                                name="marketing"
                                class="mt-1 rounded border-gray-300 text-primary focus:ring-primary"
                            >
                            <label for="marketing" class="text-sm text-gray-600">
                                আমি Zengfy.top থেকে ব্যবসা সংক্রান্ত আপডেট ও অফার ইমেইলে পেতে চাই
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button 
                            type="submit"
                            class="w-full bg-accent text-gray-900 py-3 px-4 rounded-lg font-semibold hover:bg-accentHover transition-colors shadow-md focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2"
                        >
                            অ্যাকাউন্ট তৈরি করুন
                        </button>

                        <!-- Login Link -->
                        <div class="text-center">
                            <p class="text-gray-600">
                                ইতিমধ্যে অ্যাকাউন্ট আছে?
                                <a href="{{ route('login') }}" class="text-primary font-semibold hover:underline">লগইন করুন</a>
                            </p>
                        </div>
                    </form>
                </div>

                <!-- Benefits & Features Sidebar -->
                <div class="w-full lg:w-1/2 space-y-6">
                    <!-- Quick Benefits -->
                    <div class="bg-gradient-to-r from-primary to-primaryDark text-white rounded-xl p-6 shadow-lg">
                        <h2 class="text-2xl font-bold mb-4">নিবন্ধনের সুবিধাসমূহ</h2>
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span>ফ্রি ট্রায়াল - ১৪ দিন বিনামূল্যে সব ফিচার ব্যবহার করুন</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span>বাংলা ভাষায় সম্পূর্ণ ড্যাশবোর্ড</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span>বিকাশ/নগদ সহ লোকাল পেমেন্ট গেটওয়ে</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span>২৪/৭ বাংলাদেশি সাপোর্ট টীম</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Service Highlights -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-primary mb-4">আপনি যা পাচ্ছেন</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="service-highlight bg-blue-50 rounded-lg p-4 text-center border border-blue-100">
                                <div class="text-2xl mb-2">🛒</div>
                                <div class="font-semibold text-sm">ই-কমার্স</div>
                            </div>
                            <div class="service-highlight bg-blue-50 rounded-lg p-4 text-center border border-blue-100">
                                <div class="text-2xl mb-2">🎓</div>
                                <div class="font-semibold text-sm">স্কুল ERP</div>
                            </div>
                            <div class="service-highlight bg-blue-50 rounded-lg p-4 text-center border border-blue-100">
                                <div class="text-2xl mb-2">💳</div>
                                <div class="font-semibold text-sm">POS সিস্টেম</div>
                            </div>
                            <div class="service-highlight bg-blue-50 rounded-lg p-4 text-center border border-blue-100">
                                <div class="text-2xl mb-2">🏨</div>
                                <div class="font-semibold text-sm">হোটেল ব্যবস্থাপনা</div>
                            </div>
                        </div>
                    </div>

                    <!-- Trust Indicators -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-primary mb-4">আমাদের বিশ্বস্ততা</h3>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">১০০% নিরাপদ</div>
                                    <div class="text-sm text-gray-600">এন্ড-টু-এন্ড এনক্রিপশন</div>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">৯৯.৯% আপটাইম</div>
                                    <div class="text-sm text-gray-600">নির্ভরযোগ্য সার্ভিস</div>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">২৪/৭ সাপোর্ট</div>
                                    <div class="text-sm text-gray-600">বাংলাদেশি টীম</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="max-w-6xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Zengfy.top</h3>
                    <p class="text-gray-400">বাংলাদেশের প্রথম ইউনিফাইড SaaS প্ল্যাটফর্ম। একটি অ্যাকাউন্টে সব ব্যবসার সমাধান।</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">দ্রুত লিংক</h3>
                    <ul class="space-y-2">
                        <li><a href="https://zengfy.top" class="text-gray-400 hover:text-white transition-colors">হোম</a></li>
                        <li><a href="https://zengfy.top/team" class="text-gray-400 hover:text-white transition-colors">টীম</a></li>
                        <li><a href="https://zengfy.top/offline" class="text-gray-400 hover:text-white transition-colors">যোগাযোগ</a></li>
                        <li><a href="{{ route('login') }}" class="text-gray-400 hover:text-white transition-colors">লগইন</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">সার্ভিসসমূহ</h3>
                    <ul class="space-y-2">
                        <li><a href="https://zengfy.top/services/ecommerce" class="text-gray-400 hover:text-white transition-colors">ই-কমার্স</a></li>
                        <li><a href="https://zengfy.top/services/school" class="text-gray-400 hover:text-white transition-colors">স্কুল ERP</a></li>
                        <li><a href="https://zengfy.top/services/pos" class="text-gray-400 hover:text-white transition-colors">POS</a></li>
                        <li><a href="https://zengfy.top/services/hotel" class="text-gray-400 hover:text-white transition-colors">হোটেল ব্যবস্থাপনা</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">যোগাযোগ</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li>ইমেইল: info@zengfy.top</li>
                        <li>ফোন: +৮৮০ ১৭XX-XXXXXX</li>
                        <li>ঠিকানা: ঢাকা, বাংলাদেশ</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-400">
                <p>© ২০২৩ Zengfy.top - সকল অধিকার সংরক্ষিত</p>
            </div>
        </div>
    </footer>

    <script>
        // Form validation
        document.getElementById('signupForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const terms = document.getElementById('terms').checked;
            
            // Password match validation
            if (password !== confirmPassword) {
                alert('পাসওয়ার্ড মিলছে না। দয়া করে একই পাসওয়ার্ড আবার লিখুন।');
                return;
            }
            
            // Terms acceptance validation
            if (!terms) {
                alert('দয়া করে সেবার শর্তাবলী ও গোপনীয়তা নীতি গ্রহণ করুন।');
                return;
            }
            
            // If validation passes, submit the form
            alert('নিবন্ধন সফল! আমরা আপনাকে স্বাগতম জানাই।');
            // In real implementation, you would submit to backend here
            // this.submit();
        });
        
        // Real-time password strength indicator (optional enhancement)
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthIndicator = document.getElementById('passwordStrength');
            
            // You can implement password strength logic here
            // This is a simplified version
            if (password.length < 6) {
                // Weak password
            } else if (password.length < 10) {
                // Medium password
            } else {
                // Strong password
            }
        });
    </script>
</body>
</html>