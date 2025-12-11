<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Route;

// Static Pages
Route::get('/', [PageController::class, 'welcome'])->name('welcome');
Route::get('/team', [PageController::class, 'team'])->name('team');
Route::get('/service', [PageController::class, 'team'])->name('service');
Route::get('/download-app', [PageController::class, 'downloadApp'])->name('download.app');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');

Route::get('/signup', [PageController::class, 'signup'])->name('signup');
Route::get('/login', [PageController::class, 'login'])->name('login');
Route::get('/password', [PageController::class, 'password'])->name('password.request');


Route::get('/auth/google/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('auth.google.redirect');

Route::get('/auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->user();

    $user = App\Models\User::updateOrCreate([
        'email' => $googleUser->getEmail(),
    ], [
        'name' => $googleUser->getName(),
        'google_id' => $googleUser->getId(),
    ]);

    Auth::login($user);

    // Redirect to dashboard directly
    return redirect('https://zengfy.top/dashboard');
});


Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
