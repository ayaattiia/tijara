<?php

// database/factories/MessageFactory.php
namespace Database\Factories;

use App\Models\Message;
use App\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Message>
 */
class MessageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => Users::factory(),
            'room' => 'general',
            'content' => fake()->sentence(),
        ];
    }
}