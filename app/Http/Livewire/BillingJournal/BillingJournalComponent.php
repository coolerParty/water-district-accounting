<?php

namespace App\Http\Livewire\BillingJournal;

use App\Models\Billing;
use App\Models\JournalEntryVoucher;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class BillingJournalComponent extends Component
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

        $billings = DB::table('billings')
            ->join('journal_entry_vouchers', 'journal_entry_vouchers.id', '=', 'billings.journal_entry_voucher_id')
            ->select('billings.id as bid', 'zone', 'metered_sales', 'residential', 'comm', 'comm_a', 'comm_b', 'comm_c', 'government', 'jv_date', 'jev_no', 'journal_entry_vouchers.id as jid', 'particulars')
            ->where('type', 2)
            ->where(function ($query) {
                if (!auth()->user()->can('Super Admin')) {
                    $query->where('user_id', Auth::user()->id);
                }
            })
            ->when($this->search, function ($query) {
                $query->Where(function ($query) {
                    $query->orWhere('jv_date', 'like', '%' . $this->search . '%')
                        ->orWhere('jev_no', 'like', '%' . $this->search . '%')
                        ->orWhere('particulars', 'like', '%' . $this->search . '%')
                        ->orWhere('zone', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.billing-journal.billing-journal-component', ['billings' => $billings])->layout('layouts.base');
    }
}
