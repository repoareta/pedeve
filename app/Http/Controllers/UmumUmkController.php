<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UmumUmkController extends Controller
{
    public function index()
    {      
    $data = array(
        'Content'       => 'Umum.view_umk',
        'page1'         => 'Umum',
        'page2'         => 'Uang Muka Kerja',
    );

    return view('layouts.master', compact('data'))->with($data);
    }
}
