import React, { useState, useRef, useEffect } from 'react';

const ECOSYSTEM_APPS = [
  { name: 'Master Ecosystem', tag: 'Sovereign Hub', url: 'http://zengfy.top:8000', icon: '🌐' },
  { name: 'Social', tag: 'NID Verified', url: 'http://social.zengfy.top:8000', icon: '👥' },
  { name: 'School', tag: 'Smart Edu ERP', url: 'http://school.zengfy.top:8000', icon: '🎓' },
  { name: 'POS', tag: 'Garment & Retail', url: 'http://pos.zengfy.top:8000', icon: '🛍️' },
  { name: 'Law', tag: 'Court Chamber', url: 'http://law.zengfy.top:8000', icon: '⚖️' },
  { name: 'Civil', tag: '3D Architecture', url: 'http://civil.zengfy.top:8000', icon: '📐', current: true },
  { name: 'Rent', tag: 'Property & Flat', url: 'http://rent.zengfy.top:8000', icon: '🏢' },
  { name: 'Hotel', tag: 'Resort & PMS', url: 'http://hotel.zengfy.top:8000', icon: '🏨' },
  { name: 'Pharmacy', tag: 'Drug & Batch', url: 'http://pharmacy.zengfy.top:8000', icon: '💊' },
  { name: 'Hospital', tag: 'EMR & Diagnostic', url: 'http://hospital.zengfy.top:8000', icon: '🏥' },
  { name: 'Agro', tag: 'Farm & Cold Storage', url: 'http://agro.zengfy.top:8000', icon: '🌾' },
  { name: 'Fleet', tag: 'GPS & Fuel Logistics', url: 'http://fleet.zengfy.top:8000', icon: '🚚' },
  { name: 'Books', tag: 'VAT & Accounts', url: 'http://books.zengfy.top:8000', icon: '📊' },
];

