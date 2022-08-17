<?php

namespace Database\Seeders;

use App\Models\Billing;
use App\Models\JournalEntryVoucher;
use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BillingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JournalEntryVoucher::factory(500)->create([
            'type' => 2
        ])->each(function ($journal) {
            Billing::factory(1)->create([
                'journal_entry_voucher_id' => $journal->id,
            ]);
        })->each(function ($journal) {
            Transaction::factory(5)->create([
                'journal_entry_voucher_id' => $journal->id
            ]);
        });
    }
}
