<?php

namespace App\Http\Livewire\AccountGroup;

use App\Imports\AccountGroupImport;
use App\Models\AccountGroup;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AccountGroupAddComponent extends Component
{
    use AuthorizesRequests;

    public $seq_no;
    public $code;
    public $name;

    use WithFileUploads;
    public $file;

    public function importFile()
    {
        Excel::queueImport(new AccountGroupImport, $this->file);

        return redirect()->route('accountgroup.index')
            ->with('create-success', 'File Uploaded successfully.');
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'seq_no' => ['nullable', 'numeric'],
            'code'   => ['required', 'string'],
            'name'   => ['required', 'min:3','string','unique:account_groups'],
        ]);
    }

    public function store()
    {
        $this->confirmation();

        $this->validate([
            'seq_no' => ['nullable', 'numeric'],
            'code'   => ['required', 'string'],
            'name'   => ['required', 'min:3','string','unique:account_groups'],
        ]);

        $account         = new AccountGroup();
        $account->seq_no = $this->seq_no;
        $account->code   = $this->code;
        $account->name   = $this->name;
        $account->save();

        return redirect()->route('accountgroup.index')
            ->with('create-success', 'Account Group "' . $this->name . '" created successfully.');
    }

    public function confirmation()
    {
        // if (!auth()->user()->can('account-group-create')) {
        //     abort(404);
        // }

        $this->authorize('account-group-create');
    }

    public function render()
    {
        $this->confirmation();

        return view('livewire.account-group.account-group-add-component')->layout('layouts.base');
    }
}
