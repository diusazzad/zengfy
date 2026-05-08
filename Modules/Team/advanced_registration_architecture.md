# 🏛️ Advanced Multi-Database Registration Architecture
**ZenGfy Social Core: Scalability for Millions of Users**

বড় বড় টেক জায়ান্টরা (যেমন Meta, Google, Amazon) কীভাবে তাদের রেজিস্ট্রেশন সিস্টেম ডিজাইন করে, এটি তার একটি প্রফেশনাল ব্লুপ্রিন্ট।

---

## 1. 🔑 Auth vs. Profile Database Separation
ইন্ডাস্ট্রি স্ট্যান্ডার্ড অনুযায়ী, ইউজারের **Authentication Data** (Email, Password, Token) এবং **Profile Data** (Bio, Posts, Settings) আলাদা ডাটাবেসে রাখা হয়।

### কেন এটি করা হয়?
- **Security:** অথেনটিকেশন ডাটাবেস অনেক বেশি সিকিউর এবং রেস্ট্রিক্টেড থাকে।
- **Performance:** অথেনটিকেশন রিড অনেক ফাস্ট হতে হয়, অন্যদিকে প্রোফাইল ডাটাবেস রাইট-হেভি হতে পারে।

---

## 2. 🗺️ Database Sharding (Horizontal Scaling)
যখন ১টি ডাটাবেসে কোটি কোটি ইউজারের ডেটা রাখা সম্ভব হয় না, তখন আমরা **Sharding** ব্যবহার করি।

### Sharding Logic:
- **Shard A:** ইউজার আইডি ১ থেকে ১০ লক্ষ।
- **Shard B:** ইউজার আইডি ১০ লক্ষ ১ থেকে ২০ লক্ষ।
ইউজার যখন লগইন করে, সিস্টেম তার `user_id` দেখে ডিসাইড করে সে কোন ডাটাবেস সার্ভার থেকে ডেটা রিড করবে।

---

## 3. 🔄 Read/Write Splitting
- **Primary (Master):** সব নতুন রেজিস্ট্রেশন এবং প্রোফাইল আপডেট এখানে হয়।
- **Replicas (Slaves):** ইউজার যখন তার প্রোফাইল দেখে বা সার্চ করে, তখন এই ডাটাবেসগুলো ব্যবহৃত হয়। এটি মেইন ডাটাবেসের ওপর লোড কমায়।

---

## 4. 🧪 Saga Pattern (Distributed Transactions)
মাল্টিপল ডাটাবেসে ডেটা সেভ করার সময় যদি একটি ফেল করে, তবে পুরো প্রসেস রোলব্যাক করার জন্য **Saga Pattern** ব্যবহার করা হয়। এটি নিশ্চিত করে যে আপনার ডেটা কখনো "Inconsistent" হবে না।

---

## 5. 💻 Laravel Implementation Example

লারাভেলে আমরা কীভাবে মাল্টিপল কানেকশন ব্যবহার করে রেজিস্ট্রেশন হ্যান্ডেল করি:

### Step 1: `config/database.php` কনফিগারেশন
```php
'connections' => [
    'auth_db' => [
        'driver' => 'mysql',
        'database' => 'zengfy_auth',
        // other settings...
    ],
    'profile_shard_1' => [
        'driver' => 'mysql',
        'database' => 'zengfy_profile_1',
        // other settings...
    ],
],
```

### Step 2: Controller/Action এ ব্যবহার
```php
public function register(array $data) {
    // ১. অথেনটিকেশন ডাটাবেসে ইউজার সেভ করা
    $user = User::on('auth_db')->create([
        'email' => $data['email'],
        'password' => bcrypt($data['password']),
    ]);

    // ২. শার্ডিং লজিক অনুযায়ী প্রোফাইল ডাটাবেস সিলেক্ট করা
    $shard = ($user->id % 2 == 0) ? 'profile_shard_1' : 'profile_shard_2';

    // ৩. প্রোফাইল ডাটাবেসে ডেটা সেভ করা
    UserProfile::on($shard)->create([
        'user_id' => $user->id,
        'full_name' => $data['name'],
    ]);
}
```

---

## 6. 🚀 Event-Driven Registration Hooks
রেজিস্ট্রেশন শেষ হওয়ার পর সরাসরি কোড রান না করে ইভেন্ট কিউ (Queue) তে পাঠানো হয়:
1. `UserRegistered` ইভেন্ট ফায়ার হয়।
2. `WelcomeEmailListener` ইভেন্টটি রিসিভ করে ইমেইল পাঠায়।
3. `TrustScoreListener` ইনিশিয়াল ট্রাস্ট স্কোর সেট করে।
4. `SearchIndexListener` ইউজারকে সার্চ ইঞ্জিনে অ্যাড করে।

> [!TIP]
> এটি সিস্টেমকে অনেক ফাস্ট রাখে কারণ ইউজারকে ইমেইল যাওয়া পর্যন্ত অপেক্ষা করতে হয় না।

---
*Created by: Antigravity AI Architecture Team*
