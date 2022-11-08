<?php

namespace Database\Seeders;

use App\Models\Disbursement;
use App\Models\JournalEntryVoucher;
use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DisbursementSeeder extends Seeder
{
    private $amount = 0.00;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JournalEntryVoucher::factory(100)->create([
            'type' => 4
        ])->each(function ($journal) {
            Disbursement::factory(1)->create([
                'journal_entry_voucher_id' => $journal->id,
            ]);
        })->each(function ($journal) {
            $this->amount = rand(100.00,1000.00);
            Transaction::factory(1)->create([
                'journal_entry_voucher_id' => $journal->id,
                'debit' => $this->amount,
                'credit' => 0,
            ]);
            Transaction::factory(1)->create([
                'journal_entry_voucher_id' => $journal->id,
                'debit' => 0,
                'credit' => $this->amount,
            ]);
        });
    }
}
