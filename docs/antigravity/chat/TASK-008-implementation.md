Implementation Plan - TASK-008: Cross-Subdomain SSO Ticket Exchange Gateway
Goal Description
Implement an enterprise-grade, single-use cryptographic SSO Ticket Exchange Gateway allowing users authenticated on central zengfy.top to seamlessly transition to ecosystem subdomains (school.zengfy.top, pos.zengfy.top, law.zengfy.top, etc.) without re-entering credentials or exposing long-lived tokens in URLs.

User Review Required
IMPORTANT

Single-Use Replay Defense: Once an SSO ticket is exchanged via /api/v1/auth/sso/exchange, it is atomically deleted from cache. Any second attempt with the same ticket will immediately fail with 401 Unauthorized. Strict Subdomain Whitelisting: Tickets can only be generated for ecosystem-registered subdomains (school, pos, law, social, hotel, rent, civil, ngo, journal, skill, emergency).

Proposed Changes
Central Auth & SSO Module (Modules/Auth)
[NEW] 
SsoController.php
Method generateTicket(Request $request):
Validates target_subdomain against ecosystem whitelist.
Generates a cryptographically secure random token (sso_tkt_ + 48 hex characters).
Caches { user_id, target_subdomain, created_at } with a 60-second TTL.
Returns ApiResponse::success with ticket, expires_in (60), and prepared redirect_url.
Method exchangeTicket(Request $request):
Validates ticket and subdomain.
Atomically retrieves and purges ticket from Cache (Cache::pull).
Verifies ticket existence, non-expiration, and target subdomain match.
Retrieves User, generates a scoped Sanctum token, and registers an AuthDevice session.
Returns ApiResponse::success with user, token, and device metadata.
[MODIFY] 
routes/api.php
Add /api/v1/auth/sso/ticket (Protected by auth:sanctum & throttle:15,1).
Add /api/v1/auth/sso/exchange (Public exchange endpoint protected by throttle:30,1).
[MODIFY] 
docs/api/openapi.yaml
Document POST /api/v1/auth/sso/ticket and POST /api/v1/auth/sso/exchange endpoints with request and response schemas.
[NEW] 
SsoTicketExchangeTest.php
Test 1: Authenticated user can generate an SSO ticket for a valid subdomain (200 OK).
Test 2: Unauthenticated user cannot generate an SSO ticket (401 Unauthorized).
Test 3: Generating a ticket fails for an untrusted/unwhitelisted subdomain (422 Unprocessable Content).
Test 4: Target application can exchange a valid ticket for a scoped session token and device session (200 OK).
Test 5: Replay attack prevention: Exchanging the same ticket a second time fails (401 Unauthorized).
Test 6: Expired ticket rejection: Ticket cannot be exchanged after TTL has expired (401 Unauthorized).
Test 7: Subdomain spoofing prevention: Exchanging a ticket on a mismatched subdomain fails (403 Forbidden).
Verification Plan
Automated Tests
Run the entire Auth test suite:

bash

php artisan test Modules/Auth/tests/Feature/SsoTicketExchangeTest.php
php artisan test Modules/Auth/tests/Feature/RegistrationTest.php Modules/Auth/tests/Feature/LoginTest.php
All tests must pass 100% green.

Master Checklist Update
Mark [x] TASK-008: Cross-Subdomain SSO Ticket Exchange Gateway as complete in 
docs/task/master_engineering_task_checklist.md
.

