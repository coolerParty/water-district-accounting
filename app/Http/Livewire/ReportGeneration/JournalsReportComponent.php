<?php

namespace App\Http\Livewire\ReportGeneration;

use App\Models\JournalEntryVoucher;
use Carbon\Carbon;
use Livewire\Component;

class JournalsReportComponent extends Component
{
    public $date_start;
    public $date_end;
    public $journalType;
    public $showPrint = false;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'date_start' => ['required', 'date', 'before:date_end'],
            'date_end' => ['required', 'date', 'after:date_start'],
            'journalType' => ['required', 'numeric','min:0','max:5'],
        ]);
    }

    public function printView()
    {
        $this->validate([
            'date_start' => ['required', 'date', 'before:date_end'],
            'date_end' => ['required', 'date', 'after:date_start'],
            'journalType' => ['required', 'numeric','min:0','max:5'],
        ]);

        $journals = JournalEntryVoucher::select('id', 'jev_no', 'type', 'jv_date', 'particulars')
        ->where('type', $this->journalType)
        ->where('jv_date','>=',$this->date_start)
        ->where('jv_date','<=',$this->date_end)
        ->orderBy('jv_date','ASC')
        ->orderBy('jev_no','ASC')
        ->with('transactions')
        ->get();

        if($journals->count() == 0){
            session()->flash('delete-success', 'No Transaction Found!');
            return;
        }

        session()->flash('create-success', $journals->count() . ' Transactions Found.');

        $this->showPrint = true;

        // if($this->option == 1){
        //     return redirect()->route('journal.show',['journalType'=>$this->journalType,'date_start'=>$this->date_start,'date_end'=>$this->date_end,]);
        // }
        // elseif($this->option == 2){
        //     return redirect()->route('journal.download',['journalType'=>$this->journalType,'date_start'=>$this->date_start,'date_end'=>$this->date_end,]);
        // }


    }

    public function cancel()
    {
        $this->showPrint = false;
    }

    public function render()
    {
        return view('livewire.report-generation.journals-report-component')->layout('layouts.base');
    }
}
