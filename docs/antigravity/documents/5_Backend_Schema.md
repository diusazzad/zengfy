# 5. Backend Schema & API Specifications
## Zengfy Sovereign Ecosystem Master Landing

---

### 1. API Route Registry

The ecosystem master landing API is hosted publicly to support both the React 19 web portal and the Flutter Android mobile application:

| HTTP Method | URI | Controller Action | Description |
|---|---|---|---|
| `GET` | `/` | `LandingController@index` | Web browser SSR endpoint (renders Blade mount shell with `$initialData`) |
| `GET` | `/api/v1/ecosystem/landing` | `LandingController@data` | Dedicated public REST API payload |
| `GET` | `/api/v1/ecosystem` | `LandingController@data` | Shorthand alias for mobile API clients |

---

### 2. Complete REST API Response Schema

#### Endpoint: `GET /api/v1/ecosystem/landing`
**Header:** `Content-Type: application/json`

```json
{
  "status": "success",
  "message": "Zengfy Sovereign Ecosystem Master Landing API payload",
  "data": {
    "ecosystem": {
      "name": "Zengfy Ecosystem",
      "brand": "Zengfy",
      "tagline": "Speak Freely. One Unified Sovereign Account.",
      "description": "Bangladesh's next-generation sovereign digital infrastructure. Connect to 13 unified micro-SaaS platforms—from hyperlocal social feeds and institutional school ERP to legal vaults and retail POS—all powered by single-sign-on NID verification.",
      "version": "1.0.0",
      "base_domain": "zengfy.test"
    },
    "stats": {
      "verified_citizens": 1480,
      "total_wards": 4554,
      "active_institutions": 540,
      "system_uptime": "99.98%",
      "total_modules": 13
    },
    "modules": [
      {
        "id": "social",
        "name": "Zengfy Social",
        "category": "Civic & Social Mesh",
        "tagline": "Hyperlocal Feed, Neighborhood Groups & Civic Beacons.",
        "desc": "Verified citizen discussions, ward-level emergency SOS alerts, and end-to-end encrypted community messaging without algorithms.",
        "icon": "💬",
        "url": "http://social.zengfy.top:8000",
        "badge": "Active Module"
      },
      {
        "id": "school",
        "name": "Zengfy School",
        "category": "Education & ERP",
        "tagline": "Complete School, College & Madrasha ERP.",
        "desc": "Manage automated student admissions, RFID attendance, online report cards, teacher payroll, and SMS notifications.",
        "icon": "🏫",
        "url": "http://school.zengfy.top:8000",
        "badge": "Enterprise Ready"
      },
      {
        "id": "pos",
        "name": "Zengfy POS",
        "category": "Retail & Commerce",
        "tagline": "Fast Barcode Billing, Stock Management & Profit Analytics.",
        "desc": "Modern touch POS with multi-counter billing, thermal receipt printing, low-stock alerts, and daily sales SMS for shop owners.",
        "icon": "🛒",
        "url": "http://pos.zengfy.top:8000",
        "badge": "Retail SaaS"
      },
      {
        "id": "law",
        "name": "Zengfy Law",
        "category": "Legal & Judiciary",
        "tagline": "Case Management, Court Dates & Client File Vault.",
        "desc": "Built specifically for lawyers & law firms: track hearing schedules, client payments, court precedents, and confidential legal documents.",
        "icon": "⚖️",
        "url": "http://law.zengfy.top:8000",
        "badge": "Specialized"
      },
      {
        "id": "civil",
        "name": "Zengfy Civil",
        "category": "Engineering & Construction",
        "tagline": "Site Engineering, Material Expenses & Blueprint Vault.",
        "desc": "Track construction project budgets, site contractor payments, material wastage, and structural blueprints.",
        "icon": "🏗️",
        "url": "http://civil.zengfy.top:8000",
        "badge": "Engineering"
      },
      {
        "id": "ngo",
        "name": "Zengfy NGO",
        "category": "Charity & Relief",
        "tagline": "Transparent Donation & Relief Distribution System.",
        "desc": "Track charity donations, relief distribution to verified citizens, and manage volunteer deployment.",
        "icon": "❤️",
        "url": "http://ngo.zengfy.top:8000",
        "badge": "Non-Profit"
      },
      {
        "id": "rent",
        "name": "Zengfy Rent",
        "category": "Real Estate & Lease",
        "tagline": "Tenant NID Verification, Rent Receipt & Property Lease.",
        "desc": "Instant tenant background check, automated digital rent receipts, utility billing, and vacant flat listings.",
        "icon": "🏠",
        "url": "http://rent.zengfy.top:8000",
        "badge": "Real Estate"
      },
      {
        "id": "hotel",
        "name": "Zengfy Hotel",
        "category": "Hospitality & Booking",
        "tagline": "Room Booking, Guest Check-in & Housekeeping.",
        "desc": "Streamline room reservations, guest ID verification, invoice printing, and housekeeping shifts.",
        "icon": "🏨",
        "url": "http://hotel.zengfy.top:8000",
        "badge": "Hospitality"
      },
      {
        "id": "ecommerce",
        "name": "Zengfy Commerce",
        "category": "E-Commerce & Retail",
        "tagline": "Fast Online Storefront with Courier & Payment Gateway.",
        "desc": "Launch your branded digital shop in minutes with Steadfast/Pathao courier tracking, bKash/Nagad checkout, and inventory sync.",
        "icon": "🛍️",
        "url": "http://shop.zengfy.top:8000",
        "badge": "Online Store"
      },
      {
        "id": "skill",
        "name": "Zengfy Skill",
        "category": "LMS & Certification",
        "tagline": "Online Courses, Instructors & Skill Certifications.",
        "desc": "Host live classes, video courses, student assignments, and verified certificates.",
        "icon": "🎓",
        "url": "http://skill.zengfy.test:8000",
        "badge": "LMS Creator"
      },
      {
        "id": "journal",
        "name": "Zengfy Journal",
        "category": "Personal & Productivity",
        "tagline": "Encrypted Personal Diary, Notes & Thought Vault.",
        "desc": "Keep your daily thoughts, private notes, and personal goals protected with biometric encryption.",
        "icon": "📓",
        "url": "http://journal.zengfy.test:8000",
        "badge": "Private Vault"
      },
      {
        "id": "habit",
        "name": "Zengfy Habit",
        "category": "Productivity & Focus",
        "tagline": "Daily Routine, Habit Streaks & Focus Analytics.",
        "desc": "Track your daily rituals, building discipline with streak reminders and personal performance charts.",
        "icon": "⚡",
        "url": "http://habit.zengfy.test:8000",
        "badge": "Productivity"
      },
      {
        "id": "schedule",
        "name": "Zengfy Schedule",
        "category": "Booking & Calendar",
        "tagline": "Client Appointment Booking & Consultation Calendar.",
        "desc": "Automated calendar bookings for doctors, consultants, and coaches with SMS meeting reminders.",
        "icon": "📅",
        "url": "http://schedule.zengfy.test:8000",
        "badge": "Booking Tool"
      }
    ],
    "features": [
      {
        "key": "central_sso",
        "title": "Unified Citizen Single Sign-On",
        "tag": "One Account",
        "description": "Log in once with verified NID credentials and seamlessly access all 13 Zengfy ecosystem subdomains without re-authenticating.",
        "icon": "key"
      },
      {
        "key": "hyperlocal_mesh",
        "title": "Hyperlocal Ward Integration",
        "tag": "Civic Security",
        "description": "Automated ward-level geo-fencing connecting local businesses, civic safety beacons, and schools to their respective administrative areas.",
        "icon": "map-pin"
      },
      {
        "key": "privacy_encryption",
        "title": "Sovereign 256-Bit Data Vault",
        "tag": "Zero-Knowledge",
        "description": "End-to-end encrypted personal journals, legal files, and student records protected against corporate algorithm mining.",
        "icon": "shield-check"
      },
      {
        "key": "multi_tenant_erp",
        "title": "Autonomous Micro-SaaS Engine",
        "tag": "Instant Provisioning",
        "description": "High-throughput institutional billing, school ERP, and legal precedents with independent schema isolation.",
        "icon": "cpu-chip"
      }
    ],
    "social_preview": [
      {
        "id": 1,
        "author": "Rahim Chowdhury",
        "handle": "rahim_c",
        "avatar_bg": "bg-blue-100 text-blue-700",
        "ward": "Ward 19, Dhaka",
        "time": "10:14 AM",
        "text": "Have you tried the new sovereign ecosystem on Zengfy? One login for messaging, school ERP, and legal vault!",
        "is_outgoing": false,
        "reactions": { "❤️": 14, "🔥": 5 }
      },
      {
        "id": 2,
        "author": "Farhana Islam",
        "handle": "farhana_edu",
        "avatar_bg": "bg-indigo-100 text-indigo-700",
        "ward": "Ward 04, Chittagong",
        "time": "10:15 AM",
        "text": "Our school just migrated to Zengfy School ERP. RFID attendance and automated SMS report cards work instantly!",
        "is_outgoing": true,
        "reactions": { "👏": 22, "❤️": 9 }
      },
      {
        "id": 3,
        "author": "Barrister Tarek",
        "handle": "tarek_law",
        "avatar_bg": "bg-cyan-100 text-cyan-700",
        "ward": "Supreme Court Bar",
        "time": "10:17 AM",
        "text": "The 256-bit client encryption on Zengfy Law is game changing for confidential court precedents.",
        "is_outgoing": false,
        "reactions": { "⚖️": 18 }
      }
    ],
    "auth": {
      "is_authenticated": false,
      "user": null
    },
    "links": {
      "home": "http://zengfy.test:8000/",
      "login": "http://zengfy.test:8000/login",
      "register": "http://zengfy.test:8000/register",
      "account": "http://zengfy.test:8000/account",
      "download": "http://zengfy.test:8000/download",
      "social": "http://social.zengfy.top:8000/",
      "school": "http://school.zengfy.top:8000/",
      "api_docs": "http://zengfy.test:8000/api/v1/ecosystem/landing"
    }
  }
}
```

