<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bulankontroller;
use Auth;
use DB;
use Session;
use DomPDF;
use Alert;

class BulanKontrolerController extends Controller
{
    public function index()
    {
        return view('bulan_kontroler.index');
    }

    public function searchIndex(Request $request)
    {
        $data = DB::select("select thnbln,status,opendate,stopdate,closedate,description,suplesi from bulankontroller order by thnbln desc");
        return datatables()->of($data)
        ->addColumn('thnbln', function ($data) {
            return $data->thnbln;
       })
        ->addColumn('nama_status', function ($data) {
            if($data->status == "1"){
                $nama_status = "OPENING";
             }elseif($data->status == "2"){
                $nama_status = "STOPING";
             }else{
                $nama_status = "CLOSING";
             }
            return $nama_status;
       })
        ->addColumn('data_buka', function ($data) {
            if($data->opendate <> ""){
                $tgl = date_create($data->opendate);
                $data_buka = date_format($tgl, 'd/m/Y');
            }else{
                $data_buka = "";
            }
            return $data_buka;
       })
        ->addColumn('data_stop', function ($data) {
            if($data->stopdate <> ""){
                $tgl = date_create($data->stopdate);
                $data_stop = date_format($tgl, 'd/m/Y');
            }else{
                $data_stop = "";
            }
            return $data_stop;
       })
        ->addColumn('data_tutup', function ($data) {
            if($data->closedate <> ""){
                $tgl = date_create($data->closedate);
                $data_tutup = date_format($tgl, 'd/m/Y');
            }else{
                $data_tutup = "";
            }
            return $data_tutup;
       })
        ->addColumn('description', function ($data) {
            return $data->description;
       })
        ->addColumn('suplesi', function ($data) {
            return $data->suplesi;
       })
        ->addColumn('radio', function ($data) {
            $radio = '<center><label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" kode="'.$data->thnbln.'" class="btn-radio" name="btn-radio"><span></span></label></center>'; 
            return $radio;
        })
        ->rawColumns(['radio'])
        ->make(true); 
    }

    public function create()
    {
        return view('bulan_kontroler.create');
    }
    public function store(Request $request)
    {
        $tahun = $request->tahun;
		$bulan = $request->bulan;
		$thnbln = $tahun.''.$bulan;
		$suplesi = $request->suplesi;
		$keterangan = $request->keterangan;
		$status = $request->status;
		$opendate = $request->tanggal;
		$stopdate = $request->tanggal2;
		$closedate = $request->tanggal3;
		
		if($opendate <> ""){
		   $opendate1 = $request->tanggal;
        }else{
		   $opendate1 = null;
        }
		if($stopdate <> ""){
		   $stopdate1 = $request->tanggal2;
        }else{
		   $stopdate1 = null;
        }
		if($closedate <> ""){
		   $closedate1 = $request->tanggal3;
        }else{
		  $closedate1 = null;
        }
        $data_objRs = DB::select("select * from bulankontroller where thnbln='$thnbln'");
        if(!empty($data_objRs)){
            $data = 2;
            return response()->json($data);
        }else{
            $userid = Auth::user()->userid;
            Bulankontroller::insert([
                'thnbln' => $thnbln,
                'status' => $status ,
                'opendate' => $opendate1 ,
                'stopdate' => $stopdate1 ,
                'closedate' => $closedate1 ,
                'description' => $keterangan ,
                'userid' => $userid,
                'password' => $userid,
                'suplesi' => $suplesi 
            ]);
            $data = 1;
            return response()->json($data);
        }
    }

    public function edit($no)
    {
        $data_cash = DB::select("select * from bulankontroller where thnbln='$no'");
        foreach($data_cash as $data)
        {
                    $thnbln =     $data->thnbln;
                    $status  =     $data->status;
                    if($data->opendate<>""){
                        $tgl = date_create($data->opendate);
                        $tanggal  =   date_format($tgl, 'Y-m-d');
                    }else{
                        $tanggal  =   "";
                    }
                    if($data->stopdate<>""){
                        $tgl2 = date_create($data->stopdate);
                        $tanggal2 =   date_format($tgl2, 'Y-m-d');
                    }else{
                        $tanggal2 =   "";
                    }
                    if($data->closedate<>""){
                        $tgl3 = date_create($data->closedate);
                        $tanggal3 =  date_format($tgl3, 'Y-m-d');
                    }else{
                        $tanggal3 =  "";
                    }
                    $keterangan  =$data->description;
                    $suplesi =    $data->suplesi; 
        }
        return view('bulan_kontroler.edit',compact('thnbln','status','tanggal','tanggal2','tanggal3','keterangan','suplesi'));
    }
    public function update(Request $request)
    {
        $tahun = $request->tahun;
		$bulan = $request->bulan;
		$thnbln = $tahun.''.$bulan;
		$suplesi = $request->suplesi;
		$keterangan = $request->keterangan;
		$status = $request->status;
		$opendate = $request->tanggal;
		$stopdate = $request->tanggal2;
        $closedate = $request->tanggal3;
        $userid = Auth::user()->userid;
		
		if($opendate <> ""){
		   $opendate1 = $request->tanggal;
        }else{
		   $opendate1 = null;
        }
		if($stopdate <> ""){
		   $stopdate1 = $request->tanggal2;
        }else{
		   $stopdate1 = null;
        }
		if($closedate <> ""){
		   $closedate1 = $request->tanggal3;
        }else{
		  $closedate1 = null;
        }
        Bulankontroller::where('thnbln',$thnbln)
        ->update([
            'status' => $status ,
            'opendate' => $opendate1 ,
            'stopdate' => $stopdate1 ,
            'closedate' => $closedate1 ,
            'description' => $keterangan ,
            'userid' => $userid,
            'password' => $userid,
            'suplesi' => $suplesi 
        ]);
        return response()->json();
    }

    public function delete(Request $request)
    {
        Bulankontroller::where('thnbln',$request->kode)->delete();
        return response()->json();
    }
}
