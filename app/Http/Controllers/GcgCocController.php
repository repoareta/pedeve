<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Plugin
use Carbon\Carbon;
use Session;
use PDF;
use Auth;

class GcgCocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('gcg.coc.lampiran_satu');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lampiranDua()
    {
        return view('gcg.coc.lampiran_dua');
    }

    public function lampiranSatuPrint(Request $request)
    {
        $tempat = $request->tempat;
        $tanggal_efektif = $request->tanggal_efektif;

        $pdf = PDF::loadview('gcg.coc.lampiran_satu_print', compact('tempat', 'tanggal_efektif'));

        return $pdf->stream('coc_lampiran_satu'.date('Y-m-d H:i:s').'.pdf');
    }

    public function lampiranDuaPrint(Request $request)
    {
        $orang = $request->orang;
        $tanggal_efektif = $request->tanggal_efektif;

        $pdf = PDF::loadview('gcg.coc.lampiran_dua_print', compact('orang', 'tanggal_efektif'));

        return $pdf->stream('coc_lampiran_dua'.date('Y-m-d H:i:s').'.pdf');
    }
}
