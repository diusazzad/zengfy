import 'package:flutter/material.dart';
import 'package:flutter_test/flutter_test.dart';
import 'package:zengfy_social/main.dart';

void main() {
  group('Zero Layout Overflow Tests', () {
    testWidgets('Mobile Viewport (390 x 844) - Zero Overflow', (tester) async {
      tester.view.physicalSize = const Size(390, 844);
      tester.view.devicePixelRatio = 1.0;
      addTearDown(tester.view.resetPhysicalSize);

      await tester.pumpWidget(const ZengfySocialApp());
      await tester.pumpAndSettle();

      expect(tester.takeException(), isNull);
      expect(find.textContaining('Zengfy'), findsWidgets);
    });

    testWidgets('Desktop Viewport (1440 x 900) - Zero Overflow', (tester) async {
      tester.view.physicalSize = const Size(1440, 900);
      tester.view.devicePixelRatio = 1.0;
      addTearDown(tester.view.resetPhysicalSize);

      await tester.pumpWidget(const ZengfySocialApp());
      await tester.pumpAndSettle();

      expect(tester.takeException(), isNull);
      expect(find.textContaining('Zengfy'), findsWidgets);
    });
  });
