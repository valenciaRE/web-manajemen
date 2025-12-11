<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('bukbes', function (Blueprint $table) {
            $table->id(); // AUTO_INCREMENT
            $table->date('tanggal');
            $table->integer('id_coa');
            $table->bigInteger('saldo_awal')->nullable();
            $table->bigInteger('debit')->nullable();
            $table->bigInteger('kredit')->nullable();
            $table->bigInteger('saldo_akhir')->nullable();
            $table->integer('deleted')->nullable();
            $table->timestamps();
        });

        // --- Isi data awal Buku Besar ---
        DB::table('bukbes')->insert([
            ['tanggal'=>'2025-01-05','id_coa'=>1,'saldo_awal'=>0,'debit'=>0,'kredit'=>0,'saldo_akhir'=>0,'deleted'=>0,'created_at'=>now(),'updated_at'=>now()],
            ['tanggal'=>'2025-01-05','id_coa'=>2,'saldo_awal'=>0,'debit'=>0,'kredit'=>0,'saldo_akhir'=>0,'deleted'=>0,'created_at'=>now(),'updated_at'=>now()],
            ['tanggal'=>'2025-01-05','id_coa'=>5,'saldo_awal'=>0,'debit'=>0,'kredit'=>0,'saldo_akhir'=>0,'deleted'=>0,'created_at'=>now(),'updated_at'=>now()],
            ['tanggal'=>'2025-01-05','id_coa'=>6,'saldo_awal'=>1207049260,'debit'=>0,'kredit'=>0,'saldo_akhir'=>1207049260,'deleted'=>0,'created_at'=>now(),'updated_at'=>now()],
            ['tanggal'=>'2025-01-05','id_coa'=>8,'saldo_awal'=>17020000,'debit'=>0,'kredit'=>0,'saldo_akhir'=>17020000,'deleted'=>0,'created_at'=>now(),'updated_at'=>now()],
            ['tanggal'=>'2025-01-05','id_coa'=>261,'saldo_awal'=>0,'debit'=>0,'kredit'=>0,'saldo_akhir'=>0,'deleted'=>0,'created_at'=>now(),'updated_at'=>now()],
            ['tanggal'=>'2025-01-05','id_coa'=>280,'saldo_awal'=>3615000000,'debit'=>0,'kredit'=>0,'saldo_akhir'=>3615000000,'deleted'=>0,'created_at'=>now(),'updated_at'=>now()],
            ['tanggal'=>'2025-01-05','id_coa'=>287,'saldo_awal'=>53800000,'debit'=>0,'kredit'=>0,'saldo_akhir'=>53800000,'deleted'=>0,'created_at'=>now(),'updated_at'=>now()],
            ['tanggal'=>'2025-01-05','id_coa'=>9,'saldo_awal'=>0,'debit'=>0,'kredit'=>0,'saldo_akhir'=>0,'deleted'=>0,'created_at'=>now(),'updated_at'=>now()],
            ['tanggal'=>'2025-01-05','id_coa'=>10,'saldo_awal'=>7337294424,'debit'=>0,'kredit'=>25008000,'saldo_akhir'=>7312286424,'deleted'=>0,'created_at'=>now(),'updated_at'=>now()],
            ['tanggal'=>'2025-01-05','id_coa'=>238,'saldo_awal'=>-7439264671,'debit'=>25000000,'kredit'=>46834000,'saldo_akhir'=>-7461098671,'deleted'=>0,'created_at'=>now(),'updated_at'=>now()],
            ['tanggal'=>'2025-01-05','id_coa'=>239,'saldo_awal'=>-5671166467,'debit'=>0,'kredit'=>0,'saldo_akhir'=>-5671166467,'deleted'=>0,'created_at'=>now(),'updated_at'=>now()],
            ['tanggal'=>'2025-01-05','id_coa'=>262,'saldo_awal'=>86269,'debit'=>0,'kredit'=>0,'saldo_akhir'=>86269,'deleted'=>0,'created_at'=>now(),'updated_at'=>now()],
            ['tanggal'=>'2025-01-05','id_coa'=>208,'saldo_awal'=>7451307596,'debit'=>0,'kredit'=>0,'saldo_akhir'=>7451307596,'deleted'=>0,'created_at'=>now(),'updated_at'=>now()],
            ['tanggal'=>'2025-01-05','id_coa'=>237,'saldo_awal'=>2390996000,'debit'=>0,'kredit'=>0,'saldo_akhir'=>2390996000,'deleted'=>0,'created_at'=>now(),'updated_at'=>now()],
            ['tanggal'=>'2025-01-05','id_coa'=>17,'saldo_awal'=>0,'debit'=>0,'kredit'=>0,'saldo_akhir'=>0,'deleted'=>0,'created_at'=>now(),'updated_at'=>now()],
            ['tanggal'=>'2025-01-05','id_coa'=>18,'saldo_awal'=>-11971930194,'debit'=>0,'kredit'=>0,'saldo_akhir'=>-11971930194,'deleted'=>0,'created_at'=>now(),'updated_at'=>now()],
            ['tanggal'=>'2025-01-05','id_coa'=>19,'saldo_awal'=>464045110,'debit'=>0,'kredit'=>0,'saldo_akhir'=>464045110,'deleted'=>0,'created_at'=>now(),'updated_at'=>now()],
            ['tanggal'=>'2025-01-05','id_coa'=>168,'saldo_awal'=>31218000,'debit'=>0,'kredit'=>0,'saldo_akhir'=>31218000,'deleted'=>0,'created_at'=>now(),'updated_at'=>now()],
            ['tanggal'=>'2025-01-05','id_coa'=>169,'saldo_awal'=>-5490065936,'debit'=>0,'kredit'=>0,'saldo_akhir'=>-5490065936,'deleted'=>0,'created_at'=>now(),'updated_at'=>now()],
            ['tanggal'=>'2025-01-05','id_coa'=>170,'saldo_awal'=>17795532,'debit'=>0,'kredit'=>0,'saldo_akhir'=>17795532,'deleted'=>0,'created_at'=>now(),'updated_at'=>now()],
            ['tanggal'=>'2025-01-05','id_coa'=>264,'saldo_awal'=>3997750000,'debit'=>0,'kredit'=>0,'saldo_akhir'=>3997750000,'deleted'=>0,'created_at'=>now(),'updated_at'=>now()],
            ['tanggal'=>'2025-01-05','id_coa'=>20,'saldo_awal'=>0,'debit'=>0,'kredit'=>0,'saldo_akhir'=>0,'deleted'=>0,'created_at'=>now(),'updated_at'=>now()],
            ['tanggal'=>'2025-01-05','id_coa'=>266,'saldo_awal'=>0,'debit'=>0,'kredit'=>0,'saldo_akhir'=>0,'deleted'=>0,'created_at'=>now(),'updated_at'=>now()],
            ['tanggal'=>'2025-01-05','id_coa'=>21,'saldo_awal'=>0,'debit'=>0,'kredit'=>0,'saldo_akhir'=>0,'deleted'=>0,'created_at'=>now(),'updated_at'=>now()],
            ['tanggal'=>'2025-01-05','id_coa'=>22,'saldo_awal'=>4939489916,'debit'=>0,'kredit'=>0,'saldo_akhir'=>4939489916,'deleted'=>0,'created_at'=>now(),'updated_at'=>now()],
            ['tanggal'=>'2025-01-05','id_coa'=>171,'saldo_awal'=>0,'debit'=>0,'kredit'=>0,'saldo_akhir'=>0,'deleted'=>0,'created_at'=>now(),'updated_at'=>now()],
            ['tanggal'=>'2025-01-05','id_coa'=>24,'saldo_awal'=>0,'debit'=>0,'kredit'=>0,'saldo_akhir'=>0,'deleted'=>0,'created_at'=>now(),'updated_at'=>now()],
            ['tanggal'=>'2025-01-05','id_coa'=>25,'saldo_awal'=>14688223,'debit'=>0,'kredit'=>0,'saldo_akhir'=>14688223,'deleted'=>0,'created_at'=>now(),'updated_at'=>now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukbes');
    }
};