import React, { useState } from 'react';

export default function ScheduleFooter({ brandData }) {
  const brand = brandData || {};
  const [lang, setLang] = useState('bn');

  return (
    <footer role="contentinfo" className="bg-slate-950 border-t border-slate-800 text-slate-400 text-sm py-12">
      <div className="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
          {/* Brand Info */}
          <div className="md:col-span-2 space-y-4">
            <div className="flex items-center gap-3">
              <span className="w-9 h-9 rounded-xl bg-indigo-600 flex items-center justify-center text-white text-lg font-black shadow-md shadow-indigo-900/50">
                📅
              </span>
              <span className="text-xl font-extrabold text-white tracking-tight">
                {brand.name || 'Zengfy Schedule'}
              </span>
            </div>

            <p className="text-xs text-slate-400 max-w-md leading-relaxed">
              {brand.description || 'পেশাজীবীদের ক্লায়েন্ট অ্যাপয়েন্টমেন্ট বুকিং ও কনসালটেশন শিডিউলিং ক্যালেন্ডার ইআরপি। নো-শো রোধে স্বয়ংক্রিয় এসএমএস ও বিকাশ অগ্রিম ডিপোজিট কালেকশন।'}
            </p>

            <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-900 border border-slate-800 text-[11px] text-slate-300">
              <span>🇧🇩</span>
              <span>বাংলাদেশ প্রফেশনাল অ্যাপয়েন্টমেন্ট ও কনসালটেশন প্ল্যাটফর্ম</span>
            </div>
          </div>

          {/* Quick Links */}
          <div>
            <h4 className="text-xs uppercase tracking-wider text-white font-bold mb-4">
              প্ল্যাটফর্ম ফিচার
            </h4>
            <ul className="space-y-2 text-xs">
              <li>
                <a href="#simulator" className="hover:text-indigo-400 transition-colors">
                  বুকিং ক্যালেন্ডার স্যান্ডবক্স
                </a>
              </li>
              <li>
                <a href="#journeys" className="hover:text-indigo-400 transition-colors">
                  পেশাজীবী সমাধানসমূহ
                </a>
              </li>
              <li>
                <a href="#pillars" className="hover:text-indigo-400 transition-colors">
                  সার্বভৌম স্তম্ভসমূহ
                </a>
              </li>
              <li>
                <a href="#pricing" className="hover:text-indigo-400 transition-colors">
                  প্যাকেজ ও প্রাইসিং
                </a>
              </li>
            </ul>
          </div>

          {/* Security & Policies */}
          <div>
            <h4 className="text-xs uppercase tracking-wider text-white font-bold mb-4">
              পলিসি ও সিকিউরিটি
            </h4>
            <ul className="space-y-2 text-xs">
              <li>
                <span className="hover:text-indigo-400 cursor-pointer transition-colors">
                  ক্লায়েন্ট ডেটা প্রাইভেসি পলিসি
                </span>
              </li>
              <li>
                <span className="hover:text-indigo-400 cursor-pointer transition-colors">
                  এসএমএস ও হোয়াটসঅ্যাপ গেটওয়ে নির্দেশিকা
                </span>
              </li>
              <li>
                <span className="hover:text-indigo-400 cursor-pointer transition-colors">
                  বিকাশ নো-শো রিফান্ড পলিসি
                </span>
              </li>
              <li>
                <span className="hover:text-indigo-400 cursor-pointer transition-colors">
                  সার্বভৌম সংবিধান ও শর্তাবলী
                </span>
              </li>
            </ul>
          </div>
        </div>

        {/* Bottom Bar & Language Toggle */}
        <div className="pt-8 border-t border-slate-900 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-400">
          <div>
            © {new Date().getFullYear()} Zengfy Schedule. পেশাজীবীদের সময়ের পূর্ণ মর্যাদা। সর্বস্বত্ব সংরক্ষিত।
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
                    ? 'bg-indigo-600 text-white shadow-sm'
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
                    ? 'bg-indigo-600 text-white shadow-sm'
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
