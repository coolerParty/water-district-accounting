<?php

namespace App\Http\Livewire\BeginningBalance;

use App\Models\AccountChart;
use App\Models\BeginningBalance;
use Livewire\Component;

class BeginningBalanceComponent extends Component
{
    public $bal_id;
    public $accountCode;
    public $start_date;
    public $amount;
    public $enableAdd  = false;
    public $enableEdit = false;

    public function showAddForm()
    {
        $this->resetAddEdit();
        $this->enableAdd  = true;
        $this->enableEdit = false;
    }

    public function store()
    {
        $this->validate([
            'accountCode' => ['required'],
            'start_date'  => ['required', 'date'],
            'amount'      => ['required', 'numeric'],
        ]);

        $bal                  = new BeginningBalance();
        $bal->accountchart_id = $this->accountCode;
        $bal->start_date      = $this->start_date;
        $bal->amount          = $this->amount;
        $bal->save();

        return redirect()->route('beginningbalance.index')
            ->with('create-success', 'Account "' . $bal->accountChart->name . '" has been added successfully.');
    }

    public function showEditForm($id)
    {
        $this->resetAddEdit();
        $this->enableAdd  = false;
        $this->enableEdit = true;

        $bal               = BeginningBalance::find($id);
        $this->bal_id      = $bal->id;
        $this->accountCode = $bal->accountchart_id;
        $this->start_date  = $bal->start_date;
        $this->amount      = $bal->amount;
    }

    public function update()
    {
        $this->validate([
            'accountCode' => ['required'],
            'start_date'  => ['required', 'date'],
            'amount'      => ['required', 'numeric'],
        ]);

        $bal = BeginningBalance::find($this->bal_id);
        $bal->accountchart_id = $this->accountCode;
        $bal->start_date      = $this->start_date;
        $bal->amount          = $this->amount;
        $bal->save();
        return redirect()->route('beginningbalance.index')
            ->with('update-success', 'Account Beginning Balance "' . $bal->accountChart->name . '" created successfully.');
    }

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

    public function resetAddEdit()
    {
        $this->enableAdd   = false;
        $this->enableEdit  = false;
        $this->accountCode = null;
        $this->start_date  = null;
        $this->amount      = null;
        // $enableAdd == true && $enableEdit == false && $bal_id != $balance->id
    }

    public function render()
    {
        $balances = BeginningBalance::with('accountChart')->select('id', 'accountchart_id', 'start_date', 'amount')->get();
        $accountChartCodes = AccountChart::select('id', 'code', 'name')->orderBy('code', 'ASC')->orderBy('name', 'ASC')->get();
        return view('livewire.beginning-balance.beginning-balance-component', ['balances' => $balances, 'accountChartCodes' => $accountChartCodes])->layout('layouts.base');
    }
}
