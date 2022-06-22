<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class ProfileComponent extends Component
{
    use WithFileUploads;
    public $user_id;
    public $name;
    public $email;
    public $image;
    public $newImage;

    public function mount()
    {

        $user = User::select('id', 'name', 'email', 'profile_photo_path')->where('id', Auth::user()->id)->first();
        $this->user_id = $user->id;
        $this->name    = $user->name;
        $this->email   = $user->email;
        $this->image   = $user->profile_photo_path;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'email'     => ['required', 'email', Rule::unique('users')->ignore(Auth::user()->id)],
            'name'      => ['required', 'min:3'],
        ]);

        if ($this->newImage) {
            $this->validateOnly($fields, [
                'newImage' => ['nullable', 'image', 'max:2048'],
            ]);
        }
    }

    public function update()
    {
        $this->confirmation();

        $this->validate([
            'email'     => ['required', 'email', Rule::unique('users')->ignore(Auth::user()->id)],
            'name'      => ['required', 'min:3'],
        ]);

        if ($this->newImage) {
            $this->validate([
                'newImage' => ['nullable', 'image', 'max:2048'],
            ]);
        }

        $user = User::find(Auth::user()->id);
        $user->name  = $this->name;
        $user->email = $this->email;

        if ($this->newImage) {
            if ($this->image) {
                unlink('storage/assets/profile/medium' . '/' . $user->profile_photo_path); // Deleting Image
                unlink('storage/assets/profile/small' . '/' . $user->profile_photo_path); // Deleting Image
            }
            $imagename = Carbon::now()->timestamp . '.' . $this->newImage->extension();

            $originalPath   = storage_path() . '/app/public/assets/profile/medium/';
            $thumbnailPath   = storage_path() . '/app/public/assets/profile/small/';
            $thumbnailImage = Image::make($this->newImage);
            $thumbnailImage->fit(500, 500);
            $thumbnailImage->save($originalPath . $imagename);
            $thumbnailImage->fit(100, 100);
            $thumbnailImage->save($thumbnailPath . $imagename);

            $user->profile_photo_path = $imagename;
        }

        $user->save();
        return redirect()->route('profile')->with('message', 'Profile has been updated successfully!');
    }

    public function removeImage()
    {
        $this->newImage = null;
    }

    public function confirmation()
    {
        if (!Auth::check()) {
            Abort(403);
        }
    }

    public function render()
    {
        $this->confirmation();

        return view('livewire.profile-component')->layout('layouts.base');
    }
}
