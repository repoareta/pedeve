<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Model
use App\Models\InsentifMaster;
use App\Models\Pekerja;
use App\Models\AardPayroll;

//load form request (for validation)
use App\Http\Requests\InsentifMasterStore;
use App\Http\Requests\InsentifMasterUpdate;

// Load Plugin
use Carbon\Carbon;
use Auth;
use DataTables;
use Alert;

class InsentifMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahun = InsentifMaster::distinct('tahun')
        ->orderBy('tahun', 'desc')
        ->get();

        $pekerja_list = Pekerja::all();

        return view('insentif_master.index', compact('tahun', 'pekerja_list'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexJson(Request $request)
    {
        $insentif_master_list = InsentifMaster::orderByRaw('tahun::int DESC')
        ->orderByRaw('bulan::int DESC')
        ->orderBy('nopek', 'desc');

        return DataTables::of($insentif_master_list)
            ->filter(function ($query) use ($request) {
                if ($request->has('no_pekerja')) {
                    $query->where('nopek', 'like', "%{$request->get('no_pekerja')}%");
                }

                if ($request->get('bulan')) {
                    $query->where('bulan', '=', $request->get('bulan'));
                }

                if ($request->get('tahun')) {
                    $query->where('tahun', '=', $request->get('tahun'));
                }
            })
            ->addColumn('action', function ($row) {
                $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" name="radio_upah_all_in" value="'.$row->tahun.'-'.$row->bulan.'-'.$row->nopek.'-'.$row->aard.'"><span></span></label>';
                return $radio;
            })
            ->addColumn('bulan', function ($row) {
                return bulan($row->bulan);
            })
            ->addColumn('pekerja', function ($row) {
                return $row->nopek.' - '.optional($row->pekerja)->nama;
            })
            ->addColumn('aard', function ($row) {
                return $row->aard.' - '.optional($row->aard_payroll)->nama;
            })
            ->addColumn('nilai', function ($row) {
                return currency_idr($row->nilai);
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
        $pekerja_list = Pekerja::where('status', '<>', 'P')->get();
        $aard_list = AardPayroll::all();

        return view('insentif_master.create', compact('pekerja_list', 'aard_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InsentifMasterStore $request, InsentifMaster $insentif)
    {
        $insentif->tahun      = $request->tahun;
        $insentif->bulan      = $request->bulan;
        $insentif->nopek      = $request->pegawai;
        $insentif->aard       = $request->aard;
        $insentif->jmlcc      = 0;
        $insentif->ccl        = 0;
        $insentif->nilai      = $request->nilai;
        $insentif->userid     = Auth::user()->userid;
        $insentif->status     = Pekerja::find($request->pegawai)->status;
        $insentif->tahunins   = $request->tahun_insentif;
        $insentif->pajakins   = null;
        $insentif->pajakgaji  = null;
        $insentif->pengali    = null;
        $insentif->ut         = null;
        $insentif->keterangan = null;
        $insentif->potongan   = null;

        $insentif->save();

        Alert::success('Tambah Master Insentif', 'Berhasil')->persistent(true)->autoClose(2000);
        return redirect()->route('insentif.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($tahun, $bulan, $nopek, $aard)
    {
        $insentif = InsentifMaster::where('tahun', $tahun)
        ->where('bulan', $bulan)
        ->where('nopek', $nopek)
        ->where('aard', $aard)
        ->first();

        $pekerja_list = Pekerja::where('status', '<>', 'P')
        ->orWhere('nopeg', $nopek)
        ->get();

        $aard_list = AardPayroll::all();

        return view('insentif_master.edit', compact('pekerja_list', 'aard_list', 'insentif'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InsentifMasterUpdate $request, $tahun, $bulan, $nopek, $aard)
    {
        $insentif = InsentifMaster::where('tahun', $tahun)
        ->where('bulan', $bulan)
        ->where('nopek', $nopek)
        ->where('aard', $aard)
        ->first();

        $insentif->tahun      = $request->tahun;
        $insentif->bulan      = $request->bulan;
        $insentif->nopek      = $request->pegawai;
        $insentif->aard       = $request->aard;
        $insentif->jmlcc      = 0;
        $insentif->ccl        = 0;
        $insentif->nilai      = $request->nilai;
        $insentif->userid     = Auth::user()->userid;
        $insentif->status     = Pekerja::find($request->pegawai)->status;
        $insentif->tahunins   = $request->tahun_insentif;
        $insentif->pajakins   = null;
        $insentif->pajakgaji  = null;
        $insentif->pengali    = null;
        $insentif->ut         = null;
        $insentif->keterangan = null;
        $insentif->potongan   = null;

        $insentif->save();

        Alert::success('Ubah Master Insentif', 'Berhasil')->persistent(true)->autoClose(2000);
        return redirect()->route('insentif.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $insentif = InsentifMaster::where('tahun', $request->tahun)
        ->where('bulan', $request->bulan)
        ->where('nopek', $request->nopek)
        ->where('aard', $request->aard)
        ->delete();

        return response()->json(['delete' => true], 200);
    }
}
