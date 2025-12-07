<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            // If the user is already authenticated, redirect to the dashboard
            return redirect()->route('be.dashboard')->with('info', 'Kamu sudah login!.');
        }
        return view('login');
    }

    public function login(Request $request)
    {
        // Validasi input dari pengguna
        $validate = $request->validate([
            'nip' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($validate)) {
            $request->session()->regenerate();
            return redirect()->route('be.dashboard')->with('success', 'Berhasil login!');
        }

        return back()->withErrors([
            'nip' => 'NIP atau Password Salah!',
        ])->onlyInput('nip');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('auth.index');
    }
}
