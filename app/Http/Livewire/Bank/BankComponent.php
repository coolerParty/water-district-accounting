<?php

namespace App\Http\Livewire\Bank;

use App\Models\Bank;
use Livewire\Component;

class BankComponent extends Component
{
    public function destroy($id)
    {
        if (!auth()->user()->can('user-delete')) {
            abort(404);
        }
        $bank = Bank::find($id);
        $bank->delete();

        return redirect()->route('bank.index')
            ->with('delete-success', 'Bank has been deleted successfully.');
    }

    public function render()
    {
        if (!auth()->user()->can('user-show')) {
            abort(404);
        }

        $banks = Bank::select('id', 'bank_name', 'desc_name_brs', 'acct_number', 'seq_no')->orderBy('seq_no','ASC')->paginate(10);

        return view('livewire.bank.bank-component',['banks'=>$banks])->layout('layouts.base');
    }
}
