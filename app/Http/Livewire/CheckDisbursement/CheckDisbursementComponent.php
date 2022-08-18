<?php

namespace App\Http\Livewire\CheckDisbursement;

use App\Models\Disbursement;
use App\Models\JournalEntryVoucher;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class CheckDisbursementComponent extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public $search = '';
    public $sortColumn = 'jv_date';
    public $sortDirection = 'asc';
    public $perPage = '10';

    public function sortByColumn($column)
    {
        if ($this->sortColumn == $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortColumn = $column;
    }

    public function destroy($cdid, $jid)
    {
        $this->authorize('disbursement-journal-delete');

        $jev = JournalEntryVoucher::find($jid);
        $jev->delete();

        $cd = Disbursement::find($cdid);
        $cd->delete();

        return redirect()->route('checkdisbursementjournal.index')
            ->with('delete-success', 'Check Disbursement Journal deleted successfully.');
    }

    public function render()
    {
        $this->authorize('disbursement-journal-show');

        $disbursements = DB::table('disbursements')
            ->join('journal_entry_vouchers', 'journal_entry_vouchers.id', '=', 'disbursements.journal_entry_voucher_id')
            ->select(
                'disbursements.id as cdid',
                'dv_number',
                'check_number',
                'amount',
                'jv_date',
                'jev_no',
                'journal_entry_vouchers.id as jid',
                'journal_entry_vouchers.particulars as part'
            )
            ->where('type', 4)
            ->where(function ($query) {
                if (!auth()->user()->can('Super Admin')) {
                    $query->where('user_id', Auth::user()->id);
                }
            })
            ->Where(function ($query) {
                $query->Orwhere('jv_date', 'like', '%' . $this->search . '%')
                    ->Orwhere('jev_no', 'like', '%' . $this->search . '%')
                    ->Orwhere('journal_entry_vouchers.particulars', 'like', '%' . $this->search . '%')
                    ->Orwhere('dv_number', 'like', '%' . $this->search . '%')
                    ->Orwhere('check_number', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.check-disbursement.check-disbursement-component', ['disbursements' => $disbursements])->layout('layouts.base');
    }
}
