<?php

namespace Modules\Social\Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;
use Modules\Social\Events\MessageSent;
use Modules\Social\Events\UserTyping;
use Modules\Social\Models\Conversation;
use Modules\Social\Models\ConversationParticipant;
use Modules\Social\Models\Message;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class RealTimeMessagingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Cache::flush();
        require_once base_path('routes/channels.php');
    }

    protected function tearDown(): void
    {
        Cache::flush();
        parent::tearDown();
    }

    protected function createUser(array $overrides = []): User
    {
        static $counter = 500;
        $counter++;

        return User::create(array_merge([
            'name' => "Chat User {$counter}",
            'email' => "chat{$counter}@zengfy.top",
            'handle' => "chat_user_{$counter}",
            'password' => Hash::make('Password123!'),
            'ward_code' => 'WARD-DHAKA-19',
        ], $overrides));
    }

    #[Test]
    public function two_citizens_can_start_or_retrieve_direct_conversation()
    {
        $userA = $this->createUser();
        $userB = $this->createUser();

        Sanctum::actingAs($userA);

        // 1. First call creates conversation
        $response1 = $this->postJson('/api/v1/conversations/direct', [
            'target_user_id' => $userB->id,
        ]);

        $response1->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [
                    'type' => 'direct',
                ],
            ]);

        $conversationId = $response1->json('data.id');
        $this->assertNotEmpty($conversationId);
        $this->assertDatabaseHas('conversations', ['id' => $conversationId]);
        $this->assertDatabaseHas('conversation_participants', ['conversation_id' => $conversationId, 'user_id' => $userA->id]);
        $this->assertDatabaseHas('conversation_participants', ['conversation_id' => $conversationId, 'user_id' => $userB->id]);

        // 2. Second call by User B returns existing conversation (idempotent 1-on-1 direct channel)
        Sanctum::actingAs($userB);
        $response2 = $this->postJson('/api/v1/conversations/direct', [
            'target_user_id' => $userA->id,
        ]);

        $response2->assertStatus(200);
        $this->assertEquals($conversationId, $response2->json('data.id'));
    }

    #[Test]
    public function citizen_cannot_start_direct_conversation_with_themselves()
    {
        $user = $this->createUser();
        Sanctum::actingAs($user);

        $response = $this->postJson('/api/v1/conversations/direct', [
            'target_user_id' => $user->id,
        ]);

        $response->assertStatus(422)
            ->assertJson(['meta' => ['error_code' => 'INVALID_CONVERSATION']]);
    }

    #[Test]
    public function participant_can_send_message_and_broadcast_message_sent_event()
    {
        Event::fake([MessageSent::class]);

        $userA = $this->createUser();
        $userB = $this->createUser();

        $conversation = Conversation::create(['type' => 'direct', 'last_message_at' => now()->subHours(2)]);
        ConversationParticipant::create(['conversation_id' => $conversation->id, 'user_id' => $userA->id]);
        ConversationParticipant::create(['conversation_id' => $conversation->id, 'user_id' => $userB->id]);

        Sanctum::actingAs($userA);

        $response = $this->postJson("/api/v1/conversations/{$conversation->id}/messages", [
            'body' => 'Assalamu Alaikum! Are you attending the ward community meet?',
            'message_type' => 'text',
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'data' => [
                    'conversation_id' => $conversation->id,
                    'body' => 'Assalamu Alaikum! Are you attending the ward community meet?',
                    'sender' => [
                        'id' => $userA->id,
                        'name' => $userA->name,
                    ],
                ],
            ]);

        $messageId = $response->json('data.id');
        $this->assertDatabaseHas('messages', [
            'id' => $messageId,
            'conversation_id' => $conversation->id,
            'sender_id' => $userA->id,
        ]);

        // Verify WebSocket event broadcasted
        Event::assertDispatched(MessageSent::class, function (MessageSent $event) use ($messageId, $conversation) {
            return $event->message->id === $messageId
                && $event->broadcastOn()[0]->name === 'private-chat.' . $conversation->id
                && $event->broadcastAs() === 'message.sent';
        });
    }

    #[Test]
    public function non_participant_cannot_send_message_or_view_messages()
    {
        $userA = $this->createUser();
        $userB = $this->createUser();
        $intruder = $this->createUser();

        $conversation = Conversation::create(['type' => 'direct']);
        ConversationParticipant::create(['conversation_id' => $conversation->id, 'user_id' => $userA->id]);
        ConversationParticipant::create(['conversation_id' => $conversation->id, 'user_id' => $userB->id]);

        Sanctum::actingAs($intruder);

        // Intruder attempts to send message
        $sendResponse = $this->postJson("/api/v1/conversations/{$conversation->id}/messages", [
            'body' => 'Hacked into chat',
        ]);
        $sendResponse->assertStatus(403);

        // Intruder attempts to read messages
        $viewResponse = $this->getJson("/api/v1/conversations/{$conversation->id}/messages");
        $viewResponse->assertStatus(403);
    }

    #[Test]
    public function messages_endpoint_supports_keyset_cursor_pagination()
    {
        $userA = $this->createUser();
        $userB = $this->createUser();

        $conversation = Conversation::create(['type' => 'direct']);
        ConversationParticipant::create(['conversation_id' => $conversation->id, 'user_id' => $userA->id]);
        ConversationParticipant::create(['conversation_id' => $conversation->id, 'user_id' => $userB->id]);

        // Seed 25 messages with incremental timestamps
        for ($i = 1; $i <= 25; $i++) {
            Message::create([
                'conversation_id' => $conversation->id,
                'sender_id' => ($i % 2 === 0) ? $userA->id : $userB->id,
                'body' => "Message number {$i}",
                'created_at' => now()->subMinutes(30 - $i),
                'updated_at' => now()->subMinutes(30 - $i),
            ]);
        }

        Sanctum::actingAs($userA);

        // Page 1: 10 messages
        $page1 = $this->getJson("/api/v1/conversations/{$conversation->id}/messages?per_page=10");
        $page1->assertStatus(200);
        $this->assertCount(10, $page1->json('data'));
        $this->assertTrue($page1->json('meta.has_more'));
        $nextCursor = $page1->json('meta.next_cursor');

        // Page 2: next 10 messages
        $page2 = $this->getJson("/api/v1/conversations/{$conversation->id}/messages?per_page=10&cursor={$nextCursor}");
        $page2->assertStatus(200);
        $this->assertCount(10, $page2->json('data'));

        $ids1 = collect($page1->json('data'))->pluck('id')->all();
        $ids2 = collect($page2->json('data'))->pluck('id')->all();
        $this->assertEmpty(array_intersect($ids1, $ids2), 'Duplicate messages detected across keyset cursor pages');
    }

    #[Test]
    public function participant_can_broadcast_typing_indicator()
    {
        Event::fake([UserTyping::class]);

        $userA = $this->createUser();
        $userB = $this->createUser();

        $conversation = Conversation::create(['type' => 'direct']);
        ConversationParticipant::create(['conversation_id' => $conversation->id, 'user_id' => $userA->id]);
        ConversationParticipant::create(['conversation_id' => $conversation->id, 'user_id' => $userB->id]);

        Sanctum::actingAs($userA);

        $response = $this->postJson("/api/v1/conversations/{$conversation->id}/typing", [
            'is_typing' => true,
        ]);

        $response->assertStatus(200);

        Event::assertDispatched(UserTyping::class, function (UserTyping $event) use ($userA, $conversation) {
            return $event->user->id === $userA->id
                && $event->conversationId === $conversation->id
                && $event->isTyping === true
                && $event->broadcastAs() === 'user.typing';
        });
    }

    #[Test]
    public function participant_can_mark_conversation_as_read()
    {
        $userA = $this->createUser();
        $userB = $this->createUser();

        $conversation = Conversation::create(['type' => 'direct']);
        $participantA = ConversationParticipant::create(['conversation_id' => $conversation->id, 'user_id' => $userA->id]);
        ConversationParticipant::create(['conversation_id' => $conversation->id, 'user_id' => $userB->id]);

        // User B sends an unread message
        $msg = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $userB->id,
            'body' => 'Hey, check this report!',
            'is_read' => false,
        ]);

        Sanctum::actingAs($userA);

        $response = $this->postJson("/api/v1/conversations/{$conversation->id}/read");
        $response->assertStatus(200);

        $this->assertDatabaseHas('messages', [
            'id' => $msg->id,
            'is_read' => true,
        ]);

        $participantA->refresh();
        $this->assertNotNull($participantA->last_read_at);
    }

    #[Test]
    public function conversations_index_lists_active_conversations_with_partner_and_unread_counts()
    {
        $userA = $this->createUser();
        $userB = $this->createUser();

        $conversation = Conversation::create(['type' => 'direct', 'last_message_at' => now()]);
        ConversationParticipant::create(['conversation_id' => $conversation->id, 'user_id' => $userA->id, 'last_read_at' => now()->subMinutes(10)]);
        ConversationParticipant::create(['conversation_id' => $conversation->id, 'user_id' => $userB->id]);

        // User B sent 2 new messages
        Message::create(['conversation_id' => $conversation->id, 'sender_id' => $userB->id, 'body' => 'Message 1', 'created_at' => now()->subMinutes(5)]);
        Message::create(['conversation_id' => $conversation->id, 'sender_id' => $userB->id, 'body' => 'Message 2', 'created_at' => now()->subMinutes(1)]);

        Sanctum::actingAs($userA);

        $response = $this->getJson('/api/v1/conversations');
        $response->assertStatus(200);

        $this->assertCount(1, $response->json('data'));
        $convo = $response->json('data.0');
        $this->assertEquals($conversation->id, $convo['id']);
        $this->assertEquals($userB->id, $convo['partner']['id']);
        $this->assertEquals(2, $convo['unread_count']);
        $this->assertEquals('Message 2', $convo['latest_message']['body']);
    }

    #[Test]
    public function websocket_channel_authorizations_protect_private_and_presence_channels()
    {
        $userA = $this->createUser(['ward_code' => 'WARD-DHAKA-19']);
        $userB = $this->createUser();
        $intruder = $this->createUser();

        $conversation = Conversation::create(['type' => 'direct']);
        ConversationParticipant::create(['conversation_id' => $conversation->id, 'user_id' => $userA->id]);
        ConversationParticipant::create(['conversation_id' => $conversation->id, 'user_id' => $userB->id]);

        // 1. Participant can authenticate on private chat channel
        Sanctum::actingAs($userA);
        $response1 = $this->postJson('/broadcasting/auth', [
            'channel_name' => 'private-chat.' . $conversation->id,
            'socket_id' => '1234.5678',
        ]);
        $response1->assertStatus(200);

        // 2. Non-participant (intruder) is blocked on private chat channel
        Sanctum::actingAs($intruder);
        $response2 = $this->postJson('/broadcasting/auth', [
            'channel_name' => 'private-chat.' . $conversation->id,
            'socket_id' => '1234.5678',
        ]);
        $response2->assertStatus(403);

        // 3. User can authenticate on their own private user channel, but not others
        Sanctum::actingAs($userA);
        $response3 = $this->postJson('/broadcasting/auth', [
            'channel_name' => 'private-users.' . $userA->id,
            'socket_id' => '1234.5678',
        ]);
        $response3->assertStatus(200);

        $response4 = $this->postJson('/broadcasting/auth', [
            'channel_name' => 'private-users.' . $userB->id,
            'socket_id' => '1234.5678',
        ]);
        $response4->assertStatus(403);

        // 4. Presence channel for hyperlocal ward returns user info
        $response5 = $this->postJson('/broadcasting/auth', [
            'channel_name' => 'presence-presence.ward.WARD-DHAKA-19',
            'socket_id' => '1234.5678',
        ]);
        $response5->assertStatus(200);
        $channelData = json_decode($response5->json('channel_data'), true);
        $this->assertEquals($userA->id, $channelData['user_id']);
        $this->assertEquals('WARD-DHAKA-19', $channelData['user_info']['ward_code']);
    }
}
