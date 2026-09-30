<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Modules\Auth\Models\AuthDevice;

class AccountController extends Controller
{
    /**
     * Display the Central Sovereign Account Hub / Dashboard.
     */
    public function dashboard(Request $request)
    {
        $user = Auth::user();

        // Retrieve active login sessions & devices
        $activeDevices = AuthDevice::where('user_id', $user->id)
            ->orderBy('last_active_at', 'desc')
            ->take(10)
            ->get();

        // Ecosystem modules with status and launch links
        $baseDomain = env('APP_BASE_DOMAIN', 'zengfy.test');
        $scheme = env('APP_URL_SCHEME', 'http');
        $port = env('APP_ENV') === 'local' ? ':7000' : '';

        $ecosystemApps = [
            [
                'id' => 'social',
                'name' => 'Zengfy Social',
                'category' => 'Community & Feed',
                'desc' => 'NID-verified sovereign community feed, posts, and messaging.',
                'icon' => '🌐',
                'url' => route('social.feed'),
                'badge' => 'Active',
                'badge_color' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
            ],
            [
                'id' => 'identity',
                'name' => 'Sovereign ID',
                'category' => 'Identity & Security',
                'desc' => 'Unified SSO credentials, 256-bit vault, and NID citizen badge.',
                'icon' => '🇧🇩',
                'url' => route('account'),
                'badge' => 'Primary',
                'badge_color' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
            ],
            [
                'id' => 'mobile',
                'name' => 'Android App',
                'category' => 'Mobile APK',
                'desc' => 'Native biometric scanner, ward SOS distress beacon, push alerts.',
                'icon' => '📱',
                'url' => route('download.app'),
                'badge' => 'Alpha v1.0',
                'badge_color' => 'bg-cyan-500/10 text-cyan-400 border-cyan-500/20',
            ],
            [
                'id' => 'school',
                'name' => 'School ERP',
                'category' => 'Education (Deferred)',
                'desc' => 'Student records, exam grading, automated SMS notifications.',
                'icon' => '🏫',
                'url' => '#',
                'badge' => 'Roadmap',
                'badge_color' => 'bg-gray-500/10 text-gray-400 border-gray-500/20',
            ],
            [
                'id' => 'law',
                'name' => 'Legal Practice',
                'category' => 'Law Vault (Deferred)',
                'desc' => 'Court hearing schedules, case diary, encrypted document vault.',
                'icon' => '⚖️',
                'url' => '#',
                'badge' => 'Roadmap',
                'badge_color' => 'bg-gray-500/10 text-gray-400 border-gray-500/20',
            ],
            [
                'id' => 'pos',
                'name' => 'Retail POS',
                'category' => 'Commerce (Deferred)',
                'desc' => 'Multi-location inventory, barcode billing, bKash integration.',
                'icon' => '🛒',
                'url' => '#',
                'badge' => 'Roadmap',
                'badge_color' => 'bg-gray-500/10 text-gray-400 border-gray-500/20',
            ],
        ];

        return view('account.dashboard', compact('user', 'activeDevices', 'ecosystemApps'));
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
            'ward_code' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
        ]);

        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $path;
        }

        $user->update($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully.',
                'avatar_url' => $user->avatar_url,
                'user' => $user->fresh(),
            ]);
        }

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    /**
     * Direct AJAX/Quick Upload for Profile Avatar Photo.
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

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Profile photo updated successfully!',
                'avatar_url' => $user->avatar_url,
            ]);
        }

        return redirect()->back()->with('success', 'Profile photo updated successfully!');
    }

    /**
     * Remove Profile Avatar Photo.
     */
    public function removeAvatar(Request $request)
    {
        $user = Auth::user();

        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->update(['avatar' => null]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Profile photo removed.',
            ]);
        }

        return redirect()->back()->with('success', 'Profile photo removed.');
    }

    /**
     * Change User Password.
     */
    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if (! Hash::check($validated['current_password'], $user->password)) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'The provided current password does not match our records.',
                ], 422);
            }
            return redirect()->back()->withErrors(['current_password' => 'The provided current password does not match our records.']);
        }

        $user->update([
            'password' => Hash::make($validated['new_password']),
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Password changed successfully.',
            ]);
        }

        return redirect()->back()->with('success', 'Password updated securely.');
    }

    /**
     * Revoke a single active device session.
     */
    public function revokeDevice(string $deviceId)
    {
        $user = Auth::user();

        AuthDevice::where('id', $deviceId)
            ->where('user_id', $user->id)
            ->delete();

        return redirect()->back()->with('success', 'Device session has been revoked.');
    }

    /**
     * Revoke all other device sessions (Logout Everywhere Else).
     */
    public function revokeAllOtherDevices(Request $request)
    {
        $user = Auth::user();

        // Keep only the current session device
        AuthDevice::where('user_id', $user->id)
            ->where('user_agent', '!=', $request->userAgent())
            ->delete();

        // Delete all Sanctum personal access tokens
        $user->tokens()->delete();

        return redirect()->back()->with('success', 'All other active sessions have been terminated.');
    }

    /**
     * Web-based logout.
     */
    public function logout(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            $user->tokens()->delete();
        }

        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You have been safely signed out.');
    }
}
