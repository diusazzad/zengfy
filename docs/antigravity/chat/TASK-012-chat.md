# 🎓 Mentorship & Case Study: TASK-012 - Granular Role-Based Access Control (RBAC Engine)

**Phase:** `PHASE 3: Multi-Tenant Organization & Granular RBAC`  
**Current Milestone:** `TASK-012: Granular Role-Based Access Control (RBAC Engine)`  
**Date:** `September 2026`  

---

## 🏛️ Context & Problem: How Big Tech Solves Authorization at Scale

In **TASK-011**, আমরা নিশ্চিত করেছি যে স্কুল A-এর ডাটাবেজ রেকর্ড স্কুল B কখনো দেখতে পারবে না (Tenant Data Isolation via Global Scopes)।

কিন্তু বাস্তব জীবনে এটি সিকিউরিটির কেবল অর্ধেক সমাধান। স্কুল A-এর ভেতরেও সবার ক্ষমতা এক নয়:
- **Principal:** সব দেখতে ও পরিবর্তন করতে পারবেন (`*` অথবা `manage_staff`, `publish_exam`, `view_finance`)।
- **Teacher:** শুধু ক্লাস উপস্থিতি (`attendance.mark`) ও খাতা মূল্যায়ন (`exam.grade`) করতে পারবেন। শিক্ষক কখনো স্কুলের ব্যাংক স্টেটমেন্ট বা ফিন্যান্স লেজার দেখতে পারবেন না।
- **Accountant:** বেতন ও টিউশন ফি কালেকশন (`finance.collect_fee`) করতে পারবেন, কিন্তু তিনি কোনো ছাত্রের পরীক্ষার নম্বর পরিবর্তন করতে পারবেন না।
- **Student / Guardian:** শুধুমাত্র নোটিশ ও ফলাফল দেখতে পারবেন।

---

### 1. Naive RBAC বনাম Big Tech Granular RBAC

#### ❌ The Naive Developer Anti-Pattern:
বেশিরভাগ জুনিয়র ডেভেলপার কোডে লিখে:
```php
if ($user->role === 'admin') {
    // allow action
}
```
এটি ৩টি কারণে বড় স্কেলের সিস্টেমে সম্পূর্ণ ব্যর্থ হয়:
1. **Multi-Tenant Conflict:** একজন নাগরিক স্কুল A-তে `Teacher` হতে পারেন, কিন্তু স্কুল B-তে তিনি একজন `Parent`। যদি `users` টেবিলে একটি মাত্র স্ট্যাটিক `role` কলাম থাকে, তবে মাল্টি-টেন্যান্সি ভেঙে পড়ে।
2. **Hardcoded Logic Anti-Pattern:** কোডে যদি `if ($role === 'teacher')` হার্ডকোড করা থাকে, কালকে যদি কোনো প্রতিষ্ঠান একটি নতুন পদবী যোগ করতে চায় (যেমন: "Vice Principal", "Sports Coordinator", "Exam Incharge")—তাহলে পুরো সফটওয়্যার রি-কোডিং করতে হবে!
3. **Role Bloat & Privilege Creep:** সময়ের সাথে সাথে `admin_level_1`, `admin_level_2`, `sub_admin` ইত্যাদি বিশৃঙ্খল অবস্থা তৈরি হয়।

#### ✅ The Big Tech Pattern (Google Cloud IAM & AWS IAM):
Google ও AWS যেভাবে কাজ করে:
1. **Decouple Roles from Permissions:**
   - **Permissions:** অ্যাকশন লেভেলের ক্ষুদ্রাতিক্ষুদ্র পারমিশন স্ট্রিং (যেমন: `departments.manage`, `attendance.mark`, `finance.view_ledger`)। কোড বা মিডলওয়্যার সবসময় শুধু **Permission** চেক করে, কখনো সরাসরি Role এর নাম চেক করে না!
   - **Roles:** পারমিশনের একটি গুচ্ছ বা বান্ডিল (যেমন: `Principal` রোলের ভেতর থাকে ১০টি পারমিশন)।
2. **Dynamic Tenant Roles:**
   - সিস্টেমের কিছু ডিফল্ট টেমপ্লেট থাকবে (`owner`, `admin`, `member`)।
   - যেকোনো প্রতিষ্ঠান তাদের প্রয়োজন মতো নতুন রোল তৈরি করতে পারবে (যেমন: "Head of English Department") এবং সেখানে নির্দিষ্ট পারমিশন এসাইন করতে পারবে।
3. **Multi-Role Assignment:**
   - একজন কর্মকর্তা একই সাথে একাধিক পদে থাকতে পারেন ("Senior Teacher" + "Discipline Committee Head")।
4. **$O(1)$ In-Memory & Redis Permission Caching (`RbacEngine`):**
   - প্রতি HTTP রিকোয়েস্টে বারবার ডাটাবেজে ৫-টেবিল JOIN চালিয়ে পারমিশন চেক করা একটি মারাত্মক স্কেলেবিলিটি কিলিং ভুল।
   - ব্যবহারকারীর পারমিশনগুলো রিকোয়েস্ট সাইকেল বা রেডিসে ক্যাশ থাকে। মুহূর্তের মধ্যে ($O(1)$ time) চেক সম্পন্ন হয়।

---

| **TASK-011** | **Multi-Tenant Scoping & Organization Model** | `Organization` & `OrganizationMembership` মডেল, `TenantContext`, `BelongsToTenant` Global Scope | 🟢 **COMPLETED (9/9 Tests)** |
| **TASK-012** | **Granular Role-Based Access Control (RBAC)** | Role vs Permissions (`Principal`, `Teacher`, `Accountant`), Policies & Middleware (`RequireTenantPermission`), Redis Caching | 🟢 **COMPLETED (9/9 Tests Passing)** |

---

## 🚀 Execution & Verification Summary
- **Artifacts:**
  - Plan: [`Implementation Plan - TASK-012.md`](file:///p:/Zengfy-Ecosystem/core/docs/antigravity/chat/Implementation%20Plan%20-%20TASK-012.md)
  - Walkthrough: [`TASK-012-walkthrough.md`](file:///p:/Zengfy-Ecosystem/core/docs/antigravity/chat/TASK-012-walkthrough.md)
- **Feature Tests:** 9/9 passing (`Modules/Organization/tests/Feature/TenantRbacTest.php`).
- **Full Suite Status:** 50/50 passing (245 assertions) across all modules in 4.55s.
- **Phase 3 Completed:** Multi-Tenant Organization & Granular RBAC is now 100% complete!
- **Next Mission:** **PHASE 4: Consumer Social Media & Hyperlocal Feeds (TASK-013: User Profiles & Follow/Friendship Graph)**.
