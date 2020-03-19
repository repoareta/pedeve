<?php

namespace App\Http\Controllers;

use App\PermintaanBayarModel;
use App\PermintaanDetailModel;
use App\Models\UmuDebetNota;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Session;
use PDF;


class PermintaanBayarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('permintaan_bayar.index');
    }

    public function indexJson()
    {
        $bayar_list = PermintaanBayarModel::all();
        
        return datatables()->of($bayar_list)
            ->addColumn('no_bayar', function ($row) {
                return $row->no_bayar;
            })
            ->addColumn('no_kas', function ($row) {
                return $row->no_kas;
            })
            ->addColumn('kepada', function ($row) {
                return $row->kepada;
            })
            ->addColumn('keterangan', function ($row) {
                return $row->keterangan;
            })
            ->addColumn('lampiran', function ($row) {
                return $row->lampiran;
            })
            ->addColumn('nilai', function ($row) {
                return currency_idr($row->nilai);
            })
            ->addColumn('action', function ($row) {
                if($row->app_pbd == 'Y'){
                    $button = '<p align="center"><span style="font-size: 2em;" class="kt-font-success"><i class="fas fa-check-circle" title="Data Sudah di proses perbendaharaan"></i></span></p>';
                }else{
                    if($row->app_sdm == 'Y'){
                        $button = '<p align="center"><a href="#"><span style="font-size: 2em;" class="kt-font-warning"><i class="fas fa-check-circle" title="Batalkan Approval"></i></span></a></p>';
                    }else{
                        $button = '<p align="center"><a href="#"><span style="font-size: 2em;" class="kt-font-danger"><i class="fas fa-ban" title="Klik untuk Approval"></i></span></a></p>';
                    }
                }
                return $button;
            })
            ->addColumn('action_radio', function ($row) {
                $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" name="radio1" value="'.str_replace('/', '-', $row->no_bayar).'" data-id="'.str_replace('/', '-', $row->no_bayar).'"><span></span></label>';
                return $radio;
            })
            ->rawColumns(['action_radio','action'])
            ->make(true);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $debit_nota = UmuDebetNota::all();
        $data = DB::select("select left(max(no_bayar),-14) as no_bayar from umu_bayar_header where  date_part('year', tgl_bayar)  = date_part('year', CURRENT_DATE)");
        foreach ($data as $data_no_bayar) {
            $data_no_bayar->no_bayar;
        }
        $no_bayar_max = $data_no_bayar->no_bayar;
        if(empty($no_umk_max)) {
            $permintaan_header_count= sprintf("%03s", abs($no_bayar_max + 1)). '/CS/' . date('d/m/Y');
        }else {
            $permintaan_header_count= sprintf("%03s", 1). '/CS/' . date('d/m/Y');
        }
        return view('permintaan_bayar.create',compact('debit_nota','permintaan_header_count'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check_data =  DB::select("select * from umu_bayar_header where no_bayar = '$request->nobayar'");
        if(!empty($check_data))
        {
            PermintaanBayarModel::where('no_bayar', $request->nobayar)
            ->update([
            'no_bayar' => $request->nobayar,
            'tgl_bayar' => $request->tanggal,
            'lampiran' => $request->lampiran,
            'keterangan' => $request->keterangan,
            'kepada' => $request->dibayar,
            'debet_dari' => $request->debetdari,
            'debet_no' => $request->nodebet,
            'debet_tgl' => $request->tgldebet,
            'no_kas' => $request->nokas,
            'bulan_buku' => $request->bulanbuku,
            'ci' => $request->ci,
            'rate' => $request->kurs,
            'mulai' => $request->mulai,
            'sampai' => $request->sampai,
            ]);
            return response()->json();
        }else{
            DB::table('umu_bayar_header')->insert([
            'no_bayar' => $request->nobayar,
            'tgl_bayar' => $request->tanggal,
            'lampiran' => $request->lampiran,
            'keterangan' => $request->keterangan,
            'kepada' => $request->dibayar,
            'debet_dari' => $request->debetdari,
            'debet_no' => $request->nodebet,
            'debet_tgl' => $request->tgldebet,
            'no_kas' => $request->nokas,
            'bulan_buku' => $request->bulanbuku,
            'ci' => $request->ci,
            'rate' => $request->kurs,
            'mulai' => $request->mulai,
            'sampai' => $request->sampai,
            // Save Panjar Header
            ]);
            return response()->json();
        }  
    }

    public function storeDetail(request $request)
    {      
        $check_data =  DB::select("select * from umu_bayar_detail where no = '$request->no' and  no_bayar = '$request->nobayar'");
        if(!empty($check_data)){
            PermintaanDetailModel::where('no_bayar', $request->nobayar)
            ->where('no', $request->no)
            ->update([
            'no' => $request->no,
            'keterangan' => $request->keterangan,
            'account' => $request->acc,
            'nilai' => $request->nilai,
            'cj' => $request->cj,
            'jb' => $request->jb,
            'bagian' => $request->bagian,
            'pk' => $request->pk,
            'no_bayar' => $request->nobayar
            ]);
            return response()->json();
        }else{
            PermintaanDetailModel::insert([
            'no' => $request->no,
            'keterangan' => $request->keterangan,
            'account' => $request->acc,
            'nilai' => $request->nilai,
            'cj' => $request->cj,
            'jb' => $request->jb,
            'bagian' => $request->bagian,
            'pk' => $request->pk,
            'no_bayar' => $request->nobayar
            ]);
            return response()->json();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nobayar)
    {
        $nobayars=str_replace('-', '/', $nobayar);
        $data_bayars =  PermintaanBayarModel::where('no_bayar', $nobayars)->get();
        $debit_nota = UmuDebetNota::all();
        $no_uruts =  DB::select("select max(no) as no from umu_bayar_detail where no_bayar = '$nobayars'");
        $data_bayar_details = PermintaanDetailModel::where('no_bayar',$nobayars)->get();
        $data_account = DB::select("select kodeacct, descacct FROM account where LENGTH(kodeacct)=6 AND kodeacct NOT LIKE '%X%'");
        $data_bagian = DB::select("SELECT A.kode,A.nama FROM sdm_tbl_kdbag A ORDER BY A.kode");
        $data_jenisbiaya = DB::select("select kode,keterangan from jenisbiaya order by kode");
        $data_cj = DB::select("select kode,nama from cashjudex order by kode");
        $count= PermintaanDetailModel::where('no_bayar',$nobayars)->select('no_bayar')->sum('nilai');
        if(!empty($no_urut) == null)
        { 
            foreach($no_uruts as $no_urut)
            {
                $no_bayar_details=$no_urut->no + 1;
            }
        }else{
            $no_bayar_details= 1;
        }
        return view('permintaan_bayar.edit', compact(
            'data_bayars',
            'debit_nota',
            'data_account',
            'data_bagian',
            'data_jenisbiaya',
            'data_cj',
            'no_bayar_details',
            'data_bayar_details',
            'count'
        ));
    }

    public function editDetail($dataid, $datano)
    {
        $nobayar=str_replace('-', '/', $dataid);
        $data = PermintaanDetailModel::where('no', $datano)->where('no_bayar', $nobayar)->distinct()->get();
        return response()->json($data[0]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $nobayars=str_replace('-', '/', $request->id);
        PermintaanBayarModel::where('no_bayar', $nobayars)->delete();
        PermintaanDetailModel::where('no_bayar', $nobayars)->delete();
        return response()->json();
    }

    public function deleteDetail(Request $request)
    {

        PermintaanDetailModel::where('no', $request->no)
        ->where('no_bayar', $request->id)
        ->delete();
        return response()->json();
    }
    public function rekap()
    {
        return view('permintaan_bayar.rekap');
    }

    public function rekapExport(Request $request)
    {
        $mulai = date($request->mulai);
        $sampai = date($request->sampai);
        $bayar_header_list = PermintaanBayarModel::whereBetween('tgl_bayar', [$mulai, $sampai])
        ->get();
        // dd($panjar_header_list);

        $pdf = PDF::loadview('permintaan_bayar.export', ['bayar_header_list' => $bayar_header_list]);
        return $pdf->download('rekap_bayar_'.date('Y-m-d H:i:s').'.pdf');
    }
}
