<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bukbes;
use App\Models\Coa;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BukbesExport;

class BukbesController extends Controller
{
    // =================== WAJIB LOGIN ===================
    public function __construct()
    {
        $this->middleware('auth');
    }

    // =================== INDEX ===================
    public function index(Request $request)
    {
        
        $start = $request->input('start');
        $end   = $request->input('end');

        // =================== VALIDASI TANGGAL ===================
        if ($start && $end && $start > $end) {
            return back()
                ->withErrors(['end' => 'Tanggal akhir tidak boleh lebih kecil dari tanggal awal'])
                ->withInput();
        }

        // =================== DEFAULT ===================
        $bukbes = collect();
        $total_debit  = 0;
        $total_kredit = 0;

        // =================== JIKA FILTER DIISI ===================
        if ($start && $end) {

            // 🔹 Ambil transaksi sesuai tanggal
            $coas = Coa::orderBy('coa_number')->get();

$bukbes = collect();

foreach ($coas as $coa) {

      // ===== SALDO AWAL (HISTORI SEBELUM TANGGAL) =====
            $debitSebelum = Bukbes::where('id_coa', $coa->id_coa)
                ->where('tanggal', '<', $start)
                ->sum('debit');

            $kreditSebelum = Bukbes::where('id_coa', $coa->id_coa)
                ->where('tanggal', '<', $start)
                ->sum('kredit');

            if ($coa->normal_balance === 'kredit') {
                $saldoAwal = $kreditSebelum - $debitSebelum;
            } else {
                $saldoAwal = $debitSebelum - $kreditSebelum;
            }

    // 🔹 Ambil transaksi COA ini dalam periode
    $items = Bukbes::where('id_coa', $coa->id_coa)
        ->whereBetween('tanggal', [$start, $end])
        ->get();

    // 🔹 Saldo awal (sebelum periode)
    $saldoAwal = Bukbes::where('id_coa', $coa->id_coa)
        ->where('tanggal', '<', $start)
        ->orderBy('tanggal', 'desc')
        ->value('saldo_akhir') ?? 0;

    $debitAkun  = $items->sum('debit');
    $kreditAkun = $items->sum('kredit');

    // 🔹 Normal balance
    $normalBalance = $coa->normal_balance ?? 'debit';

    if ($normalBalance === 'debit') {
        $saldoAkhir = $saldoAwal + $debitAkun - $kreditAkun;
    } else {
        $saldoAkhir = $saldoAwal - $debitAkun + $kreditAkun;
    }

    // 🔹 PUSH SEMUA COA (meski transaksi 0)
    $bukbes->push((object)[
        'coa'         => $coa,
        'saldo_awal'  => $saldoAwal,
        'debit'       => $debitAkun,
        'kredit'      => $kreditAkun,
        'saldo_akhir' => $saldoAkhir,
    ]);
}


            // =================== TOTAL GLOBAL (BENAR) ===================
            // TOTAL harus dari TRANSAKSI, bukan dari saldo akhir
            $total_debit  = $bukbes->sum('debit');
            $total_kredit = $bukbes->sum('kredit');
        }

        // =================== RETURN VIEW ===================
        return view('bukbes', [
            'bukbes' => $bukbes,
            'coas'   => Coa::orderBy('coa_number')->get(),
            'start'  => $start,
            'end'    => $end,

            // TOTAL
            'total_saldo_awal'  => $bukbes->sum('saldo_awal'),
            'total_debit'       => $total_debit,
            'total_kredit'      => $total_kredit,

            // ❗ SALDO AKHIR TOTAL TIDAK DIJUMLAHKAN
            // Ini sengaja dibuat selisih debit & kredit
            'total_saldo_akhir' => $total_debit - $total_kredit,
        ]);
    }

    // =================== DETAIL ===================
    public function detail()
    {
        $bukbes = Bukbes::with('coa')
            ->orderBy('tanggal')
            ->get();

        return view('bukbes_detail', compact('bukbes'));
    }

    // =================== EXPORT EXCEL ===================
    public function exportExcel(Request $request)
    {
        $start = $request->input('start');
        $end   = $request->input('end');

        return Excel::download(
        new BukbesExport($request->start, $request->end, $request->id_coa),
        'bukubesar.xlsx'
        );
    }
}
