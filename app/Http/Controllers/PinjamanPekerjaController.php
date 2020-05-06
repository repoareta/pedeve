<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kasdoc;
use DB;
use PDF;
use Excel;
use Alert;

class PinjamanPekerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pinjaman_pekerja.index');
    }

    public function searchIndex(Request $request)
    {
        if($request->nopek == ""){
            $data = DB::select("select a.id_pinjaman,a.nopek,a.jml_pinjaman,a.tenor,a.mulai,a.sampai,a.angsuran,a.cair,a.lunas,a.no_kontrak,b.nama as namapegawai,c.curramount from pay_mtrpkpp a join sdm_master_pegawai b on a.nopek=b.nopeg join pay_master_hutang c on b.nopeg=c.nopek where c.aard='20' and c.tahun||c.bulan = (select trim(max(tahun||bulan)) as bultah from pay_master_hutang where aard='20') and a.lunas='N' order by a.id_pinjaman asc");
        }else{
            $data = DB::select("select a.id_pinjaman,a.nopek,a.jml_pinjaman,a.tenor,a.mulai,a.sampai,a.angsuran,a.cair,a.lunas,a.no_kontrak,b.nama as namapegawai,c.curramount from pay_mtrpkpp a join sdm_master_pegawai b on a.nopek=b.nopeg join pay_master_hutang c on b.nopeg=c.nopek where c.aard='20' and c.tahun||c.bulan = (select trim(max(tahun||bulan)) as bultah from pay_master_hutang where aard='20') and a.lunas='N' order by a.id_pinjaman asc");
        }
        
            return datatables()->of($data)
            ->addColumn('id_pinjaman', function ($data) {
                return $data->id_pinjaman;
           })
            ->addColumn('nopek', function ($data) {
                return $data->nopek;
           })
            ->addColumn('namapegawai', function ($data) {
                return $data->namapegawai;
           })
           ->addColumn('mulai', function ($data) {
               $tgl = date_create($data->mulai);
               return date_format($tgl, 'd F Y');
            })
            ->addColumn('sampai', function ($data) {
                $tgl = date_create($data->sampai);
                return date_format($tgl, 'd F Y');
            })
            ->addColumn('tenor', function ($data) {
                return $data->tenor;
            })
            ->addColumn('angsuran', function ($data) {
                 return 'Rp. '.number_format($data->angsuran,2,'.',',');
           })
            ->addColumn('jml_pinjaman', function ($data) {
                 return 'Rp. '.number_format($data->jml_pinjaman,2,'.',',');
           })
            ->addColumn('curramount', function ($data) {
                 return 'Rp. '.number_format($data->curramount,2,'.',',');
           })
            ->addColumn('no_kontrak', function ($data) {
                 return $data->no_kontrak;
           })
    
            ->addColumn('radio', function ($data) {
                $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" jk="" nokas=""  tanggal="" class="btn-radio" name="btn-radio-rekap"><span></span></label>'; 
                return $radio;
            })
            ->addColumn('cair', function ($data) {
                if($data->cair == 'Y'){
                    $cair = '<p align="center"><span style="font-size: 2em;" class="kt-font-success pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Sudah Cair"><i class="fas fa-check-circle" ></i></span></p>'; 
                }else{
                    $cair = '<p align="center"><span style="font-size: 2em;" class="kt-font-danger pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Belum Cair"><i class="fas fa-ban" ></i></span></p>';
                }
                return $cair;
            })
            ->addColumn('lunas', function ($data) {
                if($data->lunas == 'Y'){
                    $lunas = '<p align="center"><span style="font-size: 2em;" class="kt-font-success pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Sudah Lunas"><i class="fas fa-check-circle" ></i></span></p>'; 
                }else{
                    $lunas = '<p align="center"><span style="font-size: 2em;" class="kt-font-danger pointer-link" data-toggle="kt-tooltip" data-placement="top" title="Belum Lunas"><i class="fas fa-ban" ></i></span></p>';
                }
                return $lunas;
            })
            ->rawColumns(['radio','cair','lunas'])
            ->make(true);
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
