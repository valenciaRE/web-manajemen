@extends('layouts.app')

@section('content')

<h3>📘 Buku Besar</h3>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li class="breadcrumb-item">
    </li>
    <a href="home"> /Home</a>
    <a href="akuntansi"> /Akuntan</a>
    <a href="laporan"> /Laporan</a>
</ol>

</nav>

<div class="card p-3">

    <div class="row g-2 align-items-end">
        <div class="col-md-3">
            <label>Tanggal Awal</label>
            <input type="date" class="form-control">
        </div>

        <div class="col-md-3">
            <label>Tanggal Akhir</label>
            <input type="date" class="form-control">
        </div>

        <div class="col-md-6 d-flex gap-2 mt-3 mt-md-0">
            <button class="btn btn-primary">Tampilkan</button>
            <button class="btn btn-success">Export Excel</button>
            <button class="btn btn-warning">Detail Buku Besar</button>
        </div>
    </div>

</div>

<div class="card mt-4">
    <div class="card-body">

        <h5>Buku Besar | Tanggal Awal : -, Tanggal Akhir : -</h5>

        <table class="table table-bordered mt-3">
            <thead class="table-light">
                <tr>
                    <th>Akun</th>
                    <th>Saldo Awal</th>
                    <th>Debit</th>
                    <th>Kredit</th>
                    <th>Saldo Akhir</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1.0.00 - Aset</td>
                    <td>0,00</td><td>0,00</td><td>0,00</td><td>0,00</td>
                </tr>
                <tr>
                    <td>1.1.01 - Kas Besar</td>
                    <td>17.666.589.600,00</td>
                    <td>0,00</td>
                    <td>0,00</td>
                    <td>17.666.589.600,00</td>
                </tr>
                <tr>
                    <td>1.1.01.02 - Kas Kecil</td>
                    <td>-34.750,00</td>
                    <td>0,00</td>
                    <td>0,00</td>
                    <td>(34.750,00)</td>
                </tr>
            </tbody>
        </table>

    </div>
</div>

@endsection

