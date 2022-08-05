<?php

namespace App\Http\Livewire\CashReceiptJournal;

use App\Models\CashReceipt;
use App\Models\JournalEntryVoucher;
use Livewire\Component;
use DB;

class CashReceiptJournalComponent extends Component
{
    public function destroy($cid,$jid)
    {
        if (!auth()->user()->can('cash-receipt-journal-delete')) {
            abort(404);
        }

        $jev = JournalEntryVoucher::find($jid);
        $jev->delete();

        $cash = CashReceipt::find($cid);
        $cash->delete();

        return redirect()->route('cashreceiptjournal.index')
            ->with('delete-success', 'Cash Receipt Journal deleted successfully.');
    }

    public function render()
    {
        if (!auth()->user()->can('cash-receipt-journal-show')) {
            abort(404);
        }

        $cashreceipts = DB::table('cash_receipts')
            ->join('journal_entry_vouchers', 'journal_entry_vouchers.id', '=', 'cash_receipts.journal_entry_voucher_id')
            ->select('cash_receipts.id as cid', 'official_receipt', 'a_receipt', 'current', 'penalty', 'arrears_cy', 'arrears_py', 'cod_prev_day', 'journal_entry_vouchers.jv_date as jdate', 'journal_entry_vouchers.jev_no as jno','journal_entry_vouchers.id as jid','journal_entry_vouchers.particulars as part')
            ->orderby('journal_entry_vouchers.jv_date', 'DESC')
            ->orderby('journal_entry_vouchers.jev_no', 'ASC')
            ->where('type',1)
            ->paginate(10);
        return view('livewire.cash-receipt-journal.cash-receipt-journal-component', ['cashreceipts' => $cashreceipts])->layout('layouts.base');
    }
}
