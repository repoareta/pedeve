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
}
