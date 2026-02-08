<?php

namespace Modules\Main\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display the account settings page.
     */
    public function index()
    {
        return view('main::account');
    }

    /**
     * Update the user's account information.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
            'nid_card' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'school_id' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
        ]);

        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
        ];

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = 'avatar_' . $user->id . '_' . time() . '.' . $avatar->getClientOriginalExtension();
            $path = $avatar->storeAs('avatars', $filename, 'public');
            $data['avatar'] = '/storage/' . $path;
        }

        if ($request->hasFile('nid_card')) {
            $nid = $request->file('nid_card');
            $filename = 'nid_' . $user->id . '_' . time() . '.' . $nid->getClientOriginalExtension();
            $path = $nid->storeAs('verifications', $filename, 'private'); // Store in private disk for security
            $data['nid_card_path'] = $path;
        }

        if ($request->hasFile('school_id')) {
            $sid = $request->file('school_id');
            $filename = 'school_id_' . $user->id . '_' . time() . '.' . $sid->getClientOriginalExtension();
            $path = $sid->storeAs('verifications', $filename, 'private');
            $data['school_id_path'] = $path;
        }

        $user->update($data);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
