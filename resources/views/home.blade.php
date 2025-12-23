@extends('layouts.app')

@section('page-title', 'Home')
@section('page-subtitle', 'Selamat datang di Sistem Akuntansi')

@section('content')

<!-- HERO SECTION -->
<div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-2xl p-10 shadow-xl mb-12 relative overflow-hidden">

    <!-- Ilustrasi SVG -->
    <img src="https://undraw.co/api/illustrations/random?color=ffffff"
         class="absolute right-6 bottom-0 w-64 opacity-30 md:opacity-70 animate-pulse"
         alt="illustration">

    <div class="relative z-10">
        <h1 class="text-4xl font-bold mb-3 animate-fade-in">
            Sistem Akuntansi Modern & Efisien
        </h1>

        <p class="text-indigo-100 text-lg max-w-xl animate-fade-in-up">
            Kelola keuangan, catat transaksi, buat laporan, dan pantau arus kas dengan cepat
            melalui platform akuntansi yang ringan dan user-friendly.
        </p>

        <div class="mt-6 flex gap-4 animate-fade-in-up">
            <a href="/akuntan"
               class="bg-white text-indigo-700 px-5 py-3 rounded-lg font-semibold shadow hover:scale-105 transition">
                Masuk Halaman Akuntan →
            </a>

            <a href="/bukbes"
               class="border border-white text-white px-5 py-3 rounded-lg hover:bg-white hover:text-indigo-700 transition">
                Lihat Bukbes
            </a>
        </div>
    </div>
</div>

<!-- FITUR SECTION -->
<h2 class="text-2xl font-bold mb-6">Fitur Unggulan</h2>

<div class="grid grid-cols-1 md:grid-cols-3 gap-8">

    <!-- Card 1 -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow hover:shadow-xl transition hover:-translate-y-1">
        <div class="flex items-center mb-4">
            <div class="bg-indigo-100 text-indigo-600 p-3 rounded-xl">
                📘
            </div>
            <h3 class="ml-4 text-lg font-semibold">Bukbes</h3>
        </div>
        <p class="text-gray-600 dark:text-gray-300 mb-4">
            Kelola transaksi keuangan secara detail dan profesional.
        </p>
        <a href="/buku-besar" class="text-indigo-600 hover:underline">Lihat Bukbes →</a>
    </div>

    <!-- Card 2 -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow hover:shadow-xl transition hover:-translate-y-1">
        <div class="flex items-center mb-4">
            <div class="bg-purple-100 text-purple-600 p-3 rounded-xl">
                📊
            </div>
            <h3 class="ml-4 text-lg font-semibold">Laporan Keuangan</h3>
        </div>
        <p class="text-gray-600 dark:text-gray-300 mb-4">
            Buat laporan otomatis: laba rugi, neraca, arus kas, dan lainnya.
        </p>
        <a href="/laporan" class="text-indigo-600 hover:underline">Lihat Laporan →</a>
    </div>

    <!-- Card 3 -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow hover:shadow-xl transition hover:-translate-y-1">
        <div class="flex items-center mb-4">
            <div class="bg-pink-100 text-pink-600 p-3 rounded-xl">
                ⚙️
            </div>
            <h3 class="ml-4 text-lg font-semibold">Pengaturan Sistem</h3>
        </div>
        <p class="text-gray-600 dark:text-gray-300 mb-4">
            Kontrol penuh untuk preferensi dan konfigurasi aplikasi.
        </p>
        <a href="/pengaturan" class="text-indigo-600 hover:underline">Pengaturan →</a>
    </div>

</div>

<!-- ANIMATION CSS -->
<style>
    .animate-fade-in {
        animation: fadeIn 0.8s ease forwards;
    }
    .animate-fade-in-up {
        opacity: 0;
        transform: translateY(10px);
        animation: fadeUp 0.8s ease forwards;
        animation-delay: .2s;
    }

    @keyframes fadeIn {
        from { opacity: 0 }
        to { opacity: 1 }
    }
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px) }
        to { opacity: 1; transform: translateY(0) }
    }
</style>

@endsection