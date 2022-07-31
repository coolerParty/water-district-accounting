<?php

namespace App\Http\Livewire\CheckDisbursement;

use App\Models\Disbursement;
use App\Models\JournalEntryVoucher;
use Livewire\Component;
use DB;

class CheckDisbursementComponent extends Component
{
    public function destroy($cdid, $jid)
    {
        if (!auth()->user()->can('disbursement-journal-delete')) {
            abort(404);
        }

        $jev = JournalEntryVoucher::find($jid);
        $jev->delete();

        $cd = Disbursement::find($cdid);
        $cd->delete();

        return redirect()->route('checkdisbursementjournal.index')
            ->with('delete-success', 'Check Disbursement Journal deleted successfully.');
    }

    public function render()
    {
        if (!auth()->user()->can('disbursement-journal-show')) {
            abort(404);
        }

        $disbursements = DB::table('disbursements')
            ->join('journal_entry_vouchers', 'journal_entry_vouchers.id', '=', 'disbursements.journal_entry_voucher_id')
            ->select(
                'disbursements.id as cdid',
                'dv_number',
                'check_number',
                'amount',
                'journal_entry_vouchers.jv_date as jdate',
                'journal_entry_vouchers.jev_no as jno',
                'journal_entry_vouchers.id as jid',
                'journal_entry_vouchers.particulars as part'
            )
            ->orderby('journal_entry_vouchers.jv_date', 'DESC')
            ->orderby('journal_entry_vouchers.jev_no', 'ASC')
            ->where('type', 4)
            ->paginate(10);
        return view('livewire.check-disbursement.check-disbursement-component', ['disbursements' => $disbursements])->layout('layouts.base');
    }
}
