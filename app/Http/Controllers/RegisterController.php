<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;

class RegisterController extends Controller
{
    public function clienteForm()
    {
        return view('auth.register_cliente');
    }

    public function empresaForm()
    {
        return view('auth.register_empresa');
    }

    public function clienteStore(Request $r)
    {
        $r->validate([
            'firstname' => 'required|string|max:255',
            'lastname'  => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|string|min:6|confirmed',
            'dui'       => ['required','regex:/^\d{8}-\d$/'],
            'birthdate' => 'required|date|before_or_equal:'.now()->subYears(18)->toDateString(),
        ],[
            'dui.regex' => 'El DUI debe tener el formato 00000000-0.',
        ]);

        User::create([
            'firstname'    => $r->firstname,
            'lastname'     => $r->lastname,
            'email'        => $r->email,
            'password'     => $r->password, // se hashea por $casts en User
            'user_type_id' => 3, // Cliente
        ]);

        return redirect()->route('login')->with('success','Registro de cliente exitoso. Ahora puedes iniciar sesión.');
    }

    public function empresaStore(Request $r)
    {
        $r->validate([
            'company_name'=> 'required|string|max:255',
            'nit'         => ['required','regex:/^(?:\d{4}-\d{6}-\d{3}-\d|\d{14})$/'],
            'address'     => 'required|string|max:255',
            'phone'       => 'required|string|max:25',
            'email'       => 'required|email|unique:users,email',
            'password'    => 'required|string|min:6|confirmed',
        ],[
            'nit.regex'   => 'El NIT debe ser 0000-000000-000-0 o 14 dígitos.',
        ]);

        $user = User::create([
            'firstname'    => $r->company_name,
            'lastname'     => 'Empresa',
            'email'        => $r->email,
            'password'     => $r->password,
            'user_type_id' => 2, // Empresa
        ]);

        Company::create([
            'user_id'    => $user->id,
            'name'       => $r->company_name,
            'nit'        => $r->nit,
            'address'    => $r->address,
            'phone'      => $r->phone,
            'approved'   => 0,
            'commission' => 0,
        ]);

        return redirect()->route('login')->with('success','Empresa registrada. Pendiente de aprobación del administrador.');
    }
}
