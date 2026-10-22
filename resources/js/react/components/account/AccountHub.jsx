import React, { useState, useRef } from 'react';
import { 
    User, Shield, ShieldCheck, Key, Lock, Globe, Camera, 
    CheckCircle2, Loader2, AlertCircle, ExternalLink, ArrowRight, 
    Smartphone, Laptop, Building2, Scale, ShoppingBag, Sparkles,
    Sliders, HelpCircle, LogOut, ChevronRight, CreditCard
} from 'lucide-react';
import ActiveDevices from './ActiveDevices';

import BillingManager from './BillingManager';
import { apiRequest } from '../../lib/api';
import { cn } from '../../utils/cn';

export default function AccountHub({
    initialUser = null,
    initialDevices = [],
    initialApps = [],
    initialBilling = null,
    homeUrl = '/',
    socialUrl = '/feed',
}) {
    const [activeTab, setActiveTab] = useState('home'); // 'home', 'personal_info', 'security', 'privacy', 'devices'
    const [currentUser, setCurrentUser] = useState(initialUser || {});
    const [appSwitcherOpen, setAppSwitcherOpen] = useState(false);
    const [profileMenuOpen, setProfileMenuOpen] = useState(false);

    // Profile Form State
    const [name, setName] = useState(initialUser?.name || '');
    const [handle, setHandle] = useState(initialUser?.handle || '');
    const [bio, setBio] = useState(initialUser?.bio || '');
    const [phone, setPhone] = useState(initialUser?.phone || '');
    const [dateOfBirth, setDateOfBirth] = useState(initialUser?.date_of_birth || '');
    const [gender, setGender] = useState(initialUser?.gender || '');
    const [city, setCity] = useState(initialUser?.city || '');
    const [recoveryEmail, setRecoveryEmail] = useState(initialUser?.recovery_email || '');
    const [isSavingProfile, setIsSavingProfile] = useState(false);
    const [profileMessage, setProfileMessage] = useState(null);

    // Avatar Upload State
    const [avatarUrl, setAvatarUrl] = useState(initialUser?.avatar_url || '');
    const [isUploadingAvatar, setIsUploadingAvatar] = useState(false);
    const avatarInputRef = useRef(null);

    // 2FA State
    const [twoFactorEnabled, setTwoFactorEnabled] = useState(initialUser?.two_factor_enabled || false);
    const [twoFactorLoading, setTwoFactorLoading] = useState(false);

    // Password State
    const [currentPassword, setCurrentPassword] = useState('');
    const [newPassword, setNewPassword] = useState('');
    const [newPasswordConfirmation, setNewPasswordConfirmation] = useState('');
    const [isSavingPassword, setIsSavingPassword] = useState(false);
    const [passwordMessage, setPasswordMessage] = useState(null);

    // Profile Completion Calculation
    let score = 0;
    const missing = [];
    if (name) score += 20;
    if (currentUser?.email_verified_at) score += 20;
    if (phone) score += 20; else missing.push('মোবাইল নম্বর');
    if (dateOfBirth && gender) score += 20; else missing.push('জন্মতারিখ ও লিঙ্গ');
    if (avatarUrl) score += 20; else missing.push('প্রোফাইল ছবি');

    // 1. Process Avatar Upload
    const processAvatarUpload = async (file) => {
        if (!file || !file.type.startsWith('image/')) {
            alert('অনুগ্রহ করে সঠিক ইমেজ ফাইল (JPG, PNG, WebP) নির্বাচন করুন।');
            return;
        }

        setIsUploadingAvatar(true);
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
                alert('প্রোফাইল ছবি সফলভাবে আপডেট হয়েছে!');
            }
        } catch (err) {
            console.error('Avatar upload failed', err);
            alert(err?.message || 'ছবি আপলোড করতে ব্যর্থ হয়েছে।');
        } finally {
            setIsUploadingAvatar(false);
        }
    };

    // 2. Save Profile Info
    const handleSaveProfile = async (e) => {
        e.preventDefault();
        setIsSavingProfile(true);
        setProfileMessage(null);

        try {
            const res = await apiRequest('/account/profile', {
                method: 'POST',
                body: JSON.stringify({
                    name,
                    handle,
                    bio,
                    phone,
                    date_of_birth: dateOfBirth,
                    gender,
                    city,
                    recovery_email: recoveryEmail,
                }),
            });

            setCurrentUser((prev) => ({ ...prev, name, handle, bio, phone, date_of_birth: dateOfBirth, gender, city }));
            setProfileMessage({ type: 'success', text: 'প্রোফাইল তথ্য সফলভাবে আপডেট হয়েছে।' });
        } catch (err) {
            setProfileMessage({ type: 'error', text: err?.message || 'প্রোফাইল সংরক্ষণ ব্যর্থ হয়েছে।' });
        } finally {
            setIsSavingProfile(false);
        }
    };

    // 3. Toggle 2FA
    const handleToggle2FA = async () => {
        if (twoFactorLoading) return;
        setTwoFactorLoading(true);

        try {
            const res = await apiRequest('/account/2fa/toggle', { method: 'POST' });
            if (res?.success) {
                setTwoFactorEnabled(res.two_factor_enabled);
                alert(res.message);
            }
        } catch (err) {
            alert(err?.message || '2FA টগল করা সম্ভব হয়নি।');
        } finally {
            setTwoFactorLoading(false);
        }
    };

    // 4. Change Password
    const handleChangePassword = async (e) => {
        e.preventDefault();
        if (newPassword !== newPasswordConfirmation) {
            setPasswordMessage({ type: 'error', text: 'নতুন পাসওয়ার্ড দুটি মেলেনি।' });
            return;
        }

        setIsSavingPassword(true);
        setPasswordMessage(null);

        try {
            const res = await apiRequest('/account/password', {
                method: 'POST',
                body: JSON.stringify({
                    current_password: currentPassword,
                    password: newPassword,
                    password_confirmation: newPasswordConfirmation,
                }),
            });

            setPasswordMessage({ type: 'success', text: 'পাসওয়ার্ড সফলভাবে পরিবর্তিত হয়েছে।' });
            setCurrentPassword('');
            setNewPassword('');
            setNewPasswordConfirmation('');
        } catch (err) {
            setPasswordMessage({ type: 'error', text: err?.message || 'পাসওয়ার্ড পরিবর্তন ব্যর্থ হয়েছে।' });
        } finally {
            setIsSavingPassword(false);
        }
    };

    return (
        <div className="min-h-screen bg-[#F8FAFD] text-[#202124] flex flex-col justify-between font-sans">
            
            {/* ========================================================================= */}
            {/* GOOGLE STYLE TOP HEADER */}
            {/* ========================================================================= */}
            <header className="sticky top-0 z-40 bg-white border-b border-slate-200 shadow-2xs px-4 sm:px-6 py-2.5 flex items-center justify-between">
                {/* Left: Brand */}
                <div className="flex items-center gap-3">
                    <a href="/account" className="flex items-center gap-2.5 group rounded-lg p-1">
                        <div className="w-9 h-9 rounded-xl bg-gradient-to-tr from-blue-600 via-indigo-600 to-cyan-500 flex items-center justify-center text-white shadow-sm shadow-blue-500/20">
                            <Shield className="w-5 h-5" />
                        </div>
                        <div className="flex items-baseline gap-1.5">
                            <span className="text-lg font-extrabold text-slate-900 tracking-tight">Zengfy</span>
                            <span className="text-sm font-medium text-slate-500">অ্যাকাউন্ট</span>
                        </div>
                    </a>
                </div>

                {/* Middle: Search Bar (Desktop) */}
                <div className="hidden md:flex flex-1 max-w-xl mx-8">
                    <div className="w-full relative flex items-center">
                        <input 
                            type="text" 
                            placeholder="Zengfy অ্যাকাউন্ট ও নিরাপত্তা সেটিংস খুঁজুন..." 
                            className="w-full pl-10 pr-4 py-2 bg-slate-100/80 hover:bg-slate-200/60 focus:bg-white text-slate-900 placeholder-slate-400 text-xs sm:text-sm rounded-full border border-transparent focus:border-blue-400 focus:shadow-sm focus:outline-none transition-all"
                        />
                    </div>
                </div>

                {/* Right: Support, 9-Dot Menu & Account Profile */}
                <div className="flex items-center gap-2">
                    <a href="/faq" title="সহায়তা" className="p-2 rounded-full hover:bg-slate-100 text-slate-600 transition-colors">
                        <HelpCircle className="w-5 h-5" />
                    </a>

                    {/* 9-Dot App Switcher Launcher */}
                    <div className="relative">
                        <button 
                            type="button" 
                            onClick={() => setAppSwitcherOpen(!appSwitcherOpen)}
                            title="Zengfy ইকোসিস্টেম অ্যাপসমূহ"
                            className={cn(
                                "p-2 rounded-full hover:bg-slate-100 text-slate-700 transition-colors cursor-pointer",
                                appSwitcherOpen && "bg-slate-100 text-blue-600"
                            )}>
                            <svg className="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <circle cx="5" cy="5" r="2" />
                                <circle cx="12" cy="5" r="2" />
                                <circle cx="19" cy="5" r="2" />
                                <circle cx="5" cy="12" r="2" />
                                <circle cx="12" cy="12" r="2" />
                                <circle cx="19" cy="12" r="2" />
                                <circle cx="5" cy="19" r="2" />
                                <circle cx="12" cy="19" r="2" />
                                <circle cx="19" cy="19" r="2" />
                            </svg>
                        </button>

                        {/* Apps Dropdown */}
                        {appSwitcherOpen && (
                            <div className="absolute right-0 mt-2 w-80 sm:w-96 rounded-3xl bg-white border border-slate-200 shadow-2xl p-4 z-50 animate-in fade-in zoom-in-95">
                                <div className="flex items-center justify-between pb-3 mb-2 border-b border-slate-100 px-2">
                                    <span className="text-xs font-bold text-slate-800 uppercase tracking-wider">Zengfy ইকোসিস্টেম</span>
                                    <span className="text-[10px] bg-blue-50 text-blue-700 font-bold px-2 py-0.5 rounded-full">১৫টি মডিউল</span>
                                </div>
                                <div className="grid grid-cols-3 gap-2 max-h-[360px] overflow-y-auto pr-1">
                                    {(initialApps.length > 0 ? initialApps : [
                                        { id: 'social', name: 'Social', category: 'Community', url: 'http://social.zengfy.top:8000/' },
                                        { id: 'school', name: 'School ERP', category: 'Education', url: 'http://school.zengfy.top:8000/' },
                                        { id: 'law', name: 'Law Vault', category: 'Legal', url: 'http://law.zengfy.top:8000/' },
                                        { id: 'pos', name: 'Retail POS', category: 'Commerce', url: 'http://pos.zengfy.top:8000/' },
                                        { id: 'civil', name: 'Civil 3D', category: 'Engineering', url: 'http://civil.zengfy.top:8000/' },
                                    ]).map((app) => (
                                        <a key={app.id} href={app.url} className="flex flex-col items-center text-center p-2.5 rounded-2xl hover:bg-slate-50 transition-all group">
                                            <div className="w-11 h-11 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl mb-1.5 shadow-2xs group-hover:scale-105 transition-transform">
                                                {app.id === 'social' ? '🌐' : app.id === 'school' ? '🎓' : app.id === 'law' ? '⚖️' : app.id === 'pos' ? '🛒' : '⚡'}
                                            </div>
                                            <span className="text-xs font-semibold text-slate-800 group-hover:text-blue-600 truncate max-w-full">{app.name}</span>
                                            <span className="text-[10px] text-slate-400 truncate max-w-full mt-0.5">{app.category}</span>
                                        </a>
                                    ))}
                                </div>
                            </div>
                        )}
                    </div>

                    {/* Profile Avatar Menu */}
                    <div className="relative">
                        <button 
                            type="button" 
                            onClick={() => setProfileMenuOpen(!profileMenuOpen)}
                            className="flex items-center gap-2 p-1 rounded-full hover:ring-4 hover:ring-slate-100 transition-all cursor-pointer">
                            {avatarUrl ? (
                                <img src={avatarUrl} alt={name} className="w-8 h-8 rounded-full object-cover ring-2 ring-blue-500/30" />
                            ) : (
                                <div className="w-8 h-8 rounded-full bg-blue-600 text-white font-bold text-xs flex items-center justify-center">
                                    {(name || 'U').charAt(0).toUpperCase()}
                                </div>
                            )}
                        </button>

                        {/* Profile Dropdown */}
                        {profileMenuOpen && (
                            <div className="absolute right-0 mt-2 w-80 rounded-3xl bg-white border border-slate-200 shadow-2xl p-5 z-50 text-center animate-in fade-in zoom-in-95">
                                <p className="text-[11px] font-semibold text-slate-400 mb-3">{currentUser?.email}</p>
                                <div className="relative inline-block mx-auto mb-3">
                                    {avatarUrl ? (
                                        <img src={avatarUrl} alt={name} className="w-18 h-18 rounded-full object-cover mx-auto ring-4 ring-slate-100" />
                                    ) : (
                                        <div className="w-18 h-18 rounded-full bg-blue-600 text-white font-extrabold text-2xl flex items-center justify-center mx-auto ring-4 ring-slate-100">
                                            {(name || 'U').charAt(0).toUpperCase()}
                                        </div>
                                    )}
                                </div>
                                <h3 className="text-base font-bold text-slate-900">{name}</h3>
                                <p className="text-xs text-slate-500 mb-4">@{handle || 'sovereign_citizen'}</p>
                                <button 
                                    type="button" 
                                    onClick={() => { setActiveTab('personal_info'); setProfileMenuOpen(false); }}
                                    className="w-full py-2.5 px-4 rounded-full border border-slate-300 hover:bg-slate-50 text-slate-800 text-xs font-semibold transition-all mb-4">
                                    Zengfy অ্যাকাউন্ট ম্যানেজ করুন
                                </button>
                                <div className="border-t border-slate-100 pt-3">
                                    <form action="/logout" method="POST">
                                        <button type="submit" className="w-full py-2 px-4 rounded-xl text-rose-600 hover:bg-rose-50 text-xs font-semibold transition-colors flex items-center justify-center gap-2">
                                            <LogOut className="w-4 h-4" />
                                            <span>অ্যাকাউন্ট থেকে লগআউট</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        )}
                    </div>
                </div>
            </header>

            {/* ========================================================================= */}
            {/* MAIN LAYOUT (Google Style Sidebar & Content Cards) */}
            {/* ========================================================================= */}
            <div className="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 flex flex-col md:flex-row gap-6 lg:gap-8">
                
                {/* Left Navigation */}
                <nav className="w-full md:w-64 shrink-0 space-y-1">
                    {[
                        { id: 'home', label: 'হোম (Home)', icon: Globe },
                        { id: 'personal_info', label: 'ব্যক্তিগত তথ্য (Personal info)', icon: User },
                        { id: 'security', label: 'নিরাপত্তা ও ২FA (Security)', icon: ShieldCheck },
                        { id: 'privacy', label: 'তথ্য ও গোপনীয়তা (Data & privacy)', icon: Sliders },
                        { id: 'devices', label: 'ডিভাইস ও সেশন (Devices)', icon: Smartphone },
                        {
                            id: 'billing',
                            label: 'পেà¦®à§à¦¿à¦ ণ়à¦à§à¦¯ ভ্à¦ºà¦¿à¦ªà§à¦¶à¦¿ ভনà¦½ (Billing)',
                            icon: CreditCard,
                        },
                    ].map((tab) => {
                        const Icon = tab.icon;
                        const isActive = activeTab === tab.id;
                        return (
                            <button
                                key={tab.id}
                                type="button"
                                onClick={() => setActiveTab(tab.id)}
                                className={cn(
                                    "w-full flex items-center gap-3.5 px-4 py-3 rounded-2xl text-xs sm:text-sm font-semibold transition-all text-left cursor-pointer",
                                    isActive ? "bg-blue-50 text-blue-700 font-bold" : "text-slate-600 hover:bg-slate-100/80"
                                )}
                            >
                                <Icon className="w-5 h-5 shrink-0" />
                                <span>{tab.label}</span>
                            </button>
                        );
                    })}
                </nav>

                {/* Main Views */}
                <main className="flex-1 min-w-0">
                    
                    {/* 1. HOME TAB */}
                    {activeTab === 'home' && (
                        <div className="space-y-6 animate-in fade-in">
                            {/* Centered Welcome */}
                            <div className="text-center py-4">
                                <div className="relative inline-block mb-3">
                                    {avatarUrl ? (
                                        <img src={avatarUrl} alt={name} className="w-20 h-20 sm:w-24 sm:h-24 rounded-full object-cover ring-4 ring-white shadow-md mx-auto" />
                                    ) : (
                                        <div className="w-20 h-20 sm:w-24 sm:h-24 rounded-full bg-blue-600 text-white font-black text-3xl flex items-center justify-center ring-4 ring-white shadow-md mx-auto">
                                            {(name || 'U').charAt(0).toUpperCase()}
                                        </div>
                                    )}
                                    <label htmlFor="react-avatar-input" title="ছবি পরিবর্তন করুন" className="absolute bottom-0 right-0 w-7 h-7 rounded-full bg-white border border-slate-200 text-slate-600 hover:text-blue-600 shadow-md flex items-center justify-center cursor-pointer">
                                        <Camera className="w-4 h-4" />
                                    </label>
                                    <input 
                                        type="file" 
                                        id="react-avatar-input" 
                                        accept="image/*" 
                                        className="hidden" 
                                        onChange={(e) => {
                                            const f = e.target.files?.[0];
                                            if (f) processAvatarUpload(f);
                                        }} 
                                    />
                                </div>
                                <h1 className="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight">স্বাগতম, {name}</h1>
                                <p className="text-xs sm:text-sm text-slate-500 mt-1 max-w-md mx-auto">আপনার তথ্য, গোপনীয়তা এবং নিরাপত্তা একটি একক সার্বভৌম অ্যাকাউন্ট থেকে নিয়ন্ত্রণ করুন।</p>
                            </div>

                            {/* PROFILE INFO COMPLETION CARD (User Instruction) */}
                            <div className="rounded-3xl bg-white border border-slate-200 shadow-xs p-5 sm:p-6 transition-all hover:shadow-md">
                                <div className="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                                    <div className="flex items-start gap-3.5">
                                        <div className="w-11 h-11 rounded-2xl bg-amber-50 border border-amber-200 text-amber-600 flex items-center justify-center shrink-0">
                                            <Sparkles className="w-6 h-6" />
                                        </div>
                                        <div>
                                            <div className="flex items-center gap-2">
                                                <h2 className="text-base font-bold text-slate-900">আপনার প্রোফাইল তথ্য সম্পূর্ণ করুন</h2>
                                                <span className="text-xs font-semibold px-2.5 py-0.5 rounded-full bg-amber-50 text-amber-700 border border-amber-200">
                                                    {score}% সম্পন্ন
                                                </span>
                                            </div>
                                            <p className="text-xs text-slate-500 mt-1">
                                                অ্যাকাউন্টের সম্পূর্ণ নিরাপত্তা ও নাগরিক অধিকার নিশ্চিত করতে অবশিষ্ট তথ্য পূরণ করুন।
                                            </p>
                                        </div>
                                    </div>

                                    <button 
                                        type="button" 
                                        onClick={() => setActiveTab('personal_info')}
                                        className="shrink-0 py-2.5 px-5 rounded-full bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold transition-all shadow-sm shadow-blue-500/20 cursor-pointer flex items-center gap-1.5">
                                        <span>প্রোফাইল তথ্য আপডেট করুন</span>
                                        <ArrowRight className="w-4 h-4" />
                                    </button>
                                </div>

                                <div className="mt-4 pt-4 border-t border-slate-100">
                                    <div className="w-full bg-slate-100 rounded-full h-2 mb-3 overflow-hidden">
                                        <div className="bg-gradient-to-r from-amber-500 to-blue-600 h-2 rounded-full transition-all duration-500" style={{ width: `${score}%` }}></div>
                                    </div>
                                    {missing.length > 0 && (
                                        <div className="flex flex-wrap items-center gap-2 text-xs">
                                            <span className="text-slate-400 font-medium">বাকি তথ্য:</span>
                                            {missing.map((item, idx) => (
                                                <button key={idx} type="button" onClick={() => setActiveTab('personal_info')} className="px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 text-[11px] font-semibold transition-colors">
                                                    + {item}
                                                </button>
                                            ))}
                                        </div>
                                    )}
                                </div>
                            </div>

                            {/* 2-Column Clean Preview Cards (Fake / Ready for expansion) */}
                            <div className="grid grid-cols-1 md:grid-cols-3 gap-5">
                                <div className="rounded-3xl bg-white border border-slate-200 p-5 shadow-xs flex flex-col justify-between hover:shadow-md transition-shadow">
                                    <div>
                                        <div className="flex items-center gap-3 mb-3">
                                            <div className="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                                                <ShieldCheck className="w-5 h-5" />
                                            </div>
                                            <h3 className="text-sm font-bold text-slate-900">নিরাপত্তা সুপারিশ (Security)</h3>
                                        </div>
                                        <p className="text-xs text-slate-500 leading-relaxed">
                                            আপনার অ্যাকাউন্ট মৌলিকভাবে সুরক্ষিত রয়েছে। যেকোনো সময় পাসওয়ার্ড এবং ২-ধাপ যাচাইকরণ (2FA) চালু করতে পারেন।
                                        </p>
                                    </div>
                                    <div className="pt-4 mt-3 border-t border-slate-100">
                                        <button type="button" onClick={() => setActiveTab('security')} className="text-xs font-bold text-blue-600 hover:underline">
                                            নিরাপত্তা সেটিংস দেখুন &rarr;
                                        </button>
                                    </div>
                                </div>

                                <div className="rounded-3xl bg-white border border-slate-200 p-5 shadow-xs flex flex-col justify-between hover:shadow-md transition-shadow">
                                    <div>
                                        <div className="flex items-center gap-3 mb-3">
                                            <div className="w-10 h-10 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center">
                                                <Sliders className="w-5 h-5" />
                                            </div>
                                            <h3 className="text-sm font-bold text-slate-900">গোপনীয়তা ও ডেটা (Privacy)</h3>
                                        </div>
                                        <p className="text-xs text-slate-500 leading-relaxed">
                                            আপনার সার্বভৌম ডেটা সম্পূর্ণ এনক্রিপ্টেড। আপনার অ্যাক্টিভিটি হিস্ট্রি এবং ডাটা শেয়ারিং নিয়ন্ত্রণ করুন।
                                        </p>
                                    </div>
                                    <div className="pt-4 mt-3 border-t border-slate-100">
                                        <button type="button" onClick={() => setActiveTab('privacy')} className="text-xs font-bold text-blue-600 hover:underline">
                                            গোপনীয়তা চেকআপ &rarr;
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    )}

                    {/* 2. PERSONAL INFO TAB */}
                    {activeTab === 'personal_info' && (
                        <div className="rounded-3xl bg-white border border-slate-200 shadow-xs p-6 sm:p-8 animate-in fade-in">
                            <h2 className="text-lg font-bold text-slate-900 mb-1">ব্যক্তিগত তথ্য (Personal info)</h2>
                            <p className="text-xs text-slate-500 mb-6">আপনার নাম, জন্মতারিখ ও যোগাযোগের তথ্য ম্যানেজ করুন</p>

                            {profileMessage && (
                                <div className={cn(
                                    "p-3.5 rounded-2xl text-xs font-semibold mb-5 flex items-center gap-2",
                                    profileMessage.type === 'success' ? "bg-emerald-50 text-emerald-800 border border-emerald-200" : "bg-rose-50 text-rose-800 border border-rose-200"
                                )}>
                                    {profileMessage.type === 'success' ? <CheckCircle2 className="w-4 h-4 text-emerald-600" /> : <AlertCircle className="w-4 h-4 text-rose-600" />}
                                    <span>{profileMessage.text}</span>
                                </div>
                            )}

                            <form onSubmit={handleSaveProfile} className="space-y-4">
                                <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label className="block text-xs font-bold text-slate-700 mb-1">পুরো নাম (Legal Name) *</label>
                                        <input type="text" value={name} onChange={(e) => setName(e.target.value)} required className="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none" />
                                    </div>

                                    <div>
                                        <label className="block text-xs font-bold text-slate-700 mb-1">ইউজারনেম (@handle)</label>
                                        <input type="text" value={handle} onChange={(e) => setHandle(e.target.value)} placeholder="username" className="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none" />
                                    </div>

                                    <div>
                                        <label className="block text-xs font-bold text-slate-700 mb-1">ইমেইল (যাচাইকৃত)</label>
                                        <input type="email" value={currentUser?.email || ''} disabled className="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-500 text-sm cursor-not-allowed" />
                                    </div>

                                    <div>
                                        <label className="block text-xs font-bold text-slate-700 mb-1">মোবাইল নম্বর (Phone)</label>
                                        <input type="tel" value={phone} onChange={(e) => setPhone(e.target.value)} placeholder="+88017XXXXXXXX" className="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none" />
                                    </div>

                                    <div>
                                        <label className="block text-xs font-bold text-slate-700 mb-1">জন্মতারিখ (Date of Birth)</label>
                                        <input type="date" value={dateOfBirth} onChange={(e) => setDateOfBirth(e.target.value)} className="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none" />
                                    </div>

                                    <div>
                                        <label className="block text-xs font-bold text-slate-700 mb-1">লিঙ্গ (Gender)</label>
                                        <select value={gender} onChange={(e) => setGender(e.target.value)} className="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none bg-white">
                                            <option value="">নির্বাচন করুন</option>
                                            <option value="male">পুরুষ (Male)</option>
                                            <option value="female">নারী (Female)</option>
                                            <option value="other">অন্যান্য (Other)</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label className="block text-xs font-bold text-slate-700 mb-1">শহর ও এলাকা (City / Location)</label>
                                        <input type="text" value={city} onChange={(e) => setCity(e.target.value)} placeholder="ঢাকা, বাংলাদেশ" className="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none" />
                                    </div>

                                    <div>
                                        <label className="block text-xs font-bold text-slate-700 mb-1">জরুরি রিকভারি ইমেইল (Recovery Email)</label>
                                        <input type="email" value={recoveryEmail} onChange={(e) => setRecoveryEmail(e.target.value)} placeholder="recovery@example.com" className="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none" />
                                    </div>
                                </div>

                                <div>
                                    <label className="block text-xs font-bold text-slate-700 mb-1">বায়ো / পরিচিতি (Bio)</label>
                                    <textarea rows={3} value={bio} onChange={(e) => setBio(e.target.value)} placeholder="আপনার পরিচিতি লিখুন..." className="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none" />
                                </div>

                                <div className="pt-4 flex justify-end">
                                    <button type="submit" disabled={isSavingProfile} className="py-2.5 px-6 rounded-full bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs shadow-md shadow-blue-500/20 transition-all cursor-pointer flex items-center gap-2">
                                        {isSavingProfile && <Loader2 className="w-4 h-4 animate-spin" />}
                                        <span>পরিবর্তন সংরক্ষণ করুন</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    )}

                    {/* 3. SECURITY TAB */}
                    {activeTab === 'security' && (
                        <div className="space-y-6 animate-in fade-in">
                            <div className="rounded-3xl bg-white border border-slate-200 shadow-xs p-6">
                                <div className="flex items-center justify-between">
                                    <div className="flex items-start gap-3.5">
                                        <div className="w-11 h-11 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                                            <Lock className="w-6 h-6" />
                                        </div>
                                        <div>
                                            <h3 className="text-base font-bold text-slate-900">২-ধাপ যাচাইকরণ (2-Step Verification)</h3>
                                            <p className="text-xs text-slate-500 mt-0.5">নতুন ডিভাইসে লগইন করার সময় পাসওয়ার্ডের পাশাপাশি দ্বিতীয় ভেরিফিকেশন কোড চাওয়া হবে।</p>
                                        </div>
                                    </div>

                                    <button 
                                        type="button" 
                                        onClick={handleToggle2FA}
                                        disabled={twoFactorLoading}
                                        className={cn(
                                            "relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none",
                                            twoFactorEnabled ? "bg-blue-600" : "bg-slate-200"
                                        )}>
                                        <span className={cn(
                                            "pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow-sm ring-0 transition duration-200 ease-in-out",
                                            twoFactorEnabled ? "translate-x-5" : "translate-x-0"
                                        )} />
                                    </button>
                                </div>
                            </div>

                            <div className="rounded-3xl bg-white border border-slate-200 shadow-xs p-6">
                                <h3 className="text-base font-bold text-slate-900 mb-1">পাসওয়ার্ড পরিবর্তন (Change Password)</h3>
                                <p className="text-xs text-slate-500 mb-4">আপনার অ্যাকাউন্টের নিরাপত্তা জোরদার করতে নিয়মিত পাসওয়ার্ড আপডেট করুন</p>

                                {passwordMessage && (
                                    <div className={cn(
                                        "p-3.5 rounded-2xl text-xs font-semibold mb-4 flex items-center gap-2",
                                        passwordMessage.type === 'success' ? "bg-emerald-50 text-emerald-800 border border-emerald-200" : "bg-rose-50 text-rose-800 border border-rose-200"
                                    )}>
                                        <span>{passwordMessage.text}</span>
                                    </div>
                                )}

                                <form onSubmit={handleChangePassword} className="max-w-md space-y-4">
                                    <div>
                                        <label className="block text-xs font-bold text-slate-700 mb-1">বর্তমান পাসওয়ার্ড</label>
                                        <input type="password" value={currentPassword} onChange={(e) => setCurrentPassword(e.target.value)} required className="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none" />
                                    </div>
                                    <div>
                                        <label className="block text-xs font-bold text-slate-700 mb-1">নতুন পাসওয়ার্ড (কমপক্ষে ৮ অক্ষর)</label>
                                        <input type="password" value={newPassword} minLength={8} onChange={(e) => setNewPassword(e.target.value)} required className="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none" />
                                    </div>
                                    <div>
                                        <label className="block text-xs font-bold text-slate-700 mb-1">নতুন পাসওয়ার্ড নিশ্চিত করুন</label>
                                        <input type="password" value={newPasswordConfirmation} onChange={(e) => setNewPasswordConfirmation(e.target.value)} required className="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none" />
                                    </div>
                                    <button type="submit" disabled={isSavingPassword} className="py-2 px-5 rounded-full bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold transition-all shadow-xs cursor-pointer flex items-center gap-2">
                                        {isSavingPassword && <Loader2 className="w-3.5 h-3.5 animate-spin" />}
                                        <span>পাসওয়ার্ড পরিবর্তন করুন</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    )}

                    {/* 4. PRIVACY TAB */}
                    {activeTab === 'privacy' && (
                        <div className="rounded-3xl bg-white border border-slate-200 shadow-xs p-6 animate-in fade-in">
                            <h2 className="text-lg font-bold text-slate-900 mb-1">তথ্য ও গোপনীয়তা (Data & privacy)</h2>
                            <p className="text-xs text-slate-500 mb-6">আপনার সার্বভৌম ডেটা ডাউনলোড করুন অথবা গোপনীয়তা নীতি পর্যবেক্ষণ করুন।</p>
                            <div className="p-4 rounded-2xl border border-slate-200 flex items-center justify-between">
                                <div>
                                    <h4 className="text-sm font-bold text-slate-800">সার্বভৌম এনক্রিপশন ভল্ট</h4>
                                    <p className="text-xs text-slate-500 mt-0.5">AES-256 বিট জিরো-নলেজ এনক্রিপশন সক্রিয় রয়েছে</p>
                                </div>
                                <span className="text-xs font-bold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full">সক্রিয়</span>
                            </div>
                        </div>
                    )}

                    {/* 5. DEVICES TAB */}
                    {activeTab === 'devices' && (
                        <div className="rounded-3xl bg-white border border-slate-200 shadow-xs p-6 animate-in fade-in">
                            <ActiveDevices initialDevices={initialDevices} />
                        </div>
                    )}

                    {/* 6. BILLING TAB */}
                    {activeTab === 'billing' && (
                        <div className="animate-in fade-in">
                            <BillingManager initialBilling={initialBilling} />
                        </div>
                    )}

                </main>
            </div>

            {/* Footer */}
            <footer className="border-t border-slate-200 bg-white py-4 px-6 text-center text-xs text-slate-500">
                <div className="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-2">
                    <span>&copy; {new Date().getFullYear()} Zengfy Ecosystem. সকল স্বত্ব সংরক্ষিত।</span>
                    <div className="flex items-center gap-4">
                        <a href="/terms" className="hover:underline">শর্তাবলী</a>
                        <a href="/faq" className="hover:underline">গোপনীয়তা</a>
                        <a href="/faq" className="hover:underline">সহায়তা</a>
                    </div>
                </div>
            </footer>
        </div>
    );
}
