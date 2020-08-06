<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VReportD5 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE OR REPLACE VIEW v_report_d5 AS
            SELECT 
                tahun, 
                bulan, 
                suplesi, 
                ci mu, 
                jb, 
                account sandi, 
                lokasi lapangan, 
                coalesce(awalrp,0) last_rp, 
                coalesce(awaldl,0) last_dl, 
                pricerp cur_rp, 
                pricedl cur_dl, 
                totpricerp cum_rp, 
                totpricedl cum_dl 
            FROM OBPSI_2017 
            UNION ALL 
            SELECT 
                tahun, 
                bulan, 
                Supbln suplesi, 
                ci mu, 
                jb, 
                account sandi, 
                lokasi lapangan, 
                0 last_rp, 
                0 last_dl, 
                SUM(coalesce(TotpriceRp,0)) cur_rp, 
                SUM(coalesce(TotPrice,0)) cur_dl, 
                SUM(coalesce(TotpriceRp,0)) cum_rp, 
                SUM(coalesce(TotpriceDl,0)) cum_dl 
            FROM FIOSD201 
            WHERE ci='2' 
            AND tahun = '2017' 
            AND TAHUN||Bulan||SUPBLN <= '2019120' 
            GROUP BY TAHUN, BULAN, SUPBLN, ACCOUNT, JB, CI, LOKASI 
            UNION ALL 
            SELECT 
                tahun, 
                bulan, 
                Supbln suplesi, 
                ci mu, 
                jb, 
                account sandi, 
                lokasi lapangan, 
                0 last_rp, 
                0 last_dl, 
                SUM(coalesce(TotpriceRp,0)) cur_rp, 
                0 cur_dl, 
                SUM(coalesce(TotpriceRp,0)) cum_rp, 
                0 cum_dl 
            FROM FIOSD201 
            WHERE CI='1' 
            AND TAHUN = '2017' 
            AND TAHUN||Bulan||SUPBLN <= '2019120' 
            GROUP BY TAHUN, BULAN, SUPBLN, ACCOUNT, JB, CI,LOKASI;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW v_report_d5");
    }
}
