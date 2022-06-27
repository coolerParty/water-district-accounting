<?php

namespace App\Http\Livewire\CashReceiptJournal;

use App\Models\CashReceipt;
use App\Models\JournalEntryVoucher;
use App\Models\Transaction;
use Livewire\Component;
use DB;

class CashReceiptJournalComponent extends Component
{
    public function destroy($cid,$jid)
    {
        // $transaction = Transaction::where('journal_entry_voucher_id', $jid)->all();
        // $transaction->delete();

        $jev = JournalEntryVoucher::find($jid);
        $jev->delete();

        $cash = CashReceipt::find($cid);
        $cash->delete();

        return redirect()->route('cashreceiptjournal.index')
            ->with('delete-success', 'Cash Receipt Journal deleted successfully.');
    }

    public function render()
    {
        // $cashreceipts = CashReceipt::with('jev')->select('id','official_receipt','a_receipt','current','penalty','arrears_cy','arrears_py','cod_prev_day')->paginate(5);
        $cashreceipts = DB::table('cash_receipts')
            ->join('journal_entry_vouchers', 'journal_entry_vouchers.code_id', '=', 'cash_receipts.id')
            ->select('cash_receipts.id as cid', 'official_receipt', 'a_receipt', 'current', 'penalty', 'arrears_cy', 'arrears_py', 'cod_prev_day', 'journal_entry_vouchers.jv_date as jdate', 'journal_entry_vouchers.jev_no as jno','journal_entry_vouchers.code_id as jid')
            ->orderby('journal_entry_vouchers.jv_date', 'DESC')
            ->orderby('journal_entry_vouchers.jev_no', 'ASC')
            ->paginate(10);
        return view('livewire.cash-receipt-journal.cash-receipt-journal-component', ['cashreceipts' => $cashreceipts])->layout('layouts.base');
    }
}
