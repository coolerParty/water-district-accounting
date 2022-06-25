<?php

namespace App\Http\Livewire\BeginningBalance;

use App\Models\AccountChart;
use App\Models\BeginningBalance;
use Livewire\Component;

class BeginningBalanceComponent extends Component
{
    public function destroy($id)
    {
        if (!auth()->user()->can('user-delete')) {
            abort(404);
        }
        $bal = BeginningBalance::find($id);
        $bal->delete();

        return redirect()->route('beginningbalance.index')
            ->with('delete-success', 'Account Beginning Balance has been deleted successfully.');
    }

    public function render()
    {
        $balances = BeginningBalance::with('accountChart')->select('id', 'accountchart_id', 'start_date', 'amount')->paginate(10);
        return view('livewire.beginning-balance.beginning-balance-component', ['balances' => $balances])->layout('layouts.base');
    }
}
