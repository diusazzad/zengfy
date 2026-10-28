# 📋 TASK-FE-006: Hybrid Modular Architecture — React 19 SPA for Social, Chat & Account Hub

**Task ID:** `TASK-FE-006`  
**Assigned To:** 🎨 Agent 2 (Frontend Engineer & UI Specialist)  
**Co-Assigned & Architecture Lead:** 🛡️ Agent 1 (Lead Systems Architect)  
**Status:** 🟢 **CORE ARCHITECTURE & INFRA READY / AGENT 2 EXPANDING UI**  
**Priority:** Highest (Sovereign Platform V1.0)  
**Build Status:** ✅ `npm run build` Passing (0 Errors, 2028 modules bundled)  


---

## 🎯 আর্কিটেকচারাল ডিসিশন (ADR: Option C — Hybrid Modular)

Zengfy ইকোসিস্টেমের জন্য টেক লিড **সাজ্জাদ ভাই** আনুষ্ঠানিকভাবে **Option C: হাইব্রিড মডার্ন আর্কিটেকচার** অনুমোদন করেছেন:

```
┌────────────────────────────────────────────────────────────────────────┐
│                   ZENGFY HYBRID MODULAR ARCHITECTURE                    │
├──────────────────────────────────┬─────────────────────────────────────┤
│ 1. Public & Marketing (SEO First) │ 2. Interactive Apps (App First)     │
│    • Landing (zengfy.top)        │    • Social Feed (social.zengfy.top)│
│    • Products, Pricing, FAQ      │    • Real-Time Chat & Alerts        │
│    • Auth Portal (login, register│    • Sovereign Account Hub (/account)│
├──────────────────────────────────┼─────────────────────────────────────┤
│ 🛠️ Stack: Blade + Tailwind + Alpine│ 🛠️ Stack: React 19 + Vite + Shadcn  │
│    • 100% SEO, Sub-second LCP   │    • TanStack Query (Optimistic UI) │
│    • Zero JS Hydration Mismatch │    • Zustand (Global State)         │
│    • Instant SSO Cookie Exchange│    • Laravel Echo + Reverb (WS)     │
└──────────────────────────────────┴─────────────────────────────────────┘
```

---

## 👥 এজেন্টদের কাজের দায়িত্ব বণ্টন (Division of Responsibility)

### 👑 Agent 1 (Lead Systems Architect - Antigravity IDE):
1. **টুলিং ও এনভায়রনমেন্ট সেটআপ:**
   - রুট `package.json` এবং `vite.config.js`-এ React 19 ও `@vitejs/plugin-react` প্লাগইন কনফিগার করা।
   - `resources/js/react/` ডিরেক্টরি কাঠামো এবং রুট প্রোভাইডার্স (QueryClientProvider, AuthProvider) তৈরি করা।
2. **এপিআই ও রিয়েল-টাইম ব্রডকাস্টিং চ্যানেল:**
   - Laravel Reverb WebSockets ক্লায়েন্ট কনফিগারেশন (`echo.js`) প্রস্তুত রাখা।
   - সমস্ত প্রয়োজনীয় REST এপিআই কন্ট্রাক্ট টেস্ট ও ভ্যালিডেশন নিশ্চিত করা।
3. **ব্লেড মাউন্ট ভিউ ইন্টিগ্রেশন:**
   - `resources/views/social/feed.blade.php` এবং `resources/views/account/dashboard.blade.php`-এ React Root মাউন্ট পয়েন্ট ও সিএসআরএফ কনটেক্সট পাস করা।

---

### 🎨 Agent 2 (Frontend Engineer & UI Specialist - Zed Editor):
1. **সোশ্যাল ফিড কম্পোনেন্ট (`resources/js/react/components/social/`):**
   - **`FeedStream.jsx`**: TanStack Query (`useInfiniteQuery`) দিয়ে পেজিনেটেড ফিড।
   - **`PostCard.jsx`**: অপটিমিস্টিক লাইক কাউন্টার (`POST /api/v1/posts/{id}/like`), কমেন্ট এক্সপ্যান্ডার, মিডিয়া গ্যালারি ও ভেরিফায়েড সিটিজেন ব্লু ব্যাজ।
   - **`CreatePostModal.jsx`**: পোস্ট তৈরির কার্ড (টেক্সট, ফটো ড্রপজোন ও ওয়ার্ড ট্যাগ)।
2. **রিয়েল-টাইম চ্যাট কম্পোনেন্ট (`resources/js/react/components/chat/`):**
   - **`ChatDrawer.jsx`** অথবা **`ChatModal.jsx`**: ফ্লোটিং / সাইডবার মেসেজিং উইন্ডো।
   - **`ConversationList.jsx`**: অ্যাক্টিভ চ্যাট লিস্ট ও আনরেড কাউন্টার।
   - **`MessageThread.jsx`**: মেসেজ বাবলস, সেন্ড ইনপুট, টাইপিং ইন্ডিকেটর এবং `window.Echo` দিয়ে লাইভ মেসেজ লিসেনার।
3. **অ্যাকাউন্ট ড্যাশবোর্ড কম্পোনেন্ট (`resources/js/react/components/account/`):**
   - **`AccountHub.jsx`**: ৪-ট্যাব ইন্টারফেস (Profile, NID Status, Device Security, App Launcher)।
   - **`ActiveDevices.jsx`**: ১-ক্লিকে পেজ রিফ্রেশ ছাড়া ডিভাইস রিভোক অ্যাকশন।
