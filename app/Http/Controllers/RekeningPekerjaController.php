<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PayTblRekening;
use DB;
use DomPDF;
use Excel;
use Alert;

class RekeningPekerjaController extends Controller
{

    public function index()
    {
        return view('rekening_pekerja.index');
    }

    public function indexJson()
    {
        $tunjangan_list = DB::select("select a.nopek,a.kdbank,a.rekening,a.atasnama,(select nama from pay_tbl_bank where kode=a.kdbank) as namabank, (select nama from sdm_master_pegawai where nopeg=a.nopek) as namapekerja from pay_tbl_rekening a order by nopek");
        
        return datatables()->of($tunjangan_list)
        ->addColumn('radio', function ($row) {
                return '<p align="center"><label  class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" class="btn-radio" kode="'.$row->nopek.'" name="btn-radio"><span></span></label></p>';
        })
        ->addColumn('namapekerja', function ($row) {
             return $row->nopek.' -- '.$row->namapekerja;
        })
        ->addColumn('namabank', function ($row) {
             return $row->kdbank.' -- '.$row->namabank;
        })
        ->addColumn('rekening', function ($row) {
             return $row->rekening;
        })
        ->addColumn('atasnama', function ($row) {
             return $row->atasnama;
        })
        ->rawColumns(['radio'])
            ->make(true);
    }


    public function create()
    {
        $data_pegawai = DB::select("select nopeg,nama,status,nama from sdm_master_pegawai where status <>'P' order by nopeg");
        $data_bank = DB::select("select kode, nama, alamat, kota from pay_tbl_bank");
        return view('rekening_pekerja.create',compact('data_pegawai','data_bank'));
    }


    public function store(Request $request)
    {
        $data_cek = DB::select("select * from pay_tbl_rekening where nopek = '$request->nopek'" ); 			
        if(!empty($data_cek)){
            $data=2;
            return response()->json($data);
        }else {
        PayTblRekening::insert([
            'nopek' => $request->nopek,
            'kdbank' => $request->kdbank,
            'rekening' => $request->rekening,
            'atasnama' => $request->atasnama,
            ]);
            $data = 1;
            return response()->json($data);
        }
    }


    public function edit($id)
    {
        $data_pegawai = DB::select("select nopeg,nama,status,nama from sdm_master_pegawai where status <>'P' order by nopeg");
        $data_bank = DB::select("select kode, nama, alamat, kota from pay_tbl_bank");
        $data_list = PayTblRekening::where('nopek', $id)->get();
        foreach($data_list as $data)
        {
            $nopek = $data->nopek;
            $kdbank = $data->kdbank;
            $rekening = $data->rekening;
            $atasnama = $data->atasnama;
        }
        return view('rekening_pekerja.edit',compact('nopek','kdbank','rekening','atasnama','data_pegawai','data_bank'));
    }


    public function update(Request $request)
    {
        PayTblRekening::where('nopek', $request->nopek)
            ->update([
                'kdbank' => $request->kdbank,
                'rekening' => $request->rekening,
                'atasnama' => $request->atasnama,
            ]);
            return response()->json();
    }


    public function delete(Request $request)
    {
        PayTblRekening::where('nopek', $request->kode)
        ->delete();
        return response()->json();
    }
}
