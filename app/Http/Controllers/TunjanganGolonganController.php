<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PayTunjangan;
use DB;
use DomPDF;
use Excel;
use Alert;

class TunjanganGolonganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tunjangan_golongan.index');
    }

    public function indexJson()
    {
        $tunjangan_list = PayTunjangan::all();
        
        return datatables()->of($tunjangan_list)
        ->addColumn('action', function ($row) {
                return '<p align="center"><label  class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" class="btn-radio" golongan="'.$row->golongan.'" name="btn-radio"><span></span></label></p>';
        })
        ->addColumn('golongan', function ($row) {
             return '<p align="center">'.$row->golongan.'</p>';
        })
        ->addColumn('nilai', function ($row) {
            return '<p align="center">'.currency_idr($row->nilai).' </p>';
        })
        ->rawColumns(['action','golongan','nilai'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(DB::select("select golongan from pay_tbl_tunjangan where golongan = 'P2'"));
        return view('tunjangan_golongan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cekGolonganJson(Request $request)
    {
        $data=PayTunjangan::where('golongan', $request->golongan)->count();
            return response()->json($data);
    }
    public function store(Request $request)
    {
        $data_cek = DB::select("select * from pay_tbl_tunjangan   where golongan='$request->golongan'" ); 			
        if(!empty($data_cek)){
            $data=0;
            return response()->json($data);
        }else {
        PayTunjangan::insert([
            'golongan' => $request->golongan,
            'nilai' => str_replace(',', '.', $request->nilai),
            ]);
            $data = 1;
            return response()->json($data);
        }
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
        $data_list = PayTunjangan::where('golongan', $id)->get();
        return view('tunjangan_golongan.edit',compact('data_list'));
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
        PayTunjangan::where('golongan', $request->golongan)
            ->update([
                'nilai' => str_replace(',', '.', $request->nilai),
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
        PayTunjangan::where('golongan', $request->golongan)
        ->delete();
        return response()->json();
    }
}
