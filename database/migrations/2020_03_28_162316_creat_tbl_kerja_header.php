<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatTblKerjaHeader extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kerja_header', function (Blueprint $table) {
            $table->timestamp('tgl_panjar')->nullable();
            $table->string('app_sdm', 1)->nullable();
            $table->string('app_sdm_oleh', 15)->nullable();
            $table->timestamp('app_sdm_tgl')->nullable();
            $table->string('app_pbd_oleh', 15)->nullable();
            $table->timestamp('app_pbd_tgl')->nullable();
            $table->string('no_kas', 25)->nullable();
            $table->string('bulan_buku', 6)->nullable();
            $table->string('keterangan', 200)->nullable();
            $table->string('ci', 1)->nullable();
            $table->string('app_pbd', 1)->nullable();
            $table->bigInteger('rate')->nullable();
            $table->string('jenis_um', 1)->nullable();
            $table->string('no_umk', 25)->primary();
            $table->bigInteger('jumlah')->nullable();
            $table->string('kepada', 200)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kerja_header');
    }
}
