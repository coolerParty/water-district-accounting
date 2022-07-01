<?php

namespace App\Http\Livewire\AccountGroup;

use App\Models\AccountGroup;
use Livewire\Component;
use Illuminate\Validation\Rule;

class AccountGroupEditComponent extends Component
{
    public $account_id;
    public $seq_no;
    public $code;
    public $name;
    public $type;

    public function mount($id)
    {
        $account = AccountGroup::findOrFail($id);
        $this->account_id = $account->id;
        $this->seq_no = $account->seq_no;
        $this->code = $account->code;
        $this->name = $account->name;
        $this->type = $account->type;

    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'seq_no' => ['nullable', 'numeric'],
            'code'   => ['required', 'string'],
            'name'   => ['required', 'min:3','string', Rule::unique('account_groups')->ignore($this->account_id)],
            'type'   => ['required', 'numeric'],
        ]);
    }

    public function update()
    {
        $this->confirmation();

        $this->validate([
            'seq_no' => ['nullable', 'numeric'],
            'code'   => ['required', 'string'],
            'name'   => ['required', 'min:3','string', Rule::unique('account_groups')->ignore($this->account_id)],
            'type'   => ['required', 'numeric'], // 1: Account Group, 2: Major Account Group, 3: Sub Major Account Group,
        ]);

        $account         = AccountGroup::find($this->account_id);
        $account->seq_no = $this->seq_no;
        $account->code   = $this->code;
        $account->name   = $this->name;
        $account->type   = $this->type;
        $account->save();

        return redirect()->route('accountgroup.index')
            ->with('update-success', 'Account Group "' . $this->name . '" updated successfully.');
    }

    public function confirmation()
    {
        if (!auth()->user()->can('account-group-edit')) {
            abort(404);
        }
    }

    public function render()
    {
        $this->confirmation();

        return view('livewire.account-group.account-group-edit-component')->layout('layouts.base');
    }
}