4. **Shadcn UI ও ডার্ক নান্দনিকতা:**
   - কালার: `#0B0F17` (ব্যাকগ্রাউন্ড), `#121A29` (কার্ড সারফেস), `#2563EB` (অ্যাকসেন্ট)।
   - স্মুথ ট্রানজিশন, লোডিং স্কেলিটন (Skeleton loaders) এবং নো-ফ্লিকার UI।

---

## 🔍 সফলতার মাপকাঠি ও ব্রাউজার ভেরিফিকেশন রিপোর্ট (Browser Verification Report)

সাব-এজেন্ট দ্বারা লাইভ এনভায়রনমেন্টে (`http://zengfy.top:7000/`) সম্পূর্ণ ভেরিফিকেশন সফল হয়েছে:

| সেকশন | ইউআরএল | স্ট্যাটাস | স্ক্রিনশট / আর্টফ্যাক্ট | ফলাফল |
| :--- | :--- | :---: | :--- | :--- |
| **Landing Page** | `http://zengfy.top:7000/` | ✅ PASS | `landing_page_1791336596838.png` | বেন্টো গ্রিড, নেভবার ও এসইও লেআউট নিখুঁতভাবে রেন্ডার হয়েছে। |
| **Auth Flow** | `http://zengfy.top:7000/login` | ✅ PASS | Live Session | সফলভাবে লগইন সম্পন্ন এবং `localStorage` এ টোকেন সংরক্ষিত। |
| **Account Hub** | `http://zengfy.top:7000/account` | ✅ PASS | `account_overview_1791337317678.png`<br>`account_security_tabs_179133769040.png` | `#react-account-root` মাউন্ট সফল; ৪টি ট্যাব, ডিভাইস সেশন ও এনআইডি স্ট্যাটাস লাইভ। |
| **Social Landing Page** | `http://social.zengfy.top:7000/about` | ✅ PASS | `social_hero_showcase_1791338498117.png`<br>`social_bento_grid_1791338503632.png`<br>`auth_modal_filled_1791338892257.png` | ডেডিকেটেড সোশ্যাল ল্যান্ডিং পেজ, লাইভ শোকেস ও এপিআই অথেনটিকেশন মোডাল ভেরিফাইড। |
| **Social Feed & Chat** | `http://social.zengfy.top:7000/` | ✅ PASS | `social_feed_chat_1791337434073.png`<br>`social_feed_page_1791339312851.png` | `#react-feed-root` এবং ফ্লোটিং `#react-chat-root` লাইভ চ্যাট ড্রয়ার সফলভাবে ওপেন হয়েছে। |

---

## 🎨 Agent 2 (Zed Editor) — পরবর্তী অ্যাকশন আইটেমস (Action Items for UI Specialist):

Agent 1 আর্কিটেকচার ও মাউন্ট ব্রিজ সম্পন্ন করেছে। এখন Agent 2 এর কাজ হলো নিম্নোক্ত UI ফিচারগুলোর নিখুঁত ফিনিশিং ও পলিশ করা:

1. **সোশ্যাল ফিড UI পলিশ (`resources/js/react/components/social/`):**
   - **`PostCard.jsx`**: অপটিমিস্টিক লাইক টগল রিঅ্যাকশন (`POST /api/v1/posts/${id}/like`), কমেন্ট এক্সপ্যান্ডার এবং ইমেজ লাইটবক্স প্রিভিউ মোডাল।
   - **`CreatePostModal.jsx`**: ওয়ার্ড ট্যাগ ড্রপডাউন (`WARD-DHAKA-19` ইত্যাদি), ফটো প্রিভিউ এবং সাবমিট অ্যানিমেশন।
   - **`FeedStream.jsx`**: ইনফিনিট স্ক্রোল লোডার এবং স্কেলিটন লোডার (Skeleton loaders)।

2. **লাইভ চ্যাট ড্রয়ার পলিশ (`resources/js/react/components/chat/`):**
   - **`ChatDrawer.jsx`**: ফ্লোটিং বটম-রাইট ড্রয়ারের স্মুথ স্লাইড অ্যানিমেশন এবং আনরেড ব্যাজ কাউন্টার।
   - **`MessageThread.jsx`**: মেসেজ বাবলস (সেন্ডার ও রিসিভার গ্রেডিয়েন্ট), এন্টার প্রেস করলে মেসেজ পাঠানো এবং নতুন মেসেজে অটো-স্ক্রোল-টু-বটম।
   - **`ConversationList.jsx`**: অ্যাক্টিভ কন্টাক্টস ও সিটিজেন ডিরেক্টরি সার্চ।

3. **অ্যাকাউন্ট হাব ইন্টারেক্টিভিটি (`resources/js/react/components/account/`):**
   - **`AccountHub.jsx`**: কুইক প্রোফাইল ফটো আপলোড প্রিভিউ (`/account/avatar`), পাসওয়ার্ড ম্যাচিং ভ্যালিডেশন টোস্ট এবং ১-ক্লিকে ডিভাইস সেশন রিভোক।

4. **স্টাইলিং ও থিম রুলস:**
   - ডার্ক থিম প্যালেট: `#0B0F17` (পৃষ্ঠা ব্যাকগ্রাউন্ড), `#121A29` (কার্ড সারফেস), `#1E293B` (বর্ডার), `#2563EB` (প্রাইমারি অ্যাকসেন্ট), `#06B6D4` (সায়ান গ্লো)।
   - বিল্ড চেক: এডিটের পর `npm run build` দিয়ে ০ এরর নিশ্চিত করা।
