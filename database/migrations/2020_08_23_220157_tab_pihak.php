<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TabPihak extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('tbl_pihak')) {
            Schema::create('tbl_pihak', function (Blueprint $table) {
                $table->increments('kd_pihak');
                $table->string('no_perkara',100);
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
        Schema::dropIfExists('tbl_pihak');
    }
}
