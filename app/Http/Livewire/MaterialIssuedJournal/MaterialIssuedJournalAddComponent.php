<?php

namespace App\Http\Livewire\MaterialIssuedJournal;

use App\Models\AccountChart;
use App\Models\MaterialIssuedJournal;
use App\Models\JournalEntryVoucher;
use App\Models\Transaction;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MaterialIssuedJournalAddComponent extends Component
{
    use AuthorizesRequests;

    public $rsmi_no;

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
            'rsmi_no' => ['required', 'numeric', 'min:0'],
        ]);
    }

    public function store()
    {
        $this->confirmation();

        $this->validate([
            'rsmi_no' => ['required', 'numeric', 'min:0'],
        ]);

        try {
            DB::transaction(function () {
                $jev              = new JournalEntryVoucher();
                $jev->jev_no      = JournalEntryVoucher::max('jev_no') + 1;
                $jev->type        = 3;
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

                $mij                           = new MaterialIssuedJournal();
                $mij->journal_entry_voucher_id = $jev->id;
                $mij->rsmi_no                  = $this->rsmi_no;
                $mij->save();

                return redirect()->route('materialissuedjournal.index')
                    ->with('create-success', 'Material Issued Journal "' . $mij->rsmi_no  . '" created successfully.');
            });
        } catch (\Exception $exception) {
            session()->flash('delete-success', 'Error occurred! Please try again.');
            return;
        }
    }

    public function confirmation()
    {
        $this->authorize('material-journal-create');
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
        return view('livewire.material-issued-journal.material-issued-journal-add-component',['accounts'=>$accounts, 'accountsModal' => $accountsModal])->layout('layouts.base');
    }
}
