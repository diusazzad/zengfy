import React, { useState } from 'react';
import { ShoppingBag, Grid, User, X, Phone, ShieldCheck, Sparkles } from 'lucide-react';

export default function AtelierNavbar({
    brandData,
    bagCount,
    onOpenBag,
    selectedCollection,
    onSelectCollection,
    collections = []
}) {
    const [waffleOpen, setWaffleOpen] = useState(false);

    const ecosystemApps = [
        { name: "Core", desc: "Master Portal", url: "http://zengfy.top:8000/", icon: "🏛️" },
        { name: "Market", desc: "Marketplace", url: "http://ecommerce.zengfy.top:8000/", icon: "🛍️" },
        { name: "Social", desc: "Civic Network", url: "http://social.zengfy.top:8000/", icon: "🌍" },
        { name: "POS", desc: "Retail & Thermal", url: "http://pos.zengfy.top:8000/", icon: "⚡" },
        { name: "School", desc: "Campus & RFID", url: "http://school.zengfy.top:8000/", icon: "🎓" },
        { name: "Law", desc: "Digital Chamber", url: "http://law.zengfy.top:8000/", icon: "⚖️" },
        { name: "Hotel", desc: "Resort & Kitchen", url: "http://hotel.zengfy.top:8000/", icon: "🏨" },
        { name: "Habit", desc: "5 Daily Salah", url: "http://habit.zengfy.top:8000/", icon: "🕌" },
        { name: "Journal", desc: "Op-Ed & Paywall", url: "http://journal.zengfy.top:8000/", icon: "📰" }
    ];

    return (
        <header className="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-200/80 shadow-xs">
            {/* Top Announcement Bar */}
            <div className="bg-slate-950 text-white text-[11px] font-semibold py-2 px-4 tracking-wide">
                <div className="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-2">
                    <div className="flex items-center gap-2">
                        <span className="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse" />
                        <span>{brandData?.announcement || "সারা বাংলাদেশে ফ্রি এক্সপ্রেস ডেলিভারি • ২৪০ GSM কম্বড কটন ও ৩৮০ GSM ফ্রেঞ্চ টেরি"}</span>
                    </div>
                    <div className="flex items-center gap-4 text-slate-400">
                        <span className="hidden sm:inline">স্টুডিও: বনানী, ঢাকা</span>
                        <span className="hidden sm:inline">|</span>
                        <span>হটলাইন: {brandData?.helpline || "০৯৬৭৮-১১২২৩৩"}</span>
                    </div>
                </div>
            </div>

            {/* Main Luxury Brand Header */}
            <div className="max-w-7xl mx-auto px-4 sm:px-6 py-4 flex items-center justify-between gap-4">
                {/* Brand Typographic Identity */}
                <div className="flex items-center gap-3">
                    <a href="http://shop.zengfy.top:8000/" className="group flex flex-col">
                        <span className="text-xl sm:text-2xl font-black tracking-widest text-slate-900 group-hover:text-slate-700 transition-colors uppercase font-mono">
                            ZENGFY ATELIER
                        </span>
                        <span className="text-[9px] font-black tracking-[0.25em] text-slate-400 uppercase">
                            {brandData?.sub_label || "SOVEREIGN APPAREL • DHAKA"}
                        </span>
                    </a>

                    {/* Waffle Menu */}
                    <div className="relative ml-2">
                        <button
                            onClick={() => setWaffleOpen(!waffleOpen)}
                            className="p-2 text-slate-500 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-colors cursor-pointer"
                            title="Zengfy Ecosystem Apps"
                        >
                            <Grid className="w-4 h-4" />
                        </button>

                        {waffleOpen && (
                            <div className="absolute left-0 mt-2 w-80 bg-white rounded-2xl shadow-2xl border border-slate-200 p-4 z-50 animate-in fade-in zoom-in-95">
                                <div className="flex items-center justify-between pb-3 border-b border-slate-100">
                                    <div className="text-xs font-black uppercase tracking-wider text-slate-500">Zengfy Sovereign Apps</div>
                                    <button onClick={() => setWaffleOpen(false)} className="text-slate-400 hover:text-slate-700 cursor-pointer">
                                        <X className="w-4 h-4" />
                                    </button>
                                </div>
                                <div className="grid grid-cols-3 gap-2 pt-3">
                                    {ecosystemApps.map((app) => (
                                        <a
                                            key={app.name}
                                            href={app.url}
                                            className="flex flex-col items-center p-2 rounded-xl hover:bg-slate-50 transition-colors text-center group"
                                        >
                                            <span className="text-2xl mb-1 transition-transform">{app.icon}</span>
                                            <span className="text-xs font-bold text-slate-800 line-clamp-1">{app.name}</span>
                                            <span className="text-[10px] text-slate-400 line-clamp-1">{app.desc}</span>
                                        </a>
                                    ))}
                                </div>
                            </div>
                        )}
                    </div>
                </div>

                {/* Minimalist Desktop Collection Navigation */}
                <nav className="hidden md:flex items-center gap-6 text-xs font-black uppercase tracking-widest text-slate-700">
                    {collections.map((c) => {
                        const isActive = selectedCollection === c.id;
                        return (
                            <button
                                key={c.id}
                                onClick={() => onSelectCollection(c.id)}
                                className={`pb-1 transition-all ${
                                    isActive
                                        ? 'text-slate-950 border-b-2 border-slate-950'
                                        : 'text-slate-500 hover:text-slate-900'
                                }`}
                            >
                                {c.name}
                            </button>
                        );
                    })}
                </nav>

                {/* Right Actions: Bag & SSO */}
                <div className="flex items-center gap-3">
                    <button
                        onClick={onOpenBag}
                        className="relative p-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white transition-all flex items-center gap-2 text-xs font-bold shadow-md shadow-slate-900/20"
                    >
                        <ShoppingBag className="w-4 h-4" />
                        <span className="hidden sm:inline">ব্যাগ</span>
                        {bagCount > 0 && (
                            <span className="w-5 h-5 rounded-full bg-white text-slate-950 font-black text-[11px] flex items-center justify-center">
                                {bagCount}
                            </span>
                        )}
                    </button>

                    <a
                        href="http://auth.zengfy.top:8000/login"
                        className="p-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 transition-colors flex items-center gap-1.5 text-xs font-bold"
                        title="Sign In"
                    >
                        <User className="w-4 h-4" />
                        <span className="hidden sm:inline">লগইন</span>
                    </a>
                </div>
            </div>

            {/* Mobile Collection Filter Bar */}
            <div className="md:hidden px-4 pb-2.5 flex items-center gap-2 overflow-x-auto scrollbar-none">
                {collections.map((c) => {
                    const isActive = selectedCollection === c.id;
                    return (
                        <button
                            key={c.id}
                            onClick={() => onSelectCollection(c.id)}
                            className={`px-3 py-1.5 rounded-full text-[11px] font-bold shrink-0 transition-all ${
                                isActive
                                    ? 'bg-slate-950 text-white'
                                    : 'bg-slate-100 text-slate-600'
                            }`}
                        >
                            {c.name}
                        </button>
                    );
                })}
            </div>
        </header>
    );
}
