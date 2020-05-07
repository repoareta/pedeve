<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SdmMasterPegawai;
use App\Models\Ttable;
use App\Models\Rekapkas;
use App\Models\Kasdoc;
use DB;
use PDF;
use Excel;
use Alert;

class RekapHarianKasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rekap_harian_kas.index');
    }

    public function searchIndex(Request $request)
    {
        $data_tahunbulan = DB::select("select max(thnbln) as bulan_buku from timetrans where status='1' and length(thnbln)='6'");
        if(!empty($data_tahunbulan)){
            foreach($data_tahunbulan as $data_bul)
            {
                $bulan_buku = $data_bul->bulan_buku;
            }
        }else{
            $bulan_buku = '000000';
        }  
            
        if($request->nama == ""){
            $data = DB::select("select a.jk, a.store, ltrim(to_char(a.rekap,'000')) as no, to_date(trim(to_char(a.tglrekap,'dd/mm/yyyy')),'dd/mm/yyyy') as stglrekap, a.saldoawal*-1 as saldoawal, a.debet*-1 as debet, kredit, a.saldoakhir*-1 as saldoakhir, b.namabank as nama_store   from rekapkas a join storejk b on a.store=b.kodestore where to_char(a.tglrekap,'yyyymm') = '$bulan_buku' order by a.tglrekap desc");
        }elseif($request->nama <> ""){
            $data = DB::select("select a.jk, a.store, ltrim(to_char(a.rekap,'000')) as no, to_date(trim(to_char(a.tglrekap,'dd/mm/yyyy')),'dd/mm/yyyy') as stglrekap, a.saldoawal*-1 as saldoawal, a.debet*-1 as debet, kredit, a.saldoakhir*-1 as saldoakhir, b.namabank as nama_store   from rekapkas a join storejk b on a.store=b.kodestore where a.store='$request->nama' order by a.tglrekap desc");
        }	
            return datatables()->of($data)
            ->addColumn('jk', function ($data) {
                return $data->jk;
           })
            ->addColumn('store', function ($data) {
                return $data->store.' -- '.$data->nama_store;
           })
            ->addColumn('no', function ($data) {
                return $data->no;
           })
            ->addColumn('tglrekap', function ($data) {
                $tgl = date_create($data->stglrekap);
                return date_format($tgl, 'd F Y');
           })
            ->addColumn('saldoawal', function ($data) {
                 return 'Rp. '.number_format($data->saldoawal,2,'.',',');
           })
            ->addColumn('debet', function ($data) {
                 return 'Rp. '.number_format($data->debet,2,'.',',');
           })
            ->addColumn('kredit', function ($data) {
                 return 'Rp. '.number_format($data->kredit,2,'.',',');
           })
            ->addColumn('saldoakhir', function ($data) {
                 return 'Rp. '.number_format($data->saldoakhir,2,'.',',');
           })
    
            ->addColumn('radio', function ($data) {
                $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" jk="" nokas=""  tanggal="" class="btn-radio" name="btn-radio-rekap"><span></span></label>'; 
                return $radio;
            })
            ->rawColumns(['radio'])
            ->make(true);
    }

    public function create()
    {
        return view('rekap_harian_kas.create');
    }

    public function JeniskaruJson(Request $request)
    {
        $datas = DB::select("select distinct jk from kasdoc where paid='Y' and to_char(paiddate,'yyyy-mm-dd') ='$request->tanggal' order by jk");
       if(!empty($datas)){
           return response()->json($datas[0]);
        }else{
            $data = 1;
            return response()->json($data);
       }
    }
    public function NokasJson(Request $request)
    {
        $datas = DB::select("select distinct a.store,b.namabank,b.norekening from kasdoc a,storejk b where a.store=b.kodestore and b.jeniskartu='$request->jk' and a.PAID='Y' and to_char(a.paiddate,'yyyy-mm-dd') = '$request->tanggal' order by a.store");
       if(!empty($datas)){
            $html = '';
            foreach ($datas as $data) {
                $html .= '<option value="'.$data->store.'">'.$data->store.' -- '.$data->namabank.'</option>';
            }
            return response()->json(['html' => $html]);
        }else{
            $data = 1;
            return response()->json($data);
       }
    }
    
    public function store(Request $request)
    {
        $jk = $request->jk;
        $nokas = $request->nokas;
        $tanggal = $request->tanggal;
	
        Ttable::where( 't_date', $tanggal)->update([
                't_date' => $tanggal
            ]);
        
	    $data_rsrekapkas = DB::select("select * from rekapkas where jk='$jk' and store='$nokas' and to_char(tglrekap,'yyyy-mm-dd')='$tanggal'");
        if(!empty($data_rsrekapkas)){
            $data_cekbulbuk = DB::select("select h.docno,to_char(h.paiddate,'yyyy-mm-dd') as stglrekap,h.voucher,h.thnbln,h.paiddate, h.store, d.keterangan, d.cj , -d.totprice totprice,posted,rate, h.jk from kasdoc h, kasline d where h.docno=d.docno and h.store='$nokas' and h.jk='$jk' and to_char(h.paiddate,'yyyy-mm-dd')='$tanggal' and d.penutup<>'Y' and h.paid ='Y' order by h.voucher");
            foreach($data_cekbulbuk as $data_cek)
            {
                   if(stbbuku("$data_cek->thnbln","0") > 1){
                    $data2 = 2;
                    return response()->json($data2);//rekap gagal !
                   }
            }
         
            $data_rsdatemin = DB::select("select min(paiddate) as datemin from kasdoc h where paiddate not in (select tglrekap from rekapkas where store='$nokas' and jk='$jk') and store='$nokas' and jk='$jk'");
            foreach($data_rsdatemin as $data_rsdat)
            {
                if($data_rsdat->datemin <> "" ){
                    $data3 = 3;
                    return response()->json($data3);//rekap harian sudah dilakukan sebelumnya, rekap gagal!
                }
            }
            $datars = DB::select("select tglrekap as datemax, rekap as norekap from rekapkas where store='$nokas' and jk='$jk' order by tglrekap desc");
        if(!empty($datars)){
            foreach($datars as $datar)
            {
                $norekap = $datar->norekap;
                if($norekap == "999"){
                   $norekap = 0;
                }
                if($datar->datemax  == ""){
                    $selrekapdate = 1;
                }
            }
        }else{
            $selrekapdate = 1;
            $norekap = 0;
        }
	    
		

          $datasetrs = DB::select("select saldoakhir from rekapkas where store='$nokas' and jk='$jk' and tglrekap= (select max(tglrekap) from rekapkas where store='$nokas' and jk='$jk')");
          if(!empty($datasetrs)){
              foreach($datasetrs as $datasetr)
              {
                  $saldoawal = round(vbildb($datasetr->saldoakhir));
              }
          }else{
            $data_saaldoakhir = DB::select("select saldoakhir from saldostore where nokas='$nokas' and jk='$jk'");
            foreach($data_saaldoakhir as $data_saaldo)
              {
                  if(!empty($data_saaldoakhir)){
                      $storeak= $data_saaldo->saldoakhir;
                  }else{
                    $storeak=0; 
                  }
                  $saldoawal = round(vbildb($storeak));
              }
            }		
            $data_jumlah = DB::select("select sum(d.totprice) as jumlah from kasdoc h, kasline d where h.docno=d.docno and h.store='$nokas' and h.jk='$jk' and to_char(h.paiddate,'yyyy-mm-dd')='$tanggal' and d.penutup<>'Y' and h.paid='Y' group by d.docno,h.ci,d.totprice");
            foreach($data_jumlah as $data_jum)
            {
                if($data_jum->jumlah <= 0){
                    $debet = $data_jum->jumlah;
                }else{
                    $kredit = $data_jum->jumlah;
                }

            }
            $tglrekap = date_create($tanggal);
            $rekapyear = date_format($tglrekap, 'Y');
            Rekapkas::insert([
                'jk' => $jk,
                'tglrekap' => $tanggal,
                'store' => $nokas,
                'saldoawal' => $saldoawal,
                'saldoakhir' => $saldoawal + $debet + $kredit,
                'debet' => $debet,
                'kredit' => $kredit,
                'userid' => $request->userid,
                'password' => $request->userid,
                'rekap' => $norekap+1,
                'tahun_rekap' => $rekapyear
                ]);
            
            $datarskasdoc = DB::select("select docno, rekap, rekapdate from kasdoc where to_char(paiddate,'yyyy-mm-dd')='$tanggal'");
            foreach($datarskasdoc as $datarskas)
            {
                Kasdoc::where('docno', $datarskas->docno)
                ->update([
                'rekap' => $norekap+1,
                'rekapdate' => $tanggal
                ]);
            }
            $data = 1;
            return response()->json($data); 
        }else{
            $data4 = 4;
            return response()->json($data4);//rekap kas sudah dilakukan!
        }
    }

}
