<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zengfy | FAQ</title>
    <meta name="description" content="Answers to common questions about Zengfy, onboarding, billing, and data security.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        display: ['"Space Grotesk"', 'sans-serif'],
                    },
                    colors: {
                        ink: {
                            900: '#0f172a'
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Space Grotesk', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 antialiased">
    <header class="bg-white/90 backdrop-blur shadow-sm sticky top-0 z-40">
        <div class="max-w-6xl mx-auto px-4 py-4 flex flex-wrap items-center justify-between gap-3">
            <a href="{{ route('welcome') }}" class="text-2xl font-bold text-blue-600">Zengfy</a>
            <nav class="flex flex-wrap items-center gap-3 text-sm sm:text-base">
                <a href="{{ route('welcome') }}" class="text-slate-600 hover:text-blue-600">Home</a>
                <a href="{{ route('team') }}" class="text-slate-600 hover:text-blue-600">Team</a>
                <a href="{{ route('download.app') }}" class="text-slate-600 hover:text-blue-600">Download App</a>
                <a href="{{ route('faq') }}" class="text-blue-700 font-semibold">FAQ</a>
                <a href="{{ route('signup') }}" class="bg-yellow-400 text-gray-900 px-4 py-2 rounded font-semibold hover:bg-yellow-300 transition">Sign Up</a>
            </nav>
        </div>
    </header>

    <main>
        <section class="bg-gradient-to-br from-blue-600 via-blue-500 to-emerald-500 text-white py-14">
            <div class="max-w-5xl mx-auto px-4 grid lg:grid-cols-2 gap-10 items-center">
                <div class="space-y-4">
                    <p class="uppercase tracking-[0.4em] text-white/80 text-xs">FAQ</p>
                    <h1 class="text-4xl sm:text-5xl font-extrabold leading-tight">Quick answers about Zengfy</h1>
                    <p class="text-lg text-white/85">Find details on onboarding, pricing, integrations, and how we protect your data across the Zengfy SaaS suite.</p>
                    <div class="flex flex-wrap gap-3">
                        <a href="mailto:team@zengfy.top" class="bg-white text-ink-900 px-5 py-3 rounded-lg font-semibold shadow hover:-translate-y-0.5 transition">Ask a new question</a>
                        <a href="{{ route('signup') }}" class="border border-white/70 px-5 py-3 rounded-lg font-semibold text-white hover:bg-white/10 transition">Start a trial</a>
                    </div>
                </div>
                <div class="bg-white/10 border border-white/30 rounded-2xl p-6 shadow-xl backdrop-blur">
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div class="p-4 rounded-xl bg-white/10 border border-white/20">
                            <p class="text-white/70">Avg. onboarding</p>
                            <p class="text-3xl font-bold">5 days</p>
                        </div>
                        <div class="p-4 rounded-xl bg-white/10 border border-white/20">
                            <p class="text-white/70">Support</p>
                            <p class="text-3xl font-bold">24/5</p>
                        </div>
                        <div class="p-4 rounded-xl bg-white/10 border border-white/20">
                            <p class="text-white/70">Uptime (90d)</p>
                            <p class="text-3xl font-bold">99.9%</p>
                        </div>
                        <div class="p-4 rounded-xl bg-white/10 border border-white/20">
                            <p class="text-white/70">Languages</p>
                            <p class="text-3xl font-bold">BN / EN</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="max-w-5xl mx-auto px-4 py-12 space-y-10">
            <div class="space-y-3">
                <h2 class="text-3xl font-bold text-ink-900">Frequently asked questions</h2>
                <p class="text-slate-600 max-w-3xl">These are the topics new customers ask us about most. We will expand and localize this list in Bangla as we refine the site.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <article class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 space-y-4">
                    <p class="text-xs uppercase tracking-[0.3em] text-slate-500">Getting started</p>
                    <dl class="space-y-4">
                        <div>
                            <dt class="font-semibold text-ink-900">How long does onboarding take?</dt>
                            <dd class="text-slate-600">Most teams go live in 3-7 business days. We provide data import templates, training sessions, and a sandbox so you can test before launch.</dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-ink-900">Do you have a free trial?</dt>
                            <dd class="text-slate-600">Yes. New workspaces start on a 14-day trial with full access to core modules. No credit card is required to explore.</dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-ink-900">Can we migrate from spreadsheets?</dt>
                            <dd class="text-slate-600">We import CSV/Excel for products, contacts, and transactions. For complex data, our team can assist with a one-time migration plan.</dd>
                        </div>
                    </dl>
                </article>

                <article class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 space-y-4">
                    <p class="text-xs uppercase tracking-[0.3em] text-slate-500">Product</p>
                    <dl class="space-y-4">
                        <div>
                            <dt class="font-semibold text-ink-900">What modules are included?</dt>
                            <dd class="text-slate-600">Current bundles cover ecommerce, POS, school ERP, hotel management, rentals, workflow automation, and AI messaging. You can enable only what you need.</dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-ink-900">Is there a mobile app?</dt>
                            <dd class="text-slate-600">Yes. Download the Android app from the “Download App” link. Web access is fully responsive for mobile browsers.</dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-ink-900">Can we integrate with other tools?</dt>
                            <dd class="text-slate-600">We expose REST APIs for orders, inventory, students, and messaging. Webhooks are available on the Growth plan and higher.</dd>
                        </div>
                    </dl>
                </article>

                <article class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 space-y-4">
                    <p class="text-xs uppercase tracking-[0.3em] text-slate-500">Billing</p>
                    <dl class="space-y-4">
                        <div>
                            <dt class="font-semibold text-ink-900">How is pricing structured?</dt>
                            <dd class="text-slate-600">Plans are subscription-based by workspace with usage tiers for messaging volume and storage. Optional add-ons cover premium support and custom integrations.</dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-ink-900">Do you offer discounts?</dt>
                            <dd class="text-slate-600">Annual commitments receive a discount. We also provide startup and education pricing on review—contact us to see if you qualify.</dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-ink-900">What payment methods are supported?</dt>
                            <dd class="text-slate-600">We accept local bank transfer and international cards. In Bangladesh we also support mobile wallets for monthly invoices.</dd>
                        </div>
                    </dl>
                </article>

                <article class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 space-y-4">
                    <p class="text-xs uppercase tracking-[0.3em] text-slate-500">Data & security</p>
                    <dl class="space-y-4">
                        <div>
                            <dt class="font-semibold text-ink-900">Where is data hosted?</dt>
                            <dd class="text-slate-600">Data is stored in ISO-certified cloud regions with daily encrypted backups. We can pin data residency on request.</dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-ink-900">How do you secure access?</dt>
                            <dd class="text-slate-600">We use HTTPS everywhere, role-based access, audit logs, and strong password hashing. SSO and 2FA are available on higher plans.</dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-ink-900">Can we export our data?</dt>
                            <dd class="text-slate-600">Yes. Admins can export structured CSVs at any time. For bulk or historical exports we provide a support-assisted download.</dd>
                        </div>
                    </dl>
                </article>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl p-6 flex flex-col md:flex-row items-center justify-between gap-4 shadow-sm">
                <div>
                    <p class="text-sm uppercase tracking-[0.35em] text-slate-500">Still need help?</p>
                    <h3 class="text-2xl font-bold text-ink-900">Talk to the Zengfy team</h3>
                    <p class="text-slate-600 mt-1">Tell us about your workflow and we will suggest the right modules.</p>
                </div>
                <div class="flex gap-3">
                    <a href="mailto:team@zengfy.top" class="px-5 py-3 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-500 transition">Email support</a>
                    <a href="{{ route('signup') }}" class="px-5 py-3 rounded-lg border border-slate-300 text-slate-800 font-semibold hover:border-slate-400 transition">Create account</a>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-slate-900 text-white py-8">
        <div class="max-w-6xl mx-auto px-4 flex flex-wrap items-center justify-between gap-4 text-sm">
            <div class="space-y-1">
                <p class="font-semibold">Zengfy</p>
                <p class="text-slate-300">Unified SaaS for commerce, education, hospitality, and workflows.</p>
            </div>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('welcome') }}" class="hover:text-blue-300">Home</a>
                <a href="{{ route('team') }}" class="hover:text-blue-300">Team</a>
                <a href="{{ route('download.app') }}" class="hover:text-blue-300">Download App</a>
                <a href="{{ route('faq') }}" class="hover:text-blue-300">FAQ</a>
                <a href="{{ route('signup') }}" class="hover:text-blue-300">Sign Up</a>
            </div>
        </div>
    </footer>
</body>

</html>
