<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGcgLhkpnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gcg_lhkpn', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status');
            $table->text('dokumen');
            $table->date('tanggal');
            $table->string('nopeg', 6);
            $table->timestamps();

            $table->foreign('nopeg')
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
        Schema::dropIfExists('gcg_lhkpn');
    }
}
