class SocialLandingData {
  final PlatformInfo platform;
  final HeroInfo hero;
  final SocialStats stats;
  final SosTelemetry sosTelemetry;
  final Map<String, List<SocialStreamPost>> streams;
  final List<SocialFeature> features;
  final List<SamplePost> samplePosts;
  final SocialLinks links;
  final bool isLiveApi;

  SocialLandingData({
    required this.platform,
    required this.hero,
    required this.stats,
    required this.sosTelemetry,
    this.streams = const {},
    required this.features,
    required this.samplePosts,
    required this.links,
    this.isLiveApi = false,
  });

  factory SocialLandingData.fromJson(
    Map<String, dynamic> json, {
    bool isLive = true,
  }) {
    final data = json['data'] as Map<String, dynamic>? ?? json;

    final brandJson =
        (data['brand'] ?? data['platform']) as Map<String, dynamic>? ?? {};
    final heroJson = data['hero'] as Map<String, dynamic>?;
    final statsJson = data['stats'] as Map<String, dynamic>? ?? {};
    final sosJson = data['sos_telemetry'] as Map<String, dynamic>? ?? {};
    final streamsJson = data['streams'] as Map<String, dynamic>? ?? {};

    // Parse multi-channel streams
    final Map<String, List<SocialStreamPost>> parsedStreams = {};
    streamsJson.forEach((key, list) {
      if (list is List) {
        parsedStreams[key] = list
            .map(
              (item) => SocialStreamPost.fromJson(item as Map<String, dynamic>),
            )
            .toList();
      }
    });

    // Populate samplePosts from streams or fallback
    List<SamplePost> posts = [];
    if (parsedStreams.isNotEmpty) {
      final List<SocialStreamPost> allStreamPosts = [
        ...parsedStreams['world'] ?? <SocialStreamPost>[],
        ...parsedStreams['nearby'] ?? <SocialStreamPost>[],
        ...parsedStreams['friends'] ?? <SocialStreamPost>[],
        ...parsedStreams['emergency_sos'] ?? <SocialStreamPost>[],
      ];
      posts = allStreamPosts
          .map((post) => SamplePost.fromStreamPost(post))
          .toList();
    } else if (data['sample_posts'] is List) {
      posts = (data['sample_posts'] as List)
          .map((item) => SamplePost.fromJson(item as Map<String, dynamic>))
          .toList();
    }

    return SocialLandingData(
      platform: PlatformInfo.fromJson(brandJson),
      hero: (heroJson != null && heroJson.isNotEmpty)
          ? HeroInfo.fromJson(heroJson)
          : HeroInfo.fromBrand(brandJson),
      stats: SocialStats.fromJson(statsJson),
      sosTelemetry: SosTelemetry.fromJson(sosJson),
      streams: parsedStreams,
      features: (data['features'] as List<dynamic>? ?? [])
          .map((item) => SocialFeature.fromJson(item as Map<String, dynamic>))
          .toList(),
      samplePosts: posts,
      links: SocialLinks.fromJson(data['links'] as Map<String, dynamic>? ?? {}),
      isLiveApi: isLive,
    );
  }

