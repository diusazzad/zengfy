import React, { useState } from 'react';

export default function ShopFooter() {
  const [lang, setLang] = useState('bn');

  return (
    <footer role="contentinfo" className="w-full bg-slate-900 text-slate-300 py-12 border-t border-slate-800">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
          {/* Brand Column */}
          <div className="md:col-span-2 space-y-4">
            <div className="flex items-center gap-2.5">
              <div className="w-9 h-9 rounded-xl bg-gradient-to-tr from-orange-500 via-orange-600 to-violet-600 flex items-center justify-center text-white text-lg font-bold shadow-md shadow-orange-500/20">
                🛒
              </div>
              <span className="text-xl font-extrabold text-white tracking-tight">
                Zengfy <span className="text-orange-500">Commerce</span>
              </span>
              <span className="text-[10px] font-bold px-2 py-0.5 rounded bg-orange-950 text-orange-400 border border-orange-800">
                D2C Anti-Fraud
              </span>
            </div>

            <p className="text-xs sm:text-sm text-slate-400 max-w-md leading-relaxed">
              বাংলাদেশের এফ-কমার্স ও ডিটুসি মার্চেন্টদের জন্য সার্বভৌম অ্যান্টি-ফ্রড আরটিও প্রিভেনশন, স্টিডফাস্ট ও পাঠাও এপিআই ইন্টিগ্রেশন এবং স্বয়ংক্রিয় সিওডি রিকনসিলিয়েশন ইকোসিস্টেম।
            </p>

            {/* Language Switcher */}
            <div className="pt-2 flex items-center gap-2">
              <span className="text-xs text-slate-400 font-semibold">ভাষা / Language:</span>
              <div className="inline-flex rounded-xl bg-slate-800 p-0.5 border border-slate-700">
                <button
                  type="button"
                  onClick={() => setLang('bn')}
                  className={`px-2.5 py-1 rounded-lg text-xs font-bold transition-all ${
                    lang === 'bn' ? 'bg-orange-600 text-white shadow-xs' : 'text-slate-400 hover:text-white'
                  }`}
                >
                  🇧🇩 বাংলা
                </button>
                <button
                  type="button"
                  onClick={() => setLang('en')}
                  className={`px-2.5 py-1 rounded-lg text-xs font-bold transition-all ${
                    lang === 'en' ? 'bg-orange-600 text-white shadow-xs' : 'text-slate-400 hover:text-white'
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
              <li><a href="#simulator" className="hover:text-orange-400 transition-colors">এআই রিটার্ন স্কোরার</a></li>
              <li><a href="#journeys" className="hover:text-orange-400 transition-colors">স্টেকহোল্ডার জার্নি</a></li>
              <li><a href="#pillars" className="hover:text-orange-400 transition-colors">কুরিয়ার এপিআই সিঙ্ক</a></li>
              <li><a href="#pricing" className="hover:text-orange-400 transition-colors">লাইসেন্সিং অফার</a></li>
              <li><a href="http://shop.zengfy.test:8000/api/v1/shop/landing" target="_blank" rel="noopener noreferrer" className="hover:text-orange-400 transition-colors">পাবলিক রেস্ট এপিআই (REST API)</a></li>
            </ul>
          </div>

          {/* Sovereign Ecosystem Directory */}
          <div>
            <h4 className="text-xs font-bold text-white uppercase tracking-wider mb-4">
              সার্বভৌম ইকোসিস্টেম
            </h4>
            <ul className="space-y-2 text-xs text-slate-400">
              <li><a href="http://zengfy.test:8000" className="hover:text-orange-400 transition-colors">🌐 Master Landing</a></li>
              <li><a href="http://social.zengfy.test:8000" className="hover:text-orange-400 transition-colors">👥 Zengfy Social</a></li>
              <li><a href="http://school.zengfy.test:8000" className="hover:text-orange-400 transition-colors">🎓 Zengfy School ERP</a></li>
              <li><a href="http://pos.zengfy.test:8000" className="hover:text-orange-400 transition-colors">🛍️ Zengfy POS Retail</a></li>
              <li><a href="http://law.zengfy.test:8000" className="hover:text-orange-400 transition-colors">⚖️ Zengfy Law</a></li>
              <li><a href="http://civil.zengfy.test:8000" className="hover:text-orange-400 transition-colors">📐 Zengfy Civil</a></li>
              <li><a href="http://ngo.zengfy.test:8000" className="hover:text-orange-400 transition-colors">🤝 Zengfy NGO</a></li>
              <li><a href="http://rent.zengfy.test:8000" className="hover:text-orange-400 transition-colors">🔑 Zengfy Rent</a></li>
              <li><a href="http://hotel.zengfy.test:8000" className="hover:text-orange-400 transition-colors">🏨 Zengfy Hotel</a></li>
              <li><a href="http://skill.zengfy.test:8000" className="hover:text-orange-400 transition-colors">🚀 Zengfy Skill</a></li>
              <li><a href="http://journal.zengfy.test:8000" className="hover:text-orange-400 transition-colors">✍️ Zengfy Journal</a></li>
              <li><a href="http://habit.zengfy.test:8000" className="hover:text-orange-400 transition-colors">⚡ Zengfy Habit</a></li>
              <li><a href="http://schedule.zengfy.test:8000" className="hover:text-orange-400 transition-colors">📅 Zengfy Schedule</a></li>
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
              100% Zero Data Harvesting
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
