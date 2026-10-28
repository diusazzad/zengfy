import React from "react";
import { Search, MapPin, ShieldCheck, X } from "lucide-react";

export default function MobileAppBar({
    searchOpen,
    setSearchOpen,
    searchQuery,
    setSearchQuery,
    wardCode = "WARD-DHAKA-19",
    onAccountClick,
}) {
    return (
        <header className="sticky top-0 z-40 bg-[#0B0F17]/90 backdrop-blur-xl border-b border-white/[0.08] px-4 py-3 md:hidden">
            <div className="flex items-center justify-between gap-3">
                {/* Brand Logo & Title */}
                <div className="flex items-center gap-2.5">
                    <div className="w-8 h-8 rounded-xl bg-gradient-to-tr from-blue-600 via-indigo-600 to-cyan-400 flex items-center justify-center font-black text-sm text-white shadow-md shadow-blue-500/25">
                        Z
                    </div>
                    <div>
                        <h1 className="text-base font-extrabold tracking-tight text-white leading-tight">
                            Zengfy<span className="text-cyan-400">.</span>
                        </h1>
                        <p className="text-[10px] text-gray-400 font-medium leading-none">
                            Sovereign Ecosystem
                        </p>
                    </div>
                </div>

                {/* Right Controls: Ward Badge, Search Trigger, Citizen Avatar */}
                <div className="flex items-center gap-2">
                    {/* Ward Pill */}
                    <div className="flex items-center gap-1 px-2.5 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-cyan-300 text-[11px] font-semibold">
                        <MapPin className="w-3 h-3 text-cyan-400 shrink-0" />
                        <span className="truncate max-w-[85px]">Ward 19</span>
                    </div>

                    {/* Search Toggle */}
                    <button
                        type="button"
                        onClick={() => setSearchOpen(!searchOpen)}
                        aria-label="Toggle search"
                        className="w-8 h-8 rounded-xl bg-white/[0.05] border border-white/[0.08] flex items-center justify-center text-gray-300 hover:text-white active:scale-95 transition"
                    >
                        {searchOpen ? (
                            <X className="w-4 h-4" />
                        ) : (
                            <Search className="w-4 h-4" />
                        )}
                    </button>

                    {/* Sovereign Account Trigger */}
                    <button
                        type="button"
                        onClick={onAccountClick}
                        aria-label="Account details"
                        className="w-8 h-8 rounded-xl bg-gradient-to-tr from-cyan-500/20 to-blue-500/20 border border-cyan-500/30 flex items-center justify-center text-cyan-300 active:scale-95 transition"
                    >
                        <ShieldCheck className="w-4 h-4" />
                    </button>
                </div>
            </div>

            {/* Quick Search Slideout (Mobile) */}
            {searchOpen && (
                <div className="mt-2.5 pt-2 border-t border-white/[0.06] animate-in fade-in duration-150">
                    <div className="relative">
                        <Search className="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" />
                        <input
                            type="text"
                            value={searchQuery}
                            onChange={(e) => setSearchQuery(e.target.value)}
                            placeholder="Search 13 apps (e.g. Social, School, POS, Law)..."
                            autoFocus
                            className="w-full bg-[#121A29] border border-white/[0.12] rounded-xl pl-9 pr-8 py-2 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-cyan-400 transition"
                        />
                        {searchQuery && (
                            <button
                                type="button"
                                onClick={() => setSearchQuery("")}
                                className="absolute right-2.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-white"
                            >
                                <X className="w-3.5 h-3.5" />
                            </button>
                        )}
                    </div>
                </div>
            )}
        </header>
    );
}
