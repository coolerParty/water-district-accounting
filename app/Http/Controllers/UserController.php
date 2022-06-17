<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Rules\Password;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('user-show');

        $users = User::all();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $this->authorize('user-create');
        if (auth()->user()->can('Super Admin')) {
            $roles = Role::get();
        } else {
            $roles = Role::whereNotIn('name', ['Super Admin'])->get();
        }

        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->authorize('user-create');

        $this->validate($request, [
            'password' => ['required', 'min:8', 'string', new Password, 'confirmed'],
            'email'    => ['required', 'email', 'unique:users'],
            'name'     => ['required', 'min:3'],
            'role'     => ['required'],
        ]);

        $roles = Role::whereIn('name', ['Super Admin'])->pluck('id')->all();

        foreach ($request->role as $p) {
            if (in_array($p, $roles)  && !auth()->user()->can('Super Admin')) {
                abort(403);
            }
        }

        $user = User::create([
            'password' => Hash::make($request->input('password')),
            'email'    => $request->input('email'),
            'name'     => $request->input('name'),
        ]);

        foreach ($request->role as $p) {
            $user->assignRole($p);
        }

        return redirect()->route('users.index')
            ->with('create-success', 'User "' . $request->input('name') . '" created successfully.');
    }

    public function edit($id)
    {
        $this->authorize('user-edit');

        $user = User::find($id);
        if (auth()->user()->can('Super Admin')) {
            $roles = Role::get();
        } else {
            $roles = Role::whereNotIn('name', ['Super Admin'])->get();
        }

        $userRoles = DB::table('model_has_roles')
            ->where('model_has_roles.model_id', $id)
            ->pluck('model_has_roles.role_id')
            ->all();

        return view('users.edit', compact('user', 'roles', 'userRoles'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('user-edit');

        $this->validate($request, [
            'name' => 'required',
            'role' => 'required',
        ]);

        $roles = Role::whereIn('name', ['Super Admin'])->pluck('id')->all();

        foreach ($request->role as $p) {
            if (in_array($p, $roles)  && !auth()->user()->can('Super Admin')) {
                abort(403);
            }
        }

        $user = User::find($id);
        $user->name = $request->input('name');
        $user->save();

        $user->syncRoles($request->input('role'));

        return redirect()->route('users.index')
            ->with('update-success', 'User "' . $request->input('name') . '" updated successfully.');
    }

    public function destroy($id)
    {
        $this->authorize('user-delete');

        User::find($id)->delete();

        return redirect()->route('users.index')
            ->with('delete-success', 'User deleted successfully');
    }
}
