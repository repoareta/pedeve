<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SdmMasterPegawai;
use DB;
use PDF;
use Excel;
use Alert;

class KasCashJudexController extends Controller
{
    public function create1()
    {
        $data_tahun = DB::select("select max(tahun||bulan||supbln) as sbulan from fiosd201");
        $data_kodelok = DB::select("select kodelokasi,nama from mdms");
        $data_sanper = DB::select("select kodeacct,descacct from account where length(kodeacct)=6 and kodeacct not like '%x%' order by kodeacct desc");
        return view('kas_bank.report1',compact('data_kodelok','data_sanper','data_tahun'));
    }
    
    public function create2()
    {
        $data_tahun = DB::select("select max(tahun||bulan) as thnbln from fiosd201");
        return view('kas_bank.report2',compact('data_tahun'));
    }
    
    public function create3()
    {
        $data_tahun = DB::select("Select max(tahun||bulan) as thnbln from fiosd201");
        return view('kas_bank.report3',compact('data_tahun'));
    }
    
    public function create4()
    {
        $data_judex = DB::select("select kode,nama from cashjudex");
        return view('kas_bank.report4',compact('data_judex'));
    }
    
    public function create5()
    {
        $data_judex = DB::select("select kode,nama from cashjudex");
        return view('kas_bank.report5',compact('data_judex'));
    }
    
    public function create6()
    {
        $data_judex = DB::select("select kode,nama from cashjudex");
        return view('kas_bank.report6',compact('data_judex'));
    }
}
