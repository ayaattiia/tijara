<?php
// tests/Feature/ChatTest.php
namespace Tests\Feature;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\Users;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class ChatTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_send_message(): void
    {
        Event::fake([MessageSent::class]);

        $user = Users::factory()->create();

        $response = $this->actingAs($user)
            ->postJson('/api/chat/messages', [
                'content' => 'Salut tout le monde',
                'room' => 'general',
            ]);

        $response->assertOk();

        $this->assertDatabaseHas('messages', [
            'user_id' => $user->IdUser,
            'content' => 'Salut tout le monde',
        ]);

        Event::assertDispatched(MessageSent::class, function ($event) use ($user) {
            return $event->message->content === 'Salut tout le monde'
                && $event->message->user_id === $user->IdUser;
        });
    }

    public function test_guest_cannot_send_message(): void
    {
        $response = $this->postJson('/api/chat/messages', [
            'content' => 'Test',
            'room' => 'general',
        ]);

        $response->assertUnauthorized();
    }

    public function test_message_validation_fails_without_content(): void
    {
        $user = Users::factory()->create();

        $this->actingAs($user)
            ->postJson('/api/chat/messages', ['room' => 'general'])
            ->assertJsonValidationErrors('content');
    }

    public function test_broadcast_data_shape_is_correct(): void
    {
        $user = Users::factory()->create(['FirstName' => 'Alice', 'LastName' => 'Dupont']);
        $message = Message::factory()->create([
            'user_id' => $user->IdUser,
            'content' => 'Hello',
        ]);

        $event = new MessageSent($message->load('user'));
        $payload = $event->broadcastWith();

        $this->assertEquals('Hello', $payload['content']);
        $this->assertEquals('Alice', $payload['user']['name']);
    }

    public function test_broadcasts_on_correct_private_channel(): void
    {
        $user = Users::factory()->create();
        $message = Message::factory()->create([
            'user_id' => $user->IdUser,
            'room' => 'general',
        ]);

        $event = new MessageSent($message->load('user'));
        $channels = $event->broadcastOn();

        $this->assertEquals('private-chat.general', $channels[0]->name);
    }
}