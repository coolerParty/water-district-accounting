<?php

namespace App\Http\Livewire\MajorAccountGroup;

use App\Models\MajorAccountGroup;
use Livewire\Component;
use Illuminate\Validation\Rule;

class MajorAccountGroupEditComponent extends Component
{
    public $account_id;
    public $seq_no;
    public $code;
    public $name;

    public function mount($id)
    {
        $account = MajorAccountGroup::findOrFail($id);
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
            'name'   => ['required', 'min:3','string', Rule::unique('major_account_groups')->ignore($this->account_id)],
        ]);
    }

    public function update()
    {
        $this->confirmation();

        $this->validate([
            'seq_no' => ['nullable', 'numeric'],
            'code'   => ['required', 'string'],
            'name'   => ['required', 'min:3','string', Rule::unique('major_account_groups')->ignore($this->account_id)],
        ]);

        $account         = MajorAccountGroup::find($this->account_id);
        $account->seq_no = $this->seq_no;
        $account->code   = $this->code;
        $account->name   = $this->name;
        $account->save();

        return redirect()->route('majoraccountgroup.index')
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

        return view('livewire.major-account-group.major-account-group-edit-component')->layout('layouts.base');
    }
}
