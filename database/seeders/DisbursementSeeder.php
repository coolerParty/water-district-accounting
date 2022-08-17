<?php

namespace Database\Seeders;

use App\Models\Disbursement;
use App\Models\JournalEntryVoucher;
use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DisbursementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JournalEntryVoucher::factory(500)->create([
            'type' => 4
        ])->each(function ($journal) {
            Disbursement::factory(1)->create([
                'journal_entry_voucher_id' => $journal->id,
            ]);
        })->each(function ($journal) {
            Transaction::factory(5)->create([
                'journal_entry_voucher_id' => $journal->id
            ]);
        });
    }
}
