<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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

        $nip = $validate['nip'];
        $password = $validate['password'];

        // 1. Cek ke database apakah nip dan password terdaftar secara lokal
        if (Auth::attempt(['nip' => $nip, 'password' => $password])) {
            return $this->handleSuccessLogin($request);
        }

        // 2. Jika gagal, cek ke API SIMPEG (hanya jika password menggunakan default 'TasikRancage2024')
        if ($password === 'TasikRancage2024') {
            try {
                $apiToken = '21|n2RSJVJSdcyok4lRpsUTco2zrYk27PCFUqT9h2yF';
                $simpegApiUrl = 'https://ws-simpeg.tasikmalayakab.go.id/api/nik/';
                
                $response = Http::timeout(20)
                    ->withToken($apiToken)
                    ->get($simpegApiUrl . $nip);

                if ($response->successful()) {
                    $responseData = $response->json();
                    
                    if (
                        isset($responseData['success']) && $responseData['success'] === true &&
                        isset($responseData['mapData']['data']) &&
                        !empty($responseData['mapData']['data'])
                    ) {
                        $pegawaiData = $responseData['mapData']['data'][0];
                        
                        // Buat atau Update user di database lokal
                        // Jika user sudah ada tapi password beda (sehingga Auth::attempt gagal), 
                        // maka password akan di-update ke password default ini.
                        $user = User::updateOrCreate(
                            ['nip' => $nip],
                            [
                                'name' => $pegawaiData['nama_lengkap'] ?? 'User SIMPEG',
                                'email' => $nip . '@tasikmalayakab.go.id', // Fallback email jika di API tidak ada
                                'password' => Hash::make('TasikRancage2024'),
                                'role' => 'user_skpd', // Default role untuk pegawai baru
                            ]
                        );

                        // Proses Login
                        Auth::login($user);
                        return $this->handleSuccessLogin($request);
                    }
                }
            } catch (\Exception $e) {
                // Log error jika diperlukan: \Log::error($e->getMessage());
            }
        }

        return back()->withErrors([
            'nip' => 'NIP tidak ditemukan atau Password salah!',
        ])->onlyInput('nip');
    }

    /**
     * Helper untuk menangani redirect dan update data setelah login sukses
     */
    private function handleSuccessLogin(Request $request)
    {
        $request->session()->regenerate();
        $user = Auth::user();

        // Update waktu login terakhir
        $user->update([
            'last_login_at' => Carbon::now(),
        ]);

        $welcomeName = Str::title($user->name);
        
        // Pengalihan berdasarkan role
        if ($user->role === 'user_skpd') {
            return redirect()->route('be.spesimen')->with('success', 'Berhasil login! Selamat datang, ' . $welcomeName . '.');
        } elseif (in_array($user->role, ['superadmin', 'admin'])) {
            return redirect()->route('be.dashboard')->with('success', 'Berhasil login! Selamat datang, ' . $welcomeName . '.');
        }

        return redirect('/')->with('error', 'Role pengguna tidak valid.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('auth.index');
    }
}
