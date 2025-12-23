<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coa extends Model
{
    protected $table = 'coa';
    
    protected $primaryKey = 'id_coa';
    
    protected $fillable = [
        'coa_number',
        'coa_name',
        'normal_balance',
    ];

    public function bukbes()
{
    return $this->hasMany(Bukbes::class, 'id_coa');
}


    
}