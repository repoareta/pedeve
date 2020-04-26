<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetForeignKeyToPanjarHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('panjar_header', function (Blueprint $table) {
            $table->foreign('nopek')
            ->references('nopeg')
            ->on('sdm_master_pegawai')
            ->onUpdate('cascade')
            ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('panjar_header', function (Blueprint $table) {
            $table->dropForeign('panjar_header_nopek_foreign');
        });
    }
}
