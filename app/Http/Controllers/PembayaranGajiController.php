<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kasdoc;
use App\Models\Storejk;
use App\Models\SdmKdbag;
use App\Models\Kasline;
use App\Models\Lokasi;
use App\Models\JenisBiaya;
use App\Models\Cashjudex;
use App\Models\Mtrdeposito;
use App\Models\Dtldepositotest;
use App\Models\Saldostore;
use App\Models\StatusBayarGaji;
use Auth;
use DB;
use Session;
use PDF;
use Alert;

class PembayaranGajiController extends Controller
{
    public function index()
    {
        $data_tahunbulan = DB::select("select max(thnbln) as bulan_buku from timetrans where status='1' and length(thnbln)='6'");
            if(!empty($data_tahunbulan)) {
                foreach ($data_tahunbulan as $data_bul) {
                    $tahun = substr($data_bul->bulan_buku,0,-2); 
                    $bulan = substr($data_bul->bulan_buku,4); 
                }
            }else{
                $bulan ='00';
                $tahun ='0000';
            }
        return view('pembayaran_gaji.index',compact('tahun','bulan'));
    }

    public function searchIndex(Request $request)
    {
        $data_rsbulan = DB::select("select max(thnbln) as thnbln from timetrans where status='1' and length(thnbln)=6");
        if(!empty($data_rsbulan)){
            foreach($data_rsbulan as $rsbulan)
            {
                if(is_null($rsbulan->thnbln)){
                    $thnblopen = "";
                }else{
                    $thnblopen = $rsbulan->thnbln;
                }
            }
        }else{
            $thnblopen = "";
        }
        $s = $thnblopen;
        $nodok = $request->bukti;
        $tahun = $request->tahun;
        $bulan = $request->bulan;
        if($nodok == "" and $tahun=="" and $bulan==""){
            $data = DB::select("select (select namabank from storejk where kodestore=a.store and ci=a.ci) as namastore, a.docno,a.originaldate,a.thnbln,a.jk,a.store,a.ci,a.voucher,a.kepada,a.rate,a.verified,a.nilai_dok,a.paid from kasdoc a where thnbln='$s' and a.kd_kepada LIKE 'PG%' order by a.store,a.voucher asc");
            $data_objrs2 = DB::select("select sum(nilai_dok) as jml from kasdoc where thnbln='$s' and kd_kepada='PG'");
            if(!empty($data_objrs2)){
             foreach($data_objrs2 as $objrs2)
             {
                 $jumlahnya =$objrs2->jml;
             }
            }else{
                $jumlahnya = 0;
            }
        }elseif($nodok <> "" and $tahun=="" and $bulan==""){
            $data = DB::select("select (select namabank from storejk where kodestore=a.store and ci=a.ci) as namastore, a.docno,a.originaldate,a.thnbln,a.jk,a.store,a.ci,a.voucher,a.kepada,a.rate,a.verified,a.nilai_dok,a.paid from kasdoc a where a.voucher='$nodok' and a.kd_kepada LIKE 'PG%' order by a.store,a.voucher asc");
            $data_objrs2 = DB::select("select sum(nilai_dok) as jml from kasdoc where voucher='$nodok' and kd_kepada='PG'");
            if(!empty($data_objrs2)){
             foreach($data_objrs2 as $objrs2)
             {
                 $jumlahnya =$objrs2->jml;
             }
            }else{
                $jumlahnya = 0;
            }
        
        }elseif($nodok <> "" and $tahun <> "" and $bulan == ""){
            $data = DB::select("select (select namabank from storejk where kodestore=a.store and ci=a.ci) as namastore, a.docno,a.originaldate,a.thnbln,a.jk,a.store,a.ci,a.voucher,a.kepada,a.rate,a.verified,a.nilai_dok,a.paid from kasdoc a where a.voucher='$nodok' and left(a.thnbln, 4)='$tahun' and a.kd_kepada LIKE 'PG%' order by a.store,a.voucher asc");
            $data_objrs2 = DB::select("select sum(nilai_dok) as jml from kasdoc where voucher='$nodok' and left(thnbln, 4)='$tahun' and kd_kepada='PG'");
            if(!empty($data_objrs2)){
             foreach($data_objrs2 as $objrs2)
             {
                 $jumlahnya =$objrs2->jml;
             }
            }else{
                $jumlahnya = 0;
            }
        }elseif($nodok == "" and $tahun <> "" and $bulan == ""){
            $data = DB::select("select (select namabank from storejk where kodestore=a.store and ci=a.ci) as namastore, a.docno,a.originaldate,a.thnbln,a.jk,a.store,a.ci,a.voucher,a.kepada,a.rate,a.nilai_dok as nilai_dok,a.verified,a.paid from kasdoc a where left(thnbln, 4)='$tahun'  and a.kd_kepada LIKE 'PG%' order by a.store,a.voucher asc ");
            $data_objrs2 = DB::select("select sum(nilai_dok) as jml from kasdoc where left(thnbln, 4)='$tahun' and kd_kepada='PG'");
            if(!empty($data_objrs2)){
             foreach($data_objrs2 as $objrs2)
             {
                 $jumlahnya =$objrs2->jml;
             }
            }else{
                $jumlahnya = 0;
            }
        }elseif($nodok == "" and $tahun <> "" and $bulan <> ""){
            $data = DB::select("select (select namabank from storejk where kodestore=a.store and ci=a.ci) as namastore, a.docno,a.originaldate,a.thnbln,a.jk,a.store,a.ci,a.voucher,a.kepada,a.rate,a.nilai_dok as nilai_dok,a.verified,a.paid from kasdoc a where left(thnbln, 4)='$tahun' and SUBSTRING(thnbln, 5, 2)='$bulan' and a.kd_kepada LIKE 'PG%' order by a.store,a.voucher asc ");
            $data_objrs2 = DB::select("select sum(nilai_dok) as jml from kasdoc where left(thnbln, 4)='$tahun' and SUBSTRING(thnbln, 5, 2)='$bulan' and kd_kepada='PG'");
            if(!empty($data_objrs2)){
             foreach($data_objrs2 as $objrs2)
             {
                 $jumlahnya =$objrs2->jml;
             }
            }else{
                $jumlahnya = 0;
            }
        }elseif($nodok == "" and $tahun == "" and $bulan <> ""){
            $data = DB::select("select (select namabank from storejk where kodestore=a.store and ci=a.ci) as namastore, a.docno,a.originaldate,a.thnbln,a.jk,a.store,a.ci,a.voucher,a.kepada,a.rate,a.nilai_dok as nilai_dok,a.verified,a.paid from kasdoc a where SUBSTRING(thnbln, 5, 2)='$bulan' and a.kd_kepada LIKE 'PG%' order by a.store,a.voucher asc ");
            $data_objrs2 = DB::select("select sum(nilai_dok) as jml from kasdoc where  SUBSTRING(thnbln, 5, 2)='$bulan' and kd_kepada='PG'");
            if(!empty($data_objrs2)){
             foreach($data_objrs2 as $objrs2)
             {
                 $jumlahnya =$objrs2->jml;
             }
            }else{
                $jumlahnya = 0;
            }
        }else{
            $data = DB::select("select (select namabank from storejk where kodestore=a.store and ci=a.ci) as namastore, a.docno,a.originaldate,a.thnbln,a.jk,a.store,a.ci,a.voucher,a.kepada,a.rate,a.verified,a.nilai_dok,a.paid from kasdoc a where a.voucher='$nodok' and left(a.thnbln, 4)='$tahun' and SUBSTRING(thnbln, 5, 2)='$bulan' and a.kd_kepada LIKE 'PG%' order by a.store,a.voucher asc");
            $data_objrs2 = DB::select("select sum(nilai_dok) as jml from kasdoc where voucher='$nodok' and left(thnbln, 4)='$tahun' and SUBSTRING(thnbln, 5, 2)='$bulan' and kd_kepada='PG'");
            if(!empty($data_objrs2)){
             foreach($data_objrs2 as $objrs2)
             {
                 $jumlahnya =$objrs2->jml;
             }
            }else{
                $jumlahnya = 0;
            }   
        }	
        return datatables()->of($data)
        ->addColumn('docno', function ($data) {
            return $data->docno;
       })
        ->addColumn('tanggalinput', function ($data) {
            $tgl = date_create($data->originaldate);
            return date_format($tgl, 'd/m/Y');
       })
        ->addColumn('nobukti', function ($data) {
            return $data->voucher;
       })
        ->addColumn('kepada', function ($data) {
            return $data->kepada;
       })
        ->addColumn('jk', function ($data) {
            return $data->jk;
       })
        ->addColumn('nokas', function ($data) {
            return $data->store.' -- '.$data->namastore;
       })
        ->addColumn('ci', function ($data) {
            return $data->ci;
       })
        ->addColumn('kurs', function ($data) {
            return $data->rate;
       })
        ->addColumn('nilai', function ($data) {
            if($data->nilai_dok  == ""){
                $nilai = 0;
            }else{
                $nilai = number_format($data->nilai_dok,2,'.',',');
            }
            return $nilai;
       })
        ->addColumn('radio', function ($data) {
            $radio = '<center><label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" value="'.$data->docno.'" class="btn-radio" name="btn-radio"><span></span></label></center>'; 
            return $radio;
        })
        ->addColumn('action', function ($data) {
            if($data->verified == 'Y'){
                $action = '<p align="center"><span style="font-size: 2em;" class="kt-font-success pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Data Sudah DiVerifikasi"><i class="fas fa-check-circle" ></i></span></p>';
            }else{
                if($data->paid == 'Y'){
                    $action = '<p align="center"><a href="'. route('pembayaran_gaji.approv',['id' => str_replace('/', '-', $data->docno),'status' => $data->paid]).'"><span style="font-size: 2em;" class="kt-font-warning pointer-link" data-toggle="kt-tooltip" data-placement="top"  title="Batalkan Pembayaran"><i class="fas fa-check-circle" ></i></span></a></p>';
                }else{
                    $action = '<p align="center"><a href="'. route('pembayaran_gaji.approv',['id' => str_replace('/', '-', $data->docno),'status' => $data->paid]).'"><span style="font-size: 2em;" class="kt-font-danger pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Klik untuk Pembayaran"><i class="fas fa-ban" ></i></span></a></p>';
                }
            }
            return $action;
        })
        ->rawColumns(['radio','action'])
        ->make(true); 
    }

