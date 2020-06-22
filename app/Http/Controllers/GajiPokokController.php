<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Model
use App\Models\Pekerja;
use App\Models\GajiPokok;

//load form request (for validation)
use App\Http\Requests\GajiPokokStore;
use App\Http\Requests\GajiPokokUpdate;

// Load Plugin
use Carbon\Carbon;
use Auth;

class GajiPokokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexJson(Pekerja $pekerja)
    {
        $gaji_pokok_list = GajiPokok::where('nopeg', $pekerja->nopeg)->get();

        return datatables()->of($gaji_pokok_list)
            ->addColumn('action', function ($row) {
                $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" name="radio_golongan_gaji" value="'.$row->nopeg.'_'.$row->gapok.'"><span></span></label>';
                return $radio;
            })
            ->addColumn('gapok', function ($row) {
                return currency_idr($row->gapok);
            })
            ->addColumn('mulai', function ($row) {
                return Carbon::parse($row->mulai)->translatedFormat('d F Y');
            })
            ->addColumn('sampai', function ($row) {
                return Carbon::parse($row->mulai)->translatedFormat('d F Y');
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
        $gaji_pokok = new GajiPokok;
        $gaji_pokok->nopeg = $pekerja->nopeg;
        $gaji_pokok->mulai = $request->mulai_gaji_pokok;
        $gaji_pokok->sampai = $request->sampai_gaji_pokok;
        $gaji_pokok->gapok = $request->nilai_gaji_pokok;
        $gaji_pokok->keterangan = $request->keterangan_gaji_pokok;
        $gaji_pokok->userid = Auth::user()->userid;
        $gaji_pokok->tglentry = Carbon::now();

        $gaji_pokok->save();

        return response()->json($gaji_pokok, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showJson(Request $request)
    {
        $golongan_gaji = GajiPokok::where('nopeg', $request->nopeg)
        ->where('golgaji', $request->golongan_gaji)
        ->where('tanggal', $request->tanggal)
        ->first();

        return response()->json($golongan_gaji, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pekerja $pekerja, $golongan_gaji, $tanggal)
    {
        $golongan_gaji = GajiPokok::where('nopeg', $pekerja->nopeg)
        ->where('golgaji', $golongan_gaji)
        ->where('tanggal', $tanggal)
        ->first();
        
        $golongan_gaji->nopeg = $pekerja->nopeg;
        $golongan_gaji->tanggal = $request->tanggal_golongan_gaji;
        $golongan_gaji->golgaji = $request->golongan_gaji;
        $golongan_gaji->userid = Auth::user()->userid;

        $golongan_gaji->save();

        return response()->json($golongan_gaji, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $golongan_gaji = GajiPokok::where('nopeg', $request->nopeg)
        ->where('golgaji', $request->golongan_gaji)
        ->where('tanggal', $request->tanggal)
        ->delete();

        return response()->json(['deleted' => true], 200);
    }
}
