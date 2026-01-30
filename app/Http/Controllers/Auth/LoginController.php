<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{    
    public function showLoginForm() { return view('auth.login'); }
    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();

        // 👉 Redirection admin
        if (Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        // 👉 Redirection utilisateur normal
        return redirect()->intended('/');
    }

    return back()->withErrors([
        'email' => 'Identifiants incorrects.',
    ]);
}

}
