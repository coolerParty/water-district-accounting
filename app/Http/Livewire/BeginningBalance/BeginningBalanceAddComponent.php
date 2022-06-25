<?php

namespace App\Http\Livewire\BeginningBalance;

use App\Models\AccountChart;
use App\Models\BeginningBalance;
use Livewire\Component;

class BeginningBalanceAddComponent extends Component
{
    public $accountCode;
    public $start_date;
    public $amount;

    public function mount()
    {
        $this->accountCode = null;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'accountCode' => ['required'],
            'start_date'  => ['required', 'date'],
            'amount'      => ['required', 'numeric'],
        ]);
    }

    public function store()
    {
        $this->confirmation();

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

    public function confirmation()
    {
        if (!auth()->user()->can('user-create')) {
            abort(404);
        }
    }

    public function render()
    {
        $this->confirmation();

        $accountChartCodes = AccountChart::select('id', 'code', 'name')->orderBy('code', 'ASC')->orderBy('name', 'ASC')->get();
        return view('livewire.beginning-balance.beginning-balance-add-component', ['accountChartCodes' => $accountChartCodes])->layout('layouts.base');
    }
}
