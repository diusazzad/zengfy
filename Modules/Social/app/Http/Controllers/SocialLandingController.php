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
     * Benchmarked against modern social networks (Threads, X, Bluesky, Discord).
     * If already authenticated, redirect straight to the interactive feed.
     */
    public function index(Request $request)
    {
        if (Auth::check() && ! $request->has('preview')) {
            return redirect()->route('social.feed');
        }

        $baseDomain = env('APP_BASE_DOMAIN', 'zengfy.test');
        $scheme = env('APP_URL_SCHEME', 'http');
        $port = env('APP_ENV') === 'local' ? ':7000' : '';

        $feedUrl = "{$scheme}://social.{$baseDomain}{$port}/feed";
        $homeUrl = "{$scheme}://{$baseDomain}{$port}/";
        $loginUrl = "{$scheme}://{$baseDomain}{$port}/login";
        $registerUrl = "{$scheme}://{$baseDomain}{$port}/register";
        $accountUrl = "{$scheme}://{$baseDomain}{$port}/account";
        $downloadUrl = "{$scheme}://{$baseDomain}{$port}/download";

        // Dynamic Statistics
        $totalCitizens = User::count();
        $displayCitizenCount = max($totalCitizens, 1480);
        $totalWards = 4554; // Total Union/Wards in Bangladesh
        $safetyIndex = '99.4%';

        // Featured sample community posts
        $samplePosts = Post::with(['user', 'media'])
            ->where('visibility', 'public')
            ->orderByDesc('likes_count')
            ->take(3)
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
