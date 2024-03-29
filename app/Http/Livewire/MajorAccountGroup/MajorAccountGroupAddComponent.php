<?php

namespace App\Http\Livewire\MajorAccountGroup;

use App\Models\MajorAccountGroup;
use Livewire\Component;
use App\Imports\MajorAccountGroupImport;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MajorAccountGroupAddComponent extends Component
{
    use AuthorizesRequests;

    public $seq_no;
    public $code;
    public $name;

    use WithFileUploads;
    public $file;

    public function importFile()
    {
        Excel::queueImport(new MajorAccountGroupImport, $this->file);

        return redirect()->route('majoraccountgroup.index')
            ->with('create-success', 'File Uploaded successfully.');
    }

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
        // if (!auth()->user()->can('account-group-create')) {
        //     abort(404);
        // }

        $this->authorize('account-group-create');
    }

    public function render()
    {
        $this->confirmation();

        return view('livewire.major-account-group.major-account-group-add-component')->layout('layouts.base');
    }
}
