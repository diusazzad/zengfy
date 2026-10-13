import React from 'react';
import { Layers, ShieldCheck, Scissors, RotateCcw } from 'lucide-react';

export default function AtelierPillars({ pillars = [] }) {
    const getPillarIcon = (name) => {
        switch (name) {
            case 'Layers': return <Layers className="w-6 h-6 text-slate-900" />;
            case 'ShieldCheck': return <ShieldCheck className="w-6 h-6 text-slate-900" />;
            case 'Scissors': return <Scissors className="w-6 h-6 text-slate-900" />;
            case 'RotateCcw': return <RotateCcw className="w-6 h-6 text-slate-900" />;
            default: return <ShieldCheck className="w-6 h-6 text-slate-900" />;
        }
    };

    if (!pillars.length) return null;

    return (
        <section className="bg-slate-100 py-16 border-y border-slate-200">
            <div className="max-w-7xl mx-auto px-4 sm:px-6">
                <div className="text-center max-w-xl mx-auto mb-12">
                    <span className="text-[10px] font-black uppercase tracking-[0.25em] text-slate-400">
                        ATELIER STANDARDS
                    </span>
                    <h2 className="text-2xl sm:text-3xl font-black text-slate-950 tracking-tight uppercase font-mono mt-1">
                        কেন আমাদের পোশাক আলাদা?
                    </h2>
                </div>

                <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    {pillars.map((pil, idx) => (
                        <div 
                            key={idx}
                            className="bg-white p-6 rounded-2xl border border-slate-200/90 shadow-sm flex flex-col justify-between"
                        >
                            <div className="w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center mb-4">
                                {getPillarIcon(pil.icon)}
                            </div>
                            <div>
                                <h3 className="text-sm font-bold text-slate-950 font-mono mb-2">
                                    {pil.title}
                                </h3>
                                <p className="text-xs text-slate-600 leading-relaxed">
                                    {pil.desc}
                                </p>
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </section>
    );
}
