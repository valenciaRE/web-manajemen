@extends('layouts.app')
@section('page-title','Bukbes')

@section('content')


<!-- BREADCRUMB -->
<nav class="text-sm text-gray-600 dark:text-gray-300 mb-4 flex items-center gap-1">
    <a href="{{ route('home') }}" class="text-blue-600 hover:underline">Home</a>
    <span>/</span>
    <a href="{{ route('akuntan') }}" class="text-blue-600 hover:underline">Akuntansi</a>
    <span>/</span>
    <a href="{{ route('laporan') }}" class="text-blue-600 hover:underline">Laporan</a>
    <span>/</span>
    <span class="text-gray-500 dark:text-gray-400">Bukbes</span>
</nav>




<div class="space-y-6">

    <!-- FILTER -->
    <form method="GET" action="{{ route('bukbes') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
        <div>
            <label class="text-sm block mb-1">Tanggal Awal</label>
            <input name="start" type="date" value="{{ $start }}"
                class="w-full p-2 rounded border dark:bg-gray-700 dark:border-gray-600" required>
                 @error('start')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="text-sm block mb-1">Tanggal Akhir</label>
            <input name="end" type="date" value="{{ $end }}"
                class="w-full p-2 rounded border dark:bg-gray-700 dark:border-gray-600" required>
                 @error('end')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-2">
            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">
                Tampilkan
            </button>
            <a href="{{ route('bukbes.export', ['start' => $start, 'end' => $end]) }}"
                class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded">
                Export Excel
            </a>
        </div>
    </form>

    <!-- TABLE -->
    <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow-md">
        <h4 class="font-semibold mb-4">
            📘 Buku Besar | Tanggal Awal: {{ $start }} , Tanggal Akhir: {{ $end }}
        </h4>

        <div class="overflow-x-auto">
            <table class="w-full table-auto text-sm">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700">
                        <th class="p-3 border">Nomor Akun</th>
                        <th class="p-3 border">Nama Akun</th>
                        <th class="p-3 border">Saldo Awal</th>
                        <th class="p-3 border">Debit</th>
                        <th class="p-3 border">Kredit</th>
                        <th class="p-3 border">Saldo Akhir</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($bukbes as $b)
                       
                        <tr>
                            <td class="p-3 border">{{ $b->coa->coa_number }}</td>
                            <td class="p-3 border">{{ $b->coa->coa_name }}</td>
                            <td class="p-3 border text-right">{{ number_format($b->saldo_awal ?? 0, 0, ',', '.') }}</td>
                            <td class="p-3 border text-right">{{ number_format($b->debit ?? 0, 0, ',', '.') }}</td>
                            <td class="p-3 border text-right">{{ number_format($b->kredit ?? 0, 0, ',', '.') }}</td>
                            <td class="p-3 border text-right">{{ number_format($b->saldo_akhir ?? 0, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                           
                        </tr>
                    @endforelse
                </tbody>

                <tfoot>
                    <tr class="bg-gray-200 dark:bg-gray-700 font-bold">
                        <td colspan="2" class="p-3 border text-center">TOTAL</td>
                        <td class="p-3 border text-right">{{ number_format($total_saldo_awal, 0, ',', '.') }}</td>
                        <td class="p-3 border text-right">{{ number_format($total_debit, 0, ',', '.') }}</td>
                        <td class="p-3 border text-right">{{ number_format($total_kredit, 0, ',', '.') }}</td>
                        <td class="p-3 border text-right"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>


    <script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form[action*="bukbes"]');
    const startInput = document.querySelector('input[name="start"]');
    const endInput = document.querySelector('input[name="end"]');

    if (!form || !startInput || !endInput) return;

    form.addEventListener('submit', function (e) {
        const startDate = new Date(startInput.value);
        const endDate = new Date(endInput.value);

        if (startDate > endDate) {
            e.preventDefault();
            alert('⚠️ Tanggal Awal tidak boleh lebih besar dari Tanggal Akhir');
            startInput.focus();
        }
    });
});
</script>

@endsection