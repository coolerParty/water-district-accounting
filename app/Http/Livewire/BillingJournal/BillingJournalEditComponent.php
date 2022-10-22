<?php

namespace App\Http\Livewire\BillingJournal;

use App\Models\AccountChart;
use App\Models\Billing;
use App\Models\JournalEntryVoucher;
use App\Models\Transaction;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class BillingJournalEditComponent extends Component
{
    use AuthorizesRequests;

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

    // Account Codes Search Modal
    public $search;
    public $accountCharts = [];
    public $showModal = false;

    // Account Codes Search Modal Start
    public function showSearchAccounts()
    {
        $this->confirmation();
        $this->resetSearchAccount();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->resetSearchAccount();
    }

    public function resetSearchAccount()
    {
        $this->search = null;
        $this->accountCharts = [];
        $this->showModal = false;
    }

    public function selectAccount($accountID)
    {
        $this->accountCode = $accountID;
        $this->closeModal();
    }
    // Account Codes Search Modal End

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
        $bj                  = Billing::findOrFail($id);
        if(empty($bj))
        {
            abort(404);
        }
        $this->bj_id         = $bj->id;
        $this->jev_id        = $bj->journal_entry_voucher_id;
        $this->zone          = $bj->zone;
        $this->metered_sales = $bj->metered_sales;
        $this->residential   = $bj->residential;
        $this->comm          = $bj->comm;
        $this->comm_a        = $bj->comm_a;
        $this->comm_b        = $bj->comm_b;
        $this->comm_c        = $bj->comm_c;
        $this->government    = $bj->government;

        $jev = JournalEntryVoucher::where('id', $this->jev_id)->where('type', 2)->visibleTo(Auth::user())->first();
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

                $jev              = JournalEntryVoucher::where('id',$this->jev_id)->visibleTo(Auth::user())->first();
                if(empty($jev))
                {
                    abort(404);
                }
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
        $this->authorize('billing-edit');
    }

    public function render()
    {
        $this->confirmation();

        $transactions = Transaction::with('accountChart')->select('id', 'accountchart_id', 'journal_entry_voucher_id', 'debit', 'credit')->where('journal_entry_voucher_id', $this->jev_id)->get();
        $accounts = AccountChart::select('id', 'code', 'name')->orderBy('code', 'ASC')->orderBy('name', 'ASC')->get();
        // Account Codes Search Modal
        $accountsModal = AccountChart::select('id', 'code', 'name')
            ->when($this->search, function ($query) {
                $query->orWhere('code', 'like',  '%' . $this->search . '%')
                    ->orWhere('name', 'like',  '%' . $this->search . '%');
            })
            ->orderBy('code', 'ASC')
            ->orderBy('name', 'ASC')
            ->get();
        return view('livewire.billing-journal.billing-journal-edit-component', [
                'transactions' => $transactions, 'accounts' => $accounts, 'accountsModal' => $accountsModal
            ])->layout('layouts.base');
    }
}