  static SocialLandingData fallback() {
    return SocialLandingData(
      isLiveApi: false,
      platform: PlatformInfo(
        name: 'Zengfy Social',
        brand: 'Zengfy.Social',
        tagline: 'Real People. Real Communities. Zero Noise.',
        description: 'The next-generation sovereign social network for Bangladesh. Verified neighborhood discussions, civic emergency SOS beacons, and chronological friend timelines.',
        version: '1.0.0',
        apiVersion: 'v1',
      ),
      hero: HeroInfo(
        badge: "🇧🇩 Bangladesh's Sovereign NID-Verified Social Network",
        title: "Real People. Real Communities. Zero Noise.",
        subtitle: "Connect with verified neighbors, monitor ward-level emergency beacons, and interact without algorithm distortion or corporate data mining.",
        highlights: [
          HeroHighlight(icon: "🛡️", text: "Smart NID Verified"),
          HeroHighlight(icon: "🤖", text: "Zero Bot Tolerance"),
          HeroHighlight(icon: "🔒", text: "256-Bit Vault Circles"),
          HeroHighlight(icon: "🚨", text: "3.2s SOS Response"),
        ],
      ),
      stats: SocialStats(
        citizensCount: 1480,
        totalWards: 4554,
        safetyIndex: "99.4%",
        activeDistricts: 1280,
      ),
      sosTelemetry: SosTelemetry(
        averageResponseTime: "3.2s",
        activeRespondersOnline: 34,
        broadcastRadiusMeters: 750,
        status: "Active Sentinel Mesh",
      ),
      streams: {
        'world': [
          SocialStreamPost(
            id: 'w1',
            author: 'Tanvir Ahmed',
            handle: 'tanvir.zengfy',
            initials: 'TA',
            avatarBg: 'bg-blue-100 text-blue-700',
            ward: 'Dhaka Division',
            badge: 'Open Source',
            verified: true,
            time: '10m ago',
            text: 'Decentralized civic tech is transforming public discourse across Bangladesh. NID verification completely eliminates anonymous bot manipulation. Pure signal, zero noise.',
            reactions: {'❤️': 48, '🔥': 16, '💡': 12},
            commentsCount: 14,
          ),
          SocialStreamPost(
            id: 'w2',
            author: 'Ayesha Siddiqua',
            handle: 'ayesha.zengfy',
            initials: 'AS',
            avatarBg: 'bg-emerald-100 text-emerald-700',
            ward: 'Chittagong Division',
            badge: 'Civic Project',
            verified: true,
            time: '25m ago',
            text: 'Neighborhood rooftop solar mesh project starting this weekend. Every verified resident can track kilowatt savings directly through their ward ledger! ☀️🌱',
            reactions: {'❤️': 39, '👏': 24},
            commentsCount: 8,
          ),
        ],
        'nearby': [
          SocialStreamPost(
            id: 'n1',
            author: 'Gulshan Ward-19 Civic Desk',
            handle: 'ward19_desk',
            initials: 'W19',
            avatarBg: 'bg-cyan-100 text-cyan-700',
            ward: 'Ward 19, Gulshan-2',
            badge: 'Civic Advisory',
            verified: true,
            time: '15m ago',
            text: 'Road maintenance underway along Road 103 until 4:00 PM. Please use alternate bypass lane through Lake Drive. Safe travels to all commuters!',
            reactions: {'👏': 52, '❤️': 19},
            commentsCount: 22,
          ),
        ],
        'friends': [
          SocialStreamPost(
            id: 'f1',
            author: 'Rahim Chowdhury',
            handle: 'rahim_c',
            initials: 'RC',
            avatarBg: 'bg-amber-100 text-amber-700',
            ward: 'Dhanmondi Ward 15',
            badge: 'Close Friends',
            verified: true,
            time: '1h ago',
            text: 'Morning cycling ride around Dhanmondi Lake was super peaceful! Ready to plan our weekend group meetup. Who is in? 🚴‍♂️☕',
            reactions: {'❤️': 26, '🔥': 9},
            commentsCount: 11,
          ),
        ],
        'emergency_sos': [
          SocialStreamPost(
            id: 's1',
            author: 'Ward-19 Emergency Responder Team',
            handle: 'w19_sos_mesh',
            initials: 'SOS',
            avatarBg: 'bg-rose-100 text-rose-700',
            ward: 'Ward 19 Gulshan',
            badge: 'Active SOS Beacon',
            verified: true,
            time: 'Active Now',
            text: 'Simulated Drill: 1-Tap SOS Beacon triggered at Lake Road. 18 Verified nearby responders received push alert within 3.2 seconds. Mesh radius: 750 meters.',
            reactions: {'🚨': 64, '🛡️': 38},
            commentsCount: 19,
          ),
        ],
      },
      features: [
        SocialFeature(
          key: "zero_algorithms",
          title: "Zero Algorithmic Rage-Bait",
          tag: "Pure Chronology",
          description: "No foreign AI algorithms manipulating your emotions or selling your attention. Experience pure, chronological posts from real people you care about.",
          icon: "sparkles",
        ),
        SocialFeature(
          key: "verified_identity",
          title: "Sovereign Verified Identity",
          tag: "Zero Bot Farms",
          description: "Every citizen profile is cryptographically verified against national records. Complete elimination of anonymous troll armies, fake accounts, and astroturfing.",
          icon: "badge-check",
        ),
        SocialFeature(
          key: "hyperlocal_mesh",
          title: "Hyperlocal Ward Geolocation",
          tag: "4,554 Wards",
          description: "Automatically connects you to your union or ward community for localized civic notices, road diversions, emergency SOS alerts, and neighborhood cooperation.",
          icon: "globe-alt",
        ),
        SocialFeature(
          key: "encrypted_circles",
          title: "End-to-End Encrypted Circles",
          tag: "256-Bit Vault",
          description: "Private group discussions and direct citizen messaging secured with client-side zero-knowledge encryption that cannot be scraped by advertising brokers.",
          icon: "chat-bubble-left-right",
        ),
      ],
      samplePosts: [
        SamplePost(
          id: "w1",
          content: "Decentralized civic tech is transforming public discourse across Bangladesh. NID verification completely eliminates anonymous bot manipulation. Pure signal, zero noise.",
          wardCode: "Dhaka Division",
          likesCount: 48,
          commentsCount: 14,
          sharesCount: 16,
          createdAt: "10m ago",
          badge: "Open Source",
          initials: "TA",
          reactions: {'❤️': 48, '🔥': 16, '💡': 12},
          author: AuthorInfo(
            name: "Tanvir Ahmed",
            handle: "tanvir.zengfy",
            avatarUrl: "",
            isVerified: true,
            wardCode: "Dhaka Division",
          ),
        ),
        SamplePost(
          id: "n1",
          content: "Road maintenance underway along Road 103 until 4:00 PM. Please use alternate bypass lane through Lake Drive. Safe travels to all commuters!",
          wardCode: "Ward 19, Gulshan-2",
          likesCount: 19,
          commentsCount: 22,
          sharesCount: 52,
          createdAt: "15m ago",
          badge: "Civic Advisory",
          initials: "W19",
          reactions: {'👏': 52, '❤️': 19},
          author: AuthorInfo(
            name: "Gulshan Ward-19 Civic Desk",
            handle: "ward19_desk",
            avatarUrl: "",
            isVerified: true,
            wardCode: "Ward 19, Gulshan-2",
          ),
        ),
      ],
      links: SocialLinks(
        home: "http://zengfy.top:8000/",
        social: "http://social.zengfy.top:8000/",
        feed: "http://social.zengfy.top:8000/",
        login: "http://zengfy.top:8000/login",
        register: "http://zengfy.top:8000/register",
        account: "http://zengfy.top:8000/account",
      ),
    );
  }
}

