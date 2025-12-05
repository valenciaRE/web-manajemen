@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Buku Besar</h1>

<div class="bg-white p-6 rounded shadow">

    <div class="flex gap-4 mb-4">
        <div>
            <label>Tanggal Awal</label>
            <input type="date" class="border p-2 rounded">
        </div>

        <div>
            <label>Tanggal Akhir</label>
            <input type="date" class="border p-2 rounded">
        </div>

        <button class="bg-indigo-600 text-white px-4 py-2 rounded">Tampilkan</button>
    </div>

    <table class="w-full border-collapse">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">Akun</th>
                <th class="p-2 border">Saldo Awal</th>
                <th class="p-2 border">Debit</th>
                <th class="p-2 border">Kredit</th>
                <th class="p-2 border">Saldo</th>
            </tr>
        </thead>
        <tbody>
            <tr class="border">
                <td class="p-2">1.1.01 - Kas</td>
                <td class="p-2 text-right">0</td>
                <td class="p-2 text-right">0</td>
                <td class="p-2 text-right">0</td>
                <td class="p-2 text-right">0</td>
            </tr>
        </tbody>
    </table>

</div>
@endsection