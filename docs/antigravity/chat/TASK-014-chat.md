# 🎓 Mentorship & Case Study: TASK-014 - Post Creation, Media Attachments & Cursor Pagination

**Phase:** `PHASE 4: Consumer Social Media & Hyperlocal Feeds`  
**Current Milestone:** `TASK-014: Post Creation, Media Attachments & Cursor Pagination`  
**Date:** `September 2026`  

---

## 🏛️ Context & Problem: How Big Tech Feeds Scale to 10M+ Users

আমরা **TASK-013**-এ সফলভাবে **User Profiles & Follow/Friendship Graph** সম্পন্ন করেছি (১১টি ফিচার টেস্ট ১০০% পাস, সর্বমোট ৬১টি টেস্ট গ্রিন)। এখন নাগরিকরা পরস্পরকে ফলো করতে পারেন এবং ফ্রেন্ড রিকোয়েস্ট আদান-প্রদান করতে পারেন।

এখন **TASK-014**-এ আমরা সোশ্যাল মিডিয়া ও লোকাল কমিউনিটির প্রধান হৃৎপিণ্ড তৈরি করছি: **Post Creation, Media Attachments & Cursor-Based Feed Pagination**।

এখানে দুটি বড় ইঞ্জিনিয়ারিং চ্যালেঞ্জ রয়েছে যা বিশ্বমানের প্ল্যাটফর্ম (Instagram, Twitter, TikTok) কীভাবে সমাধান করে তা আমরা শিখব:

---

### 1. The OFFSET Pagination Disaster: কেন `OFFSET 50000` ডেটাবেজ ক্র্যাশ করায়?

অধিকাংশ জুনিয়র ইঞ্জিনিয়ার ফিড বানাতে গিয়ে সাধারণ পেজিনেশন ব্যবহার করে:
```sql
SELECT * FROM posts ORDER BY created_at DESC LIMIT 20 OFFSET 50000;
```

#### এতে ১০ লাখ ইউজারের স্কেলে কী মারাত্মক বিপর্যয় ঘটে?
1. **CPU & Disk Exhaustion:** MySQL বা PostgreSQL-কে প্রথমে আগের ৫০,০০০ রো মেমোরিতে পড়তে হয়, সর্ট করতে হয় এবং তারপর ৫০,০০০ রো ফেলে দিয়ে শেষের ২০টি দেখাতে হয়! ৫০ নম্বর পৃষ্ঠায় কুয়েরি ১ সেকেন্ডের বেশি সময় নেয় এবং বাফার পুল চূর্ণবিচূর্ণ হয়ে যায়।
2. **Page Drift (Duplicate & Missing Posts):**
   - ইউজার পেজ ১ স্ক্রল করছেন। ঠিক তখনই অন্য ইউজাররা ৫টি নতুন পোস্ট পাবলিশ করল।
   - এখন যখন ক্লায়েন্ট পেজ ২ রিকোয়েস্ট করে (`OFFSET 20`), তখন পেজ ১-এর শেষ ৫টি পোস্ট শিফট হয়ে পেজ ২-এ চলে আসে! ফলে ইউজার একই পোস্ট বারবার দেখে (Duplicate annoyance)।
   - আর যদি কোনো পোস্ট ডিলিট হয়, তবে ইউজার পোস্ট মিস করে ফেলে।

