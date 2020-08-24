<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Model
use App\Models\GcgSosialisasi;

//load form request (for validation)
use App\Http\Requests\GcgSosialisasiStore;

// Load Plugin
use Alert;

class GcgSosialisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sosialisasi_list = GcgSosialisasi::all();
        return view('gcg.sosialisasi.index', compact('sosialisasi_list'));
    }

    public function create()
    {
        return view('gcg.sosialisasi.create');
    }

    public function store(GcgSosialisasiStore $request, GcgSosialisasi $sosialisasi)
    {
        $file = $request->file('dokumen');

        $sosialisasi->keterangan = $request->keterangan;
        $sosialisasi->nopeg = auth()->user()->nopeg;

        if ($file) {
            $file_name = $file->getClientOriginalName();
            $file_ext = $file->getClientOriginalExtension();
            $sosialisasi->dokumen = $file_name;
            $file_path = $file->storeAs('sosialisasi', $sosialisasi->dokumen, 'public');
        }

        $sosialisasi->save();

        Alert::success('Tambah Sosialisasi', 'Berhasil')->persistent(true)->autoClose(2000);
        return redirect()->route('gcg.sosialisasi.index');
    }
}