---

### 3. Flutter Integration Specifications
The Flutter mobile application consumes `GET /api/v1/ecosystem/landing` to construct native mobile UI components:
- **Base URL:**
  - Android Emulator: `http://10.0.2.2:8000/api/v1/ecosystem/landing`
  - Real Device / Network: `http://zengfy.test:8000/api/v1/ecosystem/landing`
- **Serialization Model:**
  ```dart
  class EcosystemResponse {
    final String status;
    final EcosystemData data;
    EcosystemResponse.fromJson(Map<String, dynamic> json);
  }
  ```
- **Zero Pricing Guarantee:** No pricing or subscription objects to parse, ensuring clean decoupled mobile performance.

---

### 4. Social Dedicated Landing API Specifications

#### 4.1 Route Registry
| HTTP Method | URI | Controller Action | Description |
|---|---|---|---|
| `GET` | `/` on `social.zengfy.top` | `SocialLandingController@index` | Web browser SSR Blade mount shell with `$initialData` |
| `GET` | `/api/v1/social/landing` | `SocialLandingController@data` | Dedicated public REST API payload |
| `GET` | `/api/v1/social` | `SocialLandingController@data` | Shorthand alias for mobile API clients |

#### 4.2 REST API Response Schema (`GET /api/v1/social/landing`)
**Header:** `Content-Type: application/json`

