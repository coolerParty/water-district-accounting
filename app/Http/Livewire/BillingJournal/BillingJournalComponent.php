<?php

namespace App\Http\Livewire\BillingJournal;

use App\Models\Billing;
use App\Models\JournalEntryVoucher;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class BillingJournalComponent extends Component
{
    use AuthorizesRequests;

    public function destroy($bid, $jid)
    {
        $this->authorize('billing-delete');

        $jev = JournalEntryVoucher::find($jid);
        $jev->delete();

        $billing = Billing::find($bid);
        $billing->delete();

        return redirect()->route('billingjournal.index')
            ->with('delete-success', 'Billing Journal deleted successfully.');
    }

    public function render()
    {
        $this->authorize('billing-show');

        $billings = JournalEntryVoucher::with('billing')->select('id', 'jv_date', 'jev_no', 'particulars')
            ->where('type', 2)
            ->orderBy('jv_date', 'DESC')
            ->orderBy('jev_no', 'DESC')
            ->visibleTo(Auth::user())
            ->paginate(10);

        return view('livewire.billing-journal.billing-journal-component', ['billings' => $billings])->layout('layouts.base');
    }
}
