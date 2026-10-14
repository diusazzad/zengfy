import React, { useState, useRef } from 'react';
import { User, Shield, ShieldCheck, Key, Grid, Camera, CheckCircle2, Loader2, AlertCircle, ExternalLink, ArrowRight, UploadCloud, Smartphone, Building, Scale, ShoppingBag, Globe, Sparkles } from 'lucide-react';
import ActiveDevices from './ActiveDevices';
import { apiRequest } from '../../lib/api';
import { cn } from '../../utils/cn';

export default function AccountHub({
    initialUser = null,
    initialDevices = [],
    initialApps = [],
    homeUrl = '/',
    socialUrl = '/feed',
}) {
    const [activeTab, setActiveTab] = useState('profile'); // 'profile', 'trust', 'security', 'apps'
    const [currentUser, setCurrentUser] = useState(initialUser || {});

    // Profile Edit State
    const [name, setName] = useState(initialUser?.name || '');
    const [handle, setHandle] = useState(initialUser?.handle || '');
    const [bio, setBio] = useState(initialUser?.bio || '');
    const [phone, setPhone] = useState(initialUser?.phone || '');
    const [wardCode, setWardCode] = useState(initialUser?.ward_code || '');
    const [isSavingProfile, setIsSavingProfile] = useState(false);
    const [profileMessage, setProfileMessage] = useState(null);

    // Avatar Upload State
    const [avatarUrl, setAvatarUrl] = useState(initialUser?.avatar_url || '');
    const [isUploadingAvatar, setIsUploadingAvatar] = useState(false);
    const [isAvatarDragging, setIsAvatarDragging] = useState(false);
    const [avatarPreview, setAvatarPreview] = useState(null);
    const avatarInputRef = useRef(null);

    // Password Form State
    const [currentPassword, setCurrentPassword] = useState('');
    const [newPassword, setNewPassword] = useState('');
    const [newPasswordConfirmation, setNewPasswordConfirmation] = useState('');
    const [isSavingPassword, setIsSavingPassword] = useState(false);
    const [passwordMessage, setPasswordMessage] = useState(null);

    // 1. Process and upload avatar file
    const processAvatarUpload = async (file) => {
        if (!file || !file.type.startsWith('image/')) {
            setProfileMessage({ type: 'error', text: 'Please select a valid image file (JPG, PNG, WebP).' });
            return;
        }

        // Instant local preview
        const localPreviewUrl = URL.createObjectURL(file);
        setAvatarPreview(localPreviewUrl);

        setIsUploadingAvatar(true);
        setProfileMessage(null);

        const formData = new FormData();
        formData.append('avatar', file);

        try {
            const res = await apiRequest('/account/avatar', {
                method: 'POST',
                body: formData,
            });

            if (res?.avatar_url) {
                setAvatarUrl(res.avatar_url);
                setCurrentUser((prev) => ({ ...prev, avatar_url: res.avatar_url }));
            }
            setProfileMessage({ type: 'success', text: 'Avatar photo uploaded and updated successfully!' });
        } catch (err) {
            console.error('Avatar upload failed', err);
            setProfileMessage({ type: 'error', text: err?.message || 'Failed to upload photo.' });
            setAvatarPreview(null);
        } finally {
            setIsUploadingAvatar(false);
        }
    };

    const handleAvatarFileSelected = (e) => {
        const file = e.target.files?.[0];
        if (file) processAvatarUpload(file);
    };

    const handleAvatarDrop = (e) => {
        e.preventDefault();
        e.stopPropagation();
        setIsAvatarDragging(false);
        const file = e.dataTransfer?.files?.[0];
        if (file) processAvatarUpload(file);
    };

    const handleAvatarDragOver = (e) => {
        e.preventDefault();
        e.stopPropagation();
        setIsAvatarDragging(true);
    };

    const handleAvatarDragLeave = (e) => {
        e.preventDefault();
        e.stopPropagation();
        setIsAvatarDragging(false);
    };

    // 2. Profile Details Save
    const handleProfileSubmit = async (e) => {
        e.preventDefault();
        setIsSavingProfile(true);
        setProfileMessage(null);

        try {
            const res = await apiRequest('/account/profile', {
                method: 'POST',
                body: JSON.stringify({
                    name: name.trim(),
                    handle: handle.trim(),
                    bio: bio.trim(),
                    phone: phone.trim(),
                    ward_code: wardCode.trim(),
                }),
            });

            if (res?.user) {
                setCurrentUser(res.user);
            }
            setProfileMessage({ type: 'success', text: 'Profile updated successfully!' });
        } catch (err) {
            console.error('Profile update failed', err);
            setProfileMessage({ type: 'error', text: err?.message || 'Failed to update profile.' });
        } finally {
            setIsSavingProfile(false);
        }
    };

    // 3. Password Change Submit
    const handlePasswordSubmit = async (e) => {
        e.preventDefault();
        setIsSavingPassword(true);
        setPasswordMessage(null);

        if (newPassword.length < 8) {
            setPasswordMessage({ type: 'error', text: 'New password must be at least 8 characters long.' });
            setIsSavingPassword(false);
            return;
        }

        if (newPassword !== newPasswordConfirmation) {
            setPasswordMessage({ type: 'error', text: 'Password confirmation does not match.' });
            setIsSavingPassword(false);
            return;
        }

        try {
            await apiRequest('/account/password', {
                method: 'POST',
                body: JSON.stringify({
                    current_password: currentPassword,
                    new_password: newPassword,
                    new_password_confirmation: newPasswordConfirmation,
                }),
            });

            setCurrentPassword('');
            setNewPassword('');
            setNewPasswordConfirmation('');
            setPasswordMessage({ type: 'success', text: 'Password changed securely across all devices.' });
        } catch (err) {
            console.error('Password change failed', err);
            setPasswordMessage({ type: 'error', text: err?.message || 'Failed to change password.' });
        } finally {
            setIsSavingPassword(false);
        }
    };

    // Apps list fallback
    const appsList = initialApps.length > 0 ? initialApps : [
        {
            id: 'social',
            name: 'Zengfy Social',
            category: 'Community & Feed',
            desc: 'Hyperlocal community timeline, citizen updates, and discussions.',
            icon: '🌐',
            url: socialUrl,
            badge: 'Active',
            badge_color: 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
        },
        {
            id: 'identity',
            name: 'Sovereign ID',
            category: 'Identity & Security',
            desc: 'Unified SSO credentials, 256-bit vault, and citizen badge.',
            icon: '🇧🇩',
            url: '/account',
            badge: 'Primary',
            badge_color: 'bg-blue-500/10 text-blue-400 border-blue-500/20',
        },
        {
            id: 'mobile',
            name: 'Android Mobile App',
            category: 'Mobile APK',
            desc: 'Native biometric scanner, ward SOS distress beacon, push alerts.',
            icon: '📱',
            url: '/download',
            badge: 'Alpha v1.0',
            badge_color: 'bg-cyan-500/10 text-cyan-400 border-cyan-500/20',
        },
        {
            id: 'school',
            name: 'School ERP',
            category: 'Education',
            desc: 'Student records, exam grading, and automated SMS notifications.',
            icon: '🏫',
            url: 'http://school.zengfy.top:7000/',
            badge: 'Live Demo',
            badge_color: 'bg-amber-500/10 text-amber-400 border-amber-500/20',
        },
        {
            id: 'law',
            name: 'Legal Practice',
            category: 'Law Vault',
            desc: 'Court hearing schedules, case diary, encrypted document vault.',
            icon: '⚖️',
            url: 'http://law.zengfy.top:7000/',
            badge: 'Live Demo',
            badge_color: 'bg-indigo-500/10 text-indigo-400 border-indigo-500/20',
        },
        {
            id: 'pos',
            name: 'Retail POS',
            category: 'Commerce',
            desc: 'Multi-location inventory, barcode billing, bKash integration.',
            icon: '🛒',
            url: 'http://pos.zengfy.top:7000/',
            badge: 'Live Demo',
            badge_color: 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
        },
    ];

    const isVerifiedCitizen = Boolean(currentUser?.verified_badge);
    const activeAvatar = avatarPreview || avatarUrl;

    return (
        <div className="max-w-6xl mx-auto px-4 sm:px-6 py-8 space-y-8 relative z-10">
            {/* Top User Sovereign Banner Card */}
            <div className="backdrop-blur-2xl bg-[#0E1626]/75 border border-white/15 rounded-3xl p-6 sm:p-8 shadow-[0_20px_50px_rgba(0,0,0,0.6)] relative overflow-hidden transition-all duration-300 hover:border-cyan-500/30">
                <div className="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-600 via-cyan-400 to-indigo-600 shadow-sm shadow-cyan-400/40" />
                <div className="absolute inset-0 bg-gradient-to-b from-white/[0.04] to-transparent pointer-events-none" />

                <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-6 relative z-10">
                    <div className="flex items-center gap-5">
                        {/* Avatar with Camera Trigger */}
                        <div className="relative group shrink-0">
                            {activeAvatar ? (
                                <img
                                    src={activeAvatar}
                                    alt={currentUser?.name || 'User'}
                                    className="w-20 h-20 rounded-2xl object-cover border-2 border-white/20 shadow-xl shadow-cyan-500/10"
                                />
                            ) : (
                                <div className="w-20 h-20 rounded-2xl bg-gradient-to-tr from-blue-600 via-indigo-600 to-cyan-400 flex items-center justify-center text-2xl font-black text-white shadow-xl shadow-cyan-500/20">
                                    {(currentUser?.name || 'User').substring(0, 2).toUpperCase()}
                                </div>
                            )}

                            {/* Camera overlay upload trigger */}
                            <button
                                type="button"
                                onClick={() => avatarInputRef.current?.click()}
                                disabled={isUploadingAvatar}
                                className="absolute inset-0 bg-black/60 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white cursor-pointer backdrop-blur-xs"
                                title="Change profile photo"
                            >
                                {isUploadingAvatar ? (
                                    <Loader2 className="w-6 h-6 animate-spin text-cyan-400" />
                                ) : (
                                    <Camera className="w-6 h-6" />
                                )}
                            </button>
                        </div>

                        {/* Name & Citizen Status */}
                        <div>
                            <div className="flex items-center gap-2 flex-wrap">
                                <h1 className="text-xl sm:text-2xl font-black text-white tracking-tight">
                                    {currentUser?.name || 'Sovereign Citizen'}
                                </h1>
                                {isVerifiedCitizen ? (
                                    <span className="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-cyan-500/10 text-cyan-300 border border-cyan-500/30 shadow-sm backdrop-blur-md">
                                        <CheckCircle2 className="w-3.5 h-3.5 text-cyan-400" />
                                        <span>Verified Citizen</span>
                                    </span>
                                ) : (
                                    <span className="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-amber-500/10 text-amber-400 border border-amber-500/20 backdrop-blur-md">
                                        <span>Standard Citizen</span>
                                    </span>
                                )}
                            </div>

                            <p className="text-xs text-gray-400 mt-1">
                                @{currentUser?.handle || 'citizen'} • {currentUser?.email || 'user@zengfy.top'}
                            </p>

                            <div className="flex items-center gap-2 mt-2 text-xs text-gray-400">
                                <span className="inline-flex items-center gap-1 text-cyan-400 font-medium">
                                    <ShieldCheck className="w-3.5 h-3.5" />
                                    <span>AES-256 Cloud Vault</span>
                                </span>
                                {currentUser?.ward_code && (
                                    <>
                                        <span>•</span>
                                        <span>📍 {currentUser.ward_code}</span>
                                    </>
                                )}
                            </div>
                        </div>
                    </div>

                    {/* Quick CTA to Social Feed */}
                    <a
                        href={socialUrl}
                        className="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-blue-600 via-indigo-600 to-cyan-500 hover:from-blue-500 hover:via-indigo-500 hover:to-cyan-400 shadow-lg shadow-blue-600/30 hover:shadow-cyan-500/25 transition-all self-start sm:self-auto cursor-pointer"
                    >
                        <span>Open Social Feed</span>
                        <ArrowRight className="w-4 h-4" />
                    </a>
                </div>
            </div>

            {/* 4 Smooth Navigation Tabs (Glassmorphic) */}
            <div className="flex items-center gap-2 overflow-x-auto pb-2 border-b border-white/10 no-scrollbar">
                <button
                    type="button"
                    onClick={() => setActiveTab('profile')}
                    className={cn(
                        'flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold transition-all whitespace-nowrap cursor-pointer backdrop-blur-md border',
                        activeTab === 'profile'
                            ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg shadow-blue-600/25 border-white/15'
                            : 'text-gray-400 hover:text-white bg-white/[0.03] hover:bg-white/[0.08] border-white/5'
                    )}
                >
                    <User className="w-4 h-4" />
                    <span>Profile & Identity</span>
                </button>

                <button
                    type="button"
                    onClick={() => setActiveTab('trust')}
                    className={cn(
                        'flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold transition-all whitespace-nowrap cursor-pointer backdrop-blur-md border',
                        activeTab === 'trust'
                            ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg shadow-blue-600/25 border-white/15'
                            : 'text-gray-400 hover:text-white bg-white/[0.03] hover:bg-white/[0.08] border-white/5'
                    )}
                >
                    <Shield className="w-4 h-4" />
                    <span>Community Trust & Badges</span>
                </button>

                <button
                    type="button"
                    onClick={() => setActiveTab('security')}
                    className={cn(
                        'flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold transition-all whitespace-nowrap cursor-pointer backdrop-blur-md border',
                        activeTab === 'security'
                            ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg shadow-blue-600/25 border-white/15'
                            : 'text-gray-400 hover:text-white bg-white/[0.03] hover:bg-white/[0.08] border-white/5'
                    )}
                >
                    <Key className="w-4 h-4" />
                    <span>Device Security & Sessions</span>
                </button>

                <button
                    type="button"
                    onClick={() => setActiveTab('apps')}
                    className={cn(
                        'flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold transition-all whitespace-nowrap cursor-pointer backdrop-blur-md border',
                        activeTab === 'apps'
                            ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg shadow-blue-600/25 border-white/15'
                            : 'text-gray-400 hover:text-white bg-white/[0.03] hover:bg-white/[0.08] border-white/5'
                    )}
                >
                    <Grid className="w-4 h-4" />
                    <span>App Launcher & Ecosystem</span>
                </button>
            </div>

            {/* TAB 1: Profile & Identity */}
            {activeTab === 'profile' && (
                <div className="backdrop-blur-2xl bg-[#0E1626]/80 border border-white/[0.14] rounded-3xl p-6 sm:p-8 shadow-[0_20px_50px_rgba(0,0,0,0.5)] space-y-6 relative overflow-hidden transition-all duration-300 hover:border-cyan-500/25">
                    <div className="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-600 via-cyan-400 to-indigo-600 shadow-sm shadow-cyan-400/30" />
                    <div>
                        <h3 className="text-base font-bold text-white">Citizen Identity Settings</h3>
                        <p className="text-xs text-gray-400">
                            Update your public citizen name, handle, bio, and ward location.
                        </p>
                    </div>

                    {profileMessage && (
                        <div
                            className={cn(
                                'p-4 rounded-xl text-xs font-semibold flex items-center gap-2 border backdrop-blur-md',
                                profileMessage.type === 'success'
                                    ? 'bg-emerald-500/10 border-emerald-500/30 text-emerald-300'
                                    : 'bg-rose-500/10 border-rose-500/30 text-rose-300'
                            )}
                        >
                            {profileMessage.type === 'success' ? (
                                <CheckCircle2 className="w-4 h-4 text-emerald-400 shrink-0" />
                            ) : (
                                <AlertCircle className="w-4 h-4 text-rose-400 shrink-0" />
                            )}
                            <span>{profileMessage.text}</span>
                        </div>
                    )}

                    {/* Quick Photo Upload Dropzone */}
                    <div className="space-y-2">
                        <label className="block text-xs font-semibold text-gray-300">
                            Quick Profile Photo Dropzone
                        </label>
                        <div
                            onDrop={handleAvatarDrop}
                            onDragOver={handleAvatarDragOver}
                            onDragLeave={handleAvatarDragLeave}
                            onClick={() => avatarInputRef.current?.click()}
                            className={cn(
                                'border-2 border-dashed rounded-2xl p-6 text-center cursor-pointer transition-all flex flex-col items-center justify-center gap-2.5 backdrop-blur-md',
                                isAvatarDragging
                                    ? 'border-cyan-400 bg-cyan-500/10 text-cyan-300 shadow-lg shadow-cyan-500/10'
                                    : 'border-white/10 hover:border-cyan-500/40 bg-white/[0.03] hover:bg-white/[0.06] text-gray-400 hover:text-gray-200'
                            )}
                        >
                            {isUploadingAvatar ? (
                                <div className="flex flex-col items-center gap-2 py-2">
                                    <Loader2 className="w-8 h-8 animate-spin text-[#06B6D4]" />
                                    <span className="text-xs font-bold text-white">Uploading and saving photo...</span>
                                </div>
                            ) : (
                                <>
                                    <div className="w-12 h-12 rounded-2xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-cyan-400 shadow-sm shadow-cyan-500/20">
                                        <UploadCloud className="w-6 h-6 animate-pulse" />
                                    </div>
                                    <div className="text-xs">
                                        <span className="font-bold text-white">Drag & drop your photo here</span>, or <span className="text-cyan-400 underline font-bold hover:text-cyan-300">browse</span>
                                    </div>
                                    <p className="text-[10px] text-gray-500">Supports JPG, PNG, WebP up to 10MB</p>
                                </>
                            )}
                        </div>

                        <input
                            type="file"
                            ref={avatarInputRef}
                            onChange={handleAvatarFileSelected}
                            accept="image/jpeg,image/png,image/webp,image/gif"
                            className="hidden"
                        />
                    </div>

                    <form onSubmit={handleProfileSubmit} className="space-y-4 max-w-2xl pt-2">
                        <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label className="block text-xs font-semibold text-gray-300 mb-1.5">Full Name</label>
                                <input
                                    type="text"
                                    value={name}
                                    onChange={(e) => setName(e.target.value)}
                                    required
                                    className="w-full bg-white/[0.04] border border-white/10 hover:border-white/20 rounded-xl px-4 py-2.5 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-cyan-400 focus:bg-white/[0.07] focus:ring-4 focus:ring-cyan-500/15 backdrop-blur-md transition-all"
                                />
                            </div>

                            <div>
                                <label className="block text-xs font-semibold text-gray-300 mb-1.5">Handle (@username)</label>
                                <input
                                    type="text"
                                    value={handle}
                                    onChange={(e) => setHandle(e.target.value)}
                                    className="w-full bg-white/[0.04] border border-white/10 hover:border-white/20 rounded-xl px-4 py-2.5 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-cyan-400 focus:bg-white/[0.07] focus:ring-4 focus:ring-cyan-500/15 backdrop-blur-md transition-all"
                                />
                            </div>
                        </div>

                        <div>
                            <label className="block text-xs font-semibold text-gray-300 mb-1.5">Bio / Description</label>
                            <textarea
                                rows={3}
                                value={bio}
                                onChange={(e) => setBio(e.target.value)}
                                placeholder="A few words about you or your community engagement..."
                                className="w-full bg-white/[0.04] border border-white/10 hover:border-white/20 rounded-xl p-4 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-cyan-400 focus:bg-white/[0.07] focus:ring-4 focus:ring-cyan-500/15 backdrop-blur-md transition-all resize-none"
                            />
                        </div>

                        <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label className="block text-xs font-semibold text-gray-300 mb-1.5">Ward Location Tag</label>
                                <input
                                    type="text"
                                    value={wardCode}
                                    onChange={(e) => setWardCode(e.target.value)}
                                    placeholder="WARD-DHAKA-19"
                                    className="w-full bg-white/[0.04] border border-white/10 hover:border-white/20 rounded-xl px-4 py-2.5 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-cyan-400 focus:bg-white/[0.07] focus:ring-4 focus:ring-cyan-500/15 backdrop-blur-md transition-all"
                                />
                            </div>

                            <div>
                                <label className="block text-xs font-semibold text-gray-300 mb-1.5">Phone Number</label>
                                <input
                                    type="text"
                                    value={phone}
                                    onChange={(e) => setPhone(e.target.value)}
                                    placeholder="+880 1700 000000"
                                    className="w-full bg-white/[0.04] border border-white/10 hover:border-white/20 rounded-xl px-4 py-2.5 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-cyan-400 focus:bg-white/[0.07] focus:ring-4 focus:ring-cyan-500/15 backdrop-blur-md transition-all"
                                />
                            </div>
                        </div>

                        <div className="pt-2">
                            <button
                                type="submit"
                                disabled={isSavingProfile}
                                className="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-blue-600 via-indigo-600 to-cyan-500 hover:from-blue-500 hover:via-indigo-500 hover:to-cyan-400 transition-all shadow-xl shadow-blue-600/30 hover:shadow-cyan-500/25 hover:scale-[1.02] cursor-pointer disabled:opacity-50"
                            >
                                {isSavingProfile ? (
                                    <>
                                        <Loader2 className="w-4 h-4 animate-spin" />
                                        <span>Saving Changes...</span>
                                    </>
                                ) : (
                                    <span>Save Profile</span>
                                )}
                            </button>
                        </div>
                    </form>
                </div>
            )}

            {/* TAB 2: Community Trust & Badges */}
            {activeTab === 'trust' && (
                <div className="backdrop-blur-2xl bg-[#0E1626]/80 border border-white/[0.14] rounded-3xl p-6 sm:p-8 shadow-[0_20px_50px_rgba(0,0,0,0.5)] space-y-6 relative overflow-hidden transition-all duration-300 hover:border-cyan-500/25">
                    <div className="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-600 via-cyan-400 to-indigo-600 shadow-sm shadow-cyan-400/30" />
                    <div>
                        <h3 className="text-base font-bold text-white">Community Trust & Badges</h3>
                        <p className="text-xs text-gray-400">
                            Zengfy Sovereign Identity provides cryptographically secure anti-bot verification and community reputation.
                        </p>
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {/* Status Card */}
                        <div className="backdrop-blur-md bg-white/[0.03] border border-white/10 hover:border-cyan-500/30 rounded-2xl p-6 space-y-4 shadow-lg transition-all">
                            <div className="flex items-center justify-between">
                                <span className="text-xs font-semibold text-gray-400">Citizen Verification</span>
                                {isVerifiedCitizen ? (
                                    <span className="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-cyan-500/10 text-cyan-300 border border-cyan-500/20 shadow-sm shadow-cyan-500/10">
                                        <CheckCircle2 className="w-4 h-4 text-cyan-400" />
                                        <span>Verified Citizen</span>
                                    </span>
                                ) : (
                                    <span className="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-500/10 text-amber-400 border border-amber-500/20">
                                        <span>Standard Citizen</span>
                                    </span>
                                )}
                            </div>

                            <div className="border-t border-white/5 pt-4 space-y-3">
                                <div className="flex items-center justify-between text-xs">
                                    <span className="text-gray-400">Trust Level:</span>
                                    <span className="font-semibold text-emerald-400">Tier 1 Sovereign Citizen</span>
                                </div>
                                <div className="flex items-center justify-between text-xs">
                                    <span className="text-gray-400">Anti-Bot Shield:</span>
                                    <span className="text-emerald-400 font-bold">Active & Shielded</span>
                                </div>
                                <div className="flex items-center justify-between text-xs">
                                    <span className="text-gray-400">Ward Access:</span>
                                    <span className="text-cyan-400 font-bold">{currentUser?.ward_code || 'Ward 19 Enabled'}</span>
                                </div>
                            </div>
                        </div>

                        {/* Privacy & Legal Notice */}
                        <div className="backdrop-blur-md bg-gradient-to-br from-blue-950/40 via-cyan-950/20 to-[#0E1626]/60 border border-cyan-500/20 rounded-2xl p-6 space-y-3 shadow-lg">
                            <div className="flex items-center gap-2 text-cyan-400 font-bold text-xs">
                                <ShieldCheck className="w-4 h-4 text-cyan-300" />
                                <span>Zero-Knowledge Privacy</span>
                            </div>
                            <p className="text-xs text-gray-300 leading-relaxed">
                                In accordance with privacy and sovereign regulations, Zengfy never requests or stores government identity documents or raw numbers. Citizen verification is maintained exclusively through decentralized community reputation and secure cryptographic keypairs.
                            </p>
                        </div>
                    </div>
                </div>
            )}

            {/* TAB 3: Device Security & Password */}
            {activeTab === 'security' && (
                <div className="space-y-6">
                    {/* Active Devices Component */}
                    <div className="backdrop-blur-2xl bg-[#0E1626]/80 border border-white/[0.14] rounded-3xl p-6 sm:p-8 shadow-[0_20px_50px_rgba(0,0,0,0.5)] relative overflow-hidden transition-all duration-300 hover:border-cyan-500/25">
                        <div className="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-600 via-cyan-400 to-indigo-600 shadow-sm shadow-cyan-400/30" />
                        <ActiveDevices initialDevices={initialDevices} />
                    </div>

                    {/* Change Password Card */}
                    <div className="backdrop-blur-2xl bg-[#0E1626]/80 border border-white/[0.14] rounded-3xl p-6 sm:p-8 shadow-[0_20px_50px_rgba(0,0,0,0.5)] space-y-6 relative overflow-hidden transition-all duration-300 hover:border-cyan-500/25">
                        <div className="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-600 via-cyan-400 to-indigo-600 shadow-sm shadow-cyan-400/30" />
                        <div>
                            <h3 className="text-base font-bold text-white">Change Account Password</h3>
                            <p className="text-xs text-gray-400">
                                Update your password across all unified Zengfy SSO ecosystem applications.
                            </p>
                        </div>

                        {passwordMessage && (
                            <div
                                className={cn(
                                    'p-4 rounded-xl text-xs font-semibold flex items-center gap-2 border backdrop-blur-md',
                                    passwordMessage.type === 'success'
                                        ? 'bg-emerald-500/10 border-emerald-500/30 text-emerald-300'
                                        : 'bg-rose-500/10 border-rose-500/30 text-rose-300'
                                    )}
                            >
                                {passwordMessage.type === 'success' ? (
                                    <CheckCircle2 className="w-4 h-4 text-emerald-400 shrink-0" />
                                ) : (
                                    <AlertCircle className="w-4 h-4 text-rose-400 shrink-0" />
                                )}
                                <span>{passwordMessage.text}</span>
                            </div>
                        )}

                        <form onSubmit={handlePasswordSubmit} className="space-y-4 max-w-xl">
                            <div>
                                <label className="block text-xs font-semibold text-gray-300 mb-1.5">Current Password</label>
                                <input
                                    type="password"
                                    value={currentPassword}
                                    onChange={(e) => setCurrentPassword(e.target.value)}
                                    required
                                    className="w-full bg-white/[0.04] border border-white/10 hover:border-white/20 rounded-xl px-4 py-2.5 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-cyan-400 focus:bg-white/[0.07] focus:ring-4 focus:ring-cyan-500/15 backdrop-blur-md transition-all"
                                />
                            </div>

                            <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label className="block text-xs font-semibold text-gray-300 mb-1.5">New Password</label>
                                    <input
                                        type="password"
                                        value={newPassword}
                                        onChange={(e) => setNewPassword(e.target.value)}
                                        required
                                        placeholder="Min 8 characters"
                                        className="w-full bg-white/[0.04] border border-white/10 hover:border-white/20 rounded-xl px-4 py-2.5 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-cyan-400 focus:bg-white/[0.07] focus:ring-4 focus:ring-cyan-500/15 backdrop-blur-md transition-all"
                                    />
                                </div>

                                <div>
                                    <label className="block text-xs font-semibold text-gray-300 mb-1.5">Confirm New Password</label>
                                    <input
                                        type="password"
                                        value={newPasswordConfirmation}
                                        onChange={(e) => setNewPasswordConfirmation(e.target.value)}
                                        required
                                        className="w-full bg-white/[0.04] border border-white/10 hover:border-white/20 rounded-xl px-4 py-2.5 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-cyan-400 focus:bg-white/[0.07] focus:ring-4 focus:ring-cyan-500/15 backdrop-blur-md transition-all"
                                    />
                                </div>
                            </div>

                            <div className="pt-2">
                                <button
                                    type="submit"
                                    disabled={isSavingPassword}
                                    className="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-blue-600 via-indigo-600 to-cyan-500 hover:from-blue-500 hover:via-indigo-500 hover:to-cyan-400 transition-all shadow-xl shadow-blue-600/30 hover:shadow-cyan-500/25 hover:scale-[1.02] cursor-pointer disabled:opacity-50"
                                >
                                    {isSavingPassword ? (
                                        <>
                                            <Loader2 className="w-4 h-4 animate-spin" />
                                            <span>Updating Password...</span>
                                        </>
                                    ) : (
                                        <span>Update Password</span>
                                    )}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            )}

            {/* TAB 4: App Launcher & Ecosystem */}
            {activeTab === 'apps' && (
                <div className="backdrop-blur-2xl bg-[#0E1626]/80 border border-white/[0.14] rounded-3xl p-6 sm:p-8 shadow-[0_20px_50px_rgba(0,0,0,0.5)] space-y-6 relative overflow-hidden transition-all duration-300 hover:border-cyan-500/25">
                    <div className="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-600 via-cyan-400 to-indigo-600 shadow-sm shadow-cyan-400/30" />
                    <div>
                        <h3 className="text-base font-bold text-white">Zengfy Sovereign App Launcher</h3>
                        <p className="text-xs text-gray-400">
                            Launch any module in the Zengfy 10M-Scale ecosystem with unified single sign-on (SSO).
                        </p>
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        {appsList.map((app) => (
                            <a
                                key={app.id}
                                href={app.url}
                                className="group backdrop-blur-md bg-white/[0.03] hover:bg-white/[0.07] border border-white/10 hover:border-cyan-500/40 rounded-2xl p-5 flex flex-col justify-between transition-all duration-300 hover:scale-[1.02] hover:shadow-xl hover:shadow-cyan-500/10 relative overflow-hidden"
                            >
                                <div className="space-y-3">
                                    <div className="flex items-center justify-between">
                                        <div className="text-2xl">{app.icon}</div>
                                        <span className={cn('px-2.5 py-0.5 rounded-full text-[10px] font-bold border backdrop-blur-md', app.badge_color)}>{app.badge}</span>
                                    </div>
                                    <div>
                                        <h4 className="text-sm font-bold text-white group-hover:text-cyan-400 transition-colors flex items-center gap-1.5">
                                            <span>{app.name}</span>
                                            <ExternalLink className="w-3.5 h-3.5 opacity-0 group-hover:opacity-100 transition-opacity" />
                                        </h4>
                                        <p className="text-[10px] font-semibold text-gray-400">{app.category}</p>
                                    </div>
                                    <p className="text-xs text-gray-300 leading-relaxed">
                                        {app.desc}
                                    </p>
                                </div>
                                <div className="pt-4 border-t border-white/5 flex items-center justify-between text-xs font-semibold text-cyan-400 group-hover:text-cyan-300">
                                    <span>Launch App</span>
                                    <ArrowRight className="w-4 h-4 transition-transform group-hover:translate-x-1" />
                                </div>
                            </a>
                        ))}
                    </div>
                </div>
            )}
        </div>
    );
}
