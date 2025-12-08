<?php

namespace App\Http\Controllers\Be;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil Data Statistik (tetap sama)
        $totalUsers = User::count();
        $totalAdmins = User::whereIn('role', ['admin', 'superadmin'])->count();
        $totalSkpd = User::where('role', 'user_skpd')->count();

        // 2. Persiapan untuk Cek Status API SIMPEG
        $simpegStatus = 'DOWN';
        $simpegStatusClass = 'bg-red-500';
        $simpegMessage = 'Tidak Terhubung ke API SIMPEG.';

        // Ambil token dari file .env (SIMPEG_API_TOKEN=xxxx)
        $simpegApiToken = '21|n2RSJVJSdcyok4lRpsUTco2zrYk27PCFUqT9h2yF';
        $simpegApiUrl = 'https://ws-simpeg.tasikmalayakab.go.id/api/nik/';

        try {
            // Lakukan request GET ke API SIMPEG
            $response = Http::timeout(5)
                ->withToken($simpegApiToken) // <-- Ini fungsi untuk menambahkan Bearer Token
                ->get($simpegApiUrl);

            // Cek status code HTTP
            if ($response->successful()) { // Status 200...299
                $simpegStatus = 'READY';
                $simpegStatusClass = 'bg-green-500';
                $simpegMessage = 'Koneksi API SIMPEG Aktif.';
            } elseif ($response->status() == 401 || $response->status() == 403) {
                $simpegMessage = 'Otentikasi Gagal. Token API tidak valid atau kedaluwarsa (' . $response->status() . ').';
            } else {
                // Status code non-2xx lainnya (misal 500 Server Error)
                $simpegMessage = 'Terhubung, tapi API SIMPEG mengembalikan status ' . $response->status() . '.';
            }
        } catch (\Exception $e) {
            // Gagal koneksi (timeout, network error, dll.)
            $simpegMessage = 'Gagal Koneksi: Cek URL atau Jaringan. Pesan: ' . $e->getMessage();
        }

        // 4. Ambil Data Aktivitas Login Terbaru
        $latestLogins = User::whereNotNull('last_login_at')
            ->where('role', '!=', 'superadmin')
            ->orderBy('last_login_at', 'desc')
            ->limit(10)
            ->get();

        return view('be.admin.pages.dashboard.index', [
            'totalUsers' => $totalUsers,
            'totalAdmins' => $totalAdmins,
            'totalSkpd' => $totalSkpd,
            'latestLogins' => $latestLogins,
            'simpegStatus' => $simpegStatus,
            'simpegStatusClass' => $simpegStatusClass,
            'simpegMessage' => $simpegMessage,
        ]);
    }

    public function spesimen()
    {
        return view('be.admin.pages.dashboard.spesimen');
    }

    public function verifikasiTtePublic()
    {
        return view('be.users.index');
    }
}
