# 🤝 Zengfy Dual-Agent Engineering Collaboration Protocol

**Version:** `1.0.0`  
**Governing Standard:** `CONST-001 (Sovereign Engineering Constitution)`  
**Project:** `Zengfy 10M-Scale Ecosystem`  
**Working Directory:** `p:\Zengfy-Ecosystem\core`  

---

## 🏛️ ১. টিম স্ট্রাকচার ও দায়িত্ব বণ্টন (Roles & Responsibilities)

আমাদের ডেভেলপমেন্ট গতি দ্বিগুণ করতে প্ল্যাটফর্মে দুটি স্বয়ংক্রিয় এআই এজেন্ট একটি রিয়েল-ওয়ার্ল্ড বিগ-টেক ইঞ্জিনিয়ারিং টিমের মতো একসঙ্গে কাজ করছে:

```
                      ┌───────────────────────────────────────────────┐
                      │    👨‍💻 Human Tech Lead (Project Director)    │
                      │           User / Sazzad Hossain               │
                      └───────────────┬───────────────────────────────┘
                                      │
               ┌──────────────────────┴──────────────────────┐
               │                                             │
               ▼                                             ▼
┌──────────────────────────────┐              ┌──────────────────────────────┐
│  👑 AGENT 1: Lead Architect   │              │  🎨 AGENT 2: Frontend & UI   │
│  (Antigravity IDE Lead)      │              │  (Zed Editor Extension)      │
├──────────────────────────────┤              ├──────────────────────────────┤
│ • System Architecture        │◄──Chat /────►│ • UI/UX Design & Layout      │
│ • Database & Migrations      │   Reviews    │ • Blade Views & Components   │
│ • High-Concurrency APIs      │   Tickets    │ • TailwindCSS & Alpine.js    │
│ • Security & Redis Caching   │              │ • Responsive Mobile Screens  │
│ • Code Review & Approval     │              │ • API Integration on Client  │
└──────────────────────────────┘              └──────────────────────────────┘
```

---

## 💬 ২. চ্যাট ও কমিউনিকেশন প্রটোকল (WhatsApp-Style Chat Threads)

উভয় এজেন্টের যাবতীয় কথাবার্তা, টাস্ক ডেলিগেশন ও কোড রিভিউ রিয়েল মানুষের মতো **চ্যাট থ্রেড (`docs/antigravity/multi-agent/chat/`)** ফাইলে সংরক্ষিত থাকবে।

### চ্যাটের নিয়মাবলী:
1. **ভাষা:** উভয় এজেন্ট সবসময় স্বাভাবিক, মার্জিত এবং প্রফেশনাল **বাংলা (Bengali)**-তে লিখবে যাতে হিউম্যান টেক লিড সহজে পড়ে পুরো ডেভেলপমেন্ট আর্কিটেকচার শিখতে ও মনিটর করতে পারেন।
2. **মেসেজ ফরম্যাট:** প্রতিটি মেসেজ একটি সুন্দর চ্যাট বাবল স্টাইলে ফরম্যাট করা হবে:
   ```markdown
   ### 👑 Agent 1 (Lead Systems Architect) — [2026-09-29 19:45]
   > মেসেজ ও টাস্ক ডেসক্রিপশন...

   ---

   ### 🎨 Agent 2 (Frontend Engineer) — [2026-09-29 20:00]
   > কাজের অগ্রগতি, তৈরি করা ফাইল ও ফিডব্যাক...
   ```
3. **টাস্কের লিংক:** প্রতিটি চ্যাট মেসেজে সংশ্লিষ্ট টাস্ক স্পেকের (`docs/antigravity/multi-agent/tasks/TASK-FE-XXX.md`) লিংক থাকবে।

---

## 📁 ৩. ফোল্ডার ও ফাইল স্ট্রাকচার

```text
p:\Zengfy-Ecosystem\core\docs\antigravity\multi-agent\
├── SYSTEM_PROTOCOL.md          # এই প্রটোকল ডকুমেন্ট (Source of Truth)
├── INDEX.md                    # সেন্ট্রাল ট্র্যাকার বোর্ড (কে কোন কাজে ব্যস্ত)
│
├── chat/                       # চ্যাট থ্রেডসমূহ (WhatsApp-style discussion logs)
│   └── THREAD-001-AUTH-AND-SOCIAL-UI.md
│
├── tasks/                      # Frontend এজেন্টের জন্য নির্দিষ্ট কাজের স্পেসিফিকেশন
│   └── TASK-FE-001-AUTH-PORTAL-UI.md
│
└── reviews/                    # Agent 1 কর্তৃক কোড রিভিউ ও ফিডব্যাক নোটস
    └── REVIEW-FE-001.md
```

---

## 🔄 ৪. কাজের লাইফসাইকেল (Step-by-Step Workflow)

1. **টাস্ক প্রস্তুতকরণ (Agent 1):**
   - Agent 1 ব্যাকএন্ড API এবং আর্কিটেকচার তৈরি করে `tasks/TASK-FE-XXX.md` ফাইলে বিশদ স্পেসিফিকেশন লিখে চ্যাট থ্রেডে Agent 2-কে কল করবে।
2. **টাস্ক এক্সিকিউশন (Agent 2 - Zed Editor):**
   - হিউম্যান টেক লিড Zed Editor-এ Agent 2-কে শুধু বলবেন: `"proceed"` বা `"docs/antigravity/multi-agent/chat/THREAD-001-AUTH-AND-SOCIAL-UI.md ফাইলটি দেখে কাজ শুরু করো"`।
   - Agent 2 স্পেক পড়ে UI কোড, Blade ভিউ, CSS ও Alpine.js স্ক্রিপ্ট তৈরি করবে।
   - কাজ শেষ করে Agent 2 চ্যাট থ্রেডের নিচে তার কাজের বিস্তারিত রিপোর্ট যোগ করবে।
3. **কোড রিভিউ ও মার্চেন্ট ভেরিফিকেশন (Agent 1):**
   - Agent 1 তৈরি করা কোড রিভিউ করবে, ব্রাউজার/টেস্টে যাচাই করবে এবং ফিডব্যাক দেবে।
   - রিভিউ সন্তোষজনক হলে পরবর্তী টাস্ক প্রদান করা হবে।
