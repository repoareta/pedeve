<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VRincibiayakontroler extends Migration
{
    public function up()
    {
        DB::statement("CREATE VIEW v_rincibiayakontroler AS
                        select tahun, bulan, supbln suplesi, ci mu, jb, account sandi, lokasi lapangan, 0 last_rp, 0 last_dl, sum(coalesce(totpricerp,0)) cur_rp, sum(coalesce(totprice,0)) cur_dl, sum(coalesce(totpricerp,0)) cum_rp, sum(coalesce(totpricedl,0)) cum_dl from fiosd201 where ci='2' and account like '5%' group by tahun, bulan, supbln, account, jb, ci,lokasi union all select tahun, bulan, supbln suplesi, ci mu, jb, account sandi, lokasi lapangan, 0 last_rp, 0 last_dl, sum(coalesce(totpricerp,0)) cur_rp, 0 cur_dl, sum(coalesce(totpricerp,0)) cum_rp, 0 cum_dl from fiosd201 where ci='1' and account like '5%' group by tahun, bulan, supbln, account, jb, ci,lokasi
                        ");
    }
    public function down()
    {
        DB::statement("DROP VIEW v_rincibiayakontroler");
    }
}
