<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Userlogin;
use App\Models\Userlog;
use Auth;
use DB;
use Session;
use DomPDF;
use Alert;

class AuthController extends Controller
{
    

    public function login()
    {
        return view('login');
    }

    public function postlogin(Request $request){

            $loginid = $request->userid;
            $password = $request->userpw;
            $GetTerminalName=substr(gethostbyaddr($_SERVER['REMOTE_ADDR']),0,15);
            // $UserIPAddress =substr($_SERVER['REMOTE_ADDR'],0,3);
            $UserIPAddress ='192';
            if(Auth::attempt($request->only('userid','userpw'))){
                $data_user = DB::select("select userid,usernm,kode,userpw,userlv,userap,host from userpdv where userid='$loginid'");
                foreach($data_user as $rsuser)
                {
                    $sUserId = $rsuser->userid;
                    $sUserName = $rsuser->usernm;
                    $sUserGroup = $rsuser->kode;
                    $sUserLevel = $rsuser->userlv;
                    $sUserAplikasi = $rsuser->userap;
                    $sUserPassword = $rsuser->userpw;
                    if($rsuser->host == null){
                        $sUserHost = '192';
                    }else{
                        $sUserHost = $rsuser->host;
                    }
                
                        if ($password <> $rsuser->userpw) {
                            return redirect('/error')->with('notif', "Your password not allowed...");
                        }else{
                            if ($sUserHost<>"%" and $UserIPAddress <> $sUserHost) {
                                return redirect('/error')->with('notif', "You are not allowed to access from there...");
                            }else{
                                $rsUserLogin = DB::select("select userid from userlogin where terminal='$GetTerminalName' and userid='$loginid'");
                                Userlogin::where('terminal',$GetTerminalName)->where('userid',$loginid)->delete();
                                
                                if(!empty($rsUserLogin)){
                                    return redirect('/error')->with('notif', "User $loginid in use...");
                                }else{
                                    $dLogin = date('Y-m-d H:i:s');
                                    Userlogin::insert([
                                        'userid' => $loginid,
                                        'usernm' => $sUserName,
                                        'login' => $dLogin,
                                        'terminal' => $GetTerminalName
                                    ]);
                                    Userlog::insert([
                                        'terminal' => $GetTerminalName,
                                        'userid' => $loginid,
                                        'usernm' => $sUserName,
                                        'login' => $dLogin
                                    ]);
                            
                                    $request->session()->put('log',$dLogin);
                                    $request->session()->put('tgltrans',$dLogin);
                                    $data_objRs = DB::select("select u.userid, u.usernm, 
                                                            case when u.passexp > localtimestamp then 
                                                            case when u.passexp <= localtimestamp + interval '7 days' then 'ganti' 
                                                            when u.passexp >localtimestamp + interval '7 days' then 'ok' end 
                                                            when u.passexp < localtimestamp then 'exp' end as status, 
                                                            u.passexp,extract(day from u.passexp - localtimestamp)+1 as remain from userpdv u where u.userid='$loginid'");
                                    foreach($data_objRs as $objRS)
                                    {
                                        if($objRS->status == "ganti"){
                                            $tgl = date_create($objRS->passexp);
                                            $tglex = date_format($tgl, 'd F Y');
                                            $request->session()->put('tglex',$tglex);    
                                            $request->session()->put('remain',$objRS->remain);    
                                            return redirect()->route('perjalanan_dinas.index');
                                        }else{
                                            if($objRS->status == "exp"){
                                                return redirect('/error')->with('notif',"Password Anda Sudah Expired");	
                                            }else{
                                            return redirect()->route('perjalanan_dinas.index');
                                            }
                                        }
                                    }
                                }
                            }
                        }
                } //loop
            }else{
                    return redirect('/error')->with('notif',"User $loginid not allowed...");
            }
        
    }

    public function getAuthPassword()
    {
        return $this->userpw;
    }

   
 
    public function validateCredentials(UserContract $user, array $credentials)
    {
        return $user->getAuthPassword() === $credentials['userpw'];
    }
	public function logout(){
        
        $dLogin = session()->get('log');
        $dLogout = date('Y-m-d H:i:s');
        if (!empty(Auth::user()->userid)) {
            $userid = Auth::user()->userid;
            if($userid <> "Admin")
            {
                Userlogin::where('userid',$userid)->delete();
            }
        }else{
            $userid = null;
        }
        Userlog::where('userid', $userid)
        ->where('login', $dLogin)
        ->update([
            'logout' => $dLogout
            ]);
        session()->forget('log');
        session()->forget('tgltrans');
        session()->forget('tglex');
        session()->forget('remain');
        Auth::logout();
        return redirect('/login');
    }
	public function error(){
        Auth::logout();
        return view('login');
    }
}