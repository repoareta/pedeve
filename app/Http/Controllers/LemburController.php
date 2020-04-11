<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailUmk;
use DataTables;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use DB;
use Session;
use PDF;
use Alert;

class LemburController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_list = DB::select("select a.bulan,a.tahun, a.tanggal, a.nopek, a.libur, a.mulai, a.sampai, a.makanpg, a.makansg, a.makanml, a.transport,a.lembur,(a.makanpg+a.makansg+a.makanml+a.transport+a.lembur) as total, b.nama as nama_nopek from pay_lembur a join sdm_master_pegawai b on a.nopek=b.nopeg order by a.tanggal desc");
        $data_pegawai = DB::select("select nopeg,nama,status,nama from sdm_master_pegawai where status <>'P' order by nopeg");	
        return view('lembur.index',compact('data_list','data_pegawai'));
    }


    public function searchIndex(Request $request)
    {
            $tahun = substr($request->tanggal,-4);
            $bulan = ltrim(substr($request->tanggal,0,-5), '0');
            $nopek = $request->nopek;
            $tanggal = $request->tanggal;
            if($nopek == null){
                if($tanggal == null){
                    $data_list = DB::select("select a.bulan,a.tahun, a.tanggal, a.nopek, a.libur, a.mulai, a.sampai, a.makanpg, a.makansg, a.makanml, a.transport,a.lembur,(a.makanpg+a.makansg+a.makanml+a.transport+a.lembur) as total, b.nama as nama_nopek from pay_lembur a join sdm_master_pegawai b on a.nopek=b.nopeg order by a.tanggal desc");
                }else{
                    $data_list = DB::select("select a.bulan,a.tahun, a.tanggal, a.nopek, a.libur, a.mulai, a.sampai, a.makanpg, a.makansg, a.makanml, a.transport,a.lembur,(a.makanpg+a.makansg+a.makanml+a.transport+a.lembur) as total, b.nama as nama_nopek from pay_lembur a join sdm_master_pegawai b on a.nopek=b.nopeg where a.bulan='$bulan' and a.tahun='$tahun' order by a.nopek asc");
                }
            }else{
                if($tanggal == null){
                    $data_list = DB::select("select a.bulan,a.tahun, a.tanggal, a.nopek, a.libur, a.mulai, a.sampai, a.makanpg, a.makansg, a.makanml, a.transport,a.lembur,(a.makanpg+a.makansg+a.makanml+a.transport+a.lembur) as total, b.nama as nama_nopek from pay_lembur a join sdm_master_pegawai b on a.nopek=b.nopeg where a.nopek like '%$nopek%' order by a.tanggal desc");
                }else{
                    $data_list = DB::select("select a.bulan,a.tahun, a.tanggal, a.nopek, a.libur, a.mulai, a.sampai, a.makanpg, a.makansg, a.makanml, a.transport,a.lembur,(a.makanpg+a.makansg+a.makanml+a.transport+a.lembur) as total, b.nama as nama_nopek  from pay_lembur a join sdm_master_pegawai b on a.nopek=b.nopeg where a.bulan='$bulan' and a.tahun='$tahun' and a.nopek like '%$nopek%' order by a.tanggal asc");
                }
            }
        $data_pegawai = DB::select("select nopeg,nama,status,nama from sdm_master_pegawai where status <>'P' order by nopeg");	
        return view('lembur.index',compact('data_list','data_pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_pegawai = DB::select("select nopeg,nama,status,nama from sdm_master_pegawai where status <>'P' order by nopeg");	
        $data_potongan = DB::select("select kode, nama, jenis, kenapajak, lappajak from pay_tbl_aard where kode in ('18','28','19','44') order by kode");	
        return view('lembur.create',compact('data_pegawai','data_potongan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data_cek = DB::select("select * from pay_lembur where to_char(tanggal, 'dd/mm/YYYY') = '$request->tanggal' and nopek='$request->nopek'");
        if(!empty($data_cek)){
            $data=0;
            return response()->json($data);

        }else {
                DB::table('pay_lembur')->insert([
                    'tanggal' => $request->tanggal,
                    'nopek' => $request->nopek, 
                    'makanpg' => $request->makanpg, 
                    'makansg' => $request->makansg, 
                    'makanml' => $request->makanml, 
                    'transport' => $request->transport,
                    'lembur' => $request->lembur, 
                    'userid' => $request->userid,
                    'bulan' => $request->bulan,
                    'tahun' => $request->tahun,
                    ]);
                    $data = 1;
                    return response()->json($data);
            # code...
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($tanggal, $nopek)
    {
        $data_list = DB::select("select bulan,tahun,tanggal,nopek,makanpg, makansg, makanml, transport,lembur, userid from pay_lembur where  to_char(tanggal, 'dd-mm-YYYY')= '$tanggal' and nopek = '$nopek'");
        $data_pegawai = DB::select("select nopeg,nama,status,nama from sdm_master_pegawai where status <>'P' order by nopeg");	
        $data_potongan = DB::select("select kode, nama, jenis, kenapajak, lappajak from pay_tbl_aard where kode in ('18','28','19','44') order by kode");	
        return view('lembur.edit',compact('data_list','data_pegawai','data_potongan'));
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
        DB::update("update pay_lembur set makanpg='$request->makanpg', makansg='$request->makansg', makanml='$request->makanml', transport='$request->transport',lembur='$request->lembur', userid='$request->userid',bulan='$request->bulan',tahun='$request->tahun' where to_char(tanggal, 'dd/mm/YYYY') = '$request->tanggal' and nopek='$request->nopek'");
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
        DB::delete("delete from pay_lembur where to_char(tanggal, 'dd-mm-YYYY') = '$request->tanggal' and nopek='$request->nopek'");
        return response()->json();

    }
}
