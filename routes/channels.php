<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;
use Modules\Social\Models\ConversationParticipant;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

// Private user channel for direct alerts & notifications
Broadcast::channel('users.{id}', function (User $user, string $id) {
    return (string) $user->id === (string) $id;
});

// Private conversation channel for real-time messaging & typing indicators
Broadcast::channel('chat.{conversationId}', function (User $user, string $conversationId) {
    return ConversationParticipant::where('conversation_id', $conversationId)
        ->where('user_id', $user->id)
        ->exists();
});

// Presence channel for Hyperlocal Ward community (tracks online neighbors)
Broadcast::channel('presence.ward.{wardCode}', function (User $user, string $wardCode) {
    return [
        'id' => $user->id,
        'name' => $user->name,
        'handle' => $user->handle,
        'avatar' => $user->avatar,
        'ward_code' => $wardCode,
    ];
});

// Emergency SOS distress channel (accessible to authenticated citizens & responders)
Broadcast::channel('emergency.radius', function (User $user) {
    return $user !== null;
});

// Default user model channel
Broadcast::channel('App.Models.User.{id}', function (User $user, string $id) {
    return (string) $user->id === (string) $id;
});
