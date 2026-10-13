import React, { useState, useEffect } from 'react';
import { Zap, Clock, ShoppingCart, Star, ShieldCheck, Check } from 'lucide-react';

export default function FlashDeals({ flashSaleData, onAddToCart }) {
    const [timeLeft, setTimeLeft] = useState(flashSaleData?.ends_in_seconds || 28800);
    const [addedIds, setAddedIds] = useState({});

    useEffect(() => {
        const interval = setInterval(() => {
            setTimeLeft((prev) => (prev > 0 ? prev - 1 : 0));
        }, 1000);
        return () => clearInterval(interval);
    }, []);

    const hours = Math.floor(timeLeft / 3600);
    const minutes = Math.floor((timeLeft % 3600) / 60);
    const seconds = timeLeft % 60;

    const pad = (n) => String(n).padStart(2, '0');

    const handleAdd = (item) => {
        onAddToCart(item);
        setAddedIds((prev) => ({ ...prev, [item.id]: true }));
        setTimeout(() => {
            setAddedIds((prev) => ({ ...prev, [item.id]: false }));
        }, 1500);
    };

    if (!flashSaleData?.items?.length) return null;

    return (
        <section id="flash-deals" className="max-w-7xl mx-auto px-4 sm:px-6 py-6">
            <div className="bg-gradient-to-r from-orange-50 via-white to-amber-50 rounded-3xl p-5 sm:p-7 border border-orange-200/80 shadow-sm">
                {/* Header with Countdown */}
                <div className="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pb-5 border-b border-orange-200/50">
                    <div className="flex items-center gap-3">
                        <div className="w-10 h-10 rounded-xl bg-orange-600 text-white flex items-center justify-center shadow-md shadow-orange-600/30">
                            <Zap className="w-5 h-5 fill-white" />
                        </div>
                        <div>
                            <h2 className="text-xl font-black text-slate-900 tracking-tight">
                                {flashSaleData.title || "মেগা ফ্ল্যাশ ডিলস"}
                            </h2>
                            <p className="text-xs font-semibold text-slate-500">
                                সীমিত সময়ের জন্য সর্বোচ্চ ডিসকাউন্টযুক্ত ভেরিফায়েড পণ্য
                            </p>
                        </div>
                    </div>

                    {/* Countdown Clock */}
                    <div className="flex items-center gap-2 bg-white px-4 py-2 rounded-2xl border border-orange-200 shadow-xs">
                        <Clock className="w-4 h-4 text-orange-600 animate-pulse" />
                        <span className="text-xs font-bold text-slate-600">সময় বাকি:</span>
                        <div className="flex items-center gap-1 font-mono font-black text-sm text-slate-900">
                            <span className="bg-slate-900 text-white px-2 py-0.5 rounded-lg">{pad(hours)}</span>
                            <span>:</span>
                            <span className="bg-slate-900 text-white px-2 py-0.5 rounded-lg">{pad(minutes)}</span>
                            <span>:</span>
                            <span className="bg-orange-600 text-white px-2 py-0.5 rounded-lg">{pad(seconds)}</span>
                        </div>
                    </div>
                </div>

                {/* Flash Deal Products Grid */}
                <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 pt-5">
                    {flashSaleData.items.map((item) => {
                        const isAdded = !!addedIds[item.id];
                        const stockPct = Math.round((item.sold_count / item.stock_total) * 100);

                        return (
                            <div 
                                key={item.id}
                                className="bg-white rounded-2xl overflow-hidden border border-slate-200/90 hover:border-orange-300 hover:shadow-xl transition-all duration-300 flex flex-col group"
                            >
                                {/* Thumbnail with Discount Tag */}
                                <div className="relative aspect-4/3 overflow-hidden bg-slate-100">
                                    <img 
                                        src={item.image} 
                                        alt={item.title}
                                        className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                        loading="lazy"
                                    />
                                    <span className="absolute top-2.5 left-2.5 bg-gradient-to-r from-red-600 to-orange-600 text-white text-[11px] font-black px-2 py-0.5 rounded-lg shadow-md">
                                        -{item.discount_pct}% ছাড়
                                    </span>
                                    <span className="absolute top-2.5 right-2.5 bg-white/90 backdrop-blur-md text-slate-800 text-[10px] font-bold px-2 py-0.5 rounded-md flex items-center gap-1 shadow-xs">
                                        <ShieldCheck className="w-3 h-3 text-emerald-600" /> ভেরিফায়েড
                                    </span>
                                </div>

                                {/* Body Information */}
                                <div className="p-4 flex-1 flex flex-col justify-between">
                                    <div>
                                        <div className="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">
                                            {item.category}
                                        </div>
                                        <h3 className="text-xs sm:text-sm font-bold text-slate-900 line-clamp-2 group-hover:text-orange-600 transition-colors leading-snug">
                                            {item.title}
                                        </h3>

                                        {/* Merchant Location */}
                                        <div className="mt-2 text-[11px] text-slate-500 flex items-center gap-1 font-medium">
                                            <span>🏪 {item.seller.name}</span>
                                            <span className="text-slate-300">•</span>
                                            <span className="text-slate-400 truncate">{item.seller.location.split(',')[0]}</span>
                                        </div>

                                        {/* Pricing Block */}
                                        <div className="mt-2.5 flex items-baseline gap-2">
                                            <span className="text-base sm:text-lg font-black text-slate-900">
                                                ৳{item.price.toLocaleString()}
                                            </span>
                                            <span className="text-xs text-slate-400 line-through font-semibold">
                                                ৳{item.original_price.toLocaleString()}
                                            </span>
                                        </div>

                                        {/* Stock Sold Progress Meter */}
                                        <div className="mt-3">
                                            <div className="flex items-center justify-between text-[10px] font-bold text-slate-500 mb-1">
                                                <span>বিক্রি: {item.sold_count}/{item.stock_total}</span>
                                                <span className="text-orange-600">{stockPct}% বিক্রি শেষ</span>
                                            </div>
                                            <div className="w-full h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                                <div 
                                                    className="h-full bg-gradient-to-r from-orange-500 to-red-500 rounded-full transition-all duration-500"
                                                    style={{ width: `${stockPct}%` }}
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    {/* Action Button */}
                                    <button
                                        onClick={() => handleAdd(item)}
                                        className={`mt-4 w-full py-2.5 px-3 rounded-xl font-bold text-xs flex items-center justify-center gap-1.5 transition-all shadow-xs ${
                                            isAdded
                                                ? 'bg-emerald-600 text-white'
                                                : 'bg-slate-900 hover:bg-orange-600 text-white'
                                        }`}
                                    >
                                        {isAdded ? (
                                            <>
                                                <Check className="w-4 h-4" />
                                                <span>ব্যাগে যোগ হয়েছে</span>
                                            </>
                                        ) : (
                                            <>
                                                <ShoppingCart className="w-3.5 h-3.5" />
                                                <span>কার্টে যোগ করুন</span>
                                            </>
                                        )}
                                    </button>
                                </div>
                            </div>
                        );
                    })}
                </div>
            </div>
        </section>
    );
}
