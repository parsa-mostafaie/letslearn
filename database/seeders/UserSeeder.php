<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!User::where('email', 'admin@example.com')->exists())
            User::factory()->create([
                'id' => 1,
                'firstname' => 'Admin',
                'lastname' => '',
                'email' => 'admin@example.com',
                'password' => Hash::make("admin@example.com")
            ]);

        User::factory(10)->unverified()->create();
        User::factory(10)->create();
    }
}
