import React, { useState, useEffect } from 'react';
import { 
    ChevronLeft, ChevronRight, Zap, ShieldCheck, 
    Percent, Truck, Sparkles, ArrowRight, Store, 
    Smartphone, Shirt, ShoppingBag, Home, Apple, Smile, BookOpen, Layers
} from 'lucide-react';

export default function PromoBanners({ 
    banners = [], 
    stats = [], 
    categories = [],
    onSelectCategory 
}) {
    const [currentIdx, setCurrentIdx] = useState(0);

    useEffect(() => {
        if (!banners.length) return;
        const timer = setInterval(() => {
            setCurrentIdx((prev) => (prev + 1) % banners.length);
        }, 5500);
        return () => clearInterval(timer);
    }, [banners.length]);

    if (!banners.length) return null;

    const currentBanner = banners[currentIdx];

    const getCatIcon = (iconName) => {
        switch (iconName) {
            case 'Smartphone': return <Smartphone className="w-3.5 h-3.5" />;
            case 'Shirt': return <Shirt className="w-3.5 h-3.5" />;
            case 'ShoppingBag': return <ShoppingBag className="w-3.5 h-3.5" />;
            case 'Home': return <Home className="w-3.5 h-3.5" />;
            case 'Apple': return <Apple className="w-3.5 h-3.5" />;
            case 'Sparkles': return <Sparkles className="w-3.5 h-3.5" />;
            case 'Smile': return <Smile className="w-3.5 h-3.5" />;
            case 'BookOpen': return <BookOpen className="w-3.5 h-3.5" />;
            default: return <Layers className="w-3.5 h-3.5" />;
        }
    };

    return (
        <section className="max-w-7xl mx-auto px-4 sm:px-6 pt-4 pb-3">
            <div className="grid grid-cols-1 lg:grid-cols-12 gap-4 items-stretch">
                
                {/* 1. Left Categories Sidebar (Classic Daraz Desktop Layout - 3 cols) */}
                <div className="hidden lg:block lg:col-span-3 bg-white rounded-3xl p-3 border border-slate-200/90 shadow-xs flex flex-col justify-between">
                    <div>
                        <div className="px-3 py-2 text-xs font-black uppercase tracking-wider text-slate-400 border-b border-slate-100 flex items-center justify-between">
                            <span>ক্যাটাগরি মেনু</span>
                            <span className="text-[10px] text-orange-600 font-bold bg-orange-50 px-1.5 py-0.5 rounded">সব লাইভ</span>
                        </div>
                        <div className="divide-y divide-slate-50 mt-1">
                            {categories.slice(0, 8).map((cat) => (
                                <button
                                    key={cat.id}
                                    type="button"
                                    onClick={() => onSelectCategory && onSelectCategory(cat.name)}
                                    className="w-full flex items-center justify-between px-3 py-2 text-xs font-semibold text-slate-700 hover:text-[#F85606] hover:bg-orange-50/70 rounded-xl transition-colors group cursor-pointer text-left"
                                >
                                    <div className="flex items-center gap-2.5">
                                        <span className="text-slate-400 group-hover:text-[#F85606] transition-colors">
                                            {getCatIcon(cat.icon)}
                                        </span>
                                        <span>{cat.name}</span>
                                    </div>
                                    <span className="text-[10px] text-slate-400 group-hover:text-orange-600 font-mono">
                                        {cat.count.split('+')[0]}+
                                    </span>
                                </button>
                            ))}
                        </div>
                    </div>

                    <div className="mt-2 pt-2 border-t border-slate-100 px-3">
                        <a 
                            href="#daraz-comparison"
                            className="text-[11px] font-bold text-purple-700 hover:text-purple-900 flex items-center gap-1.5"
                        >
                            <Store className="w-3.5 h-3.5 text-purple-600" />
                            <span>মার্চেন্ট সেলার অ্যাকাউন্ট খুলুন →</span>
                        </a>
                    </div>
                </div>

                {/* 2. Main Hero Deals Slider (Daraz Mega Promo - 6 cols on lg) */}
                <div className="lg:col-span-6 relative rounded-3xl overflow-hidden bg-slate-900 shadow-xl min-h-[300px] sm:min-h-[380px] flex flex-col justify-between p-6 sm:p-8 border border-slate-800">
                    {/* Background Dynamic Gradient */}
                    <div className={`absolute inset-0 bg-gradient-to-tr ${currentBanner.bg_gradient} opacity-95 transition-all duration-700`} />
                    <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-white/15 via-transparent to-transparent pointer-events-none" />

                    {/* Top Badge & Slider Controls */}
                    <div className="relative z-10 flex items-center justify-between">
                        <span className="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-black bg-white/20 text-white backdrop-blur-md border border-white/25 shadow-xs">
                            <Sparkles className="w-3.5 h-3.5 text-amber-300" />
                            {currentBanner.badge}
                        </span>

                        <div className="flex items-center gap-1 bg-black/40 backdrop-blur-md rounded-full p-1 border border-white/10">
                            <button
                                onClick={() => setCurrentIdx((prev) => (prev - 1 + banners.length) % banners.length)}
                                className="w-7 h-7 rounded-full flex items-center justify-center text-white/80 hover:text-white hover:bg-white/20 transition-all cursor-pointer"
                                aria-label="Previous Banner"
                            >
                                <ChevronLeft className="w-4 h-4" />
                            </button>
                            <span className="text-[11px] font-bold text-white/90 px-1 font-mono">
                                {currentIdx + 1}/{banners.length}
                            </span>
                            <button
                                onClick={() => setCurrentIdx((prev) => (prev + 1) % banners.length)}
                                className="w-7 h-7 rounded-full flex items-center justify-center text-white/80 hover:text-white hover:bg-white/20 transition-all cursor-pointer"
                                aria-label="Next Banner"
                            >
                                <ChevronRight className="w-4 h-4" />
                            </button>
                        </div>
                    </div>

                    {/* Banner Main Content */}
                    <div className="relative z-10 max-w-lg py-4">
                        <h1 className="text-2xl sm:text-3xl lg:text-4xl font-black text-white tracking-tight leading-tight mb-2.5">
                            {currentBanner.title}
                        </h1>
                        <p className="text-slate-100 text-xs sm:text-sm font-medium leading-relaxed mb-5">
                            {currentBanner.subtitle}
                        </p>
                        <div className="flex flex-wrap items-center gap-3">
                            <a
                                href="#flash-deals"
                                className="px-5 py-2.5 rounded-xl bg-white text-slate-900 hover:bg-slate-100 font-black text-xs sm:text-sm shadow-xl flex items-center gap-1.5 group transition-all"
                            >
                                <span>{currentBanner.cta}</span>
                                <ArrowRight className="w-4 h-4 group-hover:translate-x-1 transition-transform" />
                            </a>
                            <a
                                href="#daraz-comparison"
                                className="px-4 py-2.5 rounded-xl bg-white/20 hover:bg-white/30 text-white font-bold text-xs sm:text-sm backdrop-blur-md border border-white/25 transition-all"
                            >
                                সেলার অনবোর্ডিং
                            </a>
                        </div>
                    </div>

                    {/* Bottom Progress Indicator Dots */}
                    <div className="relative z-10 flex items-center gap-2">
                        {banners.map((_, idx) => (
                            <button
                                key={idx}
                                onClick={() => setCurrentIdx(idx)}
                                className={`h-1.5 rounded-full transition-all cursor-pointer ${idx === currentIdx ? 'w-8 bg-white' : 'w-2 bg-white/40'}`}
                                aria-label={`Go to slide ${idx + 1}`}
                            />
                        ))}
                    </div>
                </div>

                {/* 3. Right Quick Seller & Voucher Box (Daraz Member/Seller Widget - 3 cols on lg) */}
                <div className="lg:col-span-3 flex flex-col justify-between gap-3">
                    {/* Card 1: Daraz Alternative Anti-Fraud Hook */}
                    <div className="p-4 sm:p-5 rounded-3xl bg-gradient-to-br from-orange-50 via-white to-amber-50 border border-orange-200/90 shadow-xs flex flex-col justify-between flex-1">
                        <div>
                            <div className="flex items-center justify-between mb-2.5">
                                <span className="inline-flex items-center gap-1 text-[10px] font-black uppercase tracking-wider text-orange-700 bg-orange-100 px-2 py-0.5 rounded-md">
                                    <Zap className="w-3 h-3 text-orange-600 fill-orange-600" /> দারাজ বনাম জেনগফাই
                                </span>
                                <span className="text-[11px] font-black text-emerald-600">৩.৫% কমিশন</span>
                            </div>
                            <h3 className="text-sm font-black text-slate-900 leading-snug mb-1">
                                দারাজের চেয়ে ৫০% কম খরচে ব্যবসা পরিচালনা
                            </h3>
                            <p className="text-xs text-slate-600 leading-relaxed">
                                ভুয়া বায়ার ফিল্টারিং এবং জিরো রিটার্ন লস। ২৪ ঘণ্টায় সরাসরি বিকাশ/ব্যাংক পে-আউট।
                            </p>
                        </div>
                        <a 
                            href="#daraz-comparison"
                            className="mt-3 text-xs font-bold text-orange-600 hover:text-orange-700 flex items-center gap-1 pt-2 border-t border-orange-200/50"
                        >
                            <Store className="w-3.5 h-3.5" /> ফ্রি মার্চেন্ট স্টোর খুলুন →
                        </a>
                    </div>

                    {/* Card 2: 100 Taka Voucher Box */}
                    <div className="p-4 sm:p-5 rounded-3xl bg-gradient-to-br from-purple-50 via-white to-indigo-50 border border-purple-200/90 shadow-xs flex flex-col justify-between flex-1">
                        <div>
                            <div className="flex items-center justify-between mb-2.5">
                                <span className="inline-flex items-center gap-1 text-[10px] font-black uppercase tracking-wider text-purple-700 bg-purple-100 px-2 py-0.5 rounded-md">
                                    <Sparkles className="w-3 h-3 text-purple-600" /> নতুন গ্রাহক ভাউচার
                                </span>
                                <span className="text-[11px] font-black text-purple-700">৳১০০ ছাড়</span>
                            </div>
                            <h3 className="text-sm font-black text-slate-900 leading-snug mb-1">
                                প্রথম অর্ডারে ইনস্ট্যান্ট ডিসকাউন্ট
                            </h3>
                            <p className="text-xs text-slate-600 leading-relaxed font-mono">
                                চেকআউটে কোড ব্যবহার করুন: <span className="font-bold text-purple-700 bg-purple-100 px-1 py-0.5 rounded">ZENGFY100</span>
                            </p>
                        </div>
                        <a 
                            href="#flash-deals"
                            className="mt-3 text-xs font-bold text-purple-700 hover:text-purple-800 flex items-center gap-1 pt-2 border-t border-purple-200/50"
                        >
                            <Zap className="w-3.5 h-3.5" /> এখনই ডিলস উপভোগ করুন →
                        </a>
                    </div>
                </div>

            </div>

            {/* Platform Trust Telemetry Strip */}
            <div className="mt-4 grid grid-cols-2 md:grid-cols-4 gap-3 bg-white p-3 rounded-2xl border border-slate-200 shadow-xs">
                {stats.map((st, i) => (
                    <div key={i} className="flex items-center gap-3 px-3 py-1 border-r last:border-r-0 border-slate-100">
                        <div className="w-8 h-8 rounded-xl bg-orange-50 text-[#F85606] flex items-center justify-center font-bold text-xs shrink-0">
                            {i === 0 && <Store className="w-4 h-4" />}
                            {i === 1 && <Percent className="w-4 h-4" />}
                            {i === 2 && <ShieldCheck className="w-4 h-4 text-emerald-600" />}
                            {i === 3 && <Zap className="w-4 h-4 text-amber-500 fill-amber-500" />}
                        </div>
                        <div>
                            <div className="text-sm font-black text-slate-900 leading-tight">{st.value}</div>
                            <div className="text-[10px] font-semibold text-slate-500">{st.label}</div>
                        </div>
                    </div>
                ))}
            </div>
        </section>
    );
}
