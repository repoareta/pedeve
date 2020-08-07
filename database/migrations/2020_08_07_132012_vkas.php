<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Vkas extends Migration
{
    public function up()
    {
        DB::statement("CREATE VIEW vkas AS
                        select x0.docno ,x0.rekapdate ,substring(x0.thnbln from 1  for 4 ) tahun,substring(x0.thnbln  from 5  for 2 ) bulan,x1.lineno ,x1.keterangan ,x0.jk ,x0.store ,x0.ci ,x0.rate ,x0.voucher ,x1.account ,coalesce(x1.totprice,1)*case when x0.rate=0 then 1 when x0.rate is null then 1  else x0.rate end totprice,x1.area ,x1.lokasi ,x1.bagian ,x1.jb ,x1.pk ,x1.cj,x0.rekap from kasdoc x0 ,kasline x1 where ((x1.docno = x0.docno ) AND (coalesce(x0.paid,'N') = 'Y' )) and coalesce(x1.penutup,'N')<>'Y' ");
    }
    public function down()
    {
        DB::statement("DROP VIEW vkas");
    }
}
