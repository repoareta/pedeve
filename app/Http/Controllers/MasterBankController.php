<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PayTblBank;
use DB;
use DomPDF;
use Excel;
use Alert;

class MasterBankController extends Controller
{

    public function index()
    {
        return view('master_bank.index');
    }

    public function indexJson()
    {
        $data = DB::select("select kode, nama, alamat, kota from pay_tbl_bank order by kode asc");
        
        return datatables()->of($data)
        ->addColumn('radio', function ($row) {
                return '<p align="center"><label  class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" class="btn-radio" kode="'.$row->kode.'" name="btn-radio"><span></span></label></p>';
        })
        ->addColumn('kode', function ($row) {
             return '<center>'.$row->kode.'</center>';
        })
        ->addColumn('nama', function ($row) {
             return $row->nama;
        })
        ->addColumn('alamat', function ($row) {
             return $row->alamat;
        })
        ->addColumn('kota', function ($row) {
             return $row->kota;
        })
        ->rawColumns(['radio','kode','alamat','kota'])
            ->make(true);
    }


    public function create()
    {
        return view('master_bank.create');
    }


    public function store(Request $request)
    {
        $data_cek = DB::select("select * from pay_tbl_bank where kode = '$request->kode'" ); 			
        if(!empty($data_cek)){
            $data=2;
            return response()->json($data);
        }else {
        PayTblBank::insert([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            ]);
            $data = 1;
            return response()->json($data);
        }
    }


    public function edit($id)
    {
        $data_list = PayTblBank::where('kode', $id)->get();
        foreach($data_list as $data)
        {
            $kode = $data->kode;
            $nama = $data->nama;
            $alamat = $data->alamat;
            $kota = $data->kota;
        }
        return view('master_bank.edit',compact('kode','nama','alamat','kota'));
    }


    public function update(Request $request)
    {
        PayTblBank::where('kode', $request->kode)
            ->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'kota' => $request->kota,
            ]);
            return response()->json();
    }


    public function delete(Request $request)
    {
        PayTblBank::where('kode', $request->kode)
        ->delete();
        return response()->json();
    }
}
