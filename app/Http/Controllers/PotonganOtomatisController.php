<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PayPotonganRevo;
use App\Models\PayAard;
use App\Models\SdmMasterPegawai;
use DB;
use PDF;
use Excel;
use Alert;

class PotonganOtomatisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('potongan_otomatis.index');
    }

    public function indexJson()
    {
        $koreksi_gaji_list = DB::table('pay_potongan_revo as a')
                        ->join('sdm_master_pegawai as b', 'a.nopek', '=', 'b.nopeg')
                        ->join('pay_tbl_aard as c', 'a.aardpot', '=', 'c.kode')
                        ->select('a.*', 'b.nama','c.nama as nama_aard')
                        ->orderBy('a.tahun', 'asc')->get();
        
        return datatables()->of($koreksi_gaji_list)
        ->addColumn('action', function ($row) {
                return '<label  class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" class="btn-radio" tahun="'.$row->tahun.'" bulan="'.$row->bulan.'" nopek="'.$row->nopek.'" aard="'.$row->aardpot.'" nama="'.$row->nama.'" name="btn-radio"><span></span></label>';
        })
        ->addColumn('tahun', function ($row) {
            return $row->tahun;
        })
        ->addColumn('nama', function ($row) {
            return "$row->nopek - $row->nama";
        })
        ->addColumn('aard', function ($row) {
            return "$row->aardpot - $row->nama_aard";
        })
        ->addColumn('jmlcc', function ($row) {
            return number_format($row->jmlcc, 0, '', '');
        })
        ->addColumn('ccl', function ($row) {
            return number_format($row->ccl,0,'','');
        })
        ->addColumn('nilai', function ($row) {
            return currency_idr($row->nilai);
        })
        ->addColumn('akhir', function ($row) {
            return currency_idr($row->akhir);
        })
        ->addColumn('total', function ($row) {
            return currency_idr($row->totalhut);
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
        $data_pegawai = SdmMasterPegawai::whereNotIn('status',['P'])->get();
        $pay_potongan = PayAard::whereIn('kode',['18','28','19','44'])->get();
        $pay_aard = PayAard::where('jenis', '09')->get();
        $pay_aard = PayAard::where('jenis', 10)->get();
        return view('potongan_otomatis.create', compact('data_pegawai','pay_aard'));
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
        PayPotonganRevo::insert([
            'tahun' => $data_tahun,
            'bulan' => $data_bulan,
            'nopek' => $request->nopek,
            'aard' => $request->aard,
            'jmlcc' => $request->jmlcc,
            'ccl' => $request->ccl,
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
            $data_list =DB::table('pay_potongan_revo as a')
                        ->join('sdm_master_pegawai as b', 'a.nopek', '=', 'b.nopeg')
                        ->join('pay_tbl_aard as c', 'a.aardpot', '=', 'c.kode')
                        ->where('tahun', $tahun)
                        ->where('bulan',$bulan)
                        ->where('nopek',$nopek)
                        ->where('aardpot',$aard)
                        ->select('a.*', 'b.nama as nama_pegawai','b.status','c.nama as nama_aard')
                        ->get();
        foreach($data_list as $data)
        {
            $data_aardhut = $data->aardhut;
        }
        $data_pegawai = SdmMasterPegawai::whereNotIn('status',['P'])->get();
        $pay_hutang = PayAard::where('kode',$data_aardhut)->get();
        return view('potongan_otomatis.edit',compact('data_list','data_pegawai','pay_hutang'));
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

        PayPotonganRevo::where('tahun', $request->tahun)
            ->where('bulan',$request->bulan)
            ->where('nopek',$request->nopeks)
            ->where('aardpot',$request->aardpots)
            ->update([
                'jmlcc' => $request->jmlcc,
                'ccl' => $request->ccl,
                'nilai' => $request->nilai,
                'akhir' => $request->akhir,
                'totalhut' => $request->totalhut,
                'userid'    => $request->userid,
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
        PayPotonganRevo::where('tahun', $request->tahun)
        ->where('bulan',$request->bulan)
        ->where('nopek',$request->nopek)
        ->delete();
        return response()->json();
    }
}
