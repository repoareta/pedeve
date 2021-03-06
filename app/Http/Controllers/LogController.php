<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userpdv;
use Auth;
use DB;
use Session;
use DomPDF;
use Alert;

class LogController extends Controller
{
    public function index()
    {
        return view('logg.index');
    }

    public function Search(Request $request)
    {
        $data = DB::select("select * from userlog where date_part('month', login) = '$request->bulan' and  date_part('year', login) = '$request->tahun'  order by login desc");
        return datatables()->of($data)
        ->addColumn('userid', function ($data) {
            return $data->userid;
        })
        ->addColumn('usernm', function ($data) {
            return $data->usernm;
        })
        ->addColumn('login', function ($data) {
            return $data->login;
        })
        ->addColumn('logout', function ($data) {
            return $data->logout;
        })
        ->addColumn('terminal', function ($data) {
            return $data->terminal;
        })
        
        ->rawColumns(['action','radio','jenis_um'])
        ->make(true);
    }
}
