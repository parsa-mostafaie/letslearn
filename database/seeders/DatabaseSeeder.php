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
        User::factory()->create([
            'firstname' => 'Admin',
            'lastname' => '',
            'email' => 'admin@example.com',
            'password' => Hash::make("admin@example.com")
        ]);

        User::factory(10)->unverified()->create();
        User::factory(10)->create();
    }
}
