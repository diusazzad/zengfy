# 📋 TASK-FE-002: Citizen Profile & Hyperlocal Social Feed UI

**Assigned To:** 🎨 Agent 2 (Frontend Engineer & UI Specialist)  
**Assigned By:** 🛡️ Agent 1 (Lead Systems Architect)  
**Status:** 🟢 **COMPLETED & APPROVED (MERGED)**  
**Priority:** High  
**Backend API Dependencies:**
- `GET /api/v1/feed?per_page=15&cursor={cursor}` (Keyset Cursor-paginated timeline)
- `GET /api/v1/feed/hyperlocal/{wardCode}` (Ward-Level Geo-Fenced Feed)
- `GET /api/v1/feed/hyperlocal/{wardCode}/notices` (Urgent Civic Announcements)
- `GET /api/v1/feed/hyperlocal/{wardCode}/stats` (Ward Pulse Statistics)
- `POST /api/v1/posts` (Create post with optional media)
- `POST /api/v1/media/presign` (Direct S3/MinIO upload)
- `GET /api/v1/users/{identifier}/profile` (Citizen profile & counts)

---

## 🎯 লক্ষ্য (Objective)
Zengfy সোভারেন প্ল্যাটফর্মের জন্য একটি প্রফেশনাল, অত্যন্ত দৃষ্টিনন্দন (Dark Mode `#0B0F17`) সোশ্যাল ফিড ও সিটিজেন প্রোফাইল পেজ তৈরি করা। ব্যবহারকারী যাতে নির্বিঘ্নে হাইপারলোকাল ওয়ার্ড পোস্ট ব্রাউজ করতে পারে, লাইভ নোটিশ দেখতে পারে এবং নতুন পোস্ট তৈরি করতে পারে।

---

## 📦 করণীয় ও ডেলিভারেবলস (Deliverables)

1. **সোশ্যাল ফিড ভিউ (`resources/views/social/feed.blade.php`)**:
   - **ফিড লেআউট (Three-Column Layout)**:
     - *বাম কলাম:* ইউজার কার্ড, ওয়ার্ড নেভিগেটর (Ward Switcher) এবং কুইক ফিল্টার (All Feed, My Ward, Civic Notices)।
     - *মাঝের কলাম:* "Create Post" কম্পোনেন্ট (টেক্সট এরিয়া, মিডিয়া প্রিভিউ, ভিজিবিলিটি সিলেক্টর: Public / Friends Only) এবং ইনফিনিট কার্সার-বেজড পোস্ট স্ট্রিম।
     - *ডান কলাম:* "Ward Pulse" উইজেট (`/stats` এপিআই থেকে লাইভ পোস্ট সংখ্যা, সক্রিয় প্রতিবেশী) এবং সিটি কর্পোরেশন জরুরি ঘোষণা নোটিশ কার্ড।
   - **ইন্টারঅ্যাকশন (Alpine.js)**:
     - লাইক বোতাম টগল।
     - কার্সার বেজড "Load More" বা স্ক্রল ডিটেকশন।
     - মিডিয়া অ্যাটাচমেন্ট ড্রপজোন প্রিভিউ।

2. **সিটিজেন প্রোফাইল ভিউ (`resources/views/social/profile.blade.php`)**:
   - কভার ও অবতার ব্যানার, স্মার্ট এনআইডি ব্লু ভেরিফায়েড ব্যাজ (`verified_badge`)।
   - ফলোয়ার্স, ফলোয়িং ও ফ্রেন্ডস কাউন্টার উইজেট।
   - "Follow / Unfollow" ও "Send Friend Request" ডায়নামিক অ্যাকশন বোতাম।
   - ইউজারের নিজস্ব পোস্ট স্ট্রিম।

3. **রাউটিং ও কন্ট্রোলার (`routes/web.php` & `PageController`)**:
   - `GET /feed` -> `PageController@showFeed`
   - `GET /u/{handle}` -> `PageController@showProfile`

4. **টেস্ট সুইট (`tests/Feature/SocialViewsTest.php`)**:
   - ফিড ও প্রোফাইল ভিউ সফলভাবে রেন্ডার হচ্ছে কিনা তা নিশ্চিত করা (২০টি অ্যাসারশন ১০০% পাস)।

---

## 📐 টেকনিক্যাল গাইডলাইন
- **ডার্ক মোড:** `#0B0F17` (Bg), `#121A29` (Card/Container), `rgba(255, 255, 255, 0.08)` (Borders)।
- **টাইপোগ্রাফি:** `Plus Jakarta Sans`।
- **রিঅ্যাক্টিভিটি:** Alpine.js (`feedComponent()`, `createPostComponent()`)।
