<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGcgGratifikasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gcg_gratifikasi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nopeg', 6)->nullable();
            $table->string('gift_last_month', 1)->nullable();
            $table->dateTime('tgl_gratifikasi', 0);
            $table->string('status')->nullable();
            $table->string('bentuk');
            $table->string('nilai')->nullable();
            $table->string('jumlah')->nullable();
            $table->string('pemberi')->nullable();
            $table->string('penerima')->nullable();
            $table->string('peminta')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('catatan')->nullable();
            $table->string('jenis_gratifikasi');
            $table->timestamps();

            $table
            ->foreign('nopeg')
            ->references('nopeg')
            ->on('sdm_master_pegawai')
            ->onUpdate('cascade')
            ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gcg_gratifikasi');
    }
}
