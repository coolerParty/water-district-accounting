<?php

namespace App\Http\Livewire\CashReceiptJournal;

use App\Models\CashReceipt;
use App\Models\JournalEntryVoucher;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class CashReceiptJournalComponent extends Component
{
    use AuthorizesRequests;

    public function destroy($cid, $jid)
    {
        $this->authorize('cash-receipt-journal-delete');

        $jev = JournalEntryVoucher::find($jid);
        $jev->delete();

        $cash = CashReceipt::find($cid);
        $cash->delete();

        return redirect()->route('cashreceiptjournal.index')
            ->with('delete-success', 'Cash Receipt Journal deleted successfully.');
    }

    public function render()
    {
        $this->authorize('cash-receipt-journal-show');

        $cashreceipts = JournalEntryVoucher::with('cashReciept')->select('id', 'jv_date', 'jev_no', 'particulars')
            ->where('type', 1)
            ->orderBy('jv_date', 'DESC')
            ->orderBy('jev_no', 'DESC')
            ->visibleTo(Auth::user())
            ->paginate(10);

        return view('livewire.cash-receipt-journal.cash-receipt-journal-component', ['cashreceipts' => $cashreceipts])->layout('layouts.base');
    }
}
