<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurumdoc;
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
        if($request->bulan<>"" and $request->tahun<>""){
            $data = DB::select("select  docno, keterangan, jk, store, voucher, posted from jurumdoc  where thnbln ='$request->tahun$request->bulan' order by voucher");
        }else{
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

    public function create()
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

        $mp = "J";
        $s = $thnblopen2;
        if($s == ""){
            Alert::info("Bulan buku tidak ada atau sudah di posting", 'Failed')->persistent(true);
            return redirect()->route('jurnal_umum.create');
        }else{  
            $thnbln = $s;
            $suplesi = 0; 
            $tahun = substr($s,0,-2); 
            $bulan = substr($s,4); 
        }

        $rate = "1";
        $nama_ci = "1.Rp";
        $bagian = "B3000";
        $nama_bagian = "KONTROLER";
            $carinomor = DB::select("select max(substr(docno,13,3)) as id from jurumdoc where substr(docno,3,5)='B3000' and thnbln='$thnbln' and substr(docno,1,1)='J'");
            if(!empty($carinomor)){
                foreach($carinomor as $cari)
                {
                    $id = sprintf("%03s", abs(vf($cari->id) + 1));
                    $nobukti='AA'.$id;
                    $nomor = substr($tahun,2,2).''.$bulan.''.$id;
                }
            }else{
                $nobukti = "AA001";
                $nomor = substr($tahun,2,2).''.$bulan.'001';
            }
        return view('jurnal_umum.create',compact(
                                                   'mp',
                                                   'rate',
                                                   'nama_ci',
                                                   'bagian',
                                                   'nama_bagian',
                                                   'suplesi',
                                                   'nobukti',
                                                   'nomor',
                                                   'tahun',
                                                   'bulan' 
                                                    ));
    }

    public function store(Request $request)
    {
        $userid = $request->userid;
        $mp = $request->mp;
        $nomor = $request->nomor;
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $suplesi = $request->suplesi;
        $bagian = $request->bagian;
        $jk = $request->jk;
        $kurs = $request->kurs;
        $ci = $request->ci;
        $nokas = $request->nokas;
        $nobukti = $request->nobukti;
        $kepada = $request->kepada;
        $scurrdoc = $request->mp.'/'.$request->bagian.'/'.$request->nomor;
        $docno = $scurrdoc;
        $thnbln = $tahun.''.$bulan;
        $tanggal = $request->tanggal;
        
        $data_cek = DB::select("select a.* from jurumdoc a where a.docno='$docno'");	 
        if(!empty($data_cek)){
            $data = 0;
            return response()->json($data);
        }else{
            Jurumdoc::insert([
                            'docno' => $docno,
                            'thnbln' => $thnbln,
                            'jk' => $jk,
                            'suplesi' => $suplesi,
                            'store' => $nokas,
                            'keterangan' => $kepada,
                            'ci' => $ci,
                            'rate' => $kurs,
                            'posted' => 'N',
                            'inputid' => $userid,
                            'inputdate' => $tanggal,
                            'voucher' => $nobukti
                ]);
                $data = 1;
                return response()->json($data);
        }

    }

    public function edit($no)
    {
            $dokno = str_replace('-', '/', $no);
            $data_jur =  DB::select("select docno, left(docno,1) mp, substr(docno, 3, 5) bagian, substr(docno,9) nomor, 
                                    thnbln, right(thnbln,2) bulan,  left(thnbln, 4) tahun,jk,suplesi,store,keterangan,ci,rate,
                                    debet,kredit,voucher,posted, (select a.nama from sdm_tbl_kdbag a where a.kode=substr(docno, 3, 5)) nama_bagian
             from jurumdoc where docno='$dokno'");
            // dd($data_jur);
            foreach($data_jur as $data)
            {
                $docno = $data->docno;
                $mp = $data->mp;
                $bagian = $data->bagian;
                $nomor = $data->nomor;
                $thnbln = $data->thnbln;
                $bulan = $data->bulan;
                $tahun = $data->tahun;
                $jk = $data->jk;
                $suplesi = $data->suplesi;
                $store = $data->store;
                $keterangan = $data->keterangan;
                $ci = $data->ci;
                $rate = $data->rate;
                $debet = $data->debet;
                $kredit = $data->kredit;
                $nobukti = $data->voucher;
                $status2 = $data->posted;
                $nama_bagian = $data->nama_bagian;
            }

            $data_detail = DB::select("select * from jurumline where docno= '$docno' order by lineno");
            
           return view('jurnal_umum.edit',compact('data_jur','data_detail'));

    }
}
