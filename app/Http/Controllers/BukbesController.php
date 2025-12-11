<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;  
use App\Exports\BukbesExport;          

class BukbesController extends Controller
{
    public function index()
    {
        return view('bukbes');
    }

    public function getData(Request $request)
    {
        $from = $request->from ?? '1900-01-01';
        $to = $request->to ?? '2999-12-31';

        $data = DB::table('jurnal')
            ->join('coa', 'jurnal.id_coa', '=', 'coa.id_coa')
            ->select(
                'jurnal.id_coa',
                'coa.nama_akun as akun',
                DB::raw("COALESCE(SUM(debit),0) as debit"),
                DB::raw("COALESCE(SUM(kredit),0) as kredit"),
                DB::raw("COALESCE(SUM(debit - kredit),0) as saldo_akhir"),
                DB::raw("0 as saldo_awal")
            )
            ->whereBetween('tanggal_transaksi', [$from, $to])
            ->groupBy('jurnal.id_coa', 'coa.nama_akun')
            ->get();

        return response()->json($data);
    }

    public function detail($id_coa)
    {
        $data = DB::table('bukbes')
            ->where('id_coa', $id_coa)
            ->orderBy('tanggal_transaksi', 'asc')
            ->get();

        return view('bukbes.detail', compact('data', 'id_coa'));
    }


    public function export()
{
    $data = DB::table('bukbes')
        ->join('coa', 'bukbes.id_coa', '=', 'coa.id_coa')
        ->select(
            'bukbes.id_coa',
            'coa.nama_akun as akun',
            'bukbes.debit',
            'bukbes.kredit',
            'bukbes.tanggal'
        )
        ->orderBy('tanggal', 'asc')
        ->get();

    return Excel::download(new BukbesExport($data), 'bukbes.xlsx');
}
    
}
