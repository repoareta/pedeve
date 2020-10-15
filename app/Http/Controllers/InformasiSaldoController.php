<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rekapkas;
use DB;
use DomPDF;
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

    public function indexJson(Request $request)
    {
        if($request->tanggal <> ""){
            $tanggal = $request->tanggal;
        }else{
            $tanggal=date('d-m-Y');
        }
        
            $data_set = DB::select("select max(to_char(a.tglrekap,'dd-mm-yyyy')) as maxtglrek, max(to_char(now(),'dd-mm-yyyy')) as tglnow from rekapkas a,storejk b where a.store=b.kodestore and a.jk=b.jeniskartu");
            foreach($data_set as $data_s)
            {
                $maxtglrek = $data_s->maxtglrek;
                $tglnow = $data_s->tglnow;
                if($tanggal < $tglnow){  //kalo melihat saldo di tanggal sebelumnya
                    $data =  DB::select("select a.saldoawal as sa,a.debet as db,a.kredit as kr,a.saldoakhir as ak, b.kodestore,b.jeniskartu 
                                        from rekapkas a,storejk b 
                                        where a.store=b.kodestore and a.jk=b.jeniskartu  and a.tglrekap = (select max(c.tglrekap) from rekapkas c,storejk d where to_char( c.tglrekap,'dd-mm-yyyy') = '$request->tanggal' and c.store=d.kodestore and c.jk=d.jeniskartu )");
                    if(!empty($data)){
                    }else{
                        $data =  DB::select("select a.saldoawal as sa,a.debet as db,a.kredit as kr,a.saldoakhir as ak, b.kodestore,b.jeniskartu 
                                        from rekapkas a,storejk b 
                                        where a.store=b.kodestore and a.jk=b.jeniskartu  and a.tglrekap = (select max(c.tglrekap) from rekapkas c,storejk d where to_char( c.tglrekap,'dd-mm-yyyy') < '$request->tanggal' and c.store=d.kodestore and c.jk=d.jeniskartu )");

                    }
                }else{
                    if($maxtglrek == $tglnow){  //kalo pada hari ini udah direkap
                        $data =   DB::select("select a.saldoawal as sa,a.debet as db,a.kredit as kr,a.saldoakhir as ak, b.kodestore,b.jeniskartu 
                                        from rekapkas a,storejk b
                                        where a.store=b.kodestore and a.jk=b.jeniskartu  and a.tglrekap ='$maxtglrek'");
                    }else{    //kalo belum direkap
                        $data =   DB::select("select a.saldoawal as sa,a.debet as db,a.kredit as kr,a.saldoakhir as ak, b.kodestore,b.jeniskartu 
                                                from saldostore a,storejk b 
                                                where a.nokas=b.kodestore and a.jk=b.jeniskartu ");
                    }
                }     
            }
     
                return datatables()->of($data)
                ->addColumn('kodestore', function ($data) {
                    return $data->kodestore.'-'.$data->jeniskartu;
               })
                ->addColumn('ak', function ($data) {
                     return 'Rp. '.number_format($data->ak,2,'.',',');
               })
                ->addColumn('action', function ($data) {
                        $radio = '<label  class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" jk="'.$data->kodestore.'" nokas="'.$data->jeniskartu.'" class="btn-radio" ><span></span></label>';
                    return $radio;
                })
                ->rawColumns(['action'])
                ->make(true);
            
    }
}
