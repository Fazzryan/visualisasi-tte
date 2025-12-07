<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Be\AkunController;
use App\Http\Controllers\Be\DashboardController;

Route::get('/', function () {
    return view('login');
});

Route::group(['as' => 'auth.', 'prefix' => '/'], function () {
    Route::get('/login', [AuthController::class, 'index'])->name('index');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

//--------------------------------------------------------------------------
//  Route Backend
//--------------------------------------------------------------------------
Route::group(['as' => 'be.', 'prefix' => '/dashboard', 'middleware' => 'cek_login'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/spesimen', [DashboardController::class, 'spesimen'])->name('spesimen');
    //--------------------------------------------------------------------------
    //  Route Akun
    //--------------------------------------------------------------------------
    Route::group(['as' => 'akun.', 'prefix' => '/akun'], function () {
        Route::get('/', [AkunController::class, 'index'])->name('index');
    });
});
