<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VCjAk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE OR REPLACE VIEW v_cj_ak AS
            SELECT 
                replace(upper(kode),'X', '') CJ_CODE, 
                length(replace(upper(kode),'X', '')) CJ_Level, 
                nama AS KETERANGAN 
            FROM CASHJUDEX 
            ORDER BY CJ_CODE
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW v_cj_ak");
    }
}
