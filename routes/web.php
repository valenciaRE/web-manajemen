<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\BukuBesarController;
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

<<<<<<< HEAD
// =====================
// SIDEBAR PAGE ROUTES
// =====================
=======
// LAPORAN
Route::get('/laporan', [ViewController::class, 'laporan'])
    ->name('laporan')
    ->middleware('auth');
>>>>>>> 33a1d641f93277cb5ef7ce9af31ebb3e309c47ac

// BUKU BESAR – gunakan Controller khusus
Route::get('/buku-besar', [BukuBesarController::class, 'index'])
    ->name('buku-besar')
    ->middleware('auth');

// BUKU BESAR — HALAMAN HASIL TAMPILKAN
Route::get('/buku-besar/tampilkan', [ViewController::class, 'filterBukuBesar'])
    ->name('buku-besar.tampilkan') // <- pastikan nama ini persis sama
    ->middleware('auth');

// PENGATURAN
Route::get('/pengaturan', [ViewController::class, 'pengaturan'])
    ->name('pengaturan')
    ->middleware('auth');

<<<<<<< HEAD
// =====================
// OPTIONAL OTHER PAGES
// =====================
=======

>>>>>>> 33a1d641f93277cb5ef7ce9af31ebb3e309c47ac
Route::get('/buku-kecil', [ViewController::class, 'bukukecil'])->middleware('auth');
Route::get('/kas', [ViewController::class, 'kas'])->middleware('auth');
Route::get('/neraca', [ViewController::class, 'neraca'])->middleware('auth');

<<<<<<< HEAD
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
=======
Route::get('/home', function () {
    return view('home');
})->name('home');


Route::get('/akuntan', [ViewController::class, 'akuntan'])->name('akuntan');

Route::get('/laporan', [ViewController::class, 'laporan'])->name('laporan');

Route::get('/buku-besar', [ViewController::class, 'bukubesar'])->name('buku-besar');
>>>>>>> 33a1d641f93277cb5ef7ce9af31ebb3e309c47ac
