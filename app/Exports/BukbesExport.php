<?php

namespace App\Exports;

use App\Models\Bukbes;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class BukbesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithColumnFormatting
{
    protected $start, $end;

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end   = $end;
    }

    public function collection()
    {
        // Ambil semua data transaksi dalam periode
        $data = Bukbes::with('coa')
            ->whereBetween('tanggal', [$this->start, $this->end])
            ->orderBy('id_coa')
            ->orderBy('tanggal')
            ->get();
        
        // Group by COA
        $grouped = $data->groupBy('id_coa');
        
        $rows = collect();
        
        $total_saldo_awal_grand = 0;
        $total_debit_grand = 0;
        $total_kredit_grand = 0;
        $total_saldo_akhir_grand = 0;
        
        foreach ($grouped as $coa_id => $items) {
            if (!$items->first()->coa) continue;
            
            // Ambil saldo awal (dari hari sebelum tanggal awal)
            $saldoAwal = Bukbes::where('id_coa', $coa_id)
                ->where('tanggal', '<', $this->start)
                ->orderBy('tanggal', 'desc')
                ->value('saldo_akhir') ?? 0;
            
            $total_debit_coa = 0;
            $total_kredit_coa = 0;
            
            foreach ($items as $item) {
                $total_debit_coa += $item->debit ?? 0;
                $total_kredit_coa += $item->kredit ?? 0;
            }
            
            $saldoAkhir = $saldoAwal + $total_debit_coa - $total_kredit_coa;
            
            $rows->push([
                'coa_number' => $items->first()->coa->coa_number,
                'coa_name' => $items->first()->coa->coa_name,
                'saldo_awal' => $saldoAwal,
                'debit' => $total_debit_coa,
                'kredit' => $total_kredit_coa,
                'saldo_akhir' => $saldoAkhir
            ]);
            
            $total_saldo_awal_grand += $saldoAwal;
            $total_debit_grand += $total_debit_coa;
            $total_kredit_grand += $total_kredit_coa;
            $total_saldo_akhir_grand += $saldoAkhir;
        }
        
        // Tambah baris TOTAL
        $rows->push([
            'coa_number' => 'TOTAL',
            'coa_name' => '',
            'saldo_awal' => $total_saldo_awal_grand,
            'debit' => $total_debit_grand,
            'kredit' => $total_kredit_grand,
            'saldo_akhir' => $total_saldo_akhir_grand
        ]);
        
        return $rows;
    }

    public function headings(): array
    {
        return [
            'Nomor Akun',
            'Nama Akun',
            'Saldo Awal',
            'Debit',
            'Kredit',
            'Saldo Akhir'
        ];
    }
    
    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'D' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'E' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'F' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
        ];
    }
}