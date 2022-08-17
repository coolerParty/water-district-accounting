<?php

namespace App\Http\Livewire\MaterialIssuedJournal;

use Livewire\Component;
use App\Models\MaterialIssuedJournal;
use App\Models\JournalEntryVoucher;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class MaterialIssuedJournalComponent extends Component
{
    use AuthorizesRequests;

    public function destroy($mid, $jid)
    {

        $this->authorize('material-journal-delete');

        $jev = JournalEntryVoucher::find($jid);
        $jev->delete();

        $mij = MaterialIssuedJournal::find($mid);
        $mij->delete();

        return redirect()->route('materialissuedjournal.index')
            ->with('delete-success', 'Material Issued Journal deleted successfully.');
    }

    public function render()
    {
        $this->authorize('material-journal-show');

        $mijs = JournalEntryVoucher::with('materialIssuedJournal')->select('id', 'jv_date', 'jev_no', 'particulars')
            ->where('type', 3)
            ->orderBy('jv_date', 'DESC')
            ->orderBy('jev_no', 'DESC')
            ->visibleTo(Auth::user())
            ->paginate(10);

        return view('livewire.material-issued-journal.material-issued-journal-component', ['mijs' => $mijs])->layout('layouts.base');
    }
}
