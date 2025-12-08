<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // 1. Cek apakah user sedang login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // 2. Cek apakah role user ada di dalam daftar roles yang diizinkan
        if (in_array($user->role, $roles)) {
            // Role diizinkan, lanjutkan request
            return $next($request);
        }

        // 3. Jika Role TIDAK DISETUJUI, lemparkan ke rute utama user (Spesimen TTE)
        return redirect()->route('be.spesimen')->with('warning', 'Akses ditolak. Anda tidak memiliki izin untuk halaman ini.');
    }
}
