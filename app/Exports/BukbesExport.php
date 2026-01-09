<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BukbesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Bukbes::select(
            'id',
            'tanggal',
            'id_coa',
            'saldo_awal',
            'debit',
            'kredit',
            'saldo_akhir',
            'deleted',
            'created_at',
            'updated_at'
        )->get();
    }
}