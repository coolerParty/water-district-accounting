<?php

namespace App\Http\Livewire\ReportGeneration;

use App\Models\AccountChart;
use Carbon\Carbon;
use Livewire\Component;

class GeneralLedgerComponent extends Component
{
    public $year;
    public $month;
    public $code;
    public $showPrint = false;

    public function mount()
    {
        $this->year  = Carbon::now()->format('Y');
        $this->month = Carbon::now()->format('m');
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'year'            => ['required', 'integer', 'digits:4'],
            'month'           => ['required', 'integer', 'digits_between:1,2','min:1','max:12'],
            'code'            => ['required', 'string'],
        ]);
    }

    public function printView()
    {
        $this->validate([
            'year'            => ['required', 'integer', 'digits:4'],
            'month'           => ['required', 'integer', 'digits_between:1,2','min:1','max:12'],
            'code'            => ['required', 'string'],
        ]);

        session()->flash('create-success', 'Report has been set. Please select to Print Preview or download pdf.');

        $this->showPrint = true;
    }

    public function cancel()
    {
        $this->showPrint = false;
    }

    public function render()
    {
        $accounts = AccountChart::select('id', 'code', 'name')->orderBy('code', 'ASC')->orderBy('name', 'ASC')->get();
        return view('livewire.report-generation.general-ledger-component',['accounts'=>$accounts])->layout('layouts.base');
    }
}
