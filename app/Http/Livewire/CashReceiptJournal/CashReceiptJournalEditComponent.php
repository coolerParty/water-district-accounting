<?php

namespace App\Http\Livewire\CashReceiptJournal;

use App\Models\AccountChart;
use App\Models\CashReceipt;
use App\Models\JournalEntryVoucher;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class CashReceiptJournalEditComponent extends Component
{
    use AuthorizesRequests;

    public $crj_id;
    public $official_receipt;
    public $a_receipt;
    public $current = 0.00;
    public $penalty = 0.00;
    public $arrears_cy = 0.00;
    public $arrears_py = 0.00;
    public $cod_prev_day = 0.00;

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
        $this->confirmation();

        $this->jev_no = JournalEntryVoucher::where('id', '<>', $this->jev_id)->max('jev_no') + 1;
    }

    public function showAddTransaction()
    {
        $this->confirmation();

        $this->resetAddEdit();
        $this->enableEdit = false;
        $this->enableAdd = true;
    }

    public function showEditForm($id)
    {
        $this->confirmation();

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
        $this->confirmation();

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
        $crj                    = CashReceipt::findOrFail($id);
        $this->jev_id           = $crj->journal_entry_voucher_id;
        $this->crj_id           = $crj->id;
        $this->official_receipt = $crj->official_receipt;
        $this->a_receipt        = $crj->a_receipt;
        $this->current          = $crj->current;
        $this->penalty          = $crj->penalty;
        $this->arrears_cy       = $crj->arrears_cy;
        $this->arrears_py       = $crj->arrears_py;
        $this->cod_prev_day     = $crj->cod_prev_day;

        $jev = JournalEntryVoucher::where('id', $this->jev_id)->where('type', 1)->visibleTo(Auth::user())->first();
        if(empty($jev))
        {
            abort(404);
        }
        $this->jev_date    = $jev->jv_date;
        $this->jev_no      = $jev->jev_no;
        $this->particulars = $jev->particulars;
    }

    public function updated($fields)
    {

        $this->validateOnly($fields, [
            'official_receipt' => ['required', 'min:5', 'max:150'],
            'a_receipt'        => ['required', 'min:5', 'max:150'],
            'current'          => ['required', 'numeric', 'min:0'],
            'penalty'          => ['required', 'numeric', 'min:0'],
            'arrears_cy'       => ['required', 'numeric', 'min:0'],
            'arrears_py'       => ['required', 'numeric', 'min:0'],
            'cod_prev_day'     => ['required', 'numeric', 'min:0'],
            'jev_date'         => ['required', 'date'],
            'particulars'      => ['required', 'max:200'],
        ]);
    }

    public function update()
    {

        $this->confirmation();

        $this->validate([
            'official_receipt' => ['required', 'min:5', 'max:150'],
            'a_receipt'        => ['required', 'min:5', 'max:150'],
            'current'          => ['required', 'numeric', 'min:0'],
            'penalty'          => ['required', 'numeric', 'min:0'],
            'arrears_cy'       => ['required', 'numeric', 'min:0'],
            'arrears_py'       => ['required', 'numeric', 'min:0'],
            'cod_prev_day'     => ['required', 'numeric', 'min:0'],
            'jev_date'         => ['required', 'date'],
            'particulars'      => ['required', 'max:200'],
        ]);

        try {
            DB::transaction(function () {

                $cr                   = CashReceipt::find($this->crj_id);
                if(empty($cr))
                {
                    abort(404);
                }
                $cr->official_receipt = $this->official_receipt;
                $cr->a_receipt        = $this->a_receipt;
                $cr->current          = $this->current;
                $cr->penalty          = $this->penalty;
                $cr->arrears_cy       = $this->arrears_cy;
                $cr->arrears_py       = $this->arrears_py;
                $cr->cod_prev_day     = $this->cod_prev_day;
                $cr->save();

                $jev              = JournalEntryVoucher::visibleTo(Auth::user())->where('id', $this->jev_id)->first();
                if(empty($jev))
                {
                    abort(404);
                }
                $jev->jev_no      = $this->jev_no;
                $jev->jv_date     = $this->jev_date;
                $jev->particulars = $this->particulars;
                $jev->save();

                session()->flash('create-success', 'Cash Receipt Journal "' . $cr->official_receipt  . '" updated successfully.');
            });
        } catch (\Exception $exception) {
            session()->flash('delete-success', 'Error occured! Please try again.');
            return;
        }
    }

    public function addTransaction()
    {
        $this->confirmation();

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
        $this->confirmation();

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

    public function confirmation()
    {
        // if (!auth()->user()->can('cash-receipt-journal-edit')) {
        //     abort(404);
        // }

        $this->authorize('cash-receipt-journal-edit');
    }

    public function render()
    {
        $this->confirmation();

        $transactions = Transaction::with('accountChart')->select('id', 'accountchart_id', 'journal_entry_voucher_id', 'debit', 'credit')->where('journal_entry_voucher_id', $this->jev_id)->get();
        $accounts = AccountChart::select('id', 'code', 'name')->orderBy('code', 'ASC')->orderBy('name', 'ASC')->get();
        return view('livewire.cash-receipt-journal.cash-receipt-journal-edit-component', ['transactions' => $transactions, 'accounts' => $accounts])->layout('layouts.base');
    }
}
