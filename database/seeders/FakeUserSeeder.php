<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class FakeUserSeeder extends Seeder
{
    public function run()
    {
        // 3 Patients
        User::factory()->patient('patient1@example.com')->create(['name' => 'Patient One']);
        User::factory()->patient('patient2@example.com')->create(['name' => 'Patient Two']);
        User::factory()->patient('patient3@example.com')->create(['name' => 'Patient Three']);

        // 2 Doctors
        User::factory()->doctor('doctor1@example.com')->create(['name' => 'Dr. Alpha']);
        User::factory()->doctor('doctor2@example.com')->create(['name' => 'Dr. Beta']);
        User::create([
    'name' => 'Admin',
    'email' => 'admin@example.com',
    'user_type' => 'admin',
    'password' => bcrypt('admin123'), // ← this is the password
]);
    }
}