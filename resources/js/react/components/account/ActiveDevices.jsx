import React, { useState } from 'react';
import { Smartphone, Laptop, Tablet, Monitor, Trash2, CheckCircle2, Loader2, AlertCircle } from 'lucide-react';
import { apiRequest } from '../../lib/api';
import { cn } from '../../utils/cn';

export default function ActiveDevices({ initialDevices = [] }) {
    const [devices, setDevices] = useState(initialDevices);
    const [revokingId, setRevokingId] = useState(null);
    const [isRevokingAll, setIsRevokingAll] = useState(false);
    const [statusToast, setStatusToast] = useState(null);

    // Show temporary notification toast
    const showToast = (message, type = 'success') => {
        setStatusToast({ message, type });
        setTimeout(() => setStatusToast(null), 3500);
    };

    // 1-Click Revoke Individual Device without page refresh
    const handleRevokeDevice = async (deviceId) => {
        if (revokingId) return;

        setRevokingId(deviceId);

        try {
            await apiRequest(`/account/device/${deviceId}/revoke`, {
                method: 'POST',
            });

            // Optimistically update device list
            setDevices((prev) => prev.filter((d) => String(d.id) !== String(deviceId)));
            showToast('ডিভাইস সেশন বন্ধ করা হয়েছে।', 'success');
        } catch (err) {
            console.error('Failed to revoke device', err);
            showToast(err?.message || 'ডিভাইস সেশন বন্ধ করা সম্ভব হয়নি।', 'error');
        } finally {
            setRevokingId(null);
        }
    };

    // Revoke All Other Devices without page refresh
    const handleRevokeAllOtherDevices = async () => {
        if (isRevokingAll) return;

        if (!window.confirm('বর্তমান ডিভাইস ব্যতীত বাকি সব সেশন বন্ধ করতে চান?')) {
            return;
        }

        setIsRevokingAll(true);

        try {
            await apiRequest('/account/devices/revoke-all', {
                method: 'POST',
            });

            // Keep only the currently active device
            setDevices((prev) => prev.slice(0, 1));
            showToast('অন্যান্য সকল ডিভাইস থেকে সেশন বন্ধ করা হয়েছে।', 'success');
        } catch (err) {
            console.error('Failed to revoke all other devices', err);
            showToast(err?.message || 'সেশন বন্ধ করতে ব্যর্থ হয়েছে।', 'error');
        } finally {
            setIsRevokingAll(false);
        }
    };

    // Detect device icon
    const getDeviceIcon = (device) => {
        const ua = (device.user_agent || device.device_name || '').toLowerCase();
        if (ua.includes('mobile') || ua.includes('android') || ua.includes('iphone')) {
            return <Smartphone className="w-5 h-5 text-blue-600" />;
        }
        if (ua.includes('ipad') || ua.includes('tablet')) {
            return <Tablet className="w-5 h-5 text-indigo-600" />;
        }
        if (ua.includes('macintosh') || ua.includes('laptop')) {
            return <Laptop className="w-5 h-5 text-blue-600" />;
        }
        return <Monitor className="w-5 h-5 text-slate-700" />;
    };

    // Format last active time
    const formatLastActive = (isoString) => {
        if (!isoString) return 'এখন সক্রিয়';
        try {
            const date = new Date(isoString);
            const now = new Date();
            const diffMin = Math.floor((now - date) / (1000 * 60));
            if (diffMin < 2) return 'এখন সক্রিয়';
            if (diffMin < 60) return `${diffMin} মিনিট আগে`;
            const diffHours = Math.floor(diffMin / 60);
            if (diffHours < 24) return `${diffHours} ঘণ্টা আগে`;
            return date.toLocaleDateString('bn-BD', { month: 'short', day: 'numeric' });
        } catch {
            return 'সম্প্রতি';
        }
    };

    return (
        <div className="space-y-4">
            {/* Notification Toast */}
            {statusToast && (
                <div
                    className={cn(
                        'p-3.5 rounded-2xl text-xs font-semibold flex items-center justify-between border shadow-sm transition-all',
                        statusToast.type === 'success'
                            ? 'bg-emerald-50 border-emerald-200 text-emerald-800'
                            : 'bg-rose-50 border-rose-200 text-rose-800'
                    )}
                >
                    <div className="flex items-center gap-2">
                        {statusToast.type === 'success' ? (
                            <CheckCircle2 className="w-4 h-4 text-emerald-600" />
                        ) : (
                            <AlertCircle className="w-4 h-4 text-rose-600" />
                        )}
                        <span>{statusToast.message}</span>
                    </div>
                </div>
            )}

            {/* Header & Revoke All Trigger */}
            <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-slate-100">
                <div>
                    <h3 className="text-sm font-bold text-slate-900 flex items-center gap-2">
                        <span>কানেক্টেড ডিভাইস ও সেশন</span>
                        <span className="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-blue-50 text-blue-700 border border-blue-200">
                            {devices.length}টি সক্রিয়
                        </span>
                    </h3>
                    <p className="text-xs text-slate-500 mt-0.5">
                        আপনার Zengfy সার্বভৌম আইডেন্টিটিতে যেসকল ডিভাইস যুক্ত আছে
                    </p>
                </div>

                {devices.length > 1 && (
                    <button
                        type="button"
                        onClick={handleRevokeAllOtherDevices}
                        disabled={isRevokingAll}
                        className="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-full text-xs font-bold text-rose-700 bg-rose-50 hover:bg-rose-100 border border-rose-200 transition-all cursor-pointer self-start sm:self-auto"
                    >
                        {isRevokingAll ? (
                            <Loader2 className="w-3.5 h-3.5 animate-spin" />
                        ) : (
                            <Trash2 className="w-3.5 h-3.5" />
                        )}
                        <span>অন্যান্য সব ডিভাইস রিভোক করুন</span>
                    </button>
                )}
            </div>

            {/* Devices Cards */}
            <div className="space-y-2.5">
                {devices.map((device, index) => {
                    const isCurrent = index === 0;
                    const isThisRevoking = revokingId === device.id;

                    return (
                        <div
                            key={device.id || index}
                            className={cn(
                                'p-4 rounded-2xl border transition-all flex items-center justify-between gap-4',
                                isCurrent
                                    ? 'bg-blue-50/40 border-blue-200/80 shadow-2xs'
                                    : 'bg-white border-slate-200/90 hover:border-slate-300'
                            )}
                        >
                            <div className="flex items-center gap-3.5 min-w-0">
                                <div className="w-11 h-11 rounded-2xl bg-white border border-slate-200/90 flex items-center justify-center shrink-0 shadow-2xs">
                                    {getDeviceIcon(device)}
                                </div>
                                <div className="min-w-0">
                                    <div className="flex items-center gap-2">
                                        <p className="text-xs sm:text-sm font-bold text-slate-900 truncate">
                                            {device.device_name || 'অপরিচিত ডিভাইস'}
                                        </p>
                                        {isCurrent && (
                                            <span className="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                                বর্তমান ডিভাইস
                                            </span>
                                        )}
                                    </div>
                                    <p className="text-[11px] text-slate-500 truncate mt-0.5">
                                        IP: {device.ip_address || '127.0.0.1'} • {formatLastActive(device.last_active_at)}
                                    </p>
                                </div>
                            </div>

                            {!isCurrent && (
                                <button
                                    type="button"
                                    onClick={() => handleRevokeDevice(device.id)}
                                    disabled={isThisRevoking}
                                    className="px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-500 hover:text-rose-600 hover:bg-rose-50 transition-colors shrink-0 cursor-pointer"
                                >
                                    {isThisRevoking ? 'লগআউট হচ্ছে...' : 'লগআউট'}
                                </button>
                            )}
                        </div>
                    );
                })}

                {devices.length === 0 && (
                    <div className="p-8 text-center text-slate-400 text-xs">
                        কোনো সক্রিয় ডিভাইস সেশন পাওয়া যায়নি।
                    </div>
                )}
            </div>
        </div>
    );
}
