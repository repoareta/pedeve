<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblKerjaHeader extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kerja_header', function (Blueprint $table) {
            if (!Schema::hasColumn('kerja_header', 'kepada')) {
                $table->string('kepada')->nullable()->after('jumlah');
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
        //
        Schema::table('kerja_header', function (Blueprint $table) {
            //
        });
    }
}
