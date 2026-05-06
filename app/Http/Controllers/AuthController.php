<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (auth()->attempt($credentials)) {

        if (auth()->user()->role == 'admin') {
            return redirect('/admin');
        }

        return redirect('/karyawan');
    }

    return back()->with('error', 'Email atau password salah');
}
}
