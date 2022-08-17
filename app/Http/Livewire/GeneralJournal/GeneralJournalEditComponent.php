<?php

namespace App\Http\Livewire\GeneralJournal;

use App\Models\AccountChart;
use App\Models\GeneralJournal;
use App\Models\JournalEntryVoucher;
use App\Models\Transaction;
use Livewire\Component;
use DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class GeneralJournalEditComponent extends Component
{
    use AuthorizesRequests;

    public $g_id;
    public $gen_number;
    public $g_particulars;

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

    public function getMaxGJNumber()
    {
        $this->confirmation();

        $this->gen_number = GeneralJournal::where('id', '<>', $this->g_id)->max('gen_number') + 1;
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
        $this->confirmation();

        $this->enableEdit     = false;
        $this->enableAdd      = false;
        $this->transaction_id = null;
        $this->accountCode    = null;
        $this->debit          = 0;
        $this->credit         = 0;
    }

    public function mount($id)
    {
        $gj                  = GeneralJournal::findOrFail($id);
        if(empty($gj))
        {
            abort(404);
        }
        $this->jev_id        = $gj->journal_entry_voucher_id;
        $this->g_id          = $gj->id;
        $this->gen_number    = $gj->gen_number;
        $this->g_particulars = $gj->particulars;

        $jev = JournalEntryVoucher::visibleTo(Auth::user())->where('id', $this->jev_id)->where('type', 5)->first();
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
            'gen_number' => ['required', 'numeric', 'min:0'],
            'g_particulars' => ['required', 'string', 'min:5','max:200'],
        ]);
    }

    public function update()
    {
        $this->confirmation();

        $this->validate([
            'gen_number' => ['required', 'numeric', 'min:0'],
            'g_particulars' => ['required', 'string', 'min:5','max:200'],
        ]);

        try {
            DB::transaction(function () {

                $gj              = GeneralJournal::find($this->g_id);
                $gj->gen_number  = $this->gen_number;
                $gj->particulars = $this->g_particulars;
                $gj->save();

                $jev              = JournalEntryVoucher::where('id',$this->jev_id)->visibleTo(Auth::user())->firt();
                if(empty($jev))
                {
                    abort(404);
                }
                $jev->jev_no      = $this->jev_no;
                $jev->jv_date     = $this->jev_date;
                $jev->particulars = $this->particulars;
                $jev->save();

                session()->flash('create-success', 'General Journal "' . $gj->gen_number  . '" updated successfully.');
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
        // if (!auth()->user()->can('general-journal-edit')) {
        //     abort(404);
        // }

        $this->authorize('general-journal-edit');
    }

    public function render()
    {
        $this->confirmation();

        $transactions = Transaction::with('accountChart')->select('id', 'accountchart_id', 'journal_entry_voucher_id', 'debit', 'credit')->where('journal_entry_voucher_id', $this->jev_id)->get();
        $accounts = AccountChart::select('id', 'code', 'name')->orderBy('code', 'ASC')->orderBy('name', 'ASC')->get();
        return view('livewire.general-journal.general-journal-edit-component', ['transactions' => $transactions,'accounts'=>$accounts])->layout('layouts.base');
    }
}
