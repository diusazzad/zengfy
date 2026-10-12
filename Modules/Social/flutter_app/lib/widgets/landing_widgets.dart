import 'package:flutter/material.dart';
import '../models/social_landing_data.dart';
import '../theme/app_theme.dart';

/// Reusable White Glassmorphic Card (#F8FAFC canvas compatible)
class GlassCard extends StatelessWidget {
  final Widget child;
  final EdgeInsetsGeometry? padding;
  final EdgeInsetsGeometry? margin;
  final double borderRadius;
  final Color? backgroundColor;
  final Border? border;
  final LinearGradient? topGradientBar;

  const GlassCard({
    super.key,
    required this.child,
    this.padding,
    this.margin,
    this.borderRadius = 18.0,
    this.backgroundColor,
    this.border,
    this.topGradientBar,
  });

  @override
  Widget build(BuildContext context) {
    Widget content = child;

    if (topGradientBar != null) {
      content = Column(
        mainAxisSize: MainAxisSize.min,
        crossAxisAlignment: CrossAxisAlignment.stretch,
        children: [
          Container(
            height: 3,
            decoration: BoxDecoration(
              gradient: topGradientBar,
              borderRadius: BorderRadius.only(
                topLeft: Radius.circular(borderRadius),
                topRight: Radius.circular(borderRadius),
              ),
            ),
          ),
          child,
        ],
      );
    }

    return Container(
      margin: margin,
      padding: padding ?? const EdgeInsets.all(20.0),
      decoration: BoxDecoration(
        color: backgroundColor ?? AppTheme.surfaceCard,
        borderRadius: BorderRadius.circular(borderRadius),
        border: border ?? Border.all(color: AppTheme.borderSubtle, width: 1),
        boxShadow: AppTheme.cardShadow,
      ),
      child: content,
    );
  }
}

/// Dynamic Pulsing Live Badge Indicator
class LivePill extends StatelessWidget {
  final String label;
  final Color dotColor;
  final Color textColor;
  final Color backgroundColor;
  final Color borderColor;

  const LivePill({
    super.key,
    required this.label,
    this.dotColor = AppTheme.accentEmerald,
    this.textColor = AppTheme.accentEmerald,
    this.backgroundColor = const Color(0x1A10B981),
    this.borderColor = const Color(0x3310B981),
  });

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 4),
      decoration: BoxDecoration(
        color: backgroundColor,
        borderRadius: BorderRadius.circular(20),
        border: Border.all(color: borderColor, width: 1),
      ),
      child: Row(
        mainAxisSize: MainAxisSize.min,
        children: [
          Container(
            width: 6,
            height: 6,
            decoration: BoxDecoration(
              color: dotColor,
              shape: BoxShape.circle,
              boxShadow: [
                BoxShadow(
                  color: dotColor.withValues(alpha: 0.6),
                  blurRadius: 4,
                  spreadRadius: 1,
                ),
              ],
            ),
          ),
          const SizedBox(width: 6),
          Text(
            label,
            style: TextStyle(
              color: textColor,
              fontSize: 11,
              fontWeight: FontWeight.w800,
              letterSpacing: 0.3,
            ),
          ),
        ],
      ),
    );
  }
}

/// Live Stat Card
class StatCard extends StatelessWidget {
  final String label;
  final String value;
  final String subtitle;
  final IconData icon;
  final Color accentColor;

  const StatCard({
    super.key,
    required this.label,
    required this.value,
    required this.subtitle,
    required this.icon,
    this.accentColor = AppTheme.accentBlue,
  });

  @override
  Widget build(BuildContext context) {
    return GlassCard(
      padding: const EdgeInsets.all(20),
      borderRadius: 18,
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        mainAxisSize: MainAxisSize.min,
        children: [
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              Expanded(
                child: Text(
                  label.toUpperCase(),
                  style: const TextStyle(
                    color: AppTheme.textMuted,
                    fontSize: 11,
                    fontWeight: FontWeight.w700,
                    letterSpacing: 0.8,
                  ),
                  overflow: TextOverflow.ellipsis,
                ),
              ),
              const SizedBox(width: 8),
              Container(
                padding: const EdgeInsets.all(8),
                decoration: BoxDecoration(
                  color: accentColor.withValues(alpha: 0.1),
                  borderRadius: BorderRadius.circular(10),
                  border: Border.all(color: accentColor.withValues(alpha: 0.2)),
                ),
                child: Icon(icon, size: 16, color: accentColor),
              ),
            ],
          ),
          const SizedBox(height: 12),
          Text(
            value,
            style: const TextStyle(
              color: AppTheme.textPrimary,
              fontSize: 26,
              fontWeight: FontWeight.w900,
              letterSpacing: -0.5,
            ),
          ),
          const SizedBox(height: 4),
          Text(
            subtitle,
            style: TextStyle(
              color: accentColor,
              fontSize: 12,
              fontWeight: FontWeight.w700,
            ),
            overflow: TextOverflow.ellipsis,
          ),
        ],
      ),
    );
  }
}

