<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// load model
use App\Models\AnggaranSubMain;

//load form request (for validation)
use App\Http\Requests\AnggaranSubmainStore;

// Load Plugin
use Carbon\Carbon;
use Session;
use PDF;
use Excel;
use Alert;
use Auth;

class AnggaranSubMainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kode_main)
    {
        return view('anggaran_submain.index', compact('kode_main'));
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function indexJson($kode_main)
    {
        $anggaran_list = AnggaranSubMain::where('kode_main', $kode_main)
        ->orderBy('tahun', 'desc')
        ->get();

        return datatables()->of($anggaran_list)
            ->addColumn('nama_submain', function ($row) {
                $link = '<a href="'.route('anggaran.submain.detail.index', ['kode_main' => $row->kode_main, 'kode_submain' => $row->kode_submain]).'">'.$row->nama_submain.'</a>';

                return $link;
            })
            ->addColumn('nilai_real', function ($row) {
                return currency_idr($row->nilai_real);
            })
            ->addColumn('nilai', function ($row) {
                return currency_idr($row->nilai);
            })
            ->addColumn('action', function ($row) {
                $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" name="radio1" value="'.$row->kode_submain.'"><span></span></label>';
                return $radio;
            })
            ->rawColumns(['action', 'nama_submain'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($kode_main)
    {
        return view('anggaran_submain.create', compact('kode_main'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnggaranSubmainStore $request, $kode_main)
    {
        $anggaran = new AnggaranSubMain;

        $anggaran->kode_main = $kode_main;
        $anggaran->kode_submain = $request->kode;
        $anggaran->nama_submain = $request->nama;
        $anggaran->nilai = $request->nilai;
        $anggaran->nilai_real = $request->nilai_real;
        $anggaran->inputdate = date('Y-m-d H:i:s');
        $anggaran->inputuser = Auth::user()->userid;
        $anggaran->tahun = $request->tahun;

        $anggaran->save();

        Alert::success('Simpan Anggaran Submain', 'Berhasil')->persistent(true)->autoClose(2000);
        return redirect()->route('anggaran.submain', ['kode_main' => $kode_main]);
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
