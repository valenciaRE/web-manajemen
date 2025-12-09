<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ViewController;


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

// BUKU BESAR
Route::get('/buku-besar', [ViewController::class, 'bukubesar'])
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


Route::get('/buku-kecil', [ViewController::class, 'bukukecil'])->middleware('auth');
Route::get('/kas', [ViewController::class, 'kas'])->middleware('auth');
Route::get('/neraca', [ViewController::class, 'neraca'])->middleware('auth'); 

Route::get('/home', function () {
    return view('home');
})->name('home');


Route::get('/akuntan', [ViewController::class, 'akuntan'])->name('akuntan');

Route::get('/laporan', [ViewController::class, 'laporan'])->name('laporan');

Route::get('/buku-besar', [ViewController::class, 'bukubesar'])->name('buku-besar');