    public function create()
    {
        $data_tahunbulan = DB::select("select max(thnbln) as bulan_buku from timetrans where status='1' and length(thnbln)='6'");
        if(!empty($data_tahunbulan)){
            foreach($data_tahunbulan as $data_bul)
            {   if($data_bul->bulan_buku <> null){
                $bulan_buku = $data_bul->bulan_buku;

                }else{
                    $bulan_buku = date_format( date_create(now()), 'Ym');
                }
            }
        }else {
            $bulan_buku = date_format( date_create(now()), 'Ym');
        }
        $mp = 'P';
        if($mp == "P"){
            $darkep = "Kepada";
            $datas = DB::select("Select Max(left(mrs_no,4)) as nover from Kasdoc Where substr(DocNo,1,1)='P' and left(THNBLN,4)='$bulan_buku'");
            foreach($datas as $data)
            {
                if($data->nover <> null){
                    $da = '2'.$data->nover+1;
                    $nover = substr($da,1,4);
                }else {
                    $nover = '0001';
                }
            }
        }else{
            $darkep = "Dari";
            $nover = '0';
        }
        $data_tahunbulan = DB::select("select max(thnbln) as bulan_buku from timetrans where status='1' and length(thnbln)='6'");
        if(!empty($data_tahunbulan)){
            foreach($data_tahunbulan as $data_bul)
            {   if($data_bul->bulan_buku <> null){
                $bulan_buku = $data_bul->bulan_buku;

                }else{
                    $bulan_buku = date_format( date_create(now()), 'Ym');
                }
            }
        }else {
            $bulan_buku = date_format( date_create(now()), 'Ym');
        }
        $bulan = substr($bulan_buku,4);
        $tahun = substr($bulan_buku,0,-2);
        $data_bagian = SdmKdbag::all();
        return view('pembayaran_gaji.create',compact('mp','data_bagian','tahun','bulan','bulan_buku','darkep','nover'));
    }

