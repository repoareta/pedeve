<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Model
use App\Models\HutangMaster;
use App\Models\Pekerja;
use App\Models\AardPayroll;

//load form request (for validation)
use App\Http\Requests\HutangMasterStore;
use App\Http\Requests\HutangMasterUpdate;

// Load Plugin
use Carbon\Carbon;
use Auth;
use DataTables;
use Alert;

class HutangMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahun = HutangMaster::distinct('tahun')
        ->orderBy('tahun', 'desc')
        ->get();

        $pekerja_list = Pekerja::all();

        return view('hutang_master.index', compact('tahun', 'pekerja_list'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexJson(Request $request)
    {
        $hutang_master_list = HutangMaster::orderByRaw('tahun::int DESC')
        ->orderByRaw('bulan::int DESC')
        ->orderBy('nopek', 'desc');

        return DataTables::of($hutang_master_list)
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
            ->addColumn('lastamount', function ($row) {
                return currency_idr($row->lastamount);
            })
            ->addColumn('curramount', function ($row) {
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

        return view('hutang_master.create', compact('pekerja_list', 'aard_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HutangMasterStore $request, HutangMaster $hutang)
    {
        $hutang->tahun      = $request->tahun;
        $hutang->bulan      = $request->bulan;
        $hutang->nopek      = $request->pegawai;
        $hutang->aard       = $request->aard;
        $hutang->lastamount = $request->last_amount;
        $hutang->curramount = $request->current_amount;
        $hutang->userid     = Auth::user()->userid;

        $hutang->save();

        Alert::success('Tambah Master Hutang', 'Berhasil')->persistent(true)->autoClose(2000);
        return redirect()->route('hutang.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($tahun, $bulan, $nopek, $aard)
    {
        $hutang = HutangMaster::where('tahun', $tahun)
        ->where('bulan', $bulan)
        ->where('nopek', $nopek)
        ->where('aard', $aard)
        ->first();

        $pekerja_list = Pekerja::where('status', '<>', 'P')
        ->orWhere('nopeg', $nopek)
        ->get();

        $aard_list = AardPayroll::all();

        return view('hutang_master.edit', compact('pekerja_list', 'aard_list', 'hutang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HutangMasterUpdate $request, $tahun, $bulan, $nopek, $aard)
    {
        $hutang = HutangMaster::where('tahun', $tahun)
        ->where('bulan', $bulan)
        ->where('nopek', $nopek)
        ->where('aard', $aard)
        ->first();

        $hutang->tahun      = $request->tahun;
        $hutang->bulan      = $request->bulan;
        $hutang->nopek      = $request->pegawai;
        $hutang->aard       = $request->aard;
        $hutang->lastamount = $request->last_amount;
        $hutang->curramount = $request->current_amount;
        $hutang->userid     = Auth::user()->userid;

        $hutang->save();

        Alert::success('Ubah Master Hutang', 'Berhasil')->persistent(true)->autoClose(2000);
        return redirect()->route('hutang.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $hutang = HutangMaster::where('tahun', $request->tahun)
        ->where('bulan', $request->bulan)
        ->where('nopek', $request->nopek)
        ->where('aard', $request->aard)
        ->delete();

        return response()->json(['delete' => true], 200);
    }
}
