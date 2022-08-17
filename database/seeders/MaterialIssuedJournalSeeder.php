<?php

namespace Database\Seeders;

use App\Models\JournalEntryVoucher;
use App\Models\MaterialIssuedJournal;
use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialIssuedJournalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JournalEntryVoucher::factory(500)->create([
            'type' => 3
        ])->each(function ($journal) {
            MaterialIssuedJournal::factory(1)->create([
                'journal_entry_voucher_id' => $journal->id,
            ]);
        })->each(function ($journal) {
            Transaction::factory(5)->create([
                'journal_entry_voucher_id' => $journal->id
            ]);
        });
    }
}
