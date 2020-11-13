<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FApprBatalPumk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE OR REPLACE FUNCTION appr_batal_pumk (i_No text,i_UserId text)  
        RETURNS VOID AS ".'$body$'."
        DECLARE
        
        v_App varchar(2);
        
        BEGIN
           SELECT coalesce(APP_PBD,'N') into v_App FROM PUMK_HEADER WHERE UPPER(NO_PUMK)=Upper(i_No);
           if v_App='N' then
             --Delete from KasDoc where UPPER(docno) = (select UPPER(No_Kas) from PUMK_HEADER where UPPER(No_PUMK)=UPPER(i_No));
             --DELETE FROM KASLINE WHERE UPPER(DOCNO)=(select UPPER(No_Kas) from PUMK_HEADER where UPPER(No_PUMK)=UPPER(i_No));
             UPDATE PUMK_HEADER SET APP_SDM='N',APP_SDM_OLEH=i_UserId,no_kas='' where upper(No_PUMK)=Upper(i_No);
           Else
             RAISE EXCEPTION '~~Pembatalan Gagal, Data sudah di Approval';
           End if;
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
        DB::statement("DROP FUNCTION appr_batal_pumk");
    }
}
