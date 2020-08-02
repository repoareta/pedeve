<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VNeraca extends Migration
{
    public function up()
    {
        DB::statement("CREATE VIEW v_neraca AS
                        select tahun,bulan,suplesi,mu,jb,sandi,lapangan,last_rp,last_dl,cur_rp,cur_dl,cum_rp,cum_dl, m.* from v_report_d5 d, v_main_account m where substr(d.sandi,1,length(m.batas_awal)) between m.batas_awal and m.batas_akhir and strpos(m.lokasi,d.lapangan)>0");
    }
    public function down()
    {
        DB::statement("DROP VIEW v_neraca");
    }
}
