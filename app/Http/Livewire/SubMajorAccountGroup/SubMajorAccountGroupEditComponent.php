<?php

namespace App\Http\Livewire\SubMajorAccountGroup;

use App\Models\SubMajorAccountGroup;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SubMajorAccountGroupEditComponent extends Component
{
    use AuthorizesRequests;

    public $account_id;
    public $seq_no;
    public $code;
    public $name;

    public function mount($id)
    {
        $account = SubMajorAccountGroup::findOrFail($id);
        $this->account_id = $account->id;
        $this->seq_no = $account->seq_no;
        $this->code = $account->code;
        $this->name = $account->name;

    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'seq_no' => ['nullable', 'numeric'],
            'code'   => ['required', 'string'],
            'name'   => ['required', 'min:3','string', Rule::unique('sub_major_account_groups')->ignore($this->account_id)],
        ]);
    }

    public function update()
    {
        $this->confirmation();

        $this->validate([
            'seq_no' => ['nullable', 'numeric'],
            'code'   => ['required', 'string'],
            'name'   => ['required', 'min:3','string', Rule::unique('sub_major_account_groups')->ignore($this->account_id)],
        ]);

        $account         = SubMajorAccountGroup::find($this->account_id);
        $account->seq_no = $this->seq_no;
        $account->code   = $this->code;
        $account->name   = $this->name;
        $account->save();

        return redirect()->route('submajoraccountgroup.index')
            ->with('update-success', 'Account Group "' . $this->name . '" updated successfully.');
    }

    public function confirmation()
    {
        // if (!auth()->user()->can('account-group-edit')) {
        //     abort(404);
        // }

        $this->authorize('account-group-edit');
    }

    public function render()
    {
        $this->confirmation();

        return view('livewire.sub-major-account-group.sub-major-account-group-edit-component')->layout('layouts.base');
    }
}
