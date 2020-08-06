<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VCjSubClass extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE OR REPLACE VIEW v_cj_sub_class AS
        SELECT 
            substring(CJ_CODE, 1, 1) AS CLASS,
            CJ_CODE,
            CJ_LEVEL,
            KETERANGAN 
        FROM V_CJ_AK T 
        WHERE LENGTH(CJ_CODE) >= 2
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW v_cj_sub_class");
    }
}
