<?php

namespace App\Http\Livewire\BillingJournal;

use App\Models\AccountChart;
use App\Models\Billing;
use App\Models\JournalEntryVoucher;
use App\Models\Transaction;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class BillingJournalEditComponent extends Component
{
    public $bj_id;
    public $zone;
    public $metered_sales;
    public $residential;
    public $comm;
    public $comm_a;
    public $comm_b;
    public $comm_c;
    public $government;

    public $jev_id;
    public $jev_date;
    public $jev_no;
    public $particulars;

    public $transaction_id;
    public $accountCode;
    public $debit;
    public $credit;

    public $enableEdit = false;
    public $enableAdd = false;

    public function getMaxJevNumber()
    {
        $this->jev_no = JournalEntryVoucher::where('id', '<>', $this->jev_id)->max('jev_no') + 1;
    }

    public function showAddTransaction()
    {
        $this->resetAddEdit();
        $this->enableEdit = false;
        $this->enableAdd = true;
    }

    public function showEditForm($id)
    {
        $this->resetAddEdit();
        $this->enableEdit = true;
        $this->enableAdd = false;
        $t = Transaction::find($id);
        $this->transaction_id = $t->id;
        $this->accountCode    = $t->accountchart_id;
        $this->debit          = $t->debit;
        $this->credit         = $t->credit;
    }

    public function removeTransaction($id)
    {
        $t = Transaction::findOrFail($id);
        $t->delete();

        session()->flash('delete-success-transaction', 'Account has been delete!');
    }

    public function resetAddEdit()
    {
        $this->enableEdit     = false;
        $this->enableAdd      = false;
        $this->transaction_id = null;
        $this->accountCode    = null;
        $this->debit          = 0;
        $this->credit         = 0;
    }

    public function mount($id)
    {
        $bj                    = Billing::findOrFail($id);
        $this->bj_id         = $bj->id;
        $this->zone          = $bj->zone;
        $this->metered_sales = $bj->metered_sales;
        $this->residential   = $bj->residential;
        $this->comm          = $bj->comm;
        $this->comm_a        = $bj->comm_a;
        $this->comm_b        = $bj->comm_b;
        $this->comm_c        = $bj->comm_c;
        $this->government    = $bj->government;

        $jev = JournalEntryVoucher::where('code_id', $this->bj_id)->where('type', 2)->first();
        $this->jev_id      = $jev->id;
        $this->jev_date    = $jev->jv_date;
        $this->jev_no      = $jev->jev_no;
        $this->particulars = $jev->particulars;
    }

    public function updated($fields)
    {

        $this->validateOnly($fields, [
            'zone'          => ['required', 'numeric', 'min:0'],
            'metered_sales' => ['required', 'numeric', 'min:0'],
            'residential'   => ['required', 'numeric', 'min:0'],
            'comm'          => ['required', 'numeric', 'min:0'],
            'comm_a'        => ['required', 'numeric', 'min:0'],
            'comm_b'        => ['required', 'numeric', 'min:0'],
            'comm_c'        => ['required', 'numeric', 'min:0'],
            'government'    => ['required', 'numeric', 'min:0'],
            'jev_date'      => ['required', 'date'],
            'particulars'   => ['required', 'max:200'],
        ]);
    }

    public function update()
    {
        $this->validate([
            'zone'          => ['required', 'numeric', 'min:0'],
            'metered_sales' => ['required', 'numeric', 'min:0'],
            'residential'   => ['required', 'numeric', 'min:0'],
            'comm'          => ['required', 'numeric', 'min:0'],
            'comm_a'        => ['required', 'numeric', 'min:0'],
            'comm_b'        => ['required', 'numeric', 'min:0'],
            'comm_c'        => ['required', 'numeric', 'min:0'],
            'government'    => ['required', 'numeric', 'min:0'],
            'jev_date'      => ['required', 'date'],
            'particulars'   => ['required', 'max:200'],
        ]);

        try {
            DB::transaction(function () {

                $bj                = Billing::find($this->bj_id);
                $bj->zone          = $this->zone;
                $bj->metered_sales = $this->metered_sales;
                $bj->residential   = $this->residential;
                $bj->comm          = $this->comm;
                $bj->comm_a        = $this->comm_a;
                $bj->comm_b        = $this->comm_b;
                $bj->comm_c        = $this->comm_c;
                $bj->government    = $this->government;
                $bj->save();

                $jev              = JournalEntryVoucher::find($this->jev_id);
                $jev->jev_no      = $this->jev_no;
                $jev->jv_date     = $this->jev_date;
                $jev->particulars = $this->particulars;
                $jev->save();

                session()->flash('create-success', 'Billing Journal "' . $bj->zone  . '" updated successfully.');
            });
        } catch (\Exception $exception) {
            session()->flash('delete-success', 'Error occured! Please try again.');
            return;
        }
    }

    public function addTransaction()
    {
        $this->validate([
            'accountCode' => ['required', 'integer'],
            'debit'       => ['required', 'numeric', 'min:0'],
            'credit'      => ['required', 'numeric', 'min:0'],
        ]);

        $t                           = new Transaction();
        $t->accountchart_id          = $this->accountCode;
        $t->debit                    = $this->debit;
        $t->credit                   = $this->credit;
        $t->journal_entry_voucher_id = $this->jev_id;
        $t->save();

        session()->flash('create-success-transaction', $t->accountChart->code . ' - ' . $t->accountChart->name . ' has been added successfully!');
        $this->resetAddEdit();
    }

    public function updateTransaction()
    {
        $this->validate([
            'accountCode' => ['required', 'integer'],
            'debit'       => ['required', 'numeric', 'min:0'],
            'credit'      => ['required', 'numeric', 'min:0'],
        ]);

        $t                  = Transaction::findOrFail($this->transaction_id);
        $t->accountchart_id = $this->accountCode;
        $t->debit           = $this->debit;
        $t->credit          = $this->credit;
        $t->save();

        session()->flash('update-success-transaction', $t->accountChart->code . ' - ' . $t->accountChart->name . ' has been updated successfully!');
        $this->resetAddEdit();
    }

    public function render()
    {
        $transactions = Transaction::with('accountChart')->select('id', 'accountchart_id', 'journal_entry_voucher_id', 'debit', 'credit')->where('journal_entry_voucher_id', $this->jev_id)->get();
        $accounts = AccountChart::select('id', 'code', 'name')->orderBy('code', 'ASC')->orderBy('name', 'ASC')->get();
        return view('livewire.billing-journal.billing-journal-edit-component', ['transactions' => $transactions, 'accounts' => $accounts])->layout('layouts.base');
    }
}
