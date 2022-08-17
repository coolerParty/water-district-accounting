<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Billing>
 */
class BillingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'zone'          => $this->faker->numberBetween(100,500),
            'metered_sales' => $this->faker->numberBetween(100,500),
            'residential'   => $this->faker->numberBetween(100,500),
            'comm'          => $this->faker->numberBetween(100,500),
            'comm_a'        => $this->faker->numberBetween(100,500),
            'comm_b'        => $this->faker->numberBetween(100,500),
            'comm_c'        => $this->faker->numberBetween(100,500),
            'government'    => $this->faker->numberBetween(100,500),
        ];
    }
}
