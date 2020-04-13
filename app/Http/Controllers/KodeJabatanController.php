<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Model
use App\Models\KodeBagian;
use App\Models\KodeJabatan;

//load form request (for validation)
use App\Http\Requests\KodeJabatanStore;
use App\Http\Requests\KodeJabatanUpdate;

// Load Plugin
use Alert;

class KodeJabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kode_jabatan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexJson()
    {
        $kode_jabatan_list = KodeJabatan::with('kode_bagian')
        ->orderBy('kdbag', 'asc')
        ->orderBy('kdjab', 'asc')
        ->get();

        return datatables()->of($kode_jabatan_list)
            ->addColumn('action', function ($row) {
                $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" name="radio1" value="'.$row->kode.'"><span></span></label>';
                return $radio;
            })
            ->addColumn('kdbag', function ($row) {
                $kode_bagian = optional($row->kode_bagian)->nama ? ' - '.$row->kode_bagian->nama : null;
                return $row->kdbag.$kode_bagian;
            })
            ->addColumn('tunjangan', function ($row) {
                return currency_idr($row->tunjangan);
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
        $kode_bagian_list = KodeBagian::all();
        return view('kode_jabatan.create', compact('kode_bagian_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KodeJabatanStore $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('kode_jabatan.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KodeJabatanUpdate $request, $id)
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
        //
    }
}
