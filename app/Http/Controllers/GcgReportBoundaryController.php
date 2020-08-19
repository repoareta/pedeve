<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Model
use App\Models\GcgGratifikasi;

//load export CSV
use App\Exports\ReportBoundary;

//load plugin
use Excel;

class GcgReportBoundaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('gcg.report_boundary.index');
    }

    public function export(Request $request)
    {
        $report_list = GcgGratifikasi::with('userpdv')
        ->get();
        
        $bulan = date('m');
        $tahun = date('Y');

        return Excel::download(new ReportBoundary(
            $report_list,
            $bulan,
            $tahun
        ), 'gcg_report_boundary'.date('Y-m-d H:i:s').".xlsx");
    }
}
