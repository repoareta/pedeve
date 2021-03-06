<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Model
use App\Models\UpahMaster;
use App\Models\Pekerja;
use App\Models\AardPayroll;

//load form request (for validation)
use App\Http\Requests\UpahMasterStore;
use App\Http\Requests\UpahMasterUpdate;

// Load Plugin
use Carbon\Carbon;
use Auth;
use DataTables;
use Alert;

class UpahMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahun = UpahMaster::distinct('tahun')
        ->orderBy('tahun', 'desc')
        ->get();

        $pekerja_list = Pekerja::all();

        return view('upah_master.index', compact('tahun', 'pekerja_list'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexJson(Request $request)
    {
        $upah_master_list = UpahMaster::orderByRaw('tahun::int DESC')
        ->orderByRaw('bulan::int DESC')
        ->orderBy('nopek', 'DESC');

        return DataTables::of($upah_master_list)
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
                return $row->nopek.' - '.optional($row->pekerja)->nama;
            })
            ->addColumn('aard', function ($row) {
                return $row->aard.' - '.optional($row->aard_payroll)->nama;
            })
            ->addColumn('ccl', function ($row) {
                return abs($row->ccl);
            })
            ->addColumn('jmlcc', function ($row) {
                return currency_idr($row->jmlcc);
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

        return view('upah_master.create', compact('pekerja_list', 'aard_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpahMasterStore $request, UpahMaster $upah)
    {
        $upah->tahun  = $request->tahun;
        $upah->bulan  = $request->bulan;
        $upah->nopek  = $request->pegawai;
        $upah->aard   = $request->aard;
        $upah->jmlcc  = $request->jumlah_cicilan;
        $upah->ccl    = $request->cicilan;
        $upah->nilai  = $request->nilai;
        $upah->userid = Auth::user()->userid;

        $upah->save();

        Alert::success('Tambah Upah Master', 'Berhasil')->persistent(true)->autoClose(2000);
        return redirect()->route('upah.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($tahun, $bulan, $nopek, $aard)
    {
        $upah = UpahMaster::where('tahun', $tahun)
        ->where('bulan', $bulan)
        ->where('nopek', $nopek)
        ->where('aard', $aard)
        ->first();

        $pekerja_list = Pekerja::where('status', '<>', 'P')
        ->orWhere('nopeg', $nopek)
        ->get();

        $aard_list = AardPayroll::all();

        return view('upah_master.edit', compact('pekerja_list', 'aard_list', 'upah'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpahMasterUpdate $request, $tahun, $bulan, $nopek, $aard)
    {
        $upah = UpahMaster::where('tahun', $tahun)
        ->where('bulan', $bulan)
        ->where('nopek', $nopek)
        ->where('aard', $aard)
        ->first();

        $upah->tahun  = $request->tahun;
        $upah->bulan  = $request->bulan;
        $upah->nopek  = $request->pegawai;
        $upah->aard   = $request->aard;
        $upah->jmlcc  = $request->jumlah_cicilan;
        $upah->ccl    = $request->cicilan;
        $upah->nilai  = $request->nilai;
        $upah->userid = Auth::user()->userid;

        $upah->save();

        Alert::success('Ubah Upah Master', 'Berhasil')->persistent(true)->autoClose(2000);
        return redirect()->route('upah.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $upah = UpahMaster::where('tahun', $request->tahun)
        ->where('bulan', $request->bulan)
        ->where('nopek', $request->nopek)
        ->where('aard', $request->aard)
        ->delete();

        return response()->json(['delete' => true], 200);
    }
}
