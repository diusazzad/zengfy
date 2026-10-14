# 📋 TASK-FE-005: Auth Gateway & Sovereign Account Dashboard Modernization

**Task ID:** `TASK-FE-005`  
**Assigned To:** 🎨 Agent 2 (Frontend Engineer & UI Specialist)  
**Assigned By:** 🛡️ Agent 1 (Lead Systems Architect)  
**Status:** 🟡 **ASSIGNED / IN PROGRESS**  
**Priority:** Highest (Core Release Requirement)  

---

## 🎯 লক্ষ্য ও উদ্দেশ্য (Objectives)

Zengfy ইকোসিস্টেমের অথেন্টিকেশন ও ইউজার প্রোফাইল এখন সম্পূর্ণ **মডিউলার ও API-ফার্স্ট আর্কিটেকচারে** রূপান্তরিত হয়েছে:
- সমস্ত Auth রুট এবং কন্ট্রোলার এখন `Modules/Auth`-এর অধীনে কেন্দ্রীভূত।
- `/api/v1/auth/login`, `/api/v1/auth/register`, `/api/v1/auth/check`, এবং `/api/v1/auth/password/*` এপিআই সক্রিয়।
- মাল্টি-সাবডোমেন SSO সেশন কুকি (`.zengfy.test` / `.zengfy.top`) সক্রিয়।

**Agent 2-এর দায়িত্ব হলো আইটেম ২ (Auth Gateway: Login/Register/Recovery) এবং আইটেম ৩ (Sovereign Account Dashboard) এর ফ্রন্টএন্ড UI-কে বিশ্বমানের এন্টারপ্রাইজ মানে রূপ দেওয়া।**

---

## 📦 কর্মপরিধি ও ফাইলসমূহ (Scope of Work & Files)

### পার্ট ২: Auth Gateway Modernization
- **টার্গেট ফাইলসমূহ:**
  - `Modules/Auth/resources/views/layouts/auth.blade.php`
  - `Modules/Auth/resources/views/login.blade.php`
  - `Modules/Auth/resources/views/register.blade.php`
  - `Modules/Auth/resources/views/forgot-password.blade.php`
- **করণীয়:**
  1. **১০০% এপিআই-ড্রাইভেন ফর্ম সাবমিশন:**
     - Alpine.js দিয়ে `POST /api/v1/auth/login` ও `POST /api/v1/auth/register` কল করা।
     - রেসপন্স থেকে টোকেন (`data.data?.token || data.token`) লোকাল স্টোরেজে সংরক্ষণ এবং `credentials: 'same-origin'` নিশ্চিত করা।
  2. **স্মার্ট রিডাইরেক্ট সাপোর্ট:**
     - `redirect_uri` বা `redirect_to` কুয়েরি প্যারামিটার সাপোর্ট করা (যেমন: `/login?redirect_uri=http://social.zengfy.top:7000/feed`)।
     - সফল লগইনে কাঙ্ক্ষিত সাবডোমেনে অথবা ডিফল্ট `/account` এ স্মুথ রিডাইরেক্ট।
  3. **ইউআই ও মাইক্রো-ইন্টারঅ্যাকশন:**
     - পাসওয়ার্ড শো/হাইড বাটন, লাইভ পাসওয়ার্ড স্ট্রেন্থ মিটার (Weak, Fair, Good, Sovereign 256-Bit)।
     - এনআইডি ভেরিফিকেশন প্রিভিউ ব্যাজ (রেজিস্ট্রেশন ফর্মে)।
     - ব্রুট-ফোর্স লকআউট (`423`) ও রেট লিমিট (`429`) এর জন্য চমৎকার ভিজ্যুয়াল এরর ব্যানার।

---

### পার্ট ৩: Sovereign Account Dashboard Modernization
- **টার্গেট ফাইলসমূহ:**
  - `resources/views/account/dashboard.blade.php`
  - `resources/views/layouts/social.blade.php` (ন্যাভ ও লঞ্চার সামঞ্জস্য)
