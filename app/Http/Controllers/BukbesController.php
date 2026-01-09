<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;  
use App\Exports\BukbesExport; // Pastikan sudah dibuat class export

class BukbesController extends Controller
{
    // =================== INDEX VIEW ===================
    public function index()
    {
        // Ambil semua COA untuk dropdown
        $coa = DB::table('coa')->orderBy('nama_akun')->get();

        return view('bukbes', compact('coa'));
    }

    // =================== GET DATA JSON ===================
    public function getData(Request $request)
    {
        $from = $request->from ?? '1900-01-01';
        $to = $request->to ?? '2999-12-31';
        $idCoa = $request->id_coa;

        $query = DB::table('jurnal')
            ->join('coa', 'jurnal.id_coa', '=', 'coa.id_coa')
            ->select(
                'jurnal.id_coa',
                'coa.nama_akun as akun',
                'coa.coa_number as nomor_akun',
                DB::raw("COALESCE(SUM(debit),0) as debit"),
                DB::raw("COALESCE(SUM(kredit),0) as kredit"),
                DB::raw("COALESCE(SUM(debit - kredit),0) as saldo_akhir"),
                DB::raw("0 as saldo_awal")
            )
            ->whereBetween('tanggal_transaksi', [$from, $to])
            ->groupBy('jurnal.id_coa', 'coa.nama_akun', 'coa.coa_number');

        if ($idCoa) {
            $query->where('jurnal.id_coa', $idCoa);
        }

        $data = $query->get();

        return response()->json($data);
    }

    // =================== DETAIL TRANSAKSI ===================
    public function detail($id_coa)
    {
        $data = DB::table('jurnal')
            ->join('coa', 'jurnal.id_coa', '=', 'coa.id_coa')
            ->select('jurnal.*', 'coa.nama_akun as akun', 'coa.coa_number as nomor_akun')
            ->where('jurnal.id_coa', $id_coa)
            ->orderBy('tanggal_transaksi', 'asc')
            ->get();

        return view('bukbes.detail', compact('data', 'id_coa'));
    }

    // =================== EXPORT EXCEL ===================
    public function exportExcel(Request $request)
    {
        $from = $request->from ?? '1900-01-01';
        $to = $request->to ?? '2999-12-31';
        $idCoa = $request->id_coa ?? null;

        return Excel::download(new BukbesExport($from, $to, $idCoa), 'bukubesar.xlsx');
    }
}
