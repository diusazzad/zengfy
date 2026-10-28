import React, { useState } from 'react';
import { ShoppingCart, Star, ShieldCheck, Check, Sparkles, Truck, Store } from 'lucide-react';

export default function ProductFeed({ 
    products = [], 
    onAddToCart, 
    selectedCategory, 
    searchQuery 
}) {
    const [addedIds, setAddedIds] = useState({});

    // Filter products based on selectedCategory and searchQuery
    const filteredProducts = products.filter((p) => {
        const matchesCategory = 
            selectedCategory === 'all' || 
            p.category?.toLowerCase() === selectedCategory?.toLowerCase();

        const matchesSearch = 
            !searchQuery || 
            p.title?.toLowerCase().includes(searchQuery.toLowerCase()) ||
            p.category?.toLowerCase().includes(searchQuery.toLowerCase()) ||
            p.seller?.name?.toLowerCase().includes(searchQuery.toLowerCase());

        return matchesCategory && matchesSearch;
    });

    const handleAdd = (item) => {
        onAddToCart(item);
        setAddedIds((prev) => ({ ...prev, [item.id]: true }));
        setTimeout(() => {
            setAddedIds((prev) => ({ ...prev, [item.id]: false }));
        }, 1500);
    };

    return (
        <section id="just-for-you" className="max-w-7xl mx-auto px-4 sm:px-6 py-8">
            <div className="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2 mb-6">
                <div>
                    <h2 className="text-xl font-black text-slate-900 tracking-tight flex items-center gap-2">
                        <Sparkles className="w-5 h-5 text-purple-600" />
                        আপনার জন্য বাছাইকৃত পণ্য (Just For You)
                    </h2>
                    <p className="text-xs font-semibold text-slate-500">
                        {selectedCategory === 'all' ? 'সব ক্যাটাগরির' : selectedCategory} ভেরিফায়েড মার্চেন্টদের সরাসরি পণ্য
                    </p>
                </div>

                <div className="text-xs font-bold text-slate-500 bg-slate-100 px-3 py-1.5 rounded-xl border border-slate-200">
                    মোট {filteredProducts.length}টি পণ্য প্রদর্শিত
                </div>
            </div>

            {filteredProducts.length === 0 ? (
                <div className="text-center py-16 bg-white rounded-3xl border border-slate-200 p-8">
                    <div className="text-4xl mb-3">🔍</div>
                    <h3 className="text-base font-bold text-slate-900 mb-1">কোনো পণ্য পাওয়া যায়নি</h3>
                    <p className="text-xs text-slate-500 max-w-sm mx-auto">
                        আপনার সার্চের সাথে মিলে এমন কোনো পণ্য মেলেনি। ভিন্ন নাম দিয়ে খুঁজুন অথবা ক্যাটাগরি ফিল্টার রিসেট করুন।
                    </p>
                </div>
            ) : (
                <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    {filteredProducts.map((p) => {
                        const isAdded = !!addedIds[p.id];

                        return (
                            <div 
                                key={p.id}
                                className="bg-white rounded-3xl overflow-hidden border border-slate-200/80 hover:border-purple-300 hover:shadow-xl transition-all duration-300 flex flex-col group"
                            >
                                {/* Thumbnail Image */}
                                <div className="relative aspect-4/3 overflow-hidden bg-slate-100">
                                    <img 
                                        src={p.image} 
                                        alt={p.title}
                                        className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                        loading="lazy"
                                    />
                                    {p.badge && (
                                        <span className="absolute top-3 left-3 bg-gradient-to-r from-purple-700 to-indigo-700 text-white text-[11px] font-black px-2.5 py-0.5 rounded-lg shadow-md">
                                            {p.badge}
                                        </span>
                                    )}
                                    <span className="absolute top-3 right-3 bg-white/95 backdrop-blur-md text-emerald-700 text-[10px] font-extrabold px-2 py-0.5 rounded-md flex items-center gap-1 shadow-xs border border-emerald-200">
                                        <ShieldCheck className="w-3 h-3 text-emerald-600" /> NID Verified
                                    </span>
                                </div>

                                {/* Product Body */}
                                <div className="p-5 flex-1 flex flex-col justify-between">
                                    <div>
                                        <div className="flex items-center justify-between text-[11px] text-slate-400 font-bold mb-1">
                                            <span>{p.category}</span>
                                            <div className="flex items-center gap-1 text-amber-500">
                                                <Star className="w-3.5 h-3.5 fill-amber-400" />
                                                <span className="font-black text-slate-800">{p.rating}</span>
                                                <span className="text-slate-400 text-[10px]">({p.reviews})</span>
                                            </div>
                                        </div>

                                        <h3 className="text-sm font-bold text-slate-900 group-hover:text-purple-700 transition-colors line-clamp-2 leading-snug">
                                            {p.title}
                                        </h3>

                                        {/* Merchant Store Info */}
                                        <div className="mt-3 p-2.5 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between text-xs">
                                            <div className="flex items-center gap-1.5 font-bold text-slate-800">
                                                <Store className="w-3.5 h-3.5 text-purple-600" />
                                                <span className="truncate max-w-[140px]">{p.seller.name}</span>
                                            </div>
                                            <span className="text-[10px] text-slate-400 truncate max-w-[100px]">
                                                {p.seller.location.split(',')[0]}
                                            </span>
                                        </div>

                                        {/* Pricing Block */}
                                        <div className="mt-4 flex items-baseline justify-between">
                                            <div className="flex items-baseline gap-2">
                                                <span className="text-xl font-black text-slate-900">
                                                    ৳{p.price.toLocaleString()}
                                                </span>
                                                <span className="text-xs text-slate-400 line-through font-semibold">
                                                    ৳{p.original_price.toLocaleString()}
                                                </span>
                                            </div>
                                            <span className="text-[11px] font-black text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200">
                                                -{p.discount_pct}% ছাড়
                                            </span>
                                        </div>

                                        {/* Delivery Tag */}
                                        <div className="mt-2 text-[11px] text-slate-500 flex items-center gap-1 font-medium">
                                            <Truck className="w-3.5 h-3.5 text-slate-400" />
                                            <span>{p.delivery}</span>
                                        </div>
                                    </div>

                                    {/* Add to Cart Button */}
                                    <button
                                        onClick={() => handleAdd(p)}
                                        className={`mt-4 w-full py-2.5 px-4 rounded-xl font-bold text-xs flex items-center justify-center gap-2 transition-all shadow-xs ${
                                            isAdded
                                                ? 'bg-emerald-600 text-white'
                                                : 'bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white shadow-md shadow-purple-600/20'
                                        }`}
                                    >
                                        {isAdded ? (
                                            <>
                                                <Check className="w-4 h-4" />
                                                <span>ব্যাগে যুক্ত হয়েছে</span>
                                            </>
                                        ) : (
                                            <>
                                                <ShoppingCart className="w-4 h-4" />
                                                <span>কার্টে যোগ করুন</span>
                                            </>
                                        )}
                                    </button>
                                </div>
                            </div>
                        );
                    })}
                </div>
            )}
        </section>
    );
}
