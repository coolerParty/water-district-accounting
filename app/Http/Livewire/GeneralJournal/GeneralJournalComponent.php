<?php

namespace App\Http\Livewire\GeneralJournal;

use App\Models\GeneralJournal;
use App\Models\JournalEntryVoucher;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class GeneralJournalComponent extends Component
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

    public function destroy($gid, $jid)
    {
        $this->authorize('general-journal-delete');

        $jev = JournalEntryVoucher::find($jid);
        $jev->delete();

        $gj = GeneralJournal::find($gid);
        $gj->delete();

        return redirect()->route('generaljournal.index')
            ->with('delete-success', 'General Journal deleted successfully.');
    }

    public function render()
    {
        $this->authorize('general-journal-show');

        $generalJournals = DB::table('general_journals')
            ->join('journal_entry_vouchers', 'journal_entry_vouchers.id', '=', 'general_journals.journal_entry_voucher_id')
            ->select('general_journals.id as gid', 'gen_number', 'jv_date', 'jev_no', 'journal_entry_vouchers.id as jid', 'journal_entry_vouchers.particulars as part')
            ->where('type', 5)
            ->where(function ($query) {
                if (!auth()->user()->can('Super Admin')) {
                    $query->where('user_id', Auth::user()->id);
                }
            })
            ->Where(function ($query) {
                $query->Orwhere('jv_date', 'like', '%' . $this->search . '%')
                    ->Orwhere('jev_no', 'like', '%' . $this->search . '%')
                    ->Orwhere('journal_entry_vouchers.particulars', 'like', '%' . $this->search . '%')
                    ->Orwhere('gen_number', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.general-journal.general-journal-component', ['generalJournals' => $generalJournals])->layout('layouts.base');
    }
}
