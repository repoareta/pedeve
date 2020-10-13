<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeleteToDfmenuTable extends Migration
{
    public function up()
    {
        Schema::table('dftmenu', function (Blueprint $table) {
            if (!Schema::hasColumn('dftmenu', 'deleted_at')) {
                $table->softDeletes();
            }
        });
    }

    public function down()
    {
        Schema::table('dftmenu', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