/// 4 Pillars Feature Card
class FeatureCard extends StatelessWidget {
  final SocialFeature feature;

  const FeatureCard({super.key, required this.feature});

  IconData _getIconData(String iconName) {
    switch (iconName) {
      case 'sparkles':
      case 'globe-alt':
        return Icons.auto_awesome_rounded;
      case 'badge-check':
      case 'shield-check':
        return Icons.verified_user_rounded;
      case 'map-pin':
      case 'shield-exclamation':
        return Icons.location_on_rounded;
      case 'lock':
      case 'chat-bubble-left-right':
        return Icons.lock_outline_rounded;
      default:
        return Icons.scatter_plot_rounded;
    }
  }

  Color _getTagColor(String tag) {
    if (tag.contains('Live') || tag.contains('Chronology')) return AppTheme.accentEmerald;
    if (tag.contains('NID') || tag.contains('Bot')) return AppTheme.accentBlue;
    if (tag.contains('Wards') || tag.contains('Priority')) return AppTheme.accentIndigo;
    if (tag.contains('Vault') || tag.contains('End-to-End')) return AppTheme.accentCyan;
    return AppTheme.accentBlue;
  }

  @override
  Widget build(BuildContext context) {
    final tagColor = _getTagColor(feature.tag);
    final iconData = _getIconData(feature.icon);

    return GlassCard(
      padding: const EdgeInsets.all(22),
      borderRadius: 18,
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        mainAxisSize: MainAxisSize.min,
        children: [
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              Container(
                width: 42,
                height: 42,
                decoration: BoxDecoration(
                  color: tagColor.withValues(alpha: 0.1),
                  borderRadius: BorderRadius.circular(12),
                  border: Border.all(color: tagColor.withValues(alpha: 0.2)),
                ),
                child: Icon(iconData, color: tagColor, size: 20),
              ),
              const SizedBox(width: 8),
              Flexible(
                child: Container(
                  padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 4),
                  decoration: BoxDecoration(
                    color: tagColor.withValues(alpha: 0.08),
                    borderRadius: BorderRadius.circular(20),
                    border: Border.all(color: tagColor.withValues(alpha: 0.2)),
                  ),
                  child: Text(
                    feature.tag,
                    style: TextStyle(
                      color: tagColor,
                      fontSize: 11,
                      fontWeight: FontWeight.w700,
                    ),
                    overflow: TextOverflow.ellipsis,
                  ),
                ),
              ),
            ],
          ),
          const SizedBox(height: 16),
          Text(
            feature.title,
            style: const TextStyle(
              color: AppTheme.textPrimary,
              fontSize: 17,
              fontWeight: FontWeight.w800,
            ),
          ),
          const SizedBox(height: 6),
          Text(
            feature.description,
            style: const TextStyle(
              color: AppTheme.textSecondary,
              fontSize: 13,
              height: 1.5,
            ),
          ),
        ],
      ),
    );
  }
}

/// Interactive Feed Post Card with Real Reactions
class SamplePostCard extends StatefulWidget {
  final SamplePost post;

  const SamplePostCard({super.key, required this.post});

  @override
  State<SamplePostCard> createState() => _SamplePostCardState();
}

class _SamplePostCardState extends State<SamplePostCard> {
  late Map<String, int> _reactions;
  late int _likesCount;
  bool _userLiked = false;

  @override
  void initState() {
    super.initState();
    _reactions = Map.from(widget.post.reactions);
    _likesCount = widget.post.likesCount;
  }

  void _handleReaction(String emoji) {
    setState(() {
      final current = _reactions[emoji] ?? 0;
      _reactions[emoji] = current + 1;
      if (emoji == '❤️') {
        _likesCount += 1;
        _userLiked = true;
      }
    });
  }

