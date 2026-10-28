import React, { useState } from 'react';
import { ShoppingBag, Eye, Check, Sparkles, Ruler } from 'lucide-react';

export default function ClothingCollectionGrid({ 
    products = [], 
    selectedCollection, 
    onSelectCollection,
    collections = [],
    onAddToCart,
    onQuickView,
    onOpenSizeGuide
}) {
    // Keep local selected size per product id
    const [selectedSizes, setSelectedSizes] = useState({});
    const [addedIds, setAddedIds] = useState({});

    const filteredProducts = products.filter((p) => {
        if (selectedCollection === 'all') return true;
        return p.collection_id === selectedCollection;
    });

    const handleSizeSelect = (productId, size) => {
        setSelectedSizes((prev) => ({ ...prev, [productId]: size }));
    };

    const handleAdd = (product) => {
        const chosenSize = selectedSizes[product.id] || product.sizes[0];
        onAddToCart(product, chosenSize);

        setAddedIds((prev) => ({ ...prev, [product.id]: true }));
        setTimeout(() => {
            setAddedIds((prev) => ({ ...prev, [product.id]: false }));
        }, 1500);
    };

    return (
        <section id="collection-grid" className="max-w-7xl mx-auto px-4 sm:px-6 py-12">
            {/* Section Header & Minimalist Filter Tabs */}
            <div className="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8 pb-6 border-b border-slate-200">
                <div>
                    <span className="text-[11px] font-black uppercase tracking-[0.25em] text-slate-400">
                        OFFICIAL ATELIER CATALOG
                    </span>
                    <h2 className="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight uppercase font-mono mt-1">
                        THE SOVEREIGN COLLECTION
                    </h2>
                </div>

                <div className="flex flex-wrap items-center gap-2">
                    <button
                        onClick={onOpenSizeGuide}
                        className="text-xs font-bold text-slate-600 hover:text-slate-900 flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-slate-200 mr-2"
                    >
                        <Ruler className="w-3.5 h-3.5" /> সাইজ চার্ট
                    </button>

                    {collections.map((c) => {
                        const isActive = selectedCollection === c.id;
                        return (
                            <button
                                key={c.id}
                                onClick={() => onSelectCollection(c.id)}
                                className={`px-4 py-2 rounded-xl text-xs font-bold transition-all ${
                                    isActive
                                        ? 'bg-slate-950 text-white shadow-md'
                                        : 'bg-slate-100 text-slate-600 hover:bg-slate-200'
                                }`}
                            >
                                {c.name}
                            </button>
                        );
                    })}
                </div>
            </div>

            {/* Products Grid */}
            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                {filteredProducts.map((p) => {
                    const currentSize = selectedSizes[p.id] || p.sizes[0];
                    const isAdded = !!addedIds[p.id];

                    return (
                        <div 
                            key={p.id}
                            className="group flex flex-col bg-white rounded-3xl overflow-hidden border border-slate-200/90 hover:border-slate-400 hover:shadow-2xl transition-all duration-300"
                        >
                            {/* Product Image Frame with Hover Swap */}
                            <div className="relative aspect-3/4 overflow-hidden bg-slate-100">
                                <img 
                                    src={p.image_front} 
                                    alt={p.title} 
                                    className="w-full h-full object-cover transition-opacity duration-500 group-hover:opacity-0"
                                    loading="lazy"
                                />
                                <img 
                                    src={p.image_back} 
                                    alt={`${p.title} back view`} 
                                    className="w-full h-full object-cover absolute inset-0 opacity-0 transition-opacity duration-500 group-hover:opacity-100 scale-105"
                                    loading="lazy"
                                />

                                {/* GSM Spec Badge */}
                                <div className="absolute top-3 left-3 bg-slate-950/90 backdrop-blur-md text-white text-[10px] font-black uppercase tracking-wider px-2.5 py-1 rounded-lg">
                                    {p.gsm}
                                </div>

                                {p.badge && (
                                    <div className="absolute top-3 right-3 bg-white/95 backdrop-blur-md text-slate-900 text-[10px] font-bold px-2.5 py-1 rounded-lg shadow-sm border border-slate-200">
                                        {p.badge}
                                    </div>
                                )}

                                {/* Quick View Button Overlay on Hover */}
                                <div className="absolute inset-x-4 bottom-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex justify-center">
                                    <button
                                        onClick={() => onQuickView(p)}
                                        className="w-full py-2.5 px-4 rounded-xl bg-white/95 backdrop-blur-md hover:bg-white text-slate-900 font-bold text-xs shadow-lg flex items-center justify-center gap-2 transition-transform hover:scale-102"
                                    >
                                        <Eye className="w-4 h-4" />
                                        <span>বিস্তারিত ও সাইজ গাইড (Quick View)</span>
                                    </button>
                                </div>
                            </div>

                            {/* Product Details & Actions */}
                            <div className="p-5 flex-1 flex flex-col justify-between">
                                <div>
                                    <div className="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1">
                                        {p.fabric}
                                    </div>
                                    <h3 className="text-base font-bold text-slate-900 group-hover:text-slate-700 transition-colors">
                                        {p.title}
                                    </h3>
                                    <div className="text-xs text-slate-500 mt-1 line-clamp-1">
                                        {p.fit}
                                    </div>

                                    {/* Pricing Block */}
                                    <div className="mt-3 flex items-baseline gap-2.5">
                                        <span className="text-xl font-black text-slate-950 font-mono">
                                            ৳{p.price.toLocaleString()}
                                        </span>
                                        <span className="text-xs text-slate-400 line-through font-semibold">
                                            ৳{p.original_price.toLocaleString()}
                                        </span>
                                    </div>

                                    {/* Size Selector Pills */}
                                    <div className="mt-4">
                                        <div className="flex items-center justify-between text-[11px] font-bold text-slate-600 mb-1.5">
                                            <span>সাইজ নির্বাচন: <strong className="text-slate-950 font-mono">{currentSize}</strong></span>
                                            <button 
                                                onClick={onOpenSizeGuide}
                                                className="text-[10px] text-slate-400 hover:text-slate-700 underline"
                                            >
                                                পরিমাপ চার্ট
                                            </button>
                                        </div>
                                        <div className="flex items-center gap-1.5 flex-wrap">
                                            {p.sizes.map((sz) => {
                                                const isSzActive = currentSize === sz;
                                                return (
                                                    <button
                                                        key={sz}
                                                        onClick={() => handleSizeSelect(p.id, sz)}
                                                        className={`min-w-[34px] h-8 px-2 rounded-lg text-xs font-mono font-bold transition-all ${
                                                            isSzActive
                                                                ? 'bg-slate-950 text-white shadow-xs'
                                                                : 'bg-slate-100 text-slate-700 hover:bg-slate-200'
                                                        }`}
                                                    >
                                                        {sz}
                                                    </button>
                                                );
                                            })}
                                        </div>
                                    </div>
                                </div>

                                {/* Add to Bag Button */}
                                <button
                                    onClick={() => handleAdd(p)}
                                    className={`mt-5 w-full py-3 px-4 rounded-xl font-bold text-xs uppercase tracking-wider flex items-center justify-center gap-2 transition-all ${
                                        isAdded
                                            ? 'bg-emerald-600 text-white'
                                            : 'bg-slate-950 hover:bg-slate-800 text-white shadow-md shadow-slate-950/20'
                                    }`}
                                >
                                    {isAdded ? (
                                        <>
                                            <Check className="w-4 h-4" />
                                            <span>ব্যাগে যোগ হয়েছে ({currentSize})</span>
                                        </>
                                    ) : (
                                        <>
                                            <ShoppingBag className="w-4 h-4" />
                                            <span>ব্যাগে যোগ করুন ({currentSize})</span>
                                        </>
                                    )}
                                </button>
                            </div>
                        </div>
                    );
                })}
            </div>
        </section>
    );
}
