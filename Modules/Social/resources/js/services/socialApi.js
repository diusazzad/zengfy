// Fallback offline mock dataset for guaranteed zero-break rendering
export const FALLBACK_SOCIAL_DATA = {
    brand: {
        name: "Zengfy Social",
        tagline: "Real People. Real Communities. Zero Noise.",
        description: "The next-generation sovereign social network for Bangladesh. Verified neighborhood discussions, civic emergency SOS beacons, and chronological friend timelines with zero algorithm manipulation.",
        version: "1.0.0",
        base_domain: "zengfy.test",
    },
    stats: {
        verified_citizens: 1480,
        total_wards: 4554,
        safety_index: "99.4%",
        active_circles: 1280,
    },
    sos_telemetry: {
        average_response_time: "3.2s",
        active_responders_online: 34,
        broadcast_radius_meters: 750,
        status: "Active Sentinel Mesh",
    },
    streams: {
        world: [
            {
                id: "w1",
                author: "Tanvir Ahmed",
                handle: "tanvir.zengfy",
                initials: "TA",
                avatar_bg: "bg-blue-100 text-blue-700",
                ward: "Dhaka Division",
                badge: "Open Source",
                verified: true,
                time: "10m ago",
                text: "Decentralized civic tech is transforming public discourse across Bangladesh. NID verification completely eliminates anonymous bot manipulation. Pure signal, zero noise.",
                reactions: { "❤️": 48, "🔥": 16, "💡": 12 },
                comments_count: 14,
            },
            {
                id: "w2",
                author: "Ayesha Siddiqua",
                handle: "ayesha.zengfy",
                initials: "AS",
                avatar_bg: "bg-emerald-100 text-emerald-700",
                ward: "Chittagong Division",
                badge: "Civic Project",
                verified: true,
                time: "25m ago",
                text: "Neighborhood rooftop solar mesh project starting this weekend. Every verified resident can track kilowatt savings directly through their ward ledger! ☀️🌱",
                reactions: { "❤️": 39, "👏": 24 },
                comments_count: 8,
            },
        ],
        nearby: [
            {
                id: "n1",
                author: "Gulshan Ward-19 Civic Desk",
                handle: "ward19_desk",
                initials: "W19",
                avatar_bg: "bg-cyan-100 text-cyan-700",
                ward: "Ward 19, Gulshan-2",
                badge: "Civic Advisory",
                verified: true,
                time: "15m ago",
                text: "Road maintenance underway along Road 103 until 4:00 PM. Please use alternate bypass lane through Lake Drive. Safe travels to all commuters!",
                reactions: { "👏": 52, "❤️": 19 },
                comments_count: 22,
            },
            {
                id: "n2",
                author: "Mohammad Shumon",
                handle: "shumon_w19",
                initials: "MS",
                avatar_bg: "bg-indigo-100 text-indigo-700",
                ward: "Ward 19, Gulshan-2",
                badge: "Neighbor Notice",
                verified: true,
                time: "45m ago",
                text: "Lost pet kitten found near Park 3 bench. Orange tabby with red collar. Safely kept at the society security guard booth.",
                reactions: { "❤️": 31 },
                comments_count: 6,
            },
        ],
        friends: [
            {
                id: "f1",
                author: "Rahim Chowdhury",
                handle: "rahim_c",
                initials: "RC",
                avatar_bg: "bg-amber-100 text-amber-700",
                ward: "Dhanmondi Ward 15",
                badge: "Close Friends",
                verified: true,
                time: "1h ago",
                text: "Morning cycling ride around Dhanmondi Lake was super peaceful! Ready to plan our weekend group meetup. Who is in? 🚴‍♂️☕",
                reactions: { "❤️": 26, "🔥": 9 },
                comments_count: 11,
            },
            {
                id: "f2",
                author: "Farhana Islam",
                handle: "farhana_edu",
                initials: "FI",
                avatar_bg: "bg-purple-100 text-purple-700",
                ward: "Sylhet Sadar",
                badge: "Close Friends",
                verified: true,
                time: "3h ago",
                text: "New sunset photos from the tea gardens. No compression loss, pure sovereign storage on Zengfy Cloud! 🍃🌅",
                reactions: { "❤️": 45, "👏": 18 },
                comments_count: 7,
            },
        ],
        emergency_sos: [
            {
                id: "s1",
                author: "Ward-19 Emergency Responder Team",
                handle: "w19_sos_mesh",
                initials: "SOS",
                avatar_bg: "bg-rose-100 text-rose-700",
                ward: "Ward 19 Gulshan",
                badge: "Active SOS Beacon",
                verified: true,
                time: "Active Now",
                text: "Simulated Drill: 1-Tap SOS Beacon triggered at Lake Road. 18 Verified nearby responders received push alert within 3.2 seconds. Mesh radius: 750 meters.",
                reactions: { "🚨": 64, "🛡️": 38 },
                comments_count: 19,
            },
        ],
    },
    features: [
        {
            key: "zero_algorithms",
            title: "Zero Algorithmic Rage-Bait",
            tag: "Pure Chronology",
            description: "No foreign AI algorithms manipulating your emotions or selling your attention. Experience pure, chronological posts from real people you care about.",
            icon: "sparkles",
        },
        {
            key: "verified_identity",
            title: "Sovereign Verified Identity",
            tag: "Zero Bot Farms",
            description: "Every citizen profile is cryptographically verified against national records. Complete elimination of anonymous troll armies, fake accounts, and astroturfing.",
            icon: "shield-check",
        },
        {
            key: "hyperlocal_mesh",
            title: "Hyperlocal Ward Geolocation",
            tag: "4,554 Wards",
            description: "Automatically connects you to your union or ward community for localized civic notices, road diversions, emergency SOS alerts, and neighborhood cooperation.",
            icon: "map-pin",
        },
        {
            key: "encrypted_circles",
            title: "End-to-End Encrypted Circles",
            tag: "256-Bit Vault",
            description: "Private group discussions and direct citizen messaging secured with client-side zero-knowledge encryption that cannot be scraped by advertising brokers.",
            icon: "lock",
        },
    ],
    links: {
        home: "http://zengfy.test:8000/",
        social: "http://social.zengfy.test:8000/",
        feed: "http://social.zengfy.test:8000/",
        login: "http://zengfy.test:8000/login",
        register: "http://zengfy.test:8000/register",
        account: "http://zengfy.test:8000/account",
        download: "http://zengfy.test:8000/download",
        api_docs: "http://zengfy.test:8000/api/v1/social/landing",
    },
};

export async function fetchSocialLandingData() {
    // 1. Check DOM SSR injection
    const rootEl = document.getElementById('react-social-landing-root');
    if (rootEl && rootEl.dataset.initialData) {
        try {
            let raw = rootEl.dataset.initialData;
            if (raw.includes('&quot;') || raw.includes('&amp;')) {
                const txt = document.createElement('textarea');
                txt.innerHTML = raw;
                raw = txt.value;
            }
            const parsed = JSON.parse(raw);
            if (parsed && parsed.brand && parsed.streams) {
                return parsed;
            }
        } catch (e) {
            console.warn('[SocialApi] SSR JSON parse skipped:', e);
        }
    }

    // 2. Fetch from API endpoint candidates
    const endpoints = [
        '/api/v1/social/landing',
        'http://social.zengfy.test:8000/api/v1/social/landing',
        'http://zengfy.test:8000/api/v1/social/landing',
        'http://127.0.0.1:8000/api/v1/social/landing',
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
    return FALLBACK_SOCIAL_DATA;
}
