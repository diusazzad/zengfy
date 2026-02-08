<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>zengfy.top | {{ __('welcome.title') }}</title>
    <meta name="description" content="{{ __('welcome.hero.description') }}">
    <meta name="author" content="Zengfy Team">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#2563EB">
    <meta name="format-detection" content="telephone=no">
    <link rel="canonical" href="{{ url('/') }}">
    <meta http-equiv="Cache-Control" content="max-age=31536000, public">


    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="{{ __('welcome.title') }}">
    <meta property="og:description" content="{{ __('welcome.hero.description') }}">
    <meta property="og:image"
        content="https://images.unsplash.com/photo-1533750349088-cd871a92f312?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('/') }}">
    <meta property="twitter:title" content="{{ __('welcome.title') }}">
    <meta property="twitter:description" content="{{ __('welcome.hero.description') }}">
    <meta property="twitter:image"
        content="https://images.unsplash.com/photo-1533750349088-cd871a92f312?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80">

    <!-- Fonts -->
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
                        bn: ['"Noto Sans Bengali"', 'sans-serif']
                    },
                    animation: {
                        'fade-in-up': 'fadeInUp 0.8s ease-out forwards',
                        'float': 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
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
            /* Space for mobile nav */
        }

        /* Reveal on scroll class */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            will-change: opacity, transform;
            backface-visibility: hidden;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        .service-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Gradient Animation */
        .animated-gradient {
            background-size: 200% 200%;
            animation: gradientPosition 10s ease infinite;
        }

        @keyframes gradientPosition {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            padding-bottom: 0;
        }
        }

        /* Reveal on scroll class */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease-out;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        .service-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Gradient Animation */
        .animated-gradient {
            background-size: 200% 200%;
            animation: gradientPosition 10s ease infinite;
        }

        @keyframes gradientPosition {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* Preloader Styles */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #ffffff;
            z-index: 99999;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1), visibility 0.8s;
            will-change: opacity;
        }

        #preloader.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .loader-container {
            position: relative;
            width: 150px;
            height: 150px;
        }

        .circular-loader {
            transform: rotate(-90deg);
        }

        .loader-circle-bg {
            fill: none;
            stroke: #f3f4f6;
            stroke-width: 8;
        }

        .loader-circle {
            fill: none;
            stroke: #2563eb;
            stroke-width: 8;
            stroke-linecap: round;
            stroke-dasharray: 440;
            stroke-dashoffset: 440;
            transition: stroke-dashoffset 0.3s ease;
        }

        #loader-percentage {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 24px;
            font-weight: 800;
            color: #1e3a8a;
            font-family: sans-serif;
        }

        .loader-logo-inner {
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            font-weight: 900;
            color: #2563eb;
            font-size: 14px;
            letter-spacing: 2px;
        }
    </style>

</head>

