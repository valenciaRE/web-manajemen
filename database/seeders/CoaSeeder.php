<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('coa')->insert([
            ['id_coa'=>1,'coa_name'=>'Aset','coa_number'=>'1.0.00','posisi_awal'=>null],
            ['id_coa'=>2,'coa_name'=>'Aset Lancar','coa_number'=>'1.1.00','posisi_awal'=>null],
            ['id_coa'=>5,'coa_name'=>'Kas','coa_number'=>'1.1.01','posisi_awal'=>null],
            ['id_coa'=>6,'coa_name'=>'Kas Besar','coa_number'=>'1.1.01.01','posisi_awal'=>'Debit'],
            ['id_coa'=>7,'coa_name'=>'Kas Kecil','coa_number'=>'1.1.01.02','posisi_awal'=>'Debit'],
            ['id_coa'=>8,'coa_name'=>'Bank','coa_number'=>'1.1.02','posisi_awal'=>null],
            ['id_coa'=>9,'coa_name'=>'Bank Mandiri','coa_number'=>'1.1.02.01','posisi_awal'=>'Debit'],
            ['id_coa'=>10,'coa_name'=>'Bank BCA','coa_number'=>'1.1.02.02','posisi_awal'=>'Debit'],
            ['id_coa'=>11,'coa_name'=>'Piutang','coa_number'=>'1.1.03','posisi_awal'=>null],
            ['id_coa'=>12,'coa_name'=>'Piutang Usaha','coa_number'=>'1.1.03.01','posisi_awal'=>'Debit'],
            ['id_coa'=>13,'coa_name'=>'Piutang Lain-lain','coa_number'=>'1.1.03.02','posisi_awal'=>'Debit'],
            ['id_coa'=>14,'coa_name'=>'Persediaan','coa_number'=>'1.1.04','posisi_awal'=>null],
            ['id_coa'=>15,'coa_name'=>'Persediaan Barang','coa_number'=>'1.1.04.01','posisi_awal'=>'Debit'],
            ['id_coa'=>16,'coa_name'=>'Aset Tetap','coa_number'=>'1.2.00','posisi_awal'=>null],
            ['id_coa'=>17,'coa_name'=>'Peralatan','coa_number'=>'1.2.01','posisi_awal'=>null],
            ['id_coa'=>18,'coa_name'=>'Peralatan Kantor','coa_number'=>'1.2.01.01','posisi_awal'=>'Debit'],
            ['id_coa'=>19,'coa_name'=>'Kendaraan','coa_number'=>'1.2.02','posisi_awal'=>null],
            ['id_coa'=>20,'coa_name'=>'Kendaraan Operasional','coa_number'=>'1.2.02.01','posisi_awal'=>'Debit'],
            ['id_coa'=>21,'coa_name'=>'Liabilitas','coa_number'=>'2.0.00','posisi_awal'=>null],
            ['id_coa'=>22,'coa_name'=>'Liabilitas Jangka Pendek','coa_number'=>'2.1.00','posisi_awal'=>null],
            ['id_coa'=>23,'coa_name'=>'Hutang Usaha','coa_number'=>'2.1.01','posisi_awal'=>null],
            ['id_coa'=>24,'coa_name'=>'Hutang Supplier','coa_number'=>'2.1.01.01','posisi_awal'=>'Kredit'],
            ['id_coa'=>25,'coa_name'=>'Hutang Pajak','coa_number'=>'2.1.02','posisi_awal'=>null],
            ['id_coa'=>26,'coa_name'=>'Hutang PPN','coa_number'=>'2.1.02.01','posisi_awal'=>'Kredit'],
            ['id_coa'=>27,'coa_name'=>'Ekuitas','coa_number'=>'3.0.00','posisi_awal'=>null],
            ['id_coa'=>28,'coa_name'=>'Modal','coa_number'=>'3.1.00','posisi_awal'=>null],
            ['id_coa'=>29,'coa_name'=>'Modal Pemilik','coa_number'=>'3.1.01','posisi_awal'=>'Kredit'],
            ['id_coa'=>30,'coa_name'=>'Laba Ditahan','coa_number'=>'3.2.00','posisi_awal'=>null],
            ['id_coa'=>31,'coa_name'=>'Laba Tahun Berjalan','coa_number'=>'3.2.01','posisi_awal'=>'Kredit'],
            ['id_coa'=>32,'coa_name'=>'Pendapatan','coa_number'=>'4.0.00','posisi_awal'=>null],
            ['id_coa'=>33,'coa_name'=>'Pendapatan Usaha','coa_number'=>'4.1.00','posisi_awal'=>null],
            ['id_coa'=>34,'coa_name'=>'Pendapatan Penjualan','coa_number'=>'4.1.01','posisi_awal'=>'Kredit'],
            ['id_coa'=>35,'coa_name'=>'Pendapatan Jasa','coa_number'=>'4.1.02','posisi_awal'=>'Kredit'],
            ['id_coa'=>36,'coa_name'=>'Pendapatan Lain-lain','coa_number'=>'4.2.00','posisi_awal'=>null],
            ['id_coa'=>37,'coa_name'=>'Pendapatan Bunga','coa_number'=>'4.2.01','posisi_awal'=>'Kredit'],
            ['id_coa'=>38,'coa_name'=>'Beban','coa_number'=>'5.0.00','posisi_awal'=>null],
            ['id_coa'=>39,'coa_name'=>'Beban Operasional','coa_number'=>'5.1.00','posisi_awal'=>null],
            ['id_coa'=>40,'coa_name'=>'Beban Gaji','coa_number'=>'5.1.01','posisi_awal'=>'Debit'],
            ['id_coa'=>41,'coa_name'=>'Beban Listrik','coa_number'=>'5.1.02','posisi_awal'=>'Debit'],
            ['id_coa'=>42,'coa_name'=>'Beban Telepon','coa_number'=>'5.1.03','posisi_awal'=>'Debit'],
            ['id_coa'=>43,'coa_name'=>'Beban Sewa','coa_number'=>'5.1.04','posisi_awal'=>'Debit'],
            ['id_coa'=>44,'coa_name'=>'Beban Penyusutan','coa_number'=>'5.1.05','posisi_awal'=>'Debit'],
        ]);
    }
}