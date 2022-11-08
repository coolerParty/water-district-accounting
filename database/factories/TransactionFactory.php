<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'accountchart_id' => $this->faker->numberBetween(1,571),
            // 'debit' => $this->faker->numberBetween(10,500),
            // 'credit' => $this->faker->numberBetween(10,500),
        ];
    }
}
