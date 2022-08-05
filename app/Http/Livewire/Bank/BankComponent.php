<?php

namespace App\Http\Livewire\Bank;

use App\Models\Bank;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BankComponent extends Component
{
    use AuthorizesRequests;

    public function destroy($id)
    {
        // if (!auth()->user()->can('bank-delete')) {
        //     abort(404);
        // }

        $this->authorize('bank-delete');

        $bank = Bank::find($id);
        $bank->delete();

        return redirect()->route('bank.index')
            ->with('delete-success', 'Bank has been deleted successfully.');
    }

    public function render()
    {
        // if (!auth()->user()->can('bank-show')) {
        //     abort(404);
        // }

        $this->authorize('bank-show');

        $banks = Bank::select('id', 'bank_name', 'desc_name_brs', 'acct_number', 'seq_no')->orderBy('seq_no','ASC')->paginate(10);

        return view('livewire.bank.bank-component',['banks'=>$banks])->layout('layouts.base');
    }
}
