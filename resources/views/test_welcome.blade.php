ml

<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8" />
    <title>ZenGFY – এক প্ল্যাটফর্মে অসংখ্য SaaS সার্ভিস</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="ZenGFY.top – একটি কেন্দ্রীভূত SaaS ইকোসিস্টেম যেখানে এক অ্যাকাউন্টে স্কুল ম্যানেজমেন্ট, ই-কমার্স, হোটেল, POS, হ্যাবিট ট্র্যাকিং, AI এবং আরও অনেক সার্ভিস চালানো যাবে।" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <script>
        window.tailwind = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            color-scheme: dark;
            --bg-gradient: radial-gradient(circle at top left, #3b82f6 0, #0f172a 45%, #020617 100%);
            --card-bg: rgba(15, 23, 42, 0.85);
            --card-border: rgba(148, 163, 184, 0.3);
            --accent: #38bdf8;
            --accent-soft: rgba(56, 189, 248, 0.15);
            --accent-strong: rgba(56, 189, 248, 0.35);
            --ring-glow: 0 0 40px rgba(56, 189, 248, 0.45);
        }

        * {
            box-sizing: border-box;
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #020617;
            background-image: var(--bg-gradient);
            color: #e5e7eb;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
            text-rendering: geometricPrecision;
        }

        .glass-card {
            background: var(--card-bg);
            border-radius: 1.25rem;
            border: 1px solid var(--card-border);
            box-shadow:
                0 18px 45px rgba(15, 23, 42, 0.8),
                0 0 0 1px rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
        }

        .glass-card-soft {
            background: rgba(15, 23, 42, 0.75);
            border-radius: 1.25rem;
            border: 1px solid rgba(148, 163, 184, 0.25);
            box-shadow:
                0 16px 30px rgba(15, 23, 42, 0.7),
                0 0 0 1px rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        .btn-primary {
            position: relative;
            overflow: hidden;
            border-radius: 999px;
            padding: 0.7rem 1.6rem;
            font-weight: 600;
            background: linear-gradient(135deg, #38bdf8, #6366f1);
            color: white;
            box-shadow:
                0 12px 30px rgba(37, 99, 235, 0.45),
                0 0 0 1px rgba(56, 189, 248, 0.35);
            border: none;
            cursor: pointer;
            transition: transform 0.18s ease, box-shadow 0.18s ease, background 0.2s ease;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 0 0, rgba(255, 255, 255, 0.35), transparent 55%);
            opacity: 0;
            transition: opacity 0.25s ease;
        }

        .btn-primary:hover::before {
            opacity: 1;
        }

        .btn-primary:hover {
            transform: translateY(-1px) translateZ(0);
            box-shadow:
                0 18px 40px rgba(37, 99, 235, 0.6),
                0 0 0 1px rgba(56, 189, 248, 0.5);
        }

        .btn-primary:active {
            transform: translateY(0) scale(0.98);
            box-shadow:
                0 8px 20px rgba(15, 23, 42, 0.9),
                0 0 0 1px rgba(56, 189, 248, 0.6);
        }

        .btn-ghost {
            border-radius: 999px;
            padding: 0.7rem 1.4rem;
            font-weight: 500;
            border: 1px solid rgba(148, 163, 184, 0.45);
            background: radial-gradient(circle at top left, rgba(148, 163, 184, 0.15), rgba(15, 23, 42, 0.85));
            color: #e5e7eb;
            cursor: pointer;
            transition: border 0.18s ease, background 0.18s ease, transform 0.18s ease, box-shadow 0.18s ease;
        }

        .btn-ghost:hover {
            border-color: rgba(248, 250, 252, 0.7);
            background: radial-gradient(circle at top left, rgba(148, 163, 184, 0.22), rgba(15, 23, 42, 0.96));
            transform: translateY(-1px);
            box-shadow: 0 10px 26px rgba(15, 23, 42, 0.8);
        }

        .nav-blur {
            backdrop-filter: blur(22px);
            -webkit-backdrop-filter: blur(22px);
            background: linear-gradient(to bottom, rgba(15, 23, 42, 0.96), rgba(15, 23, 42, 0.76));
            border-bottom: 1px solid rgba(148, 163, 184, 0.25);
        }

        .nav-link {
            position: relative;
            font-size: 0.9rem;
            letter-spacing: 0.02em;
            text-transform: uppercase;
            color: #9ca3af;
            transition: color 0.18s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -0.2rem;
            width: 0;
            height: 2px;
            border-radius: 999px;
            background: linear-gradient(90deg, #38bdf8, #6366f1);
            transition: width 0.2s ease;
        }

        .nav-link:hover {
            color: #e5e7eb;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-link.active {
            color: #f9fafb;
        }

        .nav-link.active::after {
            width: 100%;
        }

        .service-card {
            position: relative;
            overflow: hidden;
            transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease, background 0.22s ease;
            cursor: pointer;
        }

        .service-card::before {
            content: '';
            position: absolute;
            inset: -1px;
            background: radial-gradient(circle at top left, rgba(56, 189, 248, 0.32), transparent 55%);
            opacity: 0;
            transition: opacity 0.25s ease;
            pointer-events: none;
        }

        .service-card:hover {
            transform: translateY(-4px) translateZ(0);
            border-color: var(--accent-strong);
            background: radial-gradient(circle at top left, rgba(15, 23, 42, 0.9), rgba(15, 23, 42, 0.95));
            box-shadow:
                0 18px 38px rgba(15, 23, 42, 0.96),
                0 0 0 1px rgba(15, 23, 42, 0.9);
        }

        .service-card:hover::before {
            opacity: 1;
        }

        .badge {
            border-radius: 999px;
            padding: 0.25rem 0.7rem;
            font-size: 0.72rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            border: 1px solid rgba(148, 163, 184, 0.5);
            color: #e5e7eb;
            background: radial-gradient(circle at top left, rgba(148, 163, 184, 0.25), rgba(15, 23, 42, 0.95));
        }

        .badge-accent {
            border-color: rgba(56, 189, 248, 0.6);
            color: #e0f2fe;
            background: radial-gradient(circle at top left, var(--accent-soft), rgba(15, 23, 42, 0.98));
            box-shadow: 0 0 18px rgba(56, 189, 248, 0.4);
        }

        .hero-gradient-text {
            background: linear-gradient(120deg, #e5f2ff, #38bdf8, #a855f7, #e0f2fe);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            animation: heroGradient 9s ease infinite;
        }

        @keyframes heroGradient {

            0%,
            100% {
                background-position: 0% 40%;
            }

            50% {
                background-position: 100% 60%;
            }
        }

        .glow-orb {
            position: absolute;
            border-radius: 999px;
            filter: blur(40px);
            opacity: 0.65;
            pointer-events: none;
            mix-blend-mode: screen;
        }

        .orb-1 {
            width: 280px;
            height: 280px;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.65), transparent 60%);
            top: -40px;
            left: -60px;
        }

        .orb-2 {
            width: 240px;
            height: 240px;
            background: radial-gradient(circle, rgba(129, 140, 248, 0.7), transparent 60%);
            bottom: -80px;
            right: -20px;
        }

        .orb-3 {
            width: 260px;
            height: 260px;
            background: radial-gradient(circle, rgba(45, 212, 191, 0.6), transparent 60%);
            top: 30%;
            right: 16%;
        }

        .tagline-highlight {
            background: radial-gradient(circle at top left, rgba(56, 189, 248, 0.18), transparent 70%);
            padding: 0.4rem 0.9rem;
            border-radius: 999px;
            border: 1px solid rgba(56, 189, 248, 0.45);
            font-size: 0.78rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #e0f2fe;
        }

        .tagline-dot {
            width: 7px;
            height: 7px;
            border-radius: 999px;
            background: #22c55e;
            box-shadow: 0 0 12px rgba(34, 197, 94, 0.8);
        }

        .timeline-line {
            position: absolute;
            left: 1.25rem;
            top: 0;
            bottom: 0;
            width: 2px;
            background: linear-gradient(to bottom, rgba(148, 163, 184, 0.3), rgba(56, 189, 248, 0.7));
            opacity: 0.7;
        }

        .timeline-bullet {
            width: 14px;
            height: 14px;
            border-radius: 999px;
            background: #020617;
            border: 2px solid rgba(148, 163, 184, 0.9);
            box-shadow: 0 0 0 3px rgba(15, 23, 42, 1), 0 0 0 1px rgba(148, 163, 184, 0.9);
        }

        .timeline-bullet-active {
            border-color: #38bdf8;
            box-shadow: 0 0 0 4px rgba(15, 23, 42, 1), 0 0 0 1px rgba(56, 189, 248, 0.95), var(--ring-glow);
            background: radial-gradient(circle, rgba(56, 189, 248, 0.95), #0f172a);
        }

        .faq-item {
            border-bottom: 1px solid rgba(30, 64, 175, 0.4);
        }

        .faq-question {
            cursor: pointer;
            user-select: none;
            padding: 1rem 0;
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.25s ease, opacity 0.25s ease, transform 0.25s ease;
            opacity: 0;
            transform: translateY(-4px);
        }

        .faq-answer.open {
            opacity: 1;
            transform: translateY(0);
        }

        .faq-chevron {
            transition: transform 0.22s ease, color 0.22s ease;
        }

        .faq-chevron.rotated {
            transform: rotate(90deg);
            color: #38bdf8;
        }

        .input-field {
            width: 100%;
            border-radius: 999px;
            padding: 0.7rem 1rem;
            border: 1px solid rgba(148, 163, 184, 0.4);
            background: radial-gradient(circle at top left, rgba(15, 23, 42, 0.9), rgba(15, 23, 42, 0.96));
            color: #e5e7eb;
            font-size: 0.9rem;
            outline: none;
            transition: border 0.18s ease, box-shadow 0.18s ease, background 0.18s ease;
        }

        .input-field:focus {
            border-color: rgba(56, 189, 248, 0.9);
            box-shadow: 0 0 0 1px rgba(56, 189, 248, 0.95), var(--ring-glow);
            background: radial-gradient(circle at top left, rgba(15, 23, 42, 0.95), rgba(15, 23, 42, 1));
        }

        .pill-domain {
            font-size: 0.75rem;
            border-radius: 999px;
            padding: 0.2rem 0.7rem;
            background: rgba(15, 23, 42, 0.95);
            border: 1px solid rgba(148, 163, 184, 0.5);
            color: #9ca3af;
        }

        .metric-pill {
            border-radius: 999px;
            padding: 0.35rem 0.75rem;
            font-size: 0.78rem;
            border: 1px solid rgba(148, 163, 184, 0.5);
            background: radial-gradient(circle at top left, rgba(15, 23, 42, 0.9), rgba(15, 23, 42, 0.98));
            color: #cbd5f5;
        }

        .ring-floating {
            position: absolute;
            border-radius: 999px;
            border: 1px solid rgba(148, 163, 184, 0.35);
            box-shadow: 0 0 0 1px rgba(15, 23, 42, 1);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            background: radial-gradient(circle at top left, rgba(56, 189, 248, 0.07), rgba(15, 23, 42, 0.95));
            opacity: 0.7;
        }

        .ring-1 {
            width: 210px;
            height: 210px;
            top: -60px;
            right: 2%;
        }

        .ring-2 {
            width: 150px;
            height: 150px;
            bottom: 16%;
            left: -40px;
        }

        .ring-1::before,
        .ring-2::before {
            content: '';
            position: absolute;
            inset: 18%;
            border-radius: inherit;
            border: 1px dashed rgba(148, 163, 184, 0.4);
        }

        .scroll-fade {
            animation: scrollFade 0.9s ease-out both;
        }

        @keyframes scrollFade {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 1024px) {
            .orb-3 {
                display: none;
            }

            .ring-1,
            .ring-2 {
                opacity: 0.4;
            }
        }

        @media (max-width: 768px) {

            .orb-1,
            .orb-2,
            .ring-1,
            .ring-2 {
                display: none;
            }

            .nav-desktop {
                display: none;
            }

            .nav-mobile-toggle {
                display: flex;
            }
        }

        @media (min-width: 769px) {

            .nav-mobile-toggle,
            .nav-mobile-menu {
                display: none;
            }
        }
    </style>
</head>

<body class="min-h-screen text-slate-100">
    <div class="fixed inset-0 pointer-events-none">
        <div class="glow-orb orb-1"></div>
        <div class="glow-orb orb-2"></div>
        <div class="glow-orb orb-3"></div>
        <div class="ring-floating ring-1"></div>
        <div class="ring-floating ring-2"></div>
    </div>

    <header class="fixed top-0 inset-x-0 z-30 nav-blur">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
            <a href="#top" class="flex items-center gap-2">
                <div class="relative">
                    <div
                        class="h-8 w-8 rounded-2xl bg-gradient-to-br from-sky-400 via-indigo-500 to-emerald-400 shadow-lg shadow-sky-500/40 flex items-center justify-center text-xs font-extrabold tracking-tight">
                        ZF
                    </div>
                    <div class="absolute -inset-1 rounded-2xl bg-sky-400/30 blur-md -z-10"></div>
                </div>
                <div class="flex flex-col leading-tight">
                    <span class="text-sm font-semibold tracking-tight text-slate-50">ZenGFY</span>
                    <span class="text-[11px] text-slate-400 tracking-[0.18em] uppercase">Unified SaaS OS</span>
                </div>
            </a>

            <nav class="hidden nav-desktop items-center gap-7 text-xs font-medium">
                <a href="#overview" class="nav-link">Overview</a>
                <a href="#services" class="nav-link">Services</a>
                <a href="#how-it-works" class="nav-link">কীভাবে কাজ করবে</a>
                <a href="#roadmap" class="nav-link">Roadmap</a>
                <a href="#faq" class="nav-link">FAQ</a>
                <a href="#contact" class="nav-link">Contact</a>
            </nav>

            <div class="hidden nav-desktop items-center gap-3">
                <button class="btn-ghost text-xs">Sign in (beta)</button>
                <button class="btn-primary text-xs">Join Waitlist</button>
            </div>

            <button
                class="nav-mobile-toggle h-9 w-9 rounded-full border border-slate-700/70 flex items-center justify-center text-slate-200 bg-slate-900/70">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h10M4 17h16" />
                </svg>
            </button>
        </div>

        <div class="nav-mobile-menu origin-top transform scale-y-0 opacity-0 transition-all duration-150 ease-out">
            <div class="px-4 pb-4 space-y-1 text-sm border-t border-slate-800/80 bg-slate-950/95">
                <a href="#overview" class="block py-2 text-slate-300">Overview</a>
                <a href="#services" class="block py-2 text-slate-300">Services</a>
                <a href="#how-it-works" class="block py-2 text-slate-300">কীভাবে কাজ করবে</a>
                <a href="#roadmap" class="block py-2 text-slate-300">Roadmap</a>
                <a href="#faq" class="block py-2 text-slate-300">FAQ</a>
                <a href="#contact" class="block py-2 text-slate-300">Contact</a>
                <div class="pt-3 flex gap-2">
                    <button class="btn-ghost text-xs flex-1">Sign in</button>
                    <button class="btn-primary text-xs flex-1">Waitlist</button>
                </div>
            </div>
        </div>
    </header>

    <main id="top" class="relative pt-24 pb-16 sm:pt-28 sm:pb-24">
        <section id="overview"
            class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-[minmax(0,1.2fr),minmax(0,1fr)] gap-10 lg:gap-14 items-center">
            <div class="space-y-7 scroll-fade">
                <div class="tagline-highlight">
                    <span class="tagline-dot"></span>
                    <span class="font-semibold">এক অ্যাকাউন্ট, সব সার্ভিস – ZenGFY OS for Business</span>
                </div>

                <div class="space-y-4">
                    <h1
                        class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight hero-gradient-text">
                        এক প্ল্যাটফর্মে স্কুল, ই-কমার্স, হোটেল, POS, হ্যাবিট ও AI – সবকিছুর কন্ট্রোল
                    </h1>
                    <p class="text-sm sm:text-base text-slate-300 leading-relaxed max-w-xl">
                        যেমন গুগলের একটি অ্যাকাউন্ট দিয়ে Gmail, YouTube, Drive সব ব্যবহার করা যায় –
                        <span class="font-semibold text-sky-300">ZenGFY.top</span> হবে ঠিক তেমন একটি
                        <span class="font-semibold text-sky-200">কেন্দ্রীভূত SaaS ইকোসিস্টেম</span>। একবার সাইনআপ করলে
                        সাবডোমেইন ভিত্তিক ডজনখানেক সার্ভিস, একটি সিঙ্গেল ড্যাশবোর্ড থেকেই নিয়ন্ত্রণ।
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    <button class="btn-primary text-sm">
                        Waitlist-এ নাম লেখান
                    </button>
                    <button class="btn-ghost text-sm">
                        আইডিয়াটা কতটা শক্তিশালী?
                    </button>
                </div>

                <div class="flex flex-wrap gap-3 pt-2">
                    <div class="metric-pill flex items-center gap-2">
                        <span class="h-2 w-2 rounded-full bg-emerald-400 shadow-[0_0_12px_rgba(52,211,153,0.9)]"></span>
                        Multi-tenant, multi-domain SaaS আর্কিটেকচার
                    </div>
                    <div class="metric-pill">
                        User-centric single sign-on (SSO) experience
                    </div>
                </div>

                <div class="glass-card-soft p-4 sm:p-5 mt-4 border border-sky-500/30 relative overflow-hidden">
                    <div
                        class="absolute inset-px rounded-2xl bg-gradient-to-r from-sky-500/8 via-transparent to-indigo-500/10 pointer-events-none">
                    </div>
                    <div class="relative flex flex-col sm:flex-row sm:items-center gap-4">
                        <div class="flex flex-col gap-1">
                            <span class="text-xs font-semibold tracking-[0.18em] text-sky-300 uppercase">ZenGFY Project
                                Insight</span>
                            <p class="text-sm text-slate-200">
                                এই আইডিয়াটা মূলত <span class="font-semibold text-sky-300">এক্সিকিউশন-ফোকাসড</span>
                                আইডিয়া –
                                কারণ এখানে আপনি শুধু একটি প্রোডাক্ট না, একটি <span
                                    class="font-semibold">ইকোসিস্টেম</span> তৈরি করছেন।
                            </p>
                        </div>
                        <div class="flex flex-col gap-1 text-xs text-slate-300 min-w-[180px]">
                            <div class="flex items-center justify-between">
                                <span class="text-slate-400">Scalability</span>
                                <span class="font-semibold text-sky-300">High</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-400">Monetization</span>
                                <span class="font-semibold text-emerald-300">Multi-stream</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-400">Complexity</span>
                                <span class="font-semibold text-amber-300">Phased</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <aside class="relative scroll-fade lg:translate-y-2">
                <div class="glass-card p-5 sm:p-6 relative overflow-hidden">
                    <div class="absolute -top-16 -right-8 h-40 w-40 rounded-full bg-sky-500/20 blur-3xl"></div>
                    <div class="absolute -bottom-10 -left-4 h-32 w-32 rounded-full bg-indigo-500/25 blur-3xl"></div>

                    <div class="relative space-y-5">
                        <div class="flex items-center justify-between">
                            <span class="badge-accent">ZenGFY Ecosystem Map</span>
                            <span class="text-[11px] text-slate-400">v0.1 Concept</span>
                        </div>

                        <div class="border border-slate-700/60 rounded-2xl p-3.5 bg-slate-950/70">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center gap-2">
                                    <span
                                        class="h-2.5 w-2.5 rounded-full bg-emerald-400 shadow-[0_0_10px_rgba(52,211,153,0.9)]"></span>
                                    <span class="font-semibold text-sm text-slate-100">Main Hub</span>
                                </div>
                                <span class="pill-domain">zengfy.top</span>
                            </div>
                            <p class="text-xs text-slate-300">
                                Single Sign-On (SSO), billing, permission &amp; user identity – সবকিছুর জন্য
                                <span class="font-semibold text-sky-300">Central Control Panel</span>।
                            </p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5 text-xs">
                            <div class="service-card glass-card-soft p-3.5">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-semibold text-slate-100 text-xs">School OS</span>
                                    <span class="pill-domain">school.zengfy.top</span>
                                </div>
                                <p class="text-[11px] text-slate-300 mb-2">
                                    ভর্তি, ফি, রেজাল্ট, LMS – সব একসাথে। Multi-school SaaS মডেল।
                                </p>
                                <span class="badge text-[10px]">EdTech</span>
                            </div>

                            <div class="service-card glass-card-soft p-3.5">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-semibold text-slate-100 text-xs">Commerce</span>
                                    <span class="pill-domain">ecommerce.zengfy.top</span>
                                </div>
                                <p class="text-[11px] text-slate-300 mb-2">
                                    ব্র্যান্ডেড ঘড়ি, শোরুম, POS, affiliate friendly storefront।
                                </p>
                                <span class="badge text-[10px]">Retail &amp; D2C</span>
                            </div>

                            <div class="service-card glass-card-soft p-3.5">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-semibold text-slate-100 text-xs">Smart Habit &amp; AI</span>
                                    <span class="pill-domain">havit.zengfy.top</span>
                                </div>
                                <p class="text-[11px] text-slate-300 mb-2">
                                    হ্যাবিট ট্র্যাকিং, AI কোচ, productivity insights।
                                </p>
                                <span class="badge text-[10px]">AI + Lifestyle</span>
                            </div>

                            <div class="service-card glass-card-soft p-3.5">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-semibold text-slate-100 text-xs">Accounts Core</span>
                                    <span class="pill-domain">accounts.zengfy.top</span>
                                </div>
                                <p class="text-[11px] text-slate-300 mb-2">
                                    Subscription, ইনভয়েস, usage-based pricing – সব সার্ভিসের জন্য।
                                </p>
                                <span class="badge text-[10px]">SaaS Engine</span>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-2 pt-1">
                            <span class="metric-pill">hotel.zengfy.top</span>
                            <span class="metric-pill">watch.zengfy.top</span>
                            <span class="metric-pill">pos.zengfy.top</span>
                            <span class="metric-pill">civil.zengfy.top</span>
                            <span class="metric-pill">law.zengfy.top</span>
                            <span class="metric-pill">journal.zengfy.top</span>
                            <span class="metric-pill">samrtai.zengfy.top</span>
                        </div>
                    </div>
                </div>
            </aside>
        </section>

        <section id="services" class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 sm:mt-20 space-y-7">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                <div>
                    <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-slate-50">
                        সাবডোমেইন ভিত্তিক সার্ভিস আর্কিটেকচার
                    </h2>
                    <p class="text-sm text-slate-300 mt-1 max-w-2xl">
                        প্রতিটি সার্ভিস নিজের ডোমেইনে, কিন্তু ইউজারের জন্য সব এক ড্যাশবোর্ডে –
                        <span class="font-semibold text-sky-300">seamless multi-product experience</span>।
                    </p>
                </div>
                <div class="flex flex-wrap gap-2 text-[11px] text-slate-300">
                    <span class="badge">Modular</span>
                    <span class="badge">Multi-tenant SaaS</span>
                    <span class="badge">Scalable Infrastructure</span>
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-4 lg:gap-5">
                <div class="service-card glass-card-soft p-4 flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="font-semibold text-slate-50 text-sm">School Management</h3>
                            <p class="pill-domain mt-1">school.zengfy.top</p>
                        </div>
                        <span class="badge-accent text-[10px]">Phase 1</span>
                    </div>
                    <ul class="text-xs text-slate-300 space-y-1.5">
                        <li>• অনলাইন ভর্তি, ফি কালেকশন এবং রিসিট</li>
                        <li>• ড্যাশবোর্ড for Admin, Teacher, Guardian</li>
                        <li>• Result, attendance, SMS &amp; app notification</li>
                    </ul>
                </div>

                <div class="service-card glass-card-soft p-4 flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="font-semibold text-slate-50 text-sm">E‑Commerce &amp; Watch Showroom</h3>
                            <p class="pill-domain mt-1">ecommerce.zengfy.top</p>
                        </div>
                        <span class="badge text-[10px] border-amber-400/70 text-amber-200">Phase 1.5</span>
                    </div>
                    <ul class="text-xs text-slate-300 space-y-1.5">
                        <li>• ব্র্যান্ডেড ঘড়ি ও পণ্যের ক্যাটালগ</li>
                        <li>• Affiliate / referral link system</li>
                        <li>• ইনভেন্টরি + POS ইন্টিগ্রেশন (pos.zengfy.top)</li>
                    </ul>
                </div>

                <div class="service-card glass-card-soft p-4 flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="font-semibold text-slate-50 text-sm">Hotel &amp; Hospitality</h3>
                            <p class="pill-domain mt-1">hotel.zengfy.top</p>
                        </div>
                        <span class="badge text-[10px] border-indigo-400/70 text-indigo-200">Phase 2</span>
                    </div>
                    <ul class="text-xs text-slate-300 space-y-1.5">
                        <li>• রুম বুকিং, ফ্রন্টডেস্ক, হাউসকিপিং</li>
                        <li>• OTA ইন্টিগ্রেশন (Booking, Agoda ইত্যাদি ভবিষ্যতে)</li>
                        <li>• Owner dashboard with reports</li>
                    </ul>
                </div>

                <div class="service-card glass-card-soft p-4 flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="font-semibold text-slate-50 text-sm">Smart POS</h3>
                            <p class="pill-domain mt-1">pos.zengfy.top</p>
                        </div>
                        <span class="badge text-[10px] border-emerald-400/70 text-emerald-200">Phase 2</span>
                    </div>
                    <ul class="text-xs text-slate-300 space-y-1.5">
                        <li>• Retail, restaurant, showroom friendly POS</li>
                        <li>• Work offline &amp; sync with cloud</li>
                        <li>• Direct link to accounts.zengfy.top</li>
                    </ul>
                </div>

                <div class="service-card glass-card-soft p-4 flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="font-semibold text-slate-50 text-sm">Civil, Law &amp; Journal</h3>
                            <p class="pill-domain mt-1">civil / law / journal</p>
                        </div>
                        <span class="badge text-[10px] border-sky-400/70 text-sky-200">Phase 3</span>
                    </div>
                    <ul class="text-xs text-slate-300 space-y-1.5">
                        <li>• Case Management, client portal (law)</li>
                        <li>• Project tracking (civil)</li>
                        <li>• Digital journal publishing &amp; peer review</li>
                    </ul>
                </div>

                <div class="service-card glass-card-soft p-4 flex flex-col gap-3">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="font-semibold text-slate-50 text-sm">Habit &amp; Smart AI</h3>
                            <p class="pill-domain mt-1">havit.zengfy.top &amp; samrtai.zengfy.top</p>
                        </div>
                        <span class="badge text-[10px] border-fuchsia-400/70 text-fuchsia-200">AI Core</span>
                    </div>
                    <ul class="text-xs text-slate-300 space-y-1.5">
                        <li>• ব্যক্তিগত হ্যাবিট ট্র্যাকিং, স্ট্রীক ও অ্যানালিটিক্স</li>
                        <li>• AI পরামর্শ, শেখার রিমাইন্ডার, goal planner</li>
                        <li>• সব সিস্টেমের ডেটা অনুযায়ী smart insight</li>
                    </ul>
                </div>
            </div>
        </section>

        <section id="how-it-works"
            class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 sm:mt-20 grid lg:grid-cols-[minmax(0,1.05fr),minmax(0,1.1fr)] gap-10 lg:gap-14 items-start">
            <div class="space-y-4 scroll-fade">
                <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-slate-50">ZenGFY কীভাবে কাজ করবে?</h2>
                <p class="text-sm text-slate-300 max-w-xl">
                    মূল শক্তি হলো <span class="font-semibold text-sky-300">একক অ্যাকাউন্ট + multi-service
                        onboarding</span>।
                    আলাদা আলাদা সার্ভিস বানানোর পরিবর্তে, আপনি তৈরি করছেন একটি Business Operating System।
                </p>

                <ol class="space-y-3 text-sm text-slate-200">
                    <li class="flex items-start gap-3">
                        <span
                            class="h-6 w-6 rounded-full bg-sky-500/20 border border-sky-400 flex items-center justify-center text-[11px] font-semibold text-sky-200 mt-0.5">1</span>
                        <div>
                            <p class="font-semibold mb-1">User সাইন আপ করে শুধু একবার</p>
                            <p class="text-slate-300 text-[13px]">
                                Email/phone + password + 2FA (optional)। অভ্যন্তরে থাকবে central identity service
                                (accounts.zengfy.top)।
                            </p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span
                            class="h-6 w-6 rounded-full bg-sky-500/20 border border-sky-400 flex items-center justify-center text-[11px] font-semibold text-sky-200 mt-0.5">2</span>
                        <div>
                            <p class="font-semibold mb-1">Onboarding wizard: কোন সার্ভিস লাগবে বেছে নেয়</p>
                            <p class="text-slate-300 text-[13px]">
                                School, hotel, POS, ecommerce, habit – যে সার্ভিস দরকার শুধু সেগুলো এনেবল হবে। প্রতিটি
                                সার্ভিসের নিজস্ব free/paid প্ল্যান।
                            </p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span
                            class="h-6 w-6 rounded-full bg-sky-500/20 border border-sky-400 flex items-center justify-center text-[11px] font-semibold text-sky-200 mt-0.5">3</span>
                        <div>
                            <p class="font-semibold mb-1">একই ড্যাশবোর্ডে multi-business ভিউ</p>
                            <p class="text-slate-300 text-[13px]">
                                Owner/Admin হিসেবে user এক জায়গা থেকেই রেভিনিউ, এক্সপেন্স, রিটেনশন, engagement – সবকিছু
                                দেখতে পারবে।
                            </p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span
                            class="h-6 w-6 rounded-full bg-sky-500/20 border border-sky-400 flex items-center justify-center text-[11px] font-semibold text-sky-200 mt-0.5">4</span>
                        <div>
                            <p class="font-semibold mb-1">AI সার্ভিস সব data যুক্ত করে insight দেয়</p>
                            <p class="text-slate-300 text-[13px]">
                                কোন হোটেলে booking কমছে, কোন school এর fee pending বেশি, POS data থেকে best-selling
                                product – সবকিছু auto-analytics।
                            </p>
                        </div>
                    </li>
                </ol>

                <div class="glass-card-soft p-4 mt-4">
                    <p class="text-xs text-slate-300">
                        <span class="font-semibold text-sky-300">মূল প্রশ্ন: এই আইডিয়া কি “best”?</span><br />
                        আইডিয়ার ভ্যালু নির্ভর করে execution, timing, niche focus, এবং market fit-এর উপর। ZenGFY-এর
                        সুবিধা হলো:
                    </p>
                    <ul class="mt-2 text-xs text-slate-300 space-y-1.5">
                        <li>• একই কোডবেস থেকে বহু vertical SaaS প্রোডাক্ট – development leverage অনেক বেশি।</li>
                        <li>• Cross-selling সম্ভব – একবারের acquisition cost-এ multiple সার্ভিস বিক্রি করা যাবে।</li>
                        <li>• Long-term brand value: “ZenGFY = Bangladesh-এর business OS” পজিশনিং করা যায়।</li>
                    </ul>
                </div>
            </div>

            <div class="relative scroll-fade">
                <div class="glass-card p-5 sm:p-6 relative overflow-hidden">
                    <div
                        class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(56,189,248,0.12),transparent_55%),radial-gradient(circle_at_bottom,rgba(129,140,248,0.16),transparent_55%)] pointer-events-none">
                    </div>
                    <div class="relative">
                        <div class="mb-4 flex items-center justify-between">
                            <span class="badge-accent">Execution Roadmap Snapshot</span>
                            <span class="text-[11px] text-slate-400">MVP → Ecosystem</span>
                        </div>

                        <div class="relative pl-7 mt-3">
                            <div class="timeline-line"></div>

                            <div class="space-y-5 text-xs">
                                <div class="relative flex gap-3">
                                    <div class="mt-1 timeline-bullet timeline-bullet-active"></div>
                                    <div class="space-y-1.5">
                                        <div class="flex items-center gap-2">
                                            <span class="font-semibold text-slate-100 text-sm">Phase 1 — Focused
                                                MVP</span>
                                            <span class="badge text-[9px] border-emerald-400/80 text-emerald-200">0–6
                                                months</span>
                                        </div>
                                        <p class="text-slate-300">
                                            শুধু <span class="font-semibold text-sky-300">২–৩টা strongest
                                                vertical</span> (ধরুন School + POS + Accounts) নিয়ে stable SaaS বানানো।
                                            সলিড architecture, billing, permission, multi-tenant ready করা।
                                        </p>
                                    </div>
                                </div>

                                <div class="relative flex gap-3">
                                    <div class="mt-1 timeline-bullet"></div>
                                    <div class="space-y-1.5">
                                        <div class="flex items-center gap-2">
                                            <span class="font-semibold text-slate-100 text-sm">Phase 2 — E‑Commerce +
                                                Hotel</span>
                                            <span class="badge text-[9px] border-sky-400/80 text-sky-200">6–12
                                                months</span>
                                        </div>
                                        <p class="text-slate-300">
                                            POS/Accounts এর উপর দাঁড়িয়ে Ecommerce ও Hotel module add করা।
                                            Cross-integration: inventory ↔ POS ↔ online order ↔ accounts।
                                        </p>
                                    </div>
                                </div>

                                <div class="relative flex gap-3">
                                    <div class="mt-1 timeline-bullet"></div>
                                    <div class="space-y-1.5">
                                        <div class="flex items-center gap-2">
                                            <span class="font-semibold text-slate-100 text-sm">Phase 3 — AI &amp;
                                                Knowledge Verticals</span>
                                            <span class="badge text-[9px] border-fuchsia-400/80 text-fuchsia-200">Year
                                                2+</span>
                                        </div>
                                        <p class="text-slate-300">
                                            Habit + SmartAI, civil, law, journal সবকিছুকে একসাথে বেঁধে <span
                                                class="font-semibold text-sky-300">AI-powered recommendation &amp;
                                                automation</span> বানানো।
                                        </p>
                                    </div>
                                </div>

                                <div class="relative flex gap-3">
                                    <div class="mt-1 timeline-bullet"></div>
                                    <div class="space-y-1.5">
                                        <div class="flex items-center gap-2">
                                            <span class="font-semibold text-slate-100 text-sm">Long-term — ZenGFY as a
                                                Platform</span>
                                            <span class="badge text-[9px] border-amber-400/80 text-amber-200">Plugin
                                                Ecosystem</span>
                                        </div>
                                        <p class="text-slate-300">
                                            তৃতীয় পক্ষের ডেভেলপাররা যেন ZenGFY ecosystem-এর উপর প্লাগইন/মডিউল বানাতে
                                            পারে – তখনই আইডিয়াটা full potential-এ পৌঁছাবে।
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="mt-5 pt-4 border-t border-slate-700/70 flex flex-wrap gap-3 justify-between items-center">
                            <p class="text-[11px] text-slate-400 max-w-xs">
                                এখনই সবচেয়ে গুরুত্বপূর্ণ কাজ হলো:
                                <span class="font-semibold text-slate-200">একটি লেজার-ফোকাসড MVP বেছে নেওয়া</span> এবং
                                বাকিগুলোকে roadmap-এ রাখা।
                            </p>
                            <button class="btn-ghost text-[11px] whitespace-nowrap">
                                MVP priority list তৈরি করুন
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="roadmap" class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 sm:mt-20">
            <div class="glass-card-soft p-5 sm:p-6">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-4">
                    <div>
                        <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-slate-50">Product-Market Fit ফোকাসড
                            রোডম্যাপ</h2>
                        <p class="text-sm text-slate-300 mt-1 max-w-2xl">
                            সব একসাথে বানানোর চেয়ে <span class="font-semibold text-sky-300">একটা vertical-এ
                                domination</span> পাওয়া বেশি গুরুত্বপূর্ণ।
                            সেখান থেকেই ZenGFY ব্র্যান্ড শক্তিশালী হবে।
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-2 text-[11px] text-slate-300">
                        <span class="badge">Lean Launch</span>
                        <span class="badge">Feedback Loops</span>
                        <span class="badge">Revenue First</span>
                    </div>
                </div>

                <div class="grid md:grid-cols-3 gap-4 text-xs text-slate-200">
                    <div class="glass-card-soft p-4 border border-emerald-500/40">
                        <span class="badge-accent text-[10px] mb-2 inline-block">Step 1 — Validate</span>
                        <h3 class="font-semibold mb-2 text-sm">Target Niche &amp; Pilot</h3>
                        <ul class="space-y-1.5 text-slate-300">
                            <li>• প্রথমে শুধু ১–২ niche (ধরুন school + coaching center) বেছে নিন।</li>
                            <li>• বাস্তব সমস্যা, পেমেন্ট করতে রাজি এমন ক্লায়েন্ট থেকে ফিডব্যাক নিন।</li>
                            <li>• core features ship করুন; extra feature hold-এ রাখুন।</li>
                        </ul>
                    </div>

                    <div class="glass-card-soft p-4 border border-sky-500/40">
                        <span class="badge-accent text-[10px] mb-2 inline-block">Step 2 — Stabilize</span>
                        <h3 class="font-semibold mb-2 text-sm">Codebase &amp; Infrastructure</h3>
                        <ul class="space-y-1.5 text-slate-300">
                            <li>• Multi-tenant architecture + subdomain routing ঠিক করুন।</li>
                            <li>• Central accounts, subscription billing, logging সেটআপ করুন।</li>
                            <li>• UI/UX standardize করে সব সার্ভিসে একই ফিল তৈরি করুন।</li>
                        </ul>
                    </div>

                    <div class="glass-card-soft p-4 border border-fuchsia-500/40">
                        <span class="badge-accent text-[10px] mb-2 inline-block">Step 3 — Scale</span>
                        <h3 class="font-semibold mb-2 text-sm">Add Verticals &amp; AI Layer</h3>
                        <ul class="space-y-1.5 text-slate-300">
                            <li>• একেকটা সার্ভিস add করে cross-selling শুরু করুন।</li>
                            <li>• Habit + SmartAI দিয়ে পুরো ecosystem-এ intelligence যোগ করুন।</li>
                            <li>• Marketplace &amp; 3rd party developers plan করুন।</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section id="faq"
            class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 sm:mt-20 grid lg:grid-cols-[minmax(0,1.1fr),minmax(0,0.9fr)] gap-10 lg:gap-14">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-slate-50 mb-2">FAQ — আইডিয়া নিয়ে সাধারণ
                    প্রশ্ন</h2>
                <p class="text-sm text-slate-300 mb-5 max-w-xl">
                    নিচের কয়েকটা প্রশ্ন <span class="font-semibold text-sky-300">ZenGFY</span> শুরু করার আগে
                    স্ট্র্যাটেজি ক্লিয়ার করতে সাহায্য করবে।
                </p>

                <div class="glass-card-soft p-4 sm:p-5">
                    <div class="faq-item">
                        <button class="w-full faq-question flex items-center justify-between gap-3 text-left">
                            <span class="text-sm font-medium text-slate-100">
                                ১) এই আইডিয়া কি সত্যিই “best” নাকি খুব বড় এবং risky?
                            </span>
                            <span class="faq-chevron text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </span>
                        </button>
                        <div class="faq-answer text-xs text-slate-300 pb-3">
                            <p class="mb-2">
                                “Best idea” বলতে আসলে কিছু নেই – আছে <span class="font-semibold text-sky-300">right
                                    execution + right timing</span>।
                                ZenGFY-এর ভালো দিক হলো:
                            </p>
                            <ul class="list-disc ml-4 space-y-1.5">
                                <li>আপনি শুধু একক প্রোডাক্ট না, বরং একটি ecosystem ব্র্যান্ড তৈরি করছেন।</li>
                                <li>একবার নিজস্ব account/billing সিস্টেম ঠিক করতে পারলে, পরের সার্ভিস রিলিজ করা অনেক সহজ
                                    হবে।</li>
                                <li>বাংলাদেশে vertical SaaS (school, hotel, clinics) এর চাহিদা বাড়ছে – timing ভালো।
                                </li>
                            </ul>
                            <p class="mt-2">
                                ঝুঁকি কমাতে <span class="font-semibold">ছোট scope-এর MVP</span> দিয়ে শুরু করাই
                                বুদ্ধিমানের কাজ।
                            </p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="w-full faq-question flex items-center justify-between gap-3 text-left">
                            <span class="text-sm font-medium text-slate-100">
                                ২) শুরুতে কোন সার্ভিস দিয়ে লঞ্চ করলে ভালো?
                            </span>
                            <span class="faq-chevron text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </span>
                        </button>
                        <div class="faq-answer text-xs text-slate-300 pb-3">
                            <p class="mb-2">
                                যেগুলোর <span class="font-semibold text-sky-300">চাহিদা প্রমাণিত</span> এবং আপনি দ্রুত
                                বিক্রি করতে পারবেন, সেগুলো দিয়ে শুরু করা সেফ:
                            </p>
                            <ul class="list-disc ml-4 space-y-1.5">
                                <li><span class="font-semibold">School Management:</span> আগে থেকেই মার্কেট আছে, monthly
                                    recurring revenue সম্ভব।</li>
                                <li><span class="font-semibold">POS / Retail:</span> ছোট ব্যবসা, রেস্তোরাঁ, শোরুম –
                                    সবখানে প্রয়োজন।</li>
                            </ul>
                            <p class="mt-2">
                                এই দুটো vertical stabilize হলে পরেরগুলো অনেক বেশি confident হয়ে build করতে পারবেন।
                            </p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="w-full faq-question flex items-center justify-between gap-3 text-left">
                            <span class="text-sm font-medium text-slate-100">
                                ৩) Monetization কীভাবে হবে?
                            </span>
                            <span class="faq-chevron text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </span>
                        </button>
                        <div class="faq-answer text-xs text-slate-300 pb-3">
                            <ul class="list-disc ml-4 space-y-1.5">
                                <li>প্রতি সার্ভিস আলাদা subscription tier (Basic, Pro, Enterprise)।</li>
                                <li>Per-user / per-location pricing (school branch, hotel branch, store ইত্যাদি)।</li>
                                <li>Usage-based add-on (extra storage, SMS, AI credits)।</li>
                                <li>Cross-sell bundle plan – multiple সার্ভিস নিলে ডিসকাউন্ট।</li>
                            </ul>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="w-full faq-question flex items-center justify-between gap-3 text-left">
                            <span class="text-sm font-medium text-slate-100">
                                ৪) Tech stack কীভাবে ভাবা উচিত?
                            </span>
                            <span class="faq-chevron text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </span>
                        </button>
                        <div class="faq-answer text-xs text-slate-300 pb-3">
                            <p class="mb-2">
                                Tech stack এমন হওয়া উচিত যেটা আপনার টিমের জন্য কমফর্টেবল এবং <span
                                    class="font-semibold text-sky-300">multi-tenant + subdomain routing</span> সহজ করে:
                            </p>
                            <ul class="list-disc ml-4 space-y-1.5">
                                <li>Monolith core (Laravel / Node / Django) + modular architecture।</li>
                                <li>Shared auth + billing service, কিন্তু ফিচার-wise আলাদা module।</li>
                                <li>Early stage-এ সার্ভিস আলাদা repo না রেখে single repo-তেই রাখা যায়।</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div id="contact" class="glass-card-soft p-5 sm:p-6 h-fit">
                <h3 class="text-lg font-semibold text-slate-50 mb-1.5">ZenGFY Waitlist / Idea Feedback</h3>
                <p class="text-xs text-slate-300 mb-4">
                    আপনি যদি এই প্রজেক্ট চালু করতে চান, নিচের details-based planning নিজের জন্য লিখে নিন –
                    চাইলে এটাকে অনলাইন ফর্মেও রূপান্তর করতে পারবেন।
                </p>

                <form class="space-y-3 text-xs">
                    <div>
                        <label class="block mb-1 text-slate-200" for="email">ইমেইল / কনট্যাক্ট</label>
                        <input id="email" type="email" class="input-field" placeholder="you@example.com" />
                    </div>
                    <div>
                        <label class="block mb-1 text-slate-200" for="primary-niche">প্রথম টার্গেট নিস (School / POS /
                            অন্য কিছু)</label>
                        <input id="primary-niche" type="text" class="input-field"
                            placeholder="যেমন: School + Coaching center" />
                    </div>
                    <div>
                        <label class="block mb-1 text-slate-200" for="timeline">লক্ষ্য সময় (কখন MVP লঞ্চ করতে
                            চান)</label>
                        <input id="timeline" type="text" class="input-field" placeholder="যেমন: ৬ মাসের মধ্যে" />
                    </div>
                    <div>
                        <label class="block mb-1 text-slate-200" for="note">যে বিষয়গুলো নিয়ে আপনি অনিশ্চিত</label>
                        <textarea id="note" rows="3" class="input-field rounded-2xl resize-none"
                            placeholder="Architecture, মার্কেটিং, টিম, ফান্ডিং – যা মনে আসে লিখে রাখুন"></textarea>
                    </div>
                    <button type="button" class="btn-primary w-full text-xs justify-center flex">
                        নিজের জন্য এই প্ল্যান সেভ করুন (demo)
                    </button>
                    <p class="text-[11px] text-slate-400 mt-2">
                        এই ফর্মটি এখন demo – আসল প্রোডাক্টে এটিই হবে onboarding-এর অংশ।
                    </p>
                </form>
            </div>
        </section>
    </main>

    <footer class="border-t border-slate-800/80 mt-10 sm:mt-16">
        <div
            class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-5 flex flex-col sm:flex-row gap-3 sm:items-center justify-between text-[11px] text-slate-400">
            <div class="flex items-center gap-2">
                <span>© <span id="year"></span> ZenGFY Concept.</span>
                <span class="hidden sm:inline text-slate-600">|</span>
                <span>Designed as a unified SaaS OS idea.</span>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="#overview" class="hover:text-slate-200">Overview</a>
                <a href="#services" class="hover:text-slate-200">Services</a>
                <a href="#how-it-works" class="hover:text-slate-200">Execution Strategy</a>
            </div>
        </div>
    </footer>

    <script>
            (function () {
                const navLinks = document.querySelectorAll('header nav a.nav-link');
                const sections = ['overview', 'services', 'how-it-works', 'roadmap', 'faq', 'contact']
                    .map(id => document.getElementById(id))
                    .filter(Boolean);

                function onScroll() {
                    const scrollPos = window.scrollY + 96;
                    let currentId = null;
                    for (const sec of sections) {
                        if (scrollPos >= sec.offsetTop) currentId = sec.id;
                    }
                    navLinks.forEach(link => {
                        link.classList.toggle('active', link.getAttribute('href') === '#' + currentId);
                    });
                }
                window.addEventListener('scroll', onScroll, { passive: true });
                onScroll();

                const mobileToggle = document.querySelector('.nav-mobile-toggle');
                const mobileMenu = document.querySelector('.nav-mobile-menu');

                if (mobileToggle && mobileMenu) {
                    mobileToggle.addEventListener('click', () => {
                        const open = mobileMenu.style.transform === 'scaleY(1)';
                        mobileMenu.style.transform = open ? 'scaleY(0)' : 'scaleY(1)';
                        mobileMenu.style.opacity = open ? '0' : '1';
                    });

                    mobileMenu.querySelectorAll('a').forEach(a => {
                        a.addEventListener('click', () => {
                            mobileMenu.style.transform = 'scaleY(0)';
                            mobileMenu.style.opacity = '0';
                        });
                    });
                }

                const faqQuestions = document.querySelectorAll('.faq-question');
                faqQuestions.forEach(btn => {
                    btn.addEventListener('click', () => {
                        const answer = btn.parentElement.querySelector('.faq-answer');
                        const chevron = btn.querySelector('.faq-chevron');

                        const isOpen = answer.classList.contains('open');
                        const maxHeight = isOpen ? 0 : answer.scrollHeight;

                        answer.style.maxHeight = maxHeight + 'px';
                        answer.classList.toggle('open', !isOpen);
                        chevron.classList.toggle('rotated', !isOpen);
                    });
                });

                document.getElementById('year').textContent = new Date().getFullYear();
            })();
    </script>
</body>

</html>