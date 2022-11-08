<?php

namespace Database\Seeders;

use App\Models\AccountChart;
use App\Models\Billing;
use App\Models\JournalEntryVoucher;
use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BillingSeeder extends Seeder
{
    private $amount = 0.00;
    private $accounts;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->accounts = AccountChart::all();

        JournalEntryVoucher::factory(100)->create([
            'type' => 2
        ])->each(function ($journal) {
            Billing::factory(1)->create([
                'journal_entry_voucher_id' => $journal->id,
            ]);
        })->each(function ($journal) {
            $this->amount = rand(100.00,1000.00);
            Transaction::factory(1)->create([
                'journal_entry_voucher_id' => $journal->id,
                'accountchart_id' => $this->accounts->where('code','1-03-01-010')->pluck('id')->first(),
                'debit' => $this->amount*3,
                'credit' => 0,
            ]);
            Transaction::factory(1)->create([
                'journal_entry_voucher_id' => $journal->id,
                'accountchart_id' => $this->accounts->where('code','4-02-02-090')->pluck('id')->first(),
                'debit' => 0,
                'credit' => $this->amount,
            ]);
            Transaction::factory(1)->create([
                'journal_entry_voucher_id' => $journal->id,
                'accountchart_id' => $this->accounts->where('code','4-02-02-230')->pluck('id')->first(),
                'debit' => 0,
                'credit' => $this->amount,
            ]);
            Transaction::factory(1)->create([
                'journal_entry_voucher_id' => $journal->id,
                'accountchart_id' => $this->accounts->where('code','4-02-01-990')->pluck('id')->first(),
                'debit' => 0,
                'credit' => $this->amount,
            ]);
        });
    }
}




