<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fiosd201;
use Auth;
use DB;
use Session;
use DomPDF;
use Alert;

class MasterPekerjaController extends Controller
{
    public function index()
    {
        return view('master_pekerja.index');
    }
    public function indexJson(Request $request)
     {
         $data = DB::select("select a.*, a.status as statusnya from tab_view_pekerja a order by a.nopek");
         return datatables()->of($data)
         ->addColumn('namaprshn', function ($data) {
             return $data->namaprshn;
        })
         ->addColumn('kode', function ($data) {
             return $data->kode;
        })
         ->addColumn('nama', function ($data) {
             return $data->nama;
        })
         ->addColumn('alamat', function ($data) {
             return $data->alamat;
        })       
         ->addColumn('kota', function ($data) {
             return $data->kota;
        })
         ->addColumn('telp', function ($data) {
             return $data->telp;
        })
         ->addColumn('radio', function ($data) {
             $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" kode="'.$data->kode.'" class="btn-radio" name="btn-radio"><span></span></label>'; 
             return $radio;
         })
         ->rawColumns(['radio'])
         ->make(true); 
     }
 
     public function create()
     {
         $data_perusahaan = DB::select("select * from tab_tbl_prshn");
         return view('master_pekerja.create',compact('data_perusahaan'));
     }
     public function store(Request $request)
     {
         $data = DB::select("select * from tab_tbl_unit where kode='$request->kode'");
         if(!empty($data)){
             $data2 = 2;
             return response()->json($data2);
         }else{
         DB::table('tab_tbl_unit')->insert([
            'tembusan' => $request->tembusan ,
            'skdari' => $request->skdari ,
            'kode' => $request->kode ,
            'nama' => $request->nama ,
            'perusahaan' => $request->perusahaan ,
            'alamat' => $request->alamat ,
            'kota' => $request->kota ,
            'telp' => $request->telp ,
            'facs' => $request->facs ,
            'sanper' => $request->sanper ,
            'kepada' => $request->kepada ,
            'bantu' => $request->bantu 
             ]);
             $data = 1;
             return response()->json($data);
         }
     }
     public function edit($kode)
     {
        $data_perusahaan = DB::select("select * from tab_tbl_prshn");
         $data = DB::select("select * from tab_tbl_unit where kode='$kode'");
         foreach($data as $dat)
         {
            $tembusan = $dat->tembusan;
            $skdari = $dat->skdari;
            $kode = $dat->kode;
            $nama = $dat->nama;
            $perusahaan = $dat->perusahaan;
            $alamat = $dat->alamat;
            $kota = $dat->kota;
            $telp = $dat->telp;
            $facs = $dat->facs;
            $sanper = $dat->sanper;
            $kepada = $dat->kepada;
            $bantu = $dat->bantu;
         }
         return view('master_pekerja.edit',compact(
             'data_perusahaan',
             'tembusan',
             'skdari',
             'kode',
             'kode',
             'nama',
             'perusahaan',
             'alamat',
             'kota',
             'telp',
             'facs',
             'sanper',
             'kepada',
             'bantu'
            ));
     }
     public function update(Request $request)
     {
         DB::table('tab_tbl_unit')->where('kode', $request->kode)
         ->update([
            'tembusan' => $request->tembusan ,
            'skdari' => $request->skdari ,
            'nama' => $request->nama ,
            'perusahaan' => $request->perusahaan ,
            'alamat' => $request->alamat ,
            'kota' => $request->kota ,
            'telp' => $request->telp ,
            'facs' => $request->facs ,
            'sanper' => $request->sanper ,
            'kepada' => $request->kepada ,
            'bantu' => $request->bantu 
             ]);
             return response()->json();
     }
     public function delete(Request $request)
     {
         DB::table('tab_tbl_unit')->where('kode', $request->kode)->delete();
             return response()->json();
     }
}
