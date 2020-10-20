<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Model
use App\Models\PerusahaanAfiliasi;
use App\Models\Vendor;
use Carbon\Carbon;
use Session;
use DB;

class MonitoringKinerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('monitoring_kinerja.index');
    }

    public function indexJson(Request $request)
    {
          
        $data =DB::select("select a.*, b.nama from tbl_monitoring a join cm_perusahaan_afiliasi b on a.kd_perusahaan=b.id where a.bulan='$request->bulan' and a.tahun='$request->tahun'");
        return datatables()->of($data)
        ->addColumn('action', function ($data) {
                $radio = '<label  class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" class="btn-radio" data-id="'.$data->kd_monitoring.'" value="'.$data->kd_monitoring.'" name="btn-radio"><span></span></label>';
            return $radio;
        })
        ->addColumn('nama', function ($data) {
                return $data->nama;
        })
        ->addColumn('thnbln', function ($data) {
                return "<p align='center'>$data->bulan/$data->tahun</p>";
        })
        ->addColumn('ci', function ($data) {
                if($data->ci == 1){
                    return "IDR";
                }else{
                    return "USD";
                }
        })
        ->addColumn('total_aset', function ($data) {
                return "<p align='right'>".number_format($data->total_aset,2)."</p>";
        })
        ->addColumn('sales', function ($data) {
            return "<p align='right'>".number_format($data->sales,2)."</p>";
        })
        ->addColumn('laba_bersih', function ($data) {
            return "<p align='right'>".number_format($data->laba_bersih,2)."</p>";
        })
        ->addColumn('tkp', function ($data) {
            return "<p align='right'>".number_format($data->tkp,2)."</p>";
        })
        ->rawColumns(['action','thnbln','total_aset','laba_bersih','sales','tkp'])
        ->make(true);
            
    }

    public function create()
    {
        $data_perusahaan = PerusahaanAfiliasi::all();
        return view('monitoring_kinerja.create',compact('data_perusahaan'));
    }
    public function store(Request $request)
    {
        DB::table('tbl_monitoring')->insert([
        'kd_perusahaan' => $request->nama,
        'ci' => $request->ci,
        'tahun' => $request->tahun,
        'bulan' => $request->bulan,
        'rate' => $request->kurs,
        'total_aset' => str_replace('.', '', $request->total_aset),
        'sales' => str_replace('.', '', $request->sales),
        'laba_bersih' => str_replace('.', '', $request->laba_bersih),
        'tkp' => str_replace('.', '', $request->tkp),
        ]);
        return response()->json(1);
    }

   
    public function edit($id)
    {
        $data_list =  DB::select("select a.*, b.nama from tbl_monitoring a join cm_perusahaan_afiliasi b on a.kd_perusahaan=b.id where kd_monitoring='$id'");
        return view('monitoring_kinerja.edit', compact('data_list'));
    }

    
    public function update(Request $request)
    {
            DB::table('tbl_monitoring')->where('kd_monitoring',$request->kd_monitoring)
            ->update([
            'kd_perusahaan' => $request->nama,
            'ci' => $request->ci,
            'total_aset' => str_replace('.', '', $request->total_aset),
            'sales' => str_replace('.', '', $request->sales),
            'laba_bersih' => str_replace('.', '', $request->laba_bersih),
            'tkp' => str_replace('.', '', $request->tkp),
            ]);
            return response()->json();
    }

    public function delete(Request $request)
    {
        DB::table('tbl_monitoring')->where('kd_monitoring', $request->id)->delete();
        return response()->json();
    }
}
