<?php

namespace Modules\Team\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamLoginController extends Controller
{
    /**
     * Show the team admin login form.
     * 
     * @return View|\Illuminate\Http\RedirectResponse
     */
    public function showLoginForm()
    {
        // Check if the user is already authenticated via the 'team' guard
        if (Auth::guard('team')->check()) {
            return redirect()->route('team.admin.index');
        }
        return view('team::login');
    }

    /**
     * Authenticate the team admin user.
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Use the dedicated 'team' guard for authentication
        if (Auth::guard('team')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('team.admin.index'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('team')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('team.public');
    }
}
