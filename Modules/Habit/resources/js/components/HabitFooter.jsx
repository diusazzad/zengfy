import React, { useState } from 'react';

export default function HabitFooter({ brandData }) {
  const brand = brandData || {};
  const [lang, setLang] = useState('bn');

  return (
    <footer role="contentinfo" className="bg-slate-950 border-t border-slate-800 text-slate-400 text-sm py-12">
      <div className="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
          {/* Brand Info */}
          <div className="md:col-span-2 space-y-4">
            <div className="flex items-center gap-3">
              <span className="w-9 h-9 rounded-xl bg-emerald-600 flex items-center justify-center text-white text-lg font-black shadow-md shadow-emerald-900/50">
                🌱
              </span>
              <span className="text-xl font-extrabold text-white tracking-tight">
                {brand.name || 'Zengfy Habit'}
              </span>
            </div>

            <p className="text-xs text-slate-400 max-w-md leading-relaxed">
              {brand.description || '১০০% বিজ্ঞাপনহীন, লোকাল-ফার্স্ট ও ব্যক্তিগত ভল্ট আর্কিটেকচারে তৈরি সালাত ও মাইক্রো-হ্যাবিট ট্র্যাকার।'}
            </p>

            <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-900 border border-slate-800 text-[11px] text-slate-300">
              <span>🇧🇩</span>
              <span>বাংলাদেশ সালাত কনসিস্টেন্সি ও ফ্যামিলি অ্যাকাউন্টেবিলিটি প্ল্যাটফর্ম</span>
            </div>
          </div>

          {/* Quick Links */}
          <div>
            <h4 className="text-xs uppercase tracking-wider text-white font-bold mb-4">
              প্ল্যাটফর্ম ফিচার
            </h4>
            <ul className="space-y-2 text-xs">
              <li>
                <a href="#simulator" className="hover:text-emerald-400 transition-colors">
                  সালাত ও স্ট্রিক স্যান্ডবক্স
                </a>
              </li>
              <li>
                <a href="#journeys" className="hover:text-emerald-400 transition-colors">
                  স্টেকহোল্ডার দৃষ্টিভঙ্গি
                </a>
              </li>
              <li>
                <a href="#pillars" className="hover:text-emerald-400 transition-colors">
                  সার্বভৌম স্তম্ভসমূহ
                </a>
              </li>
              <li>
                <a href="#pricing" className="hover:text-emerald-400 transition-colors">
                  প্যাকেজ ও লাইসেন্স
                </a>
              </li>
            </ul>
          </div>

          {/* Privacy & Principles */}
          <div>
            <h4 className="text-xs uppercase tracking-wider text-white font-bold mb-4">
              নীতিমালা ও প্রাইভেসী
            </h4>
            <ul className="space-y-2 text-xs">
              <li>
                <span className="hover:text-emerald-400 cursor-pointer transition-colors">
                  ১০০% নো-অ্যাড প্রাইভেসী গ্যারান্টি
                </span>
              </li>
              <li>
                <span className="hover:text-emerald-400 cursor-pointer transition-colors">
                  লোকাল-ফার্স্ট অফলাইন স্টোরেজ পলিসি
                </span>
              </li>
              <li>
                <span className="hover:text-emerald-400 cursor-pointer transition-colors">
                  ফ্যামিলি রিং এনক্রিপশন প্রটোকল
                </span>
              </li>
              <li>
                <span className="hover:text-emerald-400 cursor-pointer transition-colors">
                  সার্বভৌম সংবিধান ও শর্তাবলী
                </span>
              </li>
            </ul>
          </div>
        </div>

        {/* Bottom Bar & Language Toggle */}
        <div className="pt-8 border-t border-slate-900 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-400">
          <div>
            © {new Date().getFullYear()} Zengfy Habit. ৫ ওয়াক্ত সালাত ও আত্মশুদ্ধির ধারাবাহিকতা। সর্বস্বত্ব সংরক্ষিত।
          </div>

          {/* Language Toggle */}
          <div className="flex items-center gap-2">
            <span className="text-[11px] text-slate-400">ভাষা / Language:</span>
            <div className="inline-flex rounded-lg bg-slate-900 border border-slate-800 p-0.5">
              <button
                type="button"
                onClick={() => setLang('bn')}
                aria-pressed={lang === 'bn'}
                className={`px-2.5 py-1 rounded-md text-xs font-semibold transition-all cursor-pointer ${
                  lang === 'bn'
                    ? 'bg-emerald-600 text-white shadow-sm'
                    : 'text-slate-400 hover:text-white'
                }`}
              >
                🇧🇩 বাংলা
              </button>
              <button
                type="button"
                onClick={() => setLang('en')}
                aria-pressed={lang === 'en'}
                className={`px-2.5 py-1 rounded-md text-xs font-semibold transition-all cursor-pointer ${
                  lang === 'en'
                    ? 'bg-emerald-600 text-white shadow-sm'
                    : 'text-slate-400 hover:text-white'
                }`}
              >
                🇬🇧 English
              </button>
            </div>
          </div>
        </div>
      </div>
    </footer>
  );
}
