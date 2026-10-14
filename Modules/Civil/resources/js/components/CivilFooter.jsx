import React from 'react';

export default function CivilFooter({ brand = {} }) {
  return (
    <footer className="relative border-t border-slate-200/80 bg-white/70 backdrop-blur-xl mt-24 text-slate-700">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 mb-12">
          {/* Brand Info */}
          <div className="lg:col-span-2 space-y-4">
            <div className="flex items-center gap-3">
              <div className="w-10 h-10 rounded-xl bg-gradient-to-br from-cyan-600 to-slate-900 flex items-center justify-center text-white shadow-md">
                <span className="text-xl">📐</span>
              </div>
              <div>
                <span className="text-xl font-black tracking-tight text-slate-900">
                  Zengfy <span className="text-cyan-600">Civil</span>
                </span>
                <span className="ml-2 inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold bg-cyan-50 text-cyan-800 border border-cyan-200/60">
                  SaaS Cloud Hub
                </span>
              </div>
            </div>

            <p className="text-sm text-slate-600 leading-relaxed max-w-sm">
              বাংলাদেশের সিভিল আর্কিটেক্ট, স্ট্রাকচারাল ফার্ম ও রিয়েল এস্টেট প্ল্যানারদের জন্য ৩ডি ল্যান্ড আর্কিটেকচার ও লাইভ ম্যাটেরিয়াল কস্টিং ইআরপি।
            </p>

            {/* Compliance Badge */}
            <div className="pt-2 flex items-center gap-2.5 text-xs text-slate-500">
              <span className="inline-flex items-center justify-center w-5 h-5 rounded-full bg-cyan-100 text-cyan-800 font-bold">
                ✓
              </span>
              <span>BNBC বিল্ডিং কোড ও রাজউক/পৌরসভা কমপ্লায়েন্ট ক্লাউড ইঞ্জিন</span>
            </div>

            {/* Language Switcher */}
            <div className="pt-2 flex items-center gap-2 text-xs">
              <span className="text-slate-400">ভাষা / Language:</span>
              <span className="px-2.5 py-1 rounded-md bg-cyan-50 text-cyan-900 font-bold border border-cyan-200 cursor-default">
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

          {/* Quick Engineering Links */}
          <div>
            <h4 className="text-xs font-bold text-slate-900 uppercase tracking-wider mb-4">
              সিভিল মডিউল
            </h4>
            <ul className="space-y-2.5 text-sm">
              <li>
                <a href="#simulator" className="text-slate-600 hover:text-cyan-600 transition-colors">
                  ৩ডি প্লট ভিজ্যুয়ালাইজার
                </a>
              </li>
              <li>
                <a href="#simulator" className="text-slate-600 hover:text-cyan-600 transition-colors">
                  লাইভ রড-সিমেন্ট কস্টিং
                </a>
              </li>
              <li>
                <a href="#simulator" className="text-slate-600 hover:text-cyan-600 transition-colors">
                  বার বেন্ডিং শিডিউল (BBS)
                </a>
              </li>
              <li>
                <a href="#pillars" className="text-slate-600 hover:text-cyan-600 transition-colors">
                  রাজউক ফার (FAR) ভ্যালিডেটর
                </a>
              </li>
              <li>
                <a href="#pillars" className="text-slate-600 hover:text-cyan-600 transition-colors">
                  সার্বভৌম প্রজেক্ট ভল্ট
                </a>
              </li>
            </ul>
          </div>

          {/* Structural Standards */}
          <div>
            <h4 className="text-xs font-bold text-slate-900 uppercase tracking-wider mb-4">
              বিল্ডিং স্ট্যান্ডার্ড
            </h4>
            <ul className="space-y-2.5 text-sm text-slate-600">
              <li>BNBC 2020 বিল্ডিং কোড</li>
              <li>রাজউক ও ড্যাপ (DAP) কমপ্লায়েন্স</li>
              <li>সিডিএ (চট্টগ্রাম) সেটব্যাক রুলস</li>
              <li>পৌরসভা ও আরডিএ স্ট্যান্ডার্ড</li>
              <li>সয়েল টেস্ট ও লোড বিয়ারিং ক্যালকুলেশন</li>
              <li>সাসটেইনেবল গ্রিন আর্কিটেকচার</li>
            </ul>
          </div>

          {/* Sovereign Ecosystem Directory */}
          <div>
            <h4 className="text-xs font-bold text-slate-900 uppercase tracking-wider mb-4">
              Zengfy ইকোসিস্টেম
            </h4>
            <ul className="space-y-2.5 text-sm">
              <li>
                <a href="http://zengfy.top:8000" className="text-slate-600 hover:text-cyan-600 transition-colors flex items-center justify-between">
                  <span>মাস্টার ইকোসিস্টেম</span>
                  <span className="text-[10px] bg-slate-100 text-slate-500 px-1.5 py-0.5 rounded font-mono">Hub</span>
                </a>
              </li>
              <li>
                <a href="http://social.zengfy.top:8000" className="text-slate-600 hover:text-cyan-600 transition-colors flex items-center justify-between">
                  <span>Zengfy Social</span>
                  <span className="text-[10px] bg-sky-100 text-sky-700 px-1.5 py-0.5 rounded font-mono">NID</span>
                </a>
              </li>
              <li>
                <a href="http://school.zengfy.top:8000" className="text-slate-600 hover:text-cyan-600 transition-colors flex items-center justify-between">
                  <span>Zengfy School</span>
                  <span className="text-[10px] bg-emerald-100 text-emerald-700 px-1.5 py-0.5 rounded font-mono">Edu</span>
                </a>
              </li>
              <li>
                <a href="http://pos.zengfy.top:8000" className="text-slate-600 hover:text-cyan-600 transition-colors flex items-center justify-between">
                  <span>Zengfy POS</span>
                  <span className="text-[10px] bg-amber-100 text-amber-700 px-1.5 py-0.5 rounded font-mono">Retail</span>
                </a>
              </li>
              <li>
                <a href="http://law.zengfy.top:8000" className="text-slate-600 hover:text-cyan-600 transition-colors flex items-center justify-between">
                  <span>Zengfy Law</span>
                  <span className="text-[10px] bg-rose-100 text-rose-800 px-1.5 py-0.5 rounded font-mono">Legal</span>
                </a>
              </li>
              <li>
                <a href="http://civil.zengfy.top:8000" className="text-cyan-900 font-bold flex items-center justify-between">
                  <span>Zengfy Civil</span>
                  <span className="text-[10px] bg-cyan-100 text-cyan-800 px-1.5 py-0.5 rounded font-bold font-mono">Live</span>
                </a>
              </li>
            </ul>
          </div>
        </div>

        {/* Bottom Copyright */}
        <div className="pt-8 border-t border-slate-200/60 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
          <p>
            © {new Date().getFullYear()} Zengfy Civil — Sovereign 3D Architecture & Construction Costing Cloud. All rights reserved.
          </p>
          <div className="flex items-center gap-6">
            <span className="flex items-center gap-1.5">
              <span className="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
              লাইভ ম্যাটেরিয়াল প্রাইসিং সার্ভার সিঙ্ক: সক্রিয়
            </span>
            <a href="http://civil.zengfy.top:8000/login" className="hover:text-cyan-600 font-semibold">
              ইঞ্জিনিয়ার লগইন (SSO)
            </a>
          </div>
        </div>
      </div>
    </footer>
  );
}
