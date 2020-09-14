<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VEstimasi170 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE OR REPLACE VIEW v_estimasi_170 AS
            SELECT 
                SUBSTRING(B.THNBLN from 1 for 4) AS TAHUN,
                SUBSTRING(B.THNBLN from 5 for 2) AS BULAN,
                SUM(round(A.TOTPRICE*B.Rate))*(73.73/100) AS TOTAL 
            FROM 
                kasline A,
                KASDOC B 
            WHERE 
                A.keterangan <> 'PENUTUP' 
                AND B.DOCNO=A.DOCNO 
                AND (A.ACCOUNT like '170%' AND A.ACCOUNT not in ('170002','170400','170000')) 
            GROUP BY 
                substring(B.THNBLN from 1 for 4),
                substring(B.THNBLN from 5 for 2)
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW v_estimasi_170");
    }
}