  @override
  Widget build(BuildContext context) {
    final post = widget.post;

    return GlassCard(
      topGradientBar: const LinearGradient(
        colors: [AppTheme.accentBlue, AppTheme.accentCyan],
      ),
      padding: const EdgeInsets.all(20),
      borderRadius: 18,
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        mainAxisSize: MainAxisSize.min,
        children: [
          // Author Header
          Row(
            children: [
              // Avatar with Initials
              Container(
                width: 40,
                height: 40,
                decoration: BoxDecoration(
                  gradient: const LinearGradient(
                    colors: [Color(0xFFDBEAFE), Color(0xFFE0E7FF)],
                  ),
                  borderRadius: BorderRadius.circular(12),
                  border: Border.all(color: const Color(0xFFBFDBFE)),
                ),
                child: Center(
                  child: Text(
                    post.initials.isNotEmpty ? post.initials : 'ZC',
                    style: const TextStyle(
                      color: AppTheme.accentBlue,
                      fontWeight: FontWeight.w900,
                      fontSize: 14,
                    ),
                  ),
                ),
              ),
              const SizedBox(width: 10),
              Expanded(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Row(
                      children: [
                        Flexible(
                          child: Text(
                            post.author.name,
                            style: const TextStyle(
                              color: AppTheme.textPrimary,
                              fontWeight: FontWeight.w800,
                              fontSize: 13.5,
                            ),
                            overflow: TextOverflow.ellipsis,
                            maxLines: 1,
                          ),
                        ),
                        if (post.author.isVerified) ...[
                          const SizedBox(width: 4),
                          const Icon(
                            Icons.verified_rounded,
                            color: AppTheme.accentBlue,
                            size: 14,
                          ),
                        ],
                      ],
                    ),
                    const SizedBox(height: 2),
                    Text(
                      '@${post.author.handle} • ${post.createdAt}',
                      style: const TextStyle(
                        color: AppTheme.textMuted,
                        fontSize: 11,
                      ),
                      overflow: TextOverflow.ellipsis,
                      maxLines: 1,
                    ),
                  ],
                ),
              ),
              const SizedBox(width: 8),
              // Ward Tag (Constrained for small screens)
              ConstrainedBox(
                constraints: const BoxConstraints(maxWidth: 120),
                child: Container(
                  padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 3.5),
                  decoration: BoxDecoration(
                    color: const Color(0xFFEFF6FF),
                    borderRadius: BorderRadius.circular(14),
                    border: Border.all(color: const Color(0xFFBFDBFE)),
                  ),
                  child: Row(
                    mainAxisSize: MainAxisSize.min,
                    children: [
                      const Icon(Icons.location_on_rounded, size: 10.5, color: AppTheme.accentBlue),
                      const SizedBox(width: 3),
                      Flexible(
                        child: Text(
                          post.wardCode,
                          style: const TextStyle(
                            color: AppTheme.accentBlue,
                            fontSize: 10,
                            fontWeight: FontWeight.w700,
                          ),
                          overflow: TextOverflow.ellipsis,
                          maxLines: 1,
                        ),
                      ),
                    ],
                  ),
                ),
              ),
            ],
          ),
          const SizedBox(height: 14),

          // Post Content
          Text(
            post.content,
            style: const TextStyle(
              color: AppTheme.textPrimary,
              fontSize: 13.5,
              height: 1.55,
            ),
          ),
          const SizedBox(height: 16),

