<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\BukbesController;
use App\Http\Controllers\LaporanController;


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


// LAPORAN
Route::get('/laporan', [ViewController::class, 'laporan'])
    ->name('laporan')
    ->middleware('auth');

// BUKU BESAR – gunakan Controller khusus


// BUKU BESAR — HALAMAN HASIL TAMPILKAN

// PENGATURAN
Route::get('/pengaturan', [ViewController::class, 'pengaturan'])
    ->name('pengaturan')
    ->middleware('auth');

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



Route::get('/home', function () {
    return view('home');
})->name('home');


Route::get('/akuntan', [ViewController::class, 'akuntan'])->name('akuntan');

Route::get('/laporan', [ViewController::class, 'laporan'])->name('laporan');

Route::get('/bukbes', [\App\Http\Controllers\BukbesController::class, 'index'])->name('bukbes');
Route::get('/bukbes/data', [\App\Http\Controllers\BukbesController::class, 'getData'])->name('bukbes.data');
Route::get('/bukbes/detail', [BukbesController::class, 'detail'])->name('bukbes.detail');
Route::get('/bukbes/export', [BukbesController::class, 'export'])->name('bukbes.export');

