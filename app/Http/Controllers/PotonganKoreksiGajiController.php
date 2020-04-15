<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KoreksiGaji;
use App\Models\PayAard;
use App\Models\SdmMasterPegawai;
use DB;
use PDF;
use Excel;
use Alert;

class PotonganKoreksiGajiController extends Controller
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
        $data_list = DB::select("select a.tahun, a.bulan, a.nopek, a.aard, a.jmlcc, a.ccl, a.nilai, a.userid, b.nama as nama_nopek,c.nama as nama_aard from pay_koreksigaji a join sdm_master_pegawai b on a.nopek=b.nopeg  join pay_tbl_aard c on a.aard=c.kode where a.tahun ='$tahun' order by a.tahun,a.bulan,a.nopek");
        $data_pegawai = DB::select("select nopeg,nama,status,nama from sdm_master_pegawai where status <>'P' order by nopeg");
        return view('potongan_koreksi_gaji.index',compact('data_list','data_pegawai'));
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
        if($nopek == null){
            if($bulan == null and $tahun == null){    
                $data_list = DB::select("select a.tahun, a.bulan, a.nopek, a.aard, a.jmlcc, a.ccl, a.nilai, a.userid, b.nama as nama_nopek,c.nama as nama_aard from pay_koreksigaji a join sdm_master_pegawai b on a.nopek=b.nopeg  join pay_tbl_aard c on a.aard=c.kode where a.tahun ='$tahuns' order by a.tahun,a.bulan,a.nopek");
            }elseif($bulan == null and $tahun <> null){
                $data_list = DB::select("select a.tahun, a.bulan, a.nopek, a.aard, a.jmlcc, a.ccl, a.nilai, a.userid, b.nama as nama_nopek,c.nama as nama_aard from pay_koreksigaji a join sdm_master_pegawai b on a.nopek=b.nopeg  join pay_tbl_aard c on a.aard=c.kode where a.tahun ='$tahun' order by a.tahun,a.bulan,a.nopek");
            }else{
               $data_list = DB::select("select a.tahun, a.bulan, a.nopek, a.aard, a.jmlcc, a.ccl, a.nilai, a.userid, b.nama as nama_nopek,c.nama as nama_aard from pay_koreksigaji a join sdm_master_pegawai b on a.nopek=b.nopeg  join pay_tbl_aard c on a.aard=c.kode where a.bulan='$bulan' and a.tahun='$tahun' order by a.tahun,a.bulan,a.nopek");
            }
        }else{
            if($bulan == null and $tahun == null){
               $data_list = DB::select("select a.tahun, a.bulan, a.nopek, a.aard, a.jmlcc, a.ccl, a.nilai, a.userid, b.nama as nama_nopek,c.nama as nama_aard from pay_koreksigaji a join sdm_master_pegawai b on a.nopek=b.nopeg  join pay_tbl_aard c on a.aard=c.kode where a.nopek='$nopek' order by a.tahun,a.bulan,a.nopek");	
            }else{
               $data_list = DB::select("select a.tahun, a.bulan, a.nopek, a.aard, a.jmlcc, a.ccl, a.nilai, a.userid, b.nama as nama_nopek,c.nama as nama_aard from pay_koreksigaji a join sdm_master_pegawai b on a.nopek=b.nopeg  join pay_tbl_aard c on a.aard=c.kode where a.bulan='$bulan' and a.tahun='$tahun' and a.nopek='$nopek' order by a.tahun,a.bulan,a.nopek");
            }
        }
        $data_pegawai = DB::select("select nopeg,nama,status,nama from sdm_master_pegawai where status <>'P' order by nopeg");
        return view('potongan_koreksi_gaji.index',compact('data_list','data_pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_pegawai = DB::select("select nopeg,nama,status,nama from sdm_master_pegawai where status <>'P' order by nopeg");
        $pay_aard = PayAard::where('jenis', 10)->get();
        return view('potongan_koreksi_gaji.create', compact('pay_aard','data_pegawai'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data_cek = DB::select("select * from pay_koreksigaji   where nopek='$request->nopek' and aard='$request->aard' and bulan='$request->bulan' and tahun='$request->tahun'" ); 			
        if(!empty($data_cek)){
            $data=0;
            return response()->json($data);
        }else {
        $data_tahun = $request->tahun;
        $data_bulan = $request->bulan;
            KoreksiGaji::insert([
            'tahun' => $data_tahun,
            'bulan' => $data_bulan,
            'nopek' => $request->nopek,
            'aard' => $request->aard,
            'jmlcc' => 0,
            'ccl' => 0,
            'nilai' => $request->nilai,
            'userid' => $request->userid,
            
            // Save Panjar Header
            ]);
            $data = 1;
            return response()->json($data);
        }
    }

    public function edit($bulan,$tahun,$aard,$nopek)
    {
        $data_list = DB::select("select a.tahun, a.bulan, a.nopek, a.aard, a.jmlcc, a.ccl, a.nilai, a.userid, b.nama as nama_nopek,c.nama as nama_aard from pay_koreksigaji a join sdm_master_pegawai b on a.nopek=b.nopeg  join pay_tbl_aard c on a.aard=c.kode  where a.nopek='$nopek' and a.aard='$aard' and a.bulan='$bulan' and a.tahun='$tahun'");
        return view('potongan_koreksi_gaji.edit',compact('data_list'));
    }
    public function update(Request $request)
    {
            KoreksiGaji::where('tahun', $request->tahun)
            ->where('bulan',$request->bulan)
            ->where('nopek',$request->nopek)
            ->where('aard',$request->aard)
            ->update([
                'jmlcc' => 0,
                'ccl' => 0,
                'nilai' => $request->nilai,
                'userid' => $request->userid,
            ]);
            return response()->json();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        KoreksiGaji::where('tahun', $request->tahun)
        ->where('bulan',$request->bulan)
        ->where('nopek',$request->nopek)
        ->where('aard',$request->aard)
        ->delete();
        return response()->json();
    }
}
