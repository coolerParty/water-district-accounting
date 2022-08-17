<?php

namespace App\Http\Livewire\CheckDisbursement;

use App\Models\Disbursement;
use App\Models\JournalEntryVoucher;
use Livewire\Component;
use DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class CheckDisbursementComponent extends Component
{
    use AuthorizesRequests;

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

        $disbursements = JournalEntryVoucher::with('disbursement')->select('id', 'jv_date', 'jev_no', 'particulars')
            ->where('type', 4)
            ->orderBy('jv_date', 'DESC')
            ->orderBy('jev_no', 'DESC')
            ->visibleTo(Auth::user())
            ->paginate(10);

        return view('livewire.check-disbursement.check-disbursement-component', ['disbursements' => $disbursements])->layout('layouts.base');
    }
}
