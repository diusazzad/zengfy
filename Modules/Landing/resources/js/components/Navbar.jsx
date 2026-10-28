import React, { useState, useRef, useEffect } from 'react';
import { ChevronRight, ChevronDown, User, LogOut, LayoutDashboard, ShieldCheck } from 'lucide-react';

export default function Navbar({ links = {}, modules = [], auth = {}, onNavigateSection }) {
    const [waffleOpen, setWaffleOpen] = useState(false);
    const [userMenuOpen, setUserMenuOpen] = useState(false);
    const waffleRef = useRef(null);
    const userMenuRef = useRef(null);

    // Close menus on outside click or Esc key
    useEffect(() => {
        function handleClickOutside(event) {
            if (waffleRef.current && !waffleRef.current.contains(event.target)) {
                setWaffleOpen(false);
            }
            if (userMenuRef.current && !userMenuRef.current.contains(event.target)) {
                setUserMenuOpen(false);
            }
        }
        function handleKeyDown(e) {
            if (e.key === 'Escape') {
                setWaffleOpen(false);
                setUserMenuOpen(false);
            }
        }
        document.addEventListener('mousedown', handleClickOutside);
        document.addEventListener('keydown', handleKeyDown);
        return () => {
            document.removeEventListener('mousedown', handleClickOutside);
            document.removeEventListener('keydown', handleKeyDown);
        };
    }, []);

    // Take top 9 modules for the Google-style 3x3 waffle grid
    const top9Modules = modules.slice(0, 9);
    const isAuthenticated = Boolean(auth && auth.is_authenticated && auth.user);
    const user = auth?.user || null;

    return (
        <header role="banner" className="sticky top-0 z-50 glass-nav transition-all duration-300">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-18 sm:h-20 flex items-center justify-between">
                
                {/* Brand Logo */}
                <a href={links.home || "/"} aria-label="Zengfy Sovereign Ecosystem Home" className="flex items-center gap-3 group shrink-0">
                    <div aria-hidden="true" className="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 via-indigo-600 to-cyan-500 flex items-center justify-center font-black text-xl text-white shadow-md shadow-blue-500/20 transition-all">
                        Z
                    </div>
                    <div className="flex flex-col">
                        <div className="flex items-center gap-1">
                            <span className="text-xl sm:text-2xl font-black tracking-tight text-slate-900 group-hover:text-blue-600 transition-colors">
                                Zengfy<span className="text-blue-600">.</span>
                            </span>
                            <span className="text-[10px] font-bold px-2 py-0.5 rounded-full bg-blue-50 text-blue-700 border border-blue-200/60 hidden sm:inline-block">
                                Sovereign Suite
                            </span>
                        </div>
                    </div>
                </a>

                {/* Right: Google-style 9-Dot Waffle Menu + Auth Navigation CTA */}
                <div className="flex items-center gap-3">
                    
                    {/* 9-Dot Waffle Apps Menu Wrapper */}
                    <div className="relative" ref={waffleRef}>
                        <button
                            type="button"
                            onClick={() => {
                                setWaffleOpen(!waffleOpen);
                                setUserMenuOpen(false);
                            }}
                            aria-expanded={waffleOpen}
                            aria-haspopup="dialog"
                            aria-label="Open Zengfy Apps Menu"
                            title="Zengfy Apps Launcher"
                            className={`w-11 h-11 rounded-2xl flex items-center justify-center border transition-all cursor-pointer ${
                                waffleOpen
                                    ? 'bg-blue-50 border-blue-300 text-blue-600 ring-2 ring-blue-500/20 shadow-md'
                                    : 'bg-white hover:bg-slate-50 border-slate-200 text-slate-700 hover:text-blue-600 shadow-xs'
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
                                        Zengfy Cloud Suite
                                    </span>
                                    <span className="text-[11px] font-bold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full border border-blue-100">
                                        14 Micro-SaaS
                                    </span>
                                </div>

                                {/* Grid of All Connected Apps */}
                                <div className="grid grid-cols-3 gap-2 sm:gap-2.5">
                                    {(modules.length > 0 ? modules : top9Modules).map((item) => (
                                        <a
                                            key={item.id}
                                            href={item.url}
                                            className="flex flex-col items-center p-2.5 rounded-2xl bg-slate-50/70 hover:bg-blue-50/70 border border-slate-100 hover:border-blue-200/80 transition-all text-center group"
                                        >
                                            <div className="w-11 h-11 rounded-2xl bg-white border border-slate-200/60 shadow-xs flex items-center justify-center text-xl group-hover:shadow-md transition-all">
                                                {item.icon}
                                            </div>
                                            <span className="mt-2 text-xs font-bold text-slate-800 group-hover:text-blue-600 transition-colors truncate w-full">
                                                {item.short_name || item.name.replace(/^Zengfy\s+/i, '')}
                                            </span>
                                            <span className="text-[10px] text-slate-400 truncate w-full">
                                                {item.category.split('&')[0]}
                                            </span>
                                        </a>
                                    ))}
                                </div>

                                <div className="mt-3.5 pt-3 border-t border-slate-100 text-center">
                                    <button
                                        type="button"
                                        onClick={() => {
                                            setWaffleOpen(false);
                                            onNavigateSection('modules');
                                        }}
                                        className="text-xs font-bold text-blue-600 hover:text-blue-700 transition-colors inline-flex items-center gap-1.5 py-1 cursor-pointer"
                                    >
                                        <span>View all 14 platforms</span>
                                        <ChevronRight className="w-3.5 h-3.5" />
                                    </button>
                                </div>
                            </div>
                        )}
                    </div>

                    {/* Authenticated Citizen Menu vs Guest Sign In CTA */}
                    {isAuthenticated ? (
                        <div className="relative" ref={userMenuRef}>
                            <button
                                type="button"
                                onClick={() => {
                                    setUserMenuOpen(!userMenuOpen);
                                    setWaffleOpen(false);
                                }}
                                aria-expanded={userMenuOpen}
                                aria-haspopup="menu"
                                aria-label="Citizen Sovereign Account Menu"
                                className={`flex items-center gap-2 pl-1.5 sm:pl-2 pr-3 py-1.5 rounded-full border transition-all cursor-pointer ${
                                    userMenuOpen
                                        ? 'bg-blue-50 border-blue-300 ring-2 ring-blue-500/20 shadow-md'
                                        : 'bg-white hover:bg-slate-50 border-slate-200 shadow-xs'
                                }`}
                            >
                                <div className="w-8 h-8 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 text-white font-black text-xs flex items-center justify-center shadow-xs">
                                    {(user.name || user.handle || 'C').charAt(0).toUpperCase()}
                                </div>
                                <div className="hidden sm:flex flex-col text-left">
                                    <span className="text-xs font-bold text-slate-800 leading-tight max-w-[110px] truncate">
                                        {user.name || user.handle}
                                    </span>
                                    <span className="text-[10px] text-emerald-600 font-semibold leading-none flex items-center gap-0.5">
                                        <span className="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block"></span>
                                        <span>Citizen</span>
                                    </span>
                                </div>
                                <ChevronDown className={`w-3.5 h-3.5 text-slate-400 transition-transform ${userMenuOpen ? 'rotate-180 text-blue-600' : ''}`} />
                            </button>

                            {/* Dropdown Menu */}
                            {userMenuOpen && (
                                <div
                                    role="menu"
                                    aria-label="Sovereign Citizen Account"
                                    className="fixed left-3.5 right-3.5 top-20 sm:absolute sm:left-auto sm:right-0 sm:top-full sm:mt-2.5 sm:w-72 bg-white/95 backdrop-blur-2xl border border-slate-200/90 rounded-2xl shadow-2xl p-4 z-50 animate-in fade-in zoom-in-95 duration-150"
                                >
                                    <div className="pb-3 border-b border-slate-100 flex items-center gap-3">
                                        <div className="w-10 h-10 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 text-white font-black text-sm flex items-center justify-center shadow-xs shrink-0">
                                            {(user.name || user.handle || 'C').charAt(0).toUpperCase()}
                                        </div>
                                        <div className="overflow-hidden">
                                            <p className="text-xs font-bold text-slate-900 truncate">
                                                {user.name}
                                            </p>
                                            <p className="text-[11px] text-slate-500 truncate">
                                                {user.email}
                                            </p>
                                            <span className="inline-flex items-center gap-1 mt-1 px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 text-[9px] font-bold border border-emerald-100">
                                                <ShieldCheck className="w-2.5 h-2.5" />
                                                <span>Sovereign Citizen</span>
                                            </span>
                                        </div>
                                    </div>

                                    <div className="py-2.5 space-y-1">
                                        <a
                                            href={links.account || 'http://accounts.zengfy.top:8000/'}
                                            className="flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-bold text-slate-800 hover:text-blue-600 hover:bg-blue-50 transition"
                                        >
                                            <div className="flex items-center gap-2">
                                                <LayoutDashboard className="w-4 h-4 text-blue-600" />
                                                <span>Sovereign Dashboard</span>
                                            </div>
                                            <ChevronRight className="w-3.5 h-3.5 text-slate-400" />
                                        </a>

                                        <a
                                            href={`${links.login || 'http://accounts.zengfy.top:8000/login'}?switch=1`}
                                            className="flex items-center justify-between px-3 py-2 rounded-xl text-xs font-medium text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition"
                                        >
                                            <div className="flex items-center gap-2">
                                                <User className="w-3.5 h-3.5 text-slate-400" />
                                                <span>Switch / Add Account</span>
                                            </div>
                                        </a>
                                    </div>

                                    <div className="pt-2 border-t border-slate-100">
                                        <a
                                            href={links.logout || 'http://accounts.zengfy.top:8000/logout'}
                                            className="w-full flex items-center justify-center gap-2 px-3 py-2 rounded-xl text-xs font-bold text-red-600 hover:bg-red-50 transition"
                                        >
                                            <LogOut className="w-3.5 h-3.5" />
                                            <span>Sign Out</span>
                                        </a>
                                    </div>
                                </div>
                            )}
                        </div>
                    ) : (
                        <a
                            href={
                                typeof window !== 'undefined' &&
                                (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') &&
                                links.login?.includes('zengfy.top')
                                    ? '/login'
                                    : (links.login || 'http://accounts.zengfy.top:8000/login?continue=http%3A%2F%2Fzengfy.top%3A8000%2F')
                            }
                            className="inline-flex items-center gap-2 px-5 sm:px-6 py-2.5 rounded-full bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs sm:text-sm shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/30 transition-all cursor-pointer"
                        >
                            <span>Sign In</span>
                            <ChevronRight className="w-4 h-4" />
                        </a>
                    )}
                </div>

            </div>
        </header>
    );
}
