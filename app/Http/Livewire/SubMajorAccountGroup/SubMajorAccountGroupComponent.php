<?php

namespace App\Http\Livewire\SubMajorAccountGroup;

use App\Models\SubMajorAccountGroup;
use Livewire\Component;

class SubMajorAccountGroupComponent extends Component
{
    public function destroy($id)
    {
        if (!auth()->user()->can('account-group-delete')) {
            abort(404);
        }
        $account = SubMajorAccountGroup::find($id);
        $account->delete();

        return redirect()->route('submajoraccountgroup.index')
            ->with('delete-success', 'Sub Major Account Group has been deleted successfully.');
    }

    public function render()
    {
        if (!auth()->user()->can('account-group-show')) {
            abort(404);
        }

        $accounts = SubMajorAccountGroup::select('id', 'code', 'name', 'seq_no')->orderBy('seq_no','ASC')->paginate(10);

        return view('livewire.sub-major-account-group.sub-major-account-group-component',['accounts'=>$accounts])->layout('layouts.base');
    }
}
