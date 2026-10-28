# মডিউল ০৭: Zengfy ইমপ্লিমেন্টেশন ব্লুপ্রিন্ট (Zengfy Sovereign Blueprint)

> [⬅️ পূর্ববর্তী মডিউল](06-Case-Studies-Industry-Analysis.md) | [📖 মূল সূচিপত্র (README)](./README.md) | [পরবর্তী মডিউল ➡️](08-IT-Company-Roles-And-Engineering-Workflow.md)


> **লক্ষ্য:** Zengfy ইকোসিস্টেমের স্পেসিফিক রিকোয়ারমেন্ট অনুযায়ী রেজিস্ট্রেশন সিস্টেমের বাস্তবায়ন রোডম্যাপ এবং সার্বভৌম ট্রাস্ট ব্যাজ আর্কিটেকচার চূড়ান্ত করা।

---

## ১. সার্বভৌম ট্রাস্ট টিয়ার মডেল (Zengfy Trust Tiers)

Zengfy ইকোসিস্টেমে সিটিজেনদের আস্থা ও অধিকারের ৪টি স্তর থাকবে:

```
[ Tier 3: Sovereign Civic Citizen ] ◄── এনআইডি বা লোকাল ওয়ার্ড ভেরিফিকেশন (ভোট ও আইন)
                ▲
[ Tier 2: Community Verified ]      ◄── ফোন নাম্বার যুক্ত ও ২ জন ভেরিফাইড নাগরিকের অনুমোদন
                ▲
[ Tier 1: Email Verified Member ]   ◄── ইমেইল ভেরিফিকেশন লিংক সম্পন্ন (পোস্ট, কমেন্ট)
                ▲
[ Tier 0: Guest / Unverified ]       ◄── ৩-ফিল্ড সাইন-আপ সম্পন্ন (শুধু রিড এক্সেস)
```

| টিয়ার | নাম | শর্ত | অর্জিত অধিকার ও সুযোগ-সুবিধা |
| :---: | :--- | :--- | :--- |
| **Tier 0** | Guest Citizen | নাম, ইমেইল, পাসওয়ার্ড দিয়ে সাইন-আপ | প্ল্যাটফর্ম ভিজিট করা, কনটেন্ট পড়া, ডিরেক্টরি সার্চ করা। |
| **Tier 1** | Verified Citizen | ইমেইল ভেরিফিকেশন সম্পন্ন | সোশ্যাল ফিডে পোস্ট করা, কমেন্ট করা, কমিউনিটি নোটিফিকেশন পাওয়া। |
| **Tier 2** | Community Anchor | একাউন্ট সেন্টারে ফোন নাম্বার ভেরিফাই | লোকাল নেইবারহুড গ্রুপ তৈরি করা, সিভিক বিপদে অ্যালার্ট ইস্যু করা। |
| **Tier 3** | Sovereign Leader | এনআইডি / স্মার্ট কার্ড ডিজিটাল প্রুফ | অফিসিয়াল সিভিক ভোট প্রদান, নীতি নির্ধারণ ও ডিজিটাল পিটিশন তৈরি। |

---

## ২. মডুলার আর্কিটেকচার রোডম্যাপ

রেজিস্ট্রেশন মডিউলটি Zengfy Core-এ একটি সম্পূর্ণ পৃথক এবং স্বাধীন মডিউল (`AuthModule`) হিসেবে পরিচালিত হবে:

```
P:\Zengfy-Ecosystem\core├── modules│   └── auth│       ├── controllers\    # RegistrationController, VerificationController
│       ├── services\       # RegistrationService, TokenService, PasswordHasher
│       ├── validators\     # RegisterRequestValidator
│       ├── models\         # User, EmailVerificationToken
│       └── views\          # responsive-registration.blade.php / react-form.tsx
```

এই ডিকাপল্ড আর্কিটেকচারের ফলে ভবিষ্যতে যখন Zengfy Social, Zengfy Law বা অন্যান্য সিভিক মডিউল যুক্ত হবে, তারা সেন্ট্রাল অথেনটিকেশন সার্ভিসের সাথে একক সাইন-অন (Single Sign-On - SSO) প্রটোকলে যুক্ত হতে পারবে।

---


> [⬅️ পূর্ববর্তী মডিউল](06-Case-Studies-Industry-Analysis.md) | [📖 মূল সূচিপত্র (README)](./README.md) | [পরবর্তী মডিউল ➡️](08-IT-Company-Roles-And-Engineering-Workflow.md)

