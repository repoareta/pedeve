<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VParampajak extends Migration
{
    public function up()
    {
        DB::statement("CREATE VIEW v_parampajak AS
                        Select P.TAHUN,(P.BULAN) as BULAN, P.NOPEK, P.AARD, coalesce(sum(P.NILAI),2,0) as NILAI From PAY_MASTER_UPAH P where P.aard in (select kode from pay_tbl_aard where kenapajak='Y' or aard in ('06','05','32','45')) group by tahun,bulan,nopek,aard union all Select P.TAHUN,(P.BULAN) as BULAN, P.NOPEK, P.AARD,coalesce(sum(P.CURRAMOUNT),2,0) as Nilai From PAY_MASTER_BEBANPRSHN P where aard in ('10','12') group by tahun,bulan,nopek,aard union all Select TAHUN,(BULAN) as BULAN, NOPEK, AARD, coalesce(sum(NILAI),0) as Nilai From PAY_MASTER_INSENTIF 
                        where aard='24' group by tahun,bulan,nopek,aard union all Select TAHUN,(BULAN) as BULAN, NOPEK, '24P' as AARD, coalesce(sum(NILAI),0) as Nilai From PAY_MASTER_INSENTIF where aard='27' group by tahun,bulan,nopek,aard union all Select P.TAHUN,(P.BULAN) as BULAN, P.NOPEK, P.JENIS AS AARD, coalesce(sum(P.NILAI),2,0) as NILAI From PAJAK_INPUT P group by tahun,bulan,nopek,jenis union 
                        all Select P.TAHUN,(P.BULAN) as BULAN, P.NOPEK, P.JENIS||'P' AS AARD, coalesce(sum(P.PAJAK),2,0) as NILAI From PAJAK_INPUT P group by tahun,bulan,nopek,jenis union all Select TAHUN,(BULAN) as BULAN, NOPEK, AARD, coalesce(sum(NILAI),0) as Nilai From PAY_MASTER_THR where aard='25' group by tahun,bulan,nopek,aard union all Select TAHUN,(BULAN) as BULAN, NOPEK, '24P' as AARD, coalesce(sum(NILAI),0) as Nilai From PAY_MASTER_THR where aard='27' group by tahun,bulan,nopek,aard");
    }
    public function down()
    {
        DB::statement("DROP VIEW v_parampajak");
    }
}
