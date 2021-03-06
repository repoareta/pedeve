<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// load model
use App\Models\AnggaranMain;
use App\Models\AnggaranSubMain;
use App\Models\AnggaranDetail;

//load form request (for validation)
use App\Http\Requests\AnggaranStore;

// Load Plugin
use Carbon\Carbon;
use Session;
use DomPDF;
use PDF;
use Excel;
use Alert;
use Auth;
use DataTables;
use DB;

class AnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahun = AnggaranMain::select('tahun')
        ->whereNotNull('tahun')
        ->distinct()
        ->orderBy('tahun', 'DESC')
        ->get();

        return view('anggaran.index', compact('tahun'));
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function indexJson(Request $request)
    {
        $anggaran_list = AnggaranMain::orderBy('tahun', 'desc');

        return DataTables::of($anggaran_list)
            ->filter(function ($query) use ($request) {
                if ($request->has('kode_anggaran')) {
                    $query->where('kode_main', 'like', "%{$request->get('kode_anggaran')}%");
                }

                if ($request->has('tahun')) {
                    $query->where('tahun', 'like', "%{$request->get('tahun')}%");
                }
            })
            ->addColumn('nilai_real', function ($row) {
                return currency_idr($row->nilai_real);
            })
            ->addColumn('realisasi', function ($row) {
                return currency_idr($row->anggaran_submain->sum('nilai'));
            })
            ->addColumn('sisa', function ($row) {
                return currency_idr($row->nilai_real - $row->anggaran_submain->sum('nilai'));
            })
            ->addColumn('action', function ($row) {
                $radio = '<label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" name="radio1" value="'.$row->kode_main.'"><span></span></label>';
                return $radio;
            })
            ->rawColumns(['action', 'nama_main'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('anggaran.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnggaranStore $request)
    {
        $anggaran = new AnggaranMain;

        $anggaran->kode_main = $request->kode;
        $anggaran->nama_main = $request->nama;
        $anggaran->nilai_real = $request->nilai;
        $anggaran->inputdate = date('Y-m-d H:i:s');
        $anggaran->inputuser = Auth::user()->userid;
        $anggaran->tahun = $request->tahun;

        $anggaran->save();

        Alert::success('Simpan Anggaran', 'Berhasil')->persistent(true)->autoClose(2000);
        return redirect()->route('anggaran.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kode_main)
    {
        $anggaran = AnggaranMain::find($kode_main);
        return view('anggaran.edit', compact('anggaran', 'kode_main'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kode_main)
    {
        $anggaran = AnggaranMain::find($kode_main);

        $anggaran->kode_main = $request->kode;
        $anggaran->nama_main = $request->nama;
        $anggaran->nilai_real = $request->nilai;
        $anggaran->inputdate = date('Y-m-d H:i:s');
        $anggaran->inputuser = Auth::user()->userid;
        $anggaran->tahun = $request->tahun;

        $anggaran->save();

        Alert::success('Ubah Anggaran', 'Berhasil')->persistent(true)->autoClose(2000);
        return redirect()->route('anggaran.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        AnggaranMain::find($request->id)
        ->anggaran_detail()
        ->delete();

        AnggaranMain::find($request->id)
        ->anggaran_submain()
        ->delete();

        return response()->json();
    }

    public function rekapExport(Request $request)
    {
        $tahun = $request->tahun_cetak;
        $anggaran_list = AnggaranMain::where('tahun', $tahun)
        ->with(['anggaran_submain.anggaran_detail' => function ($query) {
            $query->orderBy('kode', 'ASC');
        }])
        ->orderBy('kode_main', 'ASC')
        ->get();

        // $v_anggaran = AnggaranMain::where('tahun', $tahun)
        // ->join(
        //     DB::raw("
        //     (SELECT
        //         (SELECT substr(thnbln,1,4) FROM kasdoc kas WHERE kas.docno = K.docno) AS tahun_anggaran,
        //         (SELECT rate FROM kasdoc kas WHERE kas.docno = K.docno) AS kurs,
        //         K.docno,
        //         K.lineno,
        //         K.account,
        //         K.area,
        //         K.lokasi,
        //         K.bagian,
        //         K.pk,
        //         K.jb,
        //         K.cj,
        //         K.totprice,
        //         K.keterangan
        //     FROM kasline K
        //     WHERE K.account like '5%') AS v_anggaran
        // "),
        //     'v_anggaran.tahun_anggaran',
        //     'anggaran_main.tahun'
        // )
        // ->get()
        // ->toArray();
    
        // dd($v_anggaran);

        // return default PDF
        $pdf = DomPDF::loadview('anggaran.export_pdf', compact('anggaran_list', 'tahun'))
        ->setPaper('a4', 'potrait')
        ->setOptions(['isPhpEnabled' => true]);

        return $pdf->stream('rekap_anggaran_'.date('Y-m-d H:i:s').'.pdf');
    }

    public function report()
    {
        return view('anggaran.report');
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function reportExport(Request $request)
    {
        $tahun = $request->tahun;
        $anggaran_list = AnggaranMain::where('tahun', $tahun)
        ->with(['anggaran_submain.anggaran_detail' => function ($query) {
            $query->orderBy('kode', 'ASC');
        }])
        ->orderBy('kode_main', 'ASC')
        ->get();

        // return default PDF
        $pdf = PDF::loadview('anggaran.report_export_pdf', compact('anggaran_list', 'tahun'))
        ->setPaper('a4', 'potrait');

        return $pdf->stream('rekap_anggaran_'.date('Y-m-d H:i:s').'.pdf');
    }
}