    public function createJson(Request $request)
    {
        $datas = DB::select("Select MAX(SUBSTR(docno,13,3)) as id from Kasdoc where SUBSTR(docno,3,5)='$request->bagian' and thnbln='$request->bulanbuku' and SUBSTR(docno,1,1)='$request->mp'");
        if(!empty($datas)){
            foreach($datas as $dataa)
            {
                if($dataa->id <> null){
                    $data = $dataa->id;
                }else {
                    $data = '000';
                }
            }
        }else {
            $data = '000';
        }
        return response()->json($data);
    }
    public function lokasiJson(Request $request)
    {
        $data= DB::select("select a.kodestore,a.namabank,a.norekening from storejk a where a.jeniskartu ='$request->jk' and a.ci='$request->ci' order by a.kodestore");
        return response()->json($data);
    }

    public function nobuktiJson(Request $request)
    {
        $datas = DB::select("select max(voucher) as nb from kasdoc where SUBSTR(thnbln,1,4)='$request->tahun' and store='$request->lokasi' and SUBSTR(docno,1,1)='$request->mp'");
        if(!empty($datas)){
            foreach($datas as $dataa)
            {
                if($dataa->nb <> null){
                    $da = '2'.$dataa->nb+1;
                    $data = substr($da,1,4);
                }else {
                    $data = '0001';
                }
            }
        }else {
            $data = '0001';
        }
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $data_tahunbulan = DB::select("select max(thnbln) as bulan_buku from timetrans where status='1' and length(thnbln)='6'");
        if(!empty($data_tahunbulan)){
            foreach($data_tahunbulan as $data_bul)
            {   if($data_bul->bulan_buku <> null){
                $bulan_buku = $data_bul->bulan_buku;

                }else{
                    $bulan_buku = '0';
                }
            }
        }else {
            $bulan_buku = '0';
        }
        $data_status = DB::select("select * from timetrans where thnbln='$bulan_buku' and suplesi='0'");
        if(!empty($data_status)){
            foreach($data_status as $data_st)
            {   if($data_st->status == '1'){
                $stbbuku = 'gtopening';
                }elseif($data_st->status == '2'){
                    $stbbuku = 'gtstopping';
                }elseif($data_st->status == '3'){
                    $stbbuku = 'gtclosing';
                }else {
                    $stbbuku = 'gtnone';
                }
            }
        }else {
            $stbbuku = 'gtnone';
        }

        $mp = $request->mp;
        $bagian = $request->bagian;
        $nomor =$request->nomor;
        $scurrdoc = $mp.'/'.$bagian.'/'.$nomor;
        $docno = $scurrdoc;
        $thnbln = $request->bulanbuku;
        $jk = $request->jk;
        $store = $request->lokasi;
        $ci = $request->ci;
        $voucher = $request->nobukti;	  
        $kepada = $request->kepada;
        $debet = "0";
        $kredit = "0";
        $original = "Y";
        $originaldate = $request->tanggal;
        $verified = "N";
        $paid = "N";
        $posted = "N";
        $inputdate = $request->tanggal;
        $inputpwd = $request->userid;
        $updatedate = $request->tanggal;
        $updatepwd = $request->userid;
        $rate = $request->kurs;
        $nilai_dok = $request->nilai;
        $originalby = $request->userid;
        $ket1 = $request->ket1;
        $ket2 = $request->ket2;
        $ket3 = $request->ket3;
        $kodekepada = 'PG';
        $nover = $request->nover;
        if($stbbuku == 'gtopening'){ 
            
            $data_cek = DB::select("select * from kasdoc where docno='$docno'");
            if(!empty($data_cek)){
                $data=0;
                return response()->json($data);
            }else {     
            Kasdoc::insert([
                'docno' =>  $docno,
                'thnbln' =>  $thnbln,
                'jk' =>  $jk,
                'store' =>  $store,
                'ci' =>  $ci,
                'voucher' =>  $voucher,
                'kepada' =>  $kepada,
                'debet'  => '0',
                'kredit'  => '0',
                'original' =>  $original,
                'originaldate' =>  $originaldate,
                'verified' =>  $verified,
                'paid' =>  $paid,
                'posted' =>  $posted,
                'inputdate' =>  $inputdate,
                'inputpwd' =>  $inputpwd,
                'updatedate' =>  $updatedate,
                'updatepwd' =>  $updatepwd,
                'rate' =>  $rate,
                'nilai_dok' =>  $nilai_dok,
                'originalby' =>  $originalby,
                'ket1' =>  $ket1,
                'ket2' =>  $ket2,
                'ket3' =>  $ket3,
                'kd_kepada' =>  $kodekepada,
                'mrs_no' =>  $nover ,           
                ]);
                $data = 1;
                return response()->json($data);
            }
        }else{
            $data=2;
            return response()->json($data);
        }

    }

