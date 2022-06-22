<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Laravel\Fortify\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ChangePasswordComponent extends Component
{
    public $current_password;
    public $password;
    public $password_confirmation;

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'current_password' => ['required'],
            'password'         => ['required','string', new Password,'confirmed','different:current_password'],
        ]);
    }

    public function changePassword()
    {
        $this->confirmation();

        $this->validate([
            'current_password' => ['required'],
            'password'         => ['required','string', new Password,'confirmed','different:current_password'],
        ]);

        if(Hash::check($this->current_password,Auth::user()->password))
        {
            $user = User::findorFail(Auth::user()->id);
            $user->password = Hash::make($this->password);
            $user->save();
            Session()->flash('password_success','Password has been changed successfully! Please Refresh and Login to continue editing!');
        }
        else
        {
            Session()->flash('password_error','Password does not match!');
        }


    }

    public function confirmation()
    {
        if(!Auth::check())
        {
            Abort(403);
        }
    }

    public function render()
    {
        $this->confirmation();

        return view('livewire.change-password-component')->layout('layouts.base');
    }
}
