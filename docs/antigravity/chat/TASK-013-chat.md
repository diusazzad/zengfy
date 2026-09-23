# 🎓 Mentorship & Case Study: TASK-013 - User Profiles & Follow/Friendship Graph

**Phase:** `PHASE 4: Consumer Social Media & Hyperlocal Feeds`  
**Current Milestone:** `TASK-013: User Profiles & Follow/Friendship Graph`  
**Date:** `September 2026`  

---

## 🏛️ Context & Problem: How Big Tech Models Social Graphs at 10M+ Scale

In Phase 2 এবং Phase 3-এ আমরা **Central Identity (SSO, PII Encryption, NID Verification)** এবং **Multi-Tenant Enterprise RBAC** সম্পূর্ণ করেছি।

এখন আমরা প্রবেশ করছি **PHASE 4: Consumer Social Media & Hyperlocal Feeds**-এ। 
Zengfy শুধু একটি B2B সফটওয়্যার নয়, এটি কোটি কোটি বাংলাদেশি নাগরিকের একটি নির্ভরযোগ্য সোশ্যাল নেটওয়ার্ক। আর যেকোনো সোশ্যাল নেটওয়ার্কের মেরুদণ্ড হলো তার **Social Graph** (ব্যবহারকারীদের মধ্যকার সংযোগের জাল)।

---

### 1. Bidirectional Friends বনাম Unidirectional Following

সোশ্যাল মিডিয়া আর্কিটেকচারে গ্রাফ প্রধানত দুই ধরণের হয়:
1. **Unidirectional Graph (একমুখী ফলো - যেমন: Twitter / Instagram):**
   - ইউজার A চাইলে ইউজার B-কে ফলো করতে পারেন কোনো অনুমতি ছাড়াই (যদি B পাবলিক হয়)।
   - এটি নিউজ মিডিয়া, পাবলিক ফিগার, কনটেন্ট ক্রিয়েটর এবং ইনফ্লুয়েন্সার ফলো করার জন্য অপরিহার্য।
   - এতে ফলোয়ারের সংখ্যা লাখ লাখ বা কোটি হতে পারে (High Cardinality)।
2. **Bidirectional Graph (দ্বিমুখী ফ্রেন্ডশিপ - যেমন: Facebook / LinkedIn):**
   - ইউজার A ফ্রেন্ড রিকোয়েস্ট পাঠান -> ইউজার B গ্রহণ করলে তারা উভয়েই "Mutual Friends" হন।
   - এটি বাস্তব জীবনের পরিচিত মানুষদের মধ্যে ব্যক্তিগত যোগাযোগের জন্য প্রযোজ্য।

> **Zengfy-র ইউনিক আর্কিটেকচার:** আমরা একই প্ল্যাটফর্মে **দুটো গ্রাফই** সমর্থন করব! নাগরিকরা ব্যক্তিগত বন্ধুদের সাথে ফ্রেন্ড হতে পারবেন, আবার জাতীয় ব্যক্তিত্ব বা প্রতিষ্ঠানের পেইজ ফলো করতে পারবেন।

---

### 2. The $O(N)$ Database Death Spiral: কেন `COUNT(*)` ব্যবহার করা নিষিদ্ধ?

ধরা যাক একজন বিখ্যাত কনটেন্ট ক্রিয়েটর বা সেলিব্রিটির ৫,০০,০০০ ফলোয়ার আছে।
যদি ডেভেলপার প্রোফাইল পেজ লোড করার সময় লেখে:
```sql
SELECT COUNT(*) FROM follows WHERE following_id = 'user-uuid';
```
১০ লাখ অ্যাক্টিভ ব্যবহারকারী যখন অ্যাপ ওপেন করবে, তখন ডাটাবেজে প্রতি সেকেন্ডে হাজার হাজার `COUNT(*)` কুয়েরি চলবে। এর ফলে:
1. ডাটাবেজ সিপিইউ ১০০% হয়ে যাবে।
2. ইনডেক্স ট্রাভার্সাল স্লো হয়ে রিকোয়েস্ট টাইমআউট হবে (Database Starvation)।
3. পুরো Zengfy প্ল্যাটফর্ম ক্র্যাশ করবে!

#### 🚀 Big Tech Solution: Cache Layering with Redis Atomic Counters
Twitter বা Instagram কখনোই প্রোফাইল পেজে সরাসরি `COUNT(*)` চালায় না। তারা ব্যবহার করে **Cache Layering**:
- ব্যবহারকারীর ফলোয়ার কাউন্ট রেডিসে সংরক্ষিত থাকে: `user:{id}:followers_count`।
- যখন কেউ কাউকে ফলো করে:
  - ডাটাবেজে রো ইনসার্ট হয়।
  - সাথে সাথে রেডিসে অ্যাটমিক অপারেশন চলে: `Redis::incr("user:{$id}:followers_count")`।
- প্রোফাইল ভিউ করার সময় কোনো SQL কাউন্ট ছাড়াই **$O(1)$ টাইম কমপ্লেক্সিটিতে (মাত্র ১ মিলিসেকেন্ডে)** রেডিস থেকে সংখ্যাটি চলে আসে!
- এর সাথে ডাটাবেজের `users` টেবিলেও কাউন্টার কলাম আপডেট থাকে নির্ভরযোগ্যতার জন্য।

---

---

## 🗺️ Phase 4 Roadmap Status

| Task | Title | Description | Status |
| :--- | :--- | :--- | :--- |
| **TASK-013** | **User Profiles & Follow/Friendship Graph** | ফলো ও ফ্রেন্ডশিপ গ্রাফ, রেডিস ক্যাশ লেয়ারিং, ইউনিক হ্যান্ডেল, হাইপারলোকাল প্রোফাইল ফিল্ডস | 🟢 **COMPLETED & 100% PASSING (11/11 Tests)** |
| **TASK-014** | **Post Creation, Media Attachments & Cursor Pagination** | কার্সর পেজিনেশন, ডাইরেক্ট S3/MinIO প্রেসাইন্ড আপলোড | 🟡 **Ready for Next Mission** |
| **TASK-015** | **Hyperlocal Ward-Level News Feed & Geo-Fencing** | ওয়ার্ড ও থানা ভিত্তিক স্পেশাল ফিল্টারিং এবং হাইপারলোকাল নোটিশ ফিড | ⚪ Planned |

---

## 🧪 Test Verification & Quality Evidence

Executed:
```bash
php artisan test Modules/Social/tests/Feature/SocialGraphTest.php
```

Result:
```text
   PASS  Modules\Social\Tests\Feature\SocialGraphTest
  ✓ user can update profile and unique handle                                    0.11s  
  ✓ user can follow another user and counters increment atomically               0.08s  
  ✓ user cannot follow self                                                      0.06s  
  ✓ user can unfollow and counters decrement                                     0.07s  
  ✓ user can send friend request                                                 0.07s  
  ✓ duplicate friend request is prevented                                        0.07s  
  ✓ receiver can accept friend request and both become friends                   0.09s  
  ✓ receiver can decline friend request                                          0.07s  
  ✓ user can remove mutual friend                                                0.08s  
  ✓ public profile endpoint returns accurate relationship state and cached counts 0.08s  
  ✓ followers and following lists are paginated                                  0.12s  

  Tests:    11 passed (46 assertions)
  Duration: 2.10s
```

Combined Verification across Modules (`Auth`, `Organization`, `Social`):
```text
  Tests:    61 passed (311 assertions)
  Duration: 5.90s
```
Zero regressions. 100% passing.

