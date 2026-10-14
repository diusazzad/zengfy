# 📋 TASK-FE-004: Frontend Audit & Inspect Fixes for Auth, Recovery & Workspace Hub

**Task ID:** `TASK-FE-004`  
**Assigned To:** 🎨 Agent 2 (Frontend Engineer & UI Specialist)  
**Assigned By:** 🛡️ Agent 1 (Lead Systems Architect)  
**Status:** 🟢 **IN PROGRESS**  
**Priority:** Highest (Blocking User Release)  

---

## 🎯 লক্ষ্য (Objective)
Zengfy প্ল্যাটফর্মের ইউজার জার্নিকে সম্পূর্ণ ক্র্যাশ-ফ্রি এবং উচ্চ নান্দনিক (Ultra-Premium Sovereign Aesthetic) রাখা। ব্যবহারকারী যখন ব্রাউজারে `http://zengfy.top:7000/` ভিজিট করবেন, তখন যাতে কোনো প্রকার জাভাস্ক্রিপ্ট/Vite কনসোল এরর না থাকে এবং ল্যান্ডিং -> লগইন -> রেজিস্ট্রেশন -> ফরগট পাসওয়ার্ড -> গুগল ওয়ার্কস্পেস ড্যাশবোর্ড পর্যন্ত প্রতিটি ট্রানজিশন স্মুথ ও বাগ-মুক্ত থাকে।

---

## 📦 অ্যাকশন আইটেমস ও ফাইল রেসপনসিবিলিটি

### ১. ল্যান্ডিং পেজ ও অ্যান্ড্রয়েড এপিকে শোকেস
- **ফাইলসমূহ:**
  - `resources/views/welcome.blade.php`
  - `resources/views/components/landing/mobile-app-section.blade.php`
  - `resources/views/components/landing/navbar.blade.php`
  - `resources/views/download.blade.php`
- **দায়িত্ব:**
  - মোবাইল ফোন মকআপ রেসপনসিভ রাখা (মোবাইল ও ডেস্কটপ ভিউতে ওভারফ্লো না হওয়া)।
  - সার্চ বার ফিচারটি আপাতত স্থগিত রাখা হয়েছে, কোনো ভাঙা সার্চ ইনপুট যেন দৃশ্যমান না থাকে।

### ২. লগইন ও রেজিস্ট্রেশন ইউআই
- **ফাইলসমূহ:**
  - `resources/views/auth/login.blade.php`
  - `resources/views/auth/register.blade.php`
- **দায়িত্ব:**
  - লগইন সফল হওয়ার পর স্মুথ রিডাইরেক্ট করে `/account` এ নেওয়া।
  - পাসওয়ার্ড শো/হাইড আইকন এবং ফর্ম ইনপুট ফোকাস স্টেট নিখুঁত রাখা।
  - কোনো আনহ্যান্ডল্ড এরর প্রমিজ বা কনসোল ওয়ার্নিং যেন না থাকে।

### ৩. পাসওয়ার্ড রিকভারি (Forgot Password)
- **ফাইল:**
  - `resources/views/auth/forgot-password.blade.php`
- **দায়িত্ব:**
  - ধাপ ১ (ইমেইল দিয়ে ৬-ডিজিট ওটিপি চাওয়া) এবং ধাপ ২ (ওটিপি ও নতুন পাসওয়ার্ড সেট করা) এর মাঝের ট্রানজিশন স্মুথ রাখা।
  - পাসওয়ার্ড স্ট্রেন্থ বারের কালার ডায়নামিক্যালি আপডেট হওয়া।

### ৪. Google Workspace-স্টাইল Sovereign Account Hub
- **ফাইল:**
  - `resources/views/account/dashboard.blade.php`
- **দায়িত্ব:**
  - টপ ন্যাভের ৯-ডট গুগল স্টাইল লঞ্চার ড্রপডাউন ঠিকমতো ওপেন ও ক্লোজ হওয়া (`@click.away`)।
  - অ্যাক্টিভ ডিভাইস সেশন কার্ড ও ১-ক্লিক "Sign Out Other Devices" অ্যাকশন দৃশ্যমান থাকা।
  - প্রোফাইল এডিটের ড্রয়ার ফর্ম ক্লিয়ার থাকা।

### ৫. ব্রাউজার কনসোল ও ইন্সপেক্ট ক্লিনিং
- **ফাইলসমূহ:**
  - `resources/js/echo.js`
  - `resources/js/bootstrap.js`
  - `resources/js/app.js`
- **দায়িত্ব:**
  - কোনো প্রকার `404 (Not Found)`, `Uncaught SyntaxError`, বা `Vite import-analysis` এরর যেন কনসোলে না থাকে।
