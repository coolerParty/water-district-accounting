<?php

namespace App\Http\Livewire\BillingJournal;

use App\Models\Billing;
use App\Models\JournalEntryVoucher;
use Livewire\Component;
use DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BillingJournalComponent extends Component
{
    use AuthorizesRequests;

    public function destroy($bid, $jid)
    {
        // if (!auth()->user()->can('billing-delete')) {
        //     abort(404);
        // }

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
        // if (!auth()->user()->can('billing-show')) {
        //     abort(404);
        // }

        $this->authorize('billing-show');

        $billings = DB::table('billings')
            ->join('journal_entry_vouchers', 'journal_entry_vouchers.id', '=', 'billings.journal_entry_voucher_id')
            ->select('billings.id as bid', 'zone', 'metered_sales', 'residential', 'comm', 'comm_a', 'comm_b', 'comm_c', 'government', 'journal_entry_vouchers.jv_date as jdate', 'journal_entry_vouchers.jev_no as jno', 'journal_entry_vouchers.id as jid', 'journal_entry_vouchers.particulars as part')
            ->orderby('journal_entry_vouchers.jv_date', 'DESC')
            ->orderby('journal_entry_vouchers.jev_no', 'ASC')
            ->where('type',2)
            ->paginate(10);
        return view('livewire.billing-journal.billing-journal-component', ['billings' => $billings])->layout('layouts.base');
    }
}
