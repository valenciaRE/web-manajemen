@extends('layouts.app')

@section('page-title','Buku Besar')
@section('page-subtitle','/ Home / Akuntansi / Laporan')

@section('content')
<div class="space-y-6">

    <!-- ========================= FILTER ========================= -->
    <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow-md">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
            <div>
                <label class="text-sm block mb-1">Tanggal Awal</label>
                <input id="from" type="date"
                       class="w-full p-2 rounded border dark:bg-gray-700 dark:border-gray-600">
            </div>
            <div>
                <label class="text-sm block mb-1">Tanggal Akhir</label>
                <input id="to" type="date"
                       class="w-full p-2 rounded border dark:bg-gray-700 dark:border-gray-600">
            </div>

            <div class="flex gap-2">
                <button id="btnFilter"
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">Tampilkan</button>

                <button id="btnExport"
                        class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded">Export Excel</button>

                <button id="btnDetail"
                        class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded">Detail</button>
            </div>
        </div>
    </div>

    <!-- ========================= TABLE ========================= -->
    <!-- (kode table tetap sama seperti milikmu) -->
    {{-- ==================== TABLE SECTION TIDAK DIUBAH ==================== --}}
    <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow-md">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-3 gap-3">
            <div>
                <h4 class="font-semibold">Buku Besar | Tanggal Awal: - , Tanggal Akhir: -</h4>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Klik nama akun untuk lihat detail transaksi.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <input id="search" type="text"
                       placeholder="Cari akun..."
                       class="px-3 py-2 rounded border dark:bg-gray-700 dark:border-gray-600">
                <select id="perPage"
                        class="px-3 py-2 rounded border dark:bg-gray-700 dark:border-gray-600">
                    <option value="5">5 / halaman</option>
                    <option value="10" selected>10 / halaman</option>
                    <option value="25">25 / halaman</option>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto scroll-shadow">
            <table id="ledgerTable" class="w-full table-auto text-sm">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700">
                        <th class="p-3 border">Akun</th>
                        <th class="p-3 border">Saldo Awal</th>
                        <th class="p-3 border">Debit</th>
                        <th class="p-3 border">Kredit</th>
                        <th class="p-3 border">Saldo Akhir</th>
                    </tr>
                </thead>
                <tbody id="tbody" class="divide-y"></tbody>
                <tfoot>
                    <tr class="bg-gray-200 dark:bg-gray-700 font-semibold">
                        <td class="p-3 border text-right">TOTAL</td>
                        <td class="p-3 border" id="totalSaldoAwal">0</td>
                        <td class="p-3 border" id="totalDebit">0</td>
                        <td class="p-3 border" id="totalKredit">0</td>
                        <td class="p-3 border" id="totalSaldoAkhir">0</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="flex items-center justify-between mt-4">
            <div class="text-sm text-gray-500" id="pagerInfo"></div>
            <div class="flex gap-2">
                <button id="prevBtn" class="px-3 py-1 bg-gray-200 dark:bg-gray-700 rounded">Prev</button>
                <button id="nextBtn" class="px-3 py-1 bg-gray-200 dark:bg-gray-700 rounded">Next</button>
            </div>
        </div>
    </div>
</div>


{{-- ========================= SCRIPT ========================= --}}
<script>

// ===================== FILTER BUTTON ========================
document.getElementById("btnFilter").addEventListener("click", function() {
    let tglAwal = document.getElementById("from").value;
    let tglAkhir = document.getElementById("to").value;

    if (!tglAwal || !tglAkhir) {
        alert("Tanggal awal dan akhir harus diisi!");
        return;
    }

    // Reload halaman sambil kirim parameter tanggal
    window.location.href = `?start=${tglAwal}&end=${tglAkhir}`;
});

document.getElementById("btnExport").addEventListener("click", function() {
    window.location.href = "{{ route('bukbes.export') }}";
});

document.getElementById("btnDetail").addEventListener("click", function() {
    window.location.href = "{{ route('bukbes.detail') }}";
});

// =============================================================
document.getElementById("btnFilter").addEventListener("click", loadData);
document.getElementById("search").addEventListener("input", loadData);
document.getElementById("perPage").addEventListener("change", loadData);

let currentPage = 1;
let dataCache = [];

function loadData() {
    const from = document.getElementById("from").value;
    const to = document.getElementById("to").value;
    const search = document.getElementById("search").value.toLowerCase();
    const perPage = parseInt(document.getElementById("perPage").value);

    fetch(`{{ route('bukbes.data') }}?from=${from}&to=${to}`)
        .then(res => res.json())
        .then(data => {
            dataCache = data.filter(row =>
                row.akun.toLowerCase().includes(search)
            );
            currentPage = 1;
            renderTable(perPage);
        });
}

function renderTable(perPage) {
    const tbody = document.getElementById("tbody");
    tbody.innerHTML = "";

    const start = (currentPage - 1) * perPage;
    const end = start + perPage;

    const pageData = dataCache.slice(start, end);

    // reset total
    let totalSaldoAwal = 0;
    let totalDebit = 0;
    let totalKredit = 0;
    let totalSaldoAkhir = 0;

    pageData.forEach(row => {
        const saldoAwal = Number(row.saldo_awal) ?? 0;
        const debit = Number(row.debit) ?? 0;
        const kredit = Number(row.kredit) ?? 0;
        const saldoAkhir = Number(row.saldo_akhir) ?? 0;

        totalSaldoAwal += saldoAwal;
        totalDebit += debit;
        totalKredit += kredit;
        totalSaldoAkhir += saldoAkhir;

        tbody.innerHTML += `
            <tr>
                <td class="p-3 border">${row.akun}</td>
                <td class="p-3 border">${number(saldoAwal)}</td>
                <td class="p-3 border">${number(debit)}</td>
                <td class="p-3 border">${number(kredit)}</td>
                <td class="p-3 border">${number(saldoAkhir)}</td>
            </tr>
        `;
    });

    document.getElementById("totalSaldoAwal").innerText = number(totalSaldoAwal);
    document.getElementById("totalDebit").innerText = number(totalDebit);
    document.getElementById("totalKredit").innerText = number(totalKredit);
    document.getElementById("totalSaldoAkhir").innerText = number(totalSaldoAkhir);

    document.getElementById("pagerInfo").innerText =
        `Halaman ${currentPage} dari ${Math.ceil(dataCache.length / perPage)}`;
}

document.getElementById("prevBtn").addEventListener("click", () => {
    if (currentPage > 1) {
        currentPage--;
        renderTable(parseInt(document.getElementById("perPage").value));
    }
});

document.getElementById("nextBtn").addEventListener("click", () => {
    const perPage = parseInt(document.getElementById("perPage").value);
    if (currentPage < Math.ceil(dataCache.length / perPage)) {
        currentPage++;
        renderTable(perPage);
    }
});

function number(x) {
    return x == null ? 0 : Number(x).toLocaleString();
}

loadData();

</script>
@endsection
