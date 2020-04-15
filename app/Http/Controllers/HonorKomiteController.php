<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PayHonor;
use App\Models\PayAard;
use App\Models\SdmMasterPegawai;
use DB;
use PDF;
use Excel;
use Alert;

class HonorKomiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_tahunbulan = DB::select("select max(thnbln) as bulan_buku from timetrans where status='1' and length(thnbln)='6'");
        foreach($data_tahunbulan as $data_bul)
        {
            $bulan_buku = $data_bul->bulan_buku;
        }
        $tahun = substr($bulan_buku,0,-2);
        $data_list = DB::select("select a.tahun, a.bulan, a.nopek, a.aard, a.jmlcc, a.ccl, a.nilai, a.userid,a.pajak, b.nama as nama_nopek from pay_honorarium a join sdm_master_pegawai b on a.nopek=b.nopeg where a.tahun ='$tahun' order by a.tahun,a.bulan,a.nopek");
        $data_pegawai = DB::select("select nopeg,nama,status,nama from sdm_master_pegawai where status <>'P' order by nopeg");	
        return view('honor_komite.index',compact('data_list','data_pegawai'));
    }

    public function searchIndex(Request $request)
    {
        $data_tahunbulan = DB::select("select max(thnbln) as bulan_buku from timetrans where status='1' and length(thnbln)='6'");
        foreach($data_tahunbulan as $data_bul)
        {
            $bulan_buku = $data_bul->bulan_buku;
        }
        $tahuns = substr($bulan_buku,0,-2);
        $bulan = ltrim($request->bulan, '0');
        $tahun = $request->tahun;
        $nopek = $request->nopek;
        if($nopek == null ){
            if($bulan == null and $tahun == null){
                $data_list = DB::select("select a.tahun, a.bulan, a.nopek, a.aard, a.jmlcc, a.ccl, a.nilai, a.userid,a.pajak, b.nama as nama_nopek from pay_honorarium a join sdm_master_pegawai b on a.nopek=b.nopeg where a.tahun ='$tahuns' order by a.tahun,a.bulan,a.nopek");	
            }elseif($bulan == null and $tahun <> null){
                $data_list = DB::select("select a.tahun, a.bulan, a.nopek, a.aard, a.jmlcc, a.ccl, a.nilai, a.userid,a.pajak, b.nama as nama_nopek from pay_honorarium a join sdm_master_pegawai b on a.nopek=b.nopeg where a.tahun ='$tahun' order by a.tahun,a.bulan,a.nopek");	
            }else{
                $data_list = DB::select("select a.tahun, a.bulan, a.nopek, a.aard, a.jmlcc, a.ccl, a.nilai, a.userid,a.pajak, b.nama as nama_nopek from pay_honorarium a join sdm_master_pegawai b on a.nopek=b.nopeg where a.bulan='$bulan' and a.tahun='$tahun' order by a.tahun,a.bulan,a.nopek");
            }
        }else{
            if($bulan == null and $tahun == null){
                $data_list = DB::select("select a.tahun, a.bulan, a.nopek, a.aard, a.jmlcc, a.ccl, a.nilai, a.userid,a.pajak, b.nama as nama_nopek from pay_honorarium a join sdm_master_pegawai b on a.nopek=b.nopeg where a.nopek='$nopek' order by a.tahun,a.bulan,a.nopek");	
            }else{
                $data_list = DB::select("select a.tahun, a.bulan, a.nopek, a.aard, a.jmlcc, a.ccl, a.nilai, a.userid,a.pajak, b.nama as nama_nopek from pay_honorarium a join sdm_master_pegawai b on a.nopek=b.nopeg where a.bulan='$bulan' and a.tahun='$tahun' and a.nopek='$nopek' order by a.tahun,a.bulan,a.nopek");
            }
        }
        $data_pegawai = DB::select("select nopeg,nama,status,nama from sdm_master_pegawai where status <>'P' order by nopeg");	
        return view('honor_komite.index',compact('data_list','data_pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_pegawai = SdmMasterPegawai::all();
        return view('honor_komite.create', compact('data_pegawai'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data_cek = DB::select("select * from pay_honorarium   where nopek='$request->nopek' and bulan='$request->bulan' and tahun='$request->tahun'" ); 			
        if(!empty($data_cek)){
            $data=0;
            return response()->json($data);
        }else {
        $nilai = $request->nilai;
        $pajak = (35/65) * $nilai;
        $data_tahun = $request->tahun;
        $data_bulan = $request->bulan;
        $nopek = $request->nopek;
        PayHonor::insert([
            'tahun' => $data_tahun,
            'bulan' => $data_bulan,
            'nopek' => $request->nopek,
            'aard' => 30,
            'jmlcc' => 0,
            'ccl' => 0,
            'nilai' => $nilai,
            'userid' => $request->userid,
            'pajak' => $pajak,
            ]);

        $data_pajak = DB::select("select round(pajak,-2) as pajaknya from pay_honorarium where tahun='$data_tahun' and bulan='$data_bulan' and nopek='$nopek'");
        foreach($data_pajak as $data_p)
        {
            PayHonor::where('tahun', $request->tahun)
            ->where('bulan',$request->bulan)
            ->where('nopek',$request->nopek)
            ->update([
                'pajak' => $data_p->pajaknya,
            ]);
        }
            $data = 1;
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
    public function edit($bulan,$tahun,$nopek)
    {
        $data_list = DB::select("select a.tahun, a.bulan, a.nopek, a.aard, a.jmlcc, a.ccl, a.nilai, a.userid,a.pajak, b.nama as nama_nopek from pay_honorarium a join sdm_master_pegawai b on a.nopek=b.nopeg where nopek='$nopek' and bulan='$bulan' and tahun='$tahun' order by a.tahun,a.bulan,a.nopek");
        $data_pegawai = SdmMasterPegawai::all();
        return view('honor_komite.edit',compact('data_list','data_pegawai'));
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
        $data_tahun = $request->tahun;
        $data_bulan = $request->bulan;
        $nilai = $request->nilai;
        $nopek = $request->nopek;
        $pajak = (35/65) * $nilai;

        PayHonor::where('tahun', $request->tahun)
        ->where('bulan',$request->bulan)
        ->where('nopek',$request->nopek)
        ->update([
            'tahun' => $data_tahun,
            'bulan' => $data_bulan,
            'nopek' => $request->nopek,
            'jmlcc' => 0,
            'ccl' => 0,
            'nilai' => $nilai,
            'userid' => $request->userid,
            'pajak' => $pajak,
        ]);

        $data_pajak = DB::select("select round(pajak,-2) as pajaknya from pay_honorarium where tahun='$data_tahun' and bulan='$data_bulan' and nopek='$nopek'");
        foreach($data_pajak as $data_p)
        {
            PayHonor::where('tahun', $request->tahun)
            ->where('bulan',$request->bulan)
            ->where('nopek',$request->nopek)
            ->update([
                'pajak' => $data_p->pajaknya,
            ]);
        }
        return response()->json();
    }
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        PayHonor::where('tahun', $request->tahun)
        ->where('bulan',$request->bulan)
        ->where('nopek',$request->nopek)
        ->where('aard',$request->aard)
        ->delete();
        return response()->json();
    }
}