class PlatformInfo {
  final String name;
  final String brand;
  final String tagline;
  final String description;
  final String version;
  final String apiVersion;

  PlatformInfo({
    required this.name,
    required this.brand,
    required this.tagline,
    required this.description,
    required this.version,
    required this.apiVersion,
  });

  factory PlatformInfo.fromJson(Map<String, dynamic> json) {
    return PlatformInfo(
      name: json['name'] as String? ?? 'Zengfy Social',
      brand:
          json['brand'] as String? ??
          json['name'] as String? ??
          'Zengfy.Social',
      tagline:
          json['tagline'] as String? ??
          'Real People. Real Communities. Zero Noise.',
      description: json['description'] as String? ?? '',
      version: json['version'] as String? ?? '1.0.0',
      apiVersion: json['api_version'] as String? ?? 'v1',
    );
  }
}

class HeroInfo {
  final String badge;
  final String title;
  final String subtitle;
  final List<HeroHighlight> highlights;

  HeroInfo({
    required this.badge,
    required this.title,
    required this.subtitle,
    required this.highlights,
  });

  factory HeroInfo.fromJson(Map<String, dynamic> json) {
    return HeroInfo(
      badge:
          json['badge'] as String? ??
          "🇧🇩 Bangladesh's Sovereign NID-Verified Social Network",
      title:
          json['title'] as String? ??
          "Real People. Real Communities. Zero Noise.",
      subtitle: json['subtitle'] as String? ?? '',
      highlights: (json['highlights'] as List<dynamic>? ?? [])
          .map((item) => HeroHighlight.fromJson(item as Map<String, dynamic>))
          .toList(),
    );
  }

