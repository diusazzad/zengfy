<?php

use Illuminate\Support\Facades\Route;
use Modules\Social\Http\Controllers\ConversationController;
use Modules\Social\Http\Controllers\EmergencySosController;
use Modules\Social\Http\Controllers\FollowController;
use Modules\Social\Http\Controllers\FriendshipController;
use Modules\Social\Http\Controllers\HyperlocalController;
use Modules\Social\Http\Controllers\MediaController;
use Modules\Social\Http\Controllers\PostController;
use Modules\Social\Http\Controllers\ProfileController;
use Modules\Social\Http\Controllers\SocialLandingController;

/*
|--------------------------------------------------------------------------
| Social Module REST API Routes (v1)
|--------------------------------------------------------------------------
|
| Serves social feeds, timeline stream, post creation, reactions, and telemetry.
| Statefully accessible with web session cookies as well as Bearer tokens.
|
*/

Route::prefix('v1')->middleware(['web'])->group(function () {
    // 1. Landing & Showcase Telemetry
    Route::get('/social/landing', [SocialLandingController::class, 'data'])
        ->name('api.v1.social.landing');
    Route::get('/social', [SocialLandingController::class, 'data'])
        ->name('api.v1.social');

    // 2. Feeds & Hyperlocal Timeline
    Route::get('/feed', [PostController::class, 'feed'])
        ->name('api.v1.feed');
    Route::get('/feed/hyperlocal/{wardCode}', [HyperlocalController::class, 'feed'])
        ->name('api.v1.feed.hyperlocal');
    Route::get('/feed/hyperlocal/{wardCode}/notices', [HyperlocalController::class, 'notices'])
        ->name('api.v1.feed.hyperlocal.notices');
    Route::get('/feed/hyperlocal/{wardCode}/stats', [HyperlocalController::class, 'stats'])
        ->name('api.v1.feed.hyperlocal.stats');

    // 3. Posts & Media Operations
    Route::post('/posts', [PostController::class, 'store'])
        ->name('api.v1.posts.store');
    Route::get('/posts/{id}', [PostController::class, 'show'])
        ->name('api.v1.posts.show');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])
        ->name('api.v1.posts.destroy');
    Route::post('/posts/{id}/like', [PostController::class, 'toggleLike'])
        ->name('api.v1.posts.like');
    Route::get('/users/{identifier}/posts', [PostController::class, 'userPosts'])
        ->name('api.v1.users.posts');
    Route::post('/media/direct-upload', [MediaController::class, 'directUpload'])
        ->name('api.v1.media.direct-upload');

    // 4. Social Graph & Interactions
    Route::get('/users/{identifier}/profile', [ProfileController::class, 'show'])
        ->name('api.v1.users.profile.show');
    Route::post('/users/{id}/follow', [FollowController::class, 'follow'])
        ->name('api.v1.users.follow');
    Route::delete('/users/{id}/follow', [FollowController::class, 'unfollow'])
        ->name('api.v1.users.unfollow');
    Route::post('/users/{id}/friend-request', [FriendshipController::class, 'sendRequest'])
        ->name('api.v1.users.friend-request.send');
    Route::get('/friend-requests', [FriendshipController::class, 'pendingRequests'])
        ->name('api.v1.friend-requests.index');
    Route::post('/friend-requests/{id}/accept', [FriendshipController::class, 'acceptRequest'])
        ->name('api.v1.friend-requests.accept');
    Route::post('/friend-requests/{id}/decline', [FriendshipController::class, 'declineRequest'])
        ->name('api.v1.friend-requests.decline');

    // 5. Emergency SOS Hub
    Route::post('/emergency/sos', [EmergencySosController::class, 'trigger'])
        ->name('api.v1.emergency.sos.trigger');
    Route::post('/emergency/sos/{id}/resolve', [EmergencySosController::class, 'resolve'])
        ->name('api.v1.emergency.sos.resolve');
    Route::get('/emergency/active', [EmergencySosController::class, 'active'])
        ->name('api.v1.emergency.active');
});