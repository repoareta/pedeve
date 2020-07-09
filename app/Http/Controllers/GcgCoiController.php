<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GcgCoiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('gcg.coi.lampiran_satu');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lampiranDua()
    {
        return view('gcg.coi.lampiran_dua');
    }
}
