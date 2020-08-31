<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VCashflowpercjreport extends Migration
{
    public function up()
    {
        DB::statement("CREATE VIEW v_cashflowpercjreport AS
                        	                        	select p.urutan, p.tahun, p.bulan, p.nilai, CAST(p.status as integer), (select coalesce(sum(totpricerp),0) from v_cashflowpercj where tahun=p.tahun and bulan=p.bulan and urutan=p.urutan) as totreal from proyeksicash p");
    }
    public function down()
    {
        DB::statement("DROP VIEW v_cashflowpercjreport");
    }
}
