# মডিউল ০৫: রিয়েল-ওয়ার্ল্ড এজ কেস ও প্রডাকশন বাগস (Edge Cases & Production Bugs)

> [⬅️ পূর্ববর্তী মডিউল](04-Verification-Mechanisms-Email-Vs-Phone.md) | [📖 মূল সূচিপত্র (README)](./README.md) | [পরবর্তী মডিউল ➡️](06-Case-Studies-Industry-Analysis.md)


> **লক্ষ্য:** প্রডাকশনে লাখ লাখ ইউজার রেজিস্ট্রেশন করার সময় যেসব মারাত্মক বাগ ও ট্র্যাপের সম্মুখীন হতে হয়, সেগুলোর কার্যকর ইঞ্জিনিয়ারিং সমাধান জানা।

---

## ১. কনকারেন্সি এবং রেস কন্ডিশন (Double Submit Race Condition)

ধরা যাক, একজন ইউজার রেজিস্ট্রেশন ফর্মে সাবমিট বাটনে দ্রুত দুইবার ক্লিক করলেন (Double-click)।

```
থ্রেড ১ ───► [ ইমেইল কি আছে? ] ──► (না, নেই) ──► [ ইউজার ইনসার্ট ] ──► (সফল)
                  ▲
থ্রেড ২ ──────────┘ একই মিলি-সেকেন্ডে চেক করে দেখল "নেই"! ──► [ ডুপ্লিকেট ইনসার্ট! ]
```

### সমাধান:
1. **ফ্রন্টএন্ড স্তরে:** বাটনে ক্লিক করার সাথে সাথে বাটন `disabled` করা এবং লোডিং স্পিনার দেখানো।
2. **ডেটাবেজ স্তরে:** `email` কলামের উপর বাধ্যতামূলক `UNIQUE CONSTRAINT` থাকা আবশ্যক।
3. **সফটওয়্যার কোড স্তরে:** ডেটাবেজের ইউনিক কি ভায়োলেশন এরর কোড (`23505` PostgreSQL-এ) ক্যাচ করে সুন্দরভাবে ক্লায়েন্টকে জানানো: "এই ইমেইলটি দিয়ে ইতোমধ্যে অ্যাকাউন্ট তৈরি করা হয়েছে।"

---

## ২. ইউনিকোড ও আন্তর্জাতিকীকরণ সমস্যা (Unicode Homograph Attacks)

আক্রমণকারীরা একই দেখতে কিন্তু ভিন্ন ক্যারেক্টার দিয়ে ক্ষতিকর ডোমেইন বা ইমেইল স্পুফ করতে পারে।
- ল্যাটিন ইংরেজি অক্ষর `a` (ASCII `0x61`)
- সিরিলিক রাশিয়ান অক্ষর `а` (Unicode `U+0430`)

উভয় অক্ষর দেখতে হুবহু একই রকম (`a`), কিন্তু কম্পিউটারের জন্য দুটি সম্পূর্ণ ভিন্ন ক্যারেক্টার!

### সমাধান:
ইমেইল এবং নাম ডেটাবেজে সেভ করার পূর্বে অবশ্যই **Unicode NFKC Normalization** চালাতে হবে:
```javascript
const cleanEmail = rawEmail.trim().toLowerCase().normalize('NFKC');
```

---

## ৩. প্লাস-ট্যাগিং ও ডট-ইনসেনসিটিভিটি (Plus-Addressing & Dot-Tricks)

গুগল জিমেইল অ্যাকাউন্টে একটি বিশেষ সুবিধা আছে:
- `sazzad.zengfy@gmail.com`
- `s.a.z.z.a.d.zengfy@gmail.com`
- `sazzad.zengfy+freecredit@gmail.com`

গুগলের কাছে এই তিনটি ঠিকানাই এক। কিন্তু সাধারণ ব্যাকএন্ড এদের তিনটি ভিন্ন ইমেইল হিসেবে গণ্য করে। এর ফলে অসাধু ইউজাররা ট্রায়াল ক্রেডিট বা ফ্রি কুপন অপব্যবহার করার জন্য শত শত একাউন্ট খুলে ফেলে।

### সমাধান:
রেজিস্ট্রেশনের সময় একটি ক্যানোনিক্যাল ইমেইল (Canonical Email) প্রসেসিং ফাংশন ব্যবহার করা:
```javascript
export function canonicalizeEmail(email) {
    let [localPart, domain] = email.trim().toLowerCase().split('@');
    if (domain === 'gmail.com' || domain === 'googlemail.com') {
        localPart = localPart.replace(/\./g, ''); // সব ডট মুছে ফেলা
        localPart = localPart.split('+')[0];      // প্লাস এবং তার পরের সব অক্ষর বাদ দেওয়া
    }
    return `${localPart}@${domain}`;
}
```

---

## ৪. ডিসপোজেবল টেম্পোরারি ইমেইল প্রতিরোধ (Disposable Email Filtering)

অনেকে `10minutemail`, `temp-mail.org`, `guerrillamail` এর মতো ক্ষতিকর অস্থায়ী মেইল সার্ভিস দিয়ে ভুয়া একাউন্ট খুলে স্প্যামিং করে।

### সমাধান:
রেজিস্ট্রেশন ভ্যালিডেশনের সময় একটি ওপেন-সোর্স ডিসপোজেবল ডোমেইন ব্ল্যাকলিস্ট দিয়ে চেক করতে হবে:
```javascript
const DISPOSABLE_DOMAINS = new Set([
    'tempmail.com', '10minutemail.com', 'mailinator.com', 
    'guerrillamail.com', 'sharklasers.com', 'yopmail.com'
]);

export function isDisposableEmail(domain) {
    return DISPOSABLE_DOMAINS.has(domain.toLowerCase());
}
```

---


> [⬅️ পূর্ববর্তী মডিউল](04-Verification-Mechanisms-Email-Vs-Phone.md) | [📖 মূল সূচিপত্র (README)](./README.md) | [পরবর্তী মডিউল ➡️](06-Case-Studies-Industry-Analysis.md)

