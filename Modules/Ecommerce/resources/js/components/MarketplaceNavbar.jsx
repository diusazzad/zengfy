import React, { useState } from 'react';
import {
    Search, ShoppingCart, Heart, Store, User,
    Grid, ShieldCheck, ChevronDown, Sparkles, X, Phone,
    Zap, Tag, ShoppingBag, Download, ArrowRight
} from 'lucide-react';

export default function MarketplaceNavbar({
    topBarData,
    cartCount,
    onOpenCart,
    searchQuery,
    setSearchQuery,
    selectedCategory,
    setSelectedCategory,
    categories = [],
    trendingKeywords = []
}) {
    const [waffleOpen, setWaffleOpen] = useState(false);
    const [catDropdownOpen, setCatDropdownOpen] = useState(false);

    const ecosystemApps = [
        { name: "Core", desc: "Master Portal", url: "http://zengfy.top:8000/", icon: "🏛️" },
        { name: "Shop", desc: "Clothing Brand", url: "http://shop.zengfy.top:8000/", icon: "🏷️" },
        { name: "Social", desc: "Civic Network", url: "http://social.zengfy.top:8000/", icon: "🌍" },
        { name: "POS", desc: "Retail & Thermal", url: "http://pos.zengfy.top:8000/", icon: "⚡" },
        { name: "School", desc: "Campus & RFID", url: "http://school.zengfy.top:8000/", icon: "🎓" },
        { name: "Law", desc: "Digital Chamber", url: "http://law.zengfy.top:8000/", icon: "⚖️" },
        { name: "Hotel", desc: "Resort & Kitchen", url: "http://hotel.zengfy.top:8000/", icon: "🏨" },
        { name: "Habit", desc: "5 Daily Salah", url: "http://habit.zengfy.top:8000/", icon: "🕌" },
        { name: "Journal", desc: "Op-Ed & Paywall", url: "http://journal.zengfy.top:8000/", icon: "📰" }
    ];

    const defaultTrending = trendingKeywords.length > 0 ? trendingKeywords : [
        "স্মার্টওয়াচ", "টি-শার্ট", "পাঞ্জাবি", "ইয়ারবাডস", "খাঁটি মধু", "অফিস চেয়ার", "গেমিং কীবোর্ড"
    ];

    return (
        <header className="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-200/80 shadow-xs">
            {/* 1. Top Utility Strip (Daraz Seller & Help Center Strip) */}
            <div className="bg-[#1E1B4B] text-white text-xs py-1.5 px-4">
                <div className="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-2">
                    <div className="flex items-center gap-2 font-medium">
                        <span className="inline-flex items-center gap-1 bg-[#F85606] text-white px-2 py-0.5 rounded-full text-[10px] font-black shadow-xs">
                            <ShieldCheck className="w-3 h-3" /> NID Verified
                        </span>
                        <span className="truncate text-slate-200 text-[11px]">
                            {topBarData?.announcement || "দারাজের চেয়ে ৫০% কম কমিশনে NID-ভেরিফায়েড সেলারদের পণ্য | সারা দেশে ক্যাশ অন ডেলিভারি"}
                        </span>
                    </div>

                    <div className="flex items-center gap-4 text-slate-300 text-[11px]">
                        <a
                            href="#daraz-comparison"
                            className="text-amber-400 hover:text-amber-300 font-bold flex items-center gap-1 transition-colors"
                        >
                            <Store className="w-3.5 h-3.5 text-[#F85606]" /> {topBarData?.seller_cta || "মার্চেন্ট জোন / দোকান খুলুন"}
                        </a>
                        <span className="hidden sm:inline text-slate-600">|</span>
                        <a href="http://zengfy.top:8000/download" className="hidden sm:flex items-center gap-1 text-slate-300 hover:text-white transition-colors">
                            <Download className="w-3 h-3 text-emerald-400" /> অ্যাপ সেভ করুন
                        </a>
                        <span className="hidden sm:inline text-slate-600">|</span>
                        <span className="hidden sm:flex items-center gap-1 text-slate-300">
                            <Phone className="w-3 h-3 text-orange-400" /> হেল্পলাইন: {topBarData?.helpline || "০৯৬৭৮-১১২২৩৩"}
                        </span>
                    </div>
                </div>
            </div>

            {/* 2. Main Search & Brand Navigation Header */}
            <div className="max-w-7xl mx-auto px-4 sm:px-6 pt-3 pb-2 flex items-center justify-between gap-4">
                {/* Brand Logo & Name */}
                <div className="flex items-center gap-3 shrink-0">
                    <a href="http://ecommerce.zengfy.top:8000/" className="flex items-center gap-2 group">
                        <div className="w-11 h-11 rounded-2xl bg-gradient-to-tr from-[#F85606] via-orange-600 to-[#7C3AED] flex items-center justify-center text-white font-black text-2xl shadow-md shadow-orange-600/25 transition-transform">
                            🛍️
                        </div>
                        <div className="flex flex-col">
                            <span className="text-xl font-black tracking-tight text-slate-900 group-hover:text-orange-600 transition-colors flex items-center gap-1.5">
                                Zengfy <span className="bg-[#F85606] text-white text-[11px] font-black uppercase tracking-wider px-1.5 py-0.5 rounded shadow-2xs">Market</span>
                            </span>
                            <span className="text-[10px] font-bold text-slate-500 tracking-wide">
                                সোভারেন মাল্টি-ভেন্ডর মার্কেটপ্লেস
                            </span>
                        </div>
                    </a>

                    {/* Ecosystem Waffle Launcher */}
                    <div className="relative">
                        <button
                            onClick={() => setWaffleOpen(!waffleOpen)}
                            className="p-2 text-slate-600 hover:text-orange-600 hover:bg-orange-50 rounded-xl transition-colors border border-transparent hover:border-orange-200 cursor-pointer"
                            title="Zengfy Ecosystem Apps"
                        >
                            <Grid className="w-5 h-5" />
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
                                            className="flex flex-col items-center p-2 rounded-xl hover:bg-orange-50/80 transition-colors text-center group"
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

                {/* 3. Wide Search Bar with Category Dropdown & Trending Tags (Daraz Style) */}
                <div className="flex-1 max-w-2xl hidden md:flex flex-col gap-1.5">
                    <div className="flex items-center relative shadow-xs">
                        <div className="relative flex-1 flex items-center">
                            <input
                                type="text"
                                value={searchQuery}
                                onChange={(e) => setSearchQuery(e.target.value)}
                                placeholder="দারাজের বিকল্পে খুঁজুন: স্মার্টওয়াচ, টি-শার্ট, পাঞ্জাবি, মধু, গ্যাজেট..."
                                className="w-full bg-slate-100/90 border-2 border-slate-200 rounded-l-xl pl-4 pr-10 py-2 text-sm font-medium text-slate-900 placeholder:text-slate-400 focus:outline-none focus:border-[#F85606] focus:bg-white transition-all"
                            />
                            {searchQuery && (
                                <button
                                    onClick={() => setSearchQuery('')}
                                    className="absolute right-3 text-slate-400 hover:text-slate-600"
                                >
                                    <X className="w-4 h-4" />
                                </button>
                            )}
                        </div>

                        {/* Category Quick Filter */}
                        <div className="relative">
                            <button
                                onClick={() => setCatDropdownOpen(!catDropdownOpen)}
                                className="h-[42px] px-3 bg-slate-100 border-y-2 border-r-2 border-slate-200 text-slate-700 text-xs font-bold flex items-center gap-1 hover:bg-slate-200 transition-colors"
                            >
                                <span className="max-w-[85px] truncate">
                                    {selectedCategory === 'all' ? 'সব ক্যাটাগরি' : selectedCategory}
                                </span>
                                <ChevronDown className="w-3.5 h-3.5" />
                            </button>

                            {catDropdownOpen && (
                                <div className="absolute right-0 mt-1 w-48 bg-white rounded-xl shadow-xl border border-slate-200 py-1.5 z-50">
                                    <button
                                        onClick={() => { setSelectedCategory('all'); setCatDropdownOpen(false); }}
                                        className={`w-full text-left px-3 py-1.5 text-xs font-bold transition-colors ${selectedCategory === 'all' ? 'text-orange-600 bg-orange-50' : 'text-slate-700 hover:bg-slate-50'}`}
                                    >
                                        সব ক্যাটাগরি
                                    </button>
                                    {categories.map(cat => (
                                        <button
                                            key={cat.id}
                                            onClick={() => { setSelectedCategory(cat.name); setCatDropdownOpen(false); }}
                                            className={`w-full text-left px-3 py-1.5 text-xs font-bold transition-colors ${selectedCategory === cat.name ? 'text-orange-600 bg-orange-50' : 'text-slate-700 hover:bg-slate-50'}`}
                                        >
                                            {cat.name}
                                        </button>
                                    ))}
                                </div>
                            )}
                        </div>

                        {/* Search Submit Button (Daraz Orange) */}
                        <button className="h-[42px] px-6 bg-[#F85606] hover:bg-[#e04c04] text-white rounded-r-xl font-bold flex items-center justify-center gap-1.5 shadow-md shadow-orange-600/25 transition-all">
                            <Search className="w-4 h-4" />
                            <span className="text-xs">খুঁজুন</span>
                        </button>
                    </div>

                    {/* Trending Search Chips */}
                    <div className="flex items-center gap-2 overflow-hidden text-[11px] text-slate-400">
                        <span className="font-bold text-slate-500 shrink-0">জনপ্রিয়:</span>
                        <div className="flex items-center gap-2 overflow-x-auto scrollbar-none">
                            {defaultTrending.map((term, i) => (
                                <button
                                    key={i}
                                    type="button"
                                    onClick={() => setSearchQuery(term)}
                                    className="hover:text-orange-600 hover:underline transition-colors shrink-0"
                                >
                                    {term}
                                </button>
                            ))}
                        </div>
                    </div>
                </div>

                {/* Right Actions: Wishlist, Cart, SSO Account */}
                <div className="flex items-center gap-3 shrink-0">
                    {/* Shopping Cart Drawer Trigger */}
                    <button
                        onClick={onOpenCart}
                        className="relative p-2.5 rounded-xl bg-orange-50 hover:bg-orange-100 text-[#F85606] transition-colors flex items-center gap-1.5 font-bold text-xs border border-orange-200/80 shadow-2xs"
                        title="View Cart"
                    >
                        <ShoppingCart className="w-5 h-5" />
                        <span className="hidden sm:inline">ব্যাগ</span>
                        {cartCount > 0 && (
                            <span className="absolute -top-1.5 -right-1.5 w-5 h-5 rounded-full bg-[#F85606] text-white text-[10px] font-black flex items-center justify-center shadow-md animate-bounce">
                                {cartCount}
                            </span>
                        )}
                    </button>

                    {/* Central Identity SSO Sign In */}
                    <a
                        href="http://zengfy.top:8000/login"
                        className="px-4 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs flex items-center gap-1.5 shadow-sm transition-all"
                    >
                        <User className="w-4 h-4 text-orange-400" />
                        <span>লগইন / সাইন আপ</span>
                    </a>
                </div>
            </div>

            {/* 4. Daraz-Style Horizontal Sub-Navigation Strip */}
            <div className="border-t border-slate-100 bg-white px-4 sm:px-6 hidden md:block">
                <div className="max-w-7xl mx-auto flex items-center justify-between text-xs font-bold text-slate-700 py-2">
                    <div className="flex items-center gap-6">
                        <button
                            onClick={() => setSelectedCategory('all')}
                            className={`flex items-center gap-1.5 hover:text-[#F85606] transition-colors ${selectedCategory === 'all' ? 'text-[#F85606]' : ''}`}
                        >
                            <Grid className="w-4 h-4 text-[#F85606]" />
                            <span>সকল ক্যাটাগরি</span>
                        </button>
                        <a href="#flash-deals" className="flex items-center gap-1.5 hover:text-[#F85606] transition-colors">
                            <Zap className="w-4 h-4 text-amber-500 fill-amber-500" />
                            <span>মেগা ফ্ল্যাশ সেল</span>
                        </a>
                        <a href="#official-stores" className="flex items-center gap-1.5 hover:text-[#F85606] transition-colors">
                            <ShieldCheck className="w-4 h-4 text-purple-600" />
                            <span>অফিসিয়াল ব্র্যান্ড মল</span>
                        </a>
                        <a href="#just-for-you" className="flex items-center gap-1.5 hover:text-[#F85606] transition-colors">
                            <Sparkles className="w-4 h-4 text-blue-600" />
                            <span>আপনার জন্য প্রস্তাবিত</span>
                        </a>
                        <a href="#daraz-comparison" className="flex items-center gap-1.5 text-purple-700 hover:text-purple-800 transition-colors">
                            <Tag className="w-4 h-4" />
                            <span>কেন জেনগফাই বনাম দারাজ?</span>
                        </a>
                    </div>

                    <a
                        href="#daraz-comparison"
                        className="text-[#F85606] hover:text-[#e04c04] flex items-center gap-1 transition-colors"
                    >
                        <Store className="w-3.5 h-3.5" />
                        <span>মার্চেন্ট হাব: ৩ মিনিটে অনলাইন দোকান খুলুন →</span>
                    </a>
                </div>
            </div>

            {/* Mobile Search Bar */}
            <div className="md:hidden px-4 pb-3 pt-1">
                <div className="flex items-center">
                    <input
                        type="text"
                        value={searchQuery}
                        onChange={(e) => setSearchQuery(e.target.value)}
                        placeholder="পণ্য বা ব্র্যান্ড খুঁজুন..."
                        className="w-full bg-slate-100 border border-slate-200 rounded-l-xl px-3 py-2 text-xs font-medium text-slate-900 focus:outline-none focus:border-[#F85606]"
                    />
                    <button className="px-4 py-2 bg-[#F85606] text-white rounded-r-xl text-xs font-bold">
                        <Search className="w-4 h-4" />
                    </button>
                </div>
            </div>
        </header>
    );
}
