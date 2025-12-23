<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bukbes extends Model
{
    protected $table = 'bukbes';

    protected $fillable = [
        'tanggal',
        'id_coa',
        'saldo_awal',
        'debit',
        'kredit',
        'saldo_akhir',
        'deleted'
    ];
    // Relasi ke COA (yang benar)
    public function coa()
    {
        return $this->belongsTo(Coa::class, 'id_coa', 'id_coa');
    }
}

