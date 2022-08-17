<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JournalEntryVoucher>
 */
class JournalEntryVoucherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id'     => 1,
            'jev_no'      => $this->faker->unique()->numberBetween(1,2501),
            'jv_date'     => Carbon::now(),
            'particulars' => $this->faker->text(130),
        ];
    }
}