  factory HeroInfo.fromBrand(Map<String, dynamic> brand) {
    return HeroInfo(
      badge: "🇧🇩 Sovereign NID-Verified Network",
      title:
          brand['tagline'] as String? ??
          "Real People. Real Communities. Zero Noise.",
      subtitle: brand['description'] as String? ?? "The next-generation sovereign social network for Bangladesh. Verified neighborhood discussions, civic emergency SOS beacons, and chronological friend timelines.",
      highlights: [
        HeroHighlight(icon: "🛡️", text: "Smart NID Verified"),
        HeroHighlight(icon: "🤖", text: "Zero Bot Tolerance"),
        HeroHighlight(icon: "🔒", text: "256-Bit Vault Circles"),
        HeroHighlight(icon: "🚨", text: "3.2s SOS Response"),
      ],
    );
  }
}

class HeroHighlight {
  final String icon;
  final String text;

  HeroHighlight({required this.icon, required this.text});

  factory HeroHighlight.fromJson(Map<String, dynamic> json) {
    return HeroHighlight(
      icon: json['icon'] as String? ?? '🛡️',
      text: json['text'] as String? ?? '',
    );
  }
}

class SocialStats {
  final int citizensCount;
  final int totalWards;
  final String safetyIndex;
  final int activeDistricts;

  SocialStats({
    required this.citizensCount,
    required this.totalWards,
    required this.safetyIndex,
    required this.activeDistricts,
  });

  factory SocialStats.fromJson(Map<String, dynamic> json) {
    return SocialStats(
      citizensCount:
          (json['verified_citizens'] as num?)?.toInt() ??
          (json['citizens_count'] as num?)?.toInt() ??
          1480,
      totalWards: (json['total_wards'] as num?)?.toInt() ?? 4554,
      safetyIndex: json['safety_index']?.toString() ?? '99.4%',
      activeDistricts:
          (json['active_circles'] as num?)?.toInt() ??
          (json['active_districts'] as num?)?.toInt() ??
          1280,
    );
  }
}

class SosTelemetry {
  final String averageResponseTime;
  final int activeRespondersOnline;
  final int broadcastRadiusMeters;
  final String status;

  SosTelemetry({
    required this.averageResponseTime,
    required this.activeRespondersOnline,
    required this.broadcastRadiusMeters,
    required this.status,
  });

  factory SosTelemetry.fromJson(Map<String, dynamic> json) {
    return SosTelemetry(
      averageResponseTime: json['average_response_time'] as String? ?? '3.2s',
      activeRespondersOnline:
          (json['active_responders_online'] as num?)?.toInt() ?? 34,
      broadcastRadiusMeters:
          (json['broadcast_radius_meters'] as num?)?.toInt() ?? 750,
      status: json['status'] as String? ?? 'Active Sentinel Mesh',
    );
  }
}

class SocialFeature {
  final String key;
  final String title;
  final String tag;
  final String description;
  final String icon;

  SocialFeature({
    required this.key,
    required this.title,
    required this.tag,
    required this.description,
    required this.icon,
  });

  factory SocialFeature.fromJson(Map<String, dynamic> json) {
    return SocialFeature(
      key: json['key'] as String? ?? '',
      title: json['title'] as String? ?? '',
      tag: json['tag'] as String? ?? '',
      description: json['description'] as String? ?? '',
      icon: json['icon'] as String? ?? '',
    );
  }
}

class SocialStreamPost {
  final String id;
  final String author;
  final String handle;
  final String initials;
  final String avatarBg;
  final String ward;
  final String badge;
  final bool verified;
  final String time;
  final String text;
  final Map<String, int> reactions;
  final int commentsCount;

  SocialStreamPost({
    required this.id,
    required this.author,
    required this.handle,
    required this.initials,
    required this.avatarBg,
    required this.ward,
    required this.badge,
    required this.verified,
    required this.time,
    required this.text,
    required this.reactions,
    required this.commentsCount,
  });

  factory SocialStreamPost.fromJson(Map<String, dynamic> json) {
    final rawReactions = json['reactions'] as Map<String, dynamic>? ?? {};
    final reactions = rawReactions.map(
      (k, v) => MapEntry(k, (v as num).toInt()),
    );

    return SocialStreamPost(
      id: json['id']?.toString() ?? '',
      author: json['author'] as String? ?? 'Citizen',
      handle: json['handle'] as String? ?? 'citizen',
      initials: json['initials'] as String? ?? 'ZC',
      avatarBg: json['avatar_bg'] as String? ?? 'bg-blue-100 text-blue-700',
      ward: json['ward'] as String? ?? 'Dhaka Division',
      badge: json['badge'] as String? ?? 'Verified',
      verified: json['verified'] as bool? ?? true,
      time: json['time'] as String? ?? 'Just now',
      text: json['text'] as String? ?? '',
      reactions: reactions,
      commentsCount: (json['comments_count'] as num?)?.toInt() ?? 0,
    );
  }
}

