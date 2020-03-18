<?php

namespace App\Http\Controllers;

use App\UmuBayarModel;
use App\UmuBayarDetailModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class PermintaanBayarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('permintaan_bayar.index');
    }

    public function indexJson()
    {
        $bayar_list = UmuBayarModel::all();
        
        return datatables()->of($bayar_list)
            ->addColumn('no_bayar', function ($row) {
                return $row->no_bayar;
            })
            ->addColumn('no_kas', function ($row) {
                return $row->no_kas;
            })
            ->addColumn('kepada', function ($row) {
                return $row->kepada;
            })
            ->addColumn('keterangan', function ($row) {
                return $row->keterangan;
            })
            ->addColumn('lampiran', function ($row) {
                return $row->lampiran;
            })
            ->addColumn('nilai', function ($row) {
                return currency_idr($row->nilai);
            })
            ->addColumn('action', function ($row) {
                if($row->app_pbd == 'Y'){
                    $button = '<p align="center"><span style="font-size: 2em;" class="kt-font-success"><i class="fas fa-check-circle" title="Data Sudah di proses perbendaharaan"></i></span></p>';
                }else{
                    if($row->app_sdm == 'Y'){
                        $button = '<p align="center"><a href="#"><span style="font-size: 2em;" class="kt-font-warning"><i class="fas fa-check-circle" title="Batalkan Approval"></i></span></a></p>';
                    }else{
                        $button = '<p align="center"><a href="#"><span style="font-size: 2em;" class="kt-font-danger"><i class="fas fa-ban" title="Klik untuk Approval"></i></span></a></p>';
                    }
                }
                return $button;
            })
            ->addColumn('action_radio', function ($row) {
                $radio = '<label class="kt-radio"><input type="radio" name="radio1"><span></span></label>';
                return $radio;
            })
            ->rawColumns(['action_radio','action'])
            ->make(true);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permintaan_bayar.create');
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
