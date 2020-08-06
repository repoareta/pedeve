<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FCjSaLalu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE OR REPLACE FUNCTION f_cj_sa_lalu (i_CI text,i_CJ text,i_th text,i_bl text)  
        RETURNS bigint 
        AS ".'$body$'."
        DECLARE
        
          Result bigint;
          v_th varchar(4);
          v_bl varchar(4);
        
        BEGIN
          if i_bl='01' then
             v_bl := '12';
             v_th := TO_NUMBER(i_th, '9999') - 1;
          else
             v_bl := LTRIM(TO_CHAR(CAST ((TO_NUMBER(i_bl, '99') - 1) AS INTEGER), '09'));
             v_th := i_th;
          end if;
          if i_CI='1' Then
              Select sum(Saldo_Awal) into Result from cash_flow C Where C.Tahun=v_th and C.Bulan=v_bl And C.Cj=i_CJ;
          elsif i_CI='2' Then
              Select sum(Saldo_Awal_DL) into Result from cash_flow C Where C.Tahun=v_th and C.Bulan=v_bl And C.Cj=i_CJ;
          else
              Select sum(Saldo_Awal_DL_rp) into Result from cash_flow C Where C.Tahun=v_th and C.Bulan=v_bl And C.Cj=i_CJ;
          end if;
          return(Result);
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
        DB::statement("DROP VIEW f_cj_sa_lalu");
    }
}
