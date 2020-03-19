<?php

namespace App\Http\Controllers;

use App\UmkModel;
use App\DetailUmkModel;
use Illuminate\Http\Request;
use DataTables;
use DB;

class UangMukaKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('umk.index');
    }

    public function indexJson(Request $request)
    {
        if($request->ajax())
        {               
                $datas = UmkModel::all()->chunk(100000);
                foreach($datas as $data)
                {
                return DataTables::of($data)
                ->addColumn('action', function($data){
                    if($data->app_pbd == 'Y'){
                        $button = '<p align="center"><span style="font-size: 2em;" class="kt-font-success"><i class="fas fa-check-circle" title="Data Sudah di proses perbendaharaan"></i></span></p>';
                    }else{
                        if($data->app_sdm == 'Y'){
                            $button = '<p align="center"><a href="#"><span style="font-size: 2em;" class="kt-font-warning"><i class="fas fa-check-circle" title="Batalkan Approval"></i></span></a></p>';
                        }else{
                            $button = '<p align="center"><a href="#"><span style="font-size: 2em;" class="kt-font-danger"><i class="fas fa-ban" title="Klik untuk Approval"></i></span></a></p>';
                        }
                    }
                    return $button;
                })
                ->addColumn('noumk', function($data){
                        $button = '<a align="center" >'.$data->no_umk.'</a>';
                    return $button;
                })
                ->addColumn('jenisum', function($data){
                    if($data->jenis_um == 'K'){
                        $button = '<p align="center">UM Kerja</p>';
                    }else{
                        $button = '<p align="center">UM Dinas</p>';
                    }
                    return $button;
                })
                ->addColumn('jumlah', function($data){
                        $button = '<p align="center">Rp. '.number_format($data->jumlah, 0, ',', '.').'</p>';
                    return $button;
                })

                ->addColumn('radio', function($data){
                    $button = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" class="btn-radio" dataumk="'.$data->no_umk.'" data-id="'.str_replace('/', '-', $data->no_umk).'" name="btn-radio"><span></span></label>';
                    return $button;
                })
                ->rawColumns(['action','radio','jenisum','jumlah','noumk'])
                ->make(true);
            }
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $awal = "CS";
        $data = DB::select("select left(max(no_umk),-14) as no_umk from kerja_header where  date_part('year', tgl_panjar)  = date_part('year', CURRENT_DATE)");
        foreach ($data as $data_no_umk) {
            $data_no_umk->no_umk;
        }
        $no_umk_max = $data_no_umk->no_umk;
        if(!empty($no_umk_max)) {
            $no_umk= sprintf("%03s", abs($no_umk_max + 1)). '/' . $awal .'/' . date('d/m/Y');
        }else {
            $no_umk= sprintf("%03s", 1). '/' . $awal .'/' . date('d/m/Y');
        }
        return view('umk.create', compact('no_umk'));
    }

    /**
     * melakukan insert ke umk
     */
    public function store(Request $request)
    {
        $check_data = DB::select("select * from kerja_header where no_umk = '$request->no_umk'");
        if(!empty($check_data))
        {
            DB::table('kerja_header')
            ->where('no_umk', $request->no_umk)
            ->update([
            'tgl_panjar' => $request->tgl_panjar,
            'bulan_buku' => $request->bulan_buku,
            'keterangan' => $request->untuk,
            'ci' => $request->ci,
            'rate' => $request->kurs,
            'jenis_um' => $request->jenis_um,
            'no_umk' => $request->no_umk,
            'jumlah' => $request->jumlah
            ]);
            return response()->json();
        }else{
            DB::table('kerja_header')->insert([
                'tgl_panjar' => $request->tgl_panjar,
                'bulan_buku' => $request->bulan_buku,
                'keterangan' => $request->untuk,
                'ci' => $request->ci,
                'rate' => $request->kurs,
                'jenis_um' => $request->jenis_um,
                'no_umk' => $request->no_umk,
                'jumlah' => $request->jumlah,
                'app_pbd' => 'N',
                'app_sdm' => 'N',
                ]);
                return response()->json();
        }        
    }

    public function edit($noumk)
    {   
        $noumk=str_replace('-', '/', $noumk);
        $data_umks = DB::select("select * from kerja_header where no_umk = '$noumk'");
        $no_uruts = DB::select("select max(no) as no from kerja_detail where no_umk = '$noumk'");
        $data_umk_details = DetailUmkModel::where('no_umk',$noumk)->get();
        $data_account = DB::select("select kodeacct, descacct FROM account where LENGTH(kodeacct)=6 AND kodeacct NOT LIKE '%X%'");
        $data_bagian = DB::select("SELECT A.kode,A.nama FROM sdm_tbl_kdbag A ORDER BY A.kode");
        $data_jenisbiaya = DB::select("select kode,keterangan from jenisbiaya order by kode");
        $data_cj = DB::select("select kode,nama from cashjudex order by kode");
        $count= DetailUmkModel::where('no_umk',$noumk)->select('no_umk')->sum('nilai');

        if(!empty($no_urut) == null)
        {
            foreach($no_uruts as $no_urut)
            {
                $no_umk_details=$no_urut->no + 1;
            }
        }else{
            $no_umk_details= 1;
        }
        
            return view('umk.edit', compact('data_umks','data_umk_details','no_umk_details','data_account','data_bagian','data_jenisbiaya','data_cj','count'));
    }

    public function storeDetail(request $request)
    {      
        $check_data =  DB::select("select * from kerja_detail where no = '$request->no' and  no_umk = '$request->no_umk'");
        if(!empty($check_data)){
            DetailUmkModel::where('no_umk', $request->no_umk)
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
            'no_umk' => $request->no_umk
            ]);
            return response()->json();
        }else{
            DetailUmkModel::insert([
            'no' => $request->no,
            'keterangan' => $request->keterangan,
            'account' => $request->acc,
            'nilai' => $request->nilai,
            'cj' => $request->cj,
            'jb' => $request->jb,
            'bagian' => $request->bagian,
            'pk' => $request->pk,
            'no_umk' => $request->no_umk
            ]);
            return response()->json();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_detail($dataid, $datano)
    {
        $noumk=str_replace('-', '/', $dataid);

            $data = DetailUmkModel::where('no', $datano)->where('no_umk', $noumk)->distinct()->get();
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

    public function delete(Request $request)
    {
        UmkModel::where('no_umk', $request->id)->delete();
        DetailUmkModel::where('no_umk', $request->id)->delete();
        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteDetail(Request $request)
    {

        DetailUmkModel::where('no', $request->no)
        ->where('no_umk', $request->id)
        ->delete();
        return response()->json();
    }

    public function rekap()
    {
        return view('umk.rekap');
    }
}
