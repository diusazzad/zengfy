import React, { useState } from 'react';
import { Radio, ShieldAlert, CheckCircle2, Clock, MapPin, Users, BellRing } from 'lucide-react';

export default function EmergencySosRadarSection({ telemetry = {} }) {
    const [beaconActive, setBeaconActive] = useState(false);
    const [simulatedCount, setSimulatedCount] = useState(34);

    const handleTriggerTestBeacon = () => {
        setBeaconActive(true);
        setSimulatedCount((prev) => prev + 1);
        setTimeout(() => {
            setBeaconActive(false);
        }, 4000);
    };

    return (
        <section id="sos-radar-section" aria-label="Ward Emergency SOS Beacon Radar" className="pt-10 pb-20 border-t border-slate-200/70">
            <div className="max-w-6xl mx-auto px-4 sm:px-6">
                
                {/* Section Header */}
                <div className="text-center max-w-3xl mx-auto mb-12">
                    <span className="text-xs uppercase font-extrabold tracking-widest text-rose-600 bg-rose-50 px-3 py-1 rounded-full border border-rose-200/70">
                        Civic Emergency Mesh
                    </span>
                    <h2 className="text-3xl sm:text-5xl font-black text-slate-900 tracking-tight mt-3">
                        Ward SOS Beacon: Safety in Seconds.
                    </h2>
                    <p className="text-sm sm:text-base text-slate-600 mt-3 leading-relaxed">
                        In an accident, fire, or medical emergency, a single tap alerts verified neighbors and ward volunteer responders within a 750-meter radius in under 3.2 seconds.
                    </p>
                </div>

                {/* Radar Interactive Container */}
                <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center glass-panel rounded-3xl p-6 sm:p-10 border border-white/90 shadow-xl">
                    
                    {/* Left: Radar Visualizer */}
                    <div className="lg:col-span-5 flex flex-col items-center justify-center relative py-6">
                        
                        {/* Radar Concentric Rings */}
                        <div className="relative w-64 h-64 sm:w-72 sm:h-72 flex items-center justify-center">
                            {/* Outer Ring */}
                            <div className={`absolute inset-0 rounded-full border-2 transition-all ${
                                beaconActive
                                    ? 'border-rose-400/80 animate-ping'
                                    : 'border-slate-200/80'
                            }`} />
                            
                            {/* Mid Ring */}
                            <div className="absolute inset-8 rounded-full border border-slate-200 bg-slate-50/40" />
                            
                            {/* Inner Ring */}
                            <div className="absolute inset-16 rounded-full border border-blue-200 bg-blue-50/50" />

                            {/* Simulated Neighbor Nodes */}
                            <div className="absolute top-10 right-12 w-3.5 h-3.5 rounded-full bg-emerald-500 border-2 border-white shadow-xs" title="Verified Neighbor" />
                            <div className="absolute bottom-12 left-10 w-3.5 h-3.5 rounded-full bg-emerald-500 border-2 border-white shadow-xs" title="Ward Volunteer" />
                            <div className="absolute top-20 left-16 w-3 h-3 rounded-full bg-emerald-500 border-2 border-white shadow-xs" title="Verified Resident" />
                            <div className="absolute bottom-16 right-14 w-3.5 h-3.5 rounded-full bg-emerald-500 border-2 border-white shadow-xs" title="Civil Guard" />

                            {/* Center Beacon Trigger Button */}
                            <button
                                type="button"
                                onClick={handleTriggerTestBeacon}
                                className={`relative z-10 w-20 h-20 rounded-full flex flex-col items-center justify-center font-black text-xs transition-all shadow-xl cursor-pointer ${
                                    beaconActive
                                        ? 'bg-rose-600 text-white scale-110 ring-8 ring-rose-300/50'
                                        : 'bg-gradient-to-tr from-rose-500 to-rose-600 text-white hover:scale-105 active:scale-95 shadow-rose-500/30'
                                }`}
                                aria-label="Test Emergency SOS Beacon"
                            >
                                <Radio className={`w-6 h-6 mb-0.5 ${beaconActive ? 'animate-bounce' : ''}`} />
                                <span>{beaconActive ? 'Pinging!' : 'Test SOS'}</span>
                            </button>
                        </div>

                        {/* Status Label Below Radar */}
                        <div className="mt-4 flex items-center gap-2 text-xs font-bold text-slate-700 bg-white/90 px-3.5 py-1 rounded-full border border-slate-200 shadow-2xs">
                            <span className="w-2 h-2 rounded-full bg-emerald-500 animate-pulse" />
                            <span>Ward 19 Mesh: {simulatedCount} Responders Standing By</span>
                        </div>
                    </div>

                    {/* Right: Key SOS Metrics & Value Props */}
                    <div className="lg:col-span-7 space-y-5 text-left">
                        <div className="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div className="p-4 rounded-2xl bg-white border border-slate-200 shadow-2xs">
                                <Clock className="w-5 h-5 text-rose-600 mb-1" />
                                <div className="text-2xl font-black text-slate-900">{telemetry.average_response_time || '3.2s'}</div>
                                <div className="text-xs text-slate-500 font-semibold mt-0.5">Average Alert Speed</div>
                            </div>

                            <div className="p-4 rounded-2xl bg-white border border-slate-200 shadow-2xs">
                                <Users className="w-5 h-5 text-blue-600 mb-1" />
                                <div className="text-2xl font-black text-slate-900">{simulatedCount}</div>
                                <div className="text-xs text-slate-500 font-semibold mt-0.5">Active Responders Online</div>
                            </div>

                            <div className="p-4 rounded-2xl bg-white border border-slate-200 shadow-2xs">
                                <MapPin className="w-5 h-5 text-emerald-600 mb-1" />
                                <div className="text-2xl font-black text-slate-900">{telemetry.broadcast_radius_meters || '750'}m</div>
                                <div className="text-xs text-slate-500 font-semibold mt-0.5">Geo-Fenced Radius</div>
                            </div>
                        </div>

                        <div className="space-y-3 pt-2">
                            <div className="flex items-start gap-3">
                                <CheckCircle2 className="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" />
                                <div>
                                    <h4 className="text-sm font-bold text-slate-900">1-Tap Distress Broadcast</h4>
                                    <p className="text-xs text-slate-600 leading-relaxed mt-0.5">
                                        Instantly transmits exact street coordinates to verified neighbors and community emergency ward leaders.
                                    </p>
                                </div>
                            </div>

                            <div className="flex items-start gap-3">
                                <CheckCircle2 className="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" />
                                <div>
                                    <h4 className="text-sm font-bold text-slate-900">Zero False Alarms via NID Verification</h4>
                                    <p className="text-xs text-slate-600 leading-relaxed mt-0.5">
                                        Because every account is tied to a verified citizen identity, pranks and fake emergency calls are virtually eliminated.
                                    </p>
                                </div>
                            </div>

                            <div className="flex items-start gap-3">
                                <CheckCircle2 className="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" />
                                <div>
                                    <h4 className="text-sm font-bold text-slate-900">Offline SMS Failover for Android</h4>
                                    <p className="text-xs text-slate-600 leading-relaxed mt-0.5">
                                        When mobile internet is down, the Zengfy Android app automatically transmits the beacon payload through encrypted local SMS relays.
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </section>
    );
}
