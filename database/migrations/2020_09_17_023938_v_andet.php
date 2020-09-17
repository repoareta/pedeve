<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VAndet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE OR REPLACE VIEW v_andet AS 
        SELECT DISTINCT substring(t.kodeacct  from 1 for 1)AS class, 
        t.kodeacct as sandi,
        t.descacct 
        FROM ACCOUNT t
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW v_andet");
    }
}
