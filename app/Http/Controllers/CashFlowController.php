<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Model
use App\Models\ViewCashFlowMutasi;

// load plugin
use DomPDF;
use DB;

class CashFlowController extends Controller
{
    public function mutasi()
    {
        return view('cash_flow.report_mutasi');
    }

    public function mutasiExport(Request $request)
    {
        $tahun = $request->tahun;
        $bulan = $request->bulan;
        
        $data_list = ViewCashFlowMutasi::select(
            DB::raw('
                status,
                urutan,
                jenis,
                tahun,
                bulan,
                totpricerp
            ')
        )
        ->when(request('bulan'), function ($query) {
            return $query->where('bulan', request('bulan'));
        })
        ->when(request('tahun'), function ($query) {
            return $query->where('tahun', request('tahun'));
        })
        ->orderBy('status', 'asc')
        ->orderBy(DB::raw('cast(urutan as integer)'), 'asc')
        ->get();

        // dd($data_list);
        

        // return default PDF
        $pdf = DomPDF::loadview('cash_flow.export_mutasi', compact(
            'tahun',
            'bulan',
            'data_list'
        ))
        ->setPaper('a4', 'Portrait')
        ->setOptions(['isPhpEnabled' => true]);

        return $pdf->stream('laporan_arus_kas_mutasi_'.date('Y-m-d H:i:s').'.pdf');
    }

    public function lengkap()
    {
        return view('cash_flow.report_lengkap');
    }

    public function lengkapExport(Request $request)
    {
        $tahun = $request->tahun;
        $bulan_mulai = $request->bulan_mulai;
        $bulan_sampai = $request->bulan_sampai;
        
        $data_list = ViewCashFlowMutasi::select(
            DB::raw('
                status,
                urutan,
                jenis,
                tahun,
                bulan,
                totpricerp
            ')
        )
        ->when(request('bulan'), function ($query) {
            return $query->whereBetween('bulan', [$bulan_mulai, $bulan_sampai]);
        })
        ->when(request('tahun'), function ($query) {
            return $query->where('tahun', request('tahun'));
        })
        ->orderBy('status', 'asc')
        ->orderBy(DB::raw('cast(urutan as integer)'), 'asc')
        ->get();

        // dd($data_list);
        

        // return default PDF
        $pdf = DomPDF::loadview('cash_flow.export_lengkap', compact(
            'tahun',
            'bulan_mulai',
            'bulan_sampai',
            'data_list'
        ))
        ->setPaper('a4', 'Portrait')
        ->setOptions(['isPhpEnabled' => true]);

        return $pdf->stream('laporan_arus_kas_lengkap_'.date('Y-m-d H:i:s').'.pdf');
    }
}
