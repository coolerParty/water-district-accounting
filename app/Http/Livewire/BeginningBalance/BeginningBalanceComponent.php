<?php

namespace App\Http\Livewire\BeginningBalance;

use App\Models\AccountChart;
use App\Models\BeginningBalance;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BeginningBalanceComponent extends Component
{
    use AuthorizesRequests;

    public function destroy($id)
    {
        // if (!auth()->user()->can('beginning-balance-delete')) {
        //     abort(404);
        // }

        $this->authorize('beginning-balance-delete');

        $bal = BeginningBalance::find($id);
        $bal->delete();

        return redirect()->route('beginningbalance.index')
            ->with('delete-success', 'Account Beginning Balance has been deleted successfully.');
    }

    public function render()
    {
        // if (!auth()->user()->can('beginning-balance-show')) {
        //     abort(404);
        // }
        $this->authorize('beginning-balance-show');

        $balances = BeginningBalance::with('accountChart')->select('id', 'accountchart_id', 'start_date', 'amount')->paginate(10);
        return view('livewire.beginning-balance.beginning-balance-component', ['balances' => $balances])->layout('layouts.base');
    }
}
