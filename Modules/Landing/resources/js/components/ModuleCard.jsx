import React from "react";
import { ArrowUpRight } from "lucide-react";

export default function ModuleCard({ module }) {
    const getBadgeStyle = (badge) => {
        if (!badge) return "bg-white/10 text-gray-300 border-white/10";
        if (badge.includes("Active"))
            return "bg-emerald-500/10 text-emerald-400 border-emerald-500/20";
        if (badge.includes("Enterprise"))
            return "bg-blue-500/10 text-blue-400 border-blue-500/20";
        if (badge.includes("Retail") || badge.includes("Online"))
            return "bg-amber-500/10 text-amber-400 border-amber-500/20";
        if (badge.includes("Vault") || badge.includes("Specialized"))
            return "bg-indigo-500/10 text-indigo-400 border-indigo-500/20";
        return "bg-cyan-500/10 text-cyan-400 border-cyan-500/20";
    };

    return (
        <div className="group relative bg-[#121A29] hover:bg-[#162134] border border-white/[0.08] hover:border-cyan-500/40 rounded-2xl p-5 shadow-xl transition-all duration-200 flex flex-col justify-between overflow-hidden">
            {/* Top Accent Line */}
            <div className="absolute top-0 left-0 right-0 h-0.5 bg-gradient-to-r from-transparent via-cyan-500/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity" />

            <div>
                {/* Header: Icon, Category & Status Badge */}
                <div className="flex items-start justify-between gap-2 mb-3">
                    <div className="flex items-center gap-3">
                        <div className="w-12 h-12 rounded-2xl bg-white/[0.04] border border-white/[0.08] group-hover:border-cyan-400/30 flex items-center justify-center text-2xl shadow-inner group-hover:scale-105 transition-transform shrink-0">
                            {module.icon || "📱"}
                        </div>
                        <div className="overflow-hidden">
                            <h3 className="text-base font-extrabold text-white group-hover:text-cyan-300 transition-colors truncate">
                                {module.name}
                            </h3>
                            <span className="text-[11px] font-semibold text-gray-400 truncate block">
                                {module.category}
                            </span>
                        </div>
                    </div>

                    {module.badge && (
                        <span
                            className={`px-2 py-0.5 rounded-full border text-[10px] font-extrabold shrink-0 ${getBadgeStyle(module.badge)}`}
                        >
                            {module.badge}
                        </span>
                    )}
                </div>

                {/* Tagline */}
                <p className="text-xs font-bold text-gray-200 mb-2 leading-snug">
                    {module.tagline}
                </p>

                {/* Description */}
                <p className="text-xs text-gray-400 leading-relaxed line-clamp-3 mb-4">
                    {module.desc}
                </p>
            </div>

            {/* Launch Action */}
            <div className="pt-3 border-t border-white/[0.06] flex items-center justify-between">
                <span className="text-[11px] font-mono text-gray-500 truncate max-w-[150px]">
                    {module.url ? module.url.replace(/^https?:\/\//, "") : ""}
                </span>

                <a
                    href={module.url}
                    target="_blank"
                    rel="noopener noreferrer"
                    className="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white/[0.05] hover:bg-cyan-500/20 border border-white/[0.1] hover:border-cyan-500/40 text-xs font-bold text-gray-200 hover:text-cyan-300 active:scale-95 transition-all"
                >
                    <span>Launch</span>
                    <ArrowUpRight className="w-3.5 h-3.5" />
                </a>
            </div>
        </div>
    );
}
