import React from "react";
import { Home, Grid, Shield, User } from "lucide-react";

export default function MobileBottomNav({ activeTab, setActiveTab }) {
    const tabs = [
        { id: "home", label: "Home", icon: Home },
        { id: "apps", label: "13 Apps", icon: Grid, badge: "13" },
        { id: "security", label: "Security", icon: Shield },
        { id: "account", label: "Account", icon: User },
    ];

    return (
        <nav
            role="navigation"
            aria-label="Mobile Bottom Navigation"
            className="fixed bottom-0 left-0 right-0 z-50 bg-[#0B0F17]/95 backdrop-blur-2xl border-t border-white/[0.08] shadow-[0_-8px_30px_rgba(0,0,0,0.6)] md:hidden safe-area-bottom"
        >
            <div className="grid grid-cols-4 items-center h-16 px-1">
                {tabs.map((tab) => {
                    const Icon = tab.icon;
                    const isActive = activeTab === tab.id;

                    return (
                        <button
                            key={tab.id}
                            type="button"
                            onClick={() => {
                                setActiveTab(tab.id);
                                window.scrollTo({ top: 0, behavior: "smooth" });
                            }}
                            className="relative flex flex-col items-center justify-center h-full min-h-[48px] py-1 select-none active:scale-95 transition-transform"
                        >
                            {/* Active Top Bar Indicator */}
                            {isActive && (
                                <span className="absolute top-0 w-8 h-1 rounded-full bg-gradient-to-r from-blue-500 to-cyan-400 shadow-sm shadow-cyan-400/50" />
                            )}

                            {/* Icon with Badge */}
                            <div className="relative mt-1">
                                <Icon
                                    className={`w-5 h-5 transition-colors ${
                                        isActive
                                            ? "text-cyan-400"
                                            : "text-gray-400"
                                    }`}
                                />
                                {tab.badge && !isActive && (
                                    <span className="absolute -top-1 -right-2 px-1 py-0.2 rounded-full bg-blue-600 text-[9px] font-extrabold text-white leading-none">
                                        {tab.badge}
                                    </span>
                                )}
                            </div>

                            {/* Label */}
                            <span
                                className={`text-[11px] font-semibold mt-1 tracking-tight transition-colors ${
                                    isActive
                                        ? "text-white font-bold"
                                        : "text-gray-400"
                                }`}
                            >
                                {tab.label}
                            </span>
                        </button>
                    );
                })}
            </div>
        </nav>
    );
}
