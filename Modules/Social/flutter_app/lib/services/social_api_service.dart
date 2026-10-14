import 'dart:convert';

import 'package:flutter/foundation.dart';
import 'package:http/http.dart' as http;

import '../models/social_landing_data.dart';

class SocialApiService {
  static List<String> get _endpoints {
    if (!kIsWeb && defaultTargetPlatform == TargetPlatform.android) {
      return const [
        'http://10.0.2.2:8000/api/v1/social/landing',
        'http://127.0.0.1:8000/api/v1/social/landing',
        'http://social.zengfy.top:8000/api/v1/social/landing',
        'http://zengfy.test:8000/api/v1/social/landing',
      ];
    }
    return const [
      'http://127.0.0.1:8000/api/v1/social/landing',
      'http://localhost:8000/api/v1/social/landing',
      'http://social.zengfy.top:8000/api/v1/social/landing',
      'http://10.0.2.2:8000/api/v1/social/landing',
    ];
  }

  /// Fetches landing payload with multi-endpoint fallback & offline resilience
  static Future<SocialLandingData> fetchLandingData() async {
    for (final url in _endpoints) {
      try {
        debugPrint('[SocialApiService] Fetching landing data from: $url');
        final response = await http
            .get(Uri.parse(url), headers: {'Accept': 'application/json'})
            .timeout(const Duration(seconds: 4));

        if (response.statusCode == 200) {
          final decoded = json.decode(response.body) as Map<String, dynamic>;
          debugPrint('[SocialApiService] Successfully fetched data from: $url');
          return SocialLandingData.fromJson(decoded, isLive: true);
        } else {
          debugPrint(
            '[SocialApiService] Non-200 response (${response.statusCode}) from: $url',
          );
        }
      } catch (e) {
        debugPrint('[SocialApiService] Error fetching from $url: $e');
      }
    }

    debugPrint(
      '[SocialApiService] All endpoints failed or timed out. Using fallback data.',
    );
    return SocialLandingData.fallback();
  }
}
