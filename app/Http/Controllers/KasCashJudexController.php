<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SdmMasterPegawai;
use DB;
use DomPDF;
use Excel;
use Alert;

class KasCashJudexController extends Controller
{
    public function Create1()
    {
        $data_tahun = DB::select("select max(tahun||bulan||supbln) as sbulan from fiosd201");
        $data_kodelok = DB::select("select kodelokasi,nama from mdms");
        $data_sanper = DB::select("select kodeacct,descacct from account where length(kodeacct)=6 and kodeacct not like '%x%' order by kodeacct desc");
        return view('kas_bank.report1', compact('data_kodelok', 'data_sanper', 'data_tahun'));
    }
    public function Cetak1(Request $request)
    {
        $thnbln = $request->tahun.''.$request->bulan;
        if ($request->jk == "1") {
            $jk = "in ('10','11','13')";
        } elseif ($request->jk == "2") {
            $jk = "in ('15','18')";
        } else {
            $jk = "in ('10','11','13','15','18')";
        }

        if ($request->lp == "KL") {
            $tahun = $request->tahun;
            if ($request->bulan <> "") {
                $bulan ="in ('$request->bulan')";
            } else {
                $bulan ="in ('01','02','03','04','05','06','07','08','09','10','11','12')";
            }

            if ($request->sanper == "") {
                $data_list = DB::select("select b.docno,substring(b.thnbln from 1 for 4) as tahun,substring(b.thnbln from 5 for 2) as bulan,b.jk,b.store,b.voucher,b.ci,b.paiddate as tglbayar,b.rate,a.lineno,a.account,a.lokasi,a.bagian,a.cj,round(a.totprice,2) as totprice,a.keterangan 
                                        from kasline a join kasdoc b on b.docno=a.docno 
                                        where b.jk $jk and substring(b.thnbln from 1 for 4)='$tahun' and substring(b.thnbln from 5 for 2) $bulan and a.keterangan <> 'penutup'");
            } else {
                $sanper = "like '$request->sanper'";
                $data_list = DB::select("select b.docno,substring(b.thnbln from 1 for 4) as tahun,substring(b.thnbln from 5 for 2) as bulan,b.jk,b.store,b.voucher,b.ci,b.paiddate as tglbayar,b.rate,a.lineno,a.account,a.lokasi,a.bagian,a.cj,round(a.totprice,2) as totprice,a.keterangan 
                                        from kasline a join kasdoc b on b.docno=a.docno 
                                        where b.jk $jk and substring(b.thnbln from 1 for 4)='$tahun' and substring(b.thnbln from 5 for 2) $bulan and a.account $sanper and a.keterangan <> 'penutup'");
            }
        } else {
            $lp = "$request->lp";
            $tahun = "$request->tahun";
            if ($request->bulan <> "") {
                $bulan = "in ('$request->bulan')";
            } else {
                $bulan ="in ('01','02','03','04','05','06','07','08','09','10','11','12')";
            }
            if ($request->sanper == "") {
                $data_list = DB::select("select b.docno,substring(b.thnbln from 1 for 4) as tahun,substring(b.thnbln from 5 for 2) as bulan,b.jk,b.store,b.voucher,b.ci,b.paiddate as tglbayar,b.rate,a.lineno,a.account,a.lokasi,a.bagian,a.cj,round(a.totprice,2) as totprice,a.keterangan 
                                        from kasline a join kasdoc b on b.docno=a.docno 
                                        where b.jk $jk and substring(b.thnbln from 1 for 4)='$tahun' and substring(b.thnbln from 5 for 2) $bulan and a.lokasi='$lp' and a.keterangan <> 'penutup'");
            } else {
                $sanper = "like '$request->sanper'";
                $data_list = DB::select("select b.docno,substring(b.thnbln from 1 for 4) as tahun,substring(b.thnbln from 5 for 2) as bulan,b.jk,b.store,b.voucher,b.ci,b.paiddate as tglbayar,b.rate,a.lineno,a.account,a.lokasi,a.bagian,a.cj,round(a.totprice,2) as totprice,a.keterangan 
                                        from kasline a join kasdoc b on b.docno=a.docno 
                                        where b.jk $jk and substring(b.thnbln from 1 for 4)='$tahun' and substring(b.thnbln from 5 for 2) $bulan and a.account $sanper and a.lokasi='$lp' and a.keterangan <> 'penutup'");
            }
        }
        // dd($data_list);
        if (!empty($data_list)) {
            set_time_limit(1200);
            // return view('kas_bank.export_report1',compact('request','data_list'));
            $pdf = DomPDF::loadview('kas_bank.export_report1', compact('request', 'data_list'))->setPaper('a4', 'Portrait');
            $pdf->output();
            $dom_pdf = $pdf->getDomPDF();

            $canvas = $dom_pdf ->get_canvas();
            $canvas->page_text(485, 100, "Halaman {PAGE_NUM} Dari {PAGE_COUNT}", null, 10, array(0, 0, 0)); //lembur landscape
            // return $pdf->download('rekap_umk_'.date('Y-m-d H:i:s').'.pdf');
            return $pdf->stream();
        } else {
            Alert::info("Tidak ditemukan data dengan Bulan/Tahun: $request->bulan/$request->tahun ", 'Failed')->persistent(true);
            return redirect()->route('kas_bank.create1');
        }
    }
    
    public function Create2()
    {
        $data_tahun = DB::select("select max(tahun||bulan) as thnbln from fiosd201");
        return view('kas_bank.report2', compact('data_tahun'));
    }
    public function Cetak2(Request $request)
    {
        $data_list = DB::select("select a.docno ,a.voucher ,a.rekapdate ,substring(a.thnbln from 1  for 4 ) as tahun,substring(a.thnbln  from 5  for 2 ) as bulan,b.lineno ,b.keterangan ,a.jk ,a.store ,a.ci ,a.rate ,a.voucher ,b.account ,coalesce(b.totprice,1)*CASE WHEN a.rate=0 THEN 1 WHEN a.rate IS NULL THEN 1  ELSE a.rate END as totprice ,b.area,b.lokasi ,b.bagian ,b.jb ,b.pk ,b.cj,a.rekap from kasdoc a join kasline b on a.docno=b.docno where  a.thnbln='202001' AND (coalesce(a.paid,'N') = 'Y' ) and coalesce(b.penutup,'N')<>'Y'");
        if (!empty($data_list)) {
            $pdf = DomPDF::loadview('kas_bank.export_report2', compact('request', 'data_list'))->setPaper('a4', 'Portrait');
            $pdf->output();
            $dom_pdf = $pdf->getDomPDF();

            $canvas = $dom_pdf ->get_canvas();
            $canvas->page_text(740, 115, "Halaman {PAGE_NUM} Dari {PAGE_COUNT}", null, 10, array(0, 0, 0)); //lembur landscape
            // return $pdf->download('rekap_umk_'.date('Y-m-d H:i:s').'.pdf');
            return $pdf->stream();
        } else {
            Alert::info("Tidak ditemukan data dengan Nopeg: $request->nopek Bulan/Tahun: $request->bulan/$request->tahun ", 'Failed')->persistent(true);
            return redirect()->route('kas_bank.Cetak2');
        }
    }
    
    public function Create3()
    {
        $data_tahun = DB::select("Select max(tahun||bulan) as thnbln from fiosd201");
        return view('kas_bank.report3', compact('data_tahun'));
    }
    public function Cetak3(Request $request)
    {
        $thnbln = $request->tahun.''.$request->bulan;
        $data_list = DB::select("select a.docno ,a.voucher ,a.rekapdate ,substring(a.thnbln from 1  for 4 ) as tahun,substring(a.thnbln  from 5  for 2 ) as bulan,b.lineno ,b.keterangan ,a.jk ,a.store ,a.ci ,a.rate ,a.voucher ,b.account ,coalesce(b.totprice,1)*CASE WHEN a.rate=0 THEN 1 WHEN a.rate IS NULL THEN 1  ELSE a.rate END as totprice ,b.area,b.lokasi ,b.bagian ,b.jb ,b.pk ,b.cj,a.rekap from kasdoc a join kasline b on a.docno=b.docno where  a.thnbln='$thnbln' AND (coalesce(a.paid,'N') = 'Y' ) and coalesce(b.penutup,'N')<>'Y'");
        if (!empty($data_list)) {
            $pdf = DomPDF::loadview('kas_bank.export_report3', compact('request', 'data_list'))->setPaper('a4', 'Portrait');
            $pdf->output();
            $dom_pdf = $pdf->getDomPDF();

            $canvas = $dom_pdf ->get_canvas();
            $canvas->page_text(485, 100, "Halaman {PAGE_NUM} Dari {PAGE_COUNT}", null, 10, array(0, 0, 0)); //lembur landscape
            // return $pdf->download('rekap_umk_'.date('Y-m-d H:i:s').'.pdf');
            return $pdf->stream('message-'.time());
        } else {
            Alert::info("Tidak ditemukan data dengan Bulan/Tahun: $request->bulan/$request->tahun ", 'Failed')->persistent(true);
            return redirect()->route('kas_bank.Cetak3');
        }
    }
    
    
    public function Create4()
    {
        $data_judex = DB::select("select kode,nama from cashjudex");
        return view('kas_bank.report4', compact('data_judex'));
    }
    public function Cetak4(Request $request)
    {
        $thnbln = $request->tahun.''.$request->bulan;
        $data_list = DB::select("select a.docno ,a.voucher ,a.rekapdate ,substring(a.thnbln from 1  for 4 ) as tahun,substring(a.thnbln  from 5  for 2 ) as bulan,b.lineno ,b.keterangan ,a.jk ,a.store ,a.ci ,a.rate ,a.voucher ,b.account ,coalesce(b.totprice,1)*CASE WHEN a.rate=0 THEN 1 WHEN a.rate IS NULL THEN 1  ELSE a.rate END as totprice ,b.area,b.lokasi ,b.bagian ,b.jb ,b.pk ,b.cj,a.rekap from kasdoc a join kasline b on a.docno=b.docno where  a.thnbln='$thnbln' and b.cj='$request->cj' AND (coalesce(a.paid,'N') = 'Y' ) and coalesce(b.penutup,'N')<>'Y'");
        if (!empty($data_list)) {
            $pdf = DomPDF::loadview('kas_bank.export_report4', compact('request', 'data_list'))->setPaper('a4', 'Portrait');
            $pdf->output();
            $dom_pdf = $pdf->getDomPDF();

            $canvas = $dom_pdf ->get_canvas();
            $canvas->page_text(485, 100, "Halaman {PAGE_NUM} Dari {PAGE_COUNT}", null, 10, array(0, 0, 0)); //lembur landscape
            // return $pdf->download('rekap_umk_'.date('Y-m-d H:i:s').'.pdf');
            return $pdf->stream();
        } else {
            Alert::info("Tidak ditemukan data dengan Bulan/Tahun: $request->bulan/$request->tahun ", 'Failed')->persistent(true);
            return redirect()->route('kas_bank.create4');
        }
    }
    
    
    public function Create5()
    {
        $data_judex = DB::select("select kode,nama from cashjudex");
        return view('kas_bank.report5', compact('data_judex'));
    }
    public function Cetak5(Request $request)
    {
        $thnbln = $request->tahun.''.$request->bulan;
        $data_list = DB::select("select a.docno ,a.voucher ,a.rekapdate ,substring(a.thnbln from 1  for 4 ) as tahun,substring(a.thnbln  from 5  for 2 ) as bulan,b.lineno ,b.keterangan ,a.jk ,a.store ,a.ci ,a.rate ,a.voucher ,b.account ,coalesce(b.totprice,1)*CASE WHEN a.rate=0 THEN 1 WHEN a.rate IS NULL THEN 1  ELSE a.rate END as totprice ,b.area,b.lokasi ,b.bagian ,b.jb ,b.pk ,b.cj,a.rekap from kasdoc a join kasline b on a.docno=b.docno where  a.thnbln='$thnbln' and b.cj='$request->cj' AND (coalesce(a.paid,'N') = 'Y' ) and coalesce(b.penutup,'N')<>'Y'");
        if (!empty($data_list)) {
            $pdf = DomPDF::loadview('kas_bank.export_report5', compact('request', 'data_list'))->setPaper('a4', 'Portrait');
            $pdf->output();
            $dom_pdf = $pdf->getDomPDF();

            $canvas = $dom_pdf ->get_canvas();
            $canvas->page_text(485, 100, "Halaman {PAGE_NUM} Dari {PAGE_COUNT}", null, 10, array(0, 0, 0)); //lembur landscape
            // return $pdf->download('rekap_umk_'.date('Y-m-d H:i:s').'.pdf');
            return $pdf->stream();
        } else {
            Alert::info("Tidak ditemukan data dengan Bulan/Tahun: $request->bulan/$request->tahun ", 'Failed')->persistent(true);
            return redirect()->route('kas_bank.create5');
        }
    }
    
    public function Create6()
    {
        $data_judex = DB::select("select kode,nama from cashjudex");
        return view('kas_bank.report6', compact('data_judex'));
    }
    public function Cetak6(Request $request)
    {
        $thnbln = $request->tahun.''.$request->bulan;
        $data_list = DB::select("select a.docno ,a.voucher ,a.rekapdate ,substring(a.thnbln from 1  for 4 ) as tahun,substring(a.thnbln  from 5  for 2 ) as bulan,b.lineno ,b.keterangan ,a.jk ,a.store ,a.ci ,a.rate ,a.voucher ,b.account ,coalesce(b.totprice,1)*CASE WHEN a.rate=0 THEN 1 WHEN a.rate IS NULL THEN 1  ELSE a.rate END as totprice ,b.area,b.lokasi ,b.bagian ,b.jb ,b.pk ,b.cj,a.rekap from kasdoc a join kasline b on a.docno=b.docno where  a.thnbln='$thnbln' and b.cj='$request->cj' AND (coalesce(a.paid,'N') = 'Y' ) and coalesce(b.penutup,'N')<>'Y'");
        if (!empty($data_list)) {
            $pdf = DomPDF::loadview('kas_bank.export_report6', compact('request', 'data_list'))->setPaper('a4', 'Portrait');
            $pdf->output();
            $dom_pdf = $pdf->getDomPDF();

            $canvas = $dom_pdf ->get_canvas();
            $canvas->page_text(485, 100, "Halaman {PAGE_NUM} Dari {PAGE_COUNT}", null, 10, array(0, 0, 0)); //lembur landscape
            // return $pdf->download('rekap_umk_'.date('Y-m-d H:i:s').'.pdf');
            return $pdf->stream();
        } else {
            Alert::info("Tidak ditemukan data dengan Bulan/Tahun: $request->bulan/$request->tahun ", 'Failed')->persistent(true);
            return redirect()->route('kas_bank.create6');
        }
    }

    // Report Cash Flow Internal
    public function Create7()
    {
        return view('kas_bank.report7');
    }

    /**
     * Cetak Report Cash Flow Internal
     *
     * @param Request $request
     * @return void
     */
    public function Cetak7(Request $request)
    {
        $tahun = $request->tahun;
        $bulan = $request->bulan;
        $kurs = $request->kurs;
        
        $data_list = null;

        $pdf = DomPDF::loadview('kas_bank.export_report7', compact('data_list', 'tahun', 'bulan'))
        ->setPaper('a4', 'Portrait');
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf ->get_canvas();
        $canvas->page_text(485, 100, "Halaman {PAGE_NUM} Dari {PAGE_COUNT}", null, 10, array(0, 0, 0));
        return $pdf->stream();
    }

    // Report Cash Flow Per Periode
    public function Create8()
    {
        return view('kas_bank.report8');
    }

    /**
     * Cetak Report Cash Flow Internal
     *
     * @param Request $request
     * @return void
     */
    public function Cetak8(Request $request)
    {
        $tahun = $request->tahun;
        $kurs = $request->kurs;
        $mulai = $request->mulai;
        $sampai = $request->sampai;
        
        $data_list = null;

        $pdf = DomPDF::loadview('kas_bank.export_report8', compact(
            'data_list',
            'tahun',
            'mulai',
            'sampai'
        ))
        ->setPaper('a4', 'Portrait');
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf ->get_canvas();
        $canvas->page_text(485, 100, "Halaman {PAGE_NUM} Dari {PAGE_COUNT}", null, 10, array(0, 0, 0));
        return $pdf->stream();
    }
}
