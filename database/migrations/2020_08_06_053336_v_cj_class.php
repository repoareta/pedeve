<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VCjClass extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE OR REPLACE VIEW v_cj_class AS
            SELECT 
                CJ_CODE AS CLASS,
                CJ_LEVEL,
                KETERANGAN 
            FROM V_CJ_AK 
            WHERE LENGTH(CJ_CODE) = 1
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW v_cj_class");
    }
}
