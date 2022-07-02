<?php

namespace App\Http\Livewire\MajorAccountGroup;

use App\Models\MajorAccountGroup;
use Livewire\Component;

class MajorAccountGroupComponent extends Component
{
    public function destroy($id)
    {
        if (!auth()->user()->can('account-group-delete')) {
            abort(404);
        }
        $account = MajorAccountGroup::find($id);
        $account->delete();

        return redirect()->route('users.index')
            ->with('delete-success', 'User has been deleted successfully.');
    }

    public function render()
    {
        if (!auth()->user()->can('account-group-show')) {
            abort(404);
        }

        $accounts = MajorAccountGroup::select('id', 'code', 'name', 'seq_no')->paginate(10);
        return view('livewire.major-account-group.major-account-group-component',['accounts'=>$accounts])->layout('layouts.base');
    }
}
