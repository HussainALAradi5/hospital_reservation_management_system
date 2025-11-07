<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FullFakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Region::factory()->count(10)->create();
        \App\Models\Address::factory()->count(30)->create();
        \App\Models\Hospital::factory()->count(15)->create();
        \App\Models\User::factory()->count(100)->create();
        \App\Models\MedicineCompany::factory()->count(20)->create();
        \App\Models\Medicine::factory()->count(100)->create();
        \App\Models\Room::factory()->count(50)->create();

    }
}
