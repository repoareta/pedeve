<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Model
use App\Models\Pekerja;
use App\Models\Jabatan;

//load form request (for validation)
use App\Http\Requests\JabatanStore;
use App\Http\Requests\JabatanUpdate;

// Load Plugin
use Carbon\Carbon;
use Auth;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexJson(Pekerja $pekerja)
    {
        $jabatan_list = Jabatan::where('nopeg', $pekerja->nopeg)->get();

        return datatables()->of($jabatan_list)
            ->addColumn('action', function ($row) {
                $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" name="radio_jabatan" value="'.$row->nopeg.'_'.$row->mulai.'_'.$row->kdbag.'_'.$row->kdjab.'"><span></span></label>';
                return $radio;
            })
            ->addColumn('bagian', function ($row) {
                return $row->kdbag.' - '.$row->kode_bagian->nama;
            })
            ->addColumn('jabatan', function ($row) {
                return $row->kdjab;
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
        $jabatan           = new Jabatan;
        $jabatan->nopeg    = $pekerja->nopeg;
        $jabatan->kdbag    = $request->bagian_pekerja;
        $jabatan->kdjab    = $request->jabatan_pekerja;
        $jabatan->mulai    = $request->mulai;
        $jabatan->sampai   = $request->sampai;
        $jabatan->noskep   = $request->no_skep;
        $jabatan->tglskep  = $request->tanggal_skep;
        $jabatan->userid   = Auth::user()->userid;
        $jabatan->tglentry = Carbon::now();
        $jabatan->id       = null;

        $jabatan->save();

        return response()->json(['response' => true], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showJson(Request $request)
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
    public function update(Request $request, Pekerja $pekerja, $mulai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $jabatan = Jabatan::where('nopeg', $request->nopeg)
        ->where('mulai', $request->mulai)
        ->where('kdbag', $request->kdbag)
        ->where('kdjab', $request->kdjab)
        ->delete();

        return response()->json(['deleted' => true], 200);
    }
}
