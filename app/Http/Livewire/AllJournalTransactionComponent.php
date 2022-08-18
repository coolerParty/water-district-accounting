<?php

namespace App\Http\Livewire;

use App\Models\JournalEntryVoucher;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class AllJournalTransactionComponent extends Component
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

    public function destroy($jid)
    {
        if (!auth()->user()->can('cash-receipt-journal-delete')) {
            abort(404);
        }

        // $jev = JournalEntryVoucher::find($jid);
        // $jev->delete();


        return redirect()->route('alljournal.index')
            ->with('delete-success', 'Journal has been deleted successfully.');
    }

    public function render()
    {
        $this->authorize('all-journal-show');

        $journals = JournalEntryVoucher::select('id', 'jev_no', 'type', 'jv_date', 'particulars')
        ->visibleTo(Auth::user())
        ->search('jv_date', $this->search)
        ->search('jev_no', $this->search)
        ->search('particulars', $this->search)
        ->orderBy($this->sortColumn , $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.all-journal-transaction-component', ['journals' => $journals])->layout('layouts.base');
    }
}
