<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FThnblnopen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE OR REPLACE FUNCTION thnblnopen () 
        RETURNS varchar AS ".'$body$'."
        DECLARE
        
          Result varchar(8);
          vStatus varchar(8);
        
        BEGIN
            Select max(thnbln) into vStatus from TimeTRans Where status='1' and length(thnbln)=6;
            Result:=vStatus;
            return Result;
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
        DB::statement("DROP FUNCTION thnblnopen");
    }
}
