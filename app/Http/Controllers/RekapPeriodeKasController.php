<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SdmMasterPegawai;
use App\Models\Ttable;
use App\Models\Rekapkas;
use App\Models\Kasdoc;
use App\Models\Kasline;
use DB;
use DomPDF;
use Excel;
use Alert;

class RekapPeriodeKasController extends Controller
{
    public function create()
    {
        return view('rekap_periode_kas.rekap');
    }

     public function RekapPeriode()
    {
        $data_jk  = DB::select("select distinct jk from kasdoc where paid='Y'");
        $data_nokas  = DB::select("select distinct a.store,b.namabank,b.norekening from kasdoc a,storejk b where a.store=b.kodestore and a.PAID='Y'");
        return view('rekap_periode_kas.rekap',compact('data_jk','data_nokas'));
    }
    public function exportPeriode(Request $request)
    {
        $data_vd = DB::select("select min(tglrekap) v_d1, max(tglrekap)  v_d2 from rekapkas where (to_char( tglrekap,'yyyy-mm-dd') between '$request->tanggal' and '$request->tanggal2') and  jk='$request->jk' and store='$request->nokas'");
        if(!empty($data_vd)){
            foreach($data_vd as $data_vdd)
            {
                $a = date_create($data_vdd->v_d1);
                $v_d1 = date_format($a, 'Y-m-d');
                $b = date_create($data_vdd->v_d2);
                $v_d2 = date_format($b, 'Y-m-d');
                // dd($v_d1);
                if (is_null($data_vdd->v_d1)) {
                    $v_saw =0;
                }else{
                    $data_a = DB::select("select -round(s.saldoawal,2)  v_saw  from rekapkas s where to_char( s.tglrekap,'yyyy-mm-dd') = '$v_d1' and jk='$request->jk' and store='$request->nokas'");
                    if(!empty($data_a)){
                        foreach($data_a as $data)
                        {
                            $v_saw = $data->v_saw;
                        }
                    }else{
                        $v_saw =0;
                    }
                }

                if (is_null($data_vdd->v_d1)) {
                    $v_sak =0;
                }else{
                    $data_a = DB::select("select -round(s.saldoakhir,2) v_sak  from rekapkas s where to_char( tglrekap,'yyyy-mm-dd') = '$v_d2' and jk='$request->jk' and store='$request->nokas'");
                    if(!empty($data_a)){
                        foreach($data_a as $data)
                        {
                            $v_sak = $data->v_sak;
                        }
                    }else{
                        $v_sak =0;
                    }
                }
            }
        }else{
            Alert::info("Data Tidak Ditemukan", 'Failed')->persistent(true);
            return redirect()->route('rekap_periode_kas.create');
        }


        DB::statement("DROP VIEW IF EXISTS v_report_rekapkas_bebas CASCADE");
        DB::statement("CREATE OR REPLACE VIEW v_report_rekapkas_bebas AS
                        select ltrim(to_char(rk.rekap,'000')) No_Rekap, to_char(rk.tglrekap,'dd/mm/yyyy') Tanggal_Rekap, rk.jk Jenis_Kartu, (rk.store||' ('||s.namabank||')') Lokasi_Kas_Bank, s.norekening No_Rekening, (d.ci||' ('||mu.namamu||')') Mata_Uang, l.docno as No_Dokumen, d.voucher as No_Bukti, l.keterangan as uraian_penjelasan, l.LOKASI, L.cj, CASE WHEN sign(l.totprice) = '-1' then abs(l.totprice) else '0' end Debet, CASE WHEN -sign(l.totprice) = 1 then 0 else l.totprice end Kredit, $v_saw Saldo_Awal, $v_sak Saldo_Akir from rekapkas rk, kasdoc d, kasline l, storejk s, matauang mu where to_char( rk.tglrekap,'yyyy-mm-dd')=to_char( d.PAIDdate,'yyyy-mm-dd') and rk.store=s.kodestore and rk.store=d.store and rk.jk=d.jk and d.docno=l.docno and coalesce(l.penutup,'N')='N' and d.ci=mu.kodemu and coalesce(d.paid,'N')='Y' And to_char( rk.tglrekap,'yyyy-mm-dd') Between '$request->tanggal' AND '$request->tanggal2' and rk.jk='$request->jk' and rk.store='$request->nokas' order by d.voucher, l.lineno;
                        ");
        $data_list = DB::select("select * from v_report_rekapkas_bebas");
        if(!empty($data_list)){
            $pdf = DomPDF::loadview('rekap_periode_kas.export_periode',compact('request','data_list'))->setPaper('a4', 'Portrait');
            $pdf->output();
            $dom_pdf = $pdf->getDomPDF();

            $canvas = $dom_pdf ->get_canvas();
            $canvas->page_text(430, 115, "({PAGE_NUM}) Dari {PAGE_COUNT}", null, 8, array(0, 0, 0)); //lembur landscape
            // return $pdf->download('rekap_umk_'.date('Y-m-d H:i:s').'.pdf');
            return $pdf->stream();
        }else{
            Alert::info("Data Tidak Ditemukan", 'Failed')->persistent(true);
            return redirect()->route('rekap_periode_kas.create');
        }
    }

}
