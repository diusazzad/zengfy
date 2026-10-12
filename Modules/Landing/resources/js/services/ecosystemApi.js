// Fallback offline mock dataset for guaranteed zero-break rendering
export const FALLBACK_ECOSYSTEM_DATA = {
    ecosystem: {
        name: "Zengfy Ecosystem",
        brand: "Zengfy",
        tagline: "Speak Freely. One Unified Sovereign Account.",
        description: "Bangladesh's next-generation sovereign digital infrastructure. Connect to 13 unified micro-SaaS platforms—from hyperlocal social feeds and institutional school ERP to legal vaults and retail POS—all powered by single-sign-on NID verification.",
        version: "1.0.0",
        base_domain: "zengfy.test",
    },
    stats: {
        verified_citizens: 1480,
        total_wards: 4554,
        active_institutions: 540,
        system_uptime: "99.98%",
        total_modules: 13,
    },
    modules: [
        {
            id: "social",
            name: "Zengfy Social",
            category: "Civic & Social Mesh",
            tagline: "Hyperlocal Feed, Neighborhood Groups & Civic Beacons.",
            desc: "Verified citizen discussions, ward-level emergency SOS alerts, and end-to-end encrypted community messaging without algorithms.",
            icon: "💬",
            url: "http://social.zengfy.test:8000",
            badge: "Active Module",
        },
        {
            id: "school",
            name: "Zengfy School",
            category: "Education & ERP",
            tagline: "Complete School, College & Madrasha ERP.",
            desc: "Manage automated student admissions, RFID attendance, online report cards, teacher payroll, and SMS notifications.",
            icon: "🏫",
            url: "http://school.zengfy.test:8000",
            badge: "Enterprise Ready",
        },
        {
            id: "pos",
            name: "Zengfy POS",
            category: "Retail & Commerce",
            tagline: "Fast Barcode Billing, Stock Management & Profit Analytics.",
            desc: "Modern touch POS with multi-counter billing, thermal receipt printing, low-stock alerts, and daily sales SMS for shop owners.",
            icon: "🛒",
            url: "http://pos.zengfy.test:8000",
            badge: "Retail SaaS",
        },
        {
            id: "law",
            name: "Zengfy Law",
            category: "Legal & Judiciary",
            tagline: "Case Management, Court Dates & Client File Vault.",
            desc: "Built specifically for lawyers & law firms: track hearing schedules, client payments, court precedents, and confidential legal documents.",
            icon: "⚖️",
            url: "http://law.zengfy.test:8000",
            badge: "Specialized",
        },
        {
            id: "civil",
            name: "Zengfy Civil",
            category: "Engineering & Construction",
            tagline: "Site Engineering, Material Expenses & Blueprint Vault.",
            desc: "Track construction project budgets, site contractor payments, material wastage, and structural blueprints.",
            icon: "🏗️",
            url: "http://civil.zengfy.test:8000",
            badge: "Engineering",
        },
        {
            id: "ngo",
            name: "Zengfy NGO",
            category: "Charity & Relief",
            tagline: "Transparent Donation & Relief Distribution System.",
            desc: "Track charity donations, relief distribution to verified citizens, and manage volunteer deployment.",
            icon: "❤️",
            url: "http://ngo.zengfy.test:8000",
            badge: "Non-Profit",
        },
        {
            id: "rent",
            name: "Zengfy Rent",
            category: "Real Estate & Lease",
            tagline: "Tenant NID Verification, Rent Receipt & Property Lease.",
            desc: "Instant tenant background check, automated digital rent receipts, utility billing, and vacant flat listings.",
            icon: "🏠",
            url: "http://rent.zengfy.test:8000",
            badge: "Real Estate",
        },
        {
            id: "hotel",
            name: "Zengfy Hotel",
            category: "Hospitality & Booking",
            tagline: "Room Booking, Guest Check-in & Housekeeping.",
            desc: "Streamline room reservations, guest ID verification, invoice printing, and housekeeping shifts.",
            icon: "🏨",
            url: "http://hotel.zengfy.test:8000",
            badge: "Hospitality",
        },
        {
            id: "ecommerce",
            name: "Zengfy Commerce",
            category: "E-Commerce & Retail",
            tagline: "Fast Online Storefront with Courier & Payment Gateway.",
            desc: "Launch your branded digital shop in minutes with Steadfast/Pathao courier tracking, bKash/Nagad checkout, and inventory sync.",
            icon: "🛍️",
            url: "http://shop.zengfy.test:8000",
            badge: "Online Store",
        },
        {
            id: "skill",
            name: "Zengfy Skill",
            category: "LMS & Certification",
            tagline: "Online Courses, Instructors & Skill Certifications.",
            desc: "Host live classes, video courses, student assignments, and verified certificates.",
            icon: "🎓",
            url: "http://skill.zengfy.test:8000",
            badge: "LMS Creator",
        },
        {
            id: "journal",
            name: "Zengfy Journal",
            category: "Personal & Productivity",
            tagline: "Encrypted Personal Diary, Notes & Thought Vault.",
            desc: "Keep your daily thoughts, private notes, and personal goals protected with biometric encryption.",
            icon: "📓",
            url: "http://journal.zengfy.test:8000",
            badge: "Private Vault",
        },
        {
            id: "habit",
            name: "Zengfy Habit",
            category: "Productivity & Focus",
            tagline: "Daily Routine, Habit Streaks & Focus Analytics.",
            desc: "Track your daily rituals, building discipline with streak reminders and personal performance charts.",
            icon: "⚡",
            url: "http://habit.zengfy.test:8000",
            badge: "Productivity",
        },
        {
            id: "schedule",
            name: "Zengfy Schedule",
            category: "Booking & Calendar",
            tagline: "Client Appointment Booking & Consultation Calendar.",
            desc: "Automated calendar bookings for doctors, consultants, and coaches with SMS meeting reminders.",
            icon: "📅",
            url: "http://schedule.zengfy.test:8000",
            badge: "Booking Tool",
        },
    ],
    features: [
        {
            key: "central_sso",
            title: "Unified Citizen Single Sign-On",
            tag: "One Account",
            description: "Log in once with verified NID credentials and seamlessly access all 13 Zengfy ecosystem subdomains without re-authenticating.",
            icon: "key",
        },
        {
            key: "hyperlocal_mesh",
            title: "Hyperlocal Ward Integration",
            tag: "Civic Security",
            description: "Automated ward-level geo-fencing connecting local businesses, civic safety beacons, and schools to their respective administrative areas.",
            icon: "map-pin",
        },
        {
            key: "privacy_encryption",
            title: "Sovereign 256-Bit Data Vault",
            tag: "Zero-Knowledge",
            description: "End-to-end encrypted personal journals, legal files, and student records protected against corporate algorithm mining.",
            icon: "shield-check",
        },
        {
            key: "multi_tenant_erp",
            title: "Autonomous Micro-SaaS Engine",
            tag: "Instant Provisioning",
            description: "High-throughput institutional billing, school ERP, and legal precedents with independent schema isolation.",
            icon: "cpu-chip",
        },
    ],
    auth: {
        is_authenticated: false,
        user: null,
    },
    links: {
        home: "http://zengfy.test:8000/",
        login: "http://zengfy.test:8000/login",
        register: "http://zengfy.test:8000/register",
        account: "http://zengfy.test:8000/account",
        download: "http://zengfy.test:8000/download",
        social: "http://social.zengfy.test:8000/",
        school: "http://school.zengfy.test:8000/",
        api_docs: "http://zengfy.test:8000/api/v1/ecosystem/landing",
    },
};

