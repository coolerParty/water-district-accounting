<?php

namespace App\Http\Livewire\AccountChart;

use App\Models\AccountChart;
use Livewire\Component;

class AccountChartComponent extends Component
{
    public function destroy($id)
    {
        if (!auth()->user()->can('account-chart-delete')) {
            abort(404);
        }
        $account = AccountChart::find($id);
        $account->delete();

        return redirect()->route('users.index')
            ->with('delete-success', 'User has been deleted successfully.');
    }

    public function render()
    {
        if (!auth()->user()->can('account-chart-show')) {
            abort(404);
        }

        $accounts = AccountChart::with('accountGroup','majorAccountGroup','SubMajorAccountGroup')->select('id', 'code', 'name', 'acctgrp_id', 'mjracctgrp_id', 'submjracctgrp_id')->paginate(10);

        return view('livewire.account-chart.account-chart-component', ['accounts' => $accounts])->layout('layouts.base');
    }
}
