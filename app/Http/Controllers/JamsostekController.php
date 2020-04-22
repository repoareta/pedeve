<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PayTblJamsostek;
use DB;
use Session;
use PDF;
use Alert;

class JamsostekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('jamsostek.index');
    }

    public function indexJson(Request $request)
    {
        if($request->ajax())
        {               
                $data = PayTblJamsostek::all();
                return datatables()->of($data)
                ->addColumn('action', function ($data) {
                        $radio = '<label  class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" class="btn-radio" data-id="'.$data->pribadi.'" name="btn-radio"><span></span></label>';
                    return $radio;
                })
                ->addColumn('pribadi', function ($data) {
                    return number_format($data->pribadi, 2, '.', ','); 
                })
                ->addColumn('accident', function ($data) {
                    return number_format($data->accident, 2, '.', ',');
                })
                ->addColumn('pensiun', function ($data) {
                    return number_format($data->pensiun, 2, '.', ',');
                })
                ->addColumn('life', function ($data) {
                    return number_format($data->life, 2, '.', ',');
                })
                ->addColumn('manulife', function ($data) {
                    return number_format($data->manulife, 2, '.', ',');
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
        return view('jamsostek.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data_cek = PayTblJamsostek::all()->count(); 			
        if(!empty($data_cek)){
            $data=0;
            return response()->json($data);
        }else {
        PayTblJamsostek::insert([
            'pribadi' => $request->pribadi,
            'accident' => $request->accident,
            'pensiun' => $request->pensiun,
            'life' => $request->life,
            'manulife' => $request->manulife
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
        $data_list =  PayTblJamsostek::where('pribadi', $id)->get();
        return view('jamsostek.edit', compact('data_list'));
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
        PayTblJamsostek::where('pribadi', $request->pribadi)
        ->update([
            'pribadi' => $request->pribadi1,
            'accident' => $request->accident,
            'pensiun' => $request->pensiun,
            'life' => $request->life,
            'manulife' => $request->manulife,
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
        PayTblJamsostek::where('pribadi', $request->dataid)->delete();
        return response()->json();
    }


    public function ctkiuranjs()
    {
        return view('jamsostek.rekap');
    }
    public function rekapExport(Request $request)
    {
        $pdf = PDF::loadview('jamsostek.export_iuranjs',compact('request'))->setPaper('a4', 'landscape');
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf ->get_canvas();
        $canvas->page_text(730, 100, "Halaman {PAGE_NUM} Dari {PAGE_COUNT}", null, 10, array(0, 0, 0)); //iuran jamsostek landscape
        // return $pdf->download('rekap_umk_'.date('Y-m-d H:i:s').'.pdf');
        return $pdf->stream();
    }
    public function ctkrekapiuranjamsostek()
    {
        return view('jamsostek.rekapiuran');
    }
    public function rekapIuranExport(Request $request)
    {
        $pdf = PDF::loadview('jamsostek.export_rekap_iuranjamsostek',compact('request'))->setPaper('a4', 'landscape');
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf ->get_canvas();
        $canvas->page_text(740, 110, "Halaman {PAGE_NUM} Dari {PAGE_COUNT}", null, 10, array(0, 0, 0)); //iuran pensiun landscape
        // return $pdf->download('rekap_umk_'.date('Y-m-d H:i:s').'.pdf');
        return $pdf->stream();
    }
}
