import React from 'react';
import { Truck, ShieldCheck, RotateCcw, Zap, Lock } from 'lucide-react';

export default function TrustGuarantees({ guarantees = [] }) {
    if (!guarantees.length) return null;

    const getIcon = (iconName) => {
        switch (iconName) {
            case 'Truck': return <Truck className="w-5 h-5 text-orange-600" />;
            case 'ShieldCheck': return <ShieldCheck className="w-5 h-5 text-emerald-600" />;
            case 'RotateCcw': return <RotateCcw className="w-5 h-5 text-blue-600" />;
            case 'Zap': return <Zap className="w-5 h-5 text-amber-500 fill-amber-500" />;
            case 'Lock': return <Lock className="w-5 h-5 text-purple-600" />;
            default: return <ShieldCheck className="w-5 h-5 text-emerald-600" />;
        }
    };

    return (
        <section aria-label="Customer Guarantees" className="max-w-7xl mx-auto px-4 sm:px-6 py-3">
            <div className="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200/90 shadow-xs grid grid-cols-2 md:grid-cols-5 gap-4">
                {guarantees.map((item) => (
                    <div 
                        key={item.id}
                        className="flex items-center gap-3 p-2 rounded-xl hover:bg-slate-50 transition-colors"
                    >
                        <div className="w-10 h-10 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center shrink-0 shadow-2xs">
                            {getIcon(item.icon)}
                        </div>
                        <div className="min-w-0">
                            <h3 className="text-xs font-black text-slate-900 truncate">
                                {item.title}
                            </h3>
                            <p className="text-[10px] text-slate-500 font-semibold line-clamp-1 mt-0.5">
                                {item.subtitle}
                            </p>
                        </div>
                    </div>
                ))}
            </div>
        </section>
    );
}
