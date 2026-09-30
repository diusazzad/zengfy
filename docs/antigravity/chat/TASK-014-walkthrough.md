# 🚀 TASK-014: Post Creation, Media Attachments & Cursor-Based Infinite Scrolling Walkthrough

## 📌 সারসংক্ষেপ (Overview)
- **টাস্ক:** TASK-014 (Phase 4: Consumer Social Media & Hyperlocal Feeds)
- **উদ্দেশ্য:** কোটি কোটি ইউজারের জন্য স্কেলেবল পোস্ট ক্রিয়েশন, S3/MinIO প্রি-সাইন্ড ডিরেক্ট মিডিয়া আপলোড এবং হাই-কনকারেন্সি কার্সার-বেজড (Keyset) ইনফিনিট স্ক্রলিং ফিড আর্কিটেকচার তৈরি করা।
- **স্ট্যাটাস:** 🟢 **COMPLETED & 100% PASSING (10/10 Tests Passed, 52 Assertions)**

---

## 🏗️ মূল আর্কিটেকচারাল সমাধান (Architectural Solutions Implemented)

### ১. কীসেট / কার্সার-বেজড ইনফিনিট স্ক্রলিং ($O(1)$ Keyset Pagination)
- **সমস্যা:** ট্র্যাডিশনাল `OFFSET / LIMIT` প্যাজিনেশন ডাটাবেজ বড় হলে ($N > 1,000,000$) প্রতি পেজে $O(N)$ ফুল-ইন্ডেক্স স্ক্যান করে ডাটাবেজ ক্র্যাশ করায় এবং নতুন পোস্ট আসলে ডুপ্লিকেট দেখায় (Pagination Drift)।
- **সমাধান:** `ORDER BY created_at DESC, id DESC` এবং কম্পোজিট ইনডেক্স `['created_at', 'id']` ব্যবহার করে লারাভেলের `cursorPaginate()` ইন্টিগ্রেশন। ক্লায়েন্টকে Base64 এনকোডেড `next_cursor` মেটা প্রদান করা হয়, যা পরবর্তী পেজ সরাসরি $O(1)$ সময়ে ইনডেক্স থেকে তুলে আনে।

### ২. প্রি-সাইন্ড ডিরেক্ট অবজেক্ট স্টোরেজ আপলোড (Presigned S3/MinIO Direct Uploads)
- **সমস্যা:** ব্যবহারকারী যখন 10MB-50MB সাইজের হাই-রেজুলেশন ছবি বা ভিডিও পোস্ট করে, তখন ফাইল লারাভেল ওয়েব সার্ভার হয়ে গেলে পিএইচপি ওয়ার্কার মেমোরি ও ব্যান্ডউইথ শেষ হয়ে পুরো সার্ভার স্লো হয়ে যায়।
- **সমাধান:** `POST /api/v1/media/presign` এন্ডপয়েন্টে ফাইল মেটাডাটা ও মাইম-টাইপ যাচাই করে S3/MinIO-এর জন্য সরাসরি ২০ মিনিটের সিকিউর প্রি-সাইন্ড PUT URL জেনারেট করা হয় (লোকাল এনভায়রনমেন্টের জন্য HMAC Signed Fallback Route)। ক্লায়েন্ট সরাসরি স্টোরেজে ফাইল আপলোড করে শুধু URL ও মেটাডাটা পোস্ট তৈরির জন্য পাঠায়।

### ৩. গ্র্যানুলার ফিড ভিজিবিলিটি স্কোপিং (Granular Visibility Rules)
- **পাবলিক (`public`):** সমস্ত ব্যবহারকারী এবং অতিথি ভিজিটররা দেখতে পারে।
- **ফ্রেন্ডস-অনলি (`friends_only`):** শুধুমাত্র পারষ্পরিক বন্ধু (`friendships` টেবিলের `status = 'accepted'`) এবং পোস্টের লেখক দেখতে পারে।
- **প্রাইভেট (`private`):** শুধুমাত্র পোস্টের মূল লেখক দেখতে পারে।

---

## 🧪 টেস্ট কভারেজ ও ভেরিফিকেশন (Test Verification)
- **টেস্ট ফাইল:** [`Modules/Social/tests/Feature/PostCreationAndPaginationTest.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/tests/Feature/PostCreationAndPaginationTest.php)
- **ফলাফল:** **10 Passed, 52 Assertions**
  1. `user_can_request_presigned_media_upload_url` ✓
  2. `presign_request_fails_with_invalid_mime_type_or_excessive_size` ✓
  3. `user_can_create_text_post_successfully` ✓
  4. `user_can_create_post_with_media_attachments` ✓
  5. `empty_post_without_text_or_media_is_rejected` ✓
  6. `unauthenticated_user_cannot_create_or_delete_posts` ✓
  7. `user_can_delete_own_post_but_cannot_delete_others_post` ✓
  8. `public_feed_returns_keyset_cursor_pagination` ✓
  9. `feed_respects_visibility_rules` ✓
  10. `hyperlocal_feed_filters_by_ward_code` ✓
