@extends('layouts.app')
@section('page-title','Buku Besar')

@section('content')

<!-- ========================= BREADCRUMB ========================= -->
<nav class="text-sm text-gray-600 dark:text-gray-300 mb-4 flex items-center gap-1">
    <a href="{{ route('home') }}" class="text-blue-600 hover:underline">Home</a>
    <span>/</span>
    <a href="{{ route('akuntan') }}" class="text-blue-600 hover:underline">Akuntansi</a>
    <span>/</span>
    <a href="{{ route('laporan') }}" class="text-blue-600 hover:underline">Laporan</a>
    <span>/</span>
    <span class="text-gray-500 dark:text-gray-400">Buku Besar</span>
</nav>

<div class="space-y-6">

    <!-- ========================= FILTER ========================= -->
    <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow-md">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            <div>
                <label class="text-sm block mb-1">Pilih Akun (COA)</label>
                <select id="id_coa" class="w-full p-2 rounded border dark:bg-gray-700 dark:border-gray-600">
                    <option value="">-- Pilih Akun --</option>
                    @foreach($coa as $c)
                    <option value="{{ $c->id_coa }}"
                         {{ isset($id_coa) && $id_coa == $c->id_coa ? 'selected' : '' }}>
                         {{ $c->coa_number }} - {{ $c->coa_name }}
                    </option>
                        <option value="{{ $c->id_coa }}">{{ $c->coa_number }} - {{ $c->coa_name }}</option>
                    @endforeach
                </select>
            </div>

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
                <button id="btnFilter" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">Tampilkan</button>
                <button id="btnExport" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded">Export Excel</button>
                <button id="btnDetail" class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded">Detail</button>
            </div>
        </div>
    </div>

    <!-- ========================= TABLE ========================= -->
    <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow-md">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-3 gap-3">
            <div>
                <h4 class="font-semibold">Buku Besar | Tanggal Awal: - , Tanggal Akhir: -</h4>
                <p class="text-sm text-gray-500 dark:text-gray-400">Klik nama akun untuk lihat detail transaksi.</p>
            </div>
            <div class="flex items-center gap-3">
                <input id="search" type="text" placeholder="Cari akun..." class="px-3 py-2 rounded border dark:bg-gray-700 dark:border-gray-600">
                <select id="perPage" class="px-3 py-2 rounded border dark:bg-gray-700 dark:border-gray-600">
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
                        <th class="p-3 border">Nomor Akun</th>
                        <th class="p-3 border">Saldo Awal</th>
                        <th class="p-3 border">Debit</th>
                        <th class="p-3 border">Kredit</th>
                        <th class="p-3 border">Saldo Akhir</th>
                    </tr>
                </thead>

                <tbody id="tbody" class="divide-y"></tbody>

                <tfoot>
                    <tr class="bg-gray-200 dark:bg-gray-700 font-semibold">
                        <td class="p-3 border text-right">Total</td>
                        <td class="p-3 border"></td>
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

<!-- ========================= SCRIPT ========================= -->
<script>
    const fromInput = document.getElementById("from");
    const toInput = document.getElementById("to");
    const idCoa = document.getElementById("id_coa");
    const searchInput = document.getElementById("search");
    const perPageSelect = document.getElementById("perPage");
    const tbody = document.getElementById("tbody");

    let currentPage = 1;
    let dataCache = [];

    function number(x) { return x == null ? 0 : Number(x).toLocaleString(); }

    function loadData() {
        const from = fromInput.value;
        const to = toInput.value;
        const search = searchInput.value.toLowerCase();
        const perPage = parseInt(perPageSelect.value);

        fetch(`{{ route('bukbes.data') }}?from=${from}&to=${to}&id_coa=${idCoa.value}`)
            .then(res => res.json())
            .then(data => {
                dataCache = data.filter(row => row.akun.toLowerCase().includes(search));
                currentPage = 1;
                renderTable(perPage);
            });
    }

    function renderTable(perPage) {
        tbody.innerHTML = "";
        const start = (currentPage - 1) * perPage;
        const end = start + perPage;
        const pageData = dataCache.slice(start, end);

        let totalSaldoAwal = 0, totalDebit = 0, totalKredit = 0, totalSaldoAkhir = 0;

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
                    <td class="p-3 border">${row.nomor_akun}</td>
                    <td class="p-3 border">${number(saldoAwal)}</td>
                    <td class="p-3 border">${number(debit)}</td>
                    <td class="p-3 border">${number(kredit)}</td>
                    <td class="p-3 border">${number(saldoAkhir)}</td>
                </tr>`;
        });

        document.getElementById("totalSaldoAwal").innerText = number(totalSaldoAwal);
        document.getElementById("totalDebit").innerText = number(totalDebit);
        document.getElementById("totalKredit").innerText = number(totalKredit);
        document.getElementById("totalSaldoAkhir").innerText = number(totalSaldoAkhir);

        document.getElementById("pagerInfo").innerText =
            `Halaman ${currentPage} dari ${Math.ceil(dataCache.length / perPage)}`;
    }

    document.getElementById("btnFilter").addEventListener("click", loadData);
    document.getElementById("search").addEventListener("input", loadData);
    perPageSelect.addEventListener("change", loadData);

    document.getElementById("prevBtn").addEventListener("click", () => {
        if (currentPage > 1) { currentPage--; renderTable(parseInt(perPageSelect.value)); }
    });

    document.getElementById("nextBtn").addEventListener("click", () => {
        if (currentPage < Math.ceil(dataCache.length / parseInt(perPageSelect.value))) {
            currentPage++; renderTable(parseInt(perPageSelect.value));
        }
    });

    document.getElementById("btnExport").addEventListener("click", () => {
        window.location.href = "{{ route('bukbes.export') }}";
    });

    document.getElementById("btnDetail").addEventListener("click", () => {
        const id = idCoa.value;
        if (!id) return alert('Pilih akun terlebih dahulu!');
        window.location.href = `/bukbes/detail/${id}`;
    });

    loadData();
</script>

@endsection