class SamplePost {
  final String id;
  final String content;
  final String wardCode;
  final int likesCount;
  final int commentsCount;
  final int sharesCount;
  final String createdAt;
  final AuthorInfo author;
  final String badge;
  final String initials;
  final Map<String, int> reactions;

  SamplePost({
    required this.id,
    required this.content,
    required this.wardCode,
    required this.likesCount,
    required this.commentsCount,
    required this.sharesCount,
    required this.createdAt,
    required this.author,
    this.badge = 'Verified',
    this.initials = 'ZC',
    this.reactions = const {},
  });

  factory SamplePost.fromJson(Map<String, dynamic> json) {
    return SamplePost(
      id: json['id'] as String? ?? '',
      content: json['content'] as String? ?? json['text'] as String? ?? '',
      wardCode:
          json['ward_code'] as String? ??
          json['ward'] as String? ??
          'WARD-DHAKA-19',
      likesCount: (json['likes_count'] as num?)?.toInt() ?? 0,
      commentsCount: (json['comments_count'] as num?)?.toInt() ?? 0,
      sharesCount: (json['shares_count'] as num?)?.toInt() ?? 0,
      createdAt:
          json['created_at'] as String? ??
          json['time'] as String? ??
          'Just now',
      author: AuthorInfo.fromJson(
        json['author'] as Map<String, dynamic>? ?? {},
      ),
      badge: json['badge'] as String? ?? 'Verified',
      initials: json['initials'] as String? ?? 'ZC',
    );
  }

  factory SamplePost.fromStreamPost(SocialStreamPost post) {
    final likes = post.reactions['❤️'] ?? 0;
    final flames = post.reactions['🔥'] ?? 0;
    final claps = post.reactions['👏'] ?? 0;
    return SamplePost(
      id: post.id,
      content: post.text,
      wardCode: post.ward,
      likesCount: likes > 0
          ? likes
          : (post.reactions.values.isNotEmpty
                ? post.reactions.values.first
                : 12),
      commentsCount: post.commentsCount,
      sharesCount: flames + claps,
      createdAt: post.time,
      badge: post.badge,
      initials: post.initials,
      reactions: post.reactions,
      author: AuthorInfo(
        name: post.author,
        handle: post.handle,
        avatarUrl: '',
        isVerified: post.verified,
        wardCode: post.ward,
      ),
    );
  }
}

class AuthorInfo {
  final String name;
  final String handle;
  final String avatarUrl;
  final bool isVerified;
  final String wardCode;

  AuthorInfo({
    required this.name,
    required this.handle,
    required this.avatarUrl,
    required this.isVerified,
    required this.wardCode,
  });

  factory AuthorInfo.fromJson(Map<String, dynamic> json) {
    return AuthorInfo(
      name: json['name'] as String? ?? 'Verified Citizen',
      handle: json['handle'] as String? ?? 'citizen',
      avatarUrl: json['avatar_url'] as String? ?? '',
      isVerified: json['is_verified'] as bool? ?? true,
      wardCode: json['ward_code'] as String? ?? '1001',
    );
  }
}

class SocialLinks {
  final String home;
  final String social;
  final String feed;
  final String login;
  final String register;
  final String account;

  SocialLinks({
    required this.home,
    required this.social,
    required this.feed,
    required this.login,
    required this.register,
    required this.account,
  });

  factory SocialLinks.fromJson(Map<String, dynamic> json) {
    return SocialLinks(
      home: json['home'] as String? ?? 'http://zengfy.top:8000/',
      social: json['social'] as String? ?? 'http://social.zengfy.top:8000/',
      feed: json['feed'] as String? ?? 'http://social.zengfy.top:8000/',
      login: json['login'] as String? ?? 'http://zengfy.top:8000/login',
      register:
          json['register'] as String? ?? 'http://zengfy.top:8000/register',
      account: json['account'] as String? ?? 'http://zengfy.top:8000/account',
    );
  }
}
