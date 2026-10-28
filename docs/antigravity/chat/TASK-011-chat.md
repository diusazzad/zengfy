# 🎓 Mentorship & Case Study: TASK-011 - Multi-Tenant Scoping & Organization Model

**Phase:** `PHASE 3: Multi-Tenant Organization & Granular RBAC`  
**Current Milestone:** `TASK-011: Multi-Tenant Scoping & Organization Model`  
**Date:** `September 2026`  

---

## 🏛️ Context & Problem: How Big Tech Builds Multi-Tenancy

In Phase 2, we completed the **Central Identity & Unified SSO Layer** (Central UUID, AES-256 PII Encryption, HMAC Blind Index, NID Verification, and Multi-Device Session Management). 

Now, we enter **PHASE 3: Multi-Tenant Organization & Granular RBAC**.

### 1. Multi-Tenancy কী এবং কেন এটি দরকার?
Zengfy শুধু একটি সাধারণ সোশ্যাল অ্যাপ নয়; এটি একটি বিশাল **B2B SaaS ইকোসিস্টেম**। 
- এতে থাকবে **School Management System (ERP)**, **Law Firm Management**, **Hospital/Clinic Management**, **Retail POS**, ইত্যাদি।
- বাংলাদেশে শত শত স্কুল বা হাজার হাজার কোম্পানি একই Zengfy প্ল্যাটফর্ম ব্যবহার করবে।
- উদাহরণস্বরূপ: **"Dhaka Residential Model College" (Tenant A)** এবং **"Viqarunnisa Noon School" (Tenant B)**।

### 2. The Nightmare: Broken Object-Level Authorization (BOLA / IDOR)
ধরা যাক একজন ডেভেলপার কোড লিখলো:
```php
// ❌ মারাত্মক সিকিউরিটি ত্রুটি:
$student = Student::find($request->student_id);
return response()->json($student);
```
যদি স্কুল A-এর একজন শিক্ষক স্কুল B-এর একজন ছাত্রের `student_id` পাস করে দেয়, এবং ডাটাবেজ থেকে সেই ডাটা চলে আসে—তাহলে একে বলা হয় **Data Leakage / Cross-Tenant Data Contamination**। ইউরোপের GDPR বা দেশের ডিজিটাল নিরাপত্তা আইনে এটি মারাত্মক অপরাধ।

### 3. Big Tech Solution: Shared Database with Global Eloquent Scoping
Google, Stripe, Shopify, এবং Slack যেভাবে মাল্টি-টেন্যান্সি তৈরি করে:
1. **Universal Tenant UUID:** প্রতিটি টেন্যান্ট-স্পেসিফিক টেবিলে একটি `organization_id` কলাম থাকবে।
2. **Global Tenant Scope (`TenantScope`):** ORM লেভেলে একটি স্বয়ংক্রিয় ফিল্টার থাকে। আপনি যদি কোডে লিখেন `Student::all()`, লারাভেলের কুয়েরি ইঞ্জিন স্বয়ংক্রিয়ভাবে ব্যাকগ্রাউন্ডে চালাবে:
   ```sql
   SELECT * FROM students WHERE organization_id = 'org-uuid-of-active-tenant';
   ```
   ডেভেলপার যদি ভুলে `where('organization_id')` নাও দেয়, তবুও স্কুল A কখনোই স্কুল B-এর ডাটা দেখতে পারবে না!
3. **Auto-Stamping on Creation:** যখন কোনো নতুন ডিপার্টমেন্ট বা স্টুডেন্ট তৈরি হবে (`Department::create(['name' => 'Science'])`), আমাদের `BelongsToTenant` ট্রেইট নিজে থেকেই বর্তমান টেন্যান্টের `organization_id` ডাটাবেজে স্ট্যাম্প করে দিবে।
4. **Zero-Trust Context Middleware:** রিকোয়েস্টে আসা `X-Organization-Id` হেডার বা রাউট প্যারামিটার থেকে টেন্যান্ট ভেরিফাই করা হবে। ইউজার যদি ওই প্রতিষ্ঠানের অ্যাক্টিভ মেম্বার না হয়, সরাসরি **403 Forbidden** রিটার্ন করবে।

---

## 🗺️ What's Next in Phase 3 Roadmap

| Task | Title | Description | Status |
| :--- | :--- | :--- | :--- |
| **TASK-011** | **Multi-Tenant Scoping & Organization Model** | `Organization` & `OrganizationMembership` মডেল, `TenantContext`, `BelongsToTenant` Global Scope, Zero-Trust Middleware | 🟢 **COMPLETED (9/9 Tests Passing)** |
| **TASK-012** | **Granular Role-Based Access Control (RBAC)** | Role vs Permissions (`Principal`, `Teacher`, `Accountant`), Policies (`$user->can('fee.collect')`) | ⚪ **NEXT MISSION** |

---

## 🚀 Execution & Verification Summary
- **Artifacts:**
  - Plan: [`Implementation Plan - TASK-011.md`](file:///p:/Zengfy-Ecosystem/core/docs/antigravity/chat/Implementation%20Plan%20-%20TASK-011.md)
  - Walkthrough: [`TASK-011-walkthrough.md`](file:///p:/Zengfy-Ecosystem/core/docs/antigravity/chat/TASK-011-walkthrough.md)
- **Feature Tests:** 9/9 passing (`Modules/Organization/tests/Feature/TenantScopingTest.php`).
- **Full Suite Status:** 41/41 passing (217 assertions) in 3.61s.
- **Ready for TASK-012:** Granular Role-Based Access Control (RBAC Engine).

