import React from 'react';
import { Calendar, FileText, Scale, ShieldCheck, ArrowRight } from 'lucide-react';

export default function LawPillarsSection({ pillars = [] }) {
    const iconMap = {
        calendar: Calendar,
        'file-text': FileText,
        scale: Scale,
        'shield-check': ShieldCheck,
    };

    return (
        <section className="py-16 md:py-24 relative overflow-hidden bg-stone-50/70 border-t border-stone-200">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div className="text-center max-w-3xl mx-auto mb-14">
                    <div className="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-rose-100/80 border border-rose-200 text-[#881337] text-xs font-bold uppercase tracking-wider mb-3">
                        <Scale className="w-4 h-4 text-[#881337]" />
                        <span>Legal Tech Foundations</span>
                    </div>
                    <h2 className="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                        যে ৪টি আইনি স্তম্ভে পরিচালিত Zengfy Law ⚖️
                    </h2>
                    <p className="mt-3 text-slate-600 text-base">
                        আদালতের জটিল নথিপত্র ও কজলিস্টের ডেট নিখুঁত রাখতে আধুনিক সার্বভৌম টেকনোলজি।
                    </p>
                </div>

                <div className="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
                    {pillars.map((pillar) => {
                        const Icon = iconMap[pillar.icon] || Scale;
                        return (
                            <div
                                key={pillar.id}
                                className="p-8 rounded-3xl bg-white border border-stone-200/90 hover:border-[#881337] shadow-sm hover:shadow-xl transition-all duration-300 text-left group flex flex-col justify-between"
                            >
                                <div>
                                    <div className="flex items-center justify-between gap-3 mb-6">
                                        <div className="w-14 h-14 rounded-2xl bg-rose-50 border border-rose-200/80 flex items-center justify-center text-[#881337] group-hover:scale-110 group-hover:bg-[#881337] group-hover:text-white transition-all shadow-xs">
                                            <Icon className="w-7 h-7" />
                                        </div>
                                        <span className="text-xs font-extrabold px-3 py-1 rounded-full bg-stone-100 text-stone-700 uppercase tracking-wider">
                                            {pillar.badge}
                                        </span>
                                    </div>

                                    <h3 className="text-xl font-extrabold text-slate-900 group-hover:text-[#881337] transition-colors">
                                        {pillar.title_bn || pillar.title}
                                    </h3>
                                    <div className="text-xs font-mono text-stone-400 mt-0.5">
                                        {pillar.title}
                                    </div>

                                    <p className="mt-4 text-sm text-stone-600 leading-relaxed">
                                        {pillar.desc}
                                    </p>
                                </div>

                                <div className="mt-6 pt-4 border-t border-stone-100 flex items-center text-xs font-extrabold text-[#881337] group-hover:translate-x-1 transition-transform">
                                    <span>স্তম্ভের কার্যপদ্ধতি দেখুন</span>
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