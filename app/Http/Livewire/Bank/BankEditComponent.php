<?php

namespace App\Http\Livewire\Bank;

use App\Models\Bank;
use Livewire\Component;

class BankEditComponent extends Component
{
    public $bank_id;
    public $bank_name;
    public $desc_name_brs;
    public $acct_number;
    public $seq_no;

    public function mount($id)
    {
        $bank                = Bank::findOrFail($id);
        $this->bank_id       = $bank->id;
        $this->seq_no        = $bank->seq_no;
        $this->bank_name     = $bank->bank_name;
        $this->desc_name_brs = $bank->desc_name_brs;
        $this->acct_number   = $bank->acct_number;

    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'seq_no'        => ['required', 'numeric','min:0'],
            'bank_name'     => ['required', 'string','min:3'],
            'desc_name_brs' => ['required', 'string','min:3'],
            'acct_number'   => ['required', 'string','min:3'],
        ]);
    }

    public function update()
    {
        $this->confirmation();

        $this->validate([
            'seq_no'        => ['required', 'numeric','min:0'],
            'bank_name'     => ['required', 'string','min:3'],
            'desc_name_brs' => ['required', 'string','min:3'],
            'acct_number'   => ['required', 'string','min:3'],
        ]);

        $account                = Bank::find($this->bank_id);
        $account->seq_no        = $this->seq_no;
        $account->bank_name     = $this->bank_name;
        $account->desc_name_brs = $this->desc_name_brs;
        $account->acct_number   = $this->acct_number;
        $account->save();

        return redirect()->route('bank.index')
            ->with('update-success', 'Bank "' . $this->bank_name . '" updated successfully.');
    }

    public function confirmation()
    {
        if (!auth()->user()->can('user-create')) {
            abort(404);
        }
    }

    public function render()
    {
        $this->confirmation();

        return view('livewire.bank.bank-edit-component')->layout('layouts.base');
    }
}
