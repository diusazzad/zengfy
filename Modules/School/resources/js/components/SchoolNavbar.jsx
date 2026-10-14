import React, { useState, useRef, useEffect } from 'react';
import { ArrowUpRight, ChevronRight, School as SchoolIcon, Radio } from 'lucide-react';

export default function SchoolNavbar({ links = {}, onNavigateSection }) {
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
        { name: 'School', icon: '🏫', url: links.school || 'http://school.zengfy.top:8000/', category: 'Academic ERP', active: true },
        { name: 'Social', icon: '🌐', url: 'http://social.zengfy.top:8000/', category: 'Civic Mesh' },
        { name: 'POS', icon: '🛒', url: 'http://pos.zengfy.top:8000/', category: 'Retail & Stock' },
        { name: 'Law', icon: '⚖️', url: 'http://law.zengfy.top:8000/', category: 'Legal Vault' },
        { name: 'Rent', icon: '🏠', url: 'http://rent.zengfy.top:8000/', category: 'Property Hub' },
        { name: 'Hotel', icon: '🏨', url: 'http://hotel.zengfy.top:8000/', category: 'Hospitality' },
        { name: 'Commerce', icon: '🛍️', url: 'http://shop.zengfy.top:8000/', category: 'Online Store' },
        { name: 'NGO', icon: '❤️', url: 'http://ngo.zengfy.top:8000/', category: 'Charity Cloud' },
        { name: 'Account', icon: '🛡️', url: links.account || 'http://zengfy.top:8000/account', category: 'Citizen SSO' },
    ];

    return (
        <header role="banner" className="sticky top-0 z-50 glass-nav transition-all duration-300">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-18 sm:h-20 flex items-center justify-between">

                {/* Brand Logo */}
                <a href={links.school || "/"} aria-label="Zengfy School Home" className="flex items-center gap-3 group shrink-0">
                    <div aria-hidden="true" className="w-10 h-10 rounded-2xl bg-gradient-to-tr from-emerald-600 via-teal-600 to-indigo-600 flex items-center justify-center font-black text-xl text-white shadow-md shadow-emerald-500/20 group-hover:scale-105 transition-transform">
                        🏫
                    </div>
                    <div className="flex flex-col">
                        <div className="flex items-center gap-1.5">
                            <span className="text-xl sm:text-2xl font-black tracking-tight text-slate-900 group-hover:text-emerald-700 transition-colors">
                                Zengfy<span className="text-emerald-600">.</span>
                            </span>
                            <span className="text-[11px] font-bold text-emerald-700 bg-emerald-50 border border-emerald-200/80 px-2.5 py-0.5 rounded-full uppercase tracking-wider">
                                School
                            </span>
                        </div>
                    </div>
                </a>

                {/* Desktop Navigation Links */}
                <nav role="navigation" aria-label="School Navigation" className="hidden lg:flex items-center gap-1 p-1 rounded-full bg-slate-100/80 border border-slate-200/60 shadow-xs">
                    <button
                        type="button"
                        onClick={() => onNavigateSection('hero')}
                        className="px-3.5 py-1.5 rounded-full text-xs font-bold text-slate-600 hover:text-slate-900 hover:bg-white transition-all cursor-pointer"
                    >
                        ওভারভিউ
                    </button>
                    <button
                        type="button"
                        onClick={() => onNavigateSection('rfid')}
                        className="px-3.5 py-1.5 rounded-full text-xs font-bold text-slate-600 hover:text-slate-900 hover:bg-white transition-all cursor-pointer flex items-center gap-1.5"
                    >
                        <span>RFID হাজিরা ডেমো</span>
                        <span className="w-2 h-2 rounded-full bg-emerald-500 animate-pulse" />
                    </button>
                    <button
                        type="button"
                        onClick={() => onNavigateSection('roles')}
                        className="px-3.5 py-1.5 rounded-full text-xs font-bold text-slate-600 hover:text-slate-900 hover:bg-white transition-all cursor-pointer"
                    >
                        ভূমিকা ও সুবিধা
                    </button>
                    <button
                        type="button"
                        onClick={() => onNavigateSection('grading')}
                        className="px-3.5 py-1.5 rounded-full text-xs font-bold text-slate-600 hover:text-slate-900 hover:bg-white transition-all cursor-pointer flex items-center gap-1.5"
                    >
                        <span>গ্রেডিং ক্যালকুলেটর</span>
                        <span className="px-1.5 py-0.2 rounded-full bg-indigo-100 text-indigo-700 text-[10px] font-extrabold">GPA ৫.০০</span>
                    </button>
                    <button
                        type="button"
                        onClick={() => onNavigateSection('pricing')}
                        className="px-3.5 py-1.5 rounded-full text-xs font-bold text-emerald-700 bg-emerald-50/80 hover:bg-emerald-100/80 border border-emerald-200/60 transition-all cursor-pointer flex items-center gap-1"
                    >
                        <span>প্যাকেজ ও অফার</span>
                    </button>
                    <a
                        href={links.api_docs || "/api/v1/school/landing"}
                        target="_blank"
                        rel="noopener noreferrer"
                        className="px-3.5 py-1.5 rounded-full text-xs font-bold text-slate-600 hover:text-emerald-700 hover:bg-white transition-all flex items-center gap-1"
                    >
                        <span>School API</span>
                        <ArrowUpRight aria-hidden="true" className="w-3 h-3" />
                    </a>
                </nav>

                {/* Right: 9-Dot Waffle Menu + Sign In CTA */}
                <div className="flex items-center gap-3">

                    {/* 9-Dot Waffle Apps Menu Wrapper */}
                    <div className="relative" ref={waffleRef}>
                        <button
                            type="button"
                            onClick={() => setWaffleOpen(!waffleOpen)}
                            aria-expanded={waffleOpen}
                            aria-haspopup="dialog"
                            aria-label="Open Zengfy Sovereign Apps Menu"
                            title="Zengfy Apps Launcher"
                            className={`w-11 h-11 rounded-2xl flex items-center justify-center border transition-all cursor-pointer ${
                                waffleOpen
                                    ? 'bg-emerald-50 border-emerald-300 text-emerald-600 ring-2 ring-emerald-500/20 shadow-md'
                                    : 'bg-white hover:bg-slate-50 border-slate-200 text-slate-700 hover:text-emerald-700 shadow-xs'
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

                        {/* Waffle Dropdown Popover */}
                        {waffleOpen && (
                            <div
                                role="dialog"
                                aria-label="Zengfy Apps Launcher"
                                aria-modal="false"
                                className="fixed left-4 right-4 top-20 sm:absolute sm:left-auto sm:right-0 sm:top-full mt-2.5 sm:w-[380px] max-h-[85vh] overflow-y-auto bg-white/95 backdrop-blur-2xl border border-slate-200/90 rounded-3xl p-4 sm:p-5 shadow-2xl ring-1 ring-slate-900/5 z-50 animate-in fade-in zoom-in-95 duration-150"
                            >
                                <div className="flex items-center justify-between pb-3 mb-3 border-b border-slate-100">
                                    <div className="flex items-center gap-2">
                                        <span className="text-xs font-bold uppercase tracking-wider text-slate-800">Zengfy Apps</span>
                                        <span className="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                                            Universal SSO
                                        </span>
                                    </div>
                                    <span className="text-[10px] text-slate-400 font-mono">Academic ERP</span>
                                </div>

                                {/* 3x3 Grid */}
                                <div className="grid grid-cols-3 gap-2 text-center">
                                    {apps.map((item) => (
                                        <a
                                            key={item.name}
                                            href={item.url}
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            className={`flex flex-col items-center p-2.5 rounded-2xl border transition-all group ${
                                                item.active
                                                    ? 'bg-emerald-50/80 border-emerald-200 text-emerald-700 shadow-2xs'
                                                    : 'bg-slate-50/70 hover:bg-emerald-50/60 border-slate-100 hover:border-emerald-200'
                                            }`}
                                        >
                                            <div className="w-11 h-11 rounded-2xl bg-white border border-slate-200/80 group-hover:border-emerald-300 flex items-center justify-center text-xl group-hover:scale-110 transition-transform shadow-xs">
                                                {item.icon}
                                            </div>
                                            <span className="mt-2 text-xs font-bold text-slate-900 group-hover:text-emerald-700 transition-colors truncate w-full">
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
                                        href={links.home || 'http://zengfy.top:8000/'}
                                        className="text-xs font-bold text-emerald-700 hover:text-emerald-800 transition-colors inline-flex items-center gap-1.5 py-1"
                                    >
                                        <span>Explore Master Ecosystem Hub</span>
                                        <ChevronRight className="w-3.5 h-3.5" />
                                    </a>
                                </div>
                            </div>
                        )}
                    </div>

                    {/* Sign In CTA */}
                    <a
                        href={links.login || "http://zengfy.top:8000/login"}
                        className="inline-flex items-center gap-2 px-5 sm:px-6 py-2.5 rounded-full bg-gradient-to-r from-emerald-600 via-teal-600 to-indigo-600 hover:from-emerald-700 hover:to-indigo-700 text-white font-bold text-xs sm:text-sm shadow-md shadow-emerald-500/20 hover:shadow-lg hover:shadow-emerald-500/30 active:scale-95 transition-all"
                    >
                        <span>লগইন করুন</span>
                        <ChevronRight className="w-4 h-4" />
                    </a>
                </div>

            </div>
        </header>
    );
}
