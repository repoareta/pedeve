<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SdmMasterPegawai;
use App\Models\Ttable;
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
	
    
        Ttable::update([
                't_date' => $tanggal
            ]);
        
	    $data_rsrekapkas = DB::select("select * from rekapkas where jk='$jk' and store='$okas' and to_char(tglrekap,'yyyy-mm-dd')='$tanggal'");
        if(!empty($data_rsrekapkas)){
            $data_cekbulbuk = DB::select("select h.docno,to_char(h.paiddate,'yyyy-mm-dd') as stglrekap,h.voucher,h.thnbln,h.paiddate, h.store, d.keterangan, d.cj , -d.totprice totprice,posted,rate, h.jk from kasdoc h, kasline d where h.docno=d.docno and h.store='$nokas' and h.jk='$jk' and to_char(h.paiddate,'yyyy-mm-dd')='$tanggal' and d.penutup<>'Y' and h.paid ='Y' order by h.voucher");
            foreach($data_cekbulbuk as $data_cek)
            {
                if($data_cek->thnbln <> "" ){
                   if(stbbuku("$data_cek->thnbln","0") > 1){
                    $data = 1;
                    return response()->json($data);//rekap gagal !
                   }
                }
            }
         
            $data_rsdatemin = DB::select("select min(paiddate) as datemin from kasdoc h where paiddate not in (select tglrekap from rekapkas where store='$nokas' and jk='$jk') and store='$nokas' and jk='$jk'");
            foreach($data_rsdatemin as $data_rsdat)
            {
                if($data_rsdat->datemin <> "" ){
                    $data = 2;
                    return response()->json($data);//rekap harian sudah dilakukan sebelumnya, rekap gagal!
                }
            }
        }else{
            $data = 3;
            return response()->json($data);//rekap kas sudah dilakukan!
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
		$data_jumlah = DB::select("select sum(d.totprice) as jumlah from kasdoc h, kasline d where h.docno=d.docno and h.store='$nokas' and h.jk='$jk' and to_char(h.paiddate,'yyyy-mm-dd')=to_char($tanggal,'yyyy-mm-dd') and d.penutup<>'Y' and h.paid='Y' group by d.docno,h.ci,d.totprice");
        rs.movefirst
        do while not rs.eof
                if cdbl(rs("jumlah")) <= 0 then
                    debet = debet + cdbl(rs("jumlah"))
                else
                    kredit = kredit + cdbl(rs("jumlah"))
                end if
        rs.movenext
        loop
        
		set objrs = cn.execute("insert into rekapkas(jk,tglrekap,store,saldoawal,saldoakhir,debet,kredit,userid,password,rekap,tahun_rekap)values "&_
		"('"& jk &"',to_date('" & formattanggal(tanggal) & "', 'dd-mon-yyyy'),'"& nokas &"','"& cdbl(saldoawal) &"','"& cdbl(saldoawal + debet + kredit) &"','"& cdbl(debet) &"','"& cdbl(kredit) &"','"& userid &"','"& userid &"','"& angka3digit(cdbl(norekap) + 1) &"','"& tahunonly(tanggal) &"')")
        
		set rsrekapkas = cn.execute("select * from rekapkas where store='" & nokas & "' and jk='" & jk & "' and tglrekap=to_date('" & formattanggal(tanggal) & "', 'dd-mon-yyyy')")
        
        set rskasdoc = cn.execute("select docno, rekap, rekapdate from kasdoc where paiddate=to_date('" & formattanggal(tanggal) & "', 'dd-mon-yyyy')")
        if not rskasdoc.eof then
            rskasdoc.movefirst
            while not rskasdoc.eof
			    set updkasdoc = cn.execute("update kasdoc set rekap='"&angka3digit(cdbl(norekap) + 1)&"',rekapdate=to_date('" & formattanggal(tanggal) & "', 'dd-mon-yyyy') where docno='"&rskasdoc("docno")&"'")
                rskasdoc.movenext
            wend
        end if        
		response.write("<script>alert('rekap harian sukses!')</script>")  
        response.write("<script>window.location('default.asp?body=pbd_rekhar').reload()</script>")
    else
	    response.write("<script>alert('rekap harian ini sudah ada!')</script>")  
        response.write("<script>window.location('default.asp?body=pbd_rekhar').reload()</script>")
    end if
  end if	
end if
    }

}
