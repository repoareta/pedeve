<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblDokumenPerkara extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('tbl_dokumen_perkara')) {
            Schema::create('tbl_dokumen_perkara', function (Blueprint $table) {
                $table->increments('kd_dok');
                $table->string('no_perkara',100);
                $table->string('file',100);

            });
        };
    }

    public function down()
    {
        Schema::dropIfExists('tbl_dokumen_perkara');
    }
}
