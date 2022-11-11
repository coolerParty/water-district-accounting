<?php

namespace App\Http\Livewire\CheckDisbursement;

use App\Models\AccountChart;
use App\Models\Bank;
use App\Models\Disbursement;
use App\Models\JournalEntryVoucher;
use App\Models\Transaction;
use DB;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class CheckDisbursementAddComponent extends Component
{
    use AuthorizesRequests;

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

        $this->mds               = false;
        $this->commercial        = false;
        $this->ada               = false;
        $this->cash_in_available = false;
        $this->subject_to_ada    = false;
        $this->others            = false;
        $this->check_withdrawn   = false;
    }

    public function getMaxDVNumber()
    {
        $this->confirmation();

        $this->dv_number = Disbursement::max('dv_number') + 1;
    }

    public function addJournal()
    {
        $this->confirmation();

        $this->journals[] = ['accountCode' => '', 'debit' => 0, 'credit' => 0];
    }

    public function removeJournal($index)
    {
        $this->confirmation();

        unset($this->journals[$index]);
        $this->journals = array_values($this->journals);
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
            'journals'          => ['required'],
        ]);
    }

    public function store()
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
            'journals'          => ['required'],
        ]);

        try {
            DB::transaction(function () {

                $jev              = new JournalEntryVoucher();
                $jev->jev_no      = JournalEntryVoucher::max('jev_no') + 1;
                $jev->type        = 4;
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

                $disbursement                           = new Disbursement();
                $disbursement->journal_entry_voucher_id = $jev->id;
                $disbursement->dv_number                = $this->dv_number;
                $disbursement->payee                    = $this->payee;
                $disbursement->particulars              = $this->dvParticulars;
                $disbursement->check_number             = $this->check_number;
                $disbursement->amount                   = $this->amount;
                $disbursement->tin_no                   = $this->tin_no;
                $disbursement->address                  = $this->address;
                $disbursement->fpa                      = $this->fpa;
                $disbursement->type_of_fund             = $this->type_of_fund;
                $disbursement->mds                      = $this->mds;
                $disbursement->commercial               = $this->commercial;
                $disbursement->ada                      = $this->ada;
                $disbursement->cash_in_available        = $this->cash_in_available;
                $disbursement->subject_to_ada           = $this->subject_to_ada;
                $disbursement->others                   = $this->others;
                $disbursement->check_withdrawn          = $this->check_withdrawn;
                $disbursement->bank_id                  = $this->bank_id;
                $disbursement->save();

                return redirect()->route('checkdisbursementjournal.index')
                    ->with('create-success', 'Check Disbursement Journal "' . $disbursement->dv_number  . '" created successfully.');
            });
        } catch (\Exception $exception) {
            session()->flash('delete-success', 'Error occured! Please try again.');
            return;
        }
    }

    public function confirmation()
    {
        $this->authorize('disbursement-journal-create');
    }

    public function render()
    {
        $this->confirmation();

        $accounts = AccountChart::select('id', 'code', 'name')->orderBy('code', 'ASC')->orderBy('name', 'ASC')->get();
        $banks = Bank::select('id','bank_name')->get();
        // Account Codes Search Modal
        $accountsModal = AccountChart::select('id', 'code', 'name')
            ->when($this->search, function ($query) {
                $query->orWhere('code', 'like' ,  '%' . $this->search . '%')
                    ->orWhere('name', 'like' ,  '%' . $this->search . '%');
            })
            ->orderBy('code', 'ASC')
            ->orderBy('name', 'ASC')
            ->get();
        return view('livewire.check-disbursement.check-disbursement-add-component', [
                'accounts' => $accounts,'banks'=>$banks, 'accountsModal' => $accountsModal
            ])->layout('layouts.base');
    }
}
