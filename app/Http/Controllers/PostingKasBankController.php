<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kasline;
use App\Models\Kasdoc;
use Auth;
use DB;
use Session;
use PDF;
use Alert;

class PostingKasBankController extends Controller
{
 public function index()
 {
    return view('posting_kas_bank.index');
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
        if($request->bulan <>"" and $request->tahun<>""){
            $data = DB::select("select a.* from kasdoc a where a.thnbln ='$request->tahun$request->bulan' and a.verified='Y' and a.posted='N' order by a.store,a.voucher,a.paiddate asc");
        }else{
            $data = DB::select("select a.* from kasdoc a where a.thnbln ='$thnblopen2' and a.verified='Y' and a.posted='N' order by a.store,a.voucher,a.paiddate asc");
        }		
        return datatables()->of($data)
        ->addColumn('paiddate', function ($data) {
            if($data->paiddate <>""){
                return $data->paiddate;
            }else{
                return '0';
            }
       })
        ->addColumn('docno', function ($data) {
            return $data->docno;
       })
        ->addColumn('thnbln', function ($data) {
            return $data->thnbln;
       })
        ->addColumn('keterangan', function ($data) {
            return $data->kepada;
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
        ->addColumn('nilai', function ($data) {
            return number_format($data->nilai_dok,2,'.',',');
       })
        ->addColumn('action', function ($data) {
            if($data->verified == 'Y'){
                $action = '<p align="center"><a href="'. route('postingan_kas_bank.verkas',['no' => str_replace('/', '-', $data->docno),'id' => $data->verified]).'"><span style="font-size: 2em;" class="kt-font-success pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Batalkan Verifikasi" style="cursor:hand"><i class="fas fa-check-circle" ></i></span></a></p>';
            }else{
                $action = '<p align="center"><a href="'. route('postingan_kas_bank.verkas',['no' => str_replace('/', '-', $data->docno),'id' => $data->verified]).'"><span style="font-size: 2em;" class="kt-font-danger pointer-link" data-toggle="kt-tooltip" data-placement="top" title="" style="cursor:hand"><i class="fas fa-ban" ></i></span></a></p>';
            }               
            return $action;
        })
        ->rawColumns(['action'])
        ->make(true); 
    }

    public function verkas($no)
    {
        $docno = str_replace('-', '/', $no);
            $data_objrs = DB::select("select * from kasdoc where docno='$docno'");
            foreach($data_objrs as $objrs )
            {
                $docno = $objrs->docno;
                $thnbln = $objrs->thnbln;
                $jk  = $objrs->jk;
                $nokas = $objrs->store;
                $ci = $objrs->ci;
                $nobukti = $objrs->voucher;
                $kepada = $objrs->kepada;
                $kurs = $objrs->rate;
                $nilai = $objrs->nilai_dok;
                $verified = $objrs->verified;
                $mp = substr($objrs->docno,0,1);
                $bagian = substr($objrs->docno,2,5);
                $nomor = substr($objrs->docno,8,7);
                $bulan = substr($objrs->thnbln,4,2);
                $tahun = substr($objrs->thnbln,0,4);
                $status1=$objrs->verified;
                $paiddate = $objrs->paiddate;
                if($mp == "P"){
                    $darkep = "Kepada";
                }else{ 
                    $darkep = "Dari";
                }

                if($jk == "13"){
                    $namajk = "Bank (Dollar)";
                    $namaci = "2.US$";
                }elseif($jk == "11"){
                    $namajk = "Bank (Rupiah)";
                    $namaci = "1.Rp";
                }else{
                    $namajk = "Kas (Rupiah)";
                    $namaci = "1.Rp";
                }

                    $data_rsbagian = DB::select("select nama from sdm_tbl_kdbag where kode ='$bagian'");
                    if(!empty($data_rsbagian)){
                        foreach($data_rsbagian as $rsbagian)
                        {
                        $nama_bagian = $rsbagian->nama;
                        }
                    }else{
                        $nama_bagian = "";
                    }

                    $data_rskas = DB::select("select namabank from storejk where kodestore ='$nokas'");
                    if(!empty($data_rskas)){
                        foreach($data_rskas as $rskas)
                        {
                            $nama_kas = $rskas->namabank;
                        }
                    }else{
                        $nama_kas = "-";
                    }
            }
            $data_no = DB::select("select max(lineno) as nu from kasline where docno='$docno'");
            if(!empty($data_no)){
                foreach($data_no as $no)
                {
                    $nu = $no->nu+1;
                }
            }else{
                $nu=1;
            }  
            $data_detail = DB::select("select a.* from kasline a where a.docno='$docno' order by a.lineno");
            $data_lapang = DB::select("select kodelokasi,nama from lokasi");
            $data_sandi = DB::select("select kodeacct,descacct from account where length(kodeacct)=6 and kodeacct not like '%X%' order by kodeacct");
            $data_bagian = DB::select("select kode,nama from sdm_tbl_kdbag order by kode");
            $data_jenis = DB::select("select kode,keterangan from jenisbiaya order by kode");
            $data_cjudex = DB::select("select kode,nama from cashjudex order by kode");
            $verifieds = DB::select("select verified from kasdoc where docno='$docno'");
            foreach($verifieds as $dat)
            {
                $verified = $dat->verified;
            }
            $sum = DB::select("select sum(totprice) as tot from kasline where docno='$docno'");
            foreach($sum as $sums)
            {
                if($sums->tot <> ""){
                    $jumlahnya = $sums->tot;
                }else{
                    $jumlahnya = 0;
                }
            }
        return view('posting_kas_bank.verkas',compact(
                                                        'jumlahnya',
                                                        'verified',
                                                        'data_detail',
                                                        'nu',
                                                        'data_lapang',
                                                        'data_cjudex',
                                                        'data_sandi',
                                                        'data_bagian',
                                                        'data_jenis',
                                                        'sum',
                                                        'docno',
                                                        'thnbln',
                                                        'jk',
                                                        'nokas',
                                                        'ci',
                                                        'nobukti',
                                                        'kepada',
                                                        'kurs',
                                                        'nilai',
                                                        'verified',
                                                        'mp',
                                                        'bagian',
                                                        'nomor',
                                                        'bulan',
                                                        'tahun',
                                                        'status1',
                                                        'paiddate',
                                                        'darkep',
                                                        'namaci',
                                                        'namajk',
                                                        'nama_bagian',
                                                        'nama_kas'
                                                            ));
    }
    public function verkass()
    {
        
            
                $docno = '';
                $thnbln = '';
                $jk  = '';
                $nokas = '';
                $ci = '';
                $nobukti = '';
                $kepada = '';
                $kurs = '';
                $nilai = '';
                $verified = '';
                $mp = '';
                $bagian = '';
                $nomor = '';
                $bulan = '';
                $tahun = '';
                $status1='';
                $paiddate = '';
                $darkep = "";
                    $namajk = "";
                    $namaci = "";
                        $nama_bagian = "";
                        $nama_kas = "-";
                $nu='';
            $data_detail = DB::select("select a.* from kasline a where a.docno='$docno' order by a.lineno");
            $data_lapang = DB::select("select kodelokasi,nama from lokasi");
            $data_sandi = DB::select("select kodeacct,descacct from account where length(kodeacct)=6 and kodeacct not like '%X%' order by kodeacct");
            $data_bagian = DB::select("select kode,nama from sdm_tbl_kdbag order by kode");
            $data_jenis = DB::select("select kode,keterangan from jenisbiaya order by kode");
            $data_cjudex = DB::select("select kode,nama from cashjudex order by kode");
            $verifieds = DB::select("select verified from kasdoc where docno='$docno'");
            foreach($verifieds as $dat)
            {
                $verified = $dat->verified;
            }
            $sum = DB::select("select sum(totprice) as tot from kasline where docno='$docno'");
            foreach($sum as $sums)
            {
                if($sums->tot <> ""){
                    $jumlahnya = $sums->tot;
                }else{
                    $jumlahnya = 0;
                }
            }
        return view('posting_kas_bank.verkas',compact(
                                                        'jumlahnya',
                                                        'verified',
                                                        'data_detail',
                                                        'nu',
                                                        'data_lapang',
                                                        'data_cjudex',
                                                        'data_sandi',
                                                        'data_bagian',
                                                        'data_jenis',
                                                        'sum',
                                                        'docno',
                                                        'thnbln',
                                                        'jk',
                                                        'nokas',
                                                        'ci',
                                                        'nobukti',
                                                        'kepada',
                                                        'kurs',
                                                        'nilai',
                                                        'verified',
                                                        'mp',
                                                        'bagian',
                                                        'nomor',
                                                        'bulan',
                                                        'tahun',
                                                        'status1',
                                                        'paiddate',
                                                        'darkep',
                                                        'namaci',
                                                        'namajk',
                                                        'nama_bagian',
                                                        'nama_kas'
                                                            ));
    }
    public function verkasJson(Request $request)
    {
        $data_rsjurnal = DB::select("select distinct(store) from kasdoc where paid='Y' and verified='N'");
        foreach($data_rsjurnal as $sjurnal)
        {
            $data = DB::select("select a.docno,a.verified from kasdoc a where a.store='$sjurnal->store' and a.paid='Y' and a.verified='N' order by a.docno asc");
        }

        return datatables()->of($data)
        ->addColumn('docno', function ($data) {
            $action = '<p align="left"><a href="'. route('postingan_kas_bank.verkas',['no' => str_replace('/', '-', $data->docno),'id' => $data->verified]).'"><span class="kt-font-primary pointer-link" data-toggle="kt-tooltip" data-placement="top" title="" style="cursor:hand">'.$data->docno.'</i></span></a></p>';
            return $action;
       })
        ->rawColumns(['docno'])
        ->make(true); 
    }

    public function editDetail($no,$id)
    {
        $docno=str_replace('-', '/', $no);
        $data = Kasline::where('docno', $docno)->where('lineno', $id)->get();
        return response()->json($data[0]);
    }
    public function storeDetail(Request $request)
    {
            $docno = $request->kode;	
            $nourut=$request->nourut;
            $rincian = $request->rincian;
            $lapangan = $request->lapangan;
            $sanper = $request->sanper;
            $bagian = $request->bagian;
            $wo = $request->wo;
            $jnsbiaya=$request->jnsbiaya;
            $jumlah = $request->jumlah;
            $cjudex = $request->cjudex;
            
        $data_objrs = DB::select("select * from kasdoc a where a.docno='$docno'");
        if(!empty($data_objrs)){
            foreach($data_objrs as $objrs)
            {
                if($objrs->posted == "Y"){
                    $data = 2;
                    return response()->json($data);
                }else{
                    
                    Kasline::insert([
                        'docno' => $docno ,
                        'lineno' => $nourut ,
                        'account' => $sanper ,
                        'lokasi' => $lapangan ,
                        'bagian' => $bagian ,
                        'pk' => $wo ,
                        'jb' => $jnsbiaya ,
                        'cj' => $cjudex ,
                        'totprice' => $jumlah ,
                        'keterangan' => $rincian  
                    ]);
                    $data = 1;
                    return response()->json($data);
                }
            }
        }
    }
    public function updateDetail(Request $request)
    {
            $docno = $request->kode;	
            $nourut=$request->nourut;
            $rincian = $request->rincian;
            $lapangan = $request->lapangan;
            $sanper = $request->sanper;
            $bagian = $request->bagian;
            $wo = $request->wo;
            $jnsbiaya=$request->jnsbiaya;
            $jumlah = $request->jumlah;
            $cjudex = $request->cjudex;
            
        $data_objrs = DB::select("select * from kasdoc a where a.docno='$docno'");
        if(!empty($data_objrs)){
            foreach($data_objrs as $objrs)
            {
                if($objrs->posted == "Y"){
                    $data = 2;
                    return response()->json($data);
                }else{
                    Kasline::where('docno', $docno)
                    ->where('lineno', $nourut)
                    ->update([
                        'keterangan' => $rincian,
                        'lokasi' => $lapangan,
                        'account' => $sanper,
                        'bagian' => $bagian,
                        'pk' => $wo,
                        'jb' => $jnsbiaya,
                        'totprice' => $jumlah,
                        'cj' => $cjudex
                    ]);
                    $data = 1;
                    return response()->json($data);
                }
            }
         }
    }

    public function deleteDetail(Request $request)
    {
        $docno=str_replace('-', '/', $request->no);
        Kasline::where('docno', $docno)->where('lineno', $request->id)->delete();
        return response()->json();
    }


    public function verifikasi(Request $request)
    {
        if($request->status1 <>"N"){
            $status1 = $request->status1;
            $docno = $request->mp.'/'.$request->bagian.'/'.$request->nomor;

            Kasdoc::where('docno', $docno)
                    ->update([
                        'verified' => 'Y',
                        'verifieddate' => $request->tanggal
                    ]);
                    $data = 1;
                    return response()->json($data);
        }else{
            $status1 = $request->status1;
            $docno = $request->mp.'/'.$request->bagian.'/'.$request->nomor;
        
            $datacek = DB::select("select * from kasdoc a where a.docno='$docno'");
            if(!empty($datacek)){
                foreach($datacek as $datac)
                {
                    if($datac->posted == "Y"){
                        $data = 2;
                        return response()->json($data);
                    }else{
                        Kasdoc::where('docno', $docno)
                        ->update([
                            'verified' => 'N',
                            'verifieddate' => $request->tanggal
                        ]);
                        $data = 3;
                        return response()->json($data);
                    }
                }
            }else{
                Kasdoc::where('docno', $docno)
                ->update([
                    'verified' => 'N',
                    'verifieddate' => $request->tanggal
                ]);
                $data = 4;
                return response()->json($data);
            }
        }

    }
}
