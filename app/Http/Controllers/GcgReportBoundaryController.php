<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
