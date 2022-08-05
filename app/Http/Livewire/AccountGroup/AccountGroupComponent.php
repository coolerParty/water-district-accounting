<?php

namespace App\Http\Livewire\AccountGroup;

use App\Models\AccountGroup;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AccountGroupComponent extends Component
{
    use AuthorizesRequests;

    public function destroy($id)
    {
        // if (!auth()->user()->can('account-group-delete')) {
        //     abort(404);
        // }

        $this->authorize('account-group-delete');

        $account = AccountGroup::find($id);
        $account->delete();

        return redirect()->route('users.index')
            ->with('delete-success', 'User has been deleted successfully.');
    }

    public function render()
    {
        // if (!auth()->user()->can('account-group-show')) {
        //     abort(404);
        // }

        $this->authorize('account-group-show');

        $accounts = AccountGroup::select('id', 'code', 'name', 'seq_no')->paginate(10);

        return view('livewire.account-group.account-group-component', ['accounts' => $accounts])->layout('layouts.base');
    }
}
