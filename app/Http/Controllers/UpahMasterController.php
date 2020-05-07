<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Model
use App\Models\UpahMaster;

//load form request (for validation)
use App\Http\Requests\UpahAllInStore;
use App\Http\Requests\UpahAllInUpdate;

// Load Plugin
use Carbon\Carbon;
use Auth;
use DB;
use DataTables;

class UpahMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahun = UpahMaster::distinct('tahun')->orderBy('tahun', 'desc')->orderBy('bulan', 'desc')->get();
        return view('upah_master.index', compact('tahun'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexJson(Request $request)
    {
        $upah_master_list = UpahMaster::orderBy('tahun', 'desc');

        return DataTables::of($upah_master_list)
            ->filter(function ($query) use ($request) {
                if ($request->has('no_pekerja')) {
                    $query->where('nopek', 'like', "%{$request->get('no_pekerja')}%");
                }

                if ($request->has('bulan')) {
                    $query->where('bulan', 'like', "%{$request->get('bulan')}%");
                }

                if ($request->has('tahun')) {
                    $query->where('tahun', 'like', "%{$request->get('tahun')}%");
                }
            })
            ->addColumn('action', function ($row) {
                $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" name="radio_upah_all_in" value="'.$row->tahun.'-'.$row->bulan.'-'.$row->nopek.'"><span></span></label>';
                return $radio;
            })
            ->addColumn('bulan_tahun', function ($row) {
                return $row->bulan.' - '.$row->tahun;
            })
            ->addColumn('pekerja', function ($row) {
                return $row->nopek.' - '.$row->pekerja->nama;
            })
            ->addColumn('aard', function ($row) {
                return $row->aard.' - '.$row->aard_payroll->nama;
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
    public function show($id)
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
    public function delete($id)
    {
        //
    }
}
