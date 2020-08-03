<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VReportRekapkasHarian extends Migration
{
    public function up()
    {
        DB::statement("CREATE VIEW v_report_rekapkas_harian AS
                        select ltrim(to_char(rk.rekap,'000')) No_Rekap, to_char(rk.tglrekap,'yyyy-mm-dd') Tanggal_Rekap, rk.jk Jenis_Kartu, (rk.store||' ('||s.namabank||')') Lokasi_Kas_Bank, s.norekening No_Rekening, (d.ci||' ('||mu.namamu||')') Mata_Uang, l.docno as No_Dokumen, d.voucher as No_Bukti, l.keterangan as uraian_penjelasan,  CASE WHEN sign(l.totprice) = '-1' then abs(l.totprice) else '0' end  Debet, CASE WHEN -sign(l.totprice) = 1 then 0 else l.totprice end Kredit, -rk.saldoawal Saldo_Awal, -rk.saldoakhir Saldo_Akir from rekapkas rk, kasdoc d, kasline l, storejk s, matauang mu where to_char( rk.tglrekap,'yyyy-mm-dd')=to_char( d.PAIDdate,'yyyy-mm-dd') and rk.store=s.kodestore and rk.store=d.store and rk.jk=d.jk and d.docno=l.docno and coalesce(l.penutup,'N')='N' and d.ci=mu.kodemu and coalesce(d.paid,'N')='Y' order by d.voucher, l.lineno");
    }
    public function down()
    {
        DB::statement("DROP VIEW v_report_rekapkas_harian");
    }
}
