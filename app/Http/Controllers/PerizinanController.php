<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Model
use App\Models\PerusahaanAfiliasi;
use App\Models\Perizinan;

//load form request (for validation)
use App\Http\Requests\PerizinanStore;
use App\Http\Requests\PerizinanUpdate;

class PerizinanController extends Controller
{
    /**
     * Menampilkan daftar perizinan perusahaan tersebut
     *
     * @return void
     */
    public function indexJson($perusahaan_afiliasi)
    {
        $perizinan_list = Perizinan::where('perusahaan_afiliasi_id', $perusahaan_afiliasi);

        return datatables()->of($perizinan_list)
            ->addColumn('action', function ($row) {
                $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" name="radio_perizinan" nama="'.$row->nama.'" value="'.$row->id.'"><span></span></label>';
                return $radio;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Insert Pemegang Saham Ke Database
     *
     * @param PerizinanStore $request
     * @param PerusahaanAfiliasi $perusahaan_afiliasi
     * @param Perizinan $perizinan
     * @return void
     */
    public function store(
        PerizinanStore $request,
        PerusahaanAfiliasi $perusahaan_afiliasi,
        Perizinan $perizinan
    ) {
        $perizinan->perusahaan_afiliasi_id = $perusahaan_afiliasi->id;
        $perizinan->keterangan = $request->keterangan_perizinan;
        $perizinan->nomor = $request->nomor_perizinan;
        $perizinan->masa_berlaku_akhir = $request->masa_berlaku_akhir_perizinan;
        $perizinan->created_by = auth()->user()->nopeg;

        $file = $request->file('dokumen_perizinan');

        if ($file) {
            $file_name = $file->getClientOriginalName();
            $perizinan->dokumen = $file_name;
            $file_path = $file->storeAs(
                $perusahaan_afiliasi->id.'/perizinan',
                $perizinan->dokumen,
                'public'
            );
        }

        $perizinan->save();

        return response()->json($perizinan, 200);
    }

    /**
     * menampilkan detail satu data pemegang saham
     *
     * @param PerusahaanAfiliasi $perusahaan_afiliasi
     * @param Perizinan $perizinan
     * @return void
     */
    public function show(PerusahaanAfiliasi $perusahaan_afiliasi, Perizinan $perizinan)
    {
        return response()->json($perizinan, 200);
    }

    /**
     * Undocumented function
     *
     * @param PerizinanUpdate $request
     * @param PerusahaanAfiliasi $perusahaan_afiliasi
     * @param Perizinan $perizinan
     * @return void
     */
    public function update(
        PerizinanUpdate $request,
        PerusahaanAfiliasi $perusahaan_afiliasi,
        Perizinan $perizinan
    ) {
        $perizinan->perusahaan_afiliasi_id = $perusahaan_afiliasi->id;
        $perizinan->nama = $request->nama_perizinan;
        $perizinan->tmt_dinas = $request->tmt_dinas;
        $perizinan->akhir_masa_dinas = $request->akhir_masa_dinas;
        $perizinan->created_by = auth()->user()->nopeg;

        $perizinan->save();

        return response()->json($perizinan, 200);
    }

    /**
     * Delete Pemegang Saham
     *
     * @param Perizinan $perizinan
     * @return void
     */
    public function delete(PerusahaanAfiliasi $perusahaan_afiliasi, Perizinan $perizinan)
    {
        $perizinan->delete();

        return response()->json(['delete' => true], 200);
    }
}
