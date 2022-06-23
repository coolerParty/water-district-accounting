<?php

namespace App\Http\Livewire\AccountGroup;

use App\Models\AccountGroup;
use Livewire\Component;

class AccountGroupAddComponent extends Component
{
    public $seq_no;
    public $code;
    public $name;
    public $type;

    public function mount()
    {
        $this->type = null;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'seq_no' => ['required', 'numeric'],
            'code'   => ['required', 'string'],
            'name'   => ['required', 'min:3','string','unique:account_groups'],
            'type'   => ['required', 'numeric'],
        ]);
    }

    public function store()
    {
        $this->confirmation();

        $this->validate([
            'seq_no' => ['required', 'numeric'],
            'code'   => ['required', 'string'],
            'name'   => ['required', 'min:3','string','unique:account_groups'],
            'type'   => ['required', 'numeric'], // 1: Account Group, 2: Major Account Group, 3: Sub Major Account Group,
        ]);

        $account         = new AccountGroup();
        $account->seq_no = $this->seq_no;
        $account->code   = $this->code;
        $account->name   = $this->name;
        $account->type   = $this->seq_no;
        $account->save();

        return redirect()->route('accountgroup.index')
            ->with('create-success', 'Account Group "' . $this->name . '" created successfully.');
    }

    public function confirmation()
    {
        if (!auth()->user()->can('user-create')) {
            abort(404);
        }
    }

    public function render()
    {
        $this->confirmation();

        return view('livewire.account-group.account-group-add-component')->layout('layouts.base');
    }
}
