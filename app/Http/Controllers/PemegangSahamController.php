<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Model
use App\Models\PerusahaanAfiliasi;
use App\Models\PemegangSaham;

//load form request (for validation)
use App\Http\Requests\PemegangSahamStore;
use App\Http\Requests\PemegangSahamUpdate;

class PemegangSahamController extends Controller
{
    /**
     * Menampilkan daftar pemegang saham perusahaan tersebut
     *
     * @return void
     */
    public function indexJson($perusahaan_afiliasi)
    {
        $pemegang_saham_list = PemegangSaham::where('perusahaan_afiliasi_id', $perusahaan_afiliasi);

        return datatables()->of($pemegang_saham_list)
            ->addColumn('action', function ($row) {
                $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" name="radio_pemegang_saham" nama="'.$row->nama.'" value="'.$row->id.'"><span></span></label>';
                return $radio;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Undocumented function
     *
     * @param PemegangSahamStore $request
     * @param PerusahaanAfiliasi $perusahaan_afiliasi
     * @param PemegangSaham $pemegang_saham
     * @return void
     */
    public function store(
        PemegangSahamStore $request,
        PerusahaanAfiliasi $perusahaan_afiliasi,
        PemegangSaham $pemegang_saham
    ) {
        $pemegang_saham->perusahaan_afiliasi_id = $perusahaan_afiliasi->id;
        $pemegang_saham->nama = $request->nama_pemegang_saham;
        $pemegang_saham->kepemilikan = $request->kepemilikan;
        $pemegang_saham->jumlah_lembar_saham = $request->jumlah_lembar_saham_pemegang_saham;
        $pemegang_saham->created_by = auth()->user()->nopeg;

        $pemegang_saham->save();

        return response()->json($pemegang_saham, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Undocumented function
     *
     * @param PemegangSahamUpdate $request
     * @param PerusahaanAfiliasi $perusahaan_afiliasi
     * @param PemegangSaham $pemegang_saham
     * @return void
     */
    public function update(
        PemegangSahamUpdate $request,
        PerusahaanAfiliasi $perusahaan_afiliasi,
        PemegangSaham $pemegang_saham
    ) {
        //
    }

    /**
     * Delete Pemegang Saham
     *
     * @param PemegangSaham $pemegang_saham
     * @return void
     */
    public function delete(PerusahaanAfiliasi $perusahaan_afiliasi, PemegangSaham $pemegang_saham)
    {
        $pemegang_saham->delete();
        
        return response()->json(['delete' => true], 200);
    }
}
