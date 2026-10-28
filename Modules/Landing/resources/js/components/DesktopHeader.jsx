import React from "react";
import { Search, Shield, ArrowUpRight, Lock } from "lucide-react";

export default function DesktopHeader({
    activeTab,
    setActiveTab,
    searchQuery,
    setSearchQuery,
    links = {},
}) {
    return (
        <header className="hidden md:block sticky top-0 z-40 bg-[#0B0F17]/85 backdrop-blur-xl border-b border-white/[0.08] shadow-2xl">
            <div className="max-w-7xl mx-auto px-6 h-18 flex items-center justify-between gap-6">
                {/* Brand Logo & Mesh Indicator */}
                <div className="flex items-center gap-4">
                    <a
                        href={links.home || "/"}
                        className="flex items-center gap-3 group"
                    >
                        <div className="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 via-indigo-600 to-cyan-400 flex items-center justify-center font-black text-lg text-white shadow-lg shadow-blue-500/25 group-hover:scale-105 transition-transform">
                            Z
                        </div>
                        <div>
                            <div className="flex items-center gap-1.5">
                                <span className="text-xl font-extrabold tracking-tight text-white">
                                    Zengfy
                                </span>
                                <span className="text-xl font-black text-cyan-400">
                                    .
                                </span>
                                <span className="text-xs px-2 py-0.5 rounded-full bg-cyan-500/10 border border-cyan-500/20 text-cyan-300 font-semibold ml-1">
                                    Ecosystem
                                </span>
                            </div>
                            <p className="text-[11px] text-gray-400 font-medium">
                                Sovereign Micro-SaaS Mesh
                            </p>
                        </div>
                    </a>

                    <div className="hidden lg:flex items-center gap-2 pl-4 border-l border-white/[0.08]">
                        <span className="w-2 h-2 rounded-full bg-emerald-400 animate-pulse" />
                        <span className="text-xs font-semibold text-emerald-400">
                            13 Apps Active
                        </span>
                    </div>
                </div>

                {/* Middle: Tab Navigation & Search */}
                <div className="flex items-center gap-4 flex-1 max-w-xl justify-center">
                    {/* Navigation Pills */}
                    <nav className="flex items-center p-1 rounded-xl bg-white/[0.03] border border-white/[0.06]">
                        <button
                            type="button"
                            onClick={() => setActiveTab("home")}
                            className={`px-3.5 py-1.5 rounded-lg text-xs font-bold transition-all ${
                                activeTab === "home"
                                    ? "bg-blue-600 text-white shadow-md shadow-blue-600/30"
                                    : "text-gray-400 hover:text-white"
                            }`}
                        >
                            Overview
                        </button>
                        <button
                            type="button"
                            onClick={() => setActiveTab("apps")}
                            className={`px-3.5 py-1.5 rounded-lg text-xs font-bold transition-all flex items-center gap-1.5 ${
                                activeTab === "apps"
                                    ? "bg-blue-600 text-white shadow-md shadow-blue-600/30"
                                    : "text-gray-400 hover:text-white"
                            }`}
                        >
                            <span>13 Micro-SaaS</span>
                            <span className="px-1.5 py-0.2 rounded-full bg-white/20 text-[10px] leading-tight">
                                13
                            </span>
                        </button>
                        <button
                            type="button"
                            onClick={() => setActiveTab("security")}
                            className={`px-3.5 py-1.5 rounded-lg text-xs font-bold transition-all ${
                                activeTab === "security"
                                    ? "bg-blue-600 text-white shadow-md shadow-blue-600/30"
                                    : "text-gray-400 hover:text-white"
                            }`}
                        >
                            Security & SSO
                        </button>
                    </nav>

                    {/* Integrated Search Input */}
                    <div className="relative w-52 focus-within:w-64 transition-all">
                        <Search className="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400" />
                        <input
                            type="text"
                            value={searchQuery}
                            onChange={(e) => setSearchQuery(e.target.value)}
                            placeholder="Find apps..."
                            className="w-full bg-[#121A29] border border-white/[0.08] hover:border-white/[0.15] focus:border-cyan-400 rounded-xl pl-8 pr-3 py-1.5 text-xs text-white placeholder-gray-500 focus:outline-none transition"
                        />
                    </div>
                </div>

                {/* Right: SSO Action Buttons */}
                <div className="flex items-center gap-3">
                    <a
                        href={
                        typeof window !== 'undefined' &&
                        (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') &&
                        links.login?.includes('zengfy.top')
                            ? '/login'
                            : (links.login || '/login')
                    }
                        className="px-4 py-2 rounded-xl text-xs font-bold text-gray-300 hover:text-white hover:bg-white/[0.05] transition flex items-center gap-1.5"
                    >
                        <Lock className="w-3.5 h-3.5 text-gray-400" />
                        <span>Sign In</span>
                    </a>

                    <a
                        href={
                        typeof window !== 'undefined' &&
                        (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') &&
                        links.register?.includes('zengfy.top')
                            ? '/register'
                            : (links.register || '/register')
                    }
                        className="px-4 py-2 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white text-xs font-extrabold shadow-lg shadow-blue-600/30 active:scale-95 transition-all flex items-center gap-1.5"
                    >
                        <Shield className="w-3.5 h-3.5" />
                        <span>Get Citizen ID</span>
                    </a>
                </div>
            </div>
        </header>
    );
}
