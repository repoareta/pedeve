<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rekapkas;
use App\Models\Penempatandepo;
use App\Models\Kasline;
use App\Models\Mtrdeposito;
use App\Models\Dtldepositotest;
use DB;
use DomPDF;
use Excel;
use Alert;

class PenempatanDepositoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        return view('penempatan_deposito.index',compact('tahun','bulan'));
    }

    public function searchIndex(Request $request)
    {        
            $bulan = ltrim($request->bulan, '0');
            $tahun = $request->tahun;
            if($bulan <> "" and $tahun <> ""){
                $data = DB::select("select a.docno,a.lineno,a.noseri,a.nominal,a.tgldep,a.tgltempo,a.perpanjangan,EXTRACT(day from tgltempo)-EXTRACT(day from date(now())) selhari,EXTRACT(month from tgltempo)-EXTRACT(month from date(now())) selbulan,EXTRACT(year from tgltempo)-EXTRACT(year from date(now())) seltahun,b.haribunga,a.bungatahun,b.bungabulan,b.pph20,b.netbulan,a.asal,a.kdbank,a.keterangan,b.accharibunga,b.accbungabulan,b.accpph20,b.accnetbulan,b.bulan,b.tahun,c.descacct as namabank from mtrdeposito a join account c on a.kdbank=c.kodeacct,dtldepositotest b where a.proses = 'Y' and b.docno=a.docno and a.lineno=b.lineno and a.perpanjangan=b.perpanjangan and b.bulan='$bulan' and b.tahun='$tahun' order by a.tgltempo asc");
            }elseif($bulan == "" and $tahun <> ""){ 
                $data = DB::select("select a.docno,a.lineno,a.noseri,a.nominal,a.tgldep,a.tgltempo,a.perpanjangan,EXTRACT(day from tgltempo)-EXTRACT(day from date(now())) selhari,EXTRACT(month from tgltempo)-EXTRACT(month from date(now())) selbulan,EXTRACT(year from tgltempo)-EXTRACT(year from date(now())) seltahun,b.haribunga,a.bungatahun,b.bungabulan,b.pph20,b.netbulan,a.asal,a.kdbank,a.keterangan,b.accharibunga,b.accbungabulan,b.accpph20,b.accnetbulan,b.bulan,b.tahun,c.descacct as namabank from mtrdeposito a join account c on a.kdbank=c.kodeacct,dtldepositotest b where a.proses = 'Y' and b.docno=a.docno and a.lineno=b.lineno and a.perpanjangan=b.perpanjangan and b.tahun='$tahun' order by a.tgltempo asc" );				    
            }else{
                $data_tahunbulan = DB::select("select max(thnbln) as bulan_buku from timetrans where status='1' and length(thnbln)='6'");
                if(!empty($data_tahunbulan)){
                    foreach($data_tahunbulan as $data_bul)
                    {
                        $bulan_buku = $data_bul->bulan_buku;
                    }
                }else{
                    $tgl = now();
                    $tanggal = date_format($tgl, 'Ym');
                    $bulan_buku = $tanggal;
                }
                $tahuns = substr($bulan_buku,0,-2);
                $bulans = ltrim(substr($bulan_buku,4), '0');

                $data = DB::select("select a.docno,a.lineno,a.noseri,a.nominal,a.tgldep,a.tgltempo,a.perpanjangan,EXTRACT(day from tgltempo)-EXTRACT(day from date(now())) selhari,EXTRACT(month from tgltempo)-EXTRACT(month from date(now())) selbulan,EXTRACT(year from tgltempo)-EXTRACT(year from date(now())) seltahun,b.haribunga,a.bungatahun,b.bungabulan,b.pph20,b.netbulan,a.asal,a.kdbank,a.keterangan,b.accharibunga,b.accbungabulan,b.accpph20,b.accnetbulan,b.bulan,b.tahun,c.descacct as namabank from mtrdeposito a join account c on a.kdbank=c.kodeacct,dtldepositotest b where a.proses = 'Y' and b.docno=a.docno and a.lineno=b.lineno and a.perpanjangan=b.perpanjangan and b.bulan='$bulans' and b.tahun='$tahuns' order by a.tgltempo asc");
            }
                return datatables()->of($data)
                ->addColumn('noseri', function ($data) {
                    return $data->noseri;
                })
                ->addColumn('namabank', function ($data) {
                    return $data->namabank;
                })
                ->addColumn('asal', function ($data) {
                return $data->asal;
                })
                ->addColumn('nominal', function ($data) {
                    return 'Rp. '.number_format($data->nominal,2,'.',',');
                })
                ->addColumn('tgldep', function ($data) {
                    $tgl = date_create($data->tgldep);
                    return date_format($tgl, 'd/m/Y');
                })
                ->addColumn('tgltempo', function ($data) {
                    $tgl = date_create($data->tgltempo);
                    return date_format($tgl, 'd/m/Y');
                })
                ->addColumn('haribunga', function ($data) {
                    return $data->haribunga;
                })
                ->addColumn('bungatahun', function ($data) {
                    return number_format($data->bungatahun,2,'.',',');
                })
                ->addColumn('bungabulan', function ($data) {
                    return 'Rp. '.number_format($data->bungabulan,2,'.',',');
                })
                ->addColumn('pph20', function ($data) {
                    return 'Rp. '.number_format($data->pph20,2,'.',',');
                })
                ->addColumn('netbulan', function ($data) {
                    return 'Rp. '.number_format($data->netbulan,2,'.',',');
                })
                ->addColumn('accharibunga', function ($data) {
                    return $data->accharibunga;
                })
                ->addColumn('accnetbulan', function ($data) {
                    return 'Rp. '.number_format($data->accnetbulan,2,'.',',');
                })
                ->addColumn('radio', function ($data) {
                    $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" class="btn-radio" name="btn-radio" nodok="'.$data->docno.'" lineno="'.$data->lineno.'" pjg="'.$data->perpanjangan.'"><span></span></label>'; 
                    return $radio;
                })
                ->rawColumns(['action','radio'])
                ->make(true);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_dok = DB::select("select a.docno,a.lineno,a.asal,a.nominal,a.kdbank,a.keterangan,b.descacct from mtrdeposito  a join account b on a.kdbank=b.kodeacct where proses='N' order by docno");
        return view('penempatan_deposito.create',compact('data_dok'));
    }

    public function linenoJson(Request $request)
    {
    $datas = DB::select("select a.docno,a.lineno,a.asal,round(a.nominal,0) as nominal,a.kdbank,a.keterangan,b.descacct from mtrdeposito  a join account b on a.kdbank=b.kodeacct  where a.docno='$request->nodok' and a.lineno='$request->lineno' and proses='N' order by docno");
        return response()->json($datas[0]);
    }
    public function kursJson(Request $request)
    {
    $datas = DB::select("select rate from kasdoc where docno='$request->nodok'");
        return response()->json($datas[0]);
    }
    public function kdbankJson(Request $request)
    {
    $datas = DB::select("select * from mtrdeposito where docno='$request->nodok' and lineno='$request->lineno' and perpanjangan='$request->pjg'");
        return response()->json($datas[0]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
 
        $docno = $request->nodok;
        $lineno = $request->lineno;
        $asal = $request->asal;
        $kdbank = $request->kdbank;
        $tgldep = $request->tanggal;
        $tgltempo = $request->tanggal2;
        $tahunbunga = $request->tahunbunga;
        $noseri = $request->noseri;
        $nominal = $request->nominal;
        $namabank = $request->namabank;
        $perpanjangan = $request->perpanjangan;
        $keterangan = $request->keterangan;
        $kurs = $request->kurs;
        Penempatandepo::insert([
            'docno' => $docno,
            'lineno' => $lineno,
            'tgldepo' => $tgldep,
            'tgltempo' => $tgltempo,
            'bungatahun' => $tahunbunga,
            'asal' => $asal,
            'noseri' => $noseri,
            'nominal' => $nominal,
            'kdbank' => $kdbank,
            'keterangan' => $keterangan,
            'kurs' => $kurs,
            'statcair' =>'N'        
            ]);
            Kasline::where('docno', $docno)
            ->where('lineno', $lineno)
            ->update([
                'inputpwd' => 'Y'
                ]);
            Mtrdeposito::where('docno', $docno)
            ->where('lineno', $lineno)
            ->where('perpanjangan', '0')
            ->update([
                'noseri' => $noseri,
                'tgldep' => $tgldep,
                'tgltempo' => $tgltempo,
                'bungatahun' => $tahunbunga,
                'proses' => 'Y'
                ]);

            $data_mtrdeposito = DB::select("select * from mtrdeposito where docno='$docno' and lineno='$lineno' and perpanjangan='$perpanjangan'");
            foreach($data_mtrdeposito as $data_mtr)
            {
                $i_proses='T';
                $i_docno=$docno;
                $i_lineno=$lineno;
                $i_panjang=$perpanjangan;
                $kdbank = $data_mtr->kdbank;
            
                if($i_proses == 'T'){
                    $data_kdbank = DB::select("select jenis as v_jenis from account where kodeacct='$kdbank'");
                    foreach($data_kdbank as $data_kdb)
                    {
                        if($data_kdb->v_jenis == 'T'){
                                $v_pembagi = '36000';
                        }else{
                                $v_pembagi = '36500';
                        }
                    }
            
                    $tgltempos = date_create($data_mtr->tgltempo);
                    $tgltempo= date_format($tgltempos, 'm');
            
                    $tgldeps = date_create($data_mtr->tgldep);
                    $tgldep= date_format($tgldeps, 'm');
                    $bulan = ltrim(date_format($tgldeps, 'm'),0);
                    $tahun = date_format($tgldeps, 'Y');
                    $lastday = date('t',strtotime($data_mtr->tgldep));
                    
                    $v_range = $tgltempo - $tgldep;
                    if($v_range < 0 ){
                        $v_rangeok = ($tgltempo+12) - $tgldep;
                    }else{
                        $v_rangeok = $v_range;
                    }
            
                    if($v_rangeok == 0 ){ //bulan sama
                        $v_jumhari = hitunghari($data_mtr->tgldep,$data_mtr->tgltempo);
                        $v_bungabulan = round(($data_mtr->nominal * $v_jumhari * $data_mtr->bungatahun)/$v_pembagi,2);
                        $v_pph20 = round($v_bungabulan * (20/100),2);
                        $v_bunganet = round((($data_mtr->nominal * $v_jumhari * $data_mtr->bungatahun)/$v_pembagi) - ($v_bungabulan * (20/100)),2);
                    
                        Dtldepositotest::insert([
                            'docno' => $i_docno,
                            'lineno' => $i_lineno,
                            'bulan' => $bulan,
                            'tahun' => $tahun,
                            'haribunga' => $v_jumhari,
                            'bungabulan' => $v_bungabulan,
                            'pph20' => $v_pph20,
                            'netbulan' => $v_bunganet,
                            'perpanjangan' => $i_panjang,
                            'tglawal' => $data_mtr->tgldep,
                            'tglakhir' => $data_mtr->tgltempo,
                            'accharibunga' => $v_jumhari,
                            'accbungabulan' => $v_bungabulan,
                            'accpph20' => $v_pph20,
                            'accnetbulan' => $v_bunganet,
                            ]);
                    }elseif($v_rangeok == 1){   //bulan beda 1
                        $v_jumhari = hitunghari($data_mtr->tgldep, $data_mtr->tgltempo);
                        $v_bungabulan = round(($data_mtr->nominal * $v_jumhari * $data_mtr->bungatahun)/$v_pembagi,2);
                        $v_pph20  = round($v_bungabulan * (20/100),2);
                        $v_bunganet  = round((($data_mtr->nominal * $v_jumhari * $data_mtr->bungatahun)/$v_pembagi) - ($v_bungabulan * (20/100)),2);
                        $v_jumhari2 =hitunghari($data_mtr->tgldep,$lastday);
                        $v_bungabulan2  = round(($data_mtr->nominal * $v_jumhari2 * $data_mtr->bungatahun)/$v_pembagi,2);
                        $v_pph202  = round($v_bungabulan2 * (20/100),2);
                        $v_bunganet2  = round((($data_mtr->nominal * $v_jumhari2 * $data_mtr->bungatahun)/$v_pembagi) - ($v_bungabulan2 * (20/100)),2);
                        Dtldepositotest::insert([
                            'docno' => $i_docno,
                            'lineno' => $i_lineno,
                            'bulan' => $bulan,
                            'tahun' => $tahun,
                            'haribunga' => $v_jumhari,
                            'bungabulan' => $v_bungabulan,
                            'pph20' => $v_pph20,
                            'netbulan' => $v_bunganet,
                            'perpanjangan' => $i_panjang,
                            'tglawal' => $data_mtr->tgldep,
                            'tglakhir' => $data_mtr->tgltempo,
                            'accharibunga' => $v_jumhari2,
                            'accbungabulan' => $v_bungabulan2,
                            'accpph20' => $v_pph202,
                            'accnetbulan' => $v_bunganet2,
                            ]);
                    }elseif($v_rangeok > 1){ // jarak bulan > 1
                        $v_tgldepotemp = date_create($data_mtr->tgldep);
                        $bulan = date_format($v_tgldepotemp, 'm');
                        $tahun = date_format($v_tgldepotemp, 'Y');
                        $v_hariakhirtemp =date_format($v_tgldepotemp, 'd');
                        $v_bulanakhirtemp =date_format($v_tgldepotemp, 'm')+1;
                        $v_tahunakhirtemp =date_format($v_tgldepotemp, 'Y');
                        if($v_bulanakhirtemp > 12){
                            $v_bulanakhirtemp =1;
                            $v_tahunakhirtemp = $v_tahunakhirtemp+1;
                        }
                        $v_tglakhir =$v_tahunakhirtemp.'-'.$v_bulanakhirtemp.'-'.$v_hariakhirtemp;
                        $v_hasiltgl = date_create($v_tglakhir);
                        $v_hasiltglakhir =date_format($v_hasiltgl, 'Y-m-d');
                        $v_jumhari =hitunghari($data_mtr->tgldep,$v_hasiltglakhir);
                        $v_bungabulan  = round(($data_mtr->nominal * $v_jumhari * $data_mtr->bungatahun)/$v_pembagi,2);
                        $v_pph20  = round($v_bungabulan * (20/100),2);
                        $v_bunganet  = round((($data_mtr->nominal * $v_jumhari * $data_mtr->bungatahun)/$v_pembagi) - ($v_bungabulan * (20/100)),2);
                        $v_jumhari2 =hitunghari($v_tgldepotemp,$lastday);
                        $v_bungabulan2  = round(($data_mtr->nominal * $v_jumhari2 * $data_mtr->bungatahun)/$v_pembagi,2);
                        $v_pph202  = round($v_bungabulan2 * (20/100),2);
                        $v_bunganet2  = round((($data_mtr->nominal * $v_jumhari2 * $data_mtr->bungatahun)/$v_pembagi) - ($v_bungabulan2 * (20/100)),2);
                        Dtldepositotest::insert([
                            'docno' => $i_docno,
                            'lineno' => $i_lineno,
                            'bulan' => $bulan,
                            'tahun' => $tahun,
                            'haribunga' => $v_jumhari,
                            'bungabulan' => $v_bungabulan,
                            'pph20' => $v_pph20,
                            'netbulan' => $v_bunganet,
                            'perpanjangan' => $i_panjang,
                            'tglawal' => $data_mtr->tgldep,
                            'tglakhir' => $v_hasiltglakhir,
                            'accharibunga' => $v_jumhari2,
                            'accbungabulan' => $v_bungabulan2,
                            'accpph20' => $v_pph202,
                            'accnetbulan' => $v_bunganet2,
                            ]);
                    }
                }
                return response()->json();
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
    public function edit($id,$lineno,$pjg)
    {
        $nodok=str_replace('-', '/', $id);

        $data_list = DB::select("select a.*, b.descacct as namabank from mtrdeposito a join account b on a.kdbank=b.kodeacct where a.docno='$nodok' and lineno='$lineno' and perpanjangan='$pjg'");
        return view('penempatan_deposito.edit',compact('data_list'));
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
        $docno = $request->nodok;
        $lineno = $request->lineno;
        $asal = $request->asal;
        $kdbank = $request->kdbank;
        $tgldep = $request->tanggal;
        $tgltempo = $request->tanggal2;
        $tahunbunga = $request->tahunbunga;
        $noseri = $request->noseri;
        $nominal = $request->nominal;
        $namabank = $request->namabank;
        $perpanjangan = $request->perpanjangan;
        $keterangan = $request->keterangan;
        $kurs = $request->kurs;

       Dtldepositotest::where('docno', $request->nodok)->where('lineno', $request->lineno)->where('perpanjangan', $request->perpanjangan)->delete();
        
       Penempatandepo::where('docno', $request->nodok)->where('lineno', $request->lineno)
        ->update([
            'tgldepo' =>  $tgldep,
            'tgltempo' =>  $tgltempo,
            'bungatahun' =>  $tahunbunga,
            'asal' =>  $asal,
            'noseri' =>  $noseri,
            'nominal' =>  $nominal,
            'kdbank' =>  $kdbank,
            'keterangan' =>  $keterangan,
            'kurs' =>  $kurs,
            'statcair' =>  'N',
        ]);
        Mtrdeposito::where('docno', $request->nodok)->where('lineno', $request->lineno)->where('perpanjangan', $request->perpanjangan)
        ->update([
            'noseri' =>  $noseri,
            'tgldep' =>  $tgldep,
            'tgltempo' =>  $tgltempo,
            'bungatahun' =>  $tahunbunga,
            'proses' =>  'Y',
        ]);

        $data_mtrdeposito = DB::select("select * from mtrdeposito where docno='$docno' and lineno='$lineno' and perpanjangan='$perpanjangan'");
            foreach($data_mtrdeposito as $data_mtr)
            {
                $i_proses='T';
                $i_docno=$docno;
                $i_lineno=$lineno;
                $i_panjang=$perpanjangan;
                $kdbank = $data_mtr->kdbank;
            
                if($i_proses == 'T'){
                    $data_kdbank = DB::select("select jenis as v_jenis from account where kodeacct='$kdbank'");
                    foreach($data_kdbank as $data_kdb)
                    {
                        if($data_kdb->v_jenis == 'T'){
                                $v_pembagi = '36000';
                        }else{
                                $v_pembagi = '36500';
                        }
                    }
            
                    $tgltempos = date_create($data_mtr->tgltempo);
                    $tgltempo= date_format($tgltempos, 'm');
            
                    $tgldeps = date_create($data_mtr->tgldep);
                    $tgldep= date_format($tgldeps, 'm');
                    $bulan = ltrim(date_format($tgldeps, 'm'),0);
                    $tahun = date_format($tgldeps, 'Y');
                    $lastday = date('t',strtotime($data_mtr->tgldep));
                    
                    $v_range = $tgltempo - $tgldep;
                    if($v_range < 0 ){
                        $v_rangeok = ($tgltempo+12) - $tgldep;
                    }else{
                        $v_rangeok = $v_range;
                    }
            
                    if($v_rangeok == 0 ){ //bulan sama
                        $v_jumhari = hitunghari($data_mtr->tgldep,$data_mtr->tgltempo);
                        $v_bungabulan = round(($data_mtr->nominal * $v_jumhari * $data_mtr->bungatahun)/$v_pembagi,2);
                        $v_pph20 = round($v_bungabulan * (20/100),2);
                        $v_bunganet = round((($data_mtr->nominal * $v_jumhari * $data_mtr->bungatahun)/$v_pembagi) - ($v_bungabulan * (20/100)),2);
                    
                        Dtldepositotest::insert([
                            'docno' => $i_docno,
                            'lineno' => $i_lineno,
                            'bulan' => $bulan,
                            'tahun' => $tahun,
                            'haribunga' => $v_jumhari,
                            'bungabulan' => $v_bungabulan,
                            'pph20' => $v_pph20,
                            'netbulan' => $v_bunganet,
                            'perpanjangan' => $i_panjang,
                            'tglawal' => $data_mtr->tgldep,
                            'tglakhir' => $data_mtr->tgltempo,
                            'accharibunga' => $v_jumhari,
                            'accbungabulan' => $v_bungabulan,
                            'accpph20' => $v_pph20,
                            'accnetbulan' => $v_bunganet,
                            ]);
                    }elseif($v_rangeok == 1){   //bulan beda 1
                        $v_jumhari = hitunghari($data_mtr->tgldep, $data_mtr->tgltempo);
                        $v_bungabulan = round(($data_mtr->nominal * $v_jumhari * $data_mtr->bungatahun)/$v_pembagi,2);
                        $v_pph20  = round($v_bungabulan * (20/100),2);
                        $v_bunganet  = round((($data_mtr->nominal * $v_jumhari * $data_mtr->bungatahun)/$v_pembagi) - ($v_bungabulan * (20/100)),2);
                        $v_jumhari2 =hitunghari($data_mtr->tgldep,$lastday);
                        $v_bungabulan2  = round(($data_mtr->nominal * $v_jumhari2 * $data_mtr->bungatahun)/$v_pembagi,2);
                        $v_pph202  = round($v_bungabulan2 * (20/100),2);
                        $v_bunganet2  = round((($data_mtr->nominal * $v_jumhari2 * $data_mtr->bungatahun)/$v_pembagi) - ($v_bungabulan2 * (20/100)),2);
                        Dtldepositotest::insert([
                            'docno' => $i_docno,
                            'lineno' => $i_lineno,
                            'bulan' => $bulan,
                            'tahun' => $tahun,
                            'haribunga' => $v_jumhari,
                            'bungabulan' => $v_bungabulan,
                            'pph20' => $v_pph20,
                            'netbulan' => $v_bunganet,
                            'perpanjangan' => $i_panjang,
                            'tglawal' => $data_mtr->tgldep,
                            'tglakhir' => $data_mtr->tgltempo,
                            'accharibunga' => $v_jumhari2,
                            'accbungabulan' => $v_bungabulan2,
                            'accpph20' => $v_pph202,
                            'accnetbulan' => $v_bunganet2,
                            ]);
                    }elseif($v_rangeok > 1){ // jarak bulan > 1
                        $v_tgldepotemp = date_create($data_mtr->tgldep);
                        $bulan = date_format($v_tgldepotemp, 'm');
                        $tahun = date_format($v_tgldepotemp, 'Y');
                        $v_hariakhirtemp =date_format($v_tgldepotemp, 'd');
                        $v_bulanakhirtemp =date_format($v_tgldepotemp, 'm')+1;
                        $v_tahunakhirtemp =date_format($v_tgldepotemp, 'Y');
                        if($v_bulanakhirtemp > 12){
                            $v_bulanakhirtemp =1;
                            $v_tahunakhirtemp = $v_tahunakhirtemp+1;
                        }
                        $v_tglakhir =$v_tahunakhirtemp.'-'.$v_bulanakhirtemp.'-'.$v_hariakhirtemp;
                        $v_hasiltgl = date_create($v_tglakhir);
                        $v_hasiltglakhir =date_format($v_hasiltgl, 'Y-m-d');
                        $v_jumhari =hitunghari($data_mtr->tgldep,$v_hasiltglakhir);
                        $v_bungabulan  = round(($data_mtr->nominal * $v_jumhari * $data_mtr->bungatahun)/$v_pembagi,2);
                        $v_pph20  = round($v_bungabulan * (20/100),2);
                        $v_bunganet  = round((($data_mtr->nominal * $v_jumhari * $data_mtr->bungatahun)/$v_pembagi) - ($v_bungabulan * (20/100)),2);
                        $v_jumhari2 =hitunghari($v_tgldepotemp,$lastday);
                        $v_bungabulan2  = round(($data_mtr->nominal * $v_jumhari2 * $data_mtr->bungatahun)/$v_pembagi,2);
                        $v_pph202  = round($v_bungabulan2 * (20/100),2);
                        $v_bunganet2  = round((($data_mtr->nominal * $v_jumhari2 * $data_mtr->bungatahun)/$v_pembagi) - ($v_bungabulan2 * (20/100)),2);
                        Dtldepositotest::insert([
                            'docno' => $i_docno,
                            'lineno' => $i_lineno,
                            'bulan' => $bulan,
                            'tahun' => $tahun,
                            'haribunga' => $v_jumhari,
                            'bungabulan' => $v_bungabulan,
                            'pph20' => $v_pph20,
                            'netbulan' => $v_bunganet,
                            'perpanjangan' => $i_panjang,
                            'tglawal' => $data_mtr->tgldep,
                            'tglakhir' => $v_hasiltglakhir,
                            'accharibunga' => $v_jumhari2,
                            'accbungabulan' => $v_bungabulan2,
                            'accpph20' => $v_pph202,
                            'accnetbulan' => $v_bunganet2,
                            ]);
                    }
                }
                return response()->json();
            }   
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $nodok=str_replace('-', '/', $request->nodok);
        
     Dtldepositotest::where('docno', $nodok)->where('lineno', $request->lineno)->where('perpanjangan', $request->pjg)->delete();
     Mtrdeposito::where('docno', $nodok)->where('lineno', $request->lineno)->where('perpanjangan', $request->pjg)->delete();
     Penempatandepo::where('docno', $nodok)->where('lineno', $request->lineno)->delete();
     Kasline::where('docno', $nodok)->where('lineno', $request->lineno)
     ->update([
         'inputpwd' =>  'N',
         ]);
     return response()->json();   
    }
    
    //perpanjangan Deposito
    public function depopjg($id,$lineno,$pjg)
    {
        $nodok=str_replace('-', '/', $id);
        
        $data_list = DB::select("select a.*, b.descacct as namabank from mtrdeposito a join account b on a.kdbank=b.kodeacct where a.docno='$nodok' and lineno='$lineno' and perpanjangan='$pjg'");
        return view('penempatan_deposito.createper',compact('data_list'));
    }


    public function updatedepopjg(Request $request)
    {
        $docno = $request->nodok;
        $lineno = $request->lineno;
        $asal = $request->asal;
        $kdbank = $request->kdbank;
        $tgldep = $request->tanggal;
        $tgltempo = $request->tanggal2;
        $tahunbunga = $request->tahunbunga;
        $noseri = $request->noseri;
        $nominal = $request->nominal;
        $namabank = $request->namabank;
        $perpanjangan = $request->perpanjangan+1;
        $keterangan = $request->keterangan;
        $kurs = $request->kurs;

       Mtrdeposito::insert([
        'docno' => $docno,
        'lineno' => $lineno,
        'tgldep' => $tgldep,
        'tgltempo' => $tgltempo,
        'bungatahun' => $tahunbunga,
        'asal' => $asal,
        'noseri' => $noseri,
        'nominal' => $nominal,
        'kdbank' => $kdbank,
        'keterangan' => $keterangan,
        'proses' => 'Y',
        'perpanjangan' => $perpanjangan 
        ]);

        $data_mtrdeposito = DB::select("select * from mtrdeposito where docno='$docno' and lineno='$lineno' and perpanjangan='$perpanjangan'");
            foreach($data_mtrdeposito as $data_mtr)
            {
                $i_proses='T';
                $i_docno=$docno;
                $i_lineno=$lineno;
                $i_panjang=$perpanjangan;
                $kdbank = $data_mtr->kdbank;
            
                if($i_proses == 'T'){
                    $data_kdbank = DB::select("select jenis as v_jenis from account where kodeacct='$kdbank'");
                    foreach($data_kdbank as $data_kdb)
                    {
                        if($data_kdb->v_jenis == 'T'){
                                $v_pembagi = '36000';
                        }else{
                                $v_pembagi = '36500';
                        }
                    }
            
                    $tgltempos = date_create($data_mtr->tgltempo);
                    $tgltempo= date_format($tgltempos, 'm');
            
                    $tgldeps = date_create($data_mtr->tgldep);
                    $tgldep= date_format($tgldeps, 'm');
                    $bulan = ltrim(date_format($tgldeps, 'm'),0);
                    $tahun = date_format($tgldeps, 'Y');
                    $lastday = date('t',strtotime($data_mtr->tgldep));
                    
                    $v_range = $tgltempo - $tgldep;
                    if($v_range < 0 ){
                        $v_rangeok = ($tgltempo+12) - $tgldep;
                    }else{
                        $v_rangeok = $v_range;
                    }
            
                    if($v_rangeok == 0 ){ //bulan sama
                        $v_jumhari = hitunghari($data_mtr->tgldep,$data_mtr->tgltempo);
                        $v_bungabulan = round(($data_mtr->nominal * $v_jumhari * $data_mtr->bungatahun)/$v_pembagi,2);
                        $v_pph20 = round($v_bungabulan * (20/100),2);
                        $v_bunganet = round((($data_mtr->nominal * $v_jumhari * $data_mtr->bungatahun)/$v_pembagi) - ($v_bungabulan * (20/100)),2);
                    
                        Dtldepositotest::insert([
                            'docno' => $i_docno,
                            'lineno' => $i_lineno,
                            'bulan' => $bulan,
                            'tahun' => $tahun,
                            'haribunga' => $v_jumhari,
                            'bungabulan' => $v_bungabulan,
                            'pph20' => $v_pph20,
                            'netbulan' => $v_bunganet,
                            'perpanjangan' => $i_panjang,
                            'tglawal' => $data_mtr->tgldep,
                            'tglakhir' => $data_mtr->tgltempo,
                            'accharibunga' => $v_jumhari,
                            'accbungabulan' => $v_bungabulan,
                            'accpph20' => $v_pph20,
                            'accnetbulan' => $v_bunganet,
                            ]);
                    }elseif($v_rangeok == 1){   //bulan beda 1
                        $v_jumhari = hitunghari($data_mtr->tgldep, $data_mtr->tgltempo);
                        $v_bungabulan = round(($data_mtr->nominal * $v_jumhari * $data_mtr->bungatahun)/$v_pembagi,2);
                        $v_pph20  = round($v_bungabulan * (20/100),2);
                        $v_bunganet  = round((($data_mtr->nominal * $v_jumhari * $data_mtr->bungatahun)/$v_pembagi) - ($v_bungabulan * (20/100)),2);
                        $v_jumhari2 =hitunghari($data_mtr->tgldep,$lastday);
                        $v_bungabulan2  = round(($data_mtr->nominal * $v_jumhari2 * $data_mtr->bungatahun)/$v_pembagi,2);
                        $v_pph202  = round($v_bungabulan2 * (20/100),2);
                        $v_bunganet2  = round((($data_mtr->nominal * $v_jumhari2 * $data_mtr->bungatahun)/$v_pembagi) - ($v_bungabulan2 * (20/100)),2);
                        Dtldepositotest::insert([
                            'docno' => $i_docno,
                            'lineno' => $i_lineno,
                            'bulan' => $bulan,
                            'tahun' => $tahun,
                            'haribunga' => $v_jumhari,
                            'bungabulan' => $v_bungabulan,
                            'pph20' => $v_pph20,
                            'netbulan' => $v_bunganet,
                            'perpanjangan' => $i_panjang,
                            'tglawal' => $data_mtr->tgldep,
                            'tglakhir' => $data_mtr->tgltempo,
                            'accharibunga' => $v_jumhari2,
                            'accbungabulan' => $v_bungabulan2,
                            'accpph20' => $v_pph202,
                            'accnetbulan' => $v_bunganet2,
                            ]);
                    }elseif($v_rangeok > 1){ // jarak bulan > 1
                        $v_tgldepotemp = date_create($data_mtr->tgldep);
                        $bulan = date_format($v_tgldepotemp, 'm');
                        $tahun = date_format($v_tgldepotemp, 'Y');
                        $v_hariakhirtemp =date_format($v_tgldepotemp, 'd');
                        $v_bulanakhirtemp =date_format($v_tgldepotemp, 'm')+1;
                        $v_tahunakhirtemp =date_format($v_tgldepotemp, 'Y');
                        if($v_bulanakhirtemp > 12){
                            $v_bulanakhirtemp =1;
                            $v_tahunakhirtemp = $v_tahunakhirtemp+1;
                        }
                        $v_tglakhir =$v_tahunakhirtemp.'-'.$v_bulanakhirtemp.'-'.$v_hariakhirtemp;
                        $v_hasiltgl = date_create($v_tglakhir);
                        $v_hasiltglakhir =date_format($v_hasiltgl, 'Y-m-d');
                        $v_jumhari =hitunghari($data_mtr->tgldep,$v_hasiltglakhir);
                        $v_bungabulan  = round(($data_mtr->nominal * $v_jumhari * $data_mtr->bungatahun)/$v_pembagi,2);
                        $v_pph20  = round($v_bungabulan * (20/100),2);
                        $v_bunganet  = round((($data_mtr->nominal * $v_jumhari * $data_mtr->bungatahun)/$v_pembagi) - ($v_bungabulan * (20/100)),2);
                        $v_jumhari2 =hitunghari($v_tgldepotemp,$lastday);
                        $v_bungabulan2  = round(($data_mtr->nominal * $v_jumhari2 * $data_mtr->bungatahun)/$v_pembagi,2);
                        $v_pph202  = round($v_bungabulan2 * (20/100),2);
                        $v_bunganet2  = round((($data_mtr->nominal * $v_jumhari2 * $data_mtr->bungatahun)/$v_pembagi) - ($v_bungabulan2 * (20/100)),2);
                        Dtldepositotest::insert([
                            'docno' => $i_docno,
                            'lineno' => $i_lineno,
                            'bulan' => $bulan,
                            'tahun' => $tahun,
                            'haribunga' => $v_jumhari,
                            'bungabulan' => $v_bungabulan,
                            'pph20' => $v_pph20,
                            'netbulan' => $v_bunganet,
                            'perpanjangan' => $i_panjang,
                            'tglawal' => $data_mtr->tgldep,
                            'tglakhir' => $v_hasiltglakhir,
                            'accharibunga' => $v_jumhari2,
                            'accbungabulan' => $v_bungabulan2,
                            'accpph20' => $v_pph202,
                            'accnetbulan' => $v_bunganet2,
                            ]);
                    }
                }
                return response()->json();
            }
    }

    public function rekap()
    {
        $data_bank = DB::select("select distinct(a.kdbank),b.descacct from mtrdeposito a, account b where b.kodeacct=a.kdbank");
        $data_lapang = DB::select("select kodelokasi,nama from lokasi");
        return view('penempatan_deposito.rekap',compact('data_bank','data_lapang'));
    }
    public function ctkdepo(Request $request)
    {
            if($request->sanper <> ""){
                $sanper = $request->sanper;
                $bulan = ltrim($request->bulan,0);
                $tahun = $request->tahun;
                $lp = $request->lp;
                $data_list = DB::select("select a.docno,a.lineno,a.noseri,a.nominal,
                                            a.tgldep,a.tgltempo,a.perpanjangan,
                                            EXTRACT(day from tgltempo)-EXTRACT(day from date(now())) selhari,
                                            EXTRACT(month from tgltempo)-EXTRACT(month from date(now())) selbulan,
                                            EXTRACT(year from tgltempo)-EXTRACT(year from date(now())) seltahun,
                                            b.haribunga,a.bungatahun,b.bungabulan,b.pph20,b.netbulan,a.asal,a.kdbank,
                                            a.keterangan,b.accharibunga,b.accbungabulan,b.accpph20,b.accnetbulan,b.bulan,
                                            b.tahun,c.descacct as namabank 
                                        from mtrdeposito a join account c on a.kdbank=c.kodeacct,dtldepositotest b 
                                        where a.proses = 'Y' and b.docno=a.docno and a.lineno=b.lineno and a.perpanjangan=b.perpanjangan 
                                            and b.bulan='$bulan' and b.tahun='$tahun' and a.kdbank='$sanper' and a.asal='$lp' order by a.tgltempo asc");
            }else{
                $sanper ="like '%'";
                $bulan = ltrim($request->bulan,0);
                $tahun = $request->tahun;
                $lp = $request->lp;
                $data_list = DB::select("select a.docno,a.lineno,a.noseri,a.nominal,
                                            a.tgldep,a.tgltempo,a.perpanjangan,
                                            EXTRACT(day from tgltempo)-EXTRACT(day from date(now())) selhari,
                                            EXTRACT(month from tgltempo)-EXTRACT(month from date(now())) selbulan,
                                            EXTRACT(year from tgltempo)-EXTRACT(year from date(now())) seltahun,
                                            b.haribunga,a.bungatahun,b.bungabulan,b.pph20,b.netbulan,a.asal,a.kdbank,
                                            a.keterangan,b.accharibunga,b.accbungabulan,b.accpph20,b.accnetbulan,b.bulan,
                                            b.tahun,c.descacct as namabank 
                                        from mtrdeposito a join account c on a.kdbank=c.kodeacct,dtldepositotest b 
                                        where a.proses = 'Y' and b.docno=a.docno and a.lineno=b.lineno and a.perpanjangan=b.perpanjangan 
                                            and b.bulan='$bulan' and b.tahun='$tahun' and a.kdbank $sanper and a.asal='$lp' order by a.tgltempo asc");
            }
        if(!empty($data_list)){
            $pdf = DomPDF::loadview('penempatan_deposito.export_depo',compact('request','data_list'))->setPaper('a4', 'landscape');
            $pdf->output();
            $dom_pdf = $pdf->getDomPDF();

            $canvas = $dom_pdf ->get_canvas();
            $canvas->page_text(725, 100, "Halaman {PAGE_NUM} Dari {PAGE_COUNT}", null, 10, array(0, 0, 0)); //lembur landscape
            // return $pdf->download('rekap_umk_'.date('Y-m-d H:i:s').'.pdf');
            return $pdf->stream();
        }else{
            Alert::info("Tidak ditemukan data dengan Bulan/Tahun: $request->bulan/$request->tahun ", 'Failed')->persistent(true);
            return redirect()->route('penempatan_deposito.rekap');
        }
    }

    public function rekaprc($no,$id)
    {
        $nodok=str_replace('-', '/', $no);
        $lineno=$id;
        $data_bank = DB::select("select distinct(a.kdbank),b.descacct from mtrdeposito a, account b where b.kodeacct=a.kdbank");
        $data_lapang = DB::select("select kodelokasi,nama from lokasi");
        return view('penempatan_deposito.rekaprc',compact('data_bank','data_lapang'));
    }
}