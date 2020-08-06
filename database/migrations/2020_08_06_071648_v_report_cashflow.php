<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VReportCashflow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE OR REPLACE VIEW v_report_cashflow AS
            SELECT 
                tahun, 
                class,
                ket_clas,
                cj_code,
                cj_level,
                bulan,
                nilai_lalu,
                nilai_lalu_dl,
                nilai_lalu_dl_rp,
                saldo_awal_lalu,
                saldo_awal_lalu_dl,
                saldo_awal_lalu_dl_rp,
                saldo_awal,
                saldo_awal_dl,
                saldo_awal_dl_rp,
                nilai,
                nilai_dl,
                nilai_dl_rp,
                saldo_akhir,
                saldo_akhir_dl,
                saldo_akhir_dl_rp,
                nilai_kurs,
                saldo_awal_kurs,
                saldo_akhir_kurs,
                keterangan 
            FROM 
                v_cj_arus
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW v_report_cashflow");
    }
}
