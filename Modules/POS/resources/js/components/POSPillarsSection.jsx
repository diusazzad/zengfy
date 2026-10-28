import React from 'react';
import { Barcode, Layers, CreditCard, Globe, ShieldCheck, ArrowRight } from 'lucide-react';

export default function POSPillarsSection({ pillars = [] }) {
    const iconMap = {
        barcode: Barcode,
        layers: Layers,
        'credit-card': CreditCard,
        globe: Globe,
    };

    return (
        <section className="py-16 md:py-24 relative overflow-hidden bg-slate-50/70 border-t border-slate-200/80">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div className="text-center max-w-3xl mx-auto mb-14">
                    <div className="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-100/80 border border-amber-200 text-amber-900 text-xs font-bold uppercase tracking-wider mb-3">
                        <ShieldCheck className="w-4 h-4 text-amber-700" />
                        <span>Core Architectural Pillars</span>
                    </div>
                    <h2 className="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                        যে ৪টি ক্ষমতায় Zengfy POS অন্য যেকোনো সফটওয়্যার থেকে আলাদা ⚡
                    </h2>
                    <p className="mt-3 text-slate-600 text-base">
                        দোকানের প্রতিদিনের হিসাব নির্ভুল ও দ্রুততম রাখতে আন্তর্জাতিক মানের আর্কিটেকচার।
                    </p>
                </div>

                <div className="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
                    {pillars.map((pillar) => {
                        const Icon = iconMap[pillar.icon] || Barcode;
                        return (
                            <div
                                key={pillar.id}
                                className="p-8 rounded-3xl bg-white border border-slate-200/90 hover:border-amber-400 shadow-sm hover:shadow-xl transition-all duration-300 text-left group flex flex-col justify-between"
                            >
                                <div>
                                    <div className="flex items-center justify-between gap-3 mb-6">
                                        <div className="w-14 h-14 rounded-2xl bg-amber-50 border border-amber-200/70 flex items-center justify-center text-amber-700 group-hover:scale-110 group-hover:bg-amber-600 group-hover:text-white transition-all shadow-xs">
                                            <Icon className="w-7 h-7" />
                                        </div>
                                        <span className="text-xs font-extrabold px-3 py-1 rounded-full bg-slate-100 text-slate-700 uppercase tracking-wider">
                                            {pillar.badge}
                                        </span>
                                    </div>

                                    <h3 className="text-xl font-extrabold text-slate-900 group-hover:text-amber-700 transition-colors">
                                        {pillar.title_bn || pillar.title}
                                    </h3>
                                    <div className="text-xs font-mono text-slate-400 mt-0.5">
                                        {pillar.title}
                                    </div>

                                    <p className="mt-4 text-sm text-slate-600 leading-relaxed">
                                        {pillar.desc}
                                    </p>
                                </div>

                                <div className="mt-6 pt-4 border-t border-slate-100 flex items-center text-xs font-extrabold text-amber-700 group-hover:translate-x-1 transition-transform">
                                    <span>ফিচারের বিস্তারিত দেখুন</span>
                                    <ArrowRight className="w-4 h-4 ml-1.5" />
                                </div>
                            </div>
                        );
                    })}
                </div>

            </div>
        </section>
    );
}