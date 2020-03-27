<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Model
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
                $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" name="radio1" value="'.$row->no_panjar.'"><span></span></label>';
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
