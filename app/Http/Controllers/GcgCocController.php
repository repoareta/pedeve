<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Model
use App\Models\GcgCoc;

// Load Plugin
use Carbon\Carbon;
use Session;
use DomPDF;
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

    public function lampiranSatuPrint(Request $request, GcgCoc $gcgCoc)
    {
        $tempat = $request->tempat;
        $tanggal_efektif = $request->tanggal_efektif;

        // insert
        $gcgCoc->lampiran = 1;
        $gcgCoc->nopeg = Auth::user()->nopeg;
        $gcgCoc->save();

        $pdf = DomPDF::loadview('gcg.coc.lampiran_satu_print', compact('tempat', 'tanggal_efektif'));

        return $pdf->stream('coc_lampiran_satu'.date('Y-m-d H:i:s').'.pdf');
    }

    public function lampiranDuaPrint(Request $request, GcgCoc $gcgCoc)
    {
        $orang = $request->orang;
        $tanggal_efektif = $request->tanggal_efektif;

        // insert
        $gcgCoc->lampiran = 2;
        $gcgCoc->nopeg = Auth::user()->nopeg;
        $gcgCoc->save();


        $pdf = DomPDF::loadview('gcg.coc.lampiran_dua_print', compact('orang', 'tanggal_efektif'));

        return $pdf->stream('coc_lampiran_dua'.date('Y-m-d H:i:s').'.pdf');
    }
}
