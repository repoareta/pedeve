<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Model
use App\Models\GcgGratifikasi;

//load form request (for validation)
use App\Http\Requests\GcgPenerimaanStore;
use App\Http\Requests\GcgPemberianStore;
use App\Http\Requests\GcgPermintaanStore;

// Load Plugin
use Alert;
use Auth;
use Carbon\Carbon;
use DomPDF;
use PDF;
use DB;

class GcgGratifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gratifikasi_list = GcgGratifikasi::all();
        return view('gcg.gratifikasi.index', compact('gratifikasi_list'));
    }

    public function penerimaan()
    {
        return view('gcg.gratifikasi.penerimaan');
    }

    public function penerimaanStore(GcgPenerimaanStore $request, GcgGratifikasi $penerimaan)
    {
        $penerimaan->nopeg             = Auth::user()->nopeg;
        $penerimaan->gift_last_month   = $request->penerimaan_bulan_lalu;
        $penerimaan->tgl_gratifikasi   = $request->tanggal_penerimaan;
        $penerimaan->bentuk            = $request->bentuk_jenis_penerimaan;
        $penerimaan->nilai             = $request->nilai;
        $penerimaan->jumlah            = $request->jumlah;
        $penerimaan->pemberi          = $request->pemberi_hadiah;
        $penerimaan->keterangan        = $request->keterangan;
        $penerimaan->jenis_gratifikasi = 'penerimaan';

        $penerimaan->save();

        Alert::success('Simpan Data Penerimaan', 'Berhasil')->persistent(true)->autoClose(2000);
        return redirect()->route('gcg.gratifikasi.index');
    }

    public function pemberian()
    {
        return view('gcg.gratifikasi.pemberian');
    }

    public function pemberianStore(GcgPemberianStore $request, GcgGratifikasi $pemberian)
    {
        $pemberian->nopeg             = Auth::user()->nopeg;
        $pemberian->gift_last_month   = $request->pemberian_bulan_lalu;
        $pemberian->tgl_gratifikasi   = $request->tanggal_pemberian;
        $pemberian->bentuk            = $request->bentuk_jenis_pemberian;
        $pemberian->nilai             = $request->nilai;
        $pemberian->jumlah            = $request->jumlah;
        $pemberian->penerima          = $request->penerima_hadiah;
        $pemberian->keterangan        = $request->keterangan;
        $pemberian->jenis_gratifikasi = 'pemberian';

        $pemberian->save();

        Alert::success('Simpan Data Pemberian', 'Berhasil')->persistent(true)->autoClose(2000);
        return redirect()->route('gcg.gratifikasi.index');
    }

    public function permintaan()
    {
        return view('gcg.gratifikasi.permintaan');
    }

    public function permintaanStore(GcgPermintaanStore $request, GcgGratifikasi $permintaan)
    {
        $permintaan->nopeg             = Auth::user()->nopeg;
        $permintaan->gift_last_month   = $request->permintaan_bulan_lalu;
        $permintaan->tgl_gratifikasi   = $request->tanggal_permintaan;
        $permintaan->bentuk            = $request->bentuk_jenis_permintaan;
        $permintaan->nilai             = $request->nilai;
        $permintaan->jumlah            = $request->jumlah;
        $permintaan->peminta          = $request->peminta;
        $permintaan->keterangan        = $request->keterangan;
        $permintaan->jenis_gratifikasi = 'permintaan';

        $permintaan->save();

        Alert::success('Simpan Data Permintaan', 'Berhasil')->persistent(true)->autoClose(2000);
        return redirect()->route('gcg.gratifikasi.index');
    }

    public function reportPersonal()
    {
        $gratifikasi_tahun = GcgGratifikasi::selectRaw("extract(year from created_at) AS year")
        ->groupBy('year')
        ->orderBy('year', 'desc')
        ->get();

        return view('gcg.gratifikasi.report_personal', compact('gratifikasi_tahun'));
    }

    public function reportPersonalExport(Request $request)
    {
        $gratifikasi_list = GcgGratifikasi::when(request('bentuk_gratifikasi'), function ($q) {
            return $q->where('jenis_gratifikasi', request('bentuk_gratifikasi'));
        })
        ->when(request('bulan'), function ($q) {
            return $q->where(DB::raw('extract(month from tgl_gratifikasi)'), request('bulan'));
        })
        ->when(request('tahun'), function ($q) {
            return $q->where(DB::raw('extract(year from tgl_gratifikasi)'), request('tahun'));
        })
        ->get();
        
        // return default PDF
        $pdf = DomPDF::loadview('gcg.gratifikasi.report_personal_export_pdf', compact('gratifikasi_list'))->setOptions(['isPhpEnabled' => true]);

        return $pdf->stream('gcg_report_personal_'.date('Y-m-d H:i:s').'.pdf');
    }

    public function reportPersonalIndexJson(Request $request)
    {
        $gratifikasi_list = GcgGratifikasi::where('nopeg', Auth::user()->nopeg)
        ->orderBy('created_at', 'desc');

        return datatables()->of($gratifikasi_list)
            ->filter(function ($query) use ($request) {
                if (request('bentuk_gratifikasi')) {
                    $query->where('jenis_gratifikasi', request('bentuk_gratifikasi'));
                }

                if (request('bulan')) {
                    $query->where(DB::raw('extract(month from tgl_gratifikasi)'), request('bulan'));
                }

                if (request('tahun')) {
                    $query->where(DB::raw('extract(year from tgl_gratifikasi)'), request('tahun'));
                }
            })
            ->addColumn('tanggal_gratifikasi', function ($row) {
                return Carbon::parse($row->tgl_gratifikasi)->translatedFormat('d F Y');
            })
            ->addColumn('tanggal_submit', function ($row) {
                return Carbon::parse($row->created_at)->translatedFormat('d F Y');
            })
            ->make(true);
    }

    public function reportManagement(Request $request)
    {
        $gratifikasi_list = GcgGratifikasi::when(request('bentuk_gratifikasi'), function ($q) {
            return $q->where('jenis_gratifikasi', request('bentuk_gratifikasi'));
        })
        ->when(request('bulan'), function ($q) {
            return $q->where(DB::raw('extract(month from tgl_gratifikasi)'), request('bulan'));
        })
        ->when(request('tahun'), function ($q) {
            return $q->where(DB::raw('extract(year from tgl_gratifikasi)'), request('tahun'));
        })
        ->get();

        $gratifikasi_tahun = GcgGratifikasi::selectRaw("extract(year from created_at) AS year")
        ->groupBy('year')
        ->orderBy('year', 'desc')
        ->get();

        return view('gcg.gratifikasi.report_management', compact('gratifikasi_tahun', 'gratifikasi_list'));
    }

    public function reportManagementExport(Request $request)
    {
        $gratifikasi_list = GcgGratifikasi::when(request('bentuk_gratifikasi'), function ($q) {
            return $q->where('jenis_gratifikasi', request('bentuk_gratifikasi'));
        })
        ->when(request('bulan'), function ($q) {
            return $q->where(DB::raw('extract(month from tgl_gratifikasi)'), request('bulan'));
        })
        ->when(request('tahun'), function ($q) {
            return $q->where(DB::raw('extract(year from tgl_gratifikasi)'), request('tahun'));
        })
        ->get();
        
        // return default PDF
        $pdf = PDF::loadview('gcg.gratifikasi.report_management_export_pdf', compact('gratifikasi_list'));

        return $pdf->stream('gcg_report_management_'.date('Y-m-d H:i:s').'.pdf');
    }

    public function reportManagementIndexJson(Request $request)
    {
        $gratifikasi_list = GcgGratifikasi::orderBy('created_at', 'desc');

        return datatables()->of($gratifikasi_list)
            ->filter(function ($query) use ($request) {
                if (request('bentuk_gratifikasi')) {
                    $query->where('jenis_gratifikasi', request('bentuk_gratifikasi'));
                }

                if (request('fungsi')) {
                    $query->where(DB::raw('extract(month from tgl_gratifikasi)'), request('bulan'));
                }

                if (request('bulan')) {
                    $query->where(DB::raw('extract(month from tgl_gratifikasi)'), request('bulan'));
                }

                if (request('tahun')) {
                    $query->where(DB::raw('extract(year from tgl_gratifikasi)'), request('tahun'));
                }
            })
            ->addColumn('nama', function ($row) {
                return $row->pekerja->nama;
            })
            ->addColumn('jabatan', function ($row) {
                return $row->pekerja->jabatan_latest_one->kode_jabatan_new->keterangan;
            })
            ->addColumn('tanggal_gratifikasi', function ($row) {
                return Carbon::parse($row->tgl_gratifikasi)->translatedFormat('d F Y');
            })
            ->addColumn('tanggal_submit', function ($row) {
                return Carbon::parse($row->created_at)->translatedFormat('d F Y');
            })
            ->make(true);
    }

    public function edit(GcgGratifikasi $gratifikasi)
    {
        return view('gcg.gratifikasi.edit', compact('gratifikasi'));
    }

    public function update(GcgGratifikasi $gratifikasi, Request $request)
    {
        $gratifikasi->status  = $request->status;
        $gratifikasi->catatan = $request->catatan;

        $gratifikasi->save();

        Alert::success('Update Data Gratifikasi', 'Berhasil')->persistent(true)->autoClose(2000);
        return redirect()->route('gcg.gratifikasi.index');
    }
}
