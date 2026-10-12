import React from "react";
import {
    ShieldCheck,
    Download,
    Grid,
    ArrowRight,
    Activity,
    Users,
    MapPin,
    Building,
    Cpu,
} from "lucide-react";

export default function EcosystemHero({
    ecosystem = {},
    stats = {},
    links = {},
    onExploreApps,
}) {
    const statCards = [
        {
            label: "Verified Citizens",
            value: `${stats.verified_citizens || 1480}+`,
            subtitle: "Smart NID Authenticated",
            icon: Users,
            color: "text-blue-400 bg-blue-500/10 border-blue-500/20",
        },
        {
            label: "Nationwide Wards",
            value: stats.total_wards || 4554,
            subtitle: "Hyperlocal Mesh",
            icon: MapPin,
            color: "text-cyan-400 bg-cyan-500/10 border-cyan-500/20",
        },
        {
            label: "Active Institutions",
            value: `${stats.active_institutions || 540}+`,
            subtitle: "Schools & Legal Vaults",
            icon: Building,
            color: "text-amber-400 bg-amber-500/10 border-amber-500/20",
        },
        {
            label: "System Uptime",
            value: stats.system_uptime || "99.98%",
            subtitle: "Decentralized Availability",
            icon: Activity,
            color: "text-emerald-400 bg-emerald-500/10 border-emerald-500/20",
        },
        {
            label: "Micro-SaaS Apps",
            value: stats.total_modules || 13,
            subtitle: "Zero-Knowledge Provisioning",
            icon: Cpu,
            color: "text-indigo-400 bg-indigo-500/10 border-indigo-500/20",
        },
    ];

    return (
        <section className="relative pt-6 sm:pt-10 pb-8 sm:pb-12 overflow-hidden">
            {/* Ambient Glowing Spotlights */}
            <div className="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[350px] bg-gradient-to-b from-blue-600/15 via-cyan-500/10 to-transparent blur-3xl pointer-events-none -z-10" />

            <div className="max-w-4xl mx-auto text-center px-4">
                {/* 1. Dynamic Badge Pill */}
                <div className="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-500/10 border border-blue-500/20 shadow-sm mb-5 animate-in fade-in">
                    <span className="text-sm">🇧🇩</span>
                    <span className="text-xs font-bold text-cyan-300">
                        Bangladesh's Sovereign Digital Infrastructure
                    </span>
                </div>

                {/* 2. Bold Headline */}
                <h1 className="text-3xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight leading-[1.15] mb-4 sm:mb-6">
                    Speak Freely. <br className="hidden sm:inline" />
                    <span className="bg-gradient-to-r from-blue-400 via-indigo-300 to-cyan-400 bg-clip-text text-transparent">
                        One Unified Sovereign Account.
                    </span>
                </h1>

                {/* 3. Subtitle */}
                <p className="text-sm sm:text-base lg:text-lg text-gray-300 max-w-2xl mx-auto leading-relaxed mb-8">
                    {ecosystem.description ||
                        "Connect to 13 unified micro-SaaS platforms—from hyperlocal social feeds and institutional school ERP to legal vaults and retail POS—all powered by single-sign-on NID verification."}
                </p>

                {/* 4. Hero Action Buttons */}
                <div className="flex flex-wrap items-center justify-center gap-3 sm:gap-4 mb-10">
                    <button
                        type="button"
                        onClick={onExploreApps}
                        className="w-full sm:w-auto px-6 py-3.5 rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white text-xs sm:text-sm font-extrabold shadow-xl shadow-blue-600/30 active:scale-95 transition-all flex items-center justify-center gap-2 cursor-pointer"
                    >
                        <Grid className="w-4 h-4" />
                        <span>Explore 13 Apps</span>
                        <ArrowRight className="w-4 h-4 ml-1" />
                    </button>

                    <a
                        href={links.download || "/download"}
                        className="w-full sm:w-auto px-5 py-3.5 rounded-2xl bg-[#121A29] hover:bg-[#182236] border border-white/[0.12] text-gray-200 text-xs sm:text-sm font-bold shadow-lg active:scale-95 transition-all flex items-center justify-center gap-2"
                    >
                        <Download className="w-4 h-4 text-cyan-400" />
                        <span>Download Android APK</span>
                    </a>

                    <a
                        href={links.register || "/register"}
                        className="w-full sm:w-auto px-5 py-3.5 rounded-2xl bg-white/[0.04] hover:bg-white/[0.08] border border-white/[0.08] text-cyan-300 text-xs sm:text-sm font-bold active:scale-95 transition-all flex items-center justify-center gap-2"
                    >
                        <ShieldCheck className="w-4 h-4 text-cyan-400" />
                        <span>Get Sovereign ID</span>
                    </a>
                </div>
            </div>

            {/* 5. Responsive Ecosystem Stats Strip */}
            <div className="max-w-6xl mx-auto px-4 mt-2">
                <div className="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-4">
                    {statCards.map((s, idx) => {
                        const Icon = s.icon;
                        return (
                            <div
                                key={idx}
                                className="bg-[#121A29] border border-white/[0.08] hover:border-white/[0.18] rounded-2xl p-4 shadow-xl transition-all"
                            >
                                <div className="flex items-center justify-between mb-2">
                                    <span className="text-[10px] font-bold text-gray-400 uppercase tracking-wider">
                                        {s.label}
                                    </span>
                                    <div
                                        className={`p-1.5 rounded-lg border ${s.color}`}
                                    >
                                        <Icon className="w-3.5 h-3.5" />
                                    </div>
                                </div>
                                <div className="text-xl sm:text-2xl font-black text-white tracking-tight">
                                    {s.value}
                                </div>
                                <div className="text-[11px] text-gray-400 font-medium truncate mt-0.5">
                                    {s.subtitle}
                                </div>
                            </div>
                        );
                    })}
                </div>
            </div>
        </section>
    );
}
