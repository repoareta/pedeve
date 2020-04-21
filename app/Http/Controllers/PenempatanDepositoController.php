<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rekapkas;
use App\Models\Penempatandepo;
use App\Models\Kasline;
use App\Models\Mtrdeposito;
use DB;
use PDF;
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

        $data_list = DB::select("select a.docno,a.lineno,a.noseri,a.nominal,a.tgldep,a.tgltempo,a.perpanjangan,EXTRACT(day from tgltempo)-EXTRACT(day from date(now())) selhari,EXTRACT(month from tgltempo)-EXTRACT(month from date(now())) selbulan,EXTRACT(year from tgltempo)-EXTRACT(year from date(now())) seltahun,b.haribunga,a.bungatahun,b.bungabulan,b.pph20,b.netbulan,a.asal,a.kdbank,a.keterangan,b.accharibunga,b.accbungabulan,b.accpph20,b.accnetbulan,b.bulan,b.tahun,c.descacct as namabank from mtrdeposito a join account c on a.kdbank=c.kodeacct,dtldepositotest b where a.proses = 'Y' and b.docno=a.docno and a.lineno=b.lineno and a.perpanjangan=b.perpanjangan and b.bulan='$bulans' and b.tahun='$tahuns' order by a.tgltempo asc");
        return view('penempatan_deposito.index',compact('data_list'));
    }

    public function searchIndex(Request $request)
    {        
            $bulan = ltrim($request->bulan, '0');
            $tahun = $request->tahun;
            if($bulan <> "" and $tahun <> ""){
                $data_list = DB::select("select a.docno,a.lineno,a.noseri,a.nominal,a.tgldep,a.tgltempo,a.perpanjangan,EXTRACT(day from tgltempo)-EXTRACT(day from date(now())) selhari,EXTRACT(month from tgltempo)-EXTRACT(month from date(now())) selbulan,EXTRACT(year from tgltempo)-EXTRACT(year from date(now())) seltahun,b.haribunga,a.bungatahun,b.bungabulan,b.pph20,b.netbulan,a.asal,a.kdbank,a.keterangan,b.accharibunga,b.accbungabulan,b.accpph20,b.accnetbulan,b.bulan,b.tahun,c.descacct as namabank from mtrdeposito a join account c on a.kdbank=c.kodeacct,dtldepositotest b where a.proses = 'Y' and b.docno=a.docno and a.lineno=b.lineno and a.perpanjangan=b.perpanjangan and b.bulan='$bulan' and b.tahun='$tahun' order by a.tgltempo asc");
            }elseif($bulan == "" and $tahun <> ""){ 
                $data_list = DB::select("select a.docno,a.lineno,a.noseri,a.nominal,a.tgldep,a.tgltempo,a.perpanjangan,EXTRACT(day from tgltempo)-EXTRACT(day from date(now())) selhari,EXTRACT(month from tgltempo)-EXTRACT(month from date(now())) selbulan,EXTRACT(year from tgltempo)-EXTRACT(year from date(now())) seltahun,b.haribunga,a.bungatahun,b.bungabulan,b.pph20,b.netbulan,a.asal,a.kdbank,a.keterangan,b.accharibunga,b.accbungabulan,b.accpph20,b.accnetbulan,b.bulan,b.tahun,c.descacct as namabank from mtrdeposito a join account c on a.kdbank=c.kodeacct,dtldepositotest b where a.proses = 'Y' and b.docno=a.docno and a.lineno=b.lineno and a.perpanjangan=b.perpanjangan and b.tahun='$tahun' order by a.tgltempo asc" );				    
            }
        return view('penempatan_deposito.index',compact('data_list'));
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
    $datas = DB::select("select a.docno,a.lineno,a.asal,a.nominal,a.kdbank,a.keterangan,b.descacct from mtrdeposito  a join account b on a.kdbank=b.kodeacct  where a.docno='$request->lineno' and proses='N' order by docno");
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

            return response()->json();
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
