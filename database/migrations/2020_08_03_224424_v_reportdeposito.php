<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VReportdeposito extends Migration
{
    public function up()
    {
        DB::statement("CREATE VIEW v_reportdeposito AS
                        select 'T' as jenis,p.doccair, p.linecair, p.tgldepo, p.tgltempo as tglcair, p.noseri, p.nominal,p.kdbank, p.keterangan, p.kurs,p.asal as lokasi,p.docno,p.lineno, p.statcair,(select descacct from account where kodeacct=p.kdbank) as namabank, p.bungatahun from penempatandepo p union all select 'C' as jenis,p.doccair, p.linecair, localtimestamp as tgldepo,p.tglcair, p.noseri, p.nominal, p.kdbank, p.keterangan, p.kurs, p.lokasi, p.docno, p.lineno,'Y' as statcair, (select descacct from account where kodeacct=p.kdbank) as namabank, 0 as bungatahun from pencairandepo p");
    }
    public function down()
    {
        DB::statement("DROP VIEW v_reportdeposito");
    }
}