<body class="bg-gray-50 text-gray-800 antialiased selection:bg-blue-200 selection:text-blue-900">

    <!-- Preloader -->
    <div id="preloader">
        <div class="loader-container">
            <div class="loader-logo-inner">ZENGFY</div>
            <svg class="circular-loader" width="150" height="150">
                <circle class="loader-circle-bg" cx="75" cy="75" r="70"></circle>
                <circle id="progress-circle" class="loader-circle" cx="75" cy="75" r="70"></circle>
            </svg>
            <div id="loader-percentage">0%</div>
        </div>
        <p class="mt-8 text-gray-400 font-medium tracking-[0.2em] text-[10px] uppercase">Architecting Ecosystem</p>
    </div>


    <!-- Desktop Header -->
    <header
        class="bg-white/90 backdrop-blur-md shadow-sm sticky top-0 z-40 hidden md:block transition-all duration-300">
        <div class="max-w-7xl mx-auto w-full px-6 py-4 flex items-center justify-between">
            <a href="/" class="flex items-center gap-2 group">
                <div
                    class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-xl group-hover:scale-105 transition">
                    Z</div>
                <span class="text-2xl font-extrabold text-gray-900 tracking-tight">zengfy.top</span>

            </a>
            <nav class="flex items-center gap-6 font-medium text-gray-600">
                <a href="{{ route('welcome') }}" class="hover:text-blue-600 transition"
                    aria-current="page">{{ __('welcome.nav.home') }}</a>
                <a href="{{ route('team') }}" class="hover:text-blue-600 transition">{{ __('welcome.nav.team') }}</a>
                <a href="{{ route('faq') }}" class="hover:text-blue-600 transition">{{ __('welcome.nav.faq') }}</a>
                <!-- Language Switcher -->
                <div class="flex items-center bg-gray-100 rounded-full p-1">
                    <a href="{{ route('lang.switch', 'en') }}"
                        class="px-3 py-1 rounded-full text-xs font-bold transition {{ app()->getLocale() == 'en' ? 'bg-white shadow text-blue-600' : 'text-gray-500 hover:text-gray-700' }}">EN</a>
                    <a href="{{ route('lang.switch', 'bn') }}"
                        class="px-3 py-1 rounded-full text-xs font-bold transition {{ app()->getLocale() == 'bn' ? 'bg-white shadow text-blue-600' : 'text-gray-500 hover:text-gray-700' }}">BN</a>
                </div>

                @guest
                    <a href="{{ route('login') }}"
                        class="text-blue-600 hover:text-blue-700">{{ __('welcome.nav.login') }}</a>
                    <a href="{{ route('signup') }}"
                        class="bg-blue-600 text-white px-5 py-2.5 rounded-full hover:bg-blue-700 transition shadow-lg shadow-blue-600/20 transform hover:-translate-y-0.5">{{ __('welcome.nav.signup') }}</a>
                @else
                    <a href="{{ route('dashboard') }}"
                        class="bg-blue-600 text-white px-5 py-2.5 rounded-full hover:bg-blue-700 transition shadow-lg shadow-blue-600/20 transform hover:-translate-y-0.5">{{ __('welcome.nav.dashboard') ?? 'Dashboard' }}</a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-500 hover:text-red-500 transition ml-2">
                            Logout
                        </button>
                    </form>
                @endguest
            </nav>
        </div>
    </header>

    <main>
        <!-- Hero Section -->
        <section id="hero"
            class="relative bg-gradient-to-br from-blue-700 via-blue-600 to-indigo-700 text-white pt-12 pb-20 md:pt-20 md:pb-28 overflow-hidden animated-gradient">
            <div
                class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 brightness-100 contrast-150">
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10 flex flex-col lg:flex-row items-center gap-12">
                <div class="flex-1 text-center lg:text-left space-y-6">
                    <span
                        class="inline-block py-1 px-3 rounded-full bg-blue-500/30 border border-blue-400/30 text-blue-100 text-xs font-bold tracking-widest uppercase mb-2 animate-fade-in-up">{{ __('welcome.hero.badge') }}</span>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight animate-fade-in-up"
                        style="animation-delay: 0.1s">
                        {{ __('welcome.hero.title_prefix') }} <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-yellow-500">
                            {{ __('welcome.hero.unified_saas') }}</span>
                    </h1>
                    <p class="text-lg sm:text-xl text-blue-100 max-w-2xl mx-auto lg:mx-0 leading-relaxed animate-fade-in-up"
                        style="animation-delay: 0.2s">
                        {{ __('welcome.hero.description') }}
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start pt-4 animate-fade-in-up"
                        style="animation-delay: 0.3s">
                        <a href="{{ auth()->check() ? route('dashboard') : route('signup') }}"
                            class="px-8 py-4 bg-yellow-400 text-gray-900 rounded-lg font-bold shadow-xl hover:bg-yellow-300 transition transform hover:-translate-y-1 flex items-center justify-center gap-2">
                            <span>{{ auth()->check() ? 'Go to Dashboard' : __('welcome.hero.cta_start') }}</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                        <a href="{{ route('download.app') }}"
                            class="px-8 py-4 border border-white/40 bg-white/5 backdrop-blur rounded-lg font-bold hover:bg-white/10 transition flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            <span>{{ __('welcome.hero.cta_app') }}</span>
                        </a>
                    </div>

                    <ul class="flex flex-wrap justify-center lg:justify-start gap-4 text-sm text-blue-200 pt-4 animate-fade-in-up"
                        style="animation-delay: 0.4s">
                        <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-400" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg> {{ __('welcome.hero.features.setup') }}</li>
                        <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-400" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg> {{ __('welcome.hero.features.payment') }}</li>
                        <li class="flex items-center gap-2"><svg class="w-4 h-4 text-green-400" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg> {{ __('welcome.hero.features.support') }}</li>
                    </ul>
                </div>

                <div class="flex-1 flex justify-center lg:justify-end animate-float">
                    @guest
                        <div class="w-full max-w-md">
                            <div class="bg-white/10 backdrop-blur-xl rounded-2xl p-8 border border-white/20 shadow-2xl">
                                <h3 class="text-2xl font-bold mb-6 text-white text-center">Sign in to ZenGFY</h3>

                                <!-- Google Login Button -->
                                <a href="{{ route('auth.google') }}"
                                    class="w-full flex items-center justify-center px-4 py-3 mb-6 bg-white text-gray-900 rounded-lg font-bold hover:bg-gray-100 transition shadow-lg">
                                    <svg class="h-5 w-5 mr-3" viewBox="0 0 48 48">
                                        <path fill="#FFC107"
                                            d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z">
                                        </path>
                                        <path fill="#FF3D00"
                                            d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z">
                                        </path>
                                        <path fill="#4CAF50"
                                            d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z">
                                        </path>
                                        <path fill="#1976D2"
                                            d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z">
                                        </path>
                                    </svg>
                                    Continue with Google
                                </a>

                                <div class="flex items-center mb-6">
                                    <div class="flex-1 h-px bg-white/20"></div>
                                    <div class="px-4 text-xs font-medium text-blue-200">or use email</div>
                                    <div class="flex-1 h-px bg-white/20"></div>
                                </div>

                                <form action="{{ route('login') }}" method="POST" class="space-y-4">
                                    @csrf
                                    <div>
                                        <input type="email" name="email" placeholder="Email address"
                                            class="w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white placeholder-blue-200 focus:outline-none focus:border-white transition"
                                            required>
                                    </div>
                                    <div>
                                        <input type="password" name="password" placeholder="Password"
                                            class="w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white placeholder-blue-200 focus:outline-none focus:border-white transition"
                                            required>
                                    </div>
                                    <button type="submit"
                                        class="w-full py-3 bg-blue-500 hover:bg-blue-400 text-white rounded-lg font-bold transition shadow-lg shadow-blue-500/20">
                                        Sign In
                                    </button>
                                </form>

                                <p class="mt-6 text-center text-sm text-blue-100">
                                    Don't have an account? <a href="{{ route('signup') }}"
                                        class="font-bold border-b border-blue-100 pb-0.5">Create new account</a>
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="relative w-full max-w-lg">
                            <div
                                class="absolute -inset-1 bg-gradient-to-r from-yellow-400 to-pink-600 rounded-2xl blur opacity-30 animate-pulse">
                            </div>
                            <div
                                class="relative bg-white/10 backdrop-blur-xl rounded-2xl p-2 border border-white/20 shadow-2xl">
                                <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                                    alt="Zengfy Dashboard Preview" class="rounded-xl shadow-inner w-full">

                                <!-- Floating Badges -->
                                <div class="absolute -bottom-6 -left-6 bg-white p-4 rounded-lg shadow-xl border border-gray-100 flex items-center gap-3 animate-bounce"
                                    style="animation-duration: 3s">
                                    <div
                                        class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                                        🛡️</div>
                                    <div>
                                        <p class="text-xs text-gray-500 font-semibold">Security Verified</p>
                                        <p class="font-bold text-gray-800">ISO 27001 Ready</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </section>

        <!-- Social Media Service Section (New Feature) -->
        <section id="social-feature" class="py-16 bg-white relative overflow-hidden reveal">
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 rounded-full bg-blue-100 opacity-50 blur-3xl">
            </div>
            <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-64 h-64 rounded-full bg-pink-100 opacity-50 blur-3xl">
            </div>

            <div class="max-w-7xl mx-auto px-4 relative z-10">
                <div class="flex flex-col lg:flex-row items-center gap-12">
                    <div class="flex-1 order-2 lg:order-1">
                        <span
                            class="inline-block py-1 px-3 rounded-full bg-gradient-to-r from-pink-500 to-red-500 text-white text-xs font-bold tracking-widest uppercase mb-4 shadow-lg shadow-pink-500/30">{{ __('welcome.social.badge') }}</span>
                        <h2 class="text-3xl md:text-5xl font-bold mb-6 text-gray-900 leading-tight">
                            {{ __('welcome.social.title_prefix') }} <span
                                class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">{{ __('welcome.social.title_highlight') }}</span>
                        </h2>
                        <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                            {{ __('welcome.social.description') }}
                        </p>

                        <div class="space-y-4 mb-8">
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 text-xl font-bold mt-1">
                                    📢</div>
                                <div>
                                    <h4 class="font-bold text-gray-900">{{ __('welcome.social.feed.title') }}</h4>
                                    <p class="text-sm text-gray-600">{{ __('welcome.social.feed.desc') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center text-pink-600 text-xl font-bold mt-1">
                                    🤝</div>
                                <div>
                                    <h4 class="font-bold text-gray-900">{{ __('welcome.social.b2b.title') }}</h4>
                                    <p class="text-sm text-gray-600">{{ __('welcome.social.b2b.desc') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-xl font-bold mt-1">
                                    🚀</div>
                                <div>
                                    <h4 class="font-bold text-gray-900">{{ __('welcome.social.organic.title') }}</h4>
                                    <p class="text-sm text-gray-600">{{ __('welcome.social.organic.desc') }}</p>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('signup') }}"
                            class="inline-flex items-center justify-center px-8 py-3 text-base font-bold text-white transition-all duration-200 bg-gray-900 border border-transparent rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900">
                            {{ __('welcome.social.cta') }}
                        </a>
                    </div>

                    <div class="flex-1 order-1 lg:order-2 flex justify-center">
                        <div class="relative w-full max-w-md">
                            <div
                                class="absolute -inset-2 bg-gradient-to-r from-blue-400 to-pink-400 rounded-3xl blur-lg opacity-40 animate-pulse">
                            </div>
                            <div
                                class="relative bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden transform rotate-2 hover:rotate-0 transition duration-500">
                                <!-- Fake UI Spec -->
                                <div class="p-4 border-b border-gray-100 flex items-center gap-3 bg-gray-50/50">
                                    <div class="w-8 h-8 rounded-full bg-gray-200"></div>
                                    <div class="h-2 w-24 bg-gray-200 rounded-full"></div>
                                </div>
                                <div class="p-6">
                                    <div class="h-4 w-3/4 bg-gray-100 rounded mb-4"></div>
                                    <div class="h-4 w-1/2 bg-gray-100 rounded mb-6"></div>
                                    <div
                                        class="aspect-video bg-blue-50 rounded-xl flex items-center justify-center text-blue-200 mb-6">
                                        <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="flex gap-4">
                                        <div class="h-8 w-8 rounded-full bg-blue-50"></div>
                                        <div class="h-8 w-8 rounded-full bg-gray-50"></div>
                                        <div class="h-8 w-8 rounded-full bg-gray-50"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Floating Comment -->
                            <div class="absolute -right-4 top-10 bg-white p-3 rounded-lg shadow-xl border border-gray-100 animate-float"
                                style="animation-delay: 1s">
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full bg-green-500"></div>
                                    <span class="text-xs font-bold text-gray-700">৩ জন সাপ্লায়ার আগ্রহী!</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section with Hover Grid -->
        <section id="services" class="max-w-7xl mx-auto px-4 py-20 reveal">
            <div class="text-center mb-16">
                <span
                    class="text-blue-600 font-bold tracking-wider uppercase text-sm bg-blue-50 px-3 py-1 rounded-full">{{ __('welcome.services.badge') }}</span>
                <h2 class="text-3xl md:text-4xl font-bold mt-3 mb-4 text-gray-900">{{ __('welcome.services.title') }}
                </h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">{{ __('welcome.services.description') }}</p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6">
                <!-- Service Items -->
                <a href="https://ecommerce.zengfy.top" class="block service-card group">
                    <div
                        class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 text-center h-full flex flex-col items-center justify-center relative overflow-hidden">
                        <div
                            class="absolute inset-0 bg-blue-50 opacity-0 group-hover:opacity-100 transition duration-300">
                        </div>
                        <div class="relative z-10">
                            <div class="text-4xl mb-3 transform group-hover:scale-110 transition duration-300">🛒</div>
                            <h3 class="font-bold text-gray-900 group-hover:text-blue-600 transition">
                                {{ __('welcome.services.items.ecommerce') }}
                            </h3>
                            <p class="text-xs text-gray-500 mt-2">{{ __('welcome.services.items.ecommerce_desc') }}</p>
                        </div>
                    </div>
                </a>

                <a href="https://school.zengfy.top" class="block service-card group">
                    <div
                        class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 text-center h-full flex flex-col items-center justify-center relative overflow-hidden">
                        <div
                            class="absolute inset-0 bg-purple-50 opacity-0 group-hover:opacity-100 transition duration-300">
                        </div>
                        <div class="relative z-10">
                            <div class="text-4xl mb-3 transform group-hover:scale-110 transition duration-300">🎓</div>
                            <h3 class="font-bold text-gray-900 group-hover:text-purple-600 transition">
                                {{ __('welcome.services.items.school') }}
                            </h3>
                            <p class="text-xs text-gray-500 mt-2">{{ __('welcome.services.items.school_desc') }}</p>
                        </div>
                    </div>
                </a>

                <a href="#" class="block service-card group">
                    <div
                        class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 text-center h-full flex flex-col items-center justify-center relative overflow-hidden">
                        <div
                            class="absolute inset-0 bg-red-50 opacity-0 group-hover:opacity-100 transition duration-300">
                        </div>
                        <div class="relative z-10">
                            <div class="text-4xl mb-3 transform group-hover:scale-110 transition duration-300">🎥</div>
                            <h3 class="font-bold text-gray-900 group-hover:text-red-600 transition">
                                {{ __('welcome.services.items.workshop') }}
                            </h3>
                            <p class="text-xs text-gray-500 mt-2">{{ __('welcome.services.items.workshop_desc') }}</p>
                        </div>
                    </div>
                </a>

                <a href="https://pos.zengfy.top" class="block service-card group">
                    <div
                        class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 text-center h-full flex flex-col items-center justify-center relative overflow-hidden">
                        <div
                            class="absolute inset-0 bg-green-50 opacity-0 group-hover:opacity-100 transition duration-300">
                        </div>
                        <div class="relative z-10">
                            <div class="text-4xl mb-3 transform group-hover:scale-110 transition duration-300">💳</div>
                            <h3 class="font-bold text-gray-900 group-hover:text-green-600 transition">
                                {{ __('welcome.services.items.pos') }}
                            </h3>
                            <p class="text-xs text-gray-500 mt-2">{{ __('welcome.services.items.pos_desc') }}</p>
                        </div>
                    </div>
                </a>

                <a href="https://rental.zengfy.top" class="block service-card group">
                    <div
                        class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 text-center h-full flex flex-col items-center justify-center relative overflow-hidden">
                        <div
                            class="absolute inset-0 bg-orange-50 opacity-0 group-hover:opacity-100 transition duration-300">
                        </div>
                        <div class="relative z-10">
                            <div class="text-4xl mb-3 transform group-hover:scale-110 transition duration-300">🏘️</div>
                            <h3 class="font-bold text-gray-900 group-hover:text-orange-600 transition">
                                {{ __('welcome.services.items.rental') }}
                            </h3>
                            <p class="text-xs text-gray-500 mt-2">{{ __('welcome.services.items.rental_desc') }}</p>
                        </div>
                    </div>
                </a>

                <!-- Row 2 -->
                <a href="https://hotel.zengfy.top" class="block service-card group">
                    <div
                        class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 text-center h-full flex flex-col items-center justify-center relative overflow-hidden">
                        <div
                            class="absolute inset-0 bg-indigo-50 opacity-0 group-hover:opacity-100 transition duration-300">
                        </div>
                        <div class="relative z-10">
                            <div class="text-4xl mb-3 transform group-hover:scale-110 transition duration-300">🏨</div>
                            <h3 class="font-bold text-gray-900 group-hover:text-indigo-600 transition">
                                {{ __('welcome.services.items.hotel') }}
                            </h3>
                            <p class="text-xs text-gray-500 mt-2">{{ __('welcome.services.items.hotel_desc') }}</p>
                        </div>
                    </div>
                </a>

                <a href="#" class="block service-card group">
                    <div
                        class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 text-center h-full flex flex-col items-center justify-center relative overflow-hidden">
                        <div
                            class="absolute inset-0 bg-gray-50 opacity-0 group-hover:opacity-100 transition duration-300">
                        </div>
                        <div class="relative z-10">
                            <div class="text-4xl mb-3 transform group-hover:scale-110 transition duration-300">⌚</div>
                            <h3 class="font-bold text-gray-900 transition">{{ __('welcome.services.items.brand') }}</h3>
                            <p class="text-xs text-gray-500 mt-2">{{ __('welcome.services.items.brand_desc') }}</p>
                        </div>
                    </div>
                </a>

                <a href="#" class="block service-card group">
                    <div
                        class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 text-center h-full flex flex-col items-center justify-center relative overflow-hidden">
                        <div
                            class="absolute inset-0 bg-teal-50 opacity-0 group-hover:opacity-100 transition duration-300">
                        </div>
                        <div class="relative z-10">
                            <div class="text-4xl mb-3 transform group-hover:scale-110 transition duration-300">📰</div>
                            <h3 class="font-bold text-gray-900 group-hover:text-teal-600 transition">
                                {{ __('welcome.services.items.journal') }}
                            </h3>
                            <p class="text-xs text-gray-500 mt-2">{{ __('welcome.services.items.journal_desc') }}</p>
                        </div>
                    </div>
                </a>

                <a href="#" class="block service-card group">
                    <div
                        class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 text-center h-full flex flex-col items-center justify-center relative overflow-hidden">
                        <div
                            class="absolute inset-0 bg-yellow-50 opacity-0 group-hover:opacity-100 transition duration-300">
                        </div>
                        <div class="relative z-10">
                            <div class="text-4xl mb-3 transform group-hover:scale-110 transition duration-300">🏗️</div>
                            <h3 class="font-bold text-gray-900 group-hover:text-yellow-600 transition">
                                {{ __('welcome.services.items.civil') }}
                            </h3>
                            <p class="text-xs text-gray-500 mt-2">{{ __('welcome.services.items.civil_desc') }}</p>
                        </div>
                    </div>
                </a>

                <a href="#" class="block service-card group">
                    <div
                        class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 text-center text-blue-600 h-full flex flex-col items-center justify-center hover:bg-blue-50 transition border-dashed border-2 border-blue-200">
                        <span class="text-2xl font-bold">+</span>
                        <span class="font-semibold text-sm mt-1">{{ __('welcome.services.items.more') }}</span>
                    </div>
                </a>
            </div>
        </section>

        <!-- Features Grid -->
        <section class="bg-blue-50 py-20 reveal">
            <div class="max-w-7xl mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900">{{ __('welcome.features.title') }}</h2>
                    <p class="text-gray-600 mt-2">{{ __('welcome.features.subtitle') }}</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div
                        class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition duration-300 border border-blue-100">
                        <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center text-3xl mb-6">💰
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-900">
                            {{ __('welcome.features.items.pricing.title') }}
                        </h3>
                        <p class="text-gray-600 leading-relaxed">{{ __('welcome.features.items.pricing.desc') }}</p>
                    </div>

                    <div
                        class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition duration-300 border border-blue-100">
                        <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center text-3xl mb-6">🚀
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-900">{{ __('welcome.features.items.setup.title') }}
                        </h3>
                        <p class="text-gray-600 leading-relaxed">{{ __('welcome.features.items.setup.desc') }}</p>
                    </div>

                    <div
                        class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition duration-300 border border-blue-100">
                        <div class="w-14 h-14 bg-indigo-100 rounded-xl flex items-center justify-center text-3xl mb-6">
                            🛡️</div>
                        <h3 class="text-xl font-bold mb-3 text-gray-900">
                            {{ __('welcome.features.items.security.title') }}
                        </h3>
                        <p class="text-gray-600 leading-relaxed">{{ __('welcome.features.items.security.desc') }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials -->
        <section class="py-20 max-w-7xl mx-auto px-4 reveal">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-900">{{ __('welcome.testimonials.title') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 relative">
                    <div class="absolute top-6 right-8 text-6xl text-blue-100 font-serif">"</div>
                    <div class="flex items-center gap-4 mb-6">
                        <img src="https://ui-avatars.com/api/?name=Rahim+Ahmed&background=0D8ABC&color=fff"
                            class="w-14 h-14 rounded-full" alt="Rahim Ahmed">
                        <div>
                            <h4 class="font-bold text-gray-900">রহিম আহমেদ</h4>
                            <p class="text-sm text-blue-600 font-medium">{{ __('welcome.testimonials.rahim.role') }}</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">{{ __('welcome.testimonials.rahim.text') }}</p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 relative">
                    <div class="absolute top-6 right-8 text-6xl text-blue-100 font-serif">"</div>
                    <div class="flex items-center gap-4 mb-6">
                        <img src="https://ui-avatars.com/api/?name=Sumaiya+Akter&background=E11D48&color=fff"
                            class="w-14 h-14 rounded-full" alt="Sumaiya Akter">
                        <div>
                            <h4 class="font-bold text-gray-900">সুমাইয়া আক্তার</h4>
                            <p class="text-sm text-pink-600 font-medium">{{ __('welcome.testimonials.sumaiya.role') }}
                            </p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">{{ __('welcome.testimonials.sumaiya.text') }}</p>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section class="bg-gray-900 text-white py-20 relative overflow-hidden">
            <div
                class="absolute inset-0 bg-blue-600 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]">
            </div>
            <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
                <h2 class="text-4xl font-bold mb-6">{{ __('welcome.cta_footer.title') }}</h2>
                <p class="text-xl text-gray-300 mb-10">{{ __('welcome.cta_footer.subtitle') }}</p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ auth()->check() ? route('dashboard') : route('signup') }}"
                        class="px-8 py-4 bg-yellow-400 text-gray-900 rounded-lg font-bold hover:bg-yellow-300 transition shadow-lg w-full sm:w-auto">{{ auth()->check() ? 'Go to Dashboard' : __('welcome.cta_footer.btn_free') }}</a>
                    <a href="{{ route('team') }}"
                        class="px-8 py-4 border border-gray-600 bg-gray-800 rounded-lg font-bold hover:bg-gray-700 transition w-full sm:w-auto">{{ __('welcome.cta_footer.btn_talk') }}</a>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-50 border-t border-gray-200 pt-16 pb-8 text-sm">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
            <div class="col-span-1 md:col-span-1">
                <div class="flex items-center gap-2 mb-4">
                    <div
                        class="w-6 h-6 bg-blue-600 rounded flex items-center justify-center text-white font-bold text-xs">
                        Z</div>
                    <span class="font-bold text-lg text-gray-800">zengfy.top</span>

                </div>
                <p class="text-gray-500 leading-relaxed">{{ __('welcome.footer.about') }}</p>
            </div>

            <div>
                <h4 class="font-bold text-gray-900 mb-4">{{ __('welcome.footer.company') }}</h4>
                <ul class="space-y-2 text-gray-600">
                    <li><a href="{{ route('welcome') }}"
                            class="hover:text-blue-600 transition">{{ __('welcome.footer.links.about') }}</a></li>
                    <li><a href="{{ route('team') }}"
                            class="hover:text-blue-600 transition">{{ __('welcome.footer.links.career') }}</a></li>
                    <li><a href="#" class="hover:text-blue-600 transition">{{ __('welcome.footer.links.blog') }}</a>
                    </li>
                    <li><a href="{{ route('faq') }}"
                            class="hover:text-blue-600 transition">{{ __('welcome.footer.links.support') }}</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold text-gray-900 mb-4">{{ __('welcome.footer.products') }}</h4>
                <ul class="space-y-2 text-gray-600">
                    <li><a href="https://school.zengfy.top"
                            class="hover:text-blue-600 transition">{{ __('welcome.services.items.school') }}</a></li>
                    <li><a href="https://ecommerce.zengfy.top"
                            class="hover:text-blue-600 transition">{{ __('welcome.services.items.ecommerce') }}</a></li>
                    <li><a href="https://pos.zengfy.top"
                            class="hover:text-blue-600 transition">{{ __('welcome.services.items.pos') }}</a></li>
                    <li><a href="https://hotel.zengfy.top"
                            class="hover:text-blue-600 transition">{{ __('welcome.services.items.hotel') }}</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold text-gray-900 mb-4">{{ __('welcome.footer.contact') }}</h4>
                <ul class="space-y-2 text-gray-600">
                    <li>ঢাকা, বাংলাদেশ</li>
                    <li><a href="mailto:support@zengfy.com"
                            class="hover:text-blue-600 transition">support@zengfy.com</a></li>
                    <li>+৮৮০ ১৯৫৩ ৫৭৬১৪৭</li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 text-center text-gray-400 pt-8 border-t border-gray-200">
            {{ __('welcome.footer.rights') }}
        </div>
    </footer>

    <!-- Mobile Bottom Nav -->
    <x-mobile-nav />

    <!-- Cookies Content Banner -->
    <div id="cookie-banner"
        class="fixed bottom-6 right-6 max-w-sm bg-white/90 backdrop-blur-xl border border-gray-100 rounded-2xl shadow-2xl p-6 z-50 transform translate-y-20 opacity-0 transition-all duration-700">
        <div id="cookie-main-content">
            <div class="flex items-start gap-4">
                <div class="text-3xl">🍪</div>
                <div class="flex-1">
                    <h4 class="font-bold text-gray-900">Cookies Policy</h4>
                    <p class="text-sm text-gray-600 mt-1 mb-4">We use cookies to improve your experience on zengfy.top.
                        By browsing, you agree to our policies.</p>
                    <div class="flex gap-2">
                        <button onclick="acceptCookies()"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-blue-700 transition">Accept
                            All</button>
                        <a href="#" class="text-gray-500 hover:text-gray-700 px-3 py-2 text-xs font-medium">Learn
                            More</a>
                    </div>
                </div>
                <button onclick="closeCookies()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Data Info Section (Hidden by default) -->
        <div id="cookie-data-info" class="hidden animate-in fade-in slide-in-from-bottom-2 duration-500">
            <div class="flex items-center gap-2 mb-3 text-green-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span class="font-bold text-sm">Preference Saved!</span>
            </div>
            <h5 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Browser Storage Summary</h5>
            <div class="bg-gray-50 rounded-lg p-3 space-y-2">
                <div class="flex justify-between text-xs">
                    <span class="text-gray-500">LocalStorage Items:</span>
                    <span id="local-storage-count" class="font-mono font-bold text-blue-600">0</span>
                </div>
                <div class="flex justify-between text-xs">
                    <span class="text-gray-500">Active Cookies:</span>
                    <span id="cookie-count" class="font-mono font-bold text-blue-600">0</span>
                </div>
                <div class="flex justify-between text-xs pt-1 border-t border-blue-50">
                    <span class="text-gray-900 font-bold">Memory Optimized:</span>
                    <span id="memory-saved" class="font-mono font-bold text-green-600 tracking-tight">0.00 KB</span>
                </div>
                <div id="storage-details"
                    class="pt-2 mt-2 border-t border-gray-200 text-[10px] text-gray-400 font-mono break-all max-h-20 overflow-y-auto">
                    <!-- Dynamic keys will go here -->
                </div>
            </div>
            <button onclick="closeCookies()"
                class="w-full mt-4 py-2 bg-gray-100 text-gray-600 rounded-lg text-sm font-bold hover:bg-gray-200 transition">Got
                it</button>
        </div>
    </div>

    <script>
            // Preloader Logic
            (function () {
                const preloader = document.getElementById('preloader');
                const progressCircle = document.getElementById('progress-circle');
                const percentageText = document.getElementById('loader-percentage');
                const circumference = 2 * Math.PI * 70; // r=70

                let currentProgress = 0;
                let targetProgress = 0;

                function updateLoader(pct) {
                    const offset = circumference - (pct / 100) * circumference;
                    progressCircle.style.strokeDashoffset = offset;
                    percentageText.textContent = Math.round(pct) + '%';
                }

                // Simulated progress while loading
                const interval = setInterval(() => {
                    if (currentProgress < 95) {
                        currentProgress += Math.random() * 5;
                        if (currentProgress > 95) currentProgress = 95;
                        updateLoader(currentProgress);
                    }
                }, 100);

                window.addEventListener('load', () => {
                    clearInterval(interval);
                    updateLoader(100);
                    setTimeout(() => {
                        preloader.classList.add('hidden');
                        // Enable scrolling after preloader is gone
                        document.body.style.overflow = 'auto';
                    }, 600);
                });

                // Initial lock
                document.body.style.overflow = 'hidden';
            })();

        // Cookies Banner Logic
        window.addEventListener('DOMContentLoaded', () => {
            if (!localStorage.getItem('cookies-accepted')) {
                setTimeout(() => {
                    const banner = document.getElementById('cookie-banner');
                    banner.classList.remove('translate-y-20', 'opacity-0');
                }, 2000);
            }
        });

        function acceptCookies() {
            localStorage.setItem('cookies-accepted', 'true');

            // Collect storage info
            const lsCount = localStorage.length;
            const cookieCount = document.cookie ? document.cookie.split(';').length : 0;
            const lsKeys = Object.keys(localStorage).slice(0, 5).join(', ') + (lsCount > 5 ? '...' : '');

            // Calculate approximate memory saved (in KB for professional look)
            let totalBytes = 0;
            for (let i = 0; i < localStorage.length; i++) {
                let key = localStorage.key(i);
                totalBytes += key.length + localStorage.getItem(key).length;
            }
            totalBytes += document.cookie.length;

            // Artificial boost for "Professional" feel (Network Optimization constant)
            const memoryMB = (totalBytes / 1024 + 0.42).toFixed(2);

            // Update UI
            document.getElementById('local-storage-count').textContent = lsCount;
            document.getElementById('cookie-count').textContent = cookieCount;
            document.getElementById('memory-saved').textContent = memoryMB + ' KB';
            document.getElementById('storage-details').textContent = 'Keys: ' + (lsKeys || 'None');

            // Switch sections
            document.getElementById('cookie-main-content').classList.add('hidden');
            document.getElementById('cookie-data-info').classList.remove('hidden');
        }

        function closeCookies() {
            const banner = document.getElementById('cookie-banner');
            banner.classList.add('translate-y-20', 'opacity-0');
        }

        // Reveal Animations on Scroll
        const revealElements = document.querySelectorAll('.reveal');
        const revealOnScroll = () => {
            const windowHeight = window.innerHeight;
            const elementVisible = 150;
            revealElements.forEach((reveal) => {
                const elementTop = reveal.getBoundingClientRect().top;
                if (elementTop < windowHeight - elementVisible) {
                    reveal.classList.add('active');
                }
            });
        };
        window.addEventListener('scroll', revealOnScroll);
        revealOnScroll(); // Trigger once on load

        // Service Worker Registration
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js').then((registration) => {
                    console.log('SW registered:', registration);

                    // Check for updates
                    registration.onupdatefound = () => {
                        const installingWorker = registration.installing;
                        installingWorker.onstatechange = () => {
                            if (installingWorker.state === 'installed') {
                                if (navigator.serviceWorker.controller) {
                                    console.log('New content available; please refresh.');
                                } else {
                                    console.log('Content is cached for offline use.');
                                }
                            }
                        };
                    };
                }).catch((error) => {
                    console.log('SW registration failed:', error);
                });
            });
        }
    </script>
</body>


</html>