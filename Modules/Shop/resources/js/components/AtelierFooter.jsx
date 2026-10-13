import React from 'react';

export default function AtelierFooter({ brandData }) {
    return (
        <footer className="bg-slate-950 text-white border-t border-slate-900">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 py-12 grid grid-cols-1 md:grid-cols-4 gap-8 text-xs text-slate-400">
                <div className="md:col-span-2">
                    <span className="text-xl font-black tracking-widest text-white uppercase font-mono">
                        ZENGFY ATELIER
                    </span>
                    <div className="text-[10px] tracking-[0.25em] text-slate-400 uppercase mt-0.5 mb-3">
                        {brandData?.sub_label || "SOVEREIGN APPAREL • DHAKA"}
                    </div>
                    <p className="max-w-sm leading-relaxed mb-4 text-slate-300">
                        সফটওয়্যার নির্মাতাদের জন্য নিবেদিত লাইফস্টাইল ব্র্যান্ড। ৩৮০ GSM হেভিওয়েট ফ্রেঞ্চ টেরি হুডি ও ড্রপ-শোল্ডার বক্সি টি-শার্ট।
                    </p>
                    <div className="text-[11px] text-slate-500">
                        স্টুডিও: {brandData?.studio_address || "হাউজ ১৪, রোড ১১, বনানী, ঢাকা-১২১৩"}
                    </div>
                </div>

                <div>
                    <h4 className="text-xs font-black uppercase tracking-wider text-white mb-3 font-mono">গ্রাহক সেবা ও নীতি</h4>
                    <ul className="space-y-2">
                        <li><a href="#collection-grid" className="hover:text-white transition-colors">৭ দিনের সাইজ এক্সচেঞ্জ</a></li>
                        <li><a href="#collection-grid" className="hover:text-white transition-colors">ফ্যাব্রিক কেয়ার নির্দেশিকা</a></li>
                        <li><a href="#collection-grid" className="hover:text-white transition-colors">এক্সপ্রেস ডেলিভারি ট্র্যাকিং</a></li>
                        <li><a href="#collection-grid" className="hover:text-white transition-colors">ক্যাশ অন ডেলিভারি নির্দেশিকা</a></li>
                    </ul>
                </div>

                <div>
                    <h4 className="text-xs font-black uppercase tracking-wider text-white mb-3 font-mono">ইকোসিস্টেম হাব</h4>
                    <ul className="space-y-2">
                        <li><a href="http://ecommerce.zengfy.test:8000/" className="text-purple-400 hover:text-purple-300 font-bold transition-colors">🛍️ Zengfy Marketplace (Daraz-Style)</a></li>
                        <li><a href="http://zengfy.test:8000/" className="hover:text-white transition-colors">🏛️ Zengfy Core Portal</a></li>
                        <li><a href="http://social.zengfy.test:8000/" className="hover:text-white transition-colors">🌍 Zengfy Social Network</a></li>
                        <li><a href="http://pos.zengfy.test:8000/" className="hover:text-white transition-colors">⚡ Zengfy POS System</a></li>
                    </ul>
                </div>
            </div>

            <div className="border-t border-slate-900 py-6 px-4 text-center text-[11px] text-slate-600 font-mono">
                © 2026 ZENGFY ATELIER. CRAFTED IN DHAKA. ALL RIGHTS RESERVED.
            </div>
        </footer>
    );
}
