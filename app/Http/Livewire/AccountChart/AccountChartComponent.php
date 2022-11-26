<?php

namespace App\Http\Livewire\AccountChart;

use App\Models\AccountChart;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AccountChartComponent extends Component
{
    use AuthorizesRequests;

    public function destroy($id)
    {
        $this->authorize('account-chart-delete');

        $account = AccountChart::find($id);
        $account->delete();

        return redirect()->route('users.index')
            ->with('delete-success', 'User has been deleted successfully.');
    }

    public function render()
    {
        $this->authorize('account-chart-show');

        $accounts = AccountChart::with('accountGroup','majorAccountGroup','SubMajorAccountGroup')->select('id', 'code', 'name', 'acctgrp_id', 'mjracctgrp_id', 'submjracctgrp_id', 'current_non')->orderBy('code','ASC')->paginate(10);

        return view('livewire.account-chart.account-chart-component', ['accounts' => $accounts])->layout('layouts.base');
    }
}
