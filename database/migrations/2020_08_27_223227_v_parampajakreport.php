<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VParampajakreport extends Migration
{
    public function up()
    {
        DB::statement("CREATE VIEW v_parampajakreport AS
                        	                        Select V.TAHUN,replace(ltrim(replace(V.BULAN,'0',' ')),' ','0') as BULAN, V.NOPEK,(SELECT NAMA FROM SDM_MASTER_PEGAWAI WHERE NOPEG=V.NOPEK) AS NAMAPEKERJA, V.AARD,(SELECT NAMA FROM PAY_TBL_AARD WHERE KODE=V.AARD) AS NAMAAARD, V.NILAI From V_PARAMPAJAK V");
    }
    public function down()
    {
        DB::statement("DROP VIEW v_parampajakreport");
    }
}
