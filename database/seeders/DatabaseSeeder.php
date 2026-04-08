<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin Account
        User::factory()->create([
            'name' => 'Admin Master',
            'email' => 'admin@event.com',
            'role' => 'admin',
            'password' => bcrypt('password123'),
        ]);

        // Organizer Account
        User::factory()->create([
            'name' => 'Organizer Pro',
            'email' => 'organizer@event.com',
            'role' => 'organizer',
            'password' => bcrypt('password123'),
        ]);

        // Customer Account
        User::factory()->create([
            'name' => 'Thaddeus Customer',
            'email' => 'customer@event.com',
            'role' => 'customer',
            'password' => bcrypt('password123'),
        ]);
    }
}
