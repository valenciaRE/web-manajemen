<?php

namespace App\Http\Controllers;

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
}

