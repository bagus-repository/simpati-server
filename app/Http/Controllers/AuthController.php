<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login_form()
    {
        return view('auth.login');
    }

    public function do_login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'sts' => 1,
            'role' => 'admin'
        ])) {
            return redirect()->intended('/dashboard');
        }else {
            return redirect()->back()->with('error', 'Email dan password tidak cocok.');
        }
    }

    public function do_logout()
    {
        Auth::logout();
        return redirect()->route('auth.login_form')->with('success', 'Berhasil logout.');
    }
}
