<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TabHakim extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('tbl_hakim')) {
            Schema::create('tbl_hakim', function (Blueprint $table) {
                $table->increments('kd_hakim');
                $table->integer('kd_pihak');
                $table->string('nama',100)->nullable();
                $table->string('alamat',100)->nullable();
                $table->text('telp')->nullable();
                $table->text('keterangan')->nullable();
                $table->string('status',1)->nullable();
            });
        };
    }

    public function down()
    {
        Schema::dropIfExists('tbl_hakim');
    }
}