#### 🚀 The Big Tech Solution: Keyset / Cursor-Based Pagination
Twitter বা Instagram কখনোই `OFFSET` ব্যবহার করে না। তারা ব্যবহার করে **Cursor Pagination**:
```sql
SELECT * FROM posts 
WHERE (created_at, id) < (:cursor_created_at, :cursor_id) 
ORDER BY created_at DESC, id DESC 
LIMIT 20;
```
- ডাটাবেজের `(created_at, id)`-এ কম্পোজিট বি-ট্রি ইনডেক্স থাকে।
- কুয়েরি সরাসরি পূর্বের শেষ দেখা পোস্টের কার্সরে জাম্প করে।
- **টাইম কমপ্লেক্সিটি $O(1)$!** পেজ ১-এ যেতে যত মিলিসেকেন্ড লাগে, পেজ ৫,০০,০০০-এ যেতেও ঠিক একই ১ মিলিসেকেন্ড লাগে!
- আমরা ক্লায়েন্টকে কার্সরটি ওপেকের মতো একটি নিরাপদ এনকোডেড টোকেন হিসেবে রিটার্ন করি (`next_cursor`).

---

### 2. Presigned Direct Upload: PHP-FPM Worker-কে মুক্তি দেওয়া

সোশ্যাল নেটওয়ার্কে ইউজাররা উচ্চ রেজোলিউশনের ছবি বা ভিডিও আপলোড করে (১০ মেগাবাইট বা তার বেশি)।

#### সনাতন পদ্ধতির সমস্যা:
যদি মোবাইল অ্যাপ ছবি সরাসরি আমাদের Laravel API সার্ভারে পাঠায়:
- বাংলাদেশের দুর্বল 3G বা 4G নেটওয়ার্কে ১০ মেগাবাইট ফাইল আপলোড হতে ৮-১৫ সেকেন্ড লাগে।
- পুরো এই ১৫ সেকেন্ড ধরে একটি PHP-FPM worker প্রসেস ব্লক হয়ে থাকে!
- মাত্র ১০০ জন মানুষ একসাথে ছবি আপলোড করলে সব PHP প্রসেস শেষ হয়ে যাবে এবং অন্য সব ইউজারের সাধারণ ব্রাউজিংও আটকে গিয়ে `504 Gateway Timeout` দেবে!

#### 🚀 The Big Tech Solution: Direct S3 / MinIO Presigned URLs
1. ক্লায়েন্ট ব্যাকএন্ডে শুধু ফাইলের মেটাডাটা পাঠায়: `POST /api/v1/media/presign` (MIME type, file size).
2. ব্যাকএন্ড ভ্যালিডেশন করে একটি ক্রিপ্টোগ্রাফিক টাইম-লিমিটেড প্রেসাইন্ড URL দেয় (`https://storage.zengfy.com/media/...?signature=...`).
3. মোবাইল অ্যাপ বা ব্রাউজার সরাসরি অবজেক্ট স্টোরেজে (MinIO/S3) ফাইলটি আপলোড করে। আমাদের API সার্ভারের কোনো মেমোরি বা প্রসেস ব্লক হয় না!
4. আপলোড শেষে ক্লায়েন্ট শুধু ফাইলের স্টোরেজ কী দিয়ে পোস্ট তৈরি করে: `POST /api/v1/posts`.

---

## 🗺️ Master Roadmap Checklist Progress

```markdown
### [x] TASK-013: User Profiles & Follow/Friendship Graph (🟢 100% COMPLETE - 11/11 Tests)
### [ ] TASK-014: Post Creation, Media Attachments & Cursor Pagination (🟡 Implementation Plan Ready)
### [ ] TASK-015: Hyperlocal Ward-Level News Feed & Geo-Fencing (⚪ Planned)
```

---

## 🚀 Readiness for Execution

Implementation Plan তৈরি করে অনুমোদনের জন্য প্রস্তুত রাখা হয়েছে:
- **Brain Artifact:** `implementation_plan.md`
- **Chat Documentation:** `docs/antigravity/chat/Implementation Plan - TASK-014.md`
- **Walkthrough Document (TASK-013):** `docs/antigravity/chat/TASK-013-walkthrough.md`
- **Master Checklist:** `docs/task/master_engineering_task_checklist.md` (Updated)

প্ল্যানটি দেখে অনুমোদন দিলে আমরা সরাসরি TASK-014 বাস্তবায়নে প্রবেশ করব!
