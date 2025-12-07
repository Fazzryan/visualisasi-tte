<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Tambahkan alias middleware kustom Anda di sini
        $middleware->alias([
            'auth' => \App\Http\Middleware\Authenticate::class, // Sudah ada
            'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class, // Sudah ada

            // DAFTARKAN MIDDLEWARE KUSTOM ANDA DI SINI
            'cek_login' => \App\Http\Middleware\CekLogin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
