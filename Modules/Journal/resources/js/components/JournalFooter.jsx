import React, { useState } from 'react';

export default function JournalFooter({ brandData }) {
  const brand = brandData || {};
  const [lang, setLang] = useState('bn');

  return (
    <footer role="contentinfo" className="bg-slate-950 border-t border-slate-800 text-slate-400 text-sm py-12">
      <div className="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
          {/* Brand Info */}
          <div className="md:col-span-2 space-y-4">
            <div className="flex items-center gap-3">
              <span className="w-9 h-9 rounded-xl bg-rose-700 flex items-center justify-center text-white text-lg font-black shadow-md shadow-rose-900/50">
                J
              </span>
              <span className="text-xl font-extrabold text-white tracking-tight">
                {brand.name || 'Zengfy Journal'}
              </span>
            </div>

            <p className="text-xs text-slate-400 max-w-md leading-relaxed">
              {brand.description || 'করপোরেট মিডিয়া হাউস বা রাজনৈতিক সেন্সরশিপের ভয় ছাড়া নিজের স্বাধীন এডিটোরিয়াল কলাম প্রকাশ ও পাঠকদের সরাসরি বিকাশ/নগদ সাবস্ক্রিপশন থেকে আয়ের সার্বভৌম প্ল্যাটফর্ম।'}
            </p>

            <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-900 border border-slate-800 text-[11px] text-slate-300">
              <span>🇧🇩</span>
              <span>বাংলাদেশ স্বাধীন সাংবাদিকতা ও সার্বভৌম অপ-এড নেটওয়ার্ক</span>
            </div>
          </div>

          {/* Quick Links */}
          <div>
            <h4 className="text-xs uppercase tracking-wider text-white font-bold mb-4">
              প্ল্যাটফর্ম ফিচার
            </h4>
            <ul className="space-y-2 text-xs">
              <li>
                <a href="#simulator" className="hover:text-rose-400 transition-colors">
                  অপ-এড পে-ওয়াল প্রিভিউ
                </a>
              </li>
              <li>
                <a href="#journeys" className="hover:text-rose-400 transition-colors">
                  স্টেকহোল্ডার জার্নি
                </a>
              </li>
              <li>
                <a href="#pillars" className="hover:text-rose-400 transition-colors">
                  সার্বভৌম স্তম্ভসমূহ
                </a>
              </li>
              <li>
                <a href="#pricing" className="hover:text-rose-400 transition-colors">
                  সাবস্ক্রিপশন ও প্রাইসিং
                </a>
              </li>
            </ul>
          </div>

          {/* Legal & Security */}
          <div>
            <h4 className="text-xs uppercase tracking-wider text-white font-bold mb-4">
              আইন ও সোর্স সুরক্ষা
            </h4>
            <ul className="space-y-2 text-xs">
              <li>
                <span className="hover:text-rose-400 cursor-pointer transition-colors">
                  জিরো-নলেজ সিকিউরিটি পলিসি
                </span>
              </li>
              <li>
                <span className="hover:text-rose-400 cursor-pointer transition-colors">
                  হুইসেলব্লোয়ার এনক্রিপশন নির্দেশিকা
                </span>
              </li>
              <li>
                <span className="hover:text-rose-400 cursor-pointer transition-colors">
                  কপিরাইট ও লেখক মালিকানা শর্ত
                </span>
              </li>
              <li>
                <span className="hover:text-rose-400 cursor-pointer transition-colors">
                  সার্বভৌম সংবিধান ও নীতিমালা
                </span>
              </li>
            </ul>
          </div>
        </div>

        {/* Bottom Bar & Language Toggle */}
        <div className="pt-8 border-t border-slate-900 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-400">
          <div>
            © {new Date().getFullYear()} Zengfy Journal. সার্বভৌম মতপ্রকাশের পূর্ণ নিশ্চয়তা। সর্বস্বত্ব সংরক্ষিত।
          </div>

          {/* Language Toggle */}
          <div className="flex items-center gap-2">
            <span className="text-[11px] text-slate-400">ভাষা / Language:</span>
            <div className="inline-flex rounded-lg bg-slate-900 border border-slate-800 p-0.5">
              <button
                type="button"
                onClick={() => setLang('bn')}
                aria-pressed={lang === 'bn'}
                className={`px-2.5 py-1 rounded-md text-xs font-semibold transition-all ${
                  lang === 'bn'
                    ? 'bg-rose-700 text-white shadow-sm'
                    : 'text-slate-400 hover:text-white'
                }`}
              >
                🇧🇩 বাংলা
              </button>
              <button
                type="button"
                onClick={() => setLang('en')}
                aria-pressed={lang === 'en'}
                className={`px-2.5 py-1 rounded-md text-xs font-semibold transition-all ${
                  lang === 'en'
                    ? 'bg-rose-700 text-white shadow-sm'
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
