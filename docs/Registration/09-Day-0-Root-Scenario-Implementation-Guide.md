# মডিউল ০৯: ডে ০ রুট সিনারিও ইমপ্লিমেন্টেশন গাইড (Step-by-Step Code Guide)

> [⬅️ পূর্ববর্তী মডিউল](08-IT-Company-Roles-And-Engineering-Workflow.md) | [📖 মূল সূচিপত্র (README)](./README.md) | [পরবর্তী মডিউল ➡️](10-Testing-QA-And-DevOps-Runbook.md)


> **লক্ষ্য:** ডে ০-এর জন্য প্রয়োজনীয় ৩টি ফিল্ডের (Full Name, Email, Password) ব্যাকএন্ড আর্কিটেকচার, ক্রিপ্টোগ্রাফিক ভেরিফিকেশন সার্ভিস এবং প্রিমিয়াম মোবাইল-ফ্রেন্ডলি ফ্রন্টএন্ড কোড তৈরি করা।

---

## ১. ব্যাকএন্ড সার্ভিস লেয়ার (Node.js / Express / TypeScript)

আমরা ক্লিন আর্কিটেকচার বজায় রেখে কোড লিখব।

### ১.১ ভ্যালিডেশন রুলস (`validators/register.validator.ts`)
```typescript
import { z } from 'zod';

// ডিসপোজেবল ডোমেইন তালিকা
const BLACKLISTED_DOMAINS = ['10minutemail.com', 'tempmail.com', 'mailinator.com', 'yopmail.com'];

export const RegisterSchema = z.object({
  fullName: z
    .string()
    .min(2, { message: 'নাম কমপক্ষে ২ অক্ষরের হতে হবে।' })
    .max(100, { message: 'নাম ১০০ অক্ষরের বেশি হতে পারবে না।' })
    .trim(),
  email: z
    .string()
    .email({ message: 'একটি বৈধ ইমেইল ঠিকানা প্রদান করুন।' })
    .trim()
    .toLowerCase()
    .refine((email) => {
      const domain = email.split('@')[1];
      return !BLACKLISTED_DOMAINS.includes(domain);
    }, { message: 'অস্থায়ী বা ডিসপোজেবল ইমেইল দিয়ে একাউন্ট খোলা যাবে না।' }),
  password: z
    .string()
    .min(8, { message: 'পাসওয়ার্ড কমপক্ষে ৮ অক্ষরের হতে হবে।' })
    .regex(/[A-Z]/, { message: 'পাসওয়ার্ডে অন্তত একটি বড় হাতের অক্ষর (A-Z) থাকতে হবে।' })
    .regex(/[0-9]/, { message: 'পাসওয়ার্ডে অন্তত একটি সংখ্যা (0-9) থাকতে হবে।' })
});
```

### ১.২ রেজিস্ট্রেশন সার্ভিস (`services/auth.service.ts`)
```typescript
import argon2 from 'argon2';
import crypto from 'crypto';
import { db } from '../config/database';

export class AuthService {
  /**
   * ডে ০ মিনিমালিস্ট রেজিস্ট্রেশন প্রসেস
   */
  async registerUser(data: { fullName: string; email: string; password: string }) {
    return await db.transaction(async (trx) => {
      // ১. ইমেইল পূর্বে ব্যবহৃত হয়েছে কি না চেক
      const existing = await trx('users').where({ email: data.email }).first();
      if (existing) {
        throw new Error('এই ইমেইল দিয়ে ইতোমধ্যে একাউন্ট খোলা হয়েছে।');
      }

      // ২. আধুনিক Argon2id দিয়ে পাসওয়ার্ড হ্যাশ করা
      const passwordHash = await argon2.hash(data.password, {
        type: argon2.argon2id,
        memoryCost: 65536, // 64 MB
        timeCost: 3,
        parallelism: 4
      });

      // ৩. ইউজার টেবিলে ডাটা ইনসার্ট করা
      const [newUser] = await trx('users')
        .insert({
          full_name: data.fullName,
          email: data.email,
          password_hash: passwordHash,
          status: 'PENDING_VERIFICATION'
        })
        .returning(['id', 'full_name', 'email']);

      // ৪. ক্রিপ্টোগ্রাফিক হাই-এনট্রপি ভেরিফিকেশন টোকেন তৈরি
      const rawToken = crypto.randomBytes(32).toString('hex');
      const tokenHash = crypto.createHash('sha256').update(rawToken).digest('hex');

      // ২৪ ঘণ্টার মেয়াদ নির্ধারণ
      const expiresAt = new Date(Date.now() + 24 * 60 * 60 * 1000);

      // ৫. হ্যাশ সংরক্ষণ
      await trx('email_verification_tokens').insert({
        user_id: newUser.id,
        token_hash: tokenHash,
        expires_at: expiresAt
      });

      // ৬. সিকিউর ভেরিফিকেশন ইউআরএল তৈরি (ইউজারের জন্য)
      const verifyUrl = `${process.env.APP_URL}/api/v1/auth/verify-email?token=${rawToken}&userId=${newUser.id}`;

      // ৭. ব্যাকগ্রাউন্ড কিউ-তে ইমেইল পাঠানোর ইভেন্ট পুশ করা
      await emailQueue.add('SendVerificationEmail', {
        to: newUser.email,
        name: newUser.full_name,
        verifyUrl: verifyUrl
      });

      return {
        success: true,
        message: 'রেজিস্ট্রেশন সফল হয়েছে! দয়া করে আপনার ইমেইল চেক করে একাউন্ট ভেরিফাই করুন।',
        user: { id: newUser.id, email: newUser.email }
      };
    });
  }

  /**
   * ইমেইল ভেরিফিকেশন টোকেন হ্যান্ডলার
   */
  async verifyEmailToken(userId: string, rawToken: string) {
    const tokenHash = crypto.createHash('sha256').update(rawToken).digest('hex');

    const tokenRecord = await db('email_verification_tokens')
      .where({
        user_id: userId,
        token_hash: tokenHash,
        consumed_at: null
      })
      .andWhere('expires_at', '>', new Date())
      .first();

    if (!tokenRecord) {
      throw new Error('ভেরিফিকেশন লিংকটি ভুল অথবা এর মেয়াদ শেষ হয়ে গেছে।');
    }

    await db.transaction(async (trx) => {
      // টোকেন কনজিউম করা
      await trx('email_verification_tokens')
        .where({ id: tokenRecord.id })
        .update({ consumed_at: new Date() });

      // ইউজারকে সক্রিয় করা
      await trx('users')
        .where({ id: userId })
        .update({
          status: 'ACTIVE',
          email_verified_at: new Date()
        });
    });

    return { success: true, message: 'অভিনন্দন! আপনার ইমেইল সফলভাবে ভেরিফাইড হয়েছে।' };
  }
}
```

