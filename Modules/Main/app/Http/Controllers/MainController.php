<?php

namespace Modules\Main\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Main\Models\Post;
use Modules\Main\Models\Like;
use Modules\Main\Models\Comment;
use Modules\Main\Services\TrendingService;

class MainController extends Controller
{
    protected $trendingService;

    public function __construct(TrendingService $trendingService)
    {
        $this->trendingService = $trendingService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(['user', 'comments.user', 'likes'])->latest()->get();
        $trends = $this->trendingService->getTrends();

        return view('main::index', compact('posts', 'trends'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('main::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Real Identity Guard: Only NID verified users can post.
        if (!auth()->user()->nid_verified) {
            return redirect()->back()->with('error', 'আপনার পরিচয় যাচাই (NID Verification) সম্পন্ন হয়নি। পোস্ট করতে দয়া করে অ্যাকাউন্ট সেটিংস থেকে NID আপলোড করুন।');
        }

        $request->validate([
            'body' => 'required|string',
            'image' => 'nullable|image|max:5120',
        ]);

        $data = [
            'user_id' => auth()->id(),
            'body' => $request->body,
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'post_' . auth()->id() . '_' . time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('posts', $filename, 'public');
            $data['image_path'] = '/storage/' . $path;
        }

        \Modules\Main\Models\Post::create($data);

        return redirect()->back()->with('success', 'Post shared successfully!');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('main::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('main::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    }

    /**
     * Toggle like on a post.
     */
    public function toggleLike($postId)
    {
        $userId = auth()->id();
        $like = Like::where('user_id', $userId)->where('post_id', $postId)->first();

        if ($like) {
            $like->delete();
            $post = Post::find($postId);
            $post->decrement('likes_count');
            return response()->json(['status' => 'unliked', 'likes_count' => $post->likes_count]);
        }

        Like::create([
            'user_id' => $userId,
            'post_id' => $postId,
        ]);

        $post = Post::find($postId);
        $post->increment('likes_count');
        return response()->json(['status' => 'liked', 'likes_count' => $post->likes_count]);
    }

    /**
     * Store a comment on a post.
     */
    public function storeComment(Request $request, $postId)
    {
        $request->validate([
            'body' => 'required|string',
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $postId,
            'body' => $request->body,
        ]);

        $post = Post::find($postId);
        $post->increment('comments_count');

        return redirect()->back()->with('success', 'Comment added successfully!');
    }
}
