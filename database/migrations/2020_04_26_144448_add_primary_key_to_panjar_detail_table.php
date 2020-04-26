<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrimaryKeyToPanjarDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('panjar_detail', function (Blueprint $table) {
            $table->primary(['no', 'no_panjar']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('panjar_detail', function (Blueprint $table) {
            $table->dropPrimary(['no', 'no_panjar']);
        });
    }
}
