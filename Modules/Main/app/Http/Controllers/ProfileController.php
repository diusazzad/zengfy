<?php

namespace Modules\Main\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Modules\Main\Models\Post;

class ProfileController extends Controller
{
    /**
     * Display the specified user's profile.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        $posts = Post::with(['user', 'comments.user', 'likes'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('main::profile', compact('user', 'posts'));
    }
}
