<?php

namespace App\Exports;

use Illuminate\Http\Request;

use App\Models\PanjarHeader;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RekapSPD implements FromView
{
    protected $panjar_header_list;
    protected $type;

    public function __construct($panjar_header_list, $type)
    {
        $this->panjar_header_list = $panjar_header_list;
        $this->type = $type;
    }
    
    /**
    * @return \Illuminate\Support\View
    */
    public function view(): View
    {
        $panjar_header_list = $this->panjar_header_list;
        
        if ($this->type == 'xlsx') {
            return view('perjalanan_dinas.export_xlsx', compact('panjar_header_list'));
        }
        
        return view('perjalanan_dinas.export_csv', compact('panjar_header_list'));
    }
}
