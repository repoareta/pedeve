<?php

namespace App\Http\Controllers;

use App\UmkModel;
use App\DetailUmkModel;
use Illuminate\Http\Request;
use DataTables;
use DB;

class UangMukaKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tampil()
    {
        return view('Umum.uang_muka_kerja.index');
    }
    public function index(Request $request)
    {
        if($request->ajax())
        {               
                $datas = UmkModel::all()->chunk(100000);
                foreach($datas as $data)
                {
                return DataTables::of($data)
                ->addColumn('action', function($data){
                    if($data->app_pbd == 'Y'){
                        $button = '<p align="center"><img src="'.asset('images/OK.gif').'" style="cursor:hand" title="Data sudah di Approv perbendaharaan"></p>';
                    }else{
                        if($data->app_sdm == 'Y'){
                            $button = '<p align="center"><a align="center" href="ba"><img src="'.asset('images/OK.gif').'" style="cursor:hand" title="Batalkan Approval"></a></p>';
                        }else{
                            $button = '<p align="center"><a align="center" href="app"><img src="'.asset('images/publish_x.png').'" style="cursor:hand" title="Klik untuk Approval"></a></p>';
                        }
                    }
                    return $button;
                })
                ->addColumn('noumk', function($data){
                        $button = '<a align="center" href="/add_umk/'.str_replace('/', '-', $data->no_umk).'">'.$data->no_umk.'</a>';
                    return $button;
                })
                ->addColumn('jenisum', function($data){
                    if($data->jenis_um == 'K'){
                        $button = '<p align="center">UM Kerja</p>';
                    }else{
                        $button = '<p align="center">UM Dinas</p>';
                    }
                    return $button;
                })
                ->addColumn('jumlah', function($data){
                        $button = '<p align="center">Rp. '.number_format($data->jumlah, 0, ',', '.').'</p>';
                    return $button;
                })

                ->addColumn('radio', function($data){
                    $button = '<p align="center"><a align="center"><input type="radio" name="btn-radio"  data-id="'.str_replace('/', '-', $data->no_umk).'" class="btn-radio"  ></a></p>';
                    return $button;
                })
                ->rawColumns(['action','radio','jenisum','jumlah','noumk'])
                ->make(true);
            }
        }
        return view('Umum.uang_muka_kerja.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $awal = "CS";
        $data = DB::select("select left(max(no_umk),-14) as no_umk from kerja_header where  date_part('year', tgl_panjar)  = date_part('year', CURRENT_DATE)");
        foreach ($data as $data_no_umk) {
            $data_no_umk->no_umk;
        }
        $no_umk_max = $data_no_umk->no_umk;
        if(!empty($no_umk_max)) {
            $no_umk= sprintf("%03s", abs($no_umk_max + 1)). '/' . $awal .'/' . date('d/m/Y');
        }else {
            $no_umk= sprintf("%03s", 1). '/' . $awal .'/' . date('d/m/Y');
        }
        // $data_umks = UmkModel::select('*')->where('no_umk', $no_umk);
        // $no_uruts = DetailUmkModel::select('no')->where('no_umk', $no_umk)->max('no');
        // $data_umk_details = DetailUmkModel::where('no_umk',$no_umk);
        // if(!empty($no_uruts) == null)
        // {

        //         $no_umk_details=$no_uruts + 1;

        // }else{
        //     $no_umk_details= 1;
        // }
        return view('Umum.uang_muka_kerja.create', compact('no_umk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
