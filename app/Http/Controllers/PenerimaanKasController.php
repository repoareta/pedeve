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
use DB;
use PDF;
use Excel;
use Alert;

class PenerimaanKasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('penerimaan_kas.index');
    }

    public function searchIndex(Request $request)
    {
            $data_tahunbulan = DB::select("select max(thnbln) as bulan_buku from timetrans where status='1' and length(thnbln)='6'");
            foreach($data_tahunbulan as $data_bul)
            {
                $bulan_buku = $data_bul->bulan_buku;
            }
            $tahuns = substr($bulan_buku,0,-2);
        
            $bulan = $request->bulan;
            $tahun = $request->tahun;
            $nodok = $request->bukti;
            if($nodok == null and $tahun == null and $bulan == null){
                $data = DB::select("select a.docno,a.originaldate,a.thnbln,a.jk,a.store,a.ci,a.voucher,a.kepada,a.rate,a.nilai_dok as nilai_dok,a.paid,a.verified,b.namabank from kasdoc a join storejk b on a.store=b.kodestore where a.thnbln='$bulan_buku' and a.kd_kepada is null  order by a.store,a.voucher asc");
            }elseif($nodok == null and $tahun <> null and $bulan == null){
                $data = DB::select("select a.docno,a.originaldate,a.thnbln,a.jk,a.store,a.ci,a.voucher,a.kepada,a.rate,a.nilai_dok as nilai_dok,a.paid,a.verified,b.namabank from kasdoc a join storejk b on a.store=b.kodestore where left(a.thnbln, 4)='$tahun' and a.kd_kepada is null  order by a.store,a.voucher asc");
            }elseif($nodok <> null and $tahun == null and $bulan == null){
                $data = DB::select("select a.docno,a.originaldate,a.thnbln,a.jk,a.store,a.ci,a.voucher,a.kepada,a.rate,a.nilai_dok as nilai_dok,a.paid,a.verified,b.namabank from kasdoc a join storejk b on a.store=b.kodestore where a.voucher='$nodok' and a.kd_kepada is null  order by a.store,a.voucher asc");
            }elseif($nodok <> null and $tahun <> null and $bulan == null){
                $data = DB::select("select a.docno,a.originaldate,a.thnbln,a.jk,a.store,a.ci,a.voucher,a.kepada,a.rate,a.nilai_dok as nilai_dok,a.paid,a.verified,b.namabank from kasdoc a join storejk b on a.store=b.kodestore where a.voucher='$nodok' and left(a.thnbln, 4)='$tahun' and a.kd_kepada is null  order by a.store,a.voucher asc");
            }elseif($nodok == null and $tahun <> null and $bulan <> null){
                $data = DB::select("select a.docno,a.originaldate,a.thnbln,a.jk,a.store,a.ci,a.voucher,a.kepada,a.rate,a.nilai_dok as nilai_dok,a.paid,a.verified,b.namabank from kasdoc a join storejk b on a.store=b.kodestore where left(thnbln, 4)='$tahun' and right(thnbln,2)='$bulan' and a.kd_kepada is null  order by a.store,a.voucher asc");
            }elseif($nodok <> null and $tahun <> null and $bulan <> null){
                $data = DB::select("select a.docno,a.originaldate,a.thnbln,a.jk,a.store,a.ci,a.voucher,a.kepada,a.rate,a.nilai_dok as nilai_dok,a.paid,a.verified,b.namabank from kasdoc a join storejk b on a.store=b.kodestore where a.voucher='$nodok' and left(thnbln, 4)='$tahun' and right(thnbln, 2)='$bulan' and a.kd_kepada is null  order by a.store,a.voucher asc");
            }	
            return datatables()->of($data)
            ->addColumn('docno', function ($data) {
                return $data->docno;
           })
           ->addColumn('tanggal', function ($data) {
               $tgl = date_create($data->originaldate);
               return date_format($tgl, 'd F Y');
            })
            ->addColumn('voucher', function ($data) {
                return $data->voucher;
            })
            ->addColumn('kepada', function ($data) {
                return $data->kepada;
            })
            ->addColumn('jk', function ($data) {
                return $data->jk;
            })
            ->addColumn('store', function ($data) {
                return $data->store.' -- '.$data->namabank;
           })
            ->addColumn('ci', function ($data) {
                return $data->ci;
           })
           ->addColumn('rate', function ($data) {
               return 'Rp. '.number_format($data->rate,2,'.',',');
            })
           ->addColumn('nilai_dok', function ($data) {
               return 'Rp. '.number_format($data->nilai_dok,2,'.',',');
            })
    
            ->addColumn('radio', function ($data) {
                $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" value="'.$data->docno.'" class="btn-radio" name="btn-radio"><span></span></label>'; 
                return $radio;
            })
            ->addColumn('action', function ($data) {
                if($data->verified == 'Y'){
                    $action = '<p align="center"><span style="font-size: 2em;" class="kt-font-success pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Data Sudah Diverifikasi"><i class="fas fa-check-circle" ></i></span></p>';
                }else{
                    if($data->paid == 'Y'){
                        $action = '<p align="center"><a href="'. route('penerimaan_kas.approv',['id' => str_replace('/', '-', $data->docno),'status' => $data->paid]).'"><span style="font-size: 2em;" class="kt-font-warning pointer-link" data-toggle="kt-tooltip" data-placement="top"  title="Batalkan Pembayaran"><i class="fas fa-check-circle" ></i></span></a></p>';
                    }else{
                        $action = '<p align="center"><a href="'. route('penerimaan_kas.approv',['id' => str_replace('/', '-', $data->docno),'status' => $data->paid]).'"><span style="font-size: 2em;" class="kt-font-danger pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Klik Untuk Pembayaran"><i class="fas fa-ban" ></i></span></a></p>';
                    }
                }               
                return $action;
            })
            ->rawColumns(['action','radio'])
            ->make(true);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createmp()
    {
        return view('penerimaan_kas.createmp');
    }
    public function create(Request $request)
    {        
        If($request->mp == "P"){
            $darkep = "Kepada";
            $datas = DB::select("Select Max(left(mrs_no,4)) as nover from Kasdoc Where substr(DocNo,1,1)='P' and left(THNBLN,4)='2020'");
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
        return view('penerimaan_kas.create',compact('request','data_bagian','tahun','bulan','bulan_buku','darkep','nover'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nodoc=str_replace('-', '/', $id);
        $data_list =DB::table('kasdoc')
        ->join('storejk', 'kasdoc.store', '=', 'storejk.kodestore')
        ->select('kasdoc.*', 'storejk.*')
        ->where('kasdoc.docno',$nodoc)
        ->get();
        $lokasi = Lokasi::all();
        $data_jenis = JenisBiaya::all();
        $data_casj = Cashjudex::all();
        $data_bagian = SdmKdbag::all();
        $data_account = DB::select("select kodeacct,descacct from account where length(kodeacct)=6 and kodeacct not like '%x%'");
        $count= Kasline::where('docno',$nodoc)->sum('totprice');
        $data_detail = Kasline::where('docno',$nodoc)->get();
        $no_detail = Kasline::where('docno',$nodoc)->max('lineno');
        if($no_detail <> null){
            $no_urut = $no_detail + 1;
        }else {
            $no_urut = 1;
        }
        return view('penerimaan_kas.edit',compact(
            'data_list',
            'data_bagian',
            'data_detail',
            'count',
            'no_urut',
            'lokasi',
            'data_account',
            'data_jenis',
            'data_casj'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        $data_cek = DB::select("select * from kasline where docno='$request->nodok' and lineno='$request->nourut'");
    if(!empty($data_cek)){
        if($request->cj = '50' and $request->mp){
            Mtrdeposito::where('docno', $request->nodok)
            ->where('lineno',$request->nourut)
            ->update([
               'kdbank' =>  $request->sanper,
               'nominal' =>  $request->nilai,
               'asal' =>  $request->lapangan,
               'keterangan' =>  $request->rincian,
               'proses' =>  'N',          
               ]);
        }
        Kasline::where('docno', $request->nodok)
            ->where('lineno',$request->nourut)
            ->update([
            'account' =>  $request->sanper,
            'lokasi'  =>  $request->lapangan,
            'bagian' =>  $request->bagian,
            'pk' =>  $request->pk,
            'jb' =>  $request->jb,
            'cj' =>  $request->cj,
            'totprice'  =>  $request->nilai,
            'keterangan'  =>  $request->rincian
            ]);
            return response()->json();
    }else{

             if($request->cj = '50' and $request->mp){
                 Mtrdeposito::insert([
                    'docno' =>  $request->nodok,
                    'lineno' =>  $request->nourut,
                    'kdbank' =>  $request->sanper,
                    'nominal' =>  $request->nilai,
                    'asal' =>  $request->lapangan,
                    'keterangan' =>  $request->rincian,
                    'proses' =>  'N',          
                    ]);
             }

        Kasline::insert([
            'docno' =>  $request->nodok,
            'lineno' =>  $request->nourut,
            'account' =>  $request->sanper,
            'area' =>  '0',
            'lokasi'  =>  $request->lapangan,
            'bagian' =>  $request->bagian,
            'pk' =>  $request->pk,
            'jb' =>  $request->jb,
            'cj' =>  $request->cj,
            'totprice'  =>  $request->nilai,
            'keterangan'  =>  $request->rincian
            ]);
            return response()->json();    
    }
    }

    public function editDetail($nodok, $nourut)
    {
        $no=str_replace('-', '/', $nodok);
        $data = Kasline::where('docno', $no)->where('lineno', $nourut)->distinct()->get();
        return response()->json($data[0]);
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
                        Mtrdeposito::where('docno', $request->nodok)->delete();
                        Dtldepositotest::where('docno', $request->nodok)->delete();
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
        Mtrdeposito::where('docno', $request->nodok)->where('lineno',$request->nourut)->delete();
        return response()->json();
    }

    public function approv($id,$status)
    {
        $nodok=str_replace('-', '/', $id);
        $data_app = Kasdoc::where('docno',$nodok)->select('*')->get();
        return view('penerimaan_kas.approv',compact('data_app','status'));
    }

    public function storeApp(Request $request)
    {      
        $nodok=str_replace('-', '/', $request->nodok);
        $i_bayar = 1; //i_Bayar = 1  : Membayar Kas/Bank
        $bi_bayar = -1 ;  //Mengembalikan pembayaran
        $data_app = Kasdoc::where('docno',$nodok)->select('*')->get();
        foreach($data_app as $data)
        {
            $check_data = $data->paid;
        }
        if($check_data == 'Y'){
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
                        return redirect()->route('penerimaan_kas.index');                            
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
                        return redirect()->route('penerimaan_kas.index');
                        
                    }
                }
            }
        }else{
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
                        return redirect()->route('penerimaan_kas.index');                            
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
                        return redirect()->route('penerimaan_kas.index');
                    }
                }
            }
        }
    }
}
