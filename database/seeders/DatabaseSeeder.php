<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@gmail.com',
            'password' => Hash::make('111111'),
        ]);

        User::factory()->create([
            'name' => 'User Tester',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user123'),
            'is_active' => 'Y'
        ]);
    }
}
