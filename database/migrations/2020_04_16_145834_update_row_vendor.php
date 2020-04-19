<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRowVendor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         //
         Schema::table('tbl_vendor', function (Blueprint $table) {
            //
        $table->string('norek',20)->nullable()->after('nama');
        $table->string('nama_bank',100)->nullable()->after('norek');
        $table->string('cabang_bank',100)->nullable()->after('nama_bank');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         //
         Schema::table('tbl_vendor', function (Blueprint $table) {
            //
        });
    }
}
