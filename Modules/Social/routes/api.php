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

/*
|--------------------------------------------------------------------------
| Social Module API Routes (v1)
|--------------------------------------------------------------------------
|
| Handles Headless Social Graph, Dynamic Feeds, Posts, Media, Hyperlocal Notices,
| Direct Messaging, and Emergency SOS Distress Dispatching.
|
*/

Route::prefix('v1')->group(function () {

    // Public / Hybrid Profile & Graph
    Route::get('/users/{identifier}/profile', [ProfileController::class, 'show'])
        ->name('api.v1.users.profile.show');

    Route::get('/users/{id}/followers', [FollowController::class, 'followers'])
        ->name('api.v1.users.followers');

    Route::get('/users/{id}/following', [FollowController::class, 'following'])
        ->name('api.v1.users.following');

    Route::get('/users/{id}/friends', [FriendshipController::class, 'friends'])
        ->name('api.v1.users.friends');

    // Authenticated Social Operations
    Route::middleware('auth:sanctum')->group(function () {
        Route::put('/profile', [ProfileController::class, 'update'])
            ->name('api.v1.profile.update');

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

        Route::delete('/users/{id}/friends', [FriendshipController::class, 'removeFriend'])
            ->name('api.v1.users.friends.remove');

        // Post & Media endpoints (Authenticated)
        Route::post('/media/presign', [MediaController::class, 'presign'])
            ->name('api.v1.media.presign');

        Route::post('/posts', [PostController::class, 'store'])
            ->name('api.v1.posts.store');

        Route::delete('/posts/{id}', [PostController::class, 'destroy'])
            ->name('api.v1.posts.destroy');

        Route::post('/posts/{id}/like', [PostController::class, 'toggleLike'])
            ->name('api.v1.posts.like');

        // Real-Time Conversations & Messaging endpoints (Authenticated)
        Route::post('/conversations/direct', [ConversationController::class, 'startDirect'])
            ->name('api.v1.conversations.direct');

        Route::get('/conversations', [ConversationController::class, 'index'])
            ->name('api.v1.conversations.index');

        Route::get('/conversations/{id}/messages', [ConversationController::class, 'messages'])
            ->name('api.v1.conversations.messages');

        Route::post('/conversations/{id}/messages', [ConversationController::class, 'sendMessage'])
            ->name('api.v1.conversations.messages.send');

        Route::post('/conversations/{id}/typing', [ConversationController::class, 'typing'])
            ->name('api.v1.conversations.typing');

        Route::post('/conversations/{id}/read', [ConversationController::class, 'markRead'])
            ->name('api.v1.conversations.read');

        // Emergency SOS Distress & Responders (Authenticated)
        Route::post('/emergency/sos', [EmergencySosController::class, 'trigger'])
            ->name('api.v1.emergency.sos.trigger');

        Route::post('/emergency/sos/{id}/resolve', [EmergencySosController::class, 'resolve'])
            ->name('api.v1.emergency.sos.resolve');

        Route::get('/emergency/active', [EmergencySosController::class, 'active'])
            ->name('api.v1.emergency.active');

        Route::get('/emergency/history', [EmergencySosController::class, 'history'])
            ->name('api.v1.emergency.history');

        Route::get('/emergency/contacts', [EmergencySosController::class, 'getContacts'])
            ->name('api.v1.emergency.contacts.index');

        Route::post('/emergency/contacts', [EmergencySosController::class, 'addContact'])
            ->name('api.v1.emergency.contacts.store');

        Route::delete('/emergency/contacts/{id}', [EmergencySosController::class, 'deleteContact'])
            ->name('api.v1.emergency.contacts.destroy');
    });

    // Public / Hybrid Feeds and Posts (Optional Sanctum Auth handled in controller)
    Route::get('/feed', [PostController::class, 'feed'])
        ->name('api.v1.feed');

    Route::get('/feed/hyperlocal/{wardCode}', [HyperlocalController::class, 'feed'])
        ->name('api.v1.feed.hyperlocal');

    Route::get('/feed/hyperlocal/{wardCode}/notices', [HyperlocalController::class, 'notices'])
        ->name('api.v1.feed.hyperlocal.notices');

    Route::get('/feed/hyperlocal/{wardCode}/stats', [HyperlocalController::class, 'stats'])
        ->name('api.v1.feed.hyperlocal.stats');

    Route::get('/users/{identifier}/posts', [PostController::class, 'userPosts'])
        ->name('api.v1.users.posts');

    Route::get('/posts/{id}', [PostController::class, 'show'])
        ->name('api.v1.posts.show');

    // Signed route for local/dev direct media upload
    Route::post('/media/direct-upload', [MediaController::class, 'directUpload'])
        ->name('api.v1.media.direct-upload');
});
