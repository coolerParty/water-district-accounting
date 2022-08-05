<?php

namespace App\Http\Livewire\Bank;

use App\Models\Bank;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BankAddComponent extends Component
{
    use AuthorizesRequests;

    public $bank_name;
    public $desc_name_brs;
    public $acct_number;
    public $seq_no;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'seq_no'        => ['required', 'numeric','min:0'],
            'bank_name'     => ['required', 'string','min:3'],
            'desc_name_brs' => ['required', 'string','min:3'],
            'acct_number'   => ['required', 'string','min:3'],
        ]);
    }

    public function store()
    {
        $this->confirmation();

        $this->validate([
            'seq_no'        => ['required', 'numeric','min:0'],
            'bank_name'     => ['required', 'string','min:3'],
            'desc_name_brs' => ['required', 'string','min:3'],
            'acct_number'   => ['required', 'string','min:3'],
        ]);

        $bank                = new Bank();
        $bank->seq_no        = $this->seq_no;
        $bank->bank_name     = $this->bank_name;
        $bank->desc_name_brs = $this->desc_name_brs;
        $bank->acct_number   = $this->acct_number;
        $bank->save();

        return redirect()->route('bank.index')
            ->with('create-success', 'Bank "' . $this->bank_name . '" created successfully.');
    }

    public function confirmation()
    {
        // if (!auth()->user()->can('bank-create')) {
        //     abort(404);
        // }

        $this->authorize('bank-create');
    }

    public function render()
    {
        $this->confirmation();

        return view('livewire.bank.bank-add-component')->layout('layouts.base');
    }
}
