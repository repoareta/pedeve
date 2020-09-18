<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VClassAccountRevisi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
        CREATE OR REPLACE VIEW v_class_account AS 
        SELECT m.jenis,
        m.batas_awal,
        m.batas_akhir,
        m.urutan,
        m.pengali,
        m.pengali_tampil,
        m.sub_akun,
        m.lokasi,
        "substring"(m.urutan::text, 1, 1) AS urutan_sc,
        "substring"(m.urutan::text, 1, 3) AS urutan_class
       FROM main_account m
      WHERE length(m.urutan::text) >= 3');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW v_class_account");
    }
}
