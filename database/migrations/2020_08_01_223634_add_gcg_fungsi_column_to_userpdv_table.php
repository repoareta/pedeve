<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGcgFungsiColumnToUserpdvTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('userpdv', function (Blueprint $table) {
            if (!Schema::hasColumn('userpdv', 'gcg_fungsi_id')) {
                $table->unsignedBigInteger('gcg_fungsi_id')->nullable();
                $table
                ->foreign('gcg_fungsi_id')
                ->references('id')
                ->on('gcg_fungsi')
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
            $table->dropColumn('gcg_fungsi_id');
        });
    }
}
