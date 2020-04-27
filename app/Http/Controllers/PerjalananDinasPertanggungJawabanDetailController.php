<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Model
use App\Models\PanjarHeader;
use App\Models\PPanjarHeader;
use App\Models\PPanjarDetail;
use App\Models\SdmMasterPegawai;
use App\Models\SdmTblKdjab;

// Load Plugin
use Carbon\Carbon;
use Session;

class PerjalananDinasPertanggungJawabanDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexJson(Request $request, $no_ppanjar = 'null')
    {
        if (session('ppanjar_detail') and $request->no_ppanjar == 'null') {
            $ppanjar_list_detail = session('ppanjar_detail');
        } else {
            $no_ppanjar = str_replace('-', '/', $request->no_ppanjar);
            $ppanjar_list_detail = PPanjarDetail::where('no_ppanjar', $no_ppanjar)
            ->get();
        }

        return datatables()->of($ppanjar_list_detail)
            ->addColumn('action', function ($row) {
                $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" name="radio1" value="'.$row->no.'-'.$row->nopek.'"><span></span></label>';
                return $radio;
            })
            ->addColumn('nilai', function ($row) {
                return float_two($row->nilai);
            })
            ->addColumn('qty', function ($row) {
                return float_two($row->qty);
            })
            ->addColumn('total', function ($row) {
                return float_two($row->total);
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
    public function store(Request $request)
    {
        $ppanjar_detail = new PPanjarDetail;
        $ppanjar_detail->no         = $request->no;
        $ppanjar_detail->no_ppanjar = $request->no_ppanjar ? $request->no_ppanjar : null;        // for add update only
        $ppanjar_detail->nopek      = $request->nopek;
        $ppanjar_detail->nama       = $request->nama;
        $ppanjar_detail->keterangan = $request->keterangan;
        $ppanjar_detail->nilai      = float_two($request->nilai);
        $ppanjar_detail->qty        = $request->qty;
        $ppanjar_detail->total      = float_two($ppanjar_detail->nilai * $ppanjar_detail->qty);

        if ($request->session == 'true') {
            if (session('ppanjar_detail')) {
                session()->push('ppanjar_detail', $ppanjar_detail);
            } else {
                session()->put('ppanjar_detail', []);
                session()->push('ppanjar_detail', $ppanjar_detail);
            }
        } else {
            $ppanjar_detail = new PPanjarDetail;
            $ppanjar_detail->no         = $request->no;
            $ppanjar_detail->no_ppanjar = $request->no_ppanjar ? $request->no_ppanjar : null;        // for add update only
            $ppanjar_detail->nopek      = $request->nopek;
            $ppanjar_detail->keterangan = $request->keterangan;
            $ppanjar_detail->nilai      = float_two($request->nilai);
            $ppanjar_detail->qty        = $request->qty;
            $ppanjar_detail->total      = float_two($ppanjar_detail->nilai * $ppanjar_detail->qty);
        
            $ppanjar_detail->save();
        }

        return response()->json($ppanjar_detail, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // $nopek = substr($request->no_nopek, strpos($request->no_nopek, "-") + 1);
        $nopek = $request->no_nopek;
        $no = $request->no_urut;

        if ($request->session == 'true') {
            foreach (session('ppanjar_detail') as $key => $value) {
                if ($value['nopek'] == $nopek and $value['no'] == $no) {
                    $data = session("ppanjar_detail.$key");
                }
            }
        } else {
            $data = PPanjarDetail::where('no_ppanjar', $request->no_ppanjar)
            ->where('no', $no)
            ->where('nopek', $nopek)
            ->first();
        }

        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $no_ppanjar, $no_urut, $nopek)
    {
        if ($request->session == 'true') {
            // delete session
            foreach (session('ppanjar_detail') as $key => $value) {
                if ($value['no'] == $no_urut and $value['nopek'] == $nopek) {
                    session()->forget("ppanjar_detail.$key");

                    $ppanjar_detail = new PPanjarDetail;
                    $ppanjar_detail->no = $request->no;
                    $ppanjar_detail->no_ppanjar = $request->no_ppanjar ? $request->no_ppanjar : null; // for add update only
                    $ppanjar_detail->nopek = $request->nopek;
                    $ppanjar_detail->nama = $request->nama;
                    $ppanjar_detail->keterangan = $request->keterangan;
                    $ppanjar_detail->nilai = float_two($request->nilai);
                    $ppanjar_detail->qty = $request->qty;
                    $ppanjar_detail->total = float_two($ppanjar_detail->nilai * $ppanjar_detail->qty);

                    // dd($panjar_detail);

                    if (session('ppanjar_detail')) {
                        session()->push('ppanjar_detail', $ppanjar_detail);
                    } else {
                        session()->put('ppanjar_detail', []);
                        session()->push('ppanjar_detail', $ppanjar_detail);
                    }
                }
            }
        } else {
            // Dari Database
            $panjar_detail = PPanjarDetail::where('no_ppanjar', $request->no_ppanjar)
            ->where('no', $request->no)
            ->delete();

            $ppanjar_detail = new PPanjarDetail;
            $ppanjar_detail->no = $request->no;
            $ppanjar_detail->no_ppanjar = $request->no_ppanjar ? $request->no_ppanjar : null; // for add update only
            $ppanjar_detail->nopek = $request->nopek;
            $ppanjar_detail->keterangan = $request->keterangan;
            $ppanjar_detail->nilai = $request->nilai;
            $ppanjar_detail->qty = $request->qty;
            $ppanjar_detail->total = $ppanjar_detail->nilai * $ppanjar_detail->qty;

            $ppanjar_detail->save();
        }

        $data = $ppanjar_detail;
        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $nopek = substr($request->no_nopek, strpos($request->no_nopek, "-") + 1);
        // dd($nopek);
        if ($request->session == 'true') {
            // delete session
            foreach (session('ppanjar_detail') as $key => $value) {
                if ($value['nopek'] == $nopek) {
                    session()->forget("ppanjar_detail.$key");
                }
            }
        } else {
            // delete Database
            PPanjarDetail::where('nopek', $nopek)
            ->where('no_ppanjar', $request->no_ppanjar)
            ->delete();
        }

        return response()->json();
    }
}