```json
{
  "status": "success",
  "message": "Zengfy Social Sovereign Network Landing API payload",
  "data": {
    "brand": {
      "name": "Zengfy Social",
      "tagline": "Real People. Real Communities. Zero Noise.",
      "description": "The next-generation sovereign social network for Bangladesh. Verified neighborhood discussions, civic emergency SOS beacons, and chronological friend timelines with zero algorithm manipulation and zero commercial data mining.",
      "version": "1.0.0",
      "base_domain": "zengfy.test"
    },
    "stats": {
      "verified_citizens": 1480,
      "total_wards": 4554,
      "safety_index": "99.4%",
      "active_circles": 1280
    },
    "sos_telemetry": {
      "average_response_time": "3.2s",
      "active_responders_online": 34,
      "broadcast_radius_meters": 750,
      "status": "Active Sentinel Mesh"
    },
    "streams": {
      "world": [
        {
          "id": "w1",
          "author": "Tanvir Ahmed",
          "handle": "tanvir.zengfy",
          "initials": "TA",
          "avatar_bg": "bg-blue-100 text-blue-700",
          "ward": "Dhaka Division",
          "badge": "Open Source",
          "verified": true,
          "time": "10m ago",
          "text": "Decentralized civic tech is transforming public discourse across Bangladesh. NID verification completely eliminates anonymous bot manipulation. Pure signal, zero noise.",
          "reactions": { "❤️": 48, "🔥": 16, "💡": 12 },
          "comments_count": 14
        }
      ],
      "nearby": [
        {
          "id": "n1",
          "author": "Gulshan Ward-19 Civic Desk",
          "handle": "ward19_desk",
          "initials": "W19",
          "avatar_bg": "bg-cyan-100 text-cyan-700",
          "ward": "Ward 19, Gulshan-2",
          "badge": "Civic Advisory",
          "verified": true,
          "time": "15m ago",
          "text": "Road maintenance underway along Road 103 until 4:00 PM. Please use alternate bypass lane through Lake Drive. Safe travels to all commuters!",
          "reactions": { "👏": 52, "❤️": 19 },
          "comments_count": 22
        }
      ],
      "friends": [
        {
          "id": "f1",
          "author": "Rahim Chowdhury",
          "handle": "rahim_c",
          "initials": "RC",
          "avatar_bg": "bg-amber-100 text-amber-700",
          "ward": "Dhanmondi Ward 15",
          "badge": "Close Friends",
          "verified": true,
          "time": "1h ago",
          "text": "Morning cycling ride around Dhanmondi Lake was super peaceful! Ready to plan our weekend group meetup. Who is in? 🚴‍♂️☕",
          "reactions": { "❤️": 26, "🔥": 9 },
          "comments_count": 11
        }
      ],
      "emergency_sos": [
        {
          "id": "s1",
          "author": "Ward-19 Emergency Responder Team",
          "handle": "w19_sos_mesh",
          "initials": "SOS",
          "avatar_bg": "bg-rose-100 text-rose-700",
          "ward": "Ward 19 Gulshan",
          "badge": "Active SOS Beacon",
          "verified": true,
          "time": "Active Now",
          "text": "Simulated Drill: 1-Tap SOS Beacon triggered at Lake Road. 18 Verified nearby responders received push alert within 3.2 seconds. Mesh radius: 750 meters.",
          "reactions": { "🚨": 64, "🛡️": 38 },
          "comments_count": 19
        }
      ]
    },
    "features": [
      {
        "key": "zero_algorithms",
        "title": "Zero Algorithmic Rage-Bait",
        "tag": "Pure Chronology",
        "description": "No foreign AI algorithms manipulating your emotions or selling your attention. Experience pure, chronological posts from real people you care about.",
        "icon": "sparkles"
      },
      {
        "key": "verified_identity",
        "title": "Sovereign Verified Identity",
        "tag": "Zero Bot Farms",
        "description": "Every citizen profile is cryptographically verified against national records. Complete elimination of anonymous troll armies, fake accounts, and astroturfing.",
        "icon": "shield-check"
      },
      {
        "key": "hyperlocal_mesh",
        "title": "Hyperlocal Ward Geolocation",
        "tag": "4,554 Wards",
        "description": "Automatically connects you to your union or ward community for localized civic notices, road diversions, emergency SOS alerts, and neighborhood cooperation.",
        "icon": "map-pin"
      },
      {
        "key": "encrypted_circles",
        "title": "End-to-End Encrypted Circles",
        "tag": "256-Bit Vault",
        "description": "Private group discussions and direct citizen messaging secured with client-side zero-knowledge encryption that cannot be scraped by advertising brokers.",
        "icon": "lock"
      }
    ],
    "auth": {
      "is_authenticated": false,
      "user": null
    },
    "links": {
      "home": "http://zengfy.test:8000/",
      "social": "http://social.zengfy.top:8000/",
      "feed": "http://social.zengfy.top:8000/",
      "login": "http://zengfy.test:8000/login",
      "register": "http://zengfy.test:8000/register",
      "account": "http://zengfy.test:8000/account",
      "download": "http://zengfy.test:8000/download",
      "api_docs": "http://zengfy.test:8000/api/v1/social/landing"
    }
  }
}
```

