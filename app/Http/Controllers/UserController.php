<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create()
    {
        $userTypes = UserType::all();
        return view('users.create', compact('userTypes'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'username'     => 'required|unique:users,username',
            'password'     => 'required|min:6',
            'firstname'    => 'required',
            'lastname'     => 'required',
            'user_type_id' => 'required|exists:user_types,id',
        ]);

        User::create([
            'username'     => $request->username,
            'password'     => Hash::make($request->password),
            'firstname'    => $request->firstname,
            'lastname'     => $request->lastname,
            'email'        => $request->username.'@demo.test', // si necesitas email
            'user_type_id' => $request->user_type_id,
        ]);

        return redirect()->route('dashboard')->with('success', 'Usuario creado exitosamente.');
    }

    public function edit(User $user)
    {
        $tipos = UserType::all();
        return view('users.edit', compact('user','tipos'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'username'   => 'required|string|max:255|unique:users,username,'.$user->id,
            'password'   => 'nullable|string|min:6|confirmed',
            'firstname'  => 'required|string|max:255',
            'lastname'   => 'required|string|max:255',
            'user_type'  => 'required|exists:user_types,id',
        ]);

        $data = [
            'username'     => $validated['username'],
            'firstname'    => $validated['firstname'],
            'lastname'     => $validated['lastname'],
            'user_type_id' => $validated['user_type'],
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);
        return redirect()->route('dashboard')->with('success', 'Usuario actualizado correctamente.');
    }
public function destroy(User $user)
{
    if (Auth::id() === $user->id) {
        return redirect()->route('dashboard')
            ->with('error', 'No puedes eliminar tu propio usuario.');
    }

    $user->delete();

    return redirect()->route('dashboard')
        ->with('success', 'Usuario eliminado correctamente.');
}
}
