<?php

namespace App\Http\Livewire\ReportGeneration;

use Livewire\Component;

class JournalsReportComponent extends Component
{
    public $date_start;
    public $date_end;
    public $journalType;
    public $option;

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

        if($this->option == 1){
            return redirect()->route('journal.show',['journalType'=>$this->journalType,'date_start'=>$this->date_start,'date_end'=>$this->date_end,]);
        }
        elseif($this->option == 2){
            return redirect()->route('journal.download',['journalType'=>$this->journalType,'date_start'=>$this->date_start,'date_end'=>$this->date_end,]);
        }


    }

    public function render()
    {
        return view('livewire.report-generation.journals-report-component')->layout('layouts.base');
    }
}
