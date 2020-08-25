<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmPerusahaanAfiliasiPemegangSahamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cm_perusahaan_afiliasi_pemegang_saham', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('perusahaan_afiliasi_id');
            $table->string('nama');
            $table->decimal('kepemilikan', 5, 2);
            $table->integer('jumlah_lembar_saham');
            $table->string('created_by', 6);
            $table->timestamps();

            $table->foreign('created_by')
            ->references('nopeg')
            ->on('userpdv')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('perusahaan_afiliasi_id')
            ->references('id')
            ->on('cm_perusahaan_afiliasi')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cm_perusahaan_afiliasi_pemegang_saham');
    }
}
