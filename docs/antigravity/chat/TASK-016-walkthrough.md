# 🚀 TASK-016: Real-Time WebSocket Gateway (Laravel Reverb) Walkthrough

## 📌 সারসংক্ষেপ (Overview)
- **টাস্ক:** TASK-016 (Phase 5: Real-Time Messaging & Emergency SOS Danger Alert)
- **উদ্দেশ্য:** Laravel Reverb ভিত্তিক হাই-কনকারেন্সি ওয়েব-সকেট ট্রান্সপোর্ট লেয়ার, প্রাইভেট ও প্রেজেন্স চ্যানেল অথেন্টিকেশন এবং রিয়েল-টাইম ডিরেক্ট মেসেজিং এপিআই তৈরি করা।
- **স্ট্যাটাস:** 🟢 **COMPLETED & 100% PASSING (9/9 Tests Passed, 40 Assertions)**
- **প্রোজেক্টের সর্বমোট টেস্ট:** **98/98 Tests Passed (466 Assertions, 0 Failures)**

---

## 🛠️ বাস্তবায়িত আর্কিটেকচারাল কম্পোনেন্ট (Architectural Components)

### ১. ব্রডকাস্টিং কনফিগারেশন ও চ্যানেল আর্কিটেকচার
- **ফাইলসমূহ:**
  - [`config/broadcasting.php`](file:///p:/Zengfy-Ecosystem/core/config/broadcasting.php)
  - [`config/reverb.php`](file:///p:/Zengfy-Ecosystem/core/config/reverb.php)
  - [`routes/channels.php`](file:///p:/Zengfy-Ecosystem/core/routes/channels.php)
  - [`bootstrap/app.php`](file:///p:/Zengfy-Ecosystem/core/bootstrap/app.php)
- **চ্যানেলসমূহ:**
  - `private-chat.{conversationId}`: কঠোরভাবে সংরক্ষিত চ্যাট রুম চ্যানেল। কেবল ঐ কথোপকথনের অংশগ্রহণকারী ইউজাররাই চ্যানেল জয়েন ও মেসেজ শুনতে পারে।
  - `private-users.{id}`: ইউজারের একক প্রাইভেট চ্যানেল (ডাইরেক্ট অ্যালার্ট, ইমার্জেন্সি পুশ নোটিফিকেশন)।
  - `presence-presence.ward.{wardCode}`: হাইপারলোকাল প্রেজেন্স চ্যানেল যা নির্দিষ্ট ওয়ার্ডের অনলাইন নাগরিকদের ট্র্যাক করে এবং ইউজার ইনফো প্রদান করে।

### ২. ডাটাবেজ মডেল ও মাইগ্রেশন
- **ফাইল:** [`Modules/Social/database/migrations/2026_09_23_000035_create_conversations_table.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/database/migrations/2026_09_23_000035_create_conversations_table.php)
- **টেবিলসমূহ:**
  - `conversations`: টাইপ (`direct`, `group`), `last_message_at` টাইমস্ট্যাম্প।
  - `conversation_participants`: ইউজার ও চ্যাটের লিঙ্ক, `last_read_at` টাইমস্ট্যাম্প (ইউনিক ইনডেক্স সহ)।
  - `messages`: বডি, মেসেজ টাইপ (`text`, `image`, `sos_alert`), মেটাডাটা JSON, রিড স্ট্যাটাস এবং হাই-কনকারেন্সি কীসেট ইনডেক্স `['conversation_id', 'created_at', 'id']`।

### ৩. রিয়েল-টাইম ব্রডকাস্ট ইভেন্টস
- **`MessageSent`:** `PrivateChannel('chat.' . $conversationId)` চ্যানেলে তাত্ক্ষণিক মেসেজ ব্রডকাস্ট করে (`broadcastAs: 'message.sent'`)।
- **`UserTyping`:** লাইভ টাইপিং ইন্ডিকেটর ব্রডকাস্ট করে (`broadcastAs: 'user.typing'`)।

### ৪. সার্ভিস ও কন্ট্রোলার লেয়ার
- **সার্ভিস:** [`Modules/Social/app/Services/MessagingService.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Services/MessagingService.php)
  - ১-অন-১ চ্যাট তৈরি বা পুনরুদ্ধার (`getOrCreateDirectConversation`)।
  - ট্রান্সঅ্যাকশন-সেফ মেসেজ পাঠানো ও ব্রডকাস্ট ডিসপ্যাচ (`sendMessage`)।
  - কীসেট কার্সার প্যাজিনেশনে মেসেজ হিস্ট্রি তুলে আনা (`getConversationMessages`)।
  - আনরিড মেসেজ কাউন্টার ও চ্যাট পার্টনার ইনফো সহ ডায়লগ লিস্ট (`getUserConversations`)।
  - লাইভ টাইপিং স্টেট ও রিড স্ট্যাটাস পরিচালনা।
- **কন্ট্রোলার:** [`Modules/Social/app/Http/Controllers/ConversationController.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Http/Controllers/ConversationController.php)

---

## 🧪 টেস্ট কভারেজ (`RealTimeMessagingTest.php`)
- **ফাইল:** [`Modules/Social/tests/Feature/RealTimeMessagingTest.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/tests/Feature/RealTimeMessagingTest.php)
- **পাসকৃত টেস্টসমূহ:**
  1. `two_citizens_can_start_or_retrieve_direct_conversation` ✓
  2. `citizen_cannot_start_direct_conversation_with_themselves` ✓
  3. `participant_can_send_message_and_broadcast_message_sent_event` ✓
  4. `non_participant_cannot_send_message_or_view_messages` ✓
  5. `messages_endpoint_supports_keyset_cursor_pagination` ✓
  6. `participant_can_broadcast_typing_indicator` ✓
  7. `participant_can_mark_conversation_as_read` ✓
  8. `conversations_index_lists_active_conversations_with_partner_and_unread_counts` ✓
  9. `websocket_channel_authorizations_protect_private_and_presence_channels` ✓