- **করণীয়:**
  1. **৪-ট্যাব বিশিষ্ট সোভারেন হাব ইন্টারফেস:**
     - **Tab 1: Profile & Citizen Identity:** অবতার লাইভ প্রিভিউ সহ ড্রপজোন আপলোড (`POST /account/avatar`), ইউনিক হ্যান্ডল (`@sazzad`), বায়ো এবং ওয়ার্ড কোড এডিট।
     - **Tab 2: NID & Sovereign Verification:** নাগরিক ভেরিফিকেশন স্ট্যাটাস কার্ড, ভেরিফায়েড হলে ব্লু শিল্ড ব্যাজ এবং এনক্রিপ্টেড ভল্ট ইন্ডিকেটর।
     - **Tab 3: Security & Active Devices:** актив ডিভাইস তালিকা (`AuthDevice`), ব্রাউজার ও ওএস ডিটেকশন আইকন, এবং পেজ রিলোড ছাড়াই ১-ক্লিকে নির্দিষ্ট ডিভাইস অথবা "Revoke All Other Devices" অ্যাকশন।
     - **Tab 4: Password & Access Keys:** পাসওয়ার্ড পরিবর্তনের সিকিউর ফর্ম এবং পার্সোনাল এপিআই অ্যাক্সেস টোকেন ভিউয়ার।
  2. **৯-ডট গুগল স্টাইল অ্যাপ লঞ্চার:**
     - ড্রপডাউনে Zengfy Social, School, Law, POS, Cloud Apps-এর সক্রিয় লিঙ্ক।
     - সাবডোমেন SSO লিঙ্ক ফরম্যাট: `http://social.zengfy.top:7000/`, `http://school.zengfy.top:7000/` ইত্যাদি।
  3. **ব্রাউজার bfcache প্রতিরোধ ও লগআউট বাটন:**
     - লগআউট বাটনে ক্লিক করলে `/logout` রুটে স্মুথ পোস্ট/গেট কল এবং ক্লিন রিডাইরেক্ট।

---

## 🎨 ডিজাইন স্পেসিফিকেশন (Aesthetic Tokens)
- **ব্যাকগ্রাউন্ড:** `#0B0F17` (ডিপ স্পেস ব্ল্যাক)
- **সারফেস ও কার্ড:** `#121A29` (লাক্সারি ডার্ক নেভি) বর্ডার `rgba(255, 255, 255, 0.08)` সহ
- **অ্যাকসেন্ট কালার:** ভাইব্রেন্ট ব্লু (`#2563EB`), ইন্ডিগো (`#4F46E5`), সায়ান (`#06B6D4`), অ্যাম্বার (`#F59E0B`)
- **টাইপোগ্রাফি:** `Plus Jakarta Sans` ও কোড/আইডির জন্য `JetBrains Mono`
- **রিঅ্যাক্টিভিটি:** `Alpine.js` (নো ফুল পেজ রিলোড ফ্লিকার, মসৃণ ট্রানজিশন)

---

## ✅ অ্যাকসেপ্ট্যান্স ক্রাইটেরিয়া (Verification Checklist)
1. `http://zengfy.test:7000/login` এবং `/register` এ কোনো কনসোল এরর নেই।
2. `POST /api/v1/auth/login` সফল হলে টোকেন সেভ হয় এবং ইউজার সরাসরি `/account` এ প্রবেশ করে।
3. `/account` পেজের সব ট্যাব (Profile, Security, Devices, Password) কোনো পেজ রিফ্রেশ ছাড়াই সক্রিয়ভাবে কাজ করে।
4. ডিভাইস ডিলিট (`revoke`) করলে তা ডায়নামিক্যালি তালিকা থেকে অপসারিত হয়।
5. সমস্ত টাচ টার্গেট অন্তত ৪৪px থেকে ৪৮px (মোবাইল ও অ্যাক্সেসিবিলিটি ফ্রেন্ডলি)।
