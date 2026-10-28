import React, { useState, useRef, useEffect } from "react";
import { 
    Globe, Users, User, ShieldCheck, Heart, MessageCircle, Share2, 
    Image, Smile, MapPin, Send, Search, Bell, Camera, CreditCard, 
    Check, Clock, Sparkles, Plus, X, ChevronRight, CheckCircle2,
    ThumbsUp, Award, ExternalLink, Bookmark, MoreHorizontal, AlertCircle,
    BadgeCheck, UploadCloud, ArrowRight, Loader2, Lock, FileText,
    LogOut, Settings, Shield
} from "lucide-react";

export default function SocialApp({ initialUser = null }) {
    // 1. Primary Navigation Tabs: "world" | "friends" | "profile"
    const [activeTab, setActiveTab] = useState("world");

    // 2. Profile Sub-tabs: "badge" | "posts" | "photos"
    const [profileSubtab, setProfileSubtab] = useState("badge");

    // 3. User Identity State
    const [user, setUser] = useState({
        id: initialUser?.id || 1,
        name: initialUser?.name || "মুহাম্মদ সাজ্জাদ হোসেন",
        handle: initialUser?.handle || "sazzad_sovereign",
        avatar_url: initialUser?.avatar_url || null,
        bio: initialUser?.bio || "সার্বভৌম ডিজিটাল বাংলাদেশ বিনির্মাণে একজন প্রত্যয়ী নাগরিক | Tech Entrepreneur & Civic Builder",
        city: initialUser?.city || "ঢাকা, বাংলাদেশ",
        ward_code: initialUser?.ward_code || "WARD-19",
        is_verified: initialUser?.nid_verified || false,
        followers_count: 1480,
        following_count: 290,
        friends_count: 350,
    });

    // Account Management Dropdown State
    const [isAccountMenuOpen, setIsAccountMenuOpen] = useState(false);
    const [isVerifyModalOpen, setIsVerifyModalOpen] = useState(false);
    const accountMenuRef = useRef(null);

    // Close account menu on click outside
    useEffect(() => {
        function handleClickOutside(event) {
            if (accountMenuRef.current && !accountMenuRef.current.contains(event.target)) {
                setIsAccountMenuOpen(false);
            }
        }
        if (isAccountMenuOpen) {
            document.addEventListener("mousedown", handleClickOutside);
        }
        return () => {
            document.removeEventListener("mousedown", handleClickOutside);
        };
    }, [isAccountMenuOpen]);

    const handleLogout = () => {
        try {
            localStorage.removeItem('zengfy_token');
            sessionStorage.clear();
        } catch (e) {
            // ignore
        }
        const port = window.location.port ? (":" + window.location.port) : "";
        const hostnameParts = window.location.hostname.split(".");
        let baseDomain = "zengfy.top";
        if (hostnameParts.length > 2) {
            baseDomain = hostnameParts.slice(1).join(".");
        } else {
            baseDomain = window.location.hostname;
        }
        const accountsUrl = window.location.protocol + "//accounts." + baseDomain + port + "/logout";
        window.location.href = accountsUrl;
    };

    // 4. Verification Badge Lifecycle ("idle" | "in_review" | "approved" | "active")
    const [verifyState, setVerifyState] = useState(user.is_verified ? "active" : "idle");
    const [applyForm, setApplyForm] = useState({
        nid: "19952691234567890",
        fullName: user.name,
        category: "professional",
    });
    const [selectedPlan, setSelectedPlan] = useState("monthly"); // monthly | yearly
    const [paymentMethod, setPaymentMethod] = useState("bkash"); // bkash | nagad | card
    const [isPaying, setIsPaying] = useState(false);
    const [toast, setToast] = useState(null);

    const showToast = (msg) => {
        setToast(msg);
        setTimeout(() => setToast(null), 3500);
    };

    const handleApplySubmit = (e) => {
        e.preventDefault();
        setVerifyState("in_review");
        showToast("ভেরিফিকেশন আবেদন সাবমিট হয়েছে! অভ্যন্তরীণ যাচাই চলছে।");
    };

    const handlePaySubmit = () => {
        setIsPaying(true);
        setTimeout(() => {
            setIsPaying(false);
            setVerifyState("active");
            setUser(prev => ({ ...prev, is_verified: true }));
            showToast("অভিনন্দন! ব্লু ব্যাজ ভেরিফিকেশন সফলভাবে সক্রিয় হয়েছে।");
        }, 1200);
    };

    // 5. World Feed Posts State
    const [newPostText, setNewPostText] = useState("");
    const [selectedPostImage, setSelectedPostImage] = useState(null);
    const [activeCommentPostId, setActiveCommentPostId] = useState(null);
    const [commentInput, setCommentInput] = useState("");

    const [worldPosts, setWorldPosts] = useState([
        {
            id: "wp_1",
            author: "সাদিয়া আফরিন",
            handle: "sadia_afreen",
            is_verified: true,
            badge_title: "Verified Citizen",
            time: "১৫ মিনিট আগে",
            content: "আজ ঢাকা বিশ্ববিদ্যালয়ের কার্জন হলে প্রযুক্তি মেলা ২০২৬ এ আমাদের Zengfy স্টলে দারুণ সাড়া পেয়েছি! তরুণ প্রজন্মের হাত ধরে ডিজিটাল বাংলাদেশ আরও বহুদূর এগিয়ে যাবে।",
            image: "https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&auto=format&fit=crop&q=80",
            likes: 142,
            is_liked: false,
            comments_count: 28,
            comments: [
                { id: "c1", user: "মাহিন আহমেদ", text: "অসাধারণ উদ্যোগ! শুভকামনা রইল।" },
            ],
            shares: 14,
        },
        {
            id: "wp_2",
            author: "ব্যারিস্টার রফিকুল ইসলাম",
            handle: "barrister_rafiq",
            is_verified: true,
            badge_title: "Verified Law Chamber",
            time: "১ ঘণ্টা আগে",
            content: "বিচার বিভাগীয় আধুনিকায়ন ও আইনজীবীদের কাজের গতি বাড়াতে ক্লাউড কেস ভল্ট এবং সেন্ট্রাল ডিজিটাল ডায়েরি সময়ের সেরা সংযোজন।",
            image: null,
            likes: 89,
            is_liked: true,
            comments_count: 12,
            comments: [],
            shares: 9,
        },
        {
            id: "wp_3",
            author: "ফারহানা জাহান",
            handle: "farhana_jahan",
            is_verified: false,
            time: "৩ ঘণ্টা আগে",
            content: "সেন্ট মার্টিন দ্বীপের মন জুড়ানো সূর্যাস্ত। সমুদ্রের গর্জন আর নীল জলরাশির মাঝে অদ্ভুত এক প্রশান্তি।",
            image: "https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800&auto=format&fit=crop&q=80",
            likes: 230,
            is_liked: false,
            comments_count: 45,
            comments: [],
            shares: 21,
        }
    ]);

    // 6. Friends Activity State
    const [stories, setStories] = useState([
        { id: "s0", name: "আমার স্টোরি", is_owner: true, avatar: user.avatar_url, seen: false },
        { id: "s1", name: "আরিফ হাসান", seen: false, time: "৩ মিনিট আগে", img: "https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=500&auto=format&fit=crop" },
        { id: "s2", name: "নাসরিন আক্তার", seen: false, time: "৪৫ মিনিট আগে", img: "https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=500&auto=format&fit=crop" },
        { id: "s3", name: "মাহিন চৌধুরী", seen: true, time: "২ ঘণ্টা আগে", img: "https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=500&auto=format&fit=crop" },
    ]);
    const [activeStory, setActiveStory] = useState(null);

    const [friendActivities, setFriendActivities] = useState([
        {
            id: "fa_1",
            friend_name: "আরিফ হাসান",
            friend_handle: "arif_hasan",
            is_verified: true,
            action_text: "একটি নতুন ছবি শেয়ার করেছেন",
            time: "২৫ মিনিট আগে",
            content: "উত্তরা দিয়াবাড়ি থেকে কাশবনের মৃদু হাওয়ায় এক বিকেল।",
            image: "https://images.unsplash.com/photo-1470240731273-7821a6eeb6bd?w=800&auto=format&fit=crop&q=80",
            likes: 54,
            is_liked: false,
            comments_count: 8,
        },
        {
            id: "fa_2",
            friend_name: "নাসরিন আক্তার",
            friend_handle: "nasrin_aktar",
            is_verified: false,
            action_text: "এবং মাহমুদুর রহমান এখন বন্ধু",
            time: "২ ঘণ্টা আগে",
            content: null,
            likes: 18,
            is_liked: false,
            comments_count: 2,
        },
        {
            id: "fa_3",
            friend_name: "মাহিন চৌধুরী",
            friend_handle: "mahin_chowdhury",
            is_verified: false,
            action_text: "স্ট্যাটাস আপডেট করেছেন",
            time: "৪ ঘণ্টা আগে",
            content: "নতুন প্রজেক্টের কাজ শুরু করলাম। সবার দোয়া প্রার্থী!",
            image: null,
            likes: 76,
            is_liked: true,
            comments_count: 14,
        }
    ]);

    const [friendRequests, setFriendRequests] = useState([
        { id: "fr_1", name: "আবরার ফাহিম", mutual: 5, city: "ঢাকা" },
        { id: "fr_2", name: "নিশাত তাসনীম", mutual: 2, city: "চট্টগ্রাম" },
    ]);

    // Handlers
    const handleCreatePost = (e) => {
        e.preventDefault();
        if (!newPostText.trim() && !selectedPostImage) return;

        const newPost = {
            id: "wp_" + Date.now(),
            author: user.name,
            handle: user.handle,
            is_verified: verifyState === 'active' || user.is_verified,
            badge_title: "Verified Citizen",
            time: "এইমাত্র",
            content: newPostText,
            image: selectedPostImage,
            likes: 1,
            is_liked: true,
            comments_count: 0,
            comments: [],
            shares: 0,
        };

        setWorldPosts([newPost, ...worldPosts]);
        setNewPostText("");
        setSelectedPostImage(null);
    };

    const handleToggleLike = (postId, isFriendFeed = false) => {
        if (isFriendFeed) {
            setFriendActivities(prev => prev.map(p => {
                if (p.id === postId) {
                    return {
                        ...p,
                        is_liked: !p.is_liked,
                        likes: p.is_liked ? p.likes - 1 : p.likes + 1,
                    };
                }
                return p;
            }));
        } else {
            setWorldPosts(prev => prev.map(p => {
                if (p.id === postId) {
                    return {
                        ...p,
                        is_liked: !p.is_liked,
                        likes: p.is_liked ? p.likes - 1 : p.likes + 1,
                    };
                }
                return p;
            }));
        }
    };

    const handleAddComment = (postId) => {
        if (!commentInput.trim()) return;
        setWorldPosts(prev => prev.map(p => {
            if (p.id === postId) {
                const newComments = [...(p.comments || []), {
                    id: "c_" + Date.now(),
                    user: user.name,
                    text: commentInput.trim(),
                }];
                return {
                    ...p,
                    comments: newComments,
                    comments_count: newComments.length,
                };
            }
            return p;
        }));
        setCommentInput("");
    };

    const handleCompletePayment = () => {
        setIsProcessingPayment(true);
        setTimeout(() => {
            setIsProcessingPayment(false);
            setVerificationStep(4);
            setUser(prev => ({ ...prev, is_verified: true }));
            setPaymentSuccessNotice(true);
            setTimeout(() => setPaymentSuccessNotice(false), 5000);
        }, 1200);
    };

    return (
        <div className="min-h-screen bg-[#F0F2F5] text-slate-900 font-sans antialiased flex flex-col justify-between selection:bg-blue-600 selection:text-white">
            
            {/* Top FB App Style Header */}
            <header className="sticky top-0 z-50 bg-white border-b border-slate-200/90 shadow-2xs">
                <div className="max-w-2xl mx-auto px-4 py-2.5 flex items-center justify-between">
                    <div className="flex items-center gap-2.5">
                        <div className="w-9 h-9 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white shadow-md shadow-blue-500/20 font-black text-lg">
                            Z
                        </div>
                        <div className="flex flex-col">
                            <span className="text-lg font-black tracking-tight text-blue-600 leading-tight">zengfy</span>
                            <span className="text-[10px] font-semibold text-slate-400 flex items-center gap-1 leading-none">
                                <span className="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                সোশ্যাল ফিড
                            </span>
                        </div>
                    </div>

                    <div className="flex items-center gap-2">
                        <button type="button" className="w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center cursor-pointer">
                            <Search className="w-4 h-4" />
                        </button>
                        <button type="button" className="relative w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center cursor-pointer">
                            <Bell className="w-4 h-4" />
                            <span className="absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-rose-500 ring-2 ring-white"></span>
                        </button>
                        {/* Sovereign Account Switcher / Dropdown */}
                        <div className="relative" ref={accountMenuRef}>
                            <button 
                                type="button" 
                                onClick={() => setIsAccountMenuOpen(prev => !prev)}
                                aria-label="Account Menu"
                                className="relative w-9 h-9 rounded-full ring-2 ring-blue-500/30 overflow-hidden cursor-pointer hover:ring-blue-500 transition-all">
                                {user.avatar_url ? (
                                    <img src={user.avatar_url} alt={user.name} className="w-full h-full object-cover" />
                                ) : (
                                    <div className="w-full h-full bg-gradient-to-tr from-blue-600 to-indigo-600 text-white font-bold text-xs flex items-center justify-center">
                                        {user.name.charAt(0)}
                                    </div>
                                )}
                                {(user.is_verified || verifyState === "active") && (
                                    <span className="absolute -bottom-0.5 -right-0.5 w-3.5 h-3.5 bg-blue-500 rounded-full flex items-center justify-center text-white text-[8px] font-bold ring-1 ring-white">
                                        ✓
                                    </span>
                                )}
                            </button>

                            {/* Account Dropdown Menu */}
                            {isAccountMenuOpen && (
                                <div className="absolute right-0 top-11 w-72 sm:w-80 bg-white rounded-2xl shadow-2xl border border-slate-200/90 z-50 p-3 animate-in fade-in zoom-in-95 duration-150">
                                    {/* User Identity Header */}
                                    <div className="p-3 bg-slate-50/80 rounded-xl border border-slate-100 mb-2">
                                        <div className="flex items-center gap-3">
                                            <div className="relative w-11 h-11 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 text-white font-black text-sm flex items-center justify-center shadow-xs shrink-0">
                                                {user.name.charAt(0)}
                                                {(user.is_verified || verifyState === "active") && (
                                                    <span className="absolute -bottom-0.5 -right-0.5 w-4 h-4 bg-blue-500 rounded-full flex items-center justify-center text-white text-[9px] font-bold ring-2 ring-white">
                                                        ✓
                                                    </span>
                                                )}
                                            </div>
                                            <div className="overflow-hidden flex-1">
                                                <div className="flex items-center gap-1">
                                                    <h4 className="text-xs font-extrabold text-slate-900 truncate">{user.name}</h4>
                                                    {(user.is_verified || verifyState === "active") && (
                                                        <span className="w-3.5 h-3.5 bg-blue-500 text-white rounded-full flex items-center justify-center text-[8px] font-bold shrink-0">✓</span>
                                                    )}
                                                </div>
                                                <p className="text-[11px] text-slate-500 truncate">{user.email || ("@" + user.handle)}</p>
                                                <span className="inline-flex items-center gap-1 text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full mt-1">
                                                    <span className="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                                    <span>সার্বভৌম সিটিজেন আইডি</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    {/* Menu Actions */}
                                    <div className="space-y-1 text-xs font-semibold text-slate-700">
                                        {/* Central Account Hub (accounts.zengfy.top) */}
                                        <a 
                                            href={window.location.protocol + "//accounts." + (window.location.hostname.split(".").length > 2 ? window.location.hostname.split(".").slice(1).join(".") : window.location.hostname) + (window.location.port ? (":" + window.location.port) : "") + "/"}
                                            className="w-full p-2.5 rounded-xl hover:bg-slate-100 flex items-center justify-between text-left transition-colors text-slate-800">
                                            <div className="flex items-center gap-2.5">
                                                <div className="w-7 h-7 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                                                    <Settings className="w-4 h-4" />
                                                </div>
                                                <div>
                                                    <span className="block font-bold">সেন্ট্রাল অ্যাকাউন্ট পরিচালনা</span>
                                                    <span className="text-[10px] text-slate-400 font-normal">প্রোফাইল, ২FA ও অ্যাক্টিভ সেশন</span>
                                                </div>
                                            </div>
                                            <ExternalLink className="w-3.5 h-3.5 text-slate-400" />
                                        </a>

                                        {/* Social Profile */}
                                        <button 
                                            type="button"
                                            onClick={() => {
                                                setActiveTab("profile");
                                                setProfileSubtab("posts");
                                                setIsAccountMenuOpen(false);
                                            }}
                                            className="w-full p-2.5 rounded-xl hover:bg-slate-100 flex items-center justify-between text-left transition-colors text-slate-800 cursor-pointer">
                                            <div className="flex items-center gap-2.5">
                                                <div className="w-7 h-7 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center">
                                                    <User className="w-4 h-4" />
                                                </div>
                                                <div>
                                                    <span className="block font-bold">আমার সোশ্যাল প্রোফাইল</span>
                                                    <span className="text-[10px] text-slate-400 font-normal">পোস্ট, ছবি ও ফলোয়ার</span>
                                                </div>
                                            </div>
                                            <ChevronRight className="w-3.5 h-3.5 text-slate-400" />
                                        </button>

                                        {/* Verification Badge Portal */}
                                        <button 
                                            type="button"
                                            onClick={() => {
                                                setIsVerifyModalOpen(true);
                                                setIsAccountMenuOpen(false);
                                            }}
                                            className="w-full p-2.5 rounded-xl hover:bg-slate-100 flex items-center justify-between text-left transition-colors text-slate-800 cursor-pointer">
                                            <div className="flex items-center gap-2.5">
                                                <div className="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                                                    <BadgeCheck className="w-4 h-4" />
                                                </div>
                                                <div>
                                                    <span className="block font-bold">ব্লু ব্যাজ ভেরিফিকেশন</span>
                                                    <span className="text-[10px] text-slate-400 font-normal">
                                                        {(verifyState === "active" || user.is_verified) ? "সক্রিয় ব্লু ব্যাজ" : "আবেদন ও সাবস্ক্রিপশন"}
                                                    </span>
                                                </div>
                                            </div>
                                            <ChevronRight className="w-3.5 h-3.5 text-slate-400" />
                                        </button>
                                    </div>

                                    {/* Divider */}
                                    <div className="border-t border-slate-100 my-1.5" />

                                    {/* Central Logout */}
                                    <button 
                                        type="button"
                                        onClick={handleLogout}
                                        className="w-full p-2.5 rounded-xl hover:bg-rose-50 text-rose-600 flex items-center gap-2.5 text-left transition-colors cursor-pointer font-bold text-xs">
                                        <div className="w-7 h-7 rounded-lg bg-rose-100/70 text-rose-600 flex items-center justify-center">
                                            <LogOut className="w-4 h-4" />
                                        </div>
                                        <div>
                                            <span className="block font-bold">লগআউট (Logout)</span>
                                            <span className="text-[10px] text-rose-400 font-normal">সকল সেশন ও সার্ভিস থেকে সাইন-আউট</span>
                                        </div>
                                    </button>
                                </div>
                            )}
                        </div>
                    </div>
                </div>

                {/* 2 Main Core Tabs (World + Friends) */}
                <div className="max-w-2xl mx-auto px-2 flex border-t border-slate-100">
                    <button 
                        type="button"
                        onClick={() => setActiveTab("world")}
                        className={"flex-1 py-3 flex items-center justify-center gap-2 font-bold text-xs sm:text-sm border-b-2 transition-all cursor-pointer " + (
                            activeTab === "world" 
                                ? "border-blue-600 text-blue-600 bg-blue-50/40" 
                                : "border-transparent text-slate-500 hover:text-slate-800 hover:bg-slate-50"
                        )}>
                        <Globe className="w-4 h-4" />
                        <span>বিশ্ব ফিড (World)</span>
                    </button>

                    <button 
                        type="button"
                        onClick={() => setActiveTab("friends")}
                        className={"flex-1 py-3 flex items-center justify-center gap-2 font-bold text-xs sm:text-sm border-b-2 transition-all cursor-pointer relative " + (
                            activeTab === "friends" 
                                ? "border-blue-600 text-blue-600 bg-blue-50/40" 
                                : "border-transparent text-slate-500 hover:text-slate-800 hover:bg-slate-50"
                        )}>
                        <Users className="w-4 h-4" />
                        <span>বন্ধুরা (Friends)</span>
                        {friendRequests.length > 0 && (
                            <span className="px-1.5 py-0.2 rounded-full text-[10px] font-black bg-rose-500 text-white leading-tight">
                                {friendRequests.length}
                            </span>
                        )}
                    </button>
                </div>
            </header>

            {/* Main Centered App Frame */}
            <main className="flex-1 max-w-2xl w-full mx-auto px-3 sm:px-4 py-4 space-y-4">

                {/* TAB 1: WORLD FEED */}
                {activeTab === "world" && (
                    <div className="space-y-4 animate-in fade-in duration-150">
                        {/* Composer */}
                        <div className="bg-white rounded-2xl border border-slate-200/90 shadow-2xs p-4">
                            <div className="flex items-center gap-3 mb-3">
                                <div className="w-10 h-10 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 text-white font-bold flex items-center justify-center shrink-0">
                                    {user.name.charAt(0)}
                                </div>
                                <input 
                                    type="text" 
                                    value={newPostText}
                                    onChange={(e) => setNewPostText(e.target.value)}
                                    placeholder="আপনার মনে কী চলছে? বিশ্বের সাথে ভাগ করুন..."
                                    className="flex-1 py-2.5 px-4 bg-slate-100 hover:bg-slate-200/70 focus:bg-white text-xs sm:text-sm text-slate-800 placeholder-slate-400 rounded-full border border-transparent focus:border-blue-400 outline-none transition-all"
                                />
                            </div>

                            {selectedPostImage && (
                                <div className="relative mb-3 rounded-xl overflow-hidden border border-slate-200">
                                    <img src={selectedPostImage} alt="Attachment" className="max-h-60 w-full object-cover" />
                                    <button 
                                        type="button"
                                        onClick={() => setSelectedPostImage(null)}
                                        className="absolute top-2 right-2 w-7 h-7 rounded-full bg-black/60 text-white flex items-center justify-center hover:bg-black/80">
                                        <X className="w-4 h-4" />
                                    </button>
                                </div>
                            )}

                            <div className="pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-slate-600">
                                <div className="flex items-center gap-1 sm:gap-2">
                                    <button 
                                        type="button"
                                        onClick={() => setSelectedPostImage("https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&auto=format&fit=crop")}
                                        className="px-3 py-1.5 rounded-lg hover:bg-slate-100 flex items-center gap-1.5 text-emerald-600 cursor-pointer">
                                        <Image className="w-4 h-4" />
                                        <span className="hidden sm:inline">ছবি / ভিডিও</span>
                                    </button>
                                    <button 
                                        type="button"
                                        onClick={() => setNewPostText(prev => prev + " 😊")}
                                        className="px-3 py-1.5 rounded-lg hover:bg-slate-100 flex items-center gap-1.5 text-amber-500 cursor-pointer">
                                        <Smile className="w-4 h-4" />
                                        <span className="hidden sm:inline">অনুভূতি</span>
                                    </button>
                                    <button 
                                        type="button"
                                        onClick={() => setNewPostText(prev => prev + " 📍 ঢাকা")}
                                        className="px-3 py-1.5 rounded-lg hover:bg-slate-100 flex items-center gap-1.5 text-rose-500 cursor-pointer">
                                        <MapPin className="w-4 h-4" />
                                        <span className="hidden sm:inline">লোকেশন</span>
                                    </button>
                                </div>

                                <button 
                                    type="button"
                                    onClick={handleCreatePost}
                                    disabled={!newPostText.trim() && !selectedPostImage}
                                    className={"py-1.5 px-5 rounded-full font-bold text-xs flex items-center gap-1.5 shadow-xs transition-all " + (
                                        newPostText.trim() || selectedPostImage 
                                            ? "bg-blue-600 text-white hover:bg-blue-700 cursor-pointer shadow-blue-500/20" 
                                            : "bg-slate-100 text-slate-400 cursor-not-allowed"
                                    )}>
                                    <span>পোস্ট</span>
                                    <Send className="w-3.5 h-3.5" />
                                </button>
                            </div>
                        </div>

                        {/* Posts List */}
                        <div className="space-y-4">
                            {worldPosts.map(post => (
                                <article key={post.id} className="bg-white rounded-2xl border border-slate-200/90 shadow-2xs overflow-hidden transition-all hover:border-slate-300">
                                    <div className="p-4 flex items-center justify-between">
                                        <div className="flex items-center gap-3">
                                            <div className="relative w-10 h-10 rounded-full bg-gradient-to-tr from-slate-700 to-slate-900 text-white font-black text-sm flex items-center justify-center shrink-0">
                                                {post.author.charAt(0)}
                                            </div>
                                            <div>
                                                <div className="flex items-center gap-1.5">
                                                    <h3 className="text-sm font-bold text-slate-900 leading-tight">
                                                        {post.author}
                                                    </h3>
                                                    {post.is_verified && (
                                                        <span title="Verified Citizen" className="inline-flex items-center justify-center w-4 h-4 rounded-full bg-blue-500 text-white text-[10px] font-bold">
                                                            ✓
                                                        </span>
                                                    )}
                                                </div>
                                                <p className="text-[11px] text-slate-400">@{post.handle} • {post.time}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div className="px-4 pb-3 text-xs sm:text-sm text-slate-800 leading-relaxed whitespace-pre-line">
                                        {post.content}
                                    </div>

                                    {post.image && (
                                        <div className="relative bg-slate-100 max-h-96 overflow-hidden">
                                            <img src={post.image} alt="Attachment" className="w-full h-full object-cover" />
                                        </div>
                                    )}

                                    <div className="px-4 py-2 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-500">
                                        <div className="flex items-center gap-1.5">
                                            <span className="w-4 h-4 rounded-full bg-blue-600 text-white flex items-center justify-center text-[9px]">👍</span>
                                            <span className="font-semibold text-slate-700">{post.likes} জন</span>
                                        </div>
                                        <div className="flex items-center gap-3">
                                            <span className="cursor-pointer hover:underline" onClick={() => setActiveCommentPostId(activeCommentPostId === post.id ? null : post.id)}>
                                                {post.comments_count}টি মন্তব্য
                                            </span>
                                            <span>{post.shares} শেয়ার</span>
                                        </div>
                                    </div>

                                    <div className="px-2 py-1.5 border-t border-slate-100 grid grid-cols-3 gap-1 text-xs font-semibold text-slate-600">
                                        <button 
                                            type="button"
                                            onClick={() => handleToggleLike(post.id)}
                                            className={"py-2 rounded-xl flex items-center justify-center gap-1.5 hover:bg-slate-100 transition-colors cursor-pointer " + (
                                                post.is_liked ? "text-blue-600 font-bold" : ""
                                            )}>
                                            <ThumbsUp className={"w-4 h-4 " + (post.is_liked ? "fill-blue-600 text-blue-600" : "")} />
                                            <span>লাইক</span>
                                        </button>
                                        <button 
                                            type="button"
                                            onClick={() => setActiveCommentPostId(activeCommentPostId === post.id ? null : post.id)}
                                            className="py-2 rounded-xl flex items-center justify-center gap-1.5 hover:bg-slate-100 transition-colors cursor-pointer">
                                            <MessageCircle className="w-4 h-4" />
                                            <span>মন্তব্য</span>
                                        </button>
                                        <button 
                                            type="button"
                                            onClick={() => alert("পোস্ট লিংক কপি করা হয়েছে!")}
                                            className="py-2 rounded-xl flex items-center justify-center gap-1.5 hover:bg-slate-100 transition-colors cursor-pointer">
                                            <Share2 className="w-4 h-4" />
                                            <span>শেয়ার</span>
                                        </button>
                                    </div>

                                    {/* Expandable Comments Drawer */}
                                    {activeCommentPostId === post.id && (
                                        <div className="p-4 bg-slate-50 border-t border-slate-100 space-y-3">
                                            <div className="space-y-2">
                                                {post.comments && post.comments.length > 0 ? (
                                                    post.comments.map(c => (
                                                        <div key={c.id} className="flex items-start gap-2">
                                                            <div className="w-7 h-7 rounded-full bg-slate-300 text-slate-700 font-bold text-xs flex items-center justify-center shrink-0">
                                                                {c.user.charAt(0)}
                                                            </div>
                                                            <div className="bg-white rounded-2xl py-1.5 px-3 border border-slate-200 text-xs">
                                                                <span className="font-bold text-slate-900 block">{c.user}</span>
                                                                <span className="text-slate-700">{c.text}</span>
                                                            </div>
                                                        </div>
                                                    ))
                                                ) : (
                                                    <p className="text-xs text-slate-400 italic">এখনো কোনো মন্তব্য নেই। প্রথম মন্তব্যটি আপনি করুন!</p>
                                                )}
                                            </div>

                                            <div className="flex items-center gap-2 pt-1">
                                                <input 
                                                    type="text"
                                                    value={commentInput}
                                                    onChange={(e) => setCommentInput(e.target.value)}
                                                    onKeyDown={(e) => e.key === "Enter" && handleAddComment(post.id)}
                                                    placeholder="একটি সুন্দর মন্তব্য লিখুন..."
                                                    className="flex-1 py-2 px-3 bg-white text-xs rounded-full border border-slate-300 outline-none focus:border-blue-500"
                                                />
                                                <button 
                                                    type="button"
                                                    onClick={() => handleAddComment(post.id)}
                                                    className="py-2 px-3 rounded-full bg-blue-600 text-white font-bold text-xs hover:bg-blue-700 cursor-pointer">
                                                    <Send className="w-3.5 h-3.5" />
                                                </button>
                                            </div>
                                        </div>
                                    )}
                                </article>
                            ))}
                        </div>
                    </div>
                )}

                {/* TAB 2: FRIENDS & ACTIVITIES */}
                {activeTab === "friends" && (
                    <div className="space-y-4 animate-in fade-in duration-150">
                        {/* Stories Carousel */}
                        <div className="bg-white rounded-2xl border border-slate-200/90 shadow-2xs p-3.5 overflow-hidden">
                            <div className="flex items-center justify-between mb-2 px-1">
                                <h3 className="text-xs font-bold text-slate-800 uppercase tracking-wider">বন্ধুদের স্টোরি ও মুহূর্ত</h3>
                                <span className="text-[11px] text-blue-600 font-semibold cursor-pointer">সবগুলো দেখুন</span>
                            </div>

                            <div className="flex items-center gap-3 overflow-x-auto pb-1">
                                {stories.map(s => (
                                    <div 
                                        key={s.id}
                                        onClick={() => s.img && setActiveStory(s)}
                                        className="flex flex-col items-center gap-1.5 shrink-0 cursor-pointer">
                                        <div className={"relative w-14 h-14 rounded-full p-0.5 " + (
                                            s.is_owner 
                                                ? "border-2 border-dashed border-slate-300" 
                                                : s.seen ? "ring-2 ring-slate-300" : "ring-2 ring-blue-600 ring-offset-2"
                                        )}>
                                            <div className="w-full h-full rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 text-white font-bold text-sm flex items-center justify-center overflow-hidden">
                                                {s.img ? (
                                                    <img src={s.img} alt={s.name} className="w-full h-full object-cover" />
                                                ) : (
                                                    s.name.charAt(0)
                                                )}
                                            </div>
                                            {s.is_owner && (
                                                <span className="absolute bottom-0 right-0 w-4 h-4 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs font-bold ring-2 ring-white">
                                                    +
                                                </span>
                                            )}
                                        </div>
                                        <span className="text-[11px] font-medium text-slate-700 max-w-[64px] truncate text-center">
                                            {s.name}
                                        </span>
                                    </div>
                                ))}
                            </div>
                        </div>

                        {/* Friend Requests */}
                        {friendRequests.length > 0 && (
                            <div className="bg-white rounded-2xl border border-slate-200/90 shadow-2xs p-4">
                                <div className="flex items-center justify-between mb-3">
                                    <h3 className="text-xs font-bold text-slate-900 uppercase tracking-wider flex items-center gap-2">
                                        <Users className="w-4 h-4 text-blue-600" />
                                        <span>বন্ধুত্বের অনুরোধ ({friendRequests.length}টি)</span>
                                    </h3>
                                    <span className="text-[11px] text-blue-600 font-semibold cursor-pointer">সবগুলো দেখুন</span>
                                </div>

                                <div className="space-y-3">
                                    {friendRequests.map(fr => (
                                        <div key={fr.id} className="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                                            <div className="flex items-center gap-3">
                                                <div className="w-10 h-10 rounded-full bg-slate-800 text-white font-bold text-sm flex items-center justify-center">
                                                    {fr.name.charAt(0)}
                                                </div>
                                                <div>
                                                    <h4 className="text-xs font-bold text-slate-900">{fr.name}</h4>
                                                    <p className="text-[10px] text-slate-500">{fr.mutual} জন মিউচুয়াল ফ্রেন্ড • {fr.city}</p>
                                                </div>
                                            </div>

                                            <div className="flex items-center gap-1.5">
                                                <button 
                                                    type="button"
                                                    onClick={() => setFriendRequests(prev => prev.filter(r => r.id !== fr.id))}
                                                    className="py-1.5 px-3 rounded-full bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold shadow-xs transition-all cursor-pointer">
                                                    কনফার্ম
                                                </button>
                                                <button 
                                                    type="button"
                                                    onClick={() => setFriendRequests(prev => prev.filter(r => r.id !== fr.id))}
                                                    className="py-1.5 px-3 rounded-full bg-slate-200 hover:bg-slate-300 text-slate-700 text-xs font-semibold transition-all cursor-pointer">
                                                    মুছে ফেলুন
                                                </button>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            </div>
                        )}

                        {/* Friend Activities Stream */}
                        <div className="space-y-4">
                            <div className="flex items-center justify-between px-1">
                                <h3 className="text-xs font-bold text-slate-500 uppercase tracking-wider">বন্ধুদের সাম্প্রতিক অ্যাক্টিভিটি</h3>
                                <span className="text-[11px] text-slate-400">লাইভ আপডেট</span>
                            </div>

                            {friendActivities.map(act => (
                                <article key={act.id} className="bg-white rounded-2xl border border-slate-200/90 shadow-2xs overflow-hidden transition-all hover:border-slate-300">
                                    <div className="p-4 flex items-center justify-between">
                                        <div className="flex items-center gap-3">
                                            <div className="relative w-10 h-10 rounded-full bg-indigo-600 text-white font-bold text-sm flex items-center justify-center shrink-0">
                                                {act.friend_name.charAt(0)}
                                            </div>
                                            <div>
                                                <div className="flex items-center gap-1.5 flex-wrap">
                                                    <h4 className="text-xs sm:text-sm font-bold text-slate-900 leading-tight">
                                                        {act.friend_name}
                                                    </h4>
                                                    {act.is_verified && (
                                                        <span className="w-3.5 h-3.5 rounded-full bg-blue-500 text-white flex items-center justify-center text-[8px] font-bold">
                                                            ✓
                                                        </span>
                                                    )}
                                                    <span className="text-xs text-slate-500">{act.action_text}</span>
                                                </div>
                                                <p className="text-[10px] text-slate-400">@{act.friend_handle} • {act.time}</p>
                                            </div>
                                        </div>
                                    </div>

                                    {act.content && (
                                        <div className="px-4 pb-3 text-xs sm:text-sm text-slate-800 leading-relaxed">
                                            {act.content}
                                        </div>
                                    )}

                                    {act.image && (
                                        <div className="bg-slate-100 max-h-80 overflow-hidden">
                                            <img src={act.image} alt="Friend Post" className="w-full h-full object-cover" />
                                        </div>
                                    )}

                                    <div className="px-4 py-2 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-500">
                                        <div className="flex items-center gap-1.5">
                                            <span className="w-4 h-4 rounded-full bg-blue-600 text-white flex items-center justify-center text-[9px]">👍</span>
                                            <span>{act.likes}</span>
                                        </div>
                                        <span>{act.comments_count} মন্তব্য</span>
                                    </div>

                                    <div className="px-2 py-1.5 border-t border-slate-100 grid grid-cols-2 gap-1 text-xs font-semibold text-slate-600">
                                        <button 
                                            type="button"
                                            onClick={() => handleToggleLike(act.id, true)}
                                            className={"py-2 rounded-xl flex items-center justify-center gap-1.5 hover:bg-slate-100 transition-colors cursor-pointer " + (
                                                act.is_liked ? "text-blue-600 font-bold" : ""
                                            )}>
                                            <ThumbsUp className={"w-4 h-4 " + (act.is_liked ? "fill-blue-600 text-blue-600" : "")} />
                                            <span>লাইক</span>
                                        </button>
                                        <button 
                                            type="button"
                                            onClick={() => alert("মন্তব্য অপশন খুলছে...")}
                                            className="py-2 rounded-xl flex items-center justify-center gap-1.5 hover:bg-slate-100 transition-colors cursor-pointer">
                                            <MessageCircle className="w-4 h-4" />
                                            <span>মন্তব্য</span>
                                        </button>
                                    </div>
                                </article>
                            ))}
                        </div>
                    </div>
                )}

                {/* TAB 3: PROFILE & BLUE BADGE PORTAL */}
                {activeTab === "profile" && (
                    <div className="space-y-4 animate-in fade-in duration-150">
                        {/* Profile Header */}
                        <div className="bg-white rounded-3xl border border-slate-200/90 shadow-2xs overflow-hidden">
                            <div className="h-32 sm:h-40 bg-gradient-to-r from-blue-600 via-indigo-600 to-cyan-500 relative">
                                <button type="button" className="absolute top-3 right-3 py-1.5 px-3 rounded-full bg-black/40 hover:bg-black/60 text-white text-[11px] font-semibold flex items-center gap-1.5">
                                    <Camera className="w-3.5 h-3.5" />
                                    <span>কভার পরিবর্তন</span>
                                </button>
                            </div>

                            <div className="px-5 pb-5">
                                <div className="relative flex justify-between items-end -mt-12 sm:-mt-14 mb-3">
                                    <div className="relative">
                                        <div className="w-24 h-24 sm:w-28 sm:h-28 rounded-full bg-gradient-to-tr from-blue-700 to-indigo-700 text-white font-black text-3xl flex items-center justify-center ring-4 ring-white shadow-md">
                                            {user.name.charAt(0)}
                                        </div>
                                    </div>

                                    <div className="flex items-center gap-2">
                                        {user.is_verified ? (
                                            <span className="py-1.5 px-3 rounded-full bg-blue-50 text-blue-700 border border-blue-200 text-xs font-bold flex items-center gap-1.5 shadow-2xs">
                                                <span className="w-4 h-4 rounded-full bg-blue-600 text-white flex items-center justify-center text-[10px]">✓</span>
                                                <span>ভেরিফাইড সিটিজেন</span>
                                            </span>
                                        ) : (
                                            <button 
                                                type="button"
                                                onClick={() => setProfileSubtab("badge")}
                                                className="py-2 px-4 rounded-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold text-xs shadow-md shadow-blue-500/20 hover:from-blue-700 hover:to-indigo-700 transition-all flex items-center gap-1.5 cursor-pointer">
                                                <ShieldCheck className="w-4 h-4" />
                                                <span>ব্লু ব্যাজের আবেদন</span>
                                            </button>
                                        )}
                                    </div>
                                </div>

                                <div className="flex items-center gap-2 mb-1">
                                    <h1 className="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">
                                        {user.name}
                                    </h1>
                                    {user.is_verified && (
                                        <span title="Official Verified Citizen" className="w-5 h-5 rounded-full bg-blue-500 text-white flex items-center justify-center text-xs font-black shadow-xs ring-2 ring-white">
                                            ✓
                                        </span>
                                    )}
                                </div>
                                <p className="text-xs text-slate-500 mb-2 font-mono">@{user.handle} • {user.city}</p>
                                <p className="text-xs sm:text-sm text-slate-700 leading-relaxed mb-4">
                                    {user.bio}
                                </p>

                                <div className="flex items-center gap-6 text-xs text-slate-600 pt-3 border-t border-slate-100">
                                    <div><strong className="text-slate-900 font-extrabold">১২</strong> পোস্ট</div>
                                    <div><strong className="text-slate-900 font-extrabold">{user.followers_count}</strong> ফলোয়ার</div>
                                    <div><strong className="text-slate-900 font-extrabold">{user.friends_count}</strong> বন্ধু</div>
                                </div>
                            </div>
                        </div>

                        {/* Profile Subtabs */}
                        <div className="bg-white rounded-2xl border border-slate-200/90 p-1.5 flex gap-1 text-xs font-bold">
                            <button 
                                type="button"
                                onClick={() => setProfileSubtab("badge")}
                                className={"flex-1 py-2 rounded-xl transition-all flex items-center justify-center gap-1.5 " + (
                                    profileSubtab === "badge" ? "bg-blue-600 text-white shadow-xs" : "text-slate-600 hover:bg-slate-100"
                                )}>
                                <ShieldCheck className="w-4 h-4" />
                                <span>ভেরিফিকেশন ব্লু ব্যাজ</span>
                            </button>
                            <button 
                                type="button"
                                onClick={() => setProfileSubtab("posts")}
                                className={"flex-1 py-2 rounded-xl transition-all " + (
                                    profileSubtab === "posts" ? "bg-blue-600 text-white shadow-xs" : "text-slate-600 hover:bg-slate-100"
                                )}>
                                আমার পোস্টসমূহ
                            </button>
                            <button 
                                type="button"
                                onClick={() => setProfileSubtab("photos")}
                                className={"flex-1 py-2 rounded-xl transition-all " + (
                                    profileSubtab === "photos" ? "bg-blue-600 text-white shadow-xs" : "text-slate-600 hover:bg-slate-100"
                                )}>
                                ফটো গ্যালারি
                            </button>
                        </div>

                        {/* Tab Content: Badge Verification Portal */}
                        {profileSubtab === "badge" && (
                            <div className="space-y-4">
                                {/* Interactive State Switcher for Demo / Review */}
                                <div className="bg-slate-900 text-white rounded-2xl p-4 shadow-sm">
                                    <div className="flex items-center justify-between gap-2 mb-2">
                                        <div className="flex items-center gap-2">
                                            <Sparkles className="w-4 h-4 text-amber-400" />
                                            <span className="text-xs font-black uppercase tracking-wider text-slate-300">ভেরিফিকেশন লাইফসাইকেল ডেমো সুইচার</span>
                                        </div>
                                        <span className="text-[10px] bg-white/10 px-2 py-0.5 rounded-full font-mono text-slate-400">Interactive Preview</span>
                                    </div>
                                    <p className="text-xs text-slate-400 mb-3">
                                        নিচের বাটনগুলোতে ক্লিক করে ভেরিফিকেশনের ৪টি ধাপ সরাসরি টেস্ট করতে পারবেন:
                                    </p>
                                    <div className="grid grid-cols-2 sm:grid-cols-4 gap-1.5 text-xs font-bold">
                                        <button 
                                            type="button"
                                            onClick={() => setVerifyState("idle")}
                                            className={"px-2.5 py-1.5 rounded-xl border text-center transition-all " + (
                                                verifyState === "idle" ? "bg-blue-600 border-blue-500 text-white shadow-xs" : "bg-slate-800/80 border-slate-700 text-slate-300 hover:bg-slate-700"
                                            )}>
                                            ১. আবেদন ফরম
                                        </button>
                                        <button 
                                            type="button"
                                            onClick={() => setVerifyState("in_review")}
                                            className={"px-2.5 py-1.5 rounded-xl border text-center transition-all " + (
                                                verifyState === "in_review" ? "bg-amber-600 border-amber-500 text-white shadow-xs" : "bg-slate-800/80 border-slate-700 text-slate-300 hover:bg-slate-700"
                                            )}>
                                            ২. রিভিউ চলছে
                                        </button>
                                        <button 
                                            type="button"
                                            onClick={() => setVerifyState("approved")}
                                            className={"px-2.5 py-1.5 rounded-xl border text-center transition-all " + (
                                                verifyState === "approved" ? "bg-emerald-600 border-emerald-500 text-white shadow-xs" : "bg-slate-800/80 border-slate-700 text-slate-300 hover:bg-slate-700"
                                            )}>
                                            ৩. অ্যাপ্রুভড (পেমেন্ট)
                                        </button>
                                        <button 
                                            type="button"
                                            onClick={() => setVerifyState("active")}
                                            className={"px-2.5 py-1.5 rounded-xl border text-center transition-all " + (
                                                verifyState === "active" ? "bg-blue-600 border-blue-500 text-white shadow-xs" : "bg-slate-800/80 border-slate-700 text-slate-300 hover:bg-slate-700"
                                            )}>
                                            ৪. অ্যাক্টিভ ব্যাজ
                                        </button>
                                    </div>
                                </div>

                                {/* State 1: Application Form */}
                                {verifyState === "idle" && (
                                    <div className="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-xs">
                                        <div className="flex items-start gap-3 mb-4">
                                            <div className="w-10 h-10 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                                <BadgeCheck className="w-6 h-6" />
                                            </div>
                                            <div>
                                                <h3 className="text-base font-extrabold text-slate-900 leading-tight">
                                                    সার্টিফাইড সিটিজেন ব্লু ব্যাজের জন্য আবেদন
                                                </h3>
                                                <p className="text-xs text-slate-500 mt-1 leading-relaxed">
                                                    ভুয়া পরিচয় রোধ এবং প্ল্যাটফর্মে সত্যতা নিশ্চিত করতে আপনার তথ্য যাচাই করা হবে। তথ্য যাচাইয়ের পর পেমেন্ট গেটওয়ে উন্মুক্ত হবে।
                                                </p>
                                            </div>
                                        </div>

                                        <form onSubmit={handleApplySubmit} className="space-y-4">
                                            <div>
                                                <label className="block text-xs font-bold text-slate-700 mb-1.5">
                                                    জাতীয় পরিচয়পত্র (NID) নম্বর <span className="text-rose-500">*</span>
                                                </label>
                                                <input 
                                                    type="text"
                                                    required
                                                    value={applyForm.nid}
                                                    onChange={e => setApplyForm({...applyForm, nid: e.target.value})}
                                                    placeholder="যেমন: 19941234567890123"
                                                    className="w-full text-xs font-mono px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-600 bg-slate-50/50"
                                                />
                                            </div>

                                            <div>
                                                <label className="block text-xs font-bold text-slate-700 mb-1.5">
                                                    পুরো নাম (NID অনুযায়ী) <span className="text-rose-500">*</span>
                                                </label>
                                                <input 
                                                    type="text"
                                                    required
                                                    value={applyForm.fullName}
                                                    onChange={e => setApplyForm({...applyForm, fullName: e.target.value})}
                                                    placeholder="আপনার অফিসিয়াল নাম লিখুন"
                                                    className="w-full text-xs px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-600 bg-slate-50/50"
                                                />
                                            </div>

                                            <div>
                                                <label className="block text-xs font-bold text-slate-700 mb-1.5">
                                                    পেশা বা পরিচয় ক্যাটাগরি <span className="text-rose-500">*</span>
                                                </label>
                                                <select 
                                                    value={applyForm.category}
                                                    onChange={e => setApplyForm({...applyForm, category: e.target.value})}
                                                    className="w-full text-xs px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-600 bg-slate-50/50 text-slate-700 font-medium">
                                                    <option value="public_citizen">সাধারণ নাগরিক / পাবলিক সিটিজেন</option>
                                                    <option value="professional">প্রফেশনাল (আইনজীবী, শিক্ষক, ইঞ্জিনিয়ার)</option>
                                                    <option value="creator">কন্টেন্ট ক্রিয়েটর / ইনফ্লুয়েন্সার</option>
                                                    <option value="business">উদ্যোক্তা / ব্যবসা প্রতিষ্ঠান</option>
                                                </select>
                                            </div>

                                            <div>
                                                <label className="block text-xs font-bold text-slate-700 mb-1.5">
                                                    ডকুমেন্ট বা ছবি প্রমাণ আপলোড (NID বা ভিজিটিং কার্ড)
                                                </label>
                                                <div className="border-2 border-dashed border-slate-200 rounded-2xl p-4 text-center bg-slate-50/50 hover:bg-slate-50 cursor-pointer transition-colors">
                                                    <UploadCloud className="w-6 h-6 text-slate-400 mx-auto mb-1" />
                                                    <span className="text-xs text-slate-600 font-semibold block">ক্লিক করে ফাইল সিলেক্ট করুন বা ড্র্যাগ করুন</span>
                                                    <span className="text-[10px] text-slate-400 font-medium">JPG, PNG বা PDF (সর্বোচ্চ ৫ MB)</span>
                                                </div>
                                            </div>

                                            <div className="pt-2">
                                                <button 
                                                    type="submit"
                                                    className="w-full py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-extrabold text-xs shadow-md shadow-blue-500/20 transition-all flex items-center justify-center gap-2">
                                                    <span>আবেদন সাবমিট করুন</span>
                                                    <ArrowRight className="w-4 h-4" />
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                )}

                                {/* State 2: Internal Review in Progress */}
                                {verifyState === "in_review" && (
                                    <div className="bg-white rounded-2xl border border-amber-200/90 p-5 shadow-xs">
                                        <div className="flex items-center gap-3 p-4 bg-amber-50 rounded-2xl border border-amber-200/60 mb-4">
                                            <div className="w-10 h-10 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center shrink-0">
                                                <Clock className="w-5 h-5 animate-pulse" />
                                            </div>
                                            <div>
                                                <div className="flex items-center gap-2">
                                                    <h4 className="text-sm font-extrabold text-amber-900">অভ্যন্তরীণ যাচাই প্রক্রিয়াধীন</h4>
                                                    <span className="text-[10px] bg-amber-200 text-amber-800 font-bold px-2 py-0.5 rounded-full">Under Review</span>
                                                </div>
                                                <p className="text-xs text-amber-700 mt-0.5">
                                                    আপনার NID ও পরিচয় তথ্য Zengfy ভেরিফিকেশন টিম ম্যানুয়ালি যাচাই করছে।
                                                </p>
                                            </div>
                                        </div>

                                        <div className="space-y-3 text-xs text-slate-600 border border-slate-100 rounded-2xl p-4 bg-slate-50/50 mb-4">
                                            <div className="flex justify-between py-1 border-b border-slate-200/60">
                                                <span className="text-slate-400 font-medium">ট্র্যাকিং রেফারেন্স:</span>
                                                <span className="font-mono font-bold text-slate-800">ZN-VERIFY-88429</span>
                                            </div>
                                            <div className="flex justify-between py-1 border-b border-slate-200/60">
                                                <span className="text-slate-400 font-medium">আবেদনের তারিখ:</span>
                                                <span className="font-semibold text-slate-800">২১ অক্টোবর, ২০২৬</span>
                                            </div>
                                            <div className="flex justify-between py-1 border-b border-slate-200/60">
                                                <span className="text-slate-400 font-medium">আনুমানিক সময়:</span>
                                                <span className="font-semibold text-emerald-600">২ থেকে ২৪ ঘণ্টা</span>
                                            </div>
                                            <div className="flex justify-between py-1">
                                                <span className="text-slate-400 font-medium">পরবর্তী ধাপ:</span>
                                                <span className="font-semibold text-blue-600">অনুমোদিত হলে পেমেন্ট অপশন আনলক হবে</span>
                                            </div>
                                        </div>

                                        <div className="flex items-center gap-2">
                                            <button 
                                                type="button"
                                                onClick={() => setVerifyState("approved")}
                                                className="flex-1 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs transition-all flex items-center justify-center gap-1.5">
                                                <CheckCircle2 className="w-4 h-4" />
                                                <span>রিভিউ অনুমোদন করুন (সিমুলেশন)</span>
                                            </button>
                                            <button 
                                                type="button"
                                                onClick={() => setVerifyState("idle")}
                                                className="py-2.5 px-3 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 font-bold text-xs transition-all">
                                                বাতিল
                                            </button>
                                        </div>
                                    </div>
                                )}

                                {/* State 3: Approved & Payment Gate */}
                                {verifyState === "approved" && (
                                    <div className="bg-white rounded-2xl border border-emerald-200/90 p-5 shadow-xs space-y-4">
                                        <div className="flex items-center gap-3 p-4 bg-emerald-50 rounded-2xl border border-emerald-200/60">
                                            <div className="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                                                <CheckCircle2 className="w-6 h-6" />
                                            </div>
                                            <div>
                                                <div className="flex items-center gap-2">
                                                    <h4 className="text-sm font-extrabold text-emerald-950">অভিনন্দন! আপনার আবেদন অনুমোদিত হয়েছে</h4>
                                                    <span className="text-[10px] bg-emerald-200 text-emerald-800 font-bold px-2 py-0.5 rounded-full">Approved</span>
                                                </div>
                                                <p className="text-xs text-emerald-700 mt-0.5">
                                                    আপনার আইডি সফলভাবে যাচাইকৃত। ব্লু ব্যাজ প্রোফাইলে ও ফিডে সক্রিয় করতে সাবস্ক্রিপশন সম্পন্ন করুন।
                                                </p>
                                            </div>
                                        </div>

                                        {/* Plan Selector */}
                                        <div>
                                            <label className="block text-xs font-bold text-slate-700 mb-2">
                                                সাবস্ক্রিপশন প্ল্যান নির্বাচন করুন:
                                            </label>
                                            <div className="grid grid-cols-2 gap-3">
                                                <div 
                                                    onClick={() => setSelectedPlan("monthly")}
                                                    className={"p-3.5 rounded-2xl border-2 cursor-pointer transition-all " + (
                                                        selectedPlan === "monthly" ? "border-blue-600 bg-blue-50/40 shadow-xs" : "border-slate-200 hover:border-slate-300"
                                                    )}>
                                                    <div className="flex items-center justify-between mb-1">
                                                        <span className="text-xs font-extrabold text-slate-900">মাসিক প্ল্যান</span>
                                                        <span className={"w-4 h-4 rounded-full border-2 flex items-center justify-center " + (selectedPlan === "monthly" ? "border-blue-600 bg-blue-600" : "border-slate-300")}>
                                                            {selectedPlan === "monthly" && <div className="w-1.5 h-1.5 rounded-full bg-white" />}
                                                        </span>
                                                    </div>
                                                    <div className="text-lg font-black text-blue-600">৳৫০ <span className="text-xs font-normal text-slate-500">/ মাস</span></div>
                                                    <span className="text-[10px] text-slate-500 block mt-1">যেকোনো সময় বাতিলযোগ্য</span>
                                                </div>

                                                <div 
                                                    onClick={() => setSelectedPlan("yearly")}
                                                    className={"p-3.5 rounded-2xl border-2 cursor-pointer transition-all relative " + (
                                                        selectedPlan === "yearly" ? "border-blue-600 bg-blue-50/40 shadow-xs" : "border-slate-200 hover:border-slate-300"
                                                    )}>
                                                    <span className="absolute -top-2 right-3 bg-gradient-to-r from-amber-500 to-rose-500 text-white text-[9px] font-black px-2 py-0.5 rounded-full shadow-xs">
                                                        ১৭% ছাড়
                                                    </span>
                                                    <div className="flex items-center justify-between mb-1">
                                                        <span className="text-xs font-extrabold text-slate-900">বার্ষিক প্ল্যান</span>
                                                        <span className={"w-4 h-4 rounded-full border-2 flex items-center justify-center " + (selectedPlan === "yearly" ? "border-blue-600 bg-blue-600" : "border-slate-300")}>
                                                            {selectedPlan === "yearly" && <div className="w-1.5 h-1.5 rounded-full bg-white" />}
                                                        </span>
                                                    </div>
                                                    <div className="text-lg font-black text-blue-600">৳৫০০ <span className="text-xs font-normal text-slate-500">/ বছর</span></div>
                                                    <span className="text-[10px] text-emerald-600 font-bold block mt-1">বছরে ১০০ টাকা সাশ্রয়</span>
                                                </div>
                                            </div>
                                        </div>

                                        {/* Payment Methods */}
                                        <div>
                                            <label className="block text-xs font-bold text-slate-700 mb-2">
                                                পেমেন্ট মেথড সিলেক্ট করুন:
                                            </label>
                                            <div className="grid grid-cols-3 gap-2">
                                                <button 
                                                    type="button"
                                                    onClick={() => setPaymentMethod("bkash")}
                                                    className={"py-2.5 px-3 rounded-xl border-2 font-bold text-xs transition-all flex items-center justify-center gap-1.5 " + (
                                                        paymentMethod === "bkash" ? "border-pink-600 bg-pink-50 text-pink-700" : "border-slate-200 text-slate-700 hover:bg-slate-50"
                                                    )}>
                                                    <CreditCard className="w-4 h-4 text-pink-600" />
                                                    <span>বিকাশ (bKash)</span>
                                                </button>
                                                <button 
                                                    type="button"
                                                    onClick={() => setPaymentMethod("nagad")}
                                                    className={"py-2.5 px-3 rounded-xl border-2 font-bold text-xs transition-all flex items-center justify-center gap-1.5 " + (
                                                        paymentMethod === "nagad" ? "border-orange-600 bg-orange-50 text-orange-700" : "border-slate-200 text-slate-700 hover:bg-slate-50"
                                                    )}>
                                                    <CreditCard className="w-4 h-4 text-orange-600" />
                                                    <span>নগদ (Nagad)</span>
                                                </button>
                                                <button 
                                                    type="button"
                                                    onClick={() => setPaymentMethod("card")}
                                                    className={"py-2.5 px-3 rounded-xl border-2 font-bold text-xs transition-all flex items-center justify-center gap-1.5 " + (
                                                        paymentMethod === "card" ? "border-blue-600 bg-blue-50 text-blue-700" : "border-slate-200 text-slate-700 hover:bg-slate-50"
                                                    )}>
                                                    <CreditCard className="w-4 h-4 text-blue-600" />
                                                    <span>কার্ড / ভিসা</span>
                                                </button>
                                            </div>
                                        </div>

                                        <button 
                                            type="button"
                                            disabled={isPaying}
                                            onClick={handlePaySubmit}
                                            className="w-full py-3.5 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-black text-sm shadow-md shadow-blue-500/25 transition-all flex items-center justify-center gap-2 disabled:opacity-50">
                                            {isPaying ? (
                                                <>
                                                    <Loader2 className="w-4 h-4 animate-spin" />
                                                    <span>পেমেন্ট প্রসেসিং হচ্ছে...</span>
                                                </>
                                            ) : (
                                                <>
                                                    <Lock className="w-4 h-4" />
                                                    <span>পেমেন্ট করুন ও ব্লু ব্যাজ সক্রিয় করুন ({selectedPlan === "yearly" ? "৳৫০০" : "৳৫০"})</span>
                                                </>
                                            )}
                                        </button>
                                    </div>
                                )}

                                {/* State 4: Active Verified */}
                                {verifyState === "active" && (
                                    <div className="bg-white rounded-2xl border border-blue-200 p-5 shadow-xs space-y-4">
                                        <div className="flex items-center gap-3 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl border border-blue-200/80">
                                            <div className="w-12 h-12 rounded-2xl bg-gradient-to-tr from-blue-600 to-indigo-600 text-white flex items-center justify-center shadow-md shadow-blue-500/30 shrink-0">
                                                <BadgeCheck className="w-7 h-7" />
                                            </div>
                                            <div>
                                                <div className="flex items-center gap-2">
                                                    <h4 className="text-base font-extrabold text-slate-900">আপনার ব্লু ব্যাজ এখন সক্রিয়!</h4>
                                                    <span className="text-[10px] bg-blue-600 text-white font-extrabold px-2 py-0.5 rounded-full">Active</span>
                                                </div>
                                                <p className="text-xs text-slate-600 mt-0.5">
                                                    আপনার নামের পাশে এখন সার্টিফাইড সিটিজেন ব্লু ব্যাজ দৃশ্যমান।
                                                </p>
                                            </div>
                                        </div>

                                        <div className="space-y-2.5 text-xs text-slate-600 border border-slate-100 rounded-2xl p-4 bg-slate-50/50">
                                            <div className="flex items-center gap-2 font-bold text-slate-800 mb-2">
                                                <Sparkles className="w-4 h-4 text-amber-500" />
                                                <span>সক্রিয় সুবিধাসমূহ:</span>
                                            </div>
                                            <div className="flex items-center gap-2 text-slate-600">
                                                <CheckCircle2 className="w-3.5 h-3.5 text-emerald-500" />
                                                <span>পাবলিক ফিডে এবং মন্তব্যে ব্লু টিক ব্যাজ ডিসপ্লে</span>
                                            </div>
                                            <div className="flex items-center gap-2 text-slate-600">
                                                <CheckCircle2 className="w-3.5 h-3.5 text-emerald-500" />
                                                <span>হাই প্রায়োরিটি কমেন্ট ও পোস্ট র‍্যাঙ্কিং</span>
                                            </div>
                                            <div className="flex items-center gap-2 text-slate-600">
                                                <CheckCircle2 className="w-3.5 h-3.5 text-emerald-500" />
                                                <span>ভেরিফাইড আইডি সুরক্ষায় ডুপ্লিকেট অ্যাকাউন্ট প্রটেকশন</span>
                                            </div>
                                            <div className="pt-2 border-t border-slate-200/60 flex items-center justify-between text-slate-500 text-[11px]">
                                                <span>পরবর্তী রিনিউয়াল তারিখ:</span>
                                                <span className="font-bold text-slate-800">২১ নভেম্বর, ২০২৬</span>
                                            </div>
                                        </div>

                                        <div className="flex items-center gap-2">
                                            <button 
                                                type="button"
                                                onClick={() => showToast("মানি রিসিট ডাউনলোড করা হয়েছে")}
                                                className="flex-1 py-2.5 rounded-xl border border-slate-200 text-slate-700 hover:bg-slate-50 font-bold text-xs transition-all flex items-center justify-center gap-1.5">
                                                <FileText className="w-3.5 h-3.5 text-slate-500" />
                                                <span>পেমেন্ট রিসিট ডাউনলোড</span>
                                            </button>
                                            <button 
                                                type="button"
                                                onClick={() => {
                                                    setVerifyState("idle");
                                                    showToast("সাবস্ক্রিপশন রিসেট করা হয়েছে");
                                                }}
                                                className="py-2.5 px-3 rounded-xl border border-rose-200 text-rose-600 hover:bg-rose-50 font-bold text-xs transition-all">
                                                রিসেট
                                            </button>
                                        </div>
                                    </div>
                                )}
                            </div>
                        )}

                        {/* Tab Content: My Posts */}
                        {profileSubtab === "posts" && (
                            <div className="space-y-4">
                                <div className="bg-white rounded-2xl border border-slate-200/90 p-4 shadow-xs">
                                    <div className="flex items-center gap-3 mb-3">
                                        <div className="w-10 h-10 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 text-white font-black text-sm flex items-center justify-center shrink-0">
                                            {user.name.charAt(0)}
                                        </div>
                                        <div className="flex-1">
                                            <div className="flex items-center gap-1.5">
                                                <h4 className="font-extrabold text-xs text-slate-900">{user.name}</h4>
                                                {(verifyState === "active" || user.is_verified) && (
                                                    <span className="w-4 h-4 bg-blue-600 rounded-full flex items-center justify-center text-white text-[9px] font-bold">✓</span>
                                                )}
                                            </div>
                                            <span className="text-[10px] text-slate-400">২ দিন আগে • পাবলিক ফিড</span>
                                        </div>
                                    </div>
                                    <p className="text-xs text-slate-800 leading-relaxed">
                                        Zengfy ইকোসিস্টেমে সিটিজেন ভেরিফিকেশন সিস্টেম চালু হলো! এখন প্রতিটি নাগরিক স্বকীয়ভাবে তার পরিচয় সংরক্ষণ ও কমিউনিটিতে অবদান রাখতে পারবেন।
                                    </p>
                                    <div className="mt-3 pt-2.5 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500 font-semibold">
                                        <span className="flex items-center gap-1 text-blue-600"><ThumbsUp className="w-3.5 h-3.5" /> ৪২ লাইক</span>
                                        <span>৮ মন্তব্য</span>
                                    </div>
                                </div>

                                <div className="bg-white rounded-2xl border border-slate-200/90 p-4 shadow-xs">
                                    <div className="flex items-center gap-3 mb-3">
                                        <div className="w-10 h-10 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 text-white font-black text-sm flex items-center justify-center shrink-0">
                                            {user.name.charAt(0)}
                                        </div>
                                        <div className="flex-1">
                                            <div className="flex items-center gap-1.5">
                                                <h4 className="font-extrabold text-xs text-slate-900">{user.name}</h4>
                                                {(verifyState === "active" || user.is_verified) && (
                                                    <span className="w-4 h-4 bg-blue-600 rounded-full flex items-center justify-center text-white text-[9px] font-bold">✓</span>
                                                )}
                                            </div>
                                            <span className="text-[10px] text-slate-400">১ সপ্তাহ আগে</span>
                                        </div>
                                    </div>
                                    <p className="text-xs text-slate-800 leading-relaxed mb-3">
                                        আজ নতুন অফিস স্পেস ভিজিট করলাম। প্রযুক্তি উদ্যোক্তাদের জন্য এক অপূর্ব ক্ষেত্র তৈরি হচ্ছে।
                                    </p>
                                    <div className="rounded-xl overflow-hidden max-h-60">
                                        <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?w=800&auto=format&fit=crop" alt="Office" className="w-full h-full object-cover" />
                                    </div>
                                    <div className="mt-3 pt-2.5 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500 font-semibold">
                                        <span className="flex items-center gap-1 text-blue-600"><ThumbsUp className="w-3.5 h-3.5" /> ৮৫ লাইক</span>
                                        <span>১৫ মন্তব্য</span>
                                    </div>
                                </div>
                            </div>
                        )}

                        {/* Tab Content: Photo Gallery */}
                        {profileSubtab === "photos" && (
                            <div className="bg-white rounded-2xl border border-slate-200/90 p-4 shadow-xs">
                                <div className="flex items-center justify-between mb-3">
                                    <h4 className="font-extrabold text-xs text-slate-900">ফটো ও অ্যালবাম (৬)</h4>
                                    <span className="text-[11px] text-blue-600 font-bold hover:underline cursor-pointer">সব দেখুন</span>
                                </div>
                                <div className="grid grid-cols-3 gap-2">
                                    {[
                                        "https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=400&auto=format&fit=crop",
                                        "https://images.unsplash.com/photo-1497366216548-37526070297c?w=400&auto=format&fit=crop",
                                        "https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=400&auto=format&fit=crop",
                                        "https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=400&auto=format&fit=crop",
                                        "https://images.unsplash.com/photo-1470240731273-7821a6eeb6bd?w=400&auto=format&fit=crop",
                                        "https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=400&auto=format&fit=crop"
                                    ].map((url, i) => (
                                        <div key={i} className="aspect-square rounded-xl overflow-hidden border border-slate-100 hover:opacity-90 cursor-pointer shadow-2xs">
                                            <img src={url} alt={"Gallery " + i} className="w-full h-full object-cover" />
                                        </div>
                                    ))}
                                </div>
                            </div>
                        )}
                    </div>
                )}
            </main>

            {/* Story Viewer Modal */}
            {activeStory && (
                <div className="fixed inset-0 z-50 bg-black/95 backdrop-blur-md flex items-center justify-center p-4">
                    <div className="relative w-full max-w-sm aspect-[9/16] bg-slate-900 rounded-3xl overflow-hidden shadow-2xl flex flex-col justify-between p-4 text-white">
                        {/* Progress bar */}
                        <div className="w-full h-1 bg-white/30 rounded-full overflow-hidden mb-3">
                            <div className="h-full bg-white animate-[pulse_3s_ease-in-out_infinite] w-full" />
                        </div>
                        {/* Top user row */}
                        <div className="flex items-center justify-between z-10">
                            <div className="flex items-center gap-2">
                                <div className="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center font-bold text-xs ring-2 ring-white">
                                    {activeStory.name?.charAt(0) || "U"}
                                </div>
                                <div>
                                    <span className="text-xs font-bold block">{activeStory.name}</span>
                                    <span className="text-[10px] text-white/70 block">{activeStory.time || "এখনই"}</span>
                                </div>
                            </div>
                            <button 
                                type="button"
                                onClick={() => setActiveStory(null)}
                                className="w-8 h-8 rounded-full bg-black/50 text-white hover:bg-black/70 flex items-center justify-center cursor-pointer">
                                <X className="w-4 h-4" />
                            </button>
                        </div>

                        {/* Background Story Image */}
                        {activeStory.img ? (
                            <img src={activeStory.img} alt="Story" className="absolute inset-0 w-full h-full object-cover" />
                        ) : (
                            <div className="absolute inset-0 flex items-center justify-center p-6 text-center bg-gradient-to-tr from-blue-700 to-indigo-800">
                                <p className="text-base font-extrabold">{user.name} এর নতুন স্টোরি</p>
                            </div>
                        )}

                        {/* Bottom reaction */}
                        <div className="z-10 flex items-center gap-2">
                            <input 
                                type="text"
                                placeholder="একটি উত্তর পাঠান..."
                                className="flex-1 bg-black/40 border border-white/20 rounded-full px-4 py-2 text-xs text-white placeholder-white/60 focus:outline-none focus:ring-1 focus:ring-white"
                            />
                            <button 
                                type="button"
                                onClick={() => {
                                    showToast("স্টোরিতে প্রতিক্রিয়া পাঠানো হয়েছে");
                                    setActiveStory(null);
                                }}
                                className="p-2 rounded-full bg-blue-600 hover:bg-blue-700 text-white cursor-pointer">
                                <Send className="w-4 h-4" />
                            </button>
                        </div>
                    </div>
                </div>
            )}

            {/* Blue Badge Verification Modal */}
            {isVerifyModalOpen && (
                <div className="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4 overflow-y-auto">
                    <div className="bg-white rounded-3xl max-w-lg w-full p-5 shadow-2xl border border-slate-200 relative my-8 animate-in fade-in zoom-in-95 duration-150">
                        <button 
                            type="button"
                            onClick={() => setIsVerifyModalOpen(false)}
                            className="absolute top-4 right-4 w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center cursor-pointer">
                            <X className="w-4 h-4" />
                        </button>

                        <div className="flex items-center gap-2.5 mb-4">
                            <div className="w-10 h-10 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                <BadgeCheck className="w-6 h-6" />
                            </div>
                            <div>
                                <h3 className="text-base font-extrabold text-slate-900 leading-tight">সার্টিফাইড ব্লু ব্যাজ ভেরিফিকেশন পোর্টাল</h3>
                                <p className="text-[11px] text-slate-500">সার্বভৌম নাগরিক ভেরিফিকেশন ও লাইফসাইকেল</p>
                            </div>
                        </div>

                        {/* Interactive State Switcher for Demo */}
                        <div className="bg-slate-900 text-white rounded-2xl p-3.5 mb-4 shadow-xs">
                            <div className="flex items-center justify-between mb-2">
                                <div className="flex items-center gap-1.5 text-xs font-bold text-amber-400">
                                    <Sparkles className="w-3.5 h-3.5" />
                                    <span>লাইফসাইকেল সুইচার</span>
                                </div>
                                <span className="text-[10px] font-mono text-slate-400">Interactive Preview</span>
                            </div>
                            <div className="grid grid-cols-4 gap-1 text-[11px] font-bold">
                                <button type="button" onClick={() => setVerifyState("idle")} className={"py-1.5 rounded-lg border text-center transition-all " + (verifyState === "idle" ? "bg-blue-600 border-blue-500 text-white shadow-xs" : "bg-slate-800 border-slate-700 text-slate-300 hover:bg-slate-700")}>১. আবেদন</button>
                                <button type="button" onClick={() => setVerifyState("in_review")} className={"py-1.5 rounded-lg border text-center transition-all " + (verifyState === "in_review" ? "bg-amber-600 border-amber-500 text-white shadow-xs" : "bg-slate-800 border-slate-700 text-slate-300 hover:bg-slate-700")}>২. রিভিউ</button>
                                <button type="button" onClick={() => setVerifyState("approved")} className={"py-1.5 rounded-lg border text-center transition-all " + (verifyState === "approved" ? "bg-emerald-600 border-emerald-500 text-white shadow-xs" : "bg-slate-800 border-slate-700 text-slate-300 hover:bg-slate-700")}>৩. পেমেন্ট</button>
                                <button type="button" onClick={() => setVerifyState("active")} className={"py-1.5 rounded-lg border text-center transition-all " + (verifyState === "active" ? "bg-blue-600 border-blue-500 text-white shadow-xs" : "bg-slate-800 border-slate-700 text-slate-300 hover:bg-slate-700")}>৪. অ্যাক্টিভ</button>
                            </div>
                        </div>

                        {/* State 1: Form */}
                        {verifyState === "idle" && (
                            <form onSubmit={handleApplySubmit} className="space-y-3">
                                <div>
                                    <label className="block text-xs font-bold text-slate-700 mb-1">জাতীয় পরিচয়পত্র (NID) নম্বর *</label>
                                    <input type="text" required value={applyForm.nid} onChange={e => setApplyForm({...applyForm, nid: e.target.value})} className="w-full text-xs font-mono px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50" />
                                </div>
                                <div>
                                    <label className="block text-xs font-bold text-slate-700 mb-1">পুরো নাম (NID অনুযায়ী) *</label>
                                    <input type="text" required value={applyForm.fullName} onChange={e => setApplyForm({...applyForm, fullName: e.target.value})} className="w-full text-xs px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50" />
                                </div>
                                <div>
                                    <label className="block text-xs font-bold text-slate-700 mb-1">পেশা ক্যাটাগরি *</label>
                                    <select value={applyForm.category} onChange={e => setApplyForm({...applyForm, category: e.target.value})} className="w-full text-xs px-3 py-2 rounded-xl border border-slate-200 bg-slate-50/50 font-medium text-slate-700">
                                        <option value="professional">প্রফেশনাল (আইনজীবী, শিক্ষক, ইঞ্জিনিয়ার)</option>
                                        <option value="creator">কন্টেন্ট ক্রিয়েটর / ইনফ্লুয়েন্সার</option>
                                        <option value="business">উদ্যোক্তা / ব্যবসা প্রতিষ্ঠান</option>
                                        <option value="public_citizen">সাধারণ নাগরিক / সিটিজেন</option>
                                    </select>
                                </div>
                                <button type="submit" className="w-full py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-extrabold text-xs shadow-xs transition-all">আবেদন সাবমিট করুন</button>
                            </form>
                        )}

                        {/* State 2: Review */}
                        {verifyState === "in_review" && (
                            <div className="space-y-3">
                                <div className="p-3.5 bg-amber-50 rounded-2xl border border-amber-200 flex items-center gap-3">
                                    <Clock className="w-6 h-6 text-amber-600 animate-pulse shrink-0" />
                                    <div>
                                        <h4 className="text-xs font-bold text-amber-900">অভ্যন্তরীণ যাচাই প্রক্রিয়াধীন</h4>
                                        <p className="text-[11px] text-amber-700">আপনার তথ্য ম্যানুয়ালি রিভিউ হচ্ছে। সাধারণত ২-২৪ ঘণ্টার মধ্যে অনুমোদন সম্পন্ন হয়।</p>
                                    </div>
                                </div>
                                <button type="button" onClick={() => setVerifyState("approved")} className="w-full py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs">রিভিউ অনুমোদন করুন (সিমুলেশন)</button>
                            </div>
                        )}

                        {/* State 3: Payment */}
                        {verifyState === "approved" && (
                            <div className="space-y-3">
                                <div className="p-3 bg-emerald-50 rounded-2xl border border-emerald-200 flex items-center gap-2.5">
                                    <CheckCircle2 className="w-5 h-5 text-emerald-600 shrink-0" />
                                    <p className="text-xs font-bold text-emerald-900">আবেদন অনুমোদিত! ব্লু ব্যাজ সক্রিয় করতে প্ল্যান সিলেক্ট করুন।</p>
                                </div>
                                <div className="grid grid-cols-2 gap-2">
                                    <div onClick={() => setSelectedPlan("monthly")} className={"p-3 rounded-xl border-2 cursor-pointer " + (selectedPlan === "monthly" ? "border-blue-600 bg-blue-50/40" : "border-slate-200")}>
                                        <span className="text-xs font-bold block">মাসিক</span>
                                        <span className="text-base font-black text-blue-600">৳৫০ <span className="text-[10px] text-slate-500 font-normal">/মাস</span></span>
                                    </div>
                                    <div onClick={() => setSelectedPlan("yearly")} className={"p-3 rounded-xl border-2 cursor-pointer " + (selectedPlan === "yearly" ? "border-blue-600 bg-blue-50/40" : "border-slate-200")}>
                                        <span className="text-xs font-bold block">বার্ষিক (১৭% ছাড়)</span>
                                        <span className="text-base font-black text-blue-600">৳৫০০ <span className="text-[10px] text-slate-500 font-normal">/বছর</span></span>
                                    </div>
                                </div>
                                <button type="button" disabled={isPaying} onClick={handlePaySubmit} className="w-full py-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-black text-xs shadow-md shadow-blue-500/25 flex items-center justify-center gap-2">
                                    {isPaying ? <Loader2 className="w-4 h-4 animate-spin" /> : <Lock className="w-4 h-4" />}
                                    <span>পেমেন্ট করে ব্লু ব্যাজ সক্রিয় করুন ({selectedPlan === "yearly" ? "৳৫০০" : "৳৫০"})</span>
                                </button>
                            </div>
                        )}

                        {/* State 4: Active */}
                        {verifyState === "active" && (
                            <div className="space-y-3">
                                <div className="p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl border border-blue-200 flex items-center gap-3">
                                    <div className="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center shrink-0">
                                        <BadgeCheck className="w-6 h-6" />
                                    </div>
                                    <div>
                                        <h4 className="text-xs font-bold text-slate-900">আপনার ব্লু ব্যাজ সফলভাবে সক্রিয়!</h4>
                                        <p className="text-[11px] text-slate-600">ফিডে ও কমেন্টে আপনার নামের পাশে ব্লু টিক প্রদর্শিত হচ্ছে।</p>
                                    </div>
                                </div>
                                <button type="button" onClick={() => setIsVerifyModalOpen(false)} className="w-full py-2.5 rounded-xl bg-slate-900 text-white font-bold text-xs">ফিডে ফিরে যান</button>
                            </div>
                        )}
                    </div>
                </div>
            )}

            {/* Toast Notification */}
            {toast && (
                <div className="fixed bottom-16 sm:bottom-6 left-1/2 -translate-x-1/2 z-50 bg-slate-900/95 backdrop-blur-md text-white text-xs font-bold px-4 py-2.5 rounded-full shadow-xl flex items-center gap-2 border border-slate-700">
                    <CheckCircle2 className="w-4 h-4 text-emerald-400" />
                    <span>{toast}</span>
                </div>
            )}

            {/* Bottom Mobile Tab Bar (2 Core Tabs) */}
            <nav className="sm:hidden fixed bottom-0 left-0 right-0 bg-white/95 backdrop-blur-md border-t border-slate-200/90 py-1.5 px-6 flex justify-around items-center z-40">
                <button 
                    type="button"
                    onClick={() => setActiveTab("world")}
                    className={"flex flex-col items-center gap-0.5 py-1 px-4 rounded-xl transition-colors " + (
                        activeTab === "world" ? "text-blue-600 font-extrabold" : "text-slate-400 font-medium"
                    )}>
                    <Globe className="w-5 h-5" />
                    <span className="text-[10px]">বিশ্ব ফিড</span>
                </button>
                <button 
                    type="button"
                    onClick={() => setActiveTab("friends")}
                    className={"flex flex-col items-center gap-0.5 py-1 px-4 rounded-xl transition-colors relative " + (
                        activeTab === "friends" ? "text-blue-600 font-extrabold" : "text-slate-400 font-medium"
                    )}>
                    <Users className="w-5 h-5" />
                    <span className="text-[10px]">বন্ধুরা</span>
                    {friendRequests.length > 0 && (
                        <span className="absolute top-0.5 right-3 w-2 h-2 rounded-full bg-rose-500"></span>
                    )}
                </button>
            </nav>

            {/* Desktop / Global Footer */}
            <footer className="mt-8 mb-16 sm:mb-4 text-center text-xs text-slate-400 py-4 border-t border-slate-200/60 max-w-2xl mx-auto w-full">
                <p>© ২০২৬ Zengfy Social • সার্বভৌম সিটিজেন নেটওয়ার্ক • সকল তথ্য সুরক্ষিত</p>
            </footer>
        </div>
    );
}
