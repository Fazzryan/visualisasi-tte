<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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

        if (Auth::attempt(['nip' => $validate['nip'], 'password' => $validate['password']])) {

            $request->session()->regenerate();
            $user = Auth::user();

            // LOGIKA TAMBAHAN: UPDATE LAST LOGIN
            $user->update([
                'last_login_at' => Carbon::now(), // <-- Kolom diisi dengan waktu saat ini
            ]);

            $welcomeName = Str::title($user->name);
            if ($user->role === 'user_skpd') {
                // User SKPD hanya melihat Spesimen TTE
                return redirect()->route('be.spesimen')->with('success', 'Berhasil login! Selamat datang, ' . $welcomeName . '.');
            }

            // Role 'superadmin' atau 'admin' diarahkan ke Dashboard
            elseif (in_array($user->role, ['superadmin', 'admin'])) {
                return redirect()->route('be.dashboard')->with('success', 'Berhasil login! Selamat datang, ' . $welcomeName . '.');
            }

            // Fallback jika role tidak terdefinisi
            return redirect('/')->with('error', 'Role pengguna tidak valid.');
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
