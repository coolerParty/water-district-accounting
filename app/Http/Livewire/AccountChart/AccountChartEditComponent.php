<?php

namespace App\Http\Livewire\AccountChart;

use App\Models\AccountChart;
use App\Models\AccountGroup;
use Livewire\Component;
use Illuminate\Validation\Rule;

class AccountChartEditComponent extends Component
{
    public $account_id;
    public $code;
    public $name;
    public $acctgrp_id;
    public $mjracctgrp_id;
    public $submjracctgrp_id;

    public function mount($id)
    {
        $account = AccountChart::findOrFail($id);
        $this->account_id       = $account->id;
        $this->code             = $account->code;
        $this->name             = $account->name;
        $this->acctgrp_id       = $account->acctgrp_id;
        $this->mjracctgrp_id    = $account->mjracctgrp_id;
        $this->submjracctgrp_id = $account->submjracctgrp_id;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'code'             => ['required', 'string'],
            'name'             => ['required', 'min:3', 'string', Rule::unique('account_charts')->ignore($this->account_id)],
            'acctgrp_id'       => ['required'],
            'mjracctgrp_id'    => ['required'],
            'submjracctgrp_id' => ['required'],
        ]);
    }

    public function update()
    {
        $this->confirmation();

        $this->validate([
            'code'             => ['required', 'string'],
            'name'             => ['required', 'min:3', 'string', Rule::unique('account_charts')->ignore($this->account_id)],
            'acctgrp_id'       => ['required'],
            'mjracctgrp_id'    => ['required'],
            'submjracctgrp_id' => ['required'],
        ]);

        $account                   = AccountChart::find($this->account_id);
        $account->code             = $this->code;
        $account->name             = $this->name;
        $account->acctgrp_id       = $this->acctgrp_id;
        $account->mjracctgrp_id    = $this->mjracctgrp_id;
        $account->submjracctgrp_id = $this->submjracctgrp_id;
        $account->save();

        return redirect()->route('accountchart.index')
            ->with('update-success', 'Account Chart "' . $this->name . '" updated successfully.');
    }

    public function confirmation()
    {
        if (!auth()->user()->can('account-chart-create')) {
            abort(404);
        }
    }

    public function render()
    {
        $this->confirmation();
        $accountgroups = AccountGroup::select('id', 'code', 'name')->orderBy('seq_no', 'ASC')->orderBy('name', 'ASC')->get();
        return view('livewire.account-chart.account-chart-edit-component', ['accountgroups' => $accountgroups])->layout('layouts.base');
    }
}
