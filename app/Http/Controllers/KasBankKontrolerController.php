<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Storejk;
use App\Models\Account;
use Auth;
use DB;
use Session;
use PDF;
use Alert;
use DataTables;

class KasBankKontrolerController extends Controller
{
    public function index()
    {
        return view('kas_bank_kontroler.index');
    }

    public function searchIndex(Request $request)
    {
        $data = DB::select("select a.* from storejk a ORDER BY a.jeniskartu,a.kodestore");
        return datatables()->of($data)
        ->addColumn('jeniskartu', function ($data) {
            return $data->jeniskartu;
       })
        ->addColumn('kodestore', function ($data) {
            return $data->kodestore;
       })
        ->addColumn('namabank', function ($data) {
            return $data->namabank;
       })
        ->addColumn('norekening', function ($data) {
            return $data->norekening;
       })
        ->addColumn('ci', function ($data) {
            return $data->ci;
       })
        ->addColumn('account', function ($data) {
            return $data->account;
       })
        ->addColumn('lokasi', function ($data) {
            return $data->lokasi;
       })
        ->addColumn('radio', function ($data) {
            $radio = '<center><label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" kode="'.$data->kodestore.'" class="btn-radio" name="btn-radio"><span></span></label></center>'; 
            return $radio;
        })
        ->rawColumns(['radio'])
        ->make(true); 
    }

    public function create()
    {
        $data_sanper = DB::select("select kodeacct,descacct from account where length(kodeacct)=6 and kodeacct not like '%X%' order by kodeacct");
        return view('kas_bank_kontroler.create',compact('data_sanper'));
    }
    public function store(Request $request)
    {
        $data_objRs = DB::select("select * from storejk where kodestore='$request->kode'");
        if(!empty($data_objRs)){
            $data = 2;
            return response()->json($data);
        }else{
            Storejk::insert([
                'jeniskartu' => $request->jk,
                'kodestore' => $request->kode,
                'account' => $request->sanper,
                'ci' => $request->ci,
                'namabank' => $request->nama,
                'norekening' => $request->norek,
                'lokasi' => $request->lokasi,
                'jenisbiaya' => '000',
                'bagian' => 'C3010' 
            ]);
            $data = 1;
            return response()->json($data);
        }

    }

    public function edit($no)
    {
        $data_cash = DB::select("select * from storejk where kodestore='$no'");
        foreach($data_cash as $data)
        {
            $kode = $data->kodestore;
            $nama = $data->namabank;
            $jk = $data->jeniskartu;
            $sanper = $data->account;
            $ci = $data->ci;
            $norek = $data->norekening;
            $lokasi = $data->lokasi;
        }
        $data_sanper = DB::select("select kodeacct,descacct from account where length(kodeacct)=6 and kodeacct not like '%X%' order by kodeacct");
        return view('kas_bank_kontroler.edit',compact(
                                                        'data_sanper',
                                                        'kode',
                                                        'nama',
                                                        'jk',
                                                        'sanper',
                                                        'ci',
                                                        'norek',
                                                        'lokasi'
                                                                ));
    }
    public function update(Request $request)
    {
        Storejk::where('kodestore',$request->kode)
        ->update([
            'jeniskartu' => $request->jk,
            'account' => $request->sanper,
            'ci' => $request->ci,
            'namabank' => $request->nama,
            'norekening' => $request->norek,
            'lokasi' => $request->lokasi
        ]);
        return response()->json();
    }

    public function delete(Request $request)
    {
        $data_objrs1 = DB::select("select account from storejk where kodestore='$request->kode'"); 
        foreach($data_objrs1 as $objrs1)
        {
            Account::where('kodeacct',$objrs1->account)->delete();
        }
        Storejk::where('kodestore',$request->kode)->delete();
        return response()->json();
    }


