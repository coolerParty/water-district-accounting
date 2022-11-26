<?php

namespace App\Http\Livewire\AccountChart;

use App\Http\Requests\AccountChartEditRequest;
use App\Models\AccountChart;
use App\Models\AccountGroup;
use App\Models\MajorAccountGroup;
use App\Models\SubMajorAccountGroup;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AccountChartEditComponent extends Component
{
    use AuthorizesRequests;

    public $account_id;
    public $code;
    public $name;
    public $acctgrp_id;
    public $mjracctgrp_id;
    public $submjracctgrp_id;
    public $current_non;

    public function rules(): array
    {
        return (new AccountChartEditRequest())->rules($this->account_id);
    }

    public function mount($id)
    {
        $account                = AccountChart::findOrFail($id);
        $this->account_id       = $account->id;
        $this->code             = $account->code;
        $this->name             = $account->name;
        $this->acctgrp_id       = $account->acctgrp_id;
        $this->mjracctgrp_id    = $account->mjracctgrp_id;
        $this->submjracctgrp_id = $account->submjracctgrp_id;
        $this->current_non      = $account->current_non;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function update()
    {
        $this->confirmation();
        $this->validate();

        $account                   = AccountChart::find($this->account_id);
        $account->code             = $this->code;
        $account->name             = $this->name;
        $account->acctgrp_id       = $this->acctgrp_id;
        $account->mjracctgrp_id    = $this->mjracctgrp_id;
        $account->submjracctgrp_id = $this->submjracctgrp_id;
        $account->current_non      = $this->current_non;
        $account->save();

        return redirect()->route('accountchart.index')
            ->with('update-success', 'Account Chart "' . $this->name . '" updated successfully.');
    }

    public function confirmation()
    {
        $this->authorize('account-chart-create');
    }

    public function render()
    {
        $this->confirmation();
        $accountgroups = AccountGroup::select('id', 'code', 'name')->orderBy('seq_no', 'ASC')->orderBy('code', 'ASC')->get();
        $majorAccountGroups = MajorAccountGroup::select('id', 'code', 'name')->orderBy('seq_no', 'ASC')->orderBy('code', 'ASC')->get();
        $subMajorAccountGroups = SubMajorAccountGroup::select('id', 'code', 'name')->orderBy('seq_no', 'ASC')->orderBy('code', 'ASC')->get();
        return view('livewire.account-chart.account-chart-edit-component', ['accountgroups' => $accountgroups, 'majorAccountGroups' => $majorAccountGroups, 'subMajorAccountGroups' => $subMajorAccountGroups])->layout('layouts.base');
    }
}