#### 4.3 Flutter Social Integration Schema
```dart
class SocialLandingResponse {
  final String status;
  final SocialLandingData data;
  SocialLandingResponse.fromJson(Map<String, dynamic> json);
}

class SocialLandingData {
  final BrandInfo brand;
  final SocialStats stats;
  final SosTelemetry sosTelemetry;
  final Map<String, List<SocialPost>> streams;
  final List<SocialFeature> features;
  final Map<String, String> links;
}
```

---

### 5. School Dedicated Landing API Specifications

#### 5.1 Route Registry
| HTTP Method | URI | Controller Action | Description |
|---|---|---|---|
| `GET` | `/` on `school.zengfy.top` | `SchoolLandingController@index` | Web browser SSR Blade mount shell with `$initialData` |
| `GET` | `/api/v1/school/landing` | `SchoolLandingController@data` | Dedicated public REST API payload |
| `GET` | `/api/v1/school` | `SchoolLandingController@data` | Shorthand alias for mobile API clients |

#### 5.2 REST API Response Schema (`GET /api/v1/school/landing`)
**Header:** `Content-Type: application/json`

```json
{
  "status": "success",
  "message": "Zengfy School Sovereign Educational Network Landing API payload",
  "data": {
    "brand": {
      "name": "Zengfy School",
      "brand": "Zengfy.School",
      "tagline": "Smart Campus. Peaceful Parents. Zero Paper.",
      "tagline_bn": "কাগজের ঝামেলাহীন আধুনিক ক্যাম্পাস। অভিভাবকের নিশ্চিন্ত ভরসা।",
      "description": "Bangladesh's next-generation sovereign school, college & madrasah management platform. Instant RFID attendance notifications, 1-click NCTB automated report cards, and transparent digital fee collection with zero paper bureaucracy.",
      "version": "1.0.0",
      "base_domain": "zengfy.test"
    },
    "stats": {
      "institutions_count": 540,
      "students_count": 180000,
      "attendance_accuracy": "99.9%",
      "wards_covered": 4554
    },
    "rfid_demo": {
      "student_name": "Soumya Ahmed (সৌম্য আহমেদ)",
      "student_id": "ZG-SCH-2026-0812",
      "class": "Class 8, Section A (Roll: 12)",
      "institution": "Motijheel Model School & College",
      "entry_time": "08:02 AM",
      "guardian_phone": "+880 1711-***892",
      "gate_id": "Main Gate RFID Scanner #01",
      "sms_text": "সৌম্য সকাল ৮:০২ মিনিটে নিরাপদে মতিঝিল মডেল স্কুল ক্যাম্পাসে প্রবেশ করেছে। (শ্রেণী: ৮ম, রোল: ১২)"
    },
    "role_journeys": [
      {
        "role": "parents",
        "title": "অভিভাবক (Parents)",
        "badge": "মানসিক প্রশান্তি",
        "icon": "heart-handshake",
        "headline": "সন্তানের ক্লাসে প্রবেশের মুহূর্তে নিশ্চিন্ত নোটিফিকেশন",
        "points": [
          "সন্তান স্কুলে ঢুকলে ও বের হলে সাথে সাথে ফোনে গ্রিন SMS নোটিফিকেশন",
          "ব্যাংকের লাইনে না দাঁড়িয়ে ১-ট্যাপে বিকাশ/নগদে টিউশন ফি পরিশোধ",
          "তাৎক্ষণিক ডিজিটাল স্ট্যাম্পড মানি রসিদ ডাউনলোড",
          "পরীক্ষার রেজাল্ট পাবলিশ হওয়ার সেকেন্ডেই ডিজিটাল প্রগ্রেস কার্ড অ্যাক্সেস"
        ]
      }
    ],
    "grading_demo": {
      "scale": "5.00 GPA",
      "subjects": [
        { "id": "bangla", "name": "বাংলা (Bangla)", "marks": 84, "max": 100 },
        { "id": "english", "name": "ইংরেজি (English)", "marks": 78, "max": 100 },
        { "id": "math", "name": "গণিত (Mathematics)", "marks": 92, "max": 100 },
        { "id": "science", "name": "বিজ্ঞান (Science)", "marks": 88, "max": 100 }
      ]
    },
    "packages": [
      {
        "id": "cloud_saas",
        "name": "রেডি ক্লাউড সাবস্ক্রিপশন (Cloud SaaS)",
        "price": "৳২,০০০",
        "period": "/মাস",
        "tag": "ছোট ও মাঝারি প্রতিষ্ঠান",
        "is_popular": true,
        "features": [
          "অল-ইন-ওয়ান রেডি ক্লাউড হোস্টিং ও অটো ব্যাকআপ",
          "১,০০০ শিক্ষার্থী পর্যন্ত আনলিমিটেড ব্যবহার",
          "অভিভাবক ও শিক্ষক মোবাইল অ্যাপ অ্যাক্সেস",
          "স্বয়ংক্রিয় SMS গেটওয়ে কানেকশন",
          "NCTB ও মাদ্রাসা রেজাল্ট অটোমেশন ইঞ্জিন",
          "নিয়মিত সিকিউরিটি ও ফিচার আপডেট"
        ],
        "cta": "শুরু করুন (Start Cloud)"
      },
      {
        "id": "one_time",
        "name": "ওয়ান-টাইম ওনারশিপ (Self-Hosted on Own Domain)",
        "price": "এককালীন ওনারশিপ",
        "period": "আজীবন ব্যবহারের লাইসেন্স",
        "tag": "প্রতিষ্ঠানের নিজস্ব ডোমেইনে",
        "is_popular": false,
        "features": [
          "প্রতিষ্ঠানের নিজস্ব ডোমেইন ও হোস্টিংয়ে সেটআপ",
          "ডাটাবেজের ১০০% নিজস্ব সার্বভৌম নিয়ন্ত্রণ",
          "জিরো মাসিক বিলিং বা মেইনটেন্যান্স ফি",
          "আনলিমিটেড শিক্ষার্থী ও শিক্ষক অ্যাকাউন্ট",
          "অফলাইন RFID গেট লোকাল সার্ভার সিঙ্ক",
          "ফুল ডাটা এক্সপোর্ট ও ব্যাকআপ কন্ট্রোল"
        ],
        "cta": "লাইসেন্স কিনুন (Buy License)"
      },
      {
        "id": "custom_enterprise",
        "name": "কাস্টম এন্টারপ্রাইজ ইআরপি (Custom Enterprise)",
        "price": "Contact Sales",
        "period": "কাস্টম কোটেশন",
        "tag": "বড় ক্যাডেট কলেজ ও চেইন",
        "is_popular": false,
        "features": [
          "মাল্টি-ক্যাম্পাস ও একাধিক ব্রাঞ্চ একীভূত ড্যাশবোর্ড",
          "কাস্টম মডিউল ডেভেলপমেন্ট ও স্পেশাল কারিকুলাম",
          "অন-সাইট স্টাফ ট্রেনিং ও ডেডিকেটেড ইঞ্জিনিয়ার",
          "কাস্টম ব্যাংকিং API ও টেলকো বাল্ক গেটওয়ে",
          "ডেডিকেটেড প্রাইভেট ক্লাউড বা অন-প্রিমিসেস সার্ভার",
          "এসএলএ সহ প্রায়োরিটি ১ জরুরি সাপোর্ট"
        ],
        "cta": "সেলস টিমের সাথে কথা বলুন (Contact Sales)"
      }
    ],
    "features": [
      {
        "key": "rfid_mesh",
        "title": "স্মার্ট আরএফআইডি গেট হাজিরা",
        "tag": "অফলাইন ব্যাকআপ",
        "description": "বিদ্যুৎ বা ইন্টারনেট চলে গেলেও অফলাইন লোকাল মেমোরিতে হাজিরা রেকর্ড থাকে এবং লাইন ফিরে আসার সাথে সাথে ব্যাকলগ সিঙ্ক হয়ে অভিভাবকদের নোটিফিকেশন পাঠায়।",
        "icon": "wifi-off"
      }
    ],
    "links": {
      "home": "http://zengfy.test:8000/",
      "school": "http://school.zengfy.top:8000/",
      "portal": "http://school.zengfy.top:8000/",
      "login": "http://zengfy.test:8000/login",
      "register": "http://zengfy.test:8000/register",
      "account": "http://zengfy.test:8000/account",
      "download": "http://zengfy.test:8000/download",
      "api_docs": "http://zengfy.test:8000/api/v1/school/landing"
    }
  }
}
```

#### 5.3 Flutter School Integration Model
```dart
class SchoolLandingResponse {
  final String status;
  final SchoolLandingData data;
  SchoolLandingResponse.fromJson(Map<String, dynamic> json);
}

class SchoolLandingData {
  final BrandInfo brand;
  final SchoolStats stats;
  final RfidDemo rfidDemo;
  final List<RoleJourney> roleJourneys;
  final GradingDemo gradingDemo;
  final List<SchoolPackage> packages;
  final List<SchoolFeature> features;
  final Map<String, String> links;
}
```
