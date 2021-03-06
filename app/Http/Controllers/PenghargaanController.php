<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Model
use App\Models\Pekerja;
use App\Models\Penghargaan;

//load form request (for validation)
use App\Http\Requests\PenghargaanStore;
use App\Http\Requests\PenghargaanUpdate;

// Load Plugin
use Carbon\Carbon;
use Auth;

class PenghargaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexJson(Pekerja $pekerja)
    {
        $penghargaan_list = Penghargaan::where('nopeg', $pekerja->nopeg)->get();

        return datatables()->of($penghargaan_list)
            ->addColumn('action', function ($row) {
                $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" name="radio_penghargaan" value="'.$row->nopeg.'_'.$row->tanggal.'_'.$row->nama.'"><span></span></label>';
                return $radio;
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
        $penghargaan = new Penghargaan;
        $penghargaan->nopeg = $pekerja->nopeg;
        $penghargaan->tanggal = $request->tanggal_penghargaan;
        $penghargaan->nama = $request->nama_penghargaan;
        $penghargaan->pemberi = $request->pemberi_penghargaan;
        $penghargaan->userid = Auth::user()->userid;
        $penghargaan->tglentry = Carbon::now();

        $penghargaan->save();

        return response()->json($penghargaan, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showJson(Request $request)
    {
        $penghargaan = Penghargaan::where('nopeg', $request->nopeg)
        ->where('tanggal', $request->tanggal)
        ->where('nama', $request->nama)
        ->first();

        return response()->json($penghargaan, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pekerja $pekerja, $tanggal, $nama)
    {
        $penghargaan = Penghargaan::where('nopeg', $pekerja->nopeg)
        ->where('tanggal', $request->tanggal)
        ->where('nama', $request->nama)
        ->first();

        $penghargaan->nopeg = $pekerja->nopeg;
        $penghargaan->tanggal = $request->tanggal_penghargaan;
        $penghargaan->nama = $request->nama_penghargaan;
        $penghargaan->pemberi = $request->pemberi_penghargaan;
        $penghargaan->userid = Auth::user()->userid;

        $penghargaan->save();

        return response()->json($penghargaan, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $penghargaan = Penghargaan::where('nopeg', $request->nopeg)
        ->where('tanggal', $request->tanggal)
        ->where('nama', $request->nama)
        ->delete();

        return response()->json(['deleted' => true], 200);
    }
}
