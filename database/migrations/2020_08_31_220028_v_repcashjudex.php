<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VRepcashjudex extends Migration
{
    public function up()
    {
        DB::statement("CREATE VIEW v_repcashjudex AS
                        	                        	Select K.DOCNO,(select voucher from kasdoc where docno=K.docno) as Voucher, (select thnbln from kasdoc where docno=K.docno) as thnbln, K.LINENO, K.ACCOUNT,K.LOKASI,K.CJ, K.TOTPRICE, K.KETERANGAN From KASLINE K");
    }
    public function down()
    {
        DB::statement("DROP VIEW v_repcashjudex");
    }
}
