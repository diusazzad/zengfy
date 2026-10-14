import React, { useState, useEffect, useRef } from 'react';

const ECOSYSTEM_APPS = [
  { name: 'Zengfy Ecosystem', tag: 'Master Sovereign', url: 'http://zengfy.test:8000', icon: '🏛️' },
  { name: 'Zengfy Social', tag: 'Decentralized Feed', url: 'http://social.zengfy.top:8000', icon: '💬' },
  { name: 'Zengfy School', tag: 'Madrasa & School ERP', url: 'http://school.zengfy.top:8000', icon: '🏫' },
  { name: 'Zengfy POS', tag: 'Dokan & Inventory', url: 'http://pos.zengfy.top:8000', icon: '🏪' },
  { name: 'Zengfy Law', tag: 'Court & Legal Case', url: 'http://law.zengfy.top:8000', icon: '⚖️' },
  { name: 'Zengfy Civil', tag: 'Construction & BOQ', url: 'http://civil.zengfy.top:8000', icon: '📐' },
  { name: 'Zengfy NGO', tag: 'Zakat & Relief Mesh', url: 'http://ngo.zengfy.top:8000', icon: '🤝' },
  { name: 'Zengfy Rent', tag: 'Property & Flat', url: 'http://rent.zengfy.top:8000', icon: '🔑' },
  { name: 'Zengfy Hotel', tag: 'Resort & ERP', url: 'http://hotel.zengfy.top:8000', icon: '🏨' },
  { name: 'Zengfy Shop', tag: 'D2C & Anti-Fraud', url: 'http://shop.zengfy.top:8000', icon: '🛒' },
  { name: 'Zengfy Skill', tag: 'Post-SSC Launchpad', url: 'http://skill.zengfy.test:8000', icon: '🎓' },
  { name: 'Zengfy Journal', tag: 'Sovereign Op-Ed', url: 'http://journal.zengfy.test:8000', icon: '📰' },
  { name: 'Zengfy Habit', tag: 'Salah & Streak Mesh', url: 'http://habit.zengfy.test:8000', icon: '🌱', current: true },
];

export default function HabitNavbar({ brand = {} }) {
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
    <header role="banner" className="sticky top-0 z-40 w-full backdrop-blur-xl bg-white/90 border-b border-emerald-100/80 shadow-xs transition-all">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex items-center justify-between h-16">
          {/* Brand Logo & Badge */}
          <div className="flex items-center gap-3">
            <a href="http://habit.zengfy.test:8000" className="flex items-center gap-2.5 group">
              <div className="w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-800 via-emerald-600 to-amber-500 flex items-center justify-center text-white shadow-md shadow-emerald-900/20 group-hover:scale-105 transition-all">
                <span className="text-xl">🌱</span>
              </div>
              <div className="flex flex-col">
                <div className="flex items-center gap-1.5">
                  <span className="font-extrabold text-lg tracking-tight text-slate-900 group-hover:text-emerald-700 transition-colors">
                    Zengfy
                  </span>
                  <span className="font-extrabold text-lg tracking-tight bg-gradient-to-r from-emerald-600 to-amber-600 bg-clip-text text-transparent">
                    Habit
                  </span>
                  <span className="text-[10px] font-bold px-1.5 py-0.5 rounded-md bg-emerald-100 text-emerald-800 border border-emerald-200">
                    সালাত ও স্ট্রিক
                  </span>
                </div>
                <span className="text-[10.5px] font-semibold text-slate-500 -mt-0.5 tracking-tight hidden sm:inline-block">
                  ৫ ওয়াক্ত সালাত ও আত্মশুদ্ধি
                </span>
              </div>
            </a>
          </div>

          {/* Desktop Navigation Links */}
          <nav role="navigation" aria-label="Main Navigation" className="hidden lg:flex items-center gap-6">
            <a href="#simulator" className="text-xs font-bold text-slate-600 hover:text-emerald-700 transition-colors">
              সালাত ও স্ট্রিক ট্র্যাকার
            </a>
            <a href="#journeys" className="text-xs font-bold text-slate-600 hover:text-emerald-700 transition-colors">
              স্টেকহোল্ডার দৃষ্টিভঙ্গি
            </a>
            <a href="#pillars" className="text-xs font-bold text-slate-600 hover:text-emerald-700 transition-colors">
              সার্বভৌম চার স্তম্ভ
            </a>
            <a href="#pricing" className="text-xs font-bold text-slate-600 hover:text-emerald-700 transition-colors">
              প্যাকেজ ও লাইসেন্স
            </a>
          </nav>

          {/* Right Action Icons & Auth Controls */}
          <div className="flex items-center gap-3">
            {/* 9-Dot Waffle Menu */}
            <div className="relative" ref={waffleRef}>
              <button
                type="button"
                onClick={() => setWaffleOpen(!waffleOpen)}
                aria-expanded={waffleOpen}
                aria-label="Zengfy Sovereign Ecosystem Apps"
                className="w-9 h-9 rounded-xl flex items-center justify-center text-slate-600 hover:text-slate-900 hover:bg-emerald-50 border border-slate-200/80 transition-all cursor-pointer"
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

              {/* Waffle Dropdown Popover */}
              {waffleOpen && (
                <div className="absolute right-0 mt-2 w-80 sm:w-96 p-4 rounded-3xl bg-white/95 backdrop-blur-2xl border border-slate-200 shadow-2xl z-50 animate-in fade-in slide-in-from-top-2 duration-150">
                  <div className="flex items-center justify-between pb-3 mb-3 border-b border-slate-100">
                    <div className="flex items-center gap-2">
                      <span className="text-base">🇧🇩</span>
                      <span className="text-xs font-extrabold uppercase tracking-wider text-slate-700">
                        Zengfy Sovereign Ecosystem
                      </span>
                    </div>
                    <span className="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 font-mono">
                      13 APPS
                    </span>
                  </div>

                  <div className="grid grid-cols-3 gap-2 max-h-80 overflow-y-auto p-1">
                    {ECOSYSTEM_APPS.map((app, idx) => (
                      <a
                        key={idx}
                        href={app.url}
                        className={`flex flex-col items-center p-2.5 rounded-2xl text-center transition-all ${
                          app.current
                            ? 'bg-emerald-50 border border-emerald-300 shadow-xs'
                            : 'hover:bg-slate-50 border border-transparent'
                        }`}
                      >
                        <span className="text-2xl mb-1">{app.icon}</span>
                        <span className="text-[11px] font-bold text-slate-800 truncate w-full">
                          {app.name}
                        </span>
                        <span className="text-[9px] text-slate-400 font-medium truncate w-full">
                          {app.tag}
                        </span>
                      </a>
                    ))}
                  </div>
                </div>
              )}
            </div>

            {/* Central SSO Login Link */}
            <a
              href="http://zengfy.test:8000/login?continue=http%3A%2F%2Fhabit.zengfy.test%3A8000%2F"
              className="text-xs font-bold text-slate-700 hover:text-emerald-700 px-3 py-2 rounded-xl hover:bg-emerald-50 transition-colors hidden sm:inline-block"
            >
              লগইন
            </a>

            {/* CTA: Start Habit Tracking */}
            <a
              href="#simulator"
              className="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-emerald-600 via-emerald-700 to-teal-800 hover:from-emerald-500 hover:to-teal-700 shadow-md shadow-emerald-900/20 transform hover:-translate-y-0.5 transition-all cursor-pointer"
            >
              <span>🔥 স্ট্রিক শুরু করুন</span>
            </a>
          </div>
        </div>
      </div>
    </header>
  );
}
