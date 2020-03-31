<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// load model
use App\Models\AnggaranDetail;

class AnggaranSubMainDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kode_main, $kode_submain)
    {
        return view('anggaran_submain_detail.index', compact('kode_main', 'kode_submain'));
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function indexJson($kode_submain)
    {
        $anggaran_list = AnggaranDetail::where('kode_submain', $kode_submain)
        ->orderBy('tahun', 'desc')
        ->get();

        return datatables()->of($anggaran_list)
            ->addColumn('nilai', function ($row) {
                return currency_idr($row->nilai);
            })
            ->addColumn('action', function ($row) {
                $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" name="radio1" value="'.$row->kode.'"><span></span></label>';
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
