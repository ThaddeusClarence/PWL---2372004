<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = \App\Models\User::where('role', 'admin')->first();
        if (!$admin) {
            $admin = \App\Models\User::create([
                'name' => 'Admin Test',
                'email' => 'admin@test.com',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'admin'
            ]);
        }

        $event1 = \App\Models\Event::create([
            'title' => 'Konser Musik Jazz 2026',
            'description' => 'Nikmati malam yang indah dengan alunan musik jazz terbaik dari musisi lokal dan mancanegara.',
            'category' => 'Musik',
            'location' => 'JIEXPO Kemayoran, Jakarta',
            'date' => '2026-06-15',
            'start_time' => '19:00:00',
            'price' => 250000,
            'user_id' => $admin->id
        ]);

        $event1->ticketTypes()->createMany([
            ['name' => 'VIP', 'price' => 750000, 'quota' => 50, 'remaining_quota' => 50],
            ['name' => 'Regular', 'price' => 250000, 'quota' => 200, 'remaining_quota' => 200],
        ]);

        $event2 = \App\Models\Event::create([
            'title' => 'Workshop AI for Future',
            'description' => 'Pelajari bagaimana kecerdasan buatan dapat membantu produktivitas harian Anda.',
            'category' => 'Seminar',
            'location' => 'Sarinah Art Center, Jakarta',
            'date' => '2026-05-20',
            'start_time' => '09:00:00',
            'price' => 150000,
            'user_id' => $admin->id
        ]);

        $event2->ticketTypes()->createMany([
            ['name' => 'Student', 'price' => 100000, 'quota' => 100, 'remaining_quota' => 100],
            ['name' => 'General', 'price' => 150000, 'quota' => 150, 'remaining_quota' => 150],
        ]);
    }
}
