import React from 'react';

export default function RentFooter({ brand = {} }) {
  return (
    <footer className="relative border-t border-slate-200/80 bg-white/70 backdrop-blur-xl mt-24 text-slate-700">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 mb-12">
          {/* Brand Info */}
          <div className="lg:col-span-2 space-y-4">
            <div className="flex items-center gap-3">
              <div className="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-700 via-indigo-800 to-emerald-600 flex items-center justify-center text-white shadow-md">
                <span className="text-xl">🔑</span>
              </div>
              <div>
                <span className="text-xl font-black tracking-tight text-slate-900">
                  Zengfy <span className="text-indigo-700">Rent</span>
                </span>
                <span className="ml-2 inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-200/60">
                  Zero Broker Mesh
                </span>
              </div>
            </div>

            <p className="text-sm text-slate-600 leading-relaxed max-w-sm">
              বাংলাদেশের প্রথম হাইপারলোকাল পে-পার-কিমি বাসা ও মেস ভাড়া প্ল্যাটফর্ম। জিরো ব্রোকার ফি ও সরাসরি বাড়িওয়ালার আসল ফোন নম্বর আনলক।
            </p>

            {/* Compliance Badge */}
            <div className="pt-2 flex items-center gap-2.5 text-xs text-slate-500">
              <span className="inline-flex items-center justify-center w-5 h-5 rounded-full bg-emerald-100 text-emerald-800 font-bold">
                ✓
              </span>
              <span>বাংলাদেশ বাড়িভাড়া নিয়ন্ত্রণ আইন ও পুলিশ ভেরিফিকেশন (CIMS) ফরম্যাট কমপ্লায়েন্ট</span>
            </div>

            {/* Language Switcher */}
            <div className="pt-2 flex items-center gap-2 text-xs">
              <span className="text-slate-400">ভাষা / Language:</span>
              <span className="px-2.5 py-1 rounded-md bg-indigo-50 text-indigo-900 font-bold border border-indigo-200 cursor-default">
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

          {/* Quick Rental Links */}
          <div>
            <h4 className="text-xs font-bold text-slate-900 uppercase tracking-wider mb-4">
              ভাড়া মডিউল
            </h4>
            <ul className="space-y-2.5 text-sm">
              <li>
                <a href="#simulator" className="text-slate-600 hover:text-indigo-700 transition-colors">
                  ১ কিমি টু-লেট আনলকার (৳৫০)
                </a>
              </li>
              <li>
                <a href="#simulator" className="text-slate-600 hover:text-indigo-700 transition-colors">
                  ৩ কিমি মেগা কভারেজ (৳২৫০)
                </a>
              </li>
              <li>
                <a href="#pricing" className="text-slate-600 hover:text-indigo-700 transition-colors">
                  বাড়িওয়ালা ফ্ল্যাট পোস্ট (৳২৫০)
                </a>
              </li>
              <li>
                <a href="#pillars" className="text-slate-600 hover:text-indigo-700 transition-colors">
                  ডিজিটাল বাড়িভাড়া চুক্তি ভল্ট
                </a>
              </li>
              <li>
                <a href="#pillars" className="text-slate-600 hover:text-indigo-700 transition-colors">
                  পুলিশ ভেরিফিকেশন ফরম (CIMS)
                </a>
              </li>
            </ul>
          </div>

          {/* Popular Cities */}
          <div>
            <h4 className="text-xs font-bold text-slate-900 uppercase tracking-wider mb-4">
              জনপ্রিয় এলাকা
            </h4>
            <ul className="space-y-2.5 text-sm text-slate-600">
              <li>ঢাকা — মিরপুর ও শেওড়াপাড়া</li>
              <li>ঢাকা — ধানমন্ডি ও কলাবাগান</li>
              <li>ঢাকা — শান্তিনগর ও কাকরাইল</li>
              <li>ঢাকা — উত্তরা সেক্টর ১-১৮</li>
              <li>চট্টগ্রাম — জিইসি ও নাসিরাবাদ</li>
              <li>সিলেট — জিন্দাবাজার ও আম্বরখানা</li>
            </ul>
          </div>

          {/* Sovereign Ecosystem Directory */}
          <div>
            <h4 className="text-xs font-bold text-slate-900 uppercase tracking-wider mb-4">
              Zengfy ইকোসিস্টেম
            </h4>
            <ul className="space-y-2.5 text-sm">
              <li>
                <a href="http://zengfy.top:8000" className="text-slate-600 hover:text-indigo-700 transition-colors flex items-center justify-between">
                  <span>মাস্টার ইকোসিস্টেম</span>
                  <span className="text-[10px] bg-slate-100 text-slate-500 px-1.5 py-0.5 rounded font-mono">Hub</span>
                </a>
              </li>
              <li>
                <a href="http://social.zengfy.top:8000" className="text-slate-600 hover:text-indigo-700 transition-colors flex items-center justify-between">
                  <span>Zengfy Social</span>
                  <span className="text-[10px] bg-sky-100 text-sky-700 px-1.5 py-0.5 rounded font-mono">NID</span>
                </a>
              </li>
              <li>
                <a href="http://school.zengfy.top:8000" className="text-slate-600 hover:text-indigo-700 transition-colors flex items-center justify-between">
                  <span>Zengfy School</span>
                  <span className="text-[10px] bg-emerald-100 text-emerald-700 px-1.5 py-0.5 rounded font-mono">Edu</span>
                </a>
              </li>
              <li>
                <a href="http://pos.zengfy.top:8000" className="text-slate-600 hover:text-indigo-700 transition-colors flex items-center justify-between">
                  <span>Zengfy POS</span>
                  <span className="text-[10px] bg-amber-100 text-amber-700 px-1.5 py-0.5 rounded font-mono">Retail</span>
                </a>
              </li>
              <li>
                <a href="http://civil.zengfy.top:8000" className="text-slate-600 hover:text-indigo-700 transition-colors flex items-center justify-between">
                  <span>Zengfy Civil</span>
                  <span className="text-[10px] bg-cyan-100 text-cyan-800 px-1.5 py-0.5 rounded font-mono">3D</span>
                </a>
              </li>
              <li>
                <a href="http://ngo.zengfy.top:8000" className="text-slate-600 hover:text-indigo-700 transition-colors flex items-center justify-between">
                  <span>Zengfy NGO</span>
                  <span className="text-[10px] bg-teal-100 text-teal-800 px-1.5 py-0.5 rounded font-mono">Trust</span>
                </a>
              </li>
              <li>
                <a href="http://rent.zengfy.top:8000" className="text-indigo-900 font-bold flex items-center justify-between">
                  <span>Zengfy Rent</span>
                  <span className="text-[10px] bg-indigo-100 text-indigo-800 px-1.5 py-0.5 rounded font-bold font-mono">Live</span>
                </a>
              </li>
            </ul>
          </div>
        </div>

        {/* Bottom Copyright */}
        <div className="pt-8 border-t border-slate-200/60 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
          <p>
            © {new Date().getFullYear()} Zengfy Rent — Sovereign Hyperlocal Pay-Per-Km Rental Mesh. All rights reserved.
          </p>
          <div className="flex items-center gap-6">
            <span className="flex items-center gap-1.5">
              <span className="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
              জিপিএস মেশ ও মাইক্রো-পেমেন্ট গেটওয়ে: সক্রিয়
            </span>
            <a href="http://rent.zengfy.top:8000/login" className="hover:text-indigo-700 font-semibold">
              লগইন (SSO)
            </a>
          </div>
        </div>
      </div>
    </footer>
  );
}
