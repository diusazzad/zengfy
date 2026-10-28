# 📋 TASK-FE-003: Interactive 9-Dot App Launcher & Real-Time Chat Drawer UI

**Assigned To:** 🎨 Agent 2 (Frontend Engineer & UI Specialist)  
**Assigned By:** 🛡️ Agent 1 (Lead Systems Architect)  
**Status:** 🟡 **ASSIGNED & READY TO START**  
**Priority:** High  
**Backend API Dependencies:**
- `GET /api/v1/conversations` (List active chat threads & unread counters)
- `POST /api/v1/conversations/direct` (Start/retrieve 1-on-1 direct conversation)
- `GET /api/v1/conversations/{id}/messages` (Keyset cursor-paginated chat history)
- `POST /api/v1/conversations/{id}/messages` (Send real-time message & trigger Reverb broadcast)
- `POST /api/v1/conversations/{id}/typing` (Live typing indicator)
- `POST /api/v1/conversations/{id}/read` (Mark messages as read)
- `POST /api/v1/emergency/sos` (Emergency SOS distress signal)
- `GET /api/v1/emergency/active` (Active emergency alerts)

---

## 🎯 লক্ষ্য (Objective)
Zengfy-এর সোশ্যাল ফিড ও প্রোফাইল পেজে একটি প্রিমিয়াম **ফ্লোটিং রিয়েল-টাইম চ্যাট ড্রয়ার (Chat Drawer / Messenger)** এবং টপ ন্যাভবারে থাকা **৯-ডট ইউনিভার্সাল ইকোসিস্টেম লঞ্চার**-কে সম্পূর্ণ ইন্টারঅ্যাক্টিভ ও লাইভ এপিআই-র সাথে সংযুক্ত করা।

---

## 📦 করণীয় ও ডেলিভারেবলস (Deliverables)

1. **৯-ডট ইউনিভার্সাল লঞ্চার এনহ্যান্সমেন্ট**:
   - `resources/views/layouts/social.blade.php`-এ থাকা ৯-ডট অ্যাপ লঞ্চারে প্রতিটি সার্ভিসে (Social, School ERP, Retail POS, Legal Chambers, Hotel HMS, Smart AI) ক্লিক করলে সিঙ্গেল সাইন-অন (SSO) টিকিট জেনারেশন লিঙ্ক বা সাবডোমেইন রিডাইরেক্ট সিমুলেশন যুক্ত করা।

2. **ফ্লোটিং চ্যাট ড্রয়ার কম্পোনেন্ট (`resources/views/social/chat-drawer.blade.php`)**:
   - সোশ্যাল ফিড ও প্রোফাইল লেআউটের নিচে ডানে একটি ফ্লোটিং চ্যাট বাটন (unread count badge সহ)।
   - ক্লিকে স্লাইড-আপ বা পপ-আপ হয়ে ওপেন হবে একটি স্লিক ডার্ক মেসেঞ্জার ড্রয়ার (`#121A29`, ব্যাকড্রপ ব্লার):
     - **থ্রেড লিস্ট ভিউ:** সক্রিয় কথোপকথনের তালিকা, পার্টনারের অবতার, নাম, ব্লু ব্যাজ, শেষ মেসেজ প্রিভিউ এবং আনরিড কাউন্টার।
     - **অ্যাক্টিভ কনভারসেশন চ্যাট উইন্ডো:** 
       - হেডার: পার্টনারের প্রোফাইল ও লাইভ টাইপিং ইন্ডিকেটর (`Typing...`)।
       - মেসেজ স্ট্রিম: Sent ও Received বাবল (টাইমস্ট্যাম্প সহ)।
       - ইনপুট বার: মেসেজ টেক্সটবক্স, সেন্ড বাটন (Enter এ সেন্ড) এবং টাইপিং ডিবাউন্স ট্রিগার (`POST /api/v1/conversations/{id}/typing`)।
   - Alpine.js স্টেট মেশিন (`chatDrawer()`).

3. **ইমার্জেন্সি এসওএস ড্যাঙ্গার ফ্লোটিং বাটন (Emergency SOS Widget)**:
   - ফিডের ডান পাশে একটি পালসিং লাল ইমার্জেন্সি এসওএস বাটন (`🚨 SOS Emergency Alert`).
   - ট্যাপ করলে কনফার্মেশন প্রম্পট ও জিপিএস কোঅর্ডিনেট সহ `POST /api/v1/emergency/sos` এপিআই কল।
   - লাইভ ব্রডকাস্টের জন্য ভিজ্যুয়াল ব্যানার শো করা।

4. **টেস্ট কভারেজ**:
   - `tests/Feature/SocialViewsTest.php` বা ডেডিকেটেড টেস্ট ফাইলে ড্রয়ার ও এসওএস উইজেট রেন্ডারিং নিশ্চিত করা।

---

## 📐 টেকনিক্যাল গাইডলাইন
- **ডার্ক মোড:** `#0B0F17` (Bg), `#121A29` (Container), `rgba(255, 255, 255, 0.08)` (Border), `#EF4444` (SOS Pulse Red).
- **রিঅ্যাক্টিভিটি:** Alpine.js (`x-data="chatDrawer()"`).
- **এপিআই কল:** Fetch API with `X-CSRF-TOKEN` or Sanctum bearer token from localStorage.
