<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Model
use App\Models\GcgGratifikasi;
use App\Models\Jabatan;
use App\Models\KodeJabatan;

// Load Plugin
use Auth;

class GcgController extends Controller
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

        $gratifikasi_list = GcgGratifikasi::selectRaw("
            extract(year from created_at) AS year, 
            extract(month from created_at) AS month, 
            COUNT(CASE WHEN (jenis_gratifikasi = 'pemberian') THEN jenis_gratifikasi ELSE NULL END) AS pemberian,
            COUNT(CASE WHEN (jenis_gratifikasi = 'penerimaan') THEN jenis_gratifikasi ELSE NULL END) AS penerimaan,
            COUNT(CASE WHEN (jenis_gratifikasi = 'permintaan') THEN jenis_gratifikasi ELSE NULL END) AS permintaan
        ")
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->get();

        return view('gcg.index', compact('gratifikasi_list', 'jabatan'));
    }
}