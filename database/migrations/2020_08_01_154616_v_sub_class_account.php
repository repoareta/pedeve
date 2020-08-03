<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VSubClassAccount extends Migration
{
    public function up()
    {
        DB::statement("CREATE VIEW v_sub_class_account AS
                        select jenis,batas_awal,batas_akhir,urutan, substring(urutan from 1 for 1) urutan_cs from main_account where length(urutan)=3");
    }
    public function down()
    {
        DB::statement("DROP VIEW v_sub_class_account");
    }
}
