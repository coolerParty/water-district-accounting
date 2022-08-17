<?php

namespace App\Http\Livewire;

use App\Models\JournalEntryVoucher;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class AllJournalTransactionComponent extends Component
{
    use AuthorizesRequests;

    public function destroy($jid)
    {
        if (!auth()->user()->can('cash-receipt-journal-delete')) {
            abort(404);
        }

        // $jev = JournalEntryVoucher::find($jid);
        // $jev->delete();


        return redirect()->route('alljournal.index')
            ->with('delete-success', 'Journal has been deleted successfully.');
    }

    public function render()
    {
        $this->authorize('all-journal-show');

        $journals = JournalEntryVoucher::select('id', 'jev_no', 'type', 'jv_date', 'particulars')->visibleTo(Auth::user())->orderBy('jv_date', 'Desc')->orderBy('jev_no', 'DESC')->paginate(10);
        return view('livewire.all-journal-transaction-component', ['journals' => $journals])->layout('layouts.base');
    }
}
