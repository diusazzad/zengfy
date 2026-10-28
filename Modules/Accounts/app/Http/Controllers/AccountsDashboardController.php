<?php

namespace Modules\Accounts\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Modules\Auth\Models\AuthDevice;
use Modules\Accounts\Models\AccountSetting;
use Modules\Accounts\Models\AccountSecurityLog;

class AccountsDashboardController extends Controller
{
    /**
     * Display the Google-style Sovereign Accounts Hub.
     */
    public function dashboard(Request $request)
    {
        $user = Auth::user();

        // 1. Ensure user has account settings
        $settings = AccountSetting::firstOrCreate(
            ['user_id' => $user->id],
            [
                'theme' => 'light',
                'locale' => 'bn',
                'two_factor_enabled' => false,
                'two_factor_method' => 'authenticator',
                'login_alerts' => true,
                'recovery_phone' => $user->phone ?? null,
                'extra_attributes' => [
                    'allow_ecosystem_sync' => true,
                    'profile_completion_prompt_dismissed' => false,
                ],
            ]
        );

        // 2. Active devices & login sessions
        $activeDevices = AuthDevice::where('user_id', $user->id)
            ->orderBy('last_active_at', 'desc')
            ->take(8)
            ->get();

        // 3. Security audit logs (latest 5)
        $securityLogs = AccountSecurityLog::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // 4. Calculate Profile Completion & Missing Fields
        $completionScore = 0;
        $missingFields = [];

        if (!empty($user->name)) $completionScore += 20;
        if (!empty($user->email_verified_at)) $completionScore += 20;

        if (!empty($user->phone)) {
            $completionScore += 20;
        } else {
            $missingFields[] = [
                'key' => 'phone',
                'label' => 'মোবাইল নম্বর',
                'hint' => 'জরুরি অ্যাকাউন্ট পুনরুদ্ধারের জন্য মোবাইল নম্বর যোগ করুন',
                'icon' => 'phone'
            ];
        }

        if (!empty($user->date_of_birth) && !empty($user->gender)) {
            $completionScore += 20;
        } else {
            $missingFields[] = [
                'key' => 'identity',
                'label' => 'জন্মতারিখ ও লিঙ্গ',
                'hint' => 'সার্বভৌম নাগরিক যাচাইয়ের জন্য তথ্য পূরণ করুন',
                'icon' => 'user'
            ];
        }

        if (!empty($user->avatar)) {
            $completionScore += 20;
        } else {
            $missingFields[] = [
                'key' => 'avatar',
                'label' => 'প্রোফাইল ছবি',
                'hint' => 'আপনার একক সার্বভৌম প্রোফাইল ছবি যুক্ত করুন',
                'icon' => 'camera'
            ];
        }

        $profileCompletion = [
            'score' => $completionScore,
            'is_complete' => $completionScore >= 100,
            'missing_fields' => $missingFields,
        ];

        // 5. Dynamic Ecosystem Links with current host & port
        $baseDomain = config('app.base_domain', env('APP_BASE_DOMAIN', 'zengfy.top'));
        $scheme = $request->getScheme();
        $port = $request->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";

        $homeUrl = "{$scheme}://{$baseDomain}{$portSuffix}/";
        $socialUrl = "{$scheme}://social.{$baseDomain}{$portSuffix}/";
        $accountUrl = "{$scheme}://accounts.{$baseDomain}{$portSuffix}/";

        $ecosystemApps = [
            [
                'id' => 'social',
                'name' => 'Zengfy Social',
                'category' => 'Community & Feed',
                'desc' => 'সার্বভৌম কমিউনিটি ফিড, পোস্ট ও মেসেজিং',
                'icon' => 'globe',
                'icon_bg' => 'bg-blue-50 text-blue-600',
                'url' => $socialUrl,
                'badge' => 'Active',
            ],
            [
                'id' => 'school',
                'name' => 'School ERP',
                'category' => 'Education',
                'desc' => 'শিক্ষার্থী তথ্য, হাজিরা ও গ্রেডিং সিস্টেম',
                'icon' => 'graduation-cap',
                'icon_bg' => 'bg-amber-50 text-amber-600',
                'url' => "{$scheme}://school.{$baseDomain}{$portSuffix}/",
                'badge' => 'Live Demo',
            ],
            [
                'id' => 'law',
                'name' => 'Legal Practice',
                'category' => 'Law Vault',
                'desc' => 'কেস ডায়েরি, শুনানি ও আইনি নথি ভল্ট',
                'icon' => 'scale',
                'icon_bg' => 'bg-indigo-50 text-indigo-600',
                'url' => "{$scheme}://law.{$baseDomain}{$portSuffix}/",
                'badge' => 'Live Demo',
            ],
            [
                'id' => 'pos',
                'name' => 'Retail POS',
                'category' => 'Commerce',
                'desc' => 'বারকোড বিলিং, ইনভেন্টরি ও রসিদ প্রিন্ট',
                'icon' => 'shopping-cart',
                'icon_bg' => 'bg-emerald-50 text-emerald-600',
                'url' => "{$scheme}://pos.{$baseDomain}{$portSuffix}/",
                'badge' => 'Live Demo',
            ],
            [
                'id' => 'civil',
                'name' => 'Civil 3D',
                'category' => 'Engineering',
                'desc' => 'ব্লু-প্রিন্ট, ৩D মডেলিং ও সাইট ক্যালকুলেশন',
                'icon' => 'building-2',
                'icon_bg' => 'bg-cyan-50 text-cyan-600',
                'url' => "{$scheme}://civil.{$baseDomain}{$portSuffix}/",
                'badge' => 'Live Demo',
            ],
            [
                'id' => 'ecommerce',
                'name' => 'Ecommerce',
                'category' => 'Online Store',
                'desc' => 'অনলাইন শপ, কার্ট ও পেমেন্ট গেটওয়ে',
                'icon' => 'shopping-bag',
                'icon_bg' => 'bg-rose-50 text-rose-600',
                'url' => "{$scheme}://ecommerce.{$baseDomain}{$portSuffix}/",
                'badge' => 'Module',
            ],
            [
                'id' => 'hotel',
                'name' => 'Hotel Booking',
                'category' => 'Hospitality',
                'desc' => 'রুম বুকিং ও গেস্ট ম্যানেজমেন্ট সিস্টেম',
                'icon' => 'bed',
                'icon_bg' => 'bg-purple-50 text-purple-600',
                'url' => "{$scheme}://hotel.{$baseDomain}{$portSuffix}/",
                'badge' => 'Module',
            ],
            [
                'id' => 'rent',
                'name' => 'Rent Portal',
                'category' => 'Property',
                'desc' => 'বাড়ি ও ফ্ল্যাট ভাড়া ম্যানেজমেন্ট',
                'icon' => 'home',
                'icon_bg' => 'bg-teal-50 text-teal-600',
                'url' => "{$scheme}://rent.{$baseDomain}{$portSuffix}/",
                'badge' => 'Module',
            ],
            [
                'id' => 'ngo',
                'name' => 'NGO Relief',
                'category' => 'Social Welfare',
                'desc' => 'ত্রাণ বিতরণ ও ডোনেশন ট্র্যাকার',
                'icon' => 'heart-handshake',
                'icon_bg' => 'bg-orange-50 text-orange-600',
                'url' => "{$scheme}://ngo.{$baseDomain}{$portSuffix}/",
                'badge' => 'Module',
            ],
            [
                'id' => 'mobile',
                'name' => 'Android App',
                'category' => 'Mobile APK',
                'desc' => 'বায়োমেট্রিক স্ক্যান ও পুশ অ্যালার্ট',
                'icon' => 'smartphone',
                'icon_bg' => 'bg-sky-50 text-sky-600',
                'url' => "{$scheme}://{$baseDomain}{$portSuffix}/download",
                'badge' => 'v1.0 APK',
            ],
        ];

        // 6. Central Billing & Subscription Dataset (Google/Odoo Style Demo Hub)
        $billingData = [
            'wallet_balance' => 250.00,
            'primary_payment_method' => [
                'type' => 'bkash',
                'name' => 'bKash Wallet',
                'account_number' => '0171***429',
                'is_default' => true,
            ],
            'saved_methods' => [
                ['id' => 'pm_1', 'type' => 'bkash', 'name' => 'bKash Wallet', 'masked' => '0171***429', 'is_default' => true],
                ['id' => 'pm_2', 'type' => 'nagad', 'name' => 'Nagad Account', 'masked' => '0182***812', 'is_default' => false],
                ['id' => 'pm_3', 'type' => 'visa', 'name' => 'City Bank Visa Debit', 'masked' => '**** **** **** 4892', 'is_default' => false],
            ],
            'subscriptions' => [
                [
                    'id' => 'sub_social_badge',
                    'module' => 'social',
                    'module_name' => 'Zengfy Social',
                    'plan_name' => 'ভেরিফাইড সিটিজেন ব্লু ব্যাজ (NID Verified)',
                    'price' => '৳ ৫০',
                    'interval' => 'মাসিক',
                    'status' => 'active',
                    'status_label' => 'সক্রিয় (Active)',
                    'status_color' => 'emerald',
                    'badge' => 'Verified Citizen',
                    'next_billing' => '২০ নভেম্বর, ২০২৬',
                    'features' => [
                        'ব্লু টিক ভেরিফাইড প্রোফাইল ও ট্রাস্ট ব্যাজ',
                        'হাইপারলোকাল ওয়ার্ড পোলে সরাসরি ভোটাধিকার',
                        'সোশ্যাল ফিডে প্রায়োরিটি অ্যালগরিদম প্লেসমেন্ট',
                    ],
                    'auto_renew' => true,
                ],
                [
                    'id' => 'sub_school_pro',
                    'module' => 'school',
                    'module_name' => 'Zengfy School ERP',
                    'tenant_name' => 'ধানমন্ডি মডেল স্কুল ও কলেজ (Tenant)',
                    'plan_name' => 'School Pro ERP (৫০০+ শিক্ষার্থী)',
                    'price' => '৳ ১,৫০০',
                    'interval' => 'মাসিক',
                    'status' => 'active',
                    'status_label' => 'সক্রিয় (Active)',
                    'status_color' => 'emerald',
                    'next_billing' => '০১ নভেম্বর, ২০২৬',
                    'features' => [
                        'ডিজিটাল স্মার্ট হাজিরা ও স্বয়ংক্রিয় এসএমএস গেটওয়ে',
                        'অনলাইন ফি ও টিউশন কালেকশন রসিদ প্রিন্ট',
                        'টার্ম ফাইনাল গ্রেডিং ও ডিজিটাল মার্কশিট জেনারেটর',
                    ],
                    'auto_renew' => true,
                ],
                [
                    'id' => 'sub_law_trial',
                    'module' => 'law',
                    'module_name' => 'Zengfy Legal Practice',
                    'tenant_name' => 'হোসাইন & অ্যাসোসিয়েটস ল চেম্বার',
                    'plan_name' => 'Law Vault & Case Diary (১৪ দিনের ফ্রি ট্রায়াল)',
                    'price' => '৳ ১,০০০',
                    'interval' => 'মাসিক',
                    'status' => 'trialing',
                    'status_label' => 'ফ্রি ট্রায়াল (৪ দিন বাকি)',
                    'status_color' => 'amber',
                    'next_billing' => '২৫ অক্টোবর, ২০২৬ (ট্রায়াল সমাপ্ত)',
                    'features' => [
                        'স্মার্ট কেস ডায়রি ও দৈনিক আদালতের কার্যতালিকা (Cause List)',
                        'ক্লায়েন্ট ফি ভল্ট ও আইনি ড্রাফট ডকুমেন্ট',
                        'কনফিডেনশিয়াল এনক্রিপ্টেড কেস আর্কাইভ',
                    ],
                    'auto_renew' => false,
                ],
            ],
            'invoices' => [
                [
                    'id' => 'inv_104',
                    'invoice_no' => 'ZENG-INV-2026-104',
                    'product' => 'Zengfy School ERP Pro Plan',
                    'date' => '১০ অক্টোবর, ২০২৬',
                    'amount' => '৳ ১,৫০০.০০',
                    'method' => 'bKash (TrxID: 9X48194)',
                    'status' => 'paid',
                    'status_label' => 'পরিশোধিত (Paid)',
                ],
                [
                    'id' => 'inv_089',
                    'invoice_no' => 'ZENG-INV-2026-089',
                    'product' => 'Social Verified Citizen Badge',
                    'date' => '১৫ সেপ্টেম্বর, ২০২৬',
                    'amount' => '৳ ৫০.০০',
                    'method' => 'Nagad (TrxID: NG83018)',
                    'status' => 'paid',
                    'status_label' => 'পরিশোধিত (Paid)',
                ],
                [
                    'id' => 'inv_042',
                    'invoice_no' => 'ZENG-INV-2026-042',
                    'product' => 'SMS Gateway Credit Pack (500 SMS)',
                    'date' => '০১ সেপ্টেম্বর, ২০২৬',
                    'amount' => '৳ ১২৫.০০',
                    'method' => 'bKash (TrxID: 8B90184)',
                    'status' => 'paid',
                    'status_label' => 'পরিশোধিত (Paid)',
                ],
            ],
        ];

        // Format user for JSON hydration
        $userData = [
            'id' => $user->id,
            'name' => $user->name,
            'handle' => $user->handle,
            'email' => $user->email,
            'phone' => $user->phone,
            'bio' => $user->bio,
            'avatar_url' => $user->avatar_url,
            'date_of_birth' => $user->date_of_birth,
            'gender' => $user->gender,
            'ward_code' => $user->ward_code,
            'city' => $user->city,
            'email_verified_at' => $user->email_verified_at,
            'nid_verified' => !empty($user->nid_verified),
            'two_factor_enabled' => $settings->two_factor_enabled,
            'recovery_email' => $settings->recovery_email,
        ];

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'user' => $userData,
                'settings' => $settings,
                'devices' => $activeDevices,
                'ecosystem_apps' => $ecosystemApps,
                'profile_completion' => $profileCompletion,
                'billing' => $billingData,
            ]);
        }

        $view = view()->exists('accounts::dashboard') ? 'accounts::dashboard' : 'account.dashboard';
        return view($view, compact(
            'user',
            'userData',
            'settings',
            'activeDevices',
            'securityLogs',
            'profileCompletion',
            'ecosystemApps',
            'billingData',
            'homeUrl',
            'socialUrl',
            'accountUrl'
        ));
    }

    /**
     * Simulate Subscription Payment or Renewal (Demo).
     */
    public function simulateSubscribe(Request $request)
    {
        $planId = $request->input('plan_id', 'sub_social_badge');
        $gateway = $request->input('gateway', 'bkash');

        return response()->json([
            'success' => true,
            'message' => 'পেমেন্ট সফলভাবে সম্পন্ন হয়েছে! আপনার সাবস্ক্রিপশন সক্রিয় করা হয়েছে।',
            'transaction_id' => 'TRX-' . strtoupper(bin2hex(random_bytes(4))) . '-' . strtoupper($gateway),
        ]);
    }

    /**
     * Update User Profile Details.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'handle' => 'nullable|string|max:50|alpha_dash|unique:users,handle,' . $user->id,
            'bio' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:30',
            'date_of_birth' => 'nullable|date|before:today',
            'gender' => 'nullable|in:male,female,other',
            'ward_code' => 'nullable|string|max:50',
            'city' => 'nullable|string|max:100',
            'recovery_email' => 'nullable|email|max:255',
        ]);

        // Update core user attributes
        $userUpdates = [
            'name' => $validated['name'],
            'handle' => $validated['handle'] ?? $user->handle,
            'bio' => $validated['bio'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'ward_code' => $validated['ward_code'] ?? null,
            'city' => $validated['city'] ?? null,
        ];

        if (!empty($validated['date_of_birth'])) {
            $userUpdates['date_of_birth'] = $validated['date_of_birth'];
        }
        if (!empty($validated['gender'])) {
            $userUpdates['gender'] = $validated['gender'];
        }

        $user->update($userUpdates);

        // Update settings attributes (e.g. recovery email)
        if (isset($validated['recovery_email'])) {
            AccountSetting::where('user_id', $user->id)->update([
                'recovery_email' => $validated['recovery_email'] ?: null,
            ]);
        }

        // Log audit event
        AccountSecurityLog::create([
            'user_id' => $user->id,
            'event_type' => 'profile_updated',
            'ip_address' => $request->ip(),
            'device_name' => substr($request->userAgent() ?? 'Web Client', 0, 100),
            'status' => 'success',
            'details' => ['fields' => array_keys($userUpdates)],
            'created_at' => now(),
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'প্রোফাইল তথ্য সফলভাবে আপডেট হয়েছে।',
                'user' => $user->fresh(),
            ]);
        }

        return redirect()->back()->with('success', 'প্রোফাইল তথ্য সফলভাবে আপডেট হয়েছে।');
    }

    /**
     * Update Profile Photo.
     */
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
        ]);

        $user = Auth::user();

        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $path = $request->file('avatar')->store('avatars', 'public');
        $user->update(['avatar' => $path]);

        AccountSecurityLog::create([
            'user_id' => $user->id,
            'event_type' => 'avatar_updated',
            'ip_address' => $request->ip(),
            'device_name' => substr($request->userAgent() ?? 'Web Client', 0, 100),
            'status' => 'success',
            'created_at' => now(),
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'প্রোফাইল ছবি সফলভাবে আপডেট হয়েছে!',
                'avatar_url' => $user->avatar_url,
            ]);
        }

        return redirect()->back()->with('success', 'প্রোফাইল ছবি সফলভাবে আপডেট হয়েছে!');
    }

    /**
     * Remove Profile Photo.
     */
    public function removeAvatar(Request $request)
    {
        $user = Auth::user();

        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->update(['avatar' => null]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'প্রোফাইল ছবি মুছে ফেলা হয়েছে।',
            ]);
        }

        return redirect()->back()->with('success', 'প্রোফাইল ছবি মুছে ফেলা হয়েছে।');
    }

    /**
     * Change Password.
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'বর্তমান পাসওয়ার্ডটি সঠিক নয়।',
                ], 422);
            }
            return redirect()->back()->withErrors(['current_password' => 'বর্তমান পাসওয়ার্ডটি সঠিক নয়।']);
        }

        $user->update(['password' => Hash::make($request->password)]);

        AccountSecurityLog::create([
            'user_id' => $user->id,
            'event_type' => 'password_change',
            'ip_address' => $request->ip(),
            'device_name' => substr($request->userAgent() ?? 'Web Client', 0, 100),
            'status' => 'success',
            'created_at' => now(),
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'পাসওয়ার্ড সফলভাবে পরিবর্তন করা হয়েছে।',
            ]);
        }

        return redirect()->back()->with('success', 'পাসওয়ার্ড সফলভাবে পরিবর্তন করা হয়েছে।');
    }

    /**
     * Toggle Two-Factor Authentication (2FA).
     */
    public function toggleTwoFactor(Request $request)
    {
        $user = Auth::user();
        $settings = AccountSetting::firstOrCreate(['user_id' => $user->id]);

        $nextState = !$settings->two_factor_enabled;

        $settings->update([
            'two_factor_enabled' => $nextState,
            'two_factor_confirmed_at' => $nextState ? now() : null,
        ]);

        AccountSecurityLog::create([
            'user_id' => $user->id,
            'event_type' => $nextState ? '2fa_enabled' : '2fa_disabled',
            'ip_address' => $request->ip(),
            'device_name' => substr($request->userAgent() ?? 'Web Client', 0, 100),
            'status' => 'success',
            'created_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'two_factor_enabled' => $nextState,
            'message' => $nextState ? '২-ধাপ যাচাইকরণ (2FA) চালু করা হয়েছে।' : '২-ধাপ যাচাইকরণ (2FA) নিষ্ক্রিয় করা হয়েছে।',
        ]);
    }

    /**
     * Revoke single device session.
     */
    public function revokeDevice(Request $request, $id)
    {
        $user = Auth::user();

        $device = AuthDevice::where('user_id', $user->id)->where('id', $id)->first();
        if ($device) {
            $deviceName = $device->device_name;
            $device->delete();

            AccountSecurityLog::create([
                'user_id' => $user->id,
                'event_type' => 'device_revoked',
                'ip_address' => $request->ip(),
                'device_name' => $deviceName,
                'status' => 'success',
                'created_at' => now(),
            ]);
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'ডিভাইস সেশন বন্ধ করা হয়েছে।',
            ]);
        }

        return redirect()->back()->with('success', 'ডিভাইস সেশন বন্ধ করা হয়েছে।');
    }

    /**
     * Revoke all other active devices.
     */
    public function revokeAllOtherDevices(Request $request)
    {
        $user = Auth::user();

        AuthDevice::where('user_id', $user->id)->delete();

        AccountSecurityLog::create([
            'user_id' => $user->id,
            'event_type' => 'all_devices_revoked',
            'ip_address' => $request->ip(),
            'status' => 'success',
            'created_at' => now(),
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'অন্যান্য সকল ডিভাইস থেকে সেশন বন্ধ করা হয়েছে।',
            ]);
        }

        return redirect()->back()->with('success', 'অন্যান্য সকল ডিভাইস থেকে সেশন বন্ধ করা হয়েছে।');
    }
}