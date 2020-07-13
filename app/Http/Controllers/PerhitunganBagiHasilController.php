<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rekapkas;
use App\Models\Penempatandepo;
use App\Models\Kasline;
use App\Models\Mtrdeposito;
use App\Models\Dtldepositotest;
use DB;
use PDF;
use Excel;
use Alert;

class PerhitunganBagiHasilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->tanggal<>""){
            $date = $request->tanggal;
        }else{
            if ($request->tanggal == "") {
                $date = date('Y-m-d');
            }else{
                $date = $request->tanggal;
            }
        }
        
        $data_list = DB::select("select docno,lineno,tgldepo,tgltempo,bungatahun,asal,noseri,nominal as asli,(select sum(case when kurs<>'1' then nominal else 0 end) from penempatandepo where tgltempo > '$date' and tgldepo <= '$date') as totaldollar,(select sum(case when kurs='1' then nominal else 0 end) from penempatandepo where tgltempo > '$date' and tgldepo <= '$date') as totalrupiah,(select sum(case when kurs<>'1' then nominal*kurs else 0 end) from penempatandepo where tgltempo > '$date' and tgldepo <= '$date') as ekivalen,(select sum(case when kurs='1' then nominal else nominal*kurs end) from penempatandepo where tgltempo > '$date' and tgldepo <= '$date') as total,((case when kurs='1' then nominal else nominal*kurs end)/(select sum(case when kurs='1' then nominal else nominal*kurs end) from penempatandepo where tgltempo > '$date' and tgldepo <= '$date'))*bungatahun as rtimbang,(select sum(((case when kurs='1' then nominal else nominal*kurs end)/(select sum(case when kurs='1' then nominal else nominal*kurs end) from penempatandepo where tgltempo > '$date' and tgldepo <= '$date'))*bungatahun) from penempatandepo where tgltempo > '$date' and tgldepo <= '$date') as totalrata,(select descacct from account where kodeacct=kdbank) as nmbank,keterangan,kurs,statcair,doccair,linecair from penempatandepo where tgltempo > '$date' and tgldepo <= '$date' order by tgltempo asc;");
        return view('perhitungan_bagihasil.index',compact('data_list','date'));
    }
    
    public function delete(Request $request)
    {
        $nodok=str_replace('-', '/', $request->nodok);
        Penempatandepo::where('docno', $nodok)->where('lineno', $request->lineno)->delete();
        Kasline::where('docno', $nodok)->where('lineno', $request->lineno)
        ->update([
            'inputpwd' =>  'N',
            ]);
        return response()->json();   
    }
}