<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rekapkas;
use DB;
use PDF;
use Excel;
use Alert;

class InformasiSaldoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('informasi_saldo.index');
    }

    // public function indexJson(Request $request)
    // {
    //     if($request->ajax())
    //     {             
    //         // Set rs1 = Cn.Execute("select max(tglrekap) as maxtglrek, Max(SysDate) as tglnow from rekapkas where store='" & rssaldo("kodestore") & "' And JK='" & rssaldo("jeniskartu") & "'")
    //         // maxTglRek = rs1("maxTglRek")
    //         // If IsNull(rs1("tglNow")) Then
    //         //     tglNow = Date
    //         // Else
    //         //     tglNow = rs1("tglNow")
    //         // End If
    //         if($tanggal < $tglnow){  //kalo melihat saldo di tanggal sebelumnya
    //                 $rsstore = DB::select("select saldoawal as sa,debet as db,kredit as kr,saldoakhir as ak from rekapkas where store='$kodestore' and jk='$jeniskartu' and tglrekap = (select max(tglrekap) from rekapkas where tglrekap='$tanggal' and store='$kodestore' and jk='$jeniskartu')");
    //                 if(!empty($rsstore))    //kalo pada tgl yg diminta
    //                     DB::select("select saldoakhir as sa,0 as db,0 as kr,saldoakhir as ak from rekapkas where store='$kodestoreS' and jk='$jeniskartu'  and tglrekap = (select max(tglrekap) from rekapkas where tglrekap < '$tanggal') and store='$kodestore' and jk='$jeniskartuS' )");
    //                 }
    //         }else{
    //                 if($maxtglrek == $tglnow){  //kalo pada hari ini udah direkap
    //                     DB::select("select saldoawal as sa,debet as db,kredit as kr,saldoakhir as ak from rekapkas where store='$kodestore' and jk='$jeniskartu'  and tglrekap ='$maxtglrek')");
    //                 }else{    //kalo belum direkap
    //                     DB::select("select saldoawal as sa,debet as db,kredit as kr,saldoakhir ak from saldostore where nokas='$kodestore' and jk='$jeniskartu'");
    //                 }
    //         }  

    //             $data = DB::select("select a.saldoawal*-1 saldoawal, a.saldoakhir*-1 saldoakhir, a.inputdate, a.inputpwd, a.nokas, a.jk, b.namabank from saldostore a join storejk b on a.nokas=b.kodestore order by a.jk||a.nokas");
    //             return datatables()->of($data)
    //             ->addColumn('nokas', function ($data) {
    //                 return $data->nokas.'-'.$data->namabank;
    //            })
    //             ->addColumn('inputdate', function ($data) {
    //                  $tgl = date_create($data->inputdate);
    //                  return date_format($tgl, 'd F Y');
    //            })
    //             ->addColumn('saldoawal', function ($data) {
    //                  return 'Rp. ' .number_format($data->saldoawal,2,'.',',');
    //            })
    //             ->addColumn('saldoakhir', function ($data) {
    //                  return 'Rp. '.number_format($data->saldoakhir,2,'.',',');
    //            })
    //             ->addColumn('action', function ($data) {
    //                     $radio = '<label  class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" jk="'.$data->jk.'" nokas="'.$data->nokas.'" class="btn-radio" ><span></span></label>';
    //                 return $radio;
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
            
    //     }
    // }
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
