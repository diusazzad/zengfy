import React from 'react';
import { Sparkles, ShieldCheck, MapPin, Lock, Check } from 'lucide-react';

export default function SocialPillarsSection({ features = [] }) {
    const iconMap = {
        sparkles: <Sparkles className="w-6 h-6 text-blue-600" />,
        'shield-check': <ShieldCheck className="w-6 h-6 text-emerald-600" />,
        'map-pin': <MapPin className="w-6 h-6 text-indigo-600" />,
        lock: <Lock className="w-6 h-6 text-cyan-600" />,
    };

    return (
        <section id="social-pillars-section" aria-label="Sovereign Social Pillars" className="pt-10 pb-20 border-t border-slate-200/70">
            <div className="max-w-6xl mx-auto px-4 sm:px-6">
                
                {/* Section Header */}
                <div className="text-center max-w-3xl mx-auto mb-14">
                    <span className="text-xs uppercase font-extrabold tracking-widest text-blue-600 bg-blue-50 px-3 py-1 rounded-full border border-blue-200/70">
                        Civic Architecture
                    </span>
                    <h2 className="text-3xl sm:text-5xl font-black text-slate-900 tracking-tight mt-3">
                        Why Bangladesh Needs Zengfy Social.
                    </h2>
                    <p className="text-sm sm:text-base text-slate-600 mt-3 leading-relaxed">
                        Commercial platforms profit from polarization, viral outrage, and selling your personal messages to ad networks. Zengfy Social changes the paradigm forever.
                    </p>
                </div>

                {/* 4 Feature Cards */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    {features.map((feat) => (
                        <div
                            key={feat.key}
                            className="glass-card rounded-3xl p-6 sm:p-7 flex flex-col justify-between"
                        >
                            <div>
                                <div className="w-12 h-12 rounded-2xl bg-white border border-slate-200/90 shadow-2xs flex items-center justify-center mb-5">
                                    {iconMap[feat.icon] || <ShieldCheck className="w-6 h-6 text-blue-600" />}
                                </div>

                                <span className="text-[10px] font-bold uppercase tracking-wider text-blue-600 px-2.5 py-1 rounded-full bg-blue-50 border border-blue-200/60">
                                    {feat.tag}
                                </span>

                                <h3 className="text-lg font-black text-slate-900 mt-3.5">
                                    {feat.title}
                                </h3>

                                <p className="text-xs text-slate-600 mt-2.5 leading-relaxed">
                                    {feat.description}
                                </p>
                            </div>

                            <div className="pt-4 mt-6 border-t border-slate-200/60 flex items-center gap-1.5 text-[11px] font-bold text-emerald-600">
                                <Check className="w-3.5 h-3.5" />
                                <span>Sovereign Standard</span>
                            </div>
                        </div>
                    ))}
                </div>

            </div>
        </section>
    );
}
