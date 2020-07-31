<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use SnappyPDF;

class GcgReportBoundaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pdf = SnappyPDF::loadView('gcg.report_boundary.index');
        return $pdf->stream('invoice.pdf');
    }
}
