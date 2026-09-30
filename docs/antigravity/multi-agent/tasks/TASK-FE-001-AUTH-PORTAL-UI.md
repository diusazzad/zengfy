# 🎨 Task Specification: TASK-FE-001 - Unified Sovereign Auth Portal UI

**Assigned To:** `🎨 Agent 2 (Frontend UI Engineer - Zed Editor)`  
**Issued By:** `👑 Agent 1 (Lead Systems Architect - Antigravity IDE)`  
**Status:** 🟡 **Ready for Review (Delivered by Agent 2)**  
**Priority:** `P0 - Critical Path`  
**Governing Standard:** `CONST-001 (Design Aesthetics & Universal UUIDs)`  

---

## 📖 ১. কাজের প্রেক্ষাপট (Context & Objective)

আমাদের ব্যাকএন্ডে Phase 2-এ **Central Identity & SSO Engine** সম্পূর্ণ তৈরি করা হয়েছে। আমাদের কাছে অত্যন্ত শক্তিশালী API রেডি আছে:
- `POST /api/v1/auth/login` (Rate limited, brute force protected, multi-device tracking)
- `POST /api/v1/auth/register` (Idempotent, transaction-safe, device fingerprinting)
- `POST /api/v1/auth/nid/verify` (AES-256 encrypted, HMAC blind index, sandbox gateway)
- `GET /api/v1/auth/me` (Active sessions, profile & devices)

কিন্তু বর্তমানে ভিজিটররা যখন ল্যান্ডিং পেজে **"Sign In"** অথবা **"Sign Up Free"** বাটনে ক্লিক করে, তখন তাদের জন্য কোনো আল্ট্রা-প্রিমিয়াম ইউজার ইন্টারফেস (UI) নেই।

**তোমার দায়িত্ব:**  
Zengfy-এর ব্র্যান্ড গাইডলাইন (`#0B0F17` ডার্ক মোড, Glassmorphism, ভাইব্র্যান্ট ব্লু-ইন্ডিগো গ্রেডিয়েন্ট এবং Alpine.js রিয়্যাক্টিভিটি) মেনে আধুনিক ও প্রিমিয়াম **লগইন ও রেজিস্ট্রেশন ভিউ** তৈরি করা।

---

## 🛠️ ২. টেকনিক্যাল রিকোয়ারমেন্টস (Frontend Requirements)

### ক. নতুন ফাইলসমূহ:
1. **`resources/views/layouts/auth.blade.php`**
   - মিনিমালিস্টিক ডার্ক ব্যাকগ্রাউন্ড, সেন্ট্রাল ব্র্যান্ড লোগো (`Zengfy.`), গ্লোয়িং লাইট ইফেক্ট এবং প্রিমিয়াম টাইপোগ্রাফি (`Plus Jakarta Sans`) সহ অথেনটিকেশন লেআউট।
2. **`resources/views/auth/login.blade.php`**
   - লগইন কার্ড: ইমেইল ও পাসওয়ার্ড ইনপুট।
   - Alpine.js ফিচারস:
     - শো/হাইড পাসওয়ার্ড টগল (Eye icon)।
     - সাবমিট করার সময় লোডিং স্পিনার ও বাটন ডিজেবল স্টেট।
     - এরর হ্যান্ডলিং ও অ্যালার্ট ডিসপ্লে।
   - "Don't have an account? Sign Up Free" লিংক।
   - সিকিউরিটি ব্যাজ: *"Protected by 256-Bit Cloud Encryption & Anti-Bot Shield"*.
3. **`resources/views/auth/register.blade.php`**
   - রেজিস্ট্রেশন কার্ড: ফুল নেম, ইমেইল, পাসওয়ার্ড ও পাসওয়ার্ড কনফার্মেশন।
   - পাসওয়ার্ড স্ট্রেংথ ইন্ডিকেটর (স্মুথ কালার বার)।
   - অপশনাল Smart NID ইনপুট বক্স (১০ বা ১৭ ডিজিটের প্লেসহোল্ডার) সহ ইনস্ট্যান্ট ভ্যালিডেশন প্রিভিউ।
   - "Already have an account? Sign In" লিংক।

### খ. কন্ট্রোলার ও রাউট বাইন্ডিং:
- [`app/Http/Controllers/PageController.php`](file:///p:/Zengfy-Ecosystem/core/app/Http/Controllers/PageController.php)-এ দুটি নতুন মেথড যোগ করবে:
  ```php
  public function showLogin() { return view('auth.login'); }
  public function showRegister() { return view('auth.register'); }
  ```
- [`routes/web.php`](file:///p:/Zengfy-Ecosystem/core/routes/web.php)-এ পাবলিক রাউট বাইন্ড করবে:
  ```php
  Route::get('/login', 'showLogin')->name('login');
  Route::get('/register', 'showRegister')->name('register');
  ```

---

## 🎨 ৩. ডিজাইন ও স্টাইলিং নির্দেশিকা (Design Tokens)

- **ব্যাকগ্রাউন্ড:** `#0B0F17` (Deep sovereign dark).
- **কার্ড ব্যাকগ্রাউন্ড:** `#121A29]/80` অথবা `bg-white/[0.03]` উইথ `backdrop-blur-2xl border border-white/10`.
- **অ্যাকসেন্ট গ্রেডিয়েন্ট:** `from-blue-600 via-indigo-600 to-cyan-400`.
- **ইনপুট ফিল্ডস:** `bg-[#0B0F17]/60 border border-white/10 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-white rounded-xl`.
- **বাটন:** `rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold py-3.5 shadow-xl shadow-blue-600/30 transition-all transform active:scale-95`.
- **মোবাইল অপটিমাইজেশন:** ছোট স্ক্রিনে (৩২০ পিক্সেল থেকে) কোনো প্রকার হরাইজন্টাল স্ক্রলবার আসা চলবে না।

---

## ✅ ৪. অ্যাকসেপ্টেন্স ক্রাইটেরিয়া (Acceptance Criteria)

1. `http://zengfy.test:7000/login` ওপেন করলে স্টাইলিশ ও ফাংশনাল লগইন পেজ দেখা যাবে।
2. `http://zengfy.test:7000/register` ওপেন করলে একইভাবে রেসপনসিভ রেজিস্ট্রেশন পেজ দেখা যাবে।
3. পাসওয়ার্ড শো/হাইড আইকন ক্লিক করলে পাসওয়ার্ড টেক্সট ও পাসওয়ার্ড টাইপের মধ্যে স্মুথলি টগল হবে।
4. `php artisan test` কমান্ড রান করলে যাতে কোনো বিদ্যমান টেস্ট ফেল না করে (৬৯/৬৯ টেস্ট গ্রিন থাকতে হবে)।
5. কাজ সম্পন্ন করে [`docs/antigravity/multi-agent/chat/THREAD-001-AUTH-AND-SOCIAL-UI.md`](file:///p:/Zengfy-Ecosystem/core/docs/antigravity/multi-agent/chat/THREAD-001-AUTH-AND-SOCIAL-UI.md) ফাইলে তোমার রিপোর্ট লিখবে।
