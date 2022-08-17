<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Disbursement>
 */
class DisbursementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'dv_number'         => $this->faker->numberBetween(100,500),
            'payee'             => $this->faker->word,
            'particulars'       => $this->faker->sentence(),
            'check_number'      => $this->faker->unique->numerify('####-####-####'),
            'amount'            => $this->faker->numberBetween(100,500),
            'tin_no'            => $this->faker->unique->numerify('####-####-####-###'),
            'address'           => $this->faker->sentence(),
            'fpa'               => $this->faker->word,
            'type_of_fund'      => 'general',
            'mds'               => rand(true,false),
            'commercial'        => rand(true,false),
            'ada'               => rand(true,false),
            'cash_in_available' => rand(true,false),
            'subject_to_ada'    => rand(true,false),
            'others'            => rand(true,false),
            'check_withdrawn'   => rand(true,false),
            'bank_id'           => $this->faker->numberBetween(1,10),
        ];
    }
}
