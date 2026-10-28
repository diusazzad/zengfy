import React from 'react';
import { Check, X, ShieldCheck, ArrowRight, Store, Zap } from 'lucide-react';

export default function DarazComparisonTable({ comparisonData, sellerCardData }) {
    if (!comparisonData?.metrics?.length) return null;

    return (
        <section className="max-w-7xl mx-auto px-4 sm:px-6 py-10">
            {/* Comparison Table Box */}
            <div className="bg-white rounded-3xl p-6 sm:p-10 border border-slate-200/90 shadow-md">
                <div className="text-center max-w-2xl mx-auto mb-8">
                    <span className="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-black bg-purple-100 text-purple-700 mb-2">
                        <ShieldCheck className="w-3.5 h-3.5" /> স্বচ্ছ ও প্রতারণাহীন কমার্স
                    </span>
                    <h2 className="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                        {comparisonData.title}
                    </h2>
                    <p className="text-xs sm:text-sm text-slate-500 font-medium mt-1">
                        {comparisonData.subtitle}
                    </p>
                </div>

                <div className="overflow-x-auto">
                    <table className="w-full text-left border-collapse">
                        <thead>
                            <tr className="border-b border-slate-200 text-xs font-black uppercase tracking-wider text-slate-500">
                                <th className="py-3 px-4">বৈশিষ্ট্য / সুবিধা</th>
                                <th className="py-3 px-4 text-red-600 bg-red-50/50 rounded-tl-xl">দারাজ (Daraz Marketplace)</th>
                                <th className="py-3 px-4 text-purple-700 bg-purple-50/80 rounded-tr-xl">Zengfy Marketplace</th>
                            </tr>
                        </thead>
                        <tbody className="divide-y divide-slate-100 text-xs sm:text-sm font-medium">
                            {comparisonData.metrics.map((m, i) => (
                                <tr key={i} className="hover:bg-slate-50/60 transition-colors">
                                    <td className="py-4 px-4 font-bold text-slate-900">
                                        {m.feature}
                                    </td>
                                    <td className="py-4 px-4 text-slate-600 bg-red-50/20">
                                        <div className="flex items-center gap-2">
                                            <X className="w-4 h-4 text-red-500 shrink-0" />
                                            <span>{m.daraz}</span>
                                        </div>
                                    </td>
                                    <td className="py-4 px-4 font-bold text-purple-900 bg-purple-50/40">
                                        <div className="flex items-center gap-2">
                                            <Check className="w-4 h-4 text-emerald-600 shrink-0" />
                                            <span>{m.zengfy}</span>
                                        </div>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>

                {/* Seller Onboarding Banner */}
                {sellerCardData && (
                    <div className="mt-8 rounded-2xl bg-gradient-to-r from-purple-900 via-indigo-900 to-slate-900 p-6 sm:p-8 text-white flex flex-col sm:flex-row items-center justify-between gap-6 shadow-xl">
                        <div className="max-w-xl">
                            <div className="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-black bg-orange-500 text-white mb-2 shadow-xs">
                                <Zap className="w-3 h-3 fill-white" /> মার্চেন্ট প্রি-লঞ্চ অফার
                            </div>
                            <h3 className="text-xl sm:text-2xl font-black tracking-tight leading-snug">
                                {sellerCardData.title}
                            </h3>
                            <p className="text-xs sm:text-sm text-slate-300 mt-1 leading-relaxed">
                                {sellerCardData.subtitle}
                            </p>
                        </div>
                        <a
                            href={sellerCardData.merchant_portal_url || "http://accounts.zengfy.top:8000/register?intent=merchant"}
                            className="px-6 py-3.5 rounded-xl bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 text-white font-extrabold text-xs sm:text-sm shadow-xl flex items-center gap-2 shrink-0 group transition-all"
                        >
                            <Store className="w-4 h-4" />
                            <span>{sellerCardData.button_text || "ফ্রি সেলার স্টোর খুলুন"}</span>
                            <ArrowRight className="w-4 h-4 group-hover:translate-x-1 transition-transform" />
                        </a>
                    </div>
                )}
            </div>
        </section>
    );
}
