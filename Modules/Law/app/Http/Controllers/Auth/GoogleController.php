<?php

namespace Modules\Law\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('google_id', $googleUser->id)
                ->orWhere('email', $googleUser->email)
                ->first();

            if ($user) {
                // Update google_id if it's missing (e.g., existing email user logging in via Google)
                if (!$user->google_id) {
                    $user->update(['google_id' => $googleUser->id]);
                }

                Auth::login($user);
            } else {
                // Register a new user
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => Hash::make(Str::random(24)),
                    'account_status' => 'active', // Assuming auto-activate for Google signup
                    'plan' => 'basic', // Default plan
                ]);

                // Assign default role if needed
                // $user->assignRole('user');

                Auth::login($user);
            }

            return redirect()->route('law.dashboard');
        } catch (\Exception $e) {
            return redirect()->route('law.login.google')->with('error', 'Google authentication failed.');
        }
    }
}
