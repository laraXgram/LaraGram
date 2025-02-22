<?php

namespace Database\Seeders;

use App\Models\User;
// use LaraGram\Database\Console\Seeds\WithoutModelEvents;
use LaraGram\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'user_id' => 123456789,
            'chat_id' => 987654321,
        ]);
    }
}