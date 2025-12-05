@extends('layouts.app')

@section('content')
<h2>Selamat Datang di Sistem Akuntansi</h2>
<p>Silakan pilih menu di sidebar untuk mengakses fitur.</p>

<div class="card mt-3">
    <div class="card-body">
        <h4>Menu Cepat</h4>
        <a href="{{ route('buku-besar') }}" class="btn btn-primary mt-2">📘 Masuk ke Buku Besar</a>
    </div>
</div>
@endsection