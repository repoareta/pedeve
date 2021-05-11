<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VD2kasbank extends Migration
{
    public function up()
    {
        DB::statement("CREATE VIEW v_d2kasbank AS
                        select b.docno,substring(b.thnbln from 1 for 4) as tahun,substring(b.thnbln from 5 for 2) as bulan,b.jk,b.store,b.voucher,b.ci,b.paiddate as tglbayar,b.rate,a.lineno,a.account,a.lokasi,a.bagian,a.cj,round(a.totprice) as totprice,a.keterangan from kasline a,kasdoc b where a.keterangan <> 'PENUTUP' and b.docno=a.docno");
    }
    public function down()
    {
        DB::statement("DROP VIEW v_d2kasbank");
    }
}
