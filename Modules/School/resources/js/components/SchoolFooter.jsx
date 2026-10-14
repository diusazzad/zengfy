import React from 'react';
import { ArrowUpRight, ShieldCheck, Heart } from 'lucide-react';

export default function SchoolFooter({ links = {} }) {
    const ecosystemApps = [
        { name: 'Zengfy School', url: links.school || 'http://school.zengfy.top:8000/', desc: 'Academic ERP' },
        { name: 'Zengfy Social', url: 'http://social.zengfy.top:8000/', desc: 'Civic Mesh' },
        { name: 'Zengfy POS', url: 'http://pos.zengfy.top:8000/', desc: 'Retail & Stock' },
        { name: 'Zengfy Law', url: 'http://law.zengfy.top:8000/', desc: 'Legal Vault' },
        { name: 'Zengfy Rent', url: 'http://rent.zengfy.top:8000/', desc: 'Property Hub' },
        { name: 'Zengfy Hotel', url: 'http://hotel.zengfy.top:8000/', desc: 'Hospitality ERP' },
        { name: 'Zengfy Commerce', url: 'http://shop.zengfy.top:8000/', desc: 'Online Store' },
        { name: 'Zengfy NGO', url: 'http://ngo.zengfy.top:8000/', desc: 'Charity Cloud' },
    ];

    return (
        <footer role="contentinfo" className="mt-20 border-t border-slate-200/80 bg-white/70 backdrop-blur-xl relative z-10">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">

                <div className="grid grid-cols-1 md:grid-cols-12 gap-8 sm:gap-12">

                    {/* Brand Meta (5 cols) */}
                    <div className="md:col-span-5">
                        <div className="flex items-center gap-3">
                            <div className="w-10 h-10 rounded-2xl bg-gradient-to-tr from-emerald-600 via-teal-600 to-indigo-600 flex items-center justify-center font-black text-xl text-white shadow-md shadow-emerald-500/20">
                                🏫
                            </div>
                            <span className="text-2xl font-black tracking-tight text-slate-900">
                                Zengfy<span className="text-emerald-600">.</span>School
                            </span>
                        </div>
                        <p className="mt-4 text-xs sm:text-sm text-slate-600 font-medium max-w-sm leading-relaxed">
                            বাংলাদেশের সার্বভৌম স্কুল, কলেজ ও মাদরাসা পরিচালনা প্ল্যাটফর্ম। আরএফআইডি গেট হাজিরা, স্বয়ংক্রিয় রেজাল্ট শিট এবং কাগজের ফাইলমুক্ত ডিজিটাল একাডেমি।
                        </p>
                        <div className="mt-4 flex items-center gap-2 text-xs font-semibold text-emerald-800 bg-emerald-50 border border-emerald-200/80 px-3 py-1.5 rounded-xl w-fit">
                            <ShieldCheck className="w-4 h-4 text-emerald-600" />
                            <span>সার্বভৌম এনক্রিপ্টেড ডাটাবেজ আর্কিটেকচার</span>
                        </div>
                    </div>

                    {/* Ecosystem Apps (4 cols) */}
                    <div className="md:col-span-4">
                        <div className="text-xs font-bold uppercase tracking-wider text-slate-900 mb-3">
                            Zengfy সার্বভৌম ইকোসিস্টেম
                        </div>
                        <div className="grid grid-cols-2 gap-2 text-xs">
                            {ecosystemApps.map((app) => (
                                <a
                                    key={app.name}
                                    href={app.url}
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    className="p-2 rounded-xl bg-slate-50 hover:bg-emerald-50 text-slate-700 hover:text-emerald-800 font-medium transition-colors border border-slate-100 hover:border-emerald-200"
                                >
                                    <div className="font-bold truncate">{app.name}</div>
                                    <div className="text-[10px] text-slate-400 truncate">{app.desc}</div>
                                </a>
                            ))}
                        </div>
                    </div>

                    {/* Developer & API (3 cols) */}
                    <div className="md:col-span-3">
                        <div className="text-xs font-bold uppercase tracking-wider text-slate-900 mb-3">
                            ডেভেলপার ও ইন্টিগ্রেশন
                        </div>
                        <ul className="space-y-2 text-xs font-semibold text-slate-600">
                            <li>
                                <a
                                    href={links.api_docs || '/api/v1/school/landing'}
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    className="hover:text-emerald-700 transition-colors inline-flex items-center gap-1"
                                >
                                    <span>School REST API</span>
                                    <ArrowUpRight className="w-3.5 h-3.5" />
                                </a>
                            </li>
                            <li>
                                <a
                                    href="http://zengfy.top:8000/download"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    className="hover:text-emerald-700 transition-colors inline-flex items-center gap-1"
                                >
                                    <span>Flutter মোবাইল অ্যাপ</span>
                                    <ArrowUpRight className="w-3.5 h-3.5" />
                                </a>
                            </li>
                            <li>
                                <a
                                    href={links.login || 'http://zengfy.top:8000/login'}
                                    className="hover:text-emerald-700 transition-colors inline-flex items-center gap-1"
                                >
                                    <span>ইউনিভার্সাল SSO লগইন</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>

                {/* Bottom Legal / Copyright */}
                <div className="mt-12 pt-6 border-t border-slate-200/70 flex flex-col sm:flex-row items-center justify-between gap-4 text-center sm:text-left text-xs text-slate-500 font-medium">
                    <div>
                        © ২০২৬ Zengfy School (A Sovereign Ecosystem Division). সর্বস্বত্ব সংরক্ষিত।
                    </div>
                    <div className="flex items-center gap-1 text-slate-500">
                        <span>তৈরি করা হয়েছে ভালোবাসা ও সার্বভৌম প্রত্যয় নিয়ে</span>
                        <Heart className="w-3 h-3 text-rose-500 fill-rose-500 inline" />
                        <span>বাংলাদেশে</span>
                    </div>
                </div>

            </div>
        </footer>
    );
}
