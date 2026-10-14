import React from 'react';
import { ShieldCheck, Heart } from 'lucide-react';

export default function POSFooter({ links = {} }) {
    return (
        <footer role="contentinfo" className="bg-slate-900 text-white pt-16 pb-12 border-t border-slate-800">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <div className="grid grid-cols-1 md:grid-cols-4 gap-10 pb-12 border-b border-slate-800 text-left">

                    {/* Brand Col */}
                    <div className="md:col-span-2 space-y-4">
                        <div className="flex items-center gap-3">
                            <div className="w-10 h-10 rounded-2xl bg-gradient-to-tr from-amber-600 via-orange-600 to-rose-600 flex items-center justify-center font-black text-xl text-white shadow-md shadow-orange-500/20">
                                🛒
                            </div>
                            <span className="text-2xl font-black tracking-tight">
                                Zengfy<span className="text-amber-500">.</span>POS
                            </span>
                        </div>
                        <p className="text-xs sm:text-sm text-slate-400 max-w-md leading-relaxed">
                            বাংলাদেশের শোরুম, ফ্যাশন বুটিক ও শপিং মল আউটলেটের জন্য তৈরি সর্বাধুনিক সোভারেন রিটেইল ইআরপি ও বারকোড পিওএস। ১.৮ সেকেন্ডে ভুলমুক্ত মেমো ও ১০০% কাগজমুক্ত ডিজিটাল বাকি খাতা।
                        </p>
                        <div className="flex items-center gap-2 text-xs font-semibold text-emerald-400">
                            <ShieldCheck className="w-4 h-4" />
                            <span>256-Bit Sovereign Data Vault • এনআইডি ভেরিফাইড নাগরিক অ্যাকাউন্ট</span>
                        </div>
                    </div>

                    {/* Ecosystem Modules Col */}
                    <div className="space-y-3">
                        <h4 className="text-xs font-black uppercase tracking-wider text-slate-300">
                            Zengfy Sovereign Mesh
                        </h4>
                        <ul className="space-y-2 text-xs text-slate-400">
                            <li>
                                <a href={links.social || "http://social.zengfy.top:8000/"} className="hover:text-amber-400 transition">
                                    Zengfy Social (নাগরিক নেটওয়ার্ক)
                                </a>
                            </li>
                            <li>
                                <a href={links.school || "http://school.zengfy.top:8000/"} className="hover:text-amber-400 transition">
                                    Zengfy School (ক্যাম্পাস ইআরপি)
                                </a>
                            </li>
                            <li>
                                <a href="http://pos.zengfy.top:8000/" className="hover:text-amber-400 transition font-bold text-amber-400">
                                    Zengfy POS (ফ্যাশন রিটেইল ইআরপি)
                                </a>
                            </li>
                            <li>
                                <a href="http://shop.zengfy.top:8000/" className="hover:text-amber-400 transition">
                                    Zengfy Commerce (অনলাইন শপ)
                                </a>
                            </li>
                            <li>
                                <a href="http://law.zengfy.top:8000/" className="hover:text-amber-400 transition">
                                    Zengfy Law (আইনি ভল্ট)
                                </a>
                            </li>
                        </ul>
                    </div>

                    {/* Links & Legal Col */}
                    <div className="space-y-3">
                        <h4 className="text-xs font-black uppercase tracking-wider text-slate-300">
                            কানেক্ট ও সাপোর্ট
                        </h4>
                        <ul className="space-y-2 text-xs text-slate-400">
                            <li>
                                <a href={links.login || "/login"} className="hover:text-amber-400 transition">
                                    মার্চেন্ট সিঙ্গেল সাইন-অন
                                </a>
                            </li>
                            <li>
                                <a href={links.download || "#"} className="hover:text-amber-400 transition">
                                    Android APK ডাউনলোড
                                </a>
                            </li>
                            <li>
                                <a href={links.api_docs || "/api/v1/pos/landing"} target="_blank" rel="noopener noreferrer" className="hover:text-amber-400 transition">
                                    REST API ডকুমেন্টেশন
                                </a>
                            </li>
                            <li>
                                <a href={links.master_landing || "http://zengfy.top:8000/"} className="hover:text-amber-400 transition">
                                    মাস্টার ইকোসিস্টেম হাব
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>

                {/* Bottom Bar with Language Switcher */}
                <div className="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
                    <div>
                        © 2026 Zengfy Ecosystem. All Sovereign Rights Reserved.
                    </div>

                    {/* Language Switcher */}
                    <div className="flex items-center gap-2 p-1 rounded-xl bg-slate-800 border border-slate-700">
                        <a
                            href="/lang/bn"
                            className="px-2.5 py-1 rounded-lg text-xs font-bold text-white bg-amber-600 shadow-xs"
                        >
                            🇧🇩 বাংলা
                        </a>
                        <a
                            href="/lang/en"
                            className="px-2.5 py-1 rounded-lg text-xs font-bold text-slate-400 hover:text-white transition"
                        >
                            🇬🇧 English
                        </a>
                    </div>
                </div>

            </div>
        </footer>
    );
}
