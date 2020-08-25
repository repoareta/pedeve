<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmPerusahaanAfiliasiKomisarisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cm_perusahaan_afiliasi_komisaris', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('perusahaan_afiliasi_id');
            $table->string('nama');
            $table->date('tmt_dinas');
            $table->date('akhir_masa_dinas');
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
        Schema::dropIfExists('cm_perusahaan_afiliasi_komisaris');
    }
}
