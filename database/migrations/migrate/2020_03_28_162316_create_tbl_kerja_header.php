<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblKerjaHeader extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kerja_header', function (Blueprint $table) {
            $table->timestamp('tgl_panjar');
            $table->string('app_sdm', 1);
            $table->string('app_sdm_oleh', 15);
            $table->timestamp('app_sdm_tgl');
            $table->string('app_pbd_oleh', 15);
            $table->timestamp('app_pbd_tgl');
            $table->string('no_kas', 25);
            $table->string('bulan_buku', 6);
            $table->string('keterangan', 200);
            $table->string('ci', 1);
            $table->string('app_pbd', 1);
            $table->bigInteger('rate');
            $table->string('jenis_um', 1);
            $table->string('no_umk', 25)->primary();
            $table->bigInteger('jumlah');
            $table->string('kepada', 200);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('kerja_header');
    }
}
