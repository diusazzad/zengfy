# 🎓 TASK-010: National ID (NID) Verification & AES-256 PII Encryption - Chat & Case Study Lecture

## 🧪 টেস্ট ভেরিফিকেশন ফলাফল (100% Green)

আমরা টার্মিনালে সমস্ত Auth মডিউল ফিচার টেস্ট রান করেছি:

```bash
php artisan test Modules/Auth/tests/Feature
```

```text
   PASS  Modules\Auth\Tests\Feature\BruteForceLockoutTest (7 tests, 23 assertions)
   PASS  Modules\Auth\Tests\Feature\LoginTest (6 tests, 55 assertions)
   PASS  Modules\Auth\Tests\Feature\NidVerificationTest (8 tests, 40 assertions)
   PASS  Modules\Auth\Tests\Feature\RegistrationTest (4 tests, 20 assertions)
   PASS  Modules\Auth\Tests\Feature\SsoTicketExchangeTest (7 tests, 42 assertions)

  Tests:    32 passed (180 assertions)
  Duration: 6.15s
```

---

## 🧠 Case Study & Engineering Rationale (মেন্টরশিপ লেকচার: PII এনক্রিপশন ও ব্লাইন্ড ইনডেক্স কেন এভাবে তৈরি করা হলো)

কেন Stripe, Google বা Zengfy-তে সংবেদনশীল জাতীয় পরিচয়পত্র (NID) এবং ব্যক্তিগত তথ্য (PII) এমন বিশেষ আর্কিটেকচারে সুরক্ষিত করা হয়? চলো গভীরভাবে জেনে নিই:

### 1. The PII Encryption Dilemma (AES-256-CBC)
- **আইনি ও নিরাপত্তা ঝুঁকি:**
  - বাংলাদেশের সাইবার নিরাপত্তা ও ডেটা প্রটেকশন নীতি অনুযায়ী কোনো নাগরিকের জাতীয় পরিচয়পত্র বা ফোন নম্বর ডাটাবেজে খালি চোখে পড়ার মতো (Plaintext) রাখা দণ্ডনীয় অপরাধ।
  - যদি কখনো কোনো কারণে ডাটাবেজ ব্যাকআপ চুরি বা লিক হয়ে যায়, হ্যাকার কোটি কোটি নাগরিকের জাতীয় পরিচয়পত্র ডার্ক ওয়েবে বিক্রি করে দিতে পারে।
- **আমাদের সমাধান:**
  - আমরা লারাভেলের Eloquent Model-এ `'nid_number' => 'encrypted'` কাস্টিং ব্যবহার করেছি।
  - এর ফলে ডাটাবেজে এটি `eyJpdiI6I...` সাইফারটেক্সট হিসেবে থাকে। আমরা টেস্ট ২-এ ডিরেক্ট ডিবি কুয়েরি দিয়ে প্রমাণ করেছি: ডাটাবেজের কাঁচা কলামে আসল সংখ্যা থাকেই না! অথচ যখন কোডে `$user->nid_number` কল করা হয়, লারাভেল নিজে থেকেই অ্যাপ্লিকেশনের মাস্টার কী দিয়ে তা ডিক্রিপ্ট করে দেখায়।

---

### 2. The Cryptographic Blind Index Pattern (HMAC-SHA256)
- **কম্পিউটার সায়েন্সের বিশাল জটিলতা:**
  - AES-256-CBC এনক্রিপশনে প্রতিবার একটি র‍্যান্ডম ইনিশিয়ালাইজেশন ভেক্টর (IV) তৈরি হয়। এর মানে হলো তুমি যদি একই NID `1234567890` দুবার এনক্রিপ্ট করো, প্রতিবার সম্পূর্ণ ভিন্ন সাইফারটেক্সট তৈরি হবে!
  - এর ফলে ডাটাবেজে `UNIQUE` ইনডেক্স দেওয়া যায় না।
  - তাহলে কীভাবে জানবে যে একজন অসাধু ব্যক্তি একই NID দিয়ে ১০টি আলাদা ভুয়া অ্যাকাউন্ট খুলে বসে আছে কি না?
  - পুরো ডাটাবেজের কোটি কোটি রেকর্ড ডিক্রিপ্ট করে মেমোরিতে চেক করা অসম্ভব (সিস্টেম ক্র্যাশ করবে)।
