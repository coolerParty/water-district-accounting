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
        $this->authorize('general-journal-show');

        $generalJournals = JournalEntryVoucher::with('generalJournal')->select('id', 'jv_date', 'jev_no', 'particulars')
            ->where('type', 5)
            ->orderBy('jv_date', 'DESC')
            ->orderBy('jev_no', 'DESC')
            ->visibleTo(Auth::user())
            ->paginate(10);

        return view('livewire.general-journal.general-journal-component', ['generalJournals' => $generalJournals])->layout('layouts.base');
    }
}
