<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetPrimaryKeyToPendidikanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sdm_tbl_pendidikan', function (Blueprint $table) {
            $table->primary('kode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sdm_tbl_pendidikan', function (Blueprint $table) {
            $table->dropPrimary('sdm_tbl_pendidikan_pkey');
        });
    }
}