          // Emoji Reactions Pill Bar
          Wrap(
            spacing: 8,
            runSpacing: 8,
            children: [
              ..._reactions.entries.map((entry) {
                return InkWell(
                  onTap: () => _handleReaction(entry.key),
                  borderRadius: BorderRadius.circular(16),
                  child: Container(
                    padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 5),
                    decoration: BoxDecoration(
                      color: AppTheme.surfaceSubtle,
                      borderRadius: BorderRadius.circular(16),
                      border: Border.all(color: AppTheme.borderSubtle),
                    ),
                    child: Row(
                      mainAxisSize: MainAxisSize.min,
                      children: [
                        Text(entry.key, style: const TextStyle(fontSize: 13)),
                        const SizedBox(width: 4),
                        Text(
                          entry.value.toString(),
                          style: const TextStyle(
                            color: AppTheme.textPrimary,
                            fontSize: 11.5,
                            fontWeight: FontWeight.w700,
                          ),
                        ),
                      ],
                    ),
                  ),
                );
              }),
              if (_reactions.isEmpty)
                InkWell(
                  onTap: () => _handleReaction('❤️'),
                  borderRadius: BorderRadius.circular(16),
                  child: Container(
                    padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 5),
                    decoration: BoxDecoration(
                      color: _userLiked ? const Color(0xFFFFE4E6) : AppTheme.surfaceSubtle,
                      borderRadius: BorderRadius.circular(16),
                      border: Border.all(
                        color: _userLiked ? const Color(0xFFFDA4AF) : AppTheme.borderSubtle,
                      ),
                    ),
                    child: Row(
                      mainAxisSize: MainAxisSize.min,
                      children: [
                        const Text('❤️', style: TextStyle(fontSize: 13)),
                        const SizedBox(width: 4),
                        Text(
                          _likesCount.toString(),
                          style: TextStyle(
                            color: _userLiked ? AppTheme.accentRose : AppTheme.textPrimary,
                            fontSize: 11.5,
                            fontWeight: FontWeight.w700,
                          ),
                        ),
                      ],
                    ),
                  ),
                ),
            ],
          ),

          const SizedBox(height: 14),
          const Divider(color: AppTheme.borderSubtle, height: 1),
          const SizedBox(height: 12),

          // Action Stats Footer
          Wrap(
            alignment: WrapAlignment.spaceBetween,
            runAlignment: WrapAlignment.center,
            crossAxisAlignment: WrapCrossAlignment.center,
            spacing: 12,
            runSpacing: 8,
            children: [
              Row(
                mainAxisSize: MainAxisSize.min,
                children: [
                  const Icon(Icons.chat_bubble_outline_rounded, size: 14, color: AppTheme.textMuted),
                  const SizedBox(width: 5),
                  Text(
                    '${post.commentsCount} comments',
                    style: const TextStyle(
                      color: AppTheme.textSecondary,
                      fontSize: 11.5,
                      fontWeight: FontWeight.w600,
                    ),
                  ),
                ],
              ),
              const Row(
                mainAxisSize: MainAxisSize.min,
                children: [
                  Icon(Icons.shield_rounded, size: 13, color: AppTheme.accentEmerald),
                  SizedBox(width: 4),
                  Text(
                    '256-bit Verified',
                    style: TextStyle(
                      color: AppTheme.accentEmerald,
                      fontSize: 11,
                      fontWeight: FontWeight.w700,
                    ),
                  ),
                ],
              ),
            ],
          ),
        ],
      ),
    );
  }
}

/// Interactive Emergency SOS Showcase Banner with Telemetry
class EmergencySosBanner extends StatefulWidget {
  final SosTelemetry? telemetry;
  final VoidCallback? onDistressTrigger;

  const EmergencySosBanner({super.key, this.telemetry, this.onDistressTrigger});

  @override
  State<EmergencySosBanner> createState() => _EmergencySosBannerState();
}

class _EmergencySosBannerState extends State<EmergencySosBanner> {
  bool _isTriggered = false;

  void _triggerBeacon() {
    setState(() {
      _isTriggered = true;
    });

    widget.onDistressTrigger?.call();

    Future.delayed(const Duration(seconds: 5), () {
      if (mounted) {
        setState(() {
          _isTriggered = false;
        });
      }
    });
  }

