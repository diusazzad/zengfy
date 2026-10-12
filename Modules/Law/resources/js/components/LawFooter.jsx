import React from 'react';

export default function LawFooter({ brand, ecosystem = [] }) {
  return (
    <footer className="relative border-t border-slate-200/80 bg-white/70 backdrop-blur-xl mt-24 text-slate-700">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 mb-12">
          {/* Brand Info */}
          <div className="lg:col-span-2 space-y-4">
            <div className="flex items-center gap-3">
              <div className="w-10 h-10 rounded-xl bg-gradient-to-br from-rose-900 to-rose-950 flex items-center justify-center text-amber-300 shadow-md">
                <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                </svg>
              </div>
              <div>
                <span className="text-xl font-black tracking-tight text-slate-900">
                  Zengfy <span className="text-rose-900">Law</span>
                </span>
                <span className="ml-2 inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold bg-amber-50 text-amber-800 border border-amber-200/60">
                  ডিজিটাল চেম্বার
                </span>
              </div>
            </div>

            <p className="text-sm text-slate-600 leading-relaxed max-w-sm">
              বাংলাদেশের সম্মানিত আইনজীবী, সিনিয়র চেম্বার ও আদালতের মুহুরীদের জন্য কজলিস্ট ট্র্যাকার, ওকালতনামা ও ডিজিটাল কেস ভল্ট।
            </p>

            {/* Security Compliance Badge */}
            <div className="pt-2 flex items-center gap-2.5 text-xs text-slate-500">
              <span className="inline-flex items-center justify-center w-5 h-5 rounded-full bg-emerald-100 text-emerald-800 font-bold">
                ✓
              </span>
              <span>২৫৬-বিট এন্ড-টু-এন্ড ক্লায়েন্ট এনক্রিপশন ও গোপনীয়তা গ্যারান্টি</span>
            </div>

            {/* Language Switcher */}
            <div className="pt-2 flex items-center gap-2 text-xs">
              <span className="text-slate-400">ভাষা / Language:</span>
              <span className="px-2.5 py-1 rounded-md bg-rose-50 text-rose-900 font-bold border border-rose-200 cursor-default">
                🇧🇩 বাংলা
              </span>
              <button 
                type="button" 
                onClick={() => alert('English interface version is active in settings.')}
                className="px-2.5 py-1 rounded-md bg-slate-100 text-slate-600 hover:text-slate-900 hover:bg-slate-200 border border-slate-200 transition-colors"
              >
                🇬🇧 English
              </button>
            </div>
          </div>

          {/* Quick Legal Links */}
          <div>
            <h4 className="text-xs font-bold text-slate-900 uppercase tracking-wider mb-4">
              আইনি মডিউল
            </h4>
            <ul className="space-y-2.5 text-sm">
              <li>
                <a href="#simulator" className="text-slate-600 hover:text-rose-900 transition-colors">
                  লাইভ কজলিস্ট ট্র্যাকার
                </a>
              </li>
              <li>
                <a href="#simulator" className="text-slate-600 hover:text-rose-900 transition-colors">
                  ওকালতনামা ও পিটিশন ড্রাফটার
                </a>
              </li>
              <li>
                <a href="#simulator" className="text-slate-600 hover:text-rose-900 transition-colors">
                  মক্কেল শুনানির এসএমএস
                </a>
              </li>
              <li>
                <a href="#features" className="text-slate-600 hover:text-rose-900 transition-colors">
                  মুহুরি ও পেশকার ট্রানজেকশন
                </a>
              </li>
              <li>
                <a href="#features" className="text-slate-600 hover:text-rose-900 transition-colors">
                  সার্বভৌম দলিল ও খতিয়ান ভল্ট
                </a>
              </li>
            </ul>
          </div>

          {/* Court Jurisdictions */}
          <div>
            <h4 className="text-xs font-bold text-slate-900 uppercase tracking-wider mb-4">
              আদালত এখতিয়ার
            </h4>
            <ul className="space-y-2.5 text-sm text-slate-600">
              <li>সুপ্রিম কোর্ট অব বাংলাদেশ</li>
              <li>হাইকোর্ট বিভাগ কজলিস্ট</li>
              <li>আপিল বিভাগ ও চেম্বার জজ</li>
              <li>৬৪ জেলা ও দায়রা জজ আদালত</li>
              <li>চিফ জুডিসিয়াল ও মেট্রোপলিটন কোর্ট</li>
              <li>ল্যান্ড সার্ভে ও শ্রম ট্রাইব্যুনাল</li>
            </ul>
          </div>

          {/* Sovereign Ecosystem Directory */}
          <div>
            <h4 className="text-xs font-bold text-slate-900 uppercase tracking-wider mb-4">
              Zengfy ইকোসিস্টেম
            </h4>
            <ul className="space-y-2.5 text-sm">
              <li>
                <a href="http://zengfy.test:8000" className="text-slate-600 hover:text-rose-900 transition-colors flex items-center justify-between">
                  <span>মাস্টার ইকোসিস্টেম</span>
                  <span className="text-[10px] bg-slate-100 text-slate-500 px-1.5 py-0.5 rounded font-mono">Hub</span>
                </a>
              </li>
              <li>
                <a href="http://social.zengfy.test:8000" className="text-slate-600 hover:text-rose-900 transition-colors flex items-center justify-between">
                  <span>Zengfy Social</span>
                  <span className="text-[10px] bg-sky-100 text-sky-700 px-1.5 py-0.5 rounded font-mono">NID</span>
                </a>
              </li>
              <li>
                <a href="http://school.zengfy.test:8000" className="text-slate-600 hover:text-rose-900 transition-colors flex items-center justify-between">
                  <span>Zengfy School</span>
                  <span className="text-[10px] bg-emerald-100 text-emerald-700 px-1.5 py-0.5 rounded font-mono">Edu</span>
                </a>
              </li>
              <li>
                <a href="http://pos.zengfy.test:8000" className="text-slate-600 hover:text-rose-900 transition-colors flex items-center justify-between">
                  <span>Zengfy POS</span>
                  <span className="text-[10px] bg-amber-100 text-amber-700 px-1.5 py-0.5 rounded font-mono">Retail</span>
                </a>
              </li>
              <li>
                <a href="http://law.zengfy.test:8000" className="text-rose-950 font-semibold flex items-center justify-between">
                  <span>Zengfy Law</span>
                  <span className="text-[10px] bg-rose-100 text-rose-800 px-1.5 py-0.5 rounded font-bold font-mono">Live</span>
                </a>
              </li>
            </ul>
          </div>
        </div>

        {/* Bottom Legal Copyright & Architecture note */}
        <div className="pt-8 border-t border-slate-200/60 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
          <p>
            © {new Date().getFullYear()} Zengfy Law — Sovereign Legal Infrastructure for Bangladesh Bar Council Advocates. All rights reserved.
          </p>
          <div className="flex items-center gap-6">
            <span className="flex items-center gap-1.5">
              <span className="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
              সুপ্রিম কোর্ট ও জেলা কজলিস্ট সার্ভার সিঙ্ক: সক্রিয়
            </span>
            <a href="http://law.zengfy.test:8000/login" className="hover:text-rose-900 font-semibold">
              আইনজীবী লগইন (SSO)
            </a>
          </div>
        </div>
      </div>
    </footer>
  );
}
