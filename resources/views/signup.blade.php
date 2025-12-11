<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('signup.meta_title') }}</title>
    <meta name="description" content="{{ __('signup.meta_description') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Noto Sans Bengali', sans-serif;
        }

        .form-container {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Desktop Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="{{ route('welcome') }}" class="text-2xl font-bold text-blue-600">{{ __('signup.brand') }}</a>
                </div>
                @php
                    $lang = request('lang', app()->getLocale());
                    $query = fn($url) => $url . (str_contains($url, '?') ? '&' : '?') . 'lang=' . $lang;
                    $switchTo = $lang === 'en' ? 'bn' : 'en';
                    $switchUrl = $query(url()->current()) . '&lang=' . $switchTo;
                @endphp
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('welcome', [], false) . '?lang=' . $lang }}"
                        class="text-gray-700 hover:text-blue-600 transition duration-300">{{ __('signup.nav.home') }}</a>
                    <a href="{{ route('team', [], false) . '?lang=' . $lang }}"
                        class="text-gray-700 hover:text-blue-600 transition duration-300">{{ __('signup.nav.team') }}</a>
                    <a href="{{ route('service', [], false) . '?lang=' . $lang }}"
                        class="text-gray-700 hover:text-blue-600 transition duration-300">{{ __('signup.nav.service') }}</a>
                    <a href="{{ route('login', [], false) . '?lang=' . $lang }}"
                        class="text-gray-700 hover:text-blue-600 transition duration-300">{{ __('signup.nav.login') }}</a>
                    <a href="{{ route('signup', [], false) . '?lang=' . $lang }}"
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">{{ __('signup.nav.signup') }}</a>
                    <a href="{{ url()->current() . '?lang=' . $switchTo }}" class="text-sm text-gray-500 hover:text-blue-600 transition duration-300">
                        {{ strtoupper($switchTo) }}
                    </a>
                </div>
                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" id="mobile-menu-button" class="text-gray-700 hover:text-blue-600">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile Navigation Menu -->
        <div id="mobile-menu" class="md:hidden hidden bg-white border-t">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('welcome', [], false) . '?lang=' . $lang }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600">{{ __('signup.nav.home') }}</a>
                <a href="{{ route('team', [], false) . '?lang=' . $lang }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600">{{ __('signup.nav.team') }}</a>
                <a href="{{ route('service', [], false) . '?lang=' . $lang }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600">{{ __('signup.nav.service') }}</a>
                <a href="{{ route('login', [], false) . '?lang=' . $lang }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600">{{ __('signup.nav.login') }}</a>
                <a href="{{ route('signup', [], false) . '?lang=' . $lang }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600">{{ __('signup.nav.signup') }}</a>
                <a href="{{ url()->current() . '?lang=' . $switchTo }}" class="block px-3 py-2 text-gray-500 hover:text-blue-600">{{ strtoupper($switchTo) }}</a>
            </div>
        </div>
    </nav>

    <!-- Signup Form Section -->
    <section class="form-container py-12">
        <div class="max-w-md mx-auto px-4">
            <div class="glass-effect p-8 rounded-2xl shadow-2xl">
                <!-- Header -->
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-white mb-2">{{ __('signup.hero_title') }}</h2>
                    <p class="text-blue-100">{{ __('signup.hero_subtitle') }}</p>
                </div>

                <!-- Signup Form -->
                <form id="signupForm" class="space-y-6">
                    @csrf

                    <!-- Name Input -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-white mb-2">{{ __('signup.name_label') }}</label>
                        <input type="text" id="name" name="name" placeholder="{{ __('signup.name_placeholder') }}" required
                            class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent transition duration-300">
                    </div>

                    <!-- Email Input -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-white mb-2">{{ __('signup.email_label') }}</label>
                        <input type="email" id="email" name="email" placeholder="{{ __('signup.email_placeholder') }}" required
                            class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent transition duration-300">
                    </div>

                    <!-- Password Input -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-white mb-2">{{ __('signup.password_label') }}</label>
                        <input type="password" id="password" name="password" placeholder="{{ __('signup.password_placeholder') }}"
                            required
                            class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent transition duration-300">
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" id="submitBtn"
                        class="w-full bg-gradient-to-r from-green-400 to-blue-500 text-white py-3 px-4 rounded-lg font-semibold hover:from-green-500 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-blue-700 transition duration-300 transform hover:scale-105">
                        <span id="buttonText">{{ __('signup.submit') }}</span>
                        <div id="loadingSpinner" class="hidden justify-center">
                            <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-white"></div>
                        </div>
                    </button>

                    <!-- Login Link -->
                    <div class="text-center">
                        <p class="text-blue-100">
                            {{ __('signup.have_account') }}
                            <a href="{{ route('login', [], false) . '?lang=' . $lang }}" class="text-white font-semibold hover:underline">{{ __('signup.login') }}</a>
                        </p>
                    </div>

                    <!-- Divider -->
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-white/30"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-transparent text-blue-100">{{ __('signup.divider') }}</span>
                        </div>
                    </div>

                    <!-- Google Sign Up Button -->
                    <a href="{{ route('auth.google.redirect', [], false) . '?lang=' . $lang }}"
                        class="w-full bg-white text-gray-700 py-3 px-4 rounded-lg font-semibold hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 transition duration-300 flex items-center justify-center space-x-3">
                        <svg class="w-5 h-5" viewBox="0 0 24 24">
                            <path fill="#4285F4"
                                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                            <path fill="#34A853"
                                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                            <path fill="#FBBC05"
                                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                            <path fill="#EA4335"
                                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                        </svg>
                        <span>{{ __('signup.google') }}</span>
                    </a>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <p>{{ __("signup.footer.copyright") }}</p>
            <div class="mt-4 flex justify-center space-x-6">
                <a href="#" class="text-gray-400 hover:text-white">{{ __("signup.footer.privacy") }}</a>
                <a href="#" class="text-gray-400 hover:text-white">{{ __("signup.footer.terms") }}</a>
                <a href="#" class="text-gray-400 hover:text-white">{{ __("signup.footer.contact") }}</a>
            </div>
        </div>
    </footer>

    <!-- Fixed Bottom Navbar (Mobile Only) -->
    <div class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 z-40">
        <div class="flex justify-around">
            <a href="{{ route('welcome', [], false) . '?lang=' . $lang }}" class="flex flex-col items-center py-2 text-gray-600">
                <div class="text-xl">H</div>
                <div class="text-xs">{{ __('signup.nav.home') }}</div>
            </a>
            <a href="{{ route('team', [], false) . '?lang=' . $lang }}" class="flex flex-col items-center py-2 text-gray-600">
                <div class="text-xl">T</div>
                <div class="text-xs">{{ __('signup.nav.team') }}</div>
            </a>
            <a href="{{ route('service', [], false) . '?lang=' . $lang }}" class="flex flex-col items-center py-2 text-gray-600">
                <div class="text-xl">S</div>
                <div class="text-xs">{{ __('signup.nav.service') }}</div>
            </a>
           <a href="{{ route('login', [], false) . '?lang=' . $lang }}" class="flex flex-col items-center py-2 text-gray-600">
                <div class="text-xl">L</div>
                <div class="text-xs">{{ __('signup.nav.login') }}</div>
            </a>
        </div>
    </div>
                <div class="text-xs">হোম</div>
            </a>
            <a href="{{ route('team') }}" class="flex flex-col items-center py-2 text-gray-600">
                <div class="text-xl">H</div>
                <div class="text-xs">টীম</div>
            </a>
            <a href="{{ route('service') }}" class="flex flex-col items-center py-2 text-gray-600">
                <div class="text-xl">H</div>
                <div class="text-xs">সার্ভিস</div>
            </a>
           <a href="{{ route('login') }}" class="flex flex-col items-center py-2 text-gray-600">
                <div class="text-xl">H</div>
                <div class="text-xs">লগইন</div>
            </a>
        </div>
    </div>



    <script>
        // Mobile Menu Toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });

        // Form Submission
        document.getElementById('signupForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const submitBtn = document.getElementById('submitBtn');
            const buttonText = document.getElementById('buttonText');
            const loadingSpinner = document.getElementById('loadingSpinner');

            // Show loading state
            buttonText.classList.add('hidden');
            loadingSpinner.classList.remove('hidden');
            submitBtn.disabled = true;

            try {
                const token = document.querySelector('input[name="_token"]')?.value;
                const formData = new FormData(this);

                const response = await fetch('https://zengfy.top/backend/public/api/register', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token || '',
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.ok) {
                    // Success message with sweet animation
                    showNotification('{{ __('signup.toast.success') }}', 'success');
                    
                    // Redirect after 2 seconds
                    setTimeout(() => {
                        window.location.href = '{{ route('login') }}';
                    }, 2000);
                } else {
                    showNotification(data.message || '{{ __('signup.toast.error') }}', 'error');
                }
            } catch (err) {
                showNotification('{{ __('signup.toast.network') }}', 'error');
                console.error(err);
            } finally {
                // Reset button state
                buttonText.classList.remove('hidden');
                loadingSpinner.classList.add('hidden');
                submitBtn.disabled = false;
            }
        });

        // Notification function
        function showNotification(message, type) {
            // Remove existing notification
            const existingNotification = document.querySelector('.custom-notification');
            if (existingNotification) {
                existingNotification.remove();
            }

            // Create notification element
            const notification = document.createElement('div');
            notification.className = `custom-notification fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-lg transform transition-transform duration-300 ${
                type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
            }`;
            notification.textContent = message;

            // Add to page
            document.body.appendChild(notification);

            // Animate in
            setTimeout(() => {
                notification.classList.add('translate-x-0');
            }, 100);

            // Remove after 5 seconds
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 5000);
        }

        // Input field animations
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('ring-2', 'ring-white', 'ring-opacity-50');
            });

            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('ring-2', 'ring-white', 'ring-opacity-50');
            });
        });
    </script>
</body>

</html>
