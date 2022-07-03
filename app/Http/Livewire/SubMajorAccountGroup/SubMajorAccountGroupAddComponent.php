<?php

namespace App\Http\Livewire\SubMajorAccountGroup;

use App\Models\SubMajorAccountGroup;
use Livewire\Component;
use App\Imports\SubMajorAccountGroupImport;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class SubMajorAccountGroupAddComponent extends Component
{
    public $seq_no;
    public $code;
    public $name;

    use WithFileUploads;
    public $file;

    public function importFile()
    {
        Excel::queueImport(new SubMajorAccountGroupImport, $this->file);

        return redirect()->route('submajoraccountgroup.index')
            ->with('create-success', 'File Uploaded successfully.');
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'seq_no' => ['nullable', 'numeric'],
            'code'   => ['required', 'string'],
            'name'   => ['required', 'min:3','string','unique:sub_major_account_groups'],
        ]);
    }

    public function store()
    {
        $this->confirmation();

        $this->validate([
            'seq_no' => ['nullable', 'numeric'],
            'code'   => ['required', 'string'],
            'name'   => ['required', 'min:3','string','unique:sub_major_account_groups'],
        ]);

        $account         = new SubMajorAccountGroup();
        $account->seq_no = $this->seq_no;
        $account->code   = $this->code;
        $account->name   = $this->name;
        $account->save();

        return redirect()->route('submajoraccountgroup.index')
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

        return view('livewire.sub-major-account-group.sub-major-account-group-add-component')->layout('layouts.base');
    }
}