    public function indexCetak()
    {
        $data_tahunbulan = DB::select("select max(thnbln) as bulan_buku from bulankontroller where status='1' and length(thnbln)='6'");
        if(!empty($data_tahunbulan)) {
            foreach ($data_tahunbulan as $data_bul) {
                $tahun = substr($data_bul->bulan_buku,0,-2); 
                $bulan = substr($data_bul->bulan_buku,4); 
            }
        }else{
            $bulan ='00';
            $tahun ='0000';
        }
        return view('kas_bank_kontroler.index_cetak',compact('tahun','bulan'));
    }

    public function searchIndexCetak(Request $request)
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
        $tahun = $request->tahun;
        $bulan = $request->bulan;
        $nodok = $request->nodok;
        if($nodok == "" and $tahun =="" and $bulan ==""){
            $data = DB::select("select a.docno,a.originaldate,a.thnbln,a.jk,a.store,a.ci,a.voucher,a.kepada,a.rate,a.nilai_dok,a.paid from kasdoc a where a.thnbln='$thnblopen2' order by a.store,a.voucher asc ");
        }elseif($nodok <> "" and $tahun =="" and $bulan ==""){
            $data =DB::select("select a.docno,a.originaldate,a.thnbln,a.jk,a.store,a.ci,a.voucher,a.kepada,a.rate,a.nilai_dok,a.paid from kasdoc a where a.voucher='$nodok' order by a.store,a.voucher asc");
        }elseif($nodok <> "" and $tahun <> "" and $bulan == ""){
            $data = DB::select("select a.docno,a.originaldate,a.thnbln,a.jk,a.store,a.ci,a.voucher,a.kepada,a.rate,a.nilai_dok,a.paid from kasdoc a where a.voucher='$nodok' and left(a.thnbln, 4)='$tahun' order by a.store,a.voucher asc");
        }elseif($nodok == "" and $tahun <> "" and $bulan <> ""){
            $data = DB::select("select a.docno,a.originaldate,a.thnbln,a.jk,a.store,a.ci,a.voucher,a.kepada,a.rate,a.nilai_dok,a.paid from kasdoc a where left(thnbln, 4)='$tahun' and substr(thnbln, 5, 2)='$bulan' order by a.store,a.voucher asc ");
        }else{
            $data = DB::select("select a.docno,a.originaldate,a.thnbln,a.jk,a.store,a.ci,a.voucher,a.kepada,a.rate,a.nilai_dok,a.paid from kasdoc a where a.voucher='$nodok' and left(thnbln, 4)='$tahun' and substr(thnbln, 5, 2)='$bulan' order by a.store,a.voucher asc");
        }
        
        return datatables()->of($data)
        ->addColumn('action', function ($data) {
            if($data->paid == 'Y'){
                return '<p align="center"><span style="font-size: 2em;" class="kt-font-success pointer-link" data-toggle="kt-tooltip" data-placement="top"  title="Batalkan Pembayaran"><i class="fas fa-check-circle" ></i></span></p>';
            }else{
                return '<p align="center"><span style="font-size: 2em;" class="kt-font-danger pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Klik Untuk Pembayaran"><i class="fas fa-ban" ></i></span></p>';
            }
       })
        ->addColumn('docno', function ($data) {
            return $data->docno;
       })
        ->addColumn('tahun', function ($data) {
            return $data->thnbln;
       })
        ->addColumn('nobukti', function ($data) {
            return $data->voucher;
       })
        ->addColumn('kepada', function ($data) {
            return $data->kepada;
       })
        ->addColumn('jk', function ($data) {
            return $data->jk;
       })
        ->addColumn('nokas', function ($data) {
            return $data->store;
       })
        ->addColumn('ci', function ($data) {
            return $data->ci;
       })
        ->addColumn('kurs', function ($data) {
            return $data->rate;
       })
        ->addColumn('nilai', function ($data) {
            if ($data->nilai_dok == "") {
                return  '0';
            }else{
                return number_format($data->nilai_dok,2,'.',',');
            }
       })
        ->addColumn('radio', function ($data) {
            $radio = '<center><label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" kode="'.str_replace('/', '-', $data->docno).'" class="btn-radio" name="btn-radio"><span></span></label></center>'; 
            return $radio;
        })
        ->rawColumns(['radio','action'])
        ->make(true); 
    }
}
