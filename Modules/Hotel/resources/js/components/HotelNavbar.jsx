import React, { useState, useRef, useEffect } from 'react';

const ECOSYSTEM_APPS = [
  { name: 'Master Ecosystem', tag: 'Sovereign Hub', url: 'http://zengfy.top:8000', icon: '🌐' },
  { name: 'Zengfy Social', tag: 'NID Verified', url: 'http://social.zengfy.top:8000', icon: '👥' },
  { name: 'Zengfy School', tag: 'Smart Edu ERP', url: 'http://school.zengfy.top:8000', icon: '🎓' },
  { name: 'Zengfy POS', tag: 'Garment & Retail', url: 'http://pos.zengfy.top:8000', icon: '🛍️' },
  { name: 'Zengfy Law', tag: 'Court Chamber', url: 'http://law.zengfy.top:8000', icon: '⚖️' },
  { name: 'Zengfy Civil', tag: '3D Architecture', url: 'http://civil.zengfy.top:8000', icon: '📐' },
  { name: 'Zengfy NGO', tag: 'Zakat & Trust', url: 'http://ngo.zengfy.top:8000', icon: '🤝' },
  { name: 'Zengfy Rent', tag: 'Property & Flat', url: 'http://rent.zengfy.top:8000', icon: '🔑' },
  { name: 'Zengfy Hotel', tag: 'Resort & ERP', url: 'http://hotel.zengfy.top:8000', icon: '🏨', current: true },
  { name: 'Zengfy Pharmacy', tag: 'Drug & Batch', url: 'http://pharmacy.zengfy.top:8000', icon: '💊' },
  { name: 'Zengfy Hospital', tag: 'EMR & Diagnostic', url: 'http://hospital.zengfy.top:8000', icon: '🏥' },
  { name: 'Zengfy Agro', tag: 'Farm & Cold Storage', url: 'http://agro.zengfy.top:8000', icon: '🌾' },
  { name: 'Zengfy Fleet', tag: 'GPS & Fuel Logistics', url: 'http://fleet.zengfy.top:8000', icon: '🚚' },
];

