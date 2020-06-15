<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cashjudex;
use Auth;
use DB;
use Session;
use PDF;
use Alert;

class CashJudexController extends Controller
{
    public function index()
    {
        return view('cash_judex.index');
    }

    public function searchIndex(Request $request)
    {
        if($request->pencarian <> ""){
            $data = DB::select("select a.* from cashjudex a where a.kode like '%$request->pencarian%' or a.nama like '%$request->pencarian%'");
        }else{
            $data = DB::select("select a.* from cashjudex a order by a.kode");
        }	
        return datatables()->of($data)
        ->addColumn('kode', function ($data) {
            return $data->kode;
       })
        ->addColumn('nama', function ($data) {
            return $data->nama;
       })
        ->addColumn('radio', function ($data) {
            $radio = '<center><label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" kode="'.$data->kode.'" class="btn-radio" name="btn-radio"><span></span></label></center>'; 
            return $radio;
        })
        ->rawColumns(['radio'])
        ->make(true); 
    }

    public function create()
    {
        return view('cash_judex.create');
    }
    public function store(Request $request)
    {
        $data_objRs = DB::select("select kode from cashjudex where kode='$request->kode'");
        if(!empty($data_objRs)){
            $data = 2;
            return response()->json($data);
        }else{
            Cashjudex::insert([
                'kode' => $request->kode,
                'nama' => $request->nama
            ]);
            $data = 1;
            return response()->json($data);
        }

    }

    public function edit($no)
    {
        $data_cash = DB::select("select * from cashjudex where kode='$no'");
        foreach($data_cash as $data)
        {
            $kode = $data->kode;
            $nama = $data->nama;
        }
        return view('cash_judex.edit',compact('kode','nama'));
    }
    public function update(Request $request)
    {
        Cashjudex::where('kode',$request->kode)
        ->update([
            'nama' => $request->nama
        ]);
        return response()->json();
    }

    public function delete(Request $request)
    {
        Cashjudex::where('kode',$request->kode)->delete();
        return response()->json();
    }
}
