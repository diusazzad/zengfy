import React from 'react';
import { Key, MapPin, ShieldCheck, Cpu } from 'lucide-react';

export default function SecuritySection({ features = [] }) {
    const iconMap = {
        key: <Key className="w-6 h-6 text-blue-600" />,
        'map-pin': <MapPin className="w-6 h-6 text-indigo-600" />,
        'shield-check': <ShieldCheck className="w-6 h-6 text-emerald-600" />,
        'cpu-chip': <Cpu className="w-6 h-6 text-cyan-600" />,
    };

    return (
        <section id="security-section" className="pt-16 sm:pt-20 pb-20 sm:pb-28 border-t border-slate-200/70">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                {/* Section Header */}
                <div className="text-center max-w-3xl mx-auto mb-14">
                    <span className="text-xs uppercase font-extrabold tracking-widest text-blue-600 bg-blue-50 px-3 py-1 rounded-full border border-blue-200/60">
                        Sovereign Architecture
                    </span>
                    <h2 className="text-3xl sm:text-5xl font-black text-slate-900 tracking-tight mt-4">
                        Built for Privacy, Scaled for Nations.
                    </h2>
                    <p className="text-sm sm:text-base text-slate-600 mt-3 leading-relaxed">
                        Zengfy is designed from the ground up as a decentralized, sovereign digital ecosystem that puts citizen privacy and data ownership first.
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

                                <span className="text-[10px] font-bold uppercase tracking-wider text-blue-600 px-2 py-0.5 rounded-full bg-blue-50 border border-blue-200/60">
                                    {feat.tag}
                                </span>

                                <h3 className="text-lg font-black text-slate-900 mt-3">
                                    {feat.title}
                                </h3>

                                <p className="text-xs text-slate-600 mt-2.5 leading-relaxed">
                                    {feat.description}
                                </p>
                            </div>

                            <div className="pt-4 mt-6 border-t border-slate-200/60 flex items-center gap-2 text-[11px] font-bold text-emerald-600">
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