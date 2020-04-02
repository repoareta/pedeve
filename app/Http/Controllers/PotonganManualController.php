<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PayHonor;
use DB;
use PDF;
use Excel;
use Alert;

class PotonganManualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('potongan_manual.index');
    }

    public function indexJson()
    {
        $koreksi_gaji_list = DB::table('pay_honorarium as a')
                        ->join('sdm_master_pegawai as b', 'a.nopek', '=', 'b.nopeg')
                        ->select('a.*', 'b.nama')
                        ->orderBy('a.tahun', 'desc')->get();
        
        return datatables()->of($koreksi_gaji_list)
        ->addColumn('action', function ($row) {
                return '<label  class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" class="btn-radio" tahun="'.$row->tahun.'" bulan="'.$row->bulan.'" nopek="'.$row->nopek.'" aard="'.$row->aard.'" nama="'.$row->nama.'" name="btn-radio"><span></span></label>';
        })
        ->addColumn('nama', function ($row) {
            return "$row->nopek - $row->nama";
        })
        ->addColumn('nilai', function ($row) {
            return currency_idr($row->nilai);
        })
        ->addColumn('pajak', function ($row) {
            return currency_idr($row->pajak);
        })
        ->addColumn('tahun', function ($row) {
            return $row->tahun;
        })
        
        ->addColumn('bulan', function ($row) {
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
            $bulan= strtoupper($array_bln[$row->bulan]);
            return $bulan;
        })
        ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function delete(Request $request)
    {
        PayHonor::where('tahun', $request->tahun)
        ->where('bulan',$request->bulan)
        ->where('nopek',$request->nopek)
        ->where('aard',$request->aard)
        ->delete();
        return response()->json();
    }
}