- **The Blind Index Solution (Stripe / 1Password Pattern):**
  - আমরা একটি ক্রিপ্টোগ্রাফিক ডিটারমিনিস্টিক হ্যাশ তৈরি করেছি:
    ```php
    public static function generateNidHash(string $nidNumber): string
    {
        return hash_hmac('sha256', trim($nidNumber), config('app.key'));
    }
    ```
  - একই NID যতবারই দেওয়া হোক না কেন, `nid_hash` সবসময় ঠিক একই ৬৪-ক্যারেক্টারের ইউনিক স্ট্রিং তৈরি করবে।
  - ডাটাবেজের `nid_hash` কলামে ইউনিক ইনডেক্স দেওয়া আছে। ফলে ডাটাবেজ ডিক্রিপ্ট না করেই মাত্র **$O(1)$ কনস্ট্যান্ট টাইমে** কোনো NID ডুপ্লিকেট কি না তা সাথে সাথে `409 Conflict` দিয়ে প্রতিহত করা যায়!

---

### 3. Mock Election Commission Gateway & Safe Masked Identifiers
- **স্যান্ডবক্স গেটওয়ে:**
  - নির্বাচন কমিশনের সার্ভার ডাউন থাকা বা রেকর্ড না পাওয়ার মতো কেসগুলো আমরা সিমুলেট করেছি (`999...` দিলে ৪২২ নট ফাউন্ড, `888...` দিলে ৫০৩ গেটওয়ে টাইমআউট)।
- **নিরাপদ মাস্কিং:**
  - মোবাইল বা ওয়েব ফ্রন্টএন্ডে কখনো পুরো NID পাঠানো হয় না। `$user->maskedNid()` মেথড স্বয়ংক্রিয়ভাবে শেষের ৪ ডিজিট বাদে বাকি সব স্টার চিহ্ন (`******7890`) বানিয়ে এপিআইতে পাঠায়, যাতে ডিসপ্লে স্ক্রিনশট নিলেও ডেটা ফাঁস না হয়।

---

## 📌 চেকলিস্ট ও ফেজের বর্তমান অবস্থা

| Phase | বিবরণ | স্ট্যাটাস |
| :--- | :--- | :--- |
| **Phase 0** | Engineering Constitution (`CONST-001`), ADR-001 & Architecture Blueprint | 🟢 **COMPLETED** |
| **Phase 1** | Production Docker Cluster (Nginx 7000, 3x App Nodes, Redis, MySQL), Locust Tests | 🟢 **COMPLETED** |
| **Phase 2** | Central Identity, Unified Single Sign-On (SSO) & NID Verification (TASK-007 to TASK-010) | 🟢 **COMPLETED (100%)** |
| **Phase 3** | **Multi-Tenant Organization & Granular RBAC Engine** | 🟡 **IN PROGRESS / NEXT** |

---

## 🎯 আমাদের পরবর্তী মিশন: PHASE 3 - TASK-011
Phase 3-এর ১ম মিশন:
👉 **[TASK-011: Multi-Tenant Scoping & Organization Model](file:///p:/Zengfy-Ecosystem/core/docs/task/master_engineering_task_checklist.md#task-011-multi-tenant-scoping--organization-model)**
- **কেন প্রয়োজন:** মাল্টি-টেন্যান্ট B2B SaaS আর্কিটেকচার তৈরি করা। কীভাবে স্কুল এ-এর ডাটা কোনোভাবেই স্কুল বি দেখতে পারবে না (Global Eloquent Scope), `organizations`, `organization_memberships` এবং `Identity -> Organization -> Role` মডেলিং তৈরি করা।
