<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VCjArus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE OR REPLACE VIEW v_cj_arus AS
            SELECT 
                C.TAHUN,
                T.CLASS,
                S.KETERANGAN AS KET_CLAS,
                T.CJ_CODE,
                T.CJ_LEVEL,
                C.BULAN,
                C.SALDO_AWAL, 
                C.SALDO_AWAL_DL, 
                C.SALDO_AWAL_DL_RP, 
                C.NILAI, 
                C.NILAI_DL, 
                C.NILAI_DL_RP, 
                C.SALDO_AKHIR, 
                C.SALDO_AKHIR_DL, 
                C.SALDO_AKHIR_DL_RP, 
                C.NILAI_KURS, 
                C.SALDO_AWAL_KURS, 
                C.SALDO_AKHIR_KURS, 
                T.KETERANGAN,
                coalesce(F_CJ_nilai_lalu('1',C.CJ,C.TAHUN,C.BULAN),0) Nilai_Lalu, 
                coalesce(F_CJ_nilai_lalu('2',C.CJ,C.TAHUN,C.BULAN),0) Nilai_Lalu_DL, 
                coalesce(F_CJ_nilai_lalu('3',C.CJ,C.TAHUN,C.BULAN),0) Nilai_Lalu_DL_RP, 
                coalesce(F_CJ_sa_lalu('1',C.CJ,C.TAHUN,C.BULAN),0) Saldo_Awal_Lalu, 
                coalesce(F_CJ_sa_lalu('2',C.CJ,C.TAHUN,C.BULAN),0) Saldo_Awal_Lalu_DL, 
                coalesce(F_CJ_sa_lalu('3',C.CJ,C.TAHUN,C.BULAN),0) Saldo_Awal_Lalu_DL_RP
            FROM 
                v_cj_sub_class t,
                CASH_FLOW C,
                V_CJ_CLASS S 
            WHERE 
            C.CJ = T.CJ_CODE 
            AND S.CLASS=T.CLASS 
            ORDER BY T.CLASS, T.CJ_CODE
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW v_cj_arus");
    }
}
