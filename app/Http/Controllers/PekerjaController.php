<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Model
use App\Models\Pekerja;
use App\Models\Jabatan;
use App\Models\KodeJabatan;
use App\Models\KodeBagian;

//load form request (for validation)
use App\Http\Requests\PekerjaStore;
use App\Http\Requests\PekerjaUpdate;

// Load Plugin
use Alert;

class PekerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pekerja.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexJson()
    {
        $pekerja_list = Pekerja::orderBy('nopeg', 'desc')
        ->with('jabatan')
        ->get();

        return datatables()->of($pekerja_list)
            ->addColumn('action', function ($row) {
                $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" name="radio1" value="'.$row->nopeg.'"><span></span></label>';
                return $radio;
            })
            ->addColumn('bagian', function ($row) {
                $kode_bagian = optional($row->jabatan_latest())->kdbag;
                $bagian = KodeBagian::find($kode_bagian);
                $nama_bagian = optional($bagian)->nama ? ' - '.optional($bagian)->nama : null;
                
                return $kode_bagian.$nama_bagian;
            })
            ->addColumn('jabatan', function ($row) {
                $kode_bagian = optional($row->jabatan_latest())->kdbag;
                $kode_jabatan = optional($row->jabatan_latest())->kdjab;
                $jabatan = KodeJabatan::where('kdbag', $kode_bagian)
                    ->where('kdjab', $kode_jabatan)
                    ->first();
                $nama_jabatan = optional($jabatan)->keterangan ? ' - '.optional($jabatan)->keterangan : null;
                
                return $kode_jabatan.$nama_jabatan;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showJson(Pekerja $pekerja)
    {
        // SHOW
        // Nopeg, Nama Jabatan dan Golongan
        $pekerja = $pekerja->jabatan_latest();
        $kode_jabatan = KodeJabatan::where('kdjab', $pekerja->kdjab)
        ->where('kdbag', $pekerja->kdbag)
        ->firstOrFail();

        $data = [
            'golongan' => $kode_jabatan->goljob,
            'jabatan' => $kode_jabatan->keterangan,
        ];

        return response()->json($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
