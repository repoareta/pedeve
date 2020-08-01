<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGcgJabatanColumnToUserpdvTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('userpdv', function (Blueprint $table) {
            if (!Schema::hasColumn('userpdv', 'gcg_jabatan_id')) {
                $table->unsignedBigInteger('gcg_jabatan_id')->nullable();
                $table
                ->foreign('gcg_jabatan_id')
                ->references('id')
                ->on('gcg_jabatan')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('userpdv', function (Blueprint $table) {
            $table->dropColumn('gcg_jabatan_id');
        });
    }
}
