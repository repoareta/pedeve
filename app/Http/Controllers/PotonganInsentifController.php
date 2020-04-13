<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PayPotonganInsentif;
use App\Models\SdmMasterPegawai;
use DB;
use PDF;
use Excel;
use Alert;

class PotonganInsentifController extends Controller
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
        $data_list = DB::select("select a.tahun, a.bulan, a.nopek, a.nilai, a.userid,b.nama as nama_nopek from pay_potongan_insentif a join sdm_master_pegawai b on a.nopek=b.nopeg where a.tahun ='$tahun'  order by a.tahun,a.bulan asc");
        $data_pegawai = DB::select("select nopeg,nama,status,nama from sdm_master_pegawai where status <>'P' order by nopeg");	
        return view('potongan_insentif.index',compact('data_list','data_pegawai'));
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
            $nopek = $request->nopek;

        if($nopek == null){
            if($bulan == null and $tahun == null){
            $data_list = DB::select("select a.tahun, a.bulan, a.nopek, a.nilai, a.userid,b.nama as nama_nopek from pay_potongan_insentif a join sdm_master_pegawai b on a.nopek=b.nopeg where a.tahun ='$tahuns'  order by a.tahun,a.bulan asc");
            }elseif($bulan == null and $tahun <> null){
            $data_list = DB::select("select a.tahun, a.bulan, a.nopek, a.nilai, a.userid,b.nama as nama_nopek from pay_potongan_insentif a join sdm_master_pegawai b on a.nopek=b.nopeg where a.tahun ='$tahun'  order by a.tahun,a.bulan asc");
            }else{
            $data_list = DB::select("select a.tahun, a.bulan, a.nopek, a.nilai, a.userid,b.nama as nama_nopek from pay_potongan_insentif a join sdm_master_pegawai b on a.nopek=b.nopeg where a.bulan='$bulan' and a.tahun='$tahun' order by a.nopek asc");
            }
        }else{
            if($bulan == null and $tahun = null){
            $data_list = DB::select("select a.tahun, a.bulan, a.nopek, a.nilai, a.userid,b.nama as nama_nopek from pay_potongan_insentif a join sdm_master_pegawai b on a.nopek=b.nopeg where a.nopek='$nopek' order by a.tahun,a.bulan desc");
            }else{
            $data_list = DB::select("select a.tahun, a.bulan, a.nopek, a.nilai, a.userid,b.nama as nama_nopek from pay_potongan_insentif a join sdm_master_pegawai b on a.nopek=b.nopeg where a.nopek='$nopek' and a.bulan='$bulan' and a.tahun='$tahun'" ); 			
            }
        }
        $data_pegawai = DB::select("select nopeg,nama,status,nama from sdm_master_pegawai where status <>'P' order by nopeg");	
        return view('potongan_insentif.index',compact('data_list','data_pegawai'));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_pegawai = SdmMasterPegawai::whereNotIn('status',['P'])->get();
        return view('potongan_insentif.create',compact('data_pegawai'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data_cek = DB::select("select * from pay_potongan_insentif a where a.nopek='$request->nopek' and a.bulan='$request->bulan' and a.tahun='$request->tahun'");			
        if(!empty($data_cek)){
            $data=0;
            return response()->json($data);
        }else {
        $data_tahun = $request->tahun;
        $data_bulan = $request->bulan;
        PayPotonganInsentif::insert([
            'tahun' => $data_tahun,
            'bulan' => $data_bulan,
            'nopek' => $request->nopek,
            'nilai' => $request->nilai,
            'userid' => $request->userid,            
            ]);
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
        $data_list = DB::select("select a.tahun, a.bulan, a.nopek, a.nilai, a.userid,b.nama as nama_nopek from pay_potongan_insentif a join sdm_master_pegawai b on a.nopek=b.nopeg where a.nopek='$nopek' and a.bulan='$bulan' and a.tahun='$tahun'" ); 			
        return view('potongan_insentif.edit',compact('data_list'));
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
      

        PayPotonganInsentif::where('tahun', $request->tahun)
            ->where('bulan',$request->bulan)
            ->where('nopek',$request->nopek)
            ->update([
                'nilai' => $request->nilai,
                'userid' => $request->userid,
            ]);
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
        PayPotonganInsentif::where('tahun', $request->tahun)
        ->where('bulan',$request->bulan)
        ->where('nopek',$request->nopek)
        ->delete();
        return response()->json();
    }
}
