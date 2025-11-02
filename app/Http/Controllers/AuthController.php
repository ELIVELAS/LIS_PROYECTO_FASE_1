<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;   // <— IMPORTANTE
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required','email'],
            'password' => ['required','string'],
        ]);

        $remember = (bool) $request->boolean('remember');

        // Auth::attempt() devuelve true/false
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        // Si falla, devolvemos error de credenciales
        throw ValidationException::withMessages([
            'email' => __('Credenciales inválidas. Verifica tu correo y contraseña.'),
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();                      // <— método del Facade Auth
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success','Sesión cerrada correctamente.');
    }
}
