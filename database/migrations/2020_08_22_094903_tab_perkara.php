<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TabPerkara extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('tbl_perkara')) {
            Schema::create('tbl_perkara', function (Blueprint $table) {
                $table->string('no_perkara',100);
                $table->dateTime('tgl_perkara')->nullable();
                $table->string('jenis_perkara',100)->nullable();
                $table->string('klasifikasi_perkara',100)->nullable();
                $table->string('status_perkara',100)->nullable();
                $table->text('r_perkara')->nullable();
                $table->text('r_patitum')->nullable();
                $table->text('r_putusan')->nullable();
                $table->decimal('nilai_perkara',38,10)->nullable();
                $table->string('file',100);
                $table->integer('rate');
                $table->integer('ci');
            });
        };
    }

    public function down()
    {
        Schema::dropIfExists('tbl_perkara');
    }
}
