<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dftmenu;
use Auth;
use DB;
use Session;
use PDF;
use Alert;

class TabelMenuController extends Controller
{
    public function index()
    {
        return view('tabel_menu.index');
    }

    public function searchIndex(Request $request)
    {
        $data = DB::select("select * from dftmenu order by menuid asc");
        return datatables()->of($data)
        ->addColumn('menuid', function ($data) {
            return $data->menuid;
       })
        ->addColumn('menunm', function ($data) {
            return $data->menunm;
       })
        ->addColumn('userap', function ($data) {
            return $data->userap;
       })
        ->addColumn('radio', function ($data) {
            $radio = '<center><label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" kode="'.$data->menuid.'" class="btn-radio" name="btn-radio"><span></span></label></center>'; 
            return $radio;
        })
        ->rawColumns(['radio'])
        ->make(true); 
    }

    public function create()
    {
        return view('tabel_menu.create');
    }
    public function store(Request $request)
    {
        $data_cek = DB::select("select * from dftmenu where menuid='$request->menuid'");
        if(!empty($data_cek)){
            $data = $request->menuid;
            return response()->json($data);
        }else{
            $menuid = $request->menuid;
            $menunm = $request->menunm;
            $userap = $request->userap;
            Dftmenu::insert([
                'menuid' => $menuid,
                'menunm' => $userap.' - '.$menunm,
                'userap' => $userap
            ]);
            $data = 1;
            return response()->json($data);
        }
    }

    public function edit($no)
    {
        $data_user = DB::select("select * from Dftmenu where menuid='$no'");
        foreach($data_user as $data)
        {
            $menuid = $data->menuid;
            $menunm  = $data->menunm; 
            $userap = $data->userap;
        }
        return view('tabel_menu.edit',compact('menuid','menunm','userap'));
    }
    public function update(Request $request)
    {
        $menuid = $request->menuid;
        $menunm = $request->menunm;
        $userap = $request->userap;
        Dftmenu::where('menuid',$menuid)
        ->update([
            'menunm' => $menunm,
            'userap' => $userap 
        ]);
        return response()->json();
    }

    public function delete(Request $request)
    {
        Dftmenu::where('menuid',$request->kode)->delete();
        return response()->json();
    }
    
}
