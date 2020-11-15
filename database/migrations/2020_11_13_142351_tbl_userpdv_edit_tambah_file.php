<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblUserpdvEditTambahFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('userpdv', function (Blueprint $table) {
            if (!Schema::hasColumn('userpdv', 'file')) {
                $table->string('file')->nullable()->after('host');
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
            //
        });
    }
}
