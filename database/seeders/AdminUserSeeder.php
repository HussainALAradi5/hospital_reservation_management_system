<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123'),
            'age' => 30,
            'telephone_number' => 300000000,
            'gender_type' => 'M',
            'is_married' => false,
            'user_type' => 'admin',
            'hospital_id' => null,
        ]);
    }
}