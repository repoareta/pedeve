<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Model
use App\Models\PUmkHeader;
use App\Models\PUmkDetail;
use App\Models\UmkHeader;
use App\Models\SdmMasterPegawai;
use App\Models\SdmTblKdjab;

// Load Plugin
use Carbon\Carbon;
use Session;
use PDF;

class UangMukaKerjaPertanggungJawabanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('umk_pertanggungjawaban.index');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function indexJson()
    {
        $pumk_list = PUmkHeader::all();

        return datatables()->of($pumk_list)
            ->addColumn('nama', function ($row) {
                return $row->nopek." - ".$row->nama;
            })
            ->addColumn('nilai', function ($row) {
                return currency_idr($row->pumk_detail->sum('nilai'));
            })
            ->addColumn('approval', function ($row) {
                if ($row->app_pbd == 'Y') {
                    $button = '<span style="font-size: 2em;" class="kt-font-success"><i class="fas fa-check-circle" title="Data Sudah di proses perbendaharaan"></i></span>';
                } else {
                    if ($row->app_sdm == 'Y') {
                        $button = '<a href="'. route('uang_muka_kerja.pertanggungjawaban.approval', ['no_pumk' => str_replace('/', '-', $row->no_pumk)]).'"><span style="font-size: 2em;" class="kt-font-warning"><i class="fas fa-check-circle" title="Batalkan Approval"></i></span></a>';
                    } else {
                        $button = '<a href="'. route('uang_muka_kerja.pertanggungjawaban.approval', ['no_pumk' => str_replace('/', '-', $row->no_pumk)]).'"><span style="font-size: 2em;" class="kt-font-danger"><i class="fas fa-ban" title="Klik untuk Approval"></i></span></a>';
                    }
                }

                return $button;
            })
            ->addColumn('action', function ($row) {
                $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" name="radio1" value="'.$row->no_pumk.'"><span></span></label>';
                return $radio;
            })
            ->rawColumns(['action', 'approval'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pegawai_list = SdmMasterPegawai::where('status', '<>', 'P')
        ->orderBy('nama', 'ASC')
        ->get();

        $jabatan_list = SdmTblKdjab::distinct('keterangan')
        ->orderBy('keterangan', 'ASC')
        ->get();

        $pumk_header_list = PUmkHeader::select('no_umk')->whereNotNull('no_umk')->get()->toArray();
        $umk_header_list = UmkHeader::whereNotIn('no_umk', $pumk_header_list)->get();

        $pumk_header_count = PUmkHeader::all()->count();

        return view('umk_pertanggungjawaban.create', compact(
            'pegawai_list',
            'umk_header_list',
            'pumk_header_count',
            'jabatan_list'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pegawai = SdmMasterPegawai::find($request->nopek);
        
        $pumk_header = new PUmkHeader;
        $pumk_header->no_pumk = $request->no_pumk;
        $pumk_header->no_umk = $request->no_umk;
        $pumk_header->keterangan = $request->keterangan;
        $pumk_header->tgl_pumk = $request->tanggal;
        $pumk_header->nopek = $request->nopek;
        $pumk_header->nama = $pegawai->nama;
        $pumk_header->app_sdm = 'N';
        $pumk_header->app_pbd = 'N';
        // Save Panjar Header
        $pumk_header->save();

        return redirect()->route('uang_muka_kerja.pertanggungjawaban.index');
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
    public function delete(Request $request)
    {
        PUmkHeader::where('no_pumk', $request->id)->delete();
        PUmkDetail::where('no_pumk', $request->id)->delete();

        return response()->json();
    }
}