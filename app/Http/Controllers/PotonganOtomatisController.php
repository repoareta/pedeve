<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PayPotonganRevo;
use App\Models\PayAard;
use App\Models\SdmMasterPegawai;
use DB;
use PDF;
use Excel;
use Alert;

class PotonganOtomatisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_pegawai = DB::select("select nopeg,nama,status,nama from sdm_master_pegawai where status <>'P' order by nopeg");	
        $data_potongan = DB::select("select kode, nama, jenis, kenapajak, lappajak from pay_tbl_aard where kode in('18','28','19','44') order by kode");

        return view('potongan_otomatis.index',compact('data_pegawai','data_potongan'));
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
        $aardpot = $request->aard;

        if($nopek ==  null and $aardpot == null and $bulan == null and $tahun == null){
                $data = DB::select("select a.tahun, a.bulan,a.nopek,a.aardpot,a.jmlcc, a.ccl, a.nilai,a.aardhut,a.awal,a.akhir,a.totalhut,a.userid, b.nama as nama_nopek, c.nama as nama_aardpot  from pay_potongan_revo  a join sdm_master_pegawai b on a.nopek=b.nopeg  join pay_tbl_aard c on a.aardpot=c.kode where a.tahun='$tahuns' order by a.ccl"); 	
        }elseif($nopek == null and $aardpot == null and $bulan == null and $tahun <> null){
                $data = DB::select("select a.tahun, a.bulan,a.nopek,a.aardpot,a.jmlcc, a.ccl, a.nilai,a.aardhut,a.awal,a.akhir,a.totalhut,a.userid, b.nama as nama_nopek, c.nama as nama_aardpot  from pay_potongan_revo a join sdm_master_pegawai b on a.nopek=b.nopeg  join pay_tbl_aard c on a.aardpot=c.kode where a.tahun='$tahun'  order by a.ccl");
        }elseif($nopek == null and $aardpot == null and $bulan <> null and $tahun <> null){
                $data = DB::select("select a.tahun, a.bulan,a.nopek,a.aardpot,a.jmlcc, a.ccl, a.nilai,a.aardhut,a.awal,a.akhir,a.totalhut,a.userid, b.nama as nama_nopek, c.nama as nama_aardpot  from pay_potongan_revo a join sdm_master_pegawai b on a.nopek=b.nopeg  join pay_tbl_aard c on a.aardpot=c.kode where a.tahun='$tahun' and a.bulan='$bulan' order by a.ccl");
        }elseif($nopek <> null and $aardpot == null and $bulan == null and $tahun == null){
                $data = DB::select("select a.tahun, a.bulan,a.nopek,a.aardpot,a.jmlcc, a.ccl, a.nilai,a.aardhut,a.awal,a.akhir,a.totalhut,a.userid, b.nama as nama_nopek, c.nama as nama_aardpot  from pay_potongan_revo a join sdm_master_pegawai b on a.nopek=b.nopeg  join pay_tbl_aard c on a.aardpot=c.kode where a.nopek='$nopek' order by a.ccl");
        }elseif($nopek <> null and $aardpot <> null and $bulan == null and $tahun == null){
                $data = DB::select("select a.tahun, a.bulan,a.nopek,a.aardpot,a.jmlcc, a.ccl, a.nilai,a.aardhut,a.awal,a.akhir,a.totalhut,a.userid, b.nama as nama_nopek, c.nama as nama_aardpot  from pay_potongan_revo a join sdm_master_pegawai b on a.nopek=b.nopeg  join pay_tbl_aard c on a.aardpot=c.kode where a.nopek='$nopek' and a.aardpot='$aardpot' order by a.ccl");
        }elseif($nopek <> null and $aardpot <> null and $bulan <> null and $tahun == null){
                $data = DB::select("select a.tahun, a.bulan,a.nopek,a.aardpot,a.jmlcc, a.ccl, a.nilai,a.aardhut,a.awal,a.akhir,a.totalhut,a.userid, b.nama as nama_nopek, c.nama as nama_aardpot  from pay_potongan_revo a join sdm_master_pegawai b on a.nopek=b.nopeg  join pay_tbl_aard c on a.aardpot=c.kode where a.nopek='$nopek' and a.aardpot='$aardpot' and a.bulan='$bulan' order by a.ccl");
        }elseif($nopek <> null and $aardpot <> null and $bulan <> null and $tahun <> null){
                $data = DB::select("select a.tahun, a.bulan,a.nopek,a.aardpot,a.jmlcc, a.ccl, a.nilai,a.aardhut,a.awal,a.akhir,a.totalhut,a.userid, b.nama as nama_nopek, c.nama as nama_aardpot  from pay_potongan_revo a join sdm_master_pegawai b on a.nopek=b.nopeg  join pay_tbl_aard c on a.aardpot=c.kode where a.nopek='$nopek' and a.aardpot='$aardpot' and a.bulan='$bulan' and a.tahun='$tahun' order by a.ccl");
        }elseif($nopek <> null and $aardpot <> null and $bulan == null and $tahun <> null){
                $data = DB::select("select a.tahun, a.bulan,a.nopek,a.aardpot,a.jmlcc, a.ccl, a.nilai,a.aardhut,a.awal,a.akhir,a.totalhut,a.userid, b.nama as nama_nopek, c.nama as nama_aardpot  from pay_potongan_revo a join sdm_master_pegawai b on a.nopek=b.nopeg  join pay_tbl_aard c on a.aardpot=c.kode where a.nopek='$nopek' and a.aardpot='$aardpot' and a.tahun='$tahun' order by a.ccl");
        }else{
            $data = DB::select("select a.tahun, a.bulan,a.nopek,a.aardpot,a.jmlcc, a.ccl, a.nilai,a.aardhut,a.awal,a.akhir,a.totalhut,a.userid, b.nama as nama_nopek, c.nama as nama_aardpot  from pay_potongan_revo  a join sdm_master_pegawai b on a.nopek=b.nopeg  join pay_tbl_aard c on a.aardpot=c.kode where a.tahun='$tahuns' order by a.ccl"); 	
        }
        return datatables()->of($data)
        ->addColumn('bulan', function ($data) {
            $array_bln	 = array (
                1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
              );
            $bulan= strtoupper($array_bln[$data->bulan]);
            return $bulan;
       })
        ->addColumn('tahun', function ($data) {
            return $data->tahun;
       })
        ->addColumn('nopek', function ($data) {
            return $data->nopek.' -- '.$data->nama_nopek;
       })
        ->addColumn('aardpot', function ($data) {
            return $data->aardpot.' -- '.$data->nama_aardpot;
       })
        ->addColumn('nilai', function ($data) {
             return 'Rp. '.number_format($data->nilai,2,'.',',');
       })
        ->addColumn('akhir', function ($data) {
             return 'Rp. '.number_format($data->akhir,2,'.',',');
       })
        ->addColumn('totalhut', function ($data) {
             return 'Rp. '.number_format($data->totalhut,2,'.',',');
       })
        ->addColumn('jmlcc', function ($data) {
             return number_format($data->jmlcc,0,'.',',');
       })
        ->addColumn('ccl', function ($data) {
             return number_format($data->ccl,0,'.',',');
       })

        ->addColumn('radio', function ($data) {
            $radio = '<label  class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" class="btn-radio" tahun="'.$data->tahun.'" bulan="'.$data->bulan.'" nopek="'.$data->nopek.'" aard="'.$data->aardpot.'" nama="'.$data->nama_nopek.'" name="btn-radio"><span></span></label>';
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
        $data_pegawai = SdmMasterPegawai::whereNotIn('status',['P'])->get();
        $pay_aard = PayAard::whereIn('kode',['18','28','19','44'])->get();
        return view('potongan_otomatis.create', compact('data_pegawai','pay_aard'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data_cek = DB::select("select * from pay_potongan_revo   where nopek='$request->nopek' and aardpot='$request->aard' and bulan='$request->bulan' and tahun='$request->tahun'" ); 			
        if(!empty($data_cek)){
            $data=0;
            return response()->json($data);
        }else {
        $data_tahun = $request->tahun;
        $data_bulan = $request->bulan;
        PayPotonganRevo::insert([
            'tahun' => $data_tahun,
            'bulan' => $data_bulan,
            'nopek' => $request->nopek,
            'aardpot' => $request->aard,
            'jmlcc' => $request->jmlcc,
            'ccl' => $request->ccl,
            'nilai' => $request->nilai,
            'userid' => $request->userid,            
            'aardhut' => 21,            
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
    public function edit($bulan,$tahun,$aard,$nopek)
    {
            $data_list =DB::table('pay_potongan_revo as a')
                        ->join('sdm_master_pegawai as b', 'a.nopek', '=', 'b.nopeg')
                        ->join('pay_tbl_aard as c', 'a.aardpot', '=', 'c.kode')
                        ->where('tahun', $tahun)
                        ->where('bulan',$bulan)
                        ->where('nopek',$nopek)
                        ->where('aardpot',$aard)
                        ->select('a.*', 'b.nama as nama_pegawai','b.status','c.nama as nama_aard')
                        ->get();
        foreach($data_list as $data)
        {
            $data_aardhut = $data->aardhut;
        }
        $pay_hutang = DB::select("select kode, nama, jenis, kenapajak, lappajak from pay_tbl_aard where jenis='09' order by kode");
        return view('potongan_otomatis.edit',compact('data_list','pay_hutang'));
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
        PayPotonganRevo::where('tahun', $request->tahun)
            ->where('bulan',$request->bulan)
            ->where('nopek',$request->nopek)
            ->where('aardpot',$request->aard)
            ->update([
                'jmlcc' => $request->jmlcc,
                'ccl' => $request->ccl,
                'nilai' => $request->nilai,
                'akhir' => $request->akhir,
                'aardhut' => $request->aardhut,
                'totalhut' => $request->totalhut,
                'userid'    => $request->userid,
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
        PayPotonganRevo::where('tahun', $request->tahun)
        ->where('bulan',$request->bulan)
        ->where('nopek',$request->nopek)
        ->where('aardpot',$request->aard)
        ->delete();
        return response()->json();
    }
}
