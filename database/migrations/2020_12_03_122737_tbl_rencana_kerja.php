<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblRencanaKerja extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('tbl_rencana_kerja')) {
            Schema::create('tbl_rencana_kerja', function (Blueprint $table) {
                $table->increments('kd_rencana_kerja');
                $table->integer('kd_perusahaan');
                $table->char('tahun',4);
                $table->char('bulan',2);
                $table->decimal('aset',38,10)->nullable();
                $table->decimal('revenue',38,10)->nullable();
                $table->decimal('beban_pokok',38,10)->nullable();                
                $table->decimal('biaya_operasi',38,10)->nullable();                
                $table->decimal('tkp',38,10)->nullable();                
                $table->decimal('kpi',38,10)->nullable();                
                $table->decimal('laba_bersih',38,10)->nullable();
                $table->decimal('rate',38,10)->nullable();;
                $table->integer('ci');
            });
        };
    }

    public function down()
    {
        Schema::dropIfExists('tbl_rencana_kerja');
    }
}
