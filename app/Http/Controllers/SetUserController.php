<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userpdv;
use App\Models\Usermenu;
use Auth;
use DB;
use Session;
use PDF;
use Alert;

class SetUserController extends Controller
{
    public function index()
    {
        return view('set_user.index');
    }

    public function searchIndex(Request $request)
    {
        $data = DB::select("select * from userpdv order by userid");
        return datatables()->of($data)
        ->addColumn('userid', function ($data) {
            return $data->userid;
       })
        ->addColumn('usernm', function ($data) {
            return $data->usernm;
       })
        ->addColumn('kode', function ($data) {
            return $data->kode;
       })
        ->addColumn('userlv', function ($data) {
            if($data->userlv == 0){
                return "ADMINISTRATOR";
            }else{
                return "USER";
            }
       })
        ->addColumn('userap', function ($data) {
            
            if(substr_count($data->userap,"A") > 0){
                 $userp1 = "[ KONTROLER ]"; 
            }else{ 
                $userp1="";
            } 
            if(substr_count($data->userap,"B") > 0){
                 $userp2 = "[ TABUNGAN ]"; 
            }else{ 
                $userp2="";
            } 
            if(substr_count($data->userap,"C") > 0){
                 $userp3 = "[ INVESTASI ]"; 
            }else{ 
                $userp3="";
            } 
            if(substr_count($data->userap,"D") > 0){ 
                $userp4 = "[ PERBENDAHARAAN ]"; 
            }else{ 
                $userp4="";
            } 
            if(substr_count($data->userap,"E") > 0){ 
                $userp5 = "[ UMUM ]"; 
            }else{ 
                $userp5="";
            } 
            if(substr_count($data->userap,"F") > 0){ 
                $userp6 = "[ SDM ]"; 
            }else{ 
                $userp6="";
            } 
            return $userp1.' '.$userp2.' '.$userp3.' '.$userp4.' '.$userp5.' '.$userp6;
       })
        ->addColumn('radio', function ($data) {
            $radio = '<center><label class="kt-radio kt-radio--bold kt-radio--brand"><input type="radio" kode="'.$data->userid.'" class="btn-radio" name="btn-radio"><span></span></label></center>'; 
            return $radio;
        })
        ->rawColumns(['radio','userap'])
        ->make(true); 
    }

    public function create()
    {
        return view('set_user.create');
    }
    public function store(Request $request)
    {
        $userid = $request->userid;
        $usernm = $request->usernm;
        $userlv = $request->userlv;
        $userap = $request->akt.''.$request->tab.''.$request->inv.''.$request->pbd.''.$request->umu.''.$request->sdm;
        $userpw = "";
        $usrupd = Auth::user()->userid;
        $kode = $request->kode;

        if($userpw == ""){
            $userpw = "v3ntur4";
        }
        $data_chkuser = DB::select("select userid from userpdv where userid='$userid'");
        if(!empty($data_chkuser)){
            foreach($data_chkuser as $data_ch)
            {
                $data = $data_ch->userid;
                return response()->json($data);
            }
            // erry="user id " & userid & " sudah ada "
            // respage="setuser&erry=" & erry & "&mode=view&userid=" & userid
        }else{
            $data_tglexp = DB::select("select (date(now()) + INTERVAL  '4' month) as tglexp");
            foreach($data_tglexp as $data_tgl)
            {
                $tglexp = $data_tgl->tglexp;
            }
            $tglupd = date('Y-m-d');
            Userpdv::insert([
                'userid' => $userid,
                'userpw' => $userpw ,
                'usernm' => $usernm,
                'kode' => $kode,
                'userlv' => $userlv,
                'userap' => $userap,
                'tglupd' => $tglupd,
                'passexp' => $tglexp,
                'usrupd' => $usrupd 
            ]);
        }
        $data_menu = DB::select("select distinct(menuid) from dftmenu");
            foreach($data_menu as $data_m)
            {
                $menuid = $data_m->menuid;
                Usermenu::insert([
                    'userid' => $userid,
                    'menuid' => $menuid,
                    'cetak' => '0',
                    'tambah' => '0',
                    'rubah' => '0',
                    'lihat' => '0',
                    'hapus' => '0'
                ]);
            }
        // strconf="sudah tersimpan dalam database"
            $data = 1;
            return response()->json($data);
    }

    public function edit($no)
    {
        $data_user = DB::select("select * from userpdv where userid='$no'");
        foreach($data_user as $data)
        {
            $userid = $data->userid;
            $userpw  = $data->userpw; 
            $usernm = $data->usernm;
            $kode = $data->kode;
            $userlv = $data->userlv;
            $userap = $data->userap;
            $usrupd = $data->usrupd;
        }
        return view('set_user.edit',compact('userid','userpw','usernm','kode','userlv','userap','usrupd'));
    }
    public function update(Request $request)
    {
        $userid = $request->userid;
        $usernm = $request->usernm;
        $userlv = $request->userlv;
        $kode = $request->kode;
        $tglupd = date('Y-m-d');
        $usrupd = Auth::user()->userid;
        $userap = $request->akt.''.$request->tab.''.$request->inv.''.$request->pbd.''.$request->umu.''.$request->sdm;
        Userpdv::where('userid',$userid)
        ->update([
            'usernm' => $usernm,
            'kode' => $kode,
            'userlv' => $userlv,
            'userap' => $userap,
            'tglupd' => $tglupd,
            'usrupd' => $usrupd 
        ]);
        return response()->json();
    }

    public function delete(Request $request)
    {
        Userpdv::where('userid',$request->kode)->delete();
        Usermenu::where('userid',$request->kode)->delete();
        return response()->json();
    }
    
}
