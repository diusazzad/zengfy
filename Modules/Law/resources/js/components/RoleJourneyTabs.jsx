import React, { useState } from 'react';
import { CheckCircle2, UserCheck, Scale, Award } from 'lucide-react';

export default function RoleJourneyTabs({ stakeholders = [] }) {
    const [activeIdx, setActiveIdx] = useState(0);
    const activeStakeholder = stakeholders[activeIdx] || stakeholders[0];

    if (!stakeholders || stakeholders.length === 0) return null;

    return (
        <section className="py-16 md:py-24 relative overflow-hidden bg-white">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div className="text-center max-w-3xl mx-auto mb-12">
                    <div className="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-rose-50 border border-rose-200/80 text-[#881337] text-xs font-bold uppercase tracking-wider mb-3">
                        <Award className="w-4 h-4 text-[#881337]" />
                        <span>Chamber Workflow Matrix</span>
                    </div>
                    <h2 className="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                        চেম্বারের প্রতিটি স্তরে শতভাগ পেশাদার গতি ও মর্যাদা 🏛️
                    </h2>
                    <p className="mt-3 text-slate-600 text-base">
                        সিনিয়র অ্যাডভোকেট, জুনিয়র অ্যাসোসিয়েট, কোর্ট মুহুরি কিংবা বিচারপ্রার্থী খরিদ্দার—সবার জন্য সমন্বিত আইনি কর্মপ্রবাহ।
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
                                        ? 'bg-[#881337] text-white shadow-lg shadow-rose-950/25 scale-102 ring-2 ring-rose-900/20'
                                        : 'bg-stone-100 hover:bg-stone-200 text-stone-700'
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
                    <div className="max-w-4xl mx-auto p-6 sm:p-10 rounded-3xl bg-gradient-to-br from-rose-50/40 via-white to-stone-50 border border-rose-200/70 shadow-lg text-left">
                        <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-stone-200">
                            <div className="flex items-center gap-3.5">
                                <div className="w-14 h-14 rounded-2xl bg-rose-100 border border-rose-200 flex items-center justify-center text-3xl shadow-xs">
                                    {activeStakeholder.avatar}
                                </div>
                                <div>
                                    <h3 className="text-xl sm:text-2xl font-black text-slate-900">
                                        {activeStakeholder.title_bn || activeStakeholder.title}
                                    </h3>
                                    <p className="text-xs sm:text-sm text-stone-500 font-semibold mt-0.5">
                                        {activeStakeholder.role_desc}
                                    </p>
                                </div>
                            </div>

                            <span className="self-start sm:self-auto text-xs font-black px-3.5 py-1.5 rounded-full bg-rose-100 text-[#881337] border border-rose-200 uppercase tracking-wider">
                                আইনি সুবিধা
                            </span>
                        </div>

                        {/* Benefits Checklist */}
                        <div className="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                            {activeStakeholder.benefits.map((point, pIdx) => (
                                <div
                                    key={pIdx}
                                    className="p-4 rounded-2xl bg-white border border-stone-200/90 shadow-xs flex items-start gap-3 group hover:border-rose-300 transition"
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