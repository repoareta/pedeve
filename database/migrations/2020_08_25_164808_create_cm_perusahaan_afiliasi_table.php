<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmPerusahaanAfiliasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cm_perusahaan_afiliasi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('telepon');
            $table->text('alamat');
            $table->text('bidang_usaha');
            $table->decimal('modal_dasar', 38, 10);
            $table->decimal('modal_disetor', 38, 10);
            $table->integer('jumlah_lembar_saham');
            $table->decimal('nilai_nominal_per_saham', 38, 10);
            $table->string('created_by', 6);
            $table->timestamps();

            $table->foreign('created_by')
            ->references('nopeg')
            ->on('userpdv')
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
        Schema::dropIfExists('cm_perusahaan_afiliasi');
    }
}
