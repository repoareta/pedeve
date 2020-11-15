<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FPbdCarilineno extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE OR REPLACE FUNCTION pbd_carilineno (i_DOCNO text)  
            RETURNS bigint AS ".'$body$'."
            DECLARE

            v_No bigint;

            BEGIN
            Select max(LINENO) into v_No from KASLINE WHERE DOCNO=i_DOCNO;
            If v_No is Null Then
                v_No :=1;
            Else
                v_No :=v_No + 1;
            End If;
            return(v_No);
            end;
            ".'$body$'."
            LANGUAGE PLPGSQL
            ;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP FUNCTION pbd_carilineno");
    }
}
