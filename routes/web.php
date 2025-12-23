<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\BukbesController;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED AREA
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [ViewController::class, 'index'])->name('dashboard');
    Route::get('/home', fn () => view('home'))->name('home');

    // MENU AKUNTANSI
    Route::get('/akuntan', [ViewController::class, 'akuntan'])->name('akuntan');
    Route::get('/laporan', [ViewController::class, 'laporan'])->name('laporan');

    // BUKU BESAR
    Route::get('/bukbes', [BukbesController::class, 'index'])->name('bukbes');
    Route::get('/bukbes/detail', [BukbesController::class, 'detail'])->name('bukbes.detail');
    Route::get('/bukbes/export', [BukbesController::class, 'exportExcel'])->name('bukbes.export');

    // LAINNYA
    Route::get('/buku-kecil', [ViewController::class, 'bukukecil']);
    Route::get('/kas', [ViewController::class, 'kas']);
    Route::get('/neraca', [ViewController::class, 'neraca']);
    Route::get('/pengaturan', [ViewController::class, 'pengaturan'])->name('pengaturan');
});

/*
|--------------------------------------------------------------------------
| PASSWORD RESET
|--------------------------------------------------------------------------
*/
Route::get('/forgot-password', fn () => view('auth.forgot-password'))
    ->name('password.request');

Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])
    ->name('password.email');

Route::get('/reset-password/{token}', fn ($token) =>
    view('auth.reset-password', ['token' => $token])
)->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])
    ->name('password.update');

