<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Country;
use App\Models\MedicineCompany;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medicine>
 */
class MedicineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
            return [
                   'code' => strtoupper($this->faker->unique()->lexify('MED???')),
                   'name' => $this->faker->word(),
                   'description' => $this->faker->sentence(),
                   'quantity' => $this->faker->numberBetween(10, 500),
                   'product_country_id' => Country::inRandomOrder()->first()?->id,
                   'medicine_company_id' => MedicineCompany::inRandomOrder()->first()?->id,
               ];

    }
}
