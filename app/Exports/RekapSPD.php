<?php

namespace App\Exports;

use Illuminate\Http\Request;

use App\Models\PanjarHeader;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RekapSPD implements FromView
{
    protected $panjar_header_list;

    public function __construct($panjar_header_list)
    {
        $this->panjar_header_list = $panjar_header_list;
    }
    
    /**
    * @return \Illuminate\Support\View
    */
    public function view(): View
    {
        $panjar_header_list = $this->panjar_header_list;

        return view('perjalanan_dinas.export', compact('panjar_header_list'));
    }
}
