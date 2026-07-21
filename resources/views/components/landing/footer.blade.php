<!-- p:\Zengfy-Ecosystem\core\resources\views\components\landing\footer.blade.php -->
<footer class="bg-gray-50 border-t border-gray-100 pt-16 pb-12 text-sm">
    <div class="max-w-7xl mx-auto px-6 sm:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center gap-2 mb-6">
                    <img src="{{ asset('images/logo.png') }}" alt="Zengfy Logo" class="h-8 w-auto">
                    <span class="text-2xl font-black text-blue-600 tracking-tighter">zengfy</span>
                </div>
                <p class="text-gray-500 font-medium max-w-sm leading-relaxed mb-6">
                    Architecting a unified digital ecosystem for small businesses and communities.
                </p>
            </div>

            <div class="col-span-1">
                <h4 class="font-black text-gray-900 mb-6 uppercase tracking-widest text-xs">Contact Us</h4>
                <ul class="space-y-4 text-gray-500 font-medium">
                    <li>Dhaka, Bangladesh</li>
                    <li><a href="mailto:info@zengfy.top" class="hover:text-blue-600 transition">info@zengfy.top</a></li>
                    <li>+880 1953 576147</li>
                </ul>
            </div>

            <div class="col-span-1">
                <h4 class="font-black text-gray-900 mb-6 uppercase tracking-widest text-xs">Community</h4>
                <ul class="space-y-4 text-gray-500 font-medium">
                    <li><a href="#" class="hover:text-blue-600 transition">Business Feed</a></li>
                    <li><a href="#" class="hover:text-blue-600 transition">Our Team</a></li>
                    <li><a href="{{ route('policy.workplace') }}" class="hover:text-blue-600 transition">Workplace Policy</a></li>
                    <li><a href="#" class="hover:text-blue-600 transition">Insights Blog</a>
                    </li>
                </ul>
            </div>
        </div>

        <div
            class="pt-8 border-t border-gray-200 flex flex-col md:flex-row justify-between items-center gap-4 text-gray-400 font-bold text-xs uppercase tracking-widest">
            <div>{{ __('welcome.footer.rights') }}</div>
            <div class="flex gap-8">
                <a href="{{ route('policy.workplace') }}" class="hover:text-blue-600 transition">Workplace Policy</a>
                <a href="#" class="hover:text-blue-600 transition">Privacy</a>
                <a href="#" class="hover:text-blue-600 transition">Terms</a>
            </div>
        </div>
    </div>
</footer>
