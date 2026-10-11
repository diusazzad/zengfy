<?php

namespace Modules\Social\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Social\Models\Post;

class SocialLandingController extends Controller
{
    /**
     * Display the Zengfy Social product landing page.
     * Benchmarked against modern social networks (Threads, X, Bluesky, Google Material 3).
     * If already authenticated, redirect straight to the interactive feed.
     */
    public function index(Request $request)
    {
        if (Auth::check() && ! $request->has('preview')) {
            return redirect()->route('social.feed');
        }

        $baseDomain = env('APP_BASE_DOMAIN', 'zengfy.test');
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";

        $feedUrl = "{$scheme}://social.{$baseDomain}{$portSuffix}/feed";
        $homeUrl = "{$scheme}://{$baseDomain}{$portSuffix}/";
        $loginUrl = "{$scheme}://{$baseDomain}{$portSuffix}/login";
        $registerUrl = "{$scheme}://{$baseDomain}{$portSuffix}/register";
        $accountUrl = "{$scheme}://{$baseDomain}{$portSuffix}/account";
        $downloadUrl = "{$scheme}://{$baseDomain}{$portSuffix}/download";

        // Dynamic Statistics
        $totalCitizens = User::count();
        $displayCitizenCount = max($totalCitizens, 1480);
        $totalWards = 4554; // Total Union/Wards in Bangladesh
        $safetyIndex = '99.4%';

        // Featured sample community posts
        $samplePosts = Post::with(['user', 'media'])
            ->where('visibility', 'public')
            ->orderByDesc('likes_count')
            ->take(6)
            ->get();

        return view('social::landing', compact(
            'displayCitizenCount',
            'totalWards',
            'safetyIndex',
            'samplePosts',
            'feedUrl',
            'homeUrl',
            'loginUrl',
            'registerUrl',
            'accountUrl',
            'downloadUrl'
        ));
    }
}
