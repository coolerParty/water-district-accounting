<?php

namespace App\Http\Livewire\BillingJournal;

use App\Models\AccountChart;
use App\Models\Billing;
use App\Models\JournalEntryVoucher;
use App\Models\Transaction;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class BillingJournalAddComponent extends Component
{
    public $zone;
    public $metered_sales;
    public $residential;
    public $comm;
    public $comm_a;
    public $comm_b;
    public $comm_c;
    public $government;

    public $jev_date;
    public $jev_no;
    public $particulars;

    public $journals = [];

    public function mount()
    {
        $this->journals = [
            ['accountCode' => '', 'debit' => 0, 'credit' => 0]
        ];
    }

    public function addJournal()
    {
        $this->journals[] = ['accountCode' => '', 'debit' => 0, 'credit' => 0];
    }

    public function removeJournal($index)
    {
        unset($this->journals[$index]);
        $this->journals = array_values($this->journals);
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
            'journals'      => ['required'],
        ]);
    }

    public function store()
    {
        $this->confirmation();

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
            'journals'      => ['required'],
        ]);

        try {
            DB::transaction(function () {

                $jev              = new JournalEntryVoucher();
                $jev->jev_no      = JournalEntryVoucher::max('jev_no') + 1;
                $jev->type        = 2;
                $jev->jv_date     = $this->jev_date;
                $jev->particulars = $this->particulars;
                $jev->save();

                foreach ($this->journals as $journal) {
                    $tran                           = new Transaction();
                    $tran->journal_entry_voucher_id = $jev->id;
                    $tran->accountchart_id          = $journal['accountCode'];
                    $tran->debit                    = $journal['debit'];
                    $tran->credit                   = $journal['credit'];
                    $tran->save();
                }

                $bill                           = new Billing();
                $bill->journal_entry_voucher_id = $jev->id;
                $bill->zone                     = $this->zone;
                $bill->metered_sales            = $this->metered_sales;
                $bill->residential              = $this->residential;
                $bill->comm                     = $this->comm;
                $bill->comm_a                   = $this->comm_a;
                $bill->comm_b                   = $this->comm_b;
                $bill->comm_c                   = $this->comm_c;
                $bill->government               = $this->government;
                $bill->save();

                return redirect()->route('billingjournal.index')
                    ->with('create-success', 'Billing Journal "' . $bill->zone  . '" created successfully.');
            });
        } catch (\Exception $exception) {
            session()->flash('delete-success', 'Error occured! Please try again.');
            return;
        }
    }

    public function confirmation()
    {
        if (!auth()->user()->can('billing-create')) {
            abort(404);
        }
    }

    public function render()
    {
        $this->confirmation();

        $accounts = AccountChart::select('id', 'code', 'name')->orderBy('code', 'ASC')->orderBy('name', 'ASC')->get();
        return view('livewire.billing-journal.billing-journal-add-component', ['accounts' => $accounts])->layout('layouts.base');
    }
}
