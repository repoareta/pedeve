<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmPerusahaanAfiliasiPerizinanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cm_perusahaan_afiliasi_perizinan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('perusahaan_afiliasi_id');
            $table->string('keterangan');
            $table->string('nomor');
            $table->date('masa_berlaku_akhir');
            $table->text('dokumen');
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
        Schema::dropIfExists('cm_perusahaan_afiliasi_perizinan');
    }
}
