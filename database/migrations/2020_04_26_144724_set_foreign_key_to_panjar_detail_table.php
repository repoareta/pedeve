<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetForeignKeyToPanjarDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('panjar_detail', function (Blueprint $table) {
            $table->foreign('no_panjar')
            ->references('no_panjar')
            ->on('panjar_header')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('nopek')
            ->references('nopeg')
            ->on('sdm_master_pegawai')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('panjar_detail', function (Blueprint $table) {
            $table->dropForeign('panjar_detail_no_panjar_foreign');
            $table->dropForeign('panjar_detail_nopek_foreign');
        });
    }
}
