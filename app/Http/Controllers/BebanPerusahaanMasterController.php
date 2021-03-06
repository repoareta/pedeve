<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Model
use App\Models\BebanPerusahaanMaster;
use App\Models\Pekerja;
use App\Models\AardPayroll;

//load form request (for validation)
use App\Http\Requests\BebanPerusahaanMasterStore;
use App\Http\Requests\BebanPerusahaanMasterUpdate;

// Load Plugin
use Carbon\Carbon;
use Auth;
use DataTables;
use Alert;

class BebanPerusahaanMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahun = BebanPerusahaanMaster::distinct('tahun')
        ->orderBy('tahun', 'desc')
        ->get();

        $pekerja_list = Pekerja::all();

        return view('beban_perusahaan_master.index', compact('tahun', 'pekerja_list'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexJson(Request $request)
    {
        $beban_perusahaan_master_list = BebanPerusahaanMaster::orderByRaw('tahun::int DESC')
        ->orderByRaw('bulan::int DESC')
        ->orderBy('nopek', 'DESC');

        return DataTables::of($beban_perusahaan_master_list)
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
            ->addColumn('bulan_tahun', function ($row) {
                return bulan($row->bulan).' '.$row->tahun;
            })
            ->addColumn('pekerja', function ($row) {
                return $row->nopek.' - '.$row->pekerja->nama;
            })
            ->addColumn('aard', function ($row) {
                return $row->aard.' - '.$row->aard_payroll->nama;
            })
            ->addColumn('nilai', function ($row) {
                return currency_idr($row->curramount);
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

        return view('beban_perusahaan_master.create', compact('pekerja_list', 'aard_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BebanPerusahaanMasterStore $request, BebanPerusahaanMaster $beban_perusahaan)
    {
        $beban_perusahaan->tahun      = $request->tahun;
        $beban_perusahaan->bulan      = $request->bulan;
        $beban_perusahaan->nopek      = $request->pegawai;
        $beban_perusahaan->aard       = $request->aard;
        $beban_perusahaan->lastamount = $request->last_amount;
        $beban_perusahaan->curramount = $request->current_amount;
        $beban_perusahaan->userid     = Auth::user()->userid;

        $beban_perusahaan->save();

        Alert::success('Tambah Master Beban Perusahaan', 'Berhasil')->persistent(true)->autoClose(2000);
        return redirect()->route('beban_perusahaan.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($tahun, $bulan, $nopek, $aard)
    {
        $beban_perusahaan = BebanPerusahaanMaster::where('tahun', $tahun)
        ->where('bulan', $bulan)
        ->where('nopek', $nopek)
        ->where('aard', $aard)
        ->first();

        $pekerja_list = Pekerja::where('status', '<>', 'P')
        ->orWhere('nopeg', $nopek)
        ->get();

        $aard_list = AardPayroll::all();

        return view('beban_perusahaan_master.edit', compact('pekerja_list', 'aard_list', 'beban_perusahaan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BebanPerusahaanMasterUpdate $request, $tahun, $bulan, $nopek, $aard)
    {
        $beban_perusahaan = BebanPerusahaanMaster::where('tahun', $tahun)
        ->where('bulan', $bulan)
        ->where('nopek', $nopek)
        ->where('aard', $aard)
        ->first();

        $beban_perusahaan->tahun      = $request->tahun;
        $beban_perusahaan->bulan      = $request->bulan;
        $beban_perusahaan->nopek      = $request->pegawai;
        $beban_perusahaan->aard       = $request->aard;
        $beban_perusahaan->lastamount = $request->last_amount;
        $beban_perusahaan->curramount = $request->current_amount;
        $beban_perusahaan->userid     = Auth::user()->userid;

        $beban_perusahaan->save();

        Alert::success('Ubah Master Beban Perusahaan', 'Berhasil')->persistent(true)->autoClose(2000);
        return redirect()->route('beban_perusahaan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $beban_perusahaan = BebanPerusahaanMaster::where('tahun', $request->tahun)
        ->where('bulan', $request->bulan)
        ->where('nopek', $request->nopek)
        ->where('aard', $request->aard)
        ->delete();

        return response()->json(['delete' => true], 200);
    }
}
