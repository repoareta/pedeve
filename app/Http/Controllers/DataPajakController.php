<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PajakInput;
use DB;
use DomPDF;
use Excel;
use Alert;

class DataPajakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('data_pajak.index');
    }

    public function indexJson(Request $request)
    {
        if($request->pencarian <> ""){
            $pencarian = $request->pencarian;
        }else{
            $pencarian=date('Y');
        }     
        $data = DB::select("select tahun,bulan,nopek,jenis,nilai,pajak,(select nama from sdm_master_pegawai where nopeg=nopek) as nm_pegawai,(select nama from pay_tbl_aard where kode=jenis) as nm_jenis from pajak_input where tahun like '%$pencarian%' or nopek like '%$pencarian%' order by nopek");
                return datatables()->of($data)
                ->addColumn('tahun', function ($data) {
                    return $data->tahun;
               })
                ->addColumn('bulan', function ($data) {
                    return $data->bulan;
               })
                ->addColumn('pekerja', function ($data) {
                    return $data->nopek.'  -  '.$data->nm_pegawai;
               })
                ->addColumn('jenis', function ($data) {
                    return $data->jenis.'  -  '.$data->nm_jenis;
               })
                ->addColumn('nilai', function ($data) {
                     return 'Rp. '.number_format($data->nilai,2,'.',',');
               })
                ->addColumn('pajak', function ($data) {
                     return 'Rp. '.number_format($data->pajak,2,'.',',');
               })
                ->addColumn('action', function ($data) {
                        $radio = '<label  class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" tahun="'.$data->tahun.'"  bulan="'.$data->bulan.'" jenis="' .$data->jenis.'" nopek="'.$data->nopek.'" class="btn-radio" ><span></span></label>';
                    return $radio;
                })
                ->rawColumns(['action'])
                ->make(true);
            
    }
    
    public function create()
    {
        $data_pegawai = DB::select("select nopeg,nama,status,nama from sdm_master_pegawai order by nopeg");
        return view('data_pajak.create',compact('data_pegawai'));
    }

    public function store(Request $request)
    {
        $data_cek = DB::select("select * from pajak_input where tahun='$request->tahun' and bulan='$request->bulan' and nopek='$request->nopek' and jenis='$request->jenis'");
        if (!empty($data_cek)) {
            $data = 2;
            return response()->json($data);
        }else{
            PajakInput::insert([
            'tahun' => $request->tahun,
            'bulan' => $request->bulan,
            'nopek' => $request->nopek,
            'jenis' => $request->jenis,
            'nilai' => $request->nilai,
            'pajak' => $request->pajak,
            ]);
            $data = 1;
            return response()->json($data);
        }
    }

    public function edit($tahun,$bulan,$nopek, $jenis)
    {
        $data_pegawai = DB::select("select nopeg,nama,status,nama from sdm_master_pegawai order by nopeg");
        $data = DB::select("select * from pajak_input where tahun='$tahun' and bulan='$bulan' and nopek='$nopek' and jenis='$jenis'");
        foreach($data as $dat)
        {
            $tahun = $dat->tahun;
            $bulan = $dat->bulan;
            $jenis = $dat->jenis;
            $nopek = $dat->nopek;
            $nilai = $dat->nilai;
            $pajak = $dat->pajak;
        }
        return view('data_pajak.edit',compact('tahun','bulan','jenis','nopek','nilai','pajak','data_pegawai'));
    }

    public function update(Request $request)
    {
        PajakInput::where('tahun',$request->tahun)
        ->where('bulan',$request->bulan)
        ->where('jenis',$request->jenis)
        ->where('nopek',$request->nopek)
        ->update([
            'nilai' => $request->nilai,
            'pajak' => $request->pajak,
            ]);
            return response()->json();
    }

    public function delete(Request $request)
    {
        PajakInput::where('tahun',$request->tahun)
        ->where('bulan',$request->bulan)
        ->where('jenis',$request->jenis)
        ->where('nopek',$request->nopek)
        ->delete();
        return response()->json();
    }
}
