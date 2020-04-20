<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Saldostore;
use App\Models\Rekapkas;
use DB;
use PDF;
use Excel;
use Alert;

class InisialisasiSaldoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('inisialisasi_saldo.index');
    }

    public function indexJson(Request $request)
    {
        if($request->ajax())
        {               
                $data = DB::select("select a.saldoawal*-1 saldoawal, a.saldoakhir*-1 saldoakhir, a.inputdate, a.inputpwd, a.nokas, a.jk, b.namabank from saldostore a join storejk b on a.nokas=b.kodestore order by a.jk||a.nokas");
                return datatables()->of($data)
                ->addColumn('nokas', function ($data) {
                    return $data->nokas.'-'.$data->namabank;
               })
                ->addColumn('inputdate', function ($data) {
                     $tgl = date_create($data->inputdate);
                     return date_format($tgl, 'd F Y');
               })
                ->addColumn('saldoawal', function ($data) {
                     return 'Rp. ' .number_format($data->saldoawal,2,'.',',');
               })
                ->addColumn('saldoakhir', function ($data) {
                     return 'Rp. '.number_format($data->saldoakhir,2,'.',',');
               })
                ->addColumn('action', function ($data) {
                        $radio = '<label  class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" jk="'.$data->jk.'" nokas="'.$data->nokas.'" class="btn-radio" ><span></span></label>';
                    return $radio;
                })
                ->rawColumns(['action'])
                ->make(true);
            
        }
    }

    public function nokasJson(Request $request)
    {
        $data= DB::select("select a.kodestore,a.namabank,a.norekening from storejk a where a.jeniskartu ='$request->jk' order by a.kodestore");
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inisialisasi_saldo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jk = $request->jk;
        $nokas = $request->nokas;
        $saldoakhir = $request->saldoakhir;
        $tglinput = $request->tanggal;
        $tgl = date_create($tglinput);
        $tahun = date_format($tgl, 'Y');
        
        if($saldoakhir > 0){
        $saldoakhir1 = $saldoakhir * -1;
        }else{
        $saldoakhir1 = $saldoakhir;
        }
        $data_cek = DB::select("select * from saldostore where jk='$jk' and nokas='$nokas'" ); 			
        if(!empty($data_cek)){
            $data=0;
            return response()->json($data);
        }else {
            Saldostore::insert([
                'nokas' => $nokas,
                'saldoawal' => $saldoakhir1,
                'debet' => '0',
                'kredit' => '0',
                'saldoakhir' => $saldoakhir1,
                'jk' => $jk,
                'inputdate' => $tglinput,         
                ]);
            Rekapkas::insert([
                'jk' => $jk,
                'store' =>$nokas,
                'rekap' =>'0',
                'debet' => '0',
                'kredit' => '0',
                'tahun_rekap' => $tahun,
                'saldoawal' => $saldoakhir1,
                'saldoakhir' => $saldoakhir1,
                'tglrekap' => $tglinput,          
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
    public function edit($jk,$nokas)
    {
        $data_list = DB::select("select a.*, b.namabank,b.norekening,b.kodestore from saldostore a join storejk b on a.nokas=b.kodestore where jk='$jk' and nokas='$nokas'" ); 			
        return view('inisialisasi_saldo.edit',compact('data_list'));
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
        Saldostore::where('jk', $request->jk)
            ->where('nokas',$request->nokas)
            ->update([
                'saldoakhir' => $request->saldoakhir,
                'inputdate' => $request->tanggal,
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
        Saldostore::where('jk', $request->jk)
        ->where('nokas',$request->nokas)
        ->delete();
        Rekapkas::where('jk', $request->jk)
        ->where('store',$request->nokas)
        ->delete();
        return response()->json();
    }
}
