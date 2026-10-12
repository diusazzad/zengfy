import React, { useState, useRef, useEffect } from 'react';
import { ChevronRight, ShoppingBag } from 'lucide-react';

export default function POSNavbar({ links = {}, onNavigateSection }) {
    const [waffleOpen, setWaffleOpen] = useState(false);
    const waffleRef = useRef(null);

    // Close waffle menu on outside click or Esc
    useEffect(() => {
        function handleClickOutside(e) {
            if (waffleRef.current && !waffleRef.current.contains(e.target)) {
                setWaffleOpen(false);
            }
        }
        function handleKeyDown(e) {
            if (e.key === 'Escape') setWaffleOpen(false);
        }
        document.addEventListener('mousedown', handleClickOutside);
        document.addEventListener('keydown', handleKeyDown);
        return () => {
            document.removeEventListener('mousedown', handleClickOutside);
            document.removeEventListener('keydown', handleKeyDown);
        };
    }, []);

    const apps = [
        { name: 'POS', icon: '🛒', url: links.home || 'http://pos.zengfy.test:8000/', category: 'Boutique & Retail', active: true },
        { name: 'Social', icon: '🌐', url: links.social || 'http://social.zengfy.test:8000/', category: 'Civic Mesh' },
        { name: 'School', icon: '🏫', url: links.school || 'http://school.zengfy.test:8000/', category: 'Campus ERP' },
        { name: 'Commerce', icon: '🛍️', url: 'http://shop.zengfy.test:8000/', category: 'Online Store' },
        { name: 'Law', icon: '⚖️', url: 'http://law.zengfy.test:8000/', category: 'Legal Vault' },
        { name: 'Rent', icon: '🏠', url: 'http://rent.zengfy.test:8000/', category: 'Property Hub' },
        { name: 'Hotel', icon: '🏨', url: 'http://hotel.zengfy.test:8000/', category: 'Hospitality' },
        { name: 'NGO', icon: '❤️', url: 'http://ngo.zengfy.test:8000/', category: 'Charity Cloud' },
        { name: 'Account', icon: '🛡️', url: links.master_landing ? `${links.master_landing}account` : 'http://zengfy.test:8000/account', category: 'Citizen SSO' },
    ];

    return (
        <header role="banner" className="sticky top-0 z-50 bg-white/85 backdrop-blur-2xl border-b border-slate-200/80 shadow-xs transition-all duration-300">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-18 sm:h-20 flex items-center justify-between">
                
                {/* Brand Logo */}
                <a href={links.home || "/"} aria-label="Zengfy POS Home" className="flex items-center gap-3 group shrink-0">
                    <div aria-hidden="true" className="w-10 h-10 rounded-2xl bg-gradient-to-tr from-amber-600 via-orange-600 to-rose-600 flex items-center justify-center font-black text-xl text-white shadow-md shadow-orange-500/20 group-hover:scale-105 transition-transform">
                        🛒
                    </div>
                    <div className="flex flex-col">
                        <div className="flex items-center gap-1.5">
                            <span className="text-xl sm:text-2xl font-black tracking-tight text-slate-900 group-hover:text-amber-700 transition-colors">
                                Zengfy<span className="text-amber-600">.</span>
                            </span>
                            <span className="text-[11px] font-bold text-amber-700 bg-amber-50 border border-amber-200/80 px-2.5 py-0.5 rounded-full uppercase tracking-wider">
                                POS Retail
                            </span>
                        </div>
                    </div>
                </a>

                {/* Right: Google-style 9-Dot Waffle Menu + Sign In CTA */}
                <div className="flex items-center gap-3">
                    
                    {/* 9-Dot Waffle Apps Menu Wrapper */}
                    <div className="relative" ref={waffleRef}>
                        <button
                            type="button"
                            onClick={() => setWaffleOpen(!waffleOpen)}
                            aria-expanded={waffleOpen}
                            aria-haspopup="dialog"
                            aria-label="Open Zengfy Apps Launcher"
                            title="Zengfy Apps Launcher"
                            className={`w-11 h-11 rounded-2xl flex items-center justify-center border transition-all cursor-pointer ${
                                waffleOpen
                                    ? 'bg-amber-50 border-amber-300 text-amber-700 ring-2 ring-amber-500/20 shadow-md'
                                    : 'bg-white hover:bg-slate-50 border-slate-200 text-slate-700 hover:text-amber-700 shadow-xs'
                            }`}
                        >
                            <svg className="w-5 h-5 pointer-events-none" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <circle cx="5" cy="5" r="2.2" />
                                <circle cx="12" cy="5" r="2.2" />
                                <circle cx="19" cy="5" r="2.2" />
                                <circle cx="5" cy="12" r="2.2" />
                                <circle cx="12" cy="12" r="2.2" />
                                <circle cx="19" cy="12" r="2.2" />
                                <circle cx="5" cy="19" r="2.2" />
                                <circle cx="12" cy="19" r="2.2" />
                                <circle cx="19" cy="19" r="2.2" />
                            </svg>
                        </button>

                        {/* Dropdown Modal Container */}
                        {waffleOpen && (
                            <div
                                role="dialog"
                                aria-label="Zengfy Ecosystem Services Grid"
                                className="fixed left-3.5 right-3.5 top-20 sm:absolute sm:left-auto sm:right-0 sm:top-full sm:mt-2.5 sm:w-[380px] max-h-[85vh] overflow-y-auto bg-white/95 backdrop-blur-2xl border border-slate-200/90 rounded-3xl shadow-2xl p-4 sm:p-5 z-50 animate-in fade-in zoom-in-95 duration-150"
                            >
                                <div className="flex items-center justify-between pb-3 mb-3 border-b border-slate-100">
                                    <span className="text-xs font-black tracking-wider text-slate-400 uppercase">
                                        Zengfy Sovereign Mesh
                                    </span>
                                    <span className="text-[11px] font-bold text-amber-700 bg-amber-50 px-2 py-0.5 rounded-full border border-amber-100">
                                        13 Micro-SaaS
                                    </span>
                                </div>

                                {/* 3x3 Grid of 9 Primary Apps */}
                                <div className="grid grid-cols-3 gap-2 sm:gap-2.5">
                                    {apps.map((item) => (
                                        <a
                                            key={item.name}
                                            href={item.url}
                                            className={`flex flex-col items-center p-2.5 rounded-2xl border transition-all text-center group ${
                                                item.active
                                                    ? 'bg-amber-50/80 border-amber-200 shadow-xs'
                                                    : 'bg-slate-50/70 hover:bg-amber-50/50 border-slate-100 hover:border-amber-200/60'
                                            }`}
                                        >
                                            <div className="w-11 h-11 rounded-2xl bg-white border border-slate-200/60 shadow-xs flex items-center justify-center text-xl group-hover:scale-110 group-hover:shadow-md transition-all">
                                                {item.icon}
                                            </div>
                                            <span className="mt-2 text-xs font-bold text-slate-800 group-hover:text-amber-700 transition-colors truncate w-full">
                                                {item.name}
                                            </span>
                                            <span className="text-[10px] text-slate-400 truncate w-full">
                                                {item.category}
                                            </span>
                                        </a>
                                    ))}
                                </div>

                                <div className="mt-3.5 pt-3 border-t border-slate-100 text-center">
                                    <a
                                        href={links.master_landing || "http://zengfy.test:8000/"}
                                        className="text-xs font-bold text-amber-700 hover:text-amber-800 transition-colors inline-flex items-center gap-1.5 py-1"
                                    >
                                        <span>Master Ecosystem Directory</span>
                                        <ChevronRight className="w-3.5 h-3.5" />
                                    </a>
                                </div>
                            </div>
                        )}
                    </div>

                    {/* Sign In CTA */}
                    <a
                        href={links.login || "/login"}
                        className="inline-flex items-center gap-2 px-5 sm:px-6 py-2.5 rounded-full bg-gradient-to-r from-amber-600 via-orange-600 to-rose-600 hover:from-amber-700 hover:to-rose-700 text-white font-bold text-xs sm:text-sm shadow-md shadow-orange-500/20 hover:shadow-lg hover:shadow-orange-500/30 active:scale-95 transition-all"
                    >
                        <span>Sign In</span>
                        <ChevronRight className="w-4 h-4" />
                    </a>
                </div>

            </div>
        </header>
    );
}