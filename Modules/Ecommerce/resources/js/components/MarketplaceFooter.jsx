import React from 'react';
import { ShieldCheck, Truck, Headphones, RotateCcw } from 'lucide-react';

export default function MarketplaceFooter() {
    return (
        <footer className="bg-slate-900 text-white mt-12 border-t border-slate-800">
            {/* Top 4 Value Badges */}
            <div className="border-b border-slate-800">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 py-8 grid grid-cols-2 lg:grid-cols-4 gap-6">
                    <div className="flex items-center gap-3">
                        <div className="w-10 h-10 rounded-xl bg-purple-500/20 text-purple-400 flex items-center justify-center shrink-0">
                            <Truck className="w-5 h-5" />
                        </div>
                        <div>
                            <div className="text-xs font-bold text-white">এক্সপ্রেস কুরিয়ার শিপিং</div>
                            <div className="text-[11px] text-slate-400">ঢাকা ২৪ ঘণ্টা, সারা দেশ ৪৮-৭২ ঘণ্টা</div>
                        </div>
                    </div>

                    <div className="flex items-center gap-3">
                        <div className="w-10 h-10 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0">
                            <ShieldCheck className="w-5 h-5" />
                        </div>
                        <div>
                            <div className="text-xs font-bold text-white">১০০% ভেরিফায়েড সেলার</div>
                            <div className="text-[11px] text-slate-400">জাতীয় পরিচয়পত্র যাচাইকৃত মার্চেন্ট</div>
                        </div>
                    </div>

                    <div className="flex items-center gap-3">
                        <div className="w-10 h-10 rounded-xl bg-orange-500/20 text-orange-400 flex items-center justify-center shrink-0">
                            <RotateCcw className="w-5 h-5" />
                        </div>
                        <div>
                            <div className="text-xs font-bold text-white">৭ দিনের ইজি রিটার্ন</div>
                            <div className="text-[11px] text-slate-400">ঝামেলাহীন ফুল রিফান্ড গ্যারান্টি</div>
                        </div>
                    </div>

                    <div className="flex items-center gap-3">
                        <div className="w-10 h-10 rounded-xl bg-sky-500/20 text-sky-400 flex items-center justify-center shrink-0">
                            <Headphones className="w-5 h-5" />
                        </div>
                        <div>
                            <div className="text-xs font-bold text-white">২৪/৭ কাস্টমার কেয়ার</div>
                            <div className="text-[11px] text-slate-400">হটলাইন: ০৯৬৭৮-১১২২৩৩</div>
                        </div>
                    </div>
                </div>
            </div>

            {/* Main Links Footer */}
            <div className="max-w-7xl mx-auto px-4 sm:px-6 py-10 grid grid-cols-1 md:grid-cols-4 gap-8 text-xs text-slate-400">
                <div>
                    <div className="flex items-center gap-2 mb-3">
                        <div className="w-7 h-7 rounded-lg bg-gradient-to-tr from-purple-600 to-orange-500 flex items-center justify-center text-white font-black text-sm">
                            🛍️
                        </div>
                        <span className="text-sm font-black text-white">Zengfy Marketplace</span>
                    </div>
                    <p className="leading-relaxed mb-4">
                        বাংলাদেশের প্রথম অ্যান্টি-ফ্রড মাল্টি-ভেন্ডর ই-কমার্স ইকোসিস্টেম। দারাজের চেয়ে ৫০% কম কমিশন এবং জিরো রিটার্ন লস গ্যারান্টি।
                    </p>
                    <div className="text-[11px] text-slate-500">
                        লাইসেন্স: Zengfy Sovereign Platform LTD
                    </div>
                </div>

                <div>
                    <h4 className="text-xs font-black uppercase tracking-wider text-white mb-3">গ্রাহক সেবা</h4>
                    <ul className="space-y-2">
                        <li><a href="#just-for-you" className="hover:text-white transition-colors">কীভাবে অর্ডার করবেন?</a></li>
                        <li><a href="#just-for-you" className="hover:text-white transition-colors">রিটার্ন ও রিফান্ড পলিসি</a></li>
                        <li><a href="#just-for-you" className="hover:text-white transition-colors">কুরিয়ার ট্র্যাকিং হেল্প</a></li>
                        <li><a href="#just-for-you" className="hover:text-white transition-colors">প্রতারণা অভিযোগ ও প্রতিকার</a></li>
                    </ul>
                </div>

                <div>
                    <h4 className="text-xs font-black uppercase tracking-wider text-white mb-3">সেলার কর্নার</h4>
                    <ul className="space-y-2">
                        <li><a href="http://auth.zengfy.test:8000/register?intent=merchant" className="text-orange-400 hover:text-orange-300 font-bold transition-colors">মার্চেন্ট অ্যাকাউন্ট খুলুন</a></li>
                        <li><a href="#daraz-comparison" className="hover:text-white transition-colors">দারাজ বনাম জেনগফাই কমিশন</a></li>
                        <li><a href="#just-for-you" className="hover:text-white transition-colors">অ্যান্টি-ফ্রড কুরিয়ার গার্ড</a></li>
                        <li><a href="#just-for-you" className="hover:text-white transition-colors">সেলার সাপোর্ট কমিউনিটি</a></li>
                    </ul>
                </div>

                <div>
                    <h4 className="text-xs font-black uppercase tracking-wider text-white mb-3">পেমেন্ট ও কুরিয়ার পার্টনার</h4>
                    <div className="flex flex-wrap gap-2 text-[10px] font-bold text-slate-300 mb-4">
                        <span className="px-2 py-1 bg-slate-800 rounded border border-slate-700">bKash</span>
                        <span className="px-2 py-1 bg-slate-800 rounded border border-slate-700">Nagad</span>
                        <span className="px-2 py-1 bg-slate-800 rounded border border-slate-700">Rocket</span>
                        <span className="px-2 py-1 bg-slate-800 rounded border border-slate-700">Visa / Master</span>
                        <span className="px-2 py-1 bg-slate-800 rounded border border-slate-700">Cash on Delivery</span>
                    </div>
                    <div className="text-[11px] text-slate-500">
                        লজিস্টিকস: Steadfast Courier, Pathao Courier, RedX Logistics.
                    </div>
                </div>
            </div>

            {/* Bottom Copyright */}
            <div className="border-t border-slate-800 py-4 px-4 text-center text-[11px] text-slate-500">
                © 2026 Zengfy Marketplace. All Sovereign Rights Reserved. Crafted with React 19 & Tailwind CSS.
            </div>
        </footer>
    );
}
