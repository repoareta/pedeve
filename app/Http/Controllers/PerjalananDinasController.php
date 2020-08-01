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
use DomPDF;
use Excel;
use Alert;

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
        $panjar_list = PanjarHeader::orderBy('tgl_panjar', 'desc')->get();

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

        // get tanggal panjar
        $last_panjar = PanjarHeader::withTrashed()->latest()->first();

        $year_now = date('Y');
        $year_last_panjar = date('Y', strtotime($last_panjar->tgl_panjar));
        $last_panjar_no = implode('/', array_slice(explode('/', $last_panjar->no_panjar), 0, 1)) + 1;
        if ($year_now > $year_last_panjar) {
            // reset no_spd ke 001
            $no_spd = sprintf("%03d", 1)."/PDV/CS/$year_now";
        } else {
            $no_spd = sprintf("%03d", $last_panjar_no)."/PDV/CS/$year_now";
        }

        return view('perjalanan_dinas.create', compact(
            'pegawai_list',
            'no_spd',
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
        $panjar_header->tgl_panjar = date('Y-m-d H:i:s', strtotime(date('H:i:s'), strtotime($request->tanggal)));
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

        Alert::success('Simpan Panjar Dinas', 'Berhasil')->persistent(true)->autoClose(2000);
        return redirect()->route('perjalanan_dinas.index');
    }

    public function showJson(Request $request)
    {
        $no_panjar = str_replace('-', '/', $request->id);
        $data = PanjarHeader::find($no_panjar);

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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        PanjarHeader::where('no_panjar', $request->id)->delete();

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


        if ($request->submit != 'pdf') {
            return Excel::download(new RekapSPD($panjar_header_list, $request->submit, $mulai, $sampai), 'rekap_spd_'.date('Y-m-d H:i:s').'.'.$request->submit);
        }

        // return default PDF
        $pdf = DomPDF::loadview('perjalanan_dinas.export_pdf', compact('panjar_header_list', 'mulai', 'sampai'))
        ->setPaper('a4', 'landscape')
        ->setOptions(['isPhpEnabled' => true]);

        return $pdf->stream('rekap_spd_'.date('Y-m-d H:i:s').'.pdf');
    }

    public function rowExport(Request $request)
    {
        // dd($request->atasan_ybs);
        // $no_panjar = str_replace('-', '/', $no_panjar);
        $panjar_header = PanjarHeader::find($request->no_panjar_dinas);

        // update panjar header
        $panjar_header->atasan = $request->atasan_ybs;
        $panjar_header->menyetujui = $request->menyetujui;
        $panjar_header->personalia = $request->sekr_perseroan;
        $panjar_header->menyetujui_keu = $request->keuangan;

        $panjar_header->save();

        $pdf = DomPDF::loadview('perjalanan_dinas.export_row', compact('panjar_header'));

        return $pdf->stream('rekap_spd_'.date('Y-m-d H:i:s').'.pdf');
    }
}
