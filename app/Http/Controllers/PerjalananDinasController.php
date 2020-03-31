<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Model
use App\Models\PanjarHeader;
use App\Models\PanjarDetail;
use App\Models\SdmMasterPegawai;
use App\Models\SdmTblKdjab;

//load form request (for validation)
use App\Http\Requests\PerjalananDinasStore;
use App\Http\Requests\PerjalananDinasUpdate;

//load export CSV
use App\Exports\RekapSPD;

// Load Plugin
use Carbon\Carbon;
use Session;
use PDF;
use Excel;

class PerjalananDinasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('perjalanan_dinas.index');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function indexJson()
    {
        $panjar_list = PanjarHeader::all();

        return datatables()->of($panjar_list)
            ->addColumn('mulai', function ($row) {
                return Carbon::parse($row->mulai)->translatedFormat('d F Y');
            })
            ->addColumn('sampai', function ($row) {
                return Carbon::parse($row->sampai)->translatedFormat('d F Y');
            })
            ->addColumn('nopek', function ($row) {
                return $row->nopek." - ".$row->nama;
            })
            ->addColumn('nilai', function ($row) {
                return currency_idr($row->jum_panjar);
            })
            ->addColumn('action', function ($row) {
                $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" name="radio1" value="'.$row->no_panjar.'"><span></span></label>';
                return $radio;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function indexJsonDetail(Request $request, $no_panjar = 'null')
    {
        if (session('panjar_detail') and $request->no_panjar == 'null') {
            $panjar_list_detail = session('panjar_detail');
        } else {
            $no_panjar = str_replace('-', '/', $request->no_panjar);
            $panjar_list_detail = PanjarDetail::where('no_panjar', $no_panjar)
            ->get();
        }

        return datatables()->of($panjar_list_detail)
            ->addColumn('golongan', function ($row) {
                return $row->status;
            })
            ->addColumn('action', function ($row) {
                $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" name="radio1" value="'.$row->no.'-'.$row->nopek.'"><span></span></label>';
                return $radio;
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
        $pegawai_list = SdmMasterPegawai::where('status', '<>', 'P')
        ->orderBy('nama', 'ASC')
        ->get();

        $jabatan_list = SdmTblKdjab::distinct('keterangan')
        ->orderBy('keterangan', 'ASC')
        ->get();

        $panjar_header_count = PanjarHeader::all()->count();

        return view('perjalanan_dinas.create', compact(
            'pegawai_list',
            'panjar_header_count',
            'jabatan_list'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PerjalananDinasStore $request)
    {
        $pegawai = SdmMasterPegawai::find($request->nopek);
        
        $panjar_header = new PanjarHeader;
        $panjar_header->no_panjar = $request->no_spd;
        $panjar_header->tgl_panjar = $request->tanggal;
        $panjar_header->nopek = $request->nopek;
        $panjar_header->nama = $pegawai->nama;
        $panjar_header->jabatan = $request->jabatan;
        $panjar_header->gol = $request->golongan;
        $panjar_header->ktp = $request->ktp;
        $panjar_header->jenis_dinas = $request->jenis_dinas;
        $panjar_header->dari = $request->dari;
        $panjar_header->tujuan = $request->tujuan;
        $panjar_header->mulai = $request->mulai;
        $panjar_header->sampai = $request->sampai;
        $panjar_header->kendaraan = $request->kendaraan;
        $panjar_header->ditanggung_oleh = $request->biaya;
        $panjar_header->keterangan = $request->keterangan;
        $panjar_header->jum_panjar = $request->jumlah;
        // Save Panjar Header
        $panjar_header->save();

        // Save Panjar Detail;
        if (session('panjar_detail')) {
            foreach (session('panjar_detail') as $panjar) {
                $panjar_detail = new PanjarDetail;
                $panjar_detail->no = $panjar['no'];
                $panjar_detail->no_panjar = $request->no_spd;
                $panjar_detail->nopek = $panjar['nopek'];
                $panjar_detail->nama = $panjar['nama'];
                $panjar_detail->jabatan = $panjar['jabatan'];
                $panjar_detail->status = $panjar['golongan'] = $panjar['status'];
                $panjar_detail->keterangan = $panjar['keterangan'];
    
                $panjar_detail->save();
            }
    
            session()->forget('panjar_detail');
        }

        return redirect()->route('perjalanan_dinas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeDetail(Request $request)
    {
        $panjar_detail = new PanjarDetail;
        $panjar_detail->no = $request->no;
        $panjar_detail->no_panjar = $request->no_panjar ? $request->no_panjar : null; // for add update only
        $panjar_detail->nopek = $request->nopek;
        $panjar_detail->nama = $request->nama;
        $panjar_detail->jabatan = $request->jabatan;
        $panjar_detail->status = $request->golongan;
        $panjar_detail->keterangan = $request->keterangan;

        if ($request->session == 'true') {
            if (session('panjar_detail')) {
                session()->push('panjar_detail', $panjar_detail);
            } else {
                session()->put('panjar_detail', []);
                session()->push('panjar_detail', $panjar_detail);
            }
        } else {
            // insert to database
            $panjar_detail->save();
        }

        return response()->json($panjar_detail, 200);
    }

    public function showJsonDetail(Request $request)
    {
        // $nopek = substr($request->no_nopek, strpos($request->no_nopek, "-") + 1);
        $nopek = $request->no_nopek;
        $no = $request->no_urut;

        if ($request->session == 'true') {
            foreach (session('panjar_detail') as $key => $value) {
                if ($value['nopek'] == $nopek and $value['no'] == $no) {
                    $data = session("panjar_detail.$key");
                }
            }
        } else {
            $data = PanjarDetail::where('no_panjar', $request->no_panjar)
            ->where('nopek', $nopek)->first();
        }

        return response()->json($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($no_panjar)
    {
        $no_panjar = str_replace('-', '/', $no_panjar);
        $panjar_header = PanjarHeader::where('no_panjar', $no_panjar)->first();

        $pegawai_list = SdmMasterPegawai::where('status', '<>', 'P')
        ->orderBy('nama', 'ASC')
        ->get();

        $jabatan_list = SdmTblKdjab::distinct('keterangan')
        ->orderBy('keterangan', 'ASC')
        ->get();

        $panjar_detail_count = PanjarDetail::where('no_panjar', $no_panjar)->count();

        return view('perjalanan_dinas.edit', compact(
            'panjar_header',
            'pegawai_list',
            'jabatan_list',
            'panjar_detail_count'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PerjalananDinasUpdate $request, $no_panjar)
    {
        $no_panjar = str_replace('-', '/', $no_panjar);
        $panjar_header = PanjarHeader::find($no_panjar);

        $pegawai = SdmMasterPegawai::find($request->nopek);

        $panjar_header->no_panjar = $request->no_spd;
        $panjar_header->tgl_panjar = $request->tanggal;
        $panjar_header->nopek = $request->nopek;
        $panjar_header->nama = $pegawai->nama;
        $panjar_header->jabatan = $request->jabatan;
        $panjar_header->gol = $request->golongan;
        $panjar_header->ktp = $request->ktp;
        $panjar_header->jenis_dinas = $request->jenis_dinas;
        $panjar_header->dari = $request->dari;
        $panjar_header->tujuan = $request->tujuan;
        $panjar_header->mulai = $request->mulai;
        $panjar_header->sampai = $request->sampai;
        $panjar_header->kendaraan = $request->kendaraan;
        $panjar_header->ditanggung_oleh = $request->biaya;
        $panjar_header->keterangan = $request->keterangan;
        $panjar_header->jum_panjar = $request->jumlah;

        $panjar_header->save();

        return redirect()->route('perjalanan_dinas.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateDetail(Request $request)
    {
        if ($request->session == 'true') {
            // delete session
            foreach (session('panjar_detail') as $key => $value) {
                if ($value['nopek'] == $request->nopek) {
                    session()->forget("panjar_detail.$key");

                    $panjar_detail = new PanjarDetail;
                    $panjar_detail->no = $request->no;
                    $panjar_detail->nopek = $request->nopek;
                    $panjar_detail->nama = $request->nama;
                    $panjar_detail->jabatan = $request->jabatan;
                    $panjar_detail->golongan = $request->golongan;
                    $panjar_detail->status = $request->golongan;
                    $panjar_detail->keterangan = $request->keterangan;

                    // dd($panjar_detail);

                    if (session('panjar_detail')) {
                        session()->push('panjar_detail', $panjar_detail);
                    } else {
                        session()->put('panjar_detail', []);
                        session()->push('panjar_detail', $panjar_detail);
                    }
                }
            }
        } else {
            // Dari Database
            $panjar_detail = PanjarDetail::where('no_panjar', $request->no_panjar)
            ->where('no', $request->no)
            ->delete();

            $panjar_detail = new PanjarDetail;
            $panjar_detail->no = $request->no;
            $panjar_detail->no_panjar = $request->no_panjar;
            $panjar_detail->nopek = $request->nopek;
            $panjar_detail->nama = $request->nama;
            $panjar_detail->jabatan = $request->jabatan;
            $panjar_detail->status = $request->golongan;
            $panjar_detail->keterangan = $request->keterangan;

            $panjar_detail->save();
        }

        $data = $panjar_detail;
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
        PanjarHeader::where('no_panjar', $request->id)->delete();
        PanjarDetail::where('no_panjar', $request->id)->delete();

        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteDetail(Request $request)
    {
        $nopek = substr($request->no_nopek, strpos($request->no_nopek, "-") + 1);
        // dd($nopek);
        if ($request->session == 'true') {
            // delete session
            foreach (session('panjar_detail') as $key => $value) {
                if ($value['nopek'] == $nopek) {
                    session()->forget("panjar_detail.$key");
                }
            }
        } else {
            // delete Database
            PanjarDetail::where('nopek', $nopek)
            ->where('no_panjar', $request->no_panjar)
            ->delete();
        }

        return response()->json();
    }

    public function rekap()
    {
        return view('perjalanan_dinas.rekap');
    }

    public function rekapExport(Request $request)
    {
        $mulai = date($request->mulai);
        $sampai = date($request->sampai);
        $panjar_header_list = PanjarHeader::whereBetween('tgl_panjar', [$mulai, $sampai])
        ->get();
        // dd($panjar_header_list);


        if ($request->submit == 'csv') {
            return Excel::download(new RekapSPD($panjar_header_list), 'rekap_spd_'.date('Y-m-d H:i:s').'.csv');
        }

        if ($request->submit == 'xlsx') {
            return Excel::download(new RekapSPD($panjar_header_list), 'rekap_spd_'.date('Y-m-d H:i:s').'.xlsx');
        }

        // return default PDF
        $pdf = PDF::loadview('perjalanan_dinas.export', [
            'panjar_header_list' => $panjar_header_list,
            'mulai' => $mulai,
            'sampai' => $sampai
        ])
        ->setPaper('a4', 'landscape');

        return $pdf->stream('rekap_spd_'.date('Y-m-d H:i:s').'.pdf');
    }

    public function rowExport($no_panjar)
    {
        $no_panjar = str_replace('-', '/', $no_panjar);
        $panjar_header = PanjarHeader::find($no_panjar);

        $pdf = PDF::loadview('perjalanan_dinas.export_row', ['panjar_header' => $panjar_header]);
        return $pdf->stream('rekap_spd_'.date('Y-m-d H:i:s').'.pdf');
    }
}
