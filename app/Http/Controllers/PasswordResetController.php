<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PasswordResetController extends Controller
{
    // Simulación de restablecimiento para entorno de desarrollo
    public function requestForm(){ return view('auth.passwords.email'); }

    public function sendToken(Request $request)
    {
        $request->validate(['email'=>'required|email']);
        $token = Str::random(32);
        DB::table('password_resets')->updateOrInsert(
            ['email'=>$request->email],
            ['token'=>$token, 'created_at'=>now()]
        );
        // En un entorno real se enviaría por correo; en desarrollo lo muestro en pantalla
        return back()->with('token',$token)->with('ok','Token generado (en producción se enviaría por correo).');
    }

    public function resetForm($token)
    {
        return view('auth.passwords.reset', compact('token'));
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:6|confirmed',
            'token'=>'required'
        ]);

        $row = DB::table('password_resets')->where('email',$request->email)->first();
        if (!$row || $row->token !== $request->token){
            return back()->withErrors(['email'=>'Token inválido.']);
        }

        $user = User::where('email',$request->email)->firstOrFail();
        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_resets')->where('email',$request->email)->delete();
        return redirect()->route('login')->with('ok','Contraseña actualizada, ya podés iniciar sesión.');
    }
}
