<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PayTblJamsostek;
use Auth;
use DB;
use Session;
use PDF;
use Alert;

class JurnalUmumController extends Controller
{
    public function index()
    {
        return view('jurnal_umum.index');
    }

    public function searchIndex(Request $request)
    {
        $rsbulan = DB::select("select max(thnbln) as thnbln from bulankontroller where status='1' and length(thnbln)=6");
        if(!empty($rsbulan)){
            foreach($rsbulan as $dat)
            {
                if(is_null($dat->thnbln)){
                    $thnblopen2 = "";
                }else{
                    $thnblopen2 = $dat->thnbln;
                }
            }
        }else{
            $thnblopen2 = "";
        }
        if($request->bulan <> "" and $request->tahun <> ""){
            $data = DB::select("select  docno, keterangan, jk, store, voucher, posted from jurumdoc  where thnbln ='$request->tahun$request->bulan' order by voucher");
        }elseif($request->bulan == "" and $request->tahun == ""){
            $data = DB::select("select  docno, keterangan, jk, store, voucher, posted from jurumdoc  where thnbln ='$thnblopen2' order by voucher");
        }	
        return datatables()->of($data)
        ->addColumn('docno', function ($data) {
            return $data->docno;
       })
        ->addColumn('keterangan', function ($data) {
            return $data->keterangan;
       })
        ->addColumn('jk', function ($data) {
            return $data->jk;
       })
        ->addColumn('store', function ($data) {
            return $data->store;
       })
        ->addColumn('voucher', function ($data) {
            return $data->voucher;
       })
        ->addColumn('posted', function ($data) {
            return $data->posted;
       })
        ->addColumn('radio', function ($data) {
            $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" value="'.$data->docno.'" class="btn-radio" name="btn-radio"><span></span></label>'; 
            return $radio;
        })
        ->addColumn('action', function ($data) {
            if(Auth::user()->userid <> 'PWC'){
                $action = '<p align="center"><a href="'. route('jurnal_umum.cpyjurnalumum',['id' => str_replace('/', '-', $data->docno)]).'"><span style="font-size: 2em;" class="kt-font-primary pointer-link" data-toggle="kt-tooltip" data-placement="top" title="" style="cursor:hand"><i class="fas fa-paste" ></i></span></a></p>';
            }else{
                $action = '<p align="center"><span style="font-size: 2em;" class="kt-font-success pointer-link" data-toggle="kt-tooltip" data-placement="top" title="" style="cursor:hand"><i class="fas fa-paste" ></i></span></p>';
            }               
            return $action;
        })
        ->rawColumns(['action','radio'])
        ->make(true); 
    }
}
