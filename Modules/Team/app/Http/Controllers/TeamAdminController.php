<?php

namespace Modules\Team\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Team\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamAdminController extends Controller
{
    /**
     * Display a listing of the team members.
     */
    public function index()
    {
        $teams = Team::orderBy('order')->get();
        return view('team::admin.index', compact('teams'));
    }

    public function create()
    {
        return view('team::admin.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'linkedin_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'facebook_url' => 'nullable|url',
            'status' => 'required|in:active,inactive',
            'order' => 'integer',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('team', 'public');
            $validated['image_path'] = $path;
        }

        Team::create($validated);

        return redirect()->route('team.admin.index')->with('success', 'টিম মেম্বার সফলভাবে যোগ করা হয়েছে।');
    }

    public function edit(Team $team)
    {
        return view('team::admin.edit', compact('team'));
    }

    public function update(Request $request, Team $team)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'linkedin_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'facebook_url' => 'nullable|url',
            'status' => 'required|in:active,inactive',
            'order' => 'integer',
        ]);

        if ($request->hasFile('image')) {
            if ($team->image_path) {
                Storage::disk('public')->delete($team->image_path);
            }
            $path = $request->file('image')->store('team', 'public');
            $validated['image_path'] = $path;
        }

        $team->update($validated);

        return redirect()->route('team.admin.index')->with('success', 'টিম মেম্বারের তথ্য সফলভাবে আপডেট করা হয়েছে।');
    }

    public function destroy(Team $team)
    {
        if ($team->image_path) {
            Storage::disk('public')->delete($team->image_path);
        }
        $team->delete();

        return redirect()->route('team.admin.index')->with('success', 'টিম মেম্বার সফলভাবে ডিলিট করা হয়েছে।');
    }
}
