<?php

namespace App\Http\Livewire;

use App\Models\JournalEntryVoucher;
use Livewire\Component;

class AllJournalTransactionComponent extends Component
{
    public function destroy($jid)
    {
        if (!auth()->user()->can('cash-receipt-journal-delete')) {
            abort(404);
        }

        $jev = JournalEntryVoucher::find($jid);
        $jev->delete();


        return redirect()->route('alljournal.index')
            ->with('delete-success', 'Journal has been deleted successfully.');
    }

    public function render()
    {
        $journals = JournalEntryVoucher::select('id','jev_no','type','jv_date','particulars')->orderBy('jv_date','Desc')->paginate(10);
        return view('livewire.all-journal-transaction-component',['journals'=>$journals])->layout('layouts.base');
    }
}
