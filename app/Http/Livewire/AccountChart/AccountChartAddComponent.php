<?php

namespace App\Http\Livewire\AccountChart;

use App\Http\Requests\AccountChartAddRequest;
use App\Imports\AccountChartImport;
use App\Models\AccountChart;
use App\Models\AccountGroup;
use App\Models\MajorAccountGroup;
use App\Models\SubMajorAccountGroup;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AccountChartAddComponent extends Component
{
    use AuthorizesRequests;

    public $code;
    public $name;
    public $acctgrp_id;
    public $mjracctgrp_id;
    public $submjracctgrp_id;
    public $current_non;

    use WithFileUploads;
    public $file;

    public function importFile()
    {
        // Excel::queueImport(new AccountChartImport, $this->file);
        $import = new AccountChartImport();
        $import->import($this->file);

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return redirect()->route('accountchart.create')
            ->with('create-success', 'File Uploaded successfully.');
    }

    public function rules(): array
    {
        return (new AccountChartAddRequest())->rules();
    }

    public function mount()
    {
        $this->type = null;
        $this->current_non = 3;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function store()
    {
        $this->confirmation();
        $this->validate();

        $account                   = new AccountChart();
        $account->code             = $this->code;
        $account->name             = $this->name;
        $account->acctgrp_id       = $this->acctgrp_id;
        $account->mjracctgrp_id    = $this->mjracctgrp_id;
        $account->submjracctgrp_id = $this->submjracctgrp_id;
        $account->current_non      = $this->current_non;
        $account->save();

        return redirect()->route('accountchart.index')
            ->with('create-success', 'Account Chart "' . $this->name . '" created successfully.');
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

        return view('livewire.account-chart.account-chart-add-component', ['accountgroups' => $accountgroups, 'majorAccountGroups' => $majorAccountGroups, 'subMajorAccountGroups' => $subMajorAccountGroups])->layout('layouts.base');
    }
}
