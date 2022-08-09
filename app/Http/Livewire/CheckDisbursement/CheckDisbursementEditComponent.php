<?php

namespace App\Http\Livewire\CheckDisbursement;

use App\Models\AccountChart;
use App\Models\Bank;
use App\Models\Disbursement;
use App\Models\JournalEntryVoucher;
use App\Models\Transaction;
use Livewire\Component;
use DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CheckDisbursementEditComponent extends Component
{
    use AuthorizesRequests;

    public $dv_id;
    public $dv_number;
    public $payee;
    public $dvParticulars;
    public $check_number;
    public $amount;
    public $tin_no;
    public $address;
    public $fpa;
    public $type_of_fund;
    public $mds;
    public $commercial;
    public $ada;
    public $cash_in_available;
    public $subject_to_ada;
    public $others;
    public $check_withdrawn;
    public $bank_id;

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

    public function getMaxDVNumber()
    {
        $this->confirmation();

        $this->dv_number = Disbursement::where('id', '<>', $this->dv_id)->max('dv_number') + 1;
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
        $dv                      = Disbursement::findOrFail($id);
        $this->dv_id             = $dv->id;
        $this->jev_id            = $dv->journal_entry_voucher_id;
        $this->dv_number         = $dv->dv_number;
        $this->payee             = $dv->payee;
        $this->dvParticulars     = $dv->particulars;
        $this->check_number      = $dv->check_number;
        $this->amount            = $dv->amount;
        $this->tin_no            = $dv->tin_no;
        $this->address           = $dv->address;
        $this->fpa               = $dv->fpa;
        $this->type_of_fund      = $dv->type_of_fund;
        $this->mds               = $dv->mds;
        $this->commercial        = $dv->commercial;
        $this->ada               = $dv->ada;
        $this->cash_in_available = $dv->cash_in_available;
        $this->subject_to_ada    = $dv->subject_to_ada;
        $this->others            = $dv->others;
        $this->check_withdrawn   = $dv->check_withdrawn;
        $this->bank_id           = $dv->bank_id;

        $jev = JournalEntryVoucher::where('id', $this->jev_id)->where('type', 4)->first();
        $this->jev_date    = $jev->jv_date;
        $this->jev_no      = $jev->jev_no;
        $this->particulars = $jev->particulars;
    }

    public function updated($fields)
    {

        $this->validateOnly($fields, [
            'dv_number'         => ['required', 'numeric', 'min:0'],
            'payee'             => ['required', 'string', 'min:3'],
            'dvParticulars'     => ['required', 'string', 'min:5', 'max:200'],
            'check_number'      => ['required', 'string', 'min:5'],
            'amount'            => ['required', 'numeric', 'min:0'],
            'tin_no'            => ['required', 'string', 'min:0'],
            'address'           => ['required', 'string', 'min:0'],
            'fpa'               => ['required', 'string', 'min:0'],
            'type_of_fund'      => ['required'],
            'mds'               => ['required'],
            'commercial'        => ['required'],
            'ada'               => ['required'],
            'cash_in_available' => ['required'],
            'subject_to_ada'    => ['required'],
            'others'            => ['required'],
            'check_withdrawn'   => ['required'],
            'bank_id'           => ['required'],
            'jev_date'          => ['required', 'date'],
            'particulars'       => ['required', 'min:5', 'max:200'],
        ]);
    }

    public function update()
    {
        $this->confirmation();

        $this->validate([
            'dv_number'         => ['required', 'numeric', 'min:0'],
            'payee'             => ['required', 'string', 'min:3'],
            'dvParticulars'     => ['required', 'string', 'min:5', 'max:200'],
            'check_number'      => ['required', 'string', 'min:5'],
            'amount'            => ['required', 'numeric', 'min:0'],
            'tin_no'            => ['required', 'string', 'min:0'],
            'address'           => ['required', 'string', 'min:0'],
            'fpa'               => ['required', 'string', 'min:0'],
            'type_of_fund'      => ['required'],
            'mds'               => ['required'],
            'commercial'        => ['required'],
            'ada'               => ['required'],
            'cash_in_available' => ['required'],
            'subject_to_ada'    => ['required'],
            'others'            => ['required'],
            'check_withdrawn'   => ['required'],
            'bank_id'           => ['required'],
            'jev_date'          => ['required', 'date'],
            'particulars'       => ['required', 'min:5', 'max:200'],
        ]);

        try {
            DB::transaction(function () {

                $dv                    = Disbursement::find($this->dv_id);
                $dv->dv_number         = $this->dv_number;
                $dv->payee             = $this->payee;
                $dv->particulars       = $this->dvParticulars;
                $dv->check_number      = $this->check_number;
                $dv->amount            = $this->amount;
                $dv->tin_no            = $this->tin_no;
                $dv->address           = $this->address;
                $dv->fpa               = $this->fpa;
                $dv->type_of_fund      = $this->type_of_fund;
                $dv->mds               = $this->mds;
                $dv->commercial        = $this->commercial;
                $dv->ada               = $this->ada;
                $dv->cash_in_available = $this->cash_in_available;
                $dv->subject_to_ada    = $this->subject_to_ada;
                $dv->others            = $this->others;
                $dv->check_withdrawn   = $this->check_withdrawn;
                $dv->bank_id           = $this->bank_id;
                $dv->save();

                $jev              = JournalEntryVoucher::find($this->jev_id);
                $jev->jev_no      = $this->jev_no;
                $jev->jv_date     = $this->jev_date;
                $jev->particulars = $this->particulars;
                $jev->save();

                session()->flash('create-success', 'Check Disbursement Journal "' . $dv->dv_number  . '" updated successfully.');
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
        // if (!auth()->user()->can('disbursement-journal-edit')) {
        //     abort(404);
        // }

        $this->authorize('disbursement-journal-edit');
    }

    public function render()
    {
        $this->confirmation();

        $transactions = Transaction::with('accountChart')->select('id', 'accountchart_id', 'journal_entry_voucher_id', 'debit', 'credit')->where('journal_entry_voucher_id', $this->jev_id)->get();
        $accounts = AccountChart::select('id', 'code', 'name')->orderBy('code', 'ASC')->orderBy('name', 'ASC')->get();
        $banks = Bank::select('id','bank_name')->get();
        return view('livewire.check-disbursement.check-disbursement-edit-component',['transactions'=>$transactions,'accounts'=>$accounts,'banks'=>$banks])->layout('layouts.base');
    }
}
