<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CashReceiptFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            // 'journal_entry_voucher_id' => $this->faker->unique()->numberBetween(1,500),
            'official_receipt' => $this->faker->unique->numerify('#######'),
            'a_receipt'        => $this->faker->word,                     // Acknowledgement Receipt
            'current'          => $this->faker->numberBetween(100,500),
            'penalty'          => $this->faker->numberBetween(100,500),
            'arrears_cy'       => $this->faker->numberBetween(100,500),
            'arrears_py'       => $this->faker->numberBetween(100,500),
            'cod_prev_day'     => $this->faker->numberBetween(100,500),
        ];
    }
}
