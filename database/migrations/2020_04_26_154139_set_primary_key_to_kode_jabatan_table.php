<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetPrimaryKeyToKodeJabatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sdm_tbl_kdjab', function (Blueprint $table) {
            $table->primary(['kdbag', 'kdjab']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sdm_tbl_kdjab', function (Blueprint $table) {
            $table->dropPrimary('sdm_tbl_kdjab_pkey');
        });
    }
}
