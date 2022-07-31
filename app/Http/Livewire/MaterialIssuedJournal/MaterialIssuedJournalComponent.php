<?php

namespace App\Http\Livewire\MaterialIssuedJournal;

use Livewire\Component;
use DB;
use App\Models\MaterialIssuedJournal;
use App\Models\JournalEntryVoucher;

class MaterialIssuedJournalComponent extends Component
{
    public function destroy($mid, $jid)
    {
        if (!auth()->user()->can('material-journal-delete')) {
            abort(404);
        }

        $jev = JournalEntryVoucher::find($jid);
        $jev->delete();

        $mij = MaterialIssuedJournal::find($mid);
        $mij->delete();

        return redirect()->route('materialissuedjournal.index')
            ->with('delete-success', 'Material Issued Journal deleted successfully.');
    }

    public function render()
    {
        if (!auth()->user()->can('material-journal-show')) {
            abort(404);
        }

        $mijs = DB::table('material_issued_journals')
            ->join('journal_entry_vouchers', 'journal_entry_vouchers.id', '=', 'material_issued_journals.journal_entry_voucher_id')
            ->select('material_issued_journals.id as mid', 'rsmi_no', 'journal_entry_vouchers.jv_date as jdate', 'journal_entry_vouchers.jev_no as jno', 'journal_entry_vouchers.id as jid', 'journal_entry_vouchers.particulars as part')
            ->orderby('journal_entry_vouchers.jv_date', 'DESC')
            ->orderby('journal_entry_vouchers.jev_no', 'ASC')
            ->where('type', 3)
            ->paginate(10);
        return view('livewire.material-issued-journal.material-issued-journal-component', ['mijs' => $mijs])->layout('layouts.base');
    }
}
