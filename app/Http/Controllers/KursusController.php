<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Model
use App\Models\Pekerja;
use App\Models\Kursus;

//load form request (for validation)
use App\Http\Requests\KursusStore;
use App\Http\Requests\KursusUpdate;

// Load Plugin
use Carbon\Carbon;
use Auth;

class KursusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexJson(Pekerja $pekerja)
    {
        $kursus_list = Kursus::where('nopeg', $pekerja->nopeg)->get();

        return datatables()->of($kursus_list)
            ->addColumn('action', function ($row) {
                $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" name="radio_kursus" value="'.$row->nopeg.'_'.$row->mulai.'_'.$row->nama.'"><span></span></label>';
                return $radio;
            })
            ->addColumn('mulai', function ($row) {
                return Carbon::parse($row->mulai)->translatedFormat('d F Y');
            })
            ->addColumn('sampai', function ($row) {
                return Carbon::parse($row->sampai)->translatedFormat('d F Y');
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
        $kursus = new Kursus;
        $kursus->nopeg         = $pekerja->nopeg;
        $kursus->mulai         = $request->mulai_kursus;
        $kursus->sampai        = $request->sampai_kursus;
        $kursus->nama          = $request->nama_kursus;
        $kursus->penyelenggara = $request->penyelenggara_kursus;
        $kursus->kota          = $request->kota_kursus;
        $kursus->negara        = $request->negara_kursus;
        $kursus->keterangan    = $request->keterangan_kursus;
        $kursus->userid        = Auth::user()->userid;
        $kursus->tglentry      = Carbon::now();

        $kursus->save();

        return response()->json($kursus, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showJson(Request $request)
    {
        $kursus = Kursus::where('nopeg', $request->nopeg)
        ->where('mulai', $request->mulai)
        ->where('nama', $request->nama)
        ->first();

        return response()->json($kursus, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pekerja $pekerja, $mulai, $nama)
    {
        $kursus = Kursus::where('nopeg', $pekerja->nopeg)
        ->where('mulai', $mulai)
        ->where('nama', $nama)
        ->first();

        $kursus->nopeg         = $pekerja->nopeg;
        $kursus->mulai         = $request->mulai_kursus;
        $kursus->sampai        = $request->sampai_kursus;
        $kursus->nama          = $request->nama_kursus;
        $kursus->penyelenggara = $request->penyelenggara_kursus;
        $kursus->kota          = $request->kota_kursus;
        $kursus->negara        = $request->negara_kursus;
        $kursus->keterangan    = $request->keterangan_kursus;
        $kursus->userid        = Auth::user()->userid;

        $kursus->save();

        return response()->json($kursus, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $kursus = Kursus::where('nopeg', $request->nopeg)
        ->where('mulai', $request->mulai)
        ->where('nama', $request->nama)
        ->delete();

        return response()->json(['delete' => true], 200);
    }
}
