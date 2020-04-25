<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblVendor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('tbl_vendor')) {
            Schema::create('tbl_vendor', function (Blueprint $table) {
                $table->increments('vendorid');
                $table->string('nama', 100);
                $table->text('alamat');
                $table->string('telpon', 20);
            });
        };
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_vendor');
    }
}
