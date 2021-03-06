<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Model
use App\Models\PerusahaanAfiliasi;
use App\Models\Direksi;

//load form request (for validation)
use App\Http\Requests\DireksiStore;
use App\Http\Requests\DireksiUpdate;

class DireksiController extends Controller
{
    /**
     * Menampilkan daftar direksi perusahaan tersebut
     *
     * @return void
     */
    public function indexJson($perusahaan_afiliasi)
    {
        $direksi_list = Direksi::where('perusahaan_afiliasi_id', $perusahaan_afiliasi);

        return datatables()->of($direksi_list)
            ->addColumn('action', function ($row) {
                $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" name="radio_direksi" nama="'.$row->nama.'" value="'.$row->id.'"><span></span></label>';
                return $radio;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Insert Pemegang Saham Ke Database
     *
     * @param DireksiStore $request
     * @param PerusahaanAfiliasi $perusahaan_afiliasi
     * @param Direksi $direksi
     * @return void
     */
    public function store(
        DireksiStore $request,
        PerusahaanAfiliasi $perusahaan_afiliasi,
        Direksi $direksi
    ) {
        $direksi->perusahaan_afiliasi_id = $perusahaan_afiliasi->id;
        $direksi->nama = $request->nama_direksi;
        $direksi->tmt_dinas = $request->tmt_dinas;
        $direksi->akhir_masa_dinas = $request->akhir_masa_dinas;
        $direksi->created_by = auth()->user()->nopeg;

        $direksi->save();

        return response()->json($direksi, 200);
    }

    /**
     * menampilkan detail satu data pemegang saham
     *
     * @param PerusahaanAfiliasi $perusahaan_afiliasi
     * @param Direksi $direksi
     * @return void
     */
    public function show(PerusahaanAfiliasi $perusahaan_afiliasi, Direksi $direksi)
    {
        return response()->json($direksi, 200);
    }

    /**
     * Undocumented function
     *
     * @param DireksiUpdate $request
     * @param PerusahaanAfiliasi $perusahaan_afiliasi
     * @param Direksi $direksi
     * @return void
     */
    public function update(
        DireksiUpdate $request,
        PerusahaanAfiliasi $perusahaan_afiliasi,
        Direksi $direksi
    ) {
        $direksi->perusahaan_afiliasi_id = $perusahaan_afiliasi->id;
        $direksi->nama = $request->nama_direksi;
        $direksi->tmt_dinas = $request->tmt_dinas;
        $direksi->akhir_masa_dinas = $request->akhir_masa_dinas;
        $direksi->created_by = auth()->user()->nopeg;

        $direksi->save();

        return response()->json($direksi, 200);
    }

    /**
     * Delete Pemegang Saham
     *
     * @param Direksi $direksi
     * @return void
     */
    public function delete(PerusahaanAfiliasi $perusahaan_afiliasi, Direksi $direksi)
    {
        $direksi->delete();

        return response()->json(['delete' => true], 200);
    }
}
