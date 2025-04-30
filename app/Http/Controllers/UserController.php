<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = \App\Models\Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
        ]);
        return to_route('users.index');
    }

    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = \App\Models\Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
        ]);
        return to_route('users.index');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return to_route('users.index');
    }
}
