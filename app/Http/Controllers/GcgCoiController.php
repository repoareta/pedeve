<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Model
use App\Models\Jabatan;
use App\Models\KodeJabatan;

// Load Plugin
use Carbon\Carbon;
use Session;
use DomPDF;
use Auth;

class GcgCoiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jabatan_latest = Jabatan::where('nopeg', Auth::user()->nopeg)->latest()->first();
        $jabatan = KodeJabatan::where('kdbag', $jabatan_latest->kdbag)
        ->where('kdjab', $jabatan_latest->kdjab)
        ->first();

        return view('gcg.coi.lampiran_satu', compact('jabatan'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lampiranDua()
    {
        $jabatan_latest = Jabatan::where('nopeg', Auth::user()->nopeg)->latest()->first();
        $jabatan = KodeJabatan::where('kdbag', $jabatan_latest->kdbag)
        ->where('kdjab', $jabatan_latest->kdjab)
        ->first();

        return view('gcg.coi.lampiran_dua', compact('jabatan'));
    }

    public function lampiranSatuPrint(Request $request)
    {
        $konflik = $request->konflik;
        $tempat = $request->tempat;
        $tanggal_efektif = $request->tanggal_efektif;
        $jabatan_latest = Jabatan::where('nopeg', Auth::user()->nopeg)->latest()->first();
        $jabatan = KodeJabatan::where('kdbag', $jabatan_latest->kdbag)
        ->where('kdjab', $jabatan_latest->kdjab)
        ->first();

        $pdf = DomPDF::loadview('gcg.coi.lampiran_satu_print', compact(
            'konflik',
            'tempat',
            'tanggal_efektif',
            'jabatan'
        ));

        return $pdf->stream('coi_lampiran_satu'.date('Y-m-d H:i:s').'.pdf');
    }

    public function lampiranDuaPrint(Request $request)
    {
        $tempat = $request->tempat;
        $tanggal_efektif = $request->tanggal_efektif;
        $jabatan_latest = Jabatan::where('nopeg', Auth::user()->nopeg)->latest()->first();
        $jabatan = KodeJabatan::where('kdbag', $jabatan_latest->kdbag)
        ->where('kdjab', $jabatan_latest->kdjab)
        ->first();

        $pdf = DomPDF::loadview('gcg.coi.lampiran_dua_print', compact(
            'tempat',
            'tanggal_efektif',
            'jabatan'
        ));

        return $pdf->stream('coi_lampiran_dua'.date('Y-m-d H:i:s').'.pdf');
    }
}
