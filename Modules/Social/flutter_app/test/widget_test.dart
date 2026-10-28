import 'package:flutter_test/flutter_test.dart';
import 'package:zengfy_social/main.dart';

void main() {
  testWidgets('Renders Zengfy Social App', (WidgetTester tester) async {
    await tester.pumpWidget(const ZengfySocialApp());
    expect(find.textContaining('Zengfy'), findsWidgets);
  });
}