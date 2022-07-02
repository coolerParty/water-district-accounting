<?php

namespace App\Http\Livewire\MajorAccountGroup;

use App\Models\MajorAccountGroup;
use Livewire\Component;

class MajorAccountGroupAddComponent extends Component
{
    public $seq_no;
    public $code;
    public $name;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'seq_no' => ['nullable', 'numeric'],
            'code'   => ['required', 'string'],
            'name'   => ['required', 'min:3','string','unique:major_account_groups'],
        ]);
    }

    public function store()
    {
        $this->confirmation();

        $this->validate([
            'seq_no' => ['nullable', 'numeric'],
            'code'   => ['required', 'string'],
            'name'   => ['required', 'min:3','string','unique:major_account_groups'],
        ]);

        $account         = new MajorAccountGroup();
        $account->seq_no = $this->seq_no;
        $account->code   = $this->code;
        $account->name   = $this->name;
        $account->save();

        return redirect()->route('majoraccountgroup.index')
            ->with('create-success', 'Account Group "' . $this->name . '" created successfully.');
    }

    public function confirmation()
    {
        if (!auth()->user()->can('account-group-create')) {
            abort(404);
        }
    }

    public function render()
    {
        $this->confirmation();

        return view('livewire.major-account-group.major-account-group-add-component')->layout('layouts.base');
    }
}
