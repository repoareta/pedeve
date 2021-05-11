<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSdmMasterPegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('sdm_master_pegawai', function (Blueprint $table) {
            if (!Schema::hasColumn('sdm_master_pegawai', 'noabsen')) {
                $table->string('noabsen')->nullable()->after('noktp');
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
        //
        Schema::table('sdm_master_pegawai', function (Blueprint $table) {
            //
        });
    }
}
