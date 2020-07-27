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
        $gratifikasi_list = GcgGratifikasi::where('jenis_gratifikasi', $request->bentuk_gratifikasi)
        ->where(DB::raw("extract(month from created_at)"), $request->bulan)
        ->where(DB::raw("extract(year from created_at)"), $request->tahun)
        ->get();

        // return default PDF
        $pdf = PDF::loadview('gcg.gratifikasi.report_personal_export_pdf', compact('gratifikasi_list'))
        ->setOptions(['isPhpEnabled' => true]);

        return $pdf->stream('gcg_report_personal_'.date('Y-m-d H:i:s').'.pdf');
    }

    public function indexJsonReportPersonal(Request $request)
    {
        $gratifikasi_list = GcgGratifikasi::orderBy('created_at', 'desc');

        return datatables()->of($gratifikasi_list)
            ->filter(function ($query) use ($request) {
                if ($request->has('bentuk_gratifikasi')) {
                    $query->where('jenis_gratifikasi', 'like', "%{$request->get('bentuk_gratifikasi')}%");
                }

                if ($request->has('bulan')) {
                    $query->where('created_at', 'like', "%{$request->get('bulan')}%");
                }

                if ($request->has('tahun')) {
                    $query->where('created_at', 'like', "%{$request->get('tahun')}%");
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

    public function reportManagement()
    {
        return view('gcg.gratifikasi.report_management');
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
