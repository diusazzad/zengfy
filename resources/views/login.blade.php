<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>লগইন করুন - Zen G School</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
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
                        },
                        accent: {
                            400: '#fbbf24',
                            500: '#f59e0b',
                        }
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.5s ease-out',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(10px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Noto Sans Bengali', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding-bottom: 70px;
            /* Fixed navbar এর জন্য স্থান সংরক্ষণ */
        }

        .login-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .form-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.3);
        }

        .btn-google {
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
        }

        .btn-google:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .floating-label {
            transition: all 0.3s ease;
        }

        .input-field:focus+.floating-label,
        .input-field:not(:placeholder-shown)+.floating-label {
            transform: translateY(-24px) scale(0.85);
            color: #2563eb;
        }

        .loader {
            border: 2px solid #f3f3f3;
            border-top: 2px solid #2563eb;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .success-checkmark {
            width: 40px;
            height: 40px;
            margin: 0 auto;
            border-radius: 50%;
            display: block;
            stroke-width: 2;
            stroke: #4bb543;
            stroke-miterlimit: 10;
            box-shadow: inset 0px 0px 0px #4bb543;
            animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
        }

        .check-icon {
            transform-origin: 50% 50%;
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
        }

        @keyframes stroke {
            100% {
                stroke-dashoffset: 0;
            }
        }

        @keyframes scale {

            0%,
            100% {
                transform: none;
            }

            50% {
                transform: scale3d(1.1, 1.1, 1);
            }
        }

        @keyframes fill {
            100% {
                box-shadow: inset 0px 0px 0px 30px #4bb543;
            }
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
    </style>
</head>

<body class="min-h-screen flex items-center justify-center py-8 px-4">
    <div class="login-card w-full max-w-md rounded-2xl overflow-hidden animate-fade-in">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white p-6 text-center">
            <div class="flex items-center justify-center mb-4">
                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mr-3">
                    <span class="text-xl">🌐</span>
                </div>
                <h1 class="text-2xl font-bold">ZenG Account</h1>
            </div>
            <p class="text-primary-100">আপনার অ্যাকাউন্টে লগইন করুন</p>
        </div>

        <!-- Login Form -->
        <div class="p-6">
            <form id="loginForm" class="space-y-5">
                <!-- Email Field -->
                <div class="relative">
                    <input type="email" id="email" name="email" required
                        class="w-full px-4 py-4 border border-gray-300 rounded-lg form-input input-field focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition placeholder-transparent"
                        placeholder="ইমেইল ঠিকানা">
                    <label for="email"
                        class="floating-label absolute left-4 top-4 text-gray-500 pointer-events-none bg-white px-1">
                        ইমেইল ঠিকানা
                    </label>
                    <div class="absolute right-3 top-3.5 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                            </path>
                        </svg>
                    </div>
                </div>

                <!-- Password Field -->
                <div class="relative">
                    <input type="password" id="password" name="password" required
                        class="w-full px-4 py-4 border border-gray-300 rounded-lg form-input input-field focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition placeholder-transparent"
                        placeholder="পাসওয়ার্ড">
                    <label for="password"
                        class="floating-label absolute left-4 top-4 text-gray-500 pointer-events-none bg-white px-1">
                        পাসওয়ার্ড
                    </label>
                    <div class="absolute right-3 top-3.5 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                    </div>
                </div>

                <!-- Remember & Forgot Password -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember"
                            class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                        <label for="remember" class="ml-2 text-sm text-gray-700">
                            আমাকে মনে রাখুন
                        </label>
                    </div>
                    <a href="#" class="text-sm text-primary-600 hover:text-primary-700 hover:underline">
                        পাসওয়ার্ড ভুলে গেছেন?
                    </a>
                </div>

                <!-- Submit Button -->
                <button type="submit" id="loginButton"
                    class="w-full btn-primary text-white py-4 px-4 rounded-lg font-semibold focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 flex items-center justify-center">
                    <span id="buttonText">লগইন করুন</span>
                    <span id="loadingSpinner" class="hidden ml-2">
                        <div class="loader"></div>
                    </span>
                </button>

                <!-- Divider -->
                <div class="relative flex items-center justify-center">
                    <div class="border-t border-gray-300 flex-grow"></div>
                    <span class="mx-4 text-gray-500 text-sm">অথবা</span>
                    <div class="border-t border-gray-300 flex-grow"></div>
                </div>

                <!-- Google Login -->
                <a href="https://zengfy.top/backend/public/auth/google/redirect"
                    class="w-full btn-google bg-white text-gray-700 py-3 px-4 rounded-lg font-semibold focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                        <path fill="#4285F4"
                            d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                        <path fill="#34A853"
                            d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                        <path fill="#FBBC05"
                            d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                        <path fill="#EA4335"
                            d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                    </svg>
                    Google দিয়ে লগইন করুন
                </a>
            </form>

            <!-- Error Message -->
            <div id="errorMessage" class="hidden mt-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg"
                role="alert">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span id="errorText"></span>
                </div>
            </div>

            <!-- Success Message -->
            <div id="successMessage"
                class="hidden mt-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg"
                role="alert">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span id="successText"></span>
                </div>
            </div>

            <!-- Signup Link -->
            <div class="mt-6 text-center">
                <p class="text-gray-600">
                    অ্যাকাউন্ট নেই?
                    <a href="{{ route('signup') }}"
                        class="text-primary-600 font-semibold hover:text-primary-700 hover:underline">
                        নতুন অ্যাকাউন্ট তৈরি করুন
                    </a>
                </p>
            </div>
        </div>
    </div>

    <!-- Fixed Bottom Navbar (Mobile Only) -->
    <div class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 z-40">
        <div class="flex justify-around">
            <a href="{{ route('welcome') }}" class="flex flex-col items-center py-2 text-gray-600">
                <div class="text-xl">🏠</div>
                <div class="text-xs">হোম</div>
            </a>
            <a href="{{ route('team') }}" class="flex flex-col items-center py-2 text-gray-600">
                <div class="text-xl">👥</div>
                <div class="text-xs">টীম</div>
            </a>
            <a href="{{ route('service') }}" class="flex flex-col items-center py-2 text-gray-600">
                <div class="text-xl">🛒</div>
                <div class="text-xs">সার্ভিস</div>
            </a>
            <a href="{{ route('service') }}" class="flex flex-col items-center py-2 text-gray-600">
                <div class="text-xl">🔐</div>
                <div class="text-xs">লগইন</div>
            </a>
           
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const submitBtn = document.getElementById('loginButton');
            const buttonText = document.getElementById('buttonText');
            const loadingSpinner = document.getElementById('loadingSpinner');
            const errorMessage = document.getElementById('errorMessage');
            const errorText = document.getElementById('errorText');
            const successMessage = document.getElementById('successMessage');
            
            // Hide previous messages
            errorMessage.classList.add('hidden');
            successMessage.classList.add('hidden');
            
            // Show loading state
            buttonText.textContent = 'লগইন হচ্ছে...';
            loadingSpinner.classList.remove('hidden');
            submitBtn.disabled = true;

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            try {
                const response = await fetch('https://zengfy.top/backend/public/api/login', {
                    method: 'POST',
                    headers: { 
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ email, password })
                });

                const data = await response.json();

                if (response.ok && data.token) {
                    // Store token and user data
                    localStorage.setItem('auth_token', data.token);
                    localStorage.setItem('user', JSON.stringify(data.user));
                    
                    // Show success message
                    successMessage.classList.remove('hidden');
                    document.getElementById('successText').textContent = 'লগইন সফল! ড্যাশবোর্ডে নিয়ে যাওয়া হচ্ছে...';
                    
                    // Redirect to dashboard after short delay
                    setTimeout(() => {
                        window.location.href = '{{ route('dashboard') }}';
                    }, 1500);
                } else {
                    // Show error message
                    errorText.textContent = data.message || 'ইমেইল বা পাসওয়ার্ড ভুল। আবার চেষ্টা করুন।';
                    errorMessage.classList.remove('hidden');
                    
                    // Reset button state
                    buttonText.textContent = 'লগইন করুন';
                    loadingSpinner.classList.add('hidden');
                    submitBtn.disabled = false;
                }
            } catch (error) {
                console.error('Login error:', error);
                
                // Show network error message
                errorText.textContent = 'নেটওয়ার্ক ত্রুটি। ইন্টারনেট সংযোগ চেক করুন এবং আবার চেষ্টা করুন।';
                errorMessage.classList.remove('hidden');
                
                // Reset button state
                buttonText.textContent = 'লগইন করুন';
                loadingSpinner.classList.add('hidden');
                submitBtn.disabled = false;
            }
        });

        // Check if user is already logged in
        document.addEventListener('DOMContentLoaded', function() {
            const token = localStorage.getItem('auth_token');
            if (token) {
                // User is already logged in, redirect to dashboard
                window.location.href = '{{ route('dashboard') }}';
            }
            
            // Add animation to form elements
            const formElements = document.querySelectorAll('.input-field');
            formElements.forEach((element, index) => {
                element.style.animationDelay = `${index * 0.1}s`;
                element.classList.add('animate-slide-up');
            });
            
            // Set active state for current page in navbar
            const currentPath = window.location.pathname;
            document.querySelectorAll('.fixed-navbar a').forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('text-primary-600');
                    link.classList.remove('text-gray-600');
                }
            });
        });

        // Enhanced floating labels
        document.querySelectorAll('.input-field').forEach(input => {
            // Check initial value
            if (input.value) {
                input.nextElementSibling.classList.add('floating-label-active');
            }
            
            input.addEventListener('focus', function() {
                this.nextElementSibling.classList.add('floating-label-active');
            });
            
            input.addEventListener('blur', function() {
                if (!this.value) {
                    this.nextElementSibling.classList.remove('floating-label-active');
                }
            });
        });
    </script>
</body>

</html>