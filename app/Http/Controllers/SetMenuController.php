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

class SetMenuController extends Controller
{
    public function index()
    {
        return view('set_menu.index');
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
        return view('set_menu.create');
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

        
        foreach ($request['id_tag'] as $data) {
            Tag_detail::create([
                'id' => $data,
                'id_jurnal' => "0021$id_otomatis",
            ]);
            }

        // strconf="sudah tersimpan dalam database"
            $data = 1;
            return response()->json($data);
    }

    public function edit($no)
    {
        $data_user = DB::select("select  a.ability,a.userid,a.menuid, b.menunm from usermenu a join dftmenu b on  b.menuid=a.menuid where a.userid='$no' order by a.menuid");
        foreach($data_user as $data)
        {
            $userid  = $data->userid; 
        }
        return view('set_menu.edit',compact('userid','data_user'));
    }
    public function update(Request $request)
    {
        $userid=$request->userid;
        $a=$request->a;
        $as = array_sum($request->a);
        dd($as);
        for($count = 1; $count < $a; $count++)
        {
            $sa = "menuid$count";
            $menuid = $request->$sa;
            $ability = $request->ability;
            // echo "$menuid<br>";
                // $countmenuid = count($request->menuid);
                // $countability = count($request->ability);
                // if($countability >= $countmenuid){
                //     // echo "$ability[$count]";
                //     $menuid = $request->menuid;
                //     $ability = $request->ability;
                // }else{
                //     $menuid = $request->menuid;
                //     $ability = "0";
                //     // echo "0";
        
                // }
                // Usermenu::where('userid',$userid)
                // ->where('menuid',$menuid)
                // ->update([
                //     'ability' => $ability
                // ]);
                // $data = array(
                //     ':userid' => $userid[$count],
                //     ':menuid' => $menuid[$count],
                //     ':ability' => $ability[$count]
                // );
                // echo "$da";
                // DB::update("update usermenu set ability='$ability[$count]' where userid='$userid' and menuid='$menuid[$count]'");
            }
            // $sentimentPost = array_count_values($ability);

        
                // Usermenu::where('userid',$data->menuid)
                // ->where('menuid',$data->menuid)
                // ->update([
                //     'ability' => $data->ability
                // ]);        
                return response()->json();
    }

    public function delete(Request $request)
    {
        Userpdv::where('userid',$request->kode)->delete();
        Usermenu::where('userid',$request->kode)->delete();
        return response()->json();
    }
    
}
