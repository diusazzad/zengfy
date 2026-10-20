import React, { useState, useRef, useEffect } from 'react';

const ECOSYSTEM_APPS = [
  { name: 'Master Ecosystem', tag: 'Sovereign Hub', url: 'http://zengfy.top:8000', icon: '🌐' },
  { name: 'Social', tag: 'NID Verified', url: 'http://social.zengfy.top:8000', icon: '👥' },
  { name: 'School', tag: 'Smart Edu ERP', url: 'http://school.zengfy.top:8000', icon: '🎓' },
  { name: 'POS', tag: 'Garment & Retail', url: 'http://pos.zengfy.top:8000', icon: '🛍️' },
  { name: 'Law', tag: 'Court Chamber', url: 'http://law.zengfy.top:8000', icon: '⚖️' },
  { name: 'Civil', tag: '3D Architecture', url: 'http://civil.zengfy.top:8000', icon: '📐' },
  { name: 'NGO', tag: 'Zakat & Trust', url: 'http://ngo.zengfy.top:8000', icon: '🤝' },
  { name: 'Rent', tag: 'Property & Flat', url: 'http://rent.zengfy.top:8000', icon: '🔑' },
  { name: 'Hotel', tag: 'Resort & ERP', url: 'http://hotel.zengfy.top:8000', icon: '🏨' },
  { name: 'Commerce', tag: 'D2C & Anti-Fraud', url: 'http://shop.zengfy.top:8000', icon: '🛒', current: true },
  { name: 'Skill', tag: 'Career & Certs', url: 'http://skill.zengfy.top:8000', icon: '🚀' },
  { name: 'Journal', tag: 'Sovereign Op-Ed', url: 'http://journal.zengfy.top:8000', icon: '✍️' },
  { name: 'Habit', tag: '5 Daily Prayers', url: 'http://habit.zengfy.top:8000', icon: '⚡' },
  { name: 'Schedule', tag: 'Client Calendar', url: 'http://schedule.zengfy.top:8000', icon: '📅' },
];

