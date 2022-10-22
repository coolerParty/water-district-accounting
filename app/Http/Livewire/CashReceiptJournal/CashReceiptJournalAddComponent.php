<?php

namespace App\Http\Livewire\CashReceiptJournal;

use App\Models\AccountChart;
use App\Models\CashReceipt;
use App\Models\JournalEntryVoucher;
use App\Models\Transaction;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class CashReceiptJournalAddComponent extends Component
{
    use AuthorizesRequests;

    public $official_receipt;
    public $a_receipt;
    public $current = 0.00;
    public $penalty = 0.00;
    public $arrears_cy = 0.00;
    public $arrears_py = 0.00;
    public $cod_prev_day = 0.00;

    public $jev_date;
    public $jev_no;
    public $particulars;

    public $journals = [];

    // Account Codes Search Modal
    public $journals_index;
    public $search;
    public $accountCharts = [];
    public $showModal = false;

    // Account Codes Search Modal Start
    public function showSearchAccounts($index)
    {
        $this->confirmation();
        $this->resetSearchAccount();

        $this->journals_index = $index;
        $this->showModal = true;
    }

    public function selectAccount($accountID)
    {
        $this->journals[$this->journals_index]['accountCode'] = $accountID;
        $this->closeModal();
    }

    public function closeModal()
    {
        $this->resetSearchAccount();
    }

    public function resetSearchAccount()
    {
        $this->journals_index = null;
        $this->search = null;
        $this->accountCharts = [];
        $this->showModal = false;
    }
    // Account Codes Search Modal End


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
            'official_receipt' => ['required', 'min:5', 'max:150'],
            'a_receipt'        => ['required', 'min:5', 'max:150'],
            'current'          => ['required', 'numeric'],
            'penalty'          => ['required', 'numeric'],
            'arrears_cy'       => ['required', 'numeric'],
            'arrears_py'       => ['required', 'numeric'],
            'cod_prev_day'     => ['required', 'numeric'],
            'jev_date'         => ['required', 'date'],
            'particulars'      => ['required', 'max:200'],
            'journals'         => ['required'],
        ]);
    }

    public function store()
    {

        $this->confirmation();

        $this->validate([
            'official_receipt' => ['required', 'min:5', 'max:150'],
            'a_receipt'        => ['required', 'min:5', 'max:150'],
            'current'          => ['required', 'numeric'],
            'penalty'          => ['required', 'numeric'],
            'arrears_cy'       => ['required', 'numeric'],
            'arrears_py'       => ['required', 'numeric'],
            'cod_prev_day'     => ['required', 'numeric'],
            'jev_date'         => ['required', 'date'],
            'particulars'      => ['required', 'max:200'],
            'journals'         => ['required'],
        ]);

        try {
            DB::transaction(function () {

                $jev              = new JournalEntryVoucher();
                $jev->jev_no      = JournalEntryVoucher::max('jev_no') + 1;
                $jev->type        = 1;
                $jev->jv_date     = $this->jev_date;
                $jev->particulars = $this->particulars;
                $jev->user_id     = Auth::user()->id;
                $jev->save();

                foreach ($this->journals as $journal) {
                    $tran                           = new Transaction();
                    $tran->journal_entry_voucher_id = $jev->id;
                    $tran->accountchart_id          = $journal['accountCode'];
                    $tran->debit                    = $journal['debit'];
                    $tran->credit                   = $journal['credit'];
                    $tran->save();
                }

                $cr                   = new CashReceipt();
                $cr->journal_entry_voucher_id = $jev->id;
                $cr->official_receipt         = $this->official_receipt;
                $cr->a_receipt                = $this->a_receipt;
                $cr->current                  = $this->current;
                $cr->penalty                  = $this->penalty;
                $cr->arrears_cy               = $this->arrears_cy;
                $cr->arrears_py               = $this->arrears_py;
                $cr->cod_prev_day             = $this->cod_prev_day;
                $cr->save();

                return redirect()->route('cashreceiptjournal.index')
                    ->with('create-success', 'Cash Receipt Journal "' . $cr->official_receipt  . '" created successfully.');
            });
        } catch (\Exception $exception) {
            session()->flash('delete-success', 'Error occured! Please try again.');
            return;
        }
    }

    public function confirmation()
    {
        $this->authorize('cash-receipt-journal-create');
    }


    public function render()
    {
        $this->confirmation();
        $accounts = AccountChart::select('id', 'code', 'name')->orderBy('code', 'ASC')->orderBy('name', 'ASC')->get();

        // Account Codes Search Modal
        $accountsModal = AccountChart::select('id', 'code', 'name')
            ->when($this->search, function ($query) {
                $query->orWhere('code', 'like' ,  '%' . $this->search . '%')
                    ->orWhere('name', 'like' ,  '%' . $this->search . '%');
            })
            ->orderBy('code', 'ASC')
            ->orderBy('name', 'ASC')
            ->get();

        return view('livewire.cash-receipt-journal.cash-receipt-journal-add-component', ['accounts' => $accounts, 'accountsModal' => $accountsModal])->layout('layouts.base');
    }
}
