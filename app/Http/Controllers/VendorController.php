<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use Carbon\Carbon;
use Session;
use DB;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('vendor.index');
    }

    public function indexJson(Request $request)
    {
        if($request->ajax())
        {               
                $data = Vendor::all();
                return datatables()->of($data)
                ->addColumn('action', function ($data) {
                        $radio = '<label  class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" class="btn-radio" data-id="'.$data->vendorid.'" value="'.$data->vendorid.'" name="btn-radio"><span></span></label>';
                    return $radio;
                })
                ->rawColumns(['action'])
                ->make(true);
            
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check_data =  DB::select("select * from tbl_vendor where vendorid = '$request->vendorid'");
        if(!empty($check_data))
        {
            Vendor::where('vendorid', $request->vendorid)
                ->update([
                'nama' => $request->nama,
                'norek' => $request->norek,
                'alamat' => $request->alamat,
                'telpon' => $request->telp,
                ]);
                return response()->json();
            }else{
                DB::table('tbl_vendor')->insert([
                'nama' => $request->nama,
                'norek' => $request->norek,
                'alamat' => $request->alamat,
                'telpon' => $request->telp,
                ]);
                return response()->json();
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
        $data_vendor =  Vendor::where('vendorid', $id)->get();
        return view('vendor.edit', compact('data_vendor'));
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
        Vendor::where('vendorid', $request->id)->delete();
        return response()->json();
    }
}
