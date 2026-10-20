# মডিউল ১০: টেস্টিং, কিউএ ও ডেভঅপস রানবুক (Testing, QA & DevOps Runbook)

> [⬅️ পূর্ববর্তী মডিউল](09-Day-0-Root-Scenario-Implementation-Guide.md) | [📖 মূল সূচিপত্র (README)](./README.md)


> **লক্ষ্য:** অটোমেটেড ইউনিট টেস্ট, সিকিউরিটি পেন-টেস্টিং, লোকাল ডকার এনভায়রনমেন্ট এবং প্রডাকশন ইনসিডেন্ট রেসপন্স প্রস্তুত করা।

---

## ১. অটোমেটেড ইন্টিগ্রেশন টেস্ট কেসেস (Jest / Vitest)

```typescript
import request from 'supertest';
import { app } from '../app';
import { db } from '../config/database';

describe('Auth Registration Integration Tests', () => {
  beforeEach(async () => {
    await db('email_verification_tokens').truncate();
    await db('users').del();
  });

  test('পজিটিভ টেস্ট: বৈধ ৩টি ফিল্ড দিলে সফলভাবে 201 Created হবে', async () => {
    const res = await request(app)
      .post('/api/v1/auth/register')
      .send({
        fullName: 'সাজ্জাদ হোসেন',
        email: 'sazzad@zengfy.com',
        password: 'Password123'
      });

    expect(res.status).toBe(201);
    expect(res.body.success).toBe(true);
    expect(res.body.user.email).toBe('sazzad@zengfy.com');
  });

  test('নেগেটিভ টেস্ট: পূর্বে ব্যবহৃত ইমেইল দিলে 400 এরর দেবে', async () => {
    await request(app).post('/api/v1/auth/register').send({
      fullName: 'ইউজার ১',
      email: 'duplicate@zengfy.com',
      password: 'Password123'
    });

    const res = await request(app).post('/api/v1/auth/register').send({
      fullName: 'ইউজার ২',
      email: 'duplicate@zengfy.com',
      password: 'Password123'
    });

    expect(res.status).toBe(400);
    expect(res.body.message).toContain('ইতোমধ্যে একাউন্ট খোলা হয়েছে');
  });

  test('সিকিউরিটি টেস্ট: ডিসপোজেবল ইমেইল স্বয়ংক্রিয়ভাবে ব্লক করবে', async () => {
    const res = await request(app).post('/api/v1/auth/register').send({
      fullName: 'বোট ইউজার',
      email: 'spammer@10minutemail.com',
      password: 'Password123'
    });

    expect(res.status).toBe(400);
    expect(res.body.message).toContain('ডিসপোজেবল ইমেইল');
  });
});
```

---

## ২. সম্পূর্ণ লোকাল ডকার ডেভেলপমেন্ট পরিবেশ (`docker-compose.yml`)

বিনা খরচে এবং কোনো আসল ইমেইল না পাঠিয়ে নিজের কম্পিউটারে ইমেইল ভিউ ও টেস্টিং করার জন্য Mailhog সহ ডকার সেটআপ:

```yaml
version: '3.8'

services:
  # ১. পোস্টগ্রেস ডেটাবেজ
  postgres:
    image: postgres:16-alpine
    container_name: zengfy-postgres
    environment:
      POSTGRES_DB: zengfy_core
      POSTGRES_USER: zengfy_user
      POSTGRES_PASSWORD: secret_password
    ports:
      - "5432:5432"
    volumes:
      - pgdata:/var/lib/postgresql/data

  # ২. রেডিস (রেট লিমিট ও ক্যাশিং)
  redis:
    image: redis:7-alpine
    container_name: zengfy-redis
    ports:
      - "6379:6379"

  # ৩. মেইলহগ (ফ্রি লোকাল SMTP সার্ভার)
  # এটি কোনো আসল মেইল পাঠায় না, ব্রাউজারে http://localhost:8025 এ সুন্দর ইনবক্স ভিউ দেয়!
  mailhog:
    image: mailhog/mailhog:latest
    container_name: zengfy-mailhog
    ports:
      - "1025:1025" # SMTP পোর্ট
      - "8025:8025" # ব্রাউজার ওয়েব UI পোর্ট

volumes:
  pgdata:
```

---

## ৩. ইনসিডেন্ট রেসপন্স ও ট্রাবলশুটিং রানবুক (DevOps SRE Guide)

### সমস্যা ১: ইউজারের কাছে ভেরিফিকেশন ইমেইল পৌঁছাচ্ছে না
1. **চেক ১:** Redis কিউ-তে কোনো জব জমে আছে কি না দেখুন: `redis-cli llen bull:emailQueue:wait`
2. **চেক ২:** ডোমেইনের SPF ও DKIM ভ্যালিডেশন চেক করুন: `dig txt zengfy.top +short`
3. **চেক ৩:** ইমেইল লগ দেখতে মেলারের কনটেইনার লগ চালান: `docker logs zengfy-mailhog`

### সমস্যা ২: রেজিস্ট্রেশনে বোট অ্যাটাক বা হঠাৎ স্পাইক
1. Cloudflare WAF-এ গিয়ে `/api/v1/auth/register` রুটের জন্য "Under Attack Mode" চালু করুন।
2. Redis স্লাইডিং উইন্ডো লিমিট সাময়িকভাবে ৫ থেকে নামিয়ে ২-এ সেট করুন।

---


> [⬅️ পূর্ববর্তী মডিউল](09-Day-0-Root-Scenario-Implementation-Guide.md) | [📖 মূল সূচিপত্র (README)](./README.md)

