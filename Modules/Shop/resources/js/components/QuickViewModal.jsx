import React, { useState } from 'react';
import { X, Check, ShoppingBag, ShieldCheck, Ruler, ArrowRight } from 'lucide-react';

export default function QuickViewModal({ 
    product, 
    onClose, 
    onAddToCart, 
    sizeGuideData 
}) {
    if (!product) return null;

    const [selectedSize, setSelectedSize] = useState(product.sizes[0]);
    const [selectedView, setSelectedView] = useState('front'); // 'front' | 'back'
    const [activeTab, setActiveTab] = useState('details'); // 'details' | 'size_guide'
    const [isAdded, setIsAdded] = useState(false);

    const handleAdd = () => {
        onAddToCart(product, selectedSize);
        setIsAdded(true);
        setTimeout(() => setIsAdded(false), 1500);
    };

    return (
        <div className="fixed inset-0 z-50 overflow-y-auto">
            {/* Backdrop */}
            <div 
                onClick={onClose}
                className="fixed inset-0 bg-slate-950/70 backdrop-blur-xs transition-opacity"
            />

            <div className="min-h-full flex items-center justify-center p-4">
                <div className="relative bg-white rounded-3xl max-w-3xl w-full overflow-hidden shadow-2xl border border-slate-200 z-10 animate-in fade-in zoom-in-95">
                    {/* Close Button */}
                    <button
                        onClick={onClose}
                        className="absolute top-4 right-4 z-20 p-2 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 transition-colors"
                    >
                        <X className="w-5 h-5" />
                    </button>

                    <div className="grid grid-cols-1 md:grid-cols-12">
                        {/* Image Showcase (5 cols) */}
                        <div className="md:col-span-5 bg-slate-100 p-6 flex flex-col justify-between">
                            <div className="relative aspect-3/4 rounded-2xl overflow-hidden shadow-md">
                                <img
                                    src={selectedView === 'front' ? product.image_front : product.image_back}
                                    alt={product.title}
                                    className="w-full h-full object-cover"
                                />
                                <span className="absolute top-3 left-3 bg-slate-950 text-white text-[10px] font-mono font-bold px-2.5 py-1 rounded-md">
                                    {product.gsm}
                                </span>
                            </div>

                            {/* View Switcher Thumbnails */}
                            <div className="flex items-center justify-center gap-3 mt-4">
                                <button
                                    onClick={() => setSelectedView('front')}
                                    className={`px-3 py-1.5 rounded-lg text-xs font-bold transition-all ${
                                        selectedView === 'front' 
                                            ? 'bg-slate-950 text-white shadow-xs' 
                                            : 'bg-white text-slate-700 border border-slate-200'
                                    }`}
                                >
                                    সামনের ভিউ
                                </button>
                                <button
                                    onClick={() => setSelectedView('back')}
                                    className={`px-3 py-1.5 rounded-lg text-xs font-bold transition-all ${
                                        selectedView === 'back' 
                                            ? 'bg-slate-950 text-white shadow-xs' 
                                            : 'bg-white text-slate-700 border border-slate-200'
                                    }`}
                                >
                                    পেছনের ভিউ
                                </button>
                            </div>
                        </div>

                        {/* Details & Specs (7 cols) */}
                        <div className="md:col-span-7 p-6 sm:p-8 flex flex-col justify-between">
                            <div>
                                <div className="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">
                                    {product.fabric}
                                </div>
                                <h3 className="text-xl font-bold text-slate-950 font-mono">
                                    {product.title}
                                </h3>

                                <div className="mt-2 flex items-baseline gap-3">
                                    <span className="text-2xl font-black text-slate-950 font-mono">
                                        ৳{product.price.toLocaleString()}
                                    </span>
                                    <span className="text-xs text-slate-400 line-through">
                                        ৳{product.original_price.toLocaleString()}
                                    </span>
                                </div>

                                {/* Tabs: Details vs Size Guide */}
                                <div className="flex items-center gap-4 mt-5 border-b border-slate-200 text-xs font-bold">
                                    <button
                                        onClick={() => setActiveTab('details')}
                                        className={`pb-2 transition-all ${activeTab === 'details' ? 'border-b-2 border-slate-950 text-slate-950' : 'text-slate-400'}`}
                                    >
                                        পোশাকের বিবরণ ও ফেব্রিক
                                    </button>
                                    <button
                                        onClick={() => setActiveTab('size_guide')}
                                        className={`pb-2 transition-all ${activeTab === 'size_guide' ? 'border-b-2 border-slate-950 text-slate-950' : 'text-slate-400'}`}
                                    >
                                        সাইজ চার্ট (ইঞ্চি)
                                    </button>
                                </div>

                                {activeTab === 'details' ? (
                                    <div className="py-4 space-y-3 text-xs text-slate-600 leading-relaxed">
                                        <p>{product.description}</p>
                                        <div className="bg-slate-50 p-3 rounded-xl border border-slate-200 space-y-1.5 font-medium">
                                            <div><strong>ফিট:</strong> {product.fit}</div>
                                            <div><strong>ফ্যাব্রিক ঘনত্ব:</strong> {product.gsm} (100% Pre-washed)</div>
                                            <div><strong>ওয়াশ কেয়ার:</strong> কোল্ড মেশিন ওয়াশ, ড্রায়ারে লো হিট।</div>
                                        </div>
                                    </div>
                                ) : (
                                    <div className="py-4">
                                        <p className="text-[11px] text-slate-500 mb-2">
                                            {sizeGuideData?.note || "আপনার রেগুলার সাইজ নির্বাচন করুন।"}
                                        </p>
                                        <div className="overflow-x-auto">
                                            <table className="w-full text-left text-xs border-collapse">
                                                <thead>
                                                    <tr className="border-b border-slate-200 text-slate-400">
                                                        <th className="py-1.5 px-2">সাইজ</th>
                                                        <th className="py-1.5 px-2">চেস্ট (বুক)</th>
                                                        <th className="py-1.5 px-2">লম্বা</th>
                                                        <th className="py-1.5 px-2">শোল্ডার</th>
                                                    </tr>
                                                </thead>
                                                <tbody className="divide-y divide-slate-100 font-mono">
                                                    {sizeGuideData?.chart?.map((row) => (
                                                        <tr key={row.size} className={selectedSize === row.size ? 'bg-slate-100 font-bold' : ''}>
                                                            <td className="py-1.5 px-2">{row.size}</td>
                                                            <td className="py-1.5 px-2">{row.chest}</td>
                                                            <td className="py-1.5 px-2">{row.length}</td>
                                                            <td className="py-1.5 px-2">{row.shoulder}</td>
                                                        </tr>
                                                    ))}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                )}

                                {/* Size Picker */}
                                <div className="mt-2">
                                    <label className="block text-xs font-bold text-slate-700 mb-1.5">
                                        সাইজ নির্বাচন করুন: <strong className="text-slate-950 font-mono">{selectedSize}</strong>
                                    </label>
                                    <div className="flex items-center gap-2">
                                        {product.sizes.map((sz) => (
                                            <button
                                                key={sz}
                                                onClick={() => setSelectedSize(sz)}
                                                className={`min-w-[40px] h-9 px-2 rounded-xl text-xs font-mono font-bold transition-all ${
                                                    selectedSize === sz
                                                        ? 'bg-slate-950 text-white'
                                                        : 'bg-slate-100 text-slate-700 hover:bg-slate-200'
                                                }`}
                                            >
                                                {sz}
                                            </button>
                                        ))}
                                    </div>
                                </div>
                            </div>

                            {/* Action Buttons */}
                            <div className="pt-6 border-t border-slate-200 mt-6 flex items-center gap-3">
                                <button
                                    onClick={handleAdd}
                                    className={`flex-1 py-3.5 px-4 rounded-xl font-bold text-xs uppercase tracking-wider flex items-center justify-center gap-2 transition-all ${
                                        isAdded
                                            ? 'bg-emerald-600 text-white'
                                            : 'bg-slate-950 hover:bg-slate-800 text-white shadow-lg shadow-slate-950/20'
                                    }`}
                                >
                                    {isAdded ? (
                                        <>
                                            <Check className="w-4 h-4" />
                                            <span>ব্যাগে যোগ হয়েছে</span>
                                        </>
                                    ) : (
                                        <>
                                            <ShoppingBag className="w-4 h-4" />
                                            <span>ব্যাগে যোগ করুন ({selectedSize})</span>
                                        </>
                                    )}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}
