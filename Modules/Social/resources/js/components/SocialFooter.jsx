import React from 'react';
import { ArrowUpRight, Smartphone, Shield } from 'lucide-react';

export default function SocialFooter({ links = {} }) {
    return (
        <footer role="contentinfo" className="mt-8 pt-10 pb-16 border-t border-slate-200/70 text-xs text-slate-500">
            <div className="max-w-6xl mx-auto px-4 sm:px-6">
                <div className="flex flex-col md:flex-row items-center justify-between gap-6 pb-8 border-b border-slate-200/50">
                    
                    {/* Brand Info */}
                    <div className="flex items-center gap-3">
                        <div aria-hidden="true" className="w-9 h-9 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center font-black text-lg text-white shadow-xs">
                            Z
                        </div>
                        <div>
                            <div className="font-extrabold text-slate-900 text-sm">
                                Zengfy Social &bull; Sovereign Citizen Mesh
                            </div>
                            <div className="text-[11px] text-slate-400">
                                Real people, authentic communities, zero bots &bull; Bangladesh.
                            </div>
                        </div>
                    </div>

                    {/* Links */}
                    <div className="flex flex-wrap items-center justify-center gap-5 font-semibold text-slate-600">
                        <a href={links.home || "http://zengfy.test:8000/"} className="hover:text-blue-600 transition">
                            Master Ecosystem Hub
                        </a>
                        <a href={links.download || "http://zengfy.test:8000/download"} className="hover:text-blue-600 transition flex items-center gap-1">
                            <Smartphone aria-hidden="true" className="w-3.5 h-3.5 text-emerald-600" />
                            <span>Android APK</span>
                        </a>
                        <a
                            href={links.api_docs || "/api/v1/social/landing"}
                            target="_blank"
                            rel="noopener noreferrer"
                            className="hover:text-blue-600 transition flex items-center gap-1"
                        >
                            <span>REST API v1</span>
                            <ArrowUpRight aria-hidden="true" className="w-3 h-3" />
                        </a>
                    </div>
                </div>

                <div className="pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-center sm:text-left text-[11px] text-slate-400">
                    <div>
                        &copy; {new Date().getFullYear()} Zengfy Social. All rights reserved. Sovereign NID Verified Network.
                    </div>
                    <div className="flex items-center gap-2">
                        <span aria-hidden="true" className="w-2 h-2 rounded-full bg-emerald-500" />
                        <span>Hyperlocal Sentinel Mesh Active across 4,554 Wards</span>
                    </div>
                </div>
            </div>
        </footer>
    );
}
