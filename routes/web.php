<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\BukuBesarController;
use App\Http\Controllers\LaporanController;

// =====================
// HOME
// =====================
Route::get('/', function () {
    return view('welcome');
});

// =====================
// AUTH ROUTES
// =====================
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// REGISTER
Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// =====================
// DASHBOARD
// =====================
Route::get('/dashboard', [ViewController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

// =====================
// SIDEBAR PAGE ROUTES
// =====================

// BUKU BESAR – gunakan Controller khusus
Route::get('/buku-besar', [BukuBesarController::class, 'index'])
    ->name('buku-besar')
    ->middleware('auth');

// LAPORAN
Route::get('/laporan', [ViewController::class, 'laporan'])
    ->name('laporan')
    ->middleware('auth');

// PENGATURAN
Route::get('/pengaturan', [ViewController::class, 'pengaturan'])
    ->name('pengaturan')
    ->middleware('auth');

// =====================
// OPTIONAL OTHER PAGES
// =====================
Route::get('/buku-kecil', [ViewController::class, 'bukukecil'])->middleware('auth');
Route::get('/kas', [ViewController::class, 'kas'])->middleware('auth');
Route::get('/neraca', [ViewController::class, 'neraca'])->middleware('auth');

// =====================
// PASSWORD RESET
// =====================
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])
    ->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])
    ->name('password.update'); 

Route::get('/buku-besar', fn() => view('buku-besar'));
