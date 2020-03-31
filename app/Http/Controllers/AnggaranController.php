<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// load model
use App\Models\AnggaranMain;

// Load Plugin
use Carbon\Carbon;
use Session;
use PDF;
use Excel;
use Alert;

class AnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('anggaran.index');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function indexJson()
    {
        $anggaran_list = AnggaranMain::orderBy('tahun', 'desc')->get();

        return datatables()->of($anggaran_list)
            ->addColumn('nama_main', function ($row) {
                $link = '<a href="'.route('anggaran.submain', ['kode_main' => $row->kode_main]).'">'.$row->nama_main.'</a>';

                return $link;
            })
            ->addColumn('nilai_real', function ($row) {
                return currency_idr($row->nilai_real);
            })
            ->addColumn('realisasi', function ($row) {
                return currency_idr($row->anggaran_submain->sum('nilai'));
            })
            ->addColumn('sisa', function ($row) {
                return currency_idr($row->nilai_real - $row->anggaran_submain->sum('nilai'));
            })
            ->addColumn('action', function ($row) {
                $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" name="radio1" value="'.$row->kode_main.'"><span></span></label>';
                return $radio;
            })
            ->rawColumns(['action', 'nama_main'])
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
