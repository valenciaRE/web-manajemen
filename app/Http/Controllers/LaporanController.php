<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function bukuBesar()
    {
        // Di sini Anda akan me-load data buku besar

        // Kemudian tampilkan view yang relevan
        return view('buku-besar'); // Ganti 'buku-besar' dengan nama view yang benar
    }
}