<?php

namespace App\Http\Livewire\GeneralJournal;

use App\Models\GeneralJournal;
use App\Models\JournalEntryVoucher;
use DB;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class GeneralJournalComponent extends Component
{
    use AuthorizesRequests;

    public function destroy($gid, $jid)
    {
        // if (!auth()->user()->can('general-journal-delete')) {
        //     abort(404);
        // }

        $this->authorize('general-journal-delete');

        $jev = JournalEntryVoucher::find($jid);
        $jev->delete();

        $gj = GeneralJournal::find($gid);
        $gj->delete();

        return redirect()->route('generaljournal.index')
            ->with('delete-success', 'General Journal deleted successfully.');
    }

    public function render()
    {

        // if (!auth()->user()->can('general-journal-show')) {
        //     abort(404);
        // }

        $this->authorize('general-journal-show');

        // $generalJournals = DB::table('general_journals')
        //     ->join('journal_entry_vouchers', 'journal_entry_vouchers.id', '=', 'general_journals.journal_entry_voucher_id')
        //     ->select('general_journals.id as gid', 'gen_number', 'journal_entry_vouchers.jv_date as jdate', 'journal_entry_vouchers.jev_no as jno', 'journal_entry_vouchers.id as jid', 'journal_entry_vouchers.particulars as part')
        //     ->orderby('journal_entry_vouchers.jv_date', 'DESC')
        //     ->orderby('journal_entry_vouchers.jev_no', 'ASC')
        //     ->where('type', 5)
        //     ->where(function ($query){
        //         if (!auth()->user()->can('Super Admin')) {
        //             $query->where('user_id', Auth::user()->id);
        //         }
        //     })
        //     ->paginate(10);

            $generalJournals = JournalEntryVoucher::with('generalJournal')->select('id','jv_date','jev_no','particulars')
            ->where('type', 5)
            ->orderBy('jv_date','DESC')
            ->orderBy('jev_no','DESC')
            ->where(function ($query){
                if (!auth()->user()->can('Super Admin')) {
                    $query->where('user_id', Auth::user()->id);
                }
            })
            ->paginate(10);
        return view('livewire.general-journal.general-journal-component', ['generalJournals' => $generalJournals])->layout('layouts.base');
    }
}
