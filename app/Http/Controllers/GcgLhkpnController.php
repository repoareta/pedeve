<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Model
use App\Models\GcgLhkpn;

//load form request (for validation)
use App\Http\Requests\GcgLHKPNStore;

// Load Plugin
use Alert;

class GcgLhkpnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lhkpn_list = GcgLhkpn::all();
        return view('gcg.lhkpn.index', compact('lhkpn_list'));
    }

    public function create()
    {
        return view('gcg.lhkpn.create');
    }

    public function store(GcgLHKPNStore $request, GcgLhkpn $lhkpn)
    {
        $file = $request->file('dokumen');

        $lhkpn->status  = $request->status_lhkpn;
        $lhkpn->tanggal = $request->tanggal;
        $lhkpn->nopeg   = auth()->user()->nopeg;

        if ($file) {
            $file_name = $file->getClientOriginalName();
            $file_ext = $file->getClientOriginalExtension();
            $lhkpn->dokumen = $file_name;
            $file_path = $file->storeAs('lhkpn', $lhkpn->dokumen, 'public');
        }

        $lhkpn->save();

        Alert::success('Tambah Laporan LHKPN', 'Berhasil')->persistent(true)->autoClose(2000);
        return redirect()->route('gcg.lhkpn.index');
    }
}
