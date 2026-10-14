// Fallback offline mock dataset for guaranteed zero-break rendering
export const FALLBACK_POS_DATA = {
    brand: {
        name: "Zengfy POS",
        brand: "Zengfy.POS",
        tagline: "Fashion Retail POS. Barcode Matrix. 2-Second Checkout.",
        tagline_bn: "গার্মেন্টস, বুটিক ও শপিং মল রিটেইলের জন্য সুপারফাস্ট বারকোড পিওএস ও ইনভেন্টরি ইআরপি।",
        description: "Bangladesh's premier sovereign retail ERP tailored for boutiques, clothing showrooms, and shopping mall fashion brands. Instant color/size variant barcode billing, thermal receipt printing, automated due ledger (Baki Khata) with bKash SMS recovery, and 1-click live Zengfy Social ShopWindow.",
        version: "1.0.0",
        base_domain: "zengfy.test",
    },
    stats: {
        active_showrooms: "1,280+",
        daily_bills_processed: "480,000+",
        avg_checkout_speed: "1.8s",
        sms_recovery_rate: "91.4%",
        wards_covered: 4554,
    },
    simulator: {
        store_name: "Royal Heritage Boutique & Fashion",
        store_address: "Shop #402, Level 4, Jamuna Future Park, Dhaka",
        cashier: "Tanvir Hasan",
        inventory: [
            {
                id: "prod-1",
                name: "Premium Panjabi (Linen Cotton)",
                name_bn: "প্রিমিয়াম লিনেন কটন পাঞ্জাবি",
                sku: "PAN-2026-LNN",
                barcode: "894120260101",
                category: "Men Ethnic Wear",
                price: 2450,
                cost: 1650,
                variants: [
                    { size: "38", color: "Navy Blue", stock: 14 },
                    { size: "40", color: "Navy Blue", stock: 22 },
                    { size: "42", color: "White", stock: 8 },
                    { size: "44", color: "Maroon", stock: 6 },
                ],
                tag: "Best Seller",
            },
            {
                id: "prod-2",
                name: "Designer Georgette Three-Piece",
                name_bn: "ডিজাইনার জর্জেট থ্রি-পিস",
                sku: "TPC-GEO-DSG",
                barcode: "894120260205",
                category: "Women Festive",
                price: 3850,
                cost: 2700,
                variants: [
                    { size: "Free Size", color: "Pastel Pink", stock: 11 },
                    { size: "Free Size", color: "Sage Green", stock: 9 },
                    { size: "Free Size", color: "Lavender", stock: 4 },
                ],
                tag: "Trending",
            },
            {
                id: "prod-3",
                name: "Slim-Fit Stretch Denim Jeans",
                name_bn: "স্লিম-ফিট স্ট্রেচ ডেনিম জিন্স",
                sku: "DNM-SLM-09",
                barcode: "894120260312",
                category: "Men Casual",
                price: 1950,
                cost: 1250,
                variants: [
                    { size: "30", color: "Indigo Blue", stock: 18 },
                    { size: "32", color: "Indigo Blue", stock: 25 },
                    { size: "34", color: "Jet Black", stock: 15 },
                    { size: "36", color: "Vintage Grey", stock: 7 },
                ],
                tag: "Essential",
            },
            {
                id: "prod-4",
                name: "Drop-Shoulder Casual Polo",
                name_bn: "ড্রপ-শোল্ডার ক্যাজুয়াল পোলো টি-শার্ট",
                sku: "POLO-DRP-04",
                barcode: "894120260488",
                category: "Unisex Streetwear",
                price: 850,
                cost: 520,
                variants: [
                    { size: "M", color: "Olive Green", stock: 35 },
                    { size: "L", color: "Jet Black", stock: 42 },
                    { size: "XL", color: "Mustard Yellow", stock: 18 },
                    { size: "XXL", color: "Jet Black", stock: 5 },
                ],
                tag: "Fast Moving",
            },
        ],
        sample_due_entry: {
            customer_name: "Mohammad Rahim Uddin",
            phone: "01712-498123",
            ward: "Ward 19, Gulshan, Dhaka",
            due_amount: 1750,
            last_purchase: "Yesterday, 07:45 PM",
            sms_status: "bKash Payment Link Sent via SMS",
        },
    },
    stakeholders: [
        {
            id: "owner",
            title: "Boutique & Showroom Owner",
            title_bn: "শোরুম ও বুটিক মালিক",
            role_desc: "মালিকের হাতের মুঠোয় লাইভ সেলস, নেট প্রফিট ও অটোমেটিক অ্যান্টি-থেফট অডিট",
            avatar: "👔",
            benefits: [
                "মোবাইলে রিয়েল-টাইম লাইভ সেলস ও আজকের নিট প্রফিট নোটিফিকেশন",
                "বারকোড স্ক্যান ছাড়া কোনো মাল বিক্রি অসম্ভব—ক্যাশিয়ার চুরি ও হিসাবের অমিল ১০০% বন্ধ",
                "মাসিক ভ্যাট ও বিক্রয় রিপোর্ট ১-ক্লিকে এক্সেল বা পিডিএফে এক্সপোর্ট",
                "বকেয়া টাকার জন্য খরিদ্দারের সাথে ঝামেলাহীন অটোমেটিক bKash/Nagad SMS তাগাদা",
            ],
        },
        {
            id: "cashier",
            title: "Cash Counter Executive",
            title_bn: "ক্যাশ কাউন্টার এক্সিকিউটিভ",
            role_desc: "পিক আওয়ারেও কোনো দীর্ঘ লাইন নেই—১.৮ সেকেন্ডে ভুলমুক্ত বারকোড মেমো",
            avatar: "💻",
            benefits: [
                "যেকোনো হ্যান্ডহেল্ড ইউএসবি/ব্লুটুথ বারকোড স্ক্যানারে ১.৮ সেকেন্ডে পণ্য যুক্ত",
                "ক্যাশ, কার্ড ও বিকাশ কিউআর স্প্লিট পেমেন্ট সমর্থন (অর্ধেক ক্যাশ, বাকি বিকাশ)",
                "৩-ইঞ্চি থার্মাল রসিদ প্রিন্টার বা হোয়াটসঅ্যাপ ডিজিটাল স্লিপ অটো জেনারেশন",
                "হাতে গোনার ঝামেলা শেষ—ডিসকাউন্ট ও অফার কুপন অটোমেটিক ক্যালকুলেশন",
            ],
        },
        {
            id: "inventory",
            title: "Inventory & Floor Manager",
            title_bn: "স্টক ও গোডাউন ইনচার্জ",
            role_desc: "সাইজ ও কালার ম্যাট্রিক্সসহ নিখুঁত স্টক ট্র্যাকিং—স্টক-আউট হওয়ার আগেই অটো রিকুইজিশন",
            avatar: "📦",
            benefits: [
                "গার্মেন্টস কালার-সাইজ ম্যাট্রিক্স (S, M, L, XL, XXL) অনুযায়ী পৃথক বারকোড লেবেল প্রিন্টিং",
                "কোনো নির্দিষ্ট সাইজ বা কালার শেষ হয়ে এলে তাত্ক্ষণিক লো-স্টক পুশ অ্যালার্ট",
                "সাপ্লায়ার পারচেজ অর্ডার (PO) ও লট চালান ট্র্যাকিং সরাসরি সিস্টেমে",
                "ডেড স্টক বা অবিক্রিত পণ্যের তালিকা শনাক্ত করে সময়মতো ডিসকাউন্ট অফার নির্ধারণ",
            ],
        },
        {
            id: "buyer",
            title: "Retail Fashion Shopper",
            title_bn: "ফ্যাশন ক্রেতা ও খদ্দের",
            role_desc: "হাতে হাতে ডিজিটাল মেমো, সহজ এক্সচেঞ্জ ও ক্যাশলেস পেয়ারিং সুবিধা",
            avatar: "🛍️",
            benefits: [
                "কাউন্টার থেকে মুহূর্তেই মোবাইলে এসএমএস বা কিউআর কোড ডিজিটাল ক্যাশমেমো প্রাপ্তি",
                "সাইজ পরিবর্তন বা এক্সচেঞ্জের জন্য কাগজের মেমো হারানো কোনো সমস্যাই নয়",
                "Zengfy Social-এ লগইন থাকা অবস্থায় স্থানীয় পছন্দের বুটিক শপের নতুন কালেকশন দেখা",
                "ভেরিফাইড কাস্টমার প্রোফাইলে বিশ্বস্ত কেনাকাটায় লয়্যালটি রিওয়ার্ড পয়েন্টস",
            ],
        },
    ],
    pillars: [
        {
            id: "barcode_checkout",
            icon: "barcode",
            title: "1.8s Ultra-Fast Barcode Billing",
            title_bn: "১.৮ সেকেন্ডের সুপারফাস্ট বারকোড ক্যাশ কাউন্টার",
            desc: "যেকোনো ইউএসবি, ব্লুটুথ বারকোড স্ক্যানার বা অ্যান্ড্রয়েড স্মার্টফোন ক্যামেরায় ১.৮ সেকেন্ডে ভুলমুক্ত মেমো ও থার্মাল রসিদ প্রিন্ট। পিক আওয়ারে লাইনের ভিড় শূন্যে নামিয়ে আনে।",
            badge: "Instant Checkout",
        },
        {
            id: "variant_matrix",
            icon: "layers",
            title: "Apparel Color & Size Matrix Inventory",
            title_bn: "ফ্যাশন কালার ও সাইজ ম্যাট্রিক্স ইনভেন্টরি",
            desc: "একটি পাঞ্জাবি বা শার্টের ১০টি কালার ও ৫টি সাইজের জন্য আলাদা জটিল এন্ট্রি নয়—এক ক্লিকে ফুল কালার-সাইজ ম্যাট্রিক্স বারকোড জেনারেট করুন এবং নিখুঁত গোডাউন স্টক ট্র্যাক করুন।",
            badge: "Variant Engine",
        },
        {
            id: "due_ledger_sms",
            icon: "credit-card",
            title: "Smart Due Ledger & Automated SMS Recovery",
            title_bn: "ডিজিটাল বাকি খাতা ও অটোমেটিক বিকাশ SMS তাগাদা",
            desc: "কাগজে বাকি লেখার দিন শেষ। খরিদ্দারের ফোন নম্বর এন্ট্রি করলেই বকেয়ার ডিজিটাল খাতা প্রস্তুত। নির্দিষ্ট তারিখে স্বয়ংক্রিয়ভাবে bKash পেমেন্ট লিংকসহ সুন্দর ভদ্র SMS প্রেরিত হয়।",
            badge: "Zero Bad Debt",
        },
        {
            id: "social_shopwindow",
            icon: "globe",
            title: "Zengfy Social Sovereign ShopWindow",
            title_bn: "Zengfy সোশ্যাল ১-ক্লিক লাইভ শপউইন্ডো",
            desc: "আপনার পিওএস ইনভেন্টরির স্টক Zengfy Social-এর স্থানীয় ক্রেতা ডিরেক্টরিতে সংযুক্ত। পাশের এলাকার ক্রেতারা সরাসরি আপনার ব্র্যান্ডের লাইভ কালেকশন দেখে দোকানে চলে আসবে।",
            badge: "Omnichannel Mesh",
        },
    ],
    pricing: [
        {
            id: "pack_retail",
            name: "Smart Boutique Pack",
            name_bn: "স্মার্ট বুটিক প্যাক",
            price: "৳৮,০০০",
            billing: "/ বছর (মাত্র ৳৬৬৬/মাস)",
            badge: "সবচেয়ে জনপ্রিয়",
            is_popular: true,
            desc: "একক ফ্যাশন শোরুম, বুটিক শপ ও গার্মেন্টসের জন্য কমপ্লিট বারকোড পিওএস ও ইনভেন্টরি সলিউশন।",
            features: [
                "আনলিমিটেড বারকোড স্ক্যানিং ও থার্মাল মেমো প্রিন্টিং",
                "গার্মেন্টস কালার ও সাইজ ম্যাট্রিক্স ইনভেন্টরি ট্র্যাকিং",
                "অ্যান্ড্রয়েড ফোনকে ওয়্যারলেস বারকোড স্ক্যানার বানানোর সুবিধা",
                "ডিজিটাল বাকি খাতা ও আনলিমিটেড বিকাশ তাগাদা SMS",
                "দৈনিক ও মাসিক অটো প্রফিট/লস ব্যালেন্স শিট",
                "Zengfy Social ১-ক্লিক শপউইন্ডো লাইভ কানেকশন",
                "২৪/৭ ডেডিকেটেড ফোন ও হোয়াটসঅ্যাপ সাপোর্ট",
            ],
            cta: "বুটিক প্যাক চালু করুন",
        },
        {
            id: "pack_pro",
            name: "Fashion Flagship Pro",
            name_bn: "ফ্ল্যাগশিপ শোরুম প্রো",
            price: "৳১৪,৫০০",
            billing: "/ বছর",
            badge: "মাল্টি-কাউন্টার শোরুম",
            is_popular: false,
            desc: "বড় শপিং মল শোরুম ও একাধিক ক্যাশ কাউন্টার পরিচালিত ব্র্যান্ডের জন্য উচ্চগতির সিস্টেম।",
            features: [
                "স্মার্ট বুটিক প্যাকের সকল সুবিধা অন্তর্ভুক্ত",
                "একসাথে ৩টি ক্যাশ কাউন্টার সংযোগ সুবিধা",
                "কাউন্টারভিত্তিক ক্যাশিয়ারের ক্যাশ ড্রয়ার মিল ও শিফট রিপোর্ট",
                "ইন-হাউস বারকোড স্টিকার জেনারেটর ও প্রিন্টিং ইঞ্জিন",
                "কাস্টমার লয়্যালটি ডিসকাউন্ট ও ক্লাব মেম্বারশিপ পয়েন্টস",
                "ব্যক্তিগত ব্র্যান্ডের কাস্টম থার্মাল রসিদ ডিজাইন",
            ],
            cta: "ফ্ল্যাগশিপ প্রো বেছে নিন",
        },
        {
            id: "pack_enterprise",
            name: "Multi-Branch Mall Enterprise",
            name_bn: "মাল্টি-ব্রাঞ্চ এন্টারপ্রাইজ",
            price: "৳২৮,০০০",
            billing: "/ বছর",
            badge: "চেইন রিটেইল ব্র্যান্ড",
            is_popular: false,
            desc: "যমুনা ফিউচার পার্ক, বসুন্ধরা সিটি ও ধানমন্ডিসহ একাধিক আউটলেট ও কেন্দ্রীয় গোডাউন পরিচালিত ব্র্যান্ডের জন্য।",
            features: [
                "ফ্ল্যাগশিপ প্রো প্যাকের সকল সুবিধা অন্তর্ভুক্ত",
                "আনলিমিটেড শোরুম ব্রাঞ্চ ও সেন্ট্রাল গোডাউন সিঙ্ক",
                "ব্রাঞ্চ টু ব্রাঞ্চ মাল ট্রান্সফার চালান ও রিসিভিং গেটওয়ে",
                "ডেডিকেটেড ক্লাউড ডাটাবেজ ব্যাকআপ ও 99.99% আপটাইম SLA",
                "কাস্টম একাউন্টিং ও কুরিয়ার ট্র্যাকিং API ইন্টিগ্রেশন",
                "অন-সাইট স্টাফ ট্রেনিং ও ভিআইপি ডেডিকেটেড অ্যাকাউন্ট ম্যানেজার",
            ],
            cta: "এন্টারপ্রাইজ টিমকে কল করুন",
        },
    ],
    faq: [
        {
            q: "আমার কি আলাদা দামি বারকোড মেশিন কিনতে হবে?",
            a: "একদমই না! যেকোনো সাধারণ কম্পিউটার, ল্যাপটপ বা অ্যান্ড্রয়েড ফোনের ক্যামেরা দিয়েই সরাসরি বারকোড স্ক্যান করা যায়। চাইলে বাজারে পাওয়া যেকোনো ৫০০-১,০০০ টাকার সাধারণ ইউএসবি স্ক্যানারও প্লাগ-এন্ড-প্লে কাজ করবে।",
        },
        {
            q: "একটি পোশাকের বিভিন্ন সাইজ (S, M, L, XL) ও রঙের স্টক কীভাবে আলাদা থাকবে?",
            a: "Zengfy POS-এ বিশেষ ফ্যাশন কালার-সাইজ ম্যাট্রিক্স তৈরি করা আছে। একই পাঞ্জাবির ভিন্ন সাইজ ও কালারের জন্য সিস্টেম স্বয়ংক্রিয়ভাবে আলাদা ভ্যারিয়্যান্ট বারকোড তৈরি করে, ফলে গোডাউনে কোন রঙের কোন সাইজ কতটি আছে তা ১ সেকেন্ডেই স্ক্রিনে ভেসে উঠবে।",
        },
        {
            q: "বাকি খাতার টাকা তুলতে সিস্টেম কীভাবে সাহায্য করে?",
            a: "খরিদ্দারের বাকি থাকলে আপনি ১-ক্লিকে তার মোবাইলে একটি প্রফেশনাল SMS পাঠাতে পারবেন। এতে বকেয়ার পরিমাণ এবং আপনার দোকানের নিজস্ব bKash/Nagad মার্চেন্ট পেমেন্ট লিংক যুক্ত থাকে, যাতে কাস্টমার ঘরে বসেই বাকি শোধ করতে পারে।",
        },
        {
            q: "আমার দোকানের পণ্য কি এলাকার মানুষ অনলাইনে দেখতে পারবে?",
            a: "হ্যাঁ! আপনার অনুমতিক্রমে আপনার পিওএস ইনভেন্টরির পণ্যগুলো সরাসরি Zengfy Social-এর স্থানীয় ডিরেক্টরিতে 'Smart ShopWindow' হিসেবে প্রদর্শিত হবে। এলাকার হাজার হাজার ভেরিফাইড নাগরিক সরাসরি আপনার দোকানের কালেকশন দেখে কেনাকাটা করতে আসবে।",
        },
    ],
    auth: {
        is_authenticated: false,
        user: null,
    },
    links: {
        home: "http://pos.zengfy.top:8000/",
        login: "http://zengfy.test:8000/login?continue=http%3A%2F%2Fpos.zengfy.top%3A8000%2F",
        register: "http://zengfy.test:8000/register?continue=http%3A%2F%2Fpos.zengfy.top%3A8000%2F",
        download: "https://github.com/diusazzad/zengfy/releases",
        master_landing: "http://zengfy.test:8000/",
        social: "http://social.zengfy.top:8000/",
        school: "http://school.zengfy.top:8000/",
        api_docs: "http://pos.zengfy.top:8000/api/v1/pos/landing",
    },
};

