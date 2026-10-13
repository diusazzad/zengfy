import React, { useState } from 'react';

export default function SkillFooter() {
  const [lang, setLang] = useState('bn');

  return (
    <footer role="contentinfo" className="w-full bg-slate-900 text-slate-300 py-12 border-t border-slate-800">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
          {/* Brand Column */}
          <div className="md:col-span-2 space-y-4">
            <div className="flex items-center gap-2.5">
              <div className="w-9 h-9 rounded-xl bg-gradient-to-tr from-blue-500 via-blue-600 to-cyan-500 flex items-center justify-center text-white text-lg font-bold shadow-md shadow-blue-500/20">
                🎓
              </div>
              <span className="text-xl font-extrabold text-white tracking-tight">
                Zengfy <span className="text-blue-500">Skill</span>
              </span>
              <span className="text-[10px] font-bold px-2 py-0.5 rounded bg-blue-950 text-blue-400 border border-blue-800">
                Post-SSC Verified
              </span>
            </div>

            <p className="text-xs sm:text-sm text-slate-400 max-w-md leading-relaxed">
              এসএসসি ও এইচএসসি পরবর্তী শিক্ষার্থীদের জন্য ভেরিফাইড মেন্টরশিপ ও প্র্যাক্টিক্যাল ক্যারিয়ার হাব। এনআইডি ডিজিটাল কিউআর সার্টিফিকেট এবং প্রতারণামুক্ত স্কিল এডুকেশন প্ল্যাটফর্ম।
            </p>

            {/* Language Switcher */}
            <div className="pt-2 flex items-center gap-2">
              <span className="text-xs text-slate-400 font-semibold">ভাষা / Language:</span>
              <div className="inline-flex rounded-xl bg-slate-800 p-0.5 border border-slate-700">
                <button
                  type="button"
                  onClick={() => setLang('bn')}
                  className={`px-2.5 py-1 rounded-lg text-xs font-bold transition-all ${
                    lang === 'bn' ? 'bg-blue-600 text-white shadow-xs' : 'text-slate-400 hover:text-white'
                  }`}
                >
                  🇧🇩 বাংলা
                </button>
                <button
                  type="button"
                  onClick={() => setLang('en')}
                  className={`px-2.5 py-1 rounded-lg text-xs font-bold transition-all ${
                    lang === 'en' ? 'bg-blue-600 text-white shadow-xs' : 'text-slate-400 hover:text-white'
                  }`}
                >
                  🇬🇧 English
                </button>
              </div>
            </div>
          </div>

          {/* Quick Links */}
          <div>
            <h4 className="text-xs font-bold text-white uppercase tracking-wider mb-4">
              প্ল্যাটফর্ম ফিচার
            </h4>
            <ul className="space-y-2 text-xs text-slate-400">
              <li><a href="#simulator" className="hover:text-blue-400 transition-colors">ক্যারিয়ার গাইডেন্স কুইজ</a></li>
              <li><a href="#journeys" className="hover:text-blue-400 transition-colors">স্টেকহোল্ডার জার্নি</a></li>
              <li><a href="#pillars" className="hover:text-blue-400 transition-colors">সার্বভৌম শিক্ষা স্তম্ভ</a></li>
              <li><a href="#pricing" className="hover:text-blue-400 transition-colors">প্রাইসিং প্যাকেজ</a></li>
              <li><a href="http://skill.zengfy.test:8000/api/v1/skill/landing" target="_blank" rel="noopener noreferrer" className="hover:text-blue-400 transition-colors">পাবলিক রেস্ট এপিআই (REST API)</a></li>
            </ul>
          </div>

          {/* Sovereign Ecosystem Directory */}
          <div>
            <h4 className="text-xs font-bold text-white uppercase tracking-wider mb-4">
              সার্বভৌম ইকোসিস্টেম
            </h4>
            <ul className="space-y-2 text-xs text-slate-400">
              <li><a href="http://zengfy.test:8000" className="hover:text-blue-400 transition-colors">Master Landing</a></li>
              <li><a href="http://social.zengfy.test:8000" className="hover:text-blue-400 transition-colors">Zengfy Social</a></li>
              <li><a href="http://school.zengfy.test:8000" className="hover:text-blue-400 transition-colors">Zengfy School ERP</a></li>
              <li><a href="http://shop.zengfy.test:8000" className="hover:text-blue-400 transition-colors">Zengfy Shop D2C</a></li>
              <li><a href="http://hotel.zengfy.test:8000" className="hover:text-blue-400 transition-colors">Zengfy Hotel ERP</a></li>
            </ul>
          </div>
        </div>

        {/* Bottom Strip */}
        <div className="pt-8 border-t border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-400">
          <div>
            © 2026 Zengfy Sovereign Ecosystem. All rights reserved. Made with pride for Bangladesh 🇧🇩
          </div>
          <div className="flex items-center gap-4">
            <span className="inline-flex items-center gap-1.5 text-emerald-400">
              <span className="w-2 h-2 rounded-full bg-emerald-500 animate-pulse" />
              100% NID Verified Mentors
            </span>
            <a href="http://zengfy.test:8000" className="hover:text-slate-300 transition-colors">
              সার্বভৌম নিরাপত্তা সনদ
            </a>
          </div>
        </div>
      </div>
    </footer>
  );
}
