<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Model
use App\Models\Pekerja;
use App\Models\GolonganGaji;

//load form request (for validation)
use App\Http\Requests\GolonganGajiStore;
use App\Http\Requests\GolonganGajiUpdate;

// Load Plugin
use Carbon\Carbon;
use Auth;

class GolonganGajiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexJson(Pekerja $pekerja)
    {
        $golongan_gaji_list = GolonganGaji::where('nopeg', $pekerja->nopeg)->get();

        return datatables()->of($golongan_gaji_list)
            ->addColumn('action', function ($row) {
                $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" name="radio_golongan_gaji" value="'.$row->nopeg.'_'.$row->golgaji.'_'.$row->tanggal.'"><span></span></label>';
                return $radio;
            })
            ->addColumn('tanggal', function ($row) {
                return Carbon::parse($row->tanggal)->translatedFormat('d F Y');
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
        $golongan_gaji = new GolonganGaji;
        $golongan_gaji->nopeg = $pekerja->nopeg;
        $golongan_gaji->tanggal = $request->tanggal_golongan_gaji;
        $golongan_gaji->golgaji = $request->golongan_gaji;
        $golongan_gaji->userid = Auth::user()->userid;
        $golongan_gaji->tglentry = Carbon::now();

        $golongan_gaji->save();

        return response()->json($golongan_gaji, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showJson(Request $request)
    {
        $golongan_gaji = GolonganGaji::where('nopeg', $request->nopeg)
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
        $golongan_gaji = GolonganGaji::where('nopeg', $pekerja->nopeg)
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
        $golongan_gaji = GolonganGaji::where('nopeg', $request->nopeg)
        ->where('golgaji', $request->golongan_gaji)
        ->where('tanggal', $request->tanggal)
        ->delete();

        return response()->json(['deleted' => true], 200);
    }
}
