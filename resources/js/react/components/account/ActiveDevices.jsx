import React, { useState } from 'react';
import { Smartphone, Laptop, Tablet, Monitor, ShieldAlert, Trash2, CheckCircle2, Loader2, AlertCircle } from 'lucide-react';
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
            showToast('Device session revoked successfully.', 'success');
        } catch (err) {
            console.error('Failed to revoke device', err);
            showToast(err?.message || 'Failed to revoke device session.', 'error');
        } finally {
            setRevokingId(null);
        }
    };

    // Revoke All Other Devices without page refresh
    const handleRevokeAllOtherDevices = async () => {
        if (isRevokingAll) return;

        if (!window.confirm('Are you sure you want to log out of all other devices?')) {
            return;
        }

        setIsRevokingAll(true);

        try {
            await apiRequest('/account/devices/revoke-all', {
                method: 'POST',
            });

            // Keep only the currently active device
            setDevices((prev) => prev.slice(0, 1));
            showToast('All other active device sessions have been terminated.', 'success');
        } catch (err) {
            console.error('Failed to revoke all other devices', err);
            showToast(err?.message || 'Failed to terminate other sessions.', 'error');
        } finally {
            setIsRevokingAll(false);
        }
    };

    // Detect device icon
    const getDeviceIcon = (device) => {
        const ua = (device.user_agent || device.device_name || '').toLowerCase();
        if (ua.includes('mobile') || ua.includes('android') || ua.includes('iphone')) {
            return <Smartphone className="w-5 h-5 text-cyan-400" />;
        }
        if (ua.includes('ipad') || ua.includes('tablet')) {
            return <Tablet className="w-5 h-5 text-indigo-400" />;
        }
        if (ua.includes('macintosh') || ua.includes('laptop')) {
            return <Laptop className="w-5 h-5 text-blue-400" />;
        }
        return <Monitor className="w-5 h-5 text-blue-400" />;
    };

    // Format last active time
    const formatLastActive = (isoString) => {
        if (!isoString) return 'Active now';
        try {
            const date = new Date(isoString);
            const now = new Date();
            const diffMin = Math.floor((now - date) / (1000 * 60));
            if (diffMin < 2) return 'Active now';
            if (diffMin < 60) return `${diffMin} minutes ago`;
            const diffHours = Math.floor(diffMin / 60);
            if (diffHours < 24) return `${diffHours} hours ago`;
            return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
        } catch {
            return 'Recently';
        }
    };

    return (
        <div className="space-y-5">
            {/* Notification Toast */}
            {statusToast && (
                <div
                    className={cn(
                        'p-3.5 rounded-xl text-xs font-semibold flex items-center justify-between border shadow-lg animate-in fade-in',
                        statusToast.type === 'success'
                            ? 'bg-emerald-500/10 border-emerald-500/30 text-emerald-300'
                            : 'bg-rose-500/10 border-rose-500/30 text-rose-300'
                    )}
                >
                    <div className="flex items-center gap-2">
                        {statusToast.type === 'success' ? (
                            <CheckCircle2 className="w-4 h-4 text-emerald-400" />
                        ) : (
                            <AlertCircle className="w-4 h-4 text-rose-400" />
                        )}
                        <span>{statusToast.message}</span>
                    </div>
                </div>
            )}

            {/* Header & Revoke All Trigger */}
            <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-white/10">
                <div>
                    <h3 className="text-sm font-bold text-white flex items-center gap-2">
                        <span>Active Devices & Sessions</span>
                        <span className="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-500/10 text-blue-400 border border-blue-500/20">
                            {devices.length} {devices.length === 1 ? 'Device' : 'Devices'}
                        </span>
                    </h3>
                    <p className="text-xs text-gray-400">
                        Devices currently signed in with your Zengfy 256-Bit SSO credential.
                    </p>
                </div>

                {devices.length > 1 && (
                    <button
                        type="button"
                        onClick={handleRevokeAllOtherDevices}
                        disabled={isRevokingAll}
                        className="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-bold text-rose-300 bg-rose-500/10 hover:bg-rose-500/20 border border-rose-500/20 transition-all cursor-pointer self-start sm:self-auto"
                    >
                        {isRevokingAll ? (
                            <>
                                <Loader2 className="w-3.5 h-3.5 animate-spin" />
                                <span>Terminating...</span>
                            </>
                        ) : (
                            <>
                                <ShieldAlert className="w-3.5 h-3.5" />
                                <span>Revoke All Other Devices</span>
                            </>
                        )}
                    </button>
                )}
            </div>

            {/* Device Cards List */}
            {devices.length === 0 ? (
                <div className="p-8 text-center bg-white/[0.02] backdrop-blur-md rounded-2xl border border-white/10 space-y-2">
                    <Monitor className="w-8 h-8 text-gray-500 mx-auto" />
                    <p className="text-xs font-bold text-white">No session devices recorded</p>
                    <p className="text-[11px] text-gray-400">Sign in from your devices to manage them here.</p>
                </div>
            ) : (
                <div className="grid grid-cols-1 md:grid-cols-2 gap-3.5">
                    {devices.map((device, idx) => {
                        const isCurrentSession = idx === 0; // First item is primary/current session
                        const isRevokingThis = revokingId === device.id;

                        return (
                            <div
                                key={device.id}
                                className={cn(
                                    'backdrop-blur-md bg-white/[0.03] hover:bg-white/[0.06] border border-white/10 hover:border-cyan-500/30 rounded-2xl p-4 flex items-start justify-between gap-3 transition-all duration-300 hover:shadow-lg hover:shadow-cyan-500/5',
                                    isCurrentSession && 'border-cyan-500/40 bg-gradient-to-r from-blue-950/30 to-cyan-950/20 shadow-md shadow-cyan-500/10',
                                    isRevokingThis && 'opacity-50 pointer-events-none'
                                )}
                            >
                                <div className="flex items-start gap-3">
                                    <div className="w-10 h-10 rounded-xl bg-white/[0.05] border border-white/10 flex items-center justify-center shrink-0">
                                        {getDeviceIcon(device)}
                                    </div>
                                    <div className="space-y-1">
                                        <div className="flex items-center gap-2 flex-wrap">
                                            <h4 className="text-xs font-bold text-white">
                                                {device.device_name || 'Web Browser'}
                                            </h4>
                                            {isCurrentSession && (
                                                <span className="px-2 py-0.5 rounded-full text-[9px] font-extrabold bg-gradient-to-r from-blue-600 to-cyan-500 text-white shadow-sm shadow-cyan-500/20">
                                                    Current Device
                                                </span>
                                            )}
                                        </div>
                                        <p className="text-[11px] text-gray-400">
                                            {device.ip_address ? `IP: ${device.ip_address.substring(0, 10)}...` : 'Encrypted IP'} • {formatLastActive(device.last_active_at)}
                                        </p>
                                        <p className="text-[10px] text-gray-500 truncate max-w-[200px]">
                                            {device.user_agent ? device.user_agent.substring(0, 45) + '...' : 'Secure Browser'}
                                        </p>
                                    </div>
                                </div>

                                {/* 1-Click Revoke Action */}
                                {!isCurrentSession ? (
                                    <button
                                        type="button"
                                        onClick={() => handleRevokeDevice(device.id)}
                                        disabled={isRevokingThis}
                                        title="Revoke and logout this device"
                                        className="p-2 rounded-xl text-gray-400 hover:text-rose-400 hover:bg-rose-500/10 border border-transparent hover:border-rose-500/20 transition-all cursor-pointer"
                                    >
                                        {isRevokingThis ? (
                                            <Loader2 className="w-4 h-4 animate-spin text-rose-400" />
                                        ) : (
                                            <Trash2 className="w-4 h-4" />
                                        )}
                                    </button>
                                ) : (
                                    <span className="p-2 text-emerald-400" title="Active current session">
                                        <CheckCircle2 className="w-4 h-4" />
                                    </span>
                                )}
                            </div>
                        );
                    })}
                </div>
            )}
        </div>
    );
}
