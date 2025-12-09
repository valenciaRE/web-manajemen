<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function index() {
        return view('dashboard');
    }

    public function bukuBesar() {
        return view('buku-besar');
    }

    public function bukuKecil() {
        return view('buku-kecil');
    }

    public function kas() {
        return view('kas');
    }

    public function neraca() {
        return view('neraca');
    }

    // =========================
    // Method untuk tombol Tampilkan
    // =========================
    public function filterBukuBesar(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;

        // Contoh data dummy, bisa diganti query database
        $data = [
            [
                'akun' => '1.0.00 - Aset',
                'saldo_awal' => 0,
                'debit' => 0,
                'kredit' => 0,
                'saldo_akhir' => 0
            ],
            [
                'akun' => '1.1.01 - Kas Besar',
                'saldo_awal' => 17666589600,
                'debit' => 0,
                'kredit' => 0,
                'saldo_akhir' => 17666589600
            ],
            [
                'akun' => '1.1.01.02 - Kas Kecil',
                'saldo_awal' => -34750,
                'debit' => 0,
                'kredit' => 0,
                'saldo_akhir' => -34750
            ]
        ];

        // Kirim data ke view tampilkan
        return view('buku-besar-tampil', compact(
            'tanggal_awal',
            'tanggal_akhir',
            'data'
        ));
    }
}
