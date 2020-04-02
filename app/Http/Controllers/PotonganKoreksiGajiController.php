<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KoreksiGaji;
use App\Models\PayAard;
use App\Models\SdmMasterPegawai;
use DB;
use PDF;
use Excel;
use Alert;

class PotonganKoreksiGajiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('potongan_koreksi_gaji.index');
    }

    public function indexJson()
    {
        $koreksi_gaji_list = DB::table('pay_koreksigaji as a')
                        ->join('sdm_master_pegawai as b', 'a.nopek', '=', 'b.nopeg')
                        ->join('pay_tbl_aard as c', 'a.aard', '=', 'c.kode')
                        ->select('a.*', 'b.nama','c.nama as nama_aard')
                        ->orderBy('a.tahun', 'desc')->get();
        
        return datatables()->of($koreksi_gaji_list)
        ->addColumn('action', function ($row) {
                return '<label  class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" class="btn-radio" tahun="'.$row->tahun.'" bulan="'.$row->bulan.'" nopek="'.$row->nopek.'" aard="'.$row->aard.'" nama="'.$row->nama.'" name="btn-radio"><span></span></label>';
        })
        ->addColumn('nama', function ($row) {
            return "$row->nopek - $row->nama";
        })
        ->addColumn('aard', function ($row) {
            return "$row->aard - $row->nama_aard";
        })
        ->addColumn('nilai', function ($row) {
            return currency_idr($row->nilai);
        })
        
        ->addColumn('tahunbulan', function ($row) {
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
            return $bulan." ".$row->tahun;
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
        $pay_aard = PayAard::where('jenis', 10)->get();
        return view('potongan_koreksi_gaji.create', compact('pay_aard','data_pegawai'));
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
            KoreksiGaji::insert([
            'tahun' => $data_tahun,
            'bulan' => $data_bulan,
            'nopek' => $request->nopek,
            'aard' => $request->aard,
            'jmlcc' => 0,
            'ccl' => 0,
            'nilai' => $request->nilai,
            'userid' => $request->userid,
            
            // Save Panjar Header
            ]);
            return response()->json();
    }
    public function update(Request $request)
    {
        $data_tahun = substr($request->bulantahun,3);
        $data_bulan = ltrim(substr($request->bulantahun,0,-5), '0');

            KoreksiGaji::where('tahun', $data_tahun)
            ->where('bulan',$data_bulan)
            ->where('nopek',$request->nopek)
            ->where('aard',$request->aard)
            ->update([
                'tahun' => $data_tahun,
                'bulan' => $data_bulan,
                'nopek' => $request->nopek,
                'aard' => $request->aard,
                'jmlcc' => 0,
                'ccl' => 0,
                'nilai' => $request->nilai,
                'userid' => $request->userid,
            ]);
            return response()->json();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        KoreksiGaji::where('tahun', $request->tahun)
        ->where('bulan',$request->bulan)
        ->where('nopek',$request->nopek)
        ->where('aard',$request->aard)
        ->delete();
        return response()->json();
    }
}
