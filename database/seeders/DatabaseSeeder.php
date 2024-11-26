<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->createMany([
            // 'name' => 'Favian Hilmi',
            // 'email' => 'favianhilmi11@gmail.com',
            // 'password' => 'favian123',
            ['name' => 'Favian Hilmi', 'email' => 'favianhilmi11@gmail.com', 'password' => bcrypt('favian123')],
            ['name' => 'admin', 'email' => 'admin@gmail.com', 'role' => 'admin', 'password' => bcrypt('admin123')]
        ]);
    }
}
