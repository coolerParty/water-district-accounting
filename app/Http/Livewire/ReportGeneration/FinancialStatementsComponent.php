<?php

namespace App\Http\Livewire\ReportGeneration;

use App\Models\JournalEntryVoucher;
use Carbon\Carbon;
use Livewire\Component;

class FinancialStatementsComponent extends Component
{
    public $year;
    public $month;
    public $reportType;
    public $showPrint = false;

    public function mount()
    {
        $this->year  = Carbon::now()->format('Y');
        $this->month = Carbon::now()->format('m');
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'year'       => ['required', 'integer', 'digits:4'],
            'month'      => ['required', 'integer', 'digits_between:1,2','min:1','max:12'],
            'reportType' => ['required', 'integer', 'digits:1'],
        ]);
    }

    public function printView()
    {
        $this->validate([
            'year'       => ['required', 'integer', 'digits:4'],
            'month'      => ['required', 'integer', 'digits_between:1,2','min:1','max:12'],
            'reportType' => ['required', 'integer', 'digits:1'],
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
        return view('livewire.report-generation.financial-statements-component')->layout('layouts.base');
    }
}
