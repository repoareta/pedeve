<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Model
use App\Models\UmkHeader;
use App\Models\PUmkHeader;
use App\Models\PUmkDetail;
// use App\Models\SdmMasterPegawai;
// use App\Models\SdmTblKdjab;

// Load Plugin
use Carbon\Carbon;
use Session;

class UangMukaKerjaPertanggungJawabanDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexJson(Request $request, $no_pumk = 'null')
    {
        // $request->session()->flush();
        if (session('pumk_detail') and $request->no_pumk == 'null') {
            $pumk_list_detail = session('pumk_detail');
        } else {
            $no_pumk = str_replace('-', '/', $request->no_pumk);
            $pumk_list_detail = PUmkDetail::where('no_pumk', $no_pumk)
            ->get();
        }
        return datatables()->of($pumk_list_detail)
            ->addColumn('action', function ($row) {
                $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" name="radio1" value="'.$row->no.'-'.$row->pumk.'"><span></span></label>';
                return $radio;
            })

            ->addColumn('nilai', function ($row) {
                return currency_idr($row->nilai);
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
        $pumk_detail = new PUmkDetail;
        $pumk_detail->no = $request->no;
        $pumk_detail->keterangan = $request->keterangan;
        $pumk_detail->account = $request->account;
        $pumk_detail->nilai = $request->nilai;
        $pumk_detail->cj = $request->cj;
        $pumk_detail->jb = $request->jb;
        $pumk_detail->bagian = $request->bagian;
        $pumk_detail->pk = $request->pk;
        $pumk_detail->no_pumk = $request->no_pumk ? $request->no_pumk : null; // for add edit only

        if ($request->session == 'true') {
            $pumk_detail->account_nama = $request->account_nama;
            $pumk_detail->cj_nama = $request->cj_nama;
            $pumk_detail->jb_nama = $request->jb_nama;
            $pumk_detail->bagian_nama = $request->bagian_nama;

            if (session('pumk_detail')) {
                session()->push('pumk_detail', $pumk_detail);
            } else {
                session()->put('pumk_detail', []);
                session()->push('pumk_detail', $pumk_detail);
            }

            // reset no_urut session
            foreach (array_values(array_filter(session('pumk_detail'))) as $key => $value) {
                $no_urut = $key + 1;
                if ($value['no'] != $no_urut) {
                    // ganti no urut dengan yang baru
                    $update_pumk_detail = $value;
                    $update_pumk_detail['no']= $no_urut;
                    $request->session()->put('pumk_detail.'.$key, $update_pumk_detail);
                }
            }
        } else {
            // insert to database
            $pumk_detail->save();
        }

        return response()->json($pumk_detail, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $no_urut, $no_pumk = null)
    {
        if ($request->session == 'true') {
            foreach (session('pumk_detail') as $key => $value) {
                if ($value['no'] == $no_urut and $value['no_pumk'] == $no_pumk) {
                    $data = session("pumk_detail.$key");
                }
            }
        } else {
            $data = PUmkDetail::where('no', $no_urut)
            ->where('no_pumk', $no_pumk)->first();
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
    public function update(Request $request, $no_urut, $no_pumk = null)
    {
        if ($request->session == 'true') {
            // search
            // delete session
            // insert a new one
            // dd($no_urut);
            foreach (session('pumk_detail') as $key => $value) {
                if ($value['no'] == $no_urut and $value['no_pumk'] == $no_pumk) {
                    // dd($value);
                    $update_pumk_detail = $value;
                    $update_pumk_detail['no'] = $request->no;
                    $update_pumk_detail['keterangan'] = $request->keterangan;
                    $update_pumk_detail['account'] = $request->account;
                    $update_pumk_detail['nilai'] = $request->nilai;
                    $update_pumk_detail['cj'] = $request->cj;
                    $update_pumk_detail['jb'] = $request->jb;
                    $update_pumk_detail['bagian'] = $request->bagian;
                    $update_pumk_detail['pk'] = $request->pk;
                    $update_pumk_detail['no_pumk'] = $request->no_pumk ? $request->no_pumk : null; // for add edit only
                    $update_pumk_detail['account_nama'] = $request->account_nama;
                    $update_pumk_detail['cj_nama'] = $request->cj_nama;
                    $update_pumk_detail['jb_nama'] = $request->jb_nama;
                    $update_pumk_detail['bagian_nama'] = $request->bagian_nama;
            
                    $request->session()->put('pumk_detail'.$key, $update_pumk_detail);
                    $pumk_detail = $update_pumk_detail;
                }
            }

            // foreach (array_values(array_filter(session('pumk_detail'))) as $key => $value) {
            //     $no_urut = $key + 1;
            //     if ($value['no'] != $no_urut) {
            //         // dd($value);
            //         // ganti no urut dengan yang baru
            //         $update_pumk_detail = $value;
            //         $update_pumk_detail['no']= $no_urut;

            //         // dd(session('pumk_detail.'.$key));

            //         $request->session()->put('pumk_detail.'.$key, $update_pumk_detail);
            //     }
            // }

            // dd(session('pumk_detail'));
        } else {
            // for Database
            $pumk_detail = PUmkDetail::where('no', $no_urut)
            ->where('no_pumk', $no_pumk)
            ->delete();

            $pumk_detail = new PUmkDetail;
            $pumk_detail->no = $request->no;
            $pumk_detail->keterangan = $request->keterangan;
            $pumk_detail->account = $request->account;
            $pumk_detail->nilai = $request->nilai;
            $pumk_detail->cj = $request->cj;
            $pumk_detail->jb = $request->jb;
            $pumk_detail->bagian = $request->bagian;
            $pumk_detail->pk = $request->pk;
            $pumk_detail->no_pumk = $request->no_pumk;

            $pumk_detail->save();
        }

        $data = $pumk_detail;
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
        $no_pumk = substr($request->no_pumk, strpos($request->no_pumk, "-") + 1);

        if ($request->session == 'true') {
            // delete session
            foreach (session('pumk_detail') as $key => $value) {
                if ($value['no'] == $request->no) {
                    $request->session()->forget("pumk_detail.$key");
                }
            }
        } else {
            // delete Database
            PUmkDetail::where('no_pumk', $no_pumk)
            ->where('no', $request->no)
            ->delete();
        }

        return response()->json(['result' => true], 200);
    }
}
