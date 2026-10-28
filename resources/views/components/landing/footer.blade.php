<!-- resources/views/components/landing/footer.blade.php -->
<footer class="bg-[#0B0F17] border-t border-white/10 pt-16 pb-12 text-sm text-gray-300">
    <div class="max-w-7xl mx-auto px-6">

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 sm:gap-10 pb-12 border-b border-white/5">

            <!-- Column 1: Brand & Status (Full width on mobile grid-cols-2) -->
            <div class="col-span-2 md:col-span-1">
                <a href="/" aria-label="Zengfy" class="flex items-center gap-3 group mb-4 min-h-[44px] inline-flex items-center focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 rounded-xl p-1">
                    <div aria-hidden="true" class="w-9 h-9 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-500 flex items-center justify-center font-black text-lg text-white group-hover:scale-105 transition-transform">
                        Z
                    </div>
                    <span class="text-xl font-extrabold tracking-tight text-white group-hover:text-gray-200 transition-colors">
                        Zengfy<span class="text-blue-500 font-black" aria-hidden="true">.</span>
                    </span>
                </a>

                <p class="text-xs text-gray-300 leading-relaxed font-normal mb-6 max-w-sm">
                    Building the sovereign digital ecosystem for Bangladesh. One account for every tool in your life & business.
                </p>

                <!-- System Operational Status Pill -->
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-semibold">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>All Systems Operational</span>
                </div>
            </div>

            <!-- Column 2: Ecosystem Applications -->
            <div>
                <h3 class="text-white font-bold text-xs sm:text-sm mb-4 tracking-wider uppercase">Operating Systems</h3>
                <ul class="space-y-1.5 text-xs font-medium">
                    <li><a href="http://school.zengfy.top:7000" target="_blank" rel="noopener noreferrer" class="py-2 px-1 min-h-[36px] inline-flex items-center hover:text-white transition-colors">School ERP Suite</a></li>
                    <li><a href="http://pos.zengfy.top:7000" target="_blank" rel="noopener noreferrer" class="py-2 px-1 min-h-[36px] inline-flex items-center hover:text-white transition-colors">POS Retail & Inventory</a></li>
                    <li><a href="http://law.zengfy.top:7000" target="_blank" rel="noopener noreferrer" class="py-2 px-1 min-h-[36px] inline-flex items-center hover:text-white transition-colors">Legal Case Management</a></li>
                    <li><a href="http://social.zengfy.top:7000" target="_blank" rel="noopener noreferrer" class="py-2 px-1 min-h-[36px] inline-flex items-center hover:text-white transition-colors">Social Network Feed</a></li>
                    <li><a href="http://ecommerce.zengfy.top:7000" target="_blank" rel="noopener noreferrer" class="py-2 px-1 min-h-[36px] inline-flex items-center hover:text-white transition-colors">E-Commerce Engine</a></li>
                </ul>
            </div>

            <!-- Column 3: Security & Platform -->
            <div>
                <h3 class="text-white font-bold text-xs sm:text-sm mb-4 tracking-wider uppercase">Security & Trust</h3>
                <ul class="space-y-1.5 text-xs font-medium">
                    <li><a href="{{ route('download.app') }}" class="py-2 px-1 min-h-[36px] hover:text-cyan-300 text-cyan-400 font-semibold inline-flex items-center gap-1.5"><span>📱</span> Download Android APK</a></li>
                    <li><a href="#security" class="py-2 px-1 min-h-[36px] inline-flex items-center hover:text-white transition-colors">NID Identity Layer</a></li>
                    <li><a href="#sso" class="py-2 px-1 min-h-[36px] inline-flex items-center hover:text-white transition-colors">Central SSO Token Engine</a></li>
                    <li><a href="#" class="py-2 px-1 min-h-[36px] inline-flex items-center hover:text-white transition-colors">256-Bit Data Sovereignty</a></li>
                    <li><a href="#" class="py-2 px-1 min-h-[36px] inline-flex items-center hover:text-white transition-colors">Cloud Infrastructure SLA</a></li>
                </ul>
            </div>

            <!-- Column 4: Corporate & Legal (2-Column Grid on Mobile) -->
            <div class="col-span-2 md:col-span-1 border-t border-white/5 md:border-none pt-4 md:pt-0">
                <h3 class="text-white font-bold text-xs sm:text-sm mb-3 md:mb-4 tracking-wider uppercase">Company</h3>
                <ul class="grid grid-cols-2 md:block gap-1 md:space-y-1.5 text-xs font-medium">
                    <li><a href="{{ Route::has('company') ? route('company') : '/company' }}" class="py-2 px-1 min-h-[36px] inline-flex items-center hover:text-white transition-colors">Company & Team</a></li>
                    <li><a href="{{ route('policy.workplace') }}" class="py-2 px-1 min-h-[36px] inline-flex items-center hover:text-white transition-colors">Workplace Policy</a></li>
                    <li><a href="{{ Route::has('faq') ? route('faq') : '/faq' }}" class="py-2 px-1 min-h-[36px] inline-flex items-center hover:text-white transition-colors">Frequently Asked Questions</a></li>
                    <li><a href="{{ Route::has('terms') ? route('terms') : '/terms' }}" class="py-2 px-1 min-h-[36px] inline-flex items-center hover:text-white transition-colors">Terms of Service & Privacy</a></li>
                </ul>
            </div>

        </div>

        <!-- Bottom Bar -->
        <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-gray-300 gap-4">
            <div>
                © {{ date('Y') }} Zengfy Inc. All rights reserved. Built with pride for Bangladesh 🇧🇩
            </div>

            <!-- Footer Exclusive Language Switcher -->
            <div class="flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/5 border border-white/10 text-xs text-gray-300">
                <span class="text-gray-400 font-semibold">🌐 ভাষা / Language:</span>
                <a href="{{ route('lang.switch', 'bn') }}" class="px-2 py-1 min-h-[32px] inline-flex items-center rounded-md transition-all {{ session('locale', 'bn') === 'bn' ? 'bg-blue-600 text-white font-bold shadow-sm' : 'hover:text-white text-gray-400' }}">🇧🇩 বাংলা</a>
                <span class="text-gray-600">|</span>
                <a href="{{ route('lang.switch', 'en') }}" class="px-2 py-1 min-h-[32px] inline-flex items-center rounded-md transition-all {{ session('locale') === 'en' ? 'bg-blue-600 text-white font-bold shadow-sm' : 'hover:text-white text-gray-400' }}">🇬🇧 English</a>
            </div>

            <div class="flex items-center gap-6">
                <a href="{{ Route::has('terms') ? route('terms') : '/terms' }}" class="py-2 px-1 min-h-[36px] inline-flex items-center hover:text-white transition-colors">Privacy & Terms</a>
                <a href="{{ Route::has('terms') ? route('terms') : '/terms' }}" class="py-2 px-1 min-h-[36px] inline-flex items-center hover:text-white transition-colors">NID Security Policy</a>
            </div>
        </div>

    </div>
</footer>
