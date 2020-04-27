<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNoKtpToSdmMasterPegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sdm_master_pegawai', function (Blueprint $table) {
            if (!Schema::hasColumn('sdm_master_pegawai', 'noktp')) {
                $table->string('noktp', 20)->nullable();
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
        Schema::table('sdm_master_pegawai', function (Blueprint $table) {
            $table->dropColumn('noktp');
        });
    }
}
