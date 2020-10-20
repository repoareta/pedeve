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
                $table->integer('sales')->nullable();
                $table->integer('tkp')->nullable();                
                $table->integer('total_aset')->nullable();
                $table->integer('laba_bersih')->nullable();
                $table->integer('rate')->nullable();;
                $table->integer('ci');
            });
        };
    }

    public function down()
    {
        Schema::dropIfExists('tbl_monitoring');
    }
}
