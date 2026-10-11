<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    /**
     * @deprecated Use Modules\Auth\Http\Controllers\AuthController::showRegister instead.
     */
    public function showRegister(?Request $request = null)
    {
        return app(\Modules\Auth\Http\Controllers\AuthController::class)->showRegister($request ?? request());
    }

    /**
     * Headless SPA Shell for Zengfy Social Feed.
     * All timeline streams, real-time reactions, and cursor pagination
     * are served asynchronously via /api/v1/feed by the React 19 SPA.
     */
    public function showFeed()
    {
        $currentUser = Auth::user();

        return view('social.feed', [
            'currentUser' => $currentUser,
        ]);
    }

    /**
     * Citizen Profile Shell for Zengfy Social.
     */
    public function showProfile(string $handle)
    {
        $viewer = Auth::user();
        $cleanHandle = ltrim($handle, '@');

        $user = User::where('handle', $cleanHandle)
            ->orWhere('id', $cleanHandle)
            ->first();

        if (!$user) {
            $user = (object) [
                'id' => null,
                'name' => ucfirst($cleanHandle),
                'handle' => $cleanHandle,
                'ward_code' => 'WARD-DHAKA-19',
                'bio' => 'Verified sovereign citizen on Zengfy network.',
                'followers_count' => 0,
                'following_count' => 0,
                'friends_count' => 0,
                'verified_badge' => true,
                'avatar_url' => null,
            ];
        }

        return view('social.profile', [
            'user' => $user,
            'viewer' => $viewer,
            'currentUser' => $viewer,
        ]);
    }
}
