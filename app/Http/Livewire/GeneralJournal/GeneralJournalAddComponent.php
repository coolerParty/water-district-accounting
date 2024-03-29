<?php

namespace App\Http\Livewire\GeneralJournal;

use App\Models\AccountChart;
use App\Models\GeneralJournal;
use App\Models\JournalEntryVoucher;
use App\Models\Transaction;
use DB;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class GeneralJournalAddComponent extends Component
{
    use AuthorizesRequests;

    public $gen_number;
    public $g_particulars;

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

    public function getMaxGJNumber()
    {
        $this->confirmation();

        $this->gen_number = GeneralJournal::max('gen_number') + 1;
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
            'gen_number' => ['required', 'numeric', 'min:0'],
            'g_particulars' => ['required', 'string', 'min:5','max:200'],
        ]);
    }

    public function store()
    {
        $this->confirmation();

        $this->validate([
            'gen_number' => ['required', 'numeric', 'min:0'],
            'g_particulars' => ['required', 'string', 'min:5','max:200'],
        ]);

        try {
            DB::transaction(function () {


                $jev              = new JournalEntryVoucher();
                $jev->jev_no      = JournalEntryVoucher::max('jev_no') + 1;
                $jev->type        = 5;
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

                $gj                           = new GeneralJournal();
                $gj->journal_entry_voucher_id = $jev->id;
                $gj->gen_number               = $this->gen_number;
                $gj->particulars              = $this->g_particulars;
                $gj->save();

                return redirect()->route('generaljournal.index')
                    ->with('create-success', 'General Journal "' . $gj->gen_number  . '" created successfully.');
            });
        } catch (\Exception $exception) {
            session()->flash('delete-success', 'Error occured! Please try again.');
            return;
        }
    }

    public function confirmation()
    {
        $this->authorize('general-journal-create');
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

        return view('livewire.general-journal.general-journal-add-component',['accounts'=>$accounts, 'accountsModal' => $accountsModal])->layout('layouts.base');
    }
}
