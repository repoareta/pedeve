<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PayHonor;
use App\Models\PayAard;
use App\Models\SdmMasterPegawai;
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
        $data_pegawai = SdmMasterPegawai::all();
        return view('potongan_manual.create', compact('data_pegawai'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data_tahun = substr($request->bulantahun,3);
        $data_bulan = ltrim(substr($request->bulantahun,0,-5), '0');
        PayHonor::insert([
            'tahun' => $data_tahun,
            'bulan' => $data_bulan,
            'nopek' => $request->nopek,
            'aard' => 30,
            'jmlcc' => 0,
            'ccl' => 0,
            'nilai' => $request->nilai,
            'userid' => $request->userid,
            'pajak' => $request->pajak,
            
            // Save Panjar Header
            ]);
            return response()->json();
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
        $data_list = PayHonor::where('tahun', $tahun)
            ->where('bulan',$bulan)
            ->where('nopek',$nopek)
            ->where('aard',$aard)
            ->get();
        $data_pegawai = SdmMasterPegawai::all();
        return view('potongan_manual.edit',compact('data_list','data_pegawai'));
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
        $data_tahun = substr($request->bulantahun,-4);
        $data_bulan = ltrim(substr($request->bulantahun,0,-5), '0');

            PayHonor::where('tahun', $request->tahun)
            ->where('bulan',$request->bulan)
            ->where('nopek',$request->nopeks)
            ->update([
                'tahun' => $data_tahun,
                'bulan' => $data_bulan,
                'nopek' => $request->nopek,
                'jmlcc' => 0,
                'ccl' => 0,
                'nilai' => $request->nilai,
                'userid' => $request->userid,
                'pajak' => $request->pajak,
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
        PayHonor::where('tahun', $request->tahun)
        ->where('bulan',$request->bulan)
        ->where('nopek',$request->nopek)
        ->where('aard',$request->aard)
        ->delete();
        return response()->json();
    }
}
