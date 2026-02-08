<?php

namespace Modules\Main\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminVerificationController extends Controller
{
    /**
     * Display a listing of pending verifications.
     */
    public function index()
    {
        $pendingNid = User::whereNotNull('nid_card_path')->where('nid_verified', false)->get();
        $pendingSchool = User::whereNotNull('school_id_path')->where('school_id_verified', false)->get();

        return view('main::admin.verifications', compact('pendingNid', 'pendingSchool'));
    }

    /**
     * Verify a user's identity.
     */
    public function verify(Request $request, User $user)
    {
        $type = $request->input('type');

        if ($type === 'nid') {
            $user->update(['nid_verified' => true]);
            session()->flash('success', "NID for {$user->name} has been verified.");
        } elseif ($type === 'school') {
            $user->update(['school_id_verified' => true]);
            session()->flash('success', "School ID for {$user->name} has been verified.");
        }

        return redirect()->back();
    }

    /**
     * Reject a user's identity verification.
     */
    public function reject(Request $request, User $user)
    {
        $type = $request->input('type');

        if ($type === 'nid') {
            $user->update(['nid_card_path' => null]);
            session()->flash('error', "NID for {$user->name} has been rejected.");
        } elseif ($type === 'school') {
            $user->update(['school_id_path' => null]);
            session()->flash('error', "School ID for {$user->name} has been rejected.");
        }

        return redirect()->back();
    }
}