---

## ২. ফ্রন্টএন্ড ফর্ম ইমপ্লিমেন্টেশন (Tailwind CSS + Mobile Responsive)

মোবাইল স্ক্রিনে যাতে এক ফোঁটাও স্ক্রল না করে এক ক্লিকে সাইন-আপ করা যায়, তার জন্য একটি প্রিমিয়াম ফর্ম:

```html
<div class="min-h-screen bg-slate-50 flex items-center justify-center p-4 sm:p-6 font-sans">
  <div class="w-full max-w-md bg-white rounded-3xl shadow-xl border border-slate-100 p-6 sm:p-8">
    
    <!-- হেডার -->
    <div class="text-center mb-6">
      <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-md">
        <span class="text-white text-2xl font-black">Z</span>
      </div>
      <h2 class="text-2xl font-black text-slate-900 tracking-tight">নতুন একাউন্ট খুলুন</h2>
      <p class="text-xs text-slate-500 mt-1 font-medium">Zengfy Sovereign প্ল্যাটফর্মে আপনাকে স্বাগতম</p>
    </div>

    <!-- গুগল ওয়ান-ট্যাপ অলটারনেটিভ বাটন -->
    <button type="button" class="w-full flex items-center justify-center gap-2.5 py-2.5 px-4 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-bold transition-all shadow-xs mb-5">
      <svg class="w-4 h-4" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/></svg>
      Google দিয়ে সরাসরি শুরু করুন
    </button>

    <div class="relative flex items-center justify-center my-4">
      <div class="border-t border-slate-200 w-full"></div>
      <span class="bg-white px-3 text-[11px] font-bold text-slate-400 uppercase tracking-wider">অথবা ইমেইল দিয়ে</span>
    </div>

    <!-- ফর্ম (কেবল ৩টি ফিল্ড) -->
    <form id="regForm" class="space-y-4">
      <!-- ফিল্ড ১: পুরো নাম -->
      <div>
        <label for="fullName" class="block text-xs font-bold text-slate-700 mb-1">পুরো নাম (Full Name)</label>
        <input type="text" id="fullName" name="fullName" required placeholder="মোঃ সাজ্জাদ হোসেন"
               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
      </div>

      <!-- ফিল্ড ২: ইমেইল ঠিকানা -->
      <div>
        <label for="email" class="block text-xs font-bold text-slate-700 mb-1">ইমেইল ঠিকানা (Email Address)</label>
        <input type="email" id="email" name="email" required placeholder="name@example.com"
               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
      </div>

      <!-- ফিল্ড ৩: পাসওয়ার্ড -->
      <div>
        <label for="password" class="block text-xs font-bold text-slate-700 mb-1">পাসওয়ার্ড (Password)</label>
        <input type="password" id="password" name="password" required placeholder="কমপক্ষে ৮ অক্ষর (A-Z ও সংখ্যা)"
               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
        <!-- লাইভ পাসওয়ার্ড স্ট্রেন্থ বার -->
        <div class="w-full bg-slate-100 h-1.5 rounded-full mt-2 overflow-hidden">
          <div id="strengthBar" class="h-full w-1/4 bg-red-500 transition-all duration-300"></div>
        </div>
      </div>

      <!-- সাবমিট বাটন -->
      <button type="submit" id="submitBtn"
              class="w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 active:scale-[0.98] text-white text-xs font-bold rounded-xl shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2">
        <span>একাউন্ট তৈরি করুন</span>
      </button>

      <!-- টার্মস ও লিগ্যাল নোটিশ -->
      <p class="text-[10px] text-center text-slate-400 mt-4 leading-relaxed">
        রেজিস্ট্রেশন সম্পন্ন করার মাধ্যমে আপনি আমাদের <a href="#" class="text-blue-600 underline">ব্যবহারের শর্তাবলী</a> এবং <a href="#" class="text-blue-600 underline">গোপনীয়তা নীতি</a> মেনে নিচ্ছেন।
      </p>
    </form>

  </div>
</div>
```

---


> [⬅️ পূর্ববর্তী মডিউল](08-IT-Company-Roles-And-Engineering-Workflow.md) | [📖 মূল সূচিপত্র (README)](./README.md) | [পরবর্তী মডিউল ➡️](10-Testing-QA-And-DevOps-Runbook.md)

