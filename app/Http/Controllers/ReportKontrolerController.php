<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SdmMasterPegawai;
use DB;
use PDF;
use Excel;
use Alert;

class ReportKontrolerController extends Controller
{
    public function create_d2_perbulan()
    {
        $data_tahun = DB::select("select max(tahun||bulan||supbln) as sbulan from fiosd201");
        $data_kodelok = DB::select("select kodelokasi,nama from mdms");
        $data_sanper = DB::select("select kodeacct,descacct from account where length(kodeacct)=6 and kodeacct not like '%X%' order by kodeacct desc");
        return view('report_kontroler.create_d2_perbulan',compact('data_tahun','data_kodelok','data_sanper'));
    }
    public function Cetak1(Request $request)
    {
        $thnbln = $request->tahun.''.$request->bulan;
        if($request->jk == "1"){
            $jk = "in ('10','11','13')";
        }elseif($request->jk == "2"){
            $jk = "in ('15','18')";
        }else{
            $jk = "in ('10','11','13','15','18')";
        }

        if($request->lp == "KL"){
            $tahun = $request->tahun;
            if($request->bulan <> ""){
                $bulan ="in ('$request->bulan')";
            }else{
                $bulan ="in ('01','02','03','04','05','06','07','08','09','10','11','12')";
            }

            if($request->sanper == ""){
                $data_list = DB::select("select b.docno,substring(b.thnbln from 1 for 4) as tahun,substring(b.thnbln from 5 for 2) as bulan,b.jk,b.store,b.voucher,b.ci,b.paiddate as tglbayar,b.rate,a.lineno,a.account,a.lokasi,a.bagian,a.cj,round(a.totprice,2) as totprice,a.keterangan 
                                        from kasline a join kasdoc b on b.docno=a.docno 
                                        where b.jk $jk and substring(b.thnbln from 1 for 4)='$tahun' and substring(b.thnbln from 5 for 2) $bulan and a.keterangan <> 'penutup'");
            }else{
                $sanper = "like '$request->sanper'";
                $data_list = DB::select("select b.docno,substring(b.thnbln from 1 for 4) as tahun,substring(b.thnbln from 5 for 2) as bulan,b.jk,b.store,b.voucher,b.ci,b.paiddate as tglbayar,b.rate,a.lineno,a.account,a.lokasi,a.bagian,a.cj,round(a.totprice,2) as totprice,a.keterangan 
                                        from kasline a join kasdoc b on b.docno=a.docno 
                                        where b.jk $jk and substring(b.thnbln from 1 for 4)='$tahun' and substring(b.thnbln from 5 for 2) $bulan and a.account $sanper and a.keterangan <> 'penutup'");
            }
        
        }else{
            $lp = "$request->lp";
            $tahun = "$request->tahun";
            if($request->bulan <> ""){
                $bulan = "in ('$request->bulan')";
            }else{
                $bulan ="in ('01','02','03','04','05','06','07','08','09','10','11','12')";
            }
            if($request->sanper == ""){
                $data_list = DB::select("select b.docno,substring(b.thnbln from 1 for 4) as tahun,substring(b.thnbln from 5 for 2) as bulan,b.jk,b.store,b.voucher,b.ci,b.paiddate as tglbayar,b.rate,a.lineno,a.account,a.lokasi,a.bagian,a.cj,round(a.totprice,2) as totprice,a.keterangan 
                                        from kasline a join kasdoc b on b.docno=a.docno 
                                        where b.jk $jk and substring(b.thnbln from 1 for 4)='$tahun' and substring(b.thnbln from 5 for 2) $bulan and a.lokasi='$lp' and a.keterangan <> 'penutup'");

            }else{
            $sanper = "like '$request->sanper'";
                $data_list = DB::select("select b.docno,substring(b.thnbln from 1 for 4) as tahun,substring(b.thnbln from 5 for 2) as bulan,b.jk,b.store,b.voucher,b.ci,b.paiddate as tglbayar,b.rate,a.lineno,a.account,a.lokasi,a.bagian,a.cj,round(a.totprice,2) as totprice,a.keterangan 
                                        from kasline a join kasdoc b on b.docno=a.docno 
                                        where b.jk $jk and substring(b.thnbln from 1 for 4)='$tahun' and substring(b.thnbln from 5 for 2) $bulan and a.account $sanper and a.lokasi='$lp' and a.keterangan <> 'penutup'");
            }
        }
        // dd($data_list);
        if(!empty($data_list)){
            set_time_limit(1200);
            // return view('report_kontroler.export_report1',compact('request','data_list'));
            $pdf = PDF::loadview('report_kontroler.export_report1',compact('request','data_list'))->setPaper('a4', 'Portrait');
            $pdf->output();
            $dom_pdf = $pdf->getDomPDF();

            $canvas = $dom_pdf ->get_canvas();
            $canvas->page_text(485, 100, "Halaman {PAGE_NUM} Dari {PAGE_COUNT}", null, 10, array(0, 0, 0)); //lembur landscape
            // return $pdf->download('rekap_umk_'.date('Y-m-d H:i:s').'.pdf');
            return $pdf->stream();
        }else{
            Alert::info("Tidak ditemukan data dengan Bulan/Tahun: $request->bulan/$request->tahun ", 'Failed')->persistent(true);
            return redirect()->route('report_kontroler.create1');
        }
    }

    public function create_d2_periode()
    {
        $data_tahun = DB::select("select max(tahun||bulan||supbln) as sbulan from fiosd201");
        $data_kodelok = DB::select("select kodelokasi,nama from mdms");
        $data_sanper = DB::select("select kodeacct,descacct from account where length(kodeacct)=6 and kodeacct not like '%X%' order by kodeacct desc");
        return view('report_kontroler.create_d2_periode',compact('data_tahun','data_kodelok','data_sanper'));
    }
    public function create_d5_report()
    {
        $data_tahun = DB::select("select max(tahun||bulan||supbln) as sbulan from fiosd201");
        $data_kodelok = DB::select("select kodelokasi,nama from mdms");
        $data_sanper = DB::select("select kodeacct,descacct from account where length(kodeacct)=6 and kodeacct not like '%X%' order by kodeacct desc");
        return view('report_kontroler.create_d5_report',compact('data_tahun','data_kodelok','data_sanper'));
    }
    public function create_neraca_konsolidasi()
    {
        $data_tahun = DB::select("select max(tahun||bulan||supbln) as sbulan from fiosd201");
        $data_kodelok = DB::select("select kodelokasi,nama from mdms");
        $data_sanper = DB::select("select kodeacct,descacct from account where length(kodeacct)=6 and kodeacct not like '%X%' order by kodeacct desc");
        return view('report_kontroler.create_neraca_konsolidasi',compact('data_tahun','data_kodelok','data_sanper'));
    }
    public function create_neraca_detail()
    {
        $data_tahun = DB::select("select max(tahun||bulan||supbln) as sbulan from fiosd201");
        $data_kodelok = DB::select("select kodelokasi,nama from mdms");
        $data_sanper = DB::select("select kodeacct,descacct from account where length(kodeacct)=6 and kodeacct not like '%X%' order by kodeacct desc");
        return view('report_kontroler.create_neraca_detail',compact('data_tahun','data_kodelok','data_sanper'));
    }
    public function create_laba_rugi_konsolidasi()
    {
        $data_tahun = DB::select("select max(tahun||bulan||supbln) as sbulan from fiosd201");
        $data_kodelok = DB::select("select kodelokasi,nama from mdms");
        $data_sanper = DB::select("select kodeacct,descacct from account where length(kodeacct)=6 and kodeacct not like '%X%' order by kodeacct desc");
        return view('report_kontroler.create_laba_rugi_konsolidasi',compact('data_tahun','data_kodelok','data_sanper'));
    }
    public function create_laba_rugi_detail()
    {
        $data_tahun = DB::select("select max(tahun||bulan||supbln) as sbulan from fiosd201");
        $data_kodelok = DB::select("select kodelokasi,nama from mdms");
        $data_sanper = DB::select("select kodeacct,descacct from account where length(kodeacct)=6 and kodeacct not like '%X%' order by kodeacct desc");
        return view('report_kontroler.create_laba_rugi_detail',compact('data_tahun','data_kodelok','data_sanper'));
    }
    public function create_laporan_keuangan()
    {
        $data_tahun = DB::select("select max(tahun||bulan||supbln) as sbulan from fiosd201");
        $data_kodelok = DB::select("select kodelokasi,nama from mdms");
        $data_sanper = DB::select("select kodeacct,descacct from account where length(kodeacct)=6 and kodeacct not like '%X%' order by kodeacct desc");
        return view('report_kontroler.create_laporan_keuangan',compact('data_tahun','data_kodelok','data_sanper'));
    }
    public function create_biaya_pegawai()
    {
        $data_tahun = DB::select("select max(tahun||bulan||supbln) as sbulan from fiosd201");
        $data_kodelok = DB::select("select kodelokasi,nama from mdms");
        $data_sanper = DB::select("select kodeacct,descacct from account where length(kodeacct)=6 and kodeacct not like '%X%' order by kodeacct desc");
        return view('report_kontroler.create_biaya_pegawai',compact('data_tahun','data_kodelok','data_sanper'));
    }
    
}
