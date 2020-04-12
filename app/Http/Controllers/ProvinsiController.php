<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Model
use App\Models\Provinsi;

//load form request (for validation)
use App\Http\Requests\ProvinsiStore;
use App\Http\Requests\ProvinsiUpdate;

// Load Plugin
use Alert;

class ProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('provinsi.index');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function indexJson()
    {
        $provinsi_list = Provinsi::orderBy('kode', 'desc')->get();

        return datatables()->of($provinsi_list)
            ->addColumn('action', function ($row) {
                $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" name="radio1" value="'.$row->kode.'"><span></span></label>';
                return $radio;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('provinsi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProvinsiStore $request)
    {
        $provinsi = new Provinsi;
        $provinsi->kode = $request->kode;
        $provinsi->nama = $request->nama;
        $provinsi->save();

        Alert::success('Simpan Data Provinsi', 'Berhasil')->persistent(true)->autoClose(2000);
        return redirect()->route('provinsi.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Provinsi $provinsi)
    {
        return view('provinsi.edit', compact('provinsi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProvinsiUpdate $request, Provinsi $provinsi)
    {
        $provinsi->kode = $request->kode;
        $provinsi->nama = $request->nama;
        $provinsi->save();

        Alert::success('Ubah Data Provinsi', 'Berhasil')->persistent(true)->autoClose(2000);
        return redirect()->route('provinsi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        Provinsi::find($request->id)
        ->delete();

        return response()->json();
    }
}
