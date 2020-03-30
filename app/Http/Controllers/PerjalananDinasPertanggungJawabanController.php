<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Model
use App\Models\PanjarHeader;
use App\Models\PPanjarHeader;
use App\Models\PPanjarDetail;
use App\Models\SdmMasterPegawai;
use App\Models\SdmTblKdjab;

// Load Plugin
use Carbon\Carbon;
use Session;
use PDF;

class PerjalananDinasPertanggungJawabanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('perjalanan_dinas_pertanggungjawaban.index');
    }
    
    /**
     * Undocumented function
     *
     * @return void
     */
    public function indexJson()
    {
        $panjar_list = PPanjarHeader::all();

        return datatables()->of($panjar_list)
            ->addColumn('tgl_ppanjar', function ($row) {
                return Carbon::parse($row->tgl_ppanjar)->translatedFormat('d F Y');
            })
            ->addColumn('nopek', function ($row) {
                return $row->nopek." - ".$row->nama;
            })
            ->addColumn('jmlpanjar', function ($row) {
                return currency_idr($row->jmlpanjar);
            })
            ->addColumn('action', function ($row) {
                $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" name="radio1" value="'.$row->no_ppanjar.'"><span></span></label>';
                return $radio;
            })
            ->rawColumns(['action'])
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

        $ppanjar_header_list = PPanjarHeader::select('no_panjar')->whereNotNull('no_panjar')->get()->toArray();
        $panjar_header_list = PanjarHeader::whereNotIn('no_panjar', $ppanjar_header_list)->get();

        $ppanjar_header_count = PPanjarHeader::all()->count();

        return view('perjalanan_dinas_pertanggungjawaban.create', compact(
            'pegawai_list',
            'panjar_header_list',
            'ppanjar_header_count',
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
        
        $ppanjar_header = new PPanjarHeader;
        $ppanjar_header->no_ppanjar = $request->no_pj_panjar;
        $ppanjar_header->no_panjar = $request->no_panjar;
        $ppanjar_header->keterangan = $request->keterangan;
        $ppanjar_header->tgl_ppanjar = $request->tanggal;
        $ppanjar_header->nopek = $request->nopek;
        $ppanjar_header->nama = $pegawai->nama;
        $ppanjar_header->pangkat = $request->jabatan;
        $ppanjar_header->gol = $request->golongan;
        $ppanjar_header->jmlpanjar = $request->jumlah;
        // Save Panjar Header
        $ppanjar_header->save();

        return redirect()->route('perjalanan_dinas.pertanggungjawaban.index');
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
    public function edit($no_ppanjar)
    {
        $no_ppanjar = str_replace('-', '/', $no_ppanjar);
        $ppanjar_header = PPanjarHeader::find($no_ppanjar);

        $pegawai_list = SdmMasterPegawai::where('status', '<>', 'P')
        ->orderBy('nama', 'ASC')
        ->get();

        $jabatan_list = SdmTblKdjab::distinct('keterangan')
        ->orderBy('keterangan', 'ASC')
        ->get();

        $panjar_header_list = PanjarHeader::all();

        return view('perjalanan_dinas_pertanggungjawaban.edit', compact(
            'pegawai_list',
            'panjar_header_list',
            'jabatan_list',
            'ppanjar_header'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $no_ppanjar)
    {
        $pegawai = SdmMasterPegawai::find($request->nopek);

        $no_ppanjar = str_replace('-', '/', $no_ppanjar);
        $ppanjar_header = PPanjarHeader::find($no_ppanjar);

        $ppanjar_header->no_ppanjar = $request->no_pj_panjar;
        $ppanjar_header->no_panjar = $request->no_panjar;
        $ppanjar_header->keterangan = $request->keterangan;
        $ppanjar_header->tgl_ppanjar = $request->tanggal;
        $ppanjar_header->nopek = $request->nopek;
        $ppanjar_header->nama = $pegawai->nama;
        $ppanjar_header->pangkat = $request->jabatan;
        $ppanjar_header->gol = $request->golongan;
        $ppanjar_header->jmlpanjar = $request->jumlah;
        // Save Panjar Header
        $ppanjar_header->save();

        return redirect()->route('perjalanan_dinas.pertanggungjawaban.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        PPanjarHeader::where('no_ppanjar', $request->id)->delete();
        PPanjarDetail::where('no_ppanjar', $request->id)->delete();

        return response()->json();
    }
}
