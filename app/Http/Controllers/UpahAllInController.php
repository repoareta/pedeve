<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Model
use App\Models\Pekerja;
use App\Models\UpahAllIn;

//load form request (for validation)
use App\Http\Requests\UpahAllInStore;
use App\Http\Requests\UpahAllInUpdate;

// Load Plugin
use Carbon\Carbon;
use Auth;
use DB;

class UpahAllInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexJson(Pekerja $pekerja)
    {
        $upah_all_in_list = UpahAllIn::where('nopek', $pekerja->nopeg)->get();

        return datatables()->of($upah_all_in_list)
            ->addColumn('action', function ($row) {
                $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" name="radio_upah_all_in" value="'.$row->nopek.'-'.$row->nilai.'"><span></span></label>';
                return $radio;
            })
            ->addColumn('nilai', function ($row) {
                return currency_idr($row->nilai);
            })
            ->addColumn('mulai', function ($row) {
                if ($row->mulai) {
                    return Carbon::parse($row->mulai)->translatedFormat('d F Y');
                }
                return null;
            })
            ->addColumn('sampai', function ($row) {
                if ($row->sampai) {
                    return Carbon::parse($row->sampai)->translatedFormat('d F Y');
                }
                return null;
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
        $upah           = new UpahAllIn;
        $upah->nopek    = $pekerja->nopeg;
        $upah->nilai    = $request->nilai_upah_all_in;
        $upah->mulai    = $request->mulai_upah_all_in;
        $upah->sampai   = $request->sampai_upah_all_in;
        $upah->userid   = Auth::user()->userid;
        $upah->tglentry = Carbon::now();

        $upah->save();

        return response()->json($upah, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showJson(Request $request)
    {
        $upah = UpahAllIn::where('nopek', $request->nopeg)
        ->where('nilai', $request->nilai)
        ->first();

        $upah['mulai_date'] = $upah->formated_mulai;
        $upah['sampai_date'] = $upah->formated_sampai;

        return response()->json($upah, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pekerja $pekerja, $nilai)
    {
        $upah = UpahAllIn::where('nopek', $pekerja->nopeg)
        ->where('nilai', $request->nilai)
        ->first();

        $upah->nopek    = $pekerja->nopeg;
        $upah->nilai    = $request->nilai_upah_all_in;
        $upah->mulai    = $request->mulai_upah_all_in;
        $upah->sampai   = $request->sampai_upah_all_in;
        $upah->userid   = Auth::user()->userid;

        $upah->save();

        return response()->json($upah, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $upah = UpahAllIn::where('nopek', $request->nopeg)
        ->where('nilai', $request->nilai)
        ->delete();

        return response()->json(['delete' => true], 200);
    }
}
