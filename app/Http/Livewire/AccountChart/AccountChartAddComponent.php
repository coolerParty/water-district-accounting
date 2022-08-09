<?php

namespace App\Http\Livewire\AccountChart;

use App\Imports\AccountChartImport;
use App\Models\AccountChart;
use App\Models\AccountGroup;
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

    use WithFileUploads;
    public $file;

    public function importFile()
    {
        // Excel::queueImport(new AccountChartImport, $this->file);
        $import = new AccountChartImport();
        $import->import($this->file);

        if($import->failures()->isNotEmpty()){
            return back()->withFailures($import->failures());
        }

        return redirect()->route('accountchart.create')
            ->with('create-success', 'File Uploaded successfully.');
    }

    public function mount()
    {
        $this->type = null;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'code'             => ['required', 'string'],
            'name'             => ['required', 'min:3','string','unique:account_charts'],
            'acctgrp_id'       => ['required'],
            'mjracctgrp_id'    => ['required'],
            'submjracctgrp_id' => ['required'],
        ]);
    }

    public function store()
    {
        $this->confirmation();

        $this->validate([
            'code'             => ['required', 'string'],
            'name'             => ['required', 'min:3','string','unique:account_charts'],
            'acctgrp_id'       => ['required'],
            'mjracctgrp_id'    => ['required'],
            'submjracctgrp_id' => ['required'],
        ]);

        $account                   = new AccountChart();
        $account->code             = $this->code;
        $account->name             = $this->name;
        $account->acctgrp_id       = $this->acctgrp_id;
        $account->mjracctgrp_id    = $this->mjracctgrp_id;
        $account->submjracctgrp_id = $this->submjracctgrp_id;
        $account->save();

        return redirect()->route('accountchart.index')
            ->with('create-success', 'Account Chart "' . $this->name . '" created successfully.');
    }

    public function confirmation()
    {
        // if (!auth()->user()->can('account-chart-create')) {
        //     abort(404);
        // }

        $this->authorize('account-chart-create');
    }

    public function render()
    {
        $this->confirmation();

        $accountgroups = AccountGroup::select('id','code','name')->orderBy('seq_no','ASC')->orderBy('name','ASC')->get();

        return view('livewire.account-chart.account-chart-add-component', ['accountgroups'=>$accountgroups])->layout('layouts.base');
    }
}
