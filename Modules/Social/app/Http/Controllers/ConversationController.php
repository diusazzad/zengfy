<?php

namespace Modules\Social\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Modules\Social\Services\MessagingService;
use Symfony\Component\HttpFoundation\Response;

class ConversationController extends Controller
{
    public function __construct(
        protected MessagingService $messagingService
    ) {}

    /**
     * Start or open a 1-on-1 direct conversation with another citizen.
     */
    public function startDirect(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'target_user_id' => ['required', 'string', 'exists:users,id'],
        ]);

        $targetUser = User::findOrFail($validated['target_user_id']);

        try {
            $conversation = $this->messagingService->getOrCreateDirectConversation(
                userA: $request->user(),
                userB: $targetUser
            );

            return ApiResponse::success($conversation, 'Conversation opened successfully');
        } catch (InvalidArgumentException $e) {
            return ApiResponse::error($e->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY, null, 'INVALID_CONVERSATION');
        }
    }

    /**
     * List authenticated citizen's active conversations.
     */
    public function index(Request $request): JsonResponse
    {
        $conversations = $this->messagingService->getUserConversations($request->user());

        return ApiResponse::success($conversations, 'Conversations retrieved successfully');
    }

    /**
     * Fetch message history for a conversation using keyset cursor pagination.
     */
    public function messages(Request $request, string $id): JsonResponse
    {
        $perPage = (int) $request->query('per_page', 25);
        $cursor = $request->query('cursor');

        try {
            $paginator = $this->messagingService->getConversationMessages(
                conversationId: $id,
                viewer: $request->user(),
                perPage: $perPage,
                cursor: $cursor
            );

            return ApiResponse::success(
                data: $paginator->items(),
                message: 'Messages retrieved successfully',
                extraMeta: [
                    'next_cursor' => $paginator->nextCursor()?->encode(),
                    'prev_cursor' => $paginator->previousCursor()?->encode(),
                    'has_more' => $paginator->hasMorePages(),
                    'per_page' => $paginator->perPage(),
                ]
            );
        } catch (AuthorizationException $e) {
            return ApiResponse::forbidden($e->getMessage());
        }
    }

    /**
     * Send a real-time message to a conversation.
     */
    public function sendMessage(Request $request, string $id): JsonResponse
    {
        $validated = $request->validate([
            'body' => ['required', 'string', 'max:5000'],
            'message_type' => ['sometimes', 'string', 'in:text,image,sos_alert,system'],
            'metadata' => ['sometimes', 'array'],
        ]);

        try {
            $message = $this->messagingService->sendMessage(
                sender: $request->user(),
                conversationId: $id,
                body: $validated['body'],
                type: $validated['message_type'] ?? 'text',
                metadata: $validated['metadata'] ?? []
            );

            return ApiResponse::created($message, 'Message sent and broadcasted successfully');
        } catch (AuthorizationException $e) {
            return ApiResponse::forbidden($e->getMessage());
        }
    }

    /**
     * Broadcast live typing indicator.
     */
    public function typing(Request $request, string $id): JsonResponse
    {
        $validated = $request->validate([
            'is_typing' => ['required', 'boolean'],
        ]);

        try {
            $this->messagingService->broadcastTyping(
                user: $request->user(),
                conversationId: $id,
                isTyping: (bool) $validated['is_typing']
            );

            return ApiResponse::success(null, 'Typing state broadcasted');
        } catch (AuthorizationException $e) {
            return ApiResponse::forbidden($e->getMessage());
        }
    }

    /**
     * Mark all messages in a conversation as read.
     */
    public function markRead(Request $request, string $id): JsonResponse
    {
        $this->messagingService->markAsRead($request->user(), $id);

        return ApiResponse::success(null, 'Conversation marked as read');
    }
}
