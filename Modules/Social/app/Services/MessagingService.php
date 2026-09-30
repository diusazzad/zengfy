<?php

namespace Modules\Social\Services;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Pagination\CursorPaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Modules\Social\Events\MessageSent;
use Modules\Social\Events\UserTyping;
use Modules\Social\Models\Conversation;
use Modules\Social\Models\ConversationParticipant;
use Modules\Social\Models\Message;

class MessagingService
{
    /**
     * Get or create a 1-on-1 direct conversation between two citizens.
     */
    public function getOrCreateDirectConversation(User $userA, User $userB): Conversation
    {
        if ($userA->id === $userB->id) {
            throw new \InvalidArgumentException('Cannot start a direct conversation with yourself.');
        }

        // Find existing conversation shared by both users
        $existing = Conversation::where('type', 'direct')
            ->whereHas('participants', function ($q) use ($userA) {
                $q->where('user_id', $userA->id);
            })
            ->whereHas('participants', function ($q) use ($userB) {
                $q->where('user_id', $userB->id);
            })
            ->first();

        if ($existing) {
            return $existing->load(['users:id,name,handle,avatar,verified_badge', 'latestMessage']);
        }

        return DB::transaction(function () use ($userA, $userB) {
            $conversation = Conversation::create([
                'type' => 'direct',
                'last_message_at' => now(),
            ]);

            ConversationParticipant::create([
                'conversation_id' => $conversation->id,
                'user_id' => $userA->id,
                'last_read_at' => now(),
            ]);

            ConversationParticipant::create([
                'conversation_id' => $conversation->id,
                'user_id' => $userB->id,
                'last_read_at' => null,
            ]);

            return $conversation->load(['users:id,name,handle,avatar,verified_badge']);
        });
    }

    /**
     * Send a real-time message and broadcast to WebSocket channel.
     */
    public function sendMessage(
        User $sender,
        string $conversationId,
        string $body,
        string $type = 'text',
        array $metadata = []
    ): Message {
        $participant = ConversationParticipant::where('conversation_id', $conversationId)
            ->where('user_id', $sender->id)
            ->first();

        if (!$participant) {
            throw new AuthorizationException('You are not a participant in this conversation.');
        }

        $message = DB::transaction(function () use ($sender, $conversationId, $body, $type, $metadata, $participant) {
            $msg = Message::create([
                'conversation_id' => $conversationId,
                'sender_id' => $sender->id,
                'body' => trim($body),
                'message_type' => $type,
                'metadata' => !empty($metadata) ? $metadata : null,
                'is_read' => false,
            ]);

            Conversation::where('id', $conversationId)->update([
                'last_message_at' => now(),
            ]);

            $participant->update(['last_read_at' => now()]);

            return $msg;
        });

        $message->load('sender:id,name,handle,avatar,verified_badge');

        // Broadcast real-time WebSocket event
        broadcast(new MessageSent($message))->toOthers();

        return $message;
    }

    /**
     * Get paginated messages for a conversation via keyset/cursor pagination.
     */
    public function getConversationMessages(
        string $conversationId,
        User $viewer,
        int $perPage = 25,
        ?string $cursor = null
    ): CursorPaginator {
        $isParticipant = ConversationParticipant::where('conversation_id', $conversationId)
            ->where('user_id', $viewer->id)
            ->exists();

        if (!$isParticipant) {
            throw new AuthorizationException('You are not authorized to view messages in this conversation.');
        }

        $perPage = min(max($perPage, 1), 100);

        return Message::with('sender:id,name,handle,avatar,verified_badge')
            ->where('conversation_id', $conversationId)
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->cursorPaginate($perPage, ['*'], 'cursor', $cursor);
    }

    /**
     * List all conversations for the authenticated citizen with unread counts.
     */
    public function getUserConversations(User $user): Collection
    {
        $conversations = Conversation::whereHas('participants', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })
        ->with([
            'users:id,name,handle,avatar,verified_badge',
            'latestMessage.sender:id,name,handle',
            'participants' => function ($q) use ($user) {
                $q->where('user_id', $user->id);
            }
        ])
        ->orderByDesc('last_message_at')
        ->get();

        return $conversations->map(function ($convo) use ($user) {
            $myParticipant = $convo->participants->first();
            $lastReadAt = $myParticipant?->last_read_at;

            $unreadCount = $lastReadAt
                ? Message::where('conversation_id', $convo->id)
                    ->where('sender_id', '!=', $user->id)
                    ->where('created_at', '>', $lastReadAt)
                    ->count()
                : Message::where('conversation_id', $convo->id)
                    ->where('sender_id', '!=', $user->id)
                    ->count();

            // Direct partner user
            $partner = $convo->users->firstWhere('id', '!=', $user->id);

            return [
                'id' => $convo->id,
                'type' => $convo->type,
                'partner' => $partner ? [
                    'id' => $partner->id,
                    'name' => $partner->name,
                    'handle' => $partner->handle,
                    'avatar' => $partner->avatar,
                    'verified_badge' => (bool) $partner->verified_badge,
                ] : null,
                'latest_message' => $convo->latestMessage ? [
                    'id' => $convo->latestMessage->id,
                    'body' => $convo->latestMessage->body,
                    'message_type' => $convo->latestMessage->message_type,
                    'created_at' => $convo->latestMessage->created_at?->toIso8601String(),
                    'sender_name' => $convo->latestMessage->sender?->name,
                ] : null,
                'unread_count' => $unreadCount,
                'last_message_at' => $convo->last_message_at?->toIso8601String(),
            ];
        });
    }

    /**
     * Broadcast live typing indicator.
     */
    public function broadcastTyping(User $user, string $conversationId, bool $isTyping = true): void
    {
        $isParticipant = ConversationParticipant::where('conversation_id', $conversationId)
            ->where('user_id', $user->id)
            ->exists();

        if (!$isParticipant) {
            throw new AuthorizationException('Not a participant in this conversation.');
        }

        broadcast(new UserTyping($user, $conversationId, $isTyping))->toOthers();
    }

    /**
     * Mark conversation as read by the user.
     */
    public function markAsRead(User $user, string $conversationId): void
    {
        ConversationParticipant::where('conversation_id', $conversationId)
            ->where('user_id', $user->id)
            ->update(['last_read_at' => now()]);

        Message::where('conversation_id', $conversationId)
            ->where('sender_id', '!=', $user->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);
    }
}
