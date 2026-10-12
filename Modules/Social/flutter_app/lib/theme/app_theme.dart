import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';

class AppTheme {
  // White Glassmorphic Palette (#F8FAFC canvas & frosted glass)
  static const Color canvasBg = Color(0xFFF8FAFC);
  static const Color surfaceCard = Color(0xFFFFFFFF);
  static const Color surfaceFrosted = Color(0xF2FFFFFF); // 95% White
  static const Color surfaceCardHover = Color(0xFFF1F5F9);
  static const Color surfaceSubtle = Color(0xFFF1F5F9); // Slate 100

  // Borders
  static const Color borderSubtle = Color(0xFFE2E8F0); // Slate 200
  static const Color borderFrosted = Color(0xCCFFFFFF);
  static const Color borderHover = Color(0xFFCBD5E1);  // Slate 300

  // Accent Colors
  static const Color accentBlue = Color(0xFF2563EB);   // Brand Primary
  static const Color accentCyan = Color(0xFF0284C7);   // Sky Blue
  static const Color accentIndigo = Color(0xFF4F46E5); // Indigo
  static const Color accentRose = Color(0xFFE11D48);   // Emergency SOS
  static const Color accentEmerald = Color(0xFF059669);// Verified Sovereign
  static const Color accentAmber = Color(0xFFD97706);  // Notice / Advisory

  // High-Contrast Slate Typography
  static const Color textPrimary = Color(0xFF0F172A);   // Slate 900
  static const Color textSecondary = Color(0xFF475569); // Slate 600
  static const Color textMuted = Color(0xFF94A3B8);     // Slate 400

  // Backward-compatible alias for existing dark references
  static const Color bgDark = canvasBg;

  // Gradients
  static const LinearGradient primaryGradient = LinearGradient(
    colors: [accentBlue, accentIndigo],
    begin: Alignment.topLeft,
    end: Alignment.bottomRight,
  );

  static const LinearGradient heroGradient = LinearGradient(
    colors: [Color(0xFF2563EB), Color(0xFF4F46E5), Color(0xFF0284C7)],
    begin: Alignment.topLeft,
    end: Alignment.bottomRight,
  );

  static const LinearGradient sosGradient = LinearGradient(
    colors: [Color(0xFFE11D48), Color(0xFFBE123C)],
    begin: Alignment.topLeft,
    end: Alignment.bottomRight,
  );

  static const LinearGradient cardBorderGradient = LinearGradient(
    colors: [Color(0x6693C5FD), Color(0x33A5B4FC), Colors.transparent],
    begin: Alignment.topLeft,
    end: Alignment.bottomRight,
  );

  // Soft Ambient Shadows for Frosted Cards
  static const List<BoxShadow> cardShadow = [
    BoxShadow(
      color: Color(0x0F0F172A),
      blurRadius: 20,
      offset: Offset(0, 8),
    ),
  ];

  static ThemeData get lightTheme {
    final baseTextTheme = ThemeData.light().textTheme;
    final plusJakartaTheme = GoogleFonts.plusJakartaSansTextTheme(baseTextTheme);

    return ThemeData(
      useMaterial3: true,
      brightness: Brightness.light,
      scaffoldBackgroundColor: canvasBg,
      colorScheme: const ColorScheme.light(
        primary: accentBlue,
        secondary: accentCyan,
        surface: surfaceCard,
        error: accentRose,
        onPrimary: Colors.white,
        onSecondary: Colors.white,
        onSurface: textPrimary,
      ),
      textTheme: plusJakartaTheme.copyWith(
        displayLarge: plusJakartaTheme.displayLarge?.copyWith(
          color: textPrimary,
          fontWeight: FontWeight.w900,
          letterSpacing: -1.0,
        ),
        displayMedium: plusJakartaTheme.displayMedium?.copyWith(
          color: textPrimary,
          fontWeight: FontWeight.w800,
          letterSpacing: -0.8,
        ),
        headlineLarge: plusJakartaTheme.headlineLarge?.copyWith(
          color: textPrimary,
          fontWeight: FontWeight.w800,
          letterSpacing: -0.5,
        ),
        headlineMedium: plusJakartaTheme.headlineMedium?.copyWith(
          color: textPrimary,
          fontWeight: FontWeight.w700,
        ),
        titleLarge: plusJakartaTheme.titleLarge?.copyWith(
          color: textPrimary,
          fontWeight: FontWeight.w700,
        ),
        titleMedium: plusJakartaTheme.titleMedium?.copyWith(
          color: textPrimary,
          fontWeight: FontWeight.w600,
        ),
        bodyLarge: plusJakartaTheme.bodyLarge?.copyWith(
          color: textSecondary,
          height: 1.6,
        ),
        bodyMedium: plusJakartaTheme.bodyMedium?.copyWith(
          color: textSecondary,
          height: 1.5,
        ),
        labelLarge: plusJakartaTheme.labelLarge?.copyWith(
          fontWeight: FontWeight.w700,
          letterSpacing: 0.2,
        ),
      ),
    );
  }

  // Backward compatible dark theme reference pointing to light theme
  static ThemeData get darkTheme => lightTheme;
}