<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNopegColumnToUserpdvTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('userpdv', function (Blueprint $table) {
            if (!Schema::hasColumn('userpdv', 'nopeg')) {
                $table->string('nopeg', 6)->nullable();
                $table
                ->foreign('nopeg')
                ->references('nopeg')
                ->on('sdm_master_pegawai')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('userpdv', function (Blueprint $table) {
            $table->dropColumn('nopeg');
        });
    }
}