export default function HotelNavbar({ brand = {} }) {
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
    <header role="banner" className="sticky top-0 z-40 w-full backdrop-blur-xl bg-white/85 border-b border-amber-100/80 shadow-xs transition-all">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex items-center justify-between h-16">
          {/* Brand Logo & Badge */}
          <div className="flex items-center gap-3">
            <a href="http://hotel.zengfy.top:8000" className="flex items-center gap-2.5 group">
              <div className="w-10 h-10 rounded-xl bg-gradient-to-tr from-amber-600 via-amber-700 to-slate-900 flex items-center justify-center text-white shadow-md shadow-amber-900/15 group-hover:scale-105 transition-transform">
                <span className="text-xl">🏨</span>
              </div>
              <div className="flex flex-col">
                <span className="text-lg font-black tracking-tight text-slate-900 flex items-center gap-1.5">
                  Zengfy <span className="text-amber-600">Hotel</span>
                </span>
                <span className="text-[10px] font-bold text-slate-500 uppercase tracking-wider -mt-1">
                  Resort & Boutique ERP
                </span>
              </div>
            </a>

            <div className="hidden lg:flex items-center ml-3 pl-3 border-l border-slate-200">
              <span className="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-amber-50 text-amber-900 border border-amber-200/60">
                <span className="w-1.5 h-1.5 rounded-full bg-amber-600 animate-pulse"></span>
                ০% ওটিএ কমিশন ডিরেক্ট ইঞ্জিন
              </span>
            </div>
          </div>

          {/* Desktop Navigation Links */}
          <nav className="hidden md:flex items-center gap-6 text-sm font-semibold text-slate-600">
            <a href="#kitchen-simulator" className="hover:text-amber-700 transition-colors">কিচেন বাজার ও বুকিং</a>
            <a href="#journeys" className="hover:text-amber-700 transition-colors">স্টেকহোল্ডার জার্নি</a>
            <a href="#pillars" className="hover:text-amber-700 transition-colors">সার্বভৌম ফিচার</a>
            <a href="#pricing" className="hover:text-amber-700 transition-colors">প্যাকেজ ও মূল্য</a>
            <a href="http://zengfy.top:8000" className="hover:text-amber-700 transition-colors flex items-center gap-1 text-slate-500 hover:text-slate-900">
              <span>ইকোসিস্টেম</span>
              <span className="text-[10px] bg-slate-100 px-1.5 py-0.5 rounded font-mono text-slate-600">১৩টি অ্যাপ</span>
            </a>
          </nav>

          {/* Right Action Buttons */}
          <div className="flex items-center gap-2.5">
            {/* 13-App Waffle Launcher */}
            <div className="relative" ref={waffleRef}>
              <button
                type="button"
                onClick={() => setWaffleOpen(!waffleOpen)}
                aria-label="Zengfy 13-App Ecosystem Launcher"
                aria-expanded={waffleOpen}
                className="w-9 h-9 flex items-center justify-center rounded-xl bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200/80 transition-all focus:outline-none focus:ring-2 focus:ring-amber-500/40"
              >
                <svg className="w-4 h-4" viewBox="0 0 16 16" fill="currentColor">
                  <path d="M2 3.5a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0zm5.5 0a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0zm5.5 0a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0zM2 8a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0zm5.5 0a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0zm5.5 0a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0zM2 12.5a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0zm5.5 0a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0zm5.5 0a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0z"/>
                </svg>
              </button>

              {/* Waffle Dropdown */}
              {waffleOpen && (
                <div className="absolute right-0 mt-2 w-80 bg-white/95 backdrop-blur-2xl rounded-2xl shadow-2xl border border-slate-200/80 p-3 z-50 animate-in fade-in zoom-in-95 duration-150">
                  <div className="flex items-center justify-between pb-2 mb-2 border-b border-slate-100 px-2">
                    <span className="text-xs font-bold text-slate-800">Zengfy Sovereign Ecosystem</span>
                    <span className="text-[10px] font-semibold text-amber-700 bg-amber-50 px-2 py-0.5 rounded-full border border-amber-200/50">১৩টি প্ল্যাটফর্ম</span>
                  </div>
                  <div className="grid grid-cols-2 gap-1.5 max-h-[360px] overflow-y-auto">
                    {ECOSYSTEM_APPS.map((app) => (
                      <a
                        key={app.name}
                        href={app.url}
                        className={`flex items-center gap-2 p-2 rounded-xl text-left transition-all ${
                          app.current
                            ? 'bg-amber-50/90 text-amber-900 border border-amber-200/60 font-bold'
                            : 'hover:bg-slate-50 text-slate-700'
                        }`}
                      >
                        <span className="text-xl flex-shrink-0">{app.icon}</span>
                        <div className="min-w-0">
                          <div className="text-xs font-semibold truncate leading-tight">{app.name}</div>
                          <div className="text-[10px] text-slate-400 truncate leading-none mt-0.5">{app.tag}</div>
                        </div>
                      </a>
                    ))}
                  </div>
                </div>
              )}
            </div>

            {/* Central SSO Login */}
            <a
              href="http://zengfy.top:8000/login?continue=http%3A%2F%2Fhotel.zengfy.top%3A8000%2F"
              className="hidden sm:inline-flex items-center px-3.5 py-1.5 rounded-xl text-xs font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 transition-colors"
            >
              লগইন
            </a>

            {/* Primary Action Button */}
            <a
              href="#kitchen-simulator"
              className="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-amber-600 via-amber-700 to-slate-900 hover:opacity-95 shadow-md shadow-amber-900/20 transition-all hover:scale-[1.02]"
            >
              <span>লাইভ টেস্ট</span>
              <span className="text-amber-200">→</span>
            </a>

            {/* Mobile Menu Toggle */}
            <button
              type="button"
              onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
              className="md:hidden w-9 h-9 flex items-center justify-center rounded-xl bg-slate-100 text-slate-700"
              aria-label="Toggle Navigation Menu"
            >
              <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                {mobileMenuOpen ? (
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
                ) : (
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 6h16M4 12h16M4 18h16" />
                )}
              </svg>
            </button>
          </div>
        </div>

        {/* Mobile Dropdown Menu */}
        {mobileMenuOpen && (
          <div className="md:hidden py-4 border-t border-slate-100 flex flex-col gap-3">
            <a
              href="#kitchen-simulator"
              onClick={() => setMobileMenuOpen(false)}
              className="px-3 py-2 rounded-lg text-sm font-semibold text-slate-700 hover:bg-amber-50"
            >
              🍳 কিচেন বাজার ও বুকিং
            </a>
            <a
              href="#journeys"
              onClick={() => setMobileMenuOpen(false)}
              className="px-3 py-2 rounded-lg text-sm font-semibold text-slate-700 hover:bg-amber-50"
            >
              👥 স্টেকহোল্ডার জার্নি
            </a>
            <a
              href="#pillars"
              onClick={() => setMobileMenuOpen(false)}
              className="px-3 py-2 rounded-lg text-sm font-semibold text-slate-700 hover:bg-amber-50"
            >
              🛡️ সার্বভৌম ফিচার
            </a>
            <a
              href="#pricing"
              onClick={() => setMobileMenuOpen(false)}
              className="px-3 py-2 rounded-lg text-sm font-semibold text-slate-700 hover:bg-amber-50"
            >
              💳 প্যাকেজ ও মূল্য
            </a>
            <div className="pt-2 border-t border-slate-100 flex items-center gap-2">
              <a
                href="http://zengfy.top:8000/login?continue=http%3A%2F%2Fhotel.zengfy.top%3A8000%2F"
                className="flex-1 text-center py-2 rounded-xl text-xs font-bold text-slate-700 bg-slate-100"
              >
                লগইন
              </a>
              <a
                href="http://zengfy.top:8000/register?continue=http%3A%2F%2Fhotel.zengfy.top%3A8000%2F"
                className="flex-1 text-center py-2 rounded-xl text-xs font-bold text-white bg-amber-600"
              >
                রেজিস্ট্রেশন
              </a>
            </div>
          </div>
        )}
      </div>
    </header>
  );
}
