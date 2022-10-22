<?php

namespace App\Http\Livewire\MaterialIssuedJournal;

use Livewire\Component;
use App\Models\MaterialIssuedJournal;
use App\Models\JournalEntryVoucher;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class MaterialIssuedJournalComponent extends Component
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

    public function destroy($mid, $jid)
    {

        $this->authorize('material-journal-delete');

        $jev = JournalEntryVoucher::find($jid);
        $jev->delete();

        $mij = MaterialIssuedJournal::find($mid);
        $mij->delete();

        return redirect()->route('materialissuedjournal.index')
            ->with('delete-success', 'Material Issued Journal deleted successfully.');
    }

    public function render()
    {
        $this->authorize('material-journal-show');

        $mijs = DB::table('material_issued_journals')
            ->join('journal_entry_vouchers', 'journal_entry_vouchers.id', '=', 'material_issued_journals.journal_entry_voucher_id')
            ->select('material_issued_journals.id as mid', 'rsmi_no', 'jv_date', 'jev_no', 'journal_entry_vouchers.id as jid', 'particulars')
            ->where('type', 3)
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
                            ->orWhere('rsmi_no', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.material-issued-journal.material-issued-journal-component', ['mijs' => $mijs])->layout('layouts.base');
    }
}
