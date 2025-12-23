<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoaTable extends Migration
{
    public function up()
    {
        Schema::create('coa', function (Blueprint $table) {
            $table->id('id_coa');
            $table->string('coa_name');
            $table->string('coa_number');   
            $table->string('posisi_awal')->nullable(); // Debit / Kredit
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('coa');
    }
}