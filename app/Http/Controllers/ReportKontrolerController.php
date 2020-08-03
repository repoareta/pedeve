<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SdmMasterPegawai;
use DB;
use DomPDF;
use PDF;
use Excel;
use Alert;

class ReportKontrolerController extends Controller
{
    // select tahun, bulan, supbln suplesi, jk, store lokasi, vc voucher, ci mu, lokasi lapangan, account sandi, bagian, wono pk, jb, cj kk, (case when -sign(totpricerp)='1' then '0' else totpricerp end) debet_rp, (case when sign(totpricerp)='-1' then totpricerp else '0' end) kredit_rp, (case when -sign(totpricedl)='1' then '0' else totpricedl end) debet_dl, (case when sign(totpricedl)='-1' then totpricedl else '0' end) kredit_dl, rate kurs, rate_trans kurs_trans, rate_pajak kurs_pajak, totprice, totpricerp, totpricedl, keterangan from fiosd201 order by tahun||bulan||supbln, account, jk||store, vc, ci, sign(totprice);

    public function create_d2_perbulan()
    {
        $data_tahun = DB::select("select max(tahun||bulan||supbln) as sbulan from fiosd201");
        $data_kodelok = DB::select("select kodelokasi,nama from mdms");
        $data_sanper = DB::select("select kodeacct,descacct from account where length(kodeacct)=6 and kodeacct not like '%X%' order by kodeacct desc");
        return view('report_kontroler.create_d2_perbulan', compact('data_tahun', 'data_kodelok', 'data_sanper'));
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
            // return view('report_kontroler.export_report1',compact('request','data_list'));
            $pdf = DomPDF::loadview('report_kontroler.export_report1', compact('request', 'data_list'))->setPaper('a4', 'Portrait');
            $pdf->output();
            $dom_pdf = $pdf->getDomPDF();

            $canvas = $dom_pdf ->get_canvas();
            $canvas->page_text(485, 100, "Halaman {PAGE_NUM} Dari {PAGE_COUNT}", null, 10, array(0, 0, 0)); //lembur landscape
            // return $pdf->download('rekap_umk_'.date('Y-m-d H:i:s').'.pdf');
            return $pdf->stream();
        } else {
            Alert::info("Tidak ditemukan data dengan Bulan/Tahun: $request->bulan/$request->tahun ", 'Failed')->persistent(true);
            return redirect()->route('report_kontroler.create1');
        }
    }

    public function create_d2_periode()
    {
        $data_tahun = DB::select("select max(tahun||bulan||supbln) as sbulan from fiosd201");
        $data_kodelok = DB::select("select kodelokasi,nama from mdms");
        $data_sanper = DB::select("select kodeacct,descacct from account where length(kodeacct)=6 and kodeacct not like '%X%' order by kodeacct desc");
        return view('report_kontroler.create_d2_periode', compact('data_tahun', 'data_kodelok', 'data_sanper'));
    }
    public function create_d5_report()
    {
        $data_tahun = DB::select("select max(tahun||bulan||supbln) as sbulan from fiosd201");
        $data_kodelok = DB::select("select kodelokasi,nama from mdms");
        $data_sanper = DB::select("select kodeacct,descacct from account where length(kodeacct)=6 and kodeacct not like '%X%' order by kodeacct desc");
        return view('report_kontroler.create_d5_report', compact('data_tahun', 'data_kodelok', 'data_sanper'));
    }
    public function create_neraca_konsolidasi()
    {
        $data_tahun = DB::select("select max(tahun||bulan||supbln) as sbulan from fiosd201");
        $data_kodelok = DB::select("select kodelokasi,nama from mdms");
        return view('report_kontroler.create_neraca_konsolidasi', compact('data_tahun', 'data_kodelok'));
    }
    public function exportNeracaKonsolidasi(Request $request)
    {
        $tahun = $request->tahun;
        $thnblnsp = "$tahun$request->bulan$request->suplesi";
        $data_list = DB::select("select a.tahun, a.bulan, a.suplesi, a.ci mu, a.jb, a.account sandi,a.lokasi lapangan,coalesce(a.awalrp,0) last_rp, coalesce(a.awaldl,0) last_dl,a.pricerp cur_rp, a.pricedl cur_dl, a.totpricerp cum_rp, a.totpricedl cum_dl, m.* from obpsi_$tahun a, v_main_account m where substr(a.account,1,length(m.batas_awal)) between m.batas_awal and m.batas_akhir and strpos(m.lokasi,a.lokasi)>0 and a.lokasi like '*' union all
                                select b.tahun, b.bulan, b.supbln suplesi, b.ci mu, b.jb, b.account sandi,b.lokasi lapangan,0 last_rp, 0 last_dl,Sum(coalesce(b.TotpriceRp,0)) cur_rp, Sum(coalesce(b.TotPrice,0)) cur_dl, Sum(coalesce(b.TotpriceRp,0)) cum_rp,Sum(coalesce(b.TotpriceDl,0)) cum_dl,m.*  from fiosd201 b, v_main_account m where substr(b.account,1,length(m.batas_awal)) between m.batas_awal and m.batas_akhir and strpos(m.lokasi,b.lokasi)>0 and b.lokasi like '*' and ci='2'  and tahun = '$tahun' and tahun||bulan||supbln <= '$thnblnsp' group by b.tahun, b.bulan, b.supbln, b.account, b.jb, b.ci,b.lokasi,m.jenis,m.batas_awal,m.batas_akhir,m.urutan,m.pengali,m.pengali_tampil,m.sub_akun,m.lokasi,m.urutan_sc union all
                                select c.tahun, c.bulan, c.supbln suplesi, c.ci mu, c.jb, c.account sandi,c.lokasi lapangan,0 last_rp, 0 last_dl,Sum(coalesce(c.TotpriceRp,0)) cur_rp, 0 cur_dl, Sum(coalesce(c.TotpriceRp,0)) cum_rp, 0 cum_dl,m.* from fiosd201 c, v_main_account m where substr(c.account,1,length(m.batas_awal)) between m.batas_awal and m.batas_akhir and strpos(m.lokasi,c.lokasi)>0  and c.lokasi like 'MD' and ci='1'  and tahun = '$tahun' and tahun||bulan||supbln <= '$thnblnsp' group by c.tahun, c.bulan, c.supbln, c.account, c.jb, c.ci,c.lokasi,m.jenis,m.batas_awal,m.batas_akhir,m.urutan,m.pengali,m.pengali_tampil,m.sub_akun,m.lokasi,m.urutan_sc;
                                ");
        // dd($data_list);
        if (!empty($data_list)) {
            set_time_limit(1200);
            $pdf = DomPDF::loadview('report_kontroler.export_neraca_konsolidasi', compact('request', 'data_list'))->setPaper('a4', 'Portrait');
            $pdf->output();
            $dom_pdf = $pdf->getDomPDF();

            $canvas = $dom_pdf ->get_canvas();
            $canvas->page_text(485, 100, "Halaman {PAGE_NUM} Dari {PAGE_COUNT}", null, 10, array(0, 0, 0)); //lembur landscape
            // return $pdf->download('rekap_umk_'.date('Y-m-d H:i:s').'.pdf');
            return $pdf->stream();
        } else {
            Alert::info("Tidak ditemukan data dengan Bulan/Tahun: $request->bulan/$request->tahun ", 'Failed')->persistent(true);
            return redirect()->route('neraca_konsolidasi.create_neraca_konsolidasi');
        }
    }
    
    
    public function create_neraca_detail()
    {
        $data_tahun = DB::select("select max(tahun||bulan||supbln) as sbulan from fiosd201");
        $data_kodelok = DB::select("select kodelokasi,nama from mdms");
        $data_sanper = DB::select("select kodeacct,descacct from account where length(kodeacct)=6 and kodeacct not like '%X%' order by kodeacct desc");
        return view('report_kontroler.create_neraca_detail', compact('data_tahun', 'data_kodelok', 'data_sanper'));
    }
    public function create_laba_rugi_konsolidasi()
    {
        $data_tahun = DB::select("select max(tahun||bulan||supbln) as sbulan from fiosd201");
        $data_kodelok = DB::select("select kodelokasi,nama from mdms");
        $data_sanper = DB::select("select kodeacct,descacct from account where length(kodeacct)=6 and kodeacct not like '%X%' order by kodeacct desc");
        return view('report_kontroler.create_laba_rugi_konsolidasi', compact('data_tahun', 'data_kodelok', 'data_sanper'));
    }
    public function exportLabaRugiKonsolidasi(Request $request)
    {
        if ($request->lapangan <> "KL") {
            $lokasi = "m.lokasi = '$request->lapangan'";
            $tahun = "tahun = '$request->tahun'";
            $bulan = "bulan = '$request->bulan'";
            $suplesi = "suplesi = '$request->suplesi'";
            $thnbln = "2019$request->bulan$request->suplesi";
            $obpsi  = "obpsi_$request->tahun";
        } else {
            $lokasi = "m.lokasi in ('MD','MS')";
            $tahun = "tahun = '$request->tahun'";
            $bulan = "bulan = '$request->bulan'";
            $suplesi = "suplesi = '$request->suplesi'";
            $thnbln = "2019$request->bulan$request->suplesi";
            $obpsi  = "obpsi_$request->tahun";
        }
        $data_list = DB::select("
        select substr(a.account,1,3) as tigadigit, a.tahun, a.bulan, a.suplesi, a.ci mu, a.jb, a.account sandi,a.lokasi lapangan,coalesce(a.awalrp,0) last_rp, coalesce(a.awaldl,0) last_dl,a.pricerp cur_rp, a.pricedl cur_dl, a.totpricerp cum_rp, a.totpricedl cum_dl, m.* from $obpsi a, v_class_account m where substr(a.account,1,length(m.batas_awal)) between m.batas_awal and m.batas_akhir and strpos(m.lokasi,a.lokasi)>0 and $lokasi union all
        select substr(b.account,1,3) as tigadigit, b.tahun, b.bulan, b.supbln suplesi, b.ci mu, b.jb, b.account sandi,b.lokasi lapangan,0 last_rp, 0 last_dl,Sum(coalesce(b.TotpriceRp,0)) cur_rp, Sum(coalesce(b.TotPrice,0)) cur_dl, Sum(coalesce(b.TotpriceRp,0)) cum_rp,Sum(coalesce(b.TotpriceDl,0)) cum_dl,m.*  from fiosd201 b, v_class_account m where substr(b.account,1,length(m.batas_awal)) between m.batas_awal and m.batas_akhir and strpos(m.lokasi,b.lokasi)>0 and $lokasi and ci='2'  and $tahun and tahun||bulan||supbln <= '$thnbln' group by b.tahun, b.bulan, b.supbln, b.account, b.jb, b.ci,b.lokasi,m.jenis,m.batas_awal,m.batas_akhir,m.urutan,m.pengali,m.pengali_tampil,m.sub_akun,m.lokasi,m.urutan_sc union all
        select substr(c.account,1,3) as tigadigit, c.tahun, c.bulan, c.supbln suplesi, c.ci mu, c.jb, c.account sandi,c.lokasi lapangan,0 last_rp, 0 last_dl,Sum(coalesce(c.TotpriceRp,0)) cur_rp, 0 cur_dl, Sum(coalesce(c.TotpriceRp,0)) cum_rp, 0 cum_dl,m.* from fiosd201 c, v_class_account m where substr(c.account,1,length(m.batas_awal)) between m.batas_awal and m.batas_akhir and strpos(m.lokasi,c.lokasi)>0  and $lokasi and ci='1'  and $tahun and tahun||bulan||supbln <= '$thnbln' group by c.tahun, c.bulan, c.supbln, c.account, c.jb, c.ci,c.lokasi,m.jenis,m.batas_awal,m.batas_akhir,m.urutan,m.pengali,m.pengali_tampil,m.sub_akun,m.lokasi,m.urutan_sc
        ");
        if (!empty($data_list)) {
            set_time_limit(1200);
            $pdf = DomPDF::loadview('report_kontroler.export_laba_rugi_konsolidasi', compact('request', 'data_list'))->setPaper('a4', 'Portrait');
            $pdf->output();
            $dom_pdf = $pdf->getDomPDF();
        
            $canvas = $dom_pdf ->get_canvas();
            // $canvas->page_text(485, 100, "Halaman {PAGE_NUM} Dari {PAGE_COUNT}", null, 10, array(0, 0, 0)); //lembur landscape
            // return $pdf->download('rekap_umk_'.date('Y-m-d H:i:s').'.pdf');
            return $pdf->stream();
        } else {
            Alert::info("Tidak ditemukan data dengan Bulan $request->bulan Tahun: $request->tahun ", 'Failed')->persistent(true);
            return redirect()->route('laba_rugi_konsolidasi.create_laba_rugi_konsolidasi');
        }
    }

    public function create_laba_rugi_detail()
    {
        $data_tahun = DB::select("select max(tahun||bulan||supbln) as sbulan from fiosd201");
        $data_kodelok = DB::select("select kodelokasi,nama from mdms");
        $data_sanper = DB::select("select kodeacct,descacct from account where length(kodeacct)=6 and kodeacct not like '%X%' order by kodeacct desc");
        return view('report_kontroler.create_laba_rugi_detail', compact('data_tahun', 'data_kodelok', 'data_sanper'));
    }
    public function exportLabaRugiDetail(Request $request)
    {
        if ($request->lapangan <> "KL") {
            $lokasi = "m.lokasi like '$request->lapangan'";
            $tahun = "tahun = '$request->tahun'";
            $bulan = "bulan = '$request->bulan'";
            $suplesi = "suplesi = '$request->suplesi'";
            $thnbln = "$request->tahun$request->bulan$request->suplesi";
            $obpsi  = "obpsi_$request->tahun";
        } else {
            $lokasi = "m.lokasi like 'MS%'";
            $tahun = "tahun = '$request->tahun'";
            $bulan = "bulan = '$request->bulan'";
            $suplesi = "suplesi = '$request->suplesi'";
            $thnbln = "$request->tahun$request->bulan$request->suplesi";
            $obpsi  = "obpsi_$request->tahun";
        }
        $data_list = DB::select("
        select substr(a.account,1,3) as tigadigit, a.account sandi,a.lokasi lapangan, Sum(coalesce(a.TotpriceRp,0)) cum_rp,Sum(coalesce(a.TotpriceRp,0)) cur_rp,sum(coalesce(a.awalrp,0)) last_rp, m.pengali_tampil, m.sub_akun from $obpsi a, v_class_account m where substr(a.account,1,length(m.batas_awal)) between m.batas_awal and m.batas_akhir and strpos(m.lokasi,a.lokasi)>0 and $lokasi group by a.account,a.lokasi, m.sub_akun,m.pengali_tampil union all
        select substr(b.account,1,3) as tigadigit, b.account sandi,b.lokasi lapangan, Sum(coalesce(b.TotpriceRp,0)) cum_rp,Sum(coalesce(b.TotpriceRp,0)) cur_rp,m.pengali_tampil,0 last_rp, m.sub_akun  from fiosd201 b, v_class_account m where substr(b.account,1,length(m.batas_awal)) between m.batas_awal and m.batas_akhir and strpos(m.lokasi,b.lokasi)>0 and $lokasi and ci='2'  and $tahun and tahun||bulan||supbln <= '$thnbln' group by b.account,b.lokasi, m.sub_akun,m.pengali_tampil union all
        select substr(c.account,1,3) as tigadigit, c.account sandi,c.lokasi lapangan,Sum(coalesce(c.TotpriceRp,0)) cum_rp,Sum(coalesce(c.TotpriceRp,0)) cur_rp,m.pengali_tampil,0 last_rp, m.sub_akun from fiosd201 c, v_class_account m where substr(c.account,1,length(m.batas_awal)) between m.batas_awal and m.batas_akhir and strpos(m.lokasi,c.lokasi)>0  and $lokasi and ci='1'  and $tahun and tahun||bulan||supbln <= '$thnbln' group by c.account,c.lokasi,m.sub_akun,m.pengali_tampil
        ");
        if (!empty($data_list)) {
            set_time_limit(1200);
            $pdf = DomPDF::loadview('report_kontroler.export_laba_rugi_detail', compact('request', 'data_list'))->setPaper('a4', 'Portrait');
            $pdf->output();
            $dom_pdf = $pdf->getDomPDF();
        
            $canvas = $dom_pdf ->get_canvas();
            // $canvas->page_text(485, 100, "Halaman {PAGE_NUM} Dari {PAGE_COUNT}", null, 10, array(0, 0, 0)); //lembur landscape
            // return $pdf->download('rekap_umk_'.date('Y-m-d H:i:s').'.pdf');
            return $pdf->stream();
        } else {
            Alert::info("Tidak ditemukan data dengan Bulan $request->bulan Tahun: $request->tahun ", 'Failed')->persistent(true);
            return redirect()->route('laba_rugi_detail.create_laba_rugi_detail');
        }
    }

    public function create_laporan_keuangan()
    {
        $data_tahun = DB::select("select max(tahun||bulan||supbln) as sbulan from fiosd201");
        $data_kodelok = DB::select("select kodelokasi,nama from mdms");
        $data_sanper = DB::select("select kodeacct,descacct from account where length(kodeacct)=6 and kodeacct not like '%X%' order by kodeacct desc");
        return view('report_kontroler.create_laporan_keuangan', compact('data_tahun', 'data_kodelok', 'data_sanper'));
    }
    public function create_biaya_pegawai()
    {
        $data_tahun = DB::select("select max(tahun||bulan||supbln) as sbulan from fiosd201");
        $data_kodelok = DB::select("select kodelokasi,nama from mdms");
        $data_sanper = DB::select("select kodeacct,descacct from account where length(kodeacct)=6 and kodeacct not like '%X%' order by kodeacct desc");
        return view('report_kontroler.create_biaya_pegawai', compact('data_tahun', 'data_kodelok', 'data_sanper'));
    }
    public function exportBiayaPegawai(Request $request)
    {
        if ($request->lapangan == "KL") {
            $yyy = "tahun = '$request->tahun'";
            $sss = "bulan <= '$request->bulan2' and bulan >= '$request->bulan1'";
            $zzz = ("$yyy and $sss");
        } else {
            $bbb = "lapangan = '$request->lapangan'";
            $yyy = "tahun = '$request->tahun'";
            $sss = "bulan <= '$request->bulan2' and bulan >= '$request->bulan1'";
            $zzz = ("$bbb and $yyy and $sss");
        }
        $data_list = DB::select("select *, substr(sandi,1,2) as duadigit,substr(sandi,1,3) as tigadigit from v_rincibiayakontroler where substr(sandi,1,3) between '500' and '519' and $zzz");
        if (!empty($data_list)) {
            set_time_limit(1200);
            $pdf = DomPDF::loadview('report_kontroler.export_biaya_pegawai', compact('request', 'data_list'))->setPaper('a4', 'Portrait');
            $pdf->output();
            $dom_pdf = $pdf->getDomPDF();
        
            $canvas = $dom_pdf ->get_canvas();
            $canvas->page_text(485, 100, "Halaman {PAGE_NUM} Dari {PAGE_COUNT}", null, 10, array(0, 0, 0)); //lembur landscape
            // return $pdf->download('rekap_umk_'.date('Y-m-d H:i:s').'.pdf');
            return $pdf->stream();
        } else {
            Alert::info("Tidak ditemukan data dengan Bulan $request->bulan1 S/D $request->bulan2 Tahun: $request->tahun ", 'Failed')->persistent(true);
            return redirect()->route('biaya_pegawai.create_biaya_pegawai');
        }
    }


    public function d2PerBulanExport(Request $request)
    {
        $tahun = $request->tahun;
        $bulan = $request->bulan;

        $d2_list =  DB::table('fiosd201')
        ->select(
            'tahun',
            'bulan',
            'supbln AS suplesi',
            'jk',
            'store AS lokasi',
            'vc AS voucher',
            'ci AS mu',
            'lokasi AS lapangan',
            'account AS sandi',
            'bagian',
            'wono AS pk',
            'jb',
            'cj AS kk',
            // decode(-sign(totpricerp),1,0,totpricerp) debet_rp,
            // decode(sign(totpricerp),-1,totpricerp,0) kredit_rp,
            // decode(-sign(totpricedl),1,0,totpricedl) debet_dl,
            // decode(sign(totpricedl),-1,totpricedl,0) kredit_dl,
            'rate AS kurs',
            'rate_trans AS kurs_trans',
            'rate_pajak AS kurs_pajak',
            'totprice',
            'totpricerp',
            'totpricedl',
            'keterangan'
        )
        ->where('tahun', $request->tahun)
        ->where('bulan', $request->bulan)
        ->where('supbln', $request->suplesi)
        ->where('lokasi', $request->lp)
        ->where('jk', $request->jk)
        ->orderBy('tahun', 'DESC')
        ->orderBy('bulan', 'DESC')
        ->orderBy('supbln', 'DESC')
        ->orderBy('account', 'DESC')
        ->orderBy('jk', 'DESC')
        ->orderBy('store', 'DESC')
        ->orderBy('vc', 'DESC')
        ->orderBy('ci', 'DESC')
        // ->limit(25)
        ->get();

        $pdf = DomPDF::loadview('report_kontroler.export_d2_perbulan_pdf', compact(
            'd2_list',
            'tahun',
            'bulan'
        ))
        ->setPaper('a4', 'landscape')
        ->setOptions(['isPhpEnabled' => true]);

        return $pdf->stream('rekap_d2_perbulan_'.date('Y-m-d H:i:s').'.pdf');
    }

    public function d2PerPeriodeExport(Request $request)
    {
        $tahun = $request->tahun;
        $bulan = $request->bulan;

        $d2_list =  DB::table('fiosd201')
        ->select(
            'tahun',
            'bulan',
            'supbln AS suplesi',
            'jk',
            'store AS lokasi',
            'vc AS voucher',
            'ci AS mu',
            'lokasi AS lapangan',
            'account AS sandi',
            'bagian',
            'wono AS pk',
            'jb',
            'cj AS kk',
            // decode(-sign(totpricerp),1,0,totpricerp) debet_rp,
            // decode(sign(totpricerp),-1,totpricerp,0) kredit_rp,
            // decode(-sign(totpricedl),1,0,totpricedl) debet_dl,
            // decode(sign(totpricedl),-1,totpricedl,0) kredit_dl,
            'rate AS kurs',
            'rate_trans AS kurs_trans',
            'rate_pajak AS kurs_pajak',
            'totprice',
            'totpricerp',
            'totpricedl',
            'keterangan'
        )
        ->where('tahun', $request->tahun)
        ->where('bulan', $request->bulan)
        ->where('supbln', $request->suplesi)
        ->where('lokasi', $request->lp)
        ->where('jk', $request->jk)
        ->get();

        $pdf = PDF::loadview('report_kontroler.export_d2_perbulan_pdf', compact(
            'd2_list',
            'tahun',
            'bulan'
        ))
        ->setPaper('a4', 'landscape')
        ->setOptions(['isPhpEnabled' => true]);

        return $pdf->stream('rekap_d2_perperiode_'.date('Y-m-d H:i:s').'.pdf');
    }

    public function laporanKeuanganExport(Request $request)
    {
        $calk_list = null;
        $pdf = PDF::loadview('report_kontroler.export_laporan_keuangan_pdf', compact(
            'calk_list',
            'tahun',
            'bulan'
        ))
        ->setPaper('a4', 'potrait')
        ->setOptions(['isPhpEnabled' => true]);

        return $pdf->stream('rekap_d2_perperiode_'.date('Y-m-d H:i:s').'.pdf');
    }
}
