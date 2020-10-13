<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeleteToUsermenuTable extends Migration
{
    public function up()
    {
        Schema::table('usermenu', function (Blueprint $table) {
            if (!Schema::hasColumn('usermenu', 'deleted_at')) {
                $table->softDeletes();
            }
        });
    }

    public function down()
    {
        Schema::table('usermenu', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
