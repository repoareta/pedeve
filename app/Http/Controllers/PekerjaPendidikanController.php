<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Model
use App\Models\Pekerja;
use App\Models\PekerjaPendidikan;

//load form request (for validation)
use App\Http\Requests\PekerjaPendidikanStore;
use App\Http\Requests\PekerjaPendidikanUpdate;

// Load Plugin
use Carbon\Carbon;
use Auth;

class PekerjaPendidikanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexJson(Pekerja $pekerja)
    {
        $pendidikan_list = PekerjaPendidikan::where('nopeg', $pekerja->nopeg)->get();

        return datatables()->of($pendidikan_list)
            ->addColumn('action', function ($row) {
                $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" name="radio_pendidikan" value="'.$row->nopeg.'_'.$row->mulai.'_'.$row->tempatdidik.'_'.$row->kodedidik.'"><span></span></label>';
                
                return $radio;
            })
            ->addColumn('namapt', function ($row) {
                return optional($row->perguruan_tinggi)->nama;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Pekerja $pekerja)
    {
        $pekerja_pendidikan = new PekerjaPendidikan;
        $pekerja_pendidikan->nopeg       = $pekerja->nopeg;
        $pekerja_pendidikan->mulai       = $request->mulai_pendidikan_pekerja;
        $pekerja_pendidikan->tgllulus    = $request->sampai_pendidikan_pekerja;
        $pekerja_pendidikan->kodedidik   = $request->kode_pendidikan_pekerja;
        $pekerja_pendidikan->tempatdidik = $request->tempat_didik_pekerja;
        $pekerja_pendidikan->kodept      = $request->kode_pt_pendidikan_pekerja;
        $pekerja_pendidikan->catatan     = $request->catatan_pendidikan_pekerja;
        $pekerja_pendidikan->userid      = Auth::user()->userid;
        $pekerja_pendidikan->tglentry    = Carbon::now();

        $pekerja_pendidikan->save();

        return response()->json($pekerja_pendidikan, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showJson(Request $request)
    {
        $pekerja_pendidikan = PekerjaPendidikan::where('nopeg', $request->nopeg)
        ->where('mulai', $request->mulai)
        ->where('tempatdidik', $request->tempatdidik)
        ->where('kodedidik', $request->kodedidik)
        ->first();

        return response()->json($pekerja_pendidikan, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pekerja $pekerja, $mulai, $tempatdidik, $kodedidik)
    {
        $pekerja_pendidikan = PekerjaPendidikan::where('nopeg', $pekerja->nopeg)
        ->where('mulai', $request->mulai)
        ->where('tempatdidik', $request->tempatdidik)
        ->where('kodedidik', $request->kodedidik)
        ->first();

        $pekerja_pendidikan->nopeg       = $pekerja->nopeg;
        $pekerja_pendidikan->mulai       = $request->mulai_pendidikan_pekerja;
        $pekerja_pendidikan->tgllulus    = $request->sampai_pendidikan_pekerja;
        $pekerja_pendidikan->kodedidik   = $request->kode_pendidikan_pekerja;
        $pekerja_pendidikan->tempatdidik = $request->tempat_didik_pekerja;
        $pekerja_pendidikan->kodept      = $request->kode_pt_pendidikan_pekerja;
        $pekerja_pendidikan->catatan     = $request->catatan_pendidikan_pekerja;
        $pekerja_pendidikan->userid      = Auth::user()->userid;

        $pekerja_pendidikan->save();

        return response()->json($pekerja_pendidikan, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $pekerja_pendidikan = PekerjaPendidikan::where('nopeg', $request->nopeg)
        ->where('mulai', $request->mulai)
        ->where('tempatdidik', $request->tempatdidik)
        ->where('kodedidik', $request->kodedidik)
        ->delete();

        return response()->json(['delete' => true], 200);
    }
}
