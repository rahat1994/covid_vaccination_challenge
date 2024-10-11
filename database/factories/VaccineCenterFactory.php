<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VaccineCenter>
 */
class VaccineCenterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(). ' Vaccination Center',
            'address' => fake()->address,
            'phone' => fake()->phoneNumber,
            'daily_limit' => fake()->numberBetween(100, 500),
            'city' => fake()->city,
            'email' => fake()->unique()->safeEmail,
        ];
    }
}
