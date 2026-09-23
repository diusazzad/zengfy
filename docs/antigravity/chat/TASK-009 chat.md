Viewed ApiResponse.php:110-130
Edited ApiResponse.php
Created AccountLockoutTriggered.php
Created BruteForceProtectionService.php
Viewed AuthController.php:95-145
Edited AuthController.php
Viewed AuthController.php:105-135
Edited AuthController.php
Viewed api.php:20-30
Edited api.php
Ran command: `php artisan test Modules/Auth/tests/Feature/LoginTest.php`
Created BruteForceLockoutTest.php
Ran command: `php artisan test --filter BruteForceLockoutTest`
Created BruteForceProtectionService.php
Ran command: `php artisan test --filter BruteForceLockoutTest`
Ran command: `php artisan test Modules/Auth/tests/Feature`
Viewed master_engineering_task_checklist.md:145-175
Edited master_engineering_task_checklist.md
Created walkthrough.md

আমরা **TASK-009: Brute-Force Defense & Redis Lockout Engine** সফলভাবে সম্পন্ন ও ভেরিফাই করেছি! 

এখন আমাদের সম্পূর্ণ Auth টেস্ট স্যুটে **24/24 Tests 100% Passed (140 assertions in 2.45s)**! 

সব কাজের রেকর্ড আপডেট করা হয়েছে [`master_engineering_task_checklist.md`](file:///p:/Zengfy-Ecosystem/core/docs/task/master_engineering_task_checklist.md)-এ এবং বিস্তারিত বিবরণ রয়েছে [`walkthrough.md`](file:///c:/Users/sazza/.gemini/antigravity-ide/brain/a046b19d-5aef-4045-8c0e-de889ec9b682/walkthrough.md)-এ।

---

## 🧪 টেস্ট ভেরিফিকেশন ফলাফল (100% Green)

আমরা টার্মিনালে সমস্ত Auth মডিউল ফিচার টেস্ট রান করেছি:

```bash
php artisan test Modules/Auth/tests/Feature
```

```text
   PASS  Modules\Auth\Tests\Feature\BruteForceLockoutTest
  ✓ failed login attempts under threshold return 401 without lockout
  ✓ fifth failed attempt triggers tier one lockout with 60 second cooldown
  ✓ login is blocked during tier one cooldown even with correct password
  ✓ successful login clears failed attempt counters
  ✓ ten failed attempts trigger tier two extended 15 minute lockout
  ✓ tier two lockout dispatches account lockout triggered event
  ✓ distributed botnet ip attack locks target account

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

  Tests:    24 passed (140 assertions)
  Duration: 2.45s
```

---

## 🧠 Case Study & Engineering Rationale (মেন্টরশিপ লেকচার: ব্রুট-ফোর্স ডিফেন্স কেন এভাবে তৈরি করা হলো)

কেন সাধারণ IP-বেসড রেট লিমিটিং 10M স্কেলের প্রোডাকশন সিস্টেমে সম্পূর্ণ ব্যর্থ হয় এবং আমরা কীভাবে এটিকে সমাধান করলাম:

### 1. The Distributed Botnet & Credential Stuffing Trap
- **সাধারণ ভুল ধারণা:** অনেক ডেভেলপার রুট ফাইলে শুধুমাত্র `throttle:5,1` (আইপি প্রতি মিনিটে ৫ রিকোয়েস্ট) বসিয়ে মনে করে সিস্টেম সুরক্ষিত।
- **বাস্তব অ্যাটাক (Distributed Credential Stuffing):**
  - হ্যাকাররা টর নেটওয়ার্ক বা বটনেটের মাধ্যমে ১০০০টি আলাদা রেসিডেন্সিয়াল আইপি ব্যবহার করে।
  - প্রতিটি আইপি থেকে তারা ইউজারের ইমেইলে (`ceo@zengfy.top`) মাত্র ১ বার পাসওয়ার্ড ট্রাই করে।
  - যেহেতু কোনো আইপি-ই ৫ বারের বেশি ট্রাই করছে না, সাধারণ আইপি-থ্রটলার কিছুই ধরতে পারে না! অথচ টার্গেট অ্যাকাউন্টে ১০০০ বার পাসওয়ার্ড ট্রাই হয়ে যায় এবং হ্যাকার একাউন্ট ব্রেক করতে সক্ষম হয়।
- **আমাদের ডুয়াল-কী শিল্ড (`Dual-Key Defense`):**
  - [`BruteForceProtectionService.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Auth/app/Services/BruteForceProtectionService.php)-এ আমরা দুটি ট্র্যাকার একসাথে চালাই:
    1. **Client IP Key:** `auth:attempts:ip:{ip}` (একক আইপি থেকে একের পর এক অ্যাকাউন্টে হামলা ঠেকাতে)।
    2. **Target Account Key:** `auth:attempts:email:{sha256(email)}` (হাজারটা আলাদা আইপি থেকে আসলেও নির্দিষ্ট অ্যাকাউন্টকে সুরক্ষিত রাখতে)।
  - টেস্ট ৭-এ আমরা প্রমাণ করেছি: ৫টি সম্পূর্ণ ভিন্ন বট আইপি দিয়ে অ্যাটাক করলেও ৬ নম্বর অচেনা বট আইপি সাথে সাথে `429 Too Many Requests` পেয়ে ব্লক হয়ে যায়!

---

### 2. Multi-Tier Exponential Backoff
- **টিয়ার ১ (৫টি ব্যর্থ চেষ্টা):** ৬০ সেকেন্ডের কুলডাউন। ইউজারের কাছে RFC 6585 স্ট্যান্ডার্ড `Retry-After: 60` রেসপন্স হেডার যায়, যা দেখে ফ্রন্টএন্ড (React/Flutter) কাউন্টডাউন টাইমার দেখাতে পারে।
- **টিয়ার ২ (১০টি ব্যর্থ চেষ্টা):** ১৫ মিনিটের এক্সটেন্ডেড সিকিউরিটি লকআউট।
- **Security Alert Event:** টিয়ার ২ ট্রিগার হওয়া মাত্রই সিস্টেম [`AccountLockoutTriggered`](file:///p:/Zengfy-Ecosystem/core/Modules/Auth/app/Events/AccountLockoutTriggered.php) ডোমেন ইভেন্ট ডিসপ্যাচ করে, যার মাধ্যমে ইউজারের ইমেইলে সাথে সাথে "আপনার অ্যাকাউন্টে বারবার ভুল পাসওয়ার্ড দেওয়ার কারণে ১৫ মিনিটের জন্য লক করা হয়েছে" সতর্কবার্তা চলে যায়।

---

### 3. CPU Exhaustion (Bcrypt DoS) প্রতিরোধ
- **গুরুত্বপূর্ণ সাইবার সিকিউরিটি টেকনিক:** পাসওয়ার্ড যাচাই করতে লারাভেল `Hash::check()` (Bcrypt) চালায়, যা ইচ্ছাকৃতভাবেই অনেক CPU-heavy।
- হ্যাকাররা চাইলে সার্ভারের সব CPU কোর ১০০% জ্যাম করে ক্র্যাশ করিয়ে দিতে পারে।
- **আমাদের সুরক্ষা:** কুলডাউন অ্যাক্টিভ থাকা অবস্থায় রিকোয়েস্ট আসলে `checkLockout()` শুরুতেই রিকোয়েস্ট রিজেক্ট করে দেয়—সার্ভার কোনো CPU খরচ করে পাসওয়ার্ড হ্যাশ করার প্রয়োজনই মনে করে না!

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
| **TASK-008** | Cross-Subdomain SSO Ticket Exchange Gateway | 🟢 **COMPLETED** (7/7 Tests) |
| **TASK-009** | **Brute-Force Defense & Redis Lockout Engine** | 🟢 **COMPLETED** (7/7 Tests) |
| **TASK-010** | **National ID (NID) Verification & AES-256 PII Encryption** | 🟡 **NEXT MISSION** |

---

## 🎯 পরবর্তী মিশন: TASK-010
ফেজ ২-এর ফাইনাল গ্র্যান্ড মিশন:
👉 **[TASK-010: National ID (NID) Verification & AES-256 PII Encryption](file:///p:/Zengfy-Ecosystem/core/docs/task/master_engineering_task_checklist.md#task-010-national-id-nid-verification--aes-256-pii-encryption)**
- **কেন প্রয়োজন:** বাংলাদেশ সরকারের ইলেকশন কমিশন এনআইডি ডাটাবেজের ধাঁচে একটি স্যান্ডবক্স গেটওয়ে তৈরি করা, ১০-সংখ্যার এনআইডি যাচাই, ইউজারের সংবেদনশীল তথ্য (NID ও ফোন নম্বর) ডাটাবেজে AES-256-CBC এনক্রিপশন রাখা, এবং ভেরিফায়েড হলে প্রোফাইলে ব্লু-ব্যাজ (`verified_badge`) ইস্যু করা।

রেডি থাকলে জানাও, আমরা **TASK-010**-এর প্ল্যান ও বাস্তবায়ন শুরু করব!
