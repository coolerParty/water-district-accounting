<?php

namespace App\Http\Livewire\CashReceiptJournal;

use App\Models\CashReceipt;
use App\Models\JournalEntryVoucher;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class CashReceiptJournalComponent extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public $search = '';
    public $sortColumn = 'jv_date';
    public $sortDirection = 'asc';
    public $perPage = '10';

    public function sortByColumn($column)
    {
        if($this->sortColumn == $column)
        {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        }
        else
        {
            $this->sortDirection = 'asc';
        }
        $this->sortColumn = $column;
    }

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

        $cashreceipts = DB::table('cash_receipts')
            ->join('journal_entry_vouchers', 'journal_entry_vouchers.id', '=', 'cash_receipts.journal_entry_voucher_id')
            ->select('cash_receipts.id as cid', 'official_receipt', 'a_receipt', 'current', 'penalty', 'arrears_cy', 'arrears_py', 'cod_prev_day', 'jv_date', 'jev_no','journal_entry_vouchers.id as jid','particulars')
            ->where('type',1)
            ->where(function ($query){
                if (!auth()->user()->can('Super Admin')) {
                    $query->where('user_id', Auth::user()->id);
                }
            })
            ->when($this->search, function ($query) {
                $query->Where(function ($query) {
                    $query->orWhere('jv_date','like', '%' . $this->search .'%')
                            ->orWhere('jev_no','like', '%' . $this->search .'%')
                            ->orWhere('particulars','like', '%' . $this->search .'%')
                            ->orWhere('official_receipt','like', '%' . $this->search .'%')
                            ->orWhere('a_receipt','like', '%' . $this->search .'%');
                });
            })
            ->orderBy($this->sortColumn , $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.cash-receipt-journal.cash-receipt-journal-component', ['cashreceipts' => $cashreceipts])->layout('layouts.base');
    }
}
