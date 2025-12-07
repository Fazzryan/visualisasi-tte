<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user TIDAK sedang login
        if (!Auth::check()) {
            // Jika belum login:
            // 1. Simpan URL tujuan (intended URL) agar setelah login bisa langsung diarahkan
            session()->put('url.intended', $request->url());
            // 2. Redirect ke halaman login dengan pesan error (optional)
            return redirect()->route('auth.login')->with('failed', 'Anda harus login untuk mengakses halaman ini.');
        }

        // Jika user sudah login, lanjutkan request
        return $next($request);
    }
}
