<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bank>
 */
class BankFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
           'bank_name' => ucwords($this->faker->unique()->word),
           'desc_name_brs' => ucwords($this->faker->unique()->sentence()),
           'acct_number' => $this->faker->unique->numerify('####-####-####-####'),
           'seq_no' => $this->faker->numberBetween(1,10),
        ];
    }
}