export async function fetchEcosystemData() {
    // 1. Check DOM SSR injection
    const rootEl = document.getElementById('react-ecosystem-landing-root');
    if (rootEl && rootEl.dataset.initialData) {
        try {
            let raw = rootEl.dataset.initialData;
            if (raw.includes('&quot;') || raw.includes('&amp;')) {
                const txt = document.createElement('textarea');
                txt.innerHTML = raw;
                raw = txt.value;
            }
            const parsed = JSON.parse(raw);
            if (parsed && parsed.modules && parsed.modules.length > 0) {
                return parsed;
            }
        } catch (e) {
            console.warn('[EcosystemApi] SSR JSON parse skipped:', e);
        }
    }

    // 2. Multi-URL fetch candidates
    const endpoints = [
        '/api/v1/ecosystem/landing',
        'http://zengfy.test:8000/api/v1/ecosystem/landing',
        'http://127.0.0.1:8000/api/v1/ecosystem/landing',
        'http://localhost:8000/api/v1/ecosystem/landing',
    ];

    for (const url of endpoints) {
        try {
            const res = await fetch(url, {
                headers: {
                    'Accept': 'application/json',
                },
            });
            if (res.ok) {
                const json = await res.json();
                if (json.status === 'success' && json.data) {
                    return json.data;
                }
            }
        } catch {
            // Continue to next endpoint fallback
        }
    }

    // 3. Resilient fallback
    return FALLBACK_ECOSYSTEM_DATA;
}