export default function CivilNavbar({ brand = {} }) {
  const [waffleOpen, setWaffleOpen] = useState(false);
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
  const waffleRef = useRef(null);

  useEffect(() => {
    function handleClickOutside(event) {
      if (waffleRef.current && !waffleRef.current.contains(event.target)) {
        setWaffleOpen(false);
      }
    }
    document.addEventListener('mousedown', handleClickOutside);
    return () => document.removeEventListener('mousedown', handleClickOutside);
  }, []);

  return (
    <header role="banner" className="sticky top-0 z-40 w-full backdrop-blur-xl bg-white/80 border-b border-cyan-100/80 shadow-xs transition-all">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex items-center justify-between h-16">
          {/* Brand Logo & Tag */}
          <div className="flex items-center gap-3">
            <a href="http://civil.zengfy.top:8000" className="flex items-center gap-2.5 group">
              <div className="w-10 h-10 rounded-xl bg-gradient-to-tr from-cyan-600 via-cyan-700 to-slate-800 flex items-center justify-center text-white shadow-md shadow-cyan-900/15 group-hover:scale-105 transition-transform">
                <span className="text-xl">📐</span>
              </div>
              <div className="flex flex-col">
                <span className="text-lg font-black tracking-tight text-slate-900 flex items-center gap-1.5">
                  Zengfy <span className="text-cyan-600">Civil</span>
                </span>
                <span className="text-[10px] font-bold text-slate-500 uppercase tracking-wider -mt-1">
                  3D Architecture ERP
                </span>
              </div>
            </a>

            <div className="hidden lg:flex items-center ml-3 pl-3 border-l border-slate-200">
              <span className="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-cyan-50 text-cyan-800 border border-cyan-200/60">
                <span className="w-1.5 h-1.5 rounded-full bg-cyan-600 animate-pulse"></span>
                SaaS Cloud Platform
              </span>
            </div>
          </div>

          {/* Desktop Navigation Links */}
          <nav role="navigation" aria-label="Main Navigation" className="hidden md:flex items-center gap-6 text-sm font-semibold text-slate-700">
            <a href="#simulator" className="hover:text-cyan-600 transition-colors">
              ৩ডি প্লট ও কস্টিং
            </a>
            <a href="#journeys" className="hover:text-cyan-600 transition-colors">
              ফার্ম ও ইঞ্জিনিয়ার
            </a>
            <a href="#pillars" className="hover:text-cyan-600 transition-colors">
              টেক আর্কিটেকচার
            </a>
            <a href="#pricing" className="hover:text-cyan-600 transition-colors">
              ক্লাউড প্যাকেজ
            </a>
            <a href="#faq" className="hover:text-cyan-600 transition-colors">
              প্রশ্নোত্তর
            </a>
          </nav>

          {/* Right Action Icons: Waffle App Launcher & SSO Login */}
          <div className="flex items-center gap-3">
            {/* 9-Dot Waffle Menu */}
            <div className="relative" ref={waffleRef}>
              <button
                type="button"
                onClick={() => setWaffleOpen(!waffleOpen)}
                aria-label="Google Apps Waffle Menu - 13 Platforms"
                className="w-9 h-9 rounded-lg flex items-center justify-center text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition-colors focus:outline-none focus:ring-2 focus:ring-cyan-500"
              >
                <svg className="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M6 6h3V3H6v3zm6 0h3V3h-3v3zm6-3v3h3V3h-3zM6 12h3V9H6v3zm6 0h3V9h-3v3zm6 0h3V9h-3v3zM6 18h3v-3H6v3zm6 0h3v-3h-3v3zm6 0h3v-3h-3v3z" />
                </svg>
              </button>

              {/* Waffle Dropdown */}
              {waffleOpen && (
                <div className="absolute right-0 mt-2 w-80 sm:w-96 rounded-2xl bg-white/95 backdrop-blur-2xl border border-slate-200 shadow-2xl p-4 z-50 animate-in fade-in zoom-in-95 duration-150">
                  <div className="flex items-center justify-between pb-3 border-b border-slate-100 mb-3">
                    <span className="text-xs font-black uppercase tracking-wider text-slate-500">
                      Zengfy Sovereign Platforms (13)
                    </span>
                    <span className="text-[11px] font-semibold text-cyan-600">
                      Unified SSO
                    </span>
                  </div>
                  <div className="grid grid-cols-3 gap-2 max-h-96 overflow-y-auto p-1">
                    {ECOSYSTEM_APPS.map((app) => (
                      <a
                        key={app.name}
                        href={app.url}
                        className={`flex flex-col items-center text-center p-2 rounded-xl transition-all ${
                          app.current
                            ? 'bg-cyan-50 border border-cyan-200 text-cyan-900 font-bold'
                            : 'hover:bg-slate-50 text-slate-700 hover:text-slate-900'
                        }`}
                      >
                        <span className="text-2xl mb-1">{app.icon}</span>
                        <span className="text-xs font-semibold leading-tight line-clamp-1">{app.name}</span>
                        <span className="text-[10px] text-slate-400 mt-0.5 line-clamp-1">{app.tag}</span>
                      </a>
                    ))}
                  </div>
                </div>
              )}
            </div>

            {/* Central SSO Login Button */}
            <a
              href="http://civil.zengfy.top:8000/login"
              className="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl text-xs font-bold text-slate-700 hover:text-slate-900 hover:bg-slate-100 border border-slate-200 transition-colors"
            >
              <span>লগইন</span>
              <svg className="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7" />
              </svg>
            </a>

            {/* Free Trial Button */}
            <a
              href="#pricing"
              className="hidden sm:inline-flex items-center gap-1.5 px-4 py-1.5 rounded-xl text-xs font-bold bg-cyan-600 hover:bg-cyan-700 text-white shadow-md shadow-cyan-600/25 transition-all"
            >
              <span>ক্লাউড ট্রায়াল</span>
            </a>

            {/* Mobile Menu Trigger */}
            <button
              type="button"
              onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
              className="md:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100 focus:outline-none"
              aria-label="Toggle Navigation Menu"
            >
              <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                {mobileMenuOpen ? (
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12" />
                ) : (
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 6h16M4 12h16M4 18h16" />
                )}
              </svg>
            </button>
          </div>
        </div>

        {/* Mobile Dropdown Menu */}
        {mobileMenuOpen && (
          <div className="md:hidden border-t border-slate-100 py-3 space-y-2 text-sm font-semibold text-slate-700 bg-white/95 rounded-b-2xl shadow-xl px-2">
            <a
              href="#simulator"
              onClick={() => setMobileMenuOpen(false)}
              className="block px-3 py-2 rounded-lg hover:bg-slate-50 hover:text-cyan-600"
            >
              ৩ডি প্লট ও কস্টিং
            </a>
            <a
              href="#journeys"
              onClick={() => setMobileMenuOpen(false)}
              className="block px-3 py-2 rounded-lg hover:bg-slate-50 hover:text-cyan-600"
            >
              ফার্ম ও ইঞ্জিনিয়ার
            </a>
            <a
              href="#pillars"
              onClick={() => setMobileMenuOpen(false)}
              className="block px-3 py-2 rounded-lg hover:bg-slate-50 hover:text-cyan-600"
            >
              টেক আর্কিটেকচার
            </a>
            <a
              href="#pricing"
              onClick={() => setMobileMenuOpen(false)}
              className="block px-3 py-2 rounded-lg hover:bg-slate-50 hover:text-cyan-600"
            >
              ক্লাউড প্যাকেজ
            </a>
            <div className="pt-2 border-t border-slate-100 flex gap-2">
              <a
                href="http://civil.zengfy.top:8000/login"
                className="flex-1 text-center py-2 rounded-lg bg-slate-100 text-slate-800 text-xs font-bold"
              >
                লগইন
              </a>
              <a
                href="#pricing"
                className="flex-1 text-center py-2 rounded-lg bg-cyan-600 text-white text-xs font-bold shadow-md shadow-cyan-600/25"
              >
                ক্লাউড ট্রায়াল
              </a>
            </div>
          </div>
        )}
      </div>
    </header>
  );
}
