import React, { useState, useRef, useEffect } from 'react';

const ECOSYSTEM_APPS = [
  { name: 'Master Ecosystem', tag: 'Sovereign Hub', url: 'http://zengfy.test:8000', icon: '🌐' },
  { name: 'Zengfy Social', tag: 'NID Verified', url: 'http://social.zengfy.test:8000', icon: '👥' },
  { name: 'Zengfy School', tag: 'Smart Edu ERP', url: 'http://school.zengfy.test:8000', icon: '🏫' },
  { name: 'Zengfy POS', tag: 'Garment & Retail', url: 'http://pos.zengfy.test:8000', icon: '🛍️' },
  { name: 'Zengfy Law', tag: 'Court Chamber', url: 'http://law.zengfy.test:8000', icon: '⚖️' },
  { name: 'Zengfy Civil', tag: '3D Architecture', url: 'http://civil.zengfy.test:8000', icon: '📐' },
  { name: 'Zengfy NGO', tag: 'Zakat & Trust', url: 'http://ngo.zengfy.test:8000', icon: '🤝' },
  { name: 'Zengfy Rent', tag: 'Property & Flat', url: 'http://rent.zengfy.test:8000', icon: '🔑' },
  { name: 'Zengfy Hotel', tag: 'Resort & ERP', url: 'http://hotel.zengfy.test:8000', icon: '🏨' },
  { name: 'Zengfy Shop', tag: 'D2C & Anti-Fraud', url: 'http://shop.zengfy.test:8000', icon: '🛒' },
  { name: 'Zengfy Skill', tag: 'Post-SSC Launchpad', url: 'http://skill.zengfy.test:8000', icon: '🎓', current: true },
  { name: 'Zengfy Pharmacy', tag: 'Drug & Batch', url: 'http://pharmacy.zengfy.test:8000', icon: '💊' },
  { name: 'Zengfy Hospital', tag: 'EMR & Diagnostic', url: 'http://hospital.zengfy.test:8000', icon: '🏥' },
];

export default function SkillNavbar({ brand = {} }) {
  const [waffleOpen, setWaffleOpen] = useState(false);
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
    <header role="banner" className="sticky top-0 z-40 w-full backdrop-blur-xl bg-white/85 border-b border-blue-100/80 shadow-xs transition-all">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex items-center justify-between h-16">
          {/* Brand Logo & Badge */}
          <div className="flex items-center gap-3">
            <a href="http://skill.zengfy.test:8000" className="flex items-center gap-2.5 group">
              <div className="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 via-blue-500 to-cyan-500 flex items-center justify-center text-white shadow-md shadow-blue-600/20 group-hover:scale-105 transition-all">
                <span className="text-xl">🎓</span>
              </div>
              <div className="flex flex-col">
                <div className="flex items-center gap-1.5">
                  <span className="font-extrabold text-lg tracking-tight text-slate-900 group-hover:text-blue-600 transition-colors">
                    Zengfy
                  </span>
                  <span className="font-extrabold text-lg tracking-tight bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent">
                    Skill
                  </span>
                  <span className="text-[10px] font-bold px-1.5 py-0.5 rounded-md bg-blue-100 text-blue-700 border border-blue-200">
                    Post-SSC
                  </span>
                </div>
                <span className="text-[10.5px] font-semibold text-slate-500 -mt-0.5 tracking-tight hidden sm:inline-block">
                  Verified Career Launchpad
                </span>
              </div>
            </a>
          </div>

          {/* Center Navigation Links */}
          <nav role="navigation" aria-label="Main Navigation" className="hidden md:flex items-center gap-1 p-1 rounded-full bg-slate-100/80 border border-slate-200/60 shadow-xs">
            <a href="#simulator" className="px-3.5 py-1.5 rounded-full text-xs font-bold text-slate-600 hover:text-blue-700 hover:bg-white transition-all">
              ক্যারিয়ার গাইডেন্স কুইজ
            </a>
            <a href="#journeys" className="px-3.5 py-1.5 rounded-full text-xs font-bold text-slate-600 hover:text-blue-700 hover:bg-white transition-all">
              স্টেকহোল্ডার ভিউ
            </a>
            <a href="#pillars" className="px-3.5 py-1.5 rounded-full text-xs font-bold text-slate-600 hover:text-blue-700 hover:bg-white transition-all">
              সার্বভৌম পিলার
            </a>
            <a href="#pricing" className="px-3.5 py-1.5 rounded-full text-xs font-bold text-slate-600 hover:text-blue-700 hover:bg-white transition-all">
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
                className="w-9 h-9 rounded-xl flex items-center justify-center text-slate-600 hover:text-blue-600 hover:bg-blue-50 border border-slate-200/80 hover:border-blue-200 transition-all cursor-pointer"
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

              {/* Waffle Dropdown Modal (13 Platforms) */}
              {waffleOpen && (
                <div className="absolute right-0 mt-2 w-80 sm:w-96 p-3 rounded-2xl bg-white/95 backdrop-blur-2xl border border-slate-200/90 shadow-2xl z-50 animate-in fade-in zoom-in-95 duration-150">
                  <div className="flex items-center justify-between pb-2 mb-2 border-b border-slate-100">
                    <span className="text-xs font-bold text-slate-500 uppercase tracking-wider">
                      Zengfy Sovereign Ecosystem (13 Platforms)
                    </span>
                    <span className="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-blue-100 text-blue-700 font-mono">
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
                            ? 'bg-blue-50 border border-blue-200 text-blue-950 font-bold'
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
              href="http://zengfy.test:8000/login?continue=http%3A%2F%2Fskill.zengfy.test%3A8000%2F"
              className="hidden sm:inline-flex items-center justify-center px-4 py-2 rounded-xl text-xs font-bold text-slate-700 hover:text-blue-700 hover:bg-blue-50/80 border border-slate-200/80 transition-all"
            >
              লগইন / SSO
            </a>

            {/* Main CTA */}
            <a
              href="http://zengfy.test:8000/register?continue=http%3A%2F%2Fskill.zengfy.test%3A8000%2F"
              className="inline-flex items-center justify-center px-4 py-2 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-blue-600 via-blue-500 to-cyan-500 hover:from-blue-700 hover:to-cyan-600 shadow-md shadow-blue-600/25 hover:shadow-lg hover:shadow-blue-600/35 transition-all transform active:scale-95"
            >
              ফ্রি ট্রায়াল শুরু করুন
            </a>
          </div>
        </div>
      </div>
    </header>
  );
}
