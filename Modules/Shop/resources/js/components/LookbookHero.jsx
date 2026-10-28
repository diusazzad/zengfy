import React from 'react';
import { Sparkles, ArrowRight, ShieldCheck, Ruler, Layers } from 'lucide-react';

export default function LookbookHero({ heroData, onOpenSizeGuide }) {
    if (!heroData) return null;

    return (
        <section className="relative bg-slate-950 text-white overflow-hidden">
            {/* Top Minimalist Grid Accent */}
            <div className="absolute inset-0 bg-[radial-gradient(#334155_1px,transparent_1px)] [background-size:24px_24px] opacity-25 pointer-events-none" />

            <div className="max-w-7xl mx-auto px-4 sm:px-6 py-12 sm:py-20 relative z-10">
                <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                    {/* Left Column: Brand Statement & Typography */}
                    <div className="lg:col-span-7 flex flex-col justify-center">
                        <div className="flex flex-wrap items-center gap-2 mb-4">
                            <span className="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-[0.2em] bg-white/10 text-slate-300 border border-white/15">
                                {heroData.drop_tag}
                            </span>
                            <span className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                                {heroData.season}
                            </span>
                        </div>

                        <h1 className="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.08] uppercase font-mono mb-4">
                            {heroData.headline}
                        </h1>

                        <p className="text-sm sm:text-base text-slate-300 font-medium leading-relaxed max-w-xl mb-8">
                            {heroData.subtitle}
                        </p>

                        <div className="flex flex-wrap items-center gap-4">
                            <a
                                href="#collection-grid"
                                className="px-7 py-3.5 rounded-xl bg-white text-slate-950 hover:bg-slate-200 font-black text-xs tracking-wider uppercase transition-all shadow-xl shadow-white/10 flex items-center gap-2 group"
                            >
                                <span>কালেকশন দেখুন</span>
                                <ArrowRight className="w-4 h-4 group-hover:translate-x-1 transition-transform" />
                            </a>

                            <button
                                onClick={onOpenSizeGuide}
                                className="px-6 py-3.5 rounded-xl bg-white/10 hover:bg-white/15 text-white font-bold text-xs tracking-wider uppercase border border-white/20 transition-all flex items-center gap-2"
                            >
                                <Ruler className="w-4 h-4 text-slate-300" />
                                <span>সাইজ গাইড</span>
                            </button>
                        </div>

                        {/* Craftsmanship Highlights Bar */}
                        <div className="mt-10 pt-6 border-t border-white/10 grid grid-cols-2 sm:grid-cols-3 gap-4 text-xs">
                            <div>
                                <div className="text-base font-black text-white font-mono">৩৮০ GSM</div>
                                <div className="text-[11px] text-slate-400 font-semibold">ফ্রেঞ্চ টেরি হুডি</div>
                            </div>
                            <div>
                                <div className="text-base font-black text-white font-mono">২৪০ GSM</div>
                                <div className="text-[11px] text-slate-400 font-semibold">কম্বড কটন টি-শার্ট</div>
                            </div>
                            <div className="col-span-2 sm:col-span-1">
                                <div className="text-base font-black text-emerald-400 font-mono">জিরো শ্রিংক</div>
                                <div className="text-[11px] text-slate-400 font-semibold">প্রিশ্রাঙ্ক গ্যারান্টি</div>
                            </div>
                        </div>
                    </div>

                    {/* Right Column: Editorial Lifestyle Showcase Images */}
                    <div className="lg:col-span-5 relative">
                        <div className="relative rounded-3xl overflow-hidden border border-white/15 shadow-2xl bg-slate-900 aspect-3/4">
                            <img 
                                src={heroData.hero_image} 
                                alt="Zengfy Atelier Editorial Drop"
                                className="w-full h-full object-cover grayscale-20 hover:grayscale-0 transition-all duration-700"
                            />
                            <div className="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent pointer-events-none" />

                            <div className="absolute bottom-4 left-4 right-4 p-4 rounded-2xl bg-black/60 backdrop-blur-md border border-white/15 flex items-center justify-between">
                                <div>
                                    <div className="text-xs font-black tracking-wider text-white uppercase">DROP 01 LOOKBOOK</div>
                                    <div className="text-[10px] text-slate-300">Available exclusively at Zengfy Atelier</div>
                                </div>
                                <span className="text-xs font-bold px-2.5 py-1 bg-white text-slate-900 rounded-lg">
                                    Limited 500 pcs
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {/* Scrolling Specs Ticker */}
            <div className="bg-slate-900 border-y border-white/10 py-3 overflow-hidden">
                <div className="flex items-center gap-8 whitespace-nowrap animate-marquee text-[11px] font-black uppercase tracking-[0.2em] text-slate-400">
                    {heroData.specs_ticker?.map((spec, idx) => (
                        <div key={idx} className="flex items-center gap-3">
                            <span className="w-1.5 h-1.5 rounded-full bg-white/40" />
                            <span>{spec}</span>
                        </div>
                    ))}
                    {heroData.specs_ticker?.map((spec, idx) => (
                        <div key={`dup-${idx}`} className="flex items-center gap-3">
                            <span className="w-1.5 h-1.5 rounded-full bg-white/40" />
                            <span>{spec}</span>
                        </div>
                    ))}
                </div>
            </div>
        </section>
    );
}
