import React, { useState } from 'react';
import { CheckCircle2, UserCheck, Shield, Sparkles } from 'lucide-react';

export default function RoleJourneyTabs({ stakeholders = [] }) {
    const [activeIdx, setActiveIdx] = useState(0);
    const activeStakeholder = stakeholders[activeIdx] || stakeholders[0];

    if (!stakeholders || stakeholders.length === 0) return null;

    return (
        <section className="py-16 md:py-24 relative overflow-hidden bg-white">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div className="text-center max-w-3xl mx-auto mb-12">
                    <div className="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-50 border border-amber-200/80 text-amber-800 text-xs font-bold uppercase tracking-wider mb-3">
                        <UserCheck className="w-4 h-4 text-amber-600" />
                        <span>Stakeholder Value Delivery</span>
                    </div>
                    <h2 className="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                        শোরুমের প্রতিটি দায়িত্বে শতভাগ মানসিক প্রশান্তি 🤝
                    </h2>
                    <p className="mt-3 text-slate-600 text-base">
                        মালিক, ক্যাশিয়ার, গোডাউন ইনচার্জ কিংবা শপিং খদ্দের—প্রত্যেকের জন্য সহজ ও দ্রুততম ইন্টারফেস।
                    </p>
                </div>

                {/* Stakeholder Selection Pills */}
                <div className="flex flex-wrap items-center justify-center gap-2.5 max-w-4xl mx-auto mb-10">
                    {stakeholders.map((sh, idx) => {
                        const isActive = activeIdx === idx;
                        return (
                            <button
                                key={sh.id}
                                type="button"
                                onClick={() => setActiveIdx(idx)}
                                className={`px-5 py-3 rounded-2xl text-xs sm:text-sm font-extrabold transition-all flex items-center gap-2 cursor-pointer ${
                                    isActive
                                        ? 'bg-amber-600 text-white shadow-lg shadow-amber-600/25 scale-102 ring-2 ring-amber-500/20'
                                        : 'bg-slate-100/80 hover:bg-slate-200/70 text-slate-700'
                                }`}
                            >
                                <span className="text-lg">{sh.avatar}</span>
                                <span>{sh.title_bn || sh.title}</span>
                            </button>
                        );
                    })}
                </div>

                {/* Active Card Body */}
                {activeStakeholder && (
                    <div className="max-w-4xl mx-auto p-6 sm:p-10 rounded-3xl bg-gradient-to-br from-amber-50/50 via-white to-slate-50 border border-amber-200/70 shadow-lg text-left">
                        <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-200/80">
                            <div className="flex items-center gap-3.5">
                                <div className="w-14 h-14 rounded-2xl bg-amber-100 border border-amber-200 flex items-center justify-center text-3xl shadow-xs">
                                    {activeStakeholder.avatar}
                                </div>
                                <div>
                                    <h3 className="text-xl sm:text-2xl font-black text-slate-900">
                                        {activeStakeholder.title_bn || activeStakeholder.title}
                                    </h3>
                                    <p className="text-xs sm:text-sm text-slate-500 font-semibold mt-0.5">
                                        {activeStakeholder.role_desc}
                                    </p>
                                </div>
                            </div>

                            <span className="self-start sm:self-auto text-xs font-black px-3.5 py-1.5 rounded-full bg-amber-100 text-amber-800 border border-amber-200 uppercase tracking-wider">
                                ভ্যালু ম্যাট্রিক্স
                            </span>
                        </div>

                        {/* Benefits Checklist */}
                        <div className="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                            {activeStakeholder.benefits.map((point, pIdx) => (
                                <div
                                    key={pIdx}
                                    className="p-4 rounded-2xl bg-white border border-slate-200/80 shadow-xs flex items-start gap-3 group hover:border-amber-300 transition"
                                >
                                    <div className="w-6 h-6 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                                        <CheckCircle2 className="w-4 h-4" />
                                    </div>
                                    <p className="text-xs sm:text-sm text-slate-700 font-medium leading-relaxed">
                                        {point}
                                    </p>
                                </div>
                            ))}
                        </div>
                    </div>
                )}

            </div>
        </section>
    );
}