<?php

namespace App\Http\Livewire\BeginningBalance;

use App\Models\AccountChart;
use App\Models\BeginningBalance;
use Livewire\Component;

class BeginningBalanceEditComponent extends Component
{
    public $bal_id;
    public $accountCode;
    public $start_date;
    public $amount;

    public function mount($id)
    {
        $bal               = BeginningBalance::findOrFail($id);
        $this->bal_id      = $bal->id;
        $this->accountCode = $bal->accountchart_id;
        $this->start_date  = $bal->start_date;
        $this->amount      = $bal->amount;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'accountCode' => ['required'],
            'start_date'  => ['required', 'date'],
            'amount'      => ['required', 'numeric'],
        ]);
    }

    public function update()
    {
        $this->confirmation();

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
        return view('livewire.beginning-balance.beginning-balance-edit-component',['accountChartCodes'=>$accountChartCodes])->layout('layouts.base');
    }
}