export async function fetchPOSData() {
    // 1. Check DOM SSR injection
    const rootEl = document.getElementById("react-pos-landing-root");
    if (rootEl && rootEl.dataset.initialData) {
        try {
            let raw = rootEl.dataset.initialData;
            if (raw.includes("&quot;") || raw.includes("&amp;")) {
                const txt = document.createElement("textarea");
                txt.innerHTML = raw;
                raw = txt.value;
            }
            const parsed = JSON.parse(raw);
            if (parsed && parsed.brand) {
                return parsed;
            }
        } catch (e) {
            console.warn("[POSApi] SSR JSON parse skipped:", e);
        }
    }

    // 2. Fetch candidates
    const endpoints = [
        "/api/v1/pos/landing",
        "http://pos.zengfy.top:8000/api/v1/pos/landing",
        "http://127.0.0.1:8000/api/v1/pos/landing",
        "http://localhost:8000/api/v1/pos/landing",
    ];

    for (const url of endpoints) {
        try {
            const res = await fetch(url, {
                headers: {
                    Accept: "application/json",
                },
            });
            if (res.ok) {
                const json = await res.json();
                if (json.status === "success" && json.data) {
                    return json.data;
                }
            }
        } catch (e) {
            // continue next candidate
        }
    }

    return FALLBACK_POS_DATA;
}
