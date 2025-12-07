<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Gunakan View Composer untuk mengirim data inisial ke beberapa view
        View::composer(['be.admin.layouts.navbar', 'be.admin.layouts.sidebar'], function ($view) {

            // Inisialisasi inisial
            $initials = 'NA';

            // Cek apakah ada pengguna yang sedang login
            if (Auth::check()) {
                $fullName = Auth::user()->name ?? '';

                // Logika Penghitungan Inisial
                $words = explode(' ', trim($fullName));
                $initials = '';

                // Ambil huruf pertama dari kata pertama
                if (isset($words[0])) {
                    $initials .= strtoupper(substr($words[0], 0, 1));
                }

                // Ambil huruf pertama dari kata kedua (jika ada)
                if (isset($words[1])) {
                    $initials .= strtoupper(substr($words[1], 0, 1));
                }

                // Fallback: Jika inisial kurang dari dua huruf, ambil dua huruf pertama
                if (strlen($initials) < 2 && strlen($fullName) > 1) {
                    $initials = strtoupper(substr($fullName, 0, 2));
                } elseif (empty($initials)) {
                    $initials = 'AN'; // Jika nama benar-benar kosong, gunakan Anonim
                }
            }

            // Kirim variabel 'initials' ke view yang ditentukan
            $view->with('initials', $initials);
        });
    }
}
