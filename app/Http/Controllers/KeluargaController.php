<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Model
use App\Models\Pekerja;
use App\Models\Keluarga;

//load form request (for validation)
use App\Http\Requests\KeluargaStore;
use App\Http\Requests\KeluargaUpdate;

// Load Plugin
use Carbon\Carbon;
use Auth;
use Storage;

class KeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexJson(Pekerja $pekerja)
    {
        $keluarga_list = Keluarga::where('nopeg', $pekerja->nopeg)->get();

        return datatables()->of($keluarga_list)
            ->addColumn('action', function ($row) {
                $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" name="radio_keluarga" value="'.$row->nopeg.'-'.$row->status.'-'.$row->nama.'"><span></span></label>';
                return $radio;
            })
            ->addColumn('status', function ($row) {
                if ($row->status == 'S') {
                    return "Suami";
                } elseif ($row->status == 'I') {
                    return "Istri";
                }

                return "Anak";
            })
            ->addColumn('agama', function ($row) {
                return $row->kode_agama->nama;
            })
            ->addColumn('tgllahir', function ($row) {
                return Carbon::parse($row->tgllahir)->translatedFormat('d F Y');
            })
            ->addColumn('pendidikan', function ($row) {
                return "$row->kodependidikan ($row->tempatpendidikan)";
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
    public function store(KeluargaStore $request, Pekerja $pekerja)
    {
        $keluarga                   = new Keluarga;
        $keluarga->nopeg            = $pekerja->nopeg;
        $keluarga->status           = $request->status_keluarga;
        $keluarga->nama             = $request->nama_keluarga;
        $keluarga->tempatlahir      = $request->tempat_lahir_keluarga;
        $keluarga->tgllahir         = $request->tanggal_lahir_keluarga;
        $keluarga->agama            = $request->agama_keluarga;
        $keluarga->goldarah         = $request->golongan_darah_keluarga;
        $keluarga->kodependidikan   = $request->pendidikan_keluarga;
        $keluarga->tempatpendidikan = $request->tempat_pendidikan_keluarga;
        $keluarga->kodept           = null;
        $keluarga->userid           = Auth::user()->userid;
        $keluarga->tglentry         = Carbon::now();

        $photo_keluarga = $request->file('photo_keluarga');
        $nama_keluarga = str_replace(' ', '_', $keluarga->nama);

        if ($photo_keluarga) {
            $photo = $photo_keluarga->getClientOriginalName();
            $extension = $photo_keluarga->getClientOriginalExtension();
            $keluarga->photo = str_replace(
                $photo,
                $pekerja->nopeg."_".$keluarga->status."_".$nama_keluarga.".".$extension,
                $photo
            );
            $photo_path = $photo_keluarga->storeAs('pekerja_img', $keluarga->photo, 'public');
        }

        $keluarga->save();

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
        $keluarga = Keluarga::where('nopeg', $request->nopeg)
        ->where('status', $request->status)
        ->where('nama', $request->nama)
        ->first();

        return response()->json($keluarga, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pekerja $pekerja, $status, $nama)
    {
        $keluarga = Keluarga::where('nopeg', $pekerja->nopeg)
        ->where('status', $status)
        ->where('nama', $nama)
        ->first();

        $keluarga->nopeg            = $pekerja->nopeg;
        $keluarga->status           = $request->status_keluarga;
        $keluarga->nama             = $request->nama_keluarga;
        $keluarga->tempatlahir      = $request->tempat_lahir_keluarga;
        $keluarga->tgllahir         = $request->tanggal_lahir_keluarga;
        $keluarga->agama            = $request->agama_keluarga;
        $keluarga->goldarah         = $request->golongan_darah_keluarga;
        $keluarga->kodependidikan   = $request->pendidikan_keluarga;
        $keluarga->tempatpendidikan = $request->tempat_pendidikan_keluarga;
        $keluarga->kodept           = null;
        $keluarga->userid           = Auth::user()->userid;
        $keluarga->tglentry         = Carbon::now();

        $photo_keluarga = $request->file('photo_keluarga');
        $nama_keluarga = str_replace(' ', '_', $keluarga->nama);

        if ($photo_keluarga) {
            $photo = $photo_keluarga->getClientOriginalName();
            $extension = $photo_keluarga->getClientOriginalExtension();
            $keluarga->photo = str_replace(
                $photo,
                $pekerja->nopeg."_".$keluarga->status."_".$nama_keluarga.".".$extension,
                $photo
            );
            $photo_path = $photo_keluarga->storeAs('pekerja_img', $keluarga->photo, 'public');
        }

        $keluarga->save();

        return response()->json(['response' => true], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $keluarga = Keluarga::where('nopeg', $request->nopeg)
        ->where('status', $request->status)
        ->where('nama', $request->nama)
        ->first();

        $image_path = "public/pekerja_img/$keluarga->photo";  // Value is not URL but directory file path
        Storage::delete($image_path);

        $keluarga->delete();

        return response()->json(['delete' => true], 200);
    }
}
