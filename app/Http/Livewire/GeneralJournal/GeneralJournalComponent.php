<?php

namespace App\Http\Livewire\GeneralJournal;

use App\Models\GeneralJournal;
use App\Models\JournalEntryVoucher;
use DB;
use Livewire\Component;

class GeneralJournalComponent extends Component
{
    public function destroy($gid, $jid)
    {
        $jev = JournalEntryVoucher::find($jid);
        $jev->delete();

        $gj = GeneralJournal::find($gid);
        $gj->delete();

        return redirect()->route('generaljournal.index')
            ->with('delete-success', 'General Journal deleted successfully.');
    }

    public function render()
    {
        $generalJournals = DB::table('general_journals')
            ->join('journal_entry_vouchers', 'journal_entry_vouchers.code_id', '=', 'general_journals.id')
            ->select('general_journals.id as gid', 'gen_number', 'journal_entry_vouchers.jv_date as jdate', 'journal_entry_vouchers.jev_no as jno', 'journal_entry_vouchers.id as jid', 'journal_entry_vouchers.particulars as part')
            ->orderby('journal_entry_vouchers.jv_date', 'DESC')
            ->orderby('journal_entry_vouchers.jev_no', 'ASC')
            ->where('type', 5)
            ->paginate(10);
        return view('livewire.general-journal.general-journal-component', ['generalJournals' => $generalJournals])->layout('layouts.base');
    }
}