export default function ShopNavbar({ brand = {} }) {
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
    <header role="banner" className="sticky top-0 z-40 w-full backdrop-blur-xl bg-white/85 border-b border-orange-100/80 shadow-xs transition-all">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex items-center justify-between h-16">
          {/* Brand Logo & Badge */}
          <div className="flex items-center gap-3">
            <a href="http://shop.zengfy.top:8000" className="flex items-center gap-2.5 group">
              <div className="w-10 h-10 rounded-xl bg-gradient-to-tr from-orange-600 via-orange-500 to-violet-600 flex items-center justify-center text-white shadow-md shadow-orange-600/20 group-hover:scale-105 transition-all">
                <span className="text-xl">🛒</span>
              </div>
              <div className="flex flex-col">
                <div className="flex items-center gap-1.5">
                  <span className="font-extrabold text-lg tracking-tight text-slate-900 group-hover:text-orange-600 transition-colors">
                    Zengfy
                  </span>
                  <span className="font-extrabold text-lg tracking-tight bg-gradient-to-r from-orange-600 to-violet-600 bg-clip-text text-transparent">
                    Commerce
                  </span>
                  <span className="text-[10px] font-bold px-1.5 py-0.5 rounded-md bg-orange-100 text-orange-700 border border-orange-200">
                    D2C Shop
                  </span>
                </div>
                <span className="text-[10.5px] font-semibold text-slate-500 -mt-0.5 tracking-tight hidden sm:inline-block">
                  Anti-Fraud D2C Commerce
                </span>
              </div>
            </a>
          </div>

          {/* Center Navigation Links */}
          <nav role="navigation" aria-label="Main Navigation" className="hidden md:flex items-center gap-1 p-1 rounded-full bg-slate-100/80 border border-slate-200/60 shadow-xs">
            <a href="#simulator" className="px-3.5 py-1.5 rounded-full text-xs font-bold text-slate-600 hover:text-orange-700 hover:bg-white transition-all">
              অ্যান্টি-ফ্রড স্কোরার
            </a>
            <a href="#journeys" className="px-3.5 py-1.5 rounded-full text-xs font-bold text-slate-600 hover:text-orange-700 hover:bg-white transition-all">
              স্টেকহোল্ডার ভিউ
            </a>
            <a href="#pillars" className="px-3.5 py-1.5 rounded-full text-xs font-bold text-slate-600 hover:text-orange-700 hover:bg-white transition-all">
              সার্বভৌম পিলার
            </a>
            <a href="#pricing" className="px-3.5 py-1.5 rounded-full text-xs font-bold text-slate-600 hover:text-orange-700 hover:bg-white transition-all">
              প্রাইসিং প্যাকেজ
            </a>
          </nav>

          {/* Right Action Buttons + 9-Dot Launcher */}
          <div className="flex items-center gap-2 sm:gap-3">
            {/* 13-App Waffle Launcher */}
            <div className="relative" ref={waffleRef}>
              <button
                type="button"
                onClick={() => setWaffleOpen(!waffleOpen)}
                aria-label="Zengfy Sovereign Platform Directory"
                aria-expanded={waffleOpen}
                className="w-9 h-9 rounded-xl flex items-center justify-center text-slate-600 hover:text-orange-600 hover:bg-orange-50 border border-slate-200/80 hover:border-orange-200 transition-all cursor-pointer"
              >
                <svg className="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <circle cx="5" cy="5" r="2" />
                  <circle cx="12" cy="5" r="2" />
                  <circle cx="19" cy="5" r="2" />
                  <circle cx="5" cy="12" r="2" />
                  <circle cx="12" cy="12" r="2" />
                  <circle cx="19" cy="12" r="2" />
                  <circle cx="5" cy="19" r="2" />
                  <circle cx="12" cy="19" r="2" />
                  <circle cx="19" cy="19" r="2" />
                </svg>
              </button>

              {/* Waffle Dropdown Modal */}
              {waffleOpen && (
                <div className="absolute right-0 mt-2 w-80 sm:w-96 p-3 rounded-2xl bg-white/95 backdrop-blur-2xl border border-slate-200/90 shadow-2xl z-50 animate-in fade-in zoom-in-95 duration-150">
                  <div className="flex items-center justify-between pb-2 mb-2 border-b border-slate-100">
                    <span className="text-xs font-bold text-slate-500 uppercase tracking-wider">
                      Zengfy Sovereign Ecosystem (14 Apps)
                    </span>
                    <span className="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-orange-100 text-orange-700 font-mono">
                      Single Sign-On
                    </span>
                  </div>
                  <div className="grid grid-cols-2 gap-1.5 max-h-80 overflow-y-auto p-0.5">
                    {ECOSYSTEM_APPS.map((app) => (
                      <a
                        key={app.name}
                        href={app.url}
                        className={`flex items-center gap-2.5 p-2 rounded-xl transition-all ${
                          app.current
                            ? 'bg-orange-50 border border-orange-200 text-orange-950 font-bold'
                            : 'hover:bg-slate-50 text-slate-700 hover:text-slate-900 border border-transparent'
                        }`}
                      >
                        <span className="text-xl shrink-0">{app.icon}</span>
                        <div className="flex flex-col min-w-0">
                          <span className="text-xs truncate">{app.name}</span>
                          <span className="text-[10px] text-slate-400 truncate">{app.tag}</span>
                        </div>
                      </a>
                    ))}
                  </div>
                </div>
              )}
            </div>

            {/* Central SSO Login Button */}
            <a
              href="http://accounts.zengfy.top:8000/login?continue=http%3A%2F%2Fshop.zengfy.top%3A8000%2F"
              className="hidden sm:inline-flex items-center justify-center px-4 py-2 rounded-xl text-xs font-bold text-slate-700 hover:text-orange-700 hover:bg-orange-50/80 border border-slate-200/80 transition-all"
            >
              লগইন / SSO
            </a>

            {/* Main CTA */}
            <a
              href="http://accounts.zengfy.top:8000/register?continue=http%3A%2F%2Fshop.zengfy.top%3A8000%2F"
              className="inline-flex items-center justify-center px-4 py-2 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-orange-600 via-orange-500 to-violet-600 hover:from-orange-700 hover:to-violet-700 shadow-md shadow-orange-600/25 hover:shadow-lg hover:shadow-orange-600/35 transition-all transform active:scale-95"
            >
              ফ্রি ট্রায়াল শুরু করুন
            </a>
          </div>
        </div>
      </div>
    </header>
  );
}
