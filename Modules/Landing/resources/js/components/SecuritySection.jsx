import React from 'react';
import { Key, MapPin, ShieldCheck, Cpu } from 'lucide-react';

export default function SecuritySection({ features = [] }) {
    const iconMap = {
        key: <Key className="w-5 h-5 sm:w-6 sm:h-6 text-blue-600" />,
        'map-pin': <MapPin className="w-5 h-5 sm:w-6 sm:h-6 text-indigo-600" />,
        'shield-check': <ShieldCheck className="w-5 h-5 sm:w-6 sm:h-6 text-emerald-600" />,
        'cpu-chip': <Cpu className="w-5 h-5 sm:w-6 sm:h-6 text-cyan-600" />,
    };

    return (
        <section id="security-section" className="pt-12 sm:pt-20 pb-16 sm:pb-24 border-t border-slate-200/70">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                {/* Section Header */}
                <div className="text-center max-w-3xl mx-auto mb-8 sm:mb-14">
                    <span className="text-xs uppercase font-extrabold tracking-widest text-blue-600 bg-blue-50 px-3 py-1 rounded-full border border-blue-200/60">
                        Sovereign Architecture
                    </span>
                    <h2 className="text-2xl sm:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight mt-3 sm:mt-4">
                        Built for Privacy, Scaled for Nations.
                    </h2>
                    <p className="text-xs sm:text-base text-slate-600 mt-2 sm:mt-3 leading-relaxed">
                        Zengfy is designed from the ground up as a decentralized, sovereign digital ecosystem that puts citizen privacy and data ownership first.
                    </p>
                </div>

                {/* 4 Feature Cards (Compact on mobile) */}
                <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3.5 sm:gap-6">
                    {features.map((feat) => (
                        <div
                            key={feat.key}
                            className="glass-card rounded-2xl sm:rounded-3xl p-4 sm:p-6 flex flex-col justify-between border border-slate-200/80 shadow-xs hover:shadow-md transition-all"
                        >
                            <div>
                                <div className="flex items-center justify-between mb-3">
                                    <div className="w-10 h-10 sm:w-12 sm:h-12 rounded-xl sm:rounded-2xl bg-white border border-slate-200/90 shadow-2xs flex items-center justify-center">
                                        {iconMap[feat.icon] || <ShieldCheck className="w-5 h-5 sm:w-6 sm:h-6 text-blue-600" />}
                                    </div>
                                    <span className="text-[10px] font-bold uppercase tracking-wider text-blue-600 px-2 py-0.5 rounded-full bg-blue-50 border border-blue-200/60">
                                        {feat.tag}
                                    </span>
                                </div>

                                <h3 className="text-base sm:text-lg font-black text-slate-900 mt-1">
                                    {feat.title}
                                </h3>

                                <p className="text-xs text-slate-600 mt-1.5 leading-relaxed">
                                    {feat.description}
                                </p>
                            </div>

                            <div className="pt-3 mt-4 border-t border-slate-200/60 flex items-center gap-2 text-[11px] font-bold text-emerald-600">
                                <span className="w-1.5 h-1.5 rounded-full bg-emerald-500" />
                                <span>Zero Backdoors</span>
                            </div>
                        </div>
                    ))}
                </div>

            </div>
        </section>
    );
}
