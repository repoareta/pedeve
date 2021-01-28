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
                $table->decimal('aset_r',38,10)->nullable();
                $table->decimal('revenue_r',38,10)->nullable();
                $table->decimal('beban_pokok_r',38,10)->nullable();                
                $table->decimal('biaya_operasi_r',38,10)->nullable();                
                $table->decimal('tkp_r',38,10)->nullable();                
                $table->decimal('kpi_r',38,10)->nullable();                
                $table->decimal('laba_bersih_r',38,10)->nullable();
                $table->decimal('rate_r',38,10)->nullable();;
                $table->integer('ci_r');
            });
        };
    }

    public function down()
    {
        Schema::dropIfExists('tbl_rencana_kerja');
    }
}