  @override
  Widget build(BuildContext context) {
    final responseTime = widget.telemetry?.averageResponseTime ?? '3.2s';
    final responders = widget.telemetry?.activeRespondersOnline ?? 34;
    final radius = widget.telemetry?.broadcastRadiusMeters ?? 750;

    return Container(
      padding: const EdgeInsets.all(22),
      decoration: BoxDecoration(
        color: const Color(0xFFFFF1F2), // soft rose/50
        borderRadius: BorderRadius.circular(18),
        border: Border.all(color: const Color(0xFFFECDD3), width: 1.2),
        boxShadow: const [
          BoxShadow(
            color: Color(0x14E11D48),
            blurRadius: 20,
            offset: Offset(0, 8),
          ),
        ],
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        mainAxisSize: MainAxisSize.min,
        children: [
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              Flexible(
                child: Row(
                  mainAxisSize: MainAxisSize.min,
                  children: [
                    Container(
                      width: 32,
                      height: 32,
                      decoration: BoxDecoration(
                        color: AppTheme.accentRose.withValues(alpha: 0.15),
                        shape: BoxShape.circle,
                      ),
                      child: const Icon(
                        Icons.crisis_alert_rounded,
                        color: AppTheme.accentRose,
                        size: 17,
                      ),
                    ),
                    const SizedBox(width: 8),
                    const Flexible(
                      child: Text(
                        'EMERGENCY SOS HUB',
                        style: TextStyle(
                          color: AppTheme.accentRose,
                          fontWeight: FontWeight.w900,
                          fontSize: 12,
                          letterSpacing: 0.8,
                        ),
                        overflow: TextOverflow.ellipsis,
                      ),
                    ),
                  ],
                ),
              ),
              const SizedBox(width: 8),
              const LivePill(
                label: 'ACTIVE MESH',
                dotColor: AppTheme.accentRose,
                textColor: AppTheme.accentRose,
                backgroundColor: Color(0x26E11D48),
                borderColor: Color(0x4DE11D48),
              ),
            ],
          ),
          const SizedBox(height: 12),
          const Text(
            'Single-Tap Sovereign Distress Signal',
            style: TextStyle(
              color: AppTheme.textPrimary,
              fontSize: 17.5,
              fontWeight: FontWeight.w800,
            ),
          ),
          const SizedBox(height: 5),
          const Text(
            'Instant broadcast to Ward 19 rapid civic responders, verified neighborhood doctors, and emergency mesh coordinators.',
            style: TextStyle(
              color: AppTheme.textSecondary,
              fontSize: 13,
              height: 1.45,
            ),
          ),
          const SizedBox(height: 16),

          // Telemetry Strip
          Container(
            padding: const EdgeInsets.symmetric(horizontal: 14, vertical: 10),
            decoration: BoxDecoration(
              color: Colors.white,
              borderRadius: BorderRadius.circular(12),
              border: Border.all(color: const Color(0xFFFEE2E2)),
            ),
            child: Row(
              children: [
                Expanded(child: _buildTelemetryItem('Response', responseTime, Icons.bolt_rounded)),
                Container(width: 1, height: 24, color: const Color(0xFFFEE2E2)),
                Expanded(child: _buildTelemetryItem('Sentinels', '$responders online', Icons.shield_rounded)),
                Container(width: 1, height: 24, color: const Color(0xFFFEE2E2)),
                Expanded(child: _buildTelemetryItem('Radius', '${radius}m', Icons.radar_rounded)),
              ],
            ),
          ),

          const SizedBox(height: 16),
          _isTriggered
              ? Container(
                  width: double.infinity,
                  padding: const EdgeInsets.symmetric(vertical: 12, horizontal: 16),
                  decoration: BoxDecoration(
                    color: const Color(0xFFE11D48),
                    borderRadius: BorderRadius.circular(12),
                  ),
                  child: const Row(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      SizedBox(
                        width: 14,
                        height: 14,
                        child: CircularProgressIndicator(
                          strokeWidth: 2,
                          valueColor: AlwaysStoppedAnimation<Color>(Colors.white),
                        ),
                      ),
                      SizedBox(width: 8),
                      Flexible(
                        child: Text(
                          'Beacon Active: Ward 19 Responders Notified',
                          style: TextStyle(
                            color: Colors.white,
                            fontWeight: FontWeight.w800,
                            fontSize: 12.5,
                          ),
                          overflow: TextOverflow.ellipsis,
                        ),
                      ),
                    ],
                  ),
                )
              : ElevatedButton.icon(
                  onPressed: _triggerBeacon,
                  style: ElevatedButton.styleFrom(
                    backgroundColor: const Color(0xFFE11D48),
                    foregroundColor: Colors.white,
                    padding: const EdgeInsets.symmetric(vertical: 12, horizontal: 20),
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(12),
                    ),
                    elevation: 4,
                    shadowColor: const Color(0x4DE11D48),
                  ),
                  icon: const Icon(Icons.crisis_alert_rounded, size: 16),
                  label: const Text(
                    'Simulate SOS Distress Beacon',
                    style: TextStyle(
                      fontWeight: FontWeight.w800,
                      fontSize: 12.5,
                    ),
                  ),
                ),
        ],
      ),
    );
  }

  Widget _buildTelemetryItem(String label, String value, IconData icon) {
    return Column(
      mainAxisSize: MainAxisSize.min,
      children: [
        Row(
          mainAxisSize: MainAxisSize.min,
          children: [
            Icon(icon, size: 12, color: AppTheme.accentRose),
            const SizedBox(width: 4),
            Flexible(
              child: Text(
                label,
                style: const TextStyle(
                  color: AppTheme.textMuted,
                  fontSize: 10.5,
                  fontWeight: FontWeight.w700,
                ),
                overflow: TextOverflow.ellipsis,
              ),
            ),
          ],
        ),
        const SizedBox(height: 2),
        Text(
          value,
          style: const TextStyle(
            color: AppTheme.textPrimary,
            fontSize: 11.5,
            fontWeight: FontWeight.w800,
          ),
          overflow: TextOverflow.ellipsis,
          maxLines: 1,
        ),
      ],
    );
  }
}