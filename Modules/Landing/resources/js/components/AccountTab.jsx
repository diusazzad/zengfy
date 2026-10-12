import React from 'react';
import { User, ShieldCheck, Lock, ExternalLink, ArrowRight, Laptop, Smartphone } from 'lucide-react';

export default function AccountTab({ auth = {}, links = {} }) {
    const isAuthed = auth.is_authenticated && auth.user;
    const user = auth.user;

    return (
        <section className="py-6 sm:py-10 max-w-2xl mx-auto">
            <div className="bg-[#121A29] border border-white/[0.08] rounded-3xl p-6 sm:p-8 shadow-2xl relative overflow-hidden">
                <div className="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-600 via-indigo-500 to-cyan-400" />

                {isAuthed ? (
                    <div>
                        {/* User Profile Header */}
                        <div className="flex items-center gap-4 mb-6 pb-6 border-b border-white/[0.08]">
                            <div className="w-16 h-16 rounded-2xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center font-black text-2xl text-white shadow-lg shadow-blue-500/25">
                                {user.name ? user.name.charAt(0).toUpperCase() : 'Z'}
                            </div>
                            <div>
                                <div className="flex items-center gap-2">
                                    <h3 className="text-xl font-black text-white">{user.name}</h3>
                                    {user.is_verified && (
                                        <span className="p-1 rounded-full bg-blue-500 text-white" title="Verified Citizen">
                                            <ShieldCheck className="w-3.5 h-3.5" />
                                        </span>
                                    )}
                                </div>
                                <p className="text-xs text-gray-400 font-mono">@{user.handle || 'citizen'}</p>
                                <span className="inline-block mt-2 px-2.5 py-0.5 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-[10px] font-bold">
                                    Unified SSO Session Active
                                </span>
                            </div>
                        </div>

                        {/* Sovereign Hub Launch Button */}
                        <div className="space-y-3">
                            <a
                                href={links.account || "/account"}
                                className="w-full py-3.5 px-5 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-extrabold text-sm flex items-center justify-center gap-2 shadow-xl shadow-blue-600/30 transition-all"
                            >
                                <span>Open Full Sovereign Account Hub</span>
                                <ArrowRight className="w-4 h-4" />
                            </a>

                            <a
                                href={links.social || "http://social.zengfy.test:8000"}
                                className="w-full py-3 px-5 rounded-xl bg-white/[0.05] hover:bg-white/[0.08] border border-white/10 text-gray-200 font-bold text-xs flex items-center justify-center gap-2 transition"
                            >
                                <span>Go to Zengfy Social Hyperlocal Feed</span>
                                <ExternalLink className="w-3.5 h-3.5 text-cyan-400" />
                            </a>
                        </div>
                    </div>
                ) : (
                    <div className="text-center py-4">
                        <div className="w-16 h-16 rounded-2xl bg-white/[0.04] border border-white/10 flex items-center justify-center mx-auto mb-4 text-cyan-400">
                            <Lock className="w-8 h-8" />
                        </div>

                        <h3 className="text-xl font-black text-white mb-2">
                            Sovereign Central Identity
                        </h3>
                        <p className="text-xs sm:text-sm text-gray-400 max-w-md mx-auto leading-relaxed mb-6">
                            Sign in once with your verified credentials to synchronize identity, 256-bit vault permissions, and active devices across all 13 micro-SaaS subdomains.
                        </p>

                        <div className="flex flex-col sm:flex-row items-center justify-center gap-3">
                            <a
                                href={links.login || "/login"}
                                className="w-full sm:w-auto px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold shadow-lg shadow-blue-600/30 transition"
                            >
                                Sign In with SSO
                            </a>

                            <a
                                href={links.register || "/register"}
                                className="w-full sm:w-auto px-6 py-3 rounded-xl bg-white/[0.05] hover:bg-white/[0.1] border border-white/10 text-gray-200 text-xs font-bold transition"
                            >
                                Register Citizen ID
                            </a>
                        </div>
                    </div>
                )}
            </div>
        </section>
    );
}