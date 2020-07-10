<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VClassAccount extends Migration
{
    public function up()
    {
        DB::statement("CREATE VIEW v_class_account AS
                        select m.*, substring(m.urutan from 1 for 3) urutan_sc from main_account m where length(urutan)>=3");
    }
    public function down()
    {
        DB::statement("DROP VIEW v_class_account");
    }
}
