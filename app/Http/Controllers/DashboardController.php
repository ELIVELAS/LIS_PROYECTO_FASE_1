<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Solo admin ve la lista completa
        $users = ($user->user_type_id === 1)
            ? User::with('userType')->orderBy('id')->get()
            : collect(); // colección vacía para no-admin

        return view('dashboard', compact('users'));
    }
}
