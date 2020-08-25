<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmPerusahaanAfiliasiAktaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cm_perusahaan_afiliasi_akta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('perusahaan_afiliasi_id');
            $table->string('jenis');
            $table->string('nomor_akta');
            $table->date('tanggal');
            $table->string('notaris');
            $table->date('tmt_mulai');
            $table->date('tmt_akhir');
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
        Schema::dropIfExists('cm_perusahaan_afiliasi_akta');
    }
}
