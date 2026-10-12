import 'package:flutter/material.dart';
import 'package:url_launcher/url_launcher.dart';
import '../models/social_landing_data.dart';
import '../services/social_api_service.dart';
import '../theme/app_theme.dart';
import '../widgets/landing_widgets.dart';

class LandingScreen extends StatefulWidget {
  const LandingScreen({super.key});

  @override
  State<LandingScreen> createState() => _LandingScreenState();
}

class _LandingScreenState extends State<LandingScreen> {
  late Future<SocialLandingData> _landingFuture;
  String _activeChannel = 'world'; // 'world' | 'nearby' | 'friends' | 'emergency_sos'

  @override
  void initState() {
    super.initState();
    _loadData();
  }

  void _loadData() {
    setState(() {
      _landingFuture = SocialApiService.fetchLandingData();
    });
  }

  Future<void> _launchUrlSafe(String urlString) async {
    try {
      final uri = Uri.parse(urlString);
      if (await canLaunchUrl(uri)) {
        await launchUrl(uri, mode: LaunchMode.externalApplication);
      } else {
        debugPrint('[LandingScreen] Could not launch URL: $urlString');
      }
    } catch (e) {
      debugPrint('[LandingScreen] URL Launch error: $e');
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: AppTheme.canvasBg,
      body: FutureBuilder<SocialLandingData>(
        future: _landingFuture,
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.waiting) {
            return _buildLoadingState();
          }

          final data = snapshot.data ?? SocialLandingData.fallback();
          return _buildContent(data);
        },
      ),
    );
  }

  Widget _buildLoadingState() {
    return Center(
      child: Column(
        mainAxisSize: MainAxisSize.min,
        children: [
          Container(
            width: 56,
            height: 56,
            decoration: BoxDecoration(
              gradient: AppTheme.primaryGradient,
              borderRadius: BorderRadius.circular(18),
              boxShadow: const [
                BoxShadow(
                  color: Color(0x4D2563EB),
                  blurRadius: 20,
                  offset: Offset(0, 8),
                ),
              ],
            ),
            child: const Center(
              child: Text(
                'Z',
                style: TextStyle(
                  color: Colors.white,
                  fontWeight: FontWeight.w900,
                  fontSize: 28,
                ),
              ),
            ),
          ),
          const SizedBox(height: 24),
          const SizedBox(
            width: 26,
            height: 26,
            child: CircularProgressIndicator(
              strokeWidth: 2.5,
              valueColor: AlwaysStoppedAnimation<Color>(AppTheme.accentBlue),
            ),
          ),
          const SizedBox(height: 16),
          const Text(
            'Connecting to Zengfy Sovereign Mesh...',
            style: TextStyle(
              color: AppTheme.textSecondary,
              fontSize: 13.5,
              fontWeight: FontWeight.w600,
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildContent(SocialLandingData data) {
    return LayoutBuilder(
      builder: (context, constraints) {
        final isMobile = constraints.maxWidth < 768;
        final isTablet = constraints.maxWidth >= 768 && constraints.maxWidth < 1024;
        final maxWidth = constraints.maxWidth > 1200 ? 1160.0 : constraints.maxWidth;

        return RefreshIndicator(
          onRefresh: () async {
            _loadData();
            await _landingFuture;
          },
          color: AppTheme.accentBlue,
          backgroundColor: Colors.white,
          child: SingleChildScrollView(
            physics: const AlwaysScrollableScrollPhysics(),
            child: Column(
              children: [
                // 1. Navigation Header
                _buildHeader(data, isMobile),

                // Main Container Centered
                Center(
                  child: Container(
                    constraints: BoxConstraints(maxWidth: maxWidth),
                    padding: EdgeInsets.symmetric(
                      horizontal: isMobile ? 16 : 24,
                      vertical: isMobile ? 24 : 40,
                    ),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.stretch,
                      children: [
                        // 2. Hero Section
                        _buildHeroSection(data, isMobile),

                        SizedBox(height: isMobile ? 36 : 56),

                        // 3. Live Stats Strip
                        _buildStatsSection(data, isMobile, isTablet),

                        SizedBox(height: isMobile ? 48 : 72),

                        // 4. Four Pillars Feature Grid
                        _buildFeaturesSection(data, isMobile),

                        SizedBox(height: isMobile ? 48 : 72),

                        // 5. Multi-Channel Stream Switcher & SOS Showcase
                        _buildShowcaseSection(data, isMobile),

                        SizedBox(height: isMobile ? 48 : 80),

                        // 6. Modern Footer
                        _buildFooter(data, isMobile),
                      ],
                    ),
                  ),
                ),
              ],
            ),
          ),
        );
      },
    );
  }

  // --------------------------------------------------------------------------
  // HEADER / APP BAR (White Glassmorphic)
  // --------------------------------------------------------------------------
  Widget _buildHeader(SocialLandingData data, bool isMobile) {
    return Container(
      decoration: BoxDecoration(
        color: Colors.white.withValues(alpha: 0.85),
        border: const Border(
          bottom: BorderSide(color: AppTheme.borderSubtle, width: 1),
        ),
        boxShadow: const [
          BoxShadow(
            color: Color(0x080F172A),
            blurRadius: 10,
            offset: Offset(0, 2),
          ),
        ],
      ),
      padding: EdgeInsets.symmetric(
        horizontal: isMobile ? 16 : 32,
        vertical: 14,
      ),
      child: SafeArea(
        bottom: false,
        child: Row(
          children: [
            // Logo & Brand
            Expanded(
              child: InkWell(
                onTap: () => _launchUrlSafe(data.links.home),
                borderRadius: BorderRadius.circular(12),
                child: Row(
                  mainAxisSize: MainAxisSize.min,
                  children: [
                    Container(
                      width: 36,
                      height: 36,
                      decoration: BoxDecoration(
                        gradient: AppTheme.primaryGradient,
                        borderRadius: BorderRadius.circular(12),
                        boxShadow: const [
                          BoxShadow(
                            color: Color(0x332563EB),
                            blurRadius: 10,
                            offset: Offset(0, 3),
                          ),
                        ],
                      ),
                      child: const Center(
                        child: Text(
                          'Z',
                          style: TextStyle(
                            color: Colors.white,
                            fontWeight: FontWeight.w900,
                            fontSize: 18,
                          ),
                        ),
                      ),
                    ),
                    const SizedBox(width: 10),
                    const Flexible(
                      child: Text.rich(
                        TextSpan(
                          children: [
                            TextSpan(
                              text: 'Zengfy',
                              style: TextStyle(
                                color: AppTheme.textPrimary,
                                fontWeight: FontWeight.w900,
                                fontSize: 18,
                                letterSpacing: -0.5,
                              ),
                            ),
                            TextSpan(
                              text: '.Social',
                              style: TextStyle(
                                color: AppTheme.accentBlue,
                                fontWeight: FontWeight.w900,
                                fontSize: 18,
                                letterSpacing: -0.5,
                              ),
                            ),
                          ],
                        ),
                        overflow: TextOverflow.ellipsis,
                        maxLines: 1,
                      ),
                    ),
                  ],
                ),
              ),
            ),

            if (!isMobile) ...[
              const SizedBox(width: 16),
              LivePill(
                label: data.isLiveApi ? 'LIVE API MESH' : 'SOVEREIGN MESH',
                dotColor: data.isLiveApi ? AppTheme.accentEmerald : AppTheme.accentBlue,
                textColor: data.isLiveApi ? AppTheme.accentEmerald : AppTheme.accentBlue,
                backgroundColor: data.isLiveApi ? const Color(0x1A059669) : const Color(0x1A2563EB),
                borderColor: data.isLiveApi ? const Color(0x33059669) : const Color(0x332563EB),
              ),
              const Spacer(),
              TextButton(
                onPressed: () => _launchUrlSafe(data.links.login),
                style: TextButton.styleFrom(
                  foregroundColor: AppTheme.textSecondary,
                  padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 10),
                ),
                child: const Text(
                  'Sign In',
                  style: TextStyle(fontWeight: FontWeight.w700, fontSize: 13.5),
                ),
              ),
              const SizedBox(width: 8),
            ] else ...[
              const SizedBox(width: 8),
            ],

            // Register CTA Button
            ElevatedButton(
              onPressed: () => _launchUrlSafe(data.links.register),
              style: ElevatedButton.styleFrom(
                backgroundColor: AppTheme.accentBlue,
                foregroundColor: Colors.white,
                padding: EdgeInsets.symmetric(
                  horizontal: isMobile ? 14 : 20,
                  vertical: 10,
                ),
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(12),
                ),
                elevation: 3,
                shadowColor: const Color(0x332563EB),
              ),
              child: Text(
                isMobile ? 'Register' : 'Get Citizen ID',
                style: const TextStyle(fontWeight: FontWeight.w800, fontSize: 13),
              ),
            ),
          ],
        ),
      ),
    );
  }

  // --------------------------------------------------------------------------
  // HERO SECTION
  // --------------------------------------------------------------------------
  Widget _buildHeroSection(SocialLandingData data, bool isMobile) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.center,
      children: [
        // 1. Dynamic Badge Pill
        Container(
          padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 7),
          decoration: BoxDecoration(
            color: const Color(0xFFEFF6FF), // blue-50
            borderRadius: BorderRadius.circular(24),
            border: Border.all(color: const Color(0xFFBFDBFE), width: 1),
          ),
          child: Text(
            data.hero.badge,
            style: const TextStyle(
              color: AppTheme.accentBlue,
              fontSize: 12.5,
              fontWeight: FontWeight.w800,
            ),
            textAlign: TextAlign.center,
          ),
        ),

        const SizedBox(height: 22),

        // 2. Bold Headline
        Text(
          data.hero.title,
          textAlign: TextAlign.center,
          style: TextStyle(
            color: AppTheme.textPrimary,
            fontSize: isMobile ? 30 : 46,
            fontWeight: FontWeight.w900,
            letterSpacing: -1.0,
            height: 1.15,
          ),
        ),

        const SizedBox(height: 16),

        // 3. Subtitle
        ConstrainedBox(
          constraints: const BoxConstraints(maxWidth: 720),
          child: Text(
            data.hero.subtitle,
            textAlign: TextAlign.center,
            style: TextStyle(
              color: AppTheme.textSecondary,
              fontSize: isMobile ? 14.5 : 16.5,
              height: 1.6,
            ),
          ),
        ),

        const SizedBox(height: 28),

        // 4. Action Buttons (Enter Feed & Smart NID)
        Wrap(
          spacing: 12,
          runSpacing: 12,
          alignment: WrapAlignment.center,
          children: [
            ElevatedButton.icon(
              onPressed: () => _launchUrlSafe(data.links.feed),
              style: ElevatedButton.styleFrom(
                backgroundColor: AppTheme.accentBlue,
                foregroundColor: Colors.white,
                padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 15),
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(14),
                ),
                elevation: 4,
                shadowColor: const Color(0x4D2563EB),
              ),
              icon: const Icon(Icons.arrow_forward_rounded, size: 18),
              label: const Text(
                'Enter Sovereign Feed',
                style: TextStyle(fontWeight: FontWeight.w800, fontSize: 14),
              ),
            ),
            OutlinedButton.icon(
              onPressed: () => _launchUrlSafe(data.links.register),
              style: OutlinedButton.styleFrom(
                foregroundColor: AppTheme.textPrimary,
                side: const BorderSide(color: AppTheme.borderSubtle, width: 1.2),
                backgroundColor: Colors.white,
                padding: const EdgeInsets.symmetric(horizontal: 22, vertical: 15),
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(14),
                ),
              ),
              icon: const Icon(Icons.verified_user_rounded, size: 17, color: AppTheme.accentBlue),
              label: const Text(
                'Verify Smart NID',
                style: TextStyle(fontWeight: FontWeight.w700, fontSize: 14),
              ),
            ),
          ],
        ),

        const SizedBox(height: 28),

        // 5. Highlight Chips
        Wrap(
          spacing: 10,
          runSpacing: 10,
          alignment: WrapAlignment.center,
          children: data.hero.highlights.map((h) {
            return Container(
              padding: const EdgeInsets.symmetric(horizontal: 14, vertical: 8),
              decoration: BoxDecoration(
                color: Colors.white,
                borderRadius: BorderRadius.circular(14),
                border: Border.all(color: AppTheme.borderSubtle, width: 1),
                boxShadow: const [
                  BoxShadow(
                    color: Color(0x050F172A),
                    blurRadius: 8,
                    offset: Offset(0, 2),
                  ),
                ],
              ),
              child: Row(
                mainAxisSize: MainAxisSize.min,
                children: [
                  Text(h.icon, style: const TextStyle(fontSize: 14)),
                  const SizedBox(width: 8),
                  Text(
                    h.text,
                    style: const TextStyle(
                      color: AppTheme.textPrimary,
                      fontSize: 12.5,
                      fontWeight: FontWeight.w700,
                    ),
                  ),
                ],
              ),
            );
          }).toList(),
        ),
      ],
    );
  }

  // --------------------------------------------------------------------------
  // LIVE STATS SECTION
  // --------------------------------------------------------------------------
  Widget _buildStatsSection(SocialLandingData data, bool isMobile, bool isTablet) {
    final stats = [
      StatCard(
        label: 'Active Citizens',
        value: '${data.stats.citizensCount}+',
        subtitle: 'Verified Identity',
        icon: Icons.people_alt_rounded,
        accentColor: AppTheme.accentBlue,
      ),
      StatCard(
        label: 'Connected Wards',
        value: '${data.stats.totalWards}',
        subtitle: 'Nationwide Mesh',
        icon: Icons.location_city_rounded,
        accentColor: AppTheme.accentIndigo,
      ),
      StatCard(
        label: 'Civic Safety Index',
        value: data.stats.safetyIndex,
        subtitle: 'Optimal Condition',
        icon: Icons.shield_rounded,
        accentColor: AppTheme.accentEmerald,
      ),
      StatCard(
        label: 'Active Circles',
        value: '${data.stats.activeDistricts}+',
        subtitle: 'Encrypted Vaults',
        icon: Icons.hub_rounded,
        accentColor: AppTheme.accentCyan,
      ),
    ];

    if (isMobile) {
      return Column(
        children: stats
            .map(
              (card) => Padding(
                padding: const EdgeInsets.only(bottom: 12),
                child: card,
              ),
            )
            .toList(),
      );
    }

    if (isTablet) {
      return GridView.count(
        crossAxisCount: 2,
        shrinkWrap: true,
        physics: const NeverScrollableScrollPhysics(),
        crossAxisSpacing: 16,
        mainAxisSpacing: 16,
        childAspectRatio: 1.8,
        children: stats,
      );
    }

    return Row(
      children: stats
          .map((card) => Expanded(
                child: Padding(
                  padding: const EdgeInsets.symmetric(horizontal: 6),
                  child: card,
                ),
              ))
          .toList(),
    );
  }

  // --------------------------------------------------------------------------
  // 4 PILLARS FEATURE SECTION
  // --------------------------------------------------------------------------
  Widget _buildFeaturesSection(SocialLandingData data, bool isMobile) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            const LivePill(
              label: 'SOVEREIGN ARCHITECTURE',
              dotColor: AppTheme.accentBlue,
              textColor: AppTheme.accentBlue,
              backgroundColor: Color(0xFFEFF6FF),
              borderColor: Color(0xFFBFDBFE),
            ),
            const SizedBox(height: 10),
            Text(
              'Four Sovereign Pillars',
              style: TextStyle(
                color: AppTheme.textPrimary,
                fontSize: isMobile ? 22 : 28,
                fontWeight: FontWeight.w900,
                letterSpacing: -0.5,
              ),
            ),
          ],
        ),
        const SizedBox(height: 24),
        if (isMobile)
          Column(
            children: data.features
                .map((f) => Padding(
                      padding: const EdgeInsets.only(bottom: 14),
                      child: FeatureCard(feature: f),
                    ))
                .toList(),
          )
        else
          GridView.builder(
            shrinkWrap: true,
            physics: const NeverScrollableScrollPhysics(),
            gridDelegate: const SliverGridDelegateWithFixedCrossAxisCount(
              crossAxisCount: 2,
              crossAxisSpacing: 20,
              mainAxisSpacing: 20,
              childAspectRatio: 1.7,
            ),
            itemCount: data.features.length,
            itemBuilder: (context, index) {
              return FeatureCard(feature: data.features[index]);
            },
          ),
      ],
    );
  }

  // --------------------------------------------------------------------------
  // SHOWCASE: STREAM SWITCHER & EMERGENCY SOS BANNER
  // --------------------------------------------------------------------------
  Widget _buildShowcaseSection(SocialLandingData data, bool isMobile) {
    // Determine active stream posts
    List<SamplePost> activePosts = [];
    if (data.streams.containsKey(_activeChannel) && data.streams[_activeChannel]!.isNotEmpty) {
      activePosts = data.streams[_activeChannel]!.map(SamplePost.fromStreamPost).toList();
    } else {
      activePosts = data.samplePosts;
    }

    final channels = [
      {'key': 'world', 'label': '🌍 World'},
      {'key': 'nearby', 'label': '📍 Ward 19'},
      {'key': 'friends', 'label': '👥 Friends'},
      {'key': 'emergency_sos', 'label': '🚨 SOS Drill'},
    ];

    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(
          'Live Hyperlocal Experience',
          style: TextStyle(
            color: AppTheme.textPrimary,
            fontSize: isMobile ? 22 : 28,
            fontWeight: FontWeight.w900,
            letterSpacing: -0.5,
          ),
        ),
        const SizedBox(height: 6),
        const Text(
          'Experience verified civic communication without algorithms, rage-bait, or corporate tracking.',
          style: TextStyle(
            color: AppTheme.textSecondary,
            fontSize: 14,
          ),
        ),
        const SizedBox(height: 20),

        // Stream Channel Switcher Tab Bar
        SingleChildScrollView(
          scrollDirection: Axis.horizontal,
          child: Row(
            children: channels.map((c) {
              final isSelected = _activeChannel == c['key'];
              return Padding(
                padding: const EdgeInsets.only(right: 10),
                child: ChoiceChip(
                  label: Text(c['label']!),
                  selected: isSelected,
                  onSelected: (selected) {
                    if (selected) {
                      setState(() {
                        _activeChannel = c['key']!;
                      });
                    }
                  },
                  selectedColor: AppTheme.accentBlue,
                  labelStyle: TextStyle(
                    color: isSelected ? Colors.white : AppTheme.textSecondary,
                    fontWeight: FontWeight.w800,
                    fontSize: 12.5,
                  ),
                  backgroundColor: Colors.white,
                  side: BorderSide(
                    color: isSelected ? AppTheme.accentBlue : AppTheme.borderSubtle,
                  ),
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(14),
                  ),
                ),
              );
            }).toList(),
          ),
        ),

        const SizedBox(height: 24),

        if (isMobile) ...[
          // Emergency SOS Banner
          EmergencySosBanner(telemetry: data.sosTelemetry),
          const SizedBox(height: 20),
          // Stream Posts
          if (activePosts.isNotEmpty)
            ...activePosts.map((post) => Padding(
                  padding: const EdgeInsets.only(bottom: 16),
                  child: SamplePostCard(post: post),
                ))
          else
            const Center(
              child: Padding(
                padding: EdgeInsets.all(24.0),
                child: Text('No posts in this stream yet.'),
              ),
            ),
        ] else ...[
          Row(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              // Left: Emergency SOS Showcase Banner
              Expanded(
                flex: 5,
                child: EmergencySosBanner(telemetry: data.sosTelemetry),
              ),
              const SizedBox(width: 24),
              // Right: Active Stream Posts
              Expanded(
                flex: 6,
                child: activePosts.isNotEmpty
                    ? Column(
                        children: activePosts
                            .map((post) => Padding(
                                  padding: const EdgeInsets.only(bottom: 16),
                                  child: SamplePostCard(post: post),
                                ))
                            .toList(),
                      )
                    : const SizedBox.shrink(),
              ),
            ],
          ),
        ],
      ],
    );
  }

  // --------------------------------------------------------------------------
  // FOOTER (White Glassmorphic)
  // --------------------------------------------------------------------------
  Widget _buildFooter(SocialLandingData data, bool isMobile) {
    return Container(
      padding: const EdgeInsets.only(top: 32),
      decoration: const BoxDecoration(
        border: Border(
          top: BorderSide(color: AppTheme.borderSubtle, width: 1),
        ),
      ),
      child: Column(
        children: [
          Row(
            mainAxisAlignment:
                isMobile ? MainAxisAlignment.center : MainAxisAlignment.spaceBetween,
            children: [
              Row(
                children: [
                  Container(
                    width: 30,
                    height: 30,
                    decoration: BoxDecoration(
                      gradient: AppTheme.primaryGradient,
                      borderRadius: BorderRadius.circular(10),
                    ),
                    child: const Center(
                      child: Text(
                        'Z',
                        style: TextStyle(
                          color: Colors.white,
                          fontWeight: FontWeight.w900,
                          fontSize: 15,
                        ),
                      ),
                    ),
                  ),
                  const SizedBox(width: 8),
                  const Text(
                    'Zengfy.Social',
                    style: TextStyle(
                      color: AppTheme.textPrimary,
                      fontWeight: FontWeight.w800,
                      fontSize: 15,
                    ),
                  ),
                ],
              ),
              if (!isMobile)
                const Text(
                  '© 2026 Zengfy Inc. Bangladesh Sovereign Civic Network.',
                  style: TextStyle(
                    color: AppTheme.textMuted,
                    fontSize: 12,
                  ),
                ),
            ],
          ),
          if (isMobile) ...[
            const SizedBox(height: 12),
            const Text(
              '© 2026 Zengfy Inc. Bangladesh Sovereign Civic Network.',
              style: TextStyle(
                color: AppTheme.textMuted,
                fontSize: 11.5,
              ),
              textAlign: TextAlign.center,
            ),
          ],
        ],
      ),
    );
  }
}