    public function edit($id)
    {
        $nodoc=str_replace('-', '/', $id);
        $data_list =DB::table('kasdoc')
        ->join('storejk', 'kasdoc.store', '=', 'storejk.kodestore')
        ->select('kasdoc.*', 'storejk.*')
        ->where('kasdoc.docno',$nodoc)
        ->get();
        $datenew = date('Y-m-d');
        $tgl = date_create($datenew);
        $tahuns = date_format($tgl, 'Y');
        $bulans = date_format($tgl, 'n');
        $lokasi = Lokasi::all();
        $data_jenis = JenisBiaya::all();
        $data_casj = Cashjudex::all();
        $data_bagian = SdmKdbag::all();
        $data_rincian = DB::select("select p.tahun, p.bulan,sum(p.nilai) as nilai,'TETAP' as status from pay_master_upah p where tahun='$tahuns' and bulan='$bulans' and nilai<>0 and nopek in (select nopeg from sdm_master_pegawai where status='C') group by tahun,bulan union all
                                    select p.tahun, p.bulan,sum(p.nilai) as nilai,'KONTRAK' as status from pay_master_upah p where tahun='$tahuns' and bulan='$bulans' and nilai<>0 and nopek in (select nopeg from sdm_master_pegawai where status='K') group by tahun,bulan union all
                                    select p.tahun, p.bulan,sum(p.nilai) as nilai,'PERBANTUAN' as status from pay_master_upah p where tahun='$tahuns' and bulan='$bulans' and nilai<>0 and nopek in (select nopeg from sdm_master_pegawai where status='B') group by tahun,bulan union all
                                    select p.tahun, p.bulan,sum(p.nilai) as nilai,'KOMISARIS' as status from pay_master_upah p where tahun='$tahuns' and bulan='$bulans' and nilai<>0 and nopek in (select nopeg from sdm_master_pegawai where status='U') group by tahun,bulan union all
                                    select p.tahun, p.bulan, sum(p.nilai) as nilai,'KOMITE' as status from pay_master_upah p where tahun='$tahuns' and bulan='$bulans' and nilai<>0 and nopek in (select nopeg from sdm_master_pegawai where status='O') group by tahun,bulan;
                                    ");
        $data_account = DB::select("select kodeacct,descacct from account where length(kodeacct)=6 and kodeacct not like '%X%'");
        $count= Kasline::where('docno',$nodoc)->sum('totprice');
        $data_detail = Kasline::where('docno',$nodoc)->get();
        $no_detail = Kasline::where('docno',$nodoc)->max('lineno');
        if($no_detail <> null){
            $no_urut = $no_detail + 1;
        }else {
            $no_urut = 1;
        }
        return view('pembayaran_gaji.edit',compact(
            'data_rincian',
            'data_list',
            'data_bagian',
            'data_detail',
            'count',
            'no_urut',
            'lokasi',
            'data_account',
            'data_jenis',
            'data_casj',
            'tahuns',
            'bulans'
        ));
    }
    public function update(Request $request)
    {
        Kasdoc::where('docno', $request->nodok)
            ->update([
                'thnbln' =>  $request->bulanbuku,
                'jk' =>  $request->jk,
                'store' =>  $request->lokasi,
                'ci' =>  $request->ci,
                'voucher' =>  $request->nobukti,
                'kepada' =>  $request->kepada,
                'rate' =>  $request->kurs,
                'nilai_dok' =>  $request->nilai,
                'ket1' =>  $request->ket1,
                'ket2' =>  $request->ket2,
                'ket3' =>  $request->ket3,
                'mrs_no' =>  $request->nover , 
            ]);
            return response()->json();
    }

    public function storeDetail(Request $request)
    {
        $tahun = $request->tahun;
        $bulans = $request->bulan;
        $bulan = ltrim($request->bulan,0);
        $thnbln = $tahun.''.$bulans;
        $docno = $request->nodok;
        $data_cek = DB::select("select * from kasline where docno='$request->nodok' and lineno='$request->nourut'");
        if(!empty($data_cek)){
            $data = 2;
            return response()->json($data);
        }else{
            $data_crtetap = DB::select("select p.tahun, p.bulan,p.aard,sum(p.nilai) as nilai,'TETAP' as status from pay_master_upah p where tahun='$tahun' and bulan='$bulan' and nilai<>0 and nopek in (select nopeg from sdm_master_pegawai where status='C') group by tahun,bulan,aard");
            $data_crkontrak = DB::select("select p.tahun, p.bulan,p.aard,sum(p.nilai) as nilai,'KONTRAK' as status from pay_master_upah p where tahun='$tahun' and bulan='$bulan' and nilai<>0 and nopek in (select nopeg from sdm_master_pegawai where status='K') group by tahun,bulan,aard");
            $data_crbantu = DB::select("select p.tahun, p.bulan,p.aard,sum(p.nilai) as nilai,'PERBANTUAN' as status from pay_master_upah p where tahun='$tahun' and bulan='$bulan' and nilai<>0 and nopek in (select nopeg from sdm_master_pegawai where status='B') group by tahun,bulan,aard");
            $data_crkom = DB::select("select p.tahun, p.bulan,p.aard,sum(p.nilai) as nilai,'KOMISARIS' as status from pay_master_upah p where tahun='$tahun' and bulan='$bulan' and nilai<>0 and nopek in (select nopeg from sdm_master_pegawai where status='U') group by tahun,bulan,aard");
            $data_crkomite = DB::select("select p.tahun, p.bulan,p.aard, sum(p.nilai) as nilai,'KOMITE' as status from pay_master_upah p where tahun='$tahun' and bulan='$bulan' and nilai<>0 and nopek in (select nopeg from sdm_master_pegawai where status='O') group by tahun,bulan,aard");

                if($request->status == 'TETAP'){
                    foreach($data_crtetap as $t)
                    {
                        $data_no = DB::select("select max(lineno) as v_no from kasline where docno='$docno'");
                        if(!empty($data_no)){
                            foreach($data_no as $no)
                            {
                                $v_nomor = $no->v_no+1;
                            }
                        }else{
                            $v_nomor =1;
                        }
                        $data_aard = DB::select("select * from pay_tbl_aard where kode='$t->aard'");
                        if(!empty($data_aard)){
                            foreach($data_aard as $data_a)
                            {
                                $v_nama = $data_a->nama ;
                                $v_sandi = $data_a->sanper ;
                                $v_cj = $data_a->cj ;
                                $v_jb = $data_a->jb ;
                            }
                        }else{
                            $v_nama ="";
                            $v_sandi ="";
                            $v_cj ="";
                            $v_jb ="";
                        }
                        Kasline::insert([
                            'docno' =>  $docno,
                            'lineno' =>  $v_nomor,
                            'account' =>  $v_sandi,
                            'area' =>  '0',
                            'lokasi'  => 'MS',
                            'bagian' =>  'B2000',
                            'pk' =>  '000000',
                            'jb' =>  $v_jb,
                            'cj' =>  $v_cj,
                            'totprice'  =>  $t->nilai,
                            'keterangan'  =>  $v_nama,
                            'penutup' => 'N',
                            'ref_no' => $thnbln
                            ]);
                    }
                    $v_jenis ='PGT';
                }elseif($request->status == 'KONTRAK'){
                    foreach($data_crkontrak as $t)
                    {
                        $data_no = DB::select("select max(lineno) as v_no from kasline where docno='$docno'");
                        if(!empty($data_no)){
                            foreach($data_no as $no)
                            {
                                $v_nomor = $no->v_no+1;
                            }
                        }else{
                            $v_nomor =1;
                        }
                       
                        $data_aard = DB::select("select * from pay_tbl_aard where kode='$t->aard'");
                        if(!empty($data_aard)){
                            foreach($data_aard as $data_a)
                            {
                                $v_nama = $data_a->nama ;
                                $v_sandi = $data_a->sanperpwt ;
                                $v_cj = $data_a->cj ;
                                $v_jb = $data_a->jb ;
                            }
                        }else{
                            $v_nama ="";
                            $v_sandi ="";
                            $v_cj ="";
                            $v_jb ="";
                        }
                        Kasline::insert([
                            'docno' =>  $docno,
                            'lineno' =>  $v_nomor,
                            'account' =>  $v_sandi,
                            'area' =>  '0',
                            'lokasi'  => 'MS',
                            'bagian' =>  'B2000',
                            'pk' =>  '000000',
                            'jb' =>  $v_jb,
                            'cj' =>  $v_cj,
                            'totprice'  =>  $t->nilai,
                            'keterangan'  =>  $v_nama,
                            'penutup' => 'N',
                            'ref_no' => $thnbln
                            ]);
                    }
                    $v_jenis ='PGK';
                }elseif($request->status == 'PERBANTUAN'){
                    foreach($data_crbantu as $t)
                    {
                        $data_no = DB::select("select max(lineno) as v_no from kasline where docno='$docno'");
                        if(!empty($data_no)){
                            foreach($data_no as $no)
                            {
                                $v_nomor = $no->v_no+1;
                            }
                        }else{
                            $v_nomor =1;
                        }
                       
                        $data_aard = DB::select("select * from pay_tbl_aard where kode='$t->aard'");
                        if(!empty($data_aard)){
                            foreach($data_aard as $data_a)
                            {
                                $v_nama = $data_a->nama ;
                                $v_sandi = $data_a->sanperdir ;
                                $v_cj = $data_a->cj ;
                                $v_jb = $data_a->jb ;
                            }
                        }else{
                            $v_nama ="";
                            $v_sandi ="";
                            $v_cj ="";
                            $v_jb ="";
                        }
                        Kasline::insert([
                            'docno' =>  $docno,
                            'lineno' =>  $v_nomor,
                            'account' =>  $v_sandi,
                            'area' =>  '0',
                            'lokasi'  => 'MS',
                            'bagian' =>  'B2000',
                            'pk' =>  '000000',
                            'jb' =>  $v_jb,
                            'cj' =>  $v_cj,
                            'totprice'  =>  $t->nilai,
                            'keterangan'  =>  $v_nama,
                            'penutup' => 'N',
                            'ref_no' => $thnbln
                            ]);
                    }
                    $v_jenis ='PGB';
                }elseif($request->status == 'KOMISARIS'){
                    foreach($data_crkom as $t)
                    {
                        $data_no = DB::select("select max(lineno) as v_no from kasline where docno='$docno'");
                        if(!empty($data_no)){
                            foreach($data_no as $no)
                            {
                                $v_nomor = $no->v_no+1;
                            }
                        }else{
                            $v_nomor =1;
                        }
                       
                        $data_aard = DB::select("select * from pay_tbl_aard where kode='$t->aard'");
                        if(!empty($data_aard)){
                            foreach($data_aard as $data_a)
                            {
                                $v_nama = $data_a->nama ;
                                $v_sandi = $data_a->sanper ;
                                $v_cj = $data_a->cj ;
                                $v_jb = $data_a->jb ;
                            }
                        }else{
                            $v_nama ="";
                            $v_sandi ="";
                            $v_cj ="";
                            $v_jb ="";
                        }
                        Kasline::insert([
                            'docno' =>  $docno,
                            'lineno' =>  $v_nomor,
                            'account' =>  $v_sandi,
                            'area' =>  '0',
                            'lokasi'  => 'MS',
                            'bagian' =>  'B2000',
                            'pk' =>  '000000',
                            'jb' =>  $v_jb,
                            'cj' =>  $v_cj,
                            'totprice'  =>  $t->nilai,
                            'keterangan'  =>  $v_nama,
                            'penutup' => 'N',
                            'ref_no' => $thnbln
                            ]);
                    }
                    $v_jenis = 'PGM';
                }else{
                    foreach($data_crkomite as $t)
                    {
                        $data_no = DB::select("select max(lineno) as v_no from kasline where docno='$docno'");
                        if(!empty($data_no)){
                            foreach($data_no as $no)
                            {
                                $v_nomor = $no->v_no+1;
                            }
                        }else{
                            $v_nomor =1;
                        }
                        $data_no = DB::select("select max(lineno) as v_no from kasline where docno='$docno'");
                        if(!empty($data_no)){
                            foreach($data_no as $no)
                            {
                                $v_nomor = $no->v_no+1;
                            }
                        }else{
                            $v_nomor =1;
                        }
                        $data_aard = DB::select("select * from pay_tbl_aard where kode='$t->aard'");
                        if(!empty($data_aard)){
                            foreach($data_aard as $data_a)
                            {
                                $v_nama = $data_a->nama ;
                                $v_sandi = $data_a->sanper ;
                                $v_cj = $data_a->cj ;
                                $v_jb = $data_a->jb ;
                            }
                        }else{
                            $v_nama ="";
                            $v_sandi ="";
                            $v_cj ="";
                            $v_jb ="";
                        }
                        Kasline::insert([
                            'docno' =>  $docno,
                            'lineno' =>  $v_nomor,
                            'account' =>  $v_sandi,
                            'area' =>  '0',
                            'lokasi'  => 'MS',
                            'bagian' =>  'B2000',
                            'pk' =>  '000000',
                            'jb' =>  $v_jb,
                            'cj' =>  $v_cj,
                            'totprice'  =>  $t->nilai,
                            'keterangan'  =>  $v_nama,
                            'penutup' => 'N',
                            'ref_no' => $thnbln
                            ]);
                    }
                    $v_jenis ='PGO';
                }
                $data_sum = DB::select("select sum(totprice) as v_total from kasline where docno='$docno'");
                foreach($data_sum as $data_s)
                {
                    Kasdoc::where('docno', $docno)
                    ->update([
                        'nilai_dok' =>  $data_s->v_total,
                        'kd_kepada' =>  $v_jenis
                    ]);
                }   
                StatusBayarGaji::where('tahun', $tahun)
                ->where('bulan',$bulan)
                ->update([
                    'statpbd' =>  'Y'
                ]);
                $data = 1;
                return response()->json($data);
        }
    }
    public function editDetail($nodok, $nourut)
    {
        $no=str_replace('-', '/', $nodok);
        $data = Kasline::where('docno', $no)->where('lineno', $nourut)->distinct()->get();
        return response()->json($data[0]);
    }
    public function updateDetail(Request $request)
    {
        Kasline::where('docno', $request->nodok)
                ->where('lineno',$request->nourut)
                ->update([
                    'account' =>  $request->sanper,
                    'area' =>  '0',
                    'lokasi' =>  $request->lapangan,
                    'bagian' =>  $request->bagian,
                    'pk' =>  $request->pk,
                    'jb' =>  $request->jb,
                    'totprice' =>  $request->nilai,
                    'cj' =>  $request->cj,
                    'keterangan' =>  $request->rincian,
                ]);
                
        $data_sum = DB::select("select sum(totprice) as total from kasline where docno='$request->nodok'");
        foreach($data_sum as $data_s)
        {
            Kasdoc::where('docno',$request->nodok)
            ->update([
                'nilai_dok' =>  $data_s->total
            ]);
        }   
        return response()->json();
    }

    public function delete(Request $request)
    {
        $data_rskas = DB::select("select thnbln from kasdoc a where a.docno='$request->nodok'");
        foreach($data_rskas as $data_kas)
        {
            $data_rsbulan = DB::select("select * from timetrans where thnbln='$data_kas->thnbln' and suplesi='0'");
            if(!empty($data_rsbulan)){
                foreach($data_rsbulan as $data_bulan)
                {
                    if($data_bulan->status == '1'){
                        $stbbuku = '1';//gtopening
                    }elseif($data_bulan->status == '2'){
                        $stbbuku = '2';//gtstopping
                    }elseif($data_bulan->status == '3'){
                        $stbbuku = '3';//gtclosing
                    }else{
                        $stbbuku = '4';//gtnone
                    }
                }
            }else{
                $stbbuku = 'gtnone';
            }
            if( $stbbuku > 1){
                $data = 2;
                return response()->json($data);
            }else{
                $data_rscekbayar = DB::select("select paid from kasdoc where docno='$request->nodok'");
                foreach($data_rscekbayar as $data_cekbayar)
                {
                    if($data_cekbayar->paid == 'Y'){
                        $data = 3;
                        return response()->json($data);
                    }else{
                        Kasdoc::where('docno', $request->nodok)->delete();
                        Kasline::where('docno', $request->nodok)->delete();
                        $data = 1;
                        return response()->json($data);
                    }
                }
            }
        }
    }

    public function deleteDetail(Request $request)
    {
        Kasline::where('docno', $request->nodok)->where('lineno',$request->nourut)->delete();
        return response()->json();
    }
    public function deleteDetailall(Request $request)
    {
        $tahun = $request->tahun;
        $bulan = ltrim($request->bulan,0);
        Kasline::where('docno', $request->nodok)->delete();
        Kasdoc::where('docno', $request->nodok)
            ->update([
                'nilai_dok' => '0'
            ]);
        StatusBayarGaji::where('tahun', $tahun)
            ->where('bulan',$bulan)
            ->update([
                'statpbd' =>  'N'
            ]);
        return response()->json();
    }

    public function approv($id,$status)
    {
        $nodok=str_replace('-', '/', $id);
        $data_app = Kasdoc::where('docno',$nodok)->select('*')->get();
        return view('pembayaran_gaji.approv',compact('data_app','status'));
    }

    public function storeApp(Request $request)
    {   
        $nodok=str_replace('-', '/', $request->nodok);
        $data_app = Kasdoc::where('docno',$nodok)->select('*')->get();
        foreach($data_app as $data)
        {
            $check_data = $data->paid;
        }
        if($check_data == 'Y'){
            $bi_bayar = -1 ;  //Mengembalikan pembayaran
            $data_cr = DB::select("select * from kasdoc h where h.docno='$nodok'");
            foreach($data_cr as $t)
            {
                $v_akhir = -9999999999999999;   
                $data_tglrekap = DB::select("select max(tglrekap) as stglrekap from rekapkas where store = '$t->store' and jk =  '$t->jk'");
                if(!empty($data_tglrekap)) {
                    foreach($data_tglrekap as $data_tgl)
                    {
                        $stglrekap  = $data_tgl->stglrekap;
                    }
                }else{
                    $stglrekap = date(now());
                }
                
                $data_juml = DB::select("select count(*),sum(totprice) as jumlah from kasline where penutup='N' and docno = '$nodok'");
                foreach($data_juml as $data_jum)
                {
                    $selisih = round($data_jum->jumlah,0) * $bi_bayar;
                    if($selisih + $v_akhir > 0){
                        Alert::info('Kas Tidak Mencukupi! Saldo yang tersedia = 9,999,999,999,990.00')->persistent(true);
                        return redirect()->route('pembayaran_gaji.index');                            
                    }else{
                        if($selisih >= 0){
                            if($bi_bayar == 1){
                                $v_debet  =  $selisih;
                                $v_kredit =  0;
                            }else{
                                $v_debet  =  0;
                                $v_kredit =  $selisih;
                            }
                        }else{
                            if($bi_bayar == 1){
                                $v_debet =  0;
                                $v_kredit = $selisih;
                            }else{
                                $v_debet =  $selisih;
                                $v_kredit = 0;
                            }
                        }
                        $data_saldo = DB::select("select *  from saldostore where jk ='$t->jk' and nokas = '$t->store'");
                        foreach($data_saldo as $data_sald)
                        {
                            Saldostore::where('jk',$t->jk)->where('nokas',$t->store)
                            ->update([
                                'saldoakhir' => round($data_sald->saldoakhir,0) + round($selisih,0),
                                'debet' => round($data_sald->debet,0)+$v_debet,
                                'kredit' => round($data_sald->kredit,0)+$v_kredit
                            ]);
                        }
                        Kasdoc::where('docno', $nodok)
                        ->update([
                            'paid' => 'N',
                            'paidby' => $request->userid,
                            'paiddate' => $request->tgl_app,
                        ]);
                        Alert::success('No.Dokumen : '.$nodok.' Berhasil Dibatalkan Approval', 'Berhasil')->persistent(true);
                        return redirect()->route('pembayaran_gaji.index');
                        
                    }
                }
            }
        }else{
            $i_bayar = 1; //i_Bayar = 1  : Membayar Kas/Bank
            $data_cr = DB::select("select * from kasdoc h where h.docno='$nodok'");
            foreach($data_cr as $t)
            {
                $v_akhir = -9999999999999999;   
                $data_tglrekap = DB::select("select max(tglrekap) as stglrekap from rekapkas where store = '$t->store' and jk =  '$t->jk'");
                if(!empty($data_tglrekap)) {
                    foreach($data_tglrekap as $data_tgl)
                    {
                        $stglrekap  = $data_tgl->stglrekap;
                    }
                }else{
                    $stglrekap = date(now());
                }
                
                $data_juml = DB::select("select count(*),sum(totprice) as jumlah from kasline where penutup='N' and docno = '$nodok'");
                foreach($data_juml as $data_jum)
                {
                    $selisih = round($data_jum->jumlah,0) * $i_bayar;
                    if($selisih + $v_akhir > 0){
                        Alert::info('Kas Tidak Mencukupi! Saldo yang tersedia = 9,999,999,999,990.00')->persistent(true);
                        return redirect()->route('pembayaran_gaji.index');                            
                    }else{
                        if($selisih >= 0){
                            if($i_bayar == 1){
                                $v_debet  =  $selisih;
                                $v_kredit =  0;
                            }else{
                                $v_debet  =  0;
                                $v_kredit =  $selisih;
                            }
                        }else{
                            if($i_bayar == 1){
                                $v_debet =  0;
                                $v_kredit = $selisih;
                            }else{
                                $v_debet =  $selisih;
                                $v_kredit = 0;
                            }
                        }
                        $data_saldo = DB::select("select *  from saldostore where jk ='$t->jk' and nokas = '$t->store'");
                        foreach($data_saldo as $data_sald)
                        {
                            Saldostore::where('jk',$t->jk)->where('nokas',$t->store)
                            ->update([
                                'saldoakhir' => round($data_sald->saldoakhir,0) + round($selisih,0),
                                'debet' => round($data_sald->debet,0)+$v_debet,
                                'kredit' => round($data_sald->kredit,0)+$v_kredit
                            ]);
                        }
                        Kasdoc::where('docno', $nodok)
                        ->update([
                            'paid' => 'Y',
                            'paidby' => $request->userid,
                            'paiddate' => $request->tgl_app,
                        ]);
                        Alert::success('No.Dokumen : '.$nodok.' Berhasil Diapproval', 'Berhasil')->persistent(true);
                        return redirect()->route('pembayaran_gaji.index');
                    }
                }
            }
        }
    }
}
