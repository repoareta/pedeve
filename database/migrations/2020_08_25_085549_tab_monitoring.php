<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TabMonitoring extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('tbl_monitoring')) {
            Schema::create('tbl_monitoring', function (Blueprint $table) {
                $table->increments('kd_monitoring');
                $table->integer('kd_perusahaan');
                $table->char('tahun',4);
                $table->char('bulan',2);
                $table->decimal('sales',38,10)->nullable();
                $table->decimal('tkp',38,10)->nullable();                
                $table->decimal('total_aset',38,10)->nullable();
                $table->decimal('laba_bersih',38,10)->nullable();
                $table->decimal('rate',38,10)->nullable();;
                $table->integer('ci');
            });
        };
    }

    public function down()
    {
        Schema::dropIfExists('tbl_monitoring');
    }
}
