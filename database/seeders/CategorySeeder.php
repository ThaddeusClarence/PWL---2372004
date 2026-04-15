<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Musik', 'Seminar', 'Workshop', 'Olahraga', 'Lainnya'];

        foreach ($categories as $cat) {
            \App\Models\Category::updateOrCreate(
                ['name' => $cat],
                ['slug' => \Illuminate\Support\Str::slug($cat)]
            );
        }
    }
}
