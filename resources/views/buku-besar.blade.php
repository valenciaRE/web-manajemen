@extends('layouts.app')

@section('content')
<div class="container">
    <h5>Buku Besar | Tanggal Awal : {{ $tanggal_awal }}, Tanggal Akhir : {{ $tanggal_akhir }}</h5>

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
            @foreach($data as $row)
            <tr>
                <td>{{ $row['akun'] }}</td>
                <td>{{ number_format($row['saldo_awal'], 2, ',', '.') }}</td>
                <td>{{ number_format($row['debit'], 2, ',', '.') }}</td>
                <td>{{ number_format($row['kredit'], 2, ',', '.') }}</td>
                <td>{{ number_format($row['saldo_akhir'], 2, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
