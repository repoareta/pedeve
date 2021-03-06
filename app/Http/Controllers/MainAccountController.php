<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mainaccount;
use Auth;
use DB;
use Session;
use DomPDF;
use Alert;

class MainAccountController extends Controller
{
    public function index()
    {
        return view('main_account.index');
    }

    public function searchIndex(Request $request)
    {
        $data = DB::select("select a.* from main_account a order by a.jenis");
        return datatables()->of($data)
        ->addColumn('jenis', function ($data) {
            return $data->jenis;
       })
        ->addColumn('batas_awal', function ($data) {
            return $data->batas_awal;
       })
        ->addColumn('batas_akhir', function ($data) {
            return $data->batas_akhir;
       })
        ->addColumn('urutan', function ($data) {
            return $data->urutan;
       })
        ->addColumn('pengali', function ($data) {
            return number_format($data->pengali,0,'.',',');
       })
        ->addColumn('pengali_tampil', function ($data) {
            return number_format($data->pengali_tampil,0,'.',',');
       })
        ->addColumn('sub_akun', function ($data) {
            return $data->sub_akun;
       })
        ->addColumn('lokasi', function ($data) {
            return $data->lokasi;
       })
        ->addColumn('radio', function ($data) {
            $radio = '<center><label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" kode="'.$data->jenis.'" class="btn-radio" name="btn-radio"><span></span></label></center>'; 
            return $radio;
        })
        ->rawColumns(['radio'])
        ->make(true); 
    }

    public function create()
    {
        return view('main_account.create');
    }
    public function store(Request $request)
    {
        $data_objRs = DB::select("select jenis from main_account where jenis='$request->jenis'");
        if(!empty($data_objRs)){
            $data = 2;
            return response()->json($data);
        }else{
            $jenis = $request->jenis;
            $batasawal= $request->batasawal;
            $batasakhir= $request->batasakhir;
            $urutan = $request->urutan;
            $pengali = $request->pengali;
            $pengalitampil = $request->pengalitampil;
            $subakun = $request->subakun;
            $lokasi = $request->lokasi;
            Mainaccount::insert([
                'jenis' => $jenis,
                'batas_awal' => $batasawal,
                'batas_akhir' => $batasakhir,
                'urutan' => $urutan,
                'pengali' => $pengali,
                'pengali_tampil' => $pengalitampil,
                'sub_akun' => $subakun,
                'lokasi' => $lokasi 
            ]);
            $data = 1;
            return response()->json($data);
        }

    }

    public function edit($no)
    {
        $data_cash = DB::select("select * from main_account where jenis='$no'");
        foreach($data_cash as $data)
        {
            $jenis = $data->jenis;
            $batasawal= $data->batas_awal;
            $batasakhir= $data->batas_akhir;
            $urutan = $data->urutan;
            $pengali = $data->pengali;
            $pengalitampil = $data->pengali_tampil;
            $subakun = $data->sub_akun;
            $lokasi = $data->lokasi;
        }
        return view('main_account.edit',compact('jenis','batasawal','batasakhir','urutan','pengali','pengalitampil','subakun','lokasi'));
    }
    public function update(Request $request)
    {
        $jenis = $request->jenis;
        $batasawal= $request->batasawal;
        $batasakhir= $request->batasakhir;
        $urutan = $request->urutan;
        $pengali = $request->pengali;
        $pengalitampil = $request->pengalitampil;
        $subakun = $request->subakun;
        $lokasi = $request->lokasi;
        Mainaccount::where('jenis',$jenis)
        ->update([
            'batas_awal' => $batasawal,
            'batas_akhir' => $batasakhir,
            'urutan' => $urutan,
            'pengali' => $pengali,
            'pengali_tampil' => $pengalitampil,
            'sub_akun' => $subakun,
            'lokasi' => $lokasi 
        ]);
        return response()->json();
    }

    public function delete(Request $request)
    {
        Mainaccount::where('jenis',$request->kode)->delete();
        return response()->json();
    }
}
