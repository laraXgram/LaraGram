<?php

namespace Database\Factories;

use LaraGram\Database\Eloquent\Factories\Factory;

/**
 * @extends \LaraGram\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name'  => fake()->lastName,
            'user_id'    => fake()->numberBetween(100000000, 9999999999),
            'chat_id'    => fake()->numberBetween(100000000, 9999999999),
        ];
    }
}