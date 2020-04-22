<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PayTblPensiun;
use DB;
use PDF;
use Excel;
use Alert;

class PensiunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pensiun.index');
    }

    public function indexJson(Request $request)
    {
        if($request->ajax())
        {               
                $data = PayTblPensiun::all();
                return datatables()->of($data)
                ->addColumn('action', function ($data) {
                        $radio = '<label  class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" class="btn-radio" data-id="'.$data->pribadi.'" name="btn-radio"><span></span></label>';
                    return $radio;
                })
                ->addColumn('pribadi', function ($data) {
                    return number_format($data->pribadi, 2, '.', ','); 
                })
                ->addColumn('perusahaan', function ($data) {
                    return number_format($data->perusahaan, 2, '.', ',');
                })
                ->addColumn('perusahaan2', function ($data) {
                    return number_format($data->perusahaan2, 2, '.', ',');
                })
                ->addColumn('perusahaan3', function ($data) {
                    return number_format($data->perusahaan3, 2, '.', ',');
                })
                ->rawColumns(['action'])
                ->make(true);
            
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pensiun.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data_cek = PayTblPensiun::all()->count(); 			
        if(!empty($data_cek)){
            $data=0;
            return response()->json($data);
        }else {
        PayTblPensiun::insert([
            'pribadi' => $request->pribadi,
            'perusahaan' => $request->perusahaan,
            'perusahaan2' => $request->perusahaan2,
            'perusahaan3' => $request->perusahaan3,
            ]);
            $data = 1;
            return response()->json($data);
        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data_list =  PayTblPensiun::where('pribadi', $id)->get();
        return view('pensiun.edit', compact('data_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        PayTblPensiun::where('pribadi', $request->pribadi)
        ->update([
            'pribadi' => $request->pribadi1,
            'perusahaan' => $request->perusahaan,
            'perusahaan2' => $request->perusahaan2,
            'perusahaan3' => $request->perusahaan3,
        ]);
        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        PayTblPensiun::where('pribadi', $request->dataid)->delete();
        return response()->json();
    }

    public function ctkiuranpensiun()
    {
        return view('pensiun.rekap');
    }
    public function rekapExport(Request $request)
    {
        $pdf = PDF::loadview('pensiun.export_iuranpensiun',compact('request'))->setPaper('a4', 'landscape');
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf ->get_canvas();
        $canvas->page_text(730, 100, "Halaman {PAGE_NUM} Dari {PAGE_COUNT}", null, 10, array(0, 0, 0)); //iuran pensiun landscape
        // return $pdf->download('rekap_umk_'.date('Y-m-d H:i:s').'.pdf');
        return $pdf->stream();
    }
    public function ctkrekapiuranpensiun()
    {
        return view('pensiun.rekapiuran');
    }
    public function rekapIuranExport(Request $request)
    {
        $pdf = PDF::loadview('pensiun.export_rekap_iuranpensiun',compact('request'))->setPaper('a4', 'landscape');
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf ->get_canvas();
        $canvas->page_text(740, 110, "Halaman {PAGE_NUM} Dari {PAGE_COUNT}", null, 10, array(0, 0, 0)); //iuran pensiun landscape
        // return $pdf->download('rekap_umk_'.date('Y-m-d H:i:s').'.pdf');
        return $pdf->stream();
    }
}
