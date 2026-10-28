Created SsoController.php
Viewed api.php:15-39
Edited api.php
Viewed openapi.yaml:60-100
Viewed openapi.yaml:130-180
Edited openapi.yaml
Created SsoTicketExchangeTest.php
Ran command: `php artisan test --filter SsoTicketExchangeTest`
Ran command: `php artisan test Modules/Auth/tests/Feature`
Viewed master_engineering_task_checklist.md:135-165
Edited master_engineering_task_checklist.md
Created walkthrough.md

আমরা **TASK-008: Cross-Subdomain SSO Ticket Exchange Gateway** সফলভাবে বাস্তবায়ন ও টেস্ট করেছি! 

আমাদের সম্পূর্ণ Auth ফিচার টেস্ট স্যুট এখন **17/17 Passed (117 assertions in 2.29s)** — সম্পূর্ণ গ্রিন!

সব প্রগ্রেস ট্র্যাক করা হয়েছে [`master_engineering_task_checklist.md`](file:///p:/Zengfy-Ecosystem/core/docs/task/master_engineering_task_checklist.md)-এ এবং বিস্তারিত টেস্ট লগ রয়েছে [`walkthrough.md`](file:///c:/Users/sazza/.gemini/antigravity-ide/brain/a046b19d-5aef-4045-8c0e-de889ec9b682/walkthrough.md)-এ।

---

## 🧪 টেস্ট ভেরিফিকেশন ফলাফল (100% Green)

আমরা টার্মিনালে সমস্ত Auth মডিউল ফিচার টেস্ট রান করেছি:

```bash
php artisan test Modules/Auth/tests/Feature
```

```text
   PASS  Modules\Auth\Tests\Feature\LoginTest
  ✓ user can login with valid credentials and receives token and device session
  ✓ login fails with invalid password or unregistered email
  ✓ authenticated user can fetch profile and active devices via me endpoint
  ✓ user can logout current device
  ✓ user can logout from all devices
  ✓ rate limiter blocks excessive login attempts

   PASS  Modules\Auth\Tests\Feature\RegistrationTest
  ✓ a user can register successfully and receives uuid and token
  ✓ registration fails if email is already taken
  ✓ idempotency key prevents duplicate user creation
  ✓ rate limiter blocks excessive registration attempts

   PASS  Modules\Auth\Tests\Feature\SsoTicketExchangeTest
  ✓ authenticated user can generate sso ticket for valid subdomain
  ✓ unauthenticated user cannot generate sso ticket
  ✓ generating ticket fails for unwhitelisted subdomain
  ✓ target subdomain can exchange valid ticket for scoped session token
  ✓ replay defense prevents exchanging the same ticket twice
  ✓ expired ticket is rejected
  ✓ subdomain spoofing prevented when exchanging ticket on mismatched domain

  Tests:    17 passed (117 assertions)
  Duration: 2.29s
```

---

## 🧠 Case Study & Engineering Rationale (মেন্টরশিপ লেকচার: SSO আর্কিটেকচার কেন এভাবে তৈরি হলো)

কেন Google, Okta বা Zengfy-তে সাবডোমেইন SSO এমন জটিল ও সুরক্ষিত আর্কিটেকচারে তৈরি করা হয়? চলো গভীরভাবে জেনে নিই:

### 1. The Browser Cookie Trap (Safari ITP & Chrome Privacy Sandbox)
- **ভুল পদ্ধতি:** অনেকেই মনে করে `domain=.zengfy.top` দিয়ে একটি কুকি সেট করলেই তো সব সাবডোমেইন (`school.zengfy.top`, `pos.zengfy.top`) সেটা পড়ে নিতে পারবে।
- **বাস্তব সমস্যা:**
  1. আধুনিক ব্রাউজারগুলো (বিশেষ করে Apple Safari-এর ITP — *Intelligent Tracking Prevention*) ক্রস-সাবডোমেইন কুকি ট্র্যাকিং অত্যন্ত কড়াকড়িভাবে ব্লক করে।
  2. আধুনিক Single Page Application (React/Next.js/Vue) এবং মোবাইল অ্যাপ (Flutter/React Native) কুকির বদলে টোকেন (Sanctum Bearer) ইন-মেমোরি বা লোকাল স্টোরেজে রাখে। ব্রাউজারের সিকিউরিটি নিয়ম অনুযায়ী `zengfy.top`-এর লোকাল স্টোরেজ কখনোই `school.zengfy.top` পড়তে পারে না!

---

### 2. URL Token Leakage Vulnerability (কেন URL-এ টোকেন পাঠানো নিষিদ্ধ)
- **ভুল পদ্ধতি:** অনেকে সরাসরি রিডাইরেক্ট করে দেয়: `https://school.zengfy.top?token=abc123longlivedtoken`।
- **ভয়াবহ ঝুঁকি:** 
  - সেই টোকেন ব্রাউজার হিস্ট্রি, প্রক্সি সার্ভার লগ, এবং `Referer` হেডার মারফত থার্ড-পার্টি অ্যানালিটিক্স বা হ্যাকারের হাতে চলে যায়। একবার লং-লিভড টোকেন ফাঁস হলে ইউজারের সম্পূর্ণ একাউন্ট হাইজ্যাক হয়ে যাবে।

---

### 3. The Gold-Standard Solution: Short-Lived Single-Use Cryptographic Ticket (OAuth2 Authorization Code Analog)
আমরা তৈরি করেছি ইন্ডাস্ট্রি-স্ট্যান্ডার্ড **Ticket Exchange Engine**:
1. **টিকিট জেনারেশন (`POST /api/v1/auth/sso/ticket`):**
   - সেন্ট্রাল আইডেন্টিটিতে লগইন থাকা ইউজার যখন "School ERP" আইকনে ক্লিক করে, ব্রাউজার সেন্ট্রাল এপিআই থেকে একটি ওয়ান-টাইম টিকিট সংগ্রহ করে (`sso_tkt_...`)।
   - এটি রেডিস/ক্যাশে রাখা হয় মাত্র **৬০ সেকেন্ডের TTL** দিয়ে।
2. **সাবডোমেইনে রিডাইরেক্ট:**
   - ব্রাউজার চলে যায় `https://school.zengfy.top/auth/sso/callback?ticket=sso_tkt_...`।
3. **এটমিক এক্সচেঞ্জ (`POST /api/v1/auth/sso/exchange`):**
   - স্কুল পোর্টাল সেন্ট্রাল অথ গেটওয়েতে টিকিটটি পাঠায়।
   - **Replay Attack Defense:** আমরা লারাভেলের `Cache::pull()` ব্যবহার করেছি। এর ফলে টিকিটটি রিড করার সাথে সাথেই মেমোরি থেকে চিরতরে মুছে যায়! কেউ যদি হিস্ট্রি থেকে সেই ইউআরএল কপি করে ২য় বার হিট করে, সে তাৎক্ষণিক `401 Unauthorized` পাবে।
4. **Subdomain Spoofing Defense:**
   - টিকিটে লেখা ছিল `target_subdomain: 'school'`. যদি কোনো হ্যাকার সেই টিকিট নিয়ে `pos.zengfy.top`-এ লগইন করতে চায়, সার্ভার সাথে সাথে `403 Forbidden` ("SSO ticket was not issued for this domain") দিয়ে ব্লক করে দেয়।
5. **Scoped Token Issuance:**
   - স্কুল পোর্টালের জন্য শুধুমাত্র `school:*` স্কোপের ডেডিকেটেড সেশন টোকেন ইস্যু করা হয় এবং তার ডিভাইসের আলাদা হিস্ট্রি লগ হয়।

---

## 📌 চেকলিস্টের সর্বশেষ অবস্থা

| Task ID | বিবরণ | টেস্ট স্ট্যাটাস |
| :--- | :--- | :--- |
| **TASK-001** | Architecture Constitution (`CONST-001`) & ADR-001 | 🟢 **COMPLETED** |
| **TASK-002** | Canonical Resource Model & 36-Section API Blueprint | 🟢 **COMPLETED** |
| **TASK-003** | OpenAPI 3.1 & Typed Response Envelope (`ApiResponse`) | 🟢 **COMPLETED** |
| **TASK-004** | Docker Cluster (Nginx 7000, 3x App, Redis, MySQL) | 🟢 **COMPLETED** |
| **TASK-005** | Registration Feature Tests & Idempotency Engine | 🟢 **COMPLETED** (4/4 Tests) |
| **TASK-006** | Locust Load Testing & Concurrency Benchmark | 🟢 **COMPLETED** |
| **TASK-007** | Enterprise Login & Multi-Device Session Tracking | 🟢 **COMPLETED** (6/6 Tests) |
| **TASK-008** | **Cross-Subdomain SSO Ticket Exchange Gateway** | 🟢 **COMPLETED** (7/7 Tests) |
| **TASK-009** | **Brute-Force Defense & Redis Lockout Engine** | 🟡 **NEXT MISSION** |

---

## 🎯 পরবর্তী মিশন: TASK-009
পরবর্তী মিশন হলো:
**TASK-009: Brute-Force Defense & Redis Lockout Engine**
- **কেন প্রয়োজন:** বটের দল যখন ডিকশনারি অ্যাটাক বা ব্রুট-ফোর্স দিয়ে বিভিন্ন ইউজারের পাসওয়ার্ড আন্দাজে ট্রাই করতে থাকবে, কীভাবে Redis Sliding Window এবং Exponential Backoff দিয়ে ৩ বার ব্যর্থ হলে ১ মিনিট, ৫ বার ব্যর্থ হলে ১৫ মিনিট লকআউট এবং ইউজারের ইমেইলে সিকিউরিটি অ্যালার্ট ট্রিগার করতে হয়।

রেডি থাকলে বলো, আমরা **TASK-009**-এর প্ল্যান ও বাস্তবায়ন শুরু করব!
