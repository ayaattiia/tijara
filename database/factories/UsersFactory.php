<?php

namespace Database\Factories;

use App\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<Users>
 */
class UsersFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'Username' => fake()->unique()->userName(),
            'FirstName' => fake()->firstName(),
            'LastName' => fake()->lastName(),
            'Email' => fake()->unique()->safeEmail(),
            'ICN' => fake()->unique()->numerify('###########'),
            'Telephone' => fake()->unique()->numerify('##########'),
            'Password' => static::$password ??= Hash::make('password'),
            'IsVerified' => 1,
            'EmailConfirmed' => true,
            'Active' => 1,
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'IsVerified' => 0,
            'EmailConfirmed' => false,
        ]);
    }
}