import React from 'react';
import { ShieldCheck, ArrowRight, Store, Sparkles, CheckCircle2 } from 'lucide-react';

export default function OfficialStores({ stores = [] }) {
    if (!stores.length) return null;

    return (
        <section id="official-stores" className="max-w-7xl mx-auto px-4 sm:px-6 py-6">
            <div className="bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 rounded-3xl p-6 sm:p-8 text-white border border-slate-800 shadow-xl relative overflow-hidden">
                {/* Background Ambient Glow */}
                <div className="absolute top-0 right-0 w-96 h-96 bg-purple-600/10 rounded-full blur-3xl pointer-events-none" />
                <div className="absolute bottom-0 left-0 w-96 h-96 bg-orange-600/10 rounded-full blur-3xl pointer-events-none" />

                {/* Section Header */}
                <div className="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pb-6 border-b border-white/10 relative z-10">
                    <div>
                        <div className="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-black bg-gradient-to-r from-amber-500 to-orange-500 text-white mb-2 shadow-sm">
                            <Sparkles className="w-3.5 h-3.5" /> 100% Genuine Mall
                        </div>
                        <h2 className="text-xl sm:text-2xl font-black tracking-tight text-white flex items-center gap-2">
                            <span>অফিসিয়াল ব্র্যান্ড স্টোর (Official Brands)</span>
                        </h2>
                        <p className="text-xs sm:text-sm text-slate-300 font-medium mt-1">
                            সরাসরি অনুমোদিত ব্র্যান্ড ওয়্যারহাউস থেকে অরিজিনাল পণ্য ও অফিসিয়াল ওয়ারেন্টি
                        </p>
                    </div>

                    <a 
                        href="#just-for-you" 
                        className="inline-flex items-center gap-1.5 text-xs font-bold text-orange-400 hover:text-orange-300 transition-colors"
                    >
                        <span>সকল ব্র্যান্ড দেখুন</span>
                        <ArrowRight className="w-4 h-4" />
                    </a>
                </div>

                {/* Brand Cards Grid */}
                <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 pt-6 relative z-10">
                    {stores.map((store) => (
                        <div
                            key={store.id}
                            className="bg-white/5 hover:bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/10 hover:border-orange-500/50 transition-all duration-300 flex flex-col justify-between group"
                        >
                            {/* Brand Banner Thumbnail */}
                            <div className="relative h-28 rounded-xl overflow-hidden mb-3 bg-slate-800">
                                <img
                                    src={store.banner}
                                    alt={store.name}
                                    className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    loading="lazy"
                                />
                                <div className="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent" />
                                
                                {/* Floating Brand Logo Avatar */}
                                <div className="absolute -bottom-2 left-3 w-11 h-11 rounded-xl bg-white p-1 shadow-lg border border-white/80 overflow-hidden">
                                    <img 
                                        src={store.logo} 
                                        alt={`${store.name} logo`} 
                                        className="w-full h-full object-cover rounded-lg"
                                    />
                                </div>

                                <span className="absolute top-2 right-2 bg-black/60 backdrop-blur-md text-amber-300 text-[10px] font-black px-2 py-0.5 rounded-full border border-amber-300/30 flex items-center gap-1">
                                    <CheckCircle2 className="w-3 h-3 text-amber-400" />
                                    {store.badge}
                                </span>
                            </div>

                            {/* Brand Info */}
                            <div className="pt-2">
                                <h3 className="text-sm font-extrabold text-white group-hover:text-orange-400 transition-colors flex items-center gap-1.5">
                                    <span>{store.name}</span>
                                </h3>
                                <p className="text-[11px] text-slate-300 line-clamp-1 mt-0.5 font-medium">
                                    {store.tagline}
                                </p>
                            </div>

                            {/* Footer Follow & Visit */}
                            <div className="mt-4 pt-3 border-t border-white/10 flex items-center justify-between text-xs">
                                <span className="text-[11px] text-slate-400 font-semibold">
                                    {store.followers} ফলোয়ার
                                </span>
                                <button
                                    type="button"
                                    className="px-3 py-1 rounded-lg bg-orange-600 hover:bg-orange-500 text-white font-bold text-[11px] transition-all flex items-center gap-1 shadow-xs"
                                >
                                    <Store className="w-3 h-3" />
                                    <span>স্টোর দেখুন</span>
                                </button>
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </section>
    );
}
