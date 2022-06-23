<?php

namespace App\Http\Livewire\AccountGroup;

use App\Models\AccountGroup;
use Livewire\Component;

class AccountGroupComponent extends Component
{
    public function destroy($id)
    {
        if (!auth()->user()->can('user-delete')) {
            abort(404);
        }
        $account = AccountGroup::find($id);
        $account->delete();

        return redirect()->route('users.index')
            ->with('delete-success', 'User has been deleted successfully.');
    }

    public function render()
    {
        if (!auth()->user()->can('user-show')) {
            abort(404);
        }

        $accounts = AccountGroup::select('id', 'code', 'name', 'seq_no', 'type')->paginate(10);

        return view('livewire.account-group.account-group-component', ['accounts' => $accounts])->layout('layouts.base');
    }
}
