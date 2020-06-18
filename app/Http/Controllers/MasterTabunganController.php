<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PayTblTabungan;
use DB;
use PDF;
use Excel;
use Alert;

class MasterTabunganController extends Controller
{

    public function index()
    {
        return view('master_tabungan.index');
    }

    public function indexJson()
    {
        $data = PayTblTabungan::all();
        
        return datatables()->of($data)
        ->addColumn('radio', function ($row) {
                return '<p align="center"><label  class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" class="btn-radio" kode="'.number_format($row->perusahaan,0).'" name="btn-radio"><span></span></label></p>';
        })
        ->addColumn('perusahaan', function ($row) {
             return number_format($row->perusahaan,0);
        })
        ->rawColumns(['radio'])
            ->make(true);
    }


    public function create()
    {
        return view('master_tabungan.create');
    }


    public function store(Request $request)
    {
        $data_cek = DB::select("select * from pay_tbl_tabungan" ); 			
        if(!empty($data_cek)){
            $data=2;
            return response()->json($data);
        }else {
        PayTblTabungan::insert([
            'perusahaan' => $request->perusahaan,
            ]);
            $data = 1;
            return response()->json($data);
        }
    }


    public function edit($id)
    {
        $data_list = PayTblTabungan::where('perusahaan', $id)->get();
        foreach($data_list as $data)
        {
            $perusahaan = $data->perusahaan;
        }
        return view('master_tabungan.edit',compact('perusahaan'));
    }


    public function update(Request $request)
    {
        PayTblTabungan::where('perusahaan',$request->kode)
            ->update([
                'perusahaan' => $request->perusahaan,
            ]);
            return response()->json();
    }


    public function delete(Request $request)
    {
        PayTblTabungan::where('perusahaan', $request->kode)
        ->delete();
        return response()->json();
    }
}
