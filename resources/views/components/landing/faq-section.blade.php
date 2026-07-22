<!-- resources/views/components/landing/faq-section.blade.php -->
<section id="faq" class="relative w-full max-w-full py-16 sm:py-24 bg-[#0E1420] border-t border-white/5 overflow-hidden">

    <div class="max-w-5xl mx-auto px-4 sm:px-6 relative z-10">

        <!-- Section Header -->
        <div class="text-center mb-16">
            <span class="text-blue-400 font-extrabold tracking-widest uppercase text-xs bg-blue-500/10 border border-blue-500/20 px-4 py-1.5 rounded-full">
                Everything You Need to Know
            </span>
            <h2 class="text-3xl sm:text-5xl font-black mt-4 text-white tracking-tight">
                Frequently Asked Questions
            </h2>
            <p class="text-gray-300 text-lg sm:text-xl max-w-2xl mx-auto font-normal mt-3">
                Have questions about NID verification, SSO login, or local payments? We've got answers.
            </p>
        </div>

        <!-- Accordion Container -->
        <div class="space-y-4">

            <!-- Question 1 -->
            <details class="group rounded-2xl bg-[#121A29]/70 border border-white/10 p-6 [&_summary::-webkit-details-marker]:hidden transition-all duration-300">
                <summary class="flex items-center justify-between cursor-pointer text-lg font-bold text-white group-open:text-blue-400">
                    <span>What is Zengfy and how does Single Sign-On (SSO) work?</span>
                    <span class="ml-4 shrink-0 transition-transform duration-300 group-open:-rotate-180 text-blue-400 font-black">
                        ↓
                    </span>
                </summary>
                <p class="mt-4 text-gray-300 text-sm sm:text-base leading-relaxed border-t border-white/5 pt-4">
                    Zengfy is a unified digital operating system for Bangladesh. Once you create a single account, you can access School ERP, POS Retail, Legal Suite, and Social Network using our 9-Dot App Switcher without ever re-entering passwords.
                </p>
            </details>

            <!-- Question 2 -->
            <details class="group rounded-2xl bg-[#121A29]/70 border border-white/10 p-6 [&_summary::-webkit-details-marker]:hidden transition-all duration-300">
                <summary class="flex items-center justify-between cursor-pointer text-lg font-bold text-white group-open:text-blue-400">
                    <span>How is NID Verification handled and is my data secure?</span>
                    <span class="ml-4 shrink-0 transition-transform duration-300 group-open:-rotate-180 text-blue-400 font-black">
                        ↓
                    </span>
                </summary>
                <p class="mt-4 text-gray-300 text-sm sm:text-base leading-relaxed border-t border-white/5 pt-4">
                    NID verification ensures real, accountable identities across our ecosystem to prevent fraud and spam. All institutional and financial data is stored using enterprise-grade 256-bit SSL encryption.
                </p>
            </details>

            <!-- Question 3 -->
            <details class="group rounded-2xl bg-[#121A29]/70 border border-white/10 p-6 [&_summary::-webkit-details-marker]:hidden transition-all duration-300">
                <summary class="flex items-center justify-between cursor-pointer text-lg font-bold text-white group-open:text-blue-400">
                    <span>How does pricing and local payment work in Bangladesh?</span>
                    <span class="ml-4 shrink-0 transition-transform duration-300 group-open:-rotate-180 text-blue-400 font-black">
                        ↓
                    </span>
                </summary>
                <p class="mt-4 text-gray-300 text-sm sm:text-base leading-relaxed border-t border-white/5 pt-4">
                    Zengfy accounts are free forever for personal use. Specialized business modules (like School ERP or POS Retail) have dedicated pricing tiers available on their respective subdomains. We natively support bKash, Nagad, Rocket, and local debit/credit cards.
                </p>
            </details>

            <!-- Question 4 -->
            <details class="group rounded-2xl bg-[#121A29]/70 border border-white/10 p-6 [&_summary::-webkit-details-marker]:hidden transition-all duration-300">
                <summary class="flex items-center justify-between cursor-pointer text-lg font-bold text-white group-open:text-blue-400">
                    <span>Can I migrate my existing school or shop data to Zengfy?</span>
                    <span class="ml-4 shrink-0 transition-transform duration-300 group-open:-rotate-180 text-blue-400 font-black">
                        ↓
                    </span>
                </summary>
                <p class="mt-4 text-gray-300 text-sm sm:text-base leading-relaxed border-t border-white/5 pt-4">
                    Yes! Our onboarding team provides automated CSV and Excel import tools so you can effortlessly import students, inventory items, and historical customer data into Zengfy.
                </p>
            </details>

        </div>

    </div>
</section>
