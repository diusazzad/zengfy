<?php

namespace Modules\Team\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Team\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class TeamAdminController
 * 
 * Handles administrative CRUD operations for the Team module.
 * Following Laravel's Resource Controller conventions.
 * 
 * @package Modules\Team\Http\Controllers
 */
class TeamAdminController extends Controller
{
    /**
     * Display a listing of the team members.
     * 
     * @return View
     */
    public function index(): View
    {
        // Fetch all team members ordered by their display order
        $teams = Team::orderBy('order')->orderBy('created_at', 'desc')->get();
        
        // Calculate statistics for the dashboard cards
        $stats = [
            'total' => $teams->count(),
            'active' => $teams->where('status', 'active')->count(),
            'inactive' => $teams->where('status', 'inactive')->count(),
        ];

        return view('team::admin.index', compact('teams', 'stats'));
    }

    /**
     * Show the form for creating a new team member.
     * 
     * @return View
     */
    public function create(): View
    {
        return view('team::admin.create');
    }

    /**
     * Store a newly created team member in storage.
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
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
            'order' => 'nullable|integer',
        ]);

        // Handle image upload and conversion to WebP for better performance
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.webp';
            $path = 'team/' . $filename;
            
            // Read and convert image using Intervention Image
            $img = Image::read($image->getRealPath());
            $encoded = $img->toWebp(80);
            Storage::disk('public')->put($path, $encoded);
            
            $validated['image_path'] = $path;
        }

        Team::create($validated);

        return redirect()->route('team.admin.index')
            ->with('success', 'Team member created successfully.');
    }

    /**
     * Display the specified team member.
     * 
     * @param Team $team
     * @return RedirectResponse
     */
    public function show(Team $admin): RedirectResponse
    {
        // We don't need a specific show page for admin, redirect back to index
        return redirect()->route('team.admin.index');
    }

    /**
     * Show the form for editing the specified team member.
     * 
     * @param Team $team
     * @return View
     */
    public function edit(Team $admin): View
    {
        return view('team::admin.edit', ['team' => $admin]);
    }

    /**
     * Update the specified team member in storage.
     * 
     * @param Request $request
     * @param Team $team
     * @return RedirectResponse
     */
    public function update(Request $request, Team $admin): RedirectResponse
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
            'order' => 'nullable|integer',
        ]);

        // Handle image update: delete old image and upload new one
        if ($request->hasFile('image')) {
            if ($admin->image_path) {
                Storage::disk('public')->delete($admin->image_path);
            }
            
            $image = $request->file('image');
            $filename = time() . '.webp';
            $path = 'team/' . $filename;
            
            // Read and convert image
            $img = Image::read($image->getRealPath());
            $encoded = $img->toWebp(80);
            Storage::disk('public')->put($path, $encoded);
            
            $validated['image_path'] = $path;
        }

        $admin->update($validated);

        return redirect()->route('team.admin.index')
            ->with('success', 'Team member updated successfully.');
    }

    /**
     * Remove the specified team member from storage.
     * 
     * @param Team $team
     * @return RedirectResponse
     */
    public function destroy(Team $admin): RedirectResponse
    {
        // Delete associated image from storage
        if ($admin->image_path) {
            Storage::disk('public')->delete($admin->image_path);
        }
        
        $admin->delete();

        return redirect()->route('team.admin.index')
            ->with('success', 'Team member deleted successfully.');
    }
}
