<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kasdoc;
use DB;
use PDF;
use Excel;
use Alert;

class PembayaranPkppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_tahunbulan = DB::select("select max(thnbln) as bulan_buku from timetrans where status='1' and length(thnbln)='6'");
        if(!empty($data_tahunbulan)){
            foreach($data_tahunbulan as $data_bul)
            {
                $bulan_buku = $data_bul->bulan_buku;
            }
        }else{
            $bulan_buku = '0';
        }
        $tahun = substr($bulan_buku,0,-2);
        $data_list = Kasdoc::where('thnbln',$bulan_buku)->get();
        return view('pembayaran_pkpp.index',compact('data_list'));
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
    public function destroy($id)
    {
        //
    }
}
