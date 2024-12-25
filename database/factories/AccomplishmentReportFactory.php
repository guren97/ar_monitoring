<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\AccomplishmentReport;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AccomplishmentReport>
 */
class AccomplishmentReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'date' => $this->faker->date(),
            'municipality' => $this->faker->city(),
            'barangay' => $this->faker->streetName(),
            'enumeration_area' => $this->faker->unique()->word(),
            'original_bsn' => $this->faker->randomNumber(5, true),
            'processed_bsn' => $this->faker->randomNumber(5, true),
            'remarks' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['Pending', 'In Progress', 'Completed']),
        ];
    }